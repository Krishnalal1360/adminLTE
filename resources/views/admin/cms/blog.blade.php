@extends('admin.cms.layouts.master')

@php
    $currentPage = 'blog';
    use Illuminate\Support\Str;
@endphp

@section('title', 'Blog - My CMS')

@section('content')
    <h1>All Blogs</h1>
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                {{--  
                <th>Description</th>
                --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogLists as $key => $blog)
                <tr>
                    <td>{{ $blogLists->firstItem() + $key }}</td>
                    <td>
                        @if(!empty($blog->file))
                            <img 
                                src="{{ asset('storage/' . $blog->file) }}" 
                                width="80" 
                                alt="Blog Image"
                                onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $blog->title }}</td>
                    {{-- 
                    <td>{{ Str::limit(strip_tags($blog->title), 5) }}</td>
                    --}}
                    {{--  
                    <td>{{ Str::limit(strip_tags($blog->description), 10) }}</td>
                    --}}
                    <td>
                        <a href="{{ route('cms.show', $blog->id) }}" class="btn btn-primary btn-sm">Read More</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $blogLists->links('pagination::bootstrap-4') }}
    </div>
@endsection
