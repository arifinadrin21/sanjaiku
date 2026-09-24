@extends('layouts.landing')

@section('title', 'Pembayaran QRIS')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Pembayaran QRIS</h4>
                </div>
                <div class="card-body text-center">
                    <h5>Invoice</h5>
                    <p>{{ $order->invoice_number }}</p>
                    <h4 class="text-success">Rp {{ number_format($order->total, 0, ',', '.') }}</h4>
                    <hr>

                    <!-- QRIS Image -->
                    <img src="{{ asset('assets/AdminLTE/dist/img/Qris-sanjaiku.jpeg') }}"
                         class="img-fluid"
                         style="max-width:300px;"
                         alt="QRIS Code">

                    <p class="mt-3">
                        Scan QR Code menggunakan<br>
                        <strong>DANA • OVO • GoPay • ShopeePay • Mobile Banking</strong>
                    </p>

                    <hr>

                    <form action="{{ route('payment.upload-proof', $order->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file"
                                   name="payment_proof"
                                   class="form-control"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim Bukti Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection