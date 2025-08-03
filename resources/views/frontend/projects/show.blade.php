{{-- resources/views/frontend/projects/show.blade.php --}}
@extends('frontend.layouts.app')

@section('title', $project->title)
@section('description', $project->excerpt)

@push('styles')
<style>
     .section-title {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;

        border-image: linear-gradient(to right, var(--primary-color), var(--secondary-color)) 1;
    }

    .title-text {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
    }

    .project-header {
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                    url('{{ $project->featured_image ? asset("storage/" . $project->featured_image) : asset("images/default-project.jpg") }}');
        background-size: cover;
        background-position: center;
        min-height: 450px;
        color: white;
        display: flex;
        align-items: center;
    }

    .project-meta-card {
        background: rgba(255,255,255,0.98);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 2rem;
        margin-top: -4rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .objective-item, .result-item {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-left: 4px solid var(--primary-color);
        padding: 1.2rem;
        margin-bottom: 1rem;
        border-radius: 0 10px 10px 0;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .objective-item:hover, .result-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .timeline {
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 1rem;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 2rem;
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        margin-left: 1rem;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -2.5rem;
        top: 1.5rem;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 3px var(--primary-color);
    }

    .progress-bar-custom {
        height: 8px;
        border-radius: 10px;
        background: #e9ecef;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border-radius: 10px;
        transition: width 0.8s ease;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .gallery-item {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    .gallery-item img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .share-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .share-btn {
        padding: 8px 16px;
        border-radius: 25px;
        text-decoration: none;
        color: white;
        font-size: 14px;
        transition: transform 0.2s;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        color: white;
    }

    .share-btn.facebook { background: #1877f2; }
    .share-btn.twitter { background: #000000; }
    .share-btn.linkedin { background: #0077b5; }
    .share-btn.whatsapp { background: #25d366; }

    .impact-counter {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-color));
        color: white;
        border-radius: 15px;
        margin-bottom: 1rem;
    }

    .impact-number {
        font-size: 2.5rem;
        font-weight: bold;
        display: block;
    }

    .sidebar-card {
        border: none;
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .sidebar-card .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 1rem 1.5rem;
    }

    .related-project-item {
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        background: #f8f9fa;
        transition: background 0.2s;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .related-project-item:hover {
        background: #e9ecef;
        color: inherit;
        text-decoration: none;
    }

    .breadcrumb-custom {
        background: rgba(255,255,255,0.9);
        border-radius: 25px;
        padding: 0.5rem 1rem;
        backdrop-filter: blur(5px);
    }

    .btn-custom {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    @media (max-width: 768px) {
        .project-header {
            min-height: 300px;
            text-align: center;
        }

        .project-meta-card {
            margin-top: -2rem;
            padding: 1.5rem;
        }

        .timeline {
            padding-left: 1rem;
        }

        .timeline-item {
            margin-left: 0.5rem;
        }
    }
</style>
@endpush

@section('content')
<!-- Project Header -->
<section class="project-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!--nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="fas fa-home me-1"></i>{{ __('Accueil') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('projects.index') }}" class="text-decoration-none">
                                {{ __('Projets') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ Str::limit($project->title, 40) }}</li>
                    </ol>
                </nav-->

                <div class="mb-3 py-4">
                    <span class="badge bg-primary me-2 px-3 py-2 text-truncate d-inline-block" style="max-width: 100%;" title="{{ $project->category->name }}">
                        <i class="{{ $project->category->icon }} me-1"></i>
                        {{ $project->category->name }}
                    </span>
                    <span class="badge {{ $project->status_badge }} px-3 py-2">
                        @if($project->status == 'active')
                            <i class="fas fa-play me-1"></i>{{ __('En cours') }}
                        @elseif($project->status == 'completed')
                            <i class="fas fa-check-circle me-1"></i>{{ __('Terminé') }}
                        @else
                            <i class="fas fa-pause me-1"></i>{{ __('Suspendu') }}
                        @endif
                    </span>
                </div>

                <h1 class="display-4 fw-bold mb-4">{{ $project->title }}</h1>
                <p class="lead mb-4">{{ $project->excerpt }}</p>

                @if($project->location)
                <p class="mb-2">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <strong>{{ $project->location }}</strong>
                </p>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Project Meta Information -->
<section class="py-5">
    <div class="container-fluid px-5">
        <div class="project-meta-card">
            <div class="row text-center">
                <div class="col-lg-2 col-md-4 col-6 mb-3">
                    <div class="impact-counter">
                        <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                        <span class="impact-number">
                            @if($project->start_date && $project->end_date)
                                {{ $project->start_date->diffInMonths($project->end_date) }}
                            @else
                                ∞
                            @endif
                        </span>
                        <small>{{ __('Mois') }}</small>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-3">
                    <div class="impact-counter">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <span class="impact-number">{{ rand(50, 500) }}</span>
                        <small>{{ __('Bénéficiaires') }}</small>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-3">
                    <div class="impact-counter">
                        <i class="fas fa-coins fa-2x mb-2"></i>
                        <span class="impact-number">
                            @if($project->budget)
                                {{ number_format($project->budget / 1000000, 1) }}M
                            @else
                                N/A
                            @endif
                        </span>
                        <small>{{ __('FCFA') }}</small>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-3">
                    <div class="impact-counter">
                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                        <span class="impact-number">
                            @if($project->status == 'completed')
                                100
                            @elseif($project->status == 'active')
                                {{ rand(30, 85) }}
                            @else
                                0
                            @endif
                        </span>
                        <small>{{ __('% Avancement') }}</small>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-3">
                    <div class="impact-counter">
                        <i class="fas fa-handshake fa-2x mb-2"></i>
                        <span class="impact-number">{{ rand(3, 8) }}</span>
                        <small>{{ __('Partenaires') }}</small>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 col-6 mb-3">
                    <div class="impact-counter">
                        <i class="fas fa-star fa-2x mb-2"></i>
                        <span class="impact-number">{{ number_format(rand(40, 50)/10, 1) }}</span>
                        <small>{{ __('Impact Score') }}</small>
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            @php
                $progress = $project->status == 'completed' ? 100 : ($project->status == 'active' ? rand(30, 85) : 0);
            @endphp
            <div class="mt-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold">{{ __('Progression du projet') }}</span>
                    <span class="badge bg-primary">{{ $progress }}%</span>
                </div>
                <div class="progress-bar-custom">
                    <div class="progress-bar-fill" style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Project Content -->
<section class="py-5 bg-light">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Description -->
                <div class="mb-5">
                    <h2 class="section-title">
                        <i class="fas fa-info-circle me-2" style="color: var(--primary-color);"></i>
                        <span class="title-text">{{ __('Description du projet') }}</span>
                    </h2>
                    <div class="content p-4" style="background: rgba(255,255,255,0.98); border-radius: 0px; box-shadow: 0 0px 0px rgba(0,0,0,0.1);">
                        {!! $project->description !!}
                    </div>
                </div>


                <!-- Timeline -->
                @if($project->start_date || $project->end_date)
                <div class="mb-5">
                    <h2 class="section-title">
                        <i class="fas fa-clock me-2" style="color: var(--primary-color);"></i>
                        <span class="title-text">{{ __('Chronologie du projet') }}</span>
                    </h2>
                    <div class=" p-4" style="background: rgba(255,255,255,0.98); border-radius: 0px; box-shadow: 0 0px 0px rgba(0,0,0,0.1);">

                    <div class="card-body">
                        <div class="timeline">
                            @if($project->start_date)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="text-primary">{{ __('Lancement du projet') }}</h5>
                                        <p class="mb-0">{{ __('Début officiel des activités du projet') }}</p>
                                    </div>
                                    <span class="badge bg-primary">{{ $project->start_date->format('M Y') }}</span>
                                </div>
                            </div>
                            @endif

                            @if($project->status == 'active')
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="text-warning">{{ __('Phase actuelle') }}</h5>
                                        <p class="mb-0">{{ __('Mise en œuvre des activités principales') }}</p>
                                    </div>
                                    <span class="badge bg-warning">{{ __('En cours') }}</span>
                                </div>
                            </div>
                            @endif

                            @if($project->end_date)
                            <div class="timeline-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="{{ $project->status == 'completed' ? 'text-success' : 'text-muted' }}">
                                            {{ __('Fin du projet') }}
                                        </h5>
                                        <p class="mb-0">{{ __('Clôture et évaluation finale') }}</p>
                                    </div>
                                    <span class="badge {{ $project->status == 'completed' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $project->end_date->format('M Y') }}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

                <!-- Objectives -->
                @if($project->objectives && count($project->objectives) > 0)
                <div class="mb-5">
                    <h2 class="section-title">
                        <i class="fas fa-bullseye me-2" style="color: var(--primary-color);"></i>
                        <span class="title-text">{{ __('Objectifs du projet') }}</span>
                    </h2>
                    <div class="p-4" style="background: rgba(255,255,255,0.98); border-radius: 0px; box-shadow: 0 0px 0px rgba(0,0,0,0.1);">
                        @foreach($project->objectives as $index => $objective)
                        <div class="objective-item">
                            <div class="d-flex align-items-start">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                     style="width: 30px; height: 30px; flex-shrink: 0;">
                                    <small class="fw-bold">{{ $index + 1 }}</small>
                                </div>
                                <div>
                                    <p class="mb-0 fw-medium">{{ $objective }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Expected Results -->
                @if($project->expected_results && count($project->expected_results) > 0)
                <div class="mb-5">
                    <h2 class="section-title">
                        <i class="fas fa-check-circle me-2" style="color: var(--primary-color);"></i>
                        <span class="title-text">{{ __('Résultats attendus') }}</span>
                    </h2>
                    <div class="p-4" style="background: rgba(255,255,255,0.98); border-radius: 0px; box-shadow: 0 0px 0px rgba(0,0,0,0.1);">
                        @foreach($project->expected_results as $result)
                        <div class="result-item">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-arrow-right text-success me-3 mt-1"></i>
                                <p class="mb-0">{{ $result }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Gallery -->
                @if($project->gallery && count($project->gallery) > 0)
                <div class="card sidebar-card mb-5">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-images me-2"></i>{{ __('Galerie photos') }}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="gallery-grid">
                            @foreach($project->gallery as $index => $image)
                            <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#imageModal{{ $index }}">
                                <img src="{{ asset('storage/' . $image) }}" alt="Galerie {{ $project->title }}" class="img-fluid">
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                     style="background: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.3s;">
                                    <i class="fas fa-search-plus fa-2x text-white"></i>
                                </div>
                            </div>

                            <!-- Modal pour chaque image -->
                            <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid w-100" alt="Galerie {{ $project->title }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Share Section -->
                <div class="mb-5">
                    <h2 class="section-title">
                        <i class="fas fa-share-alt me-2" style="color: var(--primary-color);"></i>
                        <span class="title-text">{{ __('Partager ce projet') }}</span>
                    </h2>
                    <div class="p-4" style="background: rgba(255,255,255,0.98); border-radius: 0px; box-shadow: 0 0px 0px rgba(0,0,0,0.1);">
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                               target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook-f me-1"></i>
                            </a>
                            <a href="https://x.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($project->title) }}"
                               target="_blank" class="share-btn twitter">
                                <i class="fab fa-x me-1"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}"
                               target="_blank" class="share-btn linkedin">
                                <i class="fab fa-linkedin-in me-1"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($project->title . ' - ' . request()->fullUrl()) }}"
                               target="_blank" class="share-btn whatsapp">
                                <i class="fab fa-whatsapp me-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Project Details -->
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>{{ __('Détails du projet') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-5">{{ __('Statut') }} :</dt>
                            <dd class="col-sm-7">
                                <span class="badge {{ $project->status_badge }}">
                                    @if($project->status == 'active')
                                        {{ __('En cours') }}
                                    @elseif($project->status == 'completed')
                                        {{ __('Terminé') }}
                                    @else
                                        {{ __('Suspendu') }}
                                    @endif
                                </span>
                            </dd>

                            <dt class="col-sm-5">{{ __('Catégorie') }} :</dt>
                            <dd class="col-sm-7">
                                <span class="badge bg-primary d-inline-block" style="max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    {{ Str::limit($project->category->name) }}
                                </span>
                            </dd>

                            @if($project->location)
                            <dt class="col-sm-5">{{ __('Lieu') }} :</dt>
                            <dd class="col-sm-7">{{ $project->location }}</dd>
                            @endif

                            @if($project->start_date)
                            <dt class="col-sm-5">{{ __('Début') }} :</dt>
                            <dd class="col-sm-7">{{ $project->start_date->format('d/m/Y') }}</dd>
                            @endif

                            @if($project->end_date)
                            <dt class="col-sm-5">{{ __('Fin') }} :</dt>
                            <dd class="col-sm-7">{{ $project->end_date->format('d/m/Y') }}</dd>
                            @endif

                            @if($project->budget)
                            <dt class="col-sm-5">{{ __('Budget') }} :</dt>
                            <dd class="col-sm-7">{{ number_format($project->budget, 0, ',', ' ') }} FCFA</dd>
                            @endif
                        </dl>

                        <hr>

                        <div class="text-center">
                            <h6 class="fw-bold mb-3">{{ __('Intéressé par ce projet ?') }}</h6>
                            <div class="d-grid gap-2">
                                <a href="{{ route('contact.index') }}" class="btn btn-primary btn-custom">
                                    <i class="fas fa-envelope me-2"></i>{{ __('Nous contacter') }}
                                </a>
                                <a href="{{ route('contact.volunteer') }}" class="btn btn-success btn-custom">
                                    <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Participer') }}
                                </a>
                                <a href="{{ route('contact.partnership') }}" class="btn btn-info btn-custom">
                                    <i class="fas fa-handshake me-2"></i>{{ __('Partenariat') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Projects -->
                @if($relatedProjects->count() > 0)
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-project-diagram me-2"></i>{{ __('Projets similaires') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedProjects as $related)
                        <a href="{{ route('projects.show', $related->slug) }}" class="related-project-item">
                            <div class="d-flex align-items-start">
                                @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}"
                                     class="me-3 rounded" width="60" height="60" style="object-fit: cover;">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ Str::limit($related->title, 50) }}</h6>
                                    <p class="small text-muted mb-1">{{ Str::limit($related->excerpt, 80) }}</p>
                                    <span class="badge {{ $related->status_badge }} small">
                                        @if($related->status == 'active')
                                            {{ __('En cours') }}
                                        @elseif($related->status == 'completed')
                                            {{ __('Terminé') }}
                                        @else
                                            {{ __('Suspendu') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </a>
                        @endforeach

                        <div class="text-center mt-3">
                            <a href="{{ route('projects.index') }}" class="btn btn-outline-primary btn-sm btn-custom">
                                {{ __('Voir tous les projets') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Contact Information -->
                <div class="card sidebar-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-phone me-2"></i>{{ __('Contact direct') }}
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="mb-3">{{ __('Questions sur ce projet ?') }}</p>

                        <div class="d-grid gap-2">
                            <a href="tel:+237696740438" class="btn btn-outline-success btn-sm btn-custom">
                                <i class="fas fa-phone me-2"></i>+237 696 740 438
                            </a>
                            <a href="mailto:contact@actforcommunities.org" class="btn btn-outline-primary btn-sm btn-custom">
                                <i class="fas fa-envelope me-2"></i>Email direct
                            </a>
                        </div>

                        <hr>

                        <div class="small text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i>
                            Garoua / Marouaré, Cameroun
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">{{ __('Soutenez nos actions !') }}</h2>
        <p class="lead mb-4">
            {{ __('Chaque projet compte dans notre mission de développement communautaire. Rejoignez-nous !') }}
        </p>
        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="{{ route('contact.volunteer') }}" class="btn btn-light btn-lg btn-custom">
                <i class="fas fa-hand-holding-heart me-2"></i>{{ __('Devenir bénévole') }}
            </a>
            <a href="{{ route('contact.partnership') }}" class="btn btn-outline-light btn-lg btn-custom">
                <i class="fas fa-handshake me-2"></i>{{ __('Partenariat') }}
            </a>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-light btn-lg btn-custom">
                <i class="fas fa-folder-open me-2"></i>{{ __('Autres projets') }}
            </a>
        </div>
    </div>
</section>

<!-- Navigation entre projets -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                @php
                    $prevProject = \App\Models\Project::where('is_published', true)
                                                    ->where('id', '<', $project->id)
                                                    ->orderBy('id', 'desc')
                                                    ->first();
                @endphp
                @if($prevProject)
                <a href="{{ route('projects.show', $prevProject->slug) }}"
                   class="btn btn-outline-secondary btn-custom d-flex align-items-center">
                    <i class="fas fa-arrow-left me-2"></i>
                    <div class="text-start">
                        <div class="small">{{ __('Projet précédent') }}</div>
                        <div class="fw-bold">{{ Str::limit($prevProject->title, 30) }}</div>
                    </div>
                </a>
                @endif
            </div>

            <div class="col-md-4 text-center">
                <a href="{{ route('projects.index') }}" class="btn btn-primary btn-custom">
                    <i class="fas fa-th-large me-2"></i>{{ __('Tous les projets') }}
                </a>
            </div>

            <div class="col-md-4 text-end">
                @php
                    $nextProject = \App\Models\Project::where('is_published', true)
                                                    ->where('id', '>', $project->id)
                                                    ->orderBy('id', 'asc')
                                                    ->first();
                @endphp
                @if($nextProject)
                <a href="{{ route('projects.show', $nextProject->slug) }}"
                   class="btn btn-outline-secondary btn-custom d-flex align-items-center justify-content-end">
                    <div class="text-end me-2">
                        <div class="small">{{ __('Projet suivant') }}</div>
                        <div class="fw-bold">{{ Str::limit($nextProject->title, 30) }}</div>
                    </div>
                    <i class="fas fa-arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Animation des compteurs d'impact
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.impact-number');

    const animateCounter = (counter) => {
        const target = parseFloat(counter.textContent.replace(/[^0-9.]/g, ''));
        const increment = target / 50;
        let current = 0;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }

            // Format selon le type de nombre
            let display = Math.floor(current);
            if (counter.textContent.includes('M')) {
                display = (current).toFixed(1) + 'M';
            } else if (counter.textContent.includes('.')) {
                display = current.toFixed(1);
            }

            counter.textContent = display;
        }, 50);
    };

    // Observer pour déclencher l'animation au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.impact-number');
                if (counter && !counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
            }
        });
    });

    document.querySelectorAll('.impact-counter').forEach(counter => {
        observer.observe(counter);
    });

    // Animation de la barre de progression
    const progressBar = document.querySelector('.progress-bar-fill');
    if (progressBar) {
        const progressObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.width = entry.target.getAttribute('style').match(/width: (\d+)%/)[1] + '%';
                }
            });
        });
        progressObserver.observe(progressBar);
    }
});

