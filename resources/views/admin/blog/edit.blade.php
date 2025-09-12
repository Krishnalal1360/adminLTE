@extends('admin.layouts.master')

@section('content')
@php
    $currentPage = 'blog';
@endphp

<div class="content-wrapper" style="min-height: 80vh; padding: 20px 40px;">

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary" style="width: 600px; margin-top: 30px;">
                <div class="card-header">
                    <h3 class="card-title text-center w-100">Blog Details</h3>
                </div>

                <form action="{{ route('admin.blog.update', $blogList->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Blog Title -->
                        <div class="form-group">
                            <label for="title">Blog Title</label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', e($blogList->title)) }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Enter blog title">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Description -->
                        <div class="form-group">
                            <label for="blog_description">Blog Description</label>
                            <textarea name="description"
                                      id="blog_description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="5">{{ old('description', $blogList->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blog Image -->
                        <div class="form-group">
                            <label for="blog_image">Blog Image</label>
                            <input type="file"
                                   id="blog_image"
                                   name="blog_image"
                                   class="form-control @error('blog_image') is-invalid @enderror">
                            @error('blog_image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                            <div class="mt-2">
                                @if(!empty($blogList->file))
                                    <img src="{{ asset('storage/' . $blogList->file) }}"
                                         alt="Blog Image"
                                         class="rounded shadow-sm"
                                         width="120"
                                         height="120"
                                         style="object-fit: cover; border: 2px solid #ddd;">
                                @endif

                                <img id="preview_image"
                                     src="#"
                                     alt="Preview"
                                     class="rounded shadow-sm d-none mt-2"
                                     width="120"
                                     height="120"
                                     style="object-fit: cover; border: 2px solid #ddd;">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary ml-2">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#blog_description').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
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
