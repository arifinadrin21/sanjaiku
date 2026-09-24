@extends('layouts.landing')

@section('title', 'Kontak')

@push('styles')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500&display=swap">

<style>
    /* =====================================================
       SANJAIKU — KONTAK
       Sistem desain yang sama dengan home.blade.php
       ("Heritage Pulse"): Midnight Navy + Vibrant Blue +
       Fresh Green di atas Cloud White. Di-scope ke
       .contact-wrapper agar halaman lain tidak ikut berubah.
       ===================================================== */

    .contact-wrapper {
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
    }

    .contact-wrapper h1,
    .contact-wrapper h2,
    .contact-wrapper h4,
    .contact-wrapper h5 {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: var(--sj-ink);
    }

    .contact-wrapper h2 {
        font-size: clamp(1.75rem, 3.2vw, 2.5rem);
        line-height: 1.15;
    }

    .contact-wrapper .text-muted {
        color: var(--sj-muted) !important;
    }

    .contact-wrapper section {
        padding: 4rem 0 6rem;
    }

    .contact-wrapper .eyebrow {
        display: inline-block;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.14em;
        color: var(--sj-blue);
        margin-bottom: 0.85rem;
    }

    /* ============ HERO ============ */
    .contact-wrapper .contact-hero {
        padding: 3rem 0 1rem;
        text-align: center;
    }

    .contact-wrapper .contact-hero h1 {
        font-size: clamp(2.25rem, 5vw, 3.1rem);
        line-height: 1.12;
        letter-spacing: -0.025em;
    }

    .contact-wrapper .contact-hero p {
        font-size: 1.0625rem;
        line-height: 1.6;
        max-width: 38rem;
        margin: 1rem auto 0;
    }

    /* ============ TOMBOL ============ */
    .contact-wrapper .btn-orange {
        background: var(--sj-blue);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 0.9rem;
        padding: 0.85rem 1.6rem;
        box-shadow: 0 10px 24px -12px rgba(0, 81, 213, 0.85);
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .contact-wrapper .btn-orange:hover {
        background: var(--sj-blue-deep);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 16px 32px -12px rgba(0, 81, 213, 0.9);
    }

    /* ============ FORM CARD ============ */
    .contact-wrapper .form-card {
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        background: #fff;
        padding: 2.5rem;
        height: 100%;
    }

    .contact-wrapper .form-card h2 {
        font-size: 1.5rem;
        margin-bottom: 1.75rem;
    }

    .contact-wrapper .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--sj-ink);
        margin-bottom: 0.5rem;
    }

    .contact-wrapper .form-control {
        border: 1px solid var(--sj-line);
        border-radius: 0.7rem;
        padding: 0.7rem 0.9rem;
        font-size: 0.925rem;
        color: var(--sj-ink);
    }

    .contact-wrapper .form-control:focus {
        border-color: var(--sj-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 81, 213, 0.12);
    }

    .contact-wrapper .form-control::placeholder {
        color: #a7abb3;
    }

    /* ============ INFO KONTAK (kartu navy) ============ */
    .contact-wrapper .info-card {
        position: relative;
        overflow: hidden;
        border-radius: 1.25rem;
        color: #fff;
        background: linear-gradient(135deg, var(--sj-navy) 0%, var(--sj-navy-2) 100%);
        padding: 2.25rem;
        margin-bottom: 1.5rem;
    }

    .contact-wrapper .info-card::before {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: 0.05;
        background-image:
            repeating-linear-gradient(45deg, #fff 0 2px, transparent 2px 15px),
            repeating-linear-gradient(-45deg, #fff 0 2px, transparent 2px 15px);
    }

    .contact-wrapper .info-card h2 {
        position: relative;
        z-index: 1;
        font-size: 1.35rem;
        color: #fff;
        margin-bottom: 1.5rem;
    }

    .contact-wrapper .info-row {
        position: relative;
        z-index: 1;
        display: flex;
        gap: 0.9rem;
        align-items: flex-start;
        margin-bottom: 1.25rem;
    }

    .contact-wrapper .info-row:last-child {
        margin-bottom: 0;
    }

    .contact-wrapper .info-icon-wrap {
        flex: none;
        width: 40px;
        height: 40px;
        border-radius: 0.7rem;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .contact-wrapper .info-icon-wrap.is-green { color: #3fcb7a; }
    .contact-wrapper .info-icon-wrap.is-blue { color: var(--sj-blue-bright); }

    .contact-wrapper .info-row strong {
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 0.2rem;
    }

    .contact-wrapper .info-row p,
    .contact-wrapper .info-row a {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.72);
        line-height: 1.55;
        margin: 0;
    }

    .contact-wrapper .info-row a:hover {
        color: #fff;
    }

    /* ============ MAP CARD ============ */
    .contact-wrapper .map-card {
        border: 1px solid var(--sj-line);
        border-radius: 1.25rem;
        overflow: hidden;
        background: #fff;
    }

    .contact-wrapper .map-card iframe {
        width: 100%;
        height: 260px;
        display: block;
        border: 0;
    }

    .contact-wrapper .map-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--sj-line);
        font-size: 0.9rem;
        font-weight: 600;
    }

    .contact-wrapper .map-bar a {
        color: var(--sj-blue);
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .contact-wrapper .map-bar a:hover {
        color: var(--sj-blue-deep);
    }

    /* ============ EMPTY STATE (reuse) ============ */
    .contact-wrapper .empty-state {
        border: 1px dashed var(--sj-line);
        border-radius: 1.25rem;
        background: var(--sj-surface-low);
        color: var(--sj-muted);
        padding: 1.5rem;
        font-size: 0.9rem;
    }

    /* ============ RESPONSIF ============ */
    @media (max-width: 991.98px) {
        .contact-wrapper .form-card {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .contact-wrapper section {
            padding: 3rem 0 4rem;
        }

        .contact-wrapper .form-card,
        .contact-wrapper .info-card {
            padding: 1.75rem;
        }
    }
</style>

@endpush

@section('content')

<div class="contact-wrapper">

    {{-- HERO --}}
    <section class="contact-hero pb-0">
        <div class="container">

            <span class="eyebrow">Mari Terhubung</span>

            <h1>Hubungi Kami</h1>

            <p class="text-muted">
                Kami siap membantu Anda. Jangan ragu untuk menghubungi kami melalui
                formulir di bawah ini atau kunjungi toko fisik kami di Bukittinggi.
            </p>

        </div>
    </section>

    {{-- FORM + INFO --}}
    <section class="pt-0">
        <div class="container">

            <div class="row g-4">

                {{-- FORM --}}
                <div class="col-lg-7">

                    <div class="form-card">

                        <h2>Kirim Pesan</h2>

                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Masukkan alamat email" required>
                            </div>

                            <div class="mb-4">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea id="message" name="message" rows="5" class="form-control"
                                    placeholder="Tuliskan pesan Anda di sini..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-orange btn-lg">
                                <span>Kirim Pesan</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>

                        </form>

                    </div>

                </div>

                {{-- INFO KONTAK + MAP --}}
                <div class="col-lg-5">

                    <div class="info-card">

                        <h2>Informasi Kontak</h2>

                        <div class="info-row">
                            <div class="info-icon-wrap is-green">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <strong>Toko Fisik Sanjaiku</strong>
                                <p>Jl. Pasar Atas No. 12, Kel. Guguk Panjang,<br>Bukittinggi, Sumatra Barat 26136</p>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-icon-wrap is-green">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <a href="https://wa.me/6281234567890">+62 812-3456-7890 (WhatsApp)</a>
                        </div>

                        <div class="info-row">
                            <div class="info-icon-wrap is-blue">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="mailto:halo@sanjaiku.id">halo@sanjaiku.id</a>
                        </div>

                    </div>

                    <div class="map-card">

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39910.07!2d100.367!3d-0.305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e54400000000001%3A0x0!2zQnVraXR0aW5nZ2ksIFdlc3QgU3VtYXRyYQ!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Sanjaiku Bukittinggi"></iframe>

                        <div class="map-bar">
                            <span>Lihat di Google Maps</span>
                            <a href="https://maps.google.com/?q=Bukittinggi,Sumatra+Barat" target="_blank" rel="noopener">
                                Buka <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>

</div>

@endsection