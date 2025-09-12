@extends('admin.layouts.master')

@section('content')
<div class="container-fluid p-4">

    <h1 class="mb-4 text-center">Welcome, {{ $adminName }}</h1>

    <div class="row justify-content-center">
        <!-- Contacts Card -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-info shadow rounded">
                <div class="inner">
                    <h3>{{ $contactCount }}</h3>
                    <p>Total Contacts</p>
                </div>
                <div class="icon">
                    <i class="fas fa-address-book"></i>
                </div>
                <a href="{{ route('admin.contact.index') }}" class="small-box-footer">
                    View Contacts <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Blogs Card -->
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="small-box bg-success shadow rounded">
                <div class="inner">
                    <h3>{{ $blogCount }}</h3>
                    <p>Total Blogs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-blog"></i>
                </div>
                <a href="{{ route('admin.blog.index') }}" class="small-box-footer">
                    View Blogs <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
