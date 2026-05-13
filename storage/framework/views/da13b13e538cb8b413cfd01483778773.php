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
    $label      = $data['label']      ?? 'Who We Are';
    $title      = $data['title']      ?? '';
    $paragraphs = $data['paragraphs'] ?? [];
?>

<?php if (! $__env->hasRenderedOnce('aee4aff1-f4e6-42da-81df-f3e7086cb2d8')): $__env->markAsRenderedOnce('aee4aff1-f4e6-42da-81df-f3e7086cb2d8'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-about-intro { padding: 100px 0; }
@media (max-width: 767px) { .dm-about-intro { padding: 60px 0; } }
.dm-about-intro-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(0,0,0,0.35);
    margin-bottom: 20px;
    font-family: var(--tp-ff-onest);
}
.dm-about-intro-title {
    font-size: 36px;
    font-weight: 600;
    color: #111;
    line-height: 1.3;
    margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .dm-about-intro-title { font-size: 26px; } }
.dm-about-intro-text p {
    font-size: 17px;
    line-height: 1.8;
    color: rgba(0,0,0,0.65);
    margin-bottom: 20px;
    font-family: var(--tp-ff-onest);
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="dm-about-intro">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-5 tp_fade_anim" data-delay=".3">
                <div class="dm-about-intro-label"><?php echo e($label); ?></div>
                <h2 class="dm-about-intro-title"><?php echo e($title); ?></h2>
            </div>
            <div class="col-lg-7 tp_fade_anim" data-delay=".5">
                <div class="dm-about-intro-text">
                    <?php $__currentLoopData = $paragraphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $para): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p><?php echo e($para); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/components/service-sections/about-intro.blade.php ENDPATH**/ ?>