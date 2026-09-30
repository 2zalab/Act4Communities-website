<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnershipRequestFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            // Informations organisation
            'org_name' => ['required', 'string', 'max:255'],
            'org_type' => ['required', 'in:ngo,company,institution,university,foundation,other'],
            'website' => ['nullable', 'url', 'max:255'],

            // Personne de contact
            'name' => ['required', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],

            // Type de partenariat
            'partnership_type' => ['required', 'in:financial,technical,strategic,academic'],

            // Domaines d'intervention (categories)
            'domains' => ['nullable', 'array'],
            'domains.*' => ['exists:categories,id'],

            // Description
            'message' => ['required', 'string', 'max:5000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'org_name.required' => __('Le nom de l\'organisation est obligatoire.'),
            'org_name.max' => __('Le nom de l\'organisation ne peut pas dépasser 255 caractères.'),

            'org_type.required' => __('Le type d\'organisation est obligatoire.'),
            'org_type.in' => __('Le type d\'organisation sélectionné n\'est pas valide.'),

            'website.url' => __('Le site web doit être une URL valide.'),
            'website.max' => __('Le site web ne peut pas dépasser 255 caractères.'),

            'name.required' => __('Le nom de la personne de contact est obligatoire.'),
            'name.max' => __('Le nom ne peut pas dépasser 255 caractères.'),

            'position.max' => __('La fonction ne peut pas dépasser 255 caractères.'),

            'email.required' => __('L\'adresse email est obligatoire.'),
            'email.email' => __('L\'adresse email doit être valide.'),
            'email.max' => __('L\'adresse email ne peut pas dépasser 255 caractères.'),

            'phone.max' => __('Le numéro de téléphone ne peut pas dépasser 20 caractères.'),

            'partnership_type.required' => __('Le type de partenariat est obligatoire.'),
            'partnership_type.in' => __('Le type de partenariat sélectionné n\'est pas valide.'),

            'domains.array' => __('Les domaines d\'intervention doivent être un tableau.'),
            'domains.*.exists' => __('L\'un des domaines sélectionnés n\'existe pas.'),

            'message.required' => __('La description de votre proposition est obligatoire.'),
            'message.min' => __('La description doit contenir au moins 10 caractères.'),
            'message.max' => __('La description ne peut pas dépasser 5000 caractères.'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'org_name' => __('nom de l\'organisation'),
            'org_type' => __('type d\'organisation'),
            'website' => __('site web'),
            'name' => __('personne de contact'),
            'position' => __('fonction'),
            'email' => __('email'),
            'phone' => __('téléphone'),
            'partnership_type' => __('type de partenariat'),
            'domains' => __('domaines d\'intervention'),
            'message' => __('description de la proposition'),
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Nettoyer et formater les données
        if ($this->has('website') && $this->website) {
            $website = $this->website;
            if (!str_starts_with($website, 'http://') && !str_starts_with($website, 'https://')) {
                $website = 'https://' . $website;
            }
            $this->merge(['website' => $website]);
        }

        if ($this->has('phone') && $this->phone) {
            // Nettoyer le numéro de téléphone
            $phone = preg_replace('/[^+\d\s\-\(\)]/', '', $this->phone);
            $this->merge(['phone' => $phone]);
        }
    }
}
