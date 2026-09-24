@extends('layouts.landing')

@section('title','Checkout')

@section('content')

<style>
    .checkout-wrap { background:#f7f8fa; padding:40px 0 60px; }
    .checkout-title { font-weight:800; font-size:2.4rem; margin-bottom:4px; }
    .checkout-subtitle { color:#6b7280; margin-bottom:32px; }

    .co-card {
        background:#fff; border:1px solid #e5e7eb; border-radius:14px;
        padding:24px; margin-bottom:20px;
    }
    .co-card-title {
        font-weight:700; font-size:1.05rem; margin-bottom:18px;
        display:flex; align-items:center; gap:8px;
    }

    .co-label { font-weight:600; font-size:.85rem; color:#374151; margin-bottom:6px; display:block; }
    .co-input {
        border:1px solid #e5e7eb; border-radius:10px; padding:10px 14px;
        width:100%; font-size:.95rem;
    }
    .co-input:focus { outline:none; border-color:#111827; box-shadow:0 0 0 3px rgba(17,24,39,.06); }

    .co-pay-option {
        border:1px solid #e5e7eb; border-radius:10px; padding:14px 16px;
        display:flex; align-items:center; gap:12px; margin-bottom:10px; cursor:pointer;
        transition:border-color .15s;
    }
    .co-pay-option:hover { border-color:#9ca3af; }
    .co-pay-option input[type="radio"] { width:18px; height:18px; margin:0; }
    .co-pay-option label { margin:0; font-weight:500; cursor:pointer; }

    .order-summary-card {
        background:#f3f4f6; border-radius:14px; padding:28px; position:sticky; top:24px;
    }
    .order-summary-title { font-weight:800; font-size:1.4rem; margin-bottom:20px; }

    .co-line-item {
        display:flex; justify-content:space-between; gap:12px; padding:10px 0;
        border-bottom:1px solid #e5e7eb; font-size:.9rem;
    }
    .co-line-item:last-of-type { border-bottom:none; }
    .co-line-name { font-weight:600; color:#111827; }
    .co-line-meta { color:#6b7280; font-size:.8rem; }
    .co-line-price { font-weight:700; text-align:right; white-space:nowrap; }

    .order-summary-total { display:flex; justify-content:space-between; align-items:center;
        border-top:1px solid #d1d5db; margin-top:14px; padding-top:16px; }
    .order-summary-total span:first-child { font-weight:600; }
    .order-summary-total span:last-child { font-weight:800; font-size:1.5rem; }

    .voucher-row { display:flex; gap:10px; margin-top:18px; }
    .voucher-row input { flex:1; }

    .btn-place-order {
        display:flex; align-items:center; justify-content:center; gap:8px;
        background:#111827; color:#fff; border:none; border-radius:10px;
        padding:14px; font-weight:600; width:100%; margin-top:20px;
    }
    .btn-place-order:hover { background:#000; color:#fff; }
</style>

<div class="checkout-wrap">
    <div class="container">

        <h2 class="checkout-title">Checkout</h2>
        <p class="checkout-subtitle">Lengkapi data pengiriman dan pembayaran Anda.</p>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">

            @csrf

            <div class="row g-4">

                {{-- LEFT: FORM --}}
                <div class="col-lg-8">

                    <div class="co-card">
                        <div class="co-card-title">Data Penerima</div>

                        <div class="mb-3">
                            <label class="co-label">Nama Penerima</label>
                            <input
                                type="text"
                                name="recipient_name"
                                class="co-input"
                                value="{{ old('recipient_name', auth()->user()->name) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="co-label">No. HP</label>
                            <input
                                type="text"
                                name="phone"
                                class="co-input"
                                placeholder="08xxxxxxxxxx"
                                value="{{ old('phone') }}"
                                required>
                        </div>

                        <div>
                            <label class="co-label">Alamat Lengkap</label>
                            <textarea
                                name="address"
                                rows="4"
                                class="co-input"
                                required>{{ old('address') }}</textarea>
                        </div>
                    </div>

                 <div class="co-card">
    <div class="co-card-title">
        <i class="fas fa-credit-card"></i>
        Metode Pembayaran
    </div>

    <div class="co-pay-option">
        <input
            type="radio"
            name="payment_method"
            value="midtrans"
            id="midtrans"
            checked>

        <label for="midtrans">
            Pembayaran melalui Midtrans
        </label>
    </div>

    <small class="text-muted">
        <i class="fas fa-info-circle me-1"></i>
        Anda akan diarahkan ke halaman pembayaran Midtrans setelah
        pesanan dibuat.
    </small>
</div>

                    <div class="co-card mb-0">
                        <div class="co-card-title">Voucher</div>

                        <label class="co-label">Kode Voucher</label>
                        <input
                            type="text"
                            name="voucher_code"
                            class="co-input"
                            value="{{ old('voucher_code') }}"
                            placeholder="Masukkan kode voucher">
                    </div>

                </div>

                {{-- RIGHT: ORDER SUMMARY --}}
                <div class="col-lg-4">

                    <div class="order-summary-card">

                        <div class="order-summary-title">Ringkasan Pesanan</div>

                        @php $total = 0; @endphp

                        @foreach($cart->items as $item)
                            @php
                                $subtotal = $item->variant->price * $item->quantity;
                                $total += $subtotal;
                            @endphp

                            <div class="co-line-item">
                                <div>
                                    <div class="co-line-name">{{ $item->variant->product->name }}</div>
                                    <div class="co-line-meta">
                                        {{ $item->variant->size }} &middot; {{ $item->quantity }}x
                                    </div>
                                </div>
                                <div class="co-line-price">
                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach

                        <div class="order-summary-total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <button type="submit" class="btn-place-order">
                            Buat Pesanan
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection