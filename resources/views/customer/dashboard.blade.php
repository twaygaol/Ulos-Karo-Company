<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-6">Pesanan Saya</h1>

        <div class="bg-white rounded-lg shadow p-6">

            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-3">Produk</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b">
                            <td class="py-3">
                                {{ $order->product->name }}
                            </td>

                            <td>
                                Rp {{ number_format($order->total_price) }}
                            </td>

                            <td>
                                @if($order->payment_status == 'paid')
                                    <span class="text-green-600 font-semibold">Lunas</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">Pending</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="text-purple-600 font-semibold">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</x-app-layout>