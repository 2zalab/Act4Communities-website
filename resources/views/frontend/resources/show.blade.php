{{-- resources/views/frontend/resources/show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $resource->meta_title ?: $resource->title)
@section('description', $resource->meta_description ?: Str::limit($resource->description, 160))

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container-fluid px-5">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Accueil') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resources.index') }}">{{ __('Ressources') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ $resource->category->url }}">{{ $resource->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $resource->title }}</li>
        </ol>
    </div>
</nav>

<!-- Contenu principal -->
<section class="resource-detail-section py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <!-- Contenu principal -->
            <div class="col-lg-8 mb-5">
                <!-- En-tête de la ressource -->
                <div class="resource-header mb-5">
                    <div class="d-flex flex-wrap align-items-start justify-content-between mb-3">
                        <!-- Catégorie et type -->
                        <div class="resource-badges">
                            <a href="{{ $resource->category->url }}"
                               class="badge category-badge me-2"
                               style="background-color: {{ $resource->category->color }}">
                                @if($resource->category->icon)
                                    <i class="{{ $resource->category->icon }} me-1"></i>
                                @endif
                                {{ $resource->category->name }}
                            </a>
                            <span class="badge file-type-badge">
                                <i class="{{ $resource->file_icon }} me-1"></i>
                                {{ $resource->file_extension }}
                            </span>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="action-buttons">
                            <a href="{{ $resource->download_url }}"
                               class="btn btn-primary btn-lg me-2"
                               onclick="trackDownload('{{ $resource->id }}')">
                                <i class="fas fa-download me-2"></i>{{ __('Télécharger') }}
                            </a>
                            <div class="btn-group">
                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="shareResource()">
                                    <i class="fas fa-share-alt me-1"></i>{{ __('Partager') }}
                                </button>
                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="printResource()">
                                    <i class="fas fa-print me-1"></i>{{ __('Imprimer') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Titre -->
                    <h1 class="resource-title display-5 fw-bold text-dark mb-4">
                        {{ $resource->title }}
                    </h1>

                    <!-- Métadonnées -->
                    <div class="resource-meta d-flex flex-wrap align-items-center gap-4 mb-4">
                        <div class="meta-item">
                            <i class="fas fa-weight-hanging text-muted me-2"></i>
                            <span class="text-muted">{{ $resource->formatted_file_size }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-download text-muted me-2"></i>
                            <span class="text-muted">{{ $resource->download_count }} {{ __('téléchargements') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar text-muted me-2"></i>
                            <span class="text-muted">{{ $resource->created_at->format('d/m/Y') }}</span>
                        </div>
                        @if($resource->fileExists())
                            <div class="meta-item">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-success">{{ __('Fichier disponible') }}</span>
                            </div>
                        @else
                            <div class="meta-item">
                                <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                <span class="text-warning">{{ __('Fichier temporairement indisponible') }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($resource->description)
                        <div class="resource-description">
                            <p class="lead text-muted lh-lg">{{ $resource->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Thumbnail et aperçu -->
                @if($resource->thumbnail)
                    <div class="resource-preview mb-5">
                        <div class="preview-container text-center">
                            <img src="{{ asset('storage/' . $resource->thumbnail) }}"
                                 alt="{{ $resource->title }}"
                                 class="img-fluid rounded shadow-lg">
                            <div class="preview-overlay">
                                <a href="{{ $resource->download_url }}"
                                   class="btn btn-primary btn-lg">
                                    <i class="fas fa-download me-2"></i>{{ __('Télécharger le document') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Contenu détaillé -->
                @if($resource->content)
                    <div class="resource-content">
                        <h3 class="fw-bold mb-4">{{ __('à propos de cette ressource') }}</h3>
                        <div class="content-body">
                            {!! nl2br(e($resource->content)) !!}
                        </div>
                    </div>
                @endif

                <!-- Tags -->
                @if($resource->tags_array)
                    <div class="resource-tags mt-5">
                        <h5 class="fw-bold mb-3">{{ __('Mots-clés') }}</h5>
                        <div class="tags-container">
                            @foreach($resource->tags_array as $tag)
                                <span class="badge bg-light text-dark border me-2 mb-2">
                                    <i class="fas fa-tag me-1"></i>{{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Informations du fichier -->
                <div class="file-info-card mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>{{ __('Informations') }}
                            </h5>

                            <div class="info-item mb-3">
                                <strong>{{ __('Nom du fichier:') }}</strong>
                                <div class="mt-1 text-muted">{{ $resource->original_filename ?: 'Non spécifié' }}</div>
                            </div>

                            <div class="info-item mb-3">
                                <strong>{{ __('Format:') }}</strong>
                                <div class="mt-1">
                                    <span class="badge bg-secondary">{{ $resource->file_extension }}</span>
                                </div>
                            </div>

                            <div class="info-item mb-3">
                                <strong>{{ __('Taille:') }}</strong>
                                <div class="mt-1 text-muted">{{ $resource->formatted_file_size }}</div>
                            </div>

                            <div class="info-item mb-3">
                                <strong>{{ __('Catégorie:') }}</strong>
                                <div class="mt-1">
                                    <a href="{{ $resource->category->url }}"
                                       class="badge category-badge"
                                       style="background-color: {{ $resource->category->color }}">
                                        {{ $resource->category->name }}
                                    </a>
                                </div>
                            </div>

                            <div class="info-item">
                                <strong>{{ __('Téléchargements:') }}</strong>
                                <div class="mt-1 text-muted">{{ $resource->download_count }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="quick-actions-card mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3">
                                <i class="fas fa-bolt text-warning me-2"></i>{{ __('Actions rapides') }}
                            </h5>

                            <div class="d-grid gap-2">
                                <a href="{{ $resource->download_url }}"
                                   class="btn btn-primary"
                                   onclick="trackDownload('{{ $resource->id }}')">
                                    <i class="fas fa-download me-2"></i>{{ __('Télécharger') }}
                                </a>

                                <button type="button"
                                        class="btn btn-outline-primary"
                                        onclick="shareResource()">
                                    <i class="fas fa-share-alt me-2"></i>{{ __('Partager') }}
                                </button>

                                <a href="{{ route('resources.category', $resource->category->slug) }}"
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-folder me-2"></i>{{ __('Voir la catégorie') }}
                                </a>

                                <a href="{{ route('resources.index') }}"
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>{{ __('Retour aux ressources') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact pour questions -->
                <div class="contact-card mb-4">
                    <div class="card border-0 shadow-sm bg-light">
                        <div class="card-body text-center">
                            <i class="fas fa-question-circle fa-2x text-primary mb-3"></i>
                            <h6 class="fw-bold mb-3">{{ __('Besoin d\'aide ?') }}</h6>
                            <p class="text-muted small mb-3">
                                {{ __('Vous avez des questions sur cette ressource ? N\'hésitez pas à nous contacter.') }}
                            </p>
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-envelope me-1"></i>{{ __('Nous contacter') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ressources similaires -->
@if($relatedResources->count() > 0)
<section class="related-resources-section py-5 bg-light">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold mb-5">
            {{ __('Ressources similaires') }}
        </h2>

        <div class="row">
            @foreach($relatedResources as $related)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="resource-card-mini h-100">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <!-- Type de fichier -->
                                <div class="file-type-mini mb-3">
                                    <i class="{{ $related->file_icon }} fa-2x"></i>
                                </div>

                                <!-- Titre -->
                                <h6 class="card-title mb-2">
                                    <a href="{{ $related->url }}" class="text-decoration-none text-dark">
                                        {{ Str::limit($related->title, 60) }}
                                    </a>
                                </h6>

                                <!-- Description -->
                                <p class="card-text text-muted small mb-3">
                                    {{ Str::limit($related->description, 80) }}
                                </p>

                                <!-- Métadonnées -->
                                <div class="mini-meta d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        {{ $related->formatted_file_size }}
                                    </small>
                                    <a href="{{ $related->url }}" class="btn btn-sm btn-outline-primary">
                                        {{ __('Voir') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.resource-detail-section {
    min-height: 60vh;
}

/* En-tête de la ressource */
.resource-badges .badge {
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
}

.category-badge {
    text-decoration: none !important;
    color: white !important;
    border-radius: 20px;
}

.file-type-badge {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
    border: 1px solid #dee2e6;
}

.action-buttons .btn {
    transition: all 0.3s ease;
}

.action-buttons .btn:hover {
    transform: translateY(-2px);
}

/* Titre */
.resource-title {
    line-height: 1.2;
}

/* Métadonnées */
.resource-meta {
    padding: 1rem 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.meta-item {
    font-size: 0.9rem;
}

/* Aperçu */
.resource-preview {
    position: relative;
}

.preview-container {
    position: relative;
    display: inline-block;
    max-width: 100%;
}

.preview-container img {
    max-height: 500px;
    width: auto;
}

.preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.preview-container:hover .preview-overlay {
    opacity: 1;
}

/* Contenu */
.content-body {
    line-height: 1.8;
    font-size: 1.1rem;
}

/* Tags */
.tags-container .badge {
    font-size: 0.85rem;
    padding: 0.5rem 0.75rem;
    transition: all 0.3s ease;
}

.tags-container .badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Cards de la sidebar */
.file-info-card .card,
.quick-actions-card .card,
.contact-card .card {
    transition: all 0.3s ease;
}

.file-info-card .card:hover,
.quick-actions-card .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.info-item {
    padding-bottom: 0.75rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.info-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

/* Ressources similaires */
.resource-card-mini .card {
    transition: all 0.3s ease;
}

.resource-card-mini:hover .card {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
}

.file-type-mini {
    text-align: center;
    opacity: 0.7;
}

.mini-meta {
    margin-top: auto;
}

/* Responsive */
@media (max-width: 768px) {
    .action-buttons {
        width: 100%;
        margin-top: 1rem;
    }

    .action-buttons .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .resource-meta {
        flex-direction: column;
        gap: 0.5rem !important;
    }

    .preview-container img {
        max-height: 300px;
    }
}
</style>

<script>
function trackDownload(resourceId) {
    // Tracker le téléchargement via AJAX si nécessaire
    fetch(`/api/resources/${resourceId}/track-download`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).catch(error => console.log('Tracking error:', error));
}

function shareResource() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas Web Share API
        copyToClipboard(window.location.href);
        showToast('Lien copié dans le presse-papiers !');
    }
}

function printResource() {
    window.print();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        console.log('URL copied to clipboard');
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
    });
}

function showToast(message) {
    // Créer un toast simple (vous pouvez utiliser Bootstrap Toast ou autre)
    const toast = document.createElement('div');
    toast.className = 'alert alert-success position-fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    toast.textContent = message;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}
</script>
@endsection
