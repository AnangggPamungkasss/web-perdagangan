@extends('auth.auth')

@section('title', 'SIGAP DISPERDAGIN')

@section('content')
        <form action="{{ route('password.reset.submit') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="mb-3">
                <label for="answer" class="form-label">{{ $question }}</label>
                <input type="text" name="answer" class="form-control" placeholder="Masukkan jawaban Anda" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Reset Password</button>
        </form>
   @endsection
