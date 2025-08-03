{{-- resources/views/admin/categories/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Gestion des catégories')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Catégories</h1>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des Catégories</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Nouvelle Catégorie
            </a>
        </div>
        @if($categories->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Couleur</th>
                        <th>Icône</th>
                        <th>Statut</th>
                        <th>Projets</th>
                        <th>Articles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $category->color }}; color: white;">
                                {{ $category->color }}
                            </span>
                        </td>
                        <td>
                            <i class="{{ $category->icon }}"></i>
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>{{ $category->projects_count }}</td>
                        <td>{{ $category->posts_count }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
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
        @else
        <div class="text-center py-4">
            <i class="fas fa-folder fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucune catégorie trouvée</h5>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Créer la première catégorie
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
