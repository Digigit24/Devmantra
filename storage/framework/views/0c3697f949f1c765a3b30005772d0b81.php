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
    $label       = $data['label']       ?? 'Our Commitment';
    $title       = $data['title']       ?? 'Our Commitment to Your Financial Success';
    $description = $data['description'] ?? 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy';
?>

<div class="cr-feature-2-area p-relative cr-feature-2-ptb">
    <div class="cr-feature-2-bg">
        <img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-bg.png')); ?>" alt="">
    </div>
    <div class="container-fluid gx-0">
        <div class="row g-0">
            <div class="col-xxl-4 col-xl-6 order-2 order-xxl-1">
                <div class="cr-feature-2-left">
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-1.png')); ?>" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-2.png')); ?>" alt=""></div></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-3.png')); ?>" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-4.png')); ?>" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-5.png')); ?>" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-6.png')); ?>" alt=""></div></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-7.png')); ?>" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-8.png')); ?>" alt=""></div></div></div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CENTER CONTENT -->
            <div class="col-xxl-4 order-xl-12 order-1 order-xxl-2">
                <div class="cr-feature-2-heading text-center">
                    <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3"><?php echo e($label); ?></div>
                    <h4 class="tp-section-title-onest tp-text-revel-anim"><?php echo e($title); ?></h4>
                    <div class="tp_text_anim"><p><?php echo e($description); ?></p></div>
                    <div class="cr-feature-2-btn tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                        <?php if (isset($component)) { $__componentOriginal490cf816fa75abeeb835565b23a9eae8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal490cf816fa75abeeb835565b23a9eae8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn-primary','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('btn-primary'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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

            <!-- RIGHT GRID -->
            <div class="col-xxl-4 col-xl-6 order-2 order-xxl-3">
                <div class="cr-feature-2-right">
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0 justify-content-end">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-9.png')); ?>" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-10.png')); ?>" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-11.png')); ?>" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-12.png')); ?>" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-13.png')); ?>" alt=""></div></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-14.png')); ?>" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="<?php echo e(asset('assets/img/home-13/feature/feature-2/feature-2-15.png')); ?>" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/components/service-sections/page-commitment-grid.blade.php ENDPATH**/ ?>