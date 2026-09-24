@extends('layouts.kasir')

@section('title', 'Dashboard Kasir')

@section('content')

<div class="page-heading">
    <h1>Kasir</h1>
    <p>Kelola transaksi penjualan Sanjaiku dengan mudah.</p>
</div>

<div class="pos-layout">

    <!-- ================= PRODUK ================= -->
    <section class="product-area">

        <div class="product-header">
            <h3>Produk</h3>

            <div class="category-filter">
                <button type="button" class="category-btn active">Semua</button>
                <button type="button" class="category-btn">Balado</button>
                <button type="button" class="category-btn">Original</button>
            </div>
        </div>

        <div class="product-grid">
            @forelse(\App\Models\Product::where('status', 1)->with('variants')->latest()->get() as $product)
                @php
                    $variantsData = $product->variants->map(function ($variant) {
                        return [
                            'id'     => $variant->id,
                            'size'   => $variant->size,
                            'price'  => $variant->price,
                            'stock'  => $variant->stock,
                            'status' => $variant->status,
                        ];
                    })->values()->all();

                    $totalStock = $product->variants->sum('stock');
                @endphp

            <div class="product-card"
     role="button"
     tabindex="0"
     data-product-id="{{ $product->id }}"
     data-product-name="{{ $product->name }}"
     data-variants="{{ json_encode($variantsData) }}">

    <div class="product-image">
        @if($product->image)
            @if($loop->first)
                {{-- Gambar pertama = LCP, load eager dengan prioritas tinggi --}}
                <img
                    src="{{ url('storage/products/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    width="400"
                    height="400"
                    fetchpriority="high"
                    loading="eager"
                >
            @else
                {{-- Gambar lainnya = lazy load --}}
                <img
                    src="{{ url('storage/products/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    width="400"
                    height="400"
                    loading="lazy"
                >
            @endif
        @else
            <i class="fas fa-box-open"></i>
        @endif
    </div>

    <div class="product-name">
        {{ $product->name }}
    </div>

    @if($product->variants->count())
        <div class="product-stock {{ $totalStock <= 0 ? 'empty' : '' }}">
            {{ $totalStock > 0 ? 'Stok: ' . $totalStock : 'Stok habis' }}
        </div>

        <div class="product-price">
            Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
        </div>
    @else
        <div class="product-price">
            Harga belum tersedia
        </div>
    @endif
</div>
@empty
    <p>Belum ada produk.</p>
@endforelse
        </div>

    </section>


    <!-- ================= ORDER ================= -->
    <aside class="order-panel">

        <div class="order-title">
            <h3>Pesanan</h3>
            <span class="order-count">0 Item</span>
        </div>

        <div class="empty-order">
            <i class="fas fa-shopping-basket"></i>
            <p>Belum ada produk</p>
            <small>Pilih produk untuk membuat transaksi.</small>
        </div>

        <!-- Wadah item pesanan (diisi via JS) -->
        <div class="order-items"></div>

        <div class="order-summary">

            <div class="summary-row">
                <span>Subtotal</span>
                <span>Rp 0</span>
            </div>

            <div class="summary-row">
                <span>Diskon</span>
                <span>Rp 0</span>
            </div>

            <div class="summary-total">
                <span>Total</span>
                <span>Rp 0</span>
            </div>

            <button
                type="button"
                class="btn-payment"
                onclick="openPaymentModal()">

                <i class="fas fa-credit-card"></i>
                Proses Pembayaran
            </button>

        </div>
    </aside>

</div>

<!-- ================= MODAL PILIH PRODUK ================= -->
<div id="productModal" class="pos-modal">
    <div class="pos-modal-content">

        <button type="button"
                class="modal-close"
                onclick="closeProductModal()">
            <i class="fas fa-xmark"></i>
        </button>

        <div class="modal-product-icon">
            <i class="fas fa-box-open"></i>
        </div>

        <h3 id="modalProductName">Produk</h3>
        <p class="modal-subtitle">Pilih ukuran produk</p>

        <div id="variantList"></div>

        <div class="quantity-section">
            <label>Jumlah</label>

            <div class="quantity-control">
                <button type="button" onclick="changeQuantity(-1)">
                    <i class="fas fa-minus"></i>
                </button>

                <input type="number"
                       id="modalQuantity"
                       value="1"
                       min="1">

                <button type="button" onclick="changeQuantity(1)">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <small id="modalStockInfo">
                Pilih ukuran terlebih dahulu.
            </small>
        </div>

        <button type="button"
                class="modal-add-button"
                onclick="addToOrder()">
            <i class="fas fa-cart-plus"></i>
            Tambahkan ke Pesanan
        </button>

    </div>
</div>

