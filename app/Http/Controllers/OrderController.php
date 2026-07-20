<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (config('app.env') === 'production') {
            abort(404);
        }

        $order->payment_status = 'paid';
        $order->status = 'processing';
        $order->save();

        return redirect()->route('dashboard')->with('success', 'Status pembayaran diupdate manual (testing)');

    }

    public function cancel(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Hanya pesanan dengan status pending yang bisa dibatalkan.');
        }

        $order->status = 'cancelled';
        $order->save();

        // Kembalikan stok
        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibatalkan.');
    }

}
