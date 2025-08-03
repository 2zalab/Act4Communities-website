{{-- resources/views/frontend/team.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'Notre équipe')
@section('description', 'Découvrez l\'équipe d\'Act for Communities qui œuvre pour le développement communautaire au Cameroun')

@section('content')
<!-- Hero Section -->
<section class="team-hero-section position-relative overflow-hidden">
    <div class="hero-bg-overlay"></div>
    <div class="container-fluid px-5 position-relative">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center text-white py-3">
                <h1 class="display-3 fw-bold mb-4 hero-title">
                    {{ __('Notre Équipe') }}
                </h1>
                <p class="lead mb-4 fs-4 hero-subtitle">
                    {{ __('Rencontrez les personnes dévouées qui portent notre mission au quotidien') }}
                </p>

                <!-- Team Stats -->
                <div class="row justify-content-center mt-5">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">7</h3>
                            <p class="mb-0">{{ __('Membres permanents') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">15+</h3>
                            <p class="mb-0">{{ __('Bénévoles actifs') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">8</h3>
                            <p class="mb-0">{{ __('Consultants') }}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="stat-card">
                            <h3 class="display-6 fw-bold text-warning">5+</h3>
                            <p class="mb-0">{{ __('Stagiaires/an') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Direction -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="text-center mb-5">
            <span class="section-badge text-uppercase text-primary fw-bold">{{ __('Leadership') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-4">{{ __('Direction') }}</h2>
            <p class="lead text-muted">{{ __('L\'équipe dirigeante qui guide notre vision') }}</p>
        </div>

        <div class="row justify-content-center">
            <!-- Coordinatrice -->
            <div class="col-lg-5 col-md-8 mb-5">
                <div class="team-card-leader text-center position-relative">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/louise-angeline-lokumu.jpg')))
                            <img src="{{ asset('images/team/louise-angeline-lokumu.jpg') }}"
                                 alt="Louise Angeline LOKUMU"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="leader-badge">
                            <i class="fas fa-crown"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h3 class="fw-bold text-primary mb-1">Louise Angeline LOKUMU</h3>
                        <p class="position-title text-secondary fw-bold fs-5 mb-3">{{ __('Coordinatrice') }}</p>
                        <p class="team-description text-muted mb-4">
                            {{ __('Leader visionnaire avec une expertise en développement communautaire et en gouvernance participative. Elle guide l\'organisation vers l\'atteinte de ses objectifs stratégiques.') }}
                        </p>
                        <div class="team-actions">
                            <a href="mailto:louise@act4communities.org" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-envelope me-2"></i>{{ __('Contacter') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Équipe Opérationnelle -->
<section class="py-5">
    <div class="container-fluid px-5">
        <div class="text-center mb-5">
            <span class="section-badge text-uppercase text-secondary fw-bold">{{ __('Notre Force') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-4">{{ __('Équipe Opérationnelle') }}</h2>
            <p class="lead text-muted">{{ __('Les professionnels qui mettent en œuvre nos programmes') }}</p>
        </div>

        <div class="row">
            <!-- Coordinateur des programmes -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card h-100">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/christian-sonette-poro.jpg')))
                            <img src="{{ asset('images/team/christian-sonette-poro.jpg') }}"
                                 alt="Christian SONETTE PORO"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="role-badge bg-success">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="fw-bold text-dark mb-1">Christian SONETTE PORO</h5>
                        <p class="position-title text-success fw-bold mb-3">{{ __('Coordinateur des programmes') }}</p>
                        <p class="team-description text-muted small mb-3">
                            {{ __('Expert en gestion de projets et coordination d\'activités de développement communautaire.') }}
                        </p>
                        <div class="team-skills mb-3">
                            <span class="skill-badge">{{ __('Gestion de projets') }}</span>
                            <span class="skill-badge">{{ __('Coordination') }}</span>
                        </div>
                        <a href="mailto:christian@act4communities.org" class="btn btn-outline-success btn-sm rounded-pill">
                            <i class="fas fa-envelope me-1"></i>{{ __('Contacter') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Assistant Programmes 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card h-100">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/pierre-bertrand-ndzambana-zang.jpg')))
                            <img src="{{ asset('images/team/pierre-bertrand-ndzambana-zang.jpg') }}"
                                 alt="Pierre Bertrand NDZAMBANA ZANG"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="role-badge bg-info">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="fw-bold text-dark mb-1">Pierre Bertrand NDZAMBANA ZANG</h5>
                        <p class="position-title text-info fw-bold mb-3">{{ __('Assistant Programmes') }}</p>
                        <p class="team-description text-muted small mb-3">
                            {{ __('Spécialiste en appui technique et suivi-évaluation des programmes de développement.') }}
                        </p>
                        <div class="team-skills mb-3">
                            <span class="skill-badge">{{ __('Suivi-évaluation') }}</span>
                            <span class="skill-badge">{{ __('Appui technique') }}</span>
                        </div>
                        <a href="mailto:pierre@act4communities.org" class="btn btn-outline-info btn-sm rounded-pill">
                            <i class="fas fa-envelope me-1"></i>{{ __('Contacter') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Assistant Programmes 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card h-100">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/marie-therese-cynthia-dinogui.jpg')))
                            <img src="{{ asset('images/team/marie-therese-cynthia-dinogui.jpg') }}"
                                 alt="Marie Thérèse Cynthia DINOGUI"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="role-badge bg-warning">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="fw-bold text-dark mb-1">Marie Thérèse Cynthia DINOGUI</h5>
                        <p class="position-title text-warning fw-bold mb-3">{{ __('Assistante Programmes') }}</p>
                        <p class="team-description text-muted small mb-3">
                            {{ __('Experte en animation communautaire et mobilisation sociale pour les programmes de terrain.') }}
                        </p>
                        <div class="team-skills mb-3">
                            <span class="skill-badge">{{ __('Animation') }}</span>
                            <span class="skill-badge">{{ __('Mobilisation') }}</span>
                        </div>
                        <a href="mailto:marie@act4communities.org" class="btn btn-outline-warning btn-sm rounded-pill">
                            <i class="fas fa-envelope me-1"></i>{{ __('Contacter') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Responsable Communication -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card h-100">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/eliane-ndjiatsa-douanla.jpg')))
                            <img src="{{ asset('images/team/eliane-ndjiatsa-douanla.jpg') }}"
                                 alt="Eliane NDJIATSA DOUANLA"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="role-badge bg-purple">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="fw-bold text-dark mb-1">Eliane NDJIATSA DOUANLA</h5>
                        <p class="position-title text-purple fw-bold mb-3">{{ __('Responsable Communication') }}</p>
                        <p class="team-description text-muted small mb-3">
                            {{ __('Spécialiste en communication externe, relations médias et sensibilisation communautaire.') }}
                        </p>
                        <div class="team-skills mb-3">
                            <span class="skill-badge">{{ __('Communication') }}</span>
                            <span class="skill-badge">{{ __('Relations médias') }}</span>
                        </div>
                        <a href="mailto:eliane@act4communities.org" class="btn btn-outline-purple btn-sm rounded-pill">
                            <i class="fas fa-envelope me-1"></i>{{ __('Contacter') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Comptable -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card h-100">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/souleymanou-abdoul-aziz.jpg')))
                            <img src="{{ asset('images/team/souleymanou-abdoul-aziz.jpg') }}"
                                 alt="SOULEYMANOU ABDOUL-AZIZ"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="role-badge bg-dark">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="fw-bold text-dark mb-1">SOULEYMANOU ABDOUL-AZIZ</h5>
                        <p class="position-title text-dark fw-bold mb-3">{{ __('Comptable') }}</p>
                        <p class="team-description text-muted small mb-3">
                            {{ __('Expert en gestion financière et comptabilité des projets de développement.') }}
                        </p>
                        <div class="team-skills mb-3">
                            <span class="skill-badge">{{ __('Comptabilité') }}</span>
                            <span class="skill-badge">{{ __('Gestion financière') }}</span>
                        </div>
                        <a href="mailto:souleymanou@act4communities.org" class="btn btn-outline-dark btn-sm rounded-pill">
                            <i class="fas fa-envelope me-1"></i>{{ __('Contacter') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bénévole -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="team-card h-100 volunteer-card">
                    <div class="team-image-container">
                        @if(file_exists(public_path('images/team/amadou-ngomna.jpg')))
                            <img src="{{ asset('images/team/amadou-ngomna.jpg') }}"
                                 alt="AMADOU NGOMNA"
                                 class="team-photo">
                        @else
                            <div class="team-photo-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                        <div class="role-badge bg-gradient-volunteer">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="fw-bold text-dark mb-1">AMADOU NGOMNA</h5>
                        <p class="position-title text-volunteer fw-bold mb-3">{{ __('Bénévole') }}</p>
                        <p class="team-description text-muted small mb-3">
                            {{ __('Bénévole engagé qui apporte son expertise et son temps pour soutenir nos missions.') }}
                        </p>
                        <div class="team-skills mb-3">
                            <span class="skill-badge volunteer-badge">{{ __('Engagement') }}</span>
                            <span class="skill-badge volunteer-badge">{{ __('Support') }}</span>
                        </div>
                        <div class="volunteer-appreciation">
                            <small class="text-muted">
                                <i class="fas fa-star text-warning me-1"></i>{{ __('Merci pour votre dévouement') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bénévoles et Consultants -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="text-center mb-5">
            <span class="section-badge text-uppercase text-info fw-bold">{{ __('Notre Réseau') }}</span>
            <h2 class="display-5 fw-bold text-dark mb-4">{{ __('Bénévoles et Consultants') }}</h2>
            <p class="lead text-muted mb-5">
                {{ __('Notre organisation bénéficie de l\'appui de nombreux experts et bénévoles qui enrichissent nos capacités') }}
            </p>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card text-center h-100">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stats-number">15+</h3>
                    <p class="stats-label">{{ __('Bénévoles actifs') }}</p>
                    <p class="stats-description">{{ __('Personnes engagées qui donnent de leur temps') }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card text-center h-100">
                    <div class="stats-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="stats-number">8</h3>
                    <p class="stats-label">{{ __('Consultants experts') }}</p>
                    <p class="stats-description">{{ __('Spécialistes dans différents domaines') }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card text-center h-100">
                    <div class="stats-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="stats-number">5+</h3>
                    <p class="stats-label">{{ __('Stagiaires par an') }}</p>
                    <p class="stats-description">{{ __('Jeunes talents en formation') }}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stats-card text-center h-100">
                    <div class="stats-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3 class="stats-number">12</h3>
                    <p class="stats-label">{{ __('Partenaires locaux') }}</p>
                    <p class="stats-description">{{ __('Organisations collaboratrices') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container-fluid px-5 text-center">
        <h2 class="display-6 fw-bold mb-4">{{ __('Rejoignez notre équipe') }}</h2>
        <p class="lead mb-4">
            {{ __('Vous partagez nos valeurs et souhaitez contribuer au développement communautaire ?') }}
        </p>
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="{{ route('contact.volunteer') }}" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
            </a>
            <a href="{{ route('contact.partnership') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-handshake me-2"></i>{{ __('Collaboration') }}
            </a>
            <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-envelope me-2"></i>{{ __('Nous contacter') }}
            </a>
        </div>
    </div>
</section>

<style>
/* Hero Section */
.team-hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.4)),
                url('{{ asset("images/team/team-hero.jpg") }}') center/cover no-repeat;
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
        rgba(5, 150, 105, 0.8) 0%,
        rgba(16, 185, 129, 0.7) 50%,
        rgba(31, 41, 55, 0.9) 100%);
    z-index: 1;
}

.min-vh-50 {
    min-height: 50vh;
}

.hero-title, .hero-subtitle {
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
}

/* Section Badges */
.section-badge {
    font-size: 0.9rem;
    letter-spacing: 2px;
    display: block;
    margin-bottom: 1rem;
}

/* Stats Cards dans le Hero */
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

/* Team Cards */
.team-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.team-card-leader {
    background: white;
    border-radius: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
    padding: 3rem 2rem;
    transition: all 0.3s ease;
    border: 2px solid rgba(5, 150, 105, 0.1);
}

.team-card-leader:hover {
    transform: translateY(-15px);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
}

/* Team Images */
.team-image-container {
    position: relative;
    text-align: center;
    margin-bottom: 1.5rem;
}

.team-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.team-card-leader .team-photo {
    width: 150px;
    height: 150px;
    border: 5px solid var(--primary-color);
}

.team-photo-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: white;
    font-size: 2.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.team-card-leader .team-photo-placeholder {
    width: 150px;
    height: 150px;
    font-size: 3rem;
}

/* Role Badges */
.role-badge {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.leader-badge {
    position: absolute;
    top: -10px;
    right: 10px;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    animation: pulse 2s infinite;
}

/* Team Info */
.team-info {
    padding: 1.5rem;
    text-align: center;
}

.position-title {
    font-size: 1rem;
    margin-bottom: 1rem;
}

.team-description {
    line-height: 1.6;
    margin-bottom: 1rem;
}

/* Skills Badges */
.team-skills {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
}

.skill-badge {
    background: rgba(5, 150, 105, 0.1);
    color: var(--primary-color);
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
    border: 1px solid rgba(5, 150, 105, 0.2);
}

.volunteer-badge {
    background: rgba(220, 38, 127, 0.1);
    color: #dc267f;
    border-color: rgba(220, 38, 127, 0.2);
}

/* Volunteer Card Special Styling */
.volunteer-card {
    background: linear-gradient(135deg, rgba(220, 38, 127, 0.05), rgba(255, 255, 255, 1));
    border: 2px solid rgba(220, 38, 127, 0.1);
}

.volunteer-card:hover {
    border-color: rgba(220, 38, 127, 0.3);
}

.bg-gradient-volunteer {
    background: linear-gradient(135deg, #dc267f, #ff6b9d);
}

.text-volunteer {
    color: #dc267f;
}

.btn-outline-purple {
    color: #6f42c1;
    border-color: #6f42c1;
}

.btn-outline-purple:hover {
    background-color: #6f42c1;
    color: white;
}

.text-purple {
    color: #6f42c1;
}

.bg-purple {
    background-color: #6f42c1;
}

/* Stats Cards */
.stats-card {
    background: white;
    border-radius: 20px;
    padding: 2rem 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.stats-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
    box-shadow: 0 10px 30px rgba(5, 150, 105, 0.3);
}

.stats-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stats-label {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

.stats-description {
    color: var(--text-light);
    font-size: 0.9rem;
    line-height: 1.4;
}

/* Volunteer Appreciation */
.volunteer-appreciation {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(220, 38, 127, 0.1);
}

/* Animations */
@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

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

.team-card, .stats-card {
    animation: fadeInUp 0.6s ease-out;
}

/* Breadcrumb */
.breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255, 255, 255, 0.7);
}

/* Button Enhancements */
.btn {
    transition: all 0.3s ease;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.btn-outline-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
}

.btn-outline-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.3);
}

.btn-outline-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
}

.btn-outline-dark:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(52, 58, 64, 0.3);
}

/* Responsive Design */
@media (max-width: 992px) {
    .team-hero-section {
        min-height: 50vh;
    }

    .display-3 {
        font-size: 2.5rem !important;
    }

    .display-5 {
        font-size: 2rem !important;
    }

    .team-card-leader {
        padding: 2rem 1.5rem;
    }

    .team-photo {
        width: 100px;
        height: 100px;
    }

    .team-card-leader .team-photo {
        width: 120px;
        height: 120px;
    }

    .team-photo-placeholder {
        width: 100px;
        height: 100px;
        font-size: 2rem;
    }

    .team-card-leader .team-photo-placeholder {
        width: 120px;
        height: 120px;
        font-size: 2.5rem;
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }

    .stats-number {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .team-hero-section {
        min-height: 40vh;
    }

    .display-3 {
        font-size: 2rem !important;
    }

    .hero-subtitle {
        font-size: 1.1rem !important;
    }

    .team-info {
        padding: 1rem;
    }

    .team-card-leader {
        padding: 1.5rem 1rem;
    }

    .stats-card {
        padding: 1.5rem 1rem;
    }

    .skill-badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.6rem;
    }

    .role-badge {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }

    .leader-badge {
        width: 35px;
        height: 35px;
        font-size: 1rem;
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

    .team-photo {
        width: 80px;
        height: 80px;
    }

    .team-card-leader .team-photo {
        width: 100px;
        height: 100px;
    }

    .team-photo-placeholder {
        width: 80px;
        height: 80px;
        font-size: 1.5rem;
    }

    .team-card-leader .team-photo-placeholder {
        width: 100px;
        height: 100px;
        font-size: 2rem;
    }

    .position-title {
        font-size: 0.9rem;
    }

    .team-description {
        font-size: 0.8rem;
    }

    .stats-number {
        font-size: 2rem;
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }
}

/* Focus States for Accessibility */
.team-card:focus,
.stats-card:focus {
    outline: 2px solid var(--primary-color);
    outline-offset: 2px;
}

/* Hover Effects for Images */
.team-photo:hover {
    transform: scale(1.05);
}

.team-photo-placeholder:hover {
    transform: scale(1.05);
}

/* Special Effects for Leader Card */
.team-card-leader::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.05), rgba(16, 185, 129, 0.05));
    border-radius: 30px;
    z-index: -1;
}

/* Enhanced Shadow Effects */
.team-card:hover .team-photo,
.team-card:hover .team-photo-placeholder {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.team-card-leader:hover .team-photo,
.team-card-leader:hover .team-photo-placeholder {
    box-shadow: 0 20px 50px rgba(5, 150, 105, 0.4);
}

/* Loading Animation for Images */
@keyframes shimmer {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: calc(200px + 100%) 0;
    }
}

.team-photo-placeholder {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    background-size: 200px 100%;
    background-repeat: no-repeat;
    animation: shimmer 1.5s infinite linear;
}

/* Print Styles */
@media print {
    .team-card,
    .stats-card {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ccc;
    }

    .btn {
        display: none;
    }

    .team-hero-section {
        background: none;
        color: black;
    }
}
</style>

@endsection
