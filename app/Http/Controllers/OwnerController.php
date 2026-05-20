<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function index()
    {
        // Nanti tambahkan logika hitung pendapatan harian/bulanan di sini
        // Sementara  arahkan ke view dulu
        return view('owner.beranda');
    }
}