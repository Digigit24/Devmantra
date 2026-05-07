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
    $subtitle = $data['subtitle'] ?? 'Commitment to Your Financial Success';
    $title    = $data['title']    ?? "Unleash the Power of\neXcellence Beyond Numbers";
    $description = $data['description'] ?? '';
    $ctaText  = $data['cta_text'] ?? null;   // null → x-btn-primary uses global setting
    $ctaUrl   = $data['cta_url']  ?? null;   // null → x-btn-primary uses global setting
?>

<?php if (! $__env->hasRenderedOnce('f9e04a5c-1dd4-41ae-a15a-c4ea6d29e71e')): $__env->markAsRenderedOnce('f9e04a5c-1dd4-41ae-a15a-c4ea6d29e71e'); ?>
<?php $__env->startPush('styles'); ?>

<link rel="preload" as="image" href="<?php echo e(asset('assets/img/hero/card1.webp')); ?>" fetchpriority="high">
<link rel="preload" as="image" href="<?php echo e(asset('assets/img/hero/background.webp')); ?>">
<style>
.cr-hero-btn-wrap {
    display: flex; align-items: center; justify-content: center;
    gap: 14px; flex-wrap: wrap;
}
@media (max-width: 575px) {
    .cr-hero-btn-wrap { flex-direction: column; gap: 10px; }
}



/* ── Card-scene hero (scoped) ─────────────────────────── */
.cr-hero-area .dm-hero-scene {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    perspective: 1200px;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
}
.dm-hero-scene .dm-card {
    position: absolute;
    width: 100%;
    
    top: 30vh;
    
    will-change: transform;
    transform-style: preserve-3d;
    pointer-events: none;
}
.dm-hero-scene .dm-card-top    { z-index: 2;  }


.dm-hover-zone {
    position: absolute;
    width: 700px;
    height: 800px;
    top: 10;
    right: -10%;

    
    transform: translateY(-50%);
    z-index: 20;
    pointer-events: auto;
    
 
}

.dm-hero-scene .dm-card-topbg {
    z-index: 1;
    
    height: 85vh;
    margin-top: 5vh;
    background-repeat: repeat;
    background-size: 480px 480px;
    will-change: background-position;
}
.dm-hero-scene .dm-card-text   { z-index: 3;  }
.dm-hero-scene .dm-card-bottom {
    z-index: 14;
    filter: brightness(0.95);
}

/* ── Responsive card placement ───────────────────────── */
/* Tablet (≤ 991px): 20vh top */
@media (max-width: 991px) {
    .dm-hero-scene .dm-card {
        top: 50vh;
    }
}
/* Mobile (≤ 575px): 50vh top, reduced right margin */
@media (max-width: 575px) {
    .dm-hero-scene .dm-card  {
        top: 40vh;
        /* Hide cards on mobile for better performance and UX */
    }
    .dm-hero-scene .dm-card-top,
    .dm-hero-scene .dm-card-topbg,
    .dm-hero-scene .dm-card-text {
        margin-right: 0;
        
    }
}
.dm-hover-zone {
    position: absolute;
    width: 700px;
    height: 800px;
    top: 10;
    right: -10%;

    
    transform: translateY(-50%);
    z-index: 20;
    pointer-events: auto;
    
    
}
@media (max-width: 575px) {
   
.dm-hover-zone {
    position: absolute;
    width: 100px;
    height: 100px;
    top: 700px;
    right: -10%;

    
    transform: translateY(-50%);
    z-index: 20;
    pointer-events: auto;
    
    
}
.cr-hero-area{
    height: 160vh;

}
}



