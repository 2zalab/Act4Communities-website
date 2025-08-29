{{-- resources/views/frontend/acd-lab.blade.php --}}
@extends('frontend.layouts.app')

@section('title', 'ACD Lab - Act4Communities')

@section('meta_description', 'ACD Lab est un espace de réflexion, de dialogue et de proposition pour des politiques publiques inclusives en matière de gouvernance des ressources naturelles, protection de l\'environnement, promotion et protection des droits humains et lutte contre les changements climatiques.')

@section('content')
<!-- Bannière de présentation -->
<section class="acd-lab-hero">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="container-fluid px-5 py-5">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <div class="hero-content">
                        <div class="hero-badge mb-4">
                            <span class="badge bg-primary bg-gradient px-4 py-2 fs-6">
                                <i class="fas fa-flask me-2"></i>Laboratoire de Recherche
                            </span>
                        </div>
                        <h1 class="display-3 fw-bold mb-4 hero-title">
                            ACD <span class="text-primary">Lab</span>
                        </h1>
                        <p class="lead fs-4 mb-5 hero-subtitle">
                            Un espace de réflexion, de dialogue et de proposition pour des politiques publiques inclusives en matière de gouvernance des ressources naturelles, protection de l'environnement, promotion et protection des droits humains et lutte contre les changements climatiques.
                        </p>
                        <div class="hero-cta">
                            <a href="#about" class="btn btn-primary btn-lg px-5 py-3 me-3">
                                <i class="fas fa-arrow-down me-2"></i>Découvrir nos travaux
                            </a>
                            <a href="#contact" class="btn btn-outline-light btn-lg px-5 py-3">
                                <i class="fas fa-envelope me-2"></i>Nous contacter
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Particules animées -->
        <div class="hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
    </div>
</section>

<!-- Domaines d'expertise -->
<section id="about" class="py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class=" mx-auto">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-4">Nos Domaines d'Expertise</h2>
                    <p class="lead text-muted">
                        ACD Lab intervient dans quatre axes stratégiques pour un développement durable et inclusif
                    </p>
                </div>

                <div class="row g-4">
                    <!-- Gouvernance des ressources naturelles -->
                    <div class="col-md-6">
                        <div class="expertise-card h-100">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="expertise-icon mb-3">
                                        <i class="fas fa-mountain text-success fa-3x"></i>
                                    </div>
                                    <h4 class="card-title text-success">Gouvernance des Ressources Naturelles</h4>
                                    <p class="card-text text-muted">
                                        Recherche et propositions de politiques pour une gestion durable et équitable des ressources naturelles, incluant les forêts, les mines, l'eau et les terres.
                                    </p>
                                    <ul class="list-unstyled small">
                                        <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Gestion forestière durable</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Exploitation minière responsable</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Gestion intégrée des ressources en eau</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Protection de l'environnement -->
                    <div class="col-md-6">
                        <div class="expertise-card h-100">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="expertise-icon mb-3">
                                        <i class="fas fa-leaf text-success fa-3x"></i>
                                    </div>
                                    <h4 class="card-title text-success">Protection de l'Environnement</h4>
                                    <p class="card-text text-muted">
                                        Développement de stratégies et politiques pour la conservation de la biodiversité et la protection des écosystèmes.
                                    </p>
                                    <ul class="list-unstyled small">
                                        <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Conservation de la biodiversité</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Restauration des écosystèmes</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>Aires protégées communautaires</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Droits humains -->
                    <div class="col-md-6">
                        <div class="expertise-card h-100">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="expertise-icon mb-3">
                                        <i class="fas fa-users text-primary fa-3x"></i>
                                    </div>
                                    <h4 class="card-title text-primary">Droits Humains</h4>
                                    <p class="card-text text-muted">
                                        Promotion et protection des droits fondamentaux avec un focus sur les droits environnementaux et des communautés locales.
                                    </p>
                                    <ul class="list-unstyled small">
                                        <li class="mb-1"><i class="fas fa-check-circle text-primary me-2"></i>Droits des peuples autochtones</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-primary me-2"></i>Justice environnementale</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-primary me-2"></i>Participation communautaire</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Changements climatiques -->
                    <div class="col-md-6">
                        <div class="expertise-card h-100">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4">
                                    <div class="expertise-icon mb-3">
                                        <i class="fas fa-thermometer-half text-warning fa-3x"></i>
                                    </div>
                                    <h4 class="card-title text-warning">Lutte contre les Changements Climatiques</h4>
                                    <p class="card-text text-muted">
                                        Recherche et développement de solutions d'adaptation et d'atténuation aux changements climatiques.
                                    </p>
                                    <ul class="list-unstyled small">
                                        <li class="mb-1"><i class="fas fa-check-circle text-warning me-2"></i>Stratégies d'adaptation</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-warning me-2"></i>Technologies vertes</li>
                                        <li class="mb-1"><i class="fas fa-check-circle text-warning me-2"></i>Réduction des émissions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre approche -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="approach-content">
                    <h2 class="display-6 fw-bold mb-4">Notre Approche</h2>
                    <p class="lead mb-4">
                        ACD Lab adopte une approche multidisciplinaire et participative pour développer des solutions durables et inclusives.
                    </p>

                    <div class="approach-steps">
                        <div class="step-item mb-4">
                            <div class="d-flex align-items-start">
                                <div class="step-number">
                                    <span class="badge bg-primary rounded-circle p-3">1</span>
                                </div>
                                <div class="step-content ms-3">
                                    <h5 class="fw-bold">Recherche & Analyse</h5>
                                    <p class="text-muted mb-0">Collecte et analyse de données pour comprendre les enjeux complexes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="step-item mb-4">
                            <div class="d-flex align-items-start">
                                <div class="step-number">
                                    <span class="badge bg-success rounded-circle p-3">2</span>
                                </div>
                                <div class="step-content ms-3">
                                    <h5 class="fw-bold">Dialogue Inclusif</h5>
                                    <p class="text-muted mb-0">Facilitation de discussions entre toutes les parties prenantes.</p>
                                </div>
                            </div>
                        </div>

                        <div class="step-item mb-4">
                            <div class="d-flex align-items-start">
                                <div class="step-number">
                                    <span class="badge bg-warning rounded-circle p-3">3</span>
                                </div>
                                <div class="step-content ms-3">
                                    <h5 class="fw-bold">Propositions Concrètes</h5>
                                    <p class="text-muted mb-0">Formulation de recommandations politiques pratiques et réalisables.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="approach-visual">
                    <div class="position-relative">
                        <div class="bg-primary rounded-4 p-5 text-white text-center approach-card">
                            <i class="fas fa-lightbulb fa-4x mb-4 opacity-75"></i>
                            <h4 class="fw-bold">Innovation & Impact</h4>
                            <p class="mb-0">Des solutions créatives pour des défis complexes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Contact -->
