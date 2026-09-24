@extends('layouts.app')

@section('title', 'Edit Produk')

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

    .produk-form-wrapper .form-group {
        margin-bottom: 18px;
    }

    .produk-form-wrapper small.text-muted {
        display: block;
        margin-top: 6px;
        font-size: 0.78rem;
        color: #94a3b8 !important;
    }

    .produk-form-wrapper .img-thumbnail {
        border: 1px solid #eef1f6;
        border-radius: 10px;
        padding: 4px;
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
            <h3 class="card-title">Edit Produk</h3>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card-body">

                {{-- Kategori --}}
                <div class="form-group">

                    <label>Kategori</label>

                    <select name="category_id" class="form-control">

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Nama --}}
                <div class="form-group">

                    <label>Nama Produk</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name',$product->name) }}">

                </div>

                {{-- Deskripsi --}}
                <div class="form-group">

                    <label>Deskripsi</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control">{{ old('description',$product->description) }}</textarea>

                </div>

                {{-- Gambar Lama --}}
                <div class="form-group">

                    <label>Gambar Saat Ini</label>

                    <br>

                    @if($product->image)

                        <img
                            src="{{ asset('storage/products/'.$product->image) }}"
                            width="180"
                            class="img-thumbnail">

                    @else

                        <img
                            src="https://placehold.co/180x180?text=No+Image"
                            class="img-thumbnail">

                    @endif

                </div>

                {{-- Upload Baru --}}
                <div class="form-group">

                    <label>Ganti Gambar</label>

                    <input
                        type="file"
                        name="image"
                        class="form-control">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>

                {{-- Status --}}
                <div class="form-group">

                    <label>Status</label>

                    <select name="status"
                            class="form-control">

                        <option value="1"
                            {{ $product->status ? 'selected':'' }}>
                            Aktif
                        </option>

                        <option value="0"
                            {{ !$product->status ? 'selected':'' }}>
                            Tidak Aktif
                        </option>

                    </select>

                </div>

            </div>

            <div class="card-footer">

                <button class="btn-save">
                    <i class="fas fa-save"></i>
                    Update
                </button>

                <a href="{{ route('admin.products.index') }}"
                    class="btn-back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection