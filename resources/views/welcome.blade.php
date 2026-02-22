<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulos Karo - Sistem Informasi Produk UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .pattern-bg {
            background-color: #f8f9fa;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23667eea' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold gradient-bg bg-clip-text text-transparent">Ulos Karo</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#beranda"
                        class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Beranda</a>
                    <a href="#tentang"
                        class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Tentang</a>
                    <a href="#produk"
                        class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Produk</a>
                    <a href="#fitur"
                        class="text-gray-700 hover:text-purple-600 px-3 py-2 rounded-md text-sm font-medium">Fitur</a>
                    <button onclick="showLogin()"
                        class="btn-primary text-white px-6 py-2 rounded-full text-sm font-medium">Masuk</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-24 pb-16 gradient-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white animate-fade-in">
                    <h1 class="text-5xl font-bold mb-6">Sistem Informasi Produk Ulos Karo</h1>
                    <p class="text-xl mb-8 text-purple-100">Mendukung Pemberdayaan UMKM Pengrajin Ulos Karo Berbasis Web
                    </p>
                    <div class="flex space-x-4">
                        <button onclick="scrollToProduk()"
                            class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Lihat
                            Produk</button>
                        <button onclick="showRegister()"
                            class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-purple-600 transition">Daftar
                            Sekarang</button>
                    </div>
                </div>
                <div class="relative">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 400'%3E%3Crect width='500' height='400' fill='%23f8f9fa'/%3E%3Cpath d='M250,50 L400,150 L400,300 L250,350 L100,300 L100,150 Z' fill='%23667eea' opacity='0.8'/%3E%3Cpath d='M250,100 L350,150 L350,250 L250,300 L150,250 L150,150 Z' fill='%23764ba2' opacity='0.6'/%3E%3Ctext x='250' y='210' font-family='Arial' font-size='40' fill='white' text-anchor='middle' font-weight='bold'%3EULOS%3C/text%3E%3Ctext x='250' y='250' font-family='Arial' font-size='30' fill='white' text-anchor='middle'%3EKARO%3C/text%3E%3C/svg%3E"
                        alt="Ulos Karo" class="rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="py-16 pattern-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Tentang Sistem</h2>
                <p class="text-xl text-gray-600">Solusi Digital untuk Pemberdayaan UMKM Ulos Karo</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="feature-icon w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Informasi Produk</h3>
                    <p class="text-gray-600">Menampilkan produk Ulos Karo secara informatif dan menarik dengan detail
                        lengkap</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="feature-icon w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Promosi & Pemasaran</h3>
                    <p class="text-gray-600">Membantu UMKM dalam proses promosi dan pemasaran produk lebih luas</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="feature-icon w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Pemberdayaan UMKM</h3>
                    <p class="text-gray-600">Mendukung pemberdayaan UMKM dengan fitur-fitur optimal dan mudah digunakan
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Section -->
    <section id="produk" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Produk Ulos Karo</h2>
                <p class="text-xl text-gray-600">Koleksi Terbaik dari UMKM Pengrajin Lokal</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8" id="productGrid">
                <!-- Product cards will be loaded here -->
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-16 pattern-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600">Sistem yang Dirancang untuk Kemudahan Anda</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- User Features -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold mb-6 text-purple-600">Untuk Pembeli</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Katalog produk lengkap dengan detail dan gambar
                                berkualitas</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Sistem pemesanan mudah dengan form data diri terintegrasi</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Pembayaran aman melalui Midtrans (berbagai metode)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Invoice otomatis untuk setiap transaksi</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Dashboard pribadi untuk tracking pesanan dan riwayat
                                pembelian</span>
                        </li>
                    </ul>
                </div>

                <!-- Admin Features -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h3 class="text-2xl font-bold mb-6 text-purple-600">Untuk Admin/UMKM</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Upload dan kelola produk dengan mudah</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Pengelolaan data produk (tambah, edit, hapus)</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Monitoring dan pengelolaan pembelian real-time</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Dashboard admin untuk laporan penjualan</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Manajemen status pesanan dan pengiriman</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 gradient-bg">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Memulai?</h2>
            <p class="text-xl text-purple-100 mb-8">Bergabunglah dengan kami dan dukung pemberdayaan UMKM Ulos Karo</p>
            <button onclick="showRegister()"
                class="bg-white text-purple-600 px-10 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition transform hover:scale-105">Daftar
                Sekarang</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Ulos Karo</h3>
                    <p class="text-gray-400">Sistem Informasi Produk UMKM Berbasis Web</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Menu</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#beranda" class="hover:text-white">Beranda</a></li>
                        <li><a href="#tentang" class="hover:text-white">Tentang</a></li>
                        <li><a href="#produk" class="hover:text-white">Produk</a></li>
                        <li><a href="#fitur" class="hover:text-white">Fitur</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@uloskaro.com</li>
                        <li>Telp: +62 xxx xxxx xxxx</li>
                        <li>Alamat: Medan, Sumatera Utara</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Ulos Karo. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Masuk</h2>
                <button onclick="closeModal('loginModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form onsubmit="handleLogin(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Password</label>
                    <input type="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg font-semibold">Masuk</button>
                <p class="text-center mt-4 text-gray-600">Belum punya akun? <button type="button"
                        onclick="closeModal('loginModal'); showRegister()"
                        class="text-purple-600 font-semibold">Daftar</button></p>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 animate-fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Daftar</h2>
                <button onclick="closeModal('registerModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form onsubmit="handleRegister(event)">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">No. Telepon</label>
                    <input type="tel" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Password</label>
                    <input type="password" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <button type="submit"
                    class="w-full btn-primary text-white py-3 rounded-lg font-semibold">Daftar</button>
                <p class="text-center mt-4 text-gray-600">Sudah punya akun? <button type="button"
                        onclick="closeModal('registerModal'); showLogin()"
                        class="text-purple-600 font-semibold">Masuk</button></p>
            </form>
        </div>
    </div>

    <!-- Product Modal -->
    <div id="productModal" class="modal">
        <div class="bg-white rounded-xl p-8 max-w-2xl w-full mx-4 animate-fade-in max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900" id="productModalTitle">Detail Produk</h2>
                <button onclick="closeModal('productModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div id="productModalContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>

    <!-- Order Form Modal -->
    <div id="orderModal" class="modal">
        <div class="bg-white rounded-xl p-8 max-w-2xl w-full mx-4 animate-fade-in max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Form Pemesanan</h2>
                <button onclick="closeModal('orderModal')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <form onsubmit="handleOrder(event)" id="orderForm">
                <div class="mb-4">
                    <h3 class="font-bold text-lg mb-2">Data Pembeli</h3>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="nama" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">No. Telepon *</label>
                    <input type="tel" name="telepon" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Alamat Lengkap *</label>
                    <textarea name="alamat" required rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Kota *</label>
                    <input type="text" name="kota" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Kode Pos *</label>
                    <input type="text" name="kodepos" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Jumlah *</label>
                    <input type="number" name="jumlah" min="1" value="1" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Catatan (Opsional)</label>
                    <textarea name="catatan" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"></textarea>
                </div>
                <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg font-semibold">Lanjutkan ke
                    Pembayaran</button>
            </form>
        </div>
    </div>

    <script>
        // Sample product data
        const products = [
            {
                id: 1,
                name: 'Ulos Ragi Hotang',
                price: 850000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%23764ba2"/%3E%3Cpath d="M0,0 L400,0 L400,100 L0,100 Z" fill="%23d4af37" opacity="0.8"/%3E%3Cpath d="M0,200 L400,200 L400,300 L0,300 Z" fill="%23d4af37" opacity="0.8"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3ERagi Hotang%3C/text%3E%3C/svg%3E',
                description: 'Ulos tradisional Karo dengan motif Ragi Hotang yang elegan',
                category: 'Premium'
            },
            {
                id: 2,
                name: 'Ulos Gatip Gantang',
                price: 650000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%23c41e3a"/%3E%3Cpath d="M0,50 L400,50 L400,100 L0,100 Z M0,200 L400,200 L400,250 L0,250 Z" fill="%23000" opacity="0.7"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3EGatip Gantang%3C/text%3E%3C/svg%3E',
                description: 'Ulos dengan motif khas Gatip Gantang untuk berbagai acara adat',
                category: 'Reguler'
            },
            {
                id: 3,
                name: 'Ulos Beka Buluh',
                price: 750000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%231a5490"/%3E%3Cpath d="M100,0 L100,300 M200,0 L200,300 M300,0 L300,300" stroke="%23ffd700" stroke-width="15" opacity="0.6"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3EBeka Buluh%3C/text%3E%3C/svg%3E',
                description: 'Ulos bermotif Beka Buluh yang sangat istimewa',
                category: 'Premium'
            },
            {
                id: 4,
                name: 'Ulos Abit Godang',
                price: 550000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%23228b22"/%3E%3Ccircle cx="100" cy="75" r="30" fill="%23ff6347" opacity="0.7"/%3E%3Ccircle cx="300" cy="75" r="30" fill="%23ff6347" opacity="0.7"/%3E%3Ccircle cx="100" cy="225" r="30" fill="%23ff6347" opacity="0.7"/%3E%3Ccircle cx="300" cy="225" r="30" fill="%23ff6347" opacity="0.7"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3EAbit Godang%3C/text%3E%3C/svg%3E',
                description: 'Ulos Abit Godang dengan kualitas terbaik',
                category: 'Reguler'
            },
            {
                id: 5,
                name: 'Ulos Kelam Kelam',
                price: 900000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%23000"/%3E%3Cpath d="M0,75 L400,75 M0,150 L400,150 M0,225 L400,225" stroke="%23ffd700" stroke-width="5"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3EKelam Kelam%3C/text%3E%3C/svg%3E',
                description: 'Ulos hitam elegan dengan detail emas yang mewah',
                category: 'Premium'
            },
            {
                id: 6,
                name: 'Ulos Cingkam',
                price: 600000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%238b4513"/%3E%3Cpath d="M0,0 L200,150 L0,300 Z M400,0 L200,150 L400,300 Z" fill="%23daa520" opacity="0.5"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3ECingkam%3C/text%3E%3C/svg%3E',
                description: 'Ulos Cingkam dengan motif geometris yang unik',
                category: 'Reguler'
            },
            {
                id: 7,
                name: 'Ulos Sibolang',
                price: 700000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%23800020"/%3E%3Cpath d="M0,100 L400,100 L400,200 L0,200 Z" fill="%23000" opacity="0.3"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3ESibolang%3C/text%3E%3C/svg%3E',
                description: 'Ulos Sibolang untuk acara-acara spesial',
                category: 'Premium'
            },
            {
                id: 8,
                name: 'Ulos Mangiring',
                price: 500000,
                image: 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 300"%3E%3Crect width="400" height="300" fill="%23ff8c00"/%3E%3Ccircle cx="200" cy="150" r="80" fill="%23fff" opacity="0.3"/%3E%3Ctext x="200" y="160" font-family="Arial" font-size="24" fill="white" text-anchor="middle" font-weight="bold"%3EMangiring%3C/text%3E%3C/svg%3E',
                description: 'Ulos Mangiring dengan warna cerah yang menarik',
                category: 'Reguler'
            }
        ];

        let selectedProduct = null;

        // Load products
        function loadProducts() {
            const grid = document.getElementById('productGrid');
            grid.innerHTML = products.map(product => `
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover cursor-pointer" onclick="showProductDetail(${product.id})">
                    <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full mb-2">${product.category}</span>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">${product.name}</h3>
                        <p class="text-gray-600 mb-4">${product.description}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-purple-600">Rp ${product.price.toLocaleString('id-ID')}</span>
                            <button onclick="event.stopPropagation(); showProductDetail(${product.id})" class="btn-primary text-white px-4 py-2 rounded-lg text-sm">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function showProductDetail(productId) {
            const product = products.find(p => p.id === productId);
            selectedProduct = product;

            const content = `
                <img src="${product.image}" alt="${product.name}" class="w-full h-64 object-cover rounded-lg mb-6">
                <div class="space-y-4">
                    <div>
                        <span class="inline-block px-3 py-1 text-xs font-semibold text-purple-600 bg-purple-100 rounded-full mb-2">${product.category}</span>
                        <h3 class="text-2xl font-bold text-gray-900">${product.name}</h3>
                    </div>
                    <p class="text-gray-600">${product.description}</p>
                    <div class="border-t pt-4">
                        <p class="text-3xl font-bold text-purple-600">Rp ${product.price.toLocaleString('id-ID')}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold mb-2">Informasi Produk:</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Bahan: Tenun Tradisional</li>
                            <li>• Ukuran: Standar Ulos Karo</li>
                            <li>• Produksi: UMKM Lokal</li>
                            <li>• Kualitas: Premium</li>
                        </ul>
                    </div>
                    <button onclick="showOrderForm()" class="w-full btn-primary text-white py-3 rounded-lg font-semibold">Pesan Sekarang</button>
                </div>
            `;

            document.getElementById('productModalContent').innerHTML = content;
            document.getElementById('productModalTitle').textContent = product.name;
            showModal('productModal');
        }

        function showOrderForm() {
            closeModal('productModal');
            showModal('orderModal');
        }

        function handleOrder(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const orderData = {
                product: selectedProduct,
                customer: {
                    nama: formData.get('nama'),
                    email: formData.get('email'),
                    telepon: formData.get('telepon'),
                    alamat: formData.get('alamat'),
                    kota: formData.get('kota'),
                    kodepos: formData.get('kodepos')
                },
                quantity: parseInt(formData.get('jumlah')),
                notes: formData.get('catatan'),
                totalPrice: selectedProduct.price * parseInt(formData.get('jumlah'))
            };

            // Simulate payment processing
            closeModal('orderModal');

            // Show success message and redirect to payment
            alert(`Terima kasih atas pesanan Anda!\n\nProduk: ${orderData.product.name}\nJumlah: ${orderData.quantity}\nTotal: Rp ${orderData.totalPrice.toLocaleString('id-ID')}\n\nAnda akan diarahkan ke halaman pembayaran Midtrans.\n\nSetelah pembayaran berhasil, invoice akan dikirim ke email Anda.`);

            // In production, this would redirect to Midtrans payment gateway
            console.log('Order Data:', orderData);
        }

        function handleLogin(event) {
            event.preventDefault();
            alert('Login berhasil! Anda akan diarahkan ke dashboard.');
            closeModal('loginModal');
            // In production, this would authenticate and redirect to user dashboard
        }

        function handleRegister(event) {
            event.preventDefault();
            alert('Registrasi berhasil! Silakan login untuk melanjutkan.');
            closeModal('registerModal');
            showLogin();
        }

        function showModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function showLogin() {
            showModal('loginModal');
        }

        function showRegister() {
            showModal('registerModal');
        }

        function scrollToProduk() {
            document.getElementById('produk').scrollIntoView({ behavior: 'smooth' });
        }

        // Close modal when clicking outside
        window.onclick = function (event) {
            if (event.target.classList.contains('modal')) {
                event.target.classList.remove('active');
            }
        }

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Load products on page load
        loadProducts();
    </script>
</body>

</html>