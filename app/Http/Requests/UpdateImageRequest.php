<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'images' => ['sometimes', 'nullable', 'array'],
            'images.*' => ['sometimes', 'nullable', 'image', 'max:' . config('settings.max_upload_size')],
            'deleted_images' => ['sometimes', 'nullable', 'array'],
            'deleted_images.*' => ['sometimes', 'nullable'],
        ];
    }
}
