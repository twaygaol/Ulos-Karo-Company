@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-20">

    <h1 class="text-3xl font-bold mb-8">Checkout Produk</h1>

    <div class="bg-white shadow-lg rounded-xl p-8 grid md:grid-cols-2 gap-8">

        <div>
            <img src="{{ asset('storage/' . $product->image) }}"
                 class="rounded-lg w-full h-64 object-cover">
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>

            <p class="text-gray-600 mb-4">
                {{ $product->description }}
            </p>

            <p class="text-xl font-bold text-purple-600 mb-6">
                Rp {{ number_format($product->price) }}
            </p>

            <form action="{{ route('checkout.process', $product->id) }}" method="POST">
                @csrf

                <label class="block mb-2 font-semibold">Jumlah</label>
                <input type="number" name="qty" value="1" min="1"
                       class="w-full border rounded-lg p-3 mb-6">

                <button class="w-full bg-purple-600 text-white py-3 rounded-lg hover:bg-purple-700">
                    Buat Pesanan
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
