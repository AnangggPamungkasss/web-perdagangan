<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP DISPERDAGIN @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/dashboard.css') }}">
</head>

<body>
    <div class="main">
    <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <img src="{{ asset('asset/images/logo.png') }}" alt="logo">
        <span class="navbar-brand">SIGAP DISPERDAGIN</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
        data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

        <div class="body-content h-100">
        <div class="row g-0 h-100">
            <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarContent">
                @if (Auth::user()->role_id == 1)
                <a href ="{{ url('/') }}"> 
                    <i class="bi bi-globe-asia-australia"></i>Kunjungi Website</a>
                <a href="{{ route('dashboard.index') }}">
                    <i class="bi bi-house-door-fill"></i>Dashboard</a>
                <a href="{{ route('dashboard.user') }}">
                    <i class="bi bi-person-fill"></i>User</a>
                <a href="{{ route('dashboard.pasar') }}">
                    <i class="bi bi-building"></i>Pasar</a>
                <a href="{{ route('dashboard.lapak') }}">
                    <i class="bi bi-shop-window"></i>Lapak</a>
                <a href="{{ route('dashboard.komoditas') }}">
                    <i class="bi bi-box"></i>Komoditas</a>
                    <hr>
                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-left"></i>Keluar</a>
                @else
                <a href ="{{ url('/') }}"> 
                    <i class="bi bi-globe-asia-australia"></i>Kunjungi Website</a>
                <a href="{{ route('dashboard.index') }}">
                    <i class="bi bi-house-door-fill"></i>Dashboard</a>
                <a href="{{ route('dashboard.pasar') }}">
                    <i class="bi bi-building"></i>Pasar</a>
                <a href="{{ route('dashboard.lapak') }}">
                    <i class="bi bi-shop-window"></i>Lapak</a>
                <a href="{{ route('dashboard.komoditas') }}">
                    <i class="bi bi-box"></i>Komoditas</a>
                    <hr>
                <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-left"></i>Keluar</a>
                @endif
            
            </div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmLogoutBtn">OK</button>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

            <div class="content p-5 col-10">
                @yield('content')
            </div>
        </div>
    </div>


    <script src="{{ asset('asset/js/logout.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
