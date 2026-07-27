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
    $title = $data['title'] ?? 'Our Memberships';
    $subtitle = $data['subtitle'] ?? 'Proud members of leading industry bodies and chambers of commerce.';
    $memberships = $data['memberships'] ?? [
        ['name' => 'BCIC',                        'logo' => 'assets/img/memberships/1.png'],
        ['name' => 'FKCCI',                       'logo' => 'assets/img/memberships/2.png'],
        ['name' => 'CII',                         'logo' => 'assets/img/memberships/3.svg'],
        ['name' => 'Indo Italy Chamber',          'logo' => 'assets/img/memberships/4.png'],
        ['name' => 'EU Chambers',                 'logo' => 'assets/img/memberships/5.svg'],
        ['name' => 'CWE',                         'logo' => 'assets/img/memberships/6.png'],
        ['name' => 'Rotary',                      'logo' => 'assets/img/memberships/7.svg'],
        ['name' => 'MAWE',                        'logo' => 'assets/img/memberships/8.jpg'],
        ['name' => 'eMerg',                       'logo' => 'assets/img/memberships/9.png'],
    ];
?>

<section class="dm-memberships-section">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="dm-memberships-heading text-center mb-50">
                    <div class="tp-section-subtitle-gradient ct mb-15">Associations & Recognition</div>
                    <h3 class="tp-section-title-onest fs-48"><?php echo e($title); ?></h3>
                    <p class="dm-memberships-subtitle"><?php echo e($subtitle); ?></p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="dm-memberships-grid">
                    <?php $__currentLoopData = $memberships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="dm-membership-item">
                        <div class="dm-membership-logo-wrap">
                            <img src="<?php echo e(asset($member['logo'])); ?>" alt="<?php echo e($member['name']); ?>" loading="lazy">
                        </div>
                        <span class="dm-membership-name"><?php echo e($member['name']); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\Users\hrith\ritik\Devmantranew\resources\views/components/service-sections/page-memberships.blade.php ENDPATH**/ ?>