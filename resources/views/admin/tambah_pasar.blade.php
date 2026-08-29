@extends('admin.mainlayout')

@section('title', 'Tambah Pasar')

@section('content')
<h1>Tambah Pasar</h1>

<div class="mt-5 w-75">
    <form action="{{ route('dashboard.pasar.store') }}" method="post">
        @csrf
        
        <div class="mb-3">
            <label for="nama_pasar" class="form-label">Nama Pasar</label>
            <input type="text" name="nama_pasar" id="nama_pasar" class="form-control" placeholder="Nama pasar" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat pasar" required>
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude</label>
            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude" required>
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude" required>
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <a href="{{ route('dashboard.pasar') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection
