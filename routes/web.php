<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
});

// Rute Khusus Owner
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/beranda', [OwnerController::class, 'index'])->name('owner.beranda');
});

require __DIR__.'/auth.php';