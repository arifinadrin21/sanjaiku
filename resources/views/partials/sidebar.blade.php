<aside class="main-sidebar main-sidebar-light">

    <style>
        /* ===== Sidebar Light Theme (override AdminLTE, scoped ke .main-sidebar-light) ===== */
        .main-sidebar-light {
            background: #ffffff !important;
            border-right: 1px solid #eef1f6;
            box-shadow: none !important;
        }

        /* Brand */
        .main-sidebar-light .brand-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 18px;
            border-bottom: none !important;
        }
        .main-sidebar-light .brand-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #2563eb;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            flex-shrink: 0;
        }
        .main-sidebar-light .brand-text-wrap {
            display: flex;
            flex-direction: column;
            line-height: 1.1;
        }
        .main-sidebar-light .brand-text-wrap .name {
            font-weight: 800;
            font-size: 16px;
            color: #1e293b !important;
        }
        .main-sidebar-light .brand-text-wrap .sub {
            font-size: 10px;
            letter-spacing: .05em;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Status pill */
        .main-sidebar-light .status-pill {
            margin: 0 16px 14px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f1f9f4;
            border: 1px solid #dcf3e4;
            border-radius: 10px;
            padding: 8px 12px;
            font-size: 12px;
            color: #16a34a;
            font-weight: 700;
        }
        .main-sidebar-light .status-pill .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            flex-shrink: 0;
        }
        .main-sidebar-light .status-pill small {
            display: block;
            font-weight: 500;
            color: #94a3b8;
            font-size: 10px;
        }

        /* User panel */
        .main-sidebar-light .user-panel {
            border-bottom: 1px solid #eef1f6 !important;
        }
        .main-sidebar-light .user-panel .info a {
            color: #1e293b !important;
            font-weight: 700;
            font-size: 13px;
        }

        /* Nav headers */
        .main-sidebar-light .nav-header {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            color: #b6bfcc !important;
            text-transform: uppercase;
            background: transparent !important;
            padding: 14px 12px 6px 12px !important;
        }

        /* Nav links */
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link {
            color: #475569 !important;
            border-radius: 10px !important;
            margin: 2px 8px;
            font-weight: 600;
            font-size: 14px;
            transition: background .15s ease, color .15s ease;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link .nav-icon {
            color: #94a3b8 !important;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link:hover {
            background: #f5f7fb !important;
            color: #1e293b !important;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.active {
            background: #1e293b !important;
            color: #ffffff !important;
            box-shadow: none !important;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.active .nav-icon {
            color: #ffffff !important;
        }

        /* ============================================================
           LOGOUT BUTTON — WARNA MERAH (#ef4444)
           Selector dibuat spesifik agar mengalahkan aturan
           nav-link umum di atas.
           ============================================================ */
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link {
            color: #ef4444 !important;
            background: transparent !important;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            transition: background .15s ease, color .15s ease;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link .nav-icon {
            color: #ef4444 !important;
            transition: color .15s ease;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link p {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        /* Hover / focus */
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link:hover,
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link:focus {
            background: #fef2f2 !important;
            color: #ef4444 !important;
            outline: none;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link:hover .nav-icon,
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link:focus .nav-icon {
            color: #ef4444 !important;
        }

        /* Active / ditekan */
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link:active {
            color: #dc2626 !important;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link:active .nav-icon {
            color: #dc2626 !important;
        }

        /* Saat modal logout terbuka */
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link.logout-active {
            color: #ef4444 !important;
            background: #fef2f2 !important;
        }
        .main-sidebar-light .nav-sidebar > .nav-item > .nav-link.logout-link.logout-active .nav-icon {
            color: #ef4444 !important;
        }

        /* ============================================================
           ADMIN LOGOUT MODAL
           ============================================================ */
        .admin-logout-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            font-family: inherit;
        }
        .admin-logout-overlay.show {
            display: flex;
        }
        .admin-logout-modal {
            width: 400px;
            max-width: calc(100% - 30px);
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 15px 45px rgba(15, 23, 42, 0.25);
            animation: adminLogoutAnimation 0.2s ease;
            pointer-events: auto;
        }
        .admin-logout-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fef2f2;
            color: #ef4444;
            font-size: 24px;
        }
        .admin-logout-modal h4 {
            margin-bottom: 8px;
            font-weight: 700;
            color: #1e293b;
        }
        .admin-logout-modal p {
            margin-bottom: 25px;
            color: #64748b;
            font-size: 14px;
        }
        .admin-logout-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
        .admin-logout-actions form {
            margin: 0;
        }
        .admin-btn-cancel,
        .admin-btn-confirm {
            min-width: 100px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 18px;
            border: 1px solid transparent;
            transition: background .15s ease, border-color .15s ease;
        }
        .admin-btn-cancel {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #334155;
        }
        .admin-btn-cancel:hover {
            background: #eef1f6;
        }
        .admin-btn-confirm {
            background: #ef4444;
            border-color: #ef4444;
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            justify-content: center;
        }
        .admin-btn-confirm:hover {
            background: #dc2626;
            border-color: #dc2626;
        }
        @keyframes adminLogoutAnimation {
            from { opacity: 0; transform: scale(0.95) translateY(-8px); }
            to   { opacity: 1; transform: scale(1) translateY(0); }
        }
        .admin-logout-overlay.closing .admin-logout-modal {
            animation: adminLogoutCloseAnimation 0.15s ease forwards;
        }
        @keyframes adminLogoutCloseAnimation {
            to { opacity: 0; transform: scale(0.95) translateY(-8px); }
        }
    </style>

    <!-- Brand Logo -->
<a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('kasir.dashboard') }}"
    class="brand-link">

    <img src="/storage/foto_landingpage/SANJAIKUUU.png"
         alt="Sanjaiku"
         style="width: 40px; height: 40px; object-fit: contain; flex-shrink: 0;">

    <div class="brand-text-wrap">
        <span class="name">Sanjaiku</span>
        <span class="sub">
            {{ Auth::user()->role === 'admin' ? 'Admin Panel' : 'Kasir Panel' }}
        </span>
    </div>

</a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Status Toko -->
        <div class="status-pill">
            <span class="dot"></span>

            <span>
                Toko Buka &bull; Online
                <small>Status Gerai</small>
            </span>
        </div>

        <!-- User Panel -->
        <div class="user-panel mt-1 pb-3 mb-3 d-flex">

            <div class="image">
                <img src="{{ asset('assets') }}/AdminLTE/dist/img/Profile-admin.jpg"
                    class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::user()->name }}
                </a>

                <small class="text-muted">
                    {{ Auth::user()->role === 'admin' ? 'Super Admin' : 'Kasir' }}
                </small>
            </div>

        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">


                {{-- ================================================= --}}
                {{-- SIDEBAR ADMIN --}}
                {{-- ================================================= --}}

                @if(Auth::user()->role === 'admin')

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-gauge-high"></i>
                            <p>Dashboard</p>

                        </a>
                    </li>


                    <!-- MASTER DATA -->
                    <li class="nav-header">MASTER DATA</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}"
                            class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-folder"></i>
                            <p>Kategori</p>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.products.index') }}"
                            class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-box"></i>
                            <p>Produk</p>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.product-variants.index') }}"
                            class="nav-link {{ request()->routeIs('admin.product-variants.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-tags"></i>
                            <p>Varian Produk</p>

                        </a>
                    </li>


                    <!-- TRANSAKSI -->
                    <li class="nav-header">TRANSAKSI</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}"
                            class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>Pesanan</p>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.vouchers.index') }}"
                            class="nav-link {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-ticket-alt"></i>
                            <p>Voucher</p>

                        </a>
                    </li>


                    <!-- PENGGUNA -->
                    <li class="nav-header">PENGGUNA</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.testimonials.index') }}"
                            class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-star"></i>
                            <p>Testimoni</p>

                        </a>
                    </li>


                    <!-- LAPORAN -->
                    <li class="nav-header">LAPORAN</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.reports.index') }}"
                            class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Laporan Penjualan</p>

                        </a>
                    </li>


                {{-- ================================================= --}}
                {{-- SIDEBAR KASIR --}}
                {{-- ================================================= --}}

                @elseif(Auth::user()->role === 'kasir')

                    <!-- Dashboard -->
                    <li class="nav-item">

                        <a href="{{ route('kasir.dashboard') }}"
                            class="nav-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">

                            <i class="nav-icon fas fa-gauge-high"></i>
                            <p>Dashboard</p>

                        </a>

                    </li>


                    <!-- TRANSAKSI -->
                    <li class="nav-header">TRANSAKSI</li>

                    <li class="nav-item">

                        <a href="#"
                            class="nav-link">

                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>Transaksi Baru</p>

                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="#"
                            class="nav-link">

                            <i class="nav-icon fas fa-clock-rotate-left"></i>
                            <p>Riwayat Transaksi</p>

                        </a>

                    </li>


                    <!-- AKUN -->
                    <li class="nav-header">AKUN</li>

                    <li class="nav-item">

                        <a href="{{ route('profile.edit') }}"
                            class="nav-link">

                            <i class="nav-icon fas fa-user"></i>
                            <p>Profil</p>

                        </a>

                    </li>

                @endif


                <!-- LOGOUT -->
                <li class="nav-header">AKUN</li>

                <li class="nav-item">

                    <button type="button"
                        class="nav-link logout-link btn btn-link text-left w-100"
                        id="logoutButton"
                        data-logout-trigger
                        onclick="openAdminLogoutModal()">

                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>

                    </button>

                </li>

            </ul>

        </nav>

    </div>
