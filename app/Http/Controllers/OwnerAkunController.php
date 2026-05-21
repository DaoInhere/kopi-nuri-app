<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class OwnerAkunController extends Controller
{
    // Menampilkan halaman manajemen akun
    public function index()
    {
        // Hanya mengambil user yang memiliki role 'kasir'
        $kasirs = User::where('role', 'kasir')->orderBy('id', 'desc')->get();
        return view('owner.akun', compact('kasirs'));
    }

    // Menyimpan akun kasir baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir', // Paksa role menjadi kasir
        ]);

        return redirect()->back()->with('success', 'Akun Kasir berhasil ditambahkan!');
    }

    // Menghapus akun kasir
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Akun Kasir berhasil dihapus!');
    }
}