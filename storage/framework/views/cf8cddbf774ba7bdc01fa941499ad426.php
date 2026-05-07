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
    $missionTitle = $data['mission_title'] ?? 'Our Mission';
    $missionText  = $data['mission_text']  ?? '';
    $visionTitle  = $data['vision_title']  ?? 'Our Vision';
    $visionText   = $data['vision_text']   ?? '';
?>

<?php if (! $__env->hasRenderedOnce('c2cfaf75-9190-43c4-af7a-0d65ba1f9665')): $__env->markAsRenderedOnce('c2cfaf75-9190-43c4-af7a-0d65ba1f9665'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-about-mv { padding: 80px 0; background: #f8f9fa; }
@media (max-width: 767px) { .dm-about-mv { padding: 50px 0; } }
@media (max-width: 575px) { .dm-about-mv { padding: 40px 0; } }
.dm-mv-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 16px;
    padding: 40px;
    height: 100%;
    transition: transform 0.3s ease;
}
.dm-mv-card:hover { transform: translateY(-4px); }
.dm-mv-card h4 {
    font-size: 24px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.dm-mv-card p {
    font-size: 16px;
    line-height: 1.75;
    color: rgba(0,0,0,0.6);
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) {
    .dm-mv-card { padding: 28px 24px; border-radius: 12px; }
    .dm-mv-card h4 { font-size: 20px; margin-bottom: 12px; }
    .dm-mv-card p { font-size: 15px; }
}
@media (max-width: 575px) {
    .dm-mv-card { padding: 22px 18px; }
    .dm-mv-card h4 { font-size: 18px; }
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="dm-about-mv">
    <div class="container container-1230">
        <div class="row g-4">
            <div class="col-md-6 tp_fade_anim" data-delay=".3">
                <div class="dm-mv-card">
                    <h4><?php echo e($missionTitle); ?></h4>
                    <p><?php echo e($missionText); ?></p>
                </div>
            </div>
            <div class="col-md-6 tp_fade_anim" data-delay=".5">
                <div class="dm-mv-card">
                    <h4><?php echo e($visionTitle); ?></h4>
                    <p><?php echo e($visionText); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/components/service-sections/about-mission-vision.blade.php ENDPATH**/ ?>