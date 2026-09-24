@extends('layouts.app')

@section('title', 'Data Pesanan')

@section('content')

{{-- ✅ WAJIB: load Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    .pesanan-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .pesanan-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .pesanan-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pesanan-wrapper .card-title .title-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #eaf1ff;
        color: #2563eb;
        font-size: 15px;
    }

    .pesanan-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pesanan-wrapper .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        background: #fafbfc;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
        vertical-align: middle;
        white-space: nowrap;
    }

    .pesanan-wrapper .table thead th i {
        margin-right: 4px;
        opacity: 0.8;
    }

    .pesanan-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
        font-size: 0.88rem;
    }

    .pesanan-wrapper .table-bordered,
    .pesanan-wrapper .table-bordered th,
    .pesanan-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .pesanan-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.72rem;
        white-space: nowrap;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .pesanan-wrapper .badge.bg-primary  { background: #eaf1ff !important; color: #2563eb !important; }
    .pesanan-wrapper .badge.bg-success  { background: #eafaf0 !important; color: #16a34a !important; }
    .pesanan-wrapper .badge.bg-danger   { background: #fdeef0 !important; color: #ef4444 !important; }
    .pesanan-wrapper .badge.bg-warning  { background: #fef7e6 !important; color: #d97706 !important; }
    .pesanan-wrapper .badge.bg-info     { background: #eaf6fd !important; color: #0891b2 !important; }
    .pesanan-wrapper .badge.bg-secondary{ background: #f1f5f9 !important; color: #64748b !important; }

    /* ===== Invoice & Pelanggan ===== */
    .pesanan-wrapper .invoice-cell {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 700;
        color: #2563eb;
        white-space: nowrap;
    }

    .pesanan-wrapper .invoice-cell i {
        opacity: 0.7;
    }

    .pesanan-wrapper .customer-cell {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .pesanan-wrapper .customer-cell .avatar {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #eaf1ff;
        color: #2563eb;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    /* ===== Total cell ===== */
    .pesanan-wrapper .total-cell {
        font-weight: 700;
        color: #16a34a;
        white-space: nowrap;
    }

    .pesanan-wrapper .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: none;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 0.78rem;
        font-weight: 700;
        transition: opacity .15s ease, transform .15s ease;
        text-decoration: none;
        cursor: pointer;
    }
    .pesanan-wrapper .btn-action:hover {
        opacity: 0.85;
        transform: translateY(-1px);
        color: inherit;
    }

    .pesanan-wrapper .btn-detail {
        background: #eaf1ff;
        color: #2563eb;
    }

    .pesanan-wrapper .btn-lihat {
        background: #eaf6fd;
        color: #0891b2;
    }

    .pesanan-wrapper .btn-verifikasi {
        background: #16a34a;
        color: #fff;
    }

    .pesanan-wrapper .btn-verifikasi:hover {
        color: #fff;
    }

    .pesanan-wrapper .cashier-info {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #334155;
        font-weight: 600;
    }

    .pesanan-wrapper .cashier-info i {
        color: #94a3b8;
    }

    .pesanan-wrapper .action-group {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    /* ===== SAFEGUARD Font Awesome ===== */
    .pesanan-wrapper .card-title i,
    .pesanan-wrapper .alert i,
    .pesanan-wrapper .badge i,
    .pesanan-wrapper .table thead th i,
    .pesanan-wrapper .btn-action i,
    .pesanan-wrapper .invoice-cell i,
    .pesanan-wrapper .customer-cell .avatar i,
    .pesanan-wrapper .cashier-info i {
        font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", "FontAwesome" !important;
        font-weight: 900 !important;
        font-style: normal;
        display: inline-block;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .pesanan-wrapper .empty-state {
        text-align: center;
        padding: 24px 12px;
        color: #94a3b8;
    }
    .pesanan-wrapper .empty-state .empty-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 10px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #94a3b8;
        font-size: 22px;
    }
    .pesanan-wrapper .empty-state p {
        margin: 0;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="pesanan-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <span class="title-icon"><i class="fas fa-receipt"></i></span>
                Data Pesanan
            </h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> No</th>
                        <th><i class="fas fa-file-invoice"></i> Invoice</th>
                        <th><i class="fas fa-user"></i> Pelanggan</th>
                        <th><i class="fas fa-money-bill-wave"></i> Total</th>
                        <th><i class="fas fa-credit-card"></i> Metode</th>
                        <th><i class="fas fa-circle-check"></i> Status Bayar</th>
                        <th><i class="fas fa-image"></i> Bukti</th>
                        <th><i class="fas fa-truck-fast"></i> Status Pesanan</th>
                        <th><i class="fas fa-tags"></i> Jenis Transaksi</th>
                        <th><i class="fas fa-user-tie"></i> Kasir</th>
                        <th width="220"><i class="fas fa-cogs"></i> Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($orders as $order)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <span class="invoice-cell">
                                <i class="fas fa-hashtag"></i>
                                {{ $order->invoice_number }}
                            </span>
                        </td>

                        <td>
                            <span class="customer-cell">
                                <span class="avatar">
                                    {{ strtoupper(substr($order->user->name ?? '-', 0, 1)) }}
                                </span>
                                {{ $order->user->name ?? '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="total-cell">
                                Rp {{ number_format($order->total,0,',','.') }}
                            </span>
                        </td>

                        {{-- METODE PEMBAYARAN --}}
                        <td>
                            @if($order->payment_method == 'cod')
                                <span class="badge bg-primary">
                                    <i class="fas fa-truck"></i> COD
                                </span>
                            @else
                                <span class="badge bg-success">
                                    <i class="fas fa-qrcode"></i> QRIS
                                </span>
                            @endif
                        </td>

                        {{-- STATUS PEMBAYARAN --}}
                        <td>
                            @switch($order->payment_status)
                                @case('belum_bayar')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle"></i> Belum Bayar
                                    </span>
                                    @break
                                @case('menunggu_verifikasi')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-hourglass-half"></i> Menunggu Verifikasi
                                    </span>
                                    @break
                                @case('lunas')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Lunas
                                    </span>
                                    @break
                            @endswitch
                        </td>

                        {{-- BUKTI PEMBAYARAN --}}
                        <td>
                            @if($order->payment_proof)
                                <a href="{{ asset('storage/payment_proofs/'.$order->payment_proof) }}"
                                   target="_blank"
                                   class="btn-action btn-lihat">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- STATUS PESANAN --}}
                        <td>
                            @switch($order->status)
                                @case('pending')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                    @break
                                @case('diproses')
                                    <span class="badge bg-info">
                                        <i class="fas fa-cogs"></i> Diproses
                                    </span>
                                    @break
                                @case('dikemas')
                                    <span class="badge bg-primary">
                                        <i class="fas fa-box-open"></i> Dikemas
                                    </span>
                                    @break
                                @case('dikirim')
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-truck"></i> Dikirim
                                    </span>
                                    @break
                                @case('selesai')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Selesai
                                    </span>
                                    @break
                                @case('dibatalkan')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-ban"></i> Dibatalkan
                                    </span>
                                    @break
                            @endswitch
                        </td>

                        {{-- JENIS TRANSAKSI --}}
                        <td>
                            @if($order->order_type === 'kasir')
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-cash-register"></i> Kasir
                                </span>
                            @else
                                <span class="badge bg-primary">
                                    <i class="fas fa-globe"></i> Online
                                </span>
                            @endif
                        </td>

                        {{-- KASIR --}}
                        <td>
                            @if($order->order_type === 'kasir')
                                <span class="cashier-info">
                                    <i class="fas fa-user-tie"></i>
                                    {{ $order->cashier->name ?? '-' }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="action-group">

                                <a href="{{ route('admin.orders.show',$order->id) }}"
                                   class="btn-action btn-detail">
                                    <i class="fas fa-circle-info"></i> Detail
                                </a>

                                @if(
                                    $order->payment_method == 'qris' &&
                                    $order->payment_status == 'menunggu_verifikasi'
                                )
                                    <form action="{{ route('admin.orders.verify-payment',$order->id) }}"
                                          method="POST"
                                          style="display:inline; margin:0;">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit"
                                                class="btn-action btn-verifikasi"
                                                onclick="return confirm('Verifikasi pembayaran ini?')">
                                            <i class="fas fa-circle-check"></i> Verifikasi
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="11">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                <p>Belum ada pesanan.</p>
                            </div>
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>
            </div>

        </div>

    </div>

</div>

@endsection