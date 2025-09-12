@extends('admin.layouts.master')

@section('styles')
<style>
    /* Override AdminLTE default left margin */
    .content-wrapper {
        margin-left: 0 !important;
    }
</style>
@endsection

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<!-- Page Header -->
<section class="content-header">
    <div class="container-fluid px-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blog List</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary float-right">
                    <i class="fas fa-file-alt"></i> Create New Blog
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid px-3">

        @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                    location.reload();
                    }, 3000);
                </script>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('admin.blog.export', 'pdf') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                    <a href="{{ route('admin.blog.export', 'excel') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                    <a href="{{ route('admin.blog.export', 'csv') }}" class="btn btn-warning btn-sm text-white">
                        <i class="fas fa-file-csv"></i> CSV
                    </a>
                    {{--  
                    <a href="{{ route('admin.blog.export', 'print') }}" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fas fa-print"></i> Print
                    </a>
                    --}}
                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Title</th>
                            {{--  
                            <th>Description</th>
                            --}}
                            <th>Image</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogLists as $key => $blog)
                        <tr>
                            <td>{{ $key + $blogLists->firstItem() }}</td>
                            <td>{{ $blog->title }}</td>
                            {{--  
                            <td>{!! Str::limit(strip_tags($blog->description), 50) !!}</td>
                            --}}
                            <td>
                                @if(!empty($blog->file))
                                    <img src="{{ asset('storage/' . $blog->file) }}" 
                                         alt="Blog Image" 
                                         class="rounded-circle" 
                                         width="50" height="50">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No blogs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $blogLists->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
