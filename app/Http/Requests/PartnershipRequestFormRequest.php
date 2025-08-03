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
            'org_name.required' => 'Le nom de l\'organisation est obligatoire.',
            'org_name.max' => 'Le nom de l\'organisation ne peut pas dépasser 255 caractères.',

            'org_type.required' => 'Le type d\'organisation est obligatoire.',
            'org_type.in' => 'Le type d\'organisation sélectionné n\'est pas valide.',

            'website.url' => 'Le site web doit être une URL valide.',
            'website.max' => 'Le site web ne peut pas dépasser 255 caractères.',

            'name.required' => 'Le nom de la personne de contact est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',

            'position.max' => 'La fonction ne peut pas dépasser 255 caractères.',

            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',

            'phone.max' => 'Le numéro de téléphone ne peut pas dépasser 20 caractères.',

            'partnership_type.required' => 'Le type de partenariat est obligatoire.',
            'partnership_type.in' => 'Le type de partenariat sélectionné n\'est pas valide.',

            'domains.array' => 'Les domaines d\'intervention doivent être un tableau.',
            'domains.*.exists' => 'L\'un des domaines sélectionnés n\'existe pas.',

            'message.required' => 'La description de votre proposition est obligatoire.',
            'message.min' => 'La description doit contenir au moins 10 caractères.',
            'message.max' => 'La description ne peut pas dépasser 5000 caractères.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'org_name' => 'nom de l\'organisation',
            'org_type' => 'type d\'organisation',
            'website' => 'site web',
            'name' => 'personne de contact',
            'position' => 'fonction',
            'email' => 'email',
            'phone' => 'téléphone',
            'partnership_type' => 'type de partenariat',
            'domains' => 'domaines d\'intervention',
            'message' => 'description de la proposition',
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
