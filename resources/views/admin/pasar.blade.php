@extends('admin.mainlayout')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">daftar Pasar</h1>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('dashboard.pasar.tambah_pasar') }}" class="btn btn-primary">Tambah</a>

                <form method="GET" action="{{ route('dashboard.pasar') }}">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Nama Pasar" name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pasar</th>
                            <th>Alamat</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Aksi</th>
                        </tr>

                    <tbody>
                        @foreach ($pasar as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->nama_pasar}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->latitude}}</td>
                            <td>{{$item->longitude}}</td>
                            <td>
                                <a href="{{ route('dashboard.pasar.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('dashboard.pasar.delete', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus pasar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