// Gestion des modales d'images avec navigation
let currentImageIndex = 0;
const totalImages = {{ $project->gallery ? count($project->gallery) : 0 }};

function showImageModal(index) {
    currentImageIndex = index;
    const modal = new bootstrap.Modal(document.getElementById(`imageModal${index}`));
    modal.show();
}

// Navigation au clavier dans les modales
document.addEventListener('keydown', function(e) {
    const activeModal = document.querySelector('.modal.show');
    if (activeModal && activeModal.id.startsWith('imageModal')) {
        if (e.key === 'ArrowLeft' && currentImageIndex > 0) {
            bootstrap.Modal.getInstance(activeModal).hide();
            setTimeout(() => showImageModal(currentImageIndex - 1), 150);
        } else if (e.key === 'ArrowRight' && currentImageIndex < totalImages - 1) {
            bootstrap.Modal.getInstance(activeModal).hide();
            setTimeout(() => showImageModal(currentImageIndex + 1), 150);
        }
    }
});

// Effet hover sur les images de galerie
document.querySelectorAll('.gallery-item').forEach(item => {
    const overlay = item.querySelector('.position-absolute');

    item.addEventListener('mouseenter', () => {
        if (overlay) overlay.style.opacity = '1';
    });

    item.addEventListener('mouseleave', () => {
        if (overlay) overlay.style.opacity = '0';
    });
});

