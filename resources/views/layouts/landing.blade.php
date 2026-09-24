<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | Sanjaiku</title>

    {{-- SEO --}}
    <meta name="description" content="@yield('meta_description', 'Sanjaiku — platform ...')">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="@yield('title') | Sanjaiku">
    <meta property="og:description" content="@yield('meta_description', 'Sanjaiku — platform ...')">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:image"       content="{{ asset('assets/img/og-default.jpg') }}">

    {{-- Preconnect (cheap, high value) --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    {{-- Preload font files (yang paling sering dipakai) --}}
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/inter/inter-latin-400-normal.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/inter/inter-latin-600-normal.woff2') }}">

    {{-- Bootstrap CSS (non-blocking) --}}
    <link rel="preload"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    </noscript>

    {{-- Font Awesome CSS (non-blocking) --}}
    <link rel="preload"
          href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet"
              href="{{ asset('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    </noscript>

    {{-- Inter font: self-hosted, INLINED (tidak ada request CSS tambahan) --}}
    <style>
    @font-face{font-family:'Inter';font-style:normal;font-weight:400;font-display:swap;src:url('/fonts/inter/inter-latin-400-normal.woff2') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
    @font-face{font-family:'Inter';font-style:normal;font-weight:500;font-display:swap;src:url('/fonts/inter/inter-latin-500-normal.woff2') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
    @font-face{font-family:'Inter';font-style:normal;font-weight:600;font-display:swap;src:url('/fonts/inter/inter-latin-600-normal.woff2') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
    @font-face{font-family:'Inter';font-style:normal;font-weight:800;font-display:swap;src:url('/fonts/inter/inter-latin-800-normal.woff2') format('woff2');unicode-range:U+0000-00FF,U+0131,U+0152-0153,U+02BB-02BC,U+02C6,U+02DA,U+02DC,U+0304,U+0308,U+0329,U+2000-206F,U+20AC,U+2122,U+2191,U+2193,U+2212,U+2215,U+FEFF,U+FFFD}
    </style>

    {{-- Custom styles --}}
    <style>
        :root {
            --ink:      #191c1e;
            --ink-soft: #45464d;
            --brand:    #0051d5;
            --line:     #dfe2e6;
            --bg:       #f7f9fb;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
            background: var(--bg);
            color: var(--ink);
        }

        /* Navbar */
        .navbar {
            background: #fff !important;
            border-bottom: 1px solid var(--line);
            padding: .75rem 0;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -.02em;
            color: #131b2e !important;
        }
        .navbar-brand:hover { color: var(--brand) !important; }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--ink-soft) !important;
            padding: .5rem 1rem;
            transition: color .18s ease;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active { color: var(--brand) !important; }

        .navbar-toggler { border-color: var(--line); }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(19,27,46,0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Buttons */
        .btn-ink {
            background: var(--ink);
            color: #fff;
            border: none;
            font-weight: 600;
            border-radius: .85rem;
            padding: .5rem 1.25rem;
            transition: background .18s ease;
        }
        .btn-ink:hover { background: var(--brand); color: #fff; }

        .text-orange { color: var(--brand); }
        section { padding: 70px 0; }

        /* Skip link for a11y */
        .skip-link {
            position: absolute; left: -9999px; top: 0;
            background: #fff; color: var(--brand);
            padding: .5rem 1rem; z-index: 2000;
        }
        .skip-link:focus { left: 1rem; top: 1rem; }

        .sj-social-icons a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sj-social-icons i {
            width: 1em;
            height: 1em;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    @stack('styles')
</head>
<body>

    <a href="#main" class="skip-link">Lewati ke konten</a>

    @include('partials.navbar-landing')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer-landing')

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>