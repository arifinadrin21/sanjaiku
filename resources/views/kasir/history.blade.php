@extends('layouts.kasir')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="page-header">

    <div>
        <h2>Riwayat Transaksi</h2>

        <p>
            Daftar transaksi yang dilakukan melalui Kasir.
        </p>
    </div>

</div>


<div class="history-card">

    <div class="history-toolbar">

        <form method="GET"
              action="{{ route('kasir.history') }}"
              class="history-search">

            <div class="search-input">

                <i class="fas fa-search"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari invoice atau nama pelanggan...">

            </div>

            <input
                type="date"
                name="date"
                value="{{ request('date') }}"
                class="date-input">

            <button type="submit" class="history-filter-button">

                <i class="fas fa-filter"></i>

                Filter

            </button>

            @if(request()->hasAny(['search', 'date']))

                <a href="{{ route('kasir.history') }}"
                   class="history-reset-button">

                    <i class="fas fa-rotate-left"></i>

                    Reset

                </a>

            @endif

        </form>

    </div>


    <div class="table-responsive">

        <table class="history-table">

            <thead>

                <tr>

                    <th>Invoice</th>

                    <th>Atas Nama</th>

                    <th>Total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($orders as $order)

                    <tr>

                        <td>

                            <strong class="invoice-number">
                                {{ $order->invoice_number }}
                            </strong>

                        </td>

                        <td>
                            {{ $order->recipient_name }}
                        </td>

                        <td>

                            <strong>
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </strong>

                        </td>

                        <td>

                            <span class="payment-badge">

                                <i class="fas fa-{{ $order->payment_method === 'cash' ? 'money-bill-wave' : 'qrcode' }}"></i>

                                {{ strtoupper($order->payment_method) }}

                            </span>

                        </td>

                        <td>

                            {{ $order->created_at->format('d/m/Y') }}

                            <small>
                                {{ $order->created_at->format('H:i') }}
                            </small>

                        </td>

                        <td>

                          <a href="{{ route('kasir.history.detail', $order->id) }}"
   class="history-detail-button">

    <i class="fas fa-eye"></i>

</a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="empty-history">

                            <i class="fas fa-receipt"></i>

                            <strong>Belum ada transaksi</strong>

                            <span>
                                Transaksi Kasir yang berhasil akan muncul di sini.
                            </span>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    @if($orders->hasPages())

        <div class="history-pagination">

            {{ $orders->links() }}

        </div>

    @endif

</div>

@endsection

@push('styles')
<style>

/* =========================
   LATAR HALAMAN KASIR
========================= */

body,
main,
.content,
.page-content {
    background: #ffffff !important;
}

.pos-layout,
.product-area,
.order-panel {
    background: #ffffff !important;
}

.product-grid {
    background: #ffffff !important;
}

/* Area heading */
.page-heading {
    background: #ffffff !important;
}

/* Kartu produk tetap putih */
.product-card {
    background: #ffffff !important;
}

/* Jika ada wrapper dari layouts.kasir */
.wrapper,
.main-content,
.content-wrapper {
    background: #ffffff !important;
}
    .page-header {
        margin-bottom: 25px;
    }

    .page-header h2 {
        margin: 0 0 6px;
        font-size: 28px;
        font-weight: 700;
        color: #172b4d;
    }

    .page-header p {
        margin: 0;
        color: #7b8794;
        font-size: 14px;
    }

    .history-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.05);
        border: 1px solid #edf0f5;
    }

    .history-toolbar {
        margin-bottom: 20px;
    }

    .history-search {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .search-input {
        position: relative;
        width: 330px;
    }

    .search-input i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #8b98a9;
    }

    .search-input input {
        width: 100%;
        height: 42px;
        border: 1px solid #dfe4ec;
        border-radius: 9px;
        padding: 0 15px 0 40px;
        outline: none;
        font-size: 14px;
    }

    .search-input input:focus,
    .date-input:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
    }

    .date-input {
        height: 42px;
        border: 1px solid #dfe4ec;
        border-radius: 9px;
        padding: 0 12px;
        outline: none;
        color: #374151;
    }

    .history-filter-button,
    .history-reset-button {
        height: 42px;
        border-radius: 9px;
        padding: 0 16px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        text-decoration: none;
        font-size: 14px;
        cursor: pointer;
    }

    .history-filter-button {
        background: #f59e0b;
        color: #ffffff;
    }

    .history-filter-button:hover {
        background: #d97706;
    }

    .history-reset-button {
        background: #f1f3f6;
        color: #5f6b7a;
    }

    .history-reset-button:hover {
        background: #e5e7eb;
        color: #374151;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .history-table thead th {
        background: #f8f9fb;
        color: #667085;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        padding: 14px 15px;
        border-bottom: 1px solid #e8ebf0;
    }

    .history-table tbody td {
        padding: 15px;
        border-bottom: 1px solid #edf0f4;
        color: #344054;
        font-size: 14px;
        vertical-align: middle;
    }

    .history-table tbody tr:hover {
        background: #fffaf0;
    }

    .invoice-number {
        color: #172b4d;
        font-size: 13px;
    }

    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 20px;
        background: #ecfdf3;
        color: #027a48;
        font-size: 12px;
        font-weight: 600;
    }

    .history-table td small {
        display: block;
        margin-top: 3px;
        color: #98a2b3;
    }

    .history-detail-button {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 8px;
        background: #f1f5f9;
        color: #475569;
        cursor: pointer;
        transition: 0.2s;
    }

    .history-detail-button:hover {
        background: #f59e0b;
        color: #ffffff;
    }

    .empty-history {
        text-align: center !important;
        padding: 50px 20px !important;
    }

    .empty-history i {
        display: block;
        font-size: 40px;
        color: #cbd5e1;
        margin-bottom: 12px;
    }

    .empty-history strong {
        display: block;
        color: #475569;
        margin-bottom: 5px;
    }

    .empty-history span {
        display: block;
        color: #94a3b8;
        font-size: 13px;
    }

    .history-pagination {
        margin-top: 20px;
    }

    @media (max-width: 900px) {

        .search-input {
            width: 100%;
        }

        .history-search {
            align-items: stretch;
        }

        .date-input,
        .history-filter-button,
        .history-reset-button {
            flex: 1;
        }

        .history-card {
            overflow-x: auto;
        }

        .history-table {
            min-width: 800px;
        }
    }

</style>
@endpush