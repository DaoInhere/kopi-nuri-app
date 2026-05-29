<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // =========================================================
        // TAMBAHAN LOGIKA UNTUK GRAFIK (7 Hari Terakhir)
        // =========================================================
        $tanggalMulai = Carbon::today()->subDays(6);
        $pesananMingguIni = Order::where('status_pesanan', 'selesai')
                                ->where('created_at', '>=', $tanggalMulai)
                                ->selectRaw('DATE(created_at) as tanggal, SUM(total_harga) as total')
                                ->groupBy('tanggal')
                                ->orderBy('tanggal', 'asc')
                                ->get();

        $labelGrafik = [];
        $dataGrafik = [];

        // Looping untuk memastikan hari yang tidak ada transaksi tetap bernilai 0
        for ($i = 0; $i < 7; $i++) {
            $tgl = Carbon::today()->subDays(6 - $i)->format('Y-m-d');
            $labelGrafik[] = Carbon::parse($tgl)->translatedFormat('d M'); // Format: "23 Mei"
            
            $pendapatanHariItu = $pesananMingguIni->where('tanggal', $tgl)->first();
            $dataGrafik[] = $pendapatanHariItu ? (int) $pendapatanHariItu->total : 0;
        }

        // Melempar variabel ke view (ditambah variabel untuk grafik)
        return view('owner.beranda', compact('pendapatanHarian', 'pendapatanBulanan', 'labelGrafik', 'dataGrafik'));
    }

    public function laporan()
    {
        $orders = Order::with(['kasir', 'meja'])
                    ->where('status_pesanan', 'selesai')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('owner.laporan', compact('orders'));
    }

    public function cetakLaporan()
    {
        // Ambil data yang sama seperti di halaman laporan
        $orders = Order::with(['kasir', 'meja'])
                    ->where('status_pesanan', 'selesai')
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        // Hitung total seluruh pendapatan dari laporan tersebut
        $totalPendapatan = $orders->sum('total_harga');

        // Panggil view khusus PDF dan kirim datanya
        $pdf = Pdf::loadView('owner.laporan-pdf', compact('orders', 'totalPendapatan'));
        
        // Menampilkan PDF di browser (bisa juga pakai ->download() untuk langsung unduh)
        return $pdf->stream('Laporan_Penjualan_Kopi_Nuri.pdf');
    }
}