<!-- ================= MODAL PEMBAYARAN ================= -->
<div id="paymentModal" class="pos-modal">
    <div class="pos-modal-content">

        <button type="button"
                class="modal-close"
                onclick="closePaymentModal()">
            <i class="fas fa-xmark"></i>
        </button>

        <div class="modal-product-icon">
            <i class="fas fa-credit-card"></i>
        </div>

        <h3>Pembayaran</h3>
        <p class="modal-subtitle">
            Masukkan nama pelanggan dan pilih metode pembayaran.
        </p>

        <!-- NAMA -->
        <div class="form-group">
            <label for="cashierCustomerName">
                Atas Nama
            </label>

            <input
                type="text"
                id="cashierCustomerName"
                class="customer-input"
                placeholder="Masukkan nama pelanggan"
                autocomplete="off">
        </div>

        <!-- TOTAL -->
        <div class="customer-total">
            <span>Total Pembayaran</span>
            <strong id="paymentTotal">Rp 0</strong>
        </div>

        <!-- METODE PEMBAYARAN -->
        <div class="payment-method-section">
            <label class="payment-label">
                Metode Pembayaran
            </label>

            <div class="payment-method-grid">

                <button
                    type="button"
                    class="payment-method active"
                    data-method="cash"
                    onclick="selectPaymentMethod('cash')">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Cash</span>
                </button>

                <button
                    type="button"
                    class="payment-method"
                    data-method="qris"
                    onclick="selectPaymentMethod('qris')">
                    <i class="fas fa-qrcode"></i>
                    <span>QRIS</span>
                </button>

            </div>

            <!-- QRIS TOKO (DI LUAR GRID) -->
            <div id="qrisPaymentSection" class="qris-payment-section" style="display: none;">
                <div class="qris-title">
                    <i class="fas fa-qrcode"></i>
                    <span>Scan QRIS untuk Pembayaran</span>
                </div>

                <img src="{{ asset('assets/AdminLTE/images/qris-sanjaiku.png.png') }}"
     alt="QRIS Sanjaiku"
     class="qris-image">

                <div class="qris-info">
                    <i class="fas fa-circle-info"></i>
                    <span>
                        Silakan pelanggan scan QRIS di atas menggunakan aplikasi pembayaran.
                    </span>
                </div>

                <div class="qris-check">
                    <i class="fas fa-check-circle"></i>
                    Kasir wajib memastikan pembayaran telah berhasil sebelum menyelesaikan transaksi.
                </div>
            </div>

        </div>

        <!-- BUTTON -->
        <button
            type="button"
            class="modal-add-button"
            onclick="finishCashierPayment()">
            <i class="fas fa-check"></i>
            Selesaikan Transaksi
        </button>

    </div>
</div>

<!-- ================= MODAL TRANSAKSI BERHASIL ================= -->
<div id="successModal" class="pos-modal">

    <div class="success-modal-content">

        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>

        <h3>Transaksi Berhasil</h3>

        <p class="success-message">
            Pembayaran berhasil disimpan ke sistem.
        </p>

        <div class="success-detail">

            <div class="success-row">
                <span>
                    <i class="fas fa-receipt"></i>
                    Invoice
                </span>

                <strong id="successInvoice">-</strong>
            </div>

            <div class="success-row">
                <span>
                    <i class="fas fa-user"></i>
                    Atas Nama
                </span>

                <strong id="successCustomer">-</strong>
            </div>

            <div class="success-row">
                <span>
                    <i class="fas fa-credit-card"></i>
                    Pembayaran
                </span>

                <strong id="successPayment">-</strong>
            </div>

            <div class="success-row">
                <span>
                    <i class="fas fa-box"></i>
                    Jumlah Item
                </span>

                <strong id="successItemCount">0 Item</strong>
            </div>

            <div class="success-total">
                <span>Total Pembayaran</span>

                <strong id="successTotal">
                    Rp 0
                </strong>
            </div>

        </div>

        <div class="success-actions">

            <button
                type="button"
                class="success-print-button"
                onclick="printCashierReceipt()">

                <i class="fas fa-print"></i>
                Cetak Struk

            </button>

            <button
                type="button"
                class="success-button"
                onclick="closeSuccessAndNewTransaction()">

                <i class="fas fa-plus"></i>
                Transaksi Baru

            </button>

        </div>

    </div>

</div>

<style>

    /* =========================
   LATAR HALAMAN KASIR
========================= */

body,
main,
.content,
.page-content {
    background: #ffffff !important;
}

.pos-layout,
.product-area,
.order-panel {
    background: #ffffff !important;
}

.product-grid {
    background: #ffffff !important;
}

/* Area heading */
.page-heading {
    background: #ffffff !important;
}

/* Kartu produk tetap putih */
.product-card {
    background: #ffffff !important;
}

/* Jika ada wrapper dari layouts.kasir */
.wrapper,
.main-content,
.content-wrapper {
    background: #ffffff !important;
}
/* ================= PRODUCT MODAL ================= */

.pos-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.pos-modal.show { display: flex; }

