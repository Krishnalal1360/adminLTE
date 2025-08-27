<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>

    @include('admin.layouts.footer')

</div>

<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>
