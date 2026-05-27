<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Kopi Nuri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-lg">
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <h1 class="text-2xl font-bold tracking-wider text-amber-500">KOPI NURI</h1>
            </div>
            {{-- Navigasi --}}
            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="{{ route('kasir.beranda') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Beranda</a>
                <a href="{{ route('kasir.pesanan.create') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Buat Pesanan</a>
                <a href="{{ route('kasir.menu') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Daftar Menu</a>
                <a href="{{ route('kasir.riwayat.pesanan') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Riwayat Transaksi</a>
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
                <h2 class="text-xl font-semibold text-gray-700">Daftar Menu</h2>
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
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($menus as $menu)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $menu->nama_menu }}</div>
                                            <div class="text-xs text-gray-500">{{ $menu->deskripsi }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($menu->is_available)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Habis</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-4">
                                            <form action="{{ route('menu.toggleAvailability', $menu->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin mengubah status menu ini?')">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="text-blue-600 hover:text-blue-900">
                                                    Ubah Status Menu
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                            Belum ada menu yang ditambahkan. Silakan tambah menu di form sebelah kiri.
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