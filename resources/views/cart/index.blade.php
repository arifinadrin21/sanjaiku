@extends('layouts.landing')

@section('title', 'Keranjang')

@section('content')

<style>
    .cart-wrap { background:#f7f8fa; padding:40px 0 60px; }
    .cart-title { font-weight:800; font-size:2.4rem; margin-bottom:4px; }
    .cart-subtitle { color:#6b7280; margin-bottom:32px; }

    .cart-item-card {
        background:#fff; border:1px solid #e5e7eb; border-radius:14px;
        padding:20px; margin-bottom:16px; display:flex; align-items:center; gap:20px;
    }
    .cart-item-thumb {
        width:90px; height:90px; border-radius:10px; object-fit:cover; background:#f0f0f0; flex-shrink:0;
    }
    .cart-item-info { flex:1; min-width:0; }
    .cart-item-name { font-weight:700; font-size:1.15rem; margin-bottom:6px; }
    .cart-item-badge {
        display:inline-block; font-size:.72rem; font-weight:600; padding:3px 10px;
        border-radius:20px; background:#eef2ff; color:#4338ca; margin-bottom:8px;
    }
    .cart-item-price { color:#374151; font-weight:500; }
    .cart-item-qty {
        display:flex; align-items:center; justify-content:center; gap:14px;
        border:1px solid #e5e7eb; border-radius:8px; padding:6px 14px; font-weight:600; min-width:90px;
    }
    .cart-item-subtotal { font-weight:700; font-size:1.05rem; min-width:110px; text-align:right; }
    .cart-item-remove {
        background:none; border:none; color:#9ca3af; padding:6px;
    }
    .cart-item-remove:hover { color:#dc2626; }

    .order-summary-card {
        background:#f3f4f6; border-radius:14px; padding:28px; position:sticky; top:24px;
    }
    .order-summary-title { font-weight:800; font-size:1.4rem; margin-bottom:20px; }
    .order-summary-row { display:flex; justify-content:space-between; padding:8px 0; color:#4b5563; }
    .order-summary-total { display:flex; justify-content:space-between; align-items:center;
        border-top:1px solid #d1d5db; margin-top:12px; padding-top:16px; }
    .order-summary-total span:first-child { font-weight:600; }
    .order-summary-total span:last-child { font-weight:800; font-size:1.5rem; }

    .btn-checkout {
        display:flex; align-items:center; justify-content:center; gap:8px;
        background:#111827; color:#fff; border:none; border-radius:10px;
        padding:14px; font-weight:600; width:100%; margin-top:20px; text-decoration:none;
    }
    .btn-checkout:hover { background:#000; color:#fff; }

    .continue-shopping { color:#2563eb; text-decoration:none; font-weight:500; display:inline-flex; align-items:center; gap:6px; }

    html {
    overflow-y: scroll; /* selalu tampilkan scrollbar vertikal */
}
</style>

<div class="cart-wrap">
    <div class="container">

        <h2 class="cart-title">Keranjang Belanja</h2>
        <p class="cart-subtitle">Review pesanan belanja Anda.</p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($cart && $cart->items->count())

            @php $total = 0; @endphp

            <div class="row g-4">

                {{-- CART ITEMS --}}
                <div class="col-lg-8">

                    @foreach($cart->items as $item)
                        @php
                            $subtotal = $item->variant->price * $item->quantity;
                            $total += $subtotal;
                        @endphp

                        <div class="cart-item-card">

                            {{-- =============================================
                                 PERBAIKAN: ambil gambar dari storage/products/
                                 ============================================= --}}
                            @php
                                $imagePath = $item->variant->product->image ?? null;
                            @endphp

                            <img
                                src="{{ $imagePath ? asset('storage/products/' . $imagePath) : asset('images/placeholder.png') }}"
                                alt="{{ $item->variant->product->name }}"
                                class="cart-item-thumb">

                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $item->variant->product->name }}</div>
                                <span class="cart-item-badge">{{ $item->variant->size }}</span>
                                <div class="cart-item-price">
                                    Rp {{ number_format($item->variant->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="cart-item-qty">
                                {{ $item->quantity }}x
                            </div>

                            <div class="cart-item-subtotal">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </div>

                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cart-item-remove" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                        <path d="M10 11v6"></path>
                                        <path d="M14 11v6"></path>
                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    @endforeach

                    <a href="{{ url()->previous() }}" class="continue-shopping mt-2">
                        &larr; Lanjut Belanja
                    </a>

                </div>

                {{-- ORDER SUMMARY --}}
                <div class="col-lg-4">

                    <div class="order-summary-card">

                        <div class="order-summary-title">Ringkasan Pesanan</div>

                        <div class="order-summary-row">
                            <span>Subtotal ({{ $cart->items->sum('quantity') }} item)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="order-summary-total">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn-checkout">
                            Lanjut ke Checkout
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </a>

                    </div>

                </div>

            </div>

        @else

            <div class="alert alert-warning">
                Keranjang masih kosong.
            </div>

        @endif

    </div>
</div>

@endsection