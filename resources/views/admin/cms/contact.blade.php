@extends('admin.cms.layouts.master')

@php
    $currentPage = 'contact';
@endphp

@section('title', 'Create Contact')

@section('content')
<form action="{{ route('cms.contact.store') }}" method="POST">
    @csrf
    <div class="card-body">

        <!-- Name -->
        <div class="form-group mb-3">
            <label for="contact_name">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name" required>
            @error('name') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="contact_email">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Enter email" required>
            @error('email') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label for="contact_password">Password</label>
            <input type="password"
                   name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Enter password" required>
            @error('password') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Message -->
        <div class="form-group mb-3">
            <label for="contact_message">Message</label>
            <textarea id="contact_message"
                      name="message"
                      class="form-control @error('message') is-invalid @enderror"
                      placeholder="Enter your message" required>{{ old('message') }}</textarea>
            @error('message') 
                <span class="invalid-feedback">{{ $message }}</span> 
            @enderror
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Submit
        </button>
        <a href="{{ route('cms.index') }}" class="btn btn-secondary ml-2">
            Cancel
        </a>
    </div>
</form>
@endsection