// Smooth scroll pour les ancres
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

// Partage natif si disponible
if (navigator.share) {
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach(btn => {
        btn.addEventListener('click', async (e) => {
            if (btn.classList.contains('native-share')) {
                e.preventDefault();
                try {
                    await navigator.share({
                        title: '{{ $project->title }}',
                        text: '{{ $project->excerpt }}',
                        url: window.location.href
                    });
                } catch (err) {
                    console.log('Erreur de partage:', err);
                }
            }
        });
    });
}

// Lazy loading pour les images
if ('loading' in HTMLImageElement.prototype) {
    const images = document.querySelectorAll('img[data-src]');
    images.forEach(img => {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
    });
} else {
    // Fallback pour les navigateurs plus anciens
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/intersection-observer@0.12.0/intersection-observer.js';
    document.head.appendChild(script);
}

// Animation des éléments au scroll
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

// Appliquer l'animation aux cartes
document.querySelectorAll('.sidebar-card, .objective-item, .result-item').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Gestion du bouton "Retour en haut"
const backToTopBtn = document.createElement('button');
backToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
backToTopBtn.className = 'btn btn-primary rounded-circle position-fixed';
backToTopBtn.style.cssText = `
    right: 20px;
    bottom: 20px;
    width: 50px;
    height: 50px;
    z-index: 1000;
    opacity: 0;
    transition: opacity 0.3s;
    display: none;
`;

document.body.appendChild(backToTopBtn);

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        backToTopBtn.style.display = 'block';
        setTimeout(() => backToTopBtn.style.opacity = '1', 10);
    } else {
        backToTopBtn.style.opacity = '0';
        setTimeout(() => backToTopBtn.style.display = 'none', 300);
    }
});

backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Copie du lien de partage
function copyProjectLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        // Afficher une notification de succès
        const toast = document.createElement('div');
        toast.className = 'toast-notification';
        toast.textContent = 'Lien copié !';
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;

        document.body.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 3000);
    });
}

// Ajout du style pour l'animation toast
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .share-buttons {
            justify-content: center;
        }

        .related-project-item .d-flex {
            flex-direction: column;
            text-align: center;
        }

        .related-project-item img {
            margin: 0 auto 10px auto;
        }
    }
`;
document.head.appendChild(style);
</script>
@endpush
