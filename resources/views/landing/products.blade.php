@extends('layouts.landing')

@section('title', 'Produk')

@push('styles')
{{-- Font & style dasar agar navbar dan seluruh halaman menggunakan font yang sama dengan index --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500&display=swap">

<style>
    /* Terapkan font ke seluruh halaman (termasuk navbar) */
    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: #f7f9fb;
        color: #191c1e;
        overflow-x: hidden;
    }

    /* Pastikan brand "Sanjaiku" di navbar memakai font Inter */
    .navbar-brand {
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    /* Gaya tambahan untuk produk - meniru gaya index */
    .landing-wrapper {
        --sj-ink: #191c1e;
        --sj-navy: #131b2e;
        --sj-navy-2: #1d2740;
        --sj-blue: #0051d5;
        --sj-blue-deep: #003ea8;
        --sj-blue-bright: #316bf3;
        --sj-green: #009844;
        --sj-green-deep: #007535;
        --sj-cream: #f7f9fb;
        --sj-surface: #eceef0;
        --sj-surface-low: #f2f4f6;
        --sj-line: #dfe2e6;
        --sj-muted: #45464d;
    }

    .landing-wrapper h2 {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: var(--sj-ink);
        font-size: clamp(1.75rem, 3.2vw, 2.5rem);
        line-height: 1.15;
    }

    .landing-wrapper .text-muted {
        color: var(--sj-muted) !important;
    }

    .landing-wrapper .btn-orange {
        background: var(--sj-blue);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 0.9rem;
        padding: 0.85rem 1.6rem;
        box-shadow: 0 10px 24px -12px rgba(0, 81, 213, 0.85);
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
    }

    .landing-wrapper .btn-orange:hover {
        background: var(--sj-blue-deep);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 16px 32px -12px rgba(0, 81, 213, 0.9);
    }

    /* ===== HEADER / HERO SECTION ===== */
    .landing-wrapper .page-header {
        text-align: center;
        margin-bottom: 3rem;
        opacity: 0;
        transform: translateY(30px);
        animation: heroFadeIn 0.9s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        animation-delay: 0.2s;
    }

    @keyframes heroFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .landing-wrapper .eyebrow {
        display: inline-block;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--sj-blue);
        margin-bottom: 0.85rem;
    }

    /* ===== KARTU PRODUK ===== */
    .landing-wrapper .product-card {
        position: relative;
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        overflow: hidden;
        background: #fff;
        transition: transform 0.35s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.35s cubic-bezier(0.23, 1, 0.32, 1),
                    border-color 0.35s ease;
        opacity: 0;
        transform: translateY(40px) scale(0.97);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.35s ease,
                    border-color 0.35s ease;
    }

    .landing-wrapper .product-card.reveal {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Delay bertingkat untuk kartu */
    .landing-wrapper .col-lg-4:nth-child(1) .product-card { transition-delay: 0.05s; }
    .landing-wrapper .col-lg-4:nth-child(2) .product-card { transition-delay: 0.12s; }
    .landing-wrapper .col-lg-4:nth-child(3) .product-card { transition-delay: 0.19s; }
    .landing-wrapper .col-lg-4:nth-child(4) .product-card { transition-delay: 0.26s; }
    .landing-wrapper .col-lg-4:nth-child(5) .product-card { transition-delay: 0.33s; }
    .landing-wrapper .col-lg-4:nth-child(6) .product-card { transition-delay: 0.40s; }
    .landing-wrapper .col-lg-4:nth-child(7) .product-card { transition-delay: 0.47s; }
    .landing-wrapper .col-lg-4:nth-child(8) .product-card { transition-delay: 0.54s; }
    .landing-wrapper .col-lg-4:nth-child(9) .product-card { transition-delay: 0.61s; }

    .landing-wrapper .product-card:hover {
        transform: translateY(-6px) scale(1.01);
        border-color: transparent;
        box-shadow: 0 20px 44px -24px rgba(19, 27, 46, 0.45), 0 0 0 1px rgba(0, 81, 213, 0.08);
    }

    .landing-wrapper .product-media {
        position: relative;
        overflow: hidden;
        background: var(--sj-surface);
    }

    .landing-wrapper .product-media::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(0deg, rgba(19, 27, 46, 0.82) 0%, rgba(19, 27, 46, 0.15) 55%, transparent 75%);
        pointer-events: none;
    }

    .landing-wrapper .product-card .card-img-top {
        border-radius: 0;
        transition: transform .5s cubic-bezier(0.23, 1, 0.32, 1);
        will-change: transform;
    }

    .landing-wrapper .product-card:hover .card-img-top {
        transform: scale(1.06);
    }

    .landing-wrapper .product-overlay {
        position: absolute;
        inset: 0;
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 1.5rem;
    }

    .landing-wrapper .product-card h5 {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        color: #fff;
        transform: translateY(0);
        transition: transform 0.3s ease;
    }

    .landing-wrapper .product-card:hover h5 {
        transform: translateY(-2px);
    }

    .landing-wrapper .product-card .product-overlay p {
        font-weight: 400;
        font-size: 0.9rem;
        line-height: 1.5;
        color: rgba(255, 255, 255, 0.82);
        margin-bottom: 0;
    }

    .landing-wrapper .product-detail-btn {
        position: absolute;
        right: 1.25rem;
        bottom: 1.25rem;
        z-index: 3;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--sj-blue);
        color: #fff;
        box-shadow: 0 10px 22px -10px rgba(0, 81, 213, 0.9);
        transition: background 0.25s ease, transform 0.3s cubic-bezier(0.23, 1, 0.32, 1), box-shadow 0.25s ease;
        text-decoration: none;
    }

    .landing-wrapper .product-detail-btn:hover {
        background: var(--sj-blue-deep);
        color: #fff;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 14px 28px -12px rgba(0, 81, 213, 0.95);
    }

    .landing-wrapper .product-detail-btn i {
        transition: transform 0.3s ease;
    }

    .landing-wrapper .product-detail-btn:hover i {
        transform: rotate(8deg);
    }

    /* ===== EMPTY STATE ===== */
    .landing-wrapper .empty-state {
        border: 1px dashed var(--sj-line);
        border-radius: 1.25rem;
        background: var(--sj-surface-low);
        color: var(--sj-muted);
        padding: 2.5rem 1.5rem;
        justify-content: center;
        font-size: 0.95rem;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }

    .landing-wrapper .empty-state.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .landing-wrapper .empty-state i {
        color: var(--sj-blue);
    }

    /* ===== PAGINATION ===== */
    .landing-wrapper .pagination {
        opacity: 0;
        transform: translateY(20px);
        animation: paginationFadeIn 0.8s ease forwards;
        animation-delay: 0.6s;
    }

    @keyframes paginationFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .landing-wrapper .pagination .page-link {
        color: var(--sj-blue);
        border-radius: 0.5rem;
        border: 1px solid var(--sj-line);
        margin: 0 2px;
        transition: background 0.2s ease, color 0.2s ease, transform 0.2s ease;
        font-weight: 500;
    }

    .landing-wrapper .pagination .page-link:hover {
        background: var(--sj-blue);
        border-color: var(--sj-blue);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -10px rgba(0, 81, 213, 0.4);
    }

    .landing-wrapper .pagination .page-item.active .page-link {
        background: var(--sj-blue);
        border-color: var(--sj-blue);
        color: #fff;
        box-shadow: 0 8px 16px -10px rgba(0, 81, 213, 0.5);
    }

    .landing-wrapper .pagination .page-item.disabled .page-link {
        color: var(--sj-muted);
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* ===== RESPONSIF ===== */
    @media (max-width: 767.98px) {
        .landing-wrapper .product-card {
            transform: translateY(30px) scale(0.98);
        }
        .landing-wrapper .product-card.reveal {
            transform: translateY(0) scale(1);
        }
    }
</style>
@endpush

@section('content')
<div class="landing-wrapper">
    <section>
        <div class="container">

            {{-- HEADER / HERO --}}
            <div class="page-header">
                <span class="eyebrow"><i class="fas fa-box-open me-1"></i> Koleksi Kami</span>
                <h2>Menu Produk</h2>
                <p class="text-muted mt-2" style="max-width: 36rem; margin-left: auto; margin-right: auto;">
                    Pilihan kerupuk sanjai asli dari Payakumbuh dengan berbagai varian rasa dan ukuran.
                </p>
            </div>

            {{-- DAFTAR PRODUK --}}
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card product-card h-100">
                            <div class="product-media">
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                     class="card-img-top"
                                     style="height:280px;object-fit:cover;"
                                     alt="{{ $product->name }}"
                                     loading="lazy">
                                <div class="product-overlay">
                                    <h5>{{ $product->name }}</h5>
                                    <p>{{ Str::limit($product->description, 70) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('products.detail', $product->slug) }}"
                               class="product-detail-btn"
                               title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state d-flex align-items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            Belum ada produk.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($products->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @endif

        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ---------- SCROLL REVEAL UNTUK KARTU PRODUK ----------
        const productCards = document.querySelectorAll('.product-card');
        const emptyState = document.querySelector('.empty-state');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -30px 0px'
        });

        productCards.forEach(card => observer.observe(card));

        // Jika ada empty state
        if (emptyState) {
            const emptyObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal');
                        emptyObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.2 });
            emptyObserver.observe(emptyState);
        }

        // ---------- EFEK PARALLAX RINGAN PADA GAMBAR (opsional) ----------
        // Bisa ditambahkan jika ingin gambar bergerak halus saat scroll,
        // tapi di halaman produk tidak terlalu diperlukan.

    });
</script>
@endpush