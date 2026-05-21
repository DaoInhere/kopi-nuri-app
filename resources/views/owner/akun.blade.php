<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - Kopi Nuri</title>
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
                <a href="{{ route('owner.laporan') }}" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Laporan Keuangan</a>
                <a href="{{ route('owner.akun.index') }}" class="block px-4 py-2 bg-amber-500 text-slate-900 font-semibold rounded-lg">Manajemen Akun</a>
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
                <h2 class="text-xl font-semibold text-gray-700">Manajemen Akun Kasir</h2>
            </header>

            <div class="p-8 flex-1 overflow-y-auto">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-amber-500">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Kasir Baru</h3>
                            <form action="{{ route('owner.akun.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" name="password" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" required class="w-full border-gray-300 rounded-lg shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                </div>
                                <button type="submit" class="w-full bg-slate-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-slate-800 transition">
                                    Daftarkan Kasir
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama & Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($kasirs as $kasir)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-bold text-gray-900">{{ $kasir->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $kasir->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $kasir->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                                <form action="{{ route('owner.akun.destroy', $kasir->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akses kasir ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus Akses</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                                Belum ada akun kasir terdaftar.
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