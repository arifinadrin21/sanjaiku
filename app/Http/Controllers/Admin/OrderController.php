<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'cashier'])
    ->latest()
    ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.variant.product', 'user');

        return view('admin.orders.show', compact('order'));
    }

 public function update(Request $request, Order $order)
{
    $request->validate([
        'status'          => 'nullable|in:pending,diproses,dikemas,dikirim,selesai,dibatalkan',
        'courier'         => 'nullable|max:50',
        'tracking_number' => 'nullable|max:100',
    ]);

    $status = $request->status ?? $order->status;

    // Auto-set ke "dikirim" hanya saat resi BARU PERTAMA KALI diisi
    // (sebelumnya kosong, sekarang diisi), dan admin tidak sedang
    // memilih status akhir seperti selesai/dibatalkan.
    $resiBaruDiisi = blank($order->tracking_number) && $request->filled('tracking_number');

    if ($resiBaruDiisi && !in_array($status, ['selesai', 'dibatalkan'])) {
        $status = 'dikirim';
    }

    $order->update([
        'status'          => $status,
        'courier'         => $request->courier,
        'tracking_number' => $request->tracking_number,
    ]);

    return back()->with('success', 'Data pesanan berhasil diperbarui.');
}

    public function verifyPayment(Order $order)
{
    $order->update([

    'payment_status' => 'lunas',

    'status' => 'diproses'

]);

    return back()->with(
        'success',
        'Pembayaran berhasil diverifikasi.'
    );
}
}