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
    $title = $data['title'] ?? 'Explore Our Other Services';
    $items = $data['items'] ?? [];   // [{label, url}]
?>

<?php if (! $__env->hasRenderedOnce('5e65b547-cb93-4ed5-b67e-25503e8d22b8')): $__env->markAsRenderedOnce('5e65b547-cb93-4ed5-b67e-25503e8d22b8'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-other-services { padding: 80px 0; background: #fff; font-family: var(--tp-ff-onest); }
.ss-other-services-title {
    font-size: 32px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 40px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-other-services-title { font-size: 24px; } }
.ss-other-pills {
    display: flex; flex-wrap: wrap; gap: 14px; justify-content: center;
}
.ss-other-pill {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 24px;
    border: 1.5px solid #1b3c6b;
    border-radius: 100px;
    font-size: 14px; font-weight: 600; color: #1b3c6b;
    text-decoration: none;
    transition: background .2s, color .2s, transform .2s;
}
.ss-other-pill:hover {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
    border-color: transparent;
    transform: translateY(-2px);
}
.ss-other-pill i { font-size: 11px; }
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-other-services">
    <div class="container container-1230">
        <h2 class="ss-other-services-title tp_fade_anim" data-delay=".2"><?php echo e($title); ?></h2>
        <div class="ss-other-pills tp_fade_anim" data-delay=".3">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($item['url'] ?? route('home')); ?>" class="ss-other-pill">
                <?php echo e($item['label'] ?? ''); ?> <i class="fa-solid fa-arrow-right"></i>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\other-services.blade.php ENDPATH**/ ?>