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
    $label = $data['label'] ?? 'What Drives Us';
    $title = $data['title'] ?? 'Our Values';
    $items = $data['items'] ?? [];
?>

<?php if (! $__env->hasRenderedOnce('7f48c391-8b22-4658-82c3-9c84b1ddd06d')): $__env->markAsRenderedOnce('7f48c391-8b22-4658-82c3-9c84b1ddd06d'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-about-values { padding: 100px 0; }
@media (max-width: 767px) { .dm-about-values { padding: 80px 0 50px; } }
@media (max-width: 575px) { .dm-about-values { padding: 64px 0 40px; } }
.dm-about-section-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(0,0,0,0.35);
    font-family: var(--tp-ff-onest);
}
.dm-about-section-title {
    font-size: 36px;
    font-weight: 600;
    color: #111;
    margin-top: 12px;
    margin-bottom: 50px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) {
    .dm-about-section-title { font-size: 24px; margin-bottom: 32px; }
}
@media (max-width: 575px) {
    .dm-about-section-title { font-size: 22px; margin-bottom: 24px; }
}
.dm-value-item {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 14px;
    padding: 32px;
    transition: all 0.3s ease;
    height: 100%;
}
.dm-value-item:hover {
    border-color: rgba(0,0,0,0.15);
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
}
.dm-value-item-icon {
    width: 48px;
    height: 48px;
    margin-bottom: 18px;
}
.dm-value-item-icon img { width: 100%; height: 100%; object-fit: contain; }
.dm-value-item h5 {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 10px;
    font-family: var(--tp-ff-onest);
}
.dm-value-item p {
    font-size: 15px;
    line-height: 1.7;
    color: rgba(0,0,0,0.6);
    margin: 0;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) {
    .dm-value-item { padding: 24px 20px; }
    .dm-value-item-icon { width: 40px; height: 40px; margin-bottom: 14px; }
    .dm-value-item h5 { font-size: 16px; }
    .dm-value-item p { font-size: 14px; }
}
@media (max-width: 575px) {
    .dm-value-item { padding: 20px 16px; border-radius: 10px; }
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="dm-about-values">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <div class="dm-about-section-label"><?php echo e($label); ?></div>
            <h3 class="dm-about-section-title"><?php echo e($title); ?></h3>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".<?php echo e(3 + ($i % 6)); ?>">
                <div class="dm-value-item">
                    <?php if(!empty($item['icon'])): ?>
                    <div class="dm-value-item-icon">
                        <img src="<?php echo e(asset('assets/img/logo/icon/' . $item['icon'] . '.png')); ?>" alt="">
                    </div>
                    <?php endif; ?>
                    <h5><?php echo e($item['title'] ?? ''); ?></h5>
                    <p><?php echo e($item['description'] ?? ''); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\about-values.blade.php ENDPATH**/ ?>