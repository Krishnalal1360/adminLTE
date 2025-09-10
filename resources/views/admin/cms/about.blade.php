@extends('admin.cms.layouts.master')

@php
    $currentPage = 'about';
@endphp

@section('title', $blog->title ?? 'Blog Details')

@section('content')
    <div class="card shadow-lg mx-auto" style="max-width: 800px;">
        <div class="card-header text-center bg-dark text-white">
            <h2 class="mb-0">{{ $blog->title }}</h2>
        </div>

        <div class="card-body text-center">
            @if(!empty($blog->file))
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $blog->file) }}" 
                         class="img-fluid rounded" 
                         style="max-height: 350px; object-fit: cover; width: 100%; max-width: 600px;"
                         alt="Blog Image">
                </div>
            @endif

            <div class="text-left">
                <p class="lead">{!! $blog->description !!}</p>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('admin.cms.index') }}" class="btn btn-secondary">Back to Blogs</a>
        </div>
    </div>
@endsection
