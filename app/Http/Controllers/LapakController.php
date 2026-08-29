<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\lapak;
use App\Models\Pasar;

class LapakController extends Controller
{
   
        public function index(Request $request)
        {
            $pasar =Pasar::all();
            $query = Lapak::with('pasar');
        
            if ($request->has('market_filter') && $request->market_filter != '') {
                $query->whereHas('pasar', function ($q) use ($request) {
                    $q->where('nama_pasar', $request->market_filter);
                });
            }
        
            if ($request->has('search') && $request->search != '') {
                $query->where('nama_lapak', 'like', '%' . $request->search . '%');
            }
        
            $lapak = $query->paginate(10)->appends($request->all());
        
            return view('admin.lapak', compact('lapak', 'pasar'));
        }
        
    

    public function tambah_lapak()
    {
        $pasar = pasar::all();
        return view('admin.tambah_lapak', compact('pasar'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_lapak' => 'required|string|max:255',
        'nomor_lapak' => 'required|string|max:255',
        'nama_penyewa' => 'required|string|max:255',
        'pasar_id' => 'required|exists:pasar,id',  
        'status' => 'required|string|max:255',
        'masa_berlaku' => 'required|date',
        'luas' => 'required|numeric',
        'retribusi' => 'required|integer',
    ]);

    Lapak::create([
        'nama_lapak' => $validatedData['nama_lapak'],
        'nomor_lapak' => $validatedData['nomor_lapak'],
        'nama_penyewa' => $validatedData['nama_penyewa'],
        'pasar_id' => $validatedData['pasar_id'],
        'status' => $validatedData['status'],
        'masa_berlaku' => $validatedData['masa_berlaku'],
        'luas' => $validatedData['luas'],
        'retribusi' => $validatedData['retribusi'],
    ]);

    return redirect()->route('dashboard.lapak')->with('success', 'Lapak berhasil ditambahkan!');
}

public function edit($id)
{
    $lapak = Lapak::findOrFail($id);
    $pasar = Pasar::all();
    return view('admin.edit_lapak', compact('lapak', 'pasar'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_lapak' => 'required|string|max:255',
        'nomor_lapak' => 'required|string|max:255',
        'nama_penyewa' => 'required|string|max:255',
        'pasar_id' => 'required|exists:pasar,id',  
        'status' => 'required|string|max:255',
        'masa_berlaku' => 'required|date',
        'luas' => 'required|numeric',
        'retribusi' => 'required|integer',
    ]);

    $lapak = Lapak::findOrFail($id);
    $lapak->update($validatedData);

    return redirect()->route('dashboard.lapak')->with('success', 'Data lapak berhasil diperbarui!');
}

public function delete($id)
{
    $lapak = Lapak::findOrFail($id);
    $lapak->delete();

    return redirect()->route('dashboard.lapak')->with('success', 'Data lapak berhasil dihapus!');
}


public function tampil_lapak(Request $request)
{
    $nama_pasar = $request->query('pasar');

    $pasar = Pasar::where('nama_pasar', $nama_pasar)->first();

    if (!$pasar) {
        return back()->with('error', 'Pasar tidak ditemukan');
    }

    $search = $request->query('search', null);

    $lapak = Lapak::where('pasar_id', $pasar->id)
    ->when($search, function ($query, $search) {
        return $query->where(function ($query) use ($search) {
           $query->where ('nama_lapak', 'like', "%$search%")
            ->orWhere('nama_penyewa', 'like', "%$search%");
        });
        
    })
    ->paginate(10)->appends($request->all());

    return view('tampil_lapak', compact('lapak','pasar'));
}







}
