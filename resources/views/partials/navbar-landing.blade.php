<style>
    /* =====================================================
       SANJAIKU — NAVBAR
       Scoped to .sj-navbar so other pages/partials are
       untouched. Matches the reference design: light flat
       bar, centered nav with blue active underline, and
       right-aligned circular icon actions.
       ===================================================== */

    .sj-navbar {
        --sj-ink: #191c1e;
        --sj-navy: #131b2e;
        --sj-blue: #0051d5;
        --sj-blue-deep: #003ea8;
        --sj-muted: #6b7280;
        --sj-line: #e6e8ea;
        --sj-bg: #f8f9fb;

        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background: var(--sj-bg);
        padding-top: 1.1rem;
        padding-bottom: 1.1rem;
        border-bottom: 1px solid var(--sj-line);
        box-shadow: none !important;
    }

    .sj-navbar .navbar-brand {
        font-weight: 800;
        font-size: 1.3rem;
        letter-spacing: -0.02em;
        color: var(--sj-ink) !important;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sj-navbar .navbar-brand i {
        display: none;
    }

    /* Centered main nav */
    .sj-navbar .navbar-nav.sj-main-nav {
        gap: 0.5rem;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .sj-navbar .nav-link {
        color: var(--sj-muted);
        font-weight: 500;
        font-size: 0.95rem;
        padding: 0.4rem 0.9rem !important;
        border-radius: 0.5rem;
        transition: color .15s ease, background .15s ease;
        position: relative;
    }

    .sj-navbar .nav-link:hover {
        color: var(--sj-ink);
    }

    .sj-navbar .nav-link.active {
        color: var(--sj-blue);
        font-weight: 600;
    }

    .sj-navbar .nav-link.active::after {
        content: '';
        position: absolute;
        left: 0.9rem;
        right: 0.9rem;
        bottom: -2px;
        height: 2px;
        background: var(--sj-blue);
        border-radius: 2px;
    }

    /* Right-side icon actions */
    .sj-navbar .sj-actions {
        gap: 0.35rem;
    }

    .sj-navbar .nav-icon-link,
    .sj-navbar .nav-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        color: var(--sj-ink);
        background: transparent;
        border: none;
        font-size: 1rem;
        transition: background .15s ease, color .15s ease;
    }

    .sj-navbar .nav-icon-link:hover,
    .sj-navbar .nav-icon-btn:hover {
        background: rgba(19, 27, 46, 0.07);
        color: var(--sj-blue);
    }

    .sj-navbar .nav-icon-wrap {
        position: relative;
    }

    .sj-navbar form.nav-icon-form {
        display: inline-flex;
        margin: 0;
    }

    /* Cart item-count badge */
    .sj-navbar .sj-cart-badge {
        position: absolute;
        top: 2px;
        right: 2px;
        min-width: 16px;
        height: 16px;
        padding: 0 3px;
        border-radius: 50%;
        background: var(--sj-blue);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        line-height: 16px;
        text-align: center;
    }

    .sj-navbar .btn-orange {
        background: var(--sj-blue);
        border: none;
        color: #fff !important;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 0.75rem;
        padding: 0.55rem 1.25rem;
        transition: background .15s ease, transform .15s ease;
    }

    .sj-navbar .btn-orange:hover {
        background: var(--sj-blue-deep);
        transform: translateY(-1px);
    }

    /* =========================
       LOGOUT BUTTON (dipakai di dalam .sj-navbar, ikutin gaya nav-icon lain)
    ========================= */
    .sj-navbar .logout-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: transparent;
        border: none;
        color: var(--sj-ink);
        font-size: 1rem;
        cursor: pointer;
        transition: background .15s ease, color .15s ease;
    }
    .sj-navbar .logout-btn:hover {
        background: rgba(220, 38, 38, 0.08);
        color: #dc2626;
    }

    /* =========================
       LOGOUT MODAL
    ========================= */
    .logout-modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(19, 27, 46, 0.45);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }
    .logout-modal.show {
        display: flex;
    }
    .logout-modal-box {
        width: 400px;
        max-width: calc(100% - 40px);
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(19, 27, 46, 0.25);
        animation: logoutModalShow 0.2s ease;
    }
    .logout-icon {
        width: 58px;
        height: 58px;
        margin: 0 auto 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fdecec;
        color: #dc2626;
        font-size: 24px;
    }
    .logout-modal-box h3 {
        margin: 0 0 10px;
        font-size: 22px;
        font-weight: 700;
        color: #131b2e;
    }
    .logout-modal-box p {
        margin: 0 0 26px;
        color: #6b7280;
        font-size: 14px;
    }
    .logout-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .logout-actions button {
        height: 42px;
        padding: 0 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
        border: 1px solid transparent;
    }
    .logout-cancel {
        background: #fff;
        border: 1px solid #e6e8ea;
        color: #333;
    }
    .logout-cancel:hover {
        background: #f5f5f5;
    }
    .logout-confirm {
        background: #dc2626;
        border: 1px solid #dc2626;
        color: #fff;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .logout-confirm:hover {
        background: #b91c1c;
    }
    @keyframes logoutModalShow {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.97);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @media (max-width: 991.98px) {
        .sj-navbar .navbar-nav.sj-main-nav {
            position: static;
            transform: none;
            gap: 0.15rem;
            padding-top: 0.75rem;
        }

        .sj-navbar .nav-link.active::after {
            display: none;
        }

        .sj-navbar .nav-icon-link,
        .sj-navbar .nav-icon-btn,
        .sj-navbar .logout-btn {
            width: auto;
            height: auto;
            border-radius: 0.6rem;
            justify-content: flex-start;
            padding: 0.5rem 0.9rem;
            font-size: 0.925rem;
            gap: 0.6rem;
        }

        .sj-navbar .nav-icon-link span,
        .sj-navbar .nav-icon-btn span,
        .sj-navbar .logout-btn span {
            display: inline !important;
        }

        .sj-navbar .sj-cart-badge {
            position: static;
            display: inline-block;
            margin-left: 0.4rem;
        }

        .sj-navbar .btn-orange {
            display: inline-block;
            margin-top: 0.5rem;
        }
    }
    
