@extends('layouts.landing')

@section('title', $product->name)

@push('styles')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500&display=swap">

<style>
    /* =====================================================
       SANJAIKU — PRODUCT DETAIL
       ===================================================== */

    .sj-detail {
        --sj-ink: #191c1e;
        --sj-navy: #131b2e;
        --sj-blue: #0051d5;
        --sj-blue-deep: #003ea8;
        --sj-green: #009844;
        --sj-cream: #f7f9fb;
        --sj-surface: #eceef0;
        --sj-surface-low: #f2f4f6;
        --sj-line: #e0e3e5;
        --sj-muted: #45464d;

        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: var(--sj-cream);
        color: var(--sj-ink);
        padding: 3.5rem 0 5rem;
    }

    .sj-detail .eyebrow {
        display: inline-block;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.72rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--sj-blue);
        margin-bottom: 0.75rem;
    }

    .sj-detail .product-title {
        font-weight: 800;
        letter-spacing: -0.02em;
        font-size: clamp(1.75rem, 3vw, 2.35rem);
        line-height: 1.15;
        margin-bottom: 0.9rem;
        color: var(--sj-ink);
    }

    .sj-detail .product-desc {
        font-size: 1rem;
        line-height: 1.65;
        color: var(--sj-muted) !important;
        margin-bottom: 0;
    }

    .sj-detail hr {
        border-color: var(--sj-line);
        opacity: 1;
        margin: 1.75rem 0;
    }

    .sj-detail .product-media {
        position: relative;
    }

    .sj-detail .product-media img {
        border-radius: 1.5rem;
        width: 100%;
        box-shadow: 0 24px 55px -30px rgba(19, 27, 46, 0.45);
    }

    .sj-detail .authentic-badge {
        position: absolute;
        top: 1.25rem;
        left: 1.25rem;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 22px -10px rgba(19, 27, 46, 0.4);
        color: var(--sj-blue);
        font-size: 1rem;
    }

    .sj-detail h5 {
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: -0.01em;
        margin-bottom: 1rem;
        color: var(--sj-ink);
    }

    /* ============ ORDER FORM ============ */
    .sj-detail .order-form {
        background: #fff;
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        padding: 1.75rem;
        margin-top: 0.5rem;
    }

    .sj-detail .order-form .form-check {
        border: 1px solid var(--sj-line);
        border-radius: 0.85rem;
        padding: 0.85rem 1rem;
        margin-bottom: 0.65rem;
        transition: border-color .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .sj-detail .order-form .form-check:hover {
        border-color: var(--sj-blue);
    }

    .sj-detail .order-form .form-check:has(.form-check-input:checked) {
        border-color: var(--sj-blue);
        background: rgba(0, 81, 213, 0.05);
        box-shadow: 0 0 0 3px rgba(0, 81, 213, 0.1);
    }

    .sj-detail .order-form .form-check-input {
        margin-top: 0.2rem;
        width: 1.15rem;
        height: 1.15rem;
        border: 2px solid var(--sj-line);
        flex: none;
    }

    .sj-detail .order-form .form-check-input:checked {
        background-color: var(--sj-blue);
        border-color: var(--sj-blue);
    }

    .sj-detail .order-form .form-check-input:focus {
        border-color: var(--sj-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 81, 213, 0.15);
    }

    .sj-detail .order-form .form-check-label {
        font-size: 0.9rem;
        color: var(--sj-ink);
    }

    .sj-detail .form-control {
        border: 1px solid var(--sj-line);
        border-radius: 0.8rem;
        padding: 0.65rem 1rem;
        font-size: 0.95rem;
        max-width: 160px;
    }

    .sj-detail .form-control:focus {
        border-color: var(--sj-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 81, 213, 0.15);
    }

    .sj-detail .btn-warning {
        background: var(--sj-navy);
        border: none;
        color: #fff;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 0.9rem;
        padding: 0.85rem 1.6rem;
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        transition: background .18s ease, transform .18s ease, box-shadow .18s ease;
        box-shadow: 0 10px 24px -12px rgba(19, 27, 46, 0.6);
    }

    .sj-detail .btn-warning:hover {
        background: var(--sj-blue);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px -12px rgba(0, 81, 213, 0.55);
    }

    @media (max-width: 991.98px) {
        .sj-detail .product-media {
            margin-bottom: 2.5rem;
        }
    }
</style>

@endpush

@section('content')

<div class="sj-detail">

    <div class="container">

        <div class="row g-5">

            <div class="col-lg-6">

                <div class="product-media">

                    {{-- GAMBAR DARI storage/products/ --}}
                    <img src="{{ asset('storage/products/' . $product->image) }}"
                         class="img-fluid rounded shadow"
                         alt="{{ $product->name }}">

                    <div class="authentic-badge" title="Asli Sanjai">
                        <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>

            <div class="col-lg-6">

                <span class="eyebrow">Detail Produk</span>

                <h2 class="fw-bold product-title">

                    {{ $product->name }}

                </h2>

                <p class="text-muted product-desc">

                    {{ $product->description }}

                </p>

                <hr>

                <form action="{{ route('cart.store') }}" method="POST" class="order-form">

                    @csrf

                    {{-- =============================================
                         Pilihan Ukuran — TETAP ADA
                         ============================================= --}}
                    <h5>Pilih Ukuran</h5>

                    @foreach($product->variants as $variant)
    <div class="form-check">

        <input
            type="radio"
            class="form-check-input variant-radio"
            name="product_variant_id"
            value="{{ $variant->id }}"
            id="variant_{{ $variant->id }}"
            data-stock="{{ $variant->stock }}"
            required>

        <label class="form-check-label" for="variant_{{ $variant->id }}">
            {{ $variant->size }}
            –
            Rp {{ number_format($variant->price,0,',','.') }}
            –
            Stok {{ $variant->stock }}
        </label>

    </div>
@endforeach

                    <div class="mt-3">

    <label for="quantity">Jumlah</label>

    <input
        type="number"
        name="quantity"
        id="quantity"
        value="1"
        min="1"
        class="form-control"
        disabled>

    <small id="stock-info" class="text-muted">
        Pilih ukuran terlebih dahulu.
    </small>

</div>

                    <button class="btn btn-warning mt-3">

                        <i class="fas fa-shopping-cart"></i>

                        Tambah ke Keranjang

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const variants = document.querySelectorAll('.variant-radio');
    const quantity = document.getElementById('quantity');
    const stockInfo = document.getElementById('stock-info');

    variants.forEach(function (variant) {

        variant.addEventListener('change', function () {

            const stock = parseInt(this.dataset.stock);

            quantity.disabled = false;
            quantity.max = stock;

            // Reset quantity menjadi 1
            quantity.value = stock > 0 ? 1 : 0;

            if (stock > 0) {
                stockInfo.textContent = 'Stok tersedia: ' + stock;
                stockInfo.classList.remove('text-danger');
                stockInfo.classList.add('text-muted');
            } else {
                quantity.disabled = true;

                stockInfo.textContent = 'Stok habis.';
                stockInfo.classList.remove('text-muted');
                stockInfo.classList.add('text-danger');
            }
        });
    });

    // Jangan izinkan quantity melebihi stok
    quantity.addEventListener('input', function () {

        const max = parseInt(this.max);
        const value = parseInt(this.value);

        if (value > max) {
            this.value = max;
        }

        if (value < 1 || isNaN(value)) {
            this.value = 1;
        }
    });

});
</script>
@endsection