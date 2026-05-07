<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevMantra — Links</title>
    <meta name="description" content="All important links from DevMantra — your strategic partner in progress.">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #001d30;
            --bg-card:    rgba(255,255,255,0.06);
            --bg-card-hover: rgba(255,255,255,0.11);
            --accent:     #4a73c4;
            --accent-glow: rgba(74,115,196,0.35);
            --text-white: #ffffff;
            --text-muted: rgba(255,255,255,0.55);
            --border:     rgba(255,255,255,0.12);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            min-height: 100vh;
            color: var(--text-white);
            -webkit-font-smoothing: antialiased;
        }

        /* ── Ambient glow ── */
        body::before {
            content: '';
            position: fixed;
            top: -200px; left: 50%; transform: translateX(-50%);
            width: 700px; height: 700px;
            background: radial-gradient(circle, rgba(74,115,196,0.18) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Scrollable container ── */
        .bm-wrap {
            position: relative;
            z-index: 1;
            max-width: 520px;
            margin: 0 auto;
            padding: 48px 20px 80px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── Header ── */
        .bm-header {
            text-align: center;
            margin-bottom: 36px;
            width: 100%;
        }
        .bm-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            border-radius: 16px;
            background: rgba(255,255,255,0.08);
            border: 2px solid rgba(255,255,255,0.15);
            margin-bottom: 16px;
            box-shadow: 0 0 40px rgba(74,115,196,0.3);
        }
        .bm-logo-wrap img {
            height: 64px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
            display: block;
        }
        .bm-name {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.3px;
            color: var(--text-white);
            margin-bottom: 8px;
        }
        .bm-tagline {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.5;
            max-width: 340px;
            margin: 0 auto;
        }

        /* ── Social icons ── */
        .bm-socials {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 20px 0 0;
        }
        .bm-social-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px; height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: 1px solid var(--border);
            color: var(--text-muted);
            font-size: 16px;
            text-decoration: none;
            transition: background .2s, color .2s, transform .2s, box-shadow .2s;
        }
        .bm-social-btn:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px var(--accent-glow);
        }

        /* ── Divider ── */
        .bm-divider {
            width: 100%;
            height: 1px;
            background: var(--border);
            margin: 28px 0;
        }

        /* ── Links list ── */
        .bm-links {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        /* ── Single link button ── */
        .bm-link {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--text-white);
            border: 1.5px solid rgba(255,255,255,0.9);
            border-radius: 16px;
            padding: 16px 20px;
            text-decoration: none;
            color: var(--bg);
            transition: transform .2s cubic-bezier(.34,1.56,.64,1),
                        box-shadow .2s,
                        background .2s;
            position: relative;
            overflow: hidden;
        }
        .bm-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #1b3c6b, #4a73c4);
            opacity: 0;
            transition: opacity .25s;
            border-radius: inherit;
        }
        .bm-link:hover {
            transform: translateY(-3px) scale(1.015);
            box-shadow: 0 12px 36px rgba(0,0,0,0.35), 0 0 0 1px rgba(74,115,196,0.4);
        }
        .bm-link:hover::before { opacity: 1; }
        .bm-link:hover .bm-link-icon,
        .bm-link:hover .bm-link-title,
        .bm-link:hover .bm-link-desc { color: #fff; }
        .bm-link:active { transform: translateY(-1px) scale(1.005); }

        .bm-link-icon {
            position: relative;
            z-index: 1;
            font-size: 22px;
            color: #1b3c6b;
            width: 30px;
            text-align: center;
            flex-shrink: 0;
            transition: color .25s;
        }

        .bm-link-body {
            position: relative;
            z-index: 1;
            flex: 1;
            min-width: 0;
        }
        .bm-link-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f1f2e;
            line-height: 1.3;
            transition: color .25s;
        }
        .bm-link-desc {
            font-size: 12px;
            color: #64748b;
            margin-top: 3px;
            line-height: 1.4;
            transition: color .25s;
        }

        .bm-link-arrow {
            position: relative;
            z-index: 1;
            font-size: 13px;
            color: #94a3b8;
            flex-shrink: 0;
            transition: color .25s, transform .2s;
        }
        .bm-link:hover .bm-link-arrow {
            color: rgba(255,255,255,0.7);
            transform: translateX(3px);
        }

        /* ── Empty state ── */
        .bm-empty {
            text-align: center;
            color: var(--text-muted);
            padding: 40px 0;
        }
        .bm-empty i { font-size: 36px; display: block; margin-bottom: 12px; }

        /* ── Footer ── */
        .bm-footer {
            margin-top: 48px;
            text-align: center;
            color: rgba(255,255,255,0.25);
            font-size: 12px;
        }
        .bm-footer a {
            color: rgba(255,255,255,0.35);
            text-decoration: none;
            transition: color .2s;
        }
        .bm-footer a:hover { color: rgba(255,255,255,0.7); }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .bm-header   { animation: fadeUp .5s ease both; }
        .bm-divider  { animation: fadeUp .5s .1s ease both; }
        .bm-link:nth-child(1)  { animation: fadeUp .4s .15s ease both; }
        .bm-link:nth-child(2)  { animation: fadeUp .4s .22s ease both; }
        .bm-link:nth-child(3)  { animation: fadeUp .4s .29s ease both; }
        .bm-link:nth-child(4)  { animation: fadeUp .4s .36s ease both; }
        .bm-link:nth-child(5)  { animation: fadeUp .4s .43s ease both; }
        .bm-link:nth-child(6)  { animation: fadeUp .4s .50s ease both; }
        .bm-link:nth-child(7)  { animation: fadeUp .4s .57s ease both; }
        .bm-link:nth-child(8)  { animation: fadeUp .4s .64s ease both; }
        .bm-link:nth-child(n+9){ animation: fadeUp .4s .70s ease both; }

        /* ── Responsive ── */
        @media (max-width: 540px) {
            .bm-wrap { padding: 36px 16px 60px; }
            .bm-name { font-size: 20px; }
            .bm-link { padding: 14px 16px; }
            .bm-link-title { font-size: 14px; }
        }
    </style>
