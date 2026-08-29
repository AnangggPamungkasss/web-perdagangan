@extends('admin.mainlayout')

@section('title', 'Edit pasar')

@section('content')
<div class="container">
    <h2>Edit Data Pasar</h2>
    <form action="{{ route('dashboard.pasar.update', $pasar->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nama Pasar</label>
            <input type="text" name="nama_pasar" class="form-control" value="{{ $pasar->nama_pasar }}" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $pasar->alamat }}" required>
        </div>
        <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="latitude" class="form-control" value="{{ $pasar->latitude }}" required>
        </div>
        <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="longitude" class="form-control" value="{{ $pasar->longitude }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
