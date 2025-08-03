@extends('frontend.layouts.app')
@section('title', 'Projets en cours')
@section('description', 'Découvrez nos projets actuellement en cours de réalisation')
@section('content')

<!-- Hero Section -->
<section class="projects-hero-section position-relative overflow-hidden">
    <div class="hero-bg-overlay text-white"></div>
    <div class="container-fluid px-5 position-relative">
        <div class="row align-items-center min-vh-60">
            <div class="col-lg-8 mx-auto text-center text-white py-2">
                <h1 class="display-3 fw-bold mb-4 hero-title">
                    {{ __('Projets en cours') }}
                </h1>
                <p class="lead mb-4 fs-4 hero-subtitle">
                    {{ __('Nos initiatives actuellement en cours de réalisation pour le développement des communautés') }}
                </p>
                <div class="mt-3">
                    <span class="badge bg-success fs-6 px-3 py-2">
                        {{ $projects->total() }} {{ __('projet(s) actif(s)') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Navigation tabs -->
<section class="py-3 bg-white border-bottom">
    <div class="container">
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.index') }}">
                    <i class="fas fa-th-large me-1"></i>{{ __('Tous') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('projects.ongoing') }}">
                    <i class="fas fa-play me-1"></i>{{ __('En cours') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('projects.completed') }}">
                    <i class="fas fa-check me-1"></i>{{ __('Réalisés') }}
                </a>
            </li>
        </ul>
    </div>
</section>

<!-- Projects Grid -->
<section class="py-5">
    <div class="container-fluid px-5">
        @if($projects->count() > 0)
        <div class="row">
            @foreach($projects as $project)
            <div class="col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($project->featured_image)
                    <img src="{{ asset('storage/' . $project->featured_image) }}" class="card-img-top" alt="{{ $project->title }}" style="height: 220px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="fas fa-project-diagram fa-3x text-muted"></i>
                    </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="d-md-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary d-inline-block text-truncate " style="max-width: 100%;">{{ $project->category->name }}</span>
                            <span class="badge bg-success d-md-inline-block d-block mt-1 mt-md-0">{{ __('En cours') }}</span>
                        </div>
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text text-muted">{{ $project->excerpt }}</p>
                        <div class="mt-auto">
                            @if($project->location)
                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $project->location }}
                            </div>
                            @endif
                            @if($project->start_date)
                            <div class="text-muted small mb-3">
                                <i class="fas fa-calendar me-1"></i>
                                {{ __('Démarré en') }} {{ $project->start_date->format('M Y') }}
                                @if($project->end_date)
                                - {{ __('Fin prévue') }} {{ $project->end_date->format('M Y') }}
                                @endif
                            </div>
                            @endif
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-primary btn-sm">
                                {{ __('Voir le projet') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination -->
        @if($projects->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $projects->links() }}
        </div>
        @endif
        @else
        <!-- No ongoing projects -->
        <div class="text-center py-5">
            <i class="fas fa-hourglass-half fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">{{ __('Aucun projet en cours actuellement') }}</h3>
            <p class="text-muted mb-4">{{ __('Nous préparons de nouvelles initiatives. Revenez bientôt !') }}</p>
            <a href="{{ route('projects.index') }}" class="btn btn-primary">
                {{ __('Voir tous nos projets') }}
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Call to action -->
@if($projects->count() > 0)
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">{{ __('Participez à nos projets en cours') }}</h3>
        <p class="mb-4">{{ __('Votre soutien nous aide à réaliser nos objectifs') }}</p>
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="{{ route('contact.volunteer') }}" class="btn btn-light">
                <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
            </a>
            <a href="{{ route('contact.partnership') }}" class="btn btn-outline-light">
                <i class="fas fa-handshake me-2"></i>{{ __('Partenariat') }}
            </a>
            <a href="{{ route('contact.index') }}" class="btn btn-outline-light">
                <i class="fas fa-envelope me-2"></i>{{ __('Nous contacter') }}
            </a>
        </div>
    </div>
</section>
@endif

<style>
    /* Hero Section */
    .projects-hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2)),
                    url('{{ asset("images/hero-slide-1.jpg") }}') center/cover no-repeat;
        min-height: 60vh;
        display: flex;
        align-items: center;
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
    }
    .hero-title, .hero-subtitle {
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.9), 1px 1px 3px rgba(0, 0, 0, 0.8);
        font-weight: 900;
        color: #ffffff !important;
    }
    .min-vh-60 {
        min-height: 60vh;
    }

    /* Navigation */
    .nav-pills .nav-link {
        border-radius: 10px;
        margin: 0 5px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link.active {
        background-color: #059669;
    }

    /* Card Styles */
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-10px);
    }

    /* Responsive adjustments */
    @media (min-width: 1200px) {
        .col-lg-4 {
            flex: 0 0 auto;
            width: 35%;
        }
    }
</style>
@endsection
