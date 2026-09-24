<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Sanjaiku</title>

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

        .register-shell {
            display: grid;
            grid-template-columns: .95fr 1.15fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 70px rgba(0, 0, 0, .08);
        }

        /* ---------- LEFT PANEL ---------- */
               .side-panel {
            position: relative;
            min-height: 700px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #fff;
            background:
                linear-gradient(180deg, rgba(8,10,16,.75) 0%, rgba(8,10,16,.6) 40%, rgba(8,10,16,.92) 100%),
                url('{{ asset("storage/foto_landingpage/registra.webp") }}') center/cover no-repeat;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
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

        .side-top {
            margin-bottom: auto;
        }

        .side-middle h1 {
            font-size: 40px;
            line-height: 1.15;
            font-weight: 700;
            margin: 20px 0 16px;
        }

        .side-middle h1 .accent {
            color: #b9c4ff;
        }

        .side-middle p {
            font-size: 14.5px;
            line-height: 1.65;
            color: rgba(255, 255, 255, .8);
            max-width: 400px;
        }

        .benefit-box {
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 14px;
            padding: 20px 20px 18px;
            margin-top: 26px;
        }

        .benefit-box .b-title {
            display: flex;
            align-items: center;
            gap: 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .5px;
            color: rgba(255, 255, 255, .6);
            margin-bottom: 14px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .benefit-item:last-child {
            margin-bottom: 0;
        }

        .benefit-item svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            margin-top: 2px;
            stroke: #b9c4ff;
        }

        .side-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(255, 255, 255, .14);
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            color: rgba(255, 255, 255, .55);
        }

        .side-bottom span {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .side-bottom svg {
            width: 13px;
            height: 13px;
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
            margin-bottom: 20px;
        }

        .form-panel h2 {
            font-size: 34px;
            font-weight: 800;
            color: #111;
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .form-panel .subtitle {
            font-size: 14.5px;
            color: #777;
            line-height: 1.55;
            margin-bottom: 26px;
            max-width: 460px;
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
            font-size: 15px;
            font-weight: 600;
            color: #222;
        }

        .hint-tag {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10.5px;
            color: #aaa;
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

        .agree-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 20px 0 24px;
            font-size: 14px;
            color: #444;
            line-height: 1.55;
        }

        .agree-row input {
            width: 16px;
            height: 16px;
            margin-top: 3px;
            accent-color: #2952e3;
            flex-shrink: 0;
        }

        .agree-row a {
            color: #2952e3;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-register {
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

        .btn-register:hover {
            background: #1e3fc4;
        }

        .btn-register svg {
            width: 18px;
            height: 18px;
            stroke: #fff;
        }

        .divider-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 26px 0;
        }

        .divider-row hr {
            flex: 1;
            border: none;
            border-top: 1px solid #ececec;
        }

        .divider-row span {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10.5px;
            letter-spacing: .5px;
            color: #b3b7bf;
            white-space: nowrap;
        }

        .login-link {
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .login-link a {
            color: #2952e3;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .login-link a svg {
            width: 14px;
            height: 14px;
            stroke: #2952e3;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: #ffe5e5;
            color: #b00020;
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
            .register-shell {
                grid-template-columns: 1fr;
            }
            .side-panel {
                min-height: 420px;
            }
            .side-middle h1 {
                font-size: 30px;
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

        <div class="register-shell">

            <!-- LEFT: brand / benefits panel -->
            <div class="side-panel">
                <div class="side-top">
                    <div class="pill pill-outline">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l3 6 6 1-4.5 4.5L18 20l-6-3-6 3 1.5-6.5L3 9l6-1 3-6z"/></svg>
                        OTENTIK PAYAKUMBUH
                    </div>
                </div>

                <div class="side-middle">
                    <h1>Warisan Rasa<br><span class="accent">Minangkabau</span></h1>
                    <p>Gabung bersama ribuan penikmat camilan tradisional asli Ranah Minang dengan jaminan renyah dan gurih premium.</p>

                    <div class="benefit-box">
                        <div class="b-title">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l2.9 6L22 9l-5 4.9 1.2 7.1L12 17.8 5.8 21l1.2-7.1L2 9l7.1-1z"/></svg>
                            KEISTIMEWAAN ANGGOTA
                        </div>
                        <div class="benefit-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16M4 12l4-4M4 12l4 4"/><path d="M14 6l6 6-6 6" opacity="0"/></svg>
                            <span>Diskon member baru 10% untuk semua varian Sanjai &amp; Kerupuk</span>
                        </div>
                        <div class="benefit-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z"/></svg>
                            <span>Pengiriman cepat &amp; kemasan kedap udara anti remuk</span>
                        </div>
                    </div>
                </div>

                <div class="side-bottom">
                    <span>KUALITAS TRADISIONAL SEJAK 1984</span>
                    <span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="6" width="15" height="12" rx="2"/><path d="M16 10h3l3 3v5h-6"/><circle cx="6" cy="19" r="2"/><circle cx="17" cy="19" r="2"/></svg>
                        Se-Indonesia
                    </span>
                </div>
            </div>

            <!-- RIGHT: register form -->
            <div class="form-panel">

                <div class="access-pill">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    REGISTRASI PELANGGAN BARU
                </div>

                <h2>Gabung Bersama Sanjaiku</h2>
                <div class="subtitle">Daftar sekarang dan nikmati kelezatan kerupuk sanjai khas Minangkabau langsung dari Bukittinggi.</div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-left:20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.process') }}" method="POST">
                    @csrf

                    <div class="input-group">
                        <div class="label-row">
                            <label for="name">Nama Lengkap</label>
                        </div>
                        <div class="input-wrap">
                            <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="4"/>
                                <path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/>
                            </svg>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="Nama"
                                value="{{ old('name') }}"
                                required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="email">Alamat Email</label>
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
                                placeholder="budi@gmail.com"
                                value="{{ old('email') }}"
                                required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="password">Kata Sandi</label>
                            <span class="hint-tag">Minimal 8 Karakter</span>
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
                                placeholder="••••••••"
                                required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password','eye-icon-1')" aria-label="Tampilkan password">
                                <svg id="eye-icon-1" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        </div>
                        <div class="input-wrap">
                            <svg class="leading-icon" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="10" rx="2"/>
                                <path d="M16 11V7a4 4 0 0 0-8 0"/>
                                <path d="M12 3a4 4 0 0 1 4 4"/>
                            </svg>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="••••••••"
                                required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation','eye-icon-2')" aria-label="Tampilkan konfirmasi password">
                                <svg id="eye-icon-2" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    

                    <button type="submit" class="btn-register">
                        Daftar Sekarang
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="m12 5 7 7-7 7"/>
                        </svg>
                    </button>
                </form>

                <div class="divider-row">
                    <hr><span>CAMILAN TRADISIONAL TERPERCAYA</span><hr>
                </div>

                <div class="login-link">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">
                        Masuk di sini
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 6l6 6-6 6"/>
                        </svg>
                    </a>
                </div>

            </div>
        </div>

        <div class="site-footer">
            © 2026 Sanjaiku. Authentically Minangkabau.<br>
            
        </div>

    </div>

    <script>
        function togglePassword(inputId, iconId){
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            icon.innerHTML = isHidden
                ? '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a20.6 20.6 0 0 1 5.06-5.94M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 7 11 7a20.6 20.6 0 0 1-2.16 3.19M14.12 14.12a3 3 0 1 1-4.24-4.24"/><path d="M1 1l22 22"/>'
                : '<path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7Z"/><circle cx="12" cy="12" r="3"/>';
        }
    </script>

</body>
</html>