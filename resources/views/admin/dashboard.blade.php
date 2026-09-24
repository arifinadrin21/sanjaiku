@use(Illuminate\Support\Js)

@extends('layouts.app')
@section('title','Dashboard')
@section('content')

{{-- ✅ WAJIB: load Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    .dashboard-wrapper {
        font-family: 'Nunito', 'Segoe UI', sans-serif;
    }

    .dashboard-wrapper h3.card-title,
    .dashboard-wrapper h1,
    .dashboard-wrapper h2,
    .dashboard-wrapper h3,
    .dashboard-wrapper h4 {
        font-weight: 700;
        letter-spacing: 0.2px;
        color: #1e293b;
    }

    /* ===== Stat Cards ===== */
    .dashboard-wrapper .stat-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #eef1f6;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        padding: 20px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        transition: transform .15s ease, box-shadow .15s ease;
        height: 100%;
    }

    .dashboard-wrapper .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(15, 23, 42, 0.08);
    }

    .dashboard-wrapper .stat-card .stat-info p.stat-label {
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #94a3b8;
        margin-bottom: 6px;
    }

    /* Angka/value di stat card: tidak hitam, tidak terlalu tebal, warnanya mengikuti tema kartu */
    .dashboard-wrapper .stat-card .stat-info h3 {
        font-weight: 600;
        font-size: 1.6rem;
        margin-bottom: 0;
        line-height: 1.2;
    }

    .dashboard-wrapper .stat-card.card-blue   .stat-info h3 { color: #2563eb; }
    .dashboard-wrapper .stat-card.card-green  .stat-info h3 { color: #16a34a; }
    .dashboard-wrapper .stat-card.card-indigo .stat-info h3 { color: #7c3aed; }
    .dashboard-wrapper .stat-card.card-orange .stat-info h3 { color: #ea580c; }

    .dashboard-wrapper .stat-card .stat-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        position: relative;
    }

    .dashboard-wrapper .stat-icon::after {
        content: "";
        position: absolute;
        inset: -4px;
        border-radius: 14px;
        border: 2px solid currentColor;
        opacity: 0.15;
    }

    .dashboard-wrapper .stat-icon.icon-blue   { background: #eaf1ff; color: #2563eb; }
    .dashboard-wrapper .stat-icon.icon-green  { background: #eafaf0; color: #16a34a; }
    .dashboard-wrapper .stat-icon.icon-indigo { background: #f0edfe; color: #7c3aed; }
    .dashboard-wrapper .stat-icon.icon-orange { background: #fff1e8; color: #ea580c; }

    /* ===== Cards ===== */
    .dashboard-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        margin-bottom: 1.5rem;
    }

    .dashboard-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
    }

    .dashboard-wrapper .card-header .card-title {
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #1e293b;
    }

    .dashboard-wrapper .card-header .card-title i {
        color: #2563eb;
    }

    /* ===== Tables ===== */
    .dashboard-wrapper .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
        background: #fafbfc;
    }

    .dashboard-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .dashboard-wrapper .table-bordered,
    .dashboard-wrapper .table-bordered th,
    .dashboard-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .dashboard-wrapper .badge {
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
    }

    .dashboard-wrapper .badge i {
        margin-right: 4px;
    }

    .dashboard-wrapper .rank-cell {
        font-weight: 700;
        font-size: 1.1rem;
        text-align: center;
        color: #1e293b;
    }
</style>

<div class="dashboard-wrapper">

   <div class="row">

    {{-- TOTAL PENJUALAN --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-green">
            <div class="stat-info">
                <p class="stat-label">Total Penjualan</p>
                <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
            <div class="stat-icon icon-green">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

    {{-- TOTAL TRANSAKSI --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-blue">
            <div class="stat-info">
                <p class="stat-label">Total Transaksi</p>
                <h3>{{ $totalPesanan }}</h3>
            </div>
            <div class="stat-icon icon-blue">
                <i class="fas fa-receipt"></i>
            </div>
        </div>
    </div>

    {{-- TRANSAKSI KASIR --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-indigo">
            <div class="stat-info">
                <p class="stat-label">Transaksi Kasir</p>
                <h3>{{ $totalTransaksiKasir }}</h3>
            </div>
            <div class="stat-icon icon-indigo">
                <i class="fas fa-cash-register"></i>
            </div>
        </div>
    </div>

    {{-- PRODUK TERJUAL --}}
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card card-orange">
            <div class="stat-info">
                <p class="stat-label">Produk Terjual</p>
                <h3>{{ $totalProdukTerjual }}</h3>
            </div>
            <div class="stat-icon icon-orange">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>

</div>

    {{-- Card Pesanan Terbaru --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-receipt"></i> Pesanan Terbaru</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-file-invoice me-1"></i> Invoice</th>
                            <th><i class="fas fa-user me-1"></i> Pelanggan</th>
                            <th><i class="fas fa-money-bill-wave me-1"></i> Total</th>
                            <th><i class="fas fa-info-circle me-1"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($latestOrders as $order)
                        <tr>
                            <td>{{ $order->invoice_number }}</td>
                            <td>{{ $order->user->name ?? $order->recipient_name }}</td>
                            <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                            <td>
                                @switch($order->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i>Pending</span>
                                        @break
                                    @case('diproses')
                                        <span class="badge bg-info text-dark"><i class="fas fa-cogs"></i>Diproses</span>
                                        @break
                                    @case('dikemas')
                                        <span class="badge bg-primary"><i class="fas fa-box-open"></i>Dikemas</span>
                                        @break
                                    @case('dikirim')
                                        <span class="badge bg-success"><i class="fas fa-truck"></i>Dikirim</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge bg-success"><i class="fas fa-check-circle"></i>Selesai</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary"><i class="fas fa-question-circle"></i>{{ ucfirst($order->status) }}</span>
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                Belum ada pesanan.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Card 5 Produk Terlaris --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-trophy" style="color:#f1c40f"></i> 5 Produk Terlaris</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="70" class="text-center">Rank</th>
                            <th><i class="fas fa-cookie-bite me-1"></i> Nama Produk</th>
                            <th width="170"><i class="fas fa-chart-line me-1"></i> Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produkTerlaris as $produk)
                        <tr>
                            <td class="rank-cell">
                                @if($loop->iteration == 1)
                                    <i class="fas fa-medal" style="color:#FFD700"></i>
                                @elseif($loop->iteration == 2)
                                    <i class="fas fa-medal" style="color:#C0C0C0"></i>
                                @elseif($loop->iteration == 3)
                                    <i class="fas fa-medal" style="color:#CD7F32"></i>
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </td>
                            <td>{{ $produk->product_name }}</td>
                            <td>
                                <span class="badge bg-success"><i class="fas fa-check"></i>{{ $produk->total_terjual }} Terjual</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                <i class="fas fa-chart-bar fa-2x mb-2 d-block"></i>
                                Belum ada data penjualan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-chart-column"></i> Grafik Pendapatan Bulanan</h3>
        </div>
        <div class="card-body">
            @if(count($data))
                <canvas id="salesChart" height="100"></canvas>
            @else
                <div class="alert alert-warning d-flex align-items-center gap-2 mb-0">
                    <i class="fas fa-exclamation-triangle"></i>
                    Belum ada data penjualan yang sudah lunas.
                </div>
            @endif
        </div>
    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    const canvas=document.getElementById('salesChart');

    if(!canvas) return;

    new Chart(canvas,{

        type:'bar',

        data:{

            labels:@json($labels),

            datasets:[{

                label:'Pendapatan',

                data:@json($data),

                backgroundColor: 'rgba(37, 99, 235, 0.75)',

                borderColor: 'rgba(37, 99, 235, 1)',

                borderWidth:1,

                borderRadius: 6

            }]

        },

        options:{

            responsive:true,

            plugins:{

                legend:{

                    labels:{

                        font:{ weight: 'bold' }

                    }

                }

            },

            scales:{

                y:{

                    beginAtZero:true,

                    ticks:{ font:{ weight: '600' } }

                },

                x:{

                    ticks:{ font:{ weight: '600' } }

                }

            }

        }

    });

});

</script>

@endpush