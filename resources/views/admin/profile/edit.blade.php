@extends('layouts.app')

@section('title','Profil Admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Profil Admin
        </h3>
    </div>

    <div class="card-body">

        {{-- KARTU INFORMASI PENGGUNA --}}
        <div class="card mb-4 border-0 shadow">

            <div class="card-body text-center">

                {{-- Ganti ikon dengan foto jika ada --}}
                @if($user->photo)
                    <img
                        src="{{ asset('storage/'.$user->photo) }}"
                        class="rounded-circle mb-3"
                        width="150"
                        height="150"
                        style="object-fit:cover;">
                @else
                    <i class="fas fa-user-circle fa-6x text-warning mb-3"></i>
                @endif

                <h3>{{ $user->name }}</h3>

                <p class="text-muted">
                    {{ $user->email }}
                </p>

                <span class="badge bg-success">
                    {{ ucfirst($user->role) }}
                </span>

            </div>

        </div>

        {{-- Alert sukses --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form edit profil --}}
        <form action="{{ route('profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Foto Profil</label>
                <input
                    type="file"
                    name="photo"
                    class="form-control">
                @if($user->photo)
                    <small class="text-muted">
                        Foto saat ini:
                        <img src="{{ asset('storage/'.$user->photo) }}" width="50" class="rounded">
                    </small>
                @endif
            </div>

            <div class="form-group mb-3">
                <label>Nama</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name',$user->name) }}">
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email',$user->email) }}">
            </div>

            <hr>

            <h5>Ubah Password</h5>

            {{-- Field password lama (sesuai controller) --}}
            <div class="form-group mb-3">
                <label>Password Lama</label>
                <input
                    type="password"
                    name="old_password"
                    class="form-control"
                    placeholder="Kosongkan jika tidak mengganti password">
            </div>

            <div class="form-group mb-3">
                <label>Password Baru</label>
                <input
                    type="password"
                    name="password"
                    class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control">
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

@endsection