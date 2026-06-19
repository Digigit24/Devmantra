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
    $title   = $data['title']    ?? 'Ready to Transform Your Business?';
    $subtitle = $data['subtitle'] ?? "Let's discuss how Dev Mantra can help you achieve your financial goals.";
    $ctaText = $data['cta_text'] ?? 'Book a Free Consultation';
    $ctaUrl  = $data['cta_url']  ?? '/contact';
?>

<?php if (! $__env->hasRenderedOnce('4cb277fb-becf-4e7a-a3bd-8bc5508eea89')): $__env->markAsRenderedOnce('4cb277fb-becf-4e7a-a3bd-8bc5508eea89'); ?>
<?php $__env->startPush('styles'); ?>
<style>
.dm-about-cta {
    padding: 100px 0;
    text-align: center;
    background: #fff;
}
@media (max-width: 767px) { .dm-about-cta { padding: 60px 0; } }
.dm-about-cta h3 {
    font-size: 36px;
    font-weight: 600;
    color: #111 !important;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .dm-about-cta h3 { font-size: 26px; } }
.dm-about-cta p {
    font-size: 17px;
    color: rgba(0,0,0,0.55) !important;
    margin-bottom: 32px;
    font-family: var(--tp-ff-onest);
}
.dm-about-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: var(--dm-brand-gradient, linear-gradient(135deg, #1b3c6b, #4a73c4));
    color: #fff;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.25s, transform 0.25s, box-shadow 0.25s;
    box-shadow: 0 4px 20px rgba(0,0,0,0.18);
    font-family: var(--tp-ff-onest);
}
.dm-about-cta-btn:hover {
    opacity: 0.88;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.25);
}
</style>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<div class="dm-about-cta">
    <div class="container container-1230">
        <h3 class="tp_fade_anim" data-delay=".3"><?php echo e($title); ?></h3>
        <p class="tp_fade_anim" data-delay=".5"><?php echo e($subtitle); ?></p>
        <a href="<?php echo e($ctaUrl); ?>" class="dm-about-cta-btn tp_fade_anim" data-delay=".7">
            <?php echo e($ctaText); ?>

            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
            </svg>
        </a>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\components\service-sections\about-cta.blade.php ENDPATH**/ ?>