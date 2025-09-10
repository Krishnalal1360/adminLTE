@extends('admin.layouts.master')

@section('content')
<form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">

        <!-- Blog Title -->
        <div class="form-group">
            <label for="blog_title">Blog Title</label>
            <input type="text"
                   name="title"
                   value=""
                   class="form-control @error('blog_title') is-invalid @enderror"
                   placeholder="Enter blog title">
            @error('blog_title') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Blog Description -->
        <div class="form-group">
            <label for="blog_description">Blog Description</label>
            <textarea id="blog_description"
                      name="description"
                      class="form-control @error('blog_description') is-invalid @enderror"
                      placeholder="Enter blog description"></textarea>
            @error('blog_description') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Blog Image -->
        <div class="form-group">
            <label for="blog_image">Blog Image</label>
            <input type="file"
                   name="blog_image"
                   id="blog_image"
                   class="form-control @error('blog_image') is-invalid @enderror">

            @error('blog_image') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror

            <!-- Preview before uploading -->
            <div class="mt-2">
                <img id="preview_image" 
                     src="#" 
                     alt="Preview" 
                     class="rounded-circle shadow-sm d-none" 
                     width="80" height="80"
                     style="object-fit: cover; border: 2px solid #ddd;">
            </div>
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Create Blog
        </button>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary ml-2">
            Cancel
        </a>
    </div>
</form>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#blog_description').summernote({
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
