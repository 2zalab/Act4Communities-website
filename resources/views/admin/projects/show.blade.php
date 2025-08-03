@extends('admin.layouts.app')

@section('title', 'Détails du projet')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 mb-1">{{ $project->title }}</h1>
            <div class="text-muted small">
                Créé le {{ $project->created_at->format('d/m/Y') }}
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary d-flex align-items-center" title="Modifier le projet">
                <i class="fas fa-edit me-2"></i> Modifier
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary d-flex align-items-center" title="Retour à la liste">
                <i class="fas fa-arrow-left me-2"></i> Retour
            </a>
        </div>
    </div>

    <article class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="row">
                <div class="col-lg-8">
                    <section class="mb-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="h4 mb-0">Aperçu du projet</h2>
                            <span class="badge
                                @if($project->status == 'active') bg-success
                                @elseif($project->status == 'completed') bg-danger
                                @else bg-warning text-dark
                                @endif
                                px-3 py-2">
                                @if($project->status == 'active') En cours
                                @elseif($project->status == 'completed') Terminé
                                @else Suspendu
                                @endif
                            </span>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Résumé</h5>
                            <p class="lead">{{ $project->excerpt }}</p>
                        </div>

                        <div class="mb-4">
                            <h5 class="mb-3">Description complète</h5>
                            <div class="border rounded p-4 bg-light">
                                {!! $project->description !!}
                            </div>
                        </div>
                    </section>

                    @if($project->objectives && count($project->objectives))
                    <section class="mb-5">
                        <h2 class="h4 mb-4">Objectifs du projet</h2>
                        <div class="row g-3">
                            @foreach($project->objectives as $index => $objective)
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Objectif {{ $index + 1 }}</h5>
                                        <p class="card-text">{{ $objective }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    @endif

                    @if($project->expected_results && count($project->expected_results))
                    <section class="mb-5">
                        <h2 class="h4 mb-4">Résultats attendus</h2>
                        <ul class="list-group list-group-numbered list-group-flush">
                            @foreach($project->expected_results as $result)
                            <li class="list-group-item d-flex align-items-start">
                                <div class="bg-success rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 24px; height: 24px; flex-shrink: 0;">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    {{ $result }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4" style="top: 20px;">
                        <div class="card-body">
                            <h3 class="h5 mb-4">Informations clés</h3>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Catégorie</span>
                                    <span class="fw-medium">{{ $project->category->name ?? 'Non spécifiée' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Projet phare</span>
                                    <span class="fw-medium">
                                        <i class="fas fa-{{ $project->is_featured ? 'check-circle text-success' : 'times-circle text-danger' }}"></i>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Publié</span>
                                    <span class="fw-medium">
                                        <i class="fas fa-{{ $project->is_published ? 'check-circle text-success' : 'times-circle text-danger' }}"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Date de début</span>
                                    <span class="fw-medium">{{ $project->start_date?->format('d/m/Y') ?? 'Non définie' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Date de fin</span>
                                    <span class="fw-medium">{{ $project->end_date?->format('d/m/Y') ?? 'Non définie' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Durée</span>
                                    <span class="fw-medium">
                                        @if($project->start_date && $project->end_date)
                                            {{ $project->start_date->diffInDays($project->end_date) }} jours
                                        @else
                                            Non calculable
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Localisation</span>
                                    <span class="fw-medium">{{ $project->location ?? 'Non spécifiée' }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-bottom pb-2 mb-3">
                                    <span class="text-muted small">Budget</span>
                                    <span class="fw-medium">{{ number_format($project->budget, 0, ',', ' ') }} FCFA</span>
                                </div>
                            </div>

                            @if($project->featured_image)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $project->featured_image) }}"
                                     alt="Image du projet {{ $project->title }}"
                                     class="img-fluid rounded shadow"
                                     style="width: 100%; height: auto; object-fit: cover;">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
@endsection
