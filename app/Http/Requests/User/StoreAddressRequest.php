<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'address' => 'required|string|min:3|max:255',
            'ste' => 'nullable|string|min:3|max:255',
            'city' => 'required|string|min:3|max:255',
            'province_id' => 'required|numeric|exists:provinces,id',
            'zip' => 'required|numeric',
            'insurances' => 'required|array',
            'insurances.*' => 'required|numeric|exists:insurances,id',
        ];
    }
}
