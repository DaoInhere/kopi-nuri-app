<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan - Kopi Nuri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-lg">
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <h1 class="text-2xl font-bold tracking-wider text-amber-500">KOPI NURI</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="{{ route('kasir.beranda') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Beranda</a>
                <a href="{{ route('kasir.pesanan.create') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Buat Pesanan</a>
                <a href="{{ route('kasir.menu') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Daftar Menu</a>
                <a href="{{ route('kasir.riwayat.pesanan') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Riwayat Transaksi</a>
            </nav>

            <div class="p-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:bg-slate-800 rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col">
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8">
                <h2 class="text-xl font-semibold text-gray-700">Buat Pesanan Baru</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-500">Halo, {{ Auth::user()->name }}</span>
                    <div class="h-8 w-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold">
                        K
                    </div>
                </div>
            </header>

            <div class="p-8 flex-1 overflow-y-auto">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        <div class="flex items-center justify-between">
                            <span>{{ session('success') }}</span>

                            <a href="{{ route('kasir.riwayat.pesanan') }}"
                            class="ml-4 inline-block px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition">
                                Lanjut Memproses Pesanan
                            </a>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kasir.pesanan.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <input type="hidden" name="kasir_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="status_pesanan" value="proses">

                    <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-amber-500">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Pesanan</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Meja</label>
                                <select name="meja_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                    <option value="">-- Pilih Meja --</option>
                                    @foreach($mejas as $meja)
                                        <option value="{{ $meja->id }}" {{ $meja->status == 'digunakan' ? 'disabled' : '' }}>
                                            Meja {{ $meja->nomor_meja }} - {{ $meja->status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
                                <input type="text" value="Proses" disabled class="w-full bg-gray-100 border-gray-300 rounded-lg shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-amber-500">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Pilih Menu</h3>
                        <p class="text-sm text-gray-500 mb-6">
                            Isi jumlah pada menu yang ingin dipesan. Menu dengan qty 0 tidak akan dihitung.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach($menus as $menu)
                                <div class="border rounded-xl p-4 bg-gray-50 hover:shadow-md transition">
                                    <div class="flex items-start justify-between gap-4 mb-3">
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $menu->nama_menu }}</h4>
                                            <p class="text-sm text-gray-500 line-clamp-2">{{ $menu->deskripsi }}</p>
                                        </div>

                                        @if($menu->is_available)
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700 whitespace-nowrap">
                                                Tersedia
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700 whitespace-nowrap">
                                                Habis
                                            </span>
                                        @endif
                                    </div>

                                    <div class="text-sm font-medium text-gray-700 mb-3">
                                        Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Qty</label>
                                        <input
                                            type="number"
                                            name="items[{{ $menu->id }}][qty]"
                                            min="0"
                                            value="0"
                                            {{ !$menu->is_available ? 'disabled' : '' }}
                                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500 disabled:bg-gray-200 disabled:cursor-not-allowed"
                                        >
                                        <input type="hidden" name="items[{{ $menu->id }}][menu_id]" value="{{ $menu->id }}">
                                        <input type="hidden" name="items[{{ $menu->id }}][subtotal]" value="0">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('kasir.beranda') }}"
                           class="px-5 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-6 py-2 bg-amber-500 text-slate-900 font-bold rounded-lg hover:bg-amber-600 transition">
                            Simpan Order
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>