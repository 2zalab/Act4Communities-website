{{-- resources/views/frontend/about.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'À propos')
@section('description', 'Découvrez Action pour le Développement Communautaire, une ONG camerounaise œuvrant pour les droits des communautés locales')

@section('content')
<!-- Hero Section with Background -->
<section class="about-hero-section position-relative overflow-hidden">
    <div class="hero-bg-overlay"></div>
    <div class="container-fluid px-5 position-relative">
        <div class="row align-items-center min-vh-60">
            <div class="col-lg-8 mx-auto text-center text-white py-4">
                <h1 class="display-3 fw-bold mb-4 hero-title">
                    {{ __('À propos de nous') }}
                </h1>
                <p class="lead mb-4 fs-4 hero-subtitle">
                    {{ __('Notre vision est celle d\'un "Cameroun où le développement est centré sur la personne humaine"') }}
                </p>
                <div class="hero-stats row justify-content-center mt-5">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">2019</h3>
                            <p class="mb-0">{{ __('Année de création') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">6+</h3>
                            <p class="mb-0">{{ __('Domaines d\'intervention') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">{{ date('Y') - 2019 }}+</h3>
                            <p class="mb-0">{{ __('Années d\'expérience') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">Nord</h3>
                            <p class="mb-0">{{ __('Région d\'origine') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Historique et Genèse -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="content-wrapper">
                    <span class="section-badge text-uppercase text-primary fw-bold">{{ __('Notre Histoire') }}</span>
                    <h2 class="display-5 fw-bold text-dark mb-4">{{ __('Genèse') }}</h2>
                    <p class="lead text-muted mb-4">
                        {{ __('Des jeunes portés par le désir profond d\'apporter le changement positif en matière de promotion et protection des droits humains et gouvernance se sont réunis en mars 2019.') }}
                    </p>
                    <div class="timeline-item mb-4">
                        <div class="timeline-marker bg-primary"></div>
                        <div class="timeline-content">
                            <h6 class="fw-bold text-primary">{{ __('Mars 2019') }}</h6>
                            <p class="mb-0">{{ __('Création de l\'association par des jeunes engagés') }}</p>
                        </div>
                    </div>
                    <div class="timeline-item mb-4">
                        <div class="timeline-marker bg-secondary"></div>
                        <div class="timeline-content">
                            <h6 class="fw-bold text-secondary">{{ __('11 Avril 2019') }}</h6>
                            <p class="mb-0">{{ __('Légalisation sous le n° 06/RDA/D42/SAAJP à la Préfecture du Mayo Louti') }}</p>
                        </div>
                    </div>
                    <div class="key-info p-4 bg-white rounded-3 shadow-sm border-start border-4 border-primary mt-4">
                        <h6 class="fw-bold text-primary mb-2">{{ __('Implantation géographique') }}</h6>
                        <p class="mb-2"><strong>{{ __('Siège :') }}</strong> Guider, Nord Cameroun</p>
                        <p class="mb-0"><strong>{{ __('Bureau opérationnel :') }}</strong> Garoua, Nord Cameroun</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-gallery">
                    <img src="{{ asset('images/about-hero.jpg') }}" alt="Histoire ADC" class="img-fluid rounded-4 shadow-lg main-image">
                    <div class="floating-badge">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ __('Depuis 2019') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision, Mission, Devise -->
<section class="py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="vision-card h-100 text-center p-5 rounded-4 bg-primary text-white position-relative overflow-hidden">
                    <div class="card-decoration"></div>
                    <i class="fas fa-eye fa-3x mb-4 opacity-75"></i>
                    <h3 class="fw-bold mb-3">{{ __('Notre Vision') }}</h3>
                    <p class="lead">
                        {{ __('Un Cameroun où le développement est centré sur l\'être humain.') }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="mission-card h-100 text-center p-5 rounded-4 bg-secondary text-white position-relative overflow-hidden">
                    <div class="card-decoration"></div>
                    <i class="fas fa-bullseye fa-3x mb-4 opacity-75"></i>
                    <h3 class="fw-bold mb-3">{{ __('Notre Mission') }}</h3>
                    <p class="lead">
                        {{ __('Contribuer à l\'atteinte des objectifs du développement durable (ODD) au Cameroun.') }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="devise-card h-100 text-center p-5 rounded-4 bg-success text-white position-relative overflow-hidden">
                    <div class="card-decoration"></div>
                    <i class="fas fa-heart fa-3x mb-4 opacity-75"></i>
                    <h3 class="fw-bold mb-3">{{ __('Notre Devise') }}</h3>
                    <p class="lead">
                        {{ __('Au service de l\'autre.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Domaines d'Intervention avec Images -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="text-center mb-5">
            <span class="section-badge text-uppercase text-primary fw-bold">{{ __('Nos Expertises') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-4">{{ __('Domaines d\'Intervention') }}</h2>
            <p class="lead text-muted">{{ __('Six domaines clés pour un développement durable et inclusif') }}</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="domain-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                    <div class="domain-image">
                        <img src="{{ asset('images/droit.png') }}" alt="Droits Humains" class="img-fluid">
                        <div class="domain-overlay">
                            <i class="fas fa-balance-scale fa-2x"></i>
                        </div>
                    </div>
                    <div class="domain-content p-4">
                        <h5 class="fw-bold mb-3">{{ __('Droits Humains & Genre') }}</h5>
                        <p class="text-muted mb-3">{{ __('Promotion et protection des droits humains avec un focus sur l\'égalité des genres.') }}</p>
                        <div class="domain-features">
                            <small class="badge bg-light text-dark me-1">{{ __('Droits humains') }}</small>
                            <small class="badge bg-light text-dark">{{ __('Égalité genre') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="domain-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                    <div class="domain-image">
                        <img src="{{ asset('images/gouvernance.png') }}" alt="Gouvernance" class="img-fluid">
                        <div class="domain-overlay">
                            <i class="fas fa-gavel fa-2x"></i>
                        </div>
                    </div>
                    <div class="domain-content p-4">
                        <h5 class="fw-bold mb-3">{{ __('Gouvernance & Ressources') }}</h5>
                        <p class="text-muted mb-3">{{ __('Gouvernance et gestion durable et inclusive des ressources naturelles.') }}</p>
                        <div class="domain-features">
                            <small class="badge bg-light text-dark me-1">{{ __('Gouvernance') }}</small>
                            <small class="badge bg-light text-dark">{{ __('Ressources') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="domain-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                    <div class="domain-image">
                        <img src="{{ asset('images/climat.jpg') }}" alt="Climat" class="img-fluid">
                        <div class="domain-overlay">
                            <i class="fas fa-thermometer-half fa-2x"></i>
                        </div>
                    </div>
                    <div class="domain-content p-4">
                        <h5 class="fw-bold mb-3">{{ __('Changements Climatiques') }}</h5>
                        <p class="text-muted mb-3">{{ __('Lutte contre le changement climatique et promotion de l\'efficacité énergétique.') }}</p>
                        <div class="domain-features">
                            <small class="badge bg-light text-dark me-1">{{ __('Climat') }}</small>
                            <small class="badge bg-light text-dark">{{ __('Énergie') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="domain-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                    <div class="domain-image">
                        <img src="{{ asset('images/bio.jpg') }}" alt="Biodiversité" class="img-fluid">
                        <div class="domain-overlay">
                            <i class="fas fa-leaf fa-2x"></i>
                        </div>
                    </div>
                    <div class="domain-content p-4">
                        <h5 class="fw-bold mb-3">{{ __('Biodiversité') }}</h5>
                        <p class="text-muted mb-3">{{ __('Protection de la biodiversité et des services écosystémiques.') }}</p>
                        <div class="domain-features">
                            <small class="badge bg-light text-dark me-1">{{ __('Biodiversité') }}</small>
                            <small class="badge bg-light text-dark">{{ __('Écosystèmes') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="domain-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                    <div class="domain-image">
                        <img src="{{ asset('images/eau.jpg') }}" alt="Eau" class="img-fluid">
                        <div class="domain-overlay">
                            <i class="fas fa-tint fa-2x"></i>
                        </div>
                    </div>
                    <div class="domain-content p-4">
                        <h5 class="fw-bold mb-3">{{ __('Eau & Assainissement') }}</h5>
                        <p class="text-muted mb-3">{{ __('Accès à l\'eau potable, hygiène et assainissement pour tous.') }}</p>
                        <div class="domain-features">
                            <small class="badge bg-light text-dark me-1">{{ __('Eau potable') }}</small>
                            <small class="badge bg-light text-dark">{{ __('Hygiène') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="domain-card h-100 rounded-4 overflow-hidden shadow-sm bg-white">
                    <div class="domain-image">
                        <img src="{{ asset('images/risque.png') }}" alt="Risques" class="img-fluid">
                        <div class="domain-overlay">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                    </div>
                    <div class="domain-content p-4">
                        <h5 class="fw-bold mb-3">{{ __('Gestion des Risques') }}</h5>
                        <p class="text-muted mb-3">{{ __('Réduction des risques de catastrophes et renforcement de la résilience.') }}</p>
                        <div class="domain-features">
                            <small class="badge bg-light text-dark me-1">{{ __('Prévention') }}</small>
                            <small class="badge bg-light text-dark">{{ __('Résilience') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Objectifs et Moyens d'Action -->
<section class="py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="objectives-section">
                    <span class="section-badge text-uppercase text-primary fw-bold">{{ __('Nos Ambitions') }}</span>
                    <h2 class="display-6 fw-bold text-dark mb-4">{{ __('Objectifs') }}</h2>
                    <div class="objectives-list">
                        <div class="objective-item mb-4">
                            <div class="objective-icon">
                                <i class="fas fa-handshake text-primary"></i>
                            </div>
                            <div class="objective-content">
                                <h6 class="fw-bold">{{ __('Accompagnement des pouvoirs publics') }}</h6>
                                <p class="text-muted mb-0">{{ __('Dans l\'élaboration, la mise en œuvre et le suivi des politiques publiques et projets de développement') }}</p>
                            </div>
                        </div>

                        <div class="objective-item mb-4">
                            <div class="objective-icon">
                                <i class="fas fa-users text-success"></i>
                            </div>
                            <div class="objective-content">
                                <h6 class="fw-bold">{{ __('Développement inclusif') }}</h6>
                                <p class="text-muted mb-0">{{ __('Contribuer au développement inclusif des communautés rurales') }}</p>
                            </div>
                        </div>

                        <div class="objective-item mb-4">
                            <div class="objective-icon">
                                <i class="fas fa-leaf text-success"></i>
                            </div>
                            <div class="objective-content">
                                <h6 class="fw-bold">{{ __('Gestion durable') }}</h6>
                                <p class="text-muted mb-0">{{ __('Contribuer à la gestion durable et inclusive des ressources naturelles') }}</p>
                            </div>
                        </div>

                        <div class="objective-item mb-4">
                            <div class="objective-icon">
                                <i class="fas fa-balance-scale text-warning"></i>
                            </div>
                            <div class="objective-content">
                                <h6 class="fw-bold">{{ __('Protection des droits') }}</h6>
                                <p class="text-muted mb-0">{{ __('Contribuer à la promotion et à la protection des droits humains') }}</p>
                            </div>
                        </div>

                        <div class="objective-item">
                            <div class="objective-icon">
                                <i class="fas fa-venus-mars text-danger"></i>
                            </div>
                            <div class="objective-content">
                                <h6 class="fw-bold">{{ __('Promotion du genre') }}</h6>
                                <p class="text-muted mb-0">{{ __('Promouvoir le genre dans les initiatives de développement') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="methods-section">
                    <span class="section-badge text-uppercase text-secondary fw-bold">{{ __('Notre Approche') }}</span>
                    <h2 class="display-6 fw-bold text-dark mb-4">{{ __('Moyens d\'Action') }}</h2>
                    <div class="methods-grid">
                        <div class="method-card mb-4">
                            <div class="method-header">
                                <i class="fas fa-bullhorn text-info"></i>
                                <h6 class="fw-bold">{{ __('Information & Sensibilisation') }}</h6>
                            </div>
                            <p class="text-muted small">{{ __('Éducation et sensibilisation des communautés') }}</p>
                        </div>

                        <div class="method-card mb-4">
                            <div class="method-header">
                                <i class="fas fa-microphone text-primary"></i>
                                <h6 class="fw-bold">{{ __('Plaidoyer') }}</h6>
                            </div>
                            <p class="text-muted small">{{ __('Défense et promotion des intérêts communautaires') }}</p>
                        </div>

                        <div class="method-card mb-4">
                            <div class="method-header">
                                <i class="fas fa-graduation-cap text-success"></i>
                                <h6 class="fw-bold">{{ __('Renforcement des Capacités') }}</h6>
                            </div>
                            <p class="text-muted small">{{ __('Formation et développement des compétences locales') }}</p>
                        </div>

                        <div class="method-card mb-4">
                            <div class="method-header">
                                <i class="fas fa-cogs text-warning"></i>
                                <h6 class="fw-bold">{{ __('Appui Technique') }}</h6>
                            </div>
                            <p class="text-muted small">{{ __('Assistance technique spécialisée') }}</p>
                        </div>

                        <div class="method-card">
                            <div class="method-header">
                                <i class="fas fa-search text-secondary"></i>
                                <h6 class="fw-bold">{{ __('Recherche-Action') }}</h6>
                            </div>
                            <p class="text-muted small">{{ __('Études et recherches appliquées') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container-fluid px-5 text-center">
        <h2 class="display-6 fw-bold mb-4">{{ __('Rejoignez notre mission') }}</h2>
        <p class="lead mb-4">
            {{ __('Ensemble, œuvrons pour un développement centré sur la personne humaine') }}
        </p>
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="{{ route('contact.index') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-envelope me-2"></i>{{ __('Nous contacter') }}
            </a>
            <a href="{{ route('contact.volunteer') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
            </a>
        </div>
    </div>
</section>

<style>
/* Hero Section Styles */
.about-hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('{{ asset("images/about-hero.jpg") }}') center/cover no-repeat;
    min-height: 70vh;
    display: flex;
    align-items: center;
    backdrop-filter: blur(2px);
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
        rgba(5, 150, 105, 0.7) 0%,
        rgba(16, 185, 129, 0.6) 50%,
        rgba(31, 41, 55, 0.8) 100%);
    z-index: 1;
}

.min-vh-60 {
    min-height: 60vh;
}

.hero-title, .hero-subtitle {
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
}

.stat-card {
    padding: 1rem;
    border-radius: 15px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
}

/* Section Badges */
.section-badge {
    font-size: 0.9rem;
    letter-spacing: 2px;
    display: block;
    margin-bottom: 1rem;
}

/* Timeline Styles */
.timeline-item {
    display: flex;
    align-items: flex-start;
    position: relative;
}

.timeline-marker {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-right: 1rem;
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 5px;
    top: 20px;
    width: 2px;
    height: calc(100% + 1rem);
    background: #e5e7eb;
}

/* Vision/Mission Cards */
.vision-card, .mission-card, .devise-card {
    position: relative;
    transition: transform 0.3s ease;
}

.vision-card:hover, .mission-card:hover, .devise-card:hover {
    transform: translateY(-10px);
}

.card-decoration {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    z-index: 0;
}

/* Domain Cards */
.domain-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.domain-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
}

.domain-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.domain-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.domain-card:hover .domain-image img {
    transform: scale(1.1);
}

.domain-overlay {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Objectives Section */
.objective-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem;
    border-radius: 10px;
    background: rgba(248, 250, 252, 0.5);
    transition: background 0.3s ease;
}

.objective-item:hover {
    background: rgba(248, 250, 252, 1);
}

.objective-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    font-size: 1.2rem;
}

/* Methods Section */
.method-card {
    padding: 1.5rem;
    border-radius: 10px;
    background: white;
    border: 1px solid rgba(0, 0, 0, 0.05);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.method-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transform: translateY(-3px);
}

.method-header {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.method-header i {
    margin-right: 0.75rem;
    font-size: 1.2rem;
}

.method-header h6 {
    margin: 0;
}

/* Image Gallery */
.image-gallery {
    position: relative;
}

.main-image {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
}

.floating-badge {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
}

.floating-badge i {
    margin-right: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-hero-section {
        min-height: 60vh;
    }

    .display-3 {
        font-size: 2.5rem !important;
    }

    .display-5 {
        font-size: 2rem !important;
    }

    .display-6 {
        font-size: 1.5rem !important;
    }

    .vision-card, .mission-card, .devise-card {
        padding: 2rem !important;
    }

    .domain-image {
        height: 150px;
    }

    .objective-item, .method-card {
        padding: 1rem !important;
    }

    .timeline-item {
        margin-bottom: 2rem;
    }

    .hero-stats {
        margin-top: 3rem !important;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding-left: 20px !important;
        padding-right: 20px !important;
    }

    .hero-title {
        font-size: 2rem !important;
    }

    .hero-subtitle {
        font-size: 1.1rem !important;
    }

    .vision-card, .mission-card, .devise-card {
        padding: 1.5rem !important;
        margin-bottom: 2rem;
    }

    .domain-image {
        height: 120px;
    }

    .stat-card h3 {
        font-size: 2rem !important;
    }

    .objective-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .floating-badge {
        bottom: 10px;
        left: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.7);
    }
}

/* Animation d'entrée */
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

.domain-card, .objective-item, .method-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Effets de survol spéciaux */
.vision-card::before, .mission-card::before, .devise-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.vision-card:hover::before, .mission-card:hover::before, .devise-card:hover::before {
    opacity: 1;
}

.vision-card > *, .mission-card > *, .devise-card > * {
    position: relative;
    z-index: 2;
}

/* Styles supplémentaires pour l'accessibilité */
.domain-card:focus, .objective-item:focus, .method-card:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Amélioration des badges */
.domain-features .badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 15px;
    background: rgba(5, 150, 105, 0.1) !important;
    color: var(--primary-color) !important;
    border: 1px solid rgba(5, 150, 105, 0.2);
}

/* Style pour les listes d'objectifs */
.objectives-list {
    position: relative;
}

.objectives-list::before {
    content: '';
    position: absolute;
    left: 24px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, var(--primary-color), transparent);
    opacity: 0.3;
}

/* Animation au survol des cartes méthodes */
.method-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.method-card:hover::after {
    opacity: 1;
}

/* Amélioration de la timeline */
.timeline-content {
    flex: 1;
}

.timeline-content h6 {
    margin-bottom: 0.5rem;
}

.key-info {
    position: relative;
    overflow: hidden;
}

.key-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--primary-color);
}

/* Styles pour les icônes de domaines */
.domain-overlay i {
    transition: transform 0.3s ease;
}

.domain-card:hover .domain-overlay i {
    transform: scale(1.2);
}

/* Gradient text effect pour les titres principaux */
.gradient-text {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Ajout d'une bordure animée pour les cartes de domaine */
.domain-card {
    position: relative;
    overflow: hidden;
}

.domain-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
    transition: left 0.5s ease;
}

.domain-card:hover::before {
    left: 100%;
}
</style>

@endsection
