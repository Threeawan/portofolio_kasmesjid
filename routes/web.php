<?php

use App\Models\Input\InputKas;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Mesjid\MesjidController;
use App\Http\Controllers\Manajemen\ManajemenController;
use App\Http\Controllers\Pemasukan\PemasukanController;
use App\Http\Controllers\Pengeluaran\PengeluaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('mesjid.dashboard');
});



Route::get('/mesjid',[MesjidController::class, 'index'])->name('mesjid.index');

Route::get('/mesjid_dashboard', [MesjidController::class, 'dashboard'])->name('dashboard.create');

Route::get('/mesjid_detail',[MesjidController::class, 'show'])->name('mesjid.detail');
Route::post('/mesjid_simpan',[MesjidController::class, 'store'])->name('mesjid.post');
Route::get('/mesjid_delete/{id}',[MesjidController::class, 'destroy'])->name('mesjid.delete');
Route::get('/mesjid_laporan',[MesjidController::class, 'cetakLaporan'])->name('mesjid.laporan');
Route::get('/mesjid_edit/{id}',[MesjidController::class, 'edit'])->name('mesjid.edit');
Route::post('/mesjid_update/{id}',[MesjidController::class, 'update'])->name('mesjid.update');
Route::get('/mesjid_filter',[[MesjidController::class, 'filter']])->name('mesjid.filter');



Route::get('/manajemen',[ManajemenController::class, 'index'])->name('manajemen.index');
Route::get('/manajemen_detail',[ManajemenController::class, 'show'])->name('manajemen.detail');
Route::post('/manajemen',[ManajemenController::class, 'store'])->name('manajemen.post');
Route::get('/manajemen_edit/{id}',[ManajemenController::class, 'edit'])->name('manajemen.edit');
Route::post('/manajemen_update/{id}',[ManajemenController::class, 'update'])->name('manajemen.update');
Route::get('/manajemen_delete/{id}',[ManajemenController::class, 'destroy'])->name('manajemen.delete');
Route::get('/manajemen_dashboard',[ManajemenController::class, 'dashboard'])->name('manajemen.dashboard');

Route::get('/sesi_index',[SessionController::class, 'index'])->name('sesi.index');
Route::post('/sesi_login',[SessionController::class, 'login'])->name('sesi.login');







