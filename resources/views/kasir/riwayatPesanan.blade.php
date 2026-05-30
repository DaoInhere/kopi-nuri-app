<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Kopi Nuri</title>
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
                <a href="{{ route('kasir.riwayat.pesanan') }}" class="block px-4 py-2 bg-amber-500 text-slate-900 font-semibold rounded-lg">Riwayat Pesanan</a>
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
                <h2 class="text-xl font-semibold text-gray-700">Riwayat Pesanan</h2>
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

                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Daftar Pesanan</h3>
                            <p class="text-sm text-gray-500">Menampilkan seluruh pesanan yang pernah dibuat.</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meja</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kasir</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                #ORD-{{ $order->id }}
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            Meja {{ $order->meja->nomor_meja ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $order->kasir->name ?? '-' }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($order->status_pesanan == 'proses')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Proses
                                                </span>
                                            @elseif($order->status_pesanan == 'lunas')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Lunas
                                                </span>
                                            @elseif($order->status_pesanan == 'selesai')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Batal
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $order->created_at->format('d-m-Y H:i') }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($order->status_pesanan === 'proses')
                                                <form action="{{ route('kasir.pesanan.lunas', $order->id) }}" method="POST" onsubmit="return confirm('Ubah status pesanan menjadi lunas?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-900">
                                                        > Sudah Dibayar
                                                    </button>
                                                </form>
                                                <form action="{{ route('kasir.pesanan.batal', $order->id) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        > Batalkan
                                                    </button>
                                                </form>
                                                <a href="{{ route('kasir.pesanan.show', $order->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                    > Detail
                                                </a>
                                            @elseif ($order->status_pesanan === 'lunas')
                                                <form action="{{ route('kasir.pesanan.selesai', $order->id) }}" method="POST" onsubmit="return confirm('Ubah status pesanan menjadi selesai dan meja pesanan dikosongkan?')">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button type="submit"
                                                        class="text-green-600 hover:text-green-900">
                                                        > Selesai
                                                    </button>
                                                </form>
                                                <a href="{{ route('kasir.pesanan.show', $order->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                    > Detail
                                                </a>
                                            @else
                                                <a href="{{ route('kasir.pesanan.show', $order->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                    > Detail
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                                            Belum ada riwayat pesanan.
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