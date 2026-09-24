@extends('layouts.landing')

@section('title', 'Pembayaran')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm border-0">
                <div class="card-body text-center p-5">

                    <i class="fas fa-credit-card fa-3x text-primary mb-3"></i>

                    <h3 class="fw-bold mb-3">
                        Pembayaran Pesanan
                    </h3>

                    <p class="text-muted mb-1">
                        Invoice:
                        <strong>{{ $order->invoice_number }}</strong>
                    </p>

                    <h4 class="fw-bold mb-4">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </h4>

                    <button
                        id="pay-button"
                        class="btn btn-primary btn-lg w-100"
                    >
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Bayar Sekarang
                    </button>

                    <a
                        href="{{ route('orders.index') }}"
                        class="btn btn-outline-secondary mt-3"
                    >
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Pesanan
                    </a>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- Midtrans Snap --}}
<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}">
</script>

<script>
    document.getElementById('pay-button').onclick = function () {

        snap.pay('{{ $order->snap_token }}', {

            onSuccess: function(result) {
    window.location.href = "{{ route('payment.midtrans.finish', $order->id) }}";
},

            onPending: function(result) {
                alert('Pembayaran masih menunggu.');
            },

            onError: function(result) {
                alert('Pembayaran gagal. Silakan coba lagi.');
            },

            onClose: function() {
                alert('Halaman pembayaran ditutup.');
            }

        });

    };
</script>

@endsection