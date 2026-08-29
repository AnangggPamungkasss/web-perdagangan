@extends('admin.mainlayout')

@section('title', 'dashboard')



@section('content')
<h1>Tambah User</h1>

<div class="mt-5 w-75">
    <form action="{{ route('dashboard.user.store') }}" method="post">
        @csrf

        <div>
            <label for="name" class="form-label">email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="email">
        </div>

        <div>
            <label for="name" class="form-label">password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="password">
        </div>

        <div class="mb-3">
            <label for="role_id" class="form-label">role</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <option value="" disabled selected>Pilih role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="security_question">Pertanyaan Keamanan</label>
            <input type="text" class="form-control" name="security_question" id="security_question"
                value="{{ old('security_question', $user->security_question ?? '') }}" required>
        </div>
        
        <div class="form-group">
            <label for="security_answer">Jawaban Keamanan</label>
            <input type="text" class="form-control" name="security_answer" id="security_answer"
                value="{{ old('security_answer', $user->security_answer ?? '') }}" required>
        </div>
        

        <div class="mt-3 d flex justify-content-between">
        <a href="{{ route('dashboard.user') }}" class="btn btn-secondary">Kembali</a>
            <button type ="submit" class="btn btn-success">simpan</button>
        </div>
    </form>
</div>


@endsection