{{-- resources/views/admin/contacts/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Gestion des contacts')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion des Contacts</h1>
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
                        <h4>{{ $contacts->total() }}</h4>
                        <p class="mb-0">Total</p>
                    </div>
                    <div>
                        <i class="fas fa-envelope fa-2x opacity-75"></i>
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
                        <h4>{{ $contacts->where('is_read', false)->count() }}</h4>
                        <p class="mb-0">Non lus</p>
                    </div>
                    <div>
                        <i class="fas fa-envelope-open fa-2x opacity-75"></i>
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
                        <h4>{{ $contacts->where('type', 'volunteer')->count() }}</h4>
                        <p class="mb-0">Bénévolat</p>
                    </div>
                    <div>
                        <i class="fas fa-hand-holding-heart fa-2x opacity-75"></i>
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
                        <h4>{{ $contacts->where('type', 'partnership')->count() }}</h4>
                        <p class="mb-0">Partenariats</p>
                    </div>
                    <div>
                        <i class="fas fa-handshake fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="all">Tous les types</option>
                    <option value="general" {{ request('type') == 'general' ? 'selected' : '' }}>Général</option>
                    <option value="volunteer" {{ request('type') == 'volunteer' ? 'selected' : '' }}>Bénévolat</option>
                    <option value="partnership" {{ request('type') == 'partnership' ? 'selected' : '' }}>Partenariat</option>
                </select>
            </div>
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

<!-- Contacts Table -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Messages ({{ $contacts->total() }})</h5>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="selectAll">
                <label class="form-check-label" for="selectAll">
                    Tout sélectionner
                </label>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($contacts->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="40"><input type="checkbox" id="masterCheckbox"></th>
                        <th>Contact</th>
                        <th>Type</th>
                        <th>Sujet</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                        <td>
                            <input type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" class="contact-checkbox">
                        </td>
                        <td>
                            <div>
                                <strong>{{ $contact->name }}</strong>
                                <div class="small text-muted">{{ $contact->email }}</div>
                                @if($contact->phone)
                                <div class="small text-muted">{{ $contact->phone }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="badge
                                @if($contact->type == 'volunteer') bg-success
                                @elseif($contact->type == 'partnership') bg-primary
                                @else bg-secondary @endif">
                                @if($contact->type == 'volunteer') Bénévolat
                                @elseif($contact->type == 'partnership') Partenariat
                                @else Général @endif
                            </span>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 200px;" title="{{ $contact->subject }}">
                                {{ $contact->subject }}
                            </div>
                        </td>
                        <td>
                            <div>{{ $contact->created_at->format('d/m/Y') }}</div>
                            <div class="small text-muted">{{ $contact->created_at->format('H:i') }}</div>
                        </td>
                        <td>
                            @if($contact->is_read)
                            <span class="badge bg-success">Lu</span>
                            @else
                            <span class="badge bg-warning">Nouveau</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.contacts.show', $contact) }}"
                                   class="btn btn-sm btn-outline-info" title="Lire">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$contact->is_read)
                                <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Marquer comme lu">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif
                                <a href="mailto:{{ $contact->email }}" class="btn btn-sm btn-outline-primary" title="Répondre">
                                    <i class="fas fa-reply"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
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
            {{ $contacts->appends(request()->query())->links() }}
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Aucun message trouvé</h5>
            <p class="text-muted">Les messages de contact apparaîtront ici</p>
        </div>
        @endif
    </div>
</div>

<!-- Modal d'actions en lot -->
<div class="modal fade" id="bulkActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actions en lot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Que souhaitez-vous faire avec les <span id="selectedCount">0</span> message(s) sélectionné(s) ?</p>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-success" onclick="bulkMarkAsRead()">
                        <i class="fas fa-check me-2"></i>Marquer comme lu
                    </button>
                    <button type="button" class="btn btn-danger" onclick="bulkDelete()">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Sélection multiple
document.getElementById('masterCheckbox').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateSelectedCount();
});

// Mise à jour du compteur
function updateSelectedCount() {
    const selected = document.querySelectorAll('.contact-checkbox:checked');
    document.getElementById('selectedCount').textContent = selected.length;

    // Activer/désactiver le bouton d'actions en lot
    const bulkButton = document.querySelector('[data-bs-target="#bulkActionModal"]');
    if (bulkButton) {
        bulkButton.disabled = selected.length === 0;
    }
}

// Écouter les changements sur les checkboxes individuelles
document.querySelectorAll('.contact-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

// Actions en lot
function markAllAsRead() {
    const selected = document.querySelectorAll('.contact-checkbox:checked');
    if (selected.length === 0) {
        alert('Veuillez sélectionner au moins un message');
        return;
    }

    const modal = new bootstrap.Modal(document.getElementById('bulkActionModal'));
    modal.show();
}

function deleteSelected() {
    const selected = document.querySelectorAll('.contact-checkbox:checked');
    if (selected.length === 0) {
        alert('Veuillez sélectionner au moins un message');
        return;
    }

    const modal = new bootstrap.Modal(document.getElementById('bulkActionModal'));
    modal.show();
}

function bulkMarkAsRead() {
    const selected = document.querySelectorAll('.contact-checkbox:checked');
    const ids = Array.from(selected).map(cb => cb.value);

    if (confirm(`Marquer ${ids.length} message(s) comme lu ?`)) {
        // Créer un formulaire pour envoyer les IDs
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.contacts.index") }}/bulk-read';

        // Token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // IDs sélectionnés
        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'contact_ids[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
}

function bulkDelete() {
    const selected = document.querySelectorAll('.contact-checkbox:checked');
    const ids = Array.from(selected).map(cb => cb.value);

    if (confirm(`Supprimer définitivement ${ids.length} message(s) ?`)) {
        // Créer un formulaire pour envoyer les IDs
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.contacts.index") }}/bulk-delete';

        // Token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Method DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        // IDs sélectionnés
        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'contact_ids[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
}

// Auto-refresh toutes les 30 secondes pour les nouveaux messages
setInterval(function() {
    // Seulement si aucun filtre n'est appliqué
    const urlParams = new URLSearchParams(window.location.search);
    if (!urlParams.has('type') && !urlParams.has('status') && !urlParams.has('search')) {
        // Recharger silencieusement le badge de notification
        fetch('{{ route("admin.contacts.index") }}?ajax=1')
            .then(response => response.json())
            .then(data => {
                if (data.unread_count) {
                    // Mettre à jour le badge dans la navigation si présent
                    const badge = document.querySelector('.navbar .badge');
                    if (badge) {
                        badge.textContent = data.unread_count;
                        badge.style.display = data.unread_count > 0 ? 'inline' : 'none';
                    }
                }
            })
            .catch(error => console.log('Refresh error:', error));
    }
}, 30000);

// Raccourcis clavier
document.addEventListener('keydown', function(e) {
    // Ctrl+A pour sélectionner tout
    if (e.ctrlKey && e.key === 'a') {
        e.preventDefault();
        document.getElementById('masterCheckbox').click();
    }

    // Suppr pour supprimer la sélection
    if (e.key === 'Delete') {
        const selected = document.querySelectorAll('.contact-checkbox:checked');
        if (selected.length > 0) {
            deleteSelected();
        }
    }
});

// Initialiser le compteur au chargement
updateSelectedCount();
</script>
@endpush
@endsection
