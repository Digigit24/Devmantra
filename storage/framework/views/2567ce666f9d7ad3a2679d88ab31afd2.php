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
    $label             = $data['label']              ?? 'Our Knowledge Partner';
    $title             = $data['title']              ?? 'Our Knowledge Partner';
    $titleHighlight    = $data['title_highlight']    ?? 'Partner';
    $description       = $data['description']        ?? '';
    $logoImage         = $data['logo_image']         ?? 'assets/img/about-us/caindia.jpg';
    $certificateImage  = $data['certificate_image']  ?? 'assets/img/about-us/peercertificate.jpg';

    // Split title so the highlight word is wrapped in accent color
    $titleHighlightTrimmed = trim($titleHighlight);
    if ($titleHighlightTrimmed && str_contains($title, $titleHighlightTrimmed)) {
        $titleParts = explode($titleHighlightTrimmed, $title, 2);
        $titleBefore = $titleParts[0];
        $titleAfter  = $titleParts[1] ?? '';
    } else {
        $titleBefore = $title;
        $titleHighlightTrimmed = '';
        $titleAfter  = '';
    }
?>

<?php if (! $__env->hasRenderedOnce('fc07ca5e-1c15-41d6-989b-7f1f3decc339')): $__env->markAsRenderedOnce('fc07ca5e-1c15-41d6-989b-7f1f3decc339'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-kp-section {
    padding-bottom: 100px;
    background: #fff;
}
@media (max-width: 767px) { .dm-kp-section { padding: 50px 0; } }
@media (max-width: 575px) { .dm-kp-section { padding: 36px 0; } }

.dm-kp-logo-wrap {
    margin-bottom: 36px;
}
.dm-kp-logo-wrap img {
    height: 90px;
    width: auto;
    object-fit: contain;
}
@media (max-width: 767px) { .dm-kp-logo-wrap img { height: 70px; } }
@media (max-width: 575px) { .dm-kp-logo-wrap img { height: 56px; } }

.dm-kp-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(0,0,0,0.35);
    font-family: var(--tp-ff-onest);
    margin-bottom: 14px;
}

.dm-kp-heading {
    font-size: 36px;
    font-weight: 700;
    color: #111;
    font-family: var(--tp-ff-onest);
    line-height: 1.2;
    margin-bottom: 24px;
}
.dm-kp-heading .dm-kp-accent {
    color: #0064a6;
}
@media (max-width: 991px) { .dm-kp-heading { font-size: 30px; } }
@media (max-width: 767px) { .dm-kp-heading { font-size: 26px; } }
@media (max-width: 575px) { .dm-kp-heading { font-size: 22px; } }

.dm-kp-description {
    font-size: 15px;
    line-height: 1.8;
    color: rgba(0,0,0,0.6);
    font-family: var(--tp-ff-onest);
    max-width: 520px;
}
@media (max-width: 991px) { .dm-kp-description { max-width: 100%; } }
@media (max-width: 767px) { .dm-kp-description { font-size: 14px; } }

.dm-kp-cert-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
}
.dm-kp-cert-wrap img {
    width: 100%;
    max-width: 500px;
    border-radius: 12px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.10);
    border: 1px solid rgba(0,0,0,0.07);
    object-fit: contain;
}
@media (max-width: 991px) {
    .dm-kp-cert-wrap { margin-top: 40px; }
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<section class="dm-kp-section">
    <div class="container container-1230">
        <div class="row align-items-center g-5">

            
            <div class="col-lg-6 tp_fade_anim" data-delay=".3">
                <?php if($logoImage): ?>
                <div class="dm-kp-logo-wrap">
                    <img src="<?php echo e(asset($logoImage)); ?>" alt="CA India">
                </div>
                <?php endif; ?>

                <?php if($label): ?>
                <div class="dm-kp-label"><?php echo e($label); ?></div>
                <?php endif; ?>

                <h2 class="dm-kp-heading">
                    <?php echo $titleBefore; ?><?php if($titleHighlightTrimmed): ?><span class="dm-kp-accent"><?php echo e($titleHighlightTrimmed); ?></span><?php endif; ?><?php echo $titleAfter; ?>

                </h2>

                <?php if($description): ?>
                <p class="dm-kp-description"><?php echo e($description); ?></p>
                <?php endif; ?>
            </div>

            
            <div class="col-lg-6 tp_fade_anim" data-delay=".5">
                <div class="dm-kp-cert-wrap">
                    <img src="<?php echo e(asset($certificateImage)); ?>" alt="Peer Review Certificate">
                </div>
            </div>

        </div>
    </div>
</section>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/components/service-sections/about-knowledge-partner.blade.php ENDPATH**/ ?>