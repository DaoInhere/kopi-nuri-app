<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Kopi Nuri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-lg">
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <h1 class="text-2xl font-bold tracking-wider text-amber-500">KOPI NURI</h1>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="{{ route('owner.beranda') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Beranda</a>
                <a href="{{ route('owner.menu.index') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Kelola Menu</a>
                <a href="{{ route('owner.laporan') }}" class="block px-4 py-2 bg-amber-500 text-slate-900 font-semibold rounded-lg">Laporan Keuangan</a>
                <a href="{{ route('owner.akun.index') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Manajemen Akun</a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-slate-800 rounded-lg transition">Logout</button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col">
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-gray-700">Laporan Keuangan</h2>
            </header>

            <div class="p-8 flex-1 overflow-y-auto">
                
                <div class="bg-white p-6 rounded-xl shadow-sm mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Riwayat Transaksi Selesai</h3>
                        <p class="text-sm text-gray-500">Daftar semua pesanan yang telah dibayar oleh pelanggan.</p>
                    </div>
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                        Cetak Laporan
                    </button>
                </div>

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kasir</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Meja</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Total Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->kasir->name ?? 'Kasir Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-semibold">
                                        Meja {{ $order->meja->nomor_meja ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-emerald-600 text-right">
                                        Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        Belum ada riwayat transaksi yang diselesaikan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</body>
</html>