@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-20">

        <h1 class="text-3xl font-bold mb-8">Detail Pesanan</h1>

        <div class="bg-white p-8 rounded-xl shadow">

            <p><strong>No Order:</strong> {{ $order->order_number }}</p>
            <p><strong>Status:</strong>
                <span class="px-2 py-1 rounded text-sm
                    @if($order->status == 'processing') bg-blue-100 text-blue-700
                    @elseif($order->status == 'shipped') bg-purple-100 text-purple-700
                    @elseif($order->status == 'delivered' || $order->status == 'completed') bg-green-100 text-green-700
                    @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                    @else bg-yellow-100 text-yellow-700
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Status Pembayaran:</strong>
                @if($order->payment_status == 'paid')
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">Lunas</span>
                @elseif($order->payment_status == 'failed')
                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded">Gagal</span>
                @else
                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">Belum Dibayar</span>
                @endif
            </p>
            @if($order->payment_type)
                <p><strong>Metode Bayar:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</p>
            @endif
            <p><strong>Total:</strong> Rp {{ number_format($order->total_price) }}</p>

            <hr class="my-6">

            <h3 class="font-bold mb-3">Item Pesanan</h3>
            @foreach($order->items as $item)
                <div class="flex justify-between mb-3">
                    <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                    <span>Rp {{ number_format($item->price * $item->quantity) }}</span>
                </div>
            @endforeach



            @if($order->payment_status == 'pending' && $order->snap_token)
                <button id="pay-button" class="bg-green-600 text-white px-6 py-3 rounded-lg mt-6 hover:bg-green-700 mr-3">
                    Bayar Sekarang
                </button>

                <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"
                        class="bg-red-600 text-white px-6 py-3 rounded-lg mt-6 hover:bg-red-700">
                        Batalkan Pesanan
                    </button>
                </form>
            @endif

            <div class="mt-6">
                <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-700">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Midtrans Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script>
        // Pastikan elemen button ada sebelum menambahkan event listener
        document.addEventListener('DOMContentLoaded', function () {
            const payButton = document.getElementById('pay-button');

            if (payButton) {
                payButton.addEventListener('click', function () {
                    // Ambil snap token dari blade
                    const snapToken = '{{ $order->snap_token }}';

                    // Panggil Snap Midtrans
                    window.snap.pay(snapToken, {
                        onSuccess: function (result) {
                            alert("Pembayaran berhasil!");
                            // Redirect ke dashboard setelah sukses
                            window.location.href = "{{ route('dashboard') }}";
                        },
                        onPending: function (result) {
                            alert("Menunggu pembayaran Anda");
                            // Redirect ke dashboard setelah pending
                            window.location.href = "{{ route('dashboard') }}";
                        },
                        onError: function (result) {
                            alert("Pembayaran gagal, silakan coba lagi");
                            // Redirect ke dashboard setelah error
                            window.location.href = "{{ route('dashboard') }}";
                        },
                        onClose: function () {
                            alert("Anda menutup popup pembayaran");
                            // Redirect ke dashboard jika ditutup
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    });
                });
            }
        });
    </script>
    <script>
        function payNow(token) {
            window.snap.pay(token, {
                onSuccess: function (result) {
                    // Redirect ke dashboard setelah sukses
                    window.location.href = "{{ route('dashboard') }}?payment=success";
                },
                onPending: function (result) {
                    // Redirect ke dashboard setelah pending
                    window.location.href = "{{ route('dashboard') }}?payment=pending";
                },
                onError: function (result) {
                    alert("Pembayaran gagal, silakan coba lagi");
                },
                onClose: function () {
                    // Redirect ke dashboard jika ditutup
                    window.location.href = "{{ route('dashboard') }}?payment=cancelled";
                }
            });
        }
    </script>
@endsection