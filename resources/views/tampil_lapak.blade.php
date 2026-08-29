@extends('index')

@section('title', 'SIGAP DISPERDAGIN')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Data Lapak di {{$pasar->nama_pasar}}</h2>
            <form action="{{ route('index.tampil_lapak') }}" method="GET" class="d-flex">
                <input type="hidden" name="pasar" value="{{ $pasar->nama_pasar }}"> 
                <input 
                    type="text" name="search" class="form-control me-2" placeholder="lapak atau penyewa" value="{{ request('search') }}" style="width: 200px;">
                <button type="submit" class="btn btn-primary">cari</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lapak</th>
                        <th>Nomor Lapak</th>
                        <th>Nama Penyewa</th>
                        <th>Status</th>
                        <th>Masa Berlaku</th>
                        <th>Luas (m²)</th>
                        <th>Retribusi (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lapak as $index => $item)
                        <tr>
                            <td>{{ ($lapak->currentPage() - 1) * $lapak->perPage() + $index + 1 }}</td>
                            <td>{{ $item->nama_lapak }}</td>
                            <td>{{ $item->nomor_lapak }}</td>
                            <td>{{ $item->nama_penyewa }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->masa_berlaku }}</td>
                            <td>{{ $item->luas }}</td>
                            <td>{{ number_format($item->retribusi, 0, ',', '.') }}</td> 
                        </tr>
                    @empty
                        <tr> 
                            <td colspan="8" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $lapak->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
