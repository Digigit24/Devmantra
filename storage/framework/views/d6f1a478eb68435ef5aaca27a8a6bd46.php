<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['data' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['data' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $title    = $data['title']    ?? 'What We Do';
    $subtitle = $data['subtitle'] ?? 'Comprehensive financial and advisory services tailored for your business growth.';
    $services = \App\Models\Service::where('status', 'published')->orderBy('sort_order')->get();
?>

<section class="dm-hscroll-section" >
    <div class="dm-hscroll-pin">
        <div class="dm-hscroll-header">
            <h2 class="dm-hscroll-title"><?php echo e($title); ?></h2>
            <p class="dm-hscroll-subtitle"><?php echo e($subtitle); ?></p>
        </div>
        <!-- Desktop: horizontal GSAP scroll -->
        <div class="dm-hscroll-track dm-hscroll-desktop">
            <div class="dm-hscroll-cards">
                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="dm-hscroll-card">
                    <div class="dm-hscroll-card-img">
                        <a href="<?php echo e(route('service.show', $service->slug)); ?>">
                            <img src="<?php echo e($service->image ? asset('storage/'.$service->image) : asset('assets/img/home-13/feature/feature-thumb-'.(($loop->index % 3)+1).'.png')); ?>" alt="<?php echo e($service->title); ?>">
                        </a>
                    </div>
                    <div class="dm-hscroll-card-body">
                        <h3><?php echo e($service->title); ?></h3>
                        <p><?php echo e($service->short_description); ?></p>
                        <a href="<?php echo e(route('service.show', $service->slug)); ?>" class="dm-hscroll-btn">Read More</a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <!-- Mobile: Swiper slider -->
        <div class="dm-hscroll-mobile">
            <div class="swiper dm-services-swiper">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="dm-hscroll-card">
                            <div class="dm-hscroll-card-img">
                                <img src="<?php echo e($service->image ? asset('storage/'.$service->image) : asset('assets/img/home-13/feature/feature-thumb-'.(($loop->index % 3)+1).'.png')); ?>" alt="<?php echo e($service->title); ?>">
                            </div>
                            <div class="dm-hscroll-card-body">
                                <h3><?php echo e($service->title); ?></h3>
                                <p><?php echo e($service->short_description); ?></p>
                                <a href="<?php echo e(route('service.show', $service->slug)); ?>" class="dm-hscroll-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="swiper-pagination dm-services-pagination"></div>
            </div>
        </div>
    </div>
</section>

<?php if (! $__env->hasRenderedOnce('11e48953-0354-4f06-a1b3-7242d4b7fc59')): $__env->markAsRenderedOnce('11e48953-0354-4f06-a1b3-7242d4b7fc59'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    var MOBILE_BP = 991;

    // gsap.registerPlugin(ScrollTrigger) removed — plugin.js already registers it
    // before window.load fires, so it's available when initHScroll() is called.

    var section = document.querySelector(".dm-hscroll-section");
    var cards = document.querySelector(".dm-hscroll-cards");

    function killHScroll() {
        ScrollTrigger.getAll().forEach(function (t) {
            if (t.vars && t.vars.id === "dm-hscroll") t.kill();
        });
        if (cards) gsap.set(cards, { x: 0 });
    }

    function initHScroll() {
        killHScroll();
        if (!section || !cards) return;
        if (window.innerWidth <= MOBILE_BP) return;

        // Extra gap so the last card fully clears the right edge
        var scrollDistance = cards.scrollWidth - window.innerWidth + 60;
        if (scrollDistance <= 0) return;

        gsap.to(cards, {
            x: -scrollDistance,
            ease: "none",
            scrollTrigger: {
                id: "dm-hscroll",
                trigger: section,
                pin: true,
                scrub: 1.5,           // higher = more lag → silkier feel
                start: "top top",
                end: "+=" + scrollDistance,
                anticipatePin: 1,     // pre-renders pin position, kills jump
                fastScrollEnd: true,  // smooth deceleration after fast fling
                invalidateOnRefresh: true
            }
        });
    }

    var swiperInstance = null;

    function initSwiper() {
        if (window.innerWidth > MOBILE_BP) {
            if (swiperInstance) { swiperInstance.destroy(true, true); swiperInstance = null; }
            return;
        }
        if (swiperInstance) return;

        swiperInstance = new Swiper(".dm-services-swiper", {
            slidesPerView: 1.15,
            spaceBetween: 16,
            centeredSlides: true,
            grabCursor: true,
            pagination: {
                el: ".dm-services-pagination",
                clickable: true
            },
            breakpoints: {
                480: { slidesPerView: 1.3, spaceBetween: 20 },
                768: { slidesPerView: 2.2, spaceBetween: 24 }
            }
        });
    }

    window.addEventListener("load", function () {
        initHScroll();
        initSwiper();
        // Refresh once all card images have decoded so dimensions are exact
        if (cards) {
            var imgs = Array.from(cards.querySelectorAll("img"));
            var pending = imgs.filter(function (img) { return !img.complete; });
            if (pending.length) {
                Promise.all(
                    pending.map(function (img) {
                        return new Promise(function (res) {
                            img.addEventListener("load", res, { once: true });
                            img.addEventListener("error", res, { once: true });
                        });
                    })
                ).then(function () { ScrollTrigger.refresh(); });
            }
        }
    });

    var resizeTimer;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            initHScroll();
            initSwiper();
        }, 250);
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/components/service-sections/page-what-we-do.blade.php ENDPATH**/ ?>