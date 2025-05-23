<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
            'old_price' => ['required', 'numeric', 'min:1'],
            'sku' => ['nullable', 'string', 'max:255'],
        ];
    }
}
