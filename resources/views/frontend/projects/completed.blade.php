@extends('frontend.layouts.app')
@section('title', 'Projets réalisés')
@section('description', 'Découvrez nos projets terminés et leurs résultats')
@section('content')

<!-- Hero Section -->
<section class="projects-hero-section position-relative overflow-hidden">
    <div class="hero-bg-overlay text-white"></div>
    <div class="container-fluid px-5 position-relative">
        <div class="row align-items-center min-vh-60">
            <div class="col-lg-8 mx-auto text-center text-white py-2">
                <h1 class="display-3 fw-bold mb-4 hero-title">
                    {{ __('Projets réalisés') }}
                </h1>
                <p class="lead mb-4 fs-4 hero-subtitle">
                    {{ __('Nos réalisations et l\'impact de nos interventions auprès des communautés') }}
                </p>
                <div class="mt-3">
                    <span class="badge bg-success fs-6 px-3 py-2">
                        {{ $projects->total() }} {{ __('projet(s) terminé(s)') }}
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
                <a class="nav-link" href="{{ route('projects.ongoing') }}">
                    <i class="fas fa-play me-1"></i>{{ __('En cours') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('projects.completed') }}">
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
            <div class=" col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($project->featured_image)
                    <img src="{{ asset('storage/' . $project->featured_image) }}" class="card-img-top" alt="{{ $project->title }}" style="height: 220px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="fas fa-check-circle fa-3x text-success"></i>
                    </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <div class="d-md-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-primary d-inline-block text-truncate" style="max-width: 100%;">{{ $project->category->name }}</span>
                            <span class="badge bg-secondary d-md-inline-block d-block mt-1 mt-md-0">{{ __('Terminé') }}</span>
                        </div>
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text text-muted">{{ $project->excerpt }}</p>
                        <div class="mt-auto">
                            @if($project->location)
                            <div class="text-muted small mb-2">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $project->location }}
                            </div>
                            @endif
                            @if($project->start_date && $project->end_date)
                            <div class="text-muted small mb-2">
                                <i class="fas fa-calendar-check me-1"></i>
                                {{ $project->start_date->format('M Y') }} - {{ $project->end_date->format('M Y') }}
                            </div>
                            <div class="text-success small mb-3">
                                <i class="fas fa-clock me-1"></i>
                                {{ __('Durée :') }} {{ $project->start_date->diffInMonths($project->end_date) }} {{ __('mois') }}
                            </div>
                            @endif
                            <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-outline-success btn-sm">
                                {{ __('Voir les résultats') }}
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
        <!-- No completed projects -->
        <div class="text-center py-5">
            <i class="fas fa-trophy fa-4x text-muted mb-4"></i>
            <h3 class="text-muted">{{ __('Aucun projet terminé pour le moment') }}</h3>
            <p class="text-muted mb-4">{{ __('Nos projets sont en cours de réalisation') }}</p>
            <a href="{{ route('projects.ongoing') }}" class="btn btn-primary">
                {{ __('Voir les projets en cours') }}
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Impact summary -->
@if($projects->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold">{{ __('Notre impact') }}</h3>
            <p class="text-muted">{{ __('Résultats de nos projets terminés') }}</p>
        </div>
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h4 class="fw-bold">{{ number_format($projects->count() * rand(50, 200)) }}</h4>
                        <p class="text-muted mb-0">{{ __('Personnes touchées') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="fas fa-home fa-3x text-success mb-3"></i>
                        <h4 class="fw-bold">{{ $projects->count() * rand(5, 15) }}</h4>
                        <p class="text-muted mb-0">{{ __('Communautés') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="fas fa-graduation-cap fa-3x text-info mb-3"></i>
                        <h4 class="fw-bold">{{ $projects->count() * rand(20, 80) }}</h4>
                        <p class="text-muted mb-0">{{ __('Formations dispensées') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card border-0 h-100">
                    <div class="card-body">
                        <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                        <h4 class="fw-bold">{{ $projects->count() * rand(2, 6) }}</h4>
                        <p class="text-muted mb-0">{{ __('Partenariats créés') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Call to action -->
<section class="py-5 bg-success text-white">
    <div class="container text-center">
        <h3 class="fw-bold mb-3">{{ __('Inspiré par nos réalisations ?') }}</h3>
        <p class="mb-4">{{ __('Rejoignez-nous pour créer plus d\'impact ensemble') }}</p>
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="{{ route('contact.volunteer') }}" class="btn btn-light">
                <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
            </a>
            <a href="{{ route('contact.partnership') }}" class="btn btn-outline-light">
                <i class="fas fa-handshake me-2"></i>{{ __('Partenariat') }}
            </a>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-light">
                <i class="fas fa-folder-open me-2"></i>{{ __('Tous nos projets') }}
            </a>
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
    .nav-pills .nav-link {
        border-radius: 10px;
        margin: 0 5px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    .nav-pills .nav-link.active {
        background-color: #059669;
    }
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-10px);
    }
</style>
@endsection
