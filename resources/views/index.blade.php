<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/home.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('asset/images/logo.png') }}" alt="logo">
        </div>
        <div class="nav">
            <a href="/">Home</a>
            <a href="/grafik">Grafik</a>
            <a href="/table">Tabel</a>
            <a href="/login">Login</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

   

    <footer>
        <p>2024 ||  development by Anang Pamungkas</p>
    </footer>
</body>
</html>
