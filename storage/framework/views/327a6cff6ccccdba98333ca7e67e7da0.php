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
    $items = $data['items'] ?? [];   // [{title, description, icon?}]
?>

<?php if (! $__env->hasRenderedOnce('cb7cb5be-347c-45da-a377-6c0e9ecf9c31')): $__env->markAsRenderedOnce('cb7cb5be-347c-45da-a377-6c0e9ecf9c31'); ?>
<?php $__env->startPush('styles'); ?>
<style>
/* ── Why Stand Out ── */
.ss-why {
    padding: 100px 0;
    background: #fff;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
/* dot-grid texture matching benefits-list */
.ss-why-texture {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(27,60,107,0.05) 1px, transparent 1px);
    background-size: 26px 26px;
    pointer-events: none;
}
@media (max-width: 991px) { .ss-why { padding: 80px 0; } }
@media (max-width: 767px) { .ss-why { padding: 64px 0; } }

.ss-why-title {
    font-size: 38px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 56px; line-height: 1.25;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-why-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-why-title { font-size: 24px; margin-bottom: 36px; } }

/* Card — homepage service card DNA: white, radius 20, lift -8 with blue shadow */
.ss-why-card {
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
/* faint bg number */
.ss-why-bg-num {
    position: absolute;
    top: -6px; right: 14px;
    font-size: 96px; font-weight: 900;
    color: rgba(27,60,107,0.04);
    line-height: 1;
    font-family: var(--tp-ff-onest);
    user-select: none; pointer-events: none;
    transition: color .35s ease;
}
/* bottom gradient reveal on hover */
.ss-why-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .4s cubic-bezier(.165,.84,.44,1);
}
.ss-why-card:hover {
    transform: translateY(-8px);
    border-color: rgba(74,115,196,0.2);
    box-shadow: 0 20px 60px rgba(27,60,107,0.13);
}
.ss-why-card:hover::after { transform: scaleX(1); }
.ss-why-card:hover .ss-why-bg-num { color: rgba(74,115,196,0.07); }

/* icon */
.ss-why-card-icon {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 20px;
    margin-bottom: 22px;
    box-shadow: 0 6px 20px rgba(27,60,107,0.22);
    position: relative; z-index: 1;
    transition: transform .35s ease, box-shadow .35s ease;
}
.ss-why-card:hover .ss-why-card-icon {
    transform: scale(1.08) rotate(-5deg);
    box-shadow: 0 10px 28px rgba(27,60,107,0.35);
}
.ss-why-card-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
    line-height: 1.3; position: relative; z-index: 1;
}
.ss-why-card-desc {
    font-size: 14.5px; color: #5a6478; line-height: 1.75;
    margin: 0; position: relative; z-index: 1;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-why">
    <div class="ss-why-texture"></div>
    <div class="container container-1230" style="position:relative;z-index:1;">
        <?php if($title): ?>
        <h2 class="ss-why-title tp_fade_anim" data-delay=".2"><?php echo e($title); ?></h2>
        <?php endif; ?>
        <div class="row g-4">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay="<?php echo e(0.2 + ($i * 0.1)); ?>">
                <div class="ss-why-card">
                    <span class="ss-why-bg-num"><?php echo e(str_pad($i + 1, 2, '0', STR_PAD_LEFT)); ?></span>
                    <div class="ss-why-card-icon">
                        <?php if(!empty($item['icon'])): ?>
                        <i class="<?php echo e($item['icon']); ?>"></i>
                        <?php else: ?>
                        <i class="fa-solid fa-star"></i>
                        <?php endif; ?>
                    </div>
                    <h3 class="ss-why-card-title"><?php echo e($item['title'] ?? ''); ?></h3>
                    <p class="ss-why-card-desc"><?php echo e($item['description'] ?? ''); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/components/service-sections/why-stand-out.blade.php ENDPATH**/ ?>