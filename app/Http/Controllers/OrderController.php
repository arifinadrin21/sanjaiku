<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Daftar pesanan pelanggan
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Detail pesanan
     */
    public function show(Order $order)
    {
        // Pastikan pesanan hanya bisa dilihat oleh pemiliknya
        if ($order->user_id != Auth::id()) {
            abort(403);
        }

        // Load detail item pesanan
        $order->load('items.variant.product');

        return view('orders.show', compact('order'));
    }
}

