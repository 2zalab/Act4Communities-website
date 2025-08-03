{{-- resources/views/admin/partnership-requests/show.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Détails de la demande #' . $partnershipRequest->id)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-eye me-2 text-info"></i>Demande #{{ $partnershipRequest->id }}
        <span class="{{ $partnershipRequest->status_badge }} ms-2">{{ $partnershipRequest->status_name }}</span>
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.partnership-requests.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
        @if(in_array($partnershipRequest->status, ['pending', 'under_review']))
        <a href="{{ route('admin.partnership-requests.edit', $partnershipRequest) }}" class="btn btn-warning">
            <i class="fas fa-cogs me-1"></i>Traiter la demande
        </a>
        @endif
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

<div class="row">
    <!-- Informations principales -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-building me-2"></i>Informations de l'organisation
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Nom :</dt>
                            <dd class="col-sm-8"><strong>{{ $partnershipRequest->org_name }}</strong></dd>

                            <dt class="col-sm-4">Type :</dt>
                            <dd class="col-sm-8">
                                <span class="badge bg-secondary">{{ $partnershipRequest->org_type_name }}</span>
                            </dd>

                            @if($partnershipRequest->website)
                            <dt class="col-sm-4">Site web :</dt>
                            <dd class="col-sm-8">
                                <a href="{{ $partnershipRequest->website }}" target="_blank" class="text-decoration-none">
                                    <i class="fas fa-external-link-alt me-1"></i>{{ $partnershipRequest->website }}
                                </a>
                            </dd>
                            @endif
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Contact :</dt>
                            <dd class="col-sm-8"><strong>{{ $partnershipRequest->contact_name }}</strong></dd>

                            @if($partnershipRequest->contact_position)
                            <dt class="col-sm-4">Fonction :</dt>
                            <dd class="col-sm-8">{{ $partnershipRequest->contact_position }}</dd>
                            @endif

                            <dt class="col-sm-4">Email :</dt>
                            <dd class="col-sm-8">
                                <a href="mailto:{{ $partnershipRequest->contact_email }}">{{ $partnershipRequest->contact_email }}</a>
                            </dd>

                            @if($partnershipRequest->contact_phone)
                            <dt class="col-sm-4">Téléphone :</dt>
                            <dd class="col-sm-8">
                                <a href="tel:{{ $partnershipRequest->contact_phone }}">{{ $partnershipRequest->contact_phone }}</a>
                            </dd>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-handshake me-2"></i>Détails du partenariat
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-5">Type de partenariat :</dt>
                            <dd class="col-sm-7">
                                <span class="badge
                                    @if($partnershipRequest->partnership_type == 'financial') bg-success
                                    @elseif($partnershipRequest->partnership_type == 'technical') bg-info
                                    @elseif($partnershipRequest->partnership_type == 'strategic') bg-primary
                                    @else bg-warning @endif">
                                    {{ $partnershipRequest->partnership_type_name }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-5">Date de demande :</dt>
                            <dd class="col-sm-7">{{ $partnershipRequest->created_at->format('d/m/Y à H:i') }}</dd>
                        </dl>
                    </div>
                </div>

                @if($partnershipRequest->categories->count() > 0)
                <div class="mt-3">
                    <dt>Domaines d'intervention :</dt>
                    <dd>
                        @foreach($partnershipRequest->categories as $category)
                        <span class="badge bg-light text-dark me-1 mb-1">
                            <i class="{{ $category->icon }} me-1" style="color: {{ $category->color }}"></i>
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </dd>
                </div>
                @endif

                <div class="mt-3">
                    <dt>Description de la proposition :</dt>
                    <dd class="mt-2">
                        <div class="p-3 bg-light rounded">
                            {{ $partnershipRequest->description }}
                        </div>
                    </dd>
                </div>
            </div>
        </div>

        @if($partnershipRequest->admin_notes)
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-sticky-note me-2"></i>Notes administratives
                </h5>
            </div>
            <div class="card-body">
                <div class="p-3 bg-light rounded">
                    {{ $partnershipRequest->admin_notes }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Actions et informations complémentaires -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-cogs me-2"></i>Actions
                </h5>
            </div>
            <div class="card-body">
                @if($partnershipRequest->status == 'pending')
                <form method="POST" action="{{ route('admin.partnership-requests.under-review', $partnershipRequest) }}" class="mb-2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>Mettre en examen
                    </button>
                </form>
                @endif

                @if(in_array($partnershipRequest->status, ['pending', 'under_review']))
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                        <i class="fas fa-check me-2"></i>Approuver
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="fas fa-times me-2"></i>Rejeter
                    </button>
                </div>
                @endif

                @if($partnershipRequest->status == 'approved' && $partnershipRequest->partner)
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Approuvée</strong><br>
                    Partenaire créé : <a href="{{ route('admin.partners.edit', $partnershipRequest->partner) }}">{{ $partnershipRequest->partner->name }}</a>
                </div>
                @endif

                @if($partnershipRequest->status == 'rejected')
                <div class="alert alert-danger">
                    <i class="fas fa-times-circle me-2"></i>
                    <strong>Rejetée</strong>
                </div>
                @endif

                <hr>

                @if(!in_array($partnershipRequest->status, ['approved']))
                <form method="POST" action="{{ route('admin.partnership-requests.destroy', $partnershipRequest) }}"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="fas fa-trash me-2"></i>Supprimer la demande
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informations système
                </h5>
            </div>
            <div class="card-body">
                <dl class="row small">
                    <dt class="col-sm-5">ID :</dt>
                    <dd class="col-sm-7">#{{ $partnershipRequest->id }}</dd>

                    <dt class="col-sm-5">Créée le :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->created_at->format('d/m/Y H:i') }}</dd>

                    <dt class="col-sm-5">Modifiée le :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->updated_at->format('d/m/Y H:i') }}</dd>

                    @if($partnershipRequest->processed_by)
                    <dt class="col-sm-5">Traitée par :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->processedBy->name ?? 'N/A' }}</dd>

                    <dt class="col-sm-5">Traitée le :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->processed_at ? $partnershipRequest->processed_at->format('d/m/Y H:i') : 'N/A' }}</dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'approbation -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="approveModalLabel">
                    <i class="fas fa-check me-2"></i>Approuver la demande de partenariat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.partnership-requests.approve', $partnershipRequest) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        L'approbation de cette demande créera automatiquement un nouveau partenaire dans le système.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="partner_name" class="form-label">Nom du partenaire <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="partner_name" name="partner_name"
                                   value="{{ $partnershipRequest->org_name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="partner_type" class="form-label">Type de partenaire <span class="text-danger">*</span></label>
                            <select class="form-select" id="partner_type" name="partner_type" required>
                                <option value="ong" {{ $partnershipRequest->org_type == 'ngo' ? 'selected' : '' }}>ONG</option>
                                <option value="entreprise" {{ $partnershipRequest->org_type == 'company' ? 'selected' : '' }}>Entreprise</option>
                                <option value="institution" {{ $partnershipRequest->org_type == 'institution' ? 'selected' : '' }}>Institution</option>
                                <option value="academique" {{ $partnershipRequest->org_type == 'university' ? 'selected' : '' }}>Académique</option>
                                <option value="fondation" {{ $partnershipRequest->org_type == 'foundation' ? 'selected' : '' }}>Fondation</option>
                                <option value="autre" {{ $partnershipRequest->org_type == 'other' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="partner_description" class="form-label">Description</label>
                        <textarea class="form-control" id="partner_description" name="partner_description" rows="3">{{ $partnershipRequest->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sort_order" class="form-label">Ordre d'affichage</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Partenaire actif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>Approuver et créer le partenaire
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de rejet -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="rejectModalLabel">
                    <i class="fas fa-times me-2"></i>Rejeter la demande de partenariat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.partnership-requests.reject', $partnershipRequest) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Cette action rejettera définitivement la demande de partenariat.
                    </div>

                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label">Motif du rejet <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="4"
                                  placeholder="Expliquez les raisons du rejet..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-2"></i>Rejeter la demande
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
