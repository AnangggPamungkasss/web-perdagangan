<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP DISPERDAGIN</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/images/logo.png') }}">
    <link href="{{ asset('asset/css/tabel.css') }}" rel="stylesheet">
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
    
</body>
</html>
    