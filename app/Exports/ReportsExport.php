<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportsExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Order::with('user')
            ->where('payment_status', 'lunas');

        // Filter tanggal
        if (
            $this->request->filled('start_date') &&
            $this->request->filled('end_date')
        ) {
            $query->whereBetween('created_at', [
                $this->request->start_date . ' 00:00:00',
                $this->request->end_date . ' 23:59:59'
            ]);
        }

        // Filter tipe transaksi
        if (
            $this->request->filled('order_type') &&
            $this->request->order_type !== 'semua'
        ) {
            $query->where('order_type', $this->request->order_type);
        }

        return $query
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    $order->invoice_number,

                    $order->user->name
                        ?? $order->recipient_name
                        ?? '-',

                    $order->order_type === 'kasir'
                        ? 'Kasir'
                        : 'Online',

                    strtoupper($order->payment_method),

                    $order->total,

                    ucfirst($order->payment_status),

                    ucfirst($order->status),

                    $order->created_at->format('d-m-Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Pelanggan',
            'Tipe Transaksi',
            'Pembayaran',
            'Total',
            'Status Pembayaran',
            'Status Pesanan',
            'Tanggal',
        ];
    }
}