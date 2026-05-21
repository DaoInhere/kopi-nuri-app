<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class OwnerMenuController extends Controller
{
    // Menampilkan halaman kelola menu
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->get();
        return view('owner.menu', compact('menus'));
    }

    // Menyimpan menu baru (Create)
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'is_available' => $request->has('is_available') ? true : false,
        ]);

        return redirect()->back()->with('success', 'Menu Kopi berhasil ditambahkan!');
    }

    // Mengupdate menu (Update)
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        
        $menu->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'is_available' => $request->has('is_available') ? true : false,
        ]);

        return redirect()->back()->with('success', 'Data menu berhasil diperbarui!');
    }

    // Menghapus menu (Delete)
    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }
}