{{-- resources/views/admin/categories/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Modifier la catégorie')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-edit me-2 text-primary"></i>Modifier la catégorie
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="#" class="btn btn-outline-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#viewModal">
            <i class="fas fa-eye me-1"></i>Voir
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-list me-1"></i>Liste
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Modification de "{{ $category->name }}"
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}" id="categoryForm">
                    @csrf
                    @method('PUT')

                    <!-- Nom -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="fas fa-tag me-2 text-primary"></i>Nom de la catégorie
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $category->name) }}"
                               placeholder="Ex: Agriculture durable"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Slug actuel: <code>{{ $category->slug }}</code>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">
                            <i class="fas fa-align-left me-2 text-primary"></i>Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Décrivez brièvement cette catégorie...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <span id="charCount">{{ strlen($category->description ?? '') }}</span>/500 caractères
                        </div>
                    </div>

                    <!-- Couleur -->
                    <div class="mb-4">
                        <label for="color" class="form-label fw-bold">
                            <i class="fas fa-palette me-2 text-primary"></i>Couleur
                        </label>
                        <div class="color-selector">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="color"
                                           class="form-control form-control-color @error('color') is-invalid @enderror"
                                           id="color"
                                           name="color"
                                           value="{{ old('color', $category->color) }}"
                                           required>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="color-preview" id="colorPreview">
                                        <div class="preview-text">Aperçu</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Couleurs prédéfinies -->
                            <div class="predefined-colors mt-3">
                                <label class="form-label small">Couleurs suggérées :</label>
                                <div class="color-palette">
                                    <div class="color-option" data-color="#059669" title="Vert primaire"></div>
                                    <div class="color-option" data-color="#10B981" title="Vert accent"></div>
                                    <div class="color-option" data-color="#F59E0B" title="Orange"></div>
                                    <div class="color-option" data-color="#EF4444" title="Rouge"></div>
                                    <div class="color-option" data-color="#3B82F6" title="Bleu"></div>
                                    <div class="color-option" data-color="#8B5CF6" title="Violet"></div>
                                    <div class="color-option" data-color="#EC4899" title="Rose"></div>
                                    <div class="color-option" data-color="#6B7280" title="Gris"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sélecteur d'icône -->
                    <div class="mb-4">
                        <label for="icon" class="form-label fw-bold">
                            <i class="fas fa-icons me-2 text-primary"></i>Icône
                        </label>
                        <div class="icon-selector">
                            <!-- Champ caché pour l'icône sélectionnée -->
                            <input type="hidden" id="icon" name="icon" value="{{ old('icon', $category->icon) }}" required>

                            <!-- Aperçu de l'icône sélectionnée -->
                            <div class="selected-icon-preview mb-3">
                                <div class="preview-container">
                                    <i id="selectedIcon" class="{{ $category->icon }}"></i>
                                    <span id="selectedIconText">{{ $category->icon }}</span>
                                    <button type="button" class="btn btn-outline-primary btn-sm ms-3" id="changeIconBtn">
                                        Changer l'icône
                                    </button>
                                </div>
                            </div>

                            <!-- Recherche d'icônes -->
                            <div class="icon-search-container" style="display: none;">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text"
                                           class="form-control"
                                           id="iconSearch"
                                           placeholder="Rechercher une icône...">
                                </div>

                                <!-- Catégories d'icônes -->
                                <div class="icon-categories mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter active" data-category="all">
                                        Toutes
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="business">
                                        Business
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="nature">
                                        Nature
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="social">
                                        Social
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm category-filter" data-category="tech">
                                        Tech
                                    </button>
                                </div>

                                <!-- Grille d'icônes -->
                                <div class="icons-grid" id="iconsGrid">
                                    <!-- Les icônes seront générées par JavaScript -->
                                </div>
                            </div>
                        </div>
                        @error('icon')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">
                                <i class="fas fa-toggle-on me-2 text-success"></i>Catégorie active
                            </label>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Une catégorie inactive ne sera pas visible sur le site
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Annuler
                        </a>
                        <div>
                            <button type="submit" class="btn btn-warning btn-lg me-2">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-2"></i>Supprimer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Aperçu et informations -->
    <div class="col-lg-4">
        <!-- Aperçu en temps réel -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="fas fa-eye me-2"></i>Aperçu des modifications
                </h5>
            </div>
            <div class="card-body">
                <div class="category-preview" id="categoryPreview">
                    <div class="preview-item">
                        <div class="preview-icon">
                            <i id="previewIcon" class="{{ $category->icon }}"></i>
                        </div>
                        <div class="preview-content">
                            <h6 id="previewName">{{ $category->name }}</h6>
                            <p id="previewDescription" class="text-muted small">{{ $category->description ?? 'Aucune description' }}</p>
                        </div>
                    </div>
                </div>

                <div class="preview-info mt-3">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Cet aperçu montre les modifications en temps réel
                    </small>
                </div>
            </div>
        </div>

        <!-- Informations sur la catégorie -->
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informations
                </h5>
            </div>
            <div class="card-body">
                <div class="info-item mb-3">
                    <label class="fw-bold text-muted">ID :</label>
                    <span>{{ $category->id }}</span>
                </div>
                <div class="info-item mb-3">
                    <label class="fw-bold text-muted">Slug :</label>
                    <span class="font-monospace">{{ $category->slug }}</span>
                </div>
                <div class="info-item mb-3">
                    <label class="fw-bold text-muted">Créée le :</label>
                    <span>{{ $category->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-item mb-3">
                    <label class="fw-bold text-muted">Modifiée le :</label>
                    <span>{{ $category->updated_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-item mb-3">
                    <label class="fw-bold text-muted">Projets liés :</label>
                    <span class="badge bg-primary">{{ $category->projects_count ?? 0 }}</span>
                </div>
                <div class="info-item">
                    <label class="fw-bold text-muted">Statut :</label>
                    @if($category->is_active)
                        <span class="badge bg-success">
                            <i class="fas fa-check me-1"></i>Active
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            <i class="fas fa-times me-1"></i>Inactive
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmer la suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-warning me-2"></i>
                    <strong>Attention !</strong> Cette action est irréversible.
                </div>
                <p>Êtes-vous sûr de vouloir supprimer la catégorie <strong>"{{ $category->name }}"</strong> ?</p>
                @if($category->projects_count ?? 0 > 0)
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Cette catégorie est utilisée par <strong>{{ $category->projects_count }}</strong> projet(s).
                        La suppression affectera ces projets.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Annuler
                </button>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de visualisation de la catégorie -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="viewModalLabel">
                    <i class="fas fa-eye me-2"></i>Détails de la catégorie
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Aperçu visuel -->
                    <div class="col-md-4 text-center mb-4">
                        <div class="category-display">
                            <div class="category-icon-large" style="background-color: {{ $category->color }}">
                                <i class="{{ $category->icon }}"></i>
                            </div>
                            <h4 class="mt-3 mb-2">{{ $category->name }}</h4>
                            <div class="color-badge">
                                <span class="badge" style="background-color: {{ $category->color }}">
                                    {{ $category->color }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Informations détaillées -->
                    <div class="col-md-8">
                        <div class="info-table">
                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-hashtag me-2 text-muted"></i>ID :
                                </label>
                                <span class="info-value">{{ $category->id }}</span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-tag me-2 text-muted"></i>Nom :
                                </label>
                                <span class="info-value">{{ $category->name }}</span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-link me-2 text-muted"></i>Slug :
                                </label>
                                <span class="info-value font-monospace">{{ $category->slug }}</span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-align-left me-2 text-muted"></i>Description :
                                </label>
                                <span class="info-value">
                                    {{ $category->description ?: 'Aucune description' }}
                                </span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-palette me-2 text-muted"></i>Couleur :
                                </label>
                                <span class="info-value">
                                    <span class="color-preview-small" style="background-color: {{ $category->color }}"></span>
                                    {{ $category->color }}
                                </span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-icons me-2 text-muted"></i>Icône :
                                </label>
                                <span class="info-value">
                                    <i class="{{ $category->icon }} me-2" style="color: {{ $category->color }}"></i>
                                    {{ $category->icon }}
                                </span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-toggle-on me-2 text-muted"></i>Statut :
                                </label>
                                <span class="info-value">
                                    @if($category->is_active)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-times me-1"></i>Inactive
                                        </span>
                                    @endif
                                </span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-folder-open me-2 text-muted"></i>Projets :
                                </label>
                                <span class="info-value">
                                    <span class="badge bg-primary">{{ $category->projects_count ?? 0 }}</span>
                                    projet(s) lié(s)
                                </span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-calendar-plus me-2 text-muted"></i>Créée le :
                                </label>
                                <span class="info-value">{{ $category->created_at->format('d/m/Y à H:i') }}</span>
                            </div>

                            <div class="info-row">
                                <label class="info-label">
                                    <i class="fas fa-calendar-edit me-2 text-muted"></i>Modifiée le :
                                </label>
                                <span class="info-value">{{ $category->updated_at->format('d/m/Y à H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Fermer
                </button>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Modifier
                </a>
                @if($category->projects_count > 0)
                <a href="{{ route('admin.projects.index', ['category' => $category->slug]) }}" class="btn btn-outline-primary">
                    <i class="fas fa-folder-open me-2"></i>Voir les projets
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Forcer le z-index des modals */
.modal {
    z-index: 1055 !important;
}

.modal-backdrop {
    z-index: 1050 !important;
}

/* Réutiliser les mêmes styles que la page de création */
.color-selector .color-preview {
    height: 38px;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    background: {{ $category->color }};
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
}

.color-palette {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.color-option {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #dee2e6;
    transition: all 0.3s ease;
    position: relative;
}

.color-option:hover {
    transform: scale(1.1);
    border-color: #495057;
}

.color-option.selected {
    border-color: #0d6efd;
    box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
}

.selected-icon-preview {
    padding: 1rem;
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    background: #f8f9fa;
}

.preview-container {
    display: flex;
    align-items: center;
}

.preview-container i {
    font-size: 2rem;
    margin-right: 1rem;
    color: {{ $category->color }};
}

.icon-search-container {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
    background: #f8f9fa;
}

.icon-categories {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.category-filter.active {
    background-color: var(--bs-primary);
    color: white;
    border-color: var(--bs-primary);
}

.icons-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
    gap: 0.5rem;
    max-height: 300px;
    overflow-y: auto;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    padding: 1rem;
    background: white;
}

.icon-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: all 0.3s ease;
    background: white;
}

.icon-item:hover {
    border-color: var(--bs-primary);
    background: rgba(13, 110, 253, 0.1);
    transform: translateY(-2px);
}

.icon-item.selected {
    border-color: var(--bs-primary);
    background: var(--bs-primary);
    color: white;
}

.icon-item i {
    font-size: 1.5rem;
    margin-bottom: 0.25rem;
}

.icon-item span {
    font-size: 0.7rem;
    text-align: center;
    word-break: break-all;
}

.category-preview {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    padding: 1rem;
    background: white;
}

.preview-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.preview-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: {{ $category->color }};
    color: white;
    flex-shrink: 0;
}

.preview-icon i {
    font-size: 1.5rem;
}

.preview-content {
    flex: 1;
}

.preview-content h6 {
    margin: 0 0 0.25rem 0;
    color: #495057;
}

.preview-content p {
    margin: 0;
    font-size: 0.85rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.info-item label {
    margin-bottom: 0;
    font-size: 0.9rem;
}

/* Styles pour le modal de visualisation */
.category-display {
    padding: 2rem 1rem;
}

.category-icon-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.category-icon-large i {
    font-size: 2.5rem;
    color: white;
}

.color-badge {
    margin-top: 1rem;
}

.info-table {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.info-row {
    display: flex;
    align-items: flex-start;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #dee2e6;
}

.info-label {
    font-weight: 600;
    color: #495057;
    min-width: 120px;
    margin: 0;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.info-value {
    flex: 1;
    color: #212529;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    word-break: break-word;
}

.color-preview-small {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    display: inline-block;
    border: 1px solid #dee2e6;
    vertical-align: middle;
}

/* Responsive pour le modal */
@media (max-width: 768px) {
    .modal-dialog {
        margin: 1rem;
    }

    .info-row {
        flex-direction: column;
        gap: 0.5rem;
    }

    .info-label {
        min-width: auto;
        font-weight: 700;
    }

    .category-icon-large {
        width: 80px;
        height: 80px;
    }

    .category-icon-large i {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .icons-grid {
        grid-template-columns: repeat(auto-fill, minmax(50px, 1fr));
    }

    .color-palette {
        justify-content: center;
    }

    .icon-categories {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debug Bootstrap et modal
    console.log('Bootstrap disponible:', typeof bootstrap !== 'undefined');

    // Test modal
    const modal = document.getElementById('viewModal');
    if (modal) {
        modal.addEventListener('show.bs.modal', function () {
            console.log('Modal en cours d\'ouverture...');
        });

        modal.addEventListener('shown.bs.modal', function () {
            console.log('Modal affiché avec succès');
        });

        modal.addEventListener('hidden.bs.modal', function () {
            console.log('Modal fermé');
        });
    }

    // Réutiliser le même JavaScript que la page de création avec les valeurs pré-remplies
    const iconsByCategory = {
        business: [
            'fas fa-briefcase', 'fas fa-chart-line', 'fas fa-handshake', 'fas fa-building',
            'fas fa-coins', 'fas fa-calculator', 'fas fa-clipboard-list', 'fas fa-cogs',
            'fas fa-bullseye', 'fas fa-trophy', 'fas fa-rocket', 'fas fa-lightbulb'
        ],
        nature: [
            'fas fa-leaf', 'fas fa-tree', 'fas fa-seedling', 'fas fa-mountain',
            'fas fa-water', 'fas fa-sun', 'fas fa-cloud', 'fas fa-globe-americas',
            'fas fa-recycle', 'fas fa-paw', 'fas fa-fish', 'fas fa-dove'
        ],
        social: [
            'fas fa-users', 'fas fa-user-friends', 'fas fa-hands-helping', 'fas fa-heart',
            'fas fa-home', 'fas fa-graduation-cap', 'fas fa-medical-kit', 'fas fa-balance-scale',
            'fas fa-gavel', 'fas fa-shield-alt', 'fas fa-church', 'fas fa-pray'
        ],
        tech: [
            'fas fa-laptop', 'fas fa-mobile-alt', 'fas fa-wifi', 'fas fa-database',
            'fas fa-cloud', 'fas fa-server', 'fas fa-code', 'fas fa-bug',
            'fas fa-robot', 'fas fa-microchip', 'fas fa-plug', 'fas fa-satellite'
        ]
    };

    const allIcons = Object.values(iconsByCategory).flat();

    // Éléments DOM
    const iconInput = document.getElementById('icon');
    const selectedIcon = document.getElementById('selectedIcon');
    const selectedIconText = document.getElementById('selectedIconText');
    const changeIconBtn = document.getElementById('changeIconBtn');
    const iconSearchContainer = document.querySelector('.icon-search-container');
    const iconSearch = document.getElementById('iconSearch');
    const iconsGrid = document.getElementById('iconsGrid');
    const categoryFilters = document.querySelectorAll('.category-filter');

    // Éléments pour l'aperçu
    const nameInput = document.getElementById('name');
    const descriptionInput = document.getElementById('description');
    const colorInput = document.getElementById('color');
    const previewIcon = document.getElementById('previewIcon');
    const previewName = document.getElementById('previewName');
    const previewDescription = document.getElementById('previewDescription');
    const colorPreview = document.getElementById('colorPreview');
    const charCount = document.getElementById('charCount');

    let currentCategory = 'all';

    function renderIcons(icons) {
        iconsGrid.innerHTML = '';
        icons.forEach(iconClass => {
            const iconItem = document.createElement('div');
            iconItem.className = 'icon-item';
            iconItem.dataset.icon = iconClass;

            const iconName = iconClass.split(' ').pop().replace('fa-', '');

            iconItem.innerHTML = `
                <i class="${iconClass}"></i>
                <span>${iconName}</span>
            `;

            iconItem.addEventListener('click', function() {
                selectIcon(iconClass);
            });

            iconsGrid.appendChild(iconItem);
        });

        // Marquer l'icône actuelle comme sélectionnée
        const currentIconElement = document.querySelector(`[data-icon="${iconInput.value}"]`);
        if (currentIconElement) {
            currentIconElement.classList.add('selected');
        }
    }

    function selectIcon(iconClass) {
        iconInput.value = iconClass;
        selectedIcon.className = iconClass;
        selectedIconText.textContent = iconClass;
        previewIcon.className = iconClass;

        // Mettre à jour la couleur de l'icône dans l'aperçu
        selectedIcon.style.color = colorInput.value;

        // Mettre à jour la sélection visuelle
        document.querySelectorAll('.icon-item').forEach(item => {
            item.classList.remove('selected');
        });
        document.querySelector(`[data-icon="${iconClass}"]`).classList.add('selected');

        // Masquer le sélecteur
        iconSearchContainer.style.display = 'none';
    }

    function filterIcons() {
        const searchTerm = iconSearch.value.toLowerCase();
        let iconsToShow = currentCategory === 'all' ? allIcons : iconsByCategory[currentCategory];

        if (searchTerm) {
            iconsToShow = iconsToShow.filter(icon =>
                icon.toLowerCase().includes(searchTerm)
            );
        }

        renderIcons(iconsToShow);
    }

    // Event listeners
    changeIconBtn.addEventListener('click', function() {
        iconSearchContainer.style.display = iconSearchContainer.style.display === 'none' ? 'block' : 'none';
        if (iconSearchContainer.style.display === 'block') {
            renderIcons(currentCategory === 'all' ? allIcons : iconsByCategory[currentCategory]);
        }
    });

    iconSearch.addEventListener('input', filterIcons);

    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            categoryFilters.forEach(f => f.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            filterIcons();
        });
    });

    // Sélecteur de couleur
    const colorOptions = document.querySelectorAll('.color-option');
    colorOptions.forEach(option => {
        const color = option.dataset.color;
        option.style.backgroundColor = color;

        // Marquer la couleur actuelle comme sélectionnée
        if (color === colorInput.value) {
            option.classList.add('selected');
        }

        option.addEventListener('click', function() {
            colorInput.value = color;
            updateColorPreview();
            colorOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    function updateColorPreview() {
        const color = colorInput.value;
        colorPreview.style.backgroundColor = color;
        document.querySelector('.preview-icon').style.backgroundColor = color;
        selectedIcon.style.color = color;
    }

    // Mise à jour de l'aperçu en temps réel
    nameInput.addEventListener('input', function() {
        previewName.textContent = this.value || '{{ $category->name }}';
    });

    descriptionInput.addEventListener('input', function() {
        const text = this.value || 'Aucune description';
        previewDescription.textContent = text;
        charCount.textContent = this.value.length;

        if (this.value.length > 500) {
            charCount.style.color = '#dc3545';
        } else {
            charCount.style.color = '#6c757d';
        }
    });

    colorInput.addEventListener('change', updateColorPreview);

    // Initialisation
    renderIcons(allIcons);
    updateColorPreview();

    // Marquer l'icône actuelle comme sélectionnée au démarrage
    selectedIcon.style.color = colorInput.value;
});
</script>
@endsection
