@extends('layouts.app')

@section('content')

    <!-- NAVBAR -->
    <nav class="bg-white shadow fixed w-full top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between h-16 items-center">
            <span class="text-xl font-bold text-purple-600">Ulos Karo</span>
            <div class="flex items-center space-x-4">
                <!-- Tombol Katalog -->
                <a href="{{ route('landing') }}#katalog"
                    class="text-purple-600 hover:text-purple-700 font-medium hidden md:block">
                    🛍️ Katalog
                </a>

                <!-- Profile -->
                <div class="relative">
                    <div onclick="toggleDropdown()" class="flex items-center space-x-2 cursor-pointer">
                        <div
                            class="w-9 h-9 bg-purple-600 text-white flex items-center justify-center rounded-full font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-medium hidden md:block">
                            {{ $user->name }}
                        </span>
                    </div>

                    <!-- DROPDOWN -->
                    <div id="userDropdown"
                        class="absolute right-0 mt-3 w-48 bg-white rounded-lg shadow-lg border hidden z-50">
                        <div class="p-3 border-b">
                            <p class="font-semibold text-sm">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                        <a href="{{ route('landing') }}#katalog" class="block px-4 py-3 text-sm hover:bg-gray-100">
                            🛍️ Katalog Produk
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-3 text-sm hover:bg-gray-100 text-red-600">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- NOTIFIKASI PEMBAYARAN -->
    @if(request()->has('payment'))
        @if(request()->payment == 'success')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline"> Pembayaran Anda telah berhasil. Status akan segera terupdate.</span>
            </div>
        @elseif(request()->payment == 'pending')
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Pending!</strong>
                <span class="block sm:inline"> Pembayaran Anda sedang diproses.</span>
            </div>
        @elseif(request()->payment == 'cancelled')
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Dibatalkan!</strong>
                <span class="block sm:inline"> Anda membatalkan pembayaran.</span>
            </div>
        @endif
    @endif

    <!-- CONTENT -->
    <div class="pt-20 pb-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            <!-- Header dengan tombol belanja -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Saya</h1>
                    <p class="text-gray-600 text-sm">Kelola pesanan dan belanja ulos</p>
                </div>
                <a href="{{ route('landing') }}#katalog"
                    class="mt-4 md:mt-0 bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Belanja Lagi
                </a>
            </div>

            <!-- STATS -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <p class="text-gray-600 text-sm">Total Pesanan</p>
                    <p class="text-2xl font-bold">{{ $totalOrders }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <p class="text-gray-600 text-sm">Selesai / Lunas</p>
                    <p class="text-2xl font-bold text-green-600">{{ $completed }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <p class="text-gray-600 text-sm">Pending / Belum Bayar</p>
                    <p class="text-2xl font-bold text-orange-600">{{ $pending }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <p class="text-gray-600 text-sm">Total Belanja</p>
                    <p class="text-xl font-bold text-purple-600">
                        Rp {{ number_format($totalSpent) }}
                    </p>
                </div>
            </div>

            <!-- ORDERS -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="font-bold text-lg mb-4">Pesanan Saya</h2>

                @forelse($orders as $order)
                    <div class="border rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-sm text-gray-500">
                                    #{{ $order->order_number }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </p>

                                <!-- Tampilkan produk yang dipesan -->
                                @if($order->items->count() > 0)
                                    @foreach($order->items as $item)
                                        <div class="mt-2">
                                            <span class="font-medium">{{ $item->product->name }}</span>
                                            <span class="text-sm text-gray-600"> x {{ $item->quantity }}</span>
                                        </div>
                                    @endforeach
                                @elseif($order->product)
                                    <div class="mt-2">
                                        <span class="font-medium">{{ $order->product->name }}</span>
                                    </div>
                                @endif

                                <p class="text-purple-600 font-semibold mt-2">
                                    Rp {{ number_format($order->total_price) }}
                                </p>
                            </div>

                            <!-- STATUS BADGE -->
                            <div>
                                @if($order->payment_status == 'paid')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs">
                                        Lunas
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-xs">
                                        Belum Bayar
                                    </span>
                                @endif

                                <!-- Status Order -->
                                <span class="ml-2 bg-gray-100 text-gray-700 px-3 py-1 rounded text-xs">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- ACTION BUTTONS -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <a href="{{ route('orders.show', $order->id) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                                Detail Pesanan
                            </a>

                            @if($order->payment_status == 'pending' && $order->snap_token)
                                <button onclick="payNow('{{ $order->snap_token }}', '{{ $order->id }}')"
                                    class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
                                    Bayar Sekarang
                                </button>
                            @elseif($order->payment_status == 'paid')
                                <span class="text-green-600 text-sm font-semibold py-2">
                                    ✓ Pembayaran Selesai
                                </span>
                            @endif
                        </div>

                        <!-- FITUR BELI LAGI - Tambahkan ini -->
                        @if($order->items->count() > 0)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-600 mb-3 font-medium">Beli produk ini lagi:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($order->items as $item)
                                        <a href="{{ route('checkout', $item->product_id) }}"
                                            class="inline-flex items-center bg-purple-50 text-purple-700 px-4 py-2 rounded-lg text-sm hover:bg-purple-100 transition border border-purple-200">
                                            <span>{{ $item->product->name }}</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                                </path>
                                            </svg>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-500 mb-4">Belum ada pesanan</p>
                        <a href="{{ route('landing') }}#katalog"
                            class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700">
                            Belanja Sekarang
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- REKOMENDASI PRODUK - Tambahkan ini -->
            @php
                use App\Models\Product;
                $recommendedProducts = Product::inRandomOrder()->limit(3)->get();
            @endphp

            @if($recommendedProducts->count() > 0)
                <div class="bg-white rounded-lg shadow p-6 mt-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-lg">Rekomendasi untuk Anda</h2>
                        <a href="{{ route('landing') }}#katalog" class="text-purple-600 text-sm hover:underline">
                            Lihat Semua →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($recommendedProducts as $product)
                            <div class="border rounded-lg p-3 hover:shadow-lg transition">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-cover rounded mb-3"
                                    alt="{{ $product->name }}">
                                <h3 class="font-semibold text-gray-800">{{ $product->name }}</h3>
                                <p class="text-purple-600 font-bold mt-1">
                                    Rp {{ number_format($product->price) }}
                                </p>
                                <a href="{{ route('checkout', $product->id) }}"
                                    class="block text-center bg-purple-600 text-white py-2 rounded mt-3 text-sm hover:bg-purple-700 transition">
                                    Beli Sekarang
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- MIDTRANS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('hidden');
        }

        // klik luar = auto close
        window.addEventListener('click', function (e) {
            let dropdown = document.getElementById('userDropdown');
            if (!e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });

        function payNow(token, orderId) {
            snap.pay(token, {
                onSuccess: function (result) {
                    alert('Pembayaran berhasil!');
                    location.reload();
                },
                onPending: function (result) {
                    alert('Menunggu pembayaran Anda');
                    location.reload();
                },
                onError: function (result) {
                    alert('Pembayaran gagal, silakan coba lagi');
                },
                onClose: function () {
                    alert('Anda menutup popup pembayaran');
                }
            });
        }
    </script>

@endsection