@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Edit Kategori</h3>
    </div>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">

                <label>Nama Kategori</label>

                <input type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $category->name) }}">

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
                    class="form-control">{{ old('description', $category->description) }}</textarea>

            </div>

            <div class="form-group">

                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="1" {{ $category->status ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0" {{ !$category->status ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>

                </select>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Update

            </button>

            <a href="{{ route('admin.categories.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection