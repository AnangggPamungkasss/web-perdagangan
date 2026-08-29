@extends('grafik.grafik')

@section('title','SIGAP DISPERDAGIN')

@section('content')

    <div class="card">
    <h1>Grafik Harga Komoditas - Tahunan</h1>

    <!-- Form Filter -->
    <form action="{{ route('charttahun') }}" method="GET" class="filter-form">
        <label for="nama_komoditas">Nama Komoditas:</label>
        <select name="nama_komoditas" id="nama_komoditas">
            <option value="">Pilih Komoditas</option>
            @foreach($namaKomoditasList as $komoditas)
                <option value="{{ $komoditas }}" {{ $namaKomoditas == $komoditas ? 'selected' : '' }}>{{ $komoditas }}</option>
            @endforeach
        </select>

        <div>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" required>
        </div>

        <div>
            <button type="submit">Filter</button>
        </div>
    </form>

    <!-- Grafik -->
    <div class="chart-container">
    <div class="chart-title">{{ $namaKomoditas ?: 'Pilih Komoditas' }}</div>
    <canvas id="komoditasChart" width="400" height="200"></canvas>

    <!-- Data untuk JavaScript -->
    
    <div id="chartLabels" data-labels="{{ json_encode($labels) }}" style="display: none;"></div>
    

    <div>
        <div class="buttons">
        <button id="btnHari" onclick="window.location.href='{{ route('grafik') }}'"> Data Harian</button>
        <button id="btnBulan" onclick="window.location.href='{{ route('chartbulan') }}'">Data Bulanan</button>
    </div>

    <div id="chartValuesSentral" data-values="{{ json_encode($valuesSentral) }}" style="display: none;"></div>
    <div id="chartValuesLiluwo" data-values="{{ json_encode($valuesLiluwo) }}" style="display: none;"></div>

   
   
     <script src="{{ asset('asset/js/charttahun.js') }}"></script>
@endsection
