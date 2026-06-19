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
    $title        = $data['title']        ?? '';
    $description  = $data['description']  ?? '';
    $description2 = $data['description2'] ?? '';
    $ctaText      = $data['cta_text']     ?? '';
    $ctaUrl       = $data['cta_url']      ?? '#contact';
    $stats        = $data['stats']        ?? [];   // [{value, label}]
?>

<?php if (! $__env->hasRenderedOnce('f337ba8b-e7d1-486e-a354-b616ecb0fd07')): $__env->markAsRenderedOnce('f337ba8b-e7d1-486e-a354-b616ecb0fd07'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.ss-overview {
    padding: 90px 0;
    background: #fff;
    font-family: var(--tp-ff-onest);
}
.ss-overview-eyebrow {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #1b3c6b;
    background: rgba(27,60,107,0.07);
    padding: 5px 16px;
    border-radius: 20px;
    margin-bottom: 20px;
}
.ss-overview-title {
    font-size: 36px;
    font-weight: 700;
    color: #0d1b2a;
    line-height: 1.3;
    margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-overview-title { font-size: 26px; } }
.ss-overview-body p {
    font-size: 16px;
    color: #444;
    line-height: 1.8;
    margin-bottom: 20px;
}
.ss-overview-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #1b3c6b;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border-bottom: 2px solid #1b3c6b;
    padding-bottom: 2px;
    margin-top: 8px;
    cursor: pointer;
    background: none;
    border-left: none; border-right: none; border-top: none;
    transition: gap .2s;
}
.ss-overview-cta:hover { gap: 16px; }
/* Stats */
.ss-overview-stats { display: flex; gap: 28px; flex-wrap: wrap; margin-top: 32px; }
.ss-overview-stat {
    background: #f5f7fa;
    border-radius: 12px;
    padding: 20px 28px;
    min-width: 130px;
    text-align: center;
}
.ss-overview-stat-value {
    font-size: 32px;
    font-weight: 800;
    color: #1b3c6b;
    line-height: 1;
    margin-bottom: 6px;
    font-family: var(--tp-ff-onest);
}
.ss-overview-stat-label { font-size: 13px; color: #666; }
/* Visual side */
.ss-overview-visual {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 16px;
    height: 100%;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
}
.ss-overview-visual-text {
    font-size: 18px;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    text-align: center;
    line-height: 1.6;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="ss-overview">
    <div class="container container-1230">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 tp_fade_anim" data-delay=".2">
                <h2 class="ss-overview-title"><?php echo e($title); ?></h2>
                <div class="ss-overview-body">
                    <?php if($description): ?><p><?php echo e($description); ?></p><?php endif; ?>
                    <?php if($description2): ?><p><?php echo e($description2); ?></p><?php endif; ?>
                </div>
                <?php if(!empty($stats)): ?>
                <div class="ss-overview-stats">
                    <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="ss-overview-stat">
                        <div class="ss-overview-stat-value"><?php echo e($stat['value'] ?? ''); ?></div>
                        <div class="ss-overview-stat-label"><?php echo e($stat['label'] ?? ''); ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <?php if($ctaText): ?>
                <div style="margin-top:32px;">
                <?php if(str_starts_with($ctaUrl, '#')): ?>
                <button class="ss-overview-cta"
                    onclick="window.openConsultationModal && window.openConsultationModal()">
                    <?php echo e($ctaText); ?> <i class="fa-solid fa-arrow-right"></i>
                </button>
                <?php else: ?>
                <a href="<?php echo e($ctaUrl); ?>" class="ss-overview-cta"><?php echo e($ctaText); ?> <i class="fa-solid fa-arrow-right"></i></a>
                <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-5 tp_fade_anim" data-delay=".4">
                <div class="ss-overview-visual">
                    <p class="ss-overview-visual-text"><?php echo e($title); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\overview.blade.php ENDPATH**/ ?>