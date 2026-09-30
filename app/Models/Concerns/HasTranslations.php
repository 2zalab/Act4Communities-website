<?php

namespace App\Models\Concerns;

use Illuminate\Http\Request;

/**
 * Contenu bilingue : le français est stocké dans les colonnes habituelles,
 * les autres langues dans la colonne JSON "translations" :
 *   {"en": {"title": "...", "excerpt": "..."}}
 *
 * Sur le site public, quand la langue choisie est l'anglais, les champs
 * listés dans $translatable renvoient automatiquement la version anglaise
 * (ou le français si la traduction est vide). L'administration voit
 * toujours les valeurs françaises d'origine.
 */
trait HasTranslations
{
    public function initializeHasTranslations()
    {
        $this->mergeCasts(['translations' => 'array']);
    }

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->translatable ?? [], true) && static::shouldTranslate()) {
            $translated = $this->translation($key, app()->getLocale());

            if (!static::isBlank($translated)) {
                return $translated;
            }
        }

        return $value;
    }

    /**
     * Valeur traduite brute (sans repli sur le français).
     */
    public function translation(string $key, string $locale = 'en')
    {
        $translations = parent::getAttribute('translations') ?? [];

        return $translations[$locale][$key] ?? null;
    }

    /**
     * Enregistre les traductions envoyées par le formulaire (translations[en][champ]).
     */
    public function fillTranslationsFromRequest(Request $request, array $lines = []): static
    {
        $input = (array) $request->input('translations', []);
        $translations = parent::getAttribute('translations') ?? [];

        foreach ($input as $locale => $fields) {
            foreach ((array) $fields as $key => $value) {
                if (!in_array($key, $this->translatable ?? [], true)) {
                    continue;
                }

                // Listes (objectifs, résultats…) saisies une par ligne
                if (in_array($key, $lines, true) && is_string($value)) {
                    $value = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value))));
                }

                if (static::isBlank($value)) {
                    unset($translations[$locale][$key]);
                } else {
                    $translations[$locale][$key] = is_string($value) ? trim($value) : $value;
                }
            }

            if (empty($translations[$locale])) {
                unset($translations[$locale]);
            }
        }

        $this->translations = $translations ?: null;

        return $this;
    }

    protected static function shouldTranslate(): bool
    {
        if (app()->getLocale() === 'fr') {
            return false;
        }

        return !request()->is('admin', 'admin/*');
    }

    protected static function isBlank($value): bool
    {
        return $value === null || $value === '' || $value === [];
    }
}
