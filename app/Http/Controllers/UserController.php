<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
class UserController extends Controller
{
    public function dashboard()
{
    $totalProduk = Product::count();

    $totalKategori = Category::count();

    $totalPesanan = Order::count();

    $totalPelanggan = User::where('role', 'user')->count();

    $voucherAktif = Voucher::where('status', 1)->count();

    $pendingOrder = Order::where('status', 'pending')->count();

    $totalPendapatan = Order::where('payment_status', 'lunas')
        ->sum('total');

    $menungguVerifikasi = Order::where(
        'payment_status',
        'menunggu_verifikasi'
    )->count();

    $latestOrders = Order::with('user')
        ->latest()
        ->take(5)
        ->get();

    return view('user.dashboard', compact(
        'totalProduk',
        'totalKategori',
        'totalPesanan',
        'totalPelanggan',
        'voucherAktif',
        'pendingOrder',
        'totalPendapatan',
        'menungguVerifikasi',
        'latestOrders'
    ));
}
}