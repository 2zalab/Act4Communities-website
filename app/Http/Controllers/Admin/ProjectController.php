<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// app/Http/Controllers/Admin/ProjectController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,completed,suspended',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'objectives' => 'nullable|array',
            'expected_results' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->uploadImage($request->file('featured_image'), 'projects');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Projet créé avec succès.');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,completed,suspended',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'location' => 'nullable|string',
            'budget' => 'nullable|numeric|min:0',
            'objectives' => 'nullable|array',
            'expected_results' => 'nullable|array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $validated['featured_image'] = $this->uploadImage($request->file('featured_image'), 'projects');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Project $project)
    {
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
                        ->with('success', 'Projet supprimé avec succès.');
    }

    private function uploadImage($file, $folder)
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = "images/{$folder}/" . $filename;

        $image = Image::make($file)->resize(800, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        Storage::disk('public')->put($path, $image->encode());

        return $path;
    }
}

