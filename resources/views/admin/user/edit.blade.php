@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Page Header -->
    <!--
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit User</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary float-right">
                    <i class="fas fa-arrow-left"></i> Back to Users
                </a>
            </div>
        </div>
    </section>
    -->

    <!-- Main Content -->
    <section class="content">
        <div class="row justify-content-start">
            <div class="col-lg-8 col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                    </div>

                    <!-- Form Start -->
                    <form action="{{ route('admin.user.update', $userList->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $userList->name) }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Enter name">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', $userList->email) }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter email">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">Password <small>(leave blank to keep current)</small></label>
                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Enter new password">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Update User
                            </button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary ml-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
