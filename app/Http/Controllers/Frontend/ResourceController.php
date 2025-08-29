<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of resources.
     */
    public function index(Request $request)
    {
        $query = Resource::with(['category'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc');

        // Filtrage par catégorie
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtrage par type de fichier
        if ($request->filled('type')) {
            $query->where('file_type', $request->type);
        }

        // Recherche
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('tags', 'like', "%{$searchTerm}%");
            });
        }

        $resources = $query->paginate(12);
        $categories = ResourceCategory::withCount('resources')->get();

        // Types de fichiers disponibles
        $fileTypes = Resource::select('file_type')
            ->where('is_published', true)
            ->distinct()
            ->pluck('file_type')
            ->filter()
            ->values();

        return view('frontend.resources.index', compact('resources', 'categories', 'fileTypes'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $resource = Resource::with(['category'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Incrémenter le compteur de téléchargements/vues
        $resource->increment('download_count');

        // Ressources similaires
        $relatedResources = Resource::where('category_id', $resource->category_id)
            ->where('id', '!=', $resource->id)
            ->where('is_published', true)
            ->limit(4)
            ->get();

        return view('frontend.resources.show', compact('resource', 'relatedResources'));
    }

    /**
     * Download resource file.
     */
      public function download($slug)
    {
        $resource = Resource::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Debug : vérifier les informations du fichier
        \Log::info('Download attempt:', [
            'resource_id' => $resource->id,
            'slug' => $slug,
            'file_path' => $resource->file_path,
            'original_filename' => $resource->original_filename,
            'file_exists' => Storage::disk('public')->exists($resource->file_path ?? ''),
            'storage_path' => Storage::disk('public')->path($resource->file_path ?? ''),
        ]);

        if (!$resource->file_path) {
            abort(404, 'Aucun fichier associé à cette ressource');
        }

        if (!Storage::disk('public')->exists($resource->file_path)) {
            \Log::error('File not found:', [
                'resource_id' => $resource->id,
                'file_path' => $resource->file_path,
                'full_path' => Storage::disk('public')->path($resource->file_path),
                'storage_exists' => file_exists(Storage::disk('public')->path($resource->file_path))
            ]);

            abort(404, 'Fichier non trouvé sur le serveur');
        }

        // Incrémenter le compteur de téléchargements
        $resource->increment('download_count');

        // Log du téléchargement
        \Log::info('Resource downloaded', [
            'resource_id' => $resource->id,
            'title' => $resource->title,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        // Nom de fichier pour le téléchargement
        $downloadName = $resource->original_filename ?:
                       ($resource->title . '.' . pathinfo($resource->file_path, PATHINFO_EXTENSION));

        try {
            return Storage::disk('public')->download($resource->file_path, $downloadName);
        } catch (\Exception $e) {
            \Log::error('Download error:', [
                'resource_id' => $resource->id,
                'error' => $e->getMessage(),
                'file_path' => $resource->file_path
            ]);

            abort(500, 'Erreur lors du téléchargement du fichier');
        }
    }

    /**
     * Display resources by category.
     */
    public function category($slug)
    {
        $category = ResourceCategory::where('slug', $slug)->firstOrFail();

        $resources = Resource::with(['category'])
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = ResourceCategory::withCount('resources')->get();

        $fileTypes = Resource::select('file_type')
            ->where('category_id', $category->id)
            ->where('is_published', true)
            ->distinct()
            ->pluck('file_type')
            ->filter()
            ->values();

        return view('frontend.resources.category', compact('resources', 'category', 'categories', 'fileTypes'));
    }

    /**
     * Search resources via API.
     */
    public function search(Request $request)
    {
        $query = Resource::with(['category'])
            ->where('is_published', true);

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhere('tags', 'like', "%{$searchTerm}%");
            });
        }

        $resources = $query->limit(10)->get();

        return response()->json([
            'resources' => $resources->map(function ($resource) {
                return [
                    'id' => $resource->id,
                    'title' => $resource->title,
                    'slug' => $resource->slug,
                    'category' => $resource->category->name,
                    'file_type' => $resource->file_type,
                    'file_size' => $resource->formatted_file_size,
                ];
            })
        ]);
    }
}
