<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') - Sanjaiku</title>

     {{-- Font Awesome lokal - dimuat async agar tidak blocking render --}}
<link rel="preload"
      as="style"
      href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}"
      onload="this.onload=null;this.rel='stylesheet'">

<noscript>
    <link rel="stylesheet"
          href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
</noscript>
<style>
        :root {
            --accent:       #0F172A;
            --accent-dark:  #1e293b;
            --accent-soft:  #e2e8f0;
            --on-accent:    #F8FAFC;
            --bg:           #fdf6ee;
            --surface:      #ffffff;
            --border:       #f0e3d1;
            --text:         #1e293b;
            --muted:        #94a3b8;
            --stock-ok:     #16a34a;
            --danger:       #ef4444;
            --danger-soft:  #fef2f2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .kasir-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */

        .kasir-sidebar {
            width: 230px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            padding: 22px 14px;
            flex-shrink: 0;
            transition: margin-left .2s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 10px 25px;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: var(--accent);
            color: #ffffff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            flex-shrink: 0;
        }

        .brand-text h3 {
            font-size: 17px;
            margin-bottom: 2px;
        }

        .brand-text span {
            font-size: 11px;
            color: var(--muted);
        }

        .menu-title {
            font-size: 10px;
            font-weight: bold;
            color: var(--muted);
            margin: 22px 10px 8px;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            margin: 3px 0;
            border-radius: 10px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            width: 100%;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            transition: background .15s ease, color .15s ease;
        }

        .menu-link:hover {
            background: var(--accent-soft);
            color: var(--accent-dark);
        }

        .menu-link.active {
            background: var(--accent);
            color: var(--on-accent);
            box-shadow: 0 6px 14px rgba(15, 23, 42, .28);
        }

        .menu-link.active i {
            color: var(--on-accent);
        }

        .menu-link i {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            color: var(--muted);
        }

        .menu-link.logout-link {
            color: var(--danger);
        }

        .menu-link.logout-link i {
            color: var(--danger);
        }

        .menu-link.logout-link:hover {
            background: var(--danger-soft);
            color: var(--danger);
        }

        /* ================= MAIN ================= */

        .kasir-main {
            flex: 1;
            min-width: 0;
        }

        /* ================= TOPBAR ================= */

        .topbar {
            height: 70px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 0 28px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
            flex: 1;
            min-width: 0;
        }

        .sidebar-toggle {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--surface);
            border-radius: 9px;
            color: #64748b;
            cursor: pointer;
            flex-shrink: 0;
        }

        .sidebar-toggle:hover {
            background: var(--bg);
        }

        .search-box {
            width: 380px;
            max-width: 100%;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 13px;
            color: var(--muted);
            pointer-events: none;
        }

       .search-box input { 
    width: 100%; 
    border: 1px solid var(--border); 
    background: #ffffff; 
    padding: 11px 15px 11px 40px; 
    border-radius: 10px; 
    outline: none; 
    font-size: 13px; 
    font-family: inherit; 
}

        .search-box input:focus {
            background: #ffffff;
            border-color: var(--accent);
        }

        .kasir-user {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .kasir-avatar {
            width: 36px;
            height: 36px;
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .kasir-user-info strong {
            display: block;
            font-size: 13px;
        }

        .kasir-user-info span {
            font-size: 11px;
            color: var(--muted);
        }

        /* ================= CONTENT ================= */

        .kasir-content {
            padding: 28px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 25px;
            margin-bottom: 5px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        /* ================= POS AREA ================= */

        .pos-layout {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 22px;
        }

        /* ================= PRODUCTS ================= */

        .product-area {
            min-width: 0;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .product-header h3 {
            font-size: 17px;
        }

        .category-filter {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .category-btn {
            border: 1px solid var(--border);
            background: var(--surface);
            padding: 8px 15px;
            border-radius: 999px;
            font-size: 12px;
            color: #64748b;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            transition: background .15s ease, color .15s ease, border-color .15s ease;
        }

        .category-btn:hover {
            border-color: var(--accent);
            color: var(--accent-dark);
        }

        .category-btn.active {
            background: var(--accent);
            color: var(--on-accent);
            border-color: var(--accent);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .product-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 12px;
            cursor: pointer;
            transition: .2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
            border-color: var(--accent);
            box-shadow: 0 10px 25px rgba(245, 158, 11, .14);
        }

        .product-card.is-hidden {
            display: none;
        }

        .product-image {
            height: 145px;
            background: var(--bg);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-image i {
            font-size: 40px;
            color: #d9c6ac;
        }

        .product-name {
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .product-stock {
            font-size: 11px;
            font-weight: 700;
            color: var(--stock-ok);
            margin-bottom: 4px;
        }

        .product-stock.empty {
            color: var(--danger);
        }

        .product-price {
            font-size: 12px;
            color: var(--accent);
            font-weight: 700;
        }

        /* ================= ORDER ================= */

        .order-panel {
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 20px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .order-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .order-title h3 {
            font-size: 17px;
        }

        .order-count {
            background: var(--accent-soft);
            color: var(--accent-dark);
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: bold;
        }

        .empty-order {
            text-align: center;
            padding: 50px 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .empty-order i {
            font-size: 35px;
            margin-bottom: 12px;
            color: #e4d4bc;
            display: block;
        }

        .order-summary {
            border-top: 1px solid var(--border);
            padding-top: 18px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 10px;
            color: #64748b;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: 800;
            margin-top: 15px;
            color: var(--text);
        }

        .btn-payment {
            width: 100%;
            border: none;
            background: var(--accent);
            color: var(--on-accent);
            padding: 13px;
            border-radius: 10px;
            margin-top: 18px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            transition: background .15s ease;
        }

        .btn-payment:hover {
            background: var(--accent-dark);
        }

        /* ================= LOGOUT MODAL ================= */

        .logout-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .logout-overlay.show {
            display: flex;
        }

        .logout-modal {
            width: 400px;
            max-width: 100%;
            background: var(--surface);
            border-radius: 14px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 15px 45px rgba(15, 23, 42, 0.25);
            animation: logoutShow .2s ease;
        }

        @keyframes logoutShow {
            from { opacity: 0; transform: scale(.95) translateY(-8px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }

        .logout-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--danger-soft);
            color: var(--danger);
            font-size: 24px;
        }

        .logout-modal h4 {
            margin-bottom: 8px;
            font-weight: 700;
            color: var(--text);
            font-size: 17px;
        }

        .logout-modal p {
            margin-bottom: 25px;
            color: #64748b;
            font-size: 14px;
        }

        .logout-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .logout-actions form {
            margin: 0;
        }

        .btn-cancel,
        .btn-confirm {
            min-width: 100px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            padding: 9px 18px;
            border: 1px solid transparent;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s ease, border-color .15s ease;
        }

        .btn-cancel {
            background: var(--bg);
            border-color: var(--border);
            color: #334155;
        }

        .btn-cancel:hover {
            background: #f3e7d6;
        }

        .btn-confirm {
            background: var(--danger);
            border-color: var(--danger);
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            justify-content: center;
        }

        .btn-confirm:hover {
            background: #dc2626;
            border-color: #dc2626;
        }

       /* ================= RESPONSIVE ================= */

@media (max-width: 1100px) {

    .pos-layout {
        grid-template-columns: 1fr;
    }

    .order-panel {
        position: static;
    }

}

@media (max-width: 900px) {
    .sidebar-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    

        .kasir-sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 10000; /* PERBAIKAN: Sidebar berada di paling atas */
        margin-left: -230px;
        box-shadow: 4px 0 20px rgba(15, 23, 42, .1);
        overflow-y: auto;
        transition: margin-left 0.3s ease; /* Animasi slide yang lebih halus */
    }
  .kasir-wrapper.sidebar-open .kasir-sidebar {
        margin-left: 0;
    }

    .kasir-wrapper.sidebar-open::after {
    content: '';
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, .35);
    z-index: 9999;   /* ← dari 999 jadi 9999 */
}

    .kasir-wrapper.sidebar-open .kasir-main {
        position: relative;
        z-index: 1; /* PERBAIKAN: Konten utama di bawah overlay */
    }

     .kasir-sidebar .brand-text,
    .kasir-sidebar .menu-link p,
    .kasir-sidebar .menu-title {
        display: block;
    }

    .kasir-sidebar .brand,
    .kasir-sidebar .menu-link {
        justify-content: flex-start;
    }

    /* Topbar & konten lebih rapat */
    .topbar        { padding: 0 16px; height: 64px; }
    .kasir-content { padding: 20px; }

}

@media (max-width: 800px) {

    .search-box { width: 100%; }

    .kasir-user-info { display: none; }

    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}

/* HP */
@media (max-width: 600px) {

    .topbar {
        padding: 0 12px;
        height: 60px;
        gap: 10px;
    }

    .kasir-content { padding: 14px; }

    .page-heading h1 { font-size: 22px; }

    /* Cegah iOS auto-zoom pada input */
    .search-box input { font-size: 16px; }

    .kasir-avatar {
        width: 34px;
        height: 34px;
        font-size: 14px;
    }

    /* Modal logout lebih ramping */
    .logout-modal {
        padding: 24px 20px;
        border-radius: 12px;
    }
    .logout-modal h4 { font-size: 16px; }
    .logout-modal p  { font-size: 13px; }

    .logout-actions {
        flex-direction: column-reverse;
        gap: 8px;
    }
    .logout-actions form,
    .logout-actions .btn-cancel,
    .logout-actions .btn-confirm {
        width: 100%;
    }
    .logout-actions .btn-confirm {
        display: flex;
        justify-content: center;
    }

}

@media (max-width: 400px) {

    .kasir-content { padding: 12px; }

    .search-box input {
        padding: 10px 14px 10px 38px;
        font-size: 16px;
    }

    .search-box i { left: 12px; top: 12px; }

    .sidebar-toggle { width: 38px; height: 38px; }

}
.brand-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.brand-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

    </style>

  @stack('styles')

</head>

<body>

<div class="kasir-wrapper" id="kasirWrapper">

    <!-- SIDEBAR -->

    <aside class="kasir-sidebar" id="kasirSidebar">

        <div class="brand">

           <div class="brand-icon">
    <img src="{{ asset('storage/foto_landingpage/SANJAIKUUU.png') }}"
         alt="Sanjaiku">
</div>

            <div class="brand-text">

                <h3>Sanjaiku</h3>

                <span>Kasir Panel</span>

            </div>

        </div>


        <div class="menu-title">
            Menu
        </div>

        <a href="{{ route('kasir.dashboard') }}"
            class="menu-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">

            <i class="fas fa-gauge-high"></i>

            <p>Dashboard</p>

        </a>


        <div class="menu-title">
            Transaksi
        </div>

      

        <a href="{{ route('kasir.history') }}"
            class="menu-link {{ request()->routeIs('kasir.history') ? 'active' : '' }}">

            <i class="fas fa-clock-rotate-left"></i>

            <p>Riwayat Transaksi</p>

        </a>


        <div class="menu-title">
            Akun
        </div>

       

        <button type="button"
            class="menu-link logout-link"
            onclick="openLogoutModal()">

            <i class="fas fa-sign-out-alt"></i>

            <p>Logout</p>

        </button>

    </aside>


    <!-- MAIN -->

    <main class="kasir-main">

        <!-- TOPBAR -->

        <header class="topbar">

            <div class="topbar-left">

                <button type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle"
                    aria-label="Buka menu">

                    <i class="fas fa-bars"></i>

                </button>

                <div class="search-box">

                    <i class="fas fa-search"></i>

                    <input type="text"
                        id="kasirSearch"
                        placeholder="Cari produk..."
                        autocomplete="off">

                </div>

            </div>


            <div class="kasir-user">

                <div class="kasir-avatar">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>

                <div class="kasir-user-info">

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                    <span>
                        Kasir
                    </span>

                </div>

            </div>

        </header>


        <!-- CONTENT -->

        <div class="kasir-content">

            @yield('content')

        </div>

    </main>

</div>

<!-- ================= LOGOUT MODAL ================= -->
<div id="logoutModal" class="logout-overlay">
    <div class="logout-modal">

        <div class="logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>

        <h4>Keluar dari akun?</h4>

        <p>Apakah Anda yakin ingin keluar dari akun kasir?</p>

        <div class="logout-actions">

            <button type="button"
                class="btn-cancel"
                onclick="closeLogoutModal()">

                Batal

            </button>

            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf

                <button type="submit" class="btn-confirm">

                    <i class="fas fa-sign-out-alt"></i>

                    Keluar

                </button>

            </form>

        </div>

    </div>
</div>

<script>
(function () {
    'use strict';

    // ---------- Logout Modal ----------
    var overlay = document.getElementById('logoutModal');

    window.openLogoutModal = function () {
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    };

    window.closeLogoutModal = function () {
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    };

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closeLogoutModal();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('show')) {
            closeLogoutModal();
        }
    });

    // ---------- Sidebar toggle (mobile) ----------
    var wrapper = document.getElementById('kasirWrapper');
    var toggle  = document.getElementById('sidebarToggle');

   if (toggle) {
    toggle.addEventListener('click', function () {
        wrapper.classList.toggle('sidebar-open');
    });

         // Klik di area gelap → tutup
   wrapper.addEventListener('click', function (e) {
    if (
        wrapper.classList.contains('sidebar-open') &&
        !e.target.closest('.kasir-sidebar') &&
        !e.target.closest('#sidebarToggle')
    ) {
        wrapper.classList.remove('sidebar-open');
    }
});
}

    // ---------- Search produk (live filter) ----------
    var searchInput = document.getElementById('kasirSearch');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var keyword = this.value.trim().toLowerCase();
            var cards   = document.querySelectorAll('.product-card');

            cards.forEach(function (card) {
                var name = (card.dataset.productName || '').toLowerCase();
                if (keyword === '' || name.indexOf(keyword) !== -1) {
                    card.classList.remove('is-hidden');
                } else {
                    card.classList.add('is-hidden');
                }
            });
        });
    }
})();


</script>

    @stack('scripts')
</body>
</html>