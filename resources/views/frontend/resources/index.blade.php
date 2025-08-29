{{-- resources/views/frontend/resources/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Ressources')
@section('description', 'Documents, guides et ressources utiles d\'Action pour le Développement Communautaire')

@section('content')

<!-- Hero Section -->
<section class="resources-hero-section py-5 position-relative overflow-hidden">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <span class="section-badge text-uppercase text-primary fw-bold letter-spacing mb-3 d-block">
                        {{ __('Centre de ressources') }}
                    </span>
                    <h1 class="display-4 fw-bold text-dark mb-4">
                        {{ __('Nos Ressources Documentaires') }}
                    </h1>
                    <p class="lead text-muted mb-5">
                        {{ __('Découvrez nos documents, guides, rapports et ressources pour accompagner le développement communautaire et la protection des droits des communautés.') }}
                    </p>

                    <!-- Barre de recherche -->
                    <div class="search-container mb-4">
                        <form method="GET" action="{{ route('resources.index') }}" class="search-form">
                            <div class="input-group input-group-lg shadow-sm">
                                <input type="text"
                                       name="search"
                                       class="form-control border-0"
                                       placeholder="{{ __('Rechercher dans les ressources...') }}"
                                       value="{{ request('search') }}">
                                <button class="btn btn-primary px-4" type="submit">
                                    <i class="fas fa-search me-2"></i>{{ __('Rechercher') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- élèments décoratifs -->
    <div class="floating-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
    </div>
</section>

<!-- Filtres et statistiques -->
<section class="filters-section py-4 bg-light">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <!-- Statistiques rapides -->
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="stats-item me-4">
                        <span class="stats-number text-primary fw-bold">{{ $resources->total() }}</span>
                        <small class="text-muted ms-2">{{ __('ressources') }}</small>
                    </div>
                    <div class="stats-item me-4">
                        <span class="stats-number text-success fw-bold">{{ $categories->count() }}</span>
                        <small class="text-muted ms-2">{{ __('catégories') }}</small>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="col-md-6">
                <form method="GET" action="{{ route('resources.index') }}" class="filter-form">
                    <div class="row g-2">
                        <!-- Filtre par catégorie -->
                        <div class="col-md-6">
                            <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">{{ __('Toutes les catégories') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->resources_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtre par type -->
                        <div class="col-md-6">
                            <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">{{ __('Tous les types') }}</option>
                                @foreach($fileTypes as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                        {{ strtoupper(str_replace('application/', '', $type)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Conserver les autres paramètres -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                </form>
            </div>
        </div>

        <!-- Filtres actifs -->
        @if(request()->hasAny(['category', 'type', 'search']))
            <div class="active-filters mt-3">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <small class="text-muted me-2">{{ __('Filtres actifs:') }}</small>

                    @if(request('search'))
                        <span class="badge bg-primary">
                            {{ __('Recherche:') }} "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="text-white ms-1">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif

                    @if(request('category'))
                        <span class="badge bg-success">
                            {{ __('Catégorie:') }} {{ $categories->where('slug', request('category'))->first()?->name }}
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="text-white ms-1">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif

                    @if(request('type'))
                        <span class="badge bg-warning">
                            {{ __('Type:') }} {{ strtoupper(str_replace('application/', '', request('type'))) }}
                            <a href="{{ request()->fullUrlWithQuery(['type' => null]) }}" class="text-white ms-1">
                                <i class="fas fa-times"></i>
                            </a>
                        </span>
                    @endif

                    <a href="{{ route('resources.index') }}" class="btn btn-sm btn-outline-secondary ms-2">
                        <i class="fas fa-times me-1"></i>{{ __('Effacer tout') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Liste des ressources -->
<section class="resources-list-section py-5">
    <div class="container-fluid px-5">
        @if($resources->count() > 0)
            <!-- Grille des ressources -->
            <div class="row">
                @foreach($resources as $resource)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="resource-card h-100 position-relative">
                            <!-- Badge de type de fichier -->
                            <div class="file-type-badge">
                                <i class="{{ $resource->file_icon }}"></i>
                                <span>{{ $resource->file_extension }}</span>
                            </div>

                            <!-- Thumbnail -->
                            <div class="resource-thumbnail">
                                 <img src="{{ asset('storage/' . $resource->thumbnail) }}"
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
                                <!-- Catégorie -->
                                <div class="resource-category mb-2">
                                    <a href="{{ $resource->category->url }}"
                                       class="badge category-badge"
                                       style="background-color: {{ $resource->category->color }}">
                                        @if($resource->category->icon)
                                            <i class="{{ $resource->category->icon }} me-1"></i>
                                        @endif
                                        {{ $resource->category->name }}
                                    </a>
                                </div>

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

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $resources->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Aucune ressource -->
            <div class="no-resources text-center py-5">
                <div class="no-results-icon mb-4">
                    <i class="fas fa-folder-open fa-4x text-muted opacity-50"></i>
                </div>
                <h3 class="text-muted mb-3">{{ __('Aucune ressource trouvée') }}</h3>
                <p class="text-muted mb-4">
                    @if(request()->hasAny(['category', 'type', 'search']))
                        {{ __('Aucune ressource ne correspond à vos critères de recherche. Essayez de modifier vos filtres.') }}
                    @else
                        {{ __('Aucune ressource n\'est disponible pour le moment. Revenez bientôt !') }}
                    @endif
                </p>

                @if(request()->hasAny(['category', 'type', 'search']))
                    <a href="{{ route('resources.index') }}" class="btn btn-primary">
                        <i class="fas fa-refresh me-2"></i>{{ __('Voir toutes les ressources') }}
                    </a>
                @endif
            </div>
        @endif
    </div>
</section>

<style>
/* Hero Section */
.resources-hero-section {
    background: linear-gradient(135deg, #f8fffe 0%, #f0fdfa 100%);
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.section-badge {
    font-size: 0.9rem;
    letter-spacing: 2px;
}

.search-container {
    max-width: 600px;
    margin: 0 auto;
}

.search-form .form-control {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

/* Filtres */
.filters-section {
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.stats-number {
    font-size: 1.5rem;
}

.active-filters .badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
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
}

</style>
@endsection
