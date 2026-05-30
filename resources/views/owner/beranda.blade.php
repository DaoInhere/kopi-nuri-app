<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - Kopi Nuri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@400;500;600&display=swap');
        body { font-family: 'DM Sans', sans-serif; }
        .brand-font { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="font-sans antialiased" style="background-color: #f5f0e8;">
    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-56 flex flex-col shadow-lg" style="background-color: #1a2010;">
            <div class="h-16 flex items-center px-6 border-b" style="border-color: #2d3a1e;">
                <h1 class="brand-font text-xl font-bold" style="color: #f5f0e8;">
                    <span style="color: #c8a84b;">Kopi</span>Nuri
                </h1>
            </div>
            <nav class="flex-1 px-3 py-6 space-y-1">
                <a href="{{ route('owner.beranda') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium text-sm transition"
                   style="background-color: #4a6741; color: #f5f0e8;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('owner.menu.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition"
                   style="color: #a8b89e;"
                   onmouseover="this.style.backgroundColor='#2d3a1e'; this.style.color='#f5f0e8';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#a8b89e';">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Kelola Menu
                </a>
                <a href="{{ route('owner.laporan') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition"
                   style="color: #a8b89e;"
                   onmouseover="this.style.backgroundColor='#2d3a1e'; this.style.color='#f5f0e8';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#a8b89e';">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Laporan
                </a>
                <a href="{{ route('owner.akun.index') }}"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition"
                   style="color: #a8b89e;"
                   onmouseover="this.style.backgroundColor='#2d3a1e'; this.style.color='#f5f0e8';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='#a8b89e';">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Manajemen Akun
                </a>
            </nav>
            <div class="p-3 border-t" style="border-color: #2d3a1e;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition"
                            style="color: #a8b89e;"
                            onmouseover="this.style.backgroundColor='#2d3a1e'; this.style.color='#f5f0e8';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#a8b89e';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col">

            {{-- Content Area --}}
            <div class="p-8 flex-1 overflow-y-auto">

                {{-- Page Header --}}
                <div class="mb-8">
                    <h2 class="brand-font text-3xl font-bold" style="color: #1a2010;">
                        Selamat Datang, <span style="color: #4a6741;">Owner</span>
                    </h2>
                    <p class="text-sm mt-1" style="color: #7a8c6e;">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }} · Dashboard Pemilik
                    </p>
                </div>

                {{-- Stats Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

                    {{-- Card Pendapatan Harian --}}
                    <div class="rounded-2xl p-6 shadow-sm flex justify-between items-center" style="background-color: #4a6741;">
                        <div>
                            <p class="text-sm font-medium mb-2" style="color: #c8dfc0;">Total Pendapatan Harian</p>
                            <p class="text-4xl font-bold" style="color: #f5f0e8;">Rp {{ number_format($pendapatanHarian, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 rounded-full" style="background-color: rgba(255,255,255,0.15);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="#f5f0e8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>

                    {{-- Card Pendapatan Bulanan --}}
                    <div class="rounded-2xl p-6 shadow-sm flex justify-between items-center" style="background-color: #154002;">
                        <div>
                            <p class="text-sm font-medium mb-2" style="color: #f5e9c0;">Total Pendapatan Bulanan</p>
                            <p class="text-4xl font-bold" style="color: #f5f0e8;">Rp {{ number_format($pendapatanBulanan, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-3 rounded-full" style="background-color: rgba(255,255,255,0.25);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="#1a2010">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Chart Area --}}
                <div class="rounded-2xl shadow-sm p-6" style="background-color: #ffffff;">
                    <h3 class="brand-font text-lg font-bold mb-4" style="color: #1a2010;">Grafik Penjualan Terbaru (7 Hari Terakhir)</h3>
                    
                    {{-- Container Canvas untuk Chart.js --}}
                    <div style="position: relative; height: 350px; width: 100%;">
                        <canvas id="grafikPendapatan"></canvas>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- Import CDN Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Script Inisialisasi Grafik --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('grafikPendapatan').getContext('2d');
            
            // Menangkap data dari PHP ke JavaScript
            const labelGrafik = {!! json_encode($labelGrafik ?? []) !!};
            const dataGrafik = {!! json_encode($dataGrafik ?? []) !!};

            new Chart(ctx, {
                type: 'line', // Grafik garis
                data: {
                    labels: labelGrafik,
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: dataGrafik,
                        borderColor: '#4a6741', // Warna hijau sage
                        backgroundColor: 'rgba(74, 103, 65, 0.1)', // Warna hijau transparan
                        borderWidth: 2,
                        pointBackgroundColor: '#c8a84b', // Warna emas
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        fill: true,
                        tension: 0.3 // Garis melengkung
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 1000000,
                            ticks: {
                                precision: 0, 
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>