<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Owner - Kopi Nuri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col shadow-lg">
            <div class="h-16 flex items-center justify-center border-b border-slate-700">
                <h1 class="text-2xl font-bold tracking-wider text-amber-500">KOPI NURI</h1>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-3">
                <a href="#" class="block px-4 py-2 bg-amber-500 text-slate-900 font-semibold rounded-lg">Beranda</a>
                <a href="#" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Kelola Menu</a>
                <a href="#" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Laporan Keuangan</a>
                <a href="#" class="block px-4 py-2 hover:bg-slate-800 rounded-lg transition">Manajemen Akun</a>
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
                <h2 class="text-xl font-semibold text-gray-700">Dasbor Owner</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-500">Halo, {{ Auth::user()->name }}</span>
                    <div class="h-8 w-8 bg-amber-500 rounded-full flex items-center justify-center text-white font-bold">
                        O
                    </div>
                </div>
            </header>

            <div class="p-8 flex-1 overflow-y-auto">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">Total Pendapatan Harian</p>
                            <p class="text-3xl font-bold text-gray-800">Rp 0</p>
                        </div>
                        <div class="p-3 bg-emerald-100 text-emerald-600 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">Total Pendapatan Bulanan</p>
                            <p class="text-3xl font-bold text-gray-800">Rp 0</p>
                        </div>
                        <div class="p-3 bg-indigo-100 text-indigo-600 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Grafik Penjualan Terbaru</h3>
                    <div class="h-64 border-2 border-dashed border-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                        Area ini nantinya bisa diisi dengan tabel laporan pesanan atau grafik dari Chart.js
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>