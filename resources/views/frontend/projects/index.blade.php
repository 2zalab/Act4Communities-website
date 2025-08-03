{{-- resources/views/frontend/projects/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Nos projets')
@section('description', 'Découvrez tous les projets d\'Act for Communities dans les domaines de l\'agriculture durable, l\'environnement, la gouvernance et l\'autonomisation')

@section('content')
<!-- Hero Section -->
<section class="projects-hero-section position-relative overflow-hidden">
    <div class="hero-bg-overlay text-white"></div>
    <div class="container-fluid px-5 position-relative">
        <div class="row align-items-center min-vh-60">
            <div class="col-lg-8 mx-auto text-center text-white py-2">
                <h1 class="display-3 fw-bold mb-4 hero-title">
                    {{ __('Nos Projets') }}
                </h1>
                <p class="lead mb-4 fs-4 hero-subtitle">
                    {{ __('Découvrez nos initiatives pour le développement durable et l\'autonomisation des communautés') }}
                </p>

                <!-- Project Stats -->
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">{{ $projects->total() }}</h3>
                            <p class="mb-0">{{ __('Total projets') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">{{ $categories->count() }}</h3>
                            <p class="mb-0">{{ __('Domaines') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">15+</h3>
                            <p class="mb-0">{{ __('Communautés') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">3</h3>
                            <p class="mb-0">{{ __('Régions') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Advanced Filters Section -->
<section class="filters-section py-4 bg-white" style="top: 0; z-index: 100;">
    <div class="container-fluid px-5">
        <form method="GET" action="{{ route('projects.index') }}" class="advanced-filters">
            <div class="row align-items-end">
                <!-- Search -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <label for="search" class="form-label fw-bold text-dark">
                        <i class="fas fa-search me-2 text-primary"></i>{{ __('Rechercher') }}
                    </label>
                    <div class="search-input-container">
                        <input type="text" class="form-control form-control-modern" id="search" name="search"
                               value="{{ request('search') }}" placeholder="{{ __('Titre, description, lieu...') }}">
                        <div class="search-icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <label for="category" class="form-label fw-bold text-dark">
                        <i class="fas fa-tags me-2 text-success"></i>{{ __('Catégorie') }}
                    </label>
                    <select class="form-select form-select-modern" id="category" name="category">
                        <option value="all">{{ __('Toutes les catégories') }}</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }} ({{ $category->projects_count }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="col-lg-3 col-md-6 mb-3">
                    <label for="status" class="form-label fw-bold text-dark">
                        <i class="fas fa-flag me-2 text-warning"></i>{{ __('Statut') }}
                    </label>
                    <select class="form-select form-select-modern" id="status" name="status">
                        <option value="all">{{ __('Tous les statuts') }}</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('En cours') }}</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('Terminé') }}</option>
                        <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>{{ __('Suspendu') }}</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="col-lg-2 col-md-6 mb-3">
                    <button type="submit" class="btn btn-primary btn-modern w-100">
                        <i class="fas fa-filter me-2"></i>{{ __('Filtrer') }}
                    </button>
                </div>
            </div>

            <!-- Active Filters Display -->
            @if(request()->hasAny(['search', 'category', 'status']) && (request('category') != 'all' || request('status') != 'all' || request('search')))
            <div class="active-filters mt-3">
                <small class="text-muted me-3">{{ __('Filtres actifs:') }}</small>
                @if(request('search'))
                    <span class="filter-tag">
                        <i class="fas fa-search me-1"></i>{{ request('search') }}
                        <a href="{{ route('projects.index', array_merge(request()->except('search'), [])) }}" class="remove-filter">×</a>
                    </span>
                @endif
                @if(request('category') && request('category') != 'all')
                    <span class="filter-tag">
                        <i class="fas fa-tag me-1"></i>{{ $categories->where('slug', request('category'))->first()->name ?? request('category') }}
                        <a href="{{ route('projects.index', array_merge(request()->except('category'), [])) }}" class="remove-filter">×</a>
                    </span>
                @endif
                @if(request('status') && request('status') != 'all')
                    <span class="filter-tag">
                        <i class="fas fa-flag me-1"></i>{{ __(ucfirst(request('status'))) }}
                        <a href="{{ route('projects.index', array_merge(request()->except('status'), [])) }}" class="remove-filter">×</a>
                    </span>
                @endif
                <a href="{{ route('projects.index') }}" class="clear-all-filters">
                    <i class="fas fa-times-circle me-1"></i>{{ __('Effacer tout') }}
                </a>
            </div>
            @endif
        </form>
    </div>
</section>

<!-- Featured Projects -->
@if($featuredProjects->count() > 0 && !request()->hasAny(['search', 'category', 'status']))
<section class="featured-projects-section py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="text-center mb-5">
            <span class="section-badge text-uppercase text-primary fw-bold">{{ __('Nos Réussites') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-4">{{ __('Projets Phares') }}</h2>
            <p class="lead text-muted">{{ __('Découvrez nos initiatives les plus marquantes') }}</p>
        </div>

        <div class="row">
            @foreach($featuredProjects as $project)
            <div class="col-lg-4 mb-4">
                <div class="project-card-featured h-100">
                    <div class="project-image-container">
                        @if($project->featured_image)
                        <img src="{{ asset('storage/' . $project->featured_image) }}"
                             class="project-image" alt="{{ $project->title }}">
                        @else
                        <div class="project-image-placeholder">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        @endif
                        <div class="project-overlay">
                            <div class="project-badges">
                                <span class="badge-category">{{ $project->category->name }}</span>
                                <span class="badge-status status-{{ $project->status }}">
                                    @if($project->status == 'active')
                                        <i class="fas fa-play me-1"></i>{{ __('En cours') }}
                                    @elseif($project->status == 'completed')
                                        <i class="fas fa-check me-1"></i>{{ __('Terminé') }}
                                    @else
                                        <i class="fas fa-pause me-1"></i>{{ __('Suspendu') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="project-content">
                        <h4 class="project-title">{{ $project->title }}</h4>
                        <p class="project-excerpt">{{ $project->excerpt }}</p>

                        <div class="project-meta">
                            @if($project->location)
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                                <span>{{ $project->location }}</span>
                            </div>
                            @endif
                            @if($project->start_date)
                            <div class="meta-item">
                                <i class="fas fa-calendar-alt text-info"></i>
                                <span>{{ $project->start_date->format('M Y') }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="project-actions">
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn-project-view">
                                {{ __('Découvrir le projet') }}
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>

                    <div class="featured-ribbon">
                        <i class="fas fa-star"></i>
                        <span>{{ __('Phare') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- All Projects -->
<section class="all-projects-section py-5">
    <div class="container-fluid px-5">
        <!-- Section Header -->
        <div class="section-header mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark mb-2">
                        @if(request()->hasAny(['search', 'category', 'status']))
                            {{ __('Résultats de recherche') }}
                        @else
                            {{ __('Tous nos projets') }}
                        @endif
                    </h2>
                    <p class="text-muted mb-0">
                        {{ $projects->total() }} {{ __('projet(s) trouvé(s)') }}
                    </p>
                </div>

                <!-- View Toggle -->
                <div class="view-toggle-container">
                    <div class="btn-group view-toggle" role="group">
                        <button type="button" class="btn btn-outline-secondary active" data-view="grid">
                            <i class="fas fa-th"></i>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if($projects->count() > 0)
        <!-- Projects Grid -->
        <div class="projects-container" id="projectsContainer">
            <div class="row projects-grid">
                @foreach($projects as $project)
                <div class="col-lg-4 col-md-6 mb-4 project-item">
                    <div class="project-card h-100">
                        <div class="project-image-container">
                            @if($project->featured_image)
                            <img src="{{ asset('storage/' . $project->featured_image) }}"
                                 class="project-image" alt="{{ $project->title }}">
                            @else
                            <div class="project-image-placeholder">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            @endif
                            <div class="project-overlay">
                                <div class="project-badges">
                                    <span class="badge-category">{{ $project->category->name }}</span>
                                    <span class="badge-status status-{{ $project->status }}">
                                        @if($project->status == 'active')
                                            <i class="fas fa-play me-1"></i>{{ __('En cours') }}
                                        @elseif($project->status == 'completed')
                                            <i class="fas fa-check me-1"></i>{{ __('Terminé') }}
                                        @else
                                            <i class="fas fa-pause me-1"></i>{{ __('Suspendu') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="project-quick-actions">
                                    <a href="{{ route('projects.show', $project->slug) }}" class="quick-action-btn" title="{{ __('Voir détails') }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="project-content">
                            <h5 class="project-title">{{ $project->title }}</h5>
                            <p class="project-excerpt">{{ $project->excerpt }}</p>

                            <div class="project-meta">
                                @if($project->location)
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt text-danger"></i>
                                    <span>{{ $project->location }}</span>
                                </div>
                                @endif
                                @if($project->start_date)
                                <div class="meta-item">
                                    <i class="fas fa-calendar-alt text-info"></i>
                                    <span>
                                        {{ $project->start_date->format('M Y') }}
                                        @if($project->end_date)
                                        - {{ $project->end_date->format('M Y') }}
                                        @endif
                                    </span>
                                </div>
                                @endif
                            </div>

                            <div class="project-actions">
                                <a href="{{ route('projects.show', $project->slug) }}" class="btn-project-view">
                                    {{ __('En savoir plus') }}
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-container d-flex justify-content-center mt-5">
            {{ $projects->appends(request()->query())->links() }}
        </div>
        @else
        <!-- No Results -->
        <div class="no-results-container text-center py-5">
            <div class="no-results-icon mb-4">
                <i class="fas fa-search"></i>
            </div>
            <h3 class="no-results-title">{{ __('Aucun projet trouvé') }}</h3>
            <p class="no-results-text">{{ __('Essayez de modifier vos critères de recherche ou explorez tous nos projets') }}</p>
            <div class="no-results-actions">
                <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                    <i class="fas fa-refresh me-2"></i>{{ __('Voir tous les projets') }}
                </a>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Quick Links Section -->
<section class="quick-links-section py-5 bg-primary text-white position-relative overflow-hidden">
    <div class="quick-links-bg"></div>
    <div class="container-fluid px-5 position-relative">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">{{ __('Explorer nos projets') }}</h2>
            <p class="lead">{{ __('Découvrez nos différentes initiatives par catégorie') }}</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('projects.ongoing') }}" class="quick-link-card text-decoration-none">
                    <div class="quick-link-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="quick-link-content">
                        <h5 class="quick-link-title">{{ __('Projets en cours') }}</h5>
                        <p class="quick-link-description">{{ __('Découvrez nos initiatives actuelles et leur progression') }}</p>
                        <div class="quick-link-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('projects.completed') }}" class="quick-link-card text-decoration-none">
                    <div class="quick-link-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="quick-link-content">
                        <h5 class="quick-link-title">{{ __('Projets réalisés') }}</h5>
                        <p class="quick-link-description">{{ __('Nos réalisations et l\'impact sur les communautés') }}</p>
                        <div class="quick-link-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('contact.partnership') }}" class="quick-link-card text-decoration-none">
                    <div class="quick-link-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="quick-link-content">
                        <h5 class="quick-link-title">{{ __('Partenariat') }}</h5>
                        <p class="quick-link-description">{{ __('Collaborez avec nous sur de nouveaux projets') }}</p>
                        <div class="quick-link-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.projects-hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2)),
                url('{{ asset("images/hero-slide-1.jpg") }}') center/cover no-repeat;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.container-fluid {
    position: relative;
    z-index: 3; /* Plus élevé que l'overlay (z-index: 1) */
}

.hero-bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg,
        rgba(0, 0, 0, 0.75) 0%,
        rgba(5, 150, 105, 0.85) 50%,
        rgba(0, 0, 0, 0.8) 100%);
    z-index: 1;
}

.min-vh-60 {
    min-height: 60vh;
}

.hero-title, .hero-subtitle {
      text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9),    /* Ombre principale */
                 1px 1px 3px rgba(0, 0, 0, 0.8);     /* Ombre secondaire */
    font-weight: 900;                                /* Plus gras */
    color: #ffffff !important;                       /* Blanc forcé */
}

.stat-card {
    padding: 1.5rem;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
}

/* Advanced Filters */
.filters-section {
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
}

.form-control-modern, .form-select-modern {
    border: 2px solid rgba(5, 150, 105, 0.1);
    border-radius: 15px;
    padding: 0.75rem 1rem;
    background: rgba(248, 250, 252, 0.8);
    transition: all 0.3s ease;
    font-weight: 500;
}

.form-control-modern:focus, .form-select-modern:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    background: white;
}

.search-input-container {
    position: relative;
}

.search-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    pointer-events: none;
}

.btn-modern {
    border-radius: 15px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

/* Active Filters */
.active-filters {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem;
    background: rgba(5, 150, 105, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(5, 150, 105, 0.1);
}

.filter-tag {
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.remove-filter {
    color: white;
    text-decoration: none;
    font-weight: bold;
    margin-left: 0.5rem;
    cursor: pointer;
}

.remove-filter:hover {
    color: rgba(255, 255, 255, 0.8);
}

.clear-all-filters {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
}

.clear-all-filters:hover {
    color: var(--secondary-color);
}

/* Section Badge */
.section-badge {
    font-size: 0.9rem;
    letter-spacing: 2px;
    display: block;
    margin-bottom: 1rem;
}

/* Project Cards */
.project-card, .project-card-featured {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
}

.project-card:hover, .project-card-featured:hover {
    transform: translateY(-15px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
}

.project-card-featured {
    border: 2px solid rgba(245, 158, 11, 0.3);
}

/* Project Images */
.project-image-container {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.project-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card:hover .project-image {
    transform: scale(1.1);
}

.project-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
}

/* Project Overlay */
.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), transparent, rgba(0, 0, 0, 0.7));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.badge-category {
    background: rgba(5, 150, 105, 0.9);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.badge-status {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.status-active {
    background: rgba(40, 167, 69, 0.9);
    color: white;
}

.status-completed {
    background: rgba(23, 162, 184, 0.9);
    color: white;
}

.status-suspended {
    background: rgba(255, 193, 7, 0.9);
    color: white;
}

.project-quick-actions {
    position: absolute;
    bottom: 15px;
    right: 15px;
}

.quick-action-btn {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.quick-action-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
}

/* Project Content */
.project-content {
    padding: 2rem;
}

.project-title {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.project-excerpt {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.project-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 2rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-light);
    font-size: 0.9rem;
}

.meta-item i {
    width: 16px;
}

/* Project Actions */
.project-actions {
    margin-top: auto;
}

.btn-project-view {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}

.btn-project-view:hover {
    background: linear-gradient(135deg, var(--accent-color), var(--primary-color));
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
}

/* Featured Ribbon */
.featured-ribbon {
    position: absolute;
    top: 20px;
    right: -35px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    color: white;
    padding: 0.5rem 3rem;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    transform: rotate(45deg);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    z-index: 10;
}

.featured-ribbon i {
    margin-right: 0.25rem;
}

/* View Toggle */
.view-toggle-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.view-toggle .btn {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid rgba(5, 150, 105, 0.2);
    background: white;
    color: var(--text-light);
    transition: all 0.3s ease;
}

.view-toggle .btn.active,
.view-toggle .btn:hover {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* List View Styles */
.projects-list .project-item {
    margin-bottom: 2rem;
    width: 100% !important; /* Largeur pleine */
    max-width: none !important;
}
.projects-list .projects-grid {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.projects-list .project-card {
     display: flex;
    flex-direction: row;
    border-radius: 15px;
    overflow: hidden;
    width: 100%;
    max-width: none;
}

.projects-list .project-image-container {
    min-width: 250px; /* Largeur fixe pour l'image */
    flex-shrink: 0;
}

.projects-list .project-card .project-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 2rem;
    width: calc(100% - 300px); /* Reste de l'espace */
}

/* No Results */
.no-results-container {
    padding: 4rem 2rem;
}

.no-results-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.1), rgba(16, 185, 129, 0.1));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: var(--primary-color);
    font-size: 2.5rem;
}

.no-results-title {
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.no-results-text {
    color: var(--text-light);
    max-width: 500px;
    margin: 0 auto 2rem;
    font-size: 1.1rem;
    line-height: 1.6;
}

/* Quick Links Section */
.quick-links-section {
    position: relative;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
}

.quick-links-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="60" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.5;
}

.quick-link-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    height: 100%;
}

.quick-link-card:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    color: white;
}

.quick-link-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.quick-link-content {
    flex: 1;
}

.quick-link-title {
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: white;
}

.quick-link-description {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}

.quick-link-arrow {
    font-size: 1.2rem;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.quick-link-card:hover .quick-link-arrow {
    opacity: 1;
    transform: translateX(5px);
}

/* Pagination Styling */
.pagination-container .pagination {
    gap: 0.5rem;
}

.pagination .page-link {
    border: none;
    background: rgba(5, 150, 105, 0.1);
    color: var(--primary-color);
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pagination .page-link:hover,
.pagination .page-item.active .page-link {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(5, 150, 105, 0.3);
}

/* Breadcrumb */
.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.7);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.project-card, .project-card-featured {
    animation: fadeInUp 0.6s ease-out;
}

/* Responsive Design */
@media (max-width: 992px) {
    .projects-hero-section {
        min-height: 50vh;
    }

    .display-3 {
        font-size: 2.5rem !important;
    }

    .project-image-container {
        height: 200px;
    }

    .project-content {
        padding: 1.5rem;
    }

    .quick-link-card {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .view-toggle-container {
        margin-top: 1rem;
    }
}

@media (max-width: 768px) {
    .projects-hero-section {
        min-height: 40vh;
    }

    .view-toggle-container{
        display: none;
    }

    .display-3 {
        font-size: 2rem !important;
    }

    .hero-subtitle {
        font-size: 1.1rem !important;
    }

    .filters-section {
        position: relative !important;
    }

    .advanced-filters .row {
        row-gap: 1rem;
    }

    .project-image-container {
        height: 180px;
    }

    .project-content {
        padding: 1rem;
    }

    .project-meta {
        flex-direction: column;
        gap: 0.5rem;
    }

    .quick-link-card {
        padding: 1rem;
    }

    .section-header {
        text-align: center;
    }

    .section-header .d-flex {
        flex-direction: column;
        gap: 1rem;
    }

}

@media (max-width: 576px) {
    .container-fluid {
        padding-left: 20px !important;
        padding-right: 20px !important;
    }

    .hero-title {
        font-size: 1.8rem !important;
    }

    .hero-subtitle {
        font-size: 1rem !important;
    }

    .stat-card h3 {
        font-size: 2rem !important;
    }

    .project-card, .project-card-featured {
        margin-bottom: 2rem;
    }

    .featured-ribbon {
        font-size: 0.7rem;
        padding: 0.4rem 2.5rem;
        right: -30px;
    }

    .active-filters {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .filter-tag {
        font-size: 0.8rem;
    }

    .no-results-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}

/* Print Styles */
@media print {
    .filters-section,
    .quick-links-section,
    .pagination-container {
        display: none;
    }

    .project-card {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ccc;
    }

    .projects-hero-section {
        background: none;
        color: black;
        min-height: auto;
        padding: 2rem 0;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .project-card, .project-card-featured {
        background: rgba(255, 255, 255, 0.95);
    }

    .filters-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .form-control-modern, .form-select-modern {
        background: rgba(255, 255, 255, 0.9);
    }
}

/* Accessibility Improvements */
.project-card:focus,
.quick-link-card:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

.btn-project-view:focus,
.quick-action-btn:focus {
    outline: 2px solid rgba(255, 255, 255, 0.8);
    outline-offset: 2px;
}

/* Loading States */
.project-item.loading {
    opacity: 0.6;
    pointer-events: none;
}

.project-item.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Toggle Functionality
    const viewToggleButtons = document.querySelectorAll('.view-toggle .btn');
    const projectsContainer = document.getElementById('projectsContainer');

    viewToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            viewToggleButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const view = this.getAttribute('data-view');

            if (view === 'list') {
                projectsContainer.classList.add('projects-list');
                projectsContainer.querySelector('.projects-grid').classList.remove('row');
            } else {
                projectsContainer.classList.remove('projects-list');
                projectsContainer.querySelector('.projects-grid').classList.add('row');
            }
        });
    });

    // Smooth scroll for quick links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Filter form auto-submit on change (optional)
    const filterForm = document.querySelector('.advanced-filters form');
    const filterSelects = filterForm.querySelectorAll('select');

    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            // Optional: auto-submit form on select change
            // Uncomment the line below if you want automatic filtering
            // filterForm.submit();
        });
    });

    // Add loading animation for project cards
    const projectCards = document.querySelectorAll('.project-card, .project-card-featured');

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, observerOptions);

    projectCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
});
</script>

@endsection
