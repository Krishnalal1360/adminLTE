<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Allow admins to submit
    }

    public function rules(): array
    {
        $userId = $this->route('id') ?? null; // For update

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z]+(\s[A-Za-z]+)?$/'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email' . ($userId ? ",$userId" : '')
            ],
            'password' => $this->isMethod('post') 
                ? 'required|string|min:6'  // On create
                : 'nullable|string|min:6', // On update
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the full name.',
            'name.regex'    => 'The name must contain only letters and a single space between first and last name.',
            'email.required'=> 'Please enter a valid email address.',
            'email.unique'  => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min'      => 'Password must be at least 6 characters.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => trim($this->email),
        ]);
    }
}
