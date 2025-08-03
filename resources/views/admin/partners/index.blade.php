{{-- resources/views/admin/partners/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Gestion des partenaires')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Partenaires</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.partnership-requests.index') }}" class="btn btn-outline-info me-2">
            <i class="fas fa-list-alt me-1"></i>Demandes de partenariat
            @if($pendingRequestsCount > 0)
                <span class="badge bg-danger ms-1">{{ $pendingRequestsCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Nouveau partenaire
        </a>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $partners->total() }}</h4>
                        <p class="mb-0">Total partenaires</p>
                    </div>
                    <div>
                        <i class="fas fa-handshake fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $partners->where('is_active', true)->count() }}</h4>
                        <p class="mb-0">Actifs</p>
                    </div>
                    <div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $partners->where('type', 'ong')->count() + $partners->where('type', 'entreprise')->count() }}</h4>
                        <p class="mb-0">Partenaires</p>
                    </div>
                    <div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $partnershipRequestsCount }}</h4>
                        <p class="mb-0">Demandes reçues</p>
                    </div>
                    <div>
                        <i class="fas fa-envelope fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Messages d'alerte -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Partners Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des partenaires ({{ $partners->total() }})</h5>
    </div>
    <div class="card-body">
        @if($partners->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Site web</th>
                        <th>Statut</th>
                        <th>Ordre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partners as $partner)
                    <tr>
                        <td>
                            @if($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}"
                                 alt="{{ $partner->name }}"
                                 class="img-thumbnail"
                                 style="width: 50px; height: 50px; object-fit: contain;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px; border-radius: 4px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div>
                                <strong>{{ $partner->name }}</strong>
                                @if($partner->description)
                                <div class="small text-muted text-truncate" style="max-width: 200px;">
                                    {{ Str::limit($partner->description, 50) }}
                                </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge
                                @if($partner->type == 'ong') bg-primary
                                @elseif($partner->type == 'entreprise') bg-success
                                @elseif($partner->type == 'institution') bg-info
                                @elseif($partner->type == 'academique') bg-warning
                                @elseif($partner->type == 'fondation') bg-secondary
                                @else bg-dark @endif">
                                {{ $partner->type_name }}
                            </span>
                        </td>
                        <td>
                            @if($partner->website)
                            <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none">
                                <i class="fas fa-external-link-alt me-1"></i>
                                {{ Str::limit($partner->website, 30) }}
                            </a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($partner->is_active)
                            <span class="badge bg-success">Actif</span>
                            @else
                            <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $partner->sort_order }}</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.partners.edit', $partner) }}"
                                   class="btn btn-sm btn-outline-primary" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}"
                                      class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $partners->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-handshake fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucun partenaire trouvé</h5>
            <p class="text-muted">Commencez par ajouter votre premier partenaire</p>
            <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Ajouter un partenaire
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
