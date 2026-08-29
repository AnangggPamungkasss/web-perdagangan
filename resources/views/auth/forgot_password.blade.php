@extends('auth.auth')

@section('title', 'SIGAP DISPERDAGIN')

@section('content')
    <form action="{{ route('password.reset') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Lanjutkan</button>
        
        <div class="mt-3">
            <a href="{{ route('login') }}" class="btn btn-link">Kembali ke Login</a>
        </div>
    </form>
@endsection
