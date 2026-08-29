@extends('auth.auth')

@section('title', 'SIGAP DISPERDAGIN')

@section('content')
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <h4>Password Anda telah berhasil direset!</h4>
                <p>Silakan login kembali menggunakan password baru Anda.</p>
                
                <a href="{{ route('login') }}" class="btn btn-primary">Kembali ke Login</a>
           @endsection