</head>
<body>
<div class="bm-wrap">

    <!-- Header -->
    <div class="bm-header">
        <div class="bm-logo-wrap">
            <img src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="DevMantra Logo">
        </div>
        <div class="bm-name">DevMantra</div>
        <div class="bm-tagline">Strategic partner in progress for businesses operating in a global and digital economy.</div>

        <!-- Social quick links -->
        <div class="bm-socials">
            <a href="https://www.linkedin.com/company/devmantra" target="_blank" rel="noopener" class="bm-social-btn" title="LinkedIn">
                <i class="fa-brands fa-linkedin-in"></i>
            </a>
            <a href="https://www.instagram.com/devmantra" target="_blank" rel="noopener" class="bm-social-btn" title="Instagram">
                <i class="fa-brands fa-instagram"></i>
            </a>
            <a href="https://twitter.com/devmantra" target="_blank" rel="noopener" class="bm-social-btn" title="X / Twitter">
                <i class="fa-brands fa-x-twitter"></i>
            </a>
            <a href="https://www.youtube.com/@devmantra" target="_blank" rel="noopener" class="bm-social-btn" title="YouTube">
                <i class="fa-brands fa-youtube"></i>
            </a>
            <a href="<?php echo e(route('home')); ?>" class="bm-social-btn" title="Website">
                <i class="fa-solid fa-globe"></i>
            </a>
        </div>
    </div>

    <div class="bm-divider"></div>

    <!-- Links -->
    <div class="bm-links">
        <?php $__empty_1 = true; $__currentLoopData = $bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookmark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e($bookmark->url); ?>" target="_blank" rel="noopener" class="bm-link">
            <?php if($bookmark->icon): ?>
            <span class="bm-link-icon"><i class="<?php echo e($bookmark->icon); ?>"></i></span>
            <?php else: ?>
            <span class="bm-link-icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
            <?php endif; ?>
            <div class="bm-link-body">
                <div class="bm-link-title"><?php echo e($bookmark->title); ?></div>
                <?php if($bookmark->description): ?>
                <div class="bm-link-desc"><?php echo e($bookmark->description); ?></div>
                <?php endif; ?>
            </div>
            <span class="bm-link-arrow"><i class="fa-solid fa-chevron-right"></i></span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bm-empty">
            <i class="fa-solid fa-link"></i>
            No links added yet.
        </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div class="bm-footer">
        <a href="<?php echo e(route('home')); ?>">devmantra.in</a>
        &nbsp;·&nbsp; &copy; <?php echo e(date('Y')); ?> DevMantra
    </div>

</div>
</body>
</html>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/frontend/bookmarks.blade.php ENDPATH**/ ?>