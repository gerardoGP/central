<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorizedSystemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function prepareForValidation(): void
    {
        // Los checkboxes en HTML no envían nada si no están marcados.
        // Aquí forzamos a que sea un booleano siempre.
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'identifier'  => 'required|string|max:255|unique:authorized_systems,identifier',
            'is_active'   => 'boolean',
            'rate_limit'  => 'required|integer|min:1',
            'allowed_ips' => 'nullable|string', 
        ];
    }
}
