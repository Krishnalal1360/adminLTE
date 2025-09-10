@extends('admin.layouts.master')

@section('content')
<form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name">
            @error('name') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Enter email">
            @error('email') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Enter password">
            @error('password') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Create User
        </button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary ml-2">
            Cancel
        </a>
    </div>
</form>
@endsection