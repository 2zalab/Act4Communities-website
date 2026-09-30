{{-- resources/views/admin/partials/translation-field.blade.php
     Version anglaise d'un champ, affichée à côté du champ français.
     Paramètres : $model (modèle ou null), $field, $label, $type (text|textarea|lines), $rows --}}
@php
    $type = $type ?? 'text';
    $inputId = 'translation_en_' . $field;
    $current = ($model ?? null) ? $model->translation($field, 'en') : null;
    if ($type === 'lines' && is_array($current)) {
        $current = implode("\n", $current);
    }
    $value = old('translations.en.' . $field, $current);
@endphp
<div class="mb-3">
    <label for="{{ $inputId }}" class="form-label">
        <span class="badge lang-badge lang-badge-en me-1">EN</span>{{ $label }}
    </label>
    @if($type === 'text')
        <input type="text" class="form-control @error('translations.en.' . $field) is-invalid @enderror"
               id="{{ $inputId }}" name="translations[en][{{ $field }}]" value="{{ $value }}"
               placeholder="English version (optional)">
    @else
        <textarea class="form-control @error('translations.en.' . $field) is-invalid @enderror"
                  id="{{ $inputId }}" name="translations[en][{{ $field }}]"
                  rows="{{ $rows ?? ($type === 'lines' ? 4 : 3) }}"
                  placeholder="{{ $type === 'lines' ? 'One item per line (optional)' : 'English version (optional)' }}">{{ $value }}</textarea>
    @endif
    @error('translations.en.' . $field)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-text">Si vide, le texte français est affiché.</div>
</div>
