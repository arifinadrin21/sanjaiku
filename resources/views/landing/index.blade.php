@extends('layouts.landing')

@section('title', 'Home')

@push('styles')

<style>
    /* =====================================================
       SANJAIKU — LANDING
       Restyled to the "Heritage Pulse" design system.
       ===================================================== */

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

        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: var(--sj-cream);
        color: var(--sj-ink);
        overflow-x: hidden;
    }

    .landing-wrapper h1,
    .landing-wrapper h2,
    .landing-wrapper h4,
    .landing-wrapper h5 {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: var(--sj-ink);
    }

    .landing-wrapper h2 {
        font-size: clamp(1.75rem, 3.2vw, 2.5rem);
        line-height: 1.15;
    }

    .landing-wrapper .text-muted {
        color: var(--sj-muted) !important;
    }

    .landing-wrapper section {
        padding: 6rem 0;
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

    /* ============ HERO (FULL IMAGE) ============ */
    .landing-wrapper .hero-section {
        position: relative;
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--sj-navy);
        padding: 6rem 0;
        text-align: center;
        overflow: hidden;
        margin-top: -1px; /* Menghilangkan gap jika ada navbar */
    }

    .landing-wrapper .hero-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }

    .landing-wrapper .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(19, 27, 46, 0.75) 0%, rgba(19, 27, 46, 0.85) 100%);
        z-index: 1;
    }

    .landing-wrapper .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
        opacity: 0;
        transform: translateY(30px);
        animation: heroFadeIn 0.9s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        animation-delay: 0.2s;
    }

    @keyframes heroFadeIn {
        to { opacity: 1; transform: translateY(0); }
    }

    .landing-wrapper .hero-content .eyebrow {
        color: var(--sj-blue-bright);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .landing-wrapper .hero-content h1 {
        font-size: clamp(2.5rem, 6vw, 4rem);
        line-height: 1.1;
        letter-spacing: -0.03em;
        margin-bottom: 1.5rem;
        color: #fff;
    }

    .landing-wrapper .hero-content .text-orange {
        color: var(--sj-blue-bright);
    }

    .landing-wrapper .hero-content .lead {
        font-size: 1.125rem;
        line-height: 1.7;
        margin: 0 auto 2rem;
        max-width: 600px;
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .landing-wrapper .hero-content .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: center;
        margin-top: 0;
    }

    /* ============ TOMBOL ============ */
    .landing-wrapper .btn-orange {
        background: var(--sj-blue);
        border: none;
        color: #fff;
        font-weight: 600;
        letter-spacing: 0;
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

    .landing-wrapper .btn-ghost-light {
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.35);
        color: #fff;
        font-weight: 600;
        border-radius: 0.9rem;
        padding: calc(0.85rem - 2px) 1.6rem;
        transition: background .18s ease, color .18s ease, border-color .18s ease;
    }

    .landing-wrapper .btn-ghost-light:hover {
        background: #fff;
        border-color: #fff;
        color: var(--sj-navy);
    }

    .landing-wrapper .link-more {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--sj-blue);
        text-decoration: none;
        white-space: nowrap;
        transition: gap .18s ease, color .18s ease;
    }

    .landing-wrapper .link-more:hover {
        color: var(--sj-blue-deep);
        gap: 0.85rem;
    }

    /* ============ STATS BAR ============ */
    .landing-wrapper .stats-section {
        padding: 3.5rem 0;
        border-bottom: 1px solid var(--sj-line);
    }

    .landing-wrapper .stat-item {
        text-align: center;
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .landing-wrapper .stat-item.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .landing-wrapper .stat-item:nth-child(1) { transition-delay: 0.05s; }
    .landing-wrapper .stat-item:nth-child(2) { transition-delay: 0.12s; }
    .landing-wrapper .stat-item:nth-child(3) { transition-delay: 0.19s; }
    .landing-wrapper .stat-item:nth-child(4) { transition-delay: 0.26s; }

    .landing-wrapper .stat-icon {
        font-size: 1.8rem;
        color: var(--sj-blue);
        display: block;
        margin-bottom: 0.5rem;
    }

    .landing-wrapper .stat-value {
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        font-size: clamp(1.5rem, 2.6vw, 2rem);
        letter-spacing: -0.02em;
        color: var(--sj-ink);
        line-height: 1.1;
    }

    .landing-wrapper .stat-label {
        font-size: 0.85rem;
        color: var(--sj-muted);
        margin-top: 0.35rem;
    }

    /* ============ KEUNGGULAN ============ */
    .landing-wrapper .feature-card {
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        background: #fff;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .landing-wrapper .feature-card.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .landing-wrapper .feature-card:nth-child(1) { transition-delay: 0.1s; }
    .landing-wrapper .feature-card:nth-child(2) { transition-delay: 0.2s; }
    .landing-wrapper .feature-card:nth-child(3) { transition-delay: 0.3s; }

    .landing-wrapper .feature-card:hover {
        transform: translateY(-4px);
        border-color: transparent;
        box-shadow: 0 18px 40px -22px rgba(19, 27, 46, 0.35);
    }

    .landing-wrapper .feature-card h4 {
        font-size: 1.05rem;
        margin-bottom: 0.5rem;
    }

    .landing-wrapper .feature-card p {
        font-weight: 400;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .landing-wrapper .feature-icon-wrap {
        width: 56px;
        height: 56px;
        border-radius: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 0 1.25rem;
    }

    .landing-wrapper .feature-icon-wrap .fa-2x {
        font-size: 1.35rem;
    }

    .landing-wrapper .feature-icon-wrap.bg-warning-soft {
        background: rgba(0, 81, 213, 0.10);
    }

    .landing-wrapper .feature-icon-wrap.bg-success-soft {
        background: rgba(0, 152, 68, 0.10);
    }

    .landing-wrapper .feature-icon-wrap.bg-primary-soft {
        background: rgba(19, 27, 46, 0.08);
    }

    .landing-wrapper .feature-icon-wrap .text-warning {
        color: var(--sj-blue) !important;
    }

    .landing-wrapper .feature-icon-wrap .text-success {
        color: var(--sj-green) !important;
    }

    .landing-wrapper .feature-icon-wrap .text-primary {
        color: var(--sj-navy) !important;
    }

    /* ============ PRODUK ============ */
    .landing-wrapper .bg-light {
        background: #ffffff !important;
    }

    .landing-wrapper .section-head {
        gap: 1.5rem;
    }

    .landing-wrapper .product-card {
        position: relative;
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        overflow: hidden;
        background: #fff;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        opacity: 0;
        transform: translateY(40px) scale(0.97);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .landing-wrapper .product-card.reveal {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .landing-wrapper .product-card:nth-child(1) { transition-delay: 0.1s; }
    .landing-wrapper .product-card:nth-child(2) { transition-delay: 0.2s; }
    .landing-wrapper .product-card:nth-child(3) { transition-delay: 0.3s; }

    .landing-wrapper .product-card:hover {
        transform: translateY(-4px);
        border-color: transparent;
        box-shadow: 0 20px 44px -24px rgba(19, 27, 46, 0.4);
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
        transition: transform .45s ease;
    }

    .landing-wrapper .product-card:hover .card-img-top {
        transform: scale(1.05);
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

    .landing-wrapper .product-badge {
        align-self: flex-start;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.68rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        background: rgba(0, 152, 68, 0.85);
        color: #fff;
        padding: 0.3rem 0.65rem;
        border-radius: 0.5rem;
        margin-bottom: auto;
    }

    .landing-wrapper .product-card h5 {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        color: #fff;
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
        transition: background .18s ease, transform .18s ease;
    }

    .landing-wrapper .product-detail-btn:hover {
        background: var(--sj-blue-deep);
        color: #fff;
        transform: translateY(-2px);
    }

    /* ============ TESTIMONI ============ */
    .landing-wrapper .testi-card {
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        background: #fff;
        overflow: hidden;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .landing-wrapper .testi-card.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .landing-wrapper .testi-card:nth-child(1) { transition-delay: 0.1s; }
    .landing-wrapper .testi-card:nth-child(2) { transition-delay: 0.2s; }
    .landing-wrapper .testi-card:nth-child(3) { transition-delay: 0.3s; }

    .landing-wrapper .testi-card:hover {
        transform: translateY(-4px);
        border-color: transparent;
        box-shadow: 0 18px 40px -22px rgba(19, 27, 46, 0.35);
    }

    .landing-wrapper .testi-card .card-body {
        padding: 1.75rem 1.5rem 1.25rem;
    }

    .landing-wrapper .testi-card .fa-star {
        color: #e8a300 !important;
        font-size: 0.85rem;
    }

    .landing-wrapper .testi-card .fa-quote-left {
        color: var(--sj-blue) !important;
    }

    .landing-wrapper .testi-card p {
        font-weight: 400;
        font-style: normal;
        font-size: 0.975rem;
        line-height: 1.65;
        margin-bottom: 0;
    }

    .landing-wrapper .testi-card .card-footer {
        background: var(--sj-surface-low);
        border-top: 1px solid var(--sj-line);
        padding: 1rem 1.5rem;
    }

    .landing-wrapper .testi-card strong {
        font-weight: 700;
        font-size: 0.95rem;
    }

    .landing-wrapper .testi-card small {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.7rem;
        letter-spacing: 0.04em;
    }

    .landing-wrapper .section-subtitle {
        font-weight: 400;
        font-size: 1.0625rem;
        max-width: 36rem;
        margin-left: auto;
        margin-right: auto;
    }

    /* ============ CRAFTED WITH CULTURE ============ */
    .landing-wrapper .culture-section {
        background: var(--sj-surface-low);
    }

    .landing-wrapper .culture-copy {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        transition-delay: 0.1s;
    }

    .landing-wrapper .culture-copy.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .landing-wrapper .culture-media {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        transition-delay: 0.2s;
    }

    .landing-wrapper .culture-media.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .landing-wrapper .culture-media img {
        border-radius: 1.5rem;
        width: 100%;
        box-shadow: 0 24px 50px -28px rgba(19, 27, 46, 0.4);
    }

    .landing-wrapper .culture-badge {
        position: absolute;
        left: -1.25rem;
        bottom: -1.25rem;
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 16px 32px -16px rgba(19, 27, 46, 0.45);
        animation: floatBadge 4s ease-in-out infinite;
    }

    @keyframes floatBadge {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    .landing-wrapper .culture-badge span {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.62rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--sj-navy);
        line-height: 1.3;
    }

    .landing-wrapper .culture-badge i {
        color: var(--sj-blue);
        font-size: 1.15rem;
        display: block;
        margin-bottom: 0.2rem;
    }

    .landing-wrapper .culture-copy h2 {
        margin-bottom: 1.1rem;
    }

    .landing-wrapper .culture-point {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        margin-top: 1.1rem;
    }

    .landing-wrapper .culture-point-icon {
        flex: none;
        width: 38px;
        height: 38px;
        border-radius: 0.65rem;
        background: rgba(0, 81, 213, 0.10);
        color: var(--sj-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .landing-wrapper .culture-point h6 {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 0.15rem;
        color: var(--sj-ink);
    }

    .landing-wrapper .culture-point p {
        font-size: 0.9rem;
        color: var(--sj-muted);
        margin-bottom: 0;
        line-height: 1.55;
    }

    /* ============ EMPTY STATE ============ */
    .landing-wrapper .empty-state {
        border: 1px dashed var(--sj-line);
        border-radius: 1.25rem;
        background: var(--sj-surface-low);
        color: var(--sj-muted);
        padding: 2.5rem 1.5rem;
        justify-content: center;
        font-size: 0.95rem;
    }

    .landing-wrapper .empty-state i {
        color: var(--sj-blue);
    }

    /* ============ PROMO VOUCHER ============ */
    .landing-wrapper .promo-section {
        padding: 70px 0;
        background: var(--sj-surface-low);
    }

    .landing-wrapper .promo-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .landing-wrapper .promo-header span {
        color: var(--sj-blue);
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .landing-wrapper .promo-header h2 {
        margin: 8px 0;
        font-size: 30px;
        font-weight: 700;
        color: var(--sj-ink);
    }

    .landing-wrapper .promo-header p {
        color: var(--sj-muted);
        font-size: 14px;
    }

    .landing-wrapper .promo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .landing-wrapper .promo-card {
        background: #101827;
        border-radius: 16px;
        padding: 28px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .landing-wrapper .promo-card::after {
        content: "";
        position: absolute;
        width: 160px;
        height: 160px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 50%;
        right: -50px;
        top: -50px;
    }

    .landing-wrapper .promo-label {
        color: #6ea8ff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        margin-bottom: 12px;
    }

    .landing-wrapper .promo-card h3 {
        font-size: 28px;
        margin-bottom: 8px;
    }

    .landing-wrapper .promo-card p {
        color: #b8c0cc;
        font-size: 14px;
    }

    .landing-wrapper .voucher-code {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 20px 0 14px;
        padding: 10px;
        background: rgba(255,255,255,.08);
        border: 1px dashed rgba(255,255,255,.25);
        border-radius: 8px;
    }

    .landing-wrapper .voucher-code span {
        font-weight: 700;
        letter-spacing: 1px;
    }

    .landing-wrapper .voucher-code button {
        border: none;
        background: var(--sj-blue);
        color: white;
        padding: 7px 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: background .2s;
    }

    .landing-wrapper .voucher-code button:hover {
        background: var(--sj-blue-deep);
    }

    .landing-wrapper .promo-card small {
        color: #9da7b5;
    }

    /* ============ TOAST NOTIFICATION ============ */
    .landing-wrapper .toast-notification {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background: var(--sj-ink);
        color: #fff;
        padding: 1rem 1.5rem;
        border-radius: 0.85rem;
        box-shadow: 0 20px 48px -16px rgba(19, 27, 46, 0.6);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transform: translateY(120%);
        opacity: 0;
        transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1),
                    opacity 0.4s ease;
        z-index: 9999;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 0.95rem;
        pointer-events: none;
    }

    .landing-wrapper .toast-notification.show {
        transform: translateY(0);
        opacity: 1;
        pointer-events: auto;
    }

    .landing-wrapper .toast-notification i {
        font-size: 1.2rem;
        color: var(--sj-green);
    }

    .landing-wrapper .toast-notification .toast-close {
        background: none;
        border: none;
        color: rgba(255,255,255,0.6);
        font-size: 1.1rem;
        cursor: pointer;
        padding: 0 0 0 0.5rem;
        transition: color 0.2s;
    }

    .landing-wrapper .toast-notification .toast-close:hover {
        color: #fff;
    }

    /* ============ RESPONSIF ============ */
    @media (max-width: 991.98px) {
        .landing-wrapper .hero-section {
            min-height: 75vh;
        }
        .landing-wrapper .culture-badge {
            left: 1.25rem;
            bottom: -1.25rem;
        }
    }

    @media (max-width: 767.98px) {
        .landing-wrapper section {
            padding: 4rem 0;
        }
        .landing-wrapper .hero-section {
            min-height: 70vh;
            padding: 4rem 1rem;
        }
        .landing-wrapper .hero-content h1 {
            font-size: 2.25rem;
        }
        .landing-wrapper .hero-content .lead {
            font-size: 1rem;
        }
        .landing-wrapper .hero-actions .btn {
            width: 100%;
        }
        .landing-wrapper .stats-section .stat-item {
            margin-bottom: 1.5rem;
        }
        .landing-wrapper .stats-section .stat-item:last-child {
            margin-bottom: 0;
        }
        .landing-wrapper .culture-media {
            margin-bottom: 3rem;
        }
    }
</style>

@endpush

@section('content')

<div class="landing-wrapper">

    {{-- HERO (FULL IMAGE) --}}
    <section class="hero-section">
        <img
    src="{{ asset('storage/foto_landingpage/pasar.jpg') }}"
    class="hero-bg"
    alt="Kerupuk Sanjai Background"
    width="1600"
    height="900"
    fetchpriority="high"
    loading="eager"
>
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <span class="eyebrow"><i class="fas fa-map-pin me-1"></i> Asli Payakumbuh</span>
            <h1>
                Kerupuk <span class="text-orange">Sanjai</span><br>
                Khas Payakumbuh
            </h1>
            <p class="lead">
                Nikmati kerupuk sanjai asli dengan berbagai pilihan rasa
                dan ukuran yang cocok untuk keluarga maupun oleh-oleh.
            </p>
            <div class="hero-actions">
                <a href="{{ route('products') }}" class="btn btn-orange btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i>Belanja Sekarang
                </a>
                <a href="{{ route('about') }}" class="btn btn-ghost-light btn-lg">
                    <i class="fas fa-info-circle me-2"></i>Cerita Kami
                </a>
            </div>
        </div>
    </section>

    {{-- ==================== PROMO VOUCHER ==================== --}}
    <section class="promo-section">
        <div class="container">
            <div class="promo-header">
                <span>PROMO</span>
                <h2>Promo Spesial Sanjaiku</h2>
                <p>Dapatkan harga lebih hemat dengan voucher pilihan kami.</p>
            </div>

            @if($vouchers->count() > 0)
                <div class="promo-grid">
                    @foreach($vouchers as $voucher)
                        <div class="promo-card">
                            <div class="promo-content">
                                <div class="promo-label">PROMO SPESIAL</div>
                                <h3>
                                    @if($voucher->type === 'percent')
                                        Diskon {{ $voucher->discount_amount }}%
                                    @elseif($voucher->type === 'nominal')
                                        Diskon Rp {{ number_format($voucher->discount_amount, 0, ',', '.') }}
                                    @else
                                        Diskon {{ $voucher->discount_amount }}%
                                    @endif
                                </h3>
                                <p>Gunakan kode voucher berikut saat checkout.</p>
                                <div class="voucher-code">
                                    <span id="voucher-{{ $voucher->id }}">{{ $voucher->code }}</span>
                                    <button type="button" onclick="copyVoucher('{{ $voucher->code }}')">
                                        <i class="fas fa-copy"></i> Salin
                                    </button>
                                </div>
                                <small>
                                    Berlaku sampai
                                    {{ \Carbon\Carbon::parse($voucher->expired_date)->format('d F Y') }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Pesan jika tidak ada voucher aktif --}}
                <div class="text-center py-5">
                    <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada promo aktif saat ini. Silakan cek nanti!</p>
                </div>
            @endif
        </div>
    </section>

    {{-- STATS --}}
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-3 stat-item" data-count="1984">
                    <i class="fas fa-calendar-alt stat-icon"></i>
                    <div class="stat-value"><span class="counter">0</span></div>
                    <div class="stat-label">Sejak Berdiri</div>
                </div>
                <div class="col-6 col-md-3 stat-item" data-count="100">
                    <i class="fas fa-leaf stat-icon"></i>
                    <div class="stat-value"><span class="counter">0</span>%</div>
                    <div class="stat-label">Singkong Alami</div>
                </div>
                <div class="col-6 col-md-3 stat-item" data-count="50">
                    <i class="fas fa-users stat-icon"></i>
                    <div class="stat-value"><span class="counter">0</span>k+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
                <div class="col-6 col-md-3 stat-item" data-count="3">
                    <i class="fas fa-tags stat-icon"></i>
                    <div class="stat-value"><span class="counter">0</span></div>
                    <div class="stat-label">Varian Rasa Khas</div>
                </div>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section>
        <div class="container">
            <div class="text-center mb-5">
                <span class="eyebrow"><i class="fas fa-star me-1"></i> Kenapa Sanjaiku</span>
                <h2>Kenapa Memilih Sanjaiku?</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrap bg-warning-soft">
                                <i class="fas fa-pepper-hot fa-2x text-warning"></i>
                            </div>
                            <h4>Rasa Autentik</h4>
                            <p class="text-muted">Dibuat menggunakan resep khas Payakumbuh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrap bg-success-soft">
                                <i class="fas fa-award fa-2x text-success"></i>
                            </div>
                            <h4>Kualitas Terbaik</h4>
                            <p class="text-muted">Bahan baku pilihan dan selalu fresh.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100">
                        <div class="card-body p-4">
                            <div class="feature-icon-wrap bg-primary-soft">
                                <i class="fas fa-truck fa-2x text-primary"></i>
                            </div>
                            <h4>Pengiriman Cepat</h4>
                            <p class="text-muted">Produk dikemas dengan aman dan rapi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- PRODUK TERBARU --}}
    <section class="bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end section-head mb-5">
                <div>
                    <span class="eyebrow"><i class="fas fa-box-open me-1"></i> Pilihan Kami</span>
                    <h2>Produk Terbaru</h2>
                </div>
                <a href="{{ route('products') }}" class="link-more">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="row">
                @forelse($products->take(3) as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card product-card h-100">
                            <div class="product-media">
                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                     class="card-img-top"
                                     style="height:280px;object-fit:cover;"
                                     alt="{{ $product->name }}">
                                <div class="product-overlay">
                                    <h5>{{ $product->name }}</h5>
                                    <p>{{ Str::limit($product->description, 70) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('products.detail', $product->slug) }}"
                               class="product-detail-btn"
                               title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state d-flex align-items-center gap-2">
                            <i class="fas fa-exclamation-triangle"></i>
                            Belum ada produk.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CRAFTED WITH CULTURE --}}
    <section class="culture-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="culture-copy">
                        <span class="eyebrow"><i class="fas fa-handshake me-1"></i> Janji Kami</span>
                        <h2>Dibuat dengan Budaya.</h2>
                        <p class="text-muted mt-3" style="max-width:34rem;">
                            Kami menjaga keaslian warisan Minangkabau di setiap gigitan.
                            Singkong kami dipilih langsung dari petani terbaik Sumatera Barat,
                            memastikan tekstur sempurna sebelum diiris dan digoreng hingga
                            keemasan.
                        </p>
                        <div class="culture-point">
                            <div class="culture-point-icon"><i class="fas fa-leaf"></i></div>
                            <div>
                                <h6>100% Bahan Alami</h6>
                                <p>Tanpa pengawet atau pewarna buatan. Murni rempah pilihan.</p>
                            </div>
                        </div>
                        <div class="culture-point">
                            <div class="culture-point-icon"><i class="fas fa-fire"></i></div>
                            <div>
                                <h6>Metode Tradisional</h6>
                                <p>Dimasak dengan cara turun-temurun untuk aroma yang khas.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="culture-media">
                        <picture>
                            <source srcset="{{ asset('storage/foto_landingpage/fix.webp') }}" type="image/webp">
                            <img src="{{ asset('storage/foto_landingpage/kedua.jpg') }}"
                                 alt="Proses memasak Sanjai"
                                 width="495" height="278"
                                 loading="lazy">
                        </picture>
                        <div class="culture-badge">
                            <span><i class="fas fa-shield-alt"></i>Asli<br>Payakumbuh</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    <section>
        <div class="container">

            <div class="text-center mb-5">
                <span class="eyebrow">
                    <i class="fas fa-comment-dots me-1"></i> Kata Mereka
                </span>

                <h2>Apa Kata Pelanggan?</h2>

                <p class="text-muted section-subtitle mt-3">
                    Testimoni pelanggan yang telah membeli Kerupuk Sanjai.
                </p>
            </div>

            <div class="row">

                @forelse($testimonials as $testimonial)

                    <div class="col-lg-4 mb-4">

                        <div class="card testi-card h-100">

                            <div class="card-body">

                                <div class="mb-3">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $testimonial->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif

                                    @endfor

                                </div>

                                <p class="text-muted">
                                    <i class="fas fa-quote-left me-1 text-warning"
                                       style="font-size:0.8rem;"></i>
                                    {{ $testimonial->review }}
                                </p>

                            </div>

                            <div class="card-footer">

                                <i class="fas fa-user-circle me-1"></i>

                                <strong>
                                    {{ $testimonial->user->name ?? 'Pelanggan' }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    <i class="far fa-calendar me-1"></i>
                                    {{ $testimonial->created_at->format('d M Y') }}
                                </small>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="empty-state d-flex align-items-center gap-2">

                            <i class="fas fa-info-circle"></i>

                            Belum ada testimoni.

                        </div>

                    </div>

                @endforelse

            </div>

        </div>
    </section>

    {{-- TOAST NOTIFICATION --}}
    <div class="toast-notification" id="toastNotification">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Kode voucher berhasil disalin!</span>
        <button class="toast-close" onclick="hideToast()">&times;</button>
    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ---------- SCROLL REVEAL + COUNTER ----------
        const revealElements = document.querySelectorAll('.stat-item, .feature-card, .product-card, .testi-card, .culture-copy, .culture-media');
        const counterElements = document.querySelectorAll('.stat-item .counter');

        function animateCounter(element, target) {
            let current = 0;
            const increment = Math.ceil(target / 60);
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = current;
            }, 20);
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    el.classList.add('reveal');

                    if (el.classList.contains('stat-item')) {
                        const count = parseInt(el.getAttribute('data-count'), 10);
                        const counterSpan = el.querySelector('.counter');
                        if (counterSpan && !isNaN(count)) {
                            animateCounter(counterSpan, count);
                        }
                    }

                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => observer.observe(el));

    });

    // ---------- TOAST NOTIFICATION ----------
    const toast = document.getElementById('toastNotification');
    const toastMessage = document.getElementById('toastMessage');
    let toastTimeout = null;

    function showToast(message, isSuccess = true) {
        toastMessage.textContent = message;
        const icon = toast.querySelector('i');
        if (isSuccess) {
            icon.className = 'fas fa-check-circle';
            icon.style.color = 'var(--sj-green)';
        } else {
            icon.className = 'fas fa-exclamation-circle';
            icon.style.color = '#e74c3c';
        }
        toast.classList.add('show');
        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(hideToast, 3000);
    }

    function hideToast() {
        toast.classList.remove('show');
        clearTimeout(toastTimeout);
    }

    // ---------- SALIN VOUCHER ----------
    window.copyVoucher = function(code) {
        const btn = event.target.closest('button');
        const originalHtml = btn.innerHTML;

        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(code)
                .then(() => {
                    showToast('Kode voucher ' + code + ' berhasil disalin!', true);
                    btn.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin';
                    btn.style.background = '#009844';
                    setTimeout(() => {
                        btn.innerHTML = originalHtml;
                        btn.style.background = '';
                    }, 2000);
                })
                .catch(() => {
                    fallbackCopy(code);
                });
        } else {
            fallbackCopy(code);
        }
    };

    function fallbackCopy(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            showToast('Kode voucher ' + text + ' berhasil disalin!', true);
        } catch (err) {
            showToast('Gagal menyalin, silakan salin manual.', false);
        }
        document.body.removeChild(textArea);
    }
</script>
@endpush