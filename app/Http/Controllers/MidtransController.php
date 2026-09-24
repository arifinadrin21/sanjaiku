<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Transaction;
class MidtransController extends Controller
{
    public function pay(Order $order)
    {
        // Pastikan pesanan milik user yang sedang login
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        return view('payment.midtrans', compact('order'));
    }

   public function finish(Order $order)
{
    if ($order->user_id != auth()->id()) {
        abort(403);
    }

    Config::$serverKey = config('services.midtrans.server_key');
    Config::$isProduction = config('services.midtrans.is_production', false);
    Config::$isSanitized = true;
    Config::$is3ds = true;

    try {

        $status = Transaction::status($order->invoice_number);

        $transactionStatus = $status->transaction_status ?? null;
        $fraudStatus = $status->fraud_status ?? null;

        if (
            $transactionStatus === 'settlement' ||
            (
                $transactionStatus === 'capture' &&
                $fraudStatus === 'accept'
            )
        ) {
            $order->payment_status = 'lunas';

            $order->midtrans_transaction_id = $status->transaction_id ?? null;
            $order->midtrans_payment_type = $status->payment_type ?? null;
            $order->midtrans_transaction_status = $transactionStatus;

            $order->save();
        }

    } catch (\Exception $e) {

        return redirect()
            ->route('orders.index')
            ->with('error', 'Status pembayaran belum dapat diperbarui.');
    }

    return redirect()
        ->route('orders.index')
        ->with('success', 'Pembayaran berhasil dikonfirmasi.');
}
    public function notification(Request $request)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notification = new Notification();

        $order = Order::where(
            'invoice_number',
            $notification->order_id
        )->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status ?? null;

        $order->update([
            'midtrans_transaction_id' => $notification->transaction_id,
            'midtrans_payment_type' => $notification->payment_type,
            'midtrans_transaction_status' => $transactionStatus,
        ]);

        if (
            $transactionStatus == 'settlement' ||
            ($transactionStatus == 'capture' && $fraudStatus == 'accept')
        ) {
            $order->update([
                'payment_status' => 'lunas',
                'status' => 'processing',
            ]);
        }

        return response()->json([
            'message' => 'Notification berhasil diproses'
        ]);
    }
}