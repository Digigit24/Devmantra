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
    $label       = $data['label']       ?? '';
    $title       = $data['title']       ?? '';
    $subtitle    = $data['subtitle']    ?? '';
    $description = $data['description'] ?? '';
    $ctaText     = $data['cta_text']    ?? '';
    $ctaUrl      = $data['cta_url']     ?? '#contact';
?>

<?php if (! $__env->hasRenderedOnce('49866398-2813-44f6-8e39-48d22aa608b1')): $__env->markAsRenderedOnce('49866398-2813-44f6-8e39-48d22aa608b1'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-hero {
    background: #001d30;
    padding: 200px 0 110px;
    position: relative;
    overflow: hidden;
    font-family: var(--tp-ff-onest);
}
.ss-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(74,115,196,0.18) 0%, transparent 65%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-hero { padding: 160px 0 90px; } }
@media (max-width: 767px) { .ss-hero { padding: 140px 0 70px; } }
.ss-hero-inner { position: relative; z-index: 2; max-width: 820px; }
.ss-hero-label {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #fff;
    border: 1px solid rgba(255,255,255,0.25);
    padding: 6px 18px;
    border-radius: 20px;
    margin-bottom: 28px;
}
.ss-hero-title {
    font-size: 52px;
    font-weight: 700;
    color: #fff;
    line-height: 1.18;
    margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-hero-title { font-size: 38px; } }
@media (max-width: 767px) { .ss-hero-title { font-size: 28px; } }
.ss-hero-subtitle {
    font-size: 18px;
    color: rgba(255,255,255,0.7);
    line-height: 1.7;
    margin-bottom: 12px;
    max-width: 680px;
}
.ss-hero-desc {
    font-size: 15px;
    color: rgba(255,255,255,0.5);
    margin-bottom: 40px;
    max-width: 600px;
}
.ss-hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    padding: 14px 32px;
    border-radius: 8px;
    text-decoration: none;
    transition: opacity .25s, transform .25s;
    cursor: pointer;
    border: none;
}
.ss-hero-cta:hover { opacity: .88; transform: translateY(-2px); color: #fff; }
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="ss-hero">
    <div class="container container-1230">
        <div class="ss-hero-inner tp_fade_anim" data-delay=".2">
            <?php if($label): ?>
            <span class="ss-hero-label"><?php echo e($label); ?></span>
            <?php endif; ?>
            <h1 class="ss-hero-title tp-text-revel-anim" data-delay=".3"><?php echo e($title); ?></h1>
            <?php if($subtitle): ?>
            <p class="ss-hero-subtitle"><?php echo e($subtitle); ?></p>
            <?php endif; ?>
            <?php if($description): ?>
            <p class="ss-hero-desc"><?php echo e($description); ?></p>
            <?php endif; ?>
            <?php if($ctaText): ?>
            <?php if(str_starts_with($ctaUrl, '#')): ?>
            <button onclick="window.openConsultationModal && window.openConsultationModal()"
                class="ss-hero-cta"><?php echo e($ctaText); ?> <i class="fa-solid fa-arrow-right"></i></button>
            <?php else: ?>
            <a href="<?php echo e($ctaUrl); ?>" class="ss-hero-cta"><?php echo e($ctaText); ?> <i class="fa-solid fa-arrow-right"></i></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\hero.blade.php ENDPATH**/ ?>