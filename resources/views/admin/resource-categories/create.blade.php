{{-- resources/views/admin/resource-categories/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Nouvelle Catégorie de Ressources')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-plus me-2 text-primary"></i>
        Nouvelle Catégorie de Ressources
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.resource-categories.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('admin.resource-categories.store') }}" method="POST">
            @csrf
            
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
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug (URL)</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" value="{{ old('slug') }}">
                                <div class="form-text">Laissez vide pour générer automatiquement</div>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" 
                                  placeholder="Description de la catégorie">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icône</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i id="icon-preview" class="fas fa-folder"></i>
                                    </span>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" name="icon" value="{{ old('icon', 'fas fa-folder') }}" 
                                           placeholder="fas fa-folder">
                                </div>
                                <div class="form-text">Classe d'icône FontAwesome (ex: fas fa-file-pdf)</div>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="color" class="form-label">Couleur</label>
                                <div class="input-group">
                                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           id="color" name="color" value="{{ old('color', '#6B7280') }}">
                                    <input type="text" class="form-control" id="color-text" 
                                           value="{{ old('color', '#6B7280') }}" readonly>
                                </div>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Ordre d'affichage</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order') }}" 
                                       min="0" placeholder="Laissez vide pour placer à la fin">
                                <div class="form-text">Plus le chiffre est bas, plus la catégorie apparaît en premier</div>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Statut</label>
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" 
                                           id="is_active" name="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        <strong>Catégorie active</strong>
                                    </label>
                                </div>
                                <div class="form-text">Les catégories inactives ne sont pas visibles sur le site</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aperçu -->
            <div class="card mt-4">
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
                                 id="preview-icon-container"
                                 style="width: 50px; height: 50px; background-color: #6B728020; border: 2px solid #6B7280">
                                <i id="preview-icon" class="fas fa-folder" style="color: #6B7280; font-size: 1.2rem;"></i>
                            </div>
                            <div>
                                <h6 class="mb-1" id="preview-name">Nom de la catégorie</h6>
                                <p class="text-muted small mb-0" id="preview-description">Description de la catégorie</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('admin.resource-categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Créer la catégorie
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Sidebar avec aide -->
    <div class="col-lg-4">
        <!-- Icônes populaires -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-icons me-2"></i>
                    Icônes populaires
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-file-pdf" title="PDF">
                            <i class="fas fa-file-pdf text-danger"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-file-word" title="Word">
                            <i class="fas fa-file-word text-primary"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-file-excel" title="Excel">
                            <i class="fas fa-file-excel text-success"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-chart-line" title="Rapports">
                            <i class="fas fa-chart-line text-info"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-book" title="Guides">
                            <i class="fas fa-book text-warning"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-tools" title="Outils">
                            <i class="fas fa-tools text-secondary"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-graduation-cap" title="Formation">
                            <i class="fas fa-graduation-cap text-purple"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-newspaper" title="Publications">
                            <i class="fas fa-newspaper text-dark"></i>
                        </button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-secondary btn-sm w-100 icon-btn" 
                                data-icon="fas fa-gavel" title="Politiques">
                            <i class="fas fa-gavel text-danger"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Couleurs populaires -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-palette me-2"></i>
                    Couleurs populaires
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#3B82F6" style="background-color: #3B82F6; color: white;" title="Bleu">
                            Bleu
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#10B981" style="background-color: #10B981; color: white;" title="Vert">
                            Vert
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#F59E0B" style="background-color: #F59E0B; color: white;" title="Orange">
                            Orange
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#EF4444" style="background-color: #EF4444; color: white;" title="Rouge">
                            Rouge
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#8B5CF6" style="background-color: #8B5CF6; color: white;" title="Violet">
                            Violet
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#06B6D4" style="background-color: #06B6D4; color: white;" title="Cyan">
                            Cyan
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#84CC16" style="background-color: #84CC16; color: white;" title="Lime">
                            Lime
                        </button>
                    </div>
                    <div class="col-3">
                        <button type="button" class="btn btn-sm w-100 color-btn" 
                                data-color="#6B7280" style="background-color: #6B7280; color: white;" title="Gris">
                            Gris
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conseils -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-lightbulb me-2"></i>
                    Conseils
                </h5>
            </div>
            <div class="card-body">
                <ul class="list-unstyled small">
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-1"></i>
                        Utilisez des noms courts et descriptifs
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-1"></i>
                        Choisissez des icônes représentatives du contenu
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-1"></i>
                        Les couleurs aident à différencier visuellement
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-check text-success me-1"></i>
                        L'ordre d'affichage peut être modifié plus tard
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.category-preview {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.icon-container {
    transition: all 0.3s ease;
}

.icon-btn, .color-btn {
    transition: all 0.2s ease;
}

.icon-btn:hover {
    transform: scale(1.1);
}

.color-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.text-purple {
    color: #8B5CF6 !important;
}

.form-control-color {
    width: 50px;
    height: 38px;
    padding: 0.375rem;
}
</style>

<script>
// Auto-génération du slug depuis le nom
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
    
    // Mettre à jour l'aperçu
    updatePreview();
});

document.getElementById('description').addEventListener('input', updatePreview);
document.getElementById('icon').addEventListener('input', updatePreview);
document.getElementById('color').addEventListener('input', updatePreview);

// Synchronisation du color picker avec le champ text
document.getElementById('color').addEventListener('input', function() {
    document.getElementById('color-text').value = this.value;
    updatePreview();
});

// Mise à jour de l'aperçu de l'icône
document.getElementById('icon').addEventListener('input', function() {
    const iconClass = this.value || 'fas fa-folder';
    document.getElementById('icon-preview').className = iconClass;
    updatePreview();
});

// Boutons d'icônes prédéfinies
document.querySelectorAll('.icon-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const icon = this.dataset.icon;
        document.getElementById('icon').value = icon;
        document.getElementById('icon-preview').className = icon;
        updatePreview();
        
        // Highlight temporairement le bouton sélectionné
        this.classList.add('btn-primary');
        this.classList.remove('btn-outline-secondary');
        setTimeout(() => {
            this.classList.remove('btn-primary');
            this.classList.add('btn-outline-secondary');
        }, 300);
    });
});

// Boutons de couleurs prédéfinies
document.querySelectorAll('.color-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const color = this.dataset.color;
        document.getElementById('color').value = color;
        document.getElementById('color-text').value = color;
        updatePreview();
        
        // Effet visuel
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = 'translateY(-2px)';
        }, 150);
    });
});

// Fonction de mise à jour de l'aperçu
function updatePreview() {
    const name = document.getElementById('name').value || 'Nom de la catégorie';
    const description = document.getElementById('description').value || 'Description de la catégorie';
    const icon = document.getElementById('icon').value || 'fas fa-folder';
    const color = document.getElementById('color').value || '#6B7280';
    
    // Mettre à jour l'aperçu
    document.getElementById('preview-name').textContent = name;
    document.getElementById('preview-description').textContent = description;
    document.getElementById('preview-icon').className = icon;
    document.getElementById('preview-icon').style.color = color;
    
    const container = document.getElementById('preview-icon-container');
    container.style.backgroundColor = color + '20'; // 20 = opacity
    container.style.borderColor = color;
}

// Validation du formulaire
document.querySelector('form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    
    if (!name) {
        e.preventDefault();
        alert('Le nom de la catégorie est obligatoire.');
        document.getElementById('name').focus();
        return false;
    }
    
    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Création en cours...';
    submitBtn.disabled = true;
    
    // Prevent double submission
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});

// Initialiser l'aperçu
updatePreview();
</script>
@endsection