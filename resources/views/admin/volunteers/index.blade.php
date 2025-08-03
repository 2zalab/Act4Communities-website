@extends('admin.layouts.app')
@section('title', 'Gestion des volontaires')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Volontaires</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                Actions en lot
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="markAllAsRead()">Marquer comme lu</a></li>
                <li><a class="dropdown-item" href="#" onclick="deleteSelected()">Supprimer sélectionnés</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $volunteers->total() }}</h4>
                        <p class="mb-0">Total</p>
                    </div>
                    <div>
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ajoutez d'autres cartes de statistiques ici -->
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label for="status" class="form-label">Statut</label>
                <select class="form-select" id="status" name="status">
                    <option value="">Tous les statuts</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Non lu</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Lu</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label">Recherche</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search" name="search"
                           value="{{ request('search') }}" placeholder="Nom, email, sujet...">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Volunteers Table -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Volontaires ({{ $volunteers->total() }})</h5>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">
                    Tout sélectionner
                </label>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($volunteers->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="40"><input type="checkbox" id="masterCheckbox"></th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($volunteers as $volunteer)
                    <tr class="{{ !$volunteer->is_read ? 'table-warning' : '' }}">
                        <td>
                            <input type="checkbox" name="volunteer_ids[]" value="{{ $volunteer->id }}" class="volunteer-checkbox">
                        </td>
                        <td>{{ $volunteer->name }}</td>
                        <td>{{ $volunteer->email }}</td>
                        <td>{{ $volunteer->phone }}</td>
                        <td>{{ $volunteer->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($volunteer->is_read)
                            <span class="badge bg-success">Lu</span>
                            @else
                            <span class="badge bg-warning">Nouveau</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.volunteers.show', $volunteer) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="mailto:{{ $volunteer->email }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-reply"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.volunteers.destroy', $volunteer) }}" class="d-inline" onsubmit="return confirm('Êtes-vous sûr ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
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
            {{ $volunteers->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucun volontaire trouvé</h5>
            <p class="text-muted">Les volontaires apparaîtront ici</p>
        </div>
        @endif
    </div>
</div>
@push('scripts')
<script>
// Scripts pour la sélection multiple, les actions en lot, etc.
</script>
@endpush
@endsection
