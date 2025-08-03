@extends('admin.layouts.app')
@section('title', 'Détails de l\'utilisateur')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Détails de l'Utilisateur</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-bold text-muted small">NOM</label>
                    <div>{{ $user->name }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">EMAIL</label>
                    <div>{{ $user->email }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">STATUT</label>
                    <div>
                        <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $user->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @if($user->avatar)
                <div class="text-center">
                    <img src="{{ $user->avatar }}" alt="Avatar" class="img-fluid rounded-circle" style="max-width: 150px;">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
