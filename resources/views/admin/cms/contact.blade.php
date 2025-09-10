@extends('admin.cms.layouts.master')

@php
    $currentPage = 'contact';
@endphp

@section('title', 'Create Contact')

@section('content')
<form action="{{ route('admin.cms.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">

        <!-- Contact Title -->
        <div class="form-group">
            <label for="contact_title">Title</label>
            <input type="text"
                   name="title"
                   value="{{ old('title') }}"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="Enter title" required>
            @error('title') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Contact Description -->
        <div class="form-group">
            <label for="contact_description">Description</label>
            <textarea id="contact_description"
                      name="description"
                      class="form-control @error('description') is-invalid @enderror"
                      placeholder="Enter description" required>{{ old('description') }}</textarea>
            @error('description') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Contact Image -->
        <div class="form-group">
            <label for="blog_image">Upload Image</label>
            <input type="file"
                   name="blog_image"
                   id="blog_image"
                   class="form-control @error('blog_image') is-invalid @enderror" required>

            @error('blog_image') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror

            <!-- Preview before uploading -->
            <div class="mt-2">
                <img id="preview_image" 
                     src="#" 
                     alt="Preview" 
                     class="rounded shadow-sm d-none" 
                     width="120" height="120"
                     style="object-fit: cover; border: 2px solid #ddd;">
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Create
        </button>
        <a href="{{ route('admin.cms.index') }}" class="btn btn-secondary ml-2">
            Cancel
        </a>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#contact_description').summernote({
            height: 200
        });

        // Image preview before uploading
        $('#blog_image').on('change', function (event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_image')
                        .attr('src', e.target.result)
                        .removeClass('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endpush
