<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900">

<div class="min-h-screen flex items-start justify-center p-6 sm:p-6">
        <div class="w-full max-w-[300px] mx-6">
            
            <div class="mb-4">
                <a href="{{ route('kasir.riwayat.pesanan') }}" class="text-sm text-blue-600 hover:underline">
                    ← Kembali
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-2xl border border-gray-200 overflow-hidden">
                
                <div class="p-5 text-center border-b border-dashed border-gray-300">
                    <h1 class="text-lg font-bold tracking-wide">KOPI NURI</h1>
                    <p class="text-xs text-gray-500 mt-1">Struk Pesanan</p>
                </div>

                <div class="p-5 text-sm space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-500">No. Order</span>
                        <span class="font-medium">#{{ $order->id }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Meja</span>
                        <span class="font-medium">Meja {{ $order->meja->nomor_meja ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Kasir</span>
                        <span class="font-medium">{{ $order->kasir->name ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Status</span>
                        <span class="font-medium">{{ ucfirst($order->status_pesanan) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Tanggal</span>
                        <span class="font-medium">{{ $order->created_at->format('d-m-Y H:i') }}</span>
                    </div>
                </div>

                <div class="px-5">
                    <div class="border-t border-dashed border-gray-300"></div>
                </div>

                <div class="p-5">
                    <h2 class="text-sm font-semibold mb-3">Detail Pesanan</h2>

                    <div class="space-y-3 text-sm">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between gap-3">
                                <div class="flex-1">
                                    <div class="font-medium">{{ $item->menu->nama_menu ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ $item->qty }} x Rp {{ number_format($item->menu->harga ?? 0, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="font-medium text-right">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="px-5">
                    <div class="border-t border-dashed border-gray-300"></div>
                </div>

                <div class="p-5 space-y-2 text-sm">
                    <div class="flex justify-between font-bold text-base">
                        <span>Total</span>
                        <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="px-5">
                    <div class="border-t border-dashed border-gray-300"></div>
                </div>

                <div class="p-5 text-center text-xs text-gray-500 space-y-1">
                    <p>Terima kasih telah berkunjung</p>
                    <p>Kopi Nuri</p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>