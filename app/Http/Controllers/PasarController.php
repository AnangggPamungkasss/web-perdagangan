<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pasar;

class PasarController extends Controller
{
    public function index( Request $request)
    {
        $query = Pasar::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_pasar', 'like', '%' . $request->search . '%');
        }

        $pasar = $query->get();

        return view('admin.pasar', compact('pasar'));
    }

    public function tambah_Pasar()
    {
        return view('admin.tambah_pasar');
    }

    public function store(Request $request)
{

    $validatedData = $request->validate([
        'nama_pasar' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'latitude' => 'required|string',
        'longitude' => 'required|string',
    ]);

    \App\Models\Pasar::create($validatedData);

    return redirect()->route('dashboard.pasar')->with('success', 'Pasar berhasil ditambahkan!');
}

public function getPasarLocations()
{
    $pasar = Pasar::all();
    $locations = $pasar->map(function ($item) {
        return [
            'id' => $item->id,
            'nama_pasar' => $item->nama_pasar,
            'alamat' => $item->alamat,
            'latitude' => $item->latitude,
            'longitude' => $item->longitude,
            'url' => route('index.tampil_lapak', ['pasar_id' => $item->id]),
        ];
    });

    return response()->json($locations);
}

public function search(Request $request)
{
    $keyword = $request->get('keyword');
    $pasar = Pasar::where('nama_pasar', 'LIKE', "%$keyword%")->get();

    return response()->json($pasar);
}


public function edit($id)
{
    $pasar = Pasar::findOrFail($id);
    return view('admin.edit_pasar', compact('pasar'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_pasar' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'latitude' => 'required|string',
        'longitude' => 'required|string',
    ]);

    $pasar = Pasar::findOrFail($id);
    $pasar->update($validatedData);

    return redirect()->route('dashboard.pasar')->with('success', 'Data pasar berhasil diperbarui!');
}

public function delete($id)
{
    $pasar = Pasar::findOrFail($id);
    $pasar->delete();

    return redirect()->route('dashboard.pasar')->with('success', 'Data pasar berhasil dihapus!');
}


}
