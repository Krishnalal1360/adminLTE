<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow all users to make this request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $contactId = $this->route('id') ?? null; // for update case

        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'email',
                'max:255',
                'unique:contacts,email' . ($contactId ? ',' . $contactId : ''),
            ],
            'password' => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:6'],
            'message'  => ['required', 'string'],
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'The name field is required.',
            'name.string'       => 'The name must be a valid string.',
            'name.max'          => 'The name may not be greater than 255 characters.',

            'email.required'    => 'The email field is required.',
            'email.email'       => 'Please provide a valid email address.',
            'email.max'         => 'The email may not be greater than 255 characters.',
            'email.unique'      => 'This email is already registered.',

            'password.required' => 'The password field is required.',
            'password.string'   => 'The password must be a valid string.',
            'password.min'      => 'The password must be at least 6 characters long.',

            'message.required'  => 'The message field is required.',
            'message.string'    => 'The message must be valid text.',
        ];
    }
}
