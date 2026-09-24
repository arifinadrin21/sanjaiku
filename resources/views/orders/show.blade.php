@extends('layouts.landing')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Detail Pesanan</h2>

    {{-- ===================== INFORMASI PESANAN ===================== --}}
    <div class="card mb-4">
        <div class="card-body">

            <p><strong>Invoice :</strong> {{ $order->invoice_number }}</p>
            <p><strong>Penerima :</strong> {{ $order->recipient_name }}</p>
            <p><strong>No HP :</strong> {{ $order->phone }}</p>
            <p><strong>Alamat :</strong> {{ $order->address }}</p>

            <hr>

            {{-- Metode Pembayaran --}}
            <p>
                <strong>Metode Pembayaran :</strong>
                @if($order->payment_method == 'cod')
                    <span class="badge bg-primary">COD</span>
                @else
                    <span class="badge bg-success">QRIS</span>
                @endif
            </p>

            {{-- Status Pembayaran --}}
            <p>
                <strong>Status Pembayaran :</strong>
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
                        <span class="badge bg-secondary">{{ ucfirst($order->payment_status) }}</span>
                @endswitch
            </p>

            {{-- Bukti Pembayaran --}}
            @if($order->payment_proof)
                <hr>
                <p><strong>Bukti Pembayaran</strong></p>
                <img src="{{ asset('storage/payment_proofs/' . $order->payment_proof) }}"
                     class="img-thumbnail mb-2" style="max-width:300px;">
                <br>
                <a href="{{ asset('storage/payment_proofs/' . $order->payment_proof) }}"
                   target="_blank" class="btn btn-info btn-sm">
                    <i class="fas fa-image"></i> Lihat Ukuran Penuh
                </a>
            @endif

            <hr>

            {{-- Informasi Pengiriman --}}
            <p><strong>Kurir :</strong> {{ $order->courier ?? '-' }}</p>

            <p>
                <strong>Nomor Resi :</strong>
                @if($order->tracking_number)
                    <span class="badge bg-success">{{ $order->tracking_number }}</span>
                @else
                    <span class="badge bg-secondary">Belum tersedia</span>
                @endif
            </p>

            {{-- Status Pesanan --}}
            <p>
                <strong>Status :</strong>
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
                    @default
                        <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                @endswitch
            </p>

            {{-- Aksi Tambahan --}}
            <div class="d-flex flex-wrap gap-2 mt-3">
                @if($order->tracking_number)
                    <a href="https://cekresi.com/?v=resi&q={{ $order->tracking_number }}"
                       target="_blank" class="btn btn-success btn-sm">
                        <i class="fas fa-truck"></i> Lacak Pengiriman
                    </a>
                @endif

                {{-- ===== ALUR TESTIMONI ===== --}}
                @if($order->status == 'selesai')
                    @if($order->testimonial)
                        {{-- Sudah pernah kirim testimoni --}}
                        @if($order->testimonial->is_approved)
                            <span class="badge bg-success align-self-center">
                                <i class="fas fa-check-circle"></i> Testimoni sudah tayang
                            </span>
                        @else
                            <span class="badge bg-secondary align-self-center">
                                <i class="fas fa-clock"></i> Testimoni menunggu persetujuan admin
                            </span>
                        @endif
                    @else
                       
                    @endif
                @endif
            </div>

        </div>
    </div>

    {{-- ===================== DAFTAR ITEM ===================== --}}
    <table class="table table-bordered">
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
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end">
        <h3>Total : Rp {{ number_format($order->total, 0, ',', '.') }}</h3>
    </div>

    @if($order->status == 'selesai' && !$order->testimonial)
        <a href="{{ route('testimonials.create', $order->id) }}" class="btn btn-warning">
            ⭐ Berikan Testimoni
        </a>
    @endif

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>

{{-- ===================== MODAL TESTIMONI ===================== --}}


@endsection