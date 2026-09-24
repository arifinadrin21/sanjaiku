<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
   public function index(Request $request)
{
    $query = Order::with('user')
        ->where('payment_status', 'lunas');

    // Filter tanggal
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
        ]);
    }

    // Filter tipe transaksi
    if ($request->filled('order_type') && $request->order_type !== 'semua') {
        $query->where('order_type', $request->order_type);
    }

    $orders = $query->latest()->get();

    $totalPesanan = $orders->count();
    $totalPendapatan = $orders->sum('total');

    return view('admin.reports.index', compact(
        'orders',
        'totalPesanan',
        'totalPendapatan'
    ));
}
    public function pdf(Request $request)
{
    $query = Order::with('user')
        ->where('payment_status', 'lunas');

    if ($request->filled('start_date') && $request->filled('end_date')) {

        $query->whereBetween('created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
        ]);

    }

    $orders = $query->latest()->get();

    $totalPendapatan = $orders->sum('total');

    $pdf = Pdf::loadView(
        'admin.reports.pdf',
        compact(
            'orders',
            'totalPendapatan'
        )
    );

    return $pdf->download('laporan-penjualan.pdf');
}

public function excel(Request $request)
{
    return Excel::download(
        new ReportsExport($request),
        'laporan-penjualan.xlsx'
    );
}
}