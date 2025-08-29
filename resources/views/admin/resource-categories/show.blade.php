{{-- resources/views/admin/resource-categories/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Détails de la Catégorie - ' . $resourceCategory->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="{{ $resourceCategory->icon ?: 'fas fa-folder' }} me-2" style="color: {{ $resourceCategory->color }}"></i>
        {{ $resourceCategory->name }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('resources.category', $resourceCategory->slug) }}" target="_blank" class="btn btn-outline-info">
                <i class="fas fa-eye me-2"></i>Voir sur le site
            </a>
            <a href="{{ route('admin.resource-categories.edit', $resourceCategory) }}" class="btn btn-outline-secondary">
                <i class="fas fa-edit me-2"></i>Modifier
            </a>
        </div>
        <a href="{{ route('admin.resource-categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
        </a>
    </div>
</div>

<!-- Informations de la catégorie -->
<div class="row mb-4">
    <!-- Informations principales -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informations de la catégorie
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom</label>
                            <div class="form-control-plaintext">{{ $resourceCategory->name }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Slug (URL)</label>
                            <div class="form-control-plaintext">
                                <code>{{ $resourceCategory->slug }}</code>
                                <small class="text-muted d-block">
                                    <i class="fas fa-link me-1"></i>
                                    {{ url('/resources/category/' . $resourceCategory->slug) }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <div class="form-control-plaintext">
                        {{ $resourceCategory->description ?: 'Aucune description' }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icône</label>
                            <div class="form-control-plaintext">
                                @if($resourceCategory->icon)
                                    <i class="{{ $resourceCategory->icon }} me-2" style="color: {{ $resourceCategory->color }}; font-size: 1.5rem;"></i>
                                    <code>{{ $resourceCategory->icon }}</code>
                                @else
                                    <span class="text-muted">Aucune icône</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Couleur</label>
                            <div class="form-control-plaintext">
                                <div class="d-flex align-items-center">
                                    <div class="color-preview me-2"
                                         style="width: 30px; height: 30px; background-color: {{ $resourceCategory->color }}; border-radius: 50%; border: 2px solid #dee2e6;"></div>
                                    <code>{{ $resourceCategory->color }}</code>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ordre</label>
                            <div class="form-control-plaintext">
                                <span class="badge bg-secondary">{{ $resourceCategory->sort_order }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Statut</label>
                            <div class="form-control-plaintext">
                                <span class="badge {{ $resourceCategory->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    <i class="fas fa-{{ $resourceCategory->is_active ? 'check' : 'times' }} me-1"></i>
                                    {{ $resourceCategory->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de ressources</label>
                            <div class="form-control-plaintext">
                                <span class="badge bg-info">{{ $resourceCategory->resources->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Créée le</label>
                            <div class="form-control-plaintext">
                                <i class="fas fa-calendar me-1 text-muted"></i>
                                {{ $resourceCategory->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Modifiée le</label>
                            <div class="form-control-plaintext">
                                <i class="fas fa-edit me-1 text-muted"></i>
                                {{ $resourceCategory->updated_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar avec aperçu -->
    <div class="col-lg-4">
        <!-- Aperçu de la catégorie -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>
                    Aperçu
                </h5>
            </div>
            <div class="card-body">
                <div class="category-preview p-3 border rounded">
                    <div class="d-flex align-items-center">
                        <div class="icon-container rounded-circle d-flex align-items-center justify-content-center me-3"
                             style="width: 50px; height: 50px; background-color: {{ $resourceCategory->color }}20; border: 2px solid {{ $resourceCategory->color }}">
                            <i class="{{ $resourceCategory->icon ?: 'fas fa-folder' }}" style="color: {{ $resourceCategory->color }}; font-size: 1.2rem;"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">{{ $resourceCategory->name }}</h6>
                            <p class="text-muted small mb-0">{{ $resourceCategory->description ?: 'Aucune description' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    Actions rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('resources.category', $resourceCategory->slug) }}" target="_blank" class="btn btn-outline-info">
                        <i class="fas fa-eye me-2"></i>Voir sur le site
                    </a>
                    <a href="{{ route('admin.resource-categories.edit', $resourceCategory) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Modifier
                    </a>
                    <a href="{{ route('admin.resources.create') }}?category_id={{ $resourceCategory->id }}" class="btn btn-outline-success">
                        <i class="fas fa-plus me-2"></i>Ajouter une ressource
                    </a>
                    <button type="button" class="btn btn-outline-warning" onclick="toggleActive({{ $resourceCategory->id }})">
                        <i class="fas fa-{{ $resourceCategory->is_active ? 'eye-slash' : 'eye' }} me-2"></i>
                        {{ $resourceCategory->is_active ? 'Désactiver' : 'Activer' }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Actions danger -->
        @if($resourceCategory->resources->count() == 0)
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Zone de danger
                </h5>
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">
                    Cette catégorie ne contient aucune ressource et peut être supprimée.
                </p>
                <form method="POST" action="{{ route('admin.resource-categories.destroy', $resourceCategory) }}"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        <i class="fas fa-trash me-2"></i>Supprimer la catégorie
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Liste des ressources de cette catégorie -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-folder-open me-2"></i>
                Ressources dans cette catégorie ({{ $resourceCategory->resources->count() }})
            </h5>
            @if($resourceCategory->resources->count() > 0)
                <a href="{{ route('admin.resources.index') }}?category={{ $resourceCategory->id }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-cog me-2"></i>Gérer toutes
                </a>
            @endif
        </div>
    </div>

    <div class="card-body p-0">
        @if($resourceCategory->resources->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Aperçu</th>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Taille</th>
                            <th>Statut</th>
                            <th>Téléchargements</th>
                            <th>Date</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resourceCategory->resources->take(10) as $resource)
                            <tr>
                                <td>
                                    <div class="resource-thumbnail">
                                        @if($resource->thumbnail)
                                            <img src="{{ $resource->thumbnail_url }}" alt="{{ $resource->title }}" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="{{ $resource->file_icon }} fa-lg"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ Str::limit($resource->title, 40) }}</strong>
                                        @if($resource->is_featured)
                                            <span class="badge bg-warning ms-1">
                                                <i class="fas fa-star"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ Str::limit($resource->description, 60) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $resource->file_extension }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $resource->formatted_file_size }}</small>
                                </td>
                                <td>
                                    <span class="badge {{ $resource->is_published ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $resource->is_published ? 'Publié' : 'Brouillon' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $resource->download_count }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $resource->created_at->format('d/m/Y') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ $resource->url }}" target="_blank" class="btn btn-outline-info" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.resources.show', $resource) }}" class="btn btn-outline-primary" title="Détails">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <a href="{{ route('admin.resources.edit', $resource) }}" class="btn btn-outline-secondary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($resourceCategory->resources->count() > 10)
                <div class="card-footer text-center">
                    <a href="{{ route('admin.resources.index') }}?category={{ $resourceCategory->id }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Voir toutes les {{ $resourceCategory->resources->count() }} ressources
                    </a>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="{{ $resourceCategory->icon ?: 'fas fa-folder-open' }} fa-3x text-muted mb-3" style="color: {{ $resourceCategory->color }}60 !important;"></i>
                <h5 class="text-muted">Aucune ressource dans cette catégorie</h5>
                <p class="text-muted">Cette catégorie ne contient pas encore de ressources.</p>
                <a href="{{ route('admin.resources.create') }}?category_id={{ $resourceCategory->id }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Ajouter la première ressource
                </a>
            </div>
        @endif
    </div>
</div>e
<style>
.category-preview {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.icon-container {
    transition: all 0.3s ease;
}

.color-preview {
    transition: transform 0.2s ease;
}

.color-preview:hover {
    transform: scale(1.1);
}

.resource-thumbnail img {
    transition: transform 0.2s ease;
}

.resource-thumbnail img:hover {
    transform: scale(1.1);
}

.table tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn-group .btn {
    border-color: #dee2e6;
}

.btn-group .btn:hover {
    z-index: 2;
}
</style>

<script>
// Toggle active status
function toggleActive(categoryId) {
    fetch(`{{ route('admin.resource-categories.toggle-active', ':id') }}`.replace(':id', categoryId), {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Une erreur est survenue');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue');
    });
}
</script>
@endsection
