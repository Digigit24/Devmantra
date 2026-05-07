<?php $__env->startSection('title', $service->title . ' - DevMantra'); ?>
<?php $__env->startSection('meta_description', $service->meta_description ?? $service->short_description ?? Str::limit(strip_tags($service->content), 160)); ?>
<?php if($service->featured_image): ?>
<?php $__env->startSection('og_image', asset('storage/' . $service->featured_image)); ?>
<?php elseif($service->hero_image): ?>
<?php $__env->startSection('og_image', asset('storage/' . $service->hero_image)); ?>
<?php elseif($service->image): ?>
<?php $__env->startSection('og_image', asset('storage/' . $service->image)); ?>
<?php endif; ?>

<?php $__env->startPush('styles'); ?>
<style>
    .dm-article-hero {
        background-color: #001d30;
        padding: 200px 0 100px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 767px) { .dm-article-hero { padding: 150px 0 70px; } }

    .dm-article-meta {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }
    .dm-article-meta-item {
        font-size: 14px;
        color: rgba(255,255,255,0.5);
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-meta-tag {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #fff;
        padding: 6px 16px;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
    }
    .dm-article-hero-title {
        font-size: 48px;
        font-weight: 600;
        color: #fff;
        line-height: 1.25;
        max-width: 800px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 991px) { .dm-article-hero-title { font-size: 36px; } }
    @media (max-width: 767px) { .dm-article-hero-title { font-size: 28px; } }

    /* Featured image - full width below hero */
    .dm-article-featured-section {
        margin-top: -40px;
        position: relative;
        z-index: 2;
        padding-bottom: 60px;
    }
    .dm-article-featured-img {
        border-radius: 16px;
        overflow: hidden;
    }
    .dm-article-featured-img img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 767px) {
        .dm-article-featured-img img { height: 260px; }
        .dm-article-featured-section { margin-top: -20px; padding-bottom: 40px; }
    }

    /* Article body - 2 column layout */
    .dm-article-body { padding: 0 0 100px; }
    @media (max-width: 767px) { .dm-article-body { padding: 0 0 60px; } }

    /* Content column */
    .dm-article-content p {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.7);
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content h3 {
        font-size: 28px;
        font-weight: 600;
        color: var(--tp-common-black);
        margin-top: 48px;
        margin-bottom: 20px;
        font-family: var(--tp-ff-onest);
        line-height: 1.35;
    }
    .dm-article-content h4 {
        font-size: 22px;
        font-weight: 600;
        color: var(--tp-common-black);
        margin-top: 36px;
        margin-bottom: 16px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content ul {
        padding-left: 0;
        margin-bottom: 28px;
        list-style: none;
    }
    .dm-article-content ul li {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.7);
        padding-left: 24px;
        position: relative;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 12px;
        width: 6px;
        height: 6px;
        background: var(--tp-common-black);
        border-radius: 50%;
    }

    .dm-article-content blockquote,
    .dm-article-quote {
        border-left: 3px solid var(--tp-common-black);
        padding: 24px 0 24px 32px;
        margin: 40px 0;
    }
    .dm-article-content blockquote p,
    .dm-article-quote p {
        font-size: 20px;
        font-weight: 500;
        color: var(--tp-common-black);
        line-height: 1.6;
        margin-bottom: 8px;
        font-style: italic;
    }
    .dm-article-content blockquote cite,
    .dm-article-quote cite {
        font-size: 14px;
        color: rgba(0,0,0,0.5);
        font-style: normal;
        font-weight: 600;
    }

    .dm-article-inline-img {
        margin: 40px 0;
        border-radius: 12px;
        overflow: hidden;
    }
    .dm-article-inline-img img {
        width: 100%;
        height: auto;
    }

    /* Tags & share */
    .dm-article-footer {
        padding-top: 40px;
        border-top: 1px solid var(--tp-border-1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .dm-article-tags { display: flex; gap: 8px; flex-wrap: wrap; }
    .dm-article-tags a {
        font-size: 13px;
        font-weight: 500;
        color: var(--tp-common-black);
        padding: 6px 16px;
        border: 1px solid var(--tp-border-1);
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-tags a:hover {
        background: var(--tp-common-black);
        color: #fff;
        border-color: var(--tp-common-black);
    }

    .dm-article-share {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .dm-article-share span {
        font-size: 14px;
        font-weight: 600;
        color: rgba(0,0,0,0.4);
        font-family: var(--tp-ff-onest);
    }
    .dm-article-share a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--tp-border-1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--tp-common-black);
        text-decoration: none;
        font-size: 14px;
        line-height: 1;
        transition: all 0.3s ease;
    }
    .dm-article-share a i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 14px;
        height: 14px;
        line-height: 1;
    }
    .dm-article-share a:hover {
        background: var(--tp-common-black);
        color: #fff;
        border-color: var(--tp-common-black);
    }

    /* ── Sticky sidebar ── */
    .dm-article-body .row { align-items: flex-start; }
    .dm-sidebar {
        position: sticky;
        top: 120px;
        padding-left: 40px;
        max-height: calc(100vh - 140px);
        overflow-y: auto;
    }
    .dm-sidebar::-webkit-scrollbar { width: 0; background: transparent; }
    @media (max-width: 991px) { .dm-sidebar { padding-left: 0; margin-top: 60px; position: static; max-height: none; } }

    .dm-sidebar-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    .dm-sidebar-post {
        display: flex;
        gap: 16px;
        padding: 20px 0;
        border-bottom: 1px solid var(--tp-border-1);
        transition: all 0.3s ease;
    }
    .dm-sidebar-post:first-of-type {
        border-top: 1px solid var(--tp-border-1);
    }
    .dm-sidebar-post:hover {
        padding-left: 6px;
    }
    .dm-sidebar-post-thumb {
        width: 72px;
        height: 72px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .dm-sidebar-post-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .dm-sidebar-post:hover .dm-sidebar-post-thumb img {
        transform: scale(1.06);
    }
    .dm-sidebar-post-info {
        flex: 1;
        min-width: 0;
    }
    .dm-sidebar-post-category {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 6px;
        display: block;
        font-family: var(--tp-ff-onest);
    }
    .dm-sidebar-post-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--tp-common-black);
        line-height: 1.45;
        font-family: var(--tp-ff-onest);
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .dm-sidebar-post-title a {
        color: inherit;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .dm-sidebar-post-title a:hover { opacity: 0.6; }

    .dm-sidebar-post-date {
        font-size: 12px;
        color: rgba(0,0,0,0.35);
        margin-top: 4px;
        font-family: var(--tp-ff-onest);
    }

    /* Related posts (bottom section) */
    .dm-related-posts {
        padding: 80px 0;
        border-top: 1px solid var(--tp-border-1);
    }
    .dm-related-posts-title {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.4);
        margin-bottom: 40px;
        font-family: var(--tp-ff-onest);
    }

    .dm-related-card {
        margin-bottom: 30px;
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .dm-related-card:hover { transform: translateY(-4px); }
    .dm-related-card-thumb {
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .dm-related-card-thumb img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .dm-related-card:hover .dm-related-card-thumb img { transform: scale(1.04); }
    .dm-related-card-category {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.4);
        margin-bottom: 8px;
        display: block;
        font-family: var(--tp-ff-onest);
    }
    .dm-related-card-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--tp-common-black);
        line-height: 1.4;
        font-family: var(--tp-ff-onest);
    }
    .dm-related-card-title a {
        color: inherit;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .dm-related-card-title a:hover { opacity: 0.6; }

    /* ── CTA Section ── */
    .dm-service-cta { padding: 100px 0; background: #fafafa; }
    @media (max-width: 767px) { .dm-service-cta { padding: 60px 0; } }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $hasSections = $service->activeSections->isNotEmpty(); ?>


<?php if($hasSections): ?>

    <?php $__currentLoopData = $service->activeSections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => 'service-sections.' . $section->section_type] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => $section->section_data ?? []]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>



