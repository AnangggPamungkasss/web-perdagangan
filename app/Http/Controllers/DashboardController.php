<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Pasar;
use App\Models\Lapak;
use App\Models\Komoditas;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index()
    {
        $pasarCount = Pasar::count();
        $lapakCount = Lapak::count();
        $komoditasCount = Komoditas::count();
        $userCount = User::count();
        return view('admin.dashboard', ['pasar_count' => $pasarCount, 'lapak_count' => $lapakCount, 'komoditas_count' => $komoditasCount, 'user_count' => $userCount]); 
    }
}

