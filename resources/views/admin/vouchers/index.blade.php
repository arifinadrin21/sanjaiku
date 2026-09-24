@extends('layouts.app')

@section('title','Data Voucher')

@section('content')

{{-- ✅ WAJIB: load Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    .voucher-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .voucher-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .voucher-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
    }

    .voucher-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
        border-radius: 10px;
        font-weight: 600;
    }

    .voucher-wrapper .table thead th {
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

    .voucher-wrapper .table td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .voucher-wrapper .table-bordered,
    .voucher-wrapper .table-bordered th,
    .voucher-wrapper .table-bordered td {
        border-color: #eef1f6;
    }

    .voucher-wrapper .badge {
        font-weight: 700;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 0.75rem;
        white-space: nowrap;
    }

    .sj-badge-nominal    { background: #eaf1ff; color: #2563eb; }
    .sj-badge-persentase { background: #fef7e6; color: #d97706; }
    .sj-badge-aktif      { background: #eafaf0; color: #16a34a; }
    .sj-badge-nonaktif   { background: #fdeef0; color: #ef4444; }

    .voucher-wrapper .btn-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: opacity .15s ease;
    }
    .voucher-wrapper .btn-icon:hover {
        opacity: 0.85;
    }

    .voucher-wrapper .btn-icon.btn-edit {
        background: #eaf1ff;
        color: #2563eb;
    }

    .voucher-wrapper .btn-icon.btn-delete {
        background: #fdeef0;
        color: #ef4444;
    }

    .voucher-wrapper .btn-add {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 10px;
        transition: background .15s ease;
    }
    .voucher-wrapper .btn-add:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .voucher-wrapper .btn-add-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
    }
</style>

<div class="voucher-wrapper">

    <div class="card">

        <div class="card-header">

            <h3 class="card-title mb-0">
                Data Voucher
            </h3>

        </div>

        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode</th>

                        <th>Nama</th>

                        <th>Tipe</th>

                        <th>Diskon</th>

                        <th>Minimal Belanja</th>

                        <th>Kuota</th>

                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($vouchers as $voucher)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $voucher->code }}</td>

                        <td>{{ $voucher->name }}</td>

                        <td>

                            @if($voucher->type=='nominal')

                                <span class="badge sj-badge-nominal">

                                    Nominal

                                </span>

                            @else

                                <span class="badge sj-badge-persentase">

                                    Persentase

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($voucher->type=='nominal')

                                Rp {{ number_format($voucher->discount_amount,0,',','.') }}

                            @else

                                {{ $voucher->discount_amount }} %

                            @endif

                        </td>

                        <td>

                            Rp {{ number_format($voucher->minimum_purchase,0,',','.') }}

                        </td>

                        <td>

                            {{ $voucher->used }} / {{ $voucher->quota }}

                        </td>

                        <td>

                            @if($voucher->status)

                                <span class="badge sj-badge-aktif">

                                    Aktif

                                </span>

                            @else

                                <span class="badge sj-badge-nonaktif">

                                    Nonaktif

                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('admin.vouchers.edit',$voucher->id) }}"
                                class="btn-icon btn-edit" title="Edit">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form
                                action="{{ route('admin.vouchers.destroy',$voucher->id) }}"
                                method="POST"
                                style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-icon btn-delete"
                                    title="Hapus"
                                    onclick="return confirm('Hapus voucher?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            Belum ada voucher.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>
            </div>

            <div class="btn-add-footer">
                <a href="{{ route('admin.vouchers.create') }}" class="btn-add">
                    <i class="fas fa-plus"></i>
                    Tambah Voucher
                </a>
            </div>

        </div>

    </div>

</div>

@endsection