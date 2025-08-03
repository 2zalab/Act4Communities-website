@extends('admin.layouts.app')
@section('title', 'Détails du volontaire')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Détails du Volontaire</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.volunteers.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Retour à la liste
            </a>
            <a href="mailto:{{ $volunteer->email }}" class="btn btn-sm btn-primary">
                <i class="fas fa-reply me-1"></i> Répondre par email
            </a>
        </div>
    </div>
</div>

<!-- Informations du volontaire -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations du Volontaire</h5>
            </div>
            <div class="card-body">
                <div class="volunteer-info">
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">NOM</label>
                        <div>{{ $volunteer->name }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">EMAIL</label>
                        <div>
                            <a href="mailto:{{ $volunteer->email }}">{{ $volunteer->email }}</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">TÉLÉPHONE</label>
                        <div>
                            <a href="tel:{{ $volunteer->phone }}">{{ $volunteer->phone }}</a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">ÂGE</label>
                        <div>{{ $volunteer->age }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">COMPÉTENCES</label>
                        <div>{{ $volunteer->skills }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">DISPONIBILITÉ</label>
                        <div>{{ $volunteer->availability }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
