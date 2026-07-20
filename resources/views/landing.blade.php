@extends('layouts.app')

@section('content')

    <!-- NAVBAR -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between h-16 items-center">

            <span class="text-2xl font-bold text-purple-600">
                Ulos Karo
            </span>

            <div class="space-x-6 hidden md:block">
                <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-purple-600 transition">Tentang</a>
                <a href="#sejarah" class="text-gray-700 hover:text-purple-600 transition">Sejarah</a>
                <a href="#katalog" class="text-gray-700 hover:text-purple-600 transition">Katalog</a>
                <a href="#adat" class="text-gray-700 hover:text-purple-600 transition">Adat Karo</a>
                <a href="#motif" class="text-gray-700 hover:text-purple-600 transition">Motif</a>
            </div>

            <!-- CEK STATUS LOGIN -->
            @auth
                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                        Dashboard
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <div
                                class="w-9 h-9 bg-purple-600 text-white flex items-center justify-center rounded-full font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium hidden md:block text-gray-700">
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border py-1" x-cloak>
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Dashboard
                            </a>
                            <a href="{{ route('landing') }}#katalog"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Katalog
                            </a>
                            <hr class="my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    Login
                </a>
            @endauth
        </div>
    </nav>

    <!-- Tambahkan Alpine.js untuk dropdown (jika belum ada) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Style untuk x-cloak -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- HERO -->
    <section id="beranda" class="pt-32 pb-24 gradient-bg text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center relative z-10">

            <div>
                <h1 class="text-5xl font-bold mb-6">
                    Digitalisasi UMKM Ulos Karo
                </h1>

                <p class="text-xl mb-8">
                    Platform modern untuk membantu pengrajin ulos
                    mempromosikan produk, mengelola data, dan
                    meningkatkan penjualan secara digital.
                </p>

                <div class="flex gap-4">
                    <a href="#katalog"
                        class="bg-white text-purple-600 px-6 py-3 rounded-full font-semibold hover:shadow-lg transition">
                        Jelajahi Katalog
                    </a>
                    <a href="#motif"
                        class="border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">
                        Lihat Motif Ulos
                    </a>
                </div>
            </div>

            <div>
                <img src="https://media.istockphoto.com/id/2182324301/photo/a-display-rack-of-colorful-traditional-woven-fabric-called-ulos.webp?a=1&b=1&s=612x612&w=0&k=20&c=MO-gfOAr0xmmiW9fFpYbwAtsA5ZKe-ghipIRx1A6eA0="
                    class="rounded-xl shadow-2xl hover:scale-105 transition duration-500" alt="Pengrajin Ulos Karo">
            </div>


        </div>
    </section>

    <!-- STATS -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-4 text-center gap-8">

            <div class="p-6">
                <h3 class="text-4xl font-bold text-purple-600">{{ $umkm ? '1' : '0' }}</h3>
                <p class="text-gray-600 mt-2">UMKM Terdaftar</p>
            </div>

            <div class="p-6">
                <h3 class="text-4xl font-bold text-purple-600">{{ $totalProducts }}+</h3>
                <p class="text-gray-600 mt-2">Produk Ulos</p>
            </div>

            <div class="p-6">
                <h3 class="text-4xl font-bold text-purple-600">{{ $totalOrders }}+</h3>
                <p class="text-gray-600 mt-2">Transaksi Digital</p>
            </div>

            <div class="p-6">
                <h3 class="text-4xl font-bold text-purple-600">{{ $products->unique('jenis')->count() }}+</h3>
                <p class="text-gray-600 mt-2">Jenis Ulos</p>
            </div>

        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="py-20 pattern-bg">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 text-center">Tentang Sistem</h2>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://media.istockphoto.com/id/2197269726/photo/kampung-ulos-samosir-island-north-sumatera.webp?a=1&b=1&s=612x612&w=0&k=20&c=vXU43F8-jjGWz441os99n5apYEyNtSRqyVM3zymmBaU="
                        class="rounded-xl shadow-lg" alt="Tentang Sistem">
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-4">Platform Digital untuk UMKM Ulos</h3>
                    <p class="text-gray-600 text-lg mb-6">
                        Sistem informasi ini dikembangkan untuk mendukung pemberdayaan
                        UMKM pengrajin Ulos Karo melalui digitalisasi pemasaran,
                        manajemen produk, serta transaksi pembayaran online.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Mudah Digunakan</h4>
                                <p class="text-gray-600">Interface yang user-friendly untuk semua kalangan</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Aman & Terpercaya</h4>
                                <p class="text-gray-600">Sistem keamanan data dan transaksi yang terjamin</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold mb-1">Melestarikan Budaya</h4>
                                <p class="text-gray-600">Membantu melestarikan warisan budaya Karo</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEJARAH ULOS KARO -->
    @php
        $sejarah = $contents['sejarah']->first() ?? null;
    @endphp

    <section id="sejarah" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">

            <h2 class="text-3xl font-bold mb-6 text-center">
                {{ $sejarah->title ?? 'Sejarah Ulos Karo' }}
            </h2>

            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">
                {!! $sejarah->body ?? '' !!}
            </p>

        </div>
    </section>

    <!-- KATALOG JENIS ULOS -->
    <!-- KATALOG JENIS ULOS -->
    <section id="katalog" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Header dengan subtitle -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 text-purple-600">
                    Katalog Produk Ulos
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan berbagai motif Ulos Karo berkualitas tinggi, dibuat oleh pengrajin lokal dengan penuh makna dan
                    keindahan
                </p>
            </div>

            <!-- Grid Produk -->
            <div class="grid md:grid-cols-3 gap-8">

                @foreach($products as $product)
                    <div
                        class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">

                        <!-- Image Container dengan overlay -->
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover hover:scale-110 transition duration-500"
                                alt="{{ $product->name }}">

                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-white/90 text-purple-600 text-xs px-4 py-2 rounded-full font-semibold shadow-lg">
                                    {{ $product->jenis ?? 'Ulos Tradisional Karo' }}
                                </span>
                            </div>

                            <!-- Quick Action Hover -->
                            <div
                                class="absolute inset-0 bg-purple-900/40 opacity-0 hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <a href="{{ route('checkout', $product->id) }}"
                                    class="bg-white text-purple-600 px-6 py-3 rounded-full font-semibold -translate-y-2 hover:translate-y-0 transition duration-300 hover:bg-purple-600 hover:text-white shadow-xl">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-gray-800 hover:text-purple-600 transition">
                                {{ $product->name }}
                            </h3>

                            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                                {{ Str::limit($product->description, 100) }}
                            </p>

                            <!-- Divider -->
                            <div class="border-t border-dashed border-gray-200 my-4"></div>

                            <!-- Price and Button -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-sm text-gray-500">Harga</span>
                                    <p class="font-bold text-2xl text-purple-600">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                <a href="{{ route('checkout', $product->id) }}"
                                    class="bg-purple-600 text-white px-6 py-3 rounded-xl hover:bg-purple-700 transition-all hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-2">
                                    <span>Beli</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            </div>

                            <!-- Stock info (optional) -->
                            @if(isset($product->stock))
                                <div class="mt-3 text-xs text-gray-500">
                                    <span class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <circle cx="10" cy="10" r="8" />
                                        </svg>
                                        Stok: {{ $product->stock }} tersedia
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Tombol Lihat Semua -->
            <div class="text-center mt-12">
                <a href="{{ route('catalog') }}"
                    class="inline-flex items-center space-x-2 bg-gray-100 text-purple-600 px-8 py-4 rounded-full hover:bg-purple-600 hover:text-white transition-all font-semibold">
                    <span>Lihat Semua Koleksi</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>


    <!-- PROFIL ADAT KARO -->
    <section id="adat" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center">Profil Adat & Budaya Karo</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">
                Mengenal lebih dekat dengan kekayaan adat dan budaya masyarakat Karo
            </p>

            <!-- Sistem Kekerabatan -->
            <div class="mb-12">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-8 rounded-xl shadow-lg mb-8">
                    <h3 class="text-2xl font-bold mb-4">Sistem Kekerabatan Merga Si Lima</h3>
                    <p class="mb-6">
                        Masyarakat Karo mengenal sistem kekerabatan Merga Si Lima (Lima Marga) yang menjadi
                        identitas sosial dan dasar hubungan kekeluargaan dalam masyarakat Karo.
                    </p>
                    <div class="grid md:grid-cols-5 gap-4">
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg text-center">
                            <div class="font-bold text-lg mb-1">Ginting</div>
                            <div class="text-sm opacity-90">Marga Pertama</div>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg text-center">
                            <div class="font-bold text-lg mb-1">Karo-Karo</div>
                            <div class="text-sm opacity-90">Marga Kedua</div>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg text-center">
                            <div class="font-bold text-lg mb-1">Perangin-angin</div>
                            <div class="text-sm opacity-90">Marga Ketiga</div>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg text-center">
                            <div class="font-bold text-lg mb-1">Sembiring</div>
                            <div class="text-sm opacity-90">Marga Keempat</div>
                        </div>
                        <div class="bg-white bg-opacity-20 p-4 rounded-lg text-center">
                            <div class="font-bold text-lg mb-1">Tarigan</div>
                            <div class="text-sm opacity-90">Marga Kelima</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upacara Adat -->
            <div class="grid md:grid-cols-2 gap-8 mb-12">

                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <span
                            class="bg-blue-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">1</span>
                        Perkawinan (Runggu)
                    </h3>
                    <p class="text-gray-700 mb-3">
                        Upacara perkawinan adat Karo yang penuh makna dan tata cara, melibatkan keluarga besar
                        dari kedua belah pihak dengan rangkaian acara yang sakral.
                    </p>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Meminang (Ngerana)</li>
                        <li>• Hari pernikahan (Mbabiat Anak Beru)</li>
                        <li>• Seserahan dan pemberian ulos</li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <span
                            class="bg-green-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">2</span>
                        Kematian (Mate)
                    </h3>
                    <p class="text-gray-700 mb-3">
                        Upacara kematian yang menghormati arwah leluhur dengan rangkaian ritual adat
                        yang diikuti oleh seluruh keluarga dan masyarakat.
                    </p>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Genduri Mate (upacara kematian)</li>
                        <li>• Mukul (pembersihan rumah)</li>
                        <li>• Pemberian ulos kepada keluarga</li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <span
                            class="bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">3</span>
                        Kelahiran (Lahir Anak)
                    </h3>
                    <p class="text-gray-700 mb-3">
                        Menyambut kelahiran bayi dengan upacara syukuran yang melibatkan keluarga besar,
                        sebagai ungkapan rasa syukur atas anugerah kehidupan baru.
                    </p>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Turun tanah (anak menginjak tanah pertama kali)</li>
                        <li>• Pemberian nama adat</li>
                        <li>• Pemberian ulos kepada bayi</li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <span
                            class="bg-purple-600 text-white w-10 h-10 rounded-full flex items-center justify-center mr-3">4</span>
                        Panen & Syukuran
                    </h3>
                    <p class="text-gray-700 mb-3">
                        Upacara tradisional sebagai ungkapan syukur atas hasil panen dan rejeki yang diterima,
                        menjaga keharmonisan dengan alam dan Sang Pencipta.
                    </p>
                    <ul class="text-gray-600 text-sm space-y-1">
                        <li>• Kerja Tahun (perayaan panen raya)</li>
                        <li>• Makan bersama (Guro-guro Aron)</li>
                        <li>• Tari-tarian tradisional</li>
                    </ul>
                </div>

            </div>

            <!-- Peta Tanah Karo -->
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold mb-6 text-center">Wilayah Tanah Karo</h3>
                <div class="grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="bg-white p-4 rounded-lg shadow mb-4">
                            <img src="https://images.unsplash.com/photo-1657790823837-e2ce64fb8785?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8a2Fyb3xlbnwwfHwwfHx8MA%3D%3D"
                                class="w-full rounded-lg" alt="Peta Tanah Karo">
                        </div>
                        <p class="text-sm text-gray-600 text-center italic">Peta Kabupaten Karo, Sumatera Utara</p>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-4">Wilayah Geografis</h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm mr-3">Ibu
                                    Kota</span>
                                <span class="text-gray-700">Kabanjahe</span>
                            </div>
                            <div class="flex items-start">
                                <span
                                    class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm mr-3">Lokasi</span>
                                <span class="text-gray-700">Dataran Tinggi Karo, Sumatera Utara</span>
                            </div>
                            <div class="flex items-start">
                                <span
                                    class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm mr-3">Ketinggian</span>
                                <span class="text-gray-700">1200 - 1400 mdpl</span>
                            </div>
                            <div class="flex items-start">
                                <span
                                    class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm mr-3">Kecamatan</span>
                                <span class="text-gray-700">17 Kecamatan</span>
                            </div>
                        </div>

                        <h4 class="font-bold text-lg mt-6 mb-3">Kota-kota Penting</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-white p-3 rounded-lg shadow-sm">
                                <div class="font-semibold">Kabanjahe</div>
                                <div class="text-sm text-gray-600">Ibu kota kabupaten</div>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm">
                                <div class="font-semibold">Berastagi</div>
                                <div class="text-sm text-gray-600">Kota wisata</div>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm">
                                <div class="font-semibold">Merek</div>
                                <div class="text-sm text-gray-600">Pusat pendidikan</div>
                            </div>
                            <div class="bg-white p-3 rounded-lg shadow-sm">
                                <div class="font-semibold">Tigabinanga</div>
                                <div class="text-sm text-gray-600">Sentra pertanian</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MOTIF & SIMBOLISME ULOS -->
    <section id="motif" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center">Motif & Simbolisme Ulos Karo</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">
                Setiap motif pada ulos memiliki makna filosofis yang dalam dan mencerminkan nilai-nilai kehidupan masyarakat
                Karo
            </p>

            <div class="grid md:grid-cols-3 gap-8 mb-12">

                <!-- Motif Tumtuman -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl shadow-lg">
                    <div
                        class="h-40 bg-gradient-to-br from-red-400 to-red-600 rounded-lg mb-4 flex items-center justify-center">
                        <img src="https://www.tobatenun.com/cdn/shop/files/COV-TUMTUMANMOTIFSEDERHANAMERAHGOLD_900x.jpg?v=1713348260"
                            class="rounded-lg w-full h-full object-cover" alt="Motif Tumtuman">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Motif Tumtuman (Sulur)</h3>
                    <p class="text-gray-700 mb-3">
                        Motif sulur-suluran yang melambangkan pertumbuhan dan perkembangan kehidupan yang berkelanjutan.
                        Menggambarkan harapan agar kehidupan terus berkembang seperti tumbuhan yang merambat.
                    </p>
                    <div class="bg-red-50 p-3 rounded-lg">
                        <div class="font-semibold text-sm text-red-800">Makna:</div>
                        <div class="text-sm text-gray-700">Kesuburan, pertumbuhan, dan perkembangan</div>
                    </div>
                </div>

                <!-- Motif Pinang Beguling -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl shadow-lg">
                    <div
                        class="h-40 bg-gradient-to-br from-green-400 to-green-600 rounded-lg mb-4 flex items-center justify-center">
                        <img src="data:image/jpeg;base64,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"
                            class="rounded-lg w-full h-full object-cover" alt="Motif Pinang Beguling">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Motif Pinang Beguling</h3>
                    <p class="text-gray-700 mb-3">
                        Motif buah pinang yang berjajar melambangkan kerukunan dan persatuan dalam keberagaman.
                        Buah pinang yang rapat menggambarkan solidaritas masyarakat Karo.
                    </p>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <div class="font-semibold text-sm text-green-800">Makna:</div>
                        <div class="text-sm text-gray-700">Persatuan, kerukunan, dan kebersamaan</div>
                    </div>
                </div>

                <!-- Motif Ragi Hotang -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-lg">
                    <div
                        class="h-40 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg mb-4 flex items-center justify-center">
                        <img src="https://via.placeholder.com/300x200" class="rounded-lg w-full h-full object-cover"
                            alt="Motif Ragi Hotang">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Motif Ragi Hotang (Rotan)</h3>
                    <p class="text-gray-700 mb-3">
                        Motif rotan yang kuat dan fleksibel melambangkan kekuatan yang dapat beradaptasi.
                        Mengajarkan untuk tetap kuat namun tidak kaku dalam menghadapi kehidupan.
                    </p>
                    <div class="bg-blue-50 p-3 rounded-lg">
                        <div class="font-semibold text-sm text-blue-800">Makna:</div>
                        <div class="text-sm text-gray-700">Kekuatan, kelenturan, dan ketahanan</div>
                    </div>
                </div>

                <!-- Motif Bintang Timur -->
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-xl shadow-lg">
                    <div
                        class="h-40 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg mb-4 flex items-center justify-center">
                        <img src="https://via.placeholder.com/300x200" class="rounded-lg w-full h-full object-cover"
                            alt="Motif Bintang Timur">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Motif Bintang Timur</h3>
                    <p class="text-gray-700 mb-3">
                        Motif bintang yang bersinar terang melambangkan harapan dan cahaya dalam kehidupan.
                        Bintang timur dianggap sebagai penunjuk jalan dan pemberi petunjuk.
                    </p>
                    <div class="bg-yellow-50 p-3 rounded-lg">
                        <div class="font-semibold text-sm text-yellow-800">Makna:</div>
                        <div class="text-sm text-gray-700">Harapan, petunjuk, dan pencerahan</div>
                    </div>
                </div>

                <!-- Motif Cecak Manuk -->
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl shadow-lg">
                    <div
                        class="h-40 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg mb-4 flex items-center justify-center">
                        <img src="https://via.placeholder.com/300x200" class="rounded-lg w-full h-full object-cover"
                            alt="Motif Cecak Manuk">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Motif Cecak Manuk (Jejak Ayam)</h3>
                    <p class="text-gray-700 mb-3">
                        Motif jejak kaki ayam yang melambangkan ketelitian dan kewaspadaan dalam hidup.
                        Mengajarkan untuk selalu berhati-hati dalam setiap langkah kehidupan.
                    </p>
                    <div class="bg-purple-50 p-3 rounded-lg">
                        <div class="font-semibold text-sm text-purple-800">Makna:</div>
                        <div class="text-sm text-gray-700">Kehati-hatian, kewaspadaan, dan ketelitian</div>
                    </div>
                </div>

                <!-- Motif Ragi Ipen -->
                <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-6 rounded-xl shadow-lg">
                    <div
                        class="h-40 bg-gradient-to-br from-pink-400 to-pink-600 rounded-lg mb-4 flex items-center justify-center">
                        <img src="https://via.placeholder.com/300x200" class="rounded-lg w-full h-full object-cover"
                            alt="Motif Ragi Ipen">
                    </div>
                    <h3 class="text-xl font-bold mb-3">Motif Ragi Ipen (Gigi)</h3>
                    <p class="text-gray-700 mb-3">
                        Motif gigi yang tersusun rapi melambangkan keteraturan dan keseimbangan dalam kehidupan.
                        Menggambarkan harmoni antara berbagai aspek kehidupan.
                    </p>
                    <div class="bg-pink-50 p-3 rounded-lg">
                        <div class="font-semibold text-sm text-pink-800">Makna:</div>
                        <div class="text-sm text-gray-700">Keteraturan, keseimbangan, dan harmoni</div>
                    </div>
                </div>

            </div>

            <!-- Warna dalam Ulos -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-8 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold mb-6 text-center">Filosofi Warna dalam Ulos Karo</h3>
                <div class="grid md:grid-cols-3 gap-6">

                    <div class="bg-white bg-opacity-20 backdrop-blur-lg p-6 rounded-xl">
                        <div class="w-16 h-16 bg-red-600 rounded-full mx-auto mb-4 shadow-lg"></div>
                        <h4 class="text-xl font-bold mb-2 text-center">Merah</h4>
                        <p class="text-center text-sm opacity-90">
                            Melambangkan keberanian, semangat, dan vitalitas hidup. Warna ini juga
                            menggambarkan kehangatan kasih sayang dan cinta dalam keluarga.
                        </p>
                    </div>

                    <div class="bg-white bg-opacity-20 backdrop-blur-lg p-6 rounded-xl">
                        <div class="w-16 h-16 bg-black rounded-full mx-auto mb-4 shadow-lg border-2 border-white"></div>
                        <h4 class="text-xl font-bold mb-2 text-center">Hitam</h4>
                        <p class="text-center text-sm opacity-90">
                            Melambangkan keagungan, kekuatan, dan keteguhan. Hitam juga menggambarkan
                            kebijaksanaan dan pengalaman hidup yang mendalam.
                        </p>
                    </div>

                    <div class="bg-white bg-opacity-20 backdrop-blur-lg p-6 rounded-xl">
                        <div class="w-16 h-16 bg-white rounded-full mx-auto mb-4 shadow-lg border-2 border-purple-300">
                        </div>
                        <h4 class="text-xl font-bold mb-2 text-center">Putih</h4>
                        <p class="text-center text-sm opacity-90">
                            Melambangkan kesucian, kejujuran, dan ketulusan hati. Warna putih
                            menggambarkan niat baik dan keikhlasan dalam setiap tindakan.
                        </p>
                    </div>

                </div>

                <div class="mt-8 text-center">
                    <p class="text-lg opacity-90">
                        Kombinasi ketiga warna ini menciptakan harmoni yang melambangkan kehidupan yang seimbang
                        antara keberanian (merah), kebijaksanaan (hitam), dan kesucian (putih).
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- PROSES PEMBUATAN ULOS -->
    <section id="proses" class="py-20 bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6 text-center">Proses Pembuatan Ulos Tradisional</h2>
            <p class="text-center text-gray-600 mb-12 max-w-3xl mx-auto">
                Dari benang hingga menjadi karya seni yang indah, setiap ulos melalui proses yang panjang dan penuh dedikasi
            </p>

            <!-- Timeline Proses -->
            <div class="relative">
                <!-- Vertical Line -->
                <div
                    class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gradient-to-b from-purple-400 to-pink-400 hidden md:block">
                </div>

                <!-- Step 1 -->
                <div class="mb-12 flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:text-right md:pr-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">1. Persiapan Benang</h3>
                            <p class="text-gray-700">
                                Pemilihan benang katun atau sutra berkualitas tinggi. Benang dipilah berdasarkan
                                warna dan ketebalan yang diinginkan. Proses ini membutuhkan ketelitian tinggi
                                untuk menghasilkan kualitas terbaik.
                            </p>
                        </div>
                    </div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            1
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12"></div>
                </div>

                <!-- Step 2 -->
                <div class="mb-12 flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:pr-12"></div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            2
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">2. Pewarnaan (Opsional)</h3>
                            <p class="text-gray-700">
                                Benang dicelup dengan pewarna alami dari tumbuhan seperti mengkudu, kulit kayu,
                                dan daun-daunan. Proses pewarnaan tradisional ini memakan waktu berhari-hari
                                untuk mendapatkan warna yang tahan lama dan merata.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="mb-12 flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:text-right md:pr-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">3. Pemasangan Benang Lungsi</h3>
                            <p class="text-gray-700">
                                Benang lungsi (vertikal) dipasang pada alat tenun dengan panjang dan ketegangan
                                yang telah ditentukan. Proses ini menentukan ukuran dan kualitas ulos yang akan dihasilkan.
                                Membutuhkan keahlian khusus untuk memastikan tegangan benang yang sempurna.
                            </p>
                        </div>
                    </div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-pink-500 to-red-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            3
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12"></div>
                </div>

                <!-- Step 4 -->
                <div class="mb-12 flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:pr-12"></div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-red-500 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            4
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">4. Proses Tenun</h3>
                            <p class="text-gray-700">
                                Benang pakan (horizontal) dijalin dengan benang lungsi menggunakan alat tenun tradisional
                                (ATBM).
                                Pengrajin mengikuti pola motif yang telah ditentukan dengan sangat teliti.
                                Proses ini bisa memakan waktu 2-4 minggu untuk satu helai ulos.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="mb-12 flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:text-right md:pr-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">5. Pembuatan Motif</h3>
                            <p class="text-gray-700">
                                Motif dan pola dibuat dengan teknik khusus yang memerlukan konsentrasi tinggi.
                                Setiap motif memiliki hitungan benang tertentu yang harus diikuti dengan presisi.
                                Kesalahan sekecil apapun akan terlihat pada hasil akhir.
                            </p>
                        </div>
                    </div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-orange-500 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            5
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12"></div>
                </div>

                <!-- Step 6 -->
                <div class="mb-12 flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:pr-12"></div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-green-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            6
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">6. Finishing</h3>
                            <p class="text-gray-700">
                                Setelah selesai ditenun, ulos dilepas dari alat tenun dan dilakukan pengecekan kualitas.
                                Benang-benang yang masih lepas dipotong dan dirapikan. Ulos kemudian dicuci dan disetrika
                                agar siap digunakan atau dijual.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 7 -->
                <div class="flex flex-col md:flex-row items-center">
                    <div class="flex-1 md:text-right md:pr-12 mb-4 md:mb-0">
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-2 text-purple-600">7. Quality Control & Packaging</h3>
                            <p class="text-gray-700">
                                Ulos diperiksa secara menyeluruh untuk memastikan tidak ada cacat.
                                Kemudian dikemas dengan rapi dan diberi label yang mencantumkan jenis ulos,
                                nama pengrajin, dan informasi lainnya. Siap untuk sampai ke tangan konsumen
                                dengan kualitas terbaik.
                            </p>
                        </div>
                    </div>
                    <div class="relative flex items-center justify-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-500 to-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg z-10">
                            7
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12"></div>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-12 grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Waktu Pembuatan</h4>
                    <p class="text-gray-600 text-sm">2-4 minggu untuk satu helai ulos berkualitas tinggi</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">Keahlian Khusus</h4>
                    <p class="text-gray-600 text-sm">Dibutuhkan pengrajin berpengalaman minimal 5 tahun</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold mb-2">100% Handmade</h4>
                    <p class="text-gray-600 text-sm">Setiap ulos dibuat dengan tangan tanpa mesin modern</p>
                </div>
            </div>

        </div>
    </section>

    <!-- CTA -->
    <section class="py-20 gradient-bg text-white text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                Dukung Pelestarian Budaya Ulos Karo
            </h2>

            <p class="text-xl mb-8 opacity-90">
                Bergabunglah bersama kami untuk membantu UMKM pengrajin ulos berkembang dan melestarikan warisan budaya Karo
            </p>

            <div class="flex gap-4 justify-center flex-wrap">
                <a href="/login"
                    class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:shadow-lg transition">
                    Mulai Sekarang
                </a>
                <a href="#katalog"
                    class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">
                    Lihat Katalog
                </a>
            </div>

            <div class="mt-12 grid md:grid-cols-3 gap-6 text-left">
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl">
                    <div class="text-3xl font-bold mb-2">100%</div>
                    <div class="opacity-90">Produk Asli Handmade</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl">
                    <div class="text-3xl font-bold mb-2">Gratis</div>
                    <div class="opacity-90">Ongkir Area Karo*</div>
                </div>
                <div class="bg-white bg-opacity-10 backdrop-blur-lg p-6 rounded-xl">
                    <div class="text-3xl font-bold mb-2">24/7</div>
                    <div class="opacity-90">Customer Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">

                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4 gradient-bg bg-clip-text text-transparent">Ulos Karo</h3>
                    <p class="text-gray-400 text-sm mb-4">
                        Platform digitalisasi UMKM untuk mempromosikan dan melestarikan warisan budaya ulos Karo.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="bg-gray-800 p-2 rounded-lg hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-2 rounded-lg hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-2 rounded-lg hover:bg-gray-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-bold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#beranda" class="hover:text-white">Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-white">Tentang</a></li>
                        <li><a href="#sejarah" class="hover:text-white">Sejarah</a></li>
                        <li><a href="#katalog" class="hover:text-white">Katalog</a></li>
                        <li><a href="#adat" class="hover:text-white">Adat Karo</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="font-bold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#motif" class="hover:text-white">Motif & Simbolisme</a></li>
                        <li><a href="#proses" class="hover:text-white">Proses Pembuatan</a></li>
                        <li><a href="/login" class="hover:text-white">Login</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Kabanjahe, Kabupaten Karo, Sumatera Utara</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>info@uloskaro.com</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-gray-400 text-sm">
                <p>© {{ date('Y') }} Sistem Informasi Ulos Karo. All Rights Reserved.</p>
                <p class="mt-2">Dikembangkan dengan ❤️ untuk melestarikan budaya Karo</p>
            </div>
        </div>
    </footer>

@endsection