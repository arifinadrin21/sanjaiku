@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<style>
    .kategori-form-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
    }

    .kategori-form-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .kategori-form-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        margin: 0;
    }

    .kategori-form-wrapper .card-body {
        padding: 24px 20px;
    }

    .kategori-form-wrapper label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .kategori-form-wrapper .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .kategori-form-wrapper .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .kategori-form-wrapper .form-control.is-invalid {
        border-color: #ef4444;
    }

    .kategori-form-wrapper .invalid-feedback {
        color: #ef4444;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .kategori-form-wrapper .form-group {
        margin-bottom: 18px;
    }

    .kategori-form-wrapper .card-footer {
        background: #fafbfc;
        border-top: 1px solid #f1f1f4;
        border-radius: 0 0 14px 14px;
        padding: 16px 20px;
        display: flex;
        gap: 10px;
    }

    .kategori-form-wrapper .btn-save {
        background: #2563eb;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: background .15s ease;
    }
    .kategori-form-wrapper .btn-save:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .kategori-form-wrapper .btn-back {
        background: #f1f5f9;
        border: none;
        color: #475569;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        transition: background .15s ease;
    }
    .kategori-form-wrapper .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="kategori-form-wrapper">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Tambah Kategori</h3>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST">

            @csrf

            <div class="card-body">

                <div class="form-group">

                    <label>Nama Kategori</label>

                    <input type="text"
                           name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           placeholder="Masukkan nama kategori">

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Deskripsi</label>

                    <textarea
                        name="description"
                        rows="4"
                        class="form-control"
                        placeholder="Masukkan deskripsi kategori">{{ old('description') }}</textarea>

                </div>

                <div class="form-group">

                    <label>Status</label>

                    <select name="status" class="form-control">

                        <option value="1">Aktif</option>

                        <option value="0">Tidak Aktif</option>

                    </select>

                </div>

            </div>

            <div class="card-footer">

                <button class="btn-save">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>

                <a href="{{ route('admin.categories.index') }}"
                    class="btn-back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection