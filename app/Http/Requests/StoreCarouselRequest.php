<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarouselRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'action' => ['nullable', 'string', 'max:2048'],
            'type' => ['required', 'integer', 'in:0,1,2'],
            'state' => ['required', 'integer', 'in:0,1'],
            'image' => ['required', 'image', 'max:'.config('settings.max_upload_size')],
        ];
    }
}
