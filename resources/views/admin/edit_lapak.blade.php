@extends('admin.mainlayout')

@section('title', 'Edit Lapak')

@section('content')
<h1>Edit Lapak</h1>

<div class="mt-5 w-75">
    <form action="{{ route('dashboard.lapak.update', $lapak->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_lapak" class="form-label">Nama Lapak</label>
            <input type="text" name="nama_lapak" id="nama_lapak" class="form-control" placeholder="Nama Lapak" value="{{ old('nama_lapak', $lapak->nama_lapak) }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_lapak" class="form-label">Nomor Lapak</label>
            <input type="text" name="nomor_lapak" id="nomor_lapak" class="form-control" placeholder="Nomor Lapak" value="{{ old('nomor_lapak', $lapak->nomor_lapak) }}" required>
        </div>

        <div class="mb-3">
            <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
            <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control" placeholder="Nama Penyewa" value="{{ old('nama_penyewa', $lapak->nama_penyewa) }}" required>
        </div>

        <div class="mb-3">
            <label for="pasar_id" class="form-label">Nama Pasar</label>
            <select name="pasar_id" id="pasar_id" class="form-control" required>
                <option value="" disabled>Pilih Pasar</option>
                @foreach ($pasar as $p)
                    <option value="{{ $p->id }}" {{ old('pasar_id', $lapak->pasar_id) == $p->id ? 'selected' : '' }}>{{ $p->nama_pasar }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Isi" {{ old('status', $lapak->status) == 'Isi' ? 'selected' : '' }}>Isi</option>
                <option value="Kosong" {{ old('status', $lapak->status) == 'Kosong' ? 'selected' : '' }}>Kosong</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="masa_berlaku" class="form-label">Masa Berlaku</label>
            <input type="date" name="masa_berlaku" id="masa_berlaku" class="form-control" value="{{ old('masa_berlaku', $lapak->masa_berlaku) }}" required>
        </div>

        <div class="mb-3">
            <label for="luas" class="form-label">Luas</label>
            <input type="number" name="luas" id="luas" class="form-control" value="{{ old('luas', $lapak->luas) }}" required>
        </div>

        <div class="mb-3">
            <label for="retribusi" class="form-label">Retribusi</label>
            <input type="number" name="retribusi" id="retribusi" class="form-control" value="{{ old('retribusi', $lapak->retribusi) }}" required>
        </div>

        <div class="mt-3 d-flex justify-content-between">
            <a href="{{ route('dashboard.lapak') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Perbarui</button>
        </div>
    </form>
</div>

@endsection
