<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only logged-in users (admin) can update profile
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // max 2MB
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.string' => 'The Name must be a valid string.',
            'name.max' => 'The Name may not be greater than 255 characters.',
            'email.email' => 'Please provide a valid Email address.',
            'email.max' => 'The Email may not be greater than 255 characters.',
            'password.min' => 'Password must be at least 8 characters.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Allowed image formats: jpg, jpeg, png, gif, webp.',
            'image.max' => 'Maximum allowed image size is 2MB.',
        ];
    }
}
