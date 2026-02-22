<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Detail Pesanan</h1>

        <div class="bg-white p-6 rounded-lg shadow">

            <p><b>Order ID:</b> {{ $order->order_number }}</p>
            <p><b>Total:</b> Rp {{ number_format($order->total_price) }}</p>
            <p><b>Status:</b> {{ $order->payment_status }}</p>

        </div>

    </div>
</x-app-layout>