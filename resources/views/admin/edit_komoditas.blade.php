@extends('admin.mainlayout')

@section('title', 'Edit Harga Komoditas')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Edit Harga Komoditas</h1>
        </div>
        <div class="card-body">
            <!-- Form untuk mengupdate harga -->
            <form action="{{ route('dashboard.komoditas.update', $komoditas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Menampilkan Nama Komoditas -->
                <div class="form-group">
                    <label for="nama_komoditas">Nama Komoditas</label>
                    <input type="text" class="form-control" id="nama_komoditas" name="nama_komoditas" value="{{ $komoditas->nama_komoditas }}" readonly>
                </div>

                <!-- Menampilkan Harga Komoditas saat ini -->
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ $komoditas->harga }}" required>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('dashboard.komoditas') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Perbarui</button>
            </form>
        </div>
    </div>
</div>

@endsection
