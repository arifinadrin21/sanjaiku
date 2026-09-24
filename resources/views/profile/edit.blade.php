@extends('layouts.landing')

@section('title','Profil Saya')

@section('content')

<style>
    :root {
        --sj-navy: #1c2333;
        --sj-navy-soft: #2a3346;
        --sj-bg: #f4f5f7;
        --sj-border: #e7e9ee;
        --sj-text-muted: #6b7280;
        --sj-blue: #2f6fed;
        --sj-blue-hover: #2559c9;
    }

    .sj-profile-wrap { background: var(--sj-bg); }

    /* Sidebar */
    .sj-user-card {
        background: #fff;
        border: 1px solid var(--sj-border);
        border-radius: 14px;
        padding: 1.75rem 1.25rem;
        text-align: center;
    }
    .sj-user-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--sj-border);
        margin: 0 auto 0.9rem;
        display: block;
    }
    .sj-user-avatar-fallback {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--sj-bg);
        color: #b8bcc6;
        font-size: 2.6rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.9rem;
    }
    .sj-user-name { font-weight: 700; font-size: 1.15rem; margin-bottom: 0.15rem; }
    .sj-user-email { color: var(--sj-text-muted); font-size: 0.9rem; margin-bottom: 0.6rem; }
    .sj-role-badge {
        display: inline-block;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
        background: #e5f6ec;
        color: #1e9e5a;
    }

    .sj-sidenav {
        background: #fff;
        border: 1px solid var(--sj-border);
        border-radius: 14px;
        padding: 0.6rem;
        margin-top: 1rem;
    }
    .sj-sidenav .nav-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 0.9rem;
        border-radius: 10px;
        color: #333;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }
    .sj-sidenav .nav-link:hover { background: var(--sj-bg); }
    .sj-sidenav .nav-link.active { background: var(--sj-navy); color: #fff; }

    /* Main card */
    .sj-profile-card {
        background: #fff;
        border: 1px solid var(--sj-border);
        border-radius: 14px;
        overflow: hidden;
    }
    .sj-profile-header {
        background: var(--sj-navy);
        color: #fff;
        padding: 1.6rem 1.9rem;
    }
    .sj-profile-header h4 { font-weight: 800; margin-bottom: 0.25rem; }
    .sj-profile-header p { color: #c7cbd6; margin-bottom: 0; font-size: 0.92rem; }
    .sj-profile-body { padding: 1.9rem; }

    .sj-form-label { font-weight: 600; font-size: 0.9rem; margin-bottom: 0.4rem; display: block; }
    .sj-form-control {
        border: 1px solid var(--sj-border);
        background: #fafbfc;
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        width: 100%;
    }
    .sj-form-control:focus {
        outline: none;
        border-color: var(--sj-blue);
        background: #fff;
        box-shadow: 0 0 0 3px rgba(47,111,237,0.12);
    }

    /* Photo uploader */
    .sj-photo-preview {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 2px dashed #cfd3db;
        background: var(--sj-bg);
        color: #a6abb6;
        font-size: 2.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 0 auto 0.9rem;
    }
    .sj-photo-preview img { width: 100%; height: 100%; object-fit: cover; }
    .sj-photo-btn {
        display: inline-block;
        border: 1px solid var(--sj-border);
        background: #fff;
        border-radius: 8px;
        padding: 0.5rem 1.1rem;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
    }
    .sj-photo-btn:hover { background: var(--sj-bg); }
    .sj-photo-hint { font-size: 0.78rem; color: var(--sj-text-muted); margin-top: 0.6rem; }

    .sj-divider { border-top: 1px solid var(--sj-border); margin: 1.9rem 0; }
    .sj-section-title { font-weight: 800; font-size: 1.15rem; margin-bottom: 1.1rem; }

    .sj-btn-save {
        background: var(--sj-blue);
        border: none;
        color: #fff;
        font-weight: 700;
        padding: 0.7rem 1.4rem;
        border-radius: 10px;
    }
    .sj-btn-save:hover { background: var(--sj-blue-hover); color: #fff; }
</style>

<div class="container py-5 sj-profile-wrap">
    <div class="row g-4">

        {{-- ============ SIDEBAR ============ --}}
        <div class="col-lg-3">
            <div class="sj-user-card">
                @if($user->photo)
                    <img src="{{ asset('storage/'.$user->photo) }}" class="sj-user-avatar" alt="{{ $user->name }}">
                @else
                    <div class="sj-user-avatar-fallback">
                        <i class="fas fa-user-circle"></i>
                    </div>
                @endif
                <div class="sj-user-name">{{ $user->name }}</div>
                <div class="sj-user-email">{{ $user->email }}</div>
                <span class="sj-role-badge">{{ ucfirst($user->role) }}</span>
            </div>

            <div class="sj-sidenav">
                <a href="#" class="nav-link active">
                    Account Details <i class="fas fa-chevron-right"></i>
                </a>
                <a href="{{ Route::has('orders.index') ? route('orders.index') : '#' }}" class="nav-link">
                    Order History
                </a>
            </div>
        </div>

        {{-- ============ MAIN CONTENT ============ --}}
        <div class="col-lg-9">
            <div class="sj-profile-card">

                <div class="sj-profile-header">
                    <h4>Profil Saya</h4>
                    <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>
                </div>

                <div class="sj-profile-body">

                    {{-- ALERT SUKSES --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ALERT ERROR VALIDASI --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM (sama persis dengan sebelumnya — hanya tampilan yang diubah) --}}
                    <form action="{{ route('profile.update') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-5 text-center mb-4">
                                <label class="sj-form-label text-start">Foto Profil</label>

                                <div class="sj-photo-preview" id="sjPhotoPreview">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/'.$user->photo) }}" alt="{{ $user->name }}">
                                    @else
                                        <i class="fas fa-image"></i>
                                    @endif
                                </div>

                                <label class="sj-photo-btn" for="sjPhotoInput">
                                    <i class="fas fa-upload me-1"></i> Pilih Gambar
                                </label>
                                <input
                                    type="file"
                                    name="photo"
                                    id="sjPhotoInput"
                                    class="d-none"
                                    accept=".jpg,.jpeg,.png">

                                <div class="sj-photo-hint">
                                    Ukuran gambar: maks. 1 MB. Format gambar: .JPG, .JPEG, .PNG
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="sj-form-label">Nama</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="sj-form-control"
                                        value="{{ old('name',$user->name) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="sj-form-label">Email</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="sj-form-control"
                                        value="{{ old('email',$user->email) }}">
                                </div>
                            </div>
                        </div>

                        <div class="sj-divider"></div>

                        <h5 class="sj-section-title">Ubah Password</h5>

                        <div class="mb-3">
                            <label class="sj-form-label">Password Lama</label>
                            <input
                                type="password"
                                name="old_password"
                                class="sj-form-control"
                                placeholder="Kosongkan jika tidak mengganti password">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="sj-form-label">Password Baru</label>
                                <input
                                    type="password"
                                    name="password"
                                    class="sj-form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="sj-form-label">Konfirmasi Password</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="sj-form-control">
                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <button class="sj-btn-save">
                                <i class="fas fa-lock me-1"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div> {{-- end sj-profile-body --}}

            </div> {{-- end sj-profile-card --}}
        </div>

    </div>
</div>

{{-- Preview foto sebelum diunggah — hanya kosmetik, tidak mengubah proses upload --}}
<script>
    document.getElementById('sjPhotoInput')?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;
        const preview = document.getElementById('sjPhotoPreview');
        const reader = new FileReader();
        reader.onload = function (ev) {
            preview.innerHTML = '<img src="' + ev.target.result + '" alt="preview">';
        };
        reader.readAsDataURL(file);
    });
</script>

@endsection