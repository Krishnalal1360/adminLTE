@extends('admin.cms.layouts.master')

@section('content')
@php
    $currentPage = 'blog_details';
@endphp

<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card card-primary shadow-sm">
            <div class="card-body text-center">
                <!-- Blog Image -->
                @if(!empty($blog->file))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $blog->file) }}"
                             alt="Blog Image"
                             class="rounded shadow-sm"
                             style="width: 100%; max-width: 400px; height: auto; object-fit: cover; border: 2px solid #ddd;">
                    </div>
                @endif

                <!-- Blog Title -->
                <h4>{{ strip_tags($blog->title) }}</h4>

                <!-- Blog Description (plain text) -->
                <div class="text-left">
                    <p>{{ strip_tags($blog->description) }}</p>
                </div>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('cms.index') }}" class="btn btn-secondary">Back to Blogs</a>
            </div>
        </div>
    </div>
</div>
@endsection
