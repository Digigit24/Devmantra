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
    $title   = $data['title']   ?? '';
    $pillars = $data['pillars'] ?? [];  // [{title, points:[]}]
    $count   = count($pillars);
    $cols    = $count <= 2 ? 6 : ($count <= 3 ? 4 : 3);
?>

<?php if (! $__env->hasRenderedOnce('5d43c290-34b2-479d-8f8e-52cc1846ae14')): $__env->markAsRenderedOnce('5d43c290-34b2-479d-8f8e-52cc1846ae14'); ?>
<?php $__env->startPush('styles'); ?>
<style>
/* ── Pillars ── */
.ss-pillars {
    padding: 100px 0;
    background: #f5f7fc;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-pillars::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(74,115,196,0.3), transparent);
}
@media (max-width: 991px) { .ss-pillars { padding: 80px 0; } }
@media (max-width: 767px) { .ss-pillars { padding: 64px 0; } }

.ss-pillars-title {
    font-size: 38px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 56px;
    font-family: var(--tp-ff-onest); line-height: 1.25;
}
@media (max-width: 991px) { .ss-pillars-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-pillars-title { font-size: 24px; margin-bottom: 36px; } }

/* Card — matches homepage service card shadow + lift */
.ss-pillar-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px 30px;
    height: 100%;
    border: 1px solid rgba(0,0,0,0.07);
    position: relative;
    overflow: hidden;
    transform: translateZ(0);
    transition: transform .35s cubic-bezier(.165,.84,.44,1),
                border-color .35s ease,
                box-shadow .35s ease;
}
/* large faint ordinal number bg */
.ss-pillar-bg-num {
    position: absolute;
    top: -6px; right: 14px;
    font-size: 100px; font-weight: 900;
    color: rgba(27,60,107,0.04);
    line-height: 1;
    font-family: var(--tp-ff-onest);
    user-select: none; pointer-events: none;
    transition: color .35s ease, transform .35s ease;
}
/* top gradient bar reveal on hover */
.ss-pillar-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .4s cubic-bezier(.165,.84,.44,1);
}
.ss-pillar-card:hover {
    transform: translateY(-8px);
    border-color: rgba(74,115,196,0.2);
    box-shadow: 0 20px 60px rgba(27,60,107,0.13);
}
.ss-pillar-card:hover::before { transform: scaleX(1); }
.ss-pillar-card:hover .ss-pillar-bg-num {
    color: rgba(74,115,196,0.07);
    transform: scale(1.04) translateX(-4px);
}
.ss-pillar-icon {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 20px;
    margin-bottom: 22px;
    box-shadow: 0 6px 20px rgba(27,60,107,0.22);
    position: relative; z-index: 1;
}
.ss-pillar-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 18px; font-family: var(--tp-ff-onest);
    line-height: 1.3; position: relative; z-index: 1;
}
.ss-pillar-points {
    list-style: none; padding: 0; margin: 0;
    position: relative; z-index: 1;
}
.ss-pillar-points li {
    font-size: 14px; color: #5a6478; line-height: 1.65;
    padding: 8px 0 8px 20px; position: relative;
    border-bottom: 1px solid rgba(0,0,0,0.04);
}
.ss-pillar-points li:last-child { border-bottom: none; }
.ss-pillar-points li::before {
    content: '';
    position: absolute; left: 0; top: 15px;
    width: 6px; height: 6px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-pillars">
    <div class="container container-1230">
        <?php if($title): ?>
        <h2 class="ss-pillars-title tp_fade_anim" data-delay=".2"><?php echo e($title); ?></h2>
        <?php endif; ?>
        <div class="row g-4">
            <?php $__currentLoopData = $pillars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pillar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-<?php echo e($cols); ?> col-md-6 tp_fade_anim" data-delay="<?php echo e(0.2 + ($i * 0.1)); ?>">
                <div class="ss-pillar-card">
                    <span class="ss-pillar-bg-num"><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></span>
                    <div class="ss-pillar-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <h3 class="ss-pillar-title"><?php echo e($pillar['title'] ?? ''); ?></h3>
                    <?php if(!empty($pillar['points'])): ?>
                    <ul class="ss-pillar-points">
                        <?php $__currentLoopData = $pillar['points']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\pillars.blade.php ENDPATH**/ ?>