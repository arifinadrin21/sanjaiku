@extends('layouts.app')

@section('title', 'Tambah Voucher')

@section('content')

<style>
    .voucher-form-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .voucher-form-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .voucher-form-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        margin: 0;
    }

    .voucher-form-wrapper .card-body {
        padding: 24px 20px;
    }

    .voucher-form-wrapper label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .voucher-form-wrapper .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .voucher-form-wrapper .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .voucher-form-wrapper .form-group {
        margin-bottom: 18px;
    }

    .voucher-form-wrapper small.text-muted {
        display: block;
        margin-top: 6px;
        font-size: 0.78rem;
        color: #94a3b8 !important;
    }

    .voucher-form-wrapper .card-footer {
        background: #fafbfc;
        border-top: 1px solid #f1f1f4;
        border-radius: 0 0 14px 14px;
        padding: 16px 20px;
        display: flex;
        gap: 10px;
    }

    .voucher-form-wrapper .btn-save {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: background .15s ease;
    }
    .voucher-form-wrapper .btn-save:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .voucher-form-wrapper .btn-back {
        background: #f1f5f9;
        border: none;
        color: #475569;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: background .15s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .voucher-form-wrapper .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="voucher-form-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Tambah Voucher</h3>
        </div>

        <form action="{{ route('admin.vouchers.store') }}" method="POST">

            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label>Kode Voucher</label>

                    <input
                        type="text"
                        name="code"
                        class="form-control"
                        value="{{ old('code') }}"
                        placeholder="Contoh : SANJAI10"
                        required>
                </div>

                <div class="form-group">
                    <label>Nama Voucher</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Promo Hari Raya"
                        required>
                </div>

                <div class="form-group">
                    <label>Tipe Voucher</label>

                    <select name="type" class="form-control" required>

                        <option value="nominal">Nominal</option>

                        <option value="percent">Persentase</option>

                    </select>

                </div>

                <div class="form-group">
                    <label>Nilai Diskon</label>

                    <input
                        type="number"
                        name="discount_amount"
                        class="form-control"
                        value="{{ old('discount_amount') }}"
                        placeholder="10000 atau 20"
                        required>

                    <small class="text-muted">
                        Nominal = isi rupiah (10000), Persentase = isi angka (20 = 20%)
                    </small>

                </div>

                <div class="form-group">
                    <label>Minimal Belanja</label>

                    <input
                        type="number"
                        name="minimum_purchase"
                        class="form-control"
                        value="{{ old('minimum_purchase',0) }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Kuota</label>

                    <input
                        type="number"
                        name="quota"
                        class="form-control"
                        value="{{ old('quota',100) }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Tanggal Mulai</label>

                    <input
                        type="date"
                        name="start_date"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Tanggal Berakhir</label>

                    <input
                        type="date"
                        name="expired_date"
                        class="form-control"
                        required>
                </div>

                <div class="form-group">
                    <label>Status</label>

                    <select
                        name="status"
                        class="form-control">

                        <option value="1">
                            Aktif
                        </option>

                        <option value="0">
                            Nonaktif
                        </option>

                    </select>

                </div>

            </div>

            <div class="card-footer">

                <button class="btn-save">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>

                <a href="{{ route('admin.vouchers.index') }}"
                    class="btn-back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection