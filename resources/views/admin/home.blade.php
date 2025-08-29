<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

    <div class="text-center">
        <h1 class="mb-4">Welcome to {{ config('app.name') }}</h1>

        {{-- Show login/register if guest --}}
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
        @endguest

        {{-- If logged in, go to dashboard --}}
        @auth
            <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Go to Dashboard</a>
        @endauth
    </div>

</body>
</html>
