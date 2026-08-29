@extends('admin.mainlayout')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Daftar Lapak</h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('dashboard.lapak.tambah_lapak') }}" class="btn btn-primary">Tambah</a>
                <form method="GET" action="{{ route('dashboard.lapak') }}" class="d-flex align-items-center" style="gap: 10px;">
                    <div class="mr-1 mb-2">
                        <form method="GET" action="{{ route('dashboard.lapak') }}" class="d-flex align-items-center" style="gap: 10px;">
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
                                <input type="text" class="form-control search-bar" placeholder="Nama lapak" name="search" value="{{ request('search') }}" aria-label="Search">
                                <div class="input-group-append mb-2">
                                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                        
                    </div>   
                
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama lapak</th>
                            <th>Nomor lapak</th>
                            <th>Nama penyewa</th>
                            <th>Nama pasar</th>
                            <th>Status</th>
                            <th>Masa berlaku</th>
                            <th>Luas (m2)</th>
                            <th>Retribusi (Rp)</th>
                            <th>Aksi</th>
                        </tr>
                   
                    <tbody>
                       @forelse ($lapak as $item)
                       <tr>
                        <td>{{ ($lapak->currentPage() - 1) * $lapak->perPage() + $loop->iteration }}</td>
                        <td>{{$item->nama_lapak}}</td>
                        <td>{{$item->nomor_lapak}}</td>
                        <td>{{$item->nama_penyewa}}</td>
                        <td class="text-capitalize">{{ $item->pasar->nama_pasar}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->masa_berlaku}}</td>
                        <td>{{$item->luas}}</td>
                        <td>{{$item->retribusi}}</td>
                        <td>
                            <a href="{{ route('dashboard.lapak.edit_lapak', $item->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('dashboard.lapak.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus lapak ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                       </tr>
                       @empty
                       <tr>
                        <td colspan="10" class="text-center">Tidak ada data lapak ditemukan.</td>
                    </tr>
                       @endforelse
                    </tbody>
                    </thead>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $lapak->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@endsection
