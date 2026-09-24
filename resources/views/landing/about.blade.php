@extends('layouts.landing')

@section('title', 'Tentang Kami')

@push('styles')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@500;600&display=swap">

<style>
    /* =====================================================
       SANJAIKU — TENTANG KAMI
       Satu sistem desain dengan home.blade.php: Cloud White
       + Ink + Navy gelap + satu aksen Biru, label mono huruf
       kecil, garis tipis sebagai elemen struktur.
       Di-scope ke .about-wrapper agar halaman lain aman.
       ===================================================== */

    .about-wrapper {
        --ab-ink: #12151a;
        --ab-ink-soft: #4a4f58;
        --ab-navy: #10182b;
        --ab-navy-2: #1b2438;
        --ab-blue: #2f5fe0;
        --ab-cream: #f4f5f7;
        --ab-line: rgba(18, 21, 26, .10);
        --ab-muted: #7a7e88;
        --ab-clay: #c97d49;
        --ab-clay-dark: #7b4124;
        --ab-gold: #e7b860;

        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: var(--ab-cream);
        color: var(--ab-ink);
        overflow-x: hidden;
    }

    .about-wrapper h1,
    .about-wrapper h2,
    .about-wrapper h3 {
        font-weight: 800;
        letter-spacing: -0.02em;
        color: var(--ab-ink);
    }

    .about-wrapper .eyebrow {
        display: inline-block;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.16em;
        color: var(--ab-blue);
        margin-bottom: 0.85rem;
    }

    .about-wrapper section {
        padding: 5.5rem 0;
    }

    /* ============ HERO ============ */
    .about-wrapper .about-hero-section {
        padding: 2rem 0 0;
    }

    .about-wrapper .about-hero {
        position: relative;
        overflow: hidden;
        border-radius: 1.25rem;
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background:
            linear-gradient(180deg, rgba(16, 17, 23, 0.65), rgba(11, 12, 17, 0.92)),
            url('https://i.ibb.co.com/My6b3MdJ/download-36.jpg');
        background-size: cover;
        background-position: center;
        will-change: transform;
        transition: background-position 0.1s linear;
    }

    .about-wrapper .about-hero-inner {
        max-width: 720px;
        padding: 4rem 2rem;
        opacity: 0;
        transform: translateY(40px);
        animation: heroFadeIn 0.9s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        animation-delay: 0.2s;
    }

    @keyframes heroFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .about-wrapper .about-hero h1 {
        font-size: clamp(1.9rem, 4.6vw, 3rem);
        line-height: 1.15;
        color: #fff;
        margin: 0;
    }

    .about-wrapper .about-hero p {
        margin: 1.4rem auto 0;
        max-width: 34rem;
        color: rgba(255, 255, 255, .82);
        font-size: 1.02rem;
        line-height: 1.65;
    }

    /* ============ ARTIKEL ============ */
    .about-wrapper .article-head h2 {
        font-size: clamp(1.6rem, 3vw, 2.1rem);
        max-width: 32rem;
        line-height: 1.2;
    }

    .about-wrapper .article-card {
        background: var(--ab-navy);
        border-radius: 1.1rem;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.35s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.35s cubic-bezier(0.23, 1, 0.32, 1);
        will-change: transform;
    }

    .about-wrapper .article-card:hover {
        transform: translateY(-8px) scale(1.01);
        box-shadow: 0 20px 40px rgba(16, 24, 43, 0.30), 0 0 0 1px rgba(47, 95, 224, 0.15);
    }

    .about-wrapper .article-media {
        position: relative;
        height: 140px;
        overflow: hidden;
        background:
            linear-gradient(0deg, rgba(16, 12, 8, .30), rgba(16, 12, 8, .05)),
            radial-gradient(circle at 30% 25%, rgba(255, 255, 255, .18), transparent 12%),
            linear-gradient(140deg, #e9b96b 0%, var(--ab-clay) 55%, var(--ab-clay-dark) 100%);
    }

    .about-wrapper .article-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .about-wrapper .article-card:hover .article-media img {
        transform: scale(1.05);
    }

    .about-wrapper .article-media.is-accent {
        background: var(--ab-gold);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .about-wrapper .article-media.is-accent i {
        font-size: 2.4rem;
        color: var(--ab-navy);
    }

    .about-wrapper .article-body {
        padding: 1.2rem 1.1rem 1.1rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .about-wrapper .article-card h3 {
        font-size: 0.92rem;
        line-height: 1.3;
        color: #fff;
        margin-bottom: 0.55rem;
    }

    .about-wrapper .article-card p {
        font-size: 0.8rem;
        line-height: 1.55;
        color: #b9bfcb;
        margin-bottom: 0;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .about-wrapper .article-link {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        margin-top: 1rem;
        align-self: flex-end;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.68rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #fff;
        text-decoration: none;
        position: relative;
        transition: color 0.3s ease;
    }

    .about-wrapper .article-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1.5px;
        background: var(--ab-gold);
        transition: width 0.3s ease;
    }

    .about-wrapper .article-link:hover::after {
        width: 100%;
    }

    .about-wrapper .article-link i {
        transition: transform 0.2s ease;
    }

    .about-wrapper .article-link:hover i {
        transform: translateX(4px);
    }

    /* ============ STATS ============ */
    .about-wrapper .about-stats {
        padding: 0;
        margin-bottom: 4rem;
        border-top: 1px solid var(--ab-line);
        border-bottom: 1px solid var(--ab-line);
        position: relative;
        overflow: hidden;
    }

    /* Efek shimmer pada garis stats (opsional) */
    .about-wrapper .about-stats::before {
        content: '';
        position: absolute;
        top: -1px;
        left: -100%;
        width: 60%;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--ab-blue), transparent);
        animation: shimmerLine 5s infinite linear;
        opacity: 0.3;
    }

    @keyframes shimmerLine {
        0% { left: -60%; }
        100% { left: 120%; }
    }

    .about-wrapper .about-stats .row {
        --bs-gutter-x: 0;
    }

    .about-wrapper .stat-item {
        text-align: center;
        padding: 2.5rem 0.75rem;
        border-right: 1px solid var(--ab-line);
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.23, 1, 0.32, 1);
    }

    .about-wrapper .stat-item.reveal {
        opacity: 1;
        transform: translateY(0);
    }

    .about-wrapper .stat-item:last-child {
        border-right: none;
    }

    .about-wrapper .stat-value {
        font-weight: 800;
        font-size: clamp(1.6rem, 2.8vw, 2.25rem);
        letter-spacing: -0.02em;
        color: var(--ab-ink);
        line-height: 1.1;
    }

    .about-wrapper .stat-label {
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.68rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--ab-muted);
        margin-top: 0.6rem;
    }

    /* ============ SCROLL REVEAL UNTUK ARTIKEL ============ */
    .about-wrapper .article-card {
        opacity: 0;
        transform: translateY(40px) scale(0.96);
        transition: opacity 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    transform 0.8s cubic-bezier(0.23, 1, 0.32, 1),
                    box-shadow 0.35s ease, border-color 0.35s ease;
    }

    .about-wrapper .article-card.reveal {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Delay bertingkat untuk kartu */
    .about-wrapper .article-card:nth-child(1) { transition-delay: 0.05s; }
    .about-wrapper .article-card:nth-child(2) { transition-delay: 0.15s; }
    .about-wrapper .article-card:nth-child(3) { transition-delay: 0.25s; }
    .about-wrapper .article-card:nth-child(4) { transition-delay: 0.35s; }

    /* ============ RESPONSIF ============ */
    @media (max-width: 767.98px) {
        .about-wrapper section {
            padding: 4rem 0;
        }

        .about-wrapper .about-hero-section {
            padding: 1.5rem 0 0;
        }

        .about-wrapper .about-hero {
            border-radius: 1.1rem;
            min-height: 380px;
        }

        .about-wrapper .about-hero-inner {
            padding: 3rem 1.5rem;
        }

        .about-wrapper .stat-item {
            border-right: none;
            border-bottom: 1px solid var(--ab-line);
        }

        .about-wrapper .about-stats .col-6:nth-last-child(-n+2) .stat-item {
            border-bottom: none;
        }
    }
</style>

@endpush

@section('content')

<div class="about-wrapper">

    {{-- HERO --}}
    <section class="about-hero-section">
        <div class="container">

            <div class="about-hero" id="aboutHero">

                <div class="about-hero-inner">

                    <h1>Menjaga Warisan Rasa Minangkabau.</h1>

                    <p>
                        Sejak 2026, Sanjaiku berkomitmen menghadirkan keotentikan
                        keripik sanjai langsung dari Payakumbuh ke tangan Anda,
                        dengan sentuhan modern tanpa menghilangkan akar tradisi.
                    </p>

                </div>

            </div>

        </div>
    </section>

    {{-- STATS --}}
    <section class="about-stats" id="statsSection">
        <div class="container">

            <div class="row">

                <div class="col-6 col-md-3">
                    <div class="stat-item" data-count="1984">
                        <div class="stat-value"><span class="counter">0</span></div>
                        <div class="stat-label">Tahun Berdiri</div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-item" data-count="50">
                        <div class="stat-value"><span class="counter">0</span>+</div>
                        <div class="stat-label">Mitra Petani Lokal</div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-item" data-count="100">
                        <div class="stat-value"><span class="counter">0</span>%</div>
                        <div class="stat-label">Singkong Pilihan</div>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="stat-item" data-count="3">
                        <div class="stat-value"><span class="counter">0</span></div>
                        <div class="stat-label">Varian Rasa</div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- ARTIKEL --}}
    <section>
        <div class="container">

            <div class="article-head mb-4">

                <span class="eyebrow">Artikel</span>

                <h2>Cerita di setiap kerupuk sanjai.</h2>

            </div>

            <div class="row g-4">

                <div class="col-lg-3 col-md-6">
                    <div class="article-card">
                        <div class="article-media">
                            <img src="https://i.ibb.co.com/HDvq6G0F/Kerupuk-Sanjai-Asli-Bukit-Tinggi-Makanan-Cemilan-Minang-1-kg-Kerupuk-Singkong-1.jpg" alt="Proses pembuatan keripik sanjai">
                        </div>
                        <div class="article-body">
                            <h3>Karupuak Sanjai: Keripik Singkong Tersohor dari Payakumbuh</h3>
                            <p>
                                Bertandang ke Payakumbuh apalah artinya tanpa membawa pulang keripik Sanjai yang otentik itu Kuliner
                            </p>
                            <a href="https://indonesiakaya.com/pustaka-indonesia/karupuak-sanjai-keripik-renyah-menggoda-khas-bukittinggi/" class="article-link" target="_blank" rel="noopener">
                                Baca selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="article-card">
                        <div class="article-media">
                            <img src="https://i.ibb.co.com/Xfwy6M5n/Makanan-Khas-Bukittingi-yang-Menggoda-Selera.jpg" alt="Bumbu balado khas Bukittinggi">
                        </div>
                        <div class="article-body">
                            <h3>Resep Keripik sanjai minang</h3>
                            <p>
                                Perpaduan cabai merah, bawang, dan gula aren yang
                                dimasak perlahan menghasilkan rasa pedas manis
                                yang jadi ciri khas keripik sanjai Sanjaiku.
                            </p>
                            <a href="https://cookpad.com/id/resep/24539547?ref=search&search_term=keripik+sanjai+padang" class="article-link" target="_blank" rel="noopener">
                                Baca selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="article-card">
                        <div class="article-media">
                            <img src="https://i.ibb.co.com/CsPRJnbX/98e12a90-dc5c-11ef-95f4-cf591c220b60-jpg.webp" alt="Petani Singkong">
                        </div>
                        <div class="article-body">
                            <h3>Indonesia disebut kebanjiran singkong impor</h3>
                            <p>
                               Pemerintah selama ini belum menjadikan singkong atau ubi kayu sebagai komoditas prioritas yang perlu dijaga dari gempuran pangan impor, kata dosen ilmu administrasi negara Universitas Lampung, Dedi Hermawan.
                            </p>
                            <a href="https://www.bbc.com/indonesia/articles/cn0yrl640dyo" class="article-link" target="_blank" rel="noopener">
                                Baca selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="article-card">
                        <div class="article-media">
                            <img src="https://img.antaranews.com/cache/1200x800/2026/03/31/file_000000001234722fb93482cc64085b20.png.webp" alt="Bumbu balado khas Bukittinggi">
                        </div>
                        <div class="article-body">
                            <h3>Keripik Sanjai Bukittinggi laris manis selama Libur Lebaran 2026</h3>
                            <p>
                                Keripik Sanjai yang merupakan makanan ringan khas oleh-oleh Kota Bukittinggi mengalami peningkatan permintaan selama libur Lebaran 2026, berbeda dengan tahun sebelumnya yang terkendala kelangkaan bahan baku
                            </p>
                            <a href="https://sumbar.antaranews.com/berita/754899/keripik-sanjai-bukittinggi-laris-manis-selama-libur-lebaran-2026" class="article-link" target="_blank" rel="noopener">
                                Baca selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // ---------- PARALLAX HERO ----------
        const hero = document.getElementById('aboutHero');
        if (hero) {
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const rate = scrolled * 0.3;
                hero.style.backgroundPosition = `center ${rate}px`;
            }, { passive: true });
        }

        // ---------- SCROLL REVEAL + COUNTER ----------
        const revealElements = document.querySelectorAll('.stat-item, .article-card');
        const counterElements = document.querySelectorAll('.stat-item .counter');

        // Fungsi untuk menjalankan counter
        function animateCounter(element, target, suffix = '') {
            let current = 0;
            const increment = Math.ceil(target / 60); // 60 frame
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = current;
            }, 20);
        }

        // Observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;

                    // Reveal animasi
                    el.classList.add('reveal');

                    // Jika stat-item, jalankan counter
                    if (el.classList.contains('stat-item')) {
                        const count = parseInt(el.getAttribute('data-count'), 10);
                        const counterSpan = el.querySelector('.counter');
                        if (counterSpan && !isNaN(count)) {
                            animateCounter(counterSpan, count);
                        }
                    }

                    // Hentikan observasi setelah muncul
                    observer.unobserve(el);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => observer.observe(el));

        // ---------- TOMBOL "Baca selengkapnya" efek tambahan (opsional) ----------
        // Sudah ada di CSS

    });
</script>
@endpush