</aside>

<!-- Admin Logout Modal -->
<div id="adminLogoutModal" class="admin-logout-overlay">
    <div class="admin-logout-modal" id="adminLogoutModalContent">
        <div class="admin-logout-icon">
            <i class="fas fa-sign-out-alt"></i>
        </div>
        <h4>Keluar dari akun?</h4>
        <p>Apakah Anda yakin ingin keluar dari akun ini?</p>
        <div class="admin-logout-actions">
            <button type="button"
                    class="btn btn-light admin-btn-cancel"
                    data-logout-cancel>
                Batal
            </button>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="submit" class="btn admin-btn-confirm">
                    <i class="fas fa-sign-out-alt mr-1"></i>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    (function () {
        'use strict';

        var overlay   = document.getElementById('adminLogoutModal');
        var content   = document.getElementById('adminLogoutModalContent');
        var form      = document.getElementById('logoutForm');
        var cancelBtn = document.querySelector('[data-logout-cancel]');

        // Dukung dua pola: [data-logout-trigger] (baru) & #logoutButton (lama)
        var triggers  = document.querySelectorAll('[data-logout-trigger], #logoutButton');

        if (!overlay || !content) return;

        function setActive(state) {
            triggers.forEach(function (btn) {
                btn.classList.toggle('logout-active', !!state);
            });
        }

        function openModal() {
            overlay.classList.remove('closing');
            overlay.classList.add('show');
            setActive(true);
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            overlay.classList.add('closing');
            setTimeout(function () {
                overlay.classList.remove('show', 'closing');
                setActive(false);
                document.body.style.overflow = '';
            }, 150);
        }

        // Expose untuk dipanggil dari inline onclick
        window.openAdminLogoutModal  = openModal;
        window.closeAdminLogoutModal = closeModal;

        // Pasang listener (preventDefault mencegah double trigger dari onclick inline)
        triggers.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                openModal();
            });
        });

        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeModal);
        }

        overlay.addEventListener('click', function (event) {
            if (event.target === overlay) closeModal();
        });

        content.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        if (form) {
            form.addEventListener('submit', function () {
                overlay.classList.remove('show', 'closing');
                setActive(false);
                document.body.style.overflow = '';
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && overlay.classList.contains('show')) {
                closeModal();
            }
        });
    })();
</script>