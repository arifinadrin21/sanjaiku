@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<style>
    .detail-pesanan-wrapper .card {
        border: 1px solid #eef1f6;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        margin-bottom: 1.5rem;
    }

    .detail-pesanan-wrapper .card-header {
        background: #fff;
        border-bottom: 1px solid #f1f1f4;
        border-radius: 14px 14px 0 0;
        padding: 18px 20px;
    }

    .detail-pesanan-wrapper .card-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: #1e293b;
        margin: 0;
    }

    .detail-pesanan-wrapper h5 {
        font-weight: 800;
        color: #1e293b;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }

    .detail-pesanan-wrapper .alert-success {
        background: #eafaf0;
        border: 1px solid #dcf3e4;
        color: #16a34a;
        border-radius: 10px;
        font-weight: 600;
    }

    .detail-pesanan-wrapper .alert-danger {
        background: #fdeef0;
        border: 1px solid #fbd7dd;
        color: #ef4444;
        border-radius: 10px;
        font-weight: 600;
    }

    /* Tabel info (key-value) */
    .detail-pesanan-wrapper .table-info th {
        width: 220px;
        background: #fafbfc;
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        border-color: #eef1f6;
    }
    .detail-pesanan-wrapper .table-info td {
        color: #1e293b;
        font-weight: 500;
        border-color: #eef1f6;
    }
    .detail-pesanan-wrapper .table-info,
    .detail-pesanan-wrapper .table-info th,
    .detail-pesanan-wrapper .table-info td {
        border-color: #eef1f6;
    }

    /* Tabel produk */
    .detail-pesanan-wrapper .table-produk thead th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.72rem;
        letter-spacing: 0.4px;
        color: #94a3b8;
        background: #fafbfc;
        border-top: none;
        border-bottom: 1px solid #eef1f6;
    }
    .detail-pesanan-wrapper .table-produk td {
        vertical-align: middle;
        font-weight: 500;
        color: #334155;
        border-color: #eef1f6;
    }

    .detail-pesanan-wrapper .badge {
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 0.75rem;
    }
    .detail-pesanan-wrapper .badge.bg-primary  { background: #eaf1ff !important; color: #2563eb !important; }
    .detail-pesanan-wrapper .badge.bg-success  { background: #eafaf0 !important; color: #16a34a !important; }
    .detail-pesanan-wrapper .badge.bg-danger   { background: #fdeef0 !important; color: #ef4444 !important; }
    .detail-pesanan-wrapper .badge.bg-warning  { background: #fef7e6 !important; color: #d97706 !important; }
    .detail-pesanan-wrapper .badge.bg-info     { background: #eaf6fd !important; color: #0891b2 !important; }
    .detail-pesanan-wrapper .badge.bg-secondary{ background: #f1f5f9 !important; color: #64748b !important; }

    .detail-pesanan-wrapper .img-thumbnail {
        border: 1px solid #eef1f6;
        border-radius: 10px;
        padding: 4px;
    }

    .detail-pesanan-wrapper label {
        font-weight: 700;
        font-size: 0.85rem;
        color: #334155;
        margin-bottom: 6px;
    }

    .detail-pesanan-wrapper .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.9rem;
        color: #1e293b;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .detail-pesanan-wrapper .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .detail-pesanan-wrapper .btn-verifikasi,
    .detail-pesanan-wrapper .btn-simpan {
        background: #16a34a;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .15s ease;
    }
    .detail-pesanan-wrapper .btn-verifikasi:hover,
    .detail-pesanan-wrapper .btn-simpan:hover {
        background: #15803d;
        color: #fff;
    }

    .detail-pesanan-wrapper .btn-lihat-gambar {
        background: #eaf6fd;
        border: none;
        color: #0891b2;
        font-weight: 700;
        font-size: 0.8rem;
        padding: 7px 14px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
        transition: opacity .15s ease;
    }
    .detail-pesanan-wrapper .btn-lihat-gambar:hover {
        opacity: 0.85;
        color: #0891b2;
    }

    .detail-pesanan-wrapper .btn-back {
        background: #f1f5f9;
        border: none;
        color: #475569;
        font-weight: 700;
        font-size: 0.85rem;
        padding: 9px 18px;
        border-radius: 10px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .15s ease;
    }
    .detail-pesanan-wrapper .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .detail-pesanan-wrapper hr {
        border-top: 1px solid #eef1f6;
    }
</style>

<div class="detail-pesanan-wrapper">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Detail Pesanan
            </h3>
        </div>

        <div class="card-body">

            {{-- Session Messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-info">

                <tr>
                    <th width="250">Invoice</th>
                    <td>{{ $order->invoice_number }}</td>
                </tr>

                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $order->user->name }}</td>
                </tr>

                <tr>
                    <th>Penerima</th>
                    <td>{{ $order->recipient_name }}</td>
                </tr>

                <tr>
                    <th>No HP</th>
                    <td>{{ $order->phone }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $order->address }}</td>
                </tr>

                <tr>
                    <th>Total</th>
                    <td>
                        Rp {{ number_format($order->total,0,',','.') }}
                    </td>
                </tr>

                {{-- Informasi pembayaran dengan badge --}}
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>
                        @if($order->payment_method == 'cod')
                            <span class="badge bg-primary">COD</span>
                        @else
                            <span class="badge bg-success">QRIS</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        @switch($order->payment_status)
                            @case('belum_bayar')
                                <span class="badge bg-danger">Belum Bayar</span>
                                @break
                            @case('menunggu_verifikasi')
                                <span class="badge bg-warning">Menunggu Verifikasi</span>
                                @break
                            @case('lunas')
                                <span class="badge bg-success">Lunas</span>
                                @break
                            @default
                                {{ ucfirst($order->payment_status) }}
                        @endswitch
                    </td>
                </tr>

                <tr>
                    <th>Bukti Pembayaran</th>
                    <td>
                        @if($order->payment_proof)
                           <img
                                src="{{ asset('storage/payment_proofs/' . $order->payment_proof) }}"
                                class="img-thumbnail"
                                style="max-width:300px;">

                            <br>

                            <a
                                href="{{ asset('storage/payment_proofs/'.$order->payment_proof) }}"
                                target="_blank"
                                class="btn-lihat-gambar mt-2">
                                <i class="fas fa-image"></i>
                                Lihat Gambar
                            </a>
                        @else
                            <span class="badge bg-secondary">Belum Upload Bukti</span>
                        @endif
                    </td>
                </tr>

                {{-- Status Pesanan dengan badge --}}
                <tr>
                    <th>Status Pesanan</th>
                    <td>
                        @switch($order->status)
                            @case('pending')
                                <span class="badge bg-warning">Pending</span>
                                @break
                            @case('diproses')
                                <span class="badge bg-info">Diproses</span>
                                @break
                            @case('dikemas')
                                <span class="badge bg-primary">Dikemas</span>
                                @break
                            @case('dikirim')
                                <span class="badge bg-success">Dikirim</span>
                                @break
                            @case('selesai')
                                <span class="badge bg-success">Selesai</span>
                                @break
                            @case('dibatalkan')
                                <span class="badge bg-danger">Dibatalkan</span>
                                @break
                        @endswitch
                    </td>
                </tr>

            </table>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Produk</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-produk mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->size }}</td>
                        <td>Rp {{ number_format($item->price,0,',','.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Tombol Verifikasi QRIS --}}
    @if($order->payment_method == 'qris' && $order->payment_status == 'menunggu_verifikasi')
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.orders.verify-payment',$order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button
                        type="submit"
                        class="btn-verifikasi"
                        onclick="return confirm('Verifikasi pembayaran ini?')">
                        <i class="fas fa-check-circle"></i>
                        Verifikasi Pembayaran
                    </button>
                </form>
            </div>
        </div>
    @endif

    {{-- ========== BAGIAN YANG DITAMBAHKAN ========== --}}
    {{-- Form untuk mengupdate Kurir & Nomor Resi --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Update Pengiriman &amp; Status</h5>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mt-3">
                    <label>Kurir</label>
                    <select name="courier" class="form-control">
                        <option value="">-- Pilih Kurir --</option>
                        <option value="JNE" {{ $order->courier == 'JNE' ? 'selected' : '' }}>JNE</option>
                        <option value="J&T" {{ $order->courier == 'J&T' ? 'selected' : '' }}>J&T</option>
                        <option value="SiCepat" {{ $order->courier == 'SiCepat' ? 'selected' : '' }}>SiCepat</option>
                        <option value="AnterAja" {{ $order->courier == 'AnterAja' ? 'selected' : '' }}>AnterAja</option>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label>Nomor Resi</label>
                    <input
                        type="text"
                        name="tracking_number"
                        class="form-control"
                        value="{{ old('tracking_number', $order->tracking_number) }}"
                        placeholder="Contoh: JNE123456789">
                </div>

                {{-- Dropdown Status Pesanan --}}
                <div class="form-group mt-3">
                    <label>Status Pesanan</label>
                    <select name="status" class="form-control">

                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="dikemas" {{ $order->status == 'dikemas' ? 'selected' : '' }}>
                            Dikemas
                        </option>

                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>
                            Dikirim
                        </option>

                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>

                    </select>
                </div>

                {{-- Tombol yang diminta --}}
                <button type="submit" class="btn-simpan mt-3">
                    Simpan Status
                </button>
            </form>

        </div>
    </div>
    {{-- Akhir dari bagian tambahan --}}

    <a href="{{ route('admin.orders.index') }}" class="btn-back">
        Kembali
    </a>

</div>

@endsection