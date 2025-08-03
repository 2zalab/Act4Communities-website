{{-- resources/views/frontend/home.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Accueil')
@section('description', 'Action pour le Développement Communautaire - ONG camerounaise œuvrant pour le développement durable et les droits des communautés')

@section('content')

 <!-- Hero Slider Section -->
<section class="hero-slider-section position-relative overflow-hidden">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <!-- Carousel Items -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active hero-slide" data-bg="{{ asset('images/hero-slide-1.jpg') }}">
                <div class="hero-overlay"></div>
                <div class="container-fluid px-5 h-100">
                    <div class="row align-items-center h-100">
                        <div class=" mx-auto text-center text-white">
                            <h1 class="display-3 fw-bold mb-4 hero-title" data-aos="fade-up" data-aos-delay="100">
                                {{ __('Un développement centré sur la personne humaine') }}
                            </h1>
                            <p class="lead mb-5 fs-4 hero-description" data-aos="fade-up" data-aos-delay="200">
                                {{ __('Action pour le Développement Communautaire (ADC) défend les droits des communautés locales et autochtones à travers la recherche-action, la sensibilisation et le plaidoyer.') }}
                            </p>
                            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center" data-aos="fade-up" data-aos-delay="300">
                                <a href="{{ route('projects.index') }}" class="btn btn-warning btn-lg px-5 py-2 rounded-pill">
                                    <i class="fas fa-folder-open me-2"></i>{{ __('Nos projets') }}
                                </a>
                                <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg px-5 py-2 rounded-pill">
                                    <i class="fas fa-envelope me-2"></i>{{ __('Nous contacter') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item hero-slide" data-bg="{{ asset('images/hero-slide-2.jpg') }}">
                <div class="hero-overlay"></div>
                <div class="container-fluid px-5 h-100">
                    <div class="row align-items-center h-100">
                        <div class=" mx-auto text-center text-white">
                            <h1 class="display-3 fw-bold mb-4 hero-title">
                                {{ __('Autonomisation des communautés locales') }}
                            </h1>
                            <p class="lead mb-5 fs-4 hero-description">
                                {{ __('Nous œuvrons pour l\'agriculture durable, l\'autonomisation des femmes et jeunes, la protection de l\'environnement et la bonne gouvernance au Cameroun.') }}
                            </p>
                            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                                <a href="{{ route('about') }}" class="btn btn-warning btn-lg px-5 py-2 rounded-pill">
                                    <i class="fas fa-info-circle me-2"></i>{{ __('À propos de nous') }}
                                </a>
                                <a href="{{ route('contact.volunteer') }}" class="btn btn-outline-light btn-lg px-5 py-2 rounded-pill">
                                    <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item hero-slide" data-bg="{{ asset('images/hero-slide-3.jpg') }}">
                <div class="hero-overlay"></div>
                <div class="container-fluid px-5 h-100">
                    <div class="row align-items-center h-100">
                        <div class="mx-auto text-center text-white">
                            <h1 class="display-3 fw-bold mb-4 hero-title">
                                {{ __('Ensemble pour un avenir durable') }}
                            </h1>
                            <p class="lead mb-5 fs-4 hero-description">
                                {{ __('Rejoignez notre mission pour construire un Cameroun prospère où chaque communauté a les moyens de son développement et de son épanouissement.') }}
                            </p>
                            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                                <a href="{{ route('contact.partnership') }}" class="btn btn-warning btn-lg px-5 py-2 rounded-pill">
                                    <i class="fas fa-handshake me-2"></i>{{ __('Partenariat') }}
                                </a>
                                <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-lg px-5 py-2 rounded-pill">
                                    <i class="fas fa-newspaper me-2"></i>{{ __('Nos actualités') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>

    <!-- Scroll Indicator -->
    <div class="scroll-down-indicator">
        <div class="scroll-arrow">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</section>

<!-- Coordinatrice Section -->

<!-- Mot de la Coordinatrice -->
<section class="coordinator-message-section py-5 position-relative overflow-hidden">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <!-- Image et titre de la coordinatrice -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="coordinator-image-container position-relative">
                    <!-- Décoration de fond -->
                    <div class="bg-decoration"></div>
                    <div class="bg-decoration-2"></div>

                    <!-- Image de la coordinatrice -->
                    <div class="image-wrapper position-relative">
                        <img src="{{ asset('images/coordinator-louise.jpg') }}"
                             alt="Louise Angeline LOKUMU"
                             class="coordinator-photo img-fluid rounded-4 shadow-lg">

                        <!-- Badge flottant -->
                        <div class="floating-badge position-absolute">
                            <i class="fas fa-quote-right"></i>
                        </div>
                    </div>

                    <!-- Informations coordinatrice -->
                    <div class="coordinator-info text-center mt-4">
                        <h4 class="fw-bold text-primary mb-1">Louise Angeline LOKUMU</h4>
                        <p class="text-muted fs-5 mb-0">
                            <i class="fas fa-crown me-2 text-warning"></i>Coordinatrice
                        </p>
                        <!-- Réseaux sociaux -->
                        <div class="social-links mt-3">
                            <a href="#" class="social-link me-2">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-link me-2">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message de la coordinatrice -->
            <div class="col-lg-7">
                <div class="message-content position-relative">
                    <!-- Titre de section -->
                    <div class="section-header mb-4">
                        <span class="section-subtitle text-uppercase text-primary fw-bold letter-spacing">
                            {{ __('Leadership') }}
                        </span>
                        <h2 class="section-title display-5 fw-bold text-dark mb-4">
                            {{ __('Mot de la Coordinatrice') }}
                        </h2>
                    </div>

                    <!-- Citation principale -->
                    <div class="quote-container mb-4">
                        <div class="quote-mark text-primary">
                            <i class="fas fa-quote-left fa-2x opacity-75"></i>
                        </div>
                        <blockquote class="quote-text fs-4 text-dark fw-medium lh-base mb-4">
                            {{ __('Notre vision d\'un développement centré sur la personne humaine guide chacune de nos actions. Nous croyons fermement que chaque communauté détient en elle les ressources nécessaires à son épanouissement.') }}
                        </blockquote>
                    </div>

                    <!-- Message détaillé -->
                    <div class="detailed-message">
                        <p class="lead text-muted lh-lg mb-4">
                            {{ __('Depuis notre création, Action pour le Développement Communautaire s\'engage à être un catalyseur de changement positif. Notre approche participative permet aux communautés de devenir actrices de leur propre développement.') }}
                        </p>

                        <p class="text-muted lh-lg mb-4">
                            {{ __('À travers nos programmes d\'agriculture durable, d\'autonomisation des femmes et jeunes, de protection environnementale et de gouvernance, nous construisons ensemble un Cameroun plus équitable et prospère.') }}
                        </p>

                        <!-- Engagement personnel -->
                        <div class="personal-commitment p-4 rounded-3 bg-light border-start border-4 border-primary">
                            <p class="mb-2 text-dark fw-medium">
                                <i class="fas fa-heart text-danger me-2"></i>
                                {{ __('Mon engagement personnel') }}
                            </p>
                            <p class="text-muted mb-0 fst-italic">
                                {{ __('Je m\'engage à poursuivre notre mission avec passion et détermination, pour que chaque projet soit une étape vers un avenir meilleur pour nos communautés.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Signature stylisée -->
                    <div class="signature-section mt-5">
                        <div class="signature-line"></div>
                        <p class="signature-name text-primary fw-bold fs-5 mb-0">Louise Angeline LOKUMU</p>
                        <small class="text-muted">Coordinatrice, Action for Community Development</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Éléments décoratifs de fond -->
    <div class="floating-elements">
        <div class="floating-circle floating-circle-1"></div>
        <div class="floating-circle floating-circle-2"></div>
        <div class="floating-circle floating-circle-3"></div>
    </div>
</section>



 <!-- Stats Section Améliorée -->
<section class="stats-section py-5 position-relative overflow-hidden">
    <!-- Background décoratif -->
    <div class="stats-bg-decoration"></div>

    <div class="container-fluid px-5">
        <!-- En-tête de section -->
        <div class="text-center mb-5">
            <span class="section-badge text-uppercase text-primary fw-bold letter-spacing">{{ __('Notre Impact') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-4">{{ __('En Chiffres') }}</h2>
            <p class="lead text-muted">{{ __('Découvrez l\'ampleur de notre action sur le terrain') }}</p>
        </div>

        <div class="row">
            <!-- Projets réalisés -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card-modern h-100 position-relative">
                    <div class="stat-icon-container">
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-pulse stat-pulse-success"></div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="{{ $stats['projects_completed'] }}">0</h3>
                        <p class="stat-label">{{ __('Projets réalisés') }}</p>
                        <p class="stat-description">{{ __('Initiatives menées à bien avec succès') }}</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar bg-success" style="width: 85%"></div>
                    </div>
                </div>
            </div>

            <!-- Projets en cours -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card-modern h-100 position-relative">
                    <div class="stat-icon-container">
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="stat-pulse stat-pulse-warning"></div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="{{ $stats['active_projects'] }}">0</h3>
                        <p class="stat-label">{{ __('Projets en cours') }}</p>
                        <p class="stat-description">{{ __('Initiatives actuellement en développement') }}</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar bg-warning" style="width: 65%"></div>
                    </div>
                </div>
            </div>

            <!-- Communautés servies -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card-modern h-100 position-relative">
                    <div class="stat-icon-container">
                        <div class="stat-icon bg-info">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-pulse stat-pulse-info"></div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="{{ $stats['communities_served'] }}">0</h3>
                        <span class="stat-plus">+</span>
                        <p class="stat-label">{{ __('Communautés servies') }}</p>
                        <p class="stat-description">{{ __('Villages et groupes accompagnés') }}</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar bg-info" style="width: 92%"></div>
                    </div>
                </div>
            </div>

            <!-- Années d'expérience -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card-modern h-100 position-relative">
                    <div class="stat-icon-container">
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-award"></i>
                        </div>
                        <div class="stat-pulse stat-pulse-primary"></div>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number" data-target="{{ $stats['years_experience'] }}">0</h3>
                        <p class="stat-label">{{ __('Années d\'expérience') }}</p>
                        <p class="stat-description">{{ __('D\'expertise en développement communautaire') }}</p>
                    </div>
                    <div class="stat-progress">
                        <div class="progress-bar bg-primary" style="width: 78%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques supplémentaires -->
        <!--div class="additional-stats mt-5">
            <div class="row">
                <div class="col-md-2 col-6 mb-3">
                    <div class="mini-stat text-center">
                        <div class="mini-stat-icon">
                            <i class="fas fa-handshake text-primary"></i>
                        </div>
                        <h5 class="mini-stat-number" data-target="25">0</h5>
                        <small class="text-muted">{{ __('Partenaires') }}</small>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="mini-stat text-center">
                        <div class="mini-stat-icon">
                            <i class="fas fa-user-tie text-success"></i>
                        </div>
                        <h5 class="mini-stat-number" data-target="8">0</h5>
                        <small class="text-muted">{{ __('Consultants') }}</small>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="mini-stat text-center">
                        <div class="mini-stat-icon">
                            <i class="fas fa-heart text-danger"></i>
                        </div>
                        <h5 class="mini-stat-number" data-target="15">0</h5>
                        <small class="text-muted">{{ __('Bénévoles') }}</small>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="mini-stat text-center">
                        <div class="mini-stat-icon">
                            <i class="fas fa-graduation-cap text-warning"></i>
                        </div>
                        <h5 class="mini-stat-number" data-target="12">0</h5>
                        <small class="text-muted">{{ __('Stagiaires') }}</small>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="mini-stat text-center">
                        <div class="mini-stat-icon">
                            <i class="fas fa-globe-africa text-info"></i>
                        </div>
                        <h5 class="mini-stat-number" data-target="3">0</h5>
                        <small class="text-muted">{{ __('Régions') }}</small>
                    </div>
                </div>
                <div class="col-md-2 col-6 mb-3">
                    <div class="mini-stat text-center">
                        <div class="mini-stat-icon">
                            <i class="fas fa-trophy text-warning"></i>
                        </div>
                        <h5 class="mini-stat-number" data-target="5">0</h5>
                        <small class="text-muted">{{ __('Prix reçus') }}</small>
                    </div>
                </div>
            </div>
        </div-->
    </div>

    <!-- Éléments décoratifs flottants -->
    <div class="floating-elements">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>
</section>

<!-- Featured Projects -->
@if($featuredProjects->count() > 0)
<section class="py-5">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold">{{ __('Nos projets phares') }}</h2>
        <div class="row">
            @foreach($featuredProjects->take(6) as $project)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    @if($project->featured_image)
                    <img src="{{ asset('storage/' . $project->featured_image) }}" class="card-img-top" alt="{{ $project->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary">{{ \Illuminate\Support\Str::limit($project->category->name, 30) }}</span>
                            <span class="badge {{ $project->status_badge }}">{{ ucfirst($project->status) }}</span>
                        </div>
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text flex-grow-1">{{ $project->excerpt }}</p>
                        @if($project->location)
                        <p class="text-muted small mb-2">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $project->location }}
                        </p>
                        @endif
                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary">
                            {{ __('En savoir plus') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('projects.index') }}" class="btn btn-primary btn-lg">
                {{ __('Voir tous les projets') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Domains of Intervention -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold">{{ __('Nos domaines d\'intervention') }}</h2>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="{{ $category->icon }} fa-3x" style="color: {{ $category->color }}"></i>
                        </div>
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                        <small class="text-muted">
                            {{ $category->projects_count }} {{ __('projet(s)') }}
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Recent News -->
@if($recentPosts->count() > 0)
<section class="py-5">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold">{{ __('Actualités récentes') }}</h2>
        <div class="row">
            @foreach($recentPosts as $post)
            <div class="col-lg-4 mb-4">
                <article class="card h-100">
                    @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-secondary">{{ \Illuminate\Support\Str::limit($post->category->name, 20) }}</span>
                            <small class="text-muted">{{ $post->published_at->format('d/m/Y') }}</small>
                        </div>
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text flex-grow-1">{{ $post->excerpt }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ __('Par') }} {{ $post->user->name }}</small>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">
                                {{ __('Lire la suite') }}
                            </a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-lg">
                {{ __('Toutes les actualités') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Partners -->
@if($partners->count() > 0)
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <h2 class="text-center section-title fw-bold">{{ __('Ils nous font confiance') }}</h2>
        <div class="row align-items-center">
            @foreach($partners as $partner)
            <div class="col-lg-3 col-md-4 col-6 mb-4 text-center">
                <div class="card border-0 bg-transparent">
                    <div class="card-body">
                        @if($partner->logo)
                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 80px; filter: grayscale(100%); transition: filter 0.3s;" onmouseover="this.style.filter='grayscale(0%)'" onmouseout="this.style.filter='grayscale(100%)'">
                        @else
                        <h6 class="text-muted">{{ $partner->name }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container-fluid px-5 text-center">
        <h2 class="fw-bold mb-4">{{ __('Rejoignez-nous dans notre mission') }}</h2>
        <p class="lead mb-4">
            {{ __('Ensemble, construisons un Cameroun où le développement est centré sur la personne humaine') }}
        </p>
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="{{ route('contact.volunteer') }}" class="btn btn-light btn-lg">
                <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
            </a>
            <a href="{{ route('contact.partnership') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-handshake me-2"></i>{{ __('Partenariat') }}
            </a>
            <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-envelope me-2"></i>{{ __('Nous soutenir') }}
            </a>
        </div>
    </div>
</section>

<style>
/* Section Coordinatrice Styles */
.coordinator-message-section {
    background: linear-gradient(135deg, #fffffe 0%, #fffdfa 100%);
    position: relative;
    min-height: 80vh;
    display: flex;
    align-items: center;
}

/* Container image coordinatrice */
.coordinator-image-container {
    text-align: center;
    position: relative;
    z-index: 2;
}

/* Décorations de fond */
.bg-decoration {
    position: absolute;
    top: -20px;
    left: -20px;
    width: 200px;
    height: 200px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 50%;
    opacity: 0.1;
    z-index: -1;
    animation: float 6s ease-in-out infinite;
}

.bg-decoration-2 {
    position: absolute;
    bottom: -30px;
    right: -30px;
    width: 150px;
    height: 150px;
    background: linear-gradient(45deg, var(--secondary-color), #FBBF24);
    border-radius: 50%;
    opacity: 0.15;
    z-index: -1;
    animation: float 4s ease-in-out infinite reverse;
}

/* Image wrapper */
.image-wrapper {
    display: inline-block;
    max-width: 320px;
}

.coordinator-photo {
    width: 100%;
    max-width: 300px;
    height: 350px;
    object-fit: cover;
    border: 4px solid rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
}

.coordinator-photo:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
}

/* Badge flottant */
.floating-badge {
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--secondary-color), #FBBF24);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
    animation: pulse 2s ease-in-out infinite;
}

/* Informations coordinatrice */
.coordinator-info h4 {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.social-links .social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    border-radius: 50%;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.social-link:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 8px 20px rgba(5, 150, 105, 0.4);
    color: white;
}

/* Section header */
.section-subtitle {
    font-size: 0.9rem;
    color: var(--primary-color);
    display: block;
    margin-bottom: 0.5rem;
}

.letter-spacing {
    letter-spacing: 2px;
}

/* Citation */
.quote-container {
    position: relative;
    padding-left: 3rem;
}

.quote-mark {
    position: absolute;
    left: 0;
    top: -10px;
}

.quote-text {
    font-style: italic;
    position: relative;
    padding: 1rem 0;
}

.quote-text::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
}

/* Message détaillé */
.detailed-message p {
    margin-bottom: 1.5rem;
}

.personal-commitment {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.05), rgba(16, 185, 129, 0.05)) !important;
    border-left: 4px solid var(--primary-color) !important;
}

/* Signature */
.signature-section {
    position: relative;
    padding-top: 2rem;
}

.signature-line {
    width: 150px;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    margin-bottom: 1rem;
    border-radius: 1px;
}

.signature-name {
    margin-bottom: 0.25rem;
}

/* Éléments flottants décoratifs */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.floating-circle {
    position: absolute;
    border-radius: 50%;
    opacity: 0.05;
}

.floating-circle-1 {
    width: 100px;
    height: 100px;
    background: var(--primary-color);
    top: 10%;
    right: 10%;
    animation: float 8s ease-in-out infinite;
}

.floating-circle-2 {
    width: 60px;
    height: 60px;
    background: var(--secondary-color);
    bottom: 20%;
    left: 5%;
    animation: float 6s ease-in-out infinite reverse;
}

.floating-circle-3 {
    width: 80px;
    height: 80px;
    background: var(--accent-color);
    top: 60%;
    right: 15%;
    animation: float 10s ease-in-out infinite;
}

/* Animations */
@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Responsive Design */
@media (max-width: 992px) {
    .coordinator-message-section {
        min-height: auto;
        padding: 4rem 0;
    }

    .quote-container {
        padding-left: 2rem;
    }

    .quote-text {
        font-size: 1.2rem !important;
    }

    .coordinator-photo {
        max-width: 250px;
        height: 300px;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 2rem !important;
    }

    .quote-text {
        font-size: 1.1rem !important;
    }

    .lead {
        font-size: 1rem !important;
    }

    .coordinator-photo {
        max-width: 220px;
        height: 280px;
    }

    .floating-badge {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .quote-container {
        padding-left: 1rem;
    }

    .quote-mark {
        position: relative;
        display: block;
        margin-bottom: 1rem;
    }

    .coordinator-info h4 {
        font-size: 1.3rem;
    }

    .personal-commitment {
        padding: 1rem !important;
    }
}

/* Hero Slider Styles */
.hero-slider-section {
    height: 100vh;
    min-height: 600px;
    position: relative;
    overflow: hidden;
}

.hero-slide {
    height: 100vh;
    min-height: 550px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    display: flex;
    align-items: center;
    padding: 5px;
}

.hero-slide::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(1px);
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        180deg,
        rgba(5, 150, 105, 0.4) 0%,
        rgba(16, 185, 129, 0.6) 30%,
        rgba(31, 41, 55, 0.8) 100%
    );
    z-index: 2;
}

.carousel-inner,
.carousel-item {
    height: 100%;
}

.carousel-item .container-fluid {
    height: 100%;
    z-index: 3;
    position: relative;
}

/* Text Styling */
.hero-title {
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    line-height: 1.2;
    margin-bottom: 2rem;
}

.hero-description {
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.6);
    max-width: 800px;
    margin: 0 auto 3rem;
    line-height: 1.6;
}

/* Buttons */
.btn {
    transition: all 0.3s ease;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.btn-warning {
    background: linear-gradient(45deg, var(--secondary-color), #FBBF24);
    border: none;
    color: #1F2937;
}

.btn-warning:hover {
    background: linear-gradient(45deg, #FBBF24, var(--secondary-color));
    color: #1F2937;
}

.btn-outline-light {
    border: 2px solid rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.1);
}

.btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.9);
    color: var(--primary-color);
    border-color: rgba(255, 255, 255, 0.9);
}

/* Carousel Indicators */
.carousel-indicators {
    bottom: 30px;
    z-index: 4;
}

.carousel-indicators [data-bs-target] {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.5);
    background-color: transparent;
    margin: 0 8px;
    transition: all 0.3s ease;
}

.carousel-indicators .active {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    transform: scale(1.2);
}

/* Carousel Controls */
.carousel-control-prev,
.carousel-control-next {
    width: 60px;
    height: 60px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
    z-index: 4;
}

.carousel-control-prev {
    left: 30px;
}

.carousel-control-next {
    right: 30px;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.5);
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 24px;
    height: 24px;
}

/* Scroll Down Indicator */
.scroll-down-indicator {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 4;
    color: white;
    cursor: pointer;
}

.scroll-arrow {
    animation: bounce 2s infinite;
    font-size: 1.5rem;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.scroll-arrow:hover {
    opacity: 1;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

/* Responsive Design */
@media (max-width: 992px) {
    .hero-slider-section {
        height: 80vh;
        min-height: 500px;
    }

    .hero-slide {
        height: 80vh;
        min-height: 500px;
    }

    .display-3 {
        font-size: 2.5rem !important;
    }

    .lead {
        font-size: 1.2rem !important;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
    }

    .carousel-control-prev {
        left: 20px;
    }

    .carousel-control-next {
        right: 20px;
    }
}

@media (max-width: 768px) {
    .hero-slider-section {
        height: 70vh;
        min-height: 450px;
    }

    .hero-slide {
        height: 70vh;
        min-height: 450px;
    }

    .display-3 {
        font-size: 2rem !important;
    }

    .lead {
        font-size: 1.1rem !important;
    }

    .btn-lg {
        padding: 0.75rem 2rem !important;
        font-size: 1rem !important;
    }

    .carousel-control-prev,
    .carousel-control-next {
        display: none;
    }

    .hero-description {
        margin-bottom: 2rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding-left: 20px !important;
        padding-right: 20px !important;
    }

    .display-3 {
        font-size: 1.8rem !important;
    }

    .btn-lg {
        width: 100%;
        margin-bottom: 1rem;
    }
}

/* Fade Effect */
.carousel-fade .carousel-item {
    opacity: 0;
    transition-duration: 1s;
    transition-property: opacity;
}

.carousel-fade .carousel-item.active,
.carousel-fade .carousel-item-next.carousel-item-start,
.carousel-fade .carousel-item-prev.carousel-item-end {
    opacity: 1;
}

.carousel-fade .carousel-item-next,
.carousel-fade .carousel-item-prev,
.carousel-fade .carousel-item.active.carousel-item-start,
.carousel-fade .carousel-item.active.carousel-item-end {
    opacity: 0;
}

/* Section Stats Styles */
.stats-section {
    background: linear-gradient(135deg, #f8fffe 0%, #f0fdfa 50%, #ecfdf5 100%);
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
}

.stats-bg-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 20% 20%, rgba(5, 150, 105, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
    z-index: 1;
}

.container-fluid {
    position: relative;
    z-index: 2;
}

/* Section Badge */
.section-badge {
    font-size: 0.9rem;
    letter-spacing: 2px;
    display: block;
    margin-bottom: 1rem;
}

.letter-spacing {
    letter-spacing: 2px;
}

/* Cartes de statistiques modernes */
.stat-card-modern {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 2rem 1.5rem;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow:
        0 10px 30px rgba(0, 0, 0, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.6);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.stat-card-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(5, 150, 105, 0.8), transparent);
    transition: left 0.6s ease;
}

.stat-card-modern:hover {
    transform: translateY(-15px) scale(1.02);
    box-shadow:
        0 25px 50px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

.stat-card-modern:hover::before {
    left: 100%;
}

/* Conteneur d'icône avec pulsation */
.stat-icon-container {
    position: relative;
    display: inline-block;
    margin-bottom: 1.5rem;
}

.stat-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.stat-card-modern:hover .stat-icon {
    transform: scale(1.1);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

/* Effet de pulsation */
.stat-pulse {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    opacity: 0.7;
    animation: pulse-ring 2s infinite;
}

.stat-pulse-success { background: rgba(40, 167, 69, 0.3); }
.stat-pulse-warning { background: rgba(255, 193, 7, 0.3); }
.stat-pulse-info { background: rgba(23, 162, 184, 0.3); }
.stat-pulse-primary { background: rgba(5, 150, 105, 0.3); }

@keyframes pulse-ring {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.7;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0;
    }
}

/* Contenu des statistiques */
.stat-content {
    position: relative;
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 900;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    line-height: 1;
    display: inline-block;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.stat-plus {
    font-size: 2rem;
    font-weight: 700;
    color: var(--secondary-color);
    margin-left: 0.25rem;
}

.stat-label {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stat-description {
    color: var(--text-light);
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 1.5rem;
}

/* Barre de progression */
.stat-progress {
    width: 100%;
    height: 4px;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    overflow: hidden;
    margin-top: auto;
}

.progress-bar {
    height: 100%;
    border-radius: 2px;
    transition: width 2s ease-in-out;
    background: linear-gradient(90deg, currentColor, rgba(255, 255, 255, 0.3));
    position: relative;
}

.progress-bar::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Statistiques supplémentaires */
.additional-stats {
    padding-top: 3rem;
    border-top: 1px solid rgba(5, 150, 105, 0.1);
}

.mini-stat {
    padding: 1rem;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.mini-stat:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.mini-stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    font-size: 1.2rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.mini-stat-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

/* Éléments flottants décoratifs */
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
    opacity: 0.1;
}

.shape-1 {
    width: 120px;
    height: 120px;
    background: var(--primary-color);
    top: 10%;
    right: 10%;
    animation: float-1 8s ease-in-out infinite;
}

.shape-2 {
    width: 80px;
    height: 80px;
    background: var(--secondary-color);
    bottom: 20%;
    left: 5%;
    animation: float-2 6s ease-in-out infinite reverse;
}

.shape-3 {
    width: 60px;
    height: 60px;
    background: var(--accent-color);
    top: 50%;
    left: 15%;
    animation: float-3 10s ease-in-out infinite;
}

@keyframes float-1 {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

@keyframes float-2 {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(-180deg); }
}

@keyframes float-3 {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-25px) rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 992px) {
    .stat-number {
        font-size: 3rem;
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }

    .stat-pulse {
        width: 60px;
        height: 60px;
    }

    .stat-card-modern {
        padding: 1.5rem 1rem;
    }
}

@media (max-width: 768px) {
    .stats-section {
        min-height: auto;
        padding: 3rem 0;
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .stat-label {
        font-size: 1rem;
    }

    .stat-description {
        font-size: 0.8rem;
    }

    .mini-stat-icon {
        width: 35px;
        height: 35px;
        font-size: 1rem;
    }

    .mini-stat-number {
        font-size: 1.5rem;
    }

    .additional-stats {
        padding-top: 2rem;
    }
}

@media (max-width: 576px) {
    .stat-card-modern {
        padding: 1rem;
    }

    .stat-number {
        font-size: 2rem;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }

    .mini-stat {
        padding: 0.75rem;
    }

    .floating-shape {
        display: none;
    }
}
</style>

<!-- Script JavaScript pour initialiser le slider et les images de fond -->
<script>
    // Animation des compteurs au scroll
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.5,
        triggerOnce: true
    };

    const countUp = (element, target) => {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 20);
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const numbers = entry.target.querySelectorAll('.stat-number, .mini-stat-number');
                numbers.forEach(number => {
                    const target = parseInt(number.getAttribute('data-target'));
                    countUp(number, target);
                });

                // Animation des barres de progression
                const progressBars = entry.target.querySelectorAll('.progress-bar');
                progressBars.forEach(bar => {
                    setTimeout(() => {
                        bar.style.width = bar.style.width;
                    }, 500);
                });
            }
        });
    }, observerOptions);

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Définir les images de fond pour chaque slide
    const slides = document.querySelectorAll('.hero-slide');

    slides.forEach(slide => {
        const bgImage = slide.getAttribute('data-bg');
        if (bgImage) {
            slide.style.backgroundImage = `url('${bgImage}')`;
        }
    });

    // Images par défaut si vous n'avez pas encore d'images
    const defaultImages = [
        'https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80', // Communauté africaine
        'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80', // Agriculture
        'https://images.unsplash.com/photo-1516062423079-7ca13cdc7f5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80'  // Développement durable
    ];

    // Si aucune image n'est trouvée, utiliser les images par défaut
    slides.forEach((slide, index) => {
        if (!slide.style.backgroundImage || slide.style.backgroundImage === 'url("")') {
            slide.style.backgroundImage = `url('${defaultImages[index] || defaultImages[0]}')`;
        }
    });

    // Smooth scroll pour l'indicateur de défilement
    const scrollIndicator = document.querySelector('.scroll-down-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', function() {
            const nextSection = document.querySelector('.hero-slider-section').nextElementSibling;
            if (nextSection) {
                nextSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }

    // Auto-pause carousel on hover
    const carousel = document.querySelector('#heroCarousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', function() {
            bootstrap.Carousel.getInstance(carousel).pause();
        });

        carousel.addEventListener('mouseleave', function() {
            bootstrap.Carousel.getInstance(carousel).cycle();
        });
    }
});
</script>
@endsection
