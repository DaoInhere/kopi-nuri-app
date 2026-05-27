<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Kasir - Kopi Nuri</title>
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
                <h2 class="text-xl font-semibold text-gray-700">Dasbor Kasir</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-500">Halo, {{ Auth::user()->name }}</span>
                    <div class="h-8 w-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold">
                        K
                    </div>
                </div>
            </header>

            <div class="p-8 flex-1 overflow-y-auto">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Pesanan Hari Ini</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $orderHariIni }} <span class="text-sm font-normal text-gray-500">transaksi</span></p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                        <p class="text-sm text-gray-500 font-medium mb-1">Meja Kosong</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $mejaKosong }}</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
                        <p class="text-sm text-gray-500 font-medium mb-1">Meja Digunakan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $mejaDigunakan }}</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Status Meja Pelanggan</h3>
                        <span class="text-sm text-gray-500">Klik meja untuk kelola pesanan</span>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @forelse($mejas as $meja)
                            <button class="py-6 rounded-xl border-2 flex flex-col items-center justify-center transition-all hover:scale-105 hover:shadow-md
                                {{ $meja->status == 'kosong' ? 'border-green-400 bg-green-50 text-green-700' : 'border-red-400 bg-red-50 text-red-700' }}">
                                <span class="text-3xl font-black mb-2">{{ $meja->nomor_meja }}</span>
                                <span class="text-xs uppercase tracking-widest font-bold">{{ $meja->status }}</span>
                            </button>
                        @empty
                            <div class="col-span-full text-center py-12 text-gray-400">
                                Belum ada meja yang terdaftar di sistem.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>