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

        // Verifikasi signature hash
        $expectedSignature = hash(
            'sha512',
            $notification->order_id . $notification->status_code . $notification->gross_amount . config('services.midtrans.server_key')
        );

        if ($notification->signature_key !== $expectedSignature) {
            \Log::warning('Midtrans callback invalid signature', [
                'expected' => $expectedSignature,
                'received' => $notification->signature_key
            ]);
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 403);
        }

        // Dapatkan order_id dari notifikasi
        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $paymentType = $notification->payment_type;
        $fraudStatus = $notification->fraud_status;

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
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $order->payment_status = 'pending';
                    $order->status = 'pending';
                } else {
                    $order->payment_status = 'paid';
                    $order->status = 'processing';
                }
            } else {
                $order->payment_status = 'paid';
                $order->status = 'processing';
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->payment_status = 'paid';
            $order->status = 'processing';
        } elseif ($transactionStatus == 'pending') {
            $order->payment_status = 'pending';
            $order->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->payment_status = 'failed';
            $order->status = 'cancelled';
        }

        $order->payment_type = $paymentType;
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment status updated'
        ]);
    }
}