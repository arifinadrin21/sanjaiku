@extends('layouts.app')

@section('title', 'Varian Produk')

@section('content')

{{-- Pastikan Font Awesome dimuat. Kalau di layouts.app sudah ada, baris ini boleh dihapus --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    .varian-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .varian-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .varian-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .varian-wrapper .card-title .title-icon {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #f0edfe;
        color: #7c3aed;
        font-size: 15px;
    }

    .varian-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .varian-wrapper .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        background: #fafbfc;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
        vertical-align: middle;
        white-space: nowrap;
    }

    .varian-wrapper .table thead th i {
        margin-right: 4px;
        opacity: 0.8;
    }

    .varian-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .varian-wrapper .table-bordered,
    .varian-wrapper .table-bordered th,
    .varian-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .varian-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .varian-wrapper .badge.bg-success {
        background: #eafaf0 !important;
        color: #16a34a !important;
    }
    .varian-wrapper .badge.bg-danger {
        background: #fdeef0 !important;
        color: #ef4444 !important;
    }

    /* ===== Badge khusus ===== */
    .varian-wrapper .badge-product {
        background: #eaf1ff;
        color: #2563eb;
    }

    .varian-wrapper .badge-size {
        background: #f0edfe;
        color: #7c3aed;
        font-family: 'Courier New', monospace;
    }

    .varian-wrapper .price-cell {
        font-weight: 700;
        color: #16a34a;
        white-space: nowrap;
    }

    .varian-wrapper .stock-cell {
        font-weight: 700;
        color: #1e293b;
    }

    .varian-wrapper .stock-cell.low {
        color: #ea580c;
    }

    .varian-wrapper .stock-cell.empty {
        color: #ef4444;
    }

    /* ===== Tombol aksi ===== */
    .varian-wrapper .action-group {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .varian-wrapper .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        line-height: 1;
        cursor: pointer;
        transition: opacity .15s ease, transform .15s ease;
        text-decoration: none;
        padding: 0;
    }
    .varian-wrapper .btn-icon:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }

    .varian-wrapper .btn-icon.btn-edit {
        background: #eaf1ff;
        color: #2563eb;
    }

    .varian-wrapper .btn-add {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 10px;
        transition: background .15s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .varian-wrapper .btn-add:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* ===== SAFEGUARD Font Awesome =====
       Agar ikon tetap tampil walau ada CSS global yang override font-family */
    .varian-wrapper .btn-icon i,
    .varian-wrapper .btn-add i,
    .varian-wrapper .card-title i,
    .varian-wrapper .alert i,
    .varian-wrapper .badge i,
    .varian-wrapper .table thead th i {
        font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", "FontAwesome" !important;
        font-weight: 900 !important;
        font-style: normal;
        display: inline-block;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .varian-wrapper .btn-add-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
    }

    .varian-wrapper .empty-state {
        text-align: center;
        padding: 24px 12px;
        color: #94a3b8;
    }
    .varian-wrapper .empty-state .empty-icon {
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
    .varian-wrapper .empty-state p {
        margin: 0;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="varian-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title mb-0">
                <span class="title-icon"><i class="fas fa-layer-group"></i></span>
                Daftar Varian Produk
            </h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i> No</th>
                        <th><i class="fas fa-cube"></i> Produk</th>
                        <th><i class="fas fa-ruler"></i> Ukuran</th>
                        <th><i class="fas fa-money-bill-wave"></i> Harga</th>
                        <th><i class="fas fa-boxes-stacked"></i> Stok</th>
                        <th><i class="fas fa-toggle-on"></i> Status Aktif</th>
                        <th width="100"><i class="fas fa-cogs"></i> Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($variants as $variant)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="badge badge-product">
                                    <i class="fas fa-box"></i>
                                    {{ $variant->product->name }}
                                </span>
                            </td>

                            <td>
                                <span class="badge badge-size">
                                    <i class="fas fa-ruler-combined"></i>
                                    {{ $variant->size }}
                                </span>
                            </td>

                            <td>
                                <span class="price-cell">
                                    Rp {{ number_format($variant->price, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                @if($variant->stock <= 0)
                                    <span class="stock-cell empty">
                                        <i class="fas fa-times-circle"></i> {{ $variant->stock }}
                                    </span>
                                @elseif($variant->stock <= 5)
                                    <span class="stock-cell low">
                                        <i class="fas fa-exclamation-triangle"></i> {{ $variant->stock }}
                                    </span>
                                @else
                                    <span class="stock-cell">
                                        <i class="fas fa-check-circle" style="color:#16a34a"></i> {{ $variant->stock }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($variant->is_active)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle"></i> Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="action-group">
                                    {{-- Hanya tombol Edit --}}
                                    <a href="{{ route('admin.product-variants.edit', $variant->id) }}"
                                       class="btn-icon btn-edit"
                                       title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-layer-group"></i></div>
                                    <p>Belum ada varian produk.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="btn-add-footer">
                <a href="{{ route('admin.product-variants.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Varian
                </a>
            </div>

        </div>
    </div>
</div>
@endsection