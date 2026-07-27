<?php extract((new \Illuminate\Support\Collection($attributes->getAttributes()))->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['data']));

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

foreach (array_filter((['data']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php if (isset($component)) { $__componentOriginal6b430bd7348d5ff06fe25908fa7b48c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6b430bd7348d5ff06fe25908fa7b48c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.service-sections.page-what-we-do','data' => ['data' => $data]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-sections.page-what-we-do'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6b430bd7348d5ff06fe25908fa7b48c2)): ?>
<?php $attributes = $__attributesOriginal6b430bd7348d5ff06fe25908fa7b48c2; ?>
<?php unset($__attributesOriginal6b430bd7348d5ff06fe25908fa7b48c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6b430bd7348d5ff06fe25908fa7b48c2)): ?>
<?php $component = $__componentOriginal6b430bd7348d5ff06fe25908fa7b48c2; ?>
<?php unset($__componentOriginal6b430bd7348d5ff06fe25908fa7b48c2); ?>
<?php endif; ?><?php /**PATH C:\Users\hrith\ritik\Devmantranew\storage\framework\views/c1e9a7ea402fd5ce89bfa93b9e65d037.blade.php ENDPATH**/ ?>