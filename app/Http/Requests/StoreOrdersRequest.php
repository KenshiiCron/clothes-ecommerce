<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'order_number' => 'required|string|unique:orders,order_number',
            'name' => 'required|string',
            'address' => 'nullable|string',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'total_price' => 'required|numeric',
            'sub_total_price' => 'required|numeric',
            'shipping_price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'total_qty' => 'required|integer',
            'wilaya_name' => 'nullable|string',
            'commune_name' => 'nullable|string',
            'delivery_state' => 'required|integer',
            'payment_method' => 'required|integer',
            'payment_state' => 'required|integer',
        ];
    }
}
