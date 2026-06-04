<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Kopi Nuri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        nuriDark: '#0A1603',    /* Warna background ekstra gelap sidebar */
                        nuriCream: '#F5F2EC',   /* Warna krem lembut background utama */
                        nuriGold: '#D8A44C',    /* Warna emas logo KopiNuri */
                        nuriArmy: '#547548',    /* Warna hijau army utama */
                        nuriForest: '#1D2A15'   /* Warna hijau botol pekat untuk pembatas/hover */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-nuriCream font-sans antialiased text-stone-900">
    <div class="min-h-screen flex">
        
        <aside class="w-64 bg-nuriDark text-stone-300 flex flex-col shadow-lg border-r border-[#263122]">
            <div class="h-20 flex items-center px-6 border-b border-[#263122]">
                <h1 class="text-2xl font-bold tracking-wide text-nuriGold" style="font-family: serif;">
                    Kopi<span class="text-white">Nuri</span>
                </h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">

                <a href="{{ route('kasir.beranda') }}"
                    class="block px-4 py-2.5 rounded-lg hover:bg-nuriForest hover:text-white transition duration-200">
                    Dashboard
                </a>

                <a href="{{ route('kasir.pesanan.create') }}"
                    class="block px-4 py-2.5 rounded-lg hover:bg-nuriForest hover:text-white transition duration-200">
                    Buat Pesanan
                </a>

                <a href="{{ route('kasir.menu') }}"
                    class="block px-4 py-2.5 rounded-lg hover:bg-nuriForest hover:text-white transition duration-200">
                    Daftar Menu
                </a>

                <a href="{{ route('kasir.riwayat.pesanan') }}"
                    class="block px-4 py-2.5 bg-nuriArmy text-white font-medium rounded-lg transition duration-200 shadow-sm">
                    Riwayat Transaksi
                </a>

            </nav>

            <div class="p-4 border-t border-nuriForest">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full py-2.5 rounded-lg bg-[#8B2D2D] hover:bg-[#742222] text-white text-sm transition duration-200 font-semibold text-center shadow-sm">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col">
            <header class="h-20 bg-transparent flex items-center justify-between px-8">
                <div>
                    <h2 class="text-3xl font-bold text-nuriDark" style="font-family: serif;">Riwayat Transaksi</h2>
                    <p class="text-xs text-stone-500 mt-0.5">Dashboard Kasir / Pemantauan Log Pesanan</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-bold text-stone-900">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-xs text-stone-400">
                            Kasir
                        </p>
                    </div>
                    <div class="h-9 w-9 bg-nuriDark rounded-full flex items-center justify-center text-nuriGold font-bold shadow-sm border border-nuriForest">
                        {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'K' }}
                    </div>
                </div>
            </header>

            <div class="px-8 pb-8 flex-1 overflow-y-auto">
                
                @if(session('success'))
                    <div class="bg-emerald-50 border-l-4 border-nuriArmy text-emerald-900 p-4 mb-6 rounded-xl shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-600 text-red-900 p-4 mb-6 rounded-xl shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-4">
                    <input
                        type="text"
                        id="orderSearch"
                        placeholder="Cari pesanan..."
                        class="mt-2 w-full border border-stone-300 rounded-lg px-4 py-2 focus:border-nuriArmy focus:ring-nuriArmy"
                    >
                </div>

                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-stone-200/60 border-t-4 border-t-nuriForest">
                    <div class="px-6 py-5 border-b border-stone-100 bg-stone-50/50">
                        <h3 class="text-lg font-bold text-nuriDark" style="font-family: serif;">Daftar Pesanan</h3>
                        <p class="text-xs text-stone-500 mt-0.5">Menampilkan seluruh rekaman pesanan pelanggan yang masuk sistem.</p>
                    
                    </div>

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-stone-100">
                            <thead class="bg-stone-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meja</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kasir</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pemesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-stone-100">
                                @forelse($orders as $order)
                                    <tr
                                        class="order-row hover:bg-stone-50/60 transition duration-150"
                                        data-order="ord-{{ $order->id }}"
                                        data-meja="meja {{ $order->meja->nomor_meja ?? '' }}"
                                        data-kasir="{{ strtolower($order->kasir->name ?? '') }}"
                                        data-status="{{ strtolower($order->status_pesanan) }}"
                                    >
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-stone-400">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-nuriDark">
                                                #ORD-{{ $order->id }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-stone-700">
                                            Meja {{ $order->meja->nomor_meja ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                            {{ $order->kasir->name ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-nuriArmy">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($order->status_pesanan == 'proses')
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                                                    Proses
                                                </span>
                                            @elseif($order->status_pesanan == 'lunas')
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-50 text-blue-800 border border-blue-200">
                                                    Lunas
                                                </span>
                                            @elseif($order->status_pesanan == 'selesai')
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-50 text-red-700 border border-red-200">
                                                    Batal
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->translatedFormat('H:i:s, j F Y') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center justify-center gap-2">
                                                
                                                @if ($order->status_pesanan === 'proses')
                                                    <form action="{{ route('kasir.pesanan.lunas', $order->id) }}" method="POST" onsubmit="return confirm('Ubah status pesanan menjadi lunas?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="px-2.5 py-1.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-lg shadow-sm transition duration-150">
                                                            Sudah Dibayar
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="{{ route('kasir.pesanan.batal', $order->id) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-bold rounded-lg transition duration-150">
                                                            Batalkan
                                                        </button>
                                                    </form>

                                                @elseif ($order->status_pesanan === 'lunas')
                                                    <form action="{{ route('kasir.pesanan.selesai', $order->id) }}" method="POST" onsubmit="return confirm('Ubah status pesanan menjadi selesai dan meja pesanan dikosongkan?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="px-2.5 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-lg shadow-sm transition duration-150">
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <a href="{{ route('kasir.pesanan.show', $order->id) }}"
                                                   class="px-2.5 py-1.5 bg-stone-100 hover:bg-nuriArmy hover:text-white text-nuriDark border border-stone-200 text-xs font-bold rounded-lg text-center transition duration-150 shadow-sm">
                                                    Lihat Struk
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-16 text-center text-stone-400">
                                            <div class="text-base font-medium mb-1">Belum Ada Riwayat Pesanan</div>
                                            <p class="text-xs text-stone-400">Data pesanan baru yang diproses akan otomatis terekam di sini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr id="noOrderFound" style="display:none;">
                                    <td colspan="8" class="px-6 py-16 text-center text-stone-400">
                                        <div class="text-base font-medium mb-1">
                                            Pesanan tidak ditemukan
                                        </div>
                                        <p class="text-xs text-stone-400">
                                            Coba gunakan kata kunci lain.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('orderSearch');
        const rows = document.querySelectorAll('.order-row');
        const noOrderFound = document.getElementById('noOrderFound');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(row => {
                const order = row.dataset.order;
                const meja = row.dataset.meja;
                const kasir = row.dataset.kasir;
                const status = row.dataset.status;

                const match =
                    order.includes(keyword) ||
                    meja.includes(keyword) ||
                    kasir.includes(keyword) ||
                    status.includes(keyword);

                if (match) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            noOrderFound.style.display =
                visibleCount === 0 ? 'table-row' : 'none';
        });
    });
</script>

</body>
</html>