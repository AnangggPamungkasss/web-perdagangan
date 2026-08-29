@extends('admin.mainlayout')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Edit User</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.user.update', $user->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="kosongkan jika tidak ingin mengganti password">

                
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
                    
                </div class="form-grup">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dashboard.user') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