.pos-modal-content {
    width: 420px;
    max-width: 100%;
    background: #ffffff;
    border-radius: 16px;
    padding: 28px;
    position: relative;
    box-shadow: 0 20px 50px rgba(15, 23, 42, 0.18);
    animation: modalShow .2s ease;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
}
@keyframes modalShow {
    from { opacity: 0; transform: translateY(10px) scale(.98); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

.modal-close {
    position: absolute;
    right: 18px;
    top: 18px;
    width: 34px;
    height: 34px;
    border: none;
    background: #f8fafc;
    color: #64748b;
    border-radius: 50%;
    cursor: pointer;
    z-index: 2;
}
.modal-close:hover { background: #f1f5f9; }

.modal-product-icon {
    width: 60px;
    height: 60px;
    background: #fff7e6;
    color: #f59e0b;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    margin-bottom: 15px;
}

.pos-modal-content h3 {
    font-size: 20px;
    margin-bottom: 4px;
}

.modal-subtitle {
    color: #94a3b8;
    font-size: 13px;
    margin-bottom: 18px;
}

/* VARIANT */
.variant-option {
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 12px 14px;
    margin-bottom: 9px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: .15s;
}
.variant-option:hover {
    border-color: #f59e0b;
    background: #fffaf0;
}
.variant-option.selected {
    border-color: #f59e0b;
    background: #fff7e6;
}
.variant-option.disabled {
    opacity: .45;
    cursor: not-allowed;
}
.variant-info strong {
    display: block;
    font-size: 13px;
}
.variant-info span {
    display: block;
    color: #f59e0b;
    font-size: 12px;
    font-weight: 700;
    margin-top: 3px;
}
.variant-stock {
    font-size: 11px;
    color: #64748b;
}
.variant-stock.empty { color: #ef4444; }

/* QUANTITY */
.quantity-section { margin-top: 20px; }
.quantity-section label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 8px;
}
.quantity-control {
    display: flex;
    align-items: center;
    width: 140px;
    border: 1px solid #e5e7eb;
    border-radius: 9px;
    overflow: hidden;
}
.quantity-control button {
    width: 40px;
    height: 40px;
    border: none;
    background: #f8fafc;
    cursor: pointer;
}
.quantity-control button:hover { background: #f1f5f9; }
.quantity-control input {
    width: 60px;
    height: 40px;
    border: none;
    text-align: center;
    outline: none;
    font-weight: 600;
}
#modalStockInfo {
    display: block;
    margin-top: 7px;
    color: #94a3b8;
}

/* ADD BUTTON */
.modal-add-button {
    width: 100%;
    border: none;
    background: var(--accent, #0F172A);
    color: var(--on-accent, #F8FAFC);
    padding: 13px;
    border-radius: 9px;
    margin-top: 20px;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    font-size: 14px;
    transition: background .15s ease, opacity .15s ease;
}
.modal-add-button:hover:not(:disabled) { background: var(--accent-dark, #1e293b); }
.modal-add-button:disabled {
    opacity: .65;
    cursor: not-allowed;
}

/* ===============================
   CASHIER ORDER ITEM
================================ */
.order-items {
    max-height: 320px;
    overflow-y: auto;
    margin-bottom: 8px;
}

.cashier-order-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 12px 0;
    border-bottom: 1px solid #edf0f4;
}
.cashier-order-item > div { min-width: 0; }
.cashier-order-item strong {
    display: block;
    font-size: 12px;
    margin-bottom: 3px;
}
.cashier-order-item small {
    display: block;
    color: #94a3b8;
    font-size: 11px;
}
.cashier-order-item span {
    display: block;
    color: #f59e0b;
    font-weight: 700;
    font-size: 12px;
    margin-top: 4px;
}
.cashier-order-item button {
    width: 30px;
    height: 30px;
    border: none;
    background: #fef2f2;
    color: #ef4444;
    border-radius: 7px;
    cursor: pointer;
    flex-shrink: 0;
}
.cashier-order-item button:hover { background: #fee2e2; }

/* ===============================
   CUSTOMER / PAYMENT FORM
================================ */
.form-group { margin-bottom: 16px; }

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 7px;
}

.form-group label span {
    color: #94a3b8;
    font-weight: 400;
}

.customer-input {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 9px;
    padding: 11px 12px;
    font-size: 13px;
    outline: none;
    font-family: inherit;
    background: #ffffff;
}

.customer-input:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, .10);
}

.customer-input::placeholder { color: #b0b7c3; }

.customer-total {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f8fafc;
    border-radius: 10px;
    padding: 14px;
    margin-top: 20px;
}

.customer-total span {
    font-size: 12px;
    color: #64748b;
}

.customer-total strong {
    font-size: 17px;
    color: #f59e0b;
}

/* ===============================
   PAYMENT METHOD
================================ */
.payment-method-section { margin-top: 20px; }

.payment-label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 9px;
}

.payment-method-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

.payment-method {
    border: 1px solid #e5e7eb;
    background: #ffffff;
    border-radius: 10px;
    padding: 14px 10px;
    cursor: pointer;
    color: #64748b;
    font-weight: 600;
    font-size: 12px;
    transition: .15s;
    font-family: inherit;
}

.payment-method i {
    display: block;
    font-size: 20px;
    margin-bottom: 7px;
}

.payment-method:hover { border-color: var(--accent, #0F172A); }

.payment-method.active {
    border-color: var(--accent, #0F172A);
    background: var(--accent-soft, #e2e8f0);
    color: var(--accent, #0F172A);
}

/* =========================
   MODAL TRANSAKSI BERHASIL
========================= */
.success-modal-content {
    width: 420px;
    max-width: calc(100vw - 30px);
    background: #ffffff;
    border-radius: 20px;
    padding: 32px;
    text-align: center;
    position: relative;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.18);
    animation: successModalIn 0.2s ease;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
}

@keyframes successModalIn {
    from { opacity: 0; transform: scale(0.94) translateY(10px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.success-icon {
    width: 72px;
    height: 72px;
    margin: 0 auto 18px;
    border-radius: 50%;
    background: #fff7e6;
    color: #f59e0b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
}

.success-modal-content h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 800;
    color: #1e293b;
}

.success-message {
    margin: 8px 0 24px;
    color: #64748b;
    font-size: 14px;
}

.success-detail {
    background: #f8fafc;
    border-radius: 14px;
    padding: 16px;
    text-align: left;
}

.success-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    padding: 9px 0;
    border-bottom: 1px solid #e5e7eb;
}

.success-row:last-of-type { border-bottom: none; }

.success-row span {
    color: #64748b;
    font-size: 13px;
}

.success-row span i {
    width: 18px;
    margin-right: 5px;
    color: #94a3b8;
}

.success-row strong {
    color: #1e293b;
    font-size: 13px;
    text-align: right;
}

.success-total {
    margin-top: 12px;
    padding-top: 14px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.success-total span {
    color: #64748b;
    font-size: 13px;
}

.success-total strong {
    color: #f59e0b;
    font-size: 20px;
    font-weight: 800;
}

/* ACTIONS */
.success-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 20px;
}

.success-print-button,
.success-button {
    width: 100%;
    border: none;
    border-radius: 10px;
    padding: 13px 10px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: .15s;
    font-family: inherit;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.success-print-button {
    background: #f8fafc;
    color: #475569;
    border: 1px solid #e2e8f0;
}

.success-print-button:hover {
    background: #f1f5f9;
}

.success-button {
    background: var(--accent, #0F172A);
    color: var(--on-accent, #F8FAFC);
    border: 1px solid var(--accent, #0F172A);
}

.success-button:hover {
    background: var(--accent-dark, #1e293b);
    border-color: var(--accent-dark, #1e293b);
}

@media (max-width: 500px) {
    .success-modal-content { padding: 25px 20px; }
    .success-modal-content h3 { font-size: 21px; }
    .success-actions { grid-template-columns: 1fr; }
}

/* =========================
   QRIS
========================= */
.qris-payment-section {
    margin-top: 18px;
    padding: 18px;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    background: #fafafa;
    text-align: center;
}

.qris-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-weight: 600;
    margin-bottom: 14px;
    color: #222;
}

.qris-title i {
    font-size: 20px;
}

.qris-image-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 14px;
}

.qris-image {
    width: 280px;
    max-width: 100%;
    height: auto;
    display: block;
}

.qris-info {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    text-align: left;
    font-size: 13px;
    color: #555;
    margin-bottom: 10px;
}

.qris-info i {
    margin-top: 2px;
}

.qris-check {
    display: flex;
    align-items: flex-start;
    gap: 8px;
    text-align: left;
    font-size: 13px;
    font-weight: 500;
}

.qris-check i {
    margin-top: 2px;
}

/* =========================
   RESPONSIVE FIXES
========================= */

/* Tablet — order panel tidak lagi sticky */
@media (max-width: 1100px) {
    .order-panel {
        position: static;
        top: auto;
        height: auto;
    }
    .order-items {
        max-height: 280px;
    }
}

/* Mobile landscape & tablet kecil */
@media (max-width: 768px) {

    .page-heading h1 { font-size: 22px; }
    .page-heading p  { font-size: 12px; }
    .page-heading    { margin-bottom: 18px; }

    /* Header produk jadi vertikal */
    .product-header {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
    }

    /* Category filter bisa di-swipe horizontal */
    .category-filter {
        width: 100%;
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 6px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    .category-filter::-webkit-scrollbar { display: none; }
    .category-btn { flex-shrink: 0; }

    /* Grid produk 2 kolom */
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    .product-image { height: 120px; }
    .product-name  { font-size: 12px; }
    .product-price { font-size: 12px; }

    /* Modal full-width di HP */
    .pos-modal           { padding: 12px; }
    .pos-modal-content   { width: 100%; padding: 22px 18px; border-radius: 14px; }
    .success-modal-content { width: 100%; padding: 24px 20px; }

    /* Font-size 16px di input → cegah auto-zoom iOS */
    #modalQuantity,
    #cashierCustomerName,
    .customer-input {
        font-size: 16px;
    }

    /* Order items lebih pendek */
    .order-items { max-height: 240px; }

    /* QRIS lebih kecil */
    .qris-payment-section { padding: 14px; }
    .qris-image           { width: 220px; }
    .qris-title           { font-size: 13px; }

    /* Tombol aksi sukses jadi 1 kolom */
    .success-actions      { grid-template-columns: 1fr; }
}

/* HP kecil */
@media (max-width: 480px) {

    .page-heading h1 { font-size: 20px; }

    .product-grid    { gap: 8px; }
    .product-card    { padding: 10px; border-radius: 12px; }
    .product-image   { height: 100px; }
    .product-name    { font-size: 11px; }
    .product-price   { font-size: 11px; }
    .product-stock   { font-size: 10px; }

    .variant-option  { padding: 10px 12px; }
    .variant-info strong { font-size: 12px; }
    .variant-info span   { font-size: 11px; }

    .quantity-control { width: 130px; }
    .quantity-control button { width: 38px; height: 38px; }

    .modal-add-button {
        font-size: 13px;
        padding: 12px;
    }

    .qris-image      { width: 180px; }
    .qris-payment-section { padding: 12px; }

    .success-icon    { width: 60px; height: 60px; font-size: 26px; }
    .success-modal-content h3 { font-size: 20px; }

    .customer-total strong { font-size: 15px; }
}

/* HP sangat kecil */
@media (max-width: 360px) {
    .product-grid { grid-template-columns: 1fr 1fr; gap: 6px; }
    .product-card { padding: 8px; }
    .product-image { height: 90px; }
    .qris-image   { width: 150px; }
}
</style>
@endsection

@push('scripts')
<script>
(function () {
    'use strict';

    // ---------- State ----------
    var selectedProduct       = null;
    var selectedVariant       = null;
    var cashierOrder          = [];
    var selectedPaymentMethod = 'cash';
    var isSubmitting          = false;

    // ---------- Helpers ----------
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(Number(number) || 0);
    }

    function escapeHtml(str) {
        return String(str == null ? '' : str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function getModalQuantity() {
        return parseInt(document.getElementById('modalQuantity').value, 10) || 1;
    }

    function getOrderTotal() {
        var total = 0;
        cashierOrder.forEach(function (item) {
            total += item.price * item.quantity;
        });
        return total;
    }

    function getOrderItemCount() {
        var count = 0;
        cashierOrder.forEach(function (item) {
            count += Number(item.quantity) || 0;
        });
        return count;
    }

    // ============================================================
    // MODAL PRODUK
    // ============================================================
    function openProductModal(productId, productName, variants) {
        selectedProduct = { id: productId, name: productName, variants: variants };
        selectedVariant = null;

        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('modalQuantity').value = 1;
        document.getElementById('modalQuantity').removeAttribute('max');
        document.getElementById('modalStockInfo').textContent =
            'Pilih ukuran terlebih dahulu.';

        var variantList = document.getElementById('variantList');
        variantList.innerHTML = '';

        variants.forEach(function (variant) {
            var disabled = Number(variant.stock) <= 0 || Number(variant.status) !== 1;

            var div = document.createElement('div');
            div.className = 'variant-option' + (disabled ? ' disabled' : '');
            div.innerHTML =
                '<div class="variant-info">' +
                    '<strong>' + escapeHtml(variant.size) + '</strong>' +
                    '<span>Rp ' + formatRupiah(variant.price) + '</span>' +
                '</div>' +
                '<div class="variant-stock ' + (Number(variant.stock) <= 0 ? 'empty' : '') + '">' +
                    (Number(variant.stock) > 0 ? 'Stok ' + variant.stock : 'Stok habis') +
                '</div>';

            if (!disabled) {
                div.addEventListener('click', function () {
                    selectVariant(variant, div);
                });
            }

            variantList.appendChild(div);
        });

        document.getElementById('productModal').classList.add('show');
    }

    function closeProductModal() {
        document.getElementById('productModal').classList.remove('show');
    }

    function selectVariant(variant, element) {
        selectedVariant = variant;

        document.querySelectorAll('.variant-option').forEach(function (item) {
            item.classList.remove('selected');
        });
        element.classList.add('selected');

        var quantity = document.getElementById('modalQuantity');
        quantity.value = 1;
        quantity.max = variant.stock;

        document.getElementById('modalStockInfo').textContent =
            'Stok tersedia: ' + variant.stock + ' pcs';
    }

    function changeQuantity(change) {
        if (!selectedVariant) {
            alert('Pilih ukuran terlebih dahulu.');
            return;
        }

        var input = document.getElementById('modalQuantity');
        var value = getModalQuantity() + change;

        if (value < 1) value = 1;
        if (value > selectedVariant.stock) value = selectedVariant.stock;

        input.value = value;
    }

    function addToOrder() {
        if (!selectedVariant) {
            alert('Silakan pilih ukuran produk terlebih dahulu.');
            return;
        }

        var quantity = getModalQuantity();

        if (quantity < 1 || quantity > selectedVariant.stock) {
            alert('Jumlah melebihi stok yang tersedia.');
            return;
        }

        var existing = cashierOrder.find(function (item) {
            return item.variant_id === selectedVariant.id;
        });

        if (existing) {
            var newQuantity = existing.quantity + quantity;
            if (newQuantity > selectedVariant.stock) {
                alert('Jumlah pesanan melebihi stok varian ini.');
                return;
            }
            existing.quantity = newQuantity;
        } else {
            cashierOrder.push({
                product_id:   selectedProduct.id,
                product_name: selectedProduct.name,
                variant_id:   selectedVariant.id,
                size:         selectedVariant.size,
                price:        parseFloat(selectedVariant.price),
                quantity:     quantity,
                stock:        selectedVariant.stock
            });
        }

        closeProductModal();
        renderOrder();
    }

    function renderOrder() {
        var panel = document.querySelector('.order-panel');
        if (!panel) return;

        var itemsWrap   = panel.querySelector('.order-items');
        var emptyOrder  = panel.querySelector('.empty-order');
        var countEl     = panel.querySelector('.order-count');
        var summaryRows = panel.querySelectorAll('.summary-row');
        var totalEl     = panel.querySelector('.summary-total span:last-child');

        var total     = getOrderTotal();
        var itemCount = getOrderItemCount();

        itemsWrap.innerHTML = '';
        countEl.textContent = itemCount + ' Item';

        if (cashierOrder.length === 0) {
            emptyOrder.style.display = 'block';
        } else {
            emptyOrder.style.display = 'none';

            cashierOrder.forEach(function (item, index) {
                var div = document.createElement('div');
                div.className = 'cashier-order-item';
                div.innerHTML =
                    '<div>' +
                        '<strong>' + escapeHtml(item.product_name) + '</strong>' +
                        '<small>' + escapeHtml(item.size) + ' × ' + item.quantity + '</small>' +
                        '<span>Rp ' + formatRupiah(item.price * item.quantity) + '</span>' +
                    '</div>' +
                    '<button type="button" data-index="' + index + '">' +
                        '<i class="fas fa-trash"></i>' +
                    '</button>';

                div.querySelector('button').addEventListener('click', function () {
                    removeOrderItem(index);
                });

                itemsWrap.appendChild(div);
            });
        }

        if (summaryRows.length >= 2) {
            summaryRows[0].querySelector('span:last-child').textContent = 'Rp ' + formatRupiah(total);
            summaryRows[1].querySelector('span:last-child').textContent = 'Rp 0';
        }

        totalEl.textContent = 'Rp ' + formatRupiah(total);
    }

    function removeOrderItem(index) {
        cashierOrder.splice(index, 1);
        renderOrder();
    }

    // ============================================================
    // MODAL PEMBAYARAN
    // ============================================================
    function openPaymentModal() {
        if (cashierOrder.length === 0) {
            alert('Belum ada produk dalam pesanan.');
            return;
        }

        document.getElementById('paymentTotal').textContent =
            'Rp ' + formatRupiah(getOrderTotal());

        document.getElementById('cashierCustomerName').value = '';

        selectedPaymentMethod = 'cash';

        document.querySelectorAll('.payment-method').forEach(function (button) {
            button.classList.remove('active');
        });
        var cashBtn = document.querySelector('[data-method="cash"]');
        if (cashBtn) cashBtn.classList.add('active');

        // Reset tampilan QRIS
        var qrisSection = document.getElementById('qrisPaymentSection');
        if (qrisSection) qrisSection.style.display = 'none';

        document.getElementById('paymentModal').classList.add('show');

        setTimeout(function () {
            document.getElementById('cashierCustomerName').focus();
        }, 100);
    }

    function closePaymentModal() {
        document.getElementById('paymentModal').classList.remove('show');
    }

    function selectPaymentMethod(method) {
        selectedPaymentMethod = method;

        document.querySelectorAll('.payment-method').forEach(function (button) {
            button.classList.remove('active');
        });

        var btn = document.querySelector('[data-method="' + method + '"]');
        if (btn) btn.classList.add('active');

        var qrisSection = document.getElementById('qrisPaymentSection');
        if (qrisSection) {
            qrisSection.style.display = (method === 'qris') ? 'block' : 'none';
        }
    }

    // ============================================================
    // SUBMIT TRANSAKSI
    // ============================================================
    function finishCashierPayment() {
        if (isSubmitting) return;

        var customerName = document
            .getElementById('cashierCustomerName')
            .value
            .trim();

        if (customerName === '') {
            alert('Silakan masukkan nama pelanggan.');
            document.getElementById('cashierCustomerName').focus();
            return;
        }

        if (cashierOrder.length === 0) {
            alert('Belum ada produk dalam pesanan.');
            return;
        }

        isSubmitting = true;

        var submitBtn = document.querySelector('#paymentModal .modal-add-button');
        var originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';

        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        }

        var csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute('content');

        // Snapshot data sebelum di-reset
        var itemCountSnapshot = getOrderItemCount();
        var totalSnapshot     = getOrderTotal();

        fetch("{{ route('kasir.transaksi.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                customer_name:  customerName,
                payment_method: selectedPaymentMethod,
                items: cashierOrder.map(function (item) {
                    return {
                        variant_id: item.variant_id,
                        quantity:   item.quantity
                    };
                })
            })
        })
        .then(async function (response) {
            var data = null;
            var text = await response.text();

            try {
                data = text ? JSON.parse(text) : {};
            } catch (e) {
                data = { message: text || 'Respons server tidak valid.' };
            }

            if (!response.ok) {
                var msg = data.message || 'Transaksi gagal disimpan.';

                if (data.errors) {
                    var first = Object.values(data.errors)[0];
                    if (Array.isArray(first) && first.length) {
                        msg = first[0];
                    }
                }

                var err = new Error(msg);
                err.response = data;
                throw err;
            }

            return data;
        })
        .then(function (data) {
            var invoice = data.invoice
                || data.invoice_number
                || (data.order && (data.order.invoice || data.order.invoice_number))
                || '-';

            var total = data.total
                || (data.order && data.order.total)
                || totalSnapshot;

            var itemCount = data.item_count
                || (data.order && data.order.item_count)
                || itemCountSnapshot;

            document.getElementById('successInvoice').textContent   = invoice;
            document.getElementById('successCustomer').textContent  = customerName;
            document.getElementById('successPayment').textContent   = selectedPaymentMethod.toUpperCase();
            document.getElementById('successItemCount').textContent = itemCount + ' Item';
            document.getElementById('successTotal').textContent     = 'Rp ' + formatRupiah(total);

            // Simpan data untuk struk
            window.lastCashierTransaction = {
                invoice:   invoice,
                customer:  customerName,
                payment:   selectedPaymentMethod.toUpperCase(),
                itemCount: itemCount,
                total:     total
            };

            // Reset pesanan
            cashierOrder = [];
            renderOrder();

            // Tutup modal pembayaran, buka modal sukses
            closePaymentModal();
            document.getElementById('successModal').classList.add('show');
        })
        .catch(function (error) {
            console.error(error);
            alert('Transaksi gagal:\n' + error.message);
        })
        .finally(function () {
            isSubmitting = false;

            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
            }
        });
    }

    // ============================================================
    // MODAL SUKSES
    // ============================================================
    function closeSuccessModal() {
        document.getElementById('successModal').classList.remove('show');
    }

    function closeSuccessAndNewTransaction() {
        closeSuccessModal();

        window.lastCashierTransaction = null;

        document.getElementById('cashierCustomerName').value = '';

        selectedPaymentMethod = 'cash';

        document.querySelectorAll('.payment-method').forEach(function (button) {
            button.classList.remove('active');
        });

        var cashButton = document.querySelector('[data-method="cash"]');
        if (cashButton) cashButton.classList.add('active');

        // Sembunyikan QRIS lagi
        var qrisSection = document.getElementById('qrisPaymentSection');
        if (qrisSection) qrisSection.style.display = 'none';
    }

    // ============================================================
    // CETAK STRUK
    // ============================================================
    function printCashierReceipt() {
        var transaction = window.lastCashierTransaction;

        if (!transaction) {
            alert('Tidak ada data transaksi untuk dicetak.');
            return;
        }

        var receiptWindow = window.open('', '_blank', 'width=400,height=600');

        if (!receiptWindow) {
            alert('Popup diblokir browser. Izinkan popup untuk mencetak struk.');
            return;
        }

        receiptWindow.document.write(
            '<!DOCTYPE html>' +
            '<html>' +
            '<head>' +
                '<title>Struk ' + transaction.invoice + '</title>' +
                '<style>' +
                    '* { box-sizing: border-box; }' +
                    'body {' +
                        'font-family: Arial, sans-serif;' +
                        'width: 300px;' +
                        'margin: 0 auto;' +
                        'padding: 20px;' +
                        'color: #111827;' +
                    '}' +
                    '.receipt-header { text-align: center; margin-bottom: 20px; }' +
                    '.receipt-header h2 { margin: 0; font-size: 22px; }' +
                    '.receipt-header p { margin: 4px 0; font-size: 12px; color: #64748b; }' +
                    '.line { border-top: 1px dashed #94a3b8; margin: 12px 0; }' +
                    '.row {' +
                        'display: flex;' +
                        'justify-content: space-between;' +
                        'gap: 10px;' +
                        'font-size: 12px;' +
                        'margin: 7px 0;' +
                    '}' +
                    '.row span:first-child { color: #64748b; }' +
                    '.total {' +
                        'display: flex;' +
                        'justify-content: space-between;' +
                        'font-size: 16px;' +
                        'font-weight: bold;' +
                        'margin-top: 12px;' +
                    '}' +
                    '.footer {' +
                        'text-align: center;' +
                        'margin-top: 25px;' +
                        'font-size: 11px;' +
                        'color: #64748b;' +
                    '}' +
                '</style>' +
            '</head>' +
            '<body>' +
                '<div class="receipt-header">' +
                    '<h2>SANJAIKU</h2>' +
                    '<p>Kerupuk Sanjai</p>' +
                    '<p>Struk Transaksi Kasir</p>' +
                '</div>' +
                '<div class="line"></div>' +
                '<div class="row"><span>Invoice</span><strong>' + transaction.invoice + '</strong></div>' +
                '<div class="row"><span>Atas Nama</span><strong>' + transaction.customer + '</strong></div>' +
                '<div class="row"><span>Pembayaran</span><strong>' + transaction.payment + '</strong></div>' +
                '<div class="row"><span>Jumlah Item</span><strong>' + transaction.itemCount + '</strong></div>' +
                '<div class="line"></div>' +
                '<div class="total">' +
                    '<span>TOTAL</span>' +
                    '<span>Rp ' + formatRupiah(transaction.total) + '</span>' +
                '</div>' +
                '<div class="footer">Terima kasih telah berbelanja di Sanjaiku.</div>' +
            '</body>' +
            '</html>'
        );

        receiptWindow.document.close();
        receiptWindow.focus();

        setTimeout(function () {
            receiptWindow.print();
            receiptWindow.close();
        }, 300);
    }

    // ============================================================
    // FILTER KATEGORI
    // ============================================================
    function applyCategoryFilter(keyword) {
        var cards = document.querySelectorAll('.product-card');
        var k = keyword.toLowerCase();

        cards.forEach(function (card) {
            var name = (card.dataset.productName || '').toLowerCase();
            var show = (k === '' || k === 'semua' || name.indexOf(k) !== -1);
            card.classList.toggle('is-hidden', !show);
        });
    }

    function bindCategoryFilter() {
        var buttons = document.querySelectorAll('.category-btn');

        buttons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                buttons.forEach(function (b) { b.classList.remove('active'); });
                this.classList.add('active');

                var label = this.textContent.trim().toLowerCase();
                applyCategoryFilter(label === 'semua' ? '' : label);
            });
        });
    }

    // ============================================================
    // EXPOSE KE GLOBAL (untuk inline onclick)
    // ============================================================
    window.openProductModal     = openProductModal;
    window.closeProductModal    = closeProductModal;
    window.changeQuantity       = changeQuantity;
    window.addToOrder           = addToOrder;

    window.openPaymentModal     = openPaymentModal;
    window.closePaymentModal    = closePaymentModal;
    window.selectPaymentMethod  = selectPaymentMethod;
    window.finishCashierPayment = finishCashierPayment;

    window.closeSuccessModal             = closeSuccessModal;
    window.closeSuccessAndNewTransaction = closeSuccessAndNewTransaction;
    window.printCashierReceipt           = printCashierReceipt;

    // ============================================================
    // BINDING EVENT
    // ============================================================

    // Kartu produk
    document.querySelectorAll('.product-card').forEach(function (card) {
        card.addEventListener('click', function () {
            var id   = this.dataset.productId;
            var name = this.dataset.productName;

            var variants = [];
            try {
                variants = JSON.parse(this.dataset.variants || '[]');
            } catch (e) {
                console.error('Gagal parse variants:', e);
            }

            openProductModal(id, name, variants);
        });

        card.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // Validasi input quantity manual
    var qtyInput = document.getElementById('modalQuantity');
    if (qtyInput) {
        qtyInput.addEventListener('input', function () {
            if (!selectedVariant) return;

            var value = parseInt(this.value, 10);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > selectedVariant.stock) {
                this.value = selectedVariant.stock;
            }
        });
    }

    // Klik luar modal → tutup
    document.getElementById('productModal').addEventListener('click', function (event) {
        if (event.target === this) closeProductModal();
    });
    document.getElementById('paymentModal').addEventListener('click', function (event) {
        if (event.target === this) closePaymentModal();
    });
    document.getElementById('successModal').addEventListener('click', function (event) {
        if (event.target === this) closeSuccessModal();
    });

    // ESC menutup modal aktif
    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;

        if (document.getElementById('successModal').classList.contains('show')) {
            closeSuccessModal();
        } else if (document.getElementById('paymentModal').classList.contains('show')) {
            closePaymentModal();
        } else if (document.getElementById('productModal').classList.contains('show')) {
            closeProductModal();
        }
    });

    // Filter kategori
    bindCategoryFilter();

    // Enter di input nama pelanggan → submit
    var custNameInput = document.getElementById('cashierCustomerName');
    if (custNameInput) {
        custNameInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                finishCashierPayment();
            }
        });
    }

})();
</script>
@endpush