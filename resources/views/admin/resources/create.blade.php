{{-- resources/views/admin/resources/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Nouvelle Ressource')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-plus me-2 text-primary"></i>
        Nouvelle Ressource
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
        </a>
    </div>
</div>

<form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Informations principales -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informations principales
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug" value="{{ old('slug') }}">
                        <div class="form-text">Laissez vide pour générer automatiquement depuis le titre</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description courte</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3"
                                  placeholder="Résumé de la ressource qui apparaîtra dans les listes">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu détaillé</label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="8"
                                  placeholder="Description détaillée de la ressource, son utilisation, etc.">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags / Mots-clés</label>
                        <input type="text" class="form-control @error('tags') is-invalid @enderror"
                               id="tags" name="tags" value="{{ old('tags') }}"
                               placeholder="Séparez les tags par des virgules">
                        <div class="form-text">Ex: développement, guide, formation, communauté</div>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Fichiers -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-file me-2"></i>
                        Fichiers
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Fichier principal <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                               id="file" name="file" required accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                        <div class="form-text">
                            Formats acceptés: PDF, Word, Excel, PowerPoint, TXT, ZIP, RAR (Max: 50 MB)
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Image de prévisualisation</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                               id="thumbnail" name="thumbnail" accept="image/*">
                        <div class="form-text">
                            Image optionnelle qui s'affichera à la place de l'icône par défaut (JPG, PNG, Max: 5 MB)
                        </div>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prçvisualisation des fichiers -->
                    <div id="file-preview" class="mt-3" style="display: none;">
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Aperçu du fichier sélectionné:</h6>
                            <div id="file-info"></div>
                        </div>
                    </div>

                    <div id="thumbnail-preview" class="mt-3" style="display: none;">
                        <div class="alert alert-success">
                            <h6><i class="fas fa-image me-2"></i>Aperçu de l'image:</h6>
                            <img id="thumbnail-img" src="" alt="Aperçu" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-search me-2"></i>
                        SEO et métadonnées
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Titre SEO</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                               id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="255">
                        <div class="form-text">Titre optimisé pour les moteurs de recherche (max 60 caractères recommandés)</div>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Description SEO</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                  id="meta_description" name="meta_description" rows="3" maxlength="500"
                                  placeholder="Description qui apparaîtra dans les résultats de recherche">{{ old('meta_description') }}</textarea>
                        <div class="form-text">Description pour les moteurs de recherche (max 160 caractères recommandés)</div>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Statut et publication -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Publication
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    @if($category->icon)
                                        {{ $category->icon }}
                                    @endif
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                   id="is_published" name="is_published" {{ old('is_published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                <strong>Publier immédiatement</strong>
                            </label>
                        </div>
                        <small class="text-muted">La ressource sera visible sur le site public</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                   id="is_featured" name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                <strong>Mettre en avant</strong>
                            </label>
                        </div>
                        <small class="text-muted">La ressource apparaîtra dans les ressources mises en avant</small>
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Créer la ressource
                        </button>
                        <button type="submit" name="save_and_continue" value="1" class="btn btn-outline-primary">
                            <i class="fas fa-save me-2"></i>Créer et continuer l'édition
                        </button>
                        <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                    </div>
                </div>
            </div>

            <!-- Aide -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Aide
                    </h5>
                </div>
                <div class="card-body">
                    <h6>Formats de fichiers supportés:</h6>
                    <ul class="list-unstyled small">
                        <li><i class="fas fa-file-pdf text-danger me-1"></i> PDF</li>
                        <li><i class="fas fa-file-word text-primary me-1"></i> Word (.doc, .docx)</li>
                        <li><i class="fas fa-file-excel text-success me-1"></i> Excel (.xls, .xlsx)</li>
                        <li><i class="fas fa-file-powerpoint text-warning me-1"></i> PowerPoint (.ppt, .pptx)</li>
                        <li><i class="fas fa-file-alt text-muted me-1"></i> Texte (.txt)</li>
                        <li><i class="fas fa-file-archive text-secondary me-1"></i> Archives (.zip, .rar)</li>
                    </ul>

                    <hr>

                    <h6>Conseils:</h6>
                    <ul class="small text-muted">
                        <li>Utilisez des titres descriptifs et clairs</li>
                        <li>Ajoutez des tags pour faciliter la recherche</li>
                        <li>Une image de prévisualisation améliore l'attrait visuel</li>
                        <li>La description courte apparaît dans les listes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.card-header h5 {
    color: #374151;
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.alert img {
    border: 2px solid #dee2e6;
}

#file-info {
    font-family: monospace;
    font-size: 0.9rem;
}

.form-text {
    color: #6b7280;
}

.text-danger {
    color: #dc3545 !important;
}
</style>

<script>
// Auto-génération du slug depuis le titre
document.getElementById('title').addEventListener('input', function() {
    const title = this.value;
    const slug = title.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('slug').value = slug;
});

// Prévisualisation du fichier principal
document.getElementById('file').addEventListener('change', function() {
    const file = this.files[0];
    const preview = document.getElementById('file-preview');
    const fileInfo = document.getElementById('file-info');

    if (file) {
        const size = formatFileSize(file.size);
        const type = file.type || 'Type inconnu';
        const name = file.name;

        // Validation en temps réel
        let warningMessage = '';
        if (file.size > 50 * 1024 * 1024) {
            warningMessage = '<div class="text-danger mt-2"><i class="fas fa-exclamation-triangle"></i> Fichier trop volumineux (max: 50 MB)</div>';
        }

        fileInfo.innerHTML = `
            <strong>Nom:</strong> ${name}<br>
            <strong>Taille:</strong> ${size}<br>
            <strong>Type:</strong> ${type}
            ${warningMessage}
        `;
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
});

document.getElementById('thumbnail').addEventListener('change', function() {
    const file = this.files[0];
    const preview = document.getElementById('thumbnail-preview');
    const img = document.getElementById('thumbnail-img');

    if (file) {
        // Validation en temps réel
        if (file.size > 5 * 1024 * 1024) {
            alert('Image trop volumineuse (max: 5 MB)');
            this.value = '';
            preview.style.display = 'none';
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Veuillez sélectionner une image valide');
            this.value = '';
            preview.style.display = 'none';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.onerror = function() {
            alert('Erreur lors de la lecture du fichier');
            preview.style.display = 'none';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});

// Formatage de la taille des fichiers
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Validation cété client
 document.querySelector('form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('file');
    const file = fileInput.files[0];

    // Pour la création, le fichier est obligatoire
    const isCreateForm = !document.querySelector('input[name="_method"][value="PUT"]');

    if (isCreateForm && !file) {
        e.preventDefault();
        alert('Veuillez sélectionner un fichier.');
        return false;
    }

    // Vérifier la taille du fichier (50MB max)
    if (file && file.size > 50 * 1024 * 1024) {
        e.preventDefault();
        alert('Le fichier est trop volumineux. Taille maximum: 50 MB');
        return false;
    }

    // Vérifier les types de fichiers autorisés
    const allowedTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'text/plain',
        'application/zip',
        'application/x-rar-compressed'
    ];

    if (file && !allowedTypes.includes(file.type)) {
        e.preventDefault();
        alert('Type de fichier non autorisé. Formats acceptés: PDF, Word, Excel, PowerPoint, TXT, ZIP, RAR');
        return false;
    }

    // Vérifier le thumbnail (5MB max)
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnail = thumbnailInput.files[0];

    if (thumbnail && thumbnail.size > 5 * 1024 * 1024) {
        e.preventDefault();
        alert('L\'image de prévisualisation est trop volumineuse. Taille maximum: 5 MB');
        return false;
    }

    // Vérifier les types d'images
    if (thumbnail && !thumbnail.type.startsWith('image/')) {
        e.preventDefault();
        alert('Le fichier sélectionné pour l\'image de prévisualisation n\'est pas une image valide.');
        return false;
    }

    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const saveAndContinueBtn = document.querySelector('button[name="save_and_continue"]');
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>' +
        (isCreateForm ? 'Création en cours...' : 'Mise à jour en cours...');
    submitBtn.disabled = true;

    if (saveAndContinueBtn) {
        saveAndContinueBtn.disabled = true;
    }

    // Restore state after timeout (safety net)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        if (saveAndContinueBtn) {
            saveAndContinueBtn.disabled = false;
        }
    }, 30000); // 30 secondes
});

// Compteur de caractéres pour les champs SEO
const metaTitle = document.getElementById('meta_title');
const metaDescription = document.getElementById('meta_description');

if (metaTitle) {
    metaTitle.addEventListener('input', function() {
        const length = this.value.length;
        const helpText = this.nextElementSibling;
        const remaining = 60 - length;

        if (remaining < 0) {
            helpText.className = 'form-text text-danger';
            helpText.textContent = `Titre trop long (${length} caractères, recommandé: 60 max)`;
        } else {
            helpText.className = 'form-text';
            helpText.textContent = `Titre optimisé pour les moteurs de recherche (${remaining} caractères restants recommandés)`;
        }
    });
}

if (metaDescription) {
    metaDescription.addEventListener('input', function() {
        const length = this.value.length;
        const helpText = this.nextElementSibling;
        const remaining = 160 - length;

        if (remaining < 0) {
            helpText.className = 'form-text text-danger';
            helpText.textContent = `Description trop longue (${length} caractères, recommandé: 160 max)`;
        } else {
            helpText.className = 'form-text';
            helpText.textContent = `Description pour les moteurs de recherche (${remaining} caractères restants recommandés)`;
        }
    });
}
</script>
@endsection
