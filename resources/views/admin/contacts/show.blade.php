{{-- resources/views/admin/contacts/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Détails du contact')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Détails du Message</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Retour à la liste
            </a>
            @if(!$contact->is_read)
            <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fas fa-check me-1"></i>Marquer comme lu
                </button>
            </form>
            @endif
            <a href="mailto:{{ $contact->email }}" class="btn btn-sm btn-primary">
                <i class="fas fa-reply me-1"></i>Répondre par email
            </a>
        </div>
    </div>
</div>

<!-- Informations du contact -->
<div class="row">
    <div class="col-md-8">
        <!-- Message principal -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $contact->subject }}</h5>
                <div>
                    <span class="badge
                        @if($contact->type == 'volunteer') bg-success
                        @elseif($contact->type == 'partnership') bg-primary
                        @else bg-secondary @endif">
                        @if($contact->type == 'volunteer') Bénévolat
                        @elseif($contact->type == 'partnership') Partenariat
                        @else Général @endif
                    </span>
                    @if($contact->is_read)
                    <span class="badge bg-success">Lu</span>
                    @else
                    <span class="badge bg-warning">Nouveau</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="message-content">
                    {!! nl2br(e($contact->message)) !!}
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>
                    <i class="fas fa-clock me-1"></i>
                    Reçu le {{ $contact->created_at->format('d/m/Y à H:i') }}
                    @if($contact->replied_at)
                    <span class="ms-3">
                        <i class="fas fa-reply me-1"></i>
                        Répondu le {{ $contact->replied_at->format('d/m/Y à H:i') }}
                    </span>
                    @endif
                </small>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Actions rapides</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-grid">
                            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                               class="btn btn-primary">
                                <i class="fas fa-envelope me-2"></i>Envoyer un email
                            </a>
                        </div>
                    </div>
                    @if($contact->phone)
                    <div class="col-md-6">
                        <div class="d-grid">
                            <a href="tel:{{ $contact->phone }}" class="btn btn-success">
                                <i class="fas fa-phone me-2"></i>Appeler
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row mt-2">
                    @if(!$contact->replied_at)
                    <div class="col-md-6">
                        <div class="d-grid">
                            <button type="button" class="btn btn-outline-success" onclick="markAsReplied()">
                                <i class="fas fa-check me-2"></i>Marquer comme répondu
                            </button>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="d-grid">
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                  class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
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

    <div class="col-md-4">
        <!-- Informations du contact -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Informations du contact</h6>
            </div>
            <div class="card-body">
                <div class="contact-info">
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">NOM</label>
                        <div>{{ $contact->name }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted small">EMAIL</label>
                        <div>
                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                        </div>
                    </div>

                    @if($contact->phone)
                    <div class="mb-3">
                        <label class="fw-bold text-muted small">TÉLÉPHONE</label>
                        <div>
                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                        </div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="fw-bold text-muted small">TYPE DE DEMANDE</label>
                        <div>
                            <span class="badge
                                @if($contact->type == 'volunteer') bg-success
                                @elseif($contact->type == 'partnership') bg-primary
                                @else bg-secondary @endif">
                                @if($contact->type == 'volunteer') Bénévolat
                                @elseif($contact->type == 'partnership') Partenariat
                                @else Général @endif
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold text-muted small">STATUT</label>
                        <div>
                            @if($contact->is_read)
                            <span class="badge bg-success">Lu</span>
                            @else
                            <span class="badge bg-warning">Non lu</span>
                            @endif

                            @if($contact->replied_at)
                            <span class="badge bg-info ms-1">Répondu</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="fw-bold text-muted small">DATE DE RÉCEPTION</label>
                        <div>{{ $contact->created_at->format('d/m/Y à H:i') }}</div>
                        <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modèles de réponse -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Modèles de réponse</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($contact->type == 'volunteer')
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyTemplate('volunteer')">
                        Réponse Bénévolat
                    </button>
                    @elseif($contact->type == 'partnership')
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyTemplate('partnership')">
                        Réponse Partenariat
                    </button>
                    @else
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyTemplate('general')">
                        Réponse Générale
                    </button>
                    @endif
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="copyTemplate('thanks')">
                        Remerciement
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form caché pour marquer comme répondu -->
<form id="repliedForm" method="POST" action="{{ route('admin.contacts.mark-replied', $contact) }}" style="display: none;">
    @csrf
    @method('PATCH')
</form>

@push('styles')
<style>
.message-content {
    line-height: 1.6;
    font-size: 1rem;
    max-height: 400px;
    overflow-y: auto;
}

.contact-info label {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.card-header h6 {
    color: #495057;
}

.contact-info > div {
    padding-bottom: 0.75rem;
    border-bottom: 1px solid #f8f9fa;
}

.contact-info > div:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
</style>
@endpush

@push('scripts')
<script>
function markAsReplied() {
    if (confirm('Marquer ce message comme répondu ?')) {
        document.getElementById('repliedForm').submit();
    }
}

function copyTemplate(type) {
    let template = '';
    const contactName = '{{ $contact->name }}';

    switch(type) {
        case 'volunteer':
            template = `Bonjour ${contactName},

Merci pour votre intérêt à devenir bénévole dans notre organisation.

Nous sommes ravis de recevoir votre candidature et nous vous contacterons prochainement pour discuter des opportunités disponibles.

Cordialement,
L'équipe`;
            break;

        case 'partnership':
            template = `Bonjour ${contactName},

Merci pour votre proposition de partenariat.

Nous étudions votre demande avec attention et nous reviendrons vers vous dans les plus brefs délais.

Cordialement,
L'équipe`;
            break;

        case 'general':
            template = `Bonjour ${contactName},

Merci pour votre message.

Nous avons bien reçu votre demande et nous vous répondrons dans les plus brefs délais.

Cordialement,
L'équipe`;
            break;

        case 'thanks':
            template = `Bonjour ${contactName},

Merci pour votre message.

Cordialement,
L'équipe`;
            break;
    }

    // Copier dans le presse-papiers
    navigator.clipboard.writeText(template).then(function() {
        // Afficher notification
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed';
        toast.style.cssText = 'top: 20px; right: 20px; z-index: 1050;';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    Modèle copié dans le presse-papiers !
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        document.body.appendChild(toast);

        // Supprimer automatiquement après 3 secondes
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 3000);
    }).catch(function() {
        alert('Erreur lors de la copie du modèle');
    });
}

// Marquer automatiquement comme lu si ce n'est pas déjà fait
@if(!$contact->is_read)
setTimeout(function() {
    fetch('{{ route("admin.contacts.mark-read", $contact) }}', {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        }
    });
}, 2000); // Marquer comme lu après 2 secondes de visualisation
@endif
</script>
@endpush
@endsection
