<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan Kopi Nuri</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; padding: 0; }
        .header p { margin: 5px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-right { text-align: right; }
        .total-row th { background-color: #e5e7eb; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Pendapatan - Kopi Nuri</h2>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Waktu Transaksi</th>
                <th>Nama Kasir</th>
                <th>Meja</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>{{ $order->kasir->name ?? 'Dihapus' }}</td>
                    <td>{{ $order->meja->nomor_meja ?? '-' }}</td>
                    <td class="text-right">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Belum ada riwayat transaksi.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <th colspan="4" class="text-right">TOTAL PENDAPATAN KESELURUHAN</th>
                <th class="text-right">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>