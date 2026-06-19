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
    $title    = $data['title']    ?? 'Ready to Elevate Your Business with Dev Mantra?';
    $subtitle = $data['subtitle'] ?? 'Dev Mantra is here to help you scale with confidence through future-ready financial, governance, and advisory solutions.';
    $ctaText  = $data['cta_text'] ?? null;
    $ctaUrl   = $data['cta_url']  ?? null;
?>

<?php if (! $__env->hasRenderedOnce('dbb924c0-e18e-48bb-8ec8-02021f15d582')): $__env->markAsRenderedOnce('dbb924c0-e18e-48bb-8ec8-02021f15d582'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.cr-cta-area-light { background: #f8f9fa; }
.cr-cta-area-light .tp-section-title-onest { color: #111 !important; }
.cr-cta-area-light .cr-cta-text { color: #555; }
.cr-cta-area-light .cr-cta-btn .tp-btn-white-border,
.cr-cta-area-light .cr-cta-btn .tp-btn-light-bg {
    color: #fff;
    background-color: #1b3c6b;
    border-color: #1b3c6b;
}
.cr-cta-area-light .cr-cta-btn .tp-btn-white-border:hover,
.cr-cta-area-light .cr-cta-btn .tp-btn-light-bg:hover {
    background-color: #0f2b5c;
    color: #fff;
    border-color: #0f2b5c;
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<!-- CTA section start -->
<div class="cr-cta-area-light">
    <div class="cr-cta-ptb p-relative pt-50 pb-100">
        <div class="cr-cta-bg">
            <img src="<?php echo e(asset('assets/img/home-13/cta/cta-thumb-bg.png')); ?>" alt="" loading="lazy">
        </div>
        <div class="cr-cta-shape">
            <span class="shape-1"></span><span class="shape-2"></span><span class="shape-3"></span>
            <span class="shape-4"></span><span class="shape-5"></span><span class="shape-6"></span>
            <span class="shape-7"></span><span class="shape-8"></span><span class="shape-9"></span>
            <span class="shape-10"></span><span class="shape-11"></span><span class="shape-12"></span>
            <span class="shape-13"></span><span class="shape-14"></span><span class="shape-15"></span>
        </div>
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-cta-content text-center">
                        <div class="cr-cta-img p-relative mb-20">
                            <img src="<?php echo e(asset('assets/img/home-13/cta/cta-thumb.gif')); ?>" alt="" loading="lazy">
                        </div>
                        <h4 class="tp-section-title-onest fs-50 tp-text-revel-anim" style="color: #111;">
                            <?php echo nl2br(e($title)); ?>

                        </h4>
                        <div class="tp_text_anim">
                            <p class="cr-cta-text" style="color: #555;"><?php echo e($subtitle); ?></p>
                        </div>
                        <div class="cr-cta-btn tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                            <?php if (isset($component)) { $__componentOriginal490cf816fa75abeeb835565b23a9eae8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal490cf816fa75abeeb835565b23a9eae8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-primary','data' => ['url' => $ctaUrl,'text' => $ctaText]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ctaUrl),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($ctaText)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal490cf816fa75abeeb835565b23a9eae8)): ?>
<?php $attributes = $__attributesOriginal490cf816fa75abeeb835565b23a9eae8; ?>
<?php unset($__attributesOriginal490cf816fa75abeeb835565b23a9eae8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal490cf816fa75abeeb835565b23a9eae8)): ?>
<?php $component = $__componentOriginal490cf816fa75abeeb835565b23a9eae8; ?>
<?php unset($__componentOriginal490cf816fa75abeeb835565b23a9eae8); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA section end -->
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\page-cta.blade.php ENDPATH**/ ?>