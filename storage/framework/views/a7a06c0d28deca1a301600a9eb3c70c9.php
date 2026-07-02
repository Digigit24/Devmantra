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
    $title    = $data['title']    ?? 'Countries that we serve';
    $subtitle = $data['subtitle'] ?? 'We work with clients across the globe, delivering solutions without borders.';
?>

<section class="cr-world-area cr-brand-ptb fix">
    <div class="container container-1230">
        <div class="cr-multi-border pt-100 pb-50">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center mb-60">
                    <h3 class="tp-section-title-onest fs-72"><?php echo e($title); ?></h3>
                    <p><?php echo e($subtitle); ?></p>
                </div>
                <div class="col-lg-10">
                    <div class="world-map-box">
                        <div class="map-base">
                            <img src="<?php echo e(asset('assets/img/logo/map.png')); ?>" alt="" loading="lazy">
                        </div>
                        <svg class="map-overlay" viewBox="0 0 1000 500" xmlns="http://www.w3.org/2000/svg">
                            <g id="pins">
                                <circle class="pin" cx="190" cy="180" r="6" data-country="USA"></circle>
                                <circle class="pin" cx="445" cy="165" r="6" data-country="UK"></circle>
                                <circle class="pin" cx="510" cy="210" r="6" data-country="Italy"></circle>
                                <circle class="pin" cx="620" cy="270" r="6" data-country="Oman"></circle>
                                <circle class="pin" cx="695" cy="310" r="6" data-country="Sri Lanka"></circle>
                                <circle class="pin" cx="760" cy="325" r="6" data-country="Singapore"></circle>
                                <circle class="pin" cx="840" cy="395" r="6" data-country="Australia"></circle>
                            </g>
                        </svg>
                        <div class="map-tooltip" id="mapTooltip"></div>
                    </div>

                    
                    <div class="map-mobile-list">
                        <?php $__currentLoopData = ['USA','UK','Italy','Oman','Sri Lanka','Singapore','Australia']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="map-mobile-tag"><?php echo e($country); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (! $__env->hasRenderedOnce('805c4cca-af52-4dd9-87fa-3d93de49cfb7')): $__env->markAsRenderedOnce('805c4cca-af52-4dd9-87fa-3d93de49cfb7'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    var pins = document.querySelectorAll(".pin");
    var box = document.querySelector(".world-map-box");
    if (!pins.length || !box) return;

    var oldTooltip = document.getElementById("mapTooltip");
    if (oldTooltip) oldTooltip.remove();

    // Only render floating tooltips on non-mobile
    if (window.innerWidth <= 767) return;

    pins.forEach(function (pin) {
        var name = pin.getAttribute("data-country");
        var tip = document.createElement("div");
        tip.className = "map-tooltip map-tooltip-always";
        tip.textContent = name;
        box.appendChild(tip);

        function positionTip() {
            if (window.innerWidth <= 767) { tip.style.display = "none"; return; }
            tip.style.display = "";
            var rect = box.getBoundingClientRect();
            var pt = pin.getBoundingClientRect();
            tip.style.left = (pt.left - rect.left + pt.width / 2) + "px";
            tip.style.top = (pt.top - rect.top) + "px";
        }

        window.addEventListener("load", positionTip);
        window.addEventListener("resize", positionTip);
        setTimeout(positionTip, 200);
        setTimeout(positionTip, 800);
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views/components/service-sections/page-world-map.blade.php ENDPATH**/ ?>