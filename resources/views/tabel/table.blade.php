@extends('tabel.tabel')

@section('title','SIGAP DISPERDAGIN')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3>Daftar Harga Komoditas</h3>
        </div>
        <div class="card-body">
            <!-- Form Filter -->
            <form method="GET" action="{{ route('table') }}" class="filter-form">
                <div class="filter-group">
                    <!-- Filter Pasar -->
                    <label for="pasar">Pilih Pasar:</label>
                    <select id="pasar" name="pasar">
                        <option value="">Pilih Pasar</option>
                        @foreach($pasar as $p)
                            <option value="{{ $p->id }}" {{ $selectedPasar == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_pasar }}
                            </option>
                        @endforeach
                    </select>
                </div>
    
                <div class="filter-group">
                    <!-- Filter Tanggal -->
                    <label for="tanggal">Pilih Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ $selectedDate }}">
                </div>
    
                <button type="submit" class="btn-filter">Filter</button>
            </form>
    
            <!-- Tabel -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Komoditas</th>
                        <th>Satuan</th>
                        <th>{{ \Carbon\Carbon::parse($selectedDate)->subDay()->format('d M') }}</th>
                        <th>{{ \Carbon\Carbon::parse($selectedDate)->format('d M') }}</th>
                        <th>Perubahan (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($komoditas as $index => $data)
                        <tr>
                            <td>{{ $data->nama_komoditas }}</td>
                            <td>{{ $data->satuan }}</td>
                            <td>
                                @if(is_numeric($data->harga_kemarin))
                                    {{ number_format($data->harga_kemarin, 0, ',', '.') }}
                                @else
                                    - 
                                @endif
                            </td>
                            <td>
                                @if(is_numeric($data->harga_hari_ini))
                                    {{ number_format($data->harga_hari_ini, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ isset($data->perubahan_persen) ? number_format($data->perubahan_persen, 2) : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('asset/js/grafik.js') }}"></script>
@endsection
