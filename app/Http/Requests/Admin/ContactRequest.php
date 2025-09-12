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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $contactId = $this->route('id') ?? null; // for update case

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z]+(?:\s[A-Za-z]+)*$/', // only letters and spaces
            ],
            'email' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/',
            'unique:contacts,email' . ($contactId ? ',' . $contactId : ''),
            ],

            'phone' => [
                'required',
                'digits:10', // exactly 10 digits
            ],
            'message' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string'   => 'The name must be a valid string.',
            'name.max'      => 'The name may not be greater than 255 characters.',
            'name.regex'    => 'The name can only contain letters and spaces (first and last name).',

            'email.required' => 'The email field is required.',
            'email.email'    => 'Please provide a valid email address (example: name@domain.com).',
            'email.max'      => 'The email may not be greater than 255 characters.',
            'email.unique'   => 'This email is already registered.',

            'phone.required' => 'The phone field is required.',
            'phone.digits'   => 'The phone must contain exactly 10 digits.',

            'message.required' => 'The message field is required.',
            'message.string'   => 'The message must be valid text.',
        ];
    }
}