/* Content sits above the card scene */
.cr-hero-area > .container-fluid {
    position: relative;
    z-index: 2;
}
.cr-hero-area .cr-hero-left,
.cr-hero-area .cr-hero-right {
    z-index: 1;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div style="background-color: #0b0f14; min-height: 120vh;" class="cr-hero-area fix cr-hero-ptb p-relative pt-100">
    
   <div class="dm-hero-scene">
    <picture>
        <source media="(max-width: 575px)" srcset="<?php echo e(asset('assets/img/hero/mobilecardtop.png')); ?>">
        <img src="<?php echo e(asset('assets/img/hero/cardtop.png')); ?>" class="dm-card dm-card-top" alt="" fetchpriority="high">
    </picture>

    <picture>
        <source media="(max-width: 575px)" srcset="<?php echo e(asset('assets/img/hero/mobile-bg.png')); ?>">
        <img src="<?php echo e(asset('assets/img/hero/cardbg.png')); ?>" class="dm-card dm-card-topbg" alt="">
    </picture>

    <picture>
        <source media="(max-width: 575px)" srcset="<?php echo e(asset('assets/img/hero/mobilecardtoptext.png')); ?>">
        <img src="<?php echo e(asset('assets/img/hero/cardtoptext.png')); ?>" class="dm-card dm-card-text" alt="" loading="lazy">
    </picture>

    <picture>
        <source media="(max-width: 575px)" srcset="<?php echo e(asset('assets/img/hero/mobile-bottom-card.png')); ?>">
        <img src="<?php echo e(asset('assets/img/hero/bottom-cardd.png')); ?>" class="dm-card dm-card-bottom" alt="" loading="lazy">
    </picture>
</div>
    <div class="dm-hover-zone"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cr-hero-heading text-center z-index-1">
                    <div class="tp-section-subtitle-gradient ct  tp_fade_anim" data-delay=".3">
                        <?php echo e($subtitle); ?>

                    </div>
                    <h4 class="tp-section-title-onest fs-68 tp-text-revel-anim hero-titlee" data-delay=".5">
                        <?php echo nl2br(e($title)); ?>

                    </h4>
                </div>
                <div class="cr-hero-content text-center z-index-2">
                    <div class="tp_text_anim">
                        <?php if($description): ?>
                       
                        <p style="margin-bottom: 40px; max-width: 620px; margin-left: auto; margin-right: auto;"><?php echo e($description); ?></p>
                        <?php else: ?>
                        <p style="margin-bottom: 40px;">&nbsp;</p>
                        <?php endif; ?>
                    </div>
                    <?php if(!request()->routeIs('home')): ?>
                    <div class="cr-hero-btn-wrap">
                        
                        <?php if (isset($component)) { $__componentOriginal490cf816fa75abeeb835565b23a9eae8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal490cf816fa75abeeb835565b23a9eae8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-primary','data' => ['url' => $ctaUrl,'text' => $ctaText]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ctaUrl),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ctaText)]); ?>
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
                        
                        <?php if (isset($component)) { $__componentOriginal1edae8760811c7b935175a7435923573 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1edae8760811c7b935175a7435923573 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-secondary','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-secondary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="cr-hero-left">
        <div class="shape-1 tp_fade_anim" data-fade-from="left" data-delay=".5"><img src="<?php echo e(asset('assets/img/home-13/hero/hero-shape-1.png')); ?>" alt="" aria-hidden="true" loading="lazy"></div>
        <div class="shape-2 tp_fade_anim" data-fade-from="left" data-delay=".5"><img src="<?php echo e(asset('assets/img/home-13/hero/hero-shape-2.png')); ?>" alt="" aria-hidden="true" loading="lazy"></div>
    </div>
    <div class="cr-hero-right">
        <div class="shape-1 tp_fade_anim" data-fade-from="right" data-delay=".5"><img src="<?php echo e(asset('assets/img/home-13/hero/hero-shape-3.png')); ?>" alt="" aria-hidden="true" loading="lazy"></div>
        <div class="shape-2 tp_fade_anim" data-fade-from="right" data-delay=".5"><img src="<?php echo e(asset('assets/img/home-13/hero/hero-shape-4.png')); ?>" alt="" aria-hidden="true" loading="lazy"></div>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('1eb78b58-55f4-4310-a37f-c73ee80a600b')): $__env->markAsRenderedOnce('1eb78b58-55f4-4310-a37f-c73ee80a600b'); ?>
<?php $__env->startPush('scripts'); ?>
<script>



document.addEventListener('DOMContentLoaded', function () {
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
  gsap.registerPlugin(ScrollTrigger);

  let mm = gsap.matchMedia();

  /* ── DESKTOP (≥ 992px) ── keep existing behavior exactly ── */
  mm.add("(min-width: 992px)", () => {

    var tl = gsap.timeline({ paused: true });

    tl.to(".dm-hero-scene .dm-card-bottom", {
      y: 0, x: 0, z: 10,
      rotationX: 0, rotationY: 0,
      scale: 1,
      ease: "power3.out",
      duration: 1
    }, 0)
    .to(".dm-hero-scene .dm-card-text", {
      opacity: 1, y: 0,
      duration: 0.8,
      ease: "power2.out"
    }, 0.2);

    gsap.set(".dm-hero-scene .dm-card-bottom", {
      y: 50, x: -40, z: -100,
      rotationX: -12, rotationY: 15,
      scale: 0.96
    });
    gsap.set(".dm-hero-scene .dm-card-text", { opacity: 0, y: 20 });

    var st = ScrollTrigger.create({
      trigger: ".cr-hero-area",
      start: "top top",
      end: "+=300",
      scrub: 0.6,
      animation: tl
    });

    var hoverZone = document.querySelector(".dm-hover-zone");
    var hoverTween = null;

    if (hoverZone) {
      hoverZone.addEventListener("mouseenter", function () {
        st.disable();
        if (hoverTween) hoverTween.kill();
        hoverTween = gsap.to(tl, { progress: 1, duration: 0.45, ease: "power2.out" });
      });
      hoverZone.addEventListener("mouseleave", function () {
        if (hoverTween) hoverTween.kill();
        hoverTween = gsap.to(tl, {
          progress: 0, duration: 0.45, ease: "power2.inOut",
          onComplete: function () { st.enable(); }
        });
      });
    }

    // matchMedia auto-reverts everything when breakpoint no longer matches
    return () => { st.kill(); };
  });

  /* ── TABLET (576px – 991px) ── lighter 3D, no hover zone ── */
  mm.add("(min-width: 576px) and (max-width: 991px)", () => {

    var tl = gsap.timeline({ paused: true });

    gsap.set(".dm-hero-scene .dm-card-bottom", {
      y: 30, x: -20, z: -60,
      rotationX: -8, rotationY: 10,
      scale: 0.97
    });
    gsap.set(".dm-hero-scene .dm-card-text", { opacity: 0, y: 15 });

    tl.to(".dm-hero-scene .dm-card-bottom", {
      y: 10, x: -10, z: 0,
      rotationX: 0, rotationY: 0,
      scale: 1,
      ease: "power2.out",
      duration: 0.8
    }, 0)
    .to(".dm-hero-scene .dm-card-text", {
      opacity: 1, y: 0,
      duration: 0.6,
      ease: "power2.out"
    }, 0.15);

    var st = ScrollTrigger.create({
      trigger: ".cr-hero-area",
      start: "top top",
      end: "+=200",
      scrub: 0.6,
      animation: tl
    });

    return () => { st.kill(); };
  });

  /* ── MOBILE (≤ 575px) ── match your actual mobile transform ── */
  mm.add("(max-width: 575px)", () => {

    var tl = gsap.timeline({ paused: true });

    // Initial: the transform you captured on mobile
    gsap.set(".dm-hero-scene .dm-card-bottom", {
      y: 59.55, x: 4.55, z: -9.56,
      rotationX: -4.53, rotationY: 5.67,
      scale: 0.985
    });
    gsap.set(".dm-hero-scene .dm-card-text", { opacity: 0, y: 10 });

    tl.to(".dm-hero-scene .dm-card-bottom", {
      y: 0, x: 0, z: 0,
      rotationX: 0, rotationY: 0,
      scale: 1,
      ease: "power2.out",
      duration: 0.6
    }, 0)
    .to(".dm-hero-scene .dm-card-text", {
      opacity: 1, y: 0,
      duration: 0.5,
      ease: "power2.out"
    }, 0.1);

    var st = ScrollTrigger.create({
      trigger: ".cr-hero-area",
      start: "bottom bottom",
      end: "bottom 90% ",
      scrub: 0.5,
      animation: tl
    });

    return () => { st.kill(); };
  });

});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/components/service-sections/page-hero.blade.php ENDPATH**/ ?>