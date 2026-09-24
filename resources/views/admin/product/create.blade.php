@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<style>
    .produk-form-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .produk-form-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .produk-form-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        margin: 0;
    }

    .produk-form-wrapper .card-body {
        padding: 24px 20px;
    }

    .produk-form-wrapper label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .produk-form-wrapper .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .produk-form-wrapper .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .produk-form-wrapper .form-control.is-invalid {
        border-color: #ef4444;
    }

    .produk-form-wrapper .invalid-feedback {
        color: #ef4444;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .produk-form-wrapper .form-group {
        margin-bottom: 18px;
    }

    .produk-form-wrapper small.text-muted {
        display: block;
        margin-top: 6px;
        font-size: 0.78rem;
        color: #94a3b8 !important;
    }

    .produk-form-wrapper .card-footer {
        background: #fafbfc;
        border-top: 1px solid #f1f1f4;
        border-radius: 0 0 14px 14px;
        padding: 16px 20px;
        display: flex;
        gap: 10px;
    }

    .produk-form-wrapper .btn-save {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: background .15s ease;
    }
    .produk-form-wrapper .btn-save:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .produk-form-wrapper .btn-back {
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
    .produk-form-wrapper .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="produk-form-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Tambah Produk</h3>
        </div>

        <form action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="card-body">

                {{-- Kategori --}}
                <div class="form-group">
                    <label>Kategori</label>

                    <select name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">

                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Nama Produk --}}
                <div class="form-group">

                    <label>Nama Produk</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Masukkan nama produk">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Deskripsi --}}
                <div class="form-group">

                    <label>Deskripsi</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>

                </div>

                {{-- Gambar Produk --}}
                <div class="form-group">

                    <label>Gambar Produk</label>

                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/*">

                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="text-muted">
                        Format: JPG, JPEG, PNG. Maksimal 2 MB.
                    </small>

                </div>

                {{-- Status --}}
                <div class="form-group">

                    <label>Status</label>

                    <select name="status"
                        class="form-control">

                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>

                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('admin.products.index') }}"
                    class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection