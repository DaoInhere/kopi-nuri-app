<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - KopiNuri</title>
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

    <aside class="w-64 bg-nuriDark text-stone-300 flex flex-col shadow-xl border-r border-nuriForest">

        <div class="h-20 flex items-center px-6 border-b border-nuriForest">
            <h1 class="text-2xl font-bold tracking-wide text-nuriGold" style="font-family: serif;">
                Kopi<span class="text-white">Nuri</span>
            </h1>
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="{{ route('kasir.beranda') }}"
                class="block px-4 py-2.5 bg-nuriArmy text-white font-medium rounded-lg transition duration-200 shadow-sm">
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
                class="block px-4 py-2.5 rounded-lg hover:bg-nuriForest hover:text-white transition duration-200">
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

        <header class="h-20 flex items-center justify-between px-8 border-b border-stone-200/60 bg-transparent">

            <div>
                <h2 class="text-2xl font-bold text-stone-900" style="font-family: serif;">
                    Selamat Datang, <span class="text-nuriArmy">{{ Auth::user()->name }}</span>
                </h2>
                <p class="text-xs text-stone-500 mt-0.5">
                    Dashboard Kasir KopiNuri / Ringkasan Operasional Hari Ini
                </p>
            </div>

            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-stone-900">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-stone-400">
                        Kasir Aktif
                    </p>
                </div>
                <div class="h-9 w-9 bg-nuriDark rounded-full flex items-center justify-center text-nuriGold font-bold shadow-sm border border-nuriForest">
                    {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) : 'K' }}
                </div>
            </div>

        </header>

        <div class="p-8 flex-1 overflow-y-auto">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <div class="bg-gradient-to-br from-nuriArmy to-[#3e5933] rounded-2xl p-6 text-white shadow-sm border border-[#446039]">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-green-100/80 mb-1">
                                Pesanan Hari Ini
                            </h4>
                            <h3 class="text-4xl font-black tracking-tight">
                                {{ $orderHariIni }}
                            </h3>
                            <p class="mt-2 text-xs text-green-100/60 font-medium">
                                Transaksi berhasil tercatat
                            </p>
                        </div>
                        <span class="px-2 py-0.5 bg-white/10 text-[10px] uppercase font-bold rounded-md tracking-wider">
                            Live
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 text-stone-800 shadow-sm border border-stone-200/60 border-t-4 border-t-emerald-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-400 mb-1">
                                Meja Kosong
                            </h4>
                            <h3 class="text-4xl font-black tracking-tight text-emerald-700">
                                {{ $mejaKosong }}
                            </h3>
                            <p class="mt-2 text-xs text-stone-400 font-medium">
                                Siap menerima pelanggan baru
                            </p>
                        </div>
                        <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] uppercase font-bold rounded-md tracking-wider">
                            Tersedia
                        </span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 text-stone-800 shadow-sm border border-stone-200/60 border-t-4 border-t-amber-600">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-stone-400 mb-1">
                                Meja Digunakan
                            </h4>
                            <h3 class="text-4xl font-black tracking-tight text-amber-700">
                                {{ $mejaDigunakan }}
                            </h3>
                            <p class="mt-2 text-xs text-stone-400 font-medium">
                                Sedang dalam pelayanan kuliner
                            </p>
                        </div>
                        <span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-100 text-[10px] uppercase font-bold rounded-md tracking-wider">
                            Terisi
                        </span>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-2xl shadow-sm p-6 border border-stone-200/60 border-t-4 border-t-nuriDark">

                <div class="flex justify-between items-start border-b border-stone-100 pb-5 mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-stone-900" style="font-family: serif;">Status Meja Pelanggan</h3>
                        <p class="text-xs text-stone-500 mt-0.5">
                            Klik kartu meja di bawah ini untuk langsung memproses dan mengelola pesanan pelanggan.
                        </p>
                    </div>
                    <div class="bg-amber-50 text-amber-800 border border-amber-200 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wider">
                        Live Monitor
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">

                    @forelse($mejas as $meja)

                        <button
                            class="group rounded-2xl border p-5 transition-all duration-200 hover:-translate-y-1 hover:shadow-md text-center flex flex-col items-center justify-center
                            {{ $meja->status == 'kosong'
                                ? 'bg-emerald-50/40 border-emerald-200 hover:bg-emerald-50'
                                : 'bg-rose-50/40 border-rose-200 hover:bg-rose-50' }}">

                            <div class="w-12 h-12 rounded-full shadow-sm flex items-center justify-center mb-3 font-bold text-lg bg-white transition duration-200 group-hover:scale-105
                                {{ $meja->status == 'kosong' ? 'text-emerald-700 border border-emerald-100' : 'text-rose-700 border border-rose-100' }}">
                                {{ $meja->nomor_meja }}
                            </div>

                            <div class="text-sm font-bold text-stone-800">
                                Meja {{ $meja->nomor_meja }}
                            </div>

                            <span class="mt-2.5 px-3 py-0.5 rounded-full text-[10px] uppercase tracking-wider font-bold shadow-sm
                                {{ $meja->status == 'kosong'
                                    ? 'bg-emerald-600 text-white'
                                    : 'bg-rose-600 text-white' }}">
                                {{ $meja->status }}
                            </span>

                        </button>

                    @empty

                        <div class="col-span-full text-center py-12 text-stone-400">
                            <div class="text-base font-medium mb-1">Status Meja Kosong</div>
                            <p class="text-xs text-stone-400">Belum ada meja yang dikonfigurasi di dalam sistem ini.</p>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>