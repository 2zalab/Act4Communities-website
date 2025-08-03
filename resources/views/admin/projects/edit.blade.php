@extends('admin.layouts.app')

@section('title', 'Modifier le projet')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifier le Projet</h1>
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
                <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $project->title) }}" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Résumé <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror"
                                  id="excerpt" name="excerpt" rows="3" required>{{ old('excerpt', $project->excerpt) }}</textarea>
                        @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description complète <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="8" required>{{ old('description', $project->description) }}</textarea>
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
                                <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
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
                                <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>En cours</option>
                                <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Terminé</option>
                                <option value="suspended" {{ old('status', $project->status) == 'suspended' ? 'selected' : '' }}>Suspendu</option>
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
                                   id="start_date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}">
                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Date de fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                   id="end_date" name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}">
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Localisation</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   id="location" name="location" value="{{ old('location', $project->location) }}">
                            @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="budget" class="form-label">Budget (FCFA)</label>
                            <input type="number" class="form-control @error('budget') is-invalid @enderror"
                                   id="budget" name="budget" value="{{ old('budget', $project->budget) }}" min="0">
                            @error('budget')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Changer l’image principale</label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                               id="featured_image" name="featured_image" accept="image/*">
                        @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($project->featured_image)
                            <img src="{{ asset('storage/' . $project->featured_image) }}" alt="Image actuelle" class="img-fluid mt-2" style="max-height: 200px;">
                        @endif
                    </div>

                    <!-- Objectifs -->
                    <div class="mb-3">
                        <label class="form-label">Objectifs</label>
                        <div id="objectives-container">
                            @forelse(old('objectives', $project->objectives ?? []) as $objective)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="objectives[]" value="{{ $objective }}" placeholder="Objectif...">
                                <button type="button" class="btn btn-outline-danger remove-objective">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            @empty
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="objectives[]" placeholder="Objectif...">
                                <button type="button" class="btn btn-outline-danger remove-objective" disabled>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-objective">
                            <i class="fas fa-plus me-1"></i>Ajouter un objectif
                        </button>
                    </div>

                    <!-- Résultats attendus -->
                    <div class="mb-3">
                        <label class="form-label">Résultats attendus</label>
                        <div id="results-container">
                            @forelse(old('expected_results', $project->expected_results ?? []) as $result)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="expected_results[]" value="{{ $result }}" placeholder="Résultat attendu...">
                                <button type="button" class="btn btn-outline-danger remove-result">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            @empty
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="expected_results[]" placeholder="Résultat attendu...">
                                <button type="button" class="btn btn-outline-danger remove-result" disabled>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" id="add-result">
                            <i class="fas fa-plus me-1"></i>Ajouter un résultat
                        </button>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1"
                               {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Projet phare (affiché en priorité)
                        </label>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1"
                               {{ old('is_published', $project->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            Publier
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Enregistrer les modifications
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const projectTypeSelect = document.querySelector('#project_type');
        const budgetInput = document.querySelector('#budget_section');

        if (projectTypeSelect && budgetInput) {
            projectTypeSelect.addEventListener('change', function () {
                if (this.value === 'funded') {
                    budgetInput.style.display = 'block';
                } else {
                    budgetInput.style.display = 'none';
                }
            });

            // Initial display logic
            if (projectTypeSelect.value !== 'funded') {
                budgetInput.style.display = 'none';
            }
        }

        // Autres scripts possibles : datepicker, WYSIWYG, etc.
        if (typeof ClassicEditor !== 'undefined') {
            const editors = document.querySelectorAll('.editor');
            editors.forEach(editorEl => {
                ClassicEditor.create(editorEl).catch(error => {
                    console.error('Erreur lors de l\'initialisation de l\'éditeur :', error);
                });
            });
        }
    });
</script>
@endpush


@endsection
