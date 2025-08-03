{{-- resources/views/admin/partnership-requests/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Demandes de partenariat')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-envelope me-2 text-primary"></i>Demandes de partenariat
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour aux partenaires
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
                        <h4>{{ $stats['total'] }}</h4>
                        <p class="mb-0">Total demandes</p>
                    </div>
                    <div>
                        <i class="fas fa-inbox fa-2x opacity-75"></i>
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
                        <h4>{{ $stats['pending'] }}</h4>
                        <p class="mb-0">En attente</p>
                    </div>
                    <div>
                        <i class="fas fa-clock fa-2x opacity-75"></i>
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
                        <h4>{{ $stats['under_review'] }}</h4>
                        <p class="mb-0">En examen</p>
                    </div>
                    <div>
                        <i class="fas fa-search fa-2x opacity-75"></i>
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
                        <h4>{{ $stats['approved'] }}</h4>
                        <p class="mb-0">Approuvées</p>
                    </div>
                    <div>
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtres -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.partnership-requests.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>En examen</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approuvé</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="partnership_type" class="form-select">
                        <option value="">Tous les types</option>
                        <option value="financial" {{ request('partnership_type') == 'financial' ? 'selected' : '' }}>Financier</option>
                        <option value="technical" {{ request('partnership_type') == 'technical' ? 'selected' : '' }}>Technique</option>
                        <option value="strategic" {{ request('partnership_type') == 'strategic' ? 'selected' : '' }}>Stratégique</option>
                        <option value="academic" {{ request('partnership_type') == 'academic' ? 'selected' : '' }}>Académique</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i>Filtrer
                    </button>
                </div>
            </div>
        </form>
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

<!-- Requests Table -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Liste des demandes ({{ $partnershipRequests->total() }})</h5>
    </div>
    <div class="card-body">
        @if($partnershipRequests->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Organisation</th>
                        <th>Contact</th>
                        <th>Type</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partnershipRequests as $request)
                    <tr>
                        <td>
                            <div>
                                <strong>{{ $request->org_name }}</strong>
                                <div class="small text-muted">
                                    <span class="badge badge-sm bg-secondary">{{ $request->org_type_name }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <strong>{{ $request->contact_name }}</strong>
                                <div class="small text-muted">{{ $request->contact_email }}</div>
                                @if($request->contact_phone)
                                <div class="small text-muted">{{ $request->contact_phone }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge
                                @if($request->partnership_type == 'financial') bg-success
                                @elseif($request->partnership_type == 'technical') bg-info
                                @elseif($request->partnership_type == 'strategic') bg-primary
                                @else bg-warning @endif">
                                {{ $request->partnership_type_name }}
                            </span>
                        </td>
                        <td>
                            <span class="{{ $request->status_badge }}">
                                {{ $request->status_name }}
                            </span>
                        </td>
                        <td>
                            <div class="small">
                                {{ $request->created_at->format('d/m/Y') }}
                                <div class="text-muted">{{ $request->created_at->format('H:i') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.partnership-requests.show', $request) }}"
                                   class="btn btn-sm btn-outline-info" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($request->status == 'pending')
                                <form method="POST" action="{{ route('admin.partnership-requests.under-review', $request) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-primary" title="Mettre en examen">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </form>
                                @endif
                                @if(in_array($request->status, ['pending', 'under_review']))
                                <a href="{{ route('admin.partnership-requests.edit', $request) }}"
                                   class="btn btn-sm btn-outline-warning" title="Traiter">
                                    <i class="fas fa-cogs"></i>
                                </a>
                                @endif
                                @if(!in_array($request->status, ['approved']))
                                <form method="POST" action="{{ route('admin.partnership-requests.destroy', $request) }}"
                                      class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $partnershipRequests->withQueryString()->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucune demande trouvée</h5>
            <p class="text-muted">Les nouvelles demandes de partenariat apparaîtront ici</p>
        </div>
        @endif
    </div>
</div>
@endsection
