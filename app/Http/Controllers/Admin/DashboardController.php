<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Post;
use App\Models\Contact;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'posts' => Post::count(),
            'contacts' => Contact::unread()->count(),
            'users' => User::count(),
            'active_projects' => Project::where('status', 'active')->count(),
            'completed_projects' => Project::where('status', 'completed')->count(),
            'published_posts' => Post::published()->count(),
        ];

        $recent_contacts = Contact::latest()->take(5)->get();
        $recent_posts = Post::with('category', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts', 'recent_posts'));
    }
}

