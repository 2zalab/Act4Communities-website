<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResourceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResourceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ResourceCategory::withCount('resources')
                                     ->orderBy('sort_order')
                                     ->get();

        return view('admin.resource-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resource-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resource_categories,slug',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Générer le slug si vide
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Valeur par défaut pour la couleur
        if (empty($data['color'])) {
            $data['color'] = '#6B7280';
        }

        // Checkbox value
        $data['is_active'] = $request->has('is_active');

        // Sort order par défaut
        if (empty($data['sort_order'])) {
            $data['sort_order'] = ResourceCategory::max('sort_order') + 1;
        }

        ResourceCategory::create($data);

        return redirect()->route('admin.resource-categories.index')
                        ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ResourceCategory $resourceCategory)
    {
        $resourceCategory->load(['resources' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('admin.resource-categories.show', compact('resourceCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceCategory $resourceCategory)
    {
        return view('admin.resource-categories.edit', compact('resourceCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResourceCategory $resourceCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:resource_categories,slug,' . $resourceCategory->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        
        // Générer le slug si vide
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        // Checkbox value
        $data['is_active'] = $request->has('is_active');

        $resourceCategory->update($data);

        return redirect()->route('admin.resource-categories.index')
                        ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResourceCategory $resourceCategory)
    {
        // Vérifier s'il y a des ressources associées
        if ($resourceCategory->resources()->count() > 0) {
            return redirect()->route('admin.resource-categories.index')
                            ->with('error', 'Impossible de supprimer cette catégorie car elle contient des ressources.');
        }

        $resourceCategory->delete();

        return redirect()->route('admin.resource-categories.index')
                        ->with('success', 'Catégorie supprimée avec succès.');
    }

    /**
     * Update sort order via AJAX.
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:resource_categories,id',
            'categories.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->categories as $categoryData) {
            ResourceCategory::where('id', $categoryData['id'])
                           ->update(['sort_order' => $categoryData['sort_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Ordre des catégories mis à jour avec succès.'
        ]);
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(ResourceCategory $resourceCategory)
    {
        $resourceCategory->update([
            'is_active' => !$resourceCategory->is_active
        ]);

        $status = $resourceCategory->is_active ? 'activée' : 'désactivée';

        return response()->json([
            'success' => true,
            'message' => "Catégorie {$status} avec succès.",
            'is_active' => $resourceCategory->is_active
        ]);
    }
}