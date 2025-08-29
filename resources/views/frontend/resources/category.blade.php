{{-- resources/views/frontend/resources/category.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $category->name . ' - Ressources')
@section('description', $category->description ?: 'Découvrez les ressources de la catégorie ' . $category->name)

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container-fluid px-5">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Accueil') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('resources.index') }}">{{ __('Ressources') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </div>
</nav>

<!-- En-tête de catégorie -->
<section class="category-header-section py-5 position-relative overflow-hidden">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <!-- Icône de la catégorie -->
                @if($category->icon)
                    <div class="category-icon mb-4">
                        <div class="icon-container" style="background-color: {{ $category->color }}20; border: 3px solid {{ $category->color }}">
                            <i class="{{ $category->icon }}" style="color: {{ $category->color }}"></i>
                        </div>
                    </div>
                @endif

                <!-- Titre -->
                <h1 class="display-4 fw-bold text-dark mb-4">
                    {{ $category->name }}
                </h1>

                <!-- Description -->
                @if($category->description)
                    <p class="lead text-muted mb-4">
                        {{ $category->description }}
                    </p>
                @endif

                <!-- Statistiques -->
                <div class="category-stats d-flex justify-content-center gap-4 mb-4">
                    <div class="stat-item">
                        <span class="stat-number text-primary fw-bold">{{ $resources->total() }}</span>
                        <small class="text-muted ms-2">{{ __('ressources') }}</small>
                    </div>
                    @if($fileTypes->count() > 0)
                        <div class="stat-item">
                            <span class="stat-number text-success fw-bold">{{ $fileTypes->count() }}</span>
                            <small class="text-muted ms-2">{{ __('types de fichiers') }}</small>
                        </div>
                    @endif
                </div>

                <!-- Navigation rapide vers autres catégories -->
                <div class="category-navigation">
                    <div class="d-flex flex-wrap justify-content-center gap-2">
                        @foreach($categories as $cat)
                            <a href="{{ $cat->url }}"
                               class="btn btn-sm {{ $cat->id === $category->id ? 'btn-primary' : 'btn-outline-secondary' }}">
                                @if($cat->icon)
                                    <i class="{{ $cat->icon }} me-1"></i>
                                @endif
                                {{ $cat->name }} ({{ $cat->resources_count }})
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- élèments décoratifs -->
    <div class="floating-elements">
        <div class="floating-shape shape-1" style="background-color: {{ $category->color }}"></div>
        <div class="floating-shape shape-2" style="background-color: {{ $category->color }}"></div>
    </div>
</section>

<!-- Filtres -->
<section class="filters-section py-3 bg-light border-bottom">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <!-- Filtres par type -->
            <div class="col-md-6">
                <form method="GET" action="{{ route('resources.category', $category->slug) }}" class="filter-form">
                    <div class="d-flex align-items-center gap-3">
                        <label class="form-label mb-0 text-muted">{{ __('Filtrer par type:') }}</label>
                        <select name="type" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                            <option value="">{{ __('Tous les types') }}</option>
                            @foreach($fileTypes as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                    {{ strtoupper(str_replace('application/', '', $type)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <!-- Actions -->
            <div class="col-md-6 text-end">
                <div class="d-flex justify-content-end align-items-center gap-2">
                    <!-- Retour aux ressources -->
                    <a href="{{ route('resources.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>{{ __('Toutes les ressources') }}
                    </a>

                    <!-- Vue grille/liste (optionnel) -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-secondary btn-sm active" data-view="grid" onclick="toggleView('grid')">
                            <i class="fas fa-th"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-view="list" onclick="toggleView('list')">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres actifs -->
        @if(request('type'))
            <div class="active-filters mt-2">
                <small class="text-muted me-2">{{ __('Filtre actif:') }}</small>
                <span class="badge bg-primary">
                    {{ __('Type:') }} {{ strtoupper(str_replace('application/', '', request('type'))) }}
                    <a href="{{ route('resources.category', $category->slug) }}" class="text-white ms-1">
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            </div>
        @endif
    </div>
</section>

<!-- Liste des ressources -->
<section class="resources-list-section py-5">
    <div class="container-fluid px-5">
        @if($resources->count() > 0)
            <!-- Grille des ressources -->
            <div class="resources-grid" id="resources-container">
                <div class="row">
                    @foreach($resources as $resource)
                        <div class="col-lg-4 col-md-6 mb-4 resource-item">
                            <div class="resource-card h-100 position-relative">
                                <!-- Badge de type de fichier -->
                                <div class="file-type-badge">
                                    <i class="{{ $resource->file_icon }}"></i>
                                    <span>{{ $resource->file_extension }}</span>
                                </div>

                                <!-- Thumbnail -->
                                <div class="resource-thumbnail">
                                    <img src="{{ $resource->thumbnail_url }}"
                                         alt="{{ $resource->title }}"
                                         class="img-fluid">
                                    <div class="thumbnail-overlay">
                                        <a href="{{ $resource->url }}" class="btn btn-light btn-sm me-2">
                                            <i class="fas fa-eye me-1"></i>{{ __('Voir') }}
                                        </a>
                                        <a href="{{ $resource->download_url }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-download me-1"></i>{{ __('Télécharger') }}
                                        </a>
                                    </div>
                                </div>

                                <!-- Contenu -->
                                <div class="resource-content p-4">
                                    <!-- Titre -->
                                    <h5 class="resource-title mb-3">
                                        <a href="{{ $resource->url }}" class="text-decoration-none text-dark">
                                            {{ $resource->title }}
                                        </a>
                                    </h5>

                                    <!-- Description -->
                                    <p class="resource-description text-muted mb-3">
                                        {{ Str::limit($resource->description, 100) }}
                                    </p>

                                    <!-- Métadonnées -->
                                    <div class="resource-meta d-flex justify-content-between align-items-center">
                                        <div class="file-info">
                                            <small class="text-muted">
                                                <i class="fas fa-weight-hanging me-1"></i>{{ $resource->formatted_file_size }}
                                            </small>
                                        </div>
                                        <div class="download-count">
                                            <small class="text-muted">
                                                <i class="fas fa-download me-1"></i>{{ $resource->download_count }}
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Tags -->
                                    @if($resource->tags_array)
                                        <div class="resource-tags mt-3">
                                            @foreach(array_slice($resource->tags_array, 0, 3) as $tag)
                                                <span class="badge bg-light text-dark me-1">{{ trim($tag) }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $resources->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Aucune ressource -->
            <div class="no-resources text-center py-5">
                <div class="no-results-icon mb-4">
                    @if($category->icon)
                        <i class="{{ $category->icon }} fa-4x text-muted opacity-50"></i>
                    @else
                        <i class="fas fa-folder-open fa-4x text-muted opacity-50"></i>
                    @endif
                </div>
                <h3 class="text-muted mb-3">{{ __('Aucune ressource dans cette catégorie') }}</h3>
                <p class="text-muted mb-4">
                    @if(request('type'))
                        {{ __('Aucune ressource de ce type n\'est disponible dans cette catégorie. Essayez de supprimer le filtre.') }}
                    @else
                        {{ __('Cette catégorie ne contient pas encore de ressources. Revenez bientôt !') }}
                    @endif
                </p>

                <div class="d-flex justify-content-center gap-3">
                    @if(request('type'))
                        <a href="{{ route('resources.category', $category->slug) }}" class="btn btn-primary">
                            <i class="fas fa-filter me-2"></i>{{ __('Supprimer les filtres') }}
                        </a>
                    @endif
                    <a href="{{ route('resources.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>{{ __('Toutes les ressources') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection

@push('styles')
<style>
/* En-tête de catégorie */
.category-header-section {
    background: linear-gradient(135deg, #f8fffe 0%, #f0fdfa 100%);
    min-height: 50vh;
    display: flex;
    align-items: center;
}

.category-icon {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

.icon-container {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    transition: all 0.3s ease;
}

.icon-container:hover {
    transform: scale(1.1);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Statistiques */
.category-stats {
    margin-bottom: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.5rem;
}

/* Navigation des catégories */
.category-navigation .btn {
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.category-navigation .btn:hover {
    transform: translateY(-2px);
}

/* Filtres */
.filters-section {
    border-bottom: 2px solid rgba(0, 0, 0, 0.1);
}

/* Cartes de ressources */
.resource-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.resource-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}

/* Badge type de fichier */
.file-type-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    font-size: 0.8rem;
    font-weight: 600;
    z-index: 2;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Thumbnail */
.resource-thumbnail {
    position: relative;
    height: 200px;
    overflow: hidden;
    background: #f8f9fa;
}

.resource-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.thumbnail-overlay {
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
    transition: all 0.3s ease;
}

.resource-card:hover .thumbnail-overlay {
    opacity: 1;
}

.resource-card:hover .resource-thumbnail img {
    transform: scale(1.1);
}

/* Contenu des ressources */
.resource-title a {
    transition: color 0.3s ease;
}

.resource-title a:hover {
    color: var(--primary-color) !important;
}

.resource-description {
    line-height: 1.6;
    font-size: 0.9rem;
}

.resource-meta {
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    padding-top: 1rem;
}

.resource-tags .badge {
    font-size: 0.7rem;
    padding: 0.3rem 0.6rem;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

/* Vue liste (optionnelle) */
.resources-list .resource-item {
    width: 100%;
}

.resources-list .resource-card {
    display: flex;
    flex-direction: row;
    height: auto;
}

.resources-list .resource-thumbnail {
    width: 200px;
    flex-shrink: 0;
}

.resources-list .resource-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

/* élèments flottants */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.floating-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.05;
}

.shape-1 {
    width: 150px;
    height: 150px;
    top: 10%;
    right: 10%;
    animation: float 8s ease-in-out infinite;
}

.shape-2 {
    width: 100px;
    height: 100px;
    bottom: 20%;
    left: 10%;
    animation: float 6s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

/* Responsive */
@media (max-width: 768px) {
    .category-header-section {
        min-height: 40vh;
        padding: 3rem 0;
    }

    .display-4 {
        font-size: 2rem !important;
    }

    .resource-thumbnail {
        height: 150px;
    }

    .category-navigation {
        text-align: center;
    }

    .category-navigation .btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }

    .resources-list .resource-card {
        flex-direction: column;
    }

    .resources-list .resource-thumbnail {
        width: 100%;
    }
}

/* Variables CSS */
:root {
    --primary-color: #059669;
    --secondary-color: #F59E0B;
    --accent-color: #10B981;
}
</style>
@endpush

@push('scripts')
<script>
function toggleView(view) {
    const container = document.getElementById('resources-container');
    const buttons = document.querySelectorAll('[data-view]');

    // Remove active class from all buttons
    buttons.forEach(button => button.classList.remove('active'));

    // Add active class to clicked button
    document.querySelector(`[data-view="${view}"]`).classList.add('active');

    if (view === 'list') {
        container.classList.remove('resources-grid');
        container.classList.add('resources-list');
    } else {
        container.classList.remove('resources-list');
        container.classList.add('resources-grid');
    }

    // Save preference in localStorage
    localStorage.setItem('resourcesView', view);
}

// Load saved view preference
document.addEventListener('DOMContentLoaded', function() {
    const savedView = localStorage.getItem('resourcesView');
    if (savedView) {
        toggleView(savedView);
    }
});
</script>
@endpush
