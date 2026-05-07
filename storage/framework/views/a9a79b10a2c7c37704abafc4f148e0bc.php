<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title', 'DevMantra'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Dev Mantra - Strategic partner in progress for businesses operating in a global and digital economy.'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- OG Tags -->
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', 'DevMantra'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('meta_description', 'Dev Mantra - Strategic partner in progress for businesses operating in a global and digital economy.'); ?>">
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <?php if (! empty(trim($__env->yieldContent('og_image')))): ?>
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>">
    <?php endif; ?>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>">

    <!-- Preconnect: establish TCP to external origins before any request is made -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://omnidim.io">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MHGXZHPY6P"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MHGXZHPY6P');
</script>

    <?php
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
    ?>
    
    <?php if($dmFontsUrl): ?>
    <link rel="stylesheet" href="<?php echo e($dmFontsUrl); ?>">
    <?php endif; ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/swiper-bundle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/spacing.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/main.css')); ?>">
    <style>
        /* Header always above GSAP ScrollSmoother wrapper */
        #header-sticky { z-index: 9999 !important; }
        /* Preloader above everything including header */
        #preloader { z-index: 99999 !important; }
        /* Hamburger — dark lines, animates to × when menu is open */
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
        /* × state */
        .dm-menu-open .tp-header-bar button i:nth-child(1) { transform: translateY(7px) rotate(45deg) !important; width: 24px !important; }
        .dm-menu-open .tp-header-bar button i:nth-child(2) { opacity: 0 !important; width: 24px !important; }
        .dm-menu-open .tp-header-bar button i:nth-child(3) { transform: translateY(-7px) rotate(-45deg) !important; width: 24px !important; }
    </style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    <?php
        $brandFrom = \App\Models\SiteSetting::get('brand_color_from', '#1b3c6b');
        $brandTo   = \App\Models\SiteSetting::get('brand_color_to',   '#4a73c4');
    ?>
    <style>
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
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>

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

    

    <!-- Rispose Agent Widget -->
    <script type="module">
        import { Agents } from "https://rispose.com/cdn/v1/sdk.es.js"
        const agent = Agents.getOrCreate('ag_qkd64r7kxxpt')
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
<?php /**PATH /home2/devmasjc/devmantra/resources/views/layouts/frontend.blade.php ENDPATH**/ ?>