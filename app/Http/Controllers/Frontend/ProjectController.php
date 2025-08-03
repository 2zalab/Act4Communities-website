<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::where('is_published', true)->with('category');

        // Filtrage par catégorie
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtrage par statut
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Recherche par mot-clé
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $projects = $query->latest()->paginate(9);

        $categories = Category::where('is_active', true)
                             ->withCount('projects')
                             ->get();

        $featuredProjects = Project::where('is_featured', true)
                                 ->where('is_published', true)
                                 ->take(3)
                                 ->get();

        return view('frontend.projects.index', compact(
            'projects',
            'categories',
            'featuredProjects'
        ));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
                         ->where('is_published', true)
                         ->with('category')
                         ->firstOrFail();

        $relatedProjects = Project::where('category_id', $project->category_id)
                                ->where('id', '!=', $project->id)
                                ->where('is_published', true)
                                ->take(3)
                                ->get();

        return view('frontend.projects.show', compact('project', 'relatedProjects'));
    }

    public function ongoing()
    {
        $projects = Project::where('status', 'active')
                          ->where('is_published', true)
                          ->with('category')
                          ->paginate(9);

        return view('frontend.projects.ongoing', compact('projects'));
    }

    public function completed()
    {
        $projects = Project::where('status', 'completed')
                          ->where('is_published', true)
                          ->with('category')
                          ->paginate(9);

        return view('frontend.projects.completed', compact('projects'));
    }
}
