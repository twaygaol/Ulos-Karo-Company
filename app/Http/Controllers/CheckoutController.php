<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index(Product $product)
    {
        return view('checkout.index', compact('product'));
    }

    public function process(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        if ($product->stock < $request->qty) {
            return back()->withErrors(['qty' => 'Stok tidak mencukupi. Sisa stok: ' . $product->stock]);
        }

        $total = $product->price * $request->qty;

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . time(),
            'total_price' => $total,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price' => $product->price,
            'quantity' => $request->qty,
        ]);

        $product->decrement('stock', $request->qty);

        // MIDTRANS PARAMS
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->update([
            'snap_token' => $snapToken
        ]);

        return redirect()->route('orders.show', $order->id);
    }
}
