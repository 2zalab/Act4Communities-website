{{-- resources/views/admin/resource-categories/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Catégories de Ressources')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tags me-2 text-primary"></i>
        Catégories de Ressources
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.resource-categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouvelle catégorie
        </a>
    </div>
</div>

<!-- Statistiques rapides -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-tags fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">{{ $categories->count() }}</div>
                        <div>Total catégories</div>
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
                        <div class="fs-5 fw-bold">{{ $categories->where('is_active', true)->count() }}</div>
                        <div>Actives</div>
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
                        <i class="fas fa-folder fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">{{ $categories->sum('resources_count') }}</div>
                        <div>Total ressources</div>
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
                        <i class="fas fa-sort fa-2x opacity-75"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="fs-5 fw-bold">
                            <i class="fas fa-arrows-alt"></i>
                        </div>
                        <div>Ordonnable</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Liste des catégories -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>
                Liste des catégories
            </h5>
            <small class="text-muted">Glissez-déposez pour réorganiser</small>
        </div>
    </div>

    <div class="card-body p-0">
        @if($categories->count() > 0)
            <div id="sortable-categories">
                @foreach($categories as $category)
                    <div class="category-item" data-id="{{ $category->id }}">
                        <div class="d-flex align-items-center p-3 border-bottom position-relative">
                            <!-- Handle pour le drag & drop -->
                            <div class="drag-handle me-3">
                                <i class="fas fa-grip-vertical text-muted"></i>
                            </div>

                            <!-- Icéne de la catégorie -->
                            <div class="category-icon me-3">
                                <div class="icon-container rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 50px; background-color: {{ $category->color }}20; border: 2px solid {{ $category->color }}">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }}" style="color: {{ $category->color }}; font-size: 1.2rem;"></i>
                                    @else
                                        <i class="fas fa-folder" style="color: {{ $category->color }}; font-size: 1.2rem;"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- Informations de la catégorie -->
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    <h6 class="mb-0 me-2">{{ $category->name }}</h6>
                                    @if(!$category->is_active)
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>
                                <p class="text-muted small mb-1">{{ $category->description ?: 'Aucune description' }}</p>
                                <div class="d-flex align-items-center gap-3">
                                    <small class="text-muted">
                                        <i class="fas fa-folder me-1"></i>{{ $category->resources_count }} ressource(s)
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-sort-numeric-up me-1"></i>Ordre: {{ $category->sort_order }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-link me-1"></i>/resources/category/{{ $category->slug }}
                                    </small>
                                </div>
                            </div>

                            <!-- Statut toggle -->
                            <div class="me-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           {{ $category->is_active ? 'checked' : '' }}
                                           onchange="toggleActive({{ $category->id }})">
                                    <label class="form-check-label">
                                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('resources.category', $category->slug) }}" target="_blank"
                                   class="btn btn-outline-info" title="Voir sur le site">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.resource-categories.show', $category) }}"
                                   class="btn btn-outline-primary" title="Voir les ressources">
                                    <i class="fas fa-folder-open"></i>
                                </a>
                                <a href="{{ route('admin.resource-categories.edit', $category) }}"
                                   class="btn btn-outline-secondary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($category->resources_count == 0)
                                    <form method="POST" action="{{ route('admin.resource-categories.destroy', $category) }}"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-delete" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-danger" disabled title="Contient des ressources">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucune catégorie</h5>
                <p class="text-muted">Commencez par créer votre premiére catégorie de ressources.</p>
                <a href="{{ route('admin.resource-categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Créer une catégorie
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="confirmButton">Confirmer</button>
            </div>
        </div>
    </div>
</div>

<style>
.category-item {
    transition: all 0.3s ease;
    background: white;
}

.category-item:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.category-item.ui-sortable-helper {
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    transform: rotate(2deg);
    background: white;
    border-radius: 8px;
}

.drag-handle {
    cursor: move;
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.category-item:hover .drag-handle {
    opacity: 1;
}

.icon-container {
    transition: all 0.3s ease;
}

.category-item:hover .icon-container {
    transform: scale(1.1);
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-group .btn {
    border-color: #dee2e6;
}

.sortable-placeholder {
    height: 80px;
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
    margin: 5px 0;
}
</style>

<!-- jQuery UI pour le drag & drop -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
$(document).ready(function() {
    // Rendre la liste triable
    $('#sortable-categories').sortable({
        handle: '.drag-handle',
        placeholder: 'sortable-placeholder',
        update: function(event, ui) {
            updateCategoryOrder();
        },
        start: function(event, ui) {
            ui.item.addClass('ui-sortable-helper');
        },
        stop: function(event, ui) {
            ui.item.removeClass('ui-sortable-helper');
        }
    });
});

// Mise é jour de l'ordre des catégories
function updateCategoryOrder() {
    const categories = [];

    $('#sortable-categories .category-item').each(function(index) {
        categories.push({
            id: $(this).data('id'),
            sort_order: index + 1
        });
    });

    fetch(`{{ route('admin.resource-categories.update-order') }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            categories: categories
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            // Mettre é jour les numéros d'ordre affichés
            $('#sortable-categories .category-item').each(function(index) {
                $(this).find('small:contains("Ordre:")').html('<i class="fas fa-sort-numeric-up me-1"></i>Ordre: ' + (index + 1));
            });
        } else {
            showToast('Erreur lors de la mise à jour de l\'ordre', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Erreur lors de la mise à jour de l\'ordre', 'error');
    });
}

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
            // Update UI
            const categoryItem = document.querySelector(`[data-id="${categoryId}"]`);
            const badge = categoryItem.querySelector('.badge');
            const switchInput = categoryItem.querySelector('.form-check-input');

            if (data.is_active) {
                badge.className = 'badge bg-success';
                badge.textContent = 'Active';
                switchInput.checked = true;

                // Remove inactive badge if present
                const inactiveBadge = categoryItem.querySelector('.badge.bg-secondary');
                if (inactiveBadge && inactiveBadge.textContent === 'Inactive') {
                    inactiveBadge.remove();
                }
            } else {
                badge.className = 'badge bg-secondary';
                badge.textContent = 'Inactive';
                switchInput.checked = false;

                // Add inactive badge next to title
                const title = categoryItem.querySelector('h6');
                if (!title.querySelector('.badge.bg-secondary')) {
                    const inactiveBadge = document.createElement('span');
                    inactiveBadge.className = 'badge bg-secondary';
                    inactiveBadge.textContent = 'Inactive';
                    title.appendChild(inactiveBadge);
                }
            }

            showToast(data.message, 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        location.reload(); // Fallback
    });
}

// Toast notification
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
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

// Confirmation de suppression améliorée
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const form = this.closest('form');
        const categoryName = this.closest('.category-item').querySelector('h6').textContent;

        document.getElementById('confirmMessage').textContent =
            `êtes-vous sûr de vouloir supprimer la catégorie "${categoryName}" ? Cette action est irréversible.`;

        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();

        document.getElementById('confirmButton').onclick = function() {
            form.submit();
            modal.hide();
        };
    });
});
</script>
@endsection
