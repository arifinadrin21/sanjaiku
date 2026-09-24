@extends('layouts.landing')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="landing-wrapper">
    <section>
        <div class="container py-4">

            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Riwayat Pesanan</h2>
            </div>

            {{-- Jika ada pesanan --}}
            @if($orders->count())

                <div class="card shadow-sm">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">

                                <thead class="table-dark">
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Tanggal</th>
                                        <th>Total</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Resi</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                @foreach($orders as $order)

                                    <tr>

                                        {{-- Invoice --}}
                                        <td>
                                            <strong>
                                                {{ $order->invoice_number }}
                                            </strong>
                                        </td>

                                        {{-- Tanggal --}}
                                        <td>
                                            {{ $order->created_at->format('d-m-Y') }}
                                        </td>

                                        {{-- Total --}}
                                        <td>
                                            <strong>
                                                Rp {{ number_format($order->total, 0, ',', '.') }}
                                            </strong>
                                        </td>

                                        {{-- Pembayaran --}}
                                        <td>
                                            @switch($order->payment_status)

                                                @case('belum_bayar')
                                                    <span class="badge bg-danger">
                                                        Belum Bayar
                                                    </span>
                                                @break

                                                @case('menunggu_verifikasi')
                                                    <span class="badge bg-warning text-dark">
                                                        Menunggu Verifikasi
                                                    </span>
                                                @break

                                                @case('lunas')
                                                    <span class="badge bg-success">
                                                        Lunas
                                                    </span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst($order->payment_status) }}
                                                    </span>

                                            @endswitch
                                        </td>

                                        {{-- Status Pesanan --}}
                                        <td>
                                            @switch($order->status)

                                                @case('pending')
                                                    <span class="badge bg-warning text-dark">
                                                        Pending
                                                    </span>
                                                @break

                                                @case('diproses')
                                                    <span class="badge bg-info text-dark">
                                                        Diproses
                                                    </span>
                                                @break

                                                @case('dikemas')
                                                    <span class="badge bg-primary">
                                                        Dikemas
                                                    </span>
                                                @break

                                                @case('dikirim')
                                                    <span class="badge bg-success">
                                                        Dikirim
                                                    </span>
                                                @break

                                                @case('selesai')
                                                    <span class="badge bg-success">
                                                        Selesai
                                                    </span>
                                                @break

                                                @case('dibatalkan')
                                                    <span class="badge bg-danger">
                                                        Dibatalkan
                                                    </span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst($order->status) }}
                                                    </span>

                                            @endswitch
                                        </td>

                                        {{-- Resi --}}
                                        <td>
                                            @if($order->resi)

                                                <span class="badge bg-success">
                                                    {{ $order->resi }}
                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    -
                                                </span>

                                            @endif
                                        </td>

                                        {{-- Aksi --}}
                                        <td>
                                            <a
                                                href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-primary btn-sm"
                                            >
                                                <i class="fas fa-eye"></i>
                                                Detail
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            @else

                <div class="alert alert-info">
                    <i class="fas fa-shopping-bag"></i>
                    Anda belum memiliki pesanan.
                </div>

            @endif

        </div>
    </section>
</div>
@endsection