<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My CMS')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Summernote CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .nav-link.active { 
            background-color: #0d6efd; 
            color: white !important; 
        }

        main {
            flex: 1; /* makes content expand and pushes footer down */
        }

        footer {
            background-color: #f8f9fa; 
            padding: 15px 0; 
            text-align: center;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    @include('admin.cms.layouts.header')

    {{-- Main Content --}}
    <main class="container my-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('admin.cms.layouts.footer')

    <!-- jQuery (required for Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <!-- Page-specific scripts -->
    @stack('scripts')
</body>
</html>
