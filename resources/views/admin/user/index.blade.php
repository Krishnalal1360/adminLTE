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
    <!-- Page Header -->
    <section class="content-header">
        <div class="container-fluid px-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User List</h1>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary float-right">
                        <i class="fas fa-user-plus"></i> Create New User
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
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
                    <!--
                    <h3 class="card-title">Users</h3>
                    -->
                    <div class="btn-group">
                        <a href="{{ route('admin.user.export', 'pdf') }}" class="btn btn-danger btn-sm">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                        <a href="{{ route('admin.user.export', 'excel') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel"></i> Excel
                        </a>
                        <a href="{{ route('admin.user.export', 'csv') }}" class="btn btn-warning btn-sm text-white">
                            <i class="fas fa-file-csv"></i> CSV
                        </a>
                        <a href="{{ route('admin.user.export', 'print') }}" target="_blank" class="btn btn-secondary btn-sm">
                            <i class="fas fa-print"></i> Print
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @forelse($userLists as $user)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @php $i++; @endphp
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $userLists->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
