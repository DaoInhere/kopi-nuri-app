<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Order;
use Carbon\Carbon;

class KasirController extends Controller
{
    public function index()
    {
        // Mengambil semua data meja
        $mejas = Meja::all();
        
        // Menghitung meja kosong dan digunakan
        $mejaKosong = Meja::where('status', 'kosong')->count();
        $mejaDigunakan = Meja::where('status', 'digunakan')->count();
        
        // Menghitung order hari ini (opsional, untuk navbar)
        $orderHariIni = Order::whereDate('created_at', Carbon::today())->count();

        // Mengarahkan ke file view blade dan membawa data
        return view('kasir.beranda', compact('mejas', 'mejaKosong', 'mejaDigunakan', 'orderHariIni'));
    }
}