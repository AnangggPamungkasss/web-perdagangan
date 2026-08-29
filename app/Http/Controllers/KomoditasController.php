<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Komoditas;
use App\Models\Pasar;

class KomoditasController extends Controller
{
    public function index(Request $request)
{
    // Ambil semua data pasar untuk dropdown filter
    $pasar = Pasar::all();

    // Query untuk data komoditas
    $query = Komoditas::with('pasar');

    // Filter berdasarkan nama pasar
    if ($request->has('market_filter') && $request->market_filter != '') {
        $query->whereHas('pasar', function ($q) use ($request) {
            $q->where('nama_pasar', $request->market_filter);
        });
    }

    // Filter berdasarkan tanggal
    if ($request->has('date_filter') && $request->date_filter != '') {
        $query->whereDate('tanggal', $request->date_filter);
    }

    // Eksekusi query
    $komoditas = $query->get();

    // Kirim data ke view
    return view('admin.komoditas', compact('komoditas', 'pasar'));
}

public function tambah_komoditas()
    {

        $pasar = Pasar::all();
        $komoditas= Komoditas::all();  

        return view('admin.tambah_komoditas', compact('komoditas', 'pasar'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'komoditas_id' => 'required|exists:komoditas,id', // Pastikan komoditas_id ada di tabel komoditas
        'pasar_id' => 'required|exists:pasar,id', // Pastikan pasar_id ada di tabel pasar
        'tanggal' => 'required|date',
        'harga' => 'required|numeric',
    ]);

    // Ambil data komoditas berdasarkan komoditas_id
    $komoditas = Komoditas::find($request->komoditas_id);

    // Cek apakah data komoditas ada
    if (!$komoditas) {
        return redirect()->route('dashboard.komoditas.tambah_komoditas')
                         ->with('error', 'Komoditas tidak ditemukan');
    }

    // Insert data ke tabel komoditas dengan menggunakan komoditas_id
    Komoditas::create([
        'komoditas_id' => $request->komoditas_id,
        'nama_komoditas' => $komoditas->nama_komoditas, // Ambil nama komoditas dari data yang ada
        'satuan' => $komoditas->satuan, // Ambil satuan dari data yang ada
        'pasar_id' => $request->pasar_id,
        'tanggal' => $request->tanggal,
        'harga' => $request->harga,
    ]);

    return redirect()->route('dashboard.komoditas')->with('success', 'Komoditas berhasil ditambahkan');
}

public function edit($id)
{
    $komoditas = Komoditas::findOrFail($id);
    $pasar = Pasar::all();
    return view('admin.edit_komoditas', compact('komoditas', 'pasar'));
}

public function update(Request $request, $id)
{
    // Validasi input harga
    $validated = $request->validate([
        'harga' => 'required|numeric',
    ]);

    // Cari komoditas berdasarkan ID
    $komoditas = Komoditas::findOrFail($id);

    // Update harga komoditas
    $komoditas->update([
        'harga' => $validated['harga']
    ]);

    // Redirect setelah berhasil update
    return redirect()->route('dashboard.komoditas')->with('success', 'Harga komoditas berhasil diperbarui');
}

public function delete($id)
{
    // Cari komoditas berdasarkan ID
    $komoditas = Komoditas::findOrFail($id);
    
    // Hapus komoditas
    $komoditas->delete();

    // Redirect setelah menghapus
    return redirect()->route('dashboard.komoditas')->with('success', 'Komoditas berhasil dihapus');
}



public function table(Request $request)
{
    $selectedDate = $request->input('tanggal', date('Y-m-d')); // Tanggal dari filter atau default hari ini
    $previousDate = date('Y-m-d', strtotime("$selectedDate -1 day")); // Tanggal sebelumnya
    $selectedPasar = $request->input('pasar', null); // Pasar yang dipilih

    $query = \DB::table('komoditas as k')
        ->leftJoin('komoditas as today', function ($join) use ($selectedDate, $selectedPasar) {
            $join->on('k.nama_komoditas', '=', 'today.nama_komoditas')
                 ->where('today.tanggal', '=', $selectedDate);
            if ($selectedPasar) {
                $join->where('today.pasar_id', '=', $selectedPasar);
            }
        })
        ->leftJoin('komoditas as yesterday', function ($join) use ($previousDate, $selectedPasar) {
            $join->on('k.nama_komoditas', '=', 'yesterday.nama_komoditas')
                 ->where('yesterday.tanggal', '=', $previousDate);
            if ($selectedPasar) {
                $join->where('yesterday.pasar_id', '=', $selectedPasar);
            }
        })
        ->select(
            'k.nama_komoditas',
            'k.satuan',
            \DB::raw('COALESCE(today.harga, "-") as harga_hari_ini'),
            \DB::raw('COALESCE(yesterday.harga, "-") as harga_kemarin'),
            \DB::raw('CASE 
                        WHEN yesterday.harga IS NOT NULL AND today.harga IS NOT NULL 
                        THEN ROUND(((today.harga - yesterday.harga) / yesterday.harga * 100), 2) 
                        ELSE NULL
                      END as perubahan_persen')
        )
        ->groupBy(
            'k.nama_komoditas',
            'k.satuan',
            'today.harga',
            'yesterday.harga'
        )
        ->orderBy('k.id', 'asc');

    $komoditas = $query->get();

    // Ambil semua data pasar untuk dropdown filter
    $pasar = \DB::table('pasar')->get();

    return view('tabel.table', compact('komoditas', 'selectedDate', 'selectedPasar', 'pasar'));
}

public function showChart(Request $request)
{
    // Ambil daftar nama komoditas untuk filter
    $namaKomoditasList = Komoditas::select('nama_komoditas')->distinct()->pluck('nama_komoditas');

    // Ambil daftar tanggal unik yang tersedia
    $tanggalList = Komoditas::select('tanggal')->distinct()->pluck('tanggal');

    // Ambil input nama komoditas dari request
    $namaKomoditas = $request->input('nama_komoditas');

    // Jika tanggal tidak dipilih, gunakan tanggal hari ini sebagai default
    $tanggal = $request->input('tanggal') ?? Carbon::now()->toDateString();

    // Hitung rentang tanggal 30 hari ke belakang
    $endDate = Carbon::parse($tanggal);
    $startDate = $endDate->copy()->subDays(29); // 30 hari termasuk tanggal yang dipilih

    // Ambil data komoditas untuk dua pasar secara langsung
    $komoditas = Komoditas::where('nama_komoditas', $namaKomoditas)
        ->whereBetween('tanggal', [$startDate, $endDate])
        ->whereIn('pasar_id', [1, 2]) // 1 = Pasar Sentral, 2 = Pasar Liluwo (sesuaikan dengan database)
        ->orderBy('tanggal', 'ASC')
        ->get();

    // Menyiapkan array untuk label tanggal dan nilai harga
    $labels = [];
    $valuesSentral = [];
    $valuesLiluwo = [];

    $currentDate = $startDate;

    while ($currentDate->lte($endDate)) {
        $labels[] = $currentDate->toDateString();

        // Ambil data sesuai tanggal untuk masing-masing pasar
        $dataSentral = $komoditas->where('pasar_id', 1)->where('tanggal', $currentDate->toDateString())->first();
        $dataLiluwo = $komoditas->where('pasar_id', 2)->where('tanggal', $currentDate->toDateString())->first();

        // Jika tidak ada data, set default 0
        $valuesSentral[] = $dataSentral ? $dataSentral->harga : 0;
        $valuesLiluwo[] = $dataLiluwo ? $dataLiluwo->harga : 0;

        $currentDate->addDay();
    }

    return view('grafik.chart', compact(
        'labels',
        'valuesSentral',
        'valuesLiluwo',
        'namaKomoditasList',
        'tanggalList',
        'namaKomoditas',
        'tanggal'
    ));
}

public function showChartBulan(Request $request)
{
    $namaKomoditasList = Komoditas::select('nama_komoditas')->distinct()->pluck('nama_komoditas');
    $tanggalList = Komoditas::select('tanggal')->distinct()->pluck('tanggal');

    $namaKomoditas = $request->input('nama_komoditas');
    $tanggal = $request->input('tanggal') ?? Carbon::now()->toDateString();
    $year = Carbon::parse($tanggal)->year;

    // Ambil data komoditas untuk dua pasar langsung
    $komoditas = Komoditas::where('nama_komoditas', $namaKomoditas)
        ->whereYear('tanggal', $year)
        ->whereIn('pasar_id', [1, 2]) // 1 = Pasar Sentral, 2 = Pasar Liluwo
        ->orderBy(DB::raw('MONTH(tanggal)'))
        ->get();

      


    $labels = [];
    $valuesSentral = [];
    $valuesLiluwo = [];

  


    // Loop semua bulan dari Januari - Desember
    for ($month = 1; $month <= 12; $month++) {
        $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
        $labels[] = $monthName;

        $dataSentral = $komoditas->where('pasar_id', 1)->filter(function ($item) use ($month) {
            return Carbon::parse($item->tanggal)->month == $month;
        })->avg('harga');

        $dataLiluwo = $komoditas->where('pasar_id', 2)->filter(function ($item) use ($month) {
            return Carbon::parse($item->tanggal)->month == $month;
        })->avg('harga');

        $valuesSentral[] = $dataSentral ?? 0;
        $valuesLiluwo[] = $dataLiluwo ?? 0;
    }

    return view('grafik.chartbulan', compact(
        'labels',
        'valuesSentral', 
        'valuesLiluwo',
        'namaKomoditasList',
        'tanggalList',
        'namaKomoditas',
        'tanggal'
    ));
}

public function showChartTahun(Request $request)
{
    $namaKomoditasList = Komoditas::select('nama_komoditas')->distinct()->pluck('nama_komoditas');
    $tahunList = Komoditas::select(DB::raw('YEAR(tanggal) as year'))->distinct()->orderBy('year', 'desc')->take(5)->pluck('year');

    $namaKomoditas = $request->input('nama_komoditas');
    $tanggal = $request->input('tanggal');
    $year = $tanggal ? Carbon::parse($tanggal)->year : Carbon::now()->subYears(5)->year;
    $startYear = $year - 4;
    $yearsInRange = range($startYear, $year);

    // Ambil data komoditas untuk dua pasar langsung
    $komoditas = Komoditas::where('nama_komoditas', $namaKomoditas)
        ->whereIn(DB::raw('YEAR(tanggal)'), $yearsInRange)
        ->whereIn('pasar_id', [1, 2])
        ->orderBy(DB::raw('YEAR(tanggal)'))
        ->get();

    $labels = [];
    $valuesSentral = [];
    $valuesLiluwo = [];

    foreach ($yearsInRange as $year) {
        $labels[] = (string)$year;

        $dataSentral = $komoditas->where('pasar_id', 1)->filter(function ($item) use ($year) {
            return Carbon::parse($item->tanggal)->year == $year;
        })->avg('harga');

        $dataLiluwo = $komoditas->where('pasar_id', 2)->filter(function ($item) use ($year) {
            return Carbon::parse($item->tanggal)->year == $year;
        })->avg('harga');

        $valuesSentral[] = $dataSentral ?? 0;
        $valuesLiluwo[] = $dataLiluwo ?? 0;
    }

    return view('grafik.charttahun', compact(
        'labels', 
        'valuesSentral',
        'valuesLiluwo',
        'namaKomoditasList',
        'tahunList',
        'namaKomoditas',
        'tanggal'
    ));
}









}
