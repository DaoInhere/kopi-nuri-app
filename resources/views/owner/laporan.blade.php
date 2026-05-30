<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Kopi Nuri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .brand-font { font-family: 'Playfair Display', serif; }
        .nav-link {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 1rem; border-radius: 0.5rem;
            font-size: 0.875rem; color: #a8b89e;
            transition: all 0.15s; text-decoration: none;
        }
        .nav-link:hover { background-color: #2d3a1e; color: #f5f0e8; }
        .nav-link.active { background-color: #4a6741; color: #f5f0e8; font-weight: 600; }
        .btn-logout {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.625rem 1rem; border-radius: 0.5rem;
            font-size: 0.875rem; color: #a8b89e;
            background: transparent; border: none; width: 100%; cursor: pointer; transition: all 0.15s;
        }
        .btn-logout:hover { background-color: #2d3a1e; color: #f5f0e8; }
        .tr-row:hover { background-color: #faf7f2; }
    </style>
</head>
<body class="font-sans antialiased" style="background-color: #f5f0e8;">
    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-56 flex flex-col shadow-lg flex-shrink-0" style="background-color: #1a2010;">
            <div class="h-16 flex items-center px-6 border-b" style="border-color: #2d3a1e;">
                <h1 class="brand-font text-xl font-bold" style="color: #f5f0e8;">
                    <span style="color: #c8a84b;">Kopi</span>Nuri
                </h1>
            </div>
            <nav class="flex-1 px-3 py-6 space-y-1">
                <a href="{{ route('owner.beranda') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard
                </a>
                <a href="{{ route('owner.menu.index') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Kelola Menu
                </a>
                <a href="{{ route('owner.laporan') }}" class="nav-link active">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    Laporan
                </a>
                <a href="{{ route('owner.akun.index') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Manajemen Akun
                </a>
            </nav>
            <div class="p-3 border-t" style="border-color: #2d3a1e;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col overflow-hidden">
            <div class="p-8 flex-1 overflow-y-auto">

                {{-- Page Header --}}
                <div class="mb-8">
                    <h2 class="brand-font text-3xl font-bold" style="color: #1a2010;">
                        Laporan <span style="color: #4a6741;">Keuangan</span>
                    </h2>
                    <p class="text-sm mt-1" style="color: #7a8c6e;">Riwayat semua transaksi yang telah diselesaikan</p>
                </div>

                {{-- Summary Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                    {{-- Total Transaksi --}}
                    <div class="rounded-2xl p-5 shadow-sm flex items-center gap-4" style="background-color: #ffffff;">
                        <div class="p-3 rounded-xl flex-shrink-0" style="background-color: #e8f0e6;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#4a6741">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Total Transaksi</p>
                            <p class="text-2xl font-bold mt-0.5" style="color: #1a2010;">{{ $orders->count() }}</p>
                        </div>
                    </div>

                    {{-- Total Pendapatan --}}
                    <div class="rounded-2xl p-5 shadow-sm flex items-center gap-4" style="background-color: #4a6741;">
                        <div class="p-3 rounded-xl flex-shrink-0" style="background-color: rgba(255,255,255,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#f5f0e8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider" style="color: #c8dfc0;">Total Pendapatan</p>
                            <p class="text-2xl font-bold mt-0.5" style="color: #f5f0e8;">Rp {{ number_format($orders->sum('total_harga'), 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Rata-rata per Transaksi --}}
                    <div class="rounded-2xl p-5 shadow-sm flex items-center gap-4" style="background-color: #c8a84b;">
                        <div class="p-3 rounded-xl flex-shrink-0" style="background-color: rgba(255,255,255,0.25);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#1a2010">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wider" style="color: #f5e9c0;">Rata-rata / Transaksi</p>
                            <p class="text-2xl font-bold mt-0.5" style="color: #1a2010;">
                                Rp {{ $orders->count() > 0 ? number_format($orders->sum('total_harga') / $orders->count(), 0, ',', '.') : '0' }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- Table Card --}}
                <div class="rounded-2xl shadow-sm overflow-hidden" style="background-color: #ffffff;">

                    {{-- Table Header --}}
                    <div class="px-6 py-4 border-b flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3" style="border-color: #ede8df;">
                        <div>
                            <h3 class="brand-font text-base font-bold" style="color: #1a2010;">Riwayat Transaksi</h3>
                            <p class="text-xs mt-0.5" style="color: #a89880;">Semua pesanan yang telah dibayar oleh pelanggan</p>
                        </div>
                        
                        {{-- TOMBOL CETAK LAPORAN YANG SUDAH DIPERBARUI --}}
                        <a href="{{ route('owner.laporan.cetak') }}" target="_blank"
                                class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition flex-shrink-0"
                                style="background-color: #1a2010; color: #f5f0e8; text-decoration: none;"
                                onmouseover="this.style.backgroundColor='#4a6741'"
                                onmouseout="this.style.backgroundColor='#1a2010'">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Laporan
                        </a>
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr style="background-color: #faf7f2;">
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Tanggal & Waktu</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Kasir</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Meja</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Total Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr class="tr-row border-t" style="border-color: #f0ebe0;">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-xs font-bold px-2.5 py-1 rounded-lg" style="background-color: #e8f0e6; color: #4a6741;">
                                            #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium" style="color: #1a2010;">{{ $order->created_at->format('d M Y') }}</div>
                                        <div class="text-xs mt-0.5" style="color: #a89880;">{{ $order->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="h-7 w-7 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0" style="background-color: #e8f0e6; color: #4a6741;">
                                                {{ strtoupper(substr($order->kasir->name ?? 'K', 0, 1)) }}
                                            </div>
                                            <span class="text-sm" style="color: #3d5636;">{{ $order->kasir->name ?? 'Kasir Dihapus' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-semibold px-2.5 py-1 rounded-lg" style="background-color: #f0ebe0; color: #7a6040;">
                                            Meja {{ $order->meja->nomor_meja ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="text-sm font-bold" style="color: #4a6741;">
                                            Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center gap-2" style="color: #a89880;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="text-sm">Belum ada riwayat transaksi yang diselesaikan.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                            {{-- Footer total --}}
                            @if($orders->count() > 0)
                            <tfoot>
                                <tr style="background-color: #faf7f2; border-top: 2px solid #d6cdb8;">
                                    <td colspan="4" class="px-6 py-4 text-sm font-bold text-right" style="color: #1a2010;">
                                        Total Keseluruhan
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-base font-bold" style="color: #4a6741;">
                                            Rp {{ number_format($orders->sum('total_harga'), 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                            @endif

                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>