{{-- resources/views/admin/partners/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Modifier partenaire')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifier le Partenaire</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informations du partenaire</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.partners.update', $partner) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $partner->name) }}"
                                       required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror"
                                        id="type"
                                        name="type"
                                        required>
                                    <option value="">Sélectionnez un type</option>
                                    <option value="partner" {{ old('type', $partner->type) == 'partner' ? 'selected' : '' }}>Partenaire</option>
                                    <option value="donor" {{ old('type', $partner->type) == 'donor' ? 'selected' : '' }}>Donateur</option>
                                    <option value="sponsor" {{ old('type', $partner->type) == 'sponsor' ? 'selected' : '' }}>Sponsor</option>
                                </select>
                                @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="website" class="form-label">Site web</label>
                                <input type="url"
                                       class="form-control @error('website') is-invalid @enderror"
                                       id="website"
                                       name="website"
                                       value="{{ old('website', $partner->website) }}"
                                       placeholder="https://example.com">
                                @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Ordre d'affichage</label>
                                <input type="number"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       id="sort_order"
                                       name="sort_order"
                                       value="{{ old('sort_order', $partner->sort_order) }}"
                                       min="0">
                                @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Plus le nombre est petit, plus l'élément apparaît en premier</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        @if($partner->logo)
                        <div class="mb-2">
                            <img src="{{ Storage::url($partner->logo) }}"
                                 alt="{{ $partner->name }}"
                                 class="img-thumbnail"
                                 style="max-width: 150px;"
                                 id="current-logo">
                            <div class="form-text">Logo actuel</div>
                        </div>
                        @endif
                        <input type="file"
                               class="form-control @error('logo') is-invalid @enderror"
                               id="logo"
                               name="logo"
                               accept="image/*">
                        @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format acceptés : JPG, PNG, GIF. Taille maximum : 2MB. Laissez vide pour conserver le logo actuel.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Description du partenaire...">{{ old('description', $partner->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                         <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input"
                                    type="checkbox"
                                    id="is_active"
                                    name="is_active"
                                    value="1"
                                    {{ old('is_active', $partner->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Partenaire actif
                            </label>
                            </div>
                        <div class="form-text">Les partenaires inactifs ne seront pas affichés sur le site</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Informations</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold text-muted small">CRÉÉ LE</label>
                    <div>{{ $partner->created_at->format('d/m/Y à H:i') }}</div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold text-muted small">MODIFIÉ LE</label>
                    <div>{{ $partner->updated_at->format('d/m/Y à H:i') }}</div>
                </div>

                @if($partner->website)
                <div class="mb-3">
                    <label class="fw-bold text-muted small">SITE WEB</label>
                    <div>
                        <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none">
                            Visiter le site <i class="fas fa-external-link-alt ms-1"></i>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Aide</h6>
            </div>
            <div class="card-body">
                <h6>Types de partenaires :</h6>
                <ul class="small">
                    <li><strong>Partenaire :</strong> Organisation collaboratrice</li>
                    <li><strong>Donateur :</strong> Soutien financier</li>
                    <li><strong>Sponsor :</strong> Partenaire commercial</li>
                </ul>

                <h6 class="mt-3">Recommandations logo :</h6>
                <ul class="small">
                    <li>Format carré ou rectangulaire</li>
                    <li>Résolution minimum : 200x200px</li>
                    <li>Fond transparent (PNG) de préférence</li>
                    <li>Taille maximum : 2MB</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Prévisualisation du nouveau logo
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            // Masquer le logo actuel et afficher la prévisualisation
            const currentLogo = document.getElementById('current-logo');
            if (currentLogo) {
                currentLogo.style.display = 'none';
            }

            // Créer ou mettre à jour la prévisualisation
            let preview = document.getElementById('logo-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'logo-preview';
                preview.className = 'img-thumbnail mt-2';
                preview.style.maxWidth = '150px';
                document.getElementById('logo').parentNode.appendChild(preview);

                const previewText = document.createElement('div');
                previewText.className = 'form-text';
                previewText.textContent = 'Nouveau logo (aperçu)';
                preview.parentNode.appendChild(previewText);
            }
            preview.src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
