<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Post;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_featured', true)
                                 ->where('is_published', true)
                                 ->with('category')
                                 ->take(6)
                                 ->get();

        $recentPosts = Post::published()
                          ->with('category', 'user')
                          ->latest()
                          ->take(3)
                          ->get();

        $partners = Partner::active()->take(8)->get();

        $testimonials = Testimonial::where('is_active', true)->take(3)->get();

        $categories = Category::where('is_active', true)
                             ->withCount('projects')
                             ->get();

        $stats = [
            'projects_completed' => Project::where('status', 'completed')->count(),
            'active_projects' => Project::where('status', 'active')->count(),
            'communities_served' => 15, // Valeur statique, peut être dynamique
            'years_experience' => now()->year - 2019, // Basé sur la création de l'ONG
        ];

        return view('frontend.home', compact(
            'featuredProjects',
            'recentPosts',
            'partners',
            'testimonials',
            'categories',
            'stats'
        ));
    }

     /**
     * Affiche la page ACD Lab
     */
    public function acdLab()
    {
        return view('frontend.acd-lab');
    }
}
