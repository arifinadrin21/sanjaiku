@extends('layouts.app')

@section('title', 'Produk')

@section('content')

{{-- Pastikan Font Awesome dimuat. Kalau di layouts.app sudah ada, baris ini boleh dihapus --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    .produk-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .produk-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .produk-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .produk-wrapper .card-title .title-icon {
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

    .produk-wrapper .btn-add {
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
    .produk-wrapper .btn-add:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .produk-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .produk-wrapper .table thead th {
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

    .produk-wrapper .table thead th i {
        margin-right: 4px;
        opacity: 0.8;
    }

    .produk-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .produk-wrapper .table-bordered,
    .produk-wrapper .table-bordered th,
    .produk-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .produk-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .produk-wrapper .badge-success {
        background: #eafaf0;
        color: #16a34a;
    }

    .produk-wrapper .badge-danger {
        background: #fdeef0;
        color: #ef4444;
    }

    .produk-wrapper .badge-secondary {
        background: #f1f5f9;
        color: #64748b;
    }

    .produk-wrapper .badge-category {
        background: #f0edfe;
        color: #7c3aed;
    }

    .produk-wrapper .product-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eef1f6;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.06);
        transition: transform .15s ease;
    }

    .produk-wrapper .product-thumb:hover {
        transform: scale(1.05);
    }

    .produk-wrapper .thumb-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        background: #f1f5f9;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        border: 1px dashed #cbd5e1;
    }

    .produk-wrapper .product-name-cell {
        font-weight: 700;
        color: #1e293b;
    }

    .produk-wrapper .slug-cell {
        font-family: 'Courier New', monospace;
        font-size: 0.8rem;
        color: #64748b;
        background: #f8fafc;
        padding: 3px 8px;
        border-radius: 6px;
        border: 1px solid #eef1f6;
    }

    /* ===== Tombol aksi ===== */
    .produk-wrapper .action-group {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .produk-wrapper .btn-icon {
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
    .produk-wrapper .btn-icon:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }

    .produk-wrapper .btn-icon.btn-edit {
        background: #eaf1ff;
        color: #2563eb;
    }

    .produk-wrapper .btn-icon.btn-delete {
        background: #fdeef0;
        color: #ef4444;
    }

    /* ===== SAFEGUARD Font Awesome =====
       Agar ikon tetap tampil walau ada CSS global yang override font-family */
    .produk-wrapper .btn-icon i,
    .produk-wrapper .btn-add i,
    .produk-wrapper .card-title i,
    .produk-wrapper .alert i,
    .produk-wrapper .badge i,
    .produk-wrapper .table thead th i,
    .produk-wrapper .thumb-placeholder i {
        font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", "FontAwesome" !important;
        font-weight: 900 !important;
        font-style: normal;
        display: inline-block;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .produk-wrapper .btn-add-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
    }

    .produk-wrapper .empty-state {
        text-align: center;
        padding: 24px 12px;
        color: #94a3b8;
    }
    .produk-wrapper .empty-state .empty-icon {
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
    .produk-wrapper .empty-state p {
        margin: 0;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="produk-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title mb-0">
                <span class="title-icon"><i class="fas fa-box-open"></i></span>
                Daftar Produk
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
                        <th><i class="fas fa-image"></i> Gambar</th>
                        <th><i class="fas fa-tags"></i> Kategori</th>
                        <th><i class="fas fa-cube"></i> Nama Produk</th>
                        <th><i class="fas fa-link"></i> Slug</th>
                        <th><i class="fas fa-toggle-on"></i> Status</th>
                        <th><i class="fas fa-cogs"></i> Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/products/'.$product->image) }}"
                                         class="product-thumb"
                                         alt="{{ $product->name }}">
                                @else
                                    <span class="thumb-placeholder" title="Tidak ada gambar">
                                        <i class="fas fa-image"></i>
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="badge badge-category">
                                    <i class="fas fa-tag"></i>
                                    {{ $product->category->name }}
                                </span>
                            </td>

                            <td>
                                <span class="product-name-cell">{{ $product->name }}</span>
                            </td>

                            <td>
                                <span class="slug-cell">{{ $product->slug }}</span>
                            </td>

                            <td>
                                @if($product->status)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="action-group">

                                    <a href="{{ route('admin.products.edit',$product->id) }}"
                                       class="btn-icon btn-edit"
                                       title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.products.destroy',$product->id) }}"
                                          method="POST"
                                          style="display:inline; margin:0;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-icon btn-delete"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus produk?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                                    <p>Belum ada produk.</p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="btn-add-footer">
                <a href="{{ route('admin.products.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Tambah Produk
                </a>
            </div>

        </div>

    </div>

</div>

@endsection