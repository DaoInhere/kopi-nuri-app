<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // Wajib dipanggil agar Controller mengenali tabel menus

class MenuController extends Controller
{
    // Fungsi untuk mengambil dan menampilkan semua menu
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->get();
        return view('kasir.menu', compact('menus'));
        
        /* Nanti, kalau Jazy dan Farsya sudah selesai membuat file tampilan 'menu.blade.php', 
        kamu tinggal mengganti kode return di atas menjadi:
        return view('menu', compact('menus'));
        */
    }

    public function toggleAvailability($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            $menu->update([
                'is_available' => !$menu->is_available
            ]);

            return back()->with('success', 'Status menu berhasil diubah.');

        } catch (\Exception $e) {

            return back()->with('error', 'Status menu gagal diubah.');
        }
    }
}