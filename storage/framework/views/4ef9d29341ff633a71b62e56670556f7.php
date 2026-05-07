<?php $__env->startSection('title', 'Newsletter - DevMantra'); ?>
<?php $__env->startSection('meta_description', 'Get the latest on corporate governance, regulatory changes, tax alerts, and strategic business advisory.'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .dm-newsletter-hero { background-color: #001d30; padding: 200px 0 120px; }
    @media (max-width: 767px) { .dm-newsletter-hero { padding: 150px 0 70px; } }
    .dm-newsletter-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; font-family: var(--tp-ff-onest); }

    /* Subscribe widget */
    .dm-subscribe-widget { margin-top: 40px; max-width: 400px; }
    .dm-sub-trigger {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 13px 26px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.25);
        background: rgba(255,255,255,0.08); color: #fff;
        font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest);
        cursor: pointer; transition: background 0.25s, border-color 0.25s;
    }
    .dm-sub-trigger:hover { background: rgba(255,255,255,0.15); border-color: rgba(255,255,255,0.4); }
    .dm-sub-panel {
        max-height: 0; overflow: hidden;
        transition: max-height 0.4s ease, opacity 0.35s ease;
        opacity: 0;
    }
    .dm-sub-panel.open { max-height: 220px; opacity: 1; }
    .dm-sub-inner { padding-top: 16px; display: flex; flex-direction: column; gap: 10px; }
    .dm-sub-input {
        width: 100%; padding: 13px 16px; box-sizing: border-box;
        background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18);
        border-radius: 8px; color: #fff; font-size: 14px; font-family: var(--tp-ff-onest);
        outline: none; transition: border-color 0.2s, background 0.2s;
    }
    .dm-sub-input::placeholder { color: rgba(255,255,255,0.38); }
    .dm-sub-input:focus { border-color: rgba(255,255,255,0.55); background: rgba(255,255,255,0.12); }
    .dm-sub-btn {
        width: 100%; padding: 13px 20px; border-radius: 8px; border: none; cursor: pointer;
        font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest);
        background: #fff; color: #001d30;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: all 0.3s ease;
    }
    .dm-sub-btn:hover:not(:disabled) { background: rgba(255,255,255,0.88); }
    .dm-sub-btn:disabled { cursor: default; }
    .dm-sub-btn.loading { background: rgba(255,255,255,0.55); color: #001d30; }
    .dm-sub-btn.success { background: #22c55e; color: #fff; }
    .dm-sub-btn.already { background: rgba(255,255,255,0.2); color: #fff; }
    .dm-sub-msg { font-size: 13px; font-family: var(--tp-ff-onest); margin-top: 6px; min-height: 18px; }
    .dm-sub-msg.error { color: #f87171; }
    .dm-sub-msg.success { color: #86efac; }
    .dm-sub-msg.already { color: rgba(255,255,255,0.6); }
    .dm-past-editions { padding: 100px 0; }
    @media (max-width: 767px) { .dm-past-editions { padding: 60px 0; } }

    /* Featured Newsletter */
    .dm-newsletter-featured { border-bottom: 1px solid var(--tp-border-1,#eee); padding-bottom: 60px; margin-bottom: 60px; }
    .dm-newsletter-featured-thumb img { width: 100%; height: 380px; object-fit: cover; border-radius: 12px; }
    .dm-newsletter-featured-title { font-size: 32px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 16px; line-height: 1.3; font-family: var(--tp-ff-onest); }
    .dm-newsletter-featured-title a { color: inherit; text-decoration: none; }
    .dm-newsletter-featured-title a:hover { opacity: 0.7; }

    /* Edition Cards */
    .dm-edition-card { margin-bottom: 40px; transition: transform 0.3s; }
    .dm-edition-card:hover { transform: translateY(-4px); }
    .dm-edition-card-thumb img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; }
    .dm-edition-card-date {
        font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        color: rgba(0,0,0,0.4); display: inline-flex; align-items: center; gap: 8px;
        margin: 16px 0 8px; font-family: var(--tp-ff-onest);
    }
    .dm-edition-card-date i { font-size: 12px; color: rgba(0,0,0,0.25); }
    .dm-edition-card-title { font-size: 20px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 12px; line-height: 1.4; font-family: var(--tp-ff-onest); }
    .dm-edition-card-title a { color: inherit; text-decoration: none; transition: opacity 0.3s; }
    .dm-edition-card-title a:hover { opacity: 0.6; }
    .dm-edition-card-excerpt { font-size: 15px; color: rgba(0,0,0,0.55); line-height: 1.6; font-family: var(--tp-ff-onest); margin-bottom: 16px; }
    .dm-edition-card-link {
        font-size: 14px; font-weight: 600; color: var(--tp-common-black,#111);
        text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        font-family: var(--tp-ff-onest); transition: opacity 0.3s;
    }
    .dm-edition-card-link:hover { opacity: 0.6; }
    .dm-edition-card-link i { font-size: 12px; transition: transform 0.3s; }
    .dm-edition-card:hover .dm-edition-card-link i { transform: translateX(3px); }

    /* Read Time Badge (cards) */
    .dm-card-read-time-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; font-weight: 600; font-family: var(--tp-ff-onest);
        color: rgba(0,0,0,0.5); background: rgba(0,0,0,0.06);
        padding: 4px 10px; border-radius: 20px;
    }
    .dm-card-read-time-badge i { font-size: 11px; }

    /* Read More Button */
    .dm-newsletter-read-more-btn {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: 13px; font-weight: 600; font-family: var(--tp-ff-onest);
        color: #fff; background: var(--tp-common-black,#111);
        padding: 8px 18px; border-radius: 6px;
        text-decoration: none; transition: background 0.25s, opacity 0.25s;
        white-space: nowrap;
    }
    .dm-newsletter-read-more-btn:hover { opacity: 0.75; color: #fff; }
    .dm-newsletter-read-more-btn i { font-size: 11px; }

    /* ── Pagination ── */
    .dm-pagination { display: flex; justify-content: center; padding-top: 40px; }
    .dm-pagination ul {
        list-style: none; padding: 0; margin: 0;
        display: flex; align-items: center; gap: 6px;
    }
    .dm-pagination li a,
    .dm-pagination li span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 42px; height: 42px; padding: 0 14px;
        border: 1px solid rgba(0,0,0,0.1); border-radius: 10px;
        font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest);
        color: var(--tp-common-black,#111); background: #fff;
        text-decoration: none; transition: all 0.25s ease;
    }
    .dm-pagination li a:hover {
        background: var(--tp-common-black,#111); color: #fff;
        border-color: var(--tp-common-black,#111);
    }
    .dm-pagination li.active span {
        background: var(--tp-common-black,#111); color: #fff;
        border-color: var(--tp-common-black,#111);
    }
    .dm-pagination li.disabled span {
        opacity: 0.3; cursor: default; pointer-events: none;
    }
    .dm-pagination li.dots span {
        border: none; background: transparent; min-width: 28px; padding: 0;
        font-size: 16px; letter-spacing: 2px; color: rgba(0,0,0,0.3);
    }
    .dm-pagination li a i,
    .dm-pagination li span i { font-size: 12px; }
    @media (max-width: 575px) {
        .dm-pagination li a,
        .dm-pagination li span { min-width: 36px; height: 36px; padding: 0 10px; font-size: 13px; }
        .dm-pagination ul { gap: 4px; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero -->
<div class="dm-newsletter-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Newsletter</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Stay Ahead with<br>Expert Insights
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-newsletter-hero-desc">Get the latest on corporate governance, regulatory changes, tax alerts, and strategic business advisory delivered to your inbox.</p>
                </div>
                <div class="dm-subscribe-widget tp_fade_anim" data-delay=".5">
                    <button class="dm-sub-trigger" id="dm-sub-trigger-idx" onclick="dmOpenSubscribe('idx')">
                        <i class="fa-regular fa-bell"></i> Subscribe to Newsletter
                    </button>
                    <div class="dm-sub-panel" id="dm-sub-panel-idx">
                        <div class="dm-sub-inner">
                            <input type="text" id="dm-sub-name-idx" class="dm-sub-input" placeholder="Your Name" autocomplete="name">
                            <input type="email" id="dm-sub-email-idx" class="dm-sub-input" placeholder="Your Email Address" autocomplete="email">
                            <button id="dm-sub-btn-idx" class="dm-sub-btn" onclick="dmSubscribe('idx')">
                                <i class="fa-regular fa-paper-plane"></i> Subscribe
                            </button>
                            <p class="dm-sub-msg" id="dm-sub-msg-idx"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Editions -->
<div class="dm-past-editions">
    <div class="container container-1230">

        <?php if($featured): ?>
        <!-- Featured Newsletter -->
        <div class="dm-newsletter-featured">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="dm-newsletter-featured-thumb tp_fade_anim" data-delay=".3">
                        <a href="<?php echo e(route('newsletter.show', $featured->slug)); ?>">
                            <?php if($featured->featured_image): ?>
                                <img src="<?php echo e(asset('storage/' . $featured->featured_image)); ?>" alt="<?php echo e($featured->title); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/img/home-13/blog/blog-thumb-1.jpg')); ?>" alt="<?php echo e($featured->title); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dm-newsletter-featured-content tp_fade_anim" data-delay=".5">
                        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:16px;">
                            <span class="dm-edition-card-date" style="margin:0;">
                                <i class="fa-regular fa-calendar"></i> Featured
                            </span>
                            <span class="dm-card-read-time-badge">
                                <i class="fa-regular fa-clock"></i>
                                <?php echo e($featured->read_time ?: '5 min read'); ?>

                            </span>
                        </div>
                        <h3 class="dm-newsletter-featured-title">
                            <a href="<?php echo e(route('newsletter.show', $featured->slug)); ?>"><?php echo e($featured->title); ?></a>
                        </h3>
                        <p class="dm-edition-card-excerpt"><?php echo e($featured->excerpt ?? Str::limit(strip_tags($featured->content), 160)); ?></p>
                        <span class="dm-edition-card-date" style="display:block;margin-bottom:20px;"><?php echo e($featured->published_at?->format('M d, Y')); ?></span>
                        <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
                            <a href="<?php echo e(route('newsletter.show', $featured->slug)); ?>" class="dm-edition-card-link">
                                Read Edition
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                    <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                                </svg>
                            </a>
                            <?php if($featured->button_url): ?>
                            <a href="<?php echo e($featured->button_url); ?>" target="_blank" rel="noopener noreferrer" class="dm-newsletter-read-more-btn">
                                <?php echo e($featured->button_text ?: 'Read More'); ?> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="section-label mb-40 tp_fade_anim" data-delay=".3" style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;font-family:var(--tp-ff-onest);color:rgba(0,0,0,0.4);">All Editions</div>

        <!-- Newsletter Cards -->
        <div class="row">
            <?php $__empty_1 = true; $__currentLoopData = $newsletters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsletter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-lg-4 col-md-6">
                <div class="dm-edition-card tp_fade_anim" data-delay=".<?php echo e(3 + ($loop->index % 3)); ?>">
                    <div class="dm-edition-card-thumb">
                        <a href="<?php echo e(route('newsletter.show', $newsletter->slug)); ?>">
                            <?php if($newsletter->featured_image): ?>
                                <img src="<?php echo e($newsletter->featured_image); ?>" alt="<?php echo e($newsletter->title); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg')); ?>" alt="<?php echo e($newsletter->title); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin:16px 0 8px;">
                        <span class="dm-edition-card-date" style="margin:0;">
                            <i class="fa-regular fa-calendar"></i>
                            <?php echo e($newsletter->edition_label ?? $newsletter->published_at?->format('F Y') ?? $newsletter->created_at->format('F Y')); ?>

                        </span>
                        <span class="dm-card-read-time-badge">
                            <i class="fa-regular fa-clock"></i>
                            <?php echo e($newsletter->read_time ?: '5 min read'); ?>

                        </span>
                    </div>
                    <h4 class="dm-edition-card-title">
                        <a href="<?php echo e(route('newsletter.show', $newsletter->slug)); ?>"><?php echo e($newsletter->title); ?></a>
                    </h4>
                    <p class="dm-edition-card-excerpt"><?php echo e($newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 140)); ?></p>
                    <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                        <a href="<?php echo e(route('newsletter.show', $newsletter->slug)); ?>" class="dm-edition-card-link">
                            Read Edition <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <?php if($newsletter->button_url): ?>
                        <a href="<?php echo e($newsletter->button_url); ?>" target="_blank" rel="noopener noreferrer" class="dm-newsletter-read-more-btn">
                            <?php echo e($newsletter->button_text ?: 'Read More'); ?> <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-12">
                <p style="text-align:center;color:rgba(0,0,0,0.4);padding:60px 0;font-family:var(--tp-ff-onest);">No newsletters published yet. Check back soon.</p>
            </div>
            <?php endif; ?>
        </div>

        <?php if($newsletters->hasPages()): ?>
            <?php echo e($newsletters->links('vendor.pagination.devmantra')); ?>

        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function dmOpenSubscribe(id) {
    const trigger = document.getElementById('dm-sub-trigger-' + id);
    const panel   = document.getElementById('dm-sub-panel-' + id);
    trigger.style.display = 'none';
    panel.classList.add('open');
    setTimeout(() => document.getElementById('dm-sub-name-' + id).focus(), 50);
}

async function dmSubscribe(id) {
    const nameEl  = document.getElementById('dm-sub-name-' + id);
    const emailEl = document.getElementById('dm-sub-email-' + id);
    const btn     = document.getElementById('dm-sub-btn-' + id);
    const msg     = document.getElementById('dm-sub-msg-' + id);

    const name  = nameEl.value.trim();
    const email = emailEl.value.trim();

    msg.className = 'dm-sub-msg';
    msg.textContent = '';

    if (!name) { msg.className = 'dm-sub-msg error'; msg.textContent = 'Please enter your name.'; nameEl.focus(); return; }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { msg.className = 'dm-sub-msg error'; msg.textContent = 'Please enter a valid email address.'; emailEl.focus(); return; }

    btn.disabled = true;
    btn.classList.add('loading');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Subscribing…';

    try {
        const res = await fetch('<?php echo e(route("newsletter.subscribe")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, email }),
        });

        const data = await res.json();

        btn.classList.remove('loading');

        if (data.status === 'success') {
            btn.classList.add('success');
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Subscribed!';
            msg.className = 'dm-sub-msg success';
            msg.textContent = data.message;
            nameEl.value = '';
            emailEl.value = '';
        } else if (data.status === 'already') {
            btn.classList.add('already');
            btn.innerHTML = '<i class="fa-solid fa-check-double"></i> Already Subscribed';
            msg.className = 'dm-sub-msg already';
            msg.textContent = data.message;
        } else {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-regular fa-paper-plane"></i> Subscribe';
            msg.className = 'dm-sub-msg error';
            msg.textContent = data.message || 'Something went wrong. Please try again.';
        }
    } catch (e) {
        btn.disabled = false;
        btn.classList.remove('loading');
        btn.innerHTML = '<i class="fa-regular fa-paper-plane"></i> Subscribe';
        msg.className = 'dm-sub-msg error';
        msg.textContent = 'Network error. Please try again.';
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/frontend/newsletter-index.blade.php ENDPATH**/ ?>