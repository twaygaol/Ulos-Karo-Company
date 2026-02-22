<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.dashboard', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('customer.detail', compact('order'));
    }
}