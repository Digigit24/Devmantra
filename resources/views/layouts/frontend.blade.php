<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'DevMantra')</title>
    <meta name="description" content="@yield('meta_description', 'Dev Mantra - Strategic partner in progress for businesses operating in a global and digital economy.')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- OG Tags -->
    <meta property="og:title" content="@yield('title', 'DevMantra')">
    <meta property="og:description" content="@yield('meta_description', 'Dev Mantra - Strategic partner in progress for businesses operating in a global and digital economy.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection('og_image')
    <meta property="og:image" content="@yield('og_image')">
    @endif
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}">

    <!-- Preconnect: establish TCP to external origins before any request is made -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://omnidim.io">

    @php
        // Collect selected typography fonts from settings
        $dmFontSettings = [
            'body' => \App\Models\SiteSetting::get('font_body', ''),
            'h1'   => \App\Models\SiteSetting::get('font_h1',   ''),
            'h2'   => \App\Models\SiteSetting::get('font_h2',   ''),
            'h3'   => \App\Models\SiteSetting::get('font_h3',   ''),
            'h4'   => \App\Models\SiteSetting::get('font_h4',   ''),
            'h5'   => \App\Models\SiteSetting::get('font_h5',   ''),
            'h6'   => \App\Models\SiteSetting::get('font_h6',   ''),
            'p'    => \App\Models\SiteSetting::get('font_p',    ''),
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
    {{-- Google Fonts: only load fonts actually in use (selected in Admin → Typography) --}}
    @if($dmFontsUrl)
    <link rel="stylesheet" href="{{ $dmFontsUrl }}">
    @endif

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    {{-- FontAwesome: non-blocking — prints first, swaps to screen once loaded --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    @php
        $brandFrom = \App\Models\SiteSetting::get('brand_color_from', '#1b3c6b');
        $brandTo   = \App\Models\SiteSetting::get('brand_color_to',   '#4a73c4');
    @endphp
    <style>
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
    </style>

    @stack('styles')

    <!-- Widget / third-party overrides — must stay last in <head> -->
    <style>
        .bg-stone-50 { display: none !important; }
    </style>
</head>

<body class="tp-magic-cursor agntix-light">

    <!-- magic cursor -->
    <div id="magic-cursor" class="cursor-white-bg">
        <div id="ball"></div>
    </div>

    <!-- preloader -->
    <div id="preloader">
        <div class="preloader">
            <span></span>
            <span></span>
        </div>
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
    <script src="{{ asset('assets/js/vendor/jquery.js') }}" defer></script>
    <script src="{{ asset('assets/js/bootstrap-bundle.js') }}" defer></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugin.js') }}" defer></script>
    <script src="{{ asset('assets/js/purecounter.js') }}" defer></script>
    <script src="{{ asset('assets/js/Observer.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/splitting.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/slider-active.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
    <script src="{{ asset('assets/js/tp-cursor.js') }}" defer></script>
    <script src="{{ asset('assets/js/portfolio-slider-1.js') }}" defer></script>

    @stack('scripts')

    @include('frontend.partials.consultation-modal')
    @include('frontend.partials.popup')

    {{-- OmniDimension Chatbot — commented out, replaced with Rispose
    <script>
    (function () {
        var loaded = false;
        function loadChatbot() {
            if (loaded) return;
            loaded = true;
            var s = document.createElement('script');
            s.id  = 'omnidimension-web-widget';
            s.src = 'https://omnidim.io/web_widget.js?secret_key=0aa1ca1064aabd91ea50c5544319e2bd';
            document.body.appendChild(s);
        }
        ['scroll', 'click', 'keydown', 'touchstart', 'mousemove'].forEach(function (ev) {
            window.addEventListener(ev, loadChatbot, { once: true, passive: true });
        });
        setTimeout(loadChatbot, 8000);
    })();
    </script>
    --}}

    <!-- Rispose Agent Widget -->
    <script type="module">
        import { Agents } from "https://rispose.com/cdn/v1/sdk.es.js"
        const agent = Agents.getOrCreate('ag_qkd64r7kxxpt')
    </script>
</body>
</html>
