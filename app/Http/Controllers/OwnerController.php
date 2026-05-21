<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function index()
    {
        // Mendapatkan tanggal hari ini, serta bulan dan tahun saat ini
        $hariIni = Carbon::today();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // Menghitung total pendapatan harian (hanya pesanan 'selesai')
        $pendapatanHarian = Order::where('status_pesanan', 'selesai')
                                ->whereDate('created_at', $hariIni)
                                ->sum('total_harga');

        // Menghitung total pendapatan bulanan (hanya pesanan 'selesai')
        $pendapatanBulanan = Order::where('status_pesanan', 'selesai')
                                ->whereMonth('created_at', $bulanIni)
                                ->whereYear('created_at', $tahunIni)
                                ->sum('total_harga');

        // Melempar variabel ke view
        return view('owner.beranda', compact('pendapatanHarian', 'pendapatanBulanan'));
    }

    public function laporan()
    {
        $orders = Order::with(['kasir', 'meja'])
                    ->where('status_pesanan', 'selesai')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('owner.laporan', compact('orders'));
    }
}