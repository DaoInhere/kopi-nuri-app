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
                        nuriDark: '#192215',    /* Warna background ekstra gelap sidebar */
                        nuriCream: '#F4EFE6',   /* Warna krem lembut background utama */
                        nuriGold: '#E4C374',    /* Warna emas logo KopiNuri */
                        nuriArmy: '#4B6244',    /* Warna hijau army (active menu & card) */
                        nuriForest: '#16360E'   /* Warna hijau botol pekat (button & text) */
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

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('kasir.beranda') }}" class="block px-4 py-2.5 hover:bg-nuriArmy hover:text-white rounded-lg transition duration-200">
                    Beranda
                </a>
                <a href="{{ route('kasir.pesanan.create') }}" class="block px-4 py-2.5 hover:bg-nuriArmy hover:text-white rounded-lg transition duration-200">
                    Buat Pesanan
                </a>
                <a href="{{ route('kasir.menu') }}" class="block px-4 py-2.5 hover:bg-nuriArmy hover:text-white rounded-lg transition duration-200">
                    Daftar Menu
                </a>
                <a href="{{ route('kasir.riwayat.pesanan') }}" class="block px-4 py-2.5 bg-nuriArmy text-white font-medium rounded-lg transition duration-200">
                    Riwayat Transaksi
                </a>
            </nav>

            <div class="p-4 border-t border-[#263122]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2.5 text-red-400 hover:bg-[#263122] rounded-lg transition duration-200">
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
                    <span class="text-sm font-medium text-stone-700">Halo, <strong class="text-nuriArmy">{{ Auth::user()->name }}</strong></span>
                    <div class="h-9 w-9 bg-nuriForest rounded-full flex items-center justify-center text-nuriGold font-bold shadow-sm">
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

                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-stone-200/60 border-t-4 border-t-nuriForest">
                    <div class="px-6 py-5 border-b border-stone-100 bg-stone-50/50">
                        <h3 class="text-lg font-bold text-nuriDark" style="font-family: serif;">Daftar Pesanan</h3>
                        <p class="text-xs text-stone-500 mt-0.5">Menampilkan seluruh rekaman pesanan pelanggan yang masuk sistem.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-100">
                            <thead class="bg-stone-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider w-12">#</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Kode Order</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Meja</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Kasir</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-stone-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-stone-100">
                                @forelse($orders as $order)
                                    <tr class="hover:bg-stone-50/60 transition duration-150">
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

                                        <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-stone-500">
                                            {{ $order->created_at->format('d-m-Y H:i') }}
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>