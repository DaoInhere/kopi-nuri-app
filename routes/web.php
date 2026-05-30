<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OwnerAkunController;
use App\Http\Controllers\OwnerMenuController;

Route::get('/', function () {
    return view('auth/login');
});

// Rute untuk halaman daftar menu (Bisa diakses pelanggan tanpa harus login)
Route::get('/menu', [MenuController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Khusus Kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/beranda', [KasirController::class, 'index'])->name('kasir.beranda');
    Route::get('/kasir/menu', [MenuController::class, 'index'])->name('kasir.menu');
    
    Route::patch('/menu/{menu}/toggle-availability', [MenuController::class, 'toggleAvailability'])
    ->name('menu.toggleAvailability');
    
    Route::get('/kasir/riwayatPesanan', [PesananController::class, 'index'])->name('kasir.riwayat.pesanan');
    
    Route::get('/kasir/pesanan/create', [PesananController::class, 'create'])->name('kasir.pesanan.create');
    Route::post('/kasir/pesanan', [PesananController::class, 'store'])->name('kasir.pesanan.store');
    Route::get('/kasir/pesanan/{order}', [PesananController::class, 'show'])->name('kasir.pesanan.show');    
    Route::patch('/kasir/pesanan/{order}/lunas', [PesananController::class, 'markLunas'])->name('kasir.pesanan.lunas');
    Route::patch('/kasir/pesanan/{order}/selesai', [PesananController::class, 'markSelesai'])->name('kasir.pesanan.selesai');
    Route::patch('/kasir/pesanan/{order}/batal', [PesananController::class, 'markBatal'])->name('kasir.pesanan.batal');
});

// Rute Khusus Owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/beranda', [OwnerController::class, 'index'])->name('owner.beranda');
    
    Route::get('/owner/laporan', [OwnerController::class, 'laporan'])->name('owner.laporan');
    Route::get('/owner/laporan/cetak', [OwnerController::class, 'cetakLaporan'])->name('owner.laporan.cetak'); // <-- Ini rute baru untuk cetak PDF
    
    // Rute Kelola Menu CRUD
    Route::get('/owner/menu', [OwnerMenuController::class, 'index'])->name('owner.menu.index');
    Route::post('/owner/menu', [OwnerMenuController::class, 'store'])->name('owner.menu.store');
    Route::put('/owner/menu/{id}', [OwnerMenuController::class, 'update'])->name('owner.menu.update');
    Route::delete('/owner/menu/{id}', [OwnerMenuController::class, 'destroy'])->name('owner.menu.destroy');

    // Rute Manajemen Akun
    Route::get('/owner/akun', [OwnerAkunController::class, 'index'])->name('owner.akun.index');
    Route::post('/owner/akun', [OwnerAkunController::class, 'store'])->name('owner.akun.store');
    Route::delete('/owner/akun/{id}', [OwnerAkunController::class, 'destroy'])->name('owner.akun.destroy');
});

require __DIR__.'/auth.php';