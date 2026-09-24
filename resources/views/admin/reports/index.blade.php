@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')

{{-- ✅ WAJIB: load Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
    .laporan-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .laporan-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .laporan-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
    }

    .laporan-wrapper label.form-label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .laporan-wrapper .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 9px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .laporan-wrapper .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .laporan-wrapper .btn-filter {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 16px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .15s ease;
    }
    .laporan-wrapper .btn-filter:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .laporan-wrapper .btn-pdf {
        background: #fdeef0;
        border: none;
        color: #ef4444;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 16px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: opacity .15s ease;
    }
    .laporan-wrapper .btn-pdf:hover {
        opacity: 0.85;
        color: #ef4444;
    }

    .laporan-wrapper .btn-excel {
        background: #eafaf0;
        border: none;
        color: #16a34a;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 16px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: opacity .15s ease;
    }
    .laporan-wrapper .btn-excel:hover {
        opacity: 0.85;
        color: #16a34a;
    }

    .laporan-wrapper hr {
        border-top: 1px solid #eef1f6;
    }

    /* Stat cards */
    .laporan-wrapper .stat-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #eef1f6;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        height: 100%;
    }

    .laporan-wrapper .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .laporan-wrapper .stat-icon.icon-blue {
        background: #eaf1ff;
        color: #2563eb;
    }

    .laporan-wrapper .stat-icon.icon-green {
        background: #eafaf0;
        color: #16a34a;
    }

    .laporan-wrapper .stat-text .label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        color: #94a3b8;
        margin-bottom: 2px;
    }

    .laporan-wrapper .stat-text .value {
        font-size: 1.3rem;
        font-weight: 800;
        color: #1e293b;
    }

    /* Table */
    .laporan-wrapper .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        background: #fafbfc;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
    }

    .laporan-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .laporan-wrapper .table-bordered,
    .laporan-wrapper .table-bordered th,
    .laporan-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .laporan-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        background: #eafaf0 !important;
        color: #16a34a !important;
    }
</style>

<div class="laporan-wrapper">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Laporan Penjualan</h3>
        </div>
        <div class="card-body">

            {{-- FORM FILTER --}}
            <form method="GET" action="{{ route('admin.reports.index') }}" class="mb-3">
                <div class="row align-items-end">

                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Tanggal Awal</label>
                        <input type="date"
                               name="start_date"
                               id="start_date"
                               value="{{ request('start_date') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date"
                               name="end_date"
                               id="end_date"
                               value="{{ request('end_date') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="order_type" class="form-label">Tipe Transaksi</label>

                        <select name="order_type" id="order_type" class="form-control">
                            <option value="semua"
                                {{ request('order_type', 'semua') == 'semua' ? 'selected' : '' }}>
                                Semua Transaksi
                            </option>

                            <option value="online"
                                {{ request('order_type') == 'online' ? 'selected' : '' }}>
                                Online
                            </option>

                            <option value="kasir"
                                {{ request('order_type') == 'kasir' ? 'selected' : '' }}>
                                Kasir
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn-filter" type="submit">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>

                        <a href="{{ route('admin.reports.pdf', request()->all()) }}"
                           class="btn-pdf">
                            <i class="fas fa-file-pdf"></i>
                            PDF
                        </a>

                        <a href="{{ route('admin.reports.excel', request()->all()) }}"
                           class="btn-excel">
                            <i class="fas fa-file-excel"></i>
                            Excel
                        </a>
                    </div>

                </div>
            </form>

            <hr>

            {{-- STATISTIK --}}
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="stat-card">
                        <div class="stat-icon icon-blue">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-text">
                            <div class="label">Total Pesanan</div>
                            <div class="value">{{ $totalPesanan }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon icon-green">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div class="stat-text">
                            <div class="label">Total Pendapatan</div>
                            <div class="value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL DATA --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
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
                                <td>{{ $order->invoice_number }}</td>

                                <td>
                                    {{ $order->user->name ?? $order->recipient_name ?? '-' }}
                                </td>

                                <td>
                                    @if($order->order_type === 'kasir')
                                        <span class="badge bg-primary">
                                            Kasir
                                        </span>
                                    @else
                                        <span class="badge bg-info">
                                            Online
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ strtoupper($order->payment_method) }}
                                </td>

                                <td>
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </td>

                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>

                                <td>
                                    {{ $order->created_at->format('d-m-Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Tidak ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION (jika ada) --}}
            @if(method_exists($orders, 'links'))
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection