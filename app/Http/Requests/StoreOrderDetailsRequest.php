<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreOrderDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50|regex:/^[a-zA-Z\x{0600}-\x{06FF}. ]+$/u',
            'last_name' => 'required|string|max:50|regex:/^[a-zA-Z\x{0600}-\x{06FF}. ]+$/u',
            'apartment' => 'required|numeric',
            'floor' => 'required|string|max:10|regex:/^[a-zA-Z\x{0600}-\x{06FF}0-20 ]+$/u',
            'street' => 'required|string|max:25|regex:/^[a-zA-Z\x{0600}-\x{06FF}0-20 ]+$/u',
            'building' => 'required|numeric',
            'city' => 'required|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'state' => 'required|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'country' => 'required|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'postal_code' => 'required|string|min:2|max:10',
            'phone_number' => ['required', 'string', 'regex:/^01[0125][0-9]{8}$/', Rule::unique('user_info')->ignore($this->user()->id, 'user_id')],
            'notes' => 'nullable|string|max:500',
        ];
    }
}
