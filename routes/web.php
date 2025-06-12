<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualanController;

// Route untuk login & logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource routes
    Route::resource('kategori', KategoriController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('pembelian', PembelianController::class);
    Route::resource('pembeli', PembeliController::class);

    // Route cetak penjualan (diletakkan sebelum resource penjualan supaya tidak ketimpa)
    Route::get('/penjualan/cetak', [PenjualanController::class, 'cetakPdf'])->name('penjualan.cetakpdf');
    Route::get('/penjualan/{id}/cetak-detail', [PenjualanController::class, 'cetakDetail'])->name('penjualan.cetakdetail');

    Route::resource('penjualan', PenjualanController::class);
});