<!-- Article Hero -->
<div class="dm-article-hero">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-meta tp_fade_anim" data-delay=".3">
                    <span class="dm-article-meta-tag">Service</span>
                    <?php if($service->short_description): ?>
                    <span class="dm-article-meta-item"><?php echo e(Str::limit($service->short_description, 80)); ?></span>
                    <?php endif; ?>
                </div>
                <h1 class="dm-article-hero-title tp-text-revel-anim" data-delay=".5"><?php echo e($service->title); ?></h1>
            </div>
        </div>
    </div>
</div>

<!-- Featured Image - Full Width -->
<?php if($service->featured_image || $service->hero_image || $service->image): ?>
<div class="dm-article-featured-section">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-featured-img tp_fade_anim" data-delay=".3">
                    <img src="<?php echo e(asset('storage/' . ($service->featured_image ?? $service->hero_image ?? $service->image))); ?>" alt="<?php echo e($service->title); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Article Body + Sidebar -->
<div class="dm-article-body">
    <div class="container container-1230">
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-8">
                <div class="dm-article-content tp_fade_anim" data-delay=".5">
                    <?php echo $service->content; ?>

                </div>

                <!-- Article Footer -->
                <div class="dm-article-footer">
                    <div class="dm-article-tags">
                        <a href="<?php echo e(route('home')); ?>#services">Service</a>
                    </div>
                    <div class="dm-article-share">
                        <span>Share</span>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($service->title)); ?>" target="_blank" rel="noopener" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(request()->url())); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div class="col-lg-4">
                <div class="dm-sidebar">
                    <div class="dm-sidebar-label">Other Services</div>
                    <?php $__currentLoopData = $sidebarServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sideService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dm-sidebar-post">
                        <div class="dm-sidebar-post-thumb">
                            <?php if($sideService->image): ?>
                                <a href="<?php echo e(route('service.show', $sideService->slug)); ?>">
                                    <img src="<?php echo e(asset('storage/' . $sideService->image)); ?>" alt="<?php echo e($sideService->title); ?>">
                                </a>
                            <?php elseif($sideService->hero_image): ?>
                                <a href="<?php echo e(route('service.show', $sideService->slug)); ?>">
                                    <img src="<?php echo e(asset('storage/' . $sideService->hero_image)); ?>" alt="<?php echo e($sideService->title); ?>">
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('service.show', $sideService->slug)); ?>">
                                    <img src="<?php echo e(asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg')); ?>" alt="<?php echo e($sideService->title); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="dm-sidebar-post-info">
                            <span class="dm-sidebar-post-category">Service</span>
                            <h5 class="dm-sidebar-post-title">
                                <a href="<?php echo e(route('service.show', $sideService->slug)); ?>"><?php echo e($sideService->title); ?></a>
                            </h5>
                            <?php if($sideService->short_description): ?>
                            <div class="dm-sidebar-post-date"><?php echo e(Str::limit($sideService->short_description, 50)); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Services -->
