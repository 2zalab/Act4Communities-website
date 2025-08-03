{{-- resources/views/admin/partners/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Nouveau partenaire')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nouveau Partenaire</h1>
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
                <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
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
                                    <option value="partner" {{ old('type') == 'partner' ? 'selected' : '' }}>Partenaire</option>
                                    <option value="donor" {{ old('type') == 'donor' ? 'selected' : '' }}>Donateur</option>
                                    <option value="sponsor" {{ old('type') == 'sponsor' ? 'selected' : '' }}>Sponsor</option>
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
                                       value="{{ old('website') }}"
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
                                       value="{{ old('sort_order', 0) }}"
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
                        <input type="file"
                               class="form-control @error('logo') is-invalid @enderror"
                               id="logo"
                               name="logo"
                               accept="image/*">
                        @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Format acceptés : JPG, PNG, GIF. Taille maximum : 2MB</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="4"
                                  placeholder="Description du partenaire...">{{ old('description') }}</textarea>
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
                                    {{ old('is_active', true) ? 'checked' : '' }}>
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
                            <i class="fas fa-save me-1"></i>Créer le partenaire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
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
// Prévisualisation du logo
document.getElementById('logo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Créer ou mettre à jour la prévisualisation
            let preview = document.getElementById('logo-preview');
            if (!preview) {
                preview = document.createElement('img');
                preview.id = 'logo-preview';
                preview.className = 'mt-2 img-thumbnail';
                preview.style.maxWidth = '150px';
                e.target.parentNode.appendChild(preview);
            }
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection
