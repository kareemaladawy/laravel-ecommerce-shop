<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:25|regex:/^[a-z ,.\'-]+$/i',
            'first_name' => 'required|string|max:25|regex:/^[a-z ,.\'-]+$/i',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => ['required', Password::defaults()],
            'city' => 'nullable|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'country' => 'nullable|string|max:100|regex:/^[a-zA-Z\x{0600}-\x{06FF} ]+$/u',
            'phone_number' => 'required|string|regex:/^01[0125][0-9]{8}$/'
        ];
    }
}
