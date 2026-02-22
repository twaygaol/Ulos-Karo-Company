@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-20 text-center">

        <h1 class="text-3xl font-bold mb-6">Pembayaran</h1>

        <p class="mb-8">Klik tombol di bawah untuk membayar pesanan Anda</p>

        <button id="pay-button" class="bg-purple-600 text-white px-8 py-3 rounded-lg">
            Bayar Sekarang
        </button>

    </div>
@endsection


@section('scripts')

    <!-- SNAP JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').onclick = function () {

            snap.pay("{{ $snapToken }}", {

                onSuccess: function (result) {
                    window.location.href = "/dashboard";
                },

                onPending: function (result) {
                    alert("Menunggu pembayaran");
                },

                onError: function (result) {
                    alert("Pembayaran gagal");
                }

            });

        };
    </script>

@endsection