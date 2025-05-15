<?php

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes','required', 'string', 'max:255'],
            'gender' => ['sometimes', 'required', Rule::in(GenderEnum::values())],
            'email' => ['sometimes','required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['nullable', 'numeric', 'digits_between:10,12'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }
}
