@extends('admin.mainlayout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Daftar User</h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('dashboard.user.tambah_user') }}" class="btn btn-primary">Tambah</a>

                <form method="GET" action="{{ route('dashboard.user') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari email" name="search" value="{{ request()->get('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>role</th>
                            <th>pertayaan keamanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->role ? $item->role->name : 'Tidak ada role' }}</td>
                                <td>{{ $item->security_question ?? 'Belum diatur' }}</td>
                                <td>
                                   
                                    <a href="{{ route('dashboard.user.edit_user', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    
                                    <form action="{{ route('dashboard.user.delete', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
