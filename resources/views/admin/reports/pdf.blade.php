<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 11px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 7px;
        }

        th {
            background: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total {
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>
        LAPORAN PENJUALAN SANJAIKU
    </h2>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Pelanggan</th>
                <th>Tipe Transaksi</th>
                <th>Pembayaran</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>

            @forelse($orders as $order)

                <tr>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $order->invoice_number }}
                    </td>

                    <td>
                        {{ $order->user->name ?? $order->recipient_name ?? '-' }}
                    </td>

                    <td>
                        {{ $order->order_type === 'kasir' ? 'Kasir' : 'Online' }}
                    </td>

                    <td>
                        {{ strtoupper($order->payment_method) }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ ucfirst($order->payment_status) }}
                    </td>

                    <td>
                        {{ $order->created_at->format('d-m-Y') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="8" class="text-center">
                        Tidak ada data penjualan.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="total">
        Total Pendapatan :
        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
    </div>

</body>

</html>