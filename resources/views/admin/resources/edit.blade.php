{{-- resources/views/admin/resources/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Modifier la Ressource')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-edit me-2 text-primary"></i>
        Modifier la Ressource
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ $resource->url }}" target="_blank" class="btn btn-outline-info">
                <i class="fas fa-eye me-2"></i>Voir sur le site
            </a>
            <a href="{{ route('admin.resources.show', $resource) }}" class="btn btn-outline-primary">
                <i class="fas fa-info-circle me-2"></i>Détails
            </a>
        </div>
        <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste
        </a>
    </div>
</div>

{{-- FORMULAIRE PRINCIPAL D'ÉDITION --}}
<form id="update-form" action="{{ route('admin.resources.update', $resource) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            {{-- Tout le contenu de votre formulaire principal reste identique --}}
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
                               id="title" name="title" value="{{ old('title', $resource->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug" value="{{ old('slug', $resource->slug) }}">
                        <div class="form-text">URL actuelle: {{ url('/resources/' . $resource->slug) }}</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description courte</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="3"
                                  placeholder="Résumé de la ressource qui apparaîtra dans les listes">{{ old('description', $resource->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu détaillé</label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="8"
                                  placeholder="Description détaillée de la ressource, son utilisation, etc.">{{ old('content', $resource->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags / Mots-clés</label>
                        <input type="text" class="form-control @error('tags') is-invalid @enderror"
                               id="tags" name="tags" value="{{ old('tags', $resource->tags) }}"
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
                    <!-- Fichier actuel -->
                    @if($resource->file_path && $resource->fileExists())
                        <div class="alert alert-info">
                            <h6><i class="fas fa-file me-2"></i>Fichier actuel:</h6>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <strong>{{ $resource->original_filename }}</strong><br>
                                    <small class="text-muted">
                                        {{ $resource->formatted_file_size }} • {{ $resource->file_extension }}
                                    </small>
                                </div>
                                <div>
                                    <a href="{{ $resource->download_url }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download me-1"></i>Télécharger
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Aucun fichier disponible ou fichier manquant
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="file" class="form-label">Remplacer le fichier</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror"
                               id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                        <div class="form-text">
                            Formats acceptés: PDF, Word, Excel, PowerPoint, TXT, ZIP, RAR (Max: 50 MB)
                        </div>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Thumbnail actuel -->
                    @if($resource->thumbnail)
                        <div class="alert alert-success">
                            <h6><i class="fas fa-image me-2"></i>Image de prévisualisation actuelle:</h6>
                            <img src="{{ $resource->thumbnail_url }}" alt="{{ $resource->title }}"
                                 class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">
                            {{ $resource->thumbnail ? 'Remplacer l\'image' : 'Ajouter une image' }} de prévisualisation
                        </label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                               id="thumbnail" name="thumbnail" accept="image/*">
                        <div class="form-text">
                            Image qui s'affichera à la place de l'icône par défaut (JPG, PNG, Max: 5 MB)
                        </div>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prévisualisation des nouveaux fichiers -->
                    <div id="file-preview" class="mt-3" style="display: none;">
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-info-circle me-2"></i>Nouveau fichier sélectionné:</h6>
                            <div id="file-info"></div>
                        </div>
                    </div>

                    <div id="thumbnail-preview" class="mt-3" style="display: none;">
                        <div class="alert alert-warning">
                            <h6><i class="fas fa-image me-2"></i>Nouvelle image sélectionnée:</h6>
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
                               id="meta_title" name="meta_title" value="{{ old('meta_title', $resource->meta_title) }}" maxlength="255">
                        <div class="form-text">Titre optimisé pour les moteurs de recherche (max 60 caractères recommandés)</div>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Description SEO</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                  id="meta_description" name="meta_description" rows="3" maxlength="500"
                                  placeholder="Description qui apparaîtra dans les résultats de recherche">{{ old('meta_description', $resource->meta_description) }}</textarea>
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
                                <option value="{{ $category->id }}"
                                        {{ old('category_id', $resource->category_id) == $category->id ? 'selected' : '' }}>
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
                                   id="is_published" name="is_published"
                                   {{ old('is_published', $resource->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">
                                <strong>Publié</strong>
                            </label>
                        </div>
                        <small class="text-muted">La ressource est visible sur le site public</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox"
                                   id="is_featured" name="is_featured"
                                   {{ old('is_featured', $resource->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                <strong>Mettre en avant</strong>
                            </label>
                        </div>
                        <small class="text-muted">La ressource apparaît dans les ressources mises en avant</small>
                    </div>

                    <hr>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Mettre à jour
                        </button>
                        <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Annuler
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        Statistiques
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <div class="fs-4 fw-bold text-primary"><small>{{ $resource->download_count }}</small></div>
                                <small class="text-muted">Téléchargements</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="fs-4 fw-bold text-success"><small>{{ $resource->created_at->diffForHumans() }}</small></div>
                            <small class="text-muted">Créée</small>
                        </div>
                    </div>
                    <hr>
                    <div class="small text-muted">
                        <div><strong>Créée:</strong> {{ $resource->created_at->format('d/m/Y H:i') }}</div>
                        <div><strong>Modifiée:</strong> {{ $resource->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>

            <!-- Actions danger - SANS FORMULAIRE IMBRIQUÉ -->
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Zone de danger
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">
                        Ces actions sont irréversibles. Procédez avec prudence.
                    </p>
                    {{-- Utiliser un bouton au lieu d'un formulaire imbriqué --}}
                    <button type="button"
                            class="btn btn-danger btn-sm w-100"
                            onclick="confirmDelete()">
                        <i class="fas fa-trash me-2"></i>Supprimer la ressource
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- FIN DU FORMULAIRE PRINCIPAL --}}

{{-- FORMULAIRE DE SUPPRESSION SÉPARÉ --}}
<form id="delete-form" method="POST" action="{{ route('admin.resources.destroy', $resource) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
// Fonction de confirmation de suppression
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette ressource ? Cette action est irréversible.')) {
        document.getElementById('delete-form').submit();
    }
}

// Auto-génération du slug depuis le titre (mais garder le slug existant si modifié manuellement)
let slugModified = false;
document.getElementById('slug').addEventListener('input', function() {
    slugModified = true;
});

document.getElementById('title').addEventListener('input', function() {
    if (!slugModified) {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    }
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

// Validation côté client pour le formulaire d'édition uniquement
document.getElementById('update-form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('file');
    const file = fileInput.files[0];

    // Vérifier la taille du fichier (50MB max) seulement si un nouveau fichier est sélectionné
    if (file && file.size > 50 * 1024 * 1024) {
        e.preventDefault();
        alert('Le fichier est trop volumineux. Taille maximum: 50 MB');
        return false;
    }

    // Vérifier les types de fichiers autorisés seulement si un nouveau fichier est sélectionné
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

    // Vérifier le thumbnail (5MB max) seulement si une nouvelle image est sélectionnée
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnail = thumbnailInput.files[0];

    if (thumbnail && thumbnail.size > 5 * 1024 * 1024) {
        e.preventDefault();
        alert('L\'image de prévisualisation est trop volumineuse. Taille maximum: 5 MB');
        return false;
    }

    // Vérifier les types d'images seulement si une nouvelle image est sélectionnée
    if (thumbnail && !thumbnail.type.startsWith('image/')) {
        e.preventDefault();
        alert('Le fichier sélectionné pour l\'image de prévisualisation n\'est pas une image valide.');
        return false;
    }

    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mise à jour en cours...';
    submitBtn.disabled = true;

    // Restore state after timeout (safety net)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 30000); // 30 secondes
});

// Compteur de caractères pour les champs SEO
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
