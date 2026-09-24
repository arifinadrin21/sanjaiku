@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

{{-- Pastikan Font Awesome dimuat. Kalau di layouts.app sudah ada, baris ini boleh dihapus --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    .kategori-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .kategori-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .kategori-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .kategori-wrapper .card-title .title-icon {
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

    .kategori-wrapper .btn-add {
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
    .kategori-wrapper .btn-add:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .kategori-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kategori-wrapper .table thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        background: #fafbfc;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
        vertical-align: middle;
    }

    .kategori-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .kategori-wrapper .table-bordered,
    .kategori-wrapper .table-bordered th,
    .kategori-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .kategori-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .kategori-wrapper .badge-success {
        background: #eafaf0;
        color: #16a34a;
    }

    .kategori-wrapper .badge-danger {
        background: #fdeef0;
        color: #ef4444;
    }

    /* ===== Tombol aksi ===== */
    .kategori-wrapper .action-group {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .kategori-wrapper .btn-icon {
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
    .kategori-wrapper .btn-icon:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }

    .kategori-wrapper .btn-icon.btn-edit {
        background: #eaf1ff;
        color: #2563eb;
    }

    .kategori-wrapper .btn-icon.btn-delete {
        background: #fdeef0;
        color: #ef4444;
    }

    /* ===== SAFEGUARD Font Awesome =====
       Agar ikon tetap tampil walau ada CSS global yang override font-family */
    .kategori-wrapper .btn-icon i,
    .kategori-wrapper .btn-add i,
    .kategori-wrapper .card-title i,
    .kategori-wrapper .alert i,
    .kategori-wrapper .badge i,
    .kategori-wrapper .table thead th i {
        font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", "FontAwesome" !important;
        font-weight: 900 !important;
        font-style: normal;
        display: inline-block;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .kategori-wrapper .btn-add-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
    }

    .kategori-wrapper .empty-state {
        text-align: center;
        padding: 24px 12px;
        color: #94a3b8;
    }
    .kategori-wrapper .empty-state .empty-icon {
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
    .kategori-wrapper .empty-state p {
        margin: 0;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<div class="kategori-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title mb-0">
                <span class="title-icon"><i class="fas fa-tags"></i></span>
                Daftar Kategori
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
                        <th width="5%">No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $category->name }}</td>

                            <td>{{ $category->description }}</td>

                            <td>
                                @if($category->status)
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

                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn-icon btn-edit"
                                       title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          style="display:inline; margin:0;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-icon btn-delete"
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-tags"></i></div>
                                    <p>Belum ada data kategori.</p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="btn-add-footer">
                <a href="{{ route('admin.categories.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>

        </div>

    </div>

</div>

@endsection