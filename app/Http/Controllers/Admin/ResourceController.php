<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Resource::with(['category']);

        // Filtres
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === 'yes');
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $resources = $query->orderBy('created_at', 'desc')->paginate(20);
        $categories = ResourceCategory::orderBy('name')->get();

        return view('admin.resources.index', compact('resources', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ResourceCategory::where('is_active', true)
                                     ->orderBy('name')
                                     ->get();

        return view('admin.resources.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resources,slug',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:resource_categories,id',
            'file' => 'required|file|max:50000|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar',
            'thumbnail' => 'nullable|image|max:5000|mimes:jpeg,png,jpg,gif,svg',
            'tags' => 'nullable|string',
            //'is_published' => 'nullable|boolean',
            //'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Préparer les données de base
        $data = $request->only([
            'title', 'slug', 'description', 'content',
            'category_id', 'tags', 'meta_title', 'meta_description'
        ]);

        // Générer le slug si vide
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Gérer les checkbox APRÈS la validation
        $data['is_published'] = $request->has('is_published') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;


        // Gérer les checkbox (elles ne sont envoyées que si cochées)
        //$data['is_published'] = $request->has('is_published');
        //$data['is_featured'] = $request->has('is_featured');

        // Upload du fichier principal (obligatoire)
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Vérifier que le fichier est valide
            if ($file->isValid()) {
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('resources/files', $filename, 'public');

                $data['file_path'] = $filePath;
                $data['original_filename'] = $file->getClientOriginalName();
                $data['file_type'] = $file->getMimeType();
                $data['file_size'] = $file->getSize();
            } else {
                return back()->withErrors(['file' => 'Le fichier uploadé est invalide.'])->withInput();
            }
        } else {
            return back()->withErrors(['file' => 'Le fichier est obligatoire.'])->withInput();
        }

        // Upload du thumbnail (optionnel)
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');

            if ($thumbnail->isValid()) {
                $thumbnailName = time() . '_thumb_' . Str::slug(pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnailPath = $thumbnail->storeAs('resources/thumbnails', $thumbnailName, 'public');
                $data['thumbnail'] = $thumbnailPath;
            }
        }

        try {
            Resource::create($data);

            $redirectTo = $request->has('save_and_continue')
                ? route('admin.resources.edit', Resource::latest()->first())
                : route('admin.resources.index');

            return redirect($redirectTo)->with('success', 'Ressource créée avec succès.');
        } catch (\Exception $e) {
            // Nettoyer les fichiers en cas d'erreur
            if (isset($data['file_path']) && Storage::disk('public')->exists($data['file_path'])) {
                Storage::disk('public')->delete($data['file_path']);
            }
            if (isset($data['thumbnail']) && Storage::disk('public')->exists($data['thumbnail'])) {
                Storage::disk('public')->delete($data['thumbnail']);
            }

            return back()->withErrors(['error' => 'Erreur lors de la création de la ressource.'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        $resource->load(['category']);
        return view('admin.resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        $categories = ResourceCategory::where('is_active', true)
                                     ->orderBy('name')
                                     ->get();

        return view('admin.resources.edit', compact('resource', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resources,slug,' . $resource->id,
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'category_id' => 'required|exists:resource_categories,id',
            'file' => 'nullable|file|max:50000|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar',
            'thumbnail' => 'nullable|image|max:5000|mimes:jpeg,png,jpg,gif,svg',
            'tags' => 'nullable|string',
            //'is_published' => 'nullable|boolean',
            //'is_featured' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Préparer les données de base
        $data = $request->only([
            'title', 'slug', 'description', 'content',
            'category_id', 'tags', 'meta_title', 'meta_description'
        ]);

        // Générer le slug si vide
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Gérer les checkbox
        //$data['is_published'] = $request->has('is_published');
        //$data['is_featured'] = $request->has('is_featured');

        // Gérer les checkbox APRÈS la validation
        $data['is_published'] = $request->has('is_published') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;

        // Gestion du fichier principal - SEULEMENT si un nouveau fichier est fourni
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($file->isValid()) {
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

                try {
                    // Stocker le nouveau fichier
                    $filePath = $file->storeAs('resources/files', $filename, 'public');

                    // Sauvegarder l'ancien chemin pour suppression ultérieure
                    $oldFilePath = $resource->file_path;

                    // Mettre à jour les données
                    $data['file_path'] = $filePath;
                    $data['original_filename'] = $file->getClientOriginalName();
                    $data['file_type'] = $file->getMimeType();
                    $data['file_size'] = $file->getSize();

                    // Supprimer l'ancien fichier seulement après le succès
                    if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                        Storage::disk('public')->delete($oldFilePath);
                    }
                } catch (\Exception $e) {
                    return back()->withErrors(['file' => 'Erreur lors de l\'upload du fichier.'])->withInput();
                }
            } else {
                return back()->withErrors(['file' => 'Le fichier uploadé est invalide.'])->withInput();
            }
        }

        // Gestion du thumbnail - SEULEMENT si une nouvelle image est fournie
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');

            if ($thumbnail->isValid()) {
                $thumbnailName = time() . '_thumb_' . Str::slug(pathinfo($thumbnail->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $thumbnail->getClientOriginalExtension();

                try {
                    // Stocker la nouvelle image
                    $thumbnailPath = $thumbnail->storeAs('resources/thumbnails', $thumbnailName, 'public');

                    // Sauvegarder l'ancien chemin
                    $oldThumbnailPath = $resource->thumbnail;

                    // Mettre à jour les données
                    $data['thumbnail'] = $thumbnailPath;

                    // Supprimer l'ancienne image seulement après le succès
                    if ($oldThumbnailPath && Storage::disk('public')->exists($oldThumbnailPath)) {
                        Storage::disk('public')->delete($oldThumbnailPath);
                    }
                } catch (\Exception $e) {
                    return back()->withErrors(['thumbnail' => 'Erreur lors de l\'upload de l\'image.'])->withInput();
                }
            }
        }

        try {
            $resource->update($data);
            return redirect()->route('admin.resources.index')->with('success', 'Ressource mise à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour de la ressource.'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        // Supprimer les fichiers
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        if ($resource->thumbnail && Storage::disk('public')->exists($resource->thumbnail)) {
            Storage::disk('public')->delete($resource->thumbnail);
        }

        $resource->delete();

        return redirect()->route('admin.resources.index')
                        ->with('success', 'Ressource supprimée avec succès.');
    }

    /**
     * Toggle featured status.
     */
     public function toggleFeatured(Resource $resource)
{
    try {
        $resource->update([
            'is_featured' => !$resource->is_featured
        ]);

        $status = $resource->is_featured ? 'mise en avant' : 'retirée de la mise en avant';

        // Nettoyer et encoder correctement les chaînes UTF-8
        $message = mb_convert_encoding("Ressource {$status} avec succès.", 'UTF-8', 'auto');

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_featured' => $resource->is_featured
        ], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    } catch (\Exception $e) {
        \Log::error('Erreur toggle featured: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la mise à jour.'
        ], 500, ['Content-Type' => 'application/json; charset=utf-8']);
    }
}
    /**
     * Toggle published status.
     */
     public function togglePublished(Resource $resource)
{
    try {
        $resource->update([
            'is_published' => !$resource->is_published
        ]);

        $status = $resource->is_published ? 'publiée' : 'mise en brouillon';
        $message = mb_convert_encoding("Ressource {$status} avec succès.", 'UTF-8', 'auto');

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_published' => $resource->is_published
        ], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    } catch (\Exception $e) {
        \Log::error('Erreur toggle published: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Erreur lors de la mise à jour.'
        ], 500, ['Content-Type' => 'application/json; charset=utf-8']);
    }
}

    /**
     * Bulk actions.
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:publish,unpublish,feature,unfeature,delete',
            'resource_ids' => 'required|array',
            'resource_ids.*' => 'exists:resources,id'
        ]);

        $resources = Resource::whereIn('id', $request->resource_ids);

        switch ($request->action) {
            case 'publish':
                $resources->update(['is_published' => true]);
                $message = count($request->resource_ids) . ' ressource(s) publiée(s).';
                break;
            case 'unpublish':
                $resources->update(['is_published' => false]);
                $message = count($request->resource_ids) . ' ressource(s) mise(s) en brouillon.';
                break;
            case 'feature':
                $resources->update(['is_featured' => true]);
                $message = count($request->resource_ids) . ' ressource(s) mise(s) en avant.';
                break;
            case 'unfeature':
                $resources->update(['is_featured' => false]);
                $message = count($request->resource_ids) . ' ressource(s) retirée(s) de la mise en avant.';
                break;
            case 'delete':
                // Supprimer les fichiers
                foreach ($resources->get() as $resource) {
                    if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                        Storage::disk('public')->delete($resource->file_path);
                    }
                    if ($resource->thumbnail && Storage::disk('public')->exists($resource->thumbnail)) {
                        Storage::disk('public')->delete($resource->thumbnail);
                    }
                }
                $resources->delete();
                $message = count($request->resource_ids) . ' ressource(s) supprimée(s).';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Export resources.
     */
    public function export()
    {
        $resources = Resource::with(['category'])->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="resources_export_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($resources) {
            $file = fopen('php://output', 'w');

            // En-tétes CSV
            fputcsv($file, [
                'ID', 'Titre', 'Slug', 'Catégorie', 'Description', 'Nom du fichier',
                'Type de fichier', 'Taille', 'Tags', 'Publié', 'Mis en avant',
                'Téléchargements', 'Date de création'
            ]);

            // Données
            foreach ($resources as $resource) {
                fputcsv($file, [
                    $resource->id,
                    $resource->title,
                    $resource->slug,
                    $resource->category->name,
                    $resource->description,
                    $resource->original_filename,
                    $resource->file_type,
                    $resource->formatted_file_size,
                    $resource->tags,
                    $resource->is_published ? 'Oui' : 'Non',
                    $resource->is_featured ? 'Oui' : 'Non',
                    $resource->download_count,
                    $resource->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
