<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->with('category', 'user');

        // Filtrage par catégorie
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtrage par type
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Recherche par mot-clé
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->latest('published_at')->paginate(9);

        $categories = Category::where('is_active', true)
                             ->withCount('posts')
                             ->get();

        $featuredPosts = Post::published()
                           ->where('is_featured', true)
                           ->take(3)
                           ->get();

        $recentPosts = Post::published()
                         ->latest('published_at')
                         ->take(5)
                         ->get();

        return view('frontend.posts.index', compact(
            'posts',
            'categories',
            'featuredPosts',
            'recentPosts'
        ));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
                   ->published()
                   ->with('category', 'user')
                   ->firstOrFail();

        // Incrémenter le compteur de vues
        $post->increment('views_count');

        $relatedPosts = Post::where('category_id', $post->category_id)
                          ->where('id', '!=', $post->id)
                          ->published()
                          ->take(3)
                          ->get();

        $recentPosts = Post::published()
                         ->latest('published_at')
                         ->take(5)
                         ->get();

        return view('frontend.posts.show', compact('post', 'relatedPosts', 'recentPosts'));
    }
}