<section id="contact" class="py-5">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="mx-auto text-center">
                <h2 class="display-6 fw-bold mb-4">Collaborer avec ACD Lab</h2>
                <p class="lead text-muted mb-5">
                    Rejoignez notre réseau de chercheurs, décideurs et acteurs de la société civile pour construire ensemble un avenir plus durable et équitable.
                </p>

                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Partenariats</h5>
                            <p class="text-muted small">Collaborations institutionnelles et projets conjoints</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <i class="fas fa-graduation-cap fa-2x text-success"></i>
                            </div>
                            <h5 class="fw-bold">Recherche</h5>
                            <p class="text-muted small">Opportunités de recherche et bourses d'études</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="contact-item">
                            <div class="contact-icon mb-3">
                                <i class="fas fa-handshake fa-2x text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Consultation</h5>
                            <p class="text-muted small">Expertise et conseil en politiques publiques</p>
                        </div>
                    </div>
                </div>

                <div class="cta-buttons">
                    <a href="mailto:contact@act4communities.org" class="btn btn-primary btn-lg px-5 py-3 me-3">
                        <i class="fas fa-envelope me-2"></i>Contactez-nous
                    </a>
                    <a href="{{ route('resources.index') }}" class="btn btn-outline-primary btn-lg px-5 py-3">
                        <i class="fas fa-book me-2"></i>Nos Ressources
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Styles pour la bannière hero */
.acd-lab-hero {
    position: relative;
    overflow: hidden;
}

.hero-background {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    min-height: 100vh;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-title {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out;
}

.hero-subtitle {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    animation: fadeInUp 1s ease-out 0.3s both;
}

.hero-cta {
    animation: fadeInUp 1s ease-out 0.6s both;
}

.hero-badge {
    animation: fadeInUp 1s ease-out 0.1s both;
}

/* Particules animées */
.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.particle {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.particle:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.particle:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    left: 80%;
    animation-delay: 2s;
}

.particle:nth-child(3) {
    width: 60px;
    height: 60px;
    top: 80%;
    left: 10%;
    animation-delay: 4s;
}

.particle:nth-child(4) {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 80%;
    animation-delay: 1s;
}

.particle:nth-child(5) {
    width: 40px;
    height: 40px;
    top: 70%;
    left: 60%;
    animation-delay: 3s;
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

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

/* Cartes d'expertise */
.expertise-card {
    transition: all 0.3s ease;
}

.expertise-card:hover {
    transform: translateY(-5px);
}

.expertise-card .card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.expertise-card:hover .card {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.expertise-icon {
    transition: transform 0.3s ease;
}

.expertise-card:hover .expertise-icon {
    transform: scale(1.1);
}

/* Section approche */
.approach-card {
    transform: rotate(-5deg);
    transition: all 0.3s ease;
}

.approach-card:hover {
    transform: rotate(0deg) scale(1.05);
}

.step-number .badge {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: bold;
}

.step-item {
    opacity: 0;
    animation: slideInLeft 0.8s ease-out forwards;
}

.step-item:nth-child(1) { animation-delay: 0.2s; }
.step-item:nth-child(2) { animation-delay: 0.4s; }
.step-item:nth-child(3) { animation-delay: 0.6s; }

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Section contact */
.contact-item {
    transition: all 0.3s ease;
    padding: 1.5rem;
    border-radius: 10px;
}

.contact-item:hover {
    background: rgba(0, 0, 0, 0.02);
    transform: translateY(-3px);
}

.contact-icon {
    transition: transform 0.3s ease;
}

.contact-item:hover .contact-icon {
    transform: scale(1.2);
}

/* Utilitaires */
.min-vh-75 {
    min-height: 75vh;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-background {
        min-height: 80vh;
    }

    .display-3 {
        font-size: 2.5rem;
    }

    .hero-cta .btn {
        display: block;
        margin-bottom: 1rem;
        margin-right: 0 !important;
    }

    .approach-card {
        transform: none;
        margin-top: 2rem;
    }
}
</style>

<script>
// Smooth scrolling pour les liens d'ancrage
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Animation au scroll pour les éléments
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observer les cartes d'expertise
document.querySelectorAll('.expertise-card').forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = `all 0.6s ease ${index * 0.2}s`;
    observer.observe(card);
});
</script>
@endsection
