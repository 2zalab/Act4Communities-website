{{-- resources/views/admin/partnership-requests/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Traiter la demande #' . $partnershipRequest->id)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-cogs me-2 text-warning"></i>Traiter la demande #{{ $partnershipRequest->id }}
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.partnership-requests.show', $partnershipRequest) }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour aux détails
        </a>
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

<div class="row pb-5">
    <!-- Résumé de la demande -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Résumé de la demande
                </h5>
            </div>
            <div class="card-body">
                <dl class="row small">
                    <dt class="col-sm-5">Organisation :</dt>
                    <dd class="col-sm-7"><strong>{{ $partnershipRequest->org_name }}</strong></dd>

                    <dt class="col-sm-5">Type :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->org_type_name }}</dd>

                    <dt class="col-sm-5">Contact :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->contact_name }}</dd>

                    <dt class="col-sm-5">Email :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->contact_email }}</dd>

                    <dt class="col-sm-5">Partenariat :</dt>
                    <dd class="col-sm-7">
                        <span class="badge bg-secondary">{{ $partnershipRequest->partnership_type_name }}</span>
                    </dd>

                    <dt class="col-sm-5">Statut actuel :</dt>
                    <dd class="col-sm-7">
                        <span class="{{ $partnershipRequest->status_badge }}">{{ $partnershipRequest->status_name }}</span>
                    </dd>

                    <dt class="col-sm-5">Reçue le :</dt>
                    <dd class="col-sm-7">{{ $partnershipRequest->created_at->format('d/m/Y H:i') }}</dd>
                </dl>

                @if($partnershipRequest->categories->count() > 0)
                <hr>
                <dt class="small">Domaines :</dt>
                <dd>
                    @foreach($partnershipRequest->categories as $category)
                    <span class="badge bg-light text-dark me-1 mb-1 small">{{ \Illuminate\Support\Str::limit($category->name, 15) }}</span>
                    @endforeach
                </dd>
                @endif
            </div>
        </div>
    </div>

    <!-- Formulaire de traitement -->
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.partnership-requests.update', $partnershipRequest) }}">
            @csrf
            @method('PUT')

            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Mise à jour du statut
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ $partnershipRequest->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="under_review" {{ $partnershipRequest->status == 'under_review' ? 'selected' : '' }}>En cours d'examen</option>
                            <option value="approved" {{ $partnershipRequest->status == 'approved' ? 'selected' : '' }}>Approuvé</option>
                            <option value="rejected" {{ $partnershipRequest->status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="admin_notes" class="form-label">Notes administratives</label>
                        <textarea class="form-control @error('admin_notes') is-invalid @enderror"
                                  id="admin_notes" name="admin_notes" rows="4"
                                  placeholder="Ajoutez vos commentaires sur le traitement de cette demande...">{{ old('admin_notes', $partnershipRequest->admin_notes) }}</textarea>
                        @error('admin_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Ces notes sont internes et ne seront pas visibles par le demandeur.</div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Description de la proposition
                    </h5>
                </div>
                <div class="card-body">
                    <div class="p-3 bg-light rounded">
                        {{ $partnershipRequest->description }}
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.partnership-requests.show', $partnershipRequest) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Annuler
                </a>
                <div>
                    <button type="submit" class="btn btn-warning me-2">
                        <i class="fas fa-save me-2"></i>Mettre à jour
                    </button>
                    @if(in_array($partnershipRequest->status, ['pending', 'under_review']))
                    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#quickApproveModal">
                        <i class="fas fa-check me-2"></i>Approuver rapidement
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#quickRejectModal">
                        <i class="fas fa-times me-2"></i>Rejeter
                    </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal d'approbation rapide -->
<div class="modal fade" id="quickApproveModal" tabindex="-1" aria-labelledby="quickApproveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="quickApproveModalLabel">
                    <i class="fas fa-check me-2"></i>Approbation rapide
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.partnership-requests.approve', $partnershipRequest) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Cette action approuvera la demande et créera automatiquement le partenaire.
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quick_partner_name" class="form-label">Nom du partenaire <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="quick_partner_name" name="partner_name"
                                   value="{{ $partnershipRequest->org_name }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="quick_partner_type" class="form-label">Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="quick_partner_type" name="partner_type" required>
                                <option value="ong" {{ $partnershipRequest->org_type == 'ngo' ? 'selected' : '' }}>ONG</option>
                                <option value="entreprise" {{ $partnershipRequest->org_type == 'company' ? 'selected' : '' }}>Entreprise</option>
                                <option value="institution" {{ $partnershipRequest->org_type == 'institution' ? 'selected' : '' }}>Institution</option>
                                <option value="academique" {{ $partnershipRequest->org_type == 'university' ? 'selected' : '' }}>Académique</option>
                                <option value="fondation" {{ $partnershipRequest->org_type == 'foundation' ? 'selected' : '' }}>Fondation</option>
                                <option value="autre" {{ $partnershipRequest->org_type == 'other' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="quick_partner_description" class="form-label">Description</label>
                            <textarea class="form-control" id="quick_partner_description" name="partner_description" rows="2">{{ Str::limit($partnershipRequest->description, 200) }}</textarea>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="quick_sort_order" class="form-label">Ordre</label>
                            <input type="number" class="form-control" id="quick_sort_order" name="sort_order" value="0" min="0">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="quick_is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="quick_is_active">Actif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-2"></i>Approuver
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de rejet rapide -->
<div class="modal fade" id="quickRejectModal" tabindex="-1" aria-labelledby="quickRejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="quickRejectModalLabel">
                    <i class="fas fa-times me-2"></i>Rejet rapide
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.partnership-requests.reject', $partnershipRequest) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="quick_rejection_reason" class="form-label">Motif du rejet <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="quick_rejection_reason" name="rejection_reason" rows="3"
                                  placeholder="Expliquez brièvement les raisons du rejet..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-2"></i>Rejeter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
