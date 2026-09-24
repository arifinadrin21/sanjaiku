<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();

        $totalKategori = Category::count();

       $totalPesanan = Order::count();

$totalTransaksiKasir = Order::where(
    'order_type',
    'kasir'
)->count();

$totalTransaksiOnline = Order::where(
    'order_type',
    'online'
)->count();

        $totalPelanggan = User::where('role', 'user')->count();

        $voucherAktif = Voucher::where('status', 1)->count();

        $pendingOrder = Order::where('status', 'pending')->count();

        $menungguVerifikasi = Order::where(
            'payment_status',
            'menunggu_verifikasi'
        )->count();

        $totalPendapatan = Order::where(
    'payment_status',
    'lunas'
)->sum('total');

$totalProdukTerjual = OrderItem::whereHas('order', function ($query) {
    $query->where('payment_status', 'lunas');
})->sum('quantity');

        $latestOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // === BAGIAN YANG DIGANTI SESUAI INSTRUKSI ===
        // Sebelumnya: $monthlySales dan loop untuk $chartData (jumlah order)
        // Sekarang: $chartData berdasarkan total pendapatan per bulan (hanya payment_status lunas)
        $chartData = Order::selectRaw('MONTH(created_at) as bulan, SUM(total) as total')
            ->where('payment_status', 'lunas')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $data = [];

        foreach ($chartData as $item) {
            $labels[] = date('M', mktime(0, 0, 0, $item->bulan, 1));
            $data[] = $item->total;
        }
        // ==========================================

        $produkTerlaris = OrderItem::select(
            'product_name',
            DB::raw('SUM(quantity) as total_terjual')
        )
        ->groupBy('product_name')
        ->orderByDesc('total_terjual')
        ->take(5)
        ->get();
return view('admin.dashboard', compact(
    'totalProduk',
    'totalKategori',
    'totalPesanan',
    'totalTransaksiKasir',
    'totalTransaksiOnline',
    'totalPelanggan',
    'voucherAktif',
    'pendingOrder',
    'menungguVerifikasi',
    'totalPendapatan',
    'totalProdukTerjual',
    'latestOrders',
    'chartData',
    'labels',
    'data',
    'produkTerlaris'
));
    }
}