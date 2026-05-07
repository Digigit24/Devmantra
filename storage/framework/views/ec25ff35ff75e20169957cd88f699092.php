<style>
    .tp-header-menu > nav > ul { display: flex; flex-wrap: nowrap; align-items: center; }
    .tp-header-menu > nav > ul > li { flex-shrink: 0; }
    .tp-header-btn-box .tp-btn-white-border { white-space: nowrap; }

    /* lg (992–1199px): compact nav, no buttons */
    @media (min-width: 992px) and (max-width: 1199px) {
        .tp-header-menu > nav > ul > li { margin: 0 6px; }
        .tp-header-menu > nav > ul > li > a { font-size: 13px; }
    }
    /* xl (1200–1399px) */
    @media (min-width: 1200px) and (max-width: 1399px) {
        .tp-header-menu > nav > ul > li { margin: 0 10px; }
        .tp-header-menu > nav > ul > li > a { font-size: 15px; }
        .tp-header-btn-box .tp-btn-white-border { font-size: 13px; padding: 10px 16px; }
    }
    @media (min-width: 1400px) and (max-width: 1599px) {
        .tp-header-menu > nav > ul > li { margin: 0 14px; }
        .tp-header-menu > nav > ul > li > a { font-size: 15px; }
    }
    @media (min-width: 1600px) {
        .tp-header-menu > nav > ul > li { margin: 0 18px; }
    }

    /* Buttons only on xl+ — never show alongside the hamburger */
    @media (max-width: 1199px) {
        .tp-header-right .tp-header-btn-box { display: none !important; }
    }

    /* Last dropdown (More) opens to the left to prevent overflow */
    .tp-header-menu > nav > ul > li:last-child .tp-submenu {
        left: auto;
        right: 0;
    }
</style>

<!-- Offcanvas -->
<div class="tp-offcanvas-area">
    <div class="tp-offcanvas-wrapper">
        <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">
            <div class="tp-offcanvas-logo">
                <a href="<?php echo e(route('home')); ?>">
                    <img class="logo-1" data-width="120" src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra" style="border-radius: 50px;">
                    <img class="logo-2" data-width="120" src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra" style="border-radius: 50px;">
                </a>
            </div>
            <div class="tp-offcanvas-close">
                <button class="tp-offcanvas-close-btn">
                    <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="tp-offcanvas-main">
            <div class="tp-offcanvas-content d-none d-xl-block">
                <h3 class="tp-offcanvas-title">Dev Mantra</h3>
                <p>Strategic partner in progress for businesses operating in a global and digital economy.</p>
            </div>
            <div class="tp-offcanvas-menu d-xl-none">
                <nav></nav>
            </div>
            <div class="tp-offcanvas-contact">
                <h3 class="tp-offcanvas-title sm">Information</h3>
                <ul>
                    <li><a href="tel:+9180-42061247">+91-80-42061247</a></li>
                    <li><a href="mailto:support@devmantra.com">support@devmantra.com</a></li>
                    <li><a href="#">Bengaluru, India</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>

<!-- Header -->
<header>
    <div id="header-sticky" class="tp-header-area tp-header-13-ptb sticky-white-bg tp-header-blur header-transparent">
        <div class="container container-1750">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-5">
                    <div class="tp-header-logo">
                        <a href="<?php echo e(route('home')); ?>"><img style="border-radius: 50px;" data-width="140" src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra"></a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-9 col-7">
                    <div class="tp-header-box d-flex align-items-center justify-content-end justify-content-xl-between">
                        <div class="tp-header-menu tp-header-13-menu tp-header-dropdown dropdown-black-bg d-none d-lg-flex">
                            <nav class="tp-mobile-menu-active">
                                <ul>
                                    <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                                    <li><a href="<?php echo e(route('about')); ?>">About Us</a></li>
                                    <li class="has-dropdown">
                                        <a href="javascript:void(0)">Expertise</a>
                                        <ul class="tp-submenu submenu">
                                            <?php $__currentLoopData = $navServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navService): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(route('service.show', $navService->slug)); ?>"><?php echo e($navService->title); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="javascript:void(0)">Insights</a>
                                        <ul class="tp-submenu submenu">
                                            <li><a href="<?php echo e(route('newsletter.index')); ?>">Newsletters</a></li>
                                            <li><a href="<?php echo e(route('report.index')); ?>">Reports</a></li>
                                            <li><a href="<?php echo e(route('case-study.index')); ?>">Case Studies</a></li>
                                            <li><a href="<?php echo e(route('alert.index')); ?>">Alerts</a></li>
                                            <li><a href="<?php echo e(route('blog.index')); ?>">Blogs</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="javascript:void(0)">More</a>
                                        <ul class="tp-submenu submenu">
                                            <li><a href="<?php echo e(route('events')); ?>">Events</a></li>
                                            <li><a href="<?php echo e(route('careers')); ?>">Careers</a></li>
                                            <li><a href="<?php echo e(route('contact')); ?>">Contact Us</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="tp-header-right d-flex align-items-center justify-content-end">
                            
                            <div class="tp-header-btn-box d-none d-xl-block ml-15">
                                <?php if (isset($component)) { $__componentOriginal1edae8760811c7b935175a7435923573 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1edae8760811c7b935175a7435923573 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-secondary','data' => ['class' => 'dm-btn-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'dm-btn-sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1edae8760811c7b935175a7435923573)): ?>
<?php $attributes = $__attributesOriginal1edae8760811c7b935175a7435923573; ?>
<?php unset($__attributesOriginal1edae8760811c7b935175a7435923573); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1edae8760811c7b935175a7435923573)): ?>
<?php $component = $__componentOriginal1edae8760811c7b935175a7435923573; ?>
<?php unset($__componentOriginal1edae8760811c7b935175a7435923573); ?>
<?php endif; ?>
                            </div>
                            
                            <div class="tp-header-btn-box d-none d-xl-block ml-15">
                                <?php if (isset($component)) { $__componentOriginal490cf816fa75abeeb835565b23a9eae8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal490cf816fa75abeeb835565b23a9eae8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-primary','data' => ['class' => 'dm-btn-sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'dm-btn-sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal490cf816fa75abeeb835565b23a9eae8)): ?>
<?php $attributes = $__attributesOriginal490cf816fa75abeeb835565b23a9eae8; ?>
<?php unset($__attributesOriginal490cf816fa75abeeb835565b23a9eae8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal490cf816fa75abeeb835565b23a9eae8)): ?>
<?php $component = $__componentOriginal490cf816fa75abeeb835565b23a9eae8; ?>
<?php unset($__componentOriginal490cf816fa75abeeb835565b23a9eae8); ?>
<?php endif; ?>
                            </div>
                            <div class="tp-header-bar ml-20 d-lg-none">
                                <button class="tp-offcanvas-open-btn" type="button">
                                    <i></i><i></i><i></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/frontend/partials/header.blade.php ENDPATH**/ ?>