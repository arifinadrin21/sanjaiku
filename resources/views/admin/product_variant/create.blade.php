@extends('layouts.app')

@section('title', 'Tambah Varian Produk')

@section('content')

<style>
    .varian-form-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .varian-form-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .varian-form-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        margin: 0;
    }

    .varian-form-wrapper .card-body {
        padding: 24px 20px;
    }

    .varian-form-wrapper .alert-danger {
        background: #fdeef0;
        border: 1px solid #fbd7dd;
        color: #ef4444;
        border-radius: 10px;
        font-weight: 600;
    }

    .varian-form-wrapper .alert-danger ul {
        padding-left: 18px;
    }

    .varian-form-wrapper label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .varian-form-wrapper .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .varian-form-wrapper .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .varian-form-wrapper .form-control.is-invalid {
        border-color: #ef4444;
    }

    .varian-form-wrapper .invalid-feedback {
        color: #ef4444;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .varian-form-wrapper .form-group {
        margin-bottom: 18px;
    }

    .varian-form-wrapper .card-footer {
        background: #fafbfc;
        border-top: 1px solid #f1f1f4;
        border-radius: 0 0 14px 14px;
        padding: 16px 20px;
        display: flex;
        gap: 10px;
    }

    .varian-form-wrapper .btn-save {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: background .15s ease;
    }
    .varian-form-wrapper .btn-save:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .varian-form-wrapper .btn-back {
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
    .varian-form-wrapper .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="varian-form-wrapper">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Varian Produk</h3>
        </div>

        <form action="{{ route('admin.product-variants.store') }}" method="POST">
            @csrf

            <div class="card-body">
                {{-- Tampilkan error umum --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Produk --}}
                <div class="form-group">
                    <label>Produk</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Ukuran --}}
                <div class="form-group">
                    <label>Ukuran</label>
                    <select name="size" class="form-control @error('size') is-invalid @enderror" required>
                        <option value="">-- Pilih Ukuran --</option>
                        <option value="250 gr" {{ old('size') == '250 gr' ? 'selected' : '' }}>250 gr</option>
                        <option value="500 gr" {{ old('size') == '500 gr' ? 'selected' : '' }}>500 gr</option>
                        <option value="1 kg" {{ old('size') == '1 kg' ? 'selected' : '' }}>1 kg</option>
                    </select>
                    @error('size')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" value="{{ old('price') }}"
                           class="form-control @error('price') is-invalid @enderror"
                           placeholder="Contoh: 18000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}"
                           class="form-control @error('stock') is-invalid @enderror" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input POIN dan STATUS POIN TIDAK ADA DI SINI --}}
            </div>

            <div class="card-footer">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.product-variants.index') }}" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection