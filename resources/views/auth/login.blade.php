<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sanjaiku</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #eef1f6;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .brand-top {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 48px;
        }

        .brand-top .logo-mark {
            width: 26px;
            height: 26px;
            color: #2952e3;
        }

        .brand-top span {
            font-size: 22px;
            font-weight: 700;
            color: #111;
        }

        .page-wrap {
            max-width: 1200px;
            margin: 0 auto;
        }

        .login-shell {
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0, 0, 0, .08);
        }

        /* ---------- LEFT PANEL ---------- */
        .side-panel {
            position: relative;
            min-height: 640px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            background:
                linear-gradient(180deg, rgba(10,12,18,.55) 0%, rgba(10,12,18,.55) 45%, rgba(10,12,18,.92) 100%),
                url('https://i.ibb.co.com/WXSpj9s/Chat-GPT-Image-Sep-5-2026-11-33-44-AM.png') center/cover no-repeat;
        }

        .side-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 999px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
        }

        .pill-outline {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .35);
            backdrop-filter: blur(4px);
        }

        .est-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: rgba(255, 255, 255, .65);
        }

        .side-middle {
            margin-top: auto;
        }

        .tag-strip {
            display: inline-block;
            background: #2952e3;
            padding: 6px 12px;
            border-radius: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .side-middle h1 {
            font-size: 44px;
            line-height: 1.12;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .side-middle p {
            font-size: 14.5px;
            line-height: 1.65;
            color: rgba(255, 255, 255, .78);
            max-width: 420px;
            margin-bottom: 26px;
        }

        .feature-row {
            display: flex;
            gap: 12px;
        }

        .feature-card {
            flex: 1;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 12px;
            padding: 14px 16px;
        }

        .feature-card .f-title {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .feature-card .f-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, .68);
            line-height: 1.4;
        }

        .icon {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        /* ---------- RIGHT PANEL (FORM) ---------- */
        .form-panel {
            padding: 56px 56px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .access-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
            background: #eef0ff;
            color: #2952e3;
            padding: 7px 14px;
            border-radius: 999px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11.5px;
            font-weight: 600;
            margin-bottom: 22px;
        }

        .form-panel h2 {
            font-size: 36px;
            font-weight: 800;
            color: #111;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .form-panel .subtitle {
            font-size: 14.5px;
            color: #777;
            line-height: 1.55;
            margin-bottom: 30px;
            max-width: 360px;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .input-group label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .5px;
            color: #333;
            font-family: 'JetBrains Mono', monospace;
        }

        .required-tag {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10.5px;
            color: #aaa;
        }

        .forgot-inline {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11.5px;
            font-weight: 600;
            color: #2952e3;
            text-decoration: none;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap svg.leading-icon {
            position: absolute;
            left: 16px;
            width: 17px;
            height: 17px;
            stroke: #9aa0aa;
            pointer-events: none;
        }

        .input-wrap input {
            width: 100%;
            padding: 14px 44px;
            border: 1px solid #e6e8ec;
            border-radius: 12px;
            background: #f6f7f9;
            outline: none;
            font-size: 14.5px;
            font-family: 'JetBrains Mono', monospace;
            color: #222;
            transition: .2s;
        }

        .input-wrap input::placeholder {
            color: #b3b7bf;
        }

        .input-wrap input:focus {
            border-color: #2952e3;
            background: #fff;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            display: flex;
        }

        .toggle-password svg {
            width: 18px;
            height: 18px;
            stroke: #9aa0aa;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #555;
            margin-bottom: 22px;
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: #2952e3;
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            background: #2952e3;
            color: #fff;
            font-size: 15.5px;
            font-weight: 600;
            letter-spacing: .3px;
            cursor: pointer;
            transition: .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: #1e3fc4;
        }

        .signup-link {
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 24px;
        }

        .signup-link a {
            color: #2952e3;
            text-decoration: none;
            font-weight: 600;
        }

        .trust-strip {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #f6f7f9;
            border-radius: 12px;
            padding: 14px 16px;
            margin-top: 22px;
            font-size: 12.5px;
            color: #666;
            line-height: 1.5;
        }

        .trust-strip a {
            color: #2952e3;
            font-weight: 600;
            text-decoration: none;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #ffe5e5;
            color: #b00020;
        }

        /* ---------- BOTTOM PRODUCT STRIP ---------- */
        .product-strip {
            max-width: 1200px;
            margin: 22px auto 0;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .product-chip {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            border-radius: 14px;
            padding: 14px 16px;
        }

        .product-chip .p-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .p-icon svg {
            width: 18px;
            height: 18px;
        }

        .product-chip .p-name {
            font-size: 13.5px;
            font-weight: 600;
            color: #222;
        }

        .product-chip .p-sub {
            font-size: 12px;
            color: #888;
            line-height: 1.35;
        }

        .site-footer {
            text-align: center;
            margin-top: 34px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #9aa0aa;
            line-height: 2;
        }

        .site-footer a {
            color: #9aa0aa;
            text-decoration: none;
            margin: 0 6px;
        }

        @media (max-width: 900px) {
            .login-shell {
                grid-template-columns: 1fr;
            }
            .side-panel {
                min-height: 380px;
            }
            .side-middle h1 {
                font-size: 32px;
            }
            .product-strip {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .form-panel {
                padding: 40px 24px;
            }
            .side-panel {
                padding: 28px;
            }
        }
    </style>
</head>

<body>

    <div class="page-wrap">

        <div class="brand-top">
            <svg class="logo-mark" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
               
            </svg>
            <span>Sanjaiku</span>
        </div>

        <div class="login-shell">

            <!-- LEFT: brand / promo panel -->
            <div class="side-panel">
                <div class="side-top">
                    <div class="pill pill-outline">
                        <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 6 6 1-4.5 4.5L18 20l-6-3-6 3 1.5-6.5L3 9l6-1 3-6z"/></svg>
                        WARISAN BUKITTINGGI
                    </div>
                    <div class="est-label">Est. 1984</div>
                </div>

                <div class="side-middle">
                    <div class="tag-strip">Renyah &amp; Gurih Tradisi Minang</div>
                    <h1>Sensasi Renyah Asli Ranah Minang.</h1>
                    <p>Dibuat langsung dari singkong Bukittinggi pilihan dengan racikan cabe balado merah segar, melinjo gurih, dan bumbu rempah pusaka turun-temurun.</p>

                    <div class="feature-row">
                        <div class="feature-card">
                            <div class="f-title">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 7h7l-5.5 4.5L18.5 21 12 16.5 5.5 21l2-7.5L2 9h7z"/></svg>
                                100% Asli
                            </div>
                            <div class="f-sub">Tanpa Pengawet &amp; Minyak Higienis</div>
                        </div>
                        <div class="feature-card">
                            <div class="f-title">
                                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
                                Sambal Balado
                            </div>
                            <div class="f-sub">Karamel Pedas Manis Legendaris</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: login form -->
            <div class="form-panel">

                <div class="access-pill">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Akses Pelanggan
                </div>

                <h2>Selamat Datang Kembali</h2>
                <div class="subtitle">Masuk untuk menikmati aneka kerupuk dan keripik sanjai renyah favorit Anda.</div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-left:20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <div class="label-row">
                            <label for="email">Email </label>
                            <span class="required-tag">Wajib</span>
                        </div>
                        <div class="input-wrap">
                            <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="m2 7 10 6 10-6"/>
                            </svg>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="contoh@gmail.com"
                                value="{{ old('email') }}"
                                required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="password">Kata Sandi</label>
                           
                        </div>
                        <div class="input-wrap">
                            <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="10" rx="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Masukkan Password"
                                required>
                            <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Tampilkan password">
                                <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        Ingat Saya di perangkat ini
                    </label>

                    <button type="submit" class="btn-login">
                        Masuk Sekarang
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
                    </button>
                </form>

                <div class="signup-link">
                    Belum punya akun?
                    <a href="{{ route('register') }}">Daftar Akun Baru</a>
                </div>

                <div class="trust-strip">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;margin-top:1px;"><path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/></svg>
                    <div>
                        Transaksi Dijamin Aman &amp; Cepat &nbsp;
                    </div>
                </div>

            </div>
        </div>

        <!-- product strip -->
        <div class="product-strip">
            <div class="product-chip">
                <div class="p-icon" style="background:#e7ecff;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#2952e3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M9 12h6M12 9v6"/></svg>
                </div>
                <div>
                    <div class="p-name">Sanjai Balado Merah</div>
                    <div class="p-sub">Pedas Manis Gurih</div>
                </div>
            </div>
            <div class="product-chip">
                <div class="p-icon" style="background:#f0f1f4;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="4" rx="1"/><rect x="3" y="13" width="18" height="4" rx="1"/></svg>
                </div>
                <div>
                    <div class="p-name">Kerupuk Sanjai Tawar</div>
                    <div class="p-sub">Original &amp; Asin Daun Kunyit</div>
                </div>
            </div>
            <div class="product-chip">
                <div class="p-icon" style="background:#e2f6ea;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#2ea862" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 20h18M5 20V9l7-5 7 5v11"/></svg>
                </div>
                <div>
                    <div class="p-name">Karak Kaliang</div>
                    <div class="p-sub">Kuning Renyah Bawang</div>
                </div>
            </div>
            <div class="product-chip">
                <div class="p-icon" style="background:#e7ecff;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#2952e3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2c4 3 6 6 6 10a6 6 0 0 1-12 0c0-4 2-7 6-10z"/></svg>
                </div>
                <div>
                    <div class="p-name">Keripik Balado Hijau</div>
                    <div class="p-sub">Cabe Ijo Aromatik</div>
                </div>
            </div>
        </div>

        <div class="site-footer">
            © 2024 Sanjaiku. Authentically Minangkabau.<br>
           
        </div>

    </div>

    <script>
        function togglePassword(){
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a20.6 20.6 0 0 1 5.06-5.94M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 7 11 7a20.6 20.6 0 0 1-2.16 3.19M14.12 14.12a3 3 0 1 1-4.24-4.24"/><path d="M1 1l22 22"/>'
                : '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/>';
        }
    </script>

</body>
</html>