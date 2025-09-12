@extends('admin.layouts.master')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card card-primary shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="card-title text-center w-100">Contact Details</h3>
            </div>

            <div class="card-body">
                <!-- Name -->
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name', $userList->name) }}"
                           class="form-control"
                           readonly>
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email', $userList->email) }}"
                           class="form-control"
                           readonly>
                </div>

                <!-- Phone -->
                <div class="form-group mb-3">
                    <label for="phone">Phone</label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone', $userList->phone) }}"
                           class="form-control"
                           readonly>
                </div>

                <!-- Message -->
                <div class="form-group mb-3">
                    <label for="message">Message</label>
                    <textarea name="message"
                              class="form-control"
                              rows="4"
                              readonly>{{ old('message', $userList->message) }}</textarea>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
