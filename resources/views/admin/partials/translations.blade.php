{{-- resources/views/admin/partials/translations.blade.php
     Champs de la version anglaise d'un contenu.
     Paramètres : $model (modèle ou null), $fields = ['champ' => ['label' => ..., 'type' => 'text|textarea|lines', 'rows' => n]] --}}
@php
    $translationModel = $model ?? null;
@endphp
<div class="card border-info mb-4 translation-card">
    <div class="card-header bg-info bg-opacity-10 d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-bold">
            <i class="fas fa-language me-2 text-info"></i>Version anglaise (English)
        </h6>
        <small class="text-muted">Facultatif</small>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">
            <i class="fas fa-info-circle me-1"></i>
            Ces textes s'affichent lorsque le visiteur choisit « English ». Si un champ est laissé vide, la version française est affichée.
        </p>

        @foreach($fields as $field => $options)
            @php
                $type = $options['type'] ?? 'text';
                $inputId = 'translation_en_' . $field;
                $current = $translationModel ? $translationModel->translation($field, 'en') : null;
                if ($type === 'lines' && is_array($current)) {
                    $current = implode("\n", $current);
                }
                $value = old('translations.en.' . $field, $current);
            @endphp
            <div class="mb-3">
                <label for="{{ $inputId }}" class="form-label">
                    {{ $options['label'] }} <span class="badge bg-light text-dark border">EN</span>
                </label>
                @if($type === 'text')
                    <input type="text" class="form-control @error('translations.en.' . $field) is-invalid @enderror"
                           id="{{ $inputId }}" name="translations[en][{{ $field }}]" value="{{ $value }}">
                @else
                    <textarea class="form-control @error('translations.en.' . $field) is-invalid @enderror"
                              id="{{ $inputId }}" name="translations[en][{{ $field }}]"
                              rows="{{ $options['rows'] ?? ($type === 'lines' ? 4 : 3) }}">{{ $value }}</textarea>
                    @if($type === 'lines')
                        <div class="form-text">Un élément par ligne.</div>
                    @endif
                @endif
                @error('translations.en.' . $field)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endforeach
    </div>
</div>
