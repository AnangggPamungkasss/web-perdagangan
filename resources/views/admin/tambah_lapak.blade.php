@extends('admin.mainlayout')

@section('title', 'dashboard')

@section('content')
<h1>Tambah Lapak</h1>

<div class="mt-5 w-75">
    <form action="{{ route('dashboard.lapak.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_lapak" class="form-label">Nama Lapak</label>
            <input type="text" name="nama_lapak" id="nama_lapak" class="form-control" placeholder="Nama Lapak" required>
        </div>

        <div class="mb-3">
            <label for="nomor_lapak" class="form-label">Nomor Lapak</label>
            <input type="text" name="nomor_lapak" id="nomor_lapak" class="form-control" placeholder="Nomor Lapak" required>
        </div>

        <div class="mb-3">
            <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
            <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control" placeholder="Nama Penyewa" required>
        </div>

        <div class="mb-3">
            <label for="pasar_id" class="form-label">Nama Pasar</label>
            <select name="pasar_id" id="pasar_id" class="form-control" required>
                <option value="" disabled selected>Pilih Pasar</option>
                @foreach ($pasar as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_pasar }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="" disabled selected>Pilih Status</option>
                <option value="Isi">Isi</option>
                <option value="Kosong">Kosong</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="masa_berlaku" class="form-label">Masa Berlaku</label>
            <input type="date" name="masa_berlaku" id="masa_berlaku" class="form-control" placeholder="Masa Berlaku" required>
        </div>

        <div class="mb-3">
            <label for="luas" class="form-label">Luas</label>
            <input type="number" name="luas" id="luas" class="form-control" placeholder="Luas" required>
        </div>

        <div class="mb-3">
            <label for="retribusi" class="form-label">Retribusi</label>
            <input type="number" name="retribusi" id="retribusi" class="form-control" placeholder="Retribusi" required>
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <a href="{{ route('dashboard.lapak') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>

@endsection
