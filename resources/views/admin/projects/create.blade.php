{{-- resources/views/admin/projects/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Nouveau projet')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nouveau Projet</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Retour à la liste
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Résumé <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror"
                                  id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description complète <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="8" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">Catégorie <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id" name="category_id" required>
                                <option value="">Sélectionnez...</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>En cours</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                                <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Date de début</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                   id="start_date" name="start_date" value="{{ old('start_date') }}">
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Date de fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                   id="end_date" name="end_date" value="{{ old('end_date') }}">
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Localisation</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   id="location" name="location" value="{{ old('location') }}">
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="budget" class="form-label">Budget (FCFA)</label>
                            <input type="number" class="form-control @error('budget') is-invalid @enderror"
                                   id="budget" name="budget" value="{{ old('budget') }}" min="0">
                            @error('budget')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Image principale</label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                               id="featured_image" name="featured_image" accept="image/*">
                        @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Objectifs -->
                    <div class="mb-3">
                        <label class="form-label">Objectifs</label>
                        <div id="objectives-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="objectives[]" placeholder="Objectif...">
                                <button type="button" class="btn btn-outline-danger remove-objective" disabled>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-objective">
                            <i class="fas fa-plus me-1"></i>Ajouter un objectif
                        </button>
                    </div>

                    <!-- Résultats attendus -->
                    <div class="mb-3">
                        <label class="form-label">Résultats attendus</label>
                        <div id="results-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="expected_results[]" placeholder="Résultat attendu...">
                                <button type="button" class="btn btn-outline-danger remove-result" disabled>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-result">
                            <i class="fas fa-plus me-1"></i>Ajouter un résultat
                        </button>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                               {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Projet phare (affiché en priorité)
                        </label>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            Publier immédiatement
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Créer le projet
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Aide</h5>
            </div>
            <div class="card-body">
                <h6>Conseils pour créer un projet :</h6>
                <ul class="small">
                    <li>Utilisez un titre clair et descriptif</li>
                    <li>Le résumé doit être accrocheur (150-200 mots)</li>
                    <li>Ajoutez une image de qualité (min. 800x600px)</li>
                    <li>Définissez des objectifs SMART</li>
                    <li>Indiquez la localisation précise</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Gestion dynamique des objectifs
document.getElementById('add-objective').addEventListener('click', function() {
    const container = document.getElementById('objectives-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="objectives[]" placeholder="Objectif...">
        <button type="button" class="btn btn-outline-danger remove-objective">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
    updateRemoveButtons('objective');
});

// Gestion dynamique des résultats
document.getElementById('add-result').addEventListener('click', function() {
    const container = document.getElementById('results-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="expected_results[]" placeholder="Résultat attendu...">
        <button type="button" class="btn btn-outline-danger remove-result">
            <i class="fas fa-minus"></i>
        </button>
    `;
    container.appendChild(div);
    updateRemoveButtons('result');
});

// Fonction pour supprimer les éléments
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-objective')) {
        e.target.closest('.input-group').remove();
        updateRemoveButtons('objective');
    }
    if (e.target.closest('.remove-result')) {
        e.target.closest('.input-group').remove();
        updateRemoveButtons('result');
    }
});

function updateRemoveButtons(type) {
    const buttons = document.querySelectorAll('.remove-' + type);
    buttons.forEach((btn, index) => {
        btn.disabled = buttons.length === 1;
    });
}
</script>
@endpush
@endsection
