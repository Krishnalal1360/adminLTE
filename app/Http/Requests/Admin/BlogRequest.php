<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules(): array
{
    $blogId   = $this->route('id') ?? null; 
    $isCreate = $this->isMethod('post');

    return [
        'title' => [
            'nullable',
            'string',
            'max:255',
            'unique:blogs,title' . ($blogId ? ",$blogId" : ''),
        ],
        'description' => [
            'nullable',
            'string',
            'min:10',
            'unique:blogs,description' . ($blogId ? ",$blogId" : ''),
        ],

        // Case 1: uploaded image
        'blog_image' => array_filter([
            $isCreate ? 'required_without:file' : 'nullable',
            'image',
            'mimes:jpg,jpeg,png,gif,webp',
            'max:2048',
        ]),

        // Case 2: file path (string)
        'file' => array_filter([
            $isCreate ? 'required_without:blog_image' : 'nullable',
            'string',
            'unique:blogs,file' . ($blogId ? ",$blogId" : ''),
        ]),
    ];
}


    public function messages(): array
    {
        return [
            'title.required'       => 'Please enter a blog title.',
            'title.max'            => 'The blog title must not exceed 255 characters.',
            'title.unique'         => 'This blog title is already taken.',

            'description.required' => 'Please enter a blog description.',
            'description.min'      => 'The description must be at least 10 characters long.',
            'description.unique'   => 'This blog description already exists.',

            'blog_image.required_without' => 'Please upload an image for the blog or provide a file path.',
            'blog_image.image'            => 'The uploaded file must be an image.',
            'blog_image.mimes'            => 'Allowed image formats are jpg, jpeg, png, gif, webp.',
            'blog_image.max'              => 'The image must not exceed 2MB.',
            'blog_image.unique'           => 'This image has already been used in another blog.',

            'file.required_without' => 'Please provide a file path if no image is uploaded.',
            'file.string'           => 'The file field must be a string path.',
            'file.unique'           => 'This file path has already been used in another blog.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title'       => $this->title ? trim($this->title) : null,
            'description' => $this->description ? trim($this->description) : null,
        ]);
    }
}
