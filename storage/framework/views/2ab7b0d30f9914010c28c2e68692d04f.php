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
    $subtitle    = $data['subtitle']    ?? 'About Dev Mantra';
    $title       = $data['title']       ?? 'Strategic Partner in Progress for Global Businesses';
    $description = $data['description'] ?? '';
?>

<?php if (! $__env->hasRenderedOnce('77bf20d5-8ea6-488f-a154-27a2c6b32e30')): $__env->markAsRenderedOnce('77bf20d5-8ea6-488f-a154-27a2c6b32e30'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-about-hero {
    background-color: #001d30;
    padding: 200px 0 100px;
    position: relative;
    overflow: hidden;
}
@media (max-width: 767px) { .dm-about-hero { padding: 150px 0 70px; } }
.dm-about-hero-subtitle {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.5);
    margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
}
.dm-about-hero-title {
    font-size: 52px;
    font-weight: 600;
    color: #fff;
    line-height: 1.2;
    max-width: 700px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .dm-about-hero-title { font-size: 38px; } }
@media (max-width: 767px) { .dm-about-hero-title { font-size: 28px; } }
.dm-about-hero-desc {
    font-size: 18px;
    color: rgba(255,255,255,0.6);
    line-height: 1.7;
    max-width: 600px;
    margin-top: 24px;
    font-family: var(--tp-ff-onest);
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="dm-about-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-8">
                <div class="dm-about-hero-subtitle tp_fade_anim" data-delay=".3"><?php echo e($subtitle); ?></div>
                <h1 class="dm-about-hero-title tp-text-revel-anim" data-delay=".5"><?php echo e($title); ?></h1>
                <?php if($description): ?>
                <p class="dm-about-hero-desc tp_fade_anim" data-delay=".7"><?php echo e($description); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\about-hero.blade.php ENDPATH**/ ?>