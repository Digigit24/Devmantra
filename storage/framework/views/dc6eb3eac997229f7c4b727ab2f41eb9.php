<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php
        $_s           = \App\Models\SiteSetting::all_cached();
        $seoDefTitle  = $_s['seo_default_title']        ?? 'DevMantra';
        $seoTitleSep  = $_s['seo_title_separator']      ?? '—';
        $seoDefDesc   = $_s['seo_default_description']  ?? 'Dev Mantra - Strategic partner in progress for businesses operating in a global and digital economy.';
        $seoDefOg     = $_s['seo_default_og_image']     ?? '';
        $seoRobots    = (($_s['seo_robots_mode'] ?? 'index') === 'noindex') ? 'noindex, nofollow' : 'index, follow';
        $seoVerify    = $_s['seo_google_verification']  ?? '';
        $seoGa4       = $_s['seo_ga4_id']              ?? 'G-MHGXZHPY6P';
        $seoGtm       = $_s['seo_gtm_id']              ?? '';
    ?>
    <?php
        // Build the page title once and de-duplicate a trailing brand suffix.
        // Some content stores meta_title already ending in "— DevMantra"; without this
        // the layout would append it again → "… — DevMantra — DevMantra".
        $__rawTitle  = trim(\Illuminate\Support\Facades\View::yieldContent('title'));
        $__rawTitle  = preg_replace('/\s*[-–—|:]\s*' . preg_quote($seoDefTitle, '/') . '\s*$/iu', '', $__rawTitle);
        $dmFullTitle = $__rawTitle !== '' ? $__rawTitle . ' ' . $seoTitleSep . ' ' . $seoDefTitle : $seoDefTitle;
    ?>
    <title><?php echo e($dmFullTitle); ?></title>
    <meta name="description" content="<?php if (! empty(trim($__env->yieldContent('meta_description')))): ?><?php echo $__env->yieldContent('meta_description'); ?><?php else: ?><?php echo e($seoDefDesc); ?><?php endif; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- OG Tags -->
    <meta property="og:title" content="<?php echo e($dmFullTitle); ?>">
    <meta property="og:description" content="<?php if (! empty(trim($__env->yieldContent('meta_description')))): ?><?php echo $__env->yieldContent('meta_description'); ?><?php else: ?><?php echo e($seoDefDesc); ?><?php endif; ?>">
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:url" content="<?php echo e(request()->url()); ?>">
    <?php if (! empty(trim($__env->yieldContent('og_image')))): ?>
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>">
    <?php elseif($seoDefOg): ?>
    <meta property="og:image" content="<?php echo e($seoDefOg); ?>">
    <?php endif; ?>
    <meta property="og:site_name" content="<?php echo e($seoDefTitle); ?>">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($dmFullTitle); ?>">
    <meta name="twitter:description" content="<?php if (! empty(trim($__env->yieldContent('meta_description')))): ?><?php echo $__env->yieldContent('meta_description'); ?><?php else: ?><?php echo e($seoDefDesc); ?><?php endif; ?>">
    <?php if (! empty(trim($__env->yieldContent('og_image')))): ?>
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('og_image'); ?>">
    <?php elseif($seoDefOg): ?>
    <meta name="twitter:image" content="<?php echo e($seoDefOg); ?>">
    <?php endif; ?>
    <?php if (! empty(trim($__env->yieldContent('noindex')))): ?><meta name="robots" content="noindex, nofollow">
    <?php else: ?><meta name="robots" content="<?php echo e($seoRobots); ?>">
    <?php endif; ?>
    <?php if($seoVerify): ?>
    <meta name="google-site-verification" content="<?php echo e($seoVerify); ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?php if (! empty(trim($__env->yieldContent('canonical_url')))): ?><?php echo $__env->yieldContent('canonical_url'); ?><?php else: ?><?php echo e(request()->url()); ?><?php endif; ?>">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>">

    <!-- Preconnect: establish TCP to external origins before any request is made -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://omnidim.io">
    
    <?php if($seoGtm): ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo e($seoGtm); ?>');</script>
    <?php endif; ?>
    
    <?php if($seoGa4): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($seoGa4); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '<?php echo e($seoGa4); ?>');
    </script>
    <?php endif; ?>

    <?php
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
    ?>
    
    <?php if($dmFontsUrl): ?>
    <link rel="preload" as="style" href="<?php echo e($dmFontsUrl); ?>">
    <link rel="stylesheet" href="<?php echo e($dmFontsUrl); ?>" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="<?php echo e($dmFontsUrl); ?>"></noscript>
    <?php endif; ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/swiper-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/spacing.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    <?php
        $brandFrom = $_s['brand_color_from'] ?? '#1b3c6b';
        $brandTo   = $_s['brand_color_to']   ?? '#4a73c4';
    ?>
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
            --dm-brand-from: <?php echo e($brandFrom); ?>;
            --dm-brand-to:   <?php echo e($brandTo); ?>;
            --dm-brand-gradient: linear-gradient(135deg, var(--dm-brand-from), var(--dm-brand-to));
            <?php if($dmFontSettings['body']): ?>
            --tp-ff-body: '<?php echo e($dmFontSettings['body']); ?>', <?php echo e($dmFontMap[$dmFontSettings['body']]['fallback'] ?? 'sans-serif'); ?>;
            <?php endif; ?>
            <?php if($dmFontSettings['p']): ?>
            --tp-ff-p: '<?php echo e($dmFontSettings['p']); ?>', <?php echo e($dmFontMap[$dmFontSettings['p']]['fallback'] ?? 'sans-serif'); ?>;
            <?php endif; ?>
        }
        <?php $__currentLoopData = ['h1','h2','h3','h4','h5','h6']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dmEl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($dmFontSettings[$dmEl])): ?>
        <?php echo e($dmEl); ?> { font-family: '<?php echo e($dmFontSettings[$dmEl]); ?>', <?php echo e($dmFontMap[$dmFontSettings[$dmEl]]['fallback'] ?? 'sans-serif'); ?> !important; }
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    <?php echo $__env->yieldPushContent('styles'); ?>

    
    <?php echo $__env->yieldPushContent('schema'); ?>

    
    <?php echo $__env->yieldPushContent('custom_head'); ?>
