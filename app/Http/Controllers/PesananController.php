<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('kasir.riwayatPesanan', compact('orders'));
    }

    public function create()
    {
        $mejas = Meja::orderByRaw("
            CASE 
                WHEN status = 'kosong' THEN 0
                WHEN status = 'terisi' THEN 1
                ELSE 2
            END
        ")
        ->orderBy('nomor_meja')
        ->get();

        return view('kasir.pesanan', [
            'menus' => Menu::all(),
            'mejas' => $mejas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'items' => 'required|array',
            'items.*.qty' => 'nullable|integer|min:0',
        ]);

        // Ambil hanya item yang qty-nya > 0
        $items = collect($request->items)->filter(function ($item) {
            return isset($item['qty']) && (int) $item['qty'] > 0;
        });

        if ($items->isEmpty()) {
            return redirect()->back()->with('error', 'Minimal pilih 1 menu.');
        }

        DB::beginTransaction();

        try {
            // 1. buat order utama
            $order = Order::create([
                'kasir_id' => Auth::id(),
                'meja_id' => $request->meja_id,
                'total_harga' => 0,
                'status_pesanan' => 'proses',
            ]);

            $total = 0;

            // 2. simpan order items
            foreach ($items as $menuId => $item) {
                $qty = (int) ($item['qty'] ?? 0);
                $menu = Menu::findOrFail($menuId);

                $subtotal = $menu->harga * $qty;
                $total += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'qty' => $qty,
                    'subtotal' => $subtotal,
                ]);
            }

            // 3. update total order
            $order->update([
                'total_harga' => $total
            ]);

            // 4. update status meja
            Meja::where('id', $request->meja_id)->update([
                'status' => 'digunakan'
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal membuat pesanan.');
        }
    }

    public function show($id)
    {
        $order = Order::with([
            'meja',
            'kasir',
            'orderItems.menu'
        ])->findOrFail($id);

        return view('kasir.strukpesanan', compact('order'));
    }

    public function markSelesai($order)
    {
        $order = Order::findOrFail($order);

        $order->status_pesanan = 'selesai';
        $order->save();

        if ($order->meja_id) {
            $meja = Meja::find($order->meja_id);
            if ($meja) {
                $meja->status = 'kosong';
                $meja->save();
            }
        }

        return redirect()->back()->with('success', 'Pesanan sudah selesai');
    }

    public function markBatal($order)
    {
        $order = Order::findOrFail($order);

        $order->status_pesanan = 'batal';
        $order->save();

        if ($order->meja_id) {
            $meja = Meja::find($order->meja_id);
            if ($meja) {
                $meja->status = 'kosong';
                $meja->save();
            }
        }

        return redirect()->back()->with('success', 'Pesanan dibatalkan');
    }

}
