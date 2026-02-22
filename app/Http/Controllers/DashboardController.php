<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ambil order milik user login - LOAD RELATIONSHIPS
        $orders = Order::with(['items.product', 'product']) // load items dan product
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        // Hitung statistik
        $totalOrders = $orders->count();

        // Hitung order yang sudah lunas (payment_status = 'paid')
        $completed = $orders->where('payment_status', 'paid')->count();

        // Hitung order yang pending (payment_status = 'pending')
        $pending = $orders->where('payment_status', 'pending')->count();

        // Hitung total pengeluaran (hanya yang sudah lunas)
        $totalSpent = $orders->where('payment_status', 'paid')->sum('total_price');

        // Debug: lihat data orders (bisa dihapus nanti)
        // \Log::info('Orders:', $orders->toArray());

        return view('dashboard.customer', [
            'user' => $user,
            'orders' => $orders,
            'totalOrders' => $totalOrders,
            'completed' => $completed,
            'pending' => $pending,
            'totalSpent' => $totalSpent,
        ]);
    }
}