</style>

<nav class="navbar navbar-expand-lg navbar-light sticky-top sj-navbar">
    <div class="container position-relative">
        <a class="navbar-brand" href="{{ route('home') }}">
    <img src="{{ asset('storage/foto_landingpage/SANJAIKUUU.png') }}"
         alt="Sanjaiku"
         style="height: 45px; width: auto;">
</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav sj-main-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('products') }}">Products</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                @endguest
            </ul>

            <ul class="navbar-nav ms-auto align-items-lg-center sj-actions">
                @auth
                    <li class="nav-item nav-icon-wrap">
                        <a class="nav-icon-link" href="{{ route('profile.edit') }}" title="Profil Saya">
                            <i class="fas fa-user"></i>
                            <span class="d-lg-none ms-1">Profil Saya</span>
                        </a>
                    </li>
                    <li class="nav-item nav-icon-wrap">
                        <a class="nav-icon-link" href="{{ route('cart.index') }}" title="Keranjang">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                // =============================================
                                // PERBAIKAN: hitung jumlah item keranjang dengan aman
                                // =============================================
                                $cartCount = 0;
                                if (auth()->check() && auth()->user()->cart) {
                                    $cartCount = auth()->user()->cart->items->count();
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="sj-cart-badge">{{ $cartCount }}</span>
                            @endif
                            <span class="d-lg-none ms-1">Keranjang</span>
                        </a>
                    </li>
                    <li class="nav-item nav-icon-wrap">
                        <a class="nav-icon-link" href="{{ route('orders.index') }}" title="Riwayat Pesanan">
                            <i class="fas fa-history"></i>
                            <span class="d-lg-none ms-1">Riwayat Pesanan</span>
                        </a>
                    </li>
                    <li class="nav-item nav-icon-wrap">
                        <button type="button" class="logout-btn" onclick="openLogoutModal()" title="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="d-lg-none ms-1">Logout</span>
                        </button>
                    </li>
                @endauth

                @guest
                    <li class="nav-item nav-icon-wrap">
                        <a class="nav-icon-link" href="{{ route('login') }}" title="Login">
                            <i class="fas fa-sign-in-alt"></i>
                            <span class="d-lg-none ms-1">Login</span>
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Logout Modal -->
<div id="logoutModal" class="logout-modal">
    <div class="logout-modal-box">

        <div class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>

        <h3>Keluar dari akun?</h3>

        <p>
            Apakah Anda yakin ingin keluar dari akun Anda?
        </p>

        <div class="logout-actions">

            <button type="button"
                    class="logout-cancel"
                    onclick="closeLogoutModal()">
                Batal
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout-confirm">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </button>
            </form>

        </div>

    </div>
</div>

<script>
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.add('show');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('show');
    }

    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLogoutModal();
        }
    });
</script>