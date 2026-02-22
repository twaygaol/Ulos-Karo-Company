<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">🦋 E-Commerce Ulos Karo</h1>

<p align="center">
  <a href="#fitur"><strong>Fitur</strong></a> •
  <a href="#teknologi"><strong>Teknologi</strong></a> •
  <a href="#cara-instalasi"><strong>Cara Instalasi</strong></a> •
  <a href="#penggunaan"><strong>Penggunaan</strong></a> •
  <a href="#struktur-database"><strong>Database</strong></a> •
  <a href="#midtrans-integration"><strong>Midtrans</strong></a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css" alt="Tailwind">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Midtrans-Integration-00A79D?style=for-the-badge" alt="Midtrans">
</p>

## 📖 Tentang Proyek

**Ulos Karo** adalah platform e-commerce yang didedikasikan untuk melestarikan dan mempromosikan kain tenun tradisional Ulos khas suku Karo, Sumatera Utara. Sistem ini memungkinkan pengrajin lokal untuk menjual produk Ulos mereka secara online dan memudahkan pembeli dari berbagai daerah untuk mendapatkan Ulos berkualitas.

### 🎯 Tujuan
- Melestarikan warisan budaya Ulos Karo melalui platform digital
- Memberdayakan pengrajin lokal dengan akses pasar yang lebih luas
- Memudahkan masyarakat mendapatkan Ulos asli dengan proses transaksi aman

## ✨ Fitur Utama

### Untuk Pengunjung
- **Landing Page Interaktif** - Menampilkan informasi lengkap tentang Ulos Karo (Sejarah, Adat, Motif)
- **Katalog Produk** - Lihat berbagai motif dan jenis Ulos dengan harga
- **Navigasi Smooth Scroll** - Mudah berpindah antar section

### Untuk Customer (Setelah Login)
- **Dashboard Customer** - Kelola semua pesanan dalam satu tempat
- **Statistik Pesanan** - Total pesanan, selesai, pending, total belanja
- **Riwayat Pesanan** - Lihat status pesanan (pending, lunas, diproses)
- **Detail Pesanan** - Informasi lengkap setiap transaksi
- **Beli Lagi** - Fitur untuk membeli produk yang sama dari riwayat
- **Rekomendasi Produk** - Saran produk berdasarkan preferensi
- **Profile Dropdown** - Akses cepat ke dashboard dan logout

### Sistem Pembayaran
- **Integrasi Midtrans Snap** - Pembayaran via berbagai metode (transfer bank, kartu kredit, e-wallet)
- **Callback Otomatis** - Status pembayaran terupdate real-time
- **Snap Token** - Generate token pembayaran unik setiap transaksi
- **Notifikasi** - Alert status pembayaran di dashboard
- **Force Update** - Fitur testing untuk update status manual (mode development)

### Manajemen Produk
- **Kategori Produk** - Pengelompokan berdasarkan jenis Ulos
- **Stock Info** - Informasi ketersediaan barang
- **Harga Dinamis** - Format Rupiah otomatis
- **Gambar Produk** - Upload dan tampilkan foto produk

## 🛠️ Teknologi

| Teknologi | Versi | Kegunaan |
|-----------|-------|----------|
| Laravel | 11.x | Framework PHP utama |
| PHP | 8.2+ | Bahasa pemrograman |
| MySQL | 8.0+ | Database |
| Tailwind CSS | 3.x | Styling dan UI (tanpa CSS manual) |
| Alpine.js | 3.x | Interaktivitas frontend (dropdown, modal) |
| Midtrans Snap | 2.x | Payment gateway |
| Laravel Breeze | - | Authentication scaffolding |

## 📦 Cara Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (untuk assets)
- Akun Midtrans (Sandbox/Production)
- Ngrok (untuk testing callback local)

### Langkah-langkah Instalasi

1. **Clone repository**
```bash
git clone https://github.com/username/ulos-karo.git
cd ulos-karo