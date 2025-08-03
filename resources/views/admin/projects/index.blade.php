{{-- resources/views/admin/projects/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Gestion des projets')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Projets</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-1"></i>Nouveau Projet
        </a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>En cours</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="category" class="form-label">Catégorie</label>
                <select class="form-select" id="category" name="category">
                    <option value="">Toutes les catégories</option>
                    @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="search" class="form-label">Recherche</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Titre, description...">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Projects Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des Projets ({{ $projects->total() }})</h5>
    </div>
    <div class="card-body">
        @if($projects->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Projet</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Période</th>
                        <th>Budget</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($project->featured_image)
                                <img src="{{ asset('storage/' . $project->featured_image) }}"
                                     class="me-3 rounded" width="50" height="50" style="object-fit: cover;">
                                @endif
                                <div>
                                    <h6 class="mb-0">{{ $project->title }}</h6>
                                    <small class="text-muted">{{ Str::limit($project->excerpt, 60) }}</small>
                                    @if($project->is_featured)
                                    <span class="badge bg-warning ms-2">Phare</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ Str::limit($category->name, 10) }}</span>
                        </td>
                         <td>
                            <span class="badge
                                @if($project->status == 'active') bg-success
                                @elseif($project->status == 'completed') bg-danger
                                @else bg-purple
                                @endif
                                text-white">
                                @if($project->status == 'active') En cours
                                @elseif($project->status == 'completed') Terminé
                                @else Suspendu @endif
                            </span>
                        </td>
                        <td>
                            @if($project->start_date)
                            {{ $project->start_date->format('M Y') }}
                            @if($project->end_date) - {{ $project->end_date->format('M Y') }} @endif
                            @else
                            <span class="text-muted">Non définie</span>
                            @endif
                        </td>
                        <td>
                            @if($project->budget)
                            {{ number_format($project->budget, 0, ',', ' ') }} FCFA
                            @else
                            <span class="text-muted">Non défini</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.projects.show', $project) }}"
                                   class="btn btn-sm btn-outline-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                   class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                      class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $projects->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucun projet trouvé</h5>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Créer le premier projet
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
