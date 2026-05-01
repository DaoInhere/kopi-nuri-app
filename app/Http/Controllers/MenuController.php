<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // Wajib dipanggil agar Controller mengenali tabel menus

class MenuController extends Controller
{
    // Fungsi untuk mengambil dan menampilkan semua menu
    public function index()
    {
        // Mengambil seluruh data yang ada di tabel 'menus'
        $menus = Menu::all();

        // KARENA HALAMAN BLADE-NYA BELUM DIBUAT OLEH TIM FRONTEND:
        // Sementara kita kembalikan datanya dalam bentuk JSON 
        // agar kamu bisa melihat hasilnya langsung di browser.
        return response()->json([
            'status' => 'success',
            'pesan' => 'Data menu berhasil diambil!',
            'data' => $menus
        ]);
        
        /* Nanti, kalau Jazy dan Farsya sudah selesai membuat file tampilan 'menu.blade.php', 
        kamu tinggal mengganti kode return di atas menjadi:
        return view('menu', compact('menus'));
        */
    }
}