<?php if($related->count()): ?>
<div class="dm-related-posts">
    <div class="container container-1230">
        <div class="dm-related-posts-title tp_fade_anim" data-delay=".3">Other Services</div>
        <div class="row">
            <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6">
                <div class="dm-related-card tp_fade_anim" data-delay=".<?php echo e(3 + ($loop->index * 2)); ?>">
                    <div class="dm-related-card-thumb">
                        <a href="<?php echo e(route('service.show', $relService->slug)); ?>">
                            <?php if($relService->image): ?>
                                <img src="<?php echo e(asset('storage/' . $relService->image)); ?>" alt="<?php echo e($relService->title); ?>">
                            <?php elseif($relService->hero_image): ?>
                                <img src="<?php echo e(asset('storage/' . $relService->hero_image)); ?>" alt="<?php echo e($relService->title); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg')); ?>" alt="<?php echo e($relService->title); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                    <span class="dm-related-card-category">Service</span>
                    <h4 class="dm-related-card-title">
                        <a href="<?php echo e(route('service.show', $relService->slug)); ?>"><?php echo e($relService->title); ?></a>
                    </h4>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php endif; ?>

<!-- CTA Section -->
<div class="dm-service-cta">
    <div class="cr-cta-ptb p-relative pt-120 pb-100">
        <div class="cr-cta-bg">
            <img src="<?php echo e(asset('assets/img/home-13/cta/cta-thumb-bg.png')); ?>" alt="">
        </div>
        <div class="cr-cta-shape">
            <span class="shape-1"></span>
            <span class="shape-2"></span>
            <span class="shape-3"></span>
            <span class="shape-4"></span>
            <span class="shape-5"></span>
            <span class="shape-6"></span>
            <span class="shape-7"></span>
            <span class="shape-8"></span>
            <span class="shape-9"></span>
            <span class="shape-10"></span>
            <span class="shape-11"></span>
            <span class="shape-12"></span>
            <span class="shape-13"></span>
            <span class="shape-14"></span>
            <span class="shape-15"></span>
        </div>
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-cta-content text-center">
                        <div class="cr-cta-img p-relative mb-20">
                            <img src="<?php echo e(asset('assets/img/home-13/cta/cta-thumb.gif')); ?>" alt="">
                        </div>
                        <h4 class="tp-section-title-onest fs-50 tp-text-revel-anim" style="color: #111;">
                            Ready to Elevate Your <br> Business with Dev Mantra?
                        </h4>
                        <div class="tp_text_anim">
                            <p class="cr-cta-text" style="color: #555;">
                                Dev Mantra is here to help you scale with confidence through
                                future-ready financial, governance, and advisory solutions.
                            </p>
                        </div>
                        <div class="cr-cta-btn tp_fade_anim" data-delay=".7"
                            data-fade-from="top" data-ease="bounce">
                            <a href="javascript:void(0);" class="tp-btn-white-border tp-btn-light-bg" id="openConsultationModal">
                                Book a Consultation
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                        height="12" viewBox="0 0 15 12" fill="none">
                                        <path
                                            d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<!-- AI Platform section -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home2/devmasjc/devmantra/resources/views/frontend/service-detail.blade.php ENDPATH**/ ?>