@extends('admin.mainlayout')

@section('title', 'dashboard')

@section('content')
<h1>Tambah Barang</h1>

<div class="mt-5 w-75">
    <form action="{{ route('dashboard.komoditas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="komoditas">Komoditas</label>
            <select name="komoditas_id" id="komoditas" class="form-control" required>
                @foreach($komoditas as $komoditasItem)
                    <option value="{{ $komoditasItem->id }}">
                        {{ $komoditasItem->nama_komoditas }} ({{ $komoditasItem->satuan }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pasar">Pasar</label>
            <select name="pasar_id" id="pasar" class="form-control" required>
                <option value="" disabled selected>Pilih Pasar</option>
                @foreach($pasar as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_pasar }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
    
</div>


@endsection