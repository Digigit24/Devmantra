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
    $title   = $data['title']   ?? 'Markets Served';
    $markets = $data['markets'] ?? [];   // [string, ...]
    // Map market name → flag emoji
    $flags = [
        'usa' => '🇺🇸', 'united states' => '🇺🇸', 'us' => '🇺🇸',
        'uk' => '🇬🇧', 'united kingdom' => '🇬🇧',
        'europe' => '🇪🇺',
        'korea' => '🇰🇷', 'south korea' => '🇰🇷',
        'japan' => '🇯🇵',
        'singapore' => '🇸🇬',
        'dubai' => '🇦🇪', 'uae' => '🇦🇪', 'abu dhabi' => '🇦🇪',
        'australia' => '🇦🇺',
        'new zealand' => '🇳🇿',
        'canada' => '🇨🇦',
        'india' => '🇮🇳',
    ];
?>

<?php if (! $__env->hasRenderedOnce('f931ca6d-08ad-4803-9d99-bd53de10492e')): $__env->markAsRenderedOnce('f931ca6d-08ad-4803-9d99-bd53de10492e'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-markets { padding: 80px 0; background: #111; font-family: var(--tp-ff-onest); }
.ss-markets-title {
    font-size: 34px; font-weight: 700; color: #fff;
    text-align: center; margin-bottom: 44px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-markets-title { font-size: 24px; } }
.ss-markets-grid { display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; }
.ss-markets-badge {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 12px 22px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 100px;
    font-size: 15px; color: #fff;
    transition: background .2s, border-color .2s;
}
.ss-markets-badge:hover {
    background: rgba(74,115,196,0.3);
    border-color: #4a73c4;
}
.ss-markets-badge-flag { font-size: 18px; }
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-markets">
    <div class="container container-1230">
        <h2 class="ss-markets-title tp_fade_anim" data-delay=".2"><?php echo e($title); ?></h2>
        <div class="ss-markets-grid tp_fade_anim" data-delay=".3">
            <?php $__currentLoopData = $markets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $market): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $flag = $flags[strtolower(trim($market))] ?? '🌍';
            ?>
            <div class="ss-markets-badge">
                <span class="ss-markets-badge-flag"><?php echo e($flag); ?></span>
                <span><?php echo e($market); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\markets-served.blade.php ENDPATH**/ ?>