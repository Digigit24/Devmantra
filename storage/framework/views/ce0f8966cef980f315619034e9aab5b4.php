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
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];   // [{title, description, icon?, points:[]}]
?>

<?php if (! $__env->hasRenderedOnce('50694b9b-043a-4e84-bb8b-85865b92a676')): $__env->markAsRenderedOnce('50694b9b-043a-4e84-bb8b-85865b92a676'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-services-grid { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-services-grid-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    line-height: 1.3; margin-bottom: 50px; text-align: center;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-services-grid-title { font-size: 26px; margin-bottom: 36px; } }
.ss-sg-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px 28px;
    height: 100%;
    transition: transform .25s, box-shadow .25s;
    border: 1px solid rgba(0,0,0,0.05);
}
.ss-sg-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); }
.ss-sg-icon {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
    font-size: 20px; color: #fff;
}
.ss-sg-card-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
}
.ss-sg-card-desc { font-size: 15px; color: #555; line-height: 1.7; margin-bottom: 16px; }
.ss-sg-points { list-style: none; padding: 0; margin: 0; }
.ss-sg-points li {
    font-size: 14px; color: #444; padding: 5px 0 5px 22px;
    position: relative; line-height: 1.6;
}
.ss-sg-points li::before {
    content: '✓';
    position: absolute; left: 0; top: 5px;
    color: #4a73c4; font-weight: 700; font-size: 13px;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-services-grid">
    <div class="container container-1230">
        <?php if($title): ?>
        <h2 class="ss-services-grid-title tp_fade_anim" data-delay=".2"><?php echo e($title); ?></h2>
        <?php endif; ?>
        <div class="row g-4">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay="<?php echo e(0.2 + ($i * 0.1)); ?>">
                <div class="ss-sg-card">
                    <?php if(!empty($item['icon'])): ?>
                    <div class="ss-sg-icon"><i class="<?php echo e($item['icon']); ?>"></i></div>
                    <?php else: ?>
                    <div class="ss-sg-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <?php endif; ?>
                    <h3 class="ss-sg-card-title"><?php echo e($item['title'] ?? ''); ?></h3>
                    <?php if(!empty($item['description'])): ?>
                    <p class="ss-sg-card-desc"><?php echo e($item['description']); ?></p>
                    <?php endif; ?>
                    <?php if(!empty($item['points'])): ?>
                    <ul class="ss-sg-points">
                        <?php $__currentLoopData = $item['points']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($point); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\services-grid.blade.php ENDPATH**/ ?>