<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Kopi Nuri</title>
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
                    class="block px-4 py-2.5 bg-nuriArmy text-white font-medium rounded-lg transition duration-200 shadow-sm">
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
            <header class="h-20 bg-transparent flex items-center justify-between px-8">
                <div>
                    <h2 class="text-3xl font-bold text-nuriDark" style="font-family: serif;">Daftar Menu Cafe</h2>
                    <p class="text-xs text-stone-500 mt-0.5">Dashboard Kasir / Kelola Ketersediaan Menu</p>
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

                <div class="lg:col-span-2">
                        <div class="mb-4">
                            <input
                                type="text"
                                id="menuSearch"
                                placeholder="Cari menu..."
                                class="w-full border border-stone-300 rounded-lg px-4 py-2 focus:border-nuriArmy focus:ring-nuriArmy"
                            >
                        </div>
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-stone-200/60 border-t-4 border-t-nuriForest">
                        <table class="min-w-full divide-y divide-stone-100">
                            <thead class="bg-stone-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Nama Menu</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-stone-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-stone-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-stone-100">
                                @forelse($menus as $menu)
                                    <tr
                                        class="menu-row hover:bg-stone-50/80 transition duration-150"
                                        data-name="{{ strtolower($menu->nama_menu) }}"
                                        data-desc="{{ strtolower($menu->deskripsi) }}"
                                    >
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-nuriDark">{{ $menu->nama_menu }}</div>
                                            <div class="text-xs text-stone-500 max-w-md line-clamp-1 mt-0.5">{{ $menu->deskripsi }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-nuriArmy">
                                            Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($menu->is_available)
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    Tersedia
                                                </span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700 border border-red-200">
                                                    Habis
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                            <form action="{{ route('menu.toggleAvailability', $menu->id) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin mengubah status menu {{ $menu->nama_menu }}?')">
                                                @csrf
                                                @method('PATCH')

                                                <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-stone-100 hover:bg-nuriArmy hover:text-white text-nuriDark text-xs font-bold rounded-lg transition duration-200 shadow-sm border border-stone-200">
                                                    Ubah Status Menu
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-16 text-center text-stone-400">
                                            <div class="text-base font-medium mb-1">Belum Ada Menu Terdaftar</div>
                                            <p class="text-xs text-stone-400">Silakan hubungi pihak administrator atau tambahkan data menu baru.</p>
                                        </td>
                                    </tr>
                                @endforelse
                                <tr id="noMenuFound" style="display:none;">
                                    <td colspan="4" class="px-6 py-16 text-center text-stone-400">
                                        <div class="text-base font-medium mb-1">
                                            Menu tidak ditemukan
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
        const searchInput = document.getElementById('menuSearch');
        const rows = document.querySelectorAll('.menu-row');
        const noMenuFound = document.getElementById('noMenuFound');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.dataset.name;
                const desc = row.dataset.desc;

                if (name.includes(keyword) || desc.includes(keyword)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            noMenuFound.style.display =
                visibleCount === 0 ? 'table-row' : 'none';
        });
    });
</script>

</body>
</html>