</head>

<body class="tp-magic-cursor agntix-light">

    
    <div id="dm-loader">
        <div class="dm-l-aurora"></div>
        <div class="dm-l-ring" style="--d:0s"></div>
        <div class="dm-l-ring" style="--d:.9s"></div>
        <div class="dm-l-ring" style="--d:1.8s"></div>
        <div class="dm-l-stage">
            <div class="dm-l-orbit" style="--s:160px;--dur:3.2s;--dir:1"></div>
            <div class="dm-l-orbit" style="--s:220px;--dur:5s;--dir:-1"></div>
            <img src="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>" alt="DevMantra" class="dm-l-logo" width="130" height="130">
        </div>
        <div class="dm-l-dots"><span></span><span></span><span></span></div>
    </div>
    <style>
    #dm-loader{
        position:fixed;inset:0;z-index:999999;overflow:hidden;
        background:radial-gradient(ellipse at 40% 40%,#1b3c6b 0%,#0d1f3c 60%,#060f1e 100%);
        display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2.5rem;
        transition:opacity .6s ease,transform .6s ease;
    }

    /* ── Aurora shimmer ── */
    .dm-l-aurora{
        position:absolute;inset:0;pointer-events:none;
        background:
            radial-gradient(ellipse 70% 50% at 20% 30%,rgba(74,115,196,.28) 0%,transparent 60%),
            radial-gradient(ellipse 55% 45% at 80% 70%,rgba(27,60,107,.45) 0%,transparent 60%),
            radial-gradient(ellipse 40% 60% at 60% 20%,rgba(99,141,219,.18) 0%,transparent 55%);
        animation:dm-aurora 7s ease-in-out infinite alternate;
    }
    @keyframes dm-aurora{
        0%  {opacity:.6;transform:scale(1)   rotate(0deg)}
        50% {opacity:1; transform:scale(1.15) rotate(8deg)}
        100%{opacity:.7;transform:scale(1.05) rotate(-4deg)}
    }

    /* ── Ripple rings ── */
    .dm-l-ring{
        position:absolute;
        width:200px;height:200px;
        border-radius:50%;
        border:1.5px solid rgba(74,115,196,.55);
        animation:dm-ripple 2.7s ease-out infinite;
        animation-delay:var(--d);
        pointer-events:none;
    }
    @keyframes dm-ripple{
        0%  {transform:scale(.5);opacity:.7}
        100%{transform:scale(4);opacity:0}
    }

    /* ── Centre stage ── */
    .dm-l-stage{
        position:relative;
        width:200px;height:200px;
        display:flex;align-items:center;justify-content:center;
        flex-shrink:0;
    }

    /* ── Orbit arcs ── */
    .dm-l-orbit{
        position:absolute;
        width:var(--s);height:var(--s);
        border-radius:50%;
        border:1px dashed rgba(99,141,219,.35);
        animation:dm-spin calc(var(--dur)) linear infinite;
        animation-direction:calc(var(--dir) * 1s > 0s ? normal : reverse);
    }
    /* inline calc on animation-direction won't work — use two classes instead */
    .dm-l-orbit:nth-child(1){animation:dm-spin-cw  3.2s linear infinite}
    .dm-l-orbit:nth-child(2){animation:dm-spin-ccw 5s   linear infinite}
    @keyframes dm-spin-cw {from{transform:rotate(0deg)}  to{transform:rotate(360deg)}}
    @keyframes dm-spin-ccw{from{transform:rotate(0deg)}  to{transform:rotate(-360deg)}}

    /* dot on each orbit arc */
    .dm-l-orbit::after{
        content:'';position:absolute;top:-4px;left:50%;
        width:8px;height:8px;margin-left:-4px;
        border-radius:50%;
        background:rgba(99,141,219,.9);
        box-shadow:0 0 8px 2px rgba(74,115,196,.7);
    }

    /* ── Logo ── */
    .dm-l-logo{
        position:relative;z-index:2;
        width:130px;height:auto;
        user-select:none;pointer-events:none;
        animation:
            dm-spring  2.4s cubic-bezier(.36,.07,.19,.97) infinite,
            dm-glow    3s   ease-in-out              infinite,
            dm-tilt    6s   ease-in-out              infinite;
        will-change:transform,filter;
        transform-origin:center bottom;
    }

    /* Spring bounce with proper squash-and-stretch */
    @keyframes dm-spring{
        0%  {transform:translateY(0)    scale(1,1)      rotate(0deg)}
        12% {transform:translateY(-36px) scale(1.06,.95) rotate(-1.5deg)}
        24% {transform:translateY(6px)  scale(.95,1.06) rotate(.8deg)}
        36% {transform:translateY(-18px) scale(1.04,.97) rotate(-.8deg)}
        48% {transform:translateY(3px)  scale(.98,1.03) rotate(.4deg)}
        60% {transform:translateY(-8px) scale(1.02,.99) rotate(-.3deg)}
        72% {transform:translateY(1px)  scale(.99,1.01) rotate(.1deg)}
        84% {transform:translateY(-3px) scale(1.01,1)   rotate(0deg)}
        100%{transform:translateY(0)    scale(1,1)      rotate(0deg)}
    }

    /* Brand-blue glow pulse */
    @keyframes dm-glow{
        0%,100%{filter:drop-shadow(0 0 10px rgba(74,115,196,.45)) drop-shadow(0 0 30px rgba(27,60,107,.3))  brightness(1)}
        50%    {filter:drop-shadow(0 0 28px rgba(99,141,219,.95)) drop-shadow(0 0 70px rgba(74,115,196,.55)) brightness(1.12)}
    }

    /* Slow pendulum tilt */
    @keyframes dm-tilt{
        0%,100%{--tilt:0deg}
        25%    {--tilt:2deg}
        75%    {--tilt:-2deg}
    }

    /* ── Loading dots ── */
    .dm-l-dots{display:flex;gap:.55rem;align-items:center}
    .dm-l-dots span{
        display:block;width:8px;height:8px;border-radius:50%;
        background:rgba(74,115,196,.7);
        animation:dm-dot 1.4s ease-in-out infinite;
    }
    .dm-l-dots span:nth-child(1){animation-delay:0s}
    .dm-l-dots span:nth-child(2){animation-delay:.22s}
    .dm-l-dots span:nth-child(3){animation-delay:.44s}
    @keyframes dm-dot{
        0%,80%,100%{transform:scale(.55) translateY(0);opacity:.3;background:rgba(74,115,196,.5)}
        40%        {transform:scale(1.15) translateY(-6px);opacity:1;background:rgba(99,141,219,1);
                    box-shadow:0 0 10px rgba(74,115,196,.8)}
    }

    @media(max-width:768px){
        .dm-l-logo{width:100px}
        .dm-l-ring{width:150px;height:150px}
    }
    </style>
    <script>
    window.addEventListener('load',function(){
        var l=document.getElementById('dm-loader');
        setTimeout(function(){
            l.style.opacity='0';
            l.style.transform='scale(1.04)';
            setTimeout(function(){l.style.display='none'},600);
        },400);
    });
    </script>

    
    <?php if($seoGtm): ?>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo e($seoGtm); ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php endif; ?>

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

    <?php echo $__env->make('frontend.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <?php echo $__env->make('frontend.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- JS — all deferred so they never block HTML rendering -->
    <script src="<?php echo e(asset('assets/js/vendor/jquery.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/bootstrap-bundle.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/swiper-bundle.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/plugin.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/purecounter.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/Observer.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/splitting.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/slider-active.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/tp-cursor.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/portfolio-slider-1.js')); ?>" defer></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php echo $__env->make('frontend.partials.consultation-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('frontend.partials.popup', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>