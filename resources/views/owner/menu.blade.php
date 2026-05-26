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
                <a href="{{ route('owner.beranda') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Beranda</a>
                <a href="{{ route('owner.menu.index') }}" class="block px-4 py-2 bg-amber-500 text-slate-900 font-semibold rounded-lg">Kelola Menu</a>
                <a href="{{ route('owner.laporan') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Laporan Keuangan</a>
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
                <h2 class="text-xl font-semibold text-gray-700">Manajemen Menu Kopi</h2>
            </header>

            <div class="p-8 flex-1 overflow-y-auto">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-amber-500">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Menu Baru</h3>
                            <form action="{{ route('owner.menu.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                                    <input type="text" name="nama_menu" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                                    <input type="number" name="harga" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                    <textarea name="deskripsi" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500"></textarea>
                                </div>
                                <div class="mb-6 flex items-center">
                                    <input type="checkbox" name="is_available" value="1" checked class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                    <label class="ml-2 text-sm text-gray-700">Tersedia (In Stock)</label>
                                </div>
                                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-slate-800 transition">
                                    Simpan Menu
                                </button>
                            </form>
                        </div>
                    </div>

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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-4" x-data="{ openEdit: false }">
    
                                                <button @click="openEdit = true" class="text-blue-600 hover:text-blue-900">Edit</button>

                                                <form action="{{ route('owner.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>

                                                <div x-show="openEdit" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                                    <div @click.away="openEdit = false" class="bg-white p-6 rounded-xl shadow-lg w-96 max-w-full relative whitespace-normal text-left">
                                                        <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Menu</h3>
                                                        
                                                        <form action="{{ route('owner.menu.update', $menu->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT') 
                                                            <div class="mb-4">
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                                                                <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                                                                <input type="number" name="harga" value="{{ $menu->harga }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                                            </div>
                                                            <div class="mb-4">
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                                                <textarea name="deskripsi" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ $menu->deskripsi }}</textarea>
                                                            </div>
                                                            <div class="mb-6 flex items-center">
                                                                <input type="checkbox" name="is_available" value="1" {{ $menu->is_available ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                                                <label class="ml-2 text-sm text-gray-700">Tersedia (In Stock)</label>
                                                            </div>
                                                            
                                                            <div class="flex justify-end space-x-2">
                                                                <button type="button" @click="openEdit = false" class="px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition">Batal</button>
                                                                <button type="submit" class="px-4 py-2 bg-amber-500 text-slate-900 font-bold rounded-lg hover:bg-amber-600 transition">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

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
            </div>
        </main>
    </div>
</body>
</html>