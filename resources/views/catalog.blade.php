@extends('layouts.app')

@section('content')
    <div class="pt-20 pb-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">Katalog Produk Ulos</h1>
                <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-700">
                    ← Kembali ke Dashboard
                </a>
            </div>

            <!-- Grid Produk -->
            <div class="grid md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-cover rounded mb-3">
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="text-purple-600 font-bold mt-1">
                            Rp {{ number_format($product->price) }}
                        </p>
                        <a href="{{ route('checkout', $product->id) }}"
                            class="block text-center bg-purple-600 text-white py-2 rounded mt-3 hover:bg-purple-700">
                            Beli Sekarang
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection