{{-- resources/views/admin/partners/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Détails du partenaire')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Détails du Partenaire</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.partners.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour à la liste
            </a>
            <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-edit me-1"></i>Modifier
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Informations principales -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $partner->name }}</h5>
                <div>
                    <span class="badge
                        @if($partner->type == 'partner') bg-primary
                        @elseif($partner->type == 'donor') bg-success
                        @else bg-warning @endif">
                        @if($partner->type == 'partner') Partenaire
                        @elseif($partner->type == 'donor') Donateur
                        @else Sponsor @endif
                    </span>
                    @if($partner->is_active)
                    <span class="badge bg-success">Actif</span>
                    @else
                    <span class="badge bg-secondary">Inactif</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($partner->logo)
                    <div class="col-md-3 text-center mb-3">
                        <img src="{{ Storage::url($partner->logo) }}"
                             alt="{{ $partner->name }}"
                             class="img-fluid rounded border"
                             style="max-width: 200px; max-height: 200px; object-fit: contain;">
                    </div>
                    @endif

                    <div class="col-md-{{ $partner->logo ? '9' : '12' }}">
                        @if($partner->description)
                        <div class="mb-3">
                            <h6 class="text-muted">Description</h6>
                            <p class="mb-0">{!! nl2br(e($partner->description)) !!}</p>
                        </div>
                        @endif

                        @if($partner->website)
                        <div class="mb-3">
                            <h6 class="text-muted">Site web</h6>
                            <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none">
                                {{ $partner->website }} <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-muted">Type</h6>
                                <span class="badge
                                    @if($partner->type == 'partner') bg-primary
                                    @elseif($partner->type == 'donor') bg-success
                                    @else bg-warning @endif">
                                    @if($partner->type == 'partner') Partenaire
                                    @elseif($partner->type == 'donor') Donateur
                                    @else Sponsor @endif
                                </span>
                            </div>

                            <div class="col-md-6">
                                <h6 class="text-muted">Ordre d'affichage</h6>
                                <span class="badge bg-info">{{ $partner->sort_order }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Actions rapides</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-grid">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </a>
                        </div>
                    </div>

                    @if($partner->website)
                    <div class="col-md-4">
                        <div class="d-grid">
                            <a href="{{ $partner->website }}" target="_blank" class="btn btn-success">
                                <i class="fas fa-external-link-alt me-2"></i>Visiter le site
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-4">
                        <div class="d-grid">
                            <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}"
                                  class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce partenaire ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash me-2"></i>Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Informations système -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Informations système</h6>
            </div>
            <div class="card-body">
                <div class="partner-info">
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">ID</label>
                        <div>{{ $partner->id }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted small">STATUT</label>
                        <div>
                            @if($partner->is_active)
                            <span class="badge bg-success">Actif</span>
                            @else
                            <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted small">ORDRE D'AFFICHAGE</label>
                        <div><span class="badge bg-info">{{ $partner->sort_order }}</span></div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted small">DATE DE CRÉATION</label>
                        <div>{{ $partner->created_at->format('d/m/Y à H:i') }}</div>
                        <small class="text-muted">{{ $partner->created_at->diffForHumans() }}</small>
                    </div>

                    <div class="mb-0">
                        <label class="fw-bold text-muted small">DERNIÈRE MODIFICATION</label>
                        <div>{{ $partner->updated_at->format('d/m/Y à H:i') }}</div>
                        <small class="text-muted">{{ $partner->updated_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Statistiques</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-primary">{{ $partner->sort_order }}</h4>
                            <small class="text-muted">Ordre</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-success">
                            {{ \Carbon\Carbon::parse($partner->created_at)->diffInDays() }}
                        </h4>
                        <small class="text-muted">Jours</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logo actuel -->
        @if($partner->logo)
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Logo</h6>
            </div>
            <div class="card-body text-center">
                <img src="{{ Storage::url($partner->logo) }}"
                     alt="{{ $partner->name }}"
                     class="img-fluid rounded border"
                     style="max-width: 100%; max-height: 200px; object-fit: contain;">
                <div class="mt-2">
                    <small class="text-muted">
                        Fichier : {{ basename($partner->logo) }}
                    </small>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
.partner-info > div {
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f8f9fa;
}

.partner-info > div:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.partner-info label {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}
</style>
@endpush
@endsection
