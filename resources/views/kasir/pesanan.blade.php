<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - Kopi Nuri</title>
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
                <a href="{{ route('kasir.pesanan.create') }}" class="block px-4 py-2.5 bg-nuriArmy text-white font-medium rounded-lg transition duration-200">
                    Buat Pesanan
                </a>
                <a href="{{ route('kasir.menu') }}" class="block px-4 py-2.5 hover:bg-nuriArmy hover:text-white rounded-lg transition duration-200">
                    Daftar Menu
                </a>
                <a href="{{ route('kasir.riwayat.pesanan') }}" class="block px-4 py-2.5 hover:bg-nuriArmy hover:text-white rounded-lg transition duration-200">
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
                    <h2 class="text-3xl font-bold text-nuriDark" style="font-family: serif;">Buat Pesanan Baru</h2>
                    <p class="text-xs text-stone-500 mt-0.5">Dashboard Kasir / Tambah Order</p>
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
                    <div class="bg-green-50 border-l-4 border-green-600 text-green-900 p-4 mb-6 rounded-xl shadow-sm">
                        <div class="flex items-center justify-between">
                            <span>{{ session('success') }}</span>
                            <a href="{{ route('kasir.riwayat.pesanan') }}" class="ml-4 inline-block px-4 py-2 bg-green-700 text-white text-sm font-semibold rounded-lg hover:bg-green-800 transition">
                                Lanjut Memproses Pesanan
                            </a>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-600 text-red-900 p-4 mb-6 rounded-xl shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-600 text-red-900 p-4 mb-6 rounded-xl shadow-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kasir.pesanan.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="kasir_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="status_pesanan" value="proses">

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200/60 border-t-4 border-t-nuriArmy">
                        <h3 class="text-lg font-bold text-nuriDark mb-4" style="font-family: serif;">Informasi Meja</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1.5">Pilih Nomor Meja</label>
                                <select name="meja_id" required class="w-full border-stone-300 rounded-lg shadow-sm focus:border-nuriArmy focus:ring-nuriArmy p-2 border">
                                    <option value="">-- Pilih Meja --</option>
                                    @foreach($mejas as $meja)
                                        <option value="{{ $meja->id }}" {{ $meja->status == 'digunakan' ? 'disabled' : '' }}>
                                            Meja {{ $meja->nomor_meja }} - {{ $meja->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1.5">Status Alur</label>
                                <input type="text" value="Proses" disabled class="w-full bg-stone-50 border border-stone-300 rounded-lg shadow-sm text-stone-500 font-medium p-2">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200/60 border-t-4 border-t-nuriForest">
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-nuriDark" style="font-family: serif;">Pilih Menu Kopi & Makanan</h3>
                            <p class="text-sm text-stone-500 mt-0.5">
                                Isi jumlah pada menu yang ingin dipesan. Menu dengan qty 0 otomatis dilewati.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach($menus as $menu)
                                <div class="border border-stone-100 rounded-xl p-4 bg-stone-50 hover:border-nuriArmy hover:bg-white hover:shadow-md transition duration-200">
                                    <div class="flex items-start justify-between gap-4 mb-3">
                                        <div>
                                            <h4 class="font-bold text-nuriDark">{{ $menu->nama_menu }}</h4>
                                            <p class="text-xs text-stone-500 line-clamp-2 mt-0.5">{{ $menu->deskripsi }}</p>
                                        </div>

                                        @if($menu->is_available)
                                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap">
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-red-50 text-red-700 border border-red-200 whitespace-nowrap">
                                                Habis
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-sm font-bold text-nuriArmy mb-4">
                                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                    </div>

                                    <div>
                                        <label class="block text-xs font-medium text-stone-500 mb-1">Kuantitas (Qty)</label>
                                        <input
                                            type="number"
                                            name="items[{{ $menu->id }}][qty]"
                                            min="0"
                                            value="0"
                                            {{ !$menu->is_available ? 'disabled' : '' }}
                                            class="w-full border border-stone-300 rounded-lg shadow-sm focus:border-nuriArmy focus:ring-nuriArmy disabled:bg-stone-200 disabled:cursor-not-allowed text-center font-semibold p-1"
                                        >
                                        <input type="hidden" name="items[{{ $menu->id }}][menu_id]" value="{{ $menu->id }}">
                                        <input type="hidden" name="items[{{ $menu->id }}][subtotal]" value="0">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-2">
                        <a href="{{ route('kasir.beranda') }}"
                           class="px-6 py-2.5 bg-white border border-stone-300 text-stone-700 font-semibold rounded-xl hover:bg-stone-50 transition duration-200">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-8 py-2.5 bg-nuriForest text-nuriGold font-bold rounded-xl hover:opacity-90 shadow-md transition duration-200">
                            Simpan Order
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>