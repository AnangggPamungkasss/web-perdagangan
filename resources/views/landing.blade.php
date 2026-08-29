@extends('index')

@section('title', 'SIGAP DISPERDAGIN')

@section('content')
<section class="section">
            <h1>SIGAP</h1>
            <p>Website ini memuat informasi tentang data lapak dan pasar yang ada di kota gorontalo serta 
                memuat tentang Grafik perubahan harga bahan pokok yang ada di kota Gorontalo</p>
            <p></p>
            <p></p>
            <p>klik tombol dibawah untuk melihat peta</p>
            <a href="#map-section">
                <button>Lihat Peta</button>
            </a>
        </section>

        <section id="map-section" class="map-section">
            <div class="search-form">
                <input type="text" id="search-input" placeholder="Cari pasar">
                <button id="search-button">Cari</button>
            </div>

            <div id="search-results" style="margin-top: 20px; max-height: 200px; overflow-y: auto;"></div>

            <div id="map" style="height: 400px;"></div>
            <script src="{{asset('asset/js/app.js')}}"></script>
        </section>
@endsection


