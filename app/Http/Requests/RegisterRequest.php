<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'firstName.required' => 'First name is required.',
            'firstName.string' => 'First name is invalid.',
            'firstName.max' => 'First name must not exceed 255 characters.',
            'lastName.required' => 'Last name is required.',
            'lastName.string' => 'Last name is invalid.',
            'lastName.max' => 'Last name must not exceed 255 characters.',
            'email.required' => 'Email is required.',
            'email.string' => 'Email is invalid.',
            'email.email' => 'Email must be a valid email address.',
            'email.max' => 'Email must not exceed 255 characters.',
            'email.unique' => 'Email has already been taken.',
            'password.required' => 'Password is required.',
            'password.string' => 'Password is invalid.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
