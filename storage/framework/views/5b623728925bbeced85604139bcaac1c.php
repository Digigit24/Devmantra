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
    $label    = $data['label'] ?? 'What We Do';
    $title    = $data['title'] ?? 'Our Expertise';
    $services = \App\Models\Service::where('status', 'published')->orderBy('sort_order')->get();
?>

<?php if (! $__env->hasRenderedOnce('32d9be63-4849-41d9-af25-442d9f3414ad')): $__env->markAsRenderedOnce('32d9be63-4849-41d9-af25-442d9f3414ad'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-about-services { padding: 80px 0; background: #001d30; }
@media (max-width: 767px) { .dm-about-services { padding: 50px 0; } }
.dm-about-service-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 32px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
    height: 100%;
}
.dm-about-service-card:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-3px);
}
.dm-about-service-card h5 {
    font-size: 18px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 10px;
    font-family: var(--tp-ff-onest);
}
.dm-about-service-card p {
    font-size: 15px;
    line-height: 1.7;
    color: rgba(255,255,255,0.5);
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.dm-about-service-card a {
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    border-bottom: 1px solid rgba(255,255,255,0.3);
    padding-bottom: 2px;
    transition: border-color 0.3s ease;
    font-family: var(--tp-ff-onest);
}
.dm-about-service-card a:hover { border-color: #fff; }
.dm-about-services-label {
    color: rgba(255,255,255,0.35);
}
.dm-about-services-title {
    color: #fff !important;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php if($services->count()): ?>
<div class="dm-about-services">
    <div class="container container-1230">
        <div class="text-center mb-50 tp_fade_anim" data-delay=".3">
            <div class="dm-about-section-label dm-about-services-label"><?php echo e($label); ?></div>
            <h3 class="dm-about-section-title dm-about-services-title"><?php echo e($title); ?></h3>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".<?php echo e(3 + ($loop->index % 6)); ?>">
                <div class="dm-about-service-card">
                    <h5><?php echo e($service->title); ?></h5>
                    <p><?php echo e(Str::limit($service->short_description, 120)); ?></p>
                    <a href="<?php echo e(route('service.show', $service->slug)); ?>">Learn More &rarr;</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\about-services-overview.blade.php ENDPATH**/ ?>