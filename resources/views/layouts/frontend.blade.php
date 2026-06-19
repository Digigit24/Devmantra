<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @php
        $_s           = \App\Models\SiteSetting::all_cached();
        $seoDefTitle  = $_s['seo_default_title']        ?? 'DevMantra';
        $seoTitleSep  = $_s['seo_title_separator']      ?? '—';
        $seoDefDesc   = $_s['seo_default_description']  ?? 'Dev Mantra - Strategic partner in progress for businesses operating in a global and digital economy.';
        $seoDefOg     = $_s['seo_default_og_image']     ?? '';
        $seoRobots    = (($_s['seo_robots_mode'] ?? 'index') === 'noindex') ? 'noindex, nofollow' : 'index, follow';
        $seoVerify    = $_s['seo_google_verification']  ?? '';
        $seoGa4       = $_s['seo_ga4_id']              ?? 'G-MHGXZHPY6P';
        $seoGtm       = $_s['seo_gtm_id']              ?? '';
    @endphp
    @php
        // Build the page title once and de-duplicate a trailing brand suffix.
        // Some content stores meta_title already ending in "— DevMantra"; without this
        // the layout would append it again → "… — DevMantra — DevMantra".
        $__rawTitle  = trim(\Illuminate\Support\Facades\View::yieldContent('title'));
        $__rawTitle  = preg_replace('/\s*[-–—|:]\s*' . preg_quote($seoDefTitle, '/') . '\s*$/iu', '', $__rawTitle);
        $dmFullTitle = $__rawTitle !== '' ? $__rawTitle . ' ' . $seoTitleSep . ' ' . $seoDefTitle : $seoDefTitle;
    @endphp
    <title>{{ $dmFullTitle }}</title>
    <meta name="description" content="@hasSection('meta_description')@yield('meta_description')@else{{ $seoDefDesc }}@endif">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- OG Tags -->
    <meta property="og:title" content="{{ $dmFullTitle }}">
    <meta property="og:description" content="@hasSection('meta_description')@yield('meta_description')@else{{ $seoDefDesc }}@endif">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ request()->url() }}">
    @hasSection('og_image')
    <meta property="og:image" content="@yield('og_image')">
    @elseif($seoDefOg)
    <meta property="og:image" content="{{ $seoDefOg }}">
    @endif
    <meta property="og:site_name" content="{{ $seoDefTitle }}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $dmFullTitle }}">
    <meta name="twitter:description" content="@hasSection('meta_description')@yield('meta_description')@else{{ $seoDefDesc }}@endif">
    @hasSection('og_image')
    <meta name="twitter:image" content="@yield('og_image')">
    @elseif($seoDefOg)
    <meta name="twitter:image" content="{{ $seoDefOg }}">
    @endif
    @hasSection('noindex')<meta name="robots" content="noindex, nofollow">
    @else<meta name="robots" content="{{ $seoRobots }}">
    @endif
    @if($seoVerify)
    <meta name="google-site-verification" content="{{ $seoVerify }}">
    @endif
    <link rel="canonical" href="@hasSection('canonical_url')@yield('canonical_url')@else{{ request()->url() }}@endif">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}">

    <!-- Preconnect: establish TCP to external origins before any request is made -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://omnidim.io">
    {{-- Google Tag Manager (head snippet) --}}
    @if($seoGtm)
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $seoGtm }}');</script>
    @endif
    {{-- Google Analytics 4 --}}
    @if($seoGa4)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seoGa4 }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ $seoGa4 }}');
    </script>
    @endif

    @php
        // Collect selected typography fonts from settings (reuse $_s loaded above)
        $dmFontSettings = [
            'body' => $_s['font_body'] ?? '',
            'h1'   => $_s['font_h1']   ?? '',
            'h2'   => $_s['font_h2']   ?? '',
            'h3'   => $_s['font_h3']   ?? '',
            'h4'   => $_s['font_h4']   ?? '',
            'h5'   => $_s['font_h5']   ?? '',
            'h6'   => $_s['font_h6']   ?? '',
            'p'    => $_s['font_p']    ?? '',
        ];
        // Always include Onest (used on buttons) + any admin-selected fonts
        $dmGoogleFonts = array_merge(['Onest'], array_values($dmFontSettings));
        // If no body/heading font selected default to Inter
        if (!$dmFontSettings['body'] && !array_filter([$dmFontSettings['h1'],$dmFontSettings['h2'],$dmFontSettings['h3']])) {
            $dmGoogleFonts[] = 'Inter';
        }
        $dmFontsUrl = \App\Http\Controllers\Admin\TypographyController::buildGoogleFontsUrl($dmGoogleFonts);
        $dmFontMap  = collect(\App\Http\Controllers\Admin\TypographyController::FONTS)->keyBy('key')->all();
    @endphp
    {{-- Google Fonts: preload hint + non-blocking swap (media="print" trick) --}}
    @if($dmFontsUrl)
    <link rel="preload" as="style" href="{{ $dmFontsUrl }}">
    <link rel="stylesheet" href="{{ $dmFontsUrl }}" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="{{ $dmFontsUrl }}"></noscript>
    @endif

    <!-- CSS -->
    {{-- $assetVer: bump this string on every cPanel deploy to bust browser cache --}}
    @php $assetVer = '2025061301'; @endphp
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}?v={{ $assetVer }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}?v={{ $assetVer }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}?v={{ $assetVer }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v={{ $assetVer }}">
    {{-- FontAwesome: non-blocking — prints first, swaps to screen once loaded --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    @php
        $brandFrom = $_s['brand_color_from'] ?? '#1b3c6b';
        $brandTo   = $_s['brand_color_to']   ?? '#4a73c4';
    @endphp
    <style>
        /* ── Z-index layers ── */
        #header-sticky { z-index: 9999 !important; }
        /* ── Hamburger — dark lines, animates to × when menu is open ── */
        .tp-header-bar button {
            background: transparent !important;
            border: none !important;
            padding: 12px 10px !important;
            width: auto !important;
            min-width: 44px; min-height: 44px;
            cursor: pointer !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 5px !important;
            -webkit-tap-highlight-color: transparent;
        }
        .tp-header-bar button i {
            background-color: #001d30 !important;
            display: block !important;
            height: 2px !important;
            width: 24px !important;
            border-radius: 2px !important;
            transition: transform 0.3s ease, opacity 0.3s ease, width 0.3s ease !important;
            transform-origin: center !important;
        }
        .tp-header-bar button i:nth-child(2) { width: 18px !important; }
        .dm-menu-open .tp-header-bar button i:nth-child(1) { transform: translateY(7px) rotate(45deg) !important; width: 24px !important; }
        .dm-menu-open .tp-header-bar button i:nth-child(2) { opacity: 0 !important; width: 24px !important; }
        .dm-menu-open .tp-header-bar button i:nth-child(3) { transform: translateY(-7px) rotate(-45deg) !important; width: 24px !important; }
        /* ── Brand colour variables (editable from Admin → Settings) ── */
        :root {
            --dm-brand-from: {{ $brandFrom }};
            --dm-brand-to:   {{ $brandTo }};
            --dm-brand-gradient: linear-gradient(135deg, var(--dm-brand-from), var(--dm-brand-to));
            @if($dmFontSettings['body'])
            --tp-ff-body: '{{ $dmFontSettings['body'] }}', {{ $dmFontMap[$dmFontSettings['body']]['fallback'] ?? 'sans-serif' }};
            @endif
            @if($dmFontSettings['p'])
            --tp-ff-p: '{{ $dmFontSettings['p'] }}', {{ $dmFontMap[$dmFontSettings['p']]['fallback'] ?? 'sans-serif' }};
            @endif
        }
        @foreach(['h1','h2','h3','h4','h5','h6'] as $dmEl)
        @if(!empty($dmFontSettings[$dmEl]))
        {{ $dmEl }} { font-family: '{{ $dmFontSettings[$dmEl] }}', {{ $dmFontMap[$dmFontSettings[$dmEl]]['fallback'] ?? 'sans-serif' }} !important; }
        @endif
        @endforeach
        /* ── Unified global CTA buttons ─────────────────────────────── */
        .dm-btn-primary,
        .dm-btn-secondary {
            display: inline-flex; align-items: center; gap: 10px;
            padding: 13px 28px;
            background: var(--dm-brand-gradient);
            color: #fff !important;
            font-size: 15px; font-weight: 600;
            border-radius: 30px;
            text-decoration: none !important;
            white-space: nowrap;
            transition: opacity 0.25s, transform 0.25s, box-shadow 0.25s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.18);
            font-family: var(--tp-ff-onest, inherit);
            cursor: pointer; border: none;
        }
        .dm-btn-primary:hover,
        .dm-btn-secondary:hover {
            opacity: 0.88;
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.25);
            color: #fff !important;
        }
        .dm-btn-primary span,
        .dm-btn-secondary span { display: inline-flex; align-items: center; }
        .dm-btn-primary.dm-btn-sm,
        .dm-btn-secondary.dm-btn-sm { font-size: 13px; padding: 10px 18px; }
        @media (max-width: 575px) {
            .dm-btn-primary, .dm-btn-secondary { font-size: 13px; padding: 12px 22px; }
        }
        /* ── Third-party widget overrides (must stay after all other rules) ── */
        .bg-stone-50 { display: none !important; }
    </style>

    @stack('styles')

    {{-- Per-page JSON-LD structured data --}}
    @stack('schema')

    {{-- Per-page custom <head> code (from admin SEO panel) --}}
    @stack('custom_head')
</head>

<body class="tp-magic-cursor agntix-light">

    {{-- ── Page Shimmer (minimal, hides on DOMContentLoaded, hard cap 1.5s) ── --}}
    <div id="dm-shimmer">
        <div id="dm-shimmer-bar"></div>
    </div>
    <style>
    #dm-shimmer{
        position:fixed;inset:0;z-index:999999;
        background:#060f1e;
        opacity:1;
        transition:opacity .35s ease;
        pointer-events:none;
    }
    #dm-shimmer-bar{
        position:absolute;top:0;left:0;height:3px;width:0;
        background:linear-gradient(90deg,#3b6fd4 0%,#638ddb 60%,#3b6fd4 100%);
        background-size:200% 100%;
        animation:dm-bar-fill 1.4s ease-out forwards, dm-bar-shine .9s linear infinite;
    }
    @keyframes dm-bar-fill{
        0%  {width:0%}
        60% {width:80%}
        100%{width:95%}
    }
    @keyframes dm-bar-shine{
        0%  {background-position:200% 0}
        100%{background-position:-200% 0}
    }
    </style>
    <script>
    (function(){
        var el=document.getElementById('dm-shimmer');
        var bar=document.getElementById('dm-shimmer-bar');
        var gone=false;
        function hide(){
            if(gone)return;gone=true;
            bar.style.transition='width .2s ease';
            bar.style.width='100%';
            setTimeout(function(){
                el.style.opacity='0';
                setTimeout(function(){el.style.display='none';},360);
            },150);
        }
        // Hide as soon as DOM is parsed — don't wait for images/scripts
        if(document.readyState==='loading'){
            document.addEventListener('DOMContentLoaded',hide);
        } else { hide(); }
        // Hard cap: always gone by 1.5s
        setTimeout(hide,1500);
    })();
    </script>

    {{-- Google Tag Manager (noscript fallback) --}}
    @if($seoGtm)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seoGtm }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    <!-- magic cursor -->
    <div id="magic-cursor" class="cursor-white-bg">
        <div id="ball"></div>
    </div>

    <!-- back to top -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    @include('frontend.partials.header')

    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>
                @yield('content')
            </main>

            @include('frontend.partials.footer')
        </div>
    </div>

    <!-- JS — all deferred so they never block HTML rendering -->
    <script src="{{ asset('assets/js/vendor/jquery.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/plugin.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/purecounter.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/Observer.min.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/splitting.min.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/slider-active.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/tp-cursor.js') }}?v={{ $assetVer }}" defer></script>
    <script src="{{ asset('assets/js/portfolio-slider-1.js') }}?v={{ $assetVer }}" defer></script>

    @stack('scripts')

    @include('frontend.partials.consultation-modal')
    @include('frontend.partials.popup')

    <!-- Conferbot chat widget — lazy-loaded on first interaction (scroll/click/key/touch) -->
    <script>
    (function () {
        var loaded = false;
        function loadConferbot() {
            if (loaded) return;
            loaded = true;
            (function (d, s, id) {
                var js, el = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.async = true;
                js.src = 'https://cdn.conferbot.com/dist/v1/widget.min.js';
                js.id = id;
                js.charset = 'UTF-8';
                el.parentNode.insertBefore(js, el);
                js.onload = function () {
                    window.ConferbotWidget('69fcf4831142c8b2c5c9dbb4', 'live_chat');
                };
            })(document, 'script', 'conferbot-js');
        }
        ['scroll', 'click', 'keydown', 'touchstart', 'mousemove'].forEach(function (ev) {
            window.addEventListener(ev, loadConferbot, { once: true, passive: true });
        });
        setTimeout(loadConferbot, 7000);
    })();
    </script>

    <!-- Mobile menu toggle — plain JS, no defer, runs immediately -->
    <script>
    (function () {
        var isOpen = false;
        function dmOpenMenu() {
            isOpen = true;
            document.querySelector('.tp-offcanvas-area').classList.add('opened');
            document.querySelector('.body-overlay').classList.add('opened');
            document.body.classList.add('dm-menu-open');
        }
        function dmCloseMenu() {
            isOpen = false;
            document.querySelector('.tp-offcanvas-area').classList.remove('opened');
            document.querySelector('.body-overlay').classList.remove('opened');
            document.body.classList.remove('dm-menu-open');
        }
        function dmToggleMenu() { isOpen ? dmCloseMenu() : dmOpenMenu(); }
        document.addEventListener('click', function (e) {
            if (e.target.closest('.tp-offcanvas-open-btn'))  { dmToggleMenu(); return; }
            if (e.target.closest('.tp-offcanvas-close-btn')) { dmCloseMenu(); return; }
            if (e.target.matches('.body-overlay'))            { dmCloseMenu(); return; }
        });
        document.addEventListener('touchend', function (e) {
            if (e.target.closest('.tp-offcanvas-open-btn'))  { e.preventDefault(); dmToggleMenu(); return; }
            if (e.target.closest('.tp-offcanvas-close-btn')) { e.preventDefault(); dmCloseMenu(); return; }
        }, { passive: false });
    })();
    </script>
</body>
</html>
