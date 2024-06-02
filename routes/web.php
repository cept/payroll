<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LemburController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    Route::middleware(['isAdmin'])->group(function () {
        Route::resource('/user', ProfileController::class);
    });
    
    Route::resource('bagian', BagianController::class);
    Route::post('/bagian/search', [BagianController::class, 'search'])->name('bagian.search');
    
    Route::resource('karyawan', KaryawanController::class);
    Route::post('/karyawan/search', [KaryawanController::class, 'search'])->name('karyawan.search');
    Route::get('/karyawan/{kode_karyawan}/gaji', [KaryawanController::class, 'getGaji']);
    
    Route::resource('lembur', LemburController::class);
    Route::post('/lembur/search', [LemburController::class, 'search'])->name('lembur.search');
    
    Route::resource('pinjaman', PinjamanController::class);
    Route::post('/pinjaman/search', [PinjamanController::class, 'search'])->name('pinjaman.search');
    
    Route::resource('penggajian', PenggajianController::class);
    Route::post('/penggajian/search', [PenggajianController::class, 'search'])->name('penggajian.search');
    Route::get('/penggajian/{kode_karyawan}/export', [PenggajianController::class, 'export'])->name('penggajian.export');
    Route::get('/karyawan/{kode_karyawan}/pinjaman', [PenggajianController::class, 'getPinjamanDetails']);
    Route::get('/karyawan/{kode_karyawan}/lembur', [PenggajianController::class, 'getLemburDetails']);
    
    Route::get('/laporan', function () {
        return view('laporan.index', ['title' => 'Laporan']);
    });
    Route::get('/laporan/bagian', [LaporanController::class, 'exportBagian'])->name('laporan.bagian');
    Route::get('/laporan/karyawan', [LaporanController::class, 'exportKaryawan'])->name('laporan.karyawan');
    Route::get('/laporan/lembur', [LaporanController::class, 'exportLembur'])->name('laporan.lembur');
    Route::get('/laporan/pinjaman', [LaporanController::class, 'exportPinjaman'])->name('laporan.pinjaman');
    Route::get('/laporan/penggajian', [LaporanController::class, 'exportPenggajian'])->name('laporan.penggajian');
});

