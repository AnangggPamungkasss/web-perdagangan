<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/login.css') }}">
</head>

<body>
    <div class="card">
        <div class="card-body text-center">
            <img src="{{ asset('asset/images/logo.png') }}" alt="Logo">
            <h5 class="card-title mt-3">SIGAP DISPERDAGIN</h5>

            {{-- Tempat untuk konten halaman lain --}}
            @yield('content')

            <script src="{{ asset('asset/js/login.js') }}"></script>
        </div>
    </div>
</body>
</html>
