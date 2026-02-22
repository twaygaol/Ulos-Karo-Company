<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Terima notifikasi dari Midtrans
        $notification = new Notification();

        // Dapatkan order_id dari notifikasi
        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $fraudStatus = $notification->fraud_status;
        $grossAmount = $notification->gross_amount;

        // Cari order berdasarkan order_number
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found: ' . $orderId
            ], 404);
        }

        // Log untuk debugging
        \Log::info('Midtrans Callback Received', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
            'payment_type' => $paymentType
        ]);

        // Handle status transaksi
        if ($transactionStatus == 'capture') {
            // Untuk credit card, cek fraud status
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    // Transaksi di-challenge oleh Midtrans
                    $order->payment_status = 'pending';
                    $order->status = 'pending';
                } else {
                    // Transaksi sukses
                    $order->payment_status = 'paid';
                    $order->status = 'processing';
                }
            } else {
                // Untuk metode pembayaran lain
                $order->payment_status = 'paid';
                $order->status = 'processing';
            }
        } elseif ($transactionStatus == 'settlement') {
            // Transaksi sukses
            $order->payment_status = 'paid';
            $order->status = 'processing';
        } elseif ($transactionStatus == 'pending') {
            // Transaksi pending
            $order->payment_status = 'pending';
            $order->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            // Transaksi gagal
            $order->payment_status = 'failed';
            $order->status = 'cancelled';
        }

        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment status updated'
        ]);
    }
}