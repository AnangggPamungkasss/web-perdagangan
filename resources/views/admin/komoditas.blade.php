@extends('admin.mainlayout')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Daftar Komoditas</h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('dashboard.komoditas.tambah_komoditas') }}" class="btn btn-primary">Tambah</a>
                <!-- Form pencarian dan filter pasar -->
                <form method="GET" action="{{ route('dashboard.komoditas') }}" class="d-flex align-items-center" style="gap: 10px;">
                    <div class="mr-1 mb-2">
                        <select class="form-control" name="market_filter">
                            <option value="">Semua Pasar</option>
                            @foreach ($pasar as $item)
                                <option value="{{ $item->nama_pasar }}" {{ request('market_filter') == $item->nama_pasar ? 'selected' : '' }}>
                                    {{ $item->nama_pasar }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-2 mr-1">
                        <input type="date" class="form-control" name="date_filter" value="{{ request('date_filter') }}">
                    </div>

                    <div class="input-group-append mb-2">
                        <button class="btn btn-outline-secondary" type="submit">Filter</button>
                    </div>
                </form>
            </div>

            <!-- Tabel Komoditas -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Komoditas</th>
                            <th>Satuan</th>
                            <th>Nama Pasar</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($komoditas as $item)
                        <tr>
                            <td>{{ $item->nama_komoditas }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->pasar->nama_pasar ?? 'Pasar Tidak Ditemukan' }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>
                                <a href="{{ route('dashboard.komoditas.edit_komoditas', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('dashboard.komoditas.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus komoditas ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data komoditas ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
