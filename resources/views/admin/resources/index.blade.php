{{-- resources/views/admin/resources/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Gestion des Ressources')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-folder-open me-2 text-primary"></i>
        Gestion des Ressources
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.resources.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Nouvelle ressource
            </a>
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-tools me-2"></i>Actions
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.resources.export') }}">
                    <i class="fas fa-download me-2"></i>Exporter en CSV
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li><button type="button" class="dropdown-item" onclick="bulkAction('publish')" id="bulk-publish">
                    <i class="fas fa-eye me-2"></i>Publier sélectionnées
                </button></li>
                <li><button type="button" class="dropdown-item" onclick="bulkAction('unpublish')" id="bulk-unpublish">
                    <i class="fas fa-eye-slash me-2"></i>Dépublier sélectionnées
                </button></li>
                <li><button type="button" class="dropdown-item text-danger" onclick="bulkAction('delete')" id="bulk-delete">
                    <i class="fas fa-trash me-2"></i>Supprimer sélectionnées
                </button></li>
            </ul>
        </div>
    </div>
</div>

<!-- Filtres -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.resources.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Rechercher</label>
                <input type="text" name="search" class="form-control" placeholder="Titre, description..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">Catégorie</label>
                <select name="category" class="form-select">
                    <option value="">Toutes</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Statut</label>
                <select name="status" class="form-select">
                    <option value="">Tous</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publiées</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Brouillons</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Mise en avant</label>
                <select name="featured" class="form-select">
                    <option value="">Toutes</option>
                    <option value="yes" {{ request('featured') == 'yes' ? 'selected' : '' }}>Oui</option>
                    <option value="no" {{ request('featured') == 'no' ? 'selected' : '' }}>Non</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-outline-primary me-2">
                    <i class="fas fa-search me-1"></i>Filtrer
                </button>
                <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i>Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Statistiques rapides -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-folder fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">{{ $resources->total() }}</div>
                        <div>Total ressources</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-eye fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">{{ $resources->where('is_published', true)->count() }}</div>
                        <div>Publiées</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-star fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">{{ $resources->where('is_featured', true)->count() }}</div>
                        <div>Mises en avant</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-download fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">{{ $resources->sum('download_count') }}</div>
                        <div>Téléchargements</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liste des ressources -->
<div class="card pb-5">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>
                Liste des ressources ({{ $resources->total() }})
            </h5>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="select-all">
                <label class="form-check-label" for="select-all">
                    Tout sélectionner
                </label>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        @if($resources->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" id="master-checkbox" class="form-check-input">
                            </th>
                            <th width="80">Aperéu</th>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Type</th>
                            <th>Taille</th>
                            <th>Statut</th>
                            <th>Téléchargements</th>
                            <th>Date</th>
                            <th width="200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>
                                    <input type="checkbox" name="resource_ids[]" value="{{ $resource->id }}" class="form-check-input resource-checkbox">
                                </td>
                                <td>
                                    <div class="resource-thumbnail">
                                        @if($resource->hasThumbnail())
                                            <img src="{{ $resource->thumbnail_url }}"
                                                alt="{{ $resource->title }}"
                                                class="img-fluid rounded"
                                                style="width: 50px; height: 50px; object-fit: cover;"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                            <!-- Fallback si l'image ne se charge pas -->
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px; display: none;">
                                                <i class="{{ $resource->file_icon }} fa-lg"></i>
                                            </div>
                                        @else
                                            <!-- Pas de thumbnail ou thumbnail manquante -->
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
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
                                    <span class="badge rounded-pill" style="background-color: {{ $resource->category->color }}; color: white;">
                                        @if($resource->category->icon)
                                            <i class="{{ $resource->category->icon }} me-1"></i>
                                        @endif
                                        {{ $resource->category->name }}
                                    </span>
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
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               {{ $resource->is_published ? 'checked' : '' }}
                                               onchange="togglePublished({{ $resource->id }})">
                                        <label class="form-check-label">
                                            <span class="badge {{ $resource->is_published ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $resource->is_published ? 'Publié' : 'Brouillon' }}
                                            </span>
                                        </label>
                                    </div>
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
                                        <!--a href="{{ route('admin.resources.show', $resource) }}" class="btn btn-outline-primary" title="Détails">
                                            <i class="fas fa-info-circle"></i>
                                        </a-->
                                        <a href="{{ route('admin.resources.edit', $resource) }}" class="btn btn-outline-secondary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-warning"
                                                onclick="toggleFeatured({{ $resource->id }})"
                                                title="Basculer mise en avant">
                                            <i class="fas fa-star {{ $resource->is_featured ? 'text-warning' : '' }}"></i>
                                        </button>
                                        <form method="POST" action="{{ route('admin.resources.destroy', $resource) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-delete" title="Supprimer">
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
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Affichage de {{ $resources->firstItem() }} à {{ $resources->lastItem() }}
                        sur {{ $resources->total() }} ressources
                    </small>
                    {{ $resources->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucune ressource trouvée</h5>
                <p class="text-muted">
                    @if(request()->hasAny(['search', 'category', 'status', 'featured']))
                        Aucune ressource ne correspond é vos critéres de recherche.
                    @else
                        Commencez par ajouter votre première ressource.
                    @endif
                </p>
                <a href="{{ route('admin.resources.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Ajouter une ressource
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.resource-thumbnail img {
    transition: transform 0.2s ease;
}

.resource-thumbnail img:hover {
    transform: scale(1.1);
}

.table tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-group .btn {
    border-color: #dee2e6;
}

.btn-group .btn:hover {
    z-index: 2;
}
</style>

<script>
// Sélection multiple
document.getElementById('master-checkbox').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.resource-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateBulkActions();
});

document.querySelectorAll('.resource-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateBulkActions);
});

function updateBulkActions() {
    const checkedBoxes = document.querySelectorAll('.resource-checkbox:checked');
    const bulkActions = document.querySelectorAll('[id^="bulk-"]');

    if (checkedBoxes.length > 0) {
        bulkActions.forEach(action => action.classList.remove('disabled'));
    } else {
        bulkActions.forEach(action => action.classList.add('disabled'));
    }
}

// Actions en lot
function bulkAction(action) {
    const checkedBoxes = document.querySelectorAll('.resource-checkbox:checked');

    if (checkedBoxes.length === 0) {
        alert('Veuillez sélectionner au moins une ressource.');
        return;
    }

    let message = '';
    switch(action) {
        case 'publish':
            message = `Publier ${checkedBoxes.length} ressource(s) ?`;
            break;
        case 'unpublish':
            message = `Mettre en brouillon ${checkedBoxes.length} ressource(s) ?`;
            break;
        case 'delete':
            message = `Supprimer définitivement ${checkedBoxes.length} ressource(s) ? Cette action est irréversible.`;
            break;
    }

    if (!confirm(message)) return;

    const resourceIds = Array.from(checkedBoxes).map(cb => cb.value);

    fetch(`{{ route('admin.resources.bulk-action') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            action: action,
            resource_ids: resourceIds
        })
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

// Toggle published status
function togglePublished(resourceId) {
    fetch(`{{ route('admin.resources.toggle-published', ':id') }}`.replace(':id', resourceId), {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI without full reload
            const row = document.querySelector(`input[value="${resourceId}"]`).closest('tr');
            const badge = row.querySelector('.badge');
            const switchInput = row.querySelector('.form-check-input');

            if (data.is_published) {
                badge.className = 'badge bg-success';
                badge.textContent = 'Publié';
                switchInput.checked = true;
            } else {
                badge.className = 'badge bg-secondary';
                badge.textContent = 'Brouillon';
                switchInput.checked = false;
            }

            // Show success message
            showToast(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload(); // Fallback
    });
}

// Toggle featured status
function toggleFeatured(resourceId) {
    fetch(`{{ route('admin.resources.toggle-featured', ':id') }}`.replace(':id', resourceId), {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI
            const row = document.querySelector(`input[value="${resourceId}"]`).closest('tr');
            const starIcon = row.querySelector('.fa-star');

            if (data.is_featured) {
                starIcon.classList.add('text-warning');
            } else {
                starIcon.classList.remove('text-warning');
            }

            showToast(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Toast notification
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 5000);
}

// Initialize bulk actions state
updateBulkActions();
</script>
@endsection
