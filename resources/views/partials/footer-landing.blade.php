<footer class="sj-footer pt-5 pb-4">
    <div class="container">
        <div class="row g-4">

            <!-- Brand & Deskripsi -->
            <div class="col-lg-4 col-md-6 sj-footer-brand">
                <h4 class="sj-footer-logo mb-3">Sanjaiku</h4>
                <p class="sj-footer-desc mb-3">
                    UMKM Kerupuk Sanjai khas Payakumbuh, menghadirkan cita rasa tradisional yang renyah dan autentik.
                </p>
              <div class="sj-social-icons mt-3">
    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
    <a href="#" title="YouTube"><i class="fab fa-youtube"></i></a>

    <a href="https://www.tiktok.com/@thevinnverse"
       target="_blank"
       rel="noopener noreferrer"
       title="TikTok">
        <i class="fab fa-tiktok"></i>
    </a>
</div>
            </div>

            <!-- Menu -->
            <div class="col-lg-2 col-md-6">
                <h5 class="sj-footer-heading">Menu</h5>
                <ul class="list-unstyled sj-footer-menu">
                    <li class="mb-2">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('products') }}">Produk</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}">Tentang</a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-3 col-md-6">
                <h5 class="sj-footer-heading">Hubungi Kami</h5>
                <ul class="list-unstyled sj-footer-contact">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt me-3 mt-1"></i>
                        <span>Payakumbuh, Sumatera Barat</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-phone-alt me-3"></i>
                        <span>0838-6778-3171</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fas fa-envelope me-3"></i>
                        <span>arifinadrin@gmail.com</span>
                    </li>
                </ul>
            </div>

            <!-- Jam Operasional / Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="sj-footer-heading">Jam Operasional</h5>
                <ul class="list-unstyled sj-footer-hours">
                    <li class="mb-2 d-flex justify-content-between">
                        <span>Senin – Jumat</span>
                        <span>08.00 – 15.00</span>
                    </li>
                    <li class="mb-2 d-flex justify-content-between">
                        <span>Sabtu – Minggu</span>
                        <span>08.00 – 18.00</span>
                    </li>
                    
                </ul>
                
            </div>

        </div>

        <hr class="sj-footer-divider my-4">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <span class="sj-footer-copy">
                    &copy; {{ date('Y') }} <span class="sj-footer-copy-brand">Sanjaiku</span>. Authentically Minangkabau.
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="sj-footer-copy">
                    Dibangun   untuk Payakumbuh
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
    .sj-footer {
        --sj-ink: #191c1e;
        --sj-muted: #6b7280;
        --sj-line: #e5e7eb;
        --sj-blue: #0051d5;
        --sj-bg: #f3f4f6;

        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: var(--sj-bg);
        color: var(--sj-ink);
    }

    .sj-footer-logo {
        font-weight: 800;
        font-size: 1.3rem;
        letter-spacing: -0.02em;
        color: var(--sj-ink);
        margin: 0 0 12px;
    }

    .sj-footer-desc {
        color: var(--sj-muted);
        font-size: 0.92rem;
        line-height: 1.6;
        max-width: 340px;
    }

    .sj-social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        margin-right: 8px;
        background: #fff;
        border: 1px solid var(--sj-line);
        color: var(--sj-ink);
        font-size: 0.9rem;
        transition: background .15s ease, color .15s ease, border-color .15s ease;
    }

    .sj-social-icons a:hover {
        background: var(--sj-blue);
        border-color: var(--sj-blue);
        color: #fff;
    }

    .sj-footer-heading {
        font-family: 'Courier New', monospace;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--sj-muted);
        margin-bottom: 16px;
    }

    .sj-footer-menu a,
    .sj-footer-contact span {
        color: var(--sj-muted);
        text-decoration: none;
        font-size: 0.92rem;
        transition: color .15s ease;
    }

    .sj-footer-menu a:hover {
        color: var(--sj-blue);
    }

    .sj-footer-contact i {
        color: var(--sj-ink);
        width: 16px;
        text-align: center;
        font-size: 0.85rem;
    }

    .sj-footer-hours {
        color: var(--sj-muted);
        font-size: 0.9rem;
    }

    .sj-footer-closed {
        color: #dc2626;
        font-weight: 600;
    }

    .sj-newsletter p {
        color: var(--sj-muted);
        font-size: 0.88rem;
    }

    .sj-newsletter-input {
        background: #fff;
        border: 1px solid var(--sj-line);
        font-size: 0.88rem;
    }

    .sj-newsletter-input:focus {
        box-shadow: none;
        border-color: var(--sj-blue);
    }

    .sj-newsletter-btn {
        background: var(--sj-ink);
        color: #fff;
        font-weight: 600;
        font-size: 0.85rem;
        border: none;
        padding: 0 16px;
    }

    .sj-newsletter-btn:hover {
        background: #000;
        color: #fff;
    }

    .sj-footer-divider {
        border-color: var(--sj-line);
        opacity: 1;
    }

    .sj-footer-copy {
        color: var(--sj-muted);
        font-size: 0.85rem;
    }

    .sj-footer-copy-brand {
        color: var(--sj-ink);
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .sj-footer-brand,
        .sj-social-icons {
            text-align: center;
        }

        .sj-footer-desc {
            max-width: none;
        }
    }
</style>