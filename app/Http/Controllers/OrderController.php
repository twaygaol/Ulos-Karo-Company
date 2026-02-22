<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(order $order)
    {
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function updatePaymentStatus(Request $request, Order $order)
    {
        // Validasi hanya untuk testing
        if (config('app.env') !== 'production') {
            $order->payment_status = 'paid';
            $order->status = 'processing';
            $order->save();

            return redirect()->route('dashboard')->with('success', 'Status pembayaran diupdate manual (testing)');
        }

        abort(404);
    }

}
