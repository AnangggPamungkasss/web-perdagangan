<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasarController;
use App\Http\Controllers\LapakController;
use App\Http\Controllers\KomoditasController;


Route::get('/', function () {
    return view('landing'); 
});
    
Route::get('login', function () {
    return view('auth.login'); 
})->name('login')->middleware('guest');;

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/forgot-password', [AuthController::class, 'showSecurityQuestion'])->name('password.reset');
Route::post('/verify-security-answer', [AuthController::class, 'verifySecurityAnswer'])->name('password.reset.submit');

Route::get('/password/reset/success', function () {
    return view('auth.password_reset_success');
})->name('password.reset.success');




Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');  
})->name('logout');

Route::get('/table', [KomoditasController::class, 'table'])->name('table');
Route::get('/grafik', [KomoditasController::class, 'showChart'])->name('grafik');
Route::get('/chart/bulan', [KomoditasController::class, 'showChartBulan'])->name('chartbulan');
Route::get('/chart/tahun', [KomoditasController::class, 'showChartTahun'])->name('charttahun');



Route::get('/index/tampil_lapak', [LapakController::class, 'tampil_lapak'])->name('index.tampil_lapak');

Route::get('/api/pasar-locations', [PasarController::class, 'getPasarLocations']);

Route::get('/search/pasar', [PasarController::class, 'search'])->name('search.pasar');



Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index'); 

    Route::get('/user', [UserController::class, 'index'])->name('dashboard.user'); 
    Route::get('/user/tambah_user', [UserController::class, 'tambah_user'])->name('dashboard.user.tambah_user');
    Route::post('/user', [UserController::class, 'store'])->name('dashboard.user.store');
    Route::get('/user/edit_user/{id}', [UserController::class, 'edit'])->name('dashboard.user.edit_user');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('dashboard.user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('dashboard.user.delete');

    Route::get('/pasar', [PasarController::class, 'index'])->name('dashboard.pasar');
    Route::get('/pasar/tambah_pasar', [PasarController::class, 'tambah_pasar'])->name('dashboard.pasar.tambah_pasar');
    Route::post('/pasar', [PasarController::class, 'store'])->name('dashboard.pasar.store'); 
    Route::get('/pasar/edit_pasar/{id}', [PasarController::class, 'edit'])->name('dashboard.pasar.edit');
    Route::put('/pasar/update/{id}', [PasarController::class, 'update'])->name('dashboard.pasar.update');
    Route::delete('/pasar/delete/{id}', [PasarController::class, 'delete'])->name('dashboard.pasar.delete');


    Route::get('/lapak', [LapakController::class, 'index'])->name('dashboard.lapak');
    Route::get('/lapak/tambah_lapak', [LapakController::class, 'tambah_lapak'])->name('dashboard.lapak.tambah_lapak');
    Route::post('/lapak', [LapakController::class, 'store'])->name('dashboard.lapak.store'); 
    Route::get('/lapak/edit_lapak/{id}', [LapakController::class, 'edit'])->name('dashboard.lapak.edit_lapak');
    Route::put('/lapak/update/{id}', [LapakController::class, 'update'])->name('dashboard.lapak.update');
    Route::delete('/lapak/delete/{id}', [LapakController::class, 'delete'])->name('dashboard.lapak.delete');


    Route::get('/komoditas', [KomoditasController::class, 'index'])->name('dashboard.komoditas');
    Route::get('/komoditas/tambah_komoditas', [KomoditasController::class, 'tambah_komoditas'])->name('dashboard.komoditas.tambah_komoditas');
    Route::post('/komoditas', [KomoditasController::class, 'store'])->name('dashboard.komoditas.store'); 
    Route::get('/komoditas/edit_komoditas/{id}', [KomoditasController::class, 'edit'])->name('dashboard.komoditas.edit_komoditas');
    Route::put('/komoditas/update/{id}', [KomoditasController::class, 'update'])->name('dashboard.komoditas.update');
    Route::delete('/komoditas/delete/{id}', [KomoditasController::class, 'delete'])->name('dashboard.komoditas.delete');
});
