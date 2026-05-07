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
<?php if (isset($component)) { $__componentOriginale1e0a98ff0f1e0186a18a776b5417040 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale1e0a98ff0f1e0186a18a776b5417040 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.service-sections.page-approach-lifecycle','data' => ['data' => $data]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('service-sections.page-approach-lifecycle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($data)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale1e0a98ff0f1e0186a18a776b5417040)): ?>
<?php $attributes = $__attributesOriginale1e0a98ff0f1e0186a18a776b5417040; ?>
<?php unset($__attributesOriginale1e0a98ff0f1e0186a18a776b5417040); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale1e0a98ff0f1e0186a18a776b5417040)): ?>
<?php $component = $__componentOriginale1e0a98ff0f1e0186a18a776b5417040; ?>
<?php unset($__componentOriginale1e0a98ff0f1e0186a18a776b5417040); ?>
<?php endif; ?><?php /**PATH /home2/devmasjc/devmantra/storage/framework/views/15dcd1b25ce1c0c2c2c7420566dae4ce.blade.php ENDPATH**/ ?>