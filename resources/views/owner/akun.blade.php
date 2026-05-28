<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun - Kopi Nuri</title>
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
        input[type="text"], input[type="email"], input[type="password"] {
            background-color: #faf7f2;
            border: 1px solid #d6cdb8;
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            font-size: 0.875rem;
            color: #1a2010;
            outline: none;
            transition: border-color 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            border-color: #4a6741;
            box-shadow: 0 0 0 3px rgba(74, 103, 65, 0.12);
        }
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
                <a href="{{ route('owner.laporan') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    Laporan
                </a>
                <a href="{{ route('owner.akun.index') }}" class="nav-link active">
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
                        Manajemen <span style="color: #4a6741;">Akun</span>
                    </h2>
                    <p class="text-sm mt-1" style="color: #7a8c6e;">Kelola akun kasir yang dapat mengakses sistem</p>
                </div>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="flex items-center gap-3 p-4 mb-6 rounded-xl text-sm font-medium" style="background-color: #d6f0d0; color: #2d6a24; border-left: 4px solid #4a6741;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="flex items-start gap-3 p-4 mb-6 rounded-xl text-sm" style="background-color: #fde8e8; color: #a02020; border-left: 4px solid #c03030;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <ul class="space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Form Tambah Kasir --}}
                    <div class="lg:col-span-1">
                        <div class="rounded-2xl shadow-sm overflow-hidden" style="background-color: #ffffff;">
                            <div class="px-6 py-4 border-b" style="background-color: #4a6741; border-color: #3d5636;">
                                <h3 class="brand-font text-base font-bold" style="color: #f5f0e8;">✦ Tambah Kasir Baru</h3>
                            </div>
                            <div class="p-6">
                                <form action="{{ route('owner.akun.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a8c6e;">Nama Lengkap</label>
                                        <input type="text" name="name" required placeholder="Nama">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a8c6e;">Email</label>
                                        <input type="email" name="email" required placeholder="Contoh: budi@kopinuri.id">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a8c6e;">Password</label>
                                        <input type="password" name="password" required placeholder="Min. 8 karakter">
                                    </div>
                                    <div class="mb-6">
                                        <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: #7a8c6e;">Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" required placeholder="Ulangi password">
                                    </div>
                                    <button type="submit"
                                            class="w-full py-2.5 px-4 rounded-xl font-semibold text-sm transition-all"
                                            style="background-color: #1a2010; color: #f5f0e8;"
                                            onmouseover="this.style.backgroundColor='#4a6741'"
                                            onmouseout="this.style.backgroundColor='#1a2010'">
                                        + Daftarkan Kasir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Daftar Kasir --}}
                    <div class="lg:col-span-2">
                        <div class="rounded-2xl shadow-sm overflow-hidden" style="background-color: #ffffff;">

                            {{-- Table Header --}}
                            <div class="px-6 py-4 border-b flex items-center justify-between" style="border-color: #ede8df;">
                                <div>
                                    <h3 class="brand-font text-base font-bold" style="color: #1a2010;">Daftar Kasir</h3>
                                    <p class="text-xs mt-0.5" style="color: #a89880;">Akun yang dapat login ke sistem kasir</p>
                                </div>
                                <span class="text-xs font-medium px-3 py-1 rounded-full" style="background-color: #f0ebe0; color: #7a8c6e;">
                                    {{ $kasirs->count() }} akun
                                </span>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full">
                                    <thead>
                                        <tr style="background-color: #faf7f2;">
                                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Kasir</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Tanggal Bergabung</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: #7a8c6e;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kasirs as $kasir)
                                        <tr class="tr-row border-t" style="border-color: #f0ebe0;">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    {{-- Avatar inisial --}}
                                                    <div class="h-9 w-9 rounded-full flex items-center justify-center font-bold text-sm flex-shrink-0" style="background-color: #e8f0e6; color: #4a6741;">
                                                        {{ strtoupper(substr($kasir->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold" style="color: #1a2010;">{{ $kasir->name }}</div>
                                                        <div class="text-xs mt-0.5" style="color: #a89880;">{{ $kasir->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm" style="color: #3d5636;">{{ $kasir->created_at->format('d M Y') }}</div>
                                                <div class="text-xs mt-0.5" style="color: #a89880;">{{ $kasir->created_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('owner.akun.destroy', $kasir->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akses kasir ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-xs font-semibold px-3 py-1.5 rounded-lg transition"
                                                            style="background-color: #fde8e8; color: #a02020;"
                                                            onmouseover="this.style.backgroundColor='#a02020'; this.style.color='#fff'"
                                                            onmouseout="this.style.backgroundColor='#fde8e8'; this.style.color='#a02020'">
                                                        Hapus Akses
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-16 text-center">
                                                <div class="flex flex-col items-center gap-2" style="color: #a89880;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <p class="text-sm">Belum ada akun kasir terdaftar.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>