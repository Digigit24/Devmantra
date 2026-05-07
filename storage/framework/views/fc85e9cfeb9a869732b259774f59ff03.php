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
    $label    = $data['label']    ?? 'Our Framework';
    $title    = $data['title']    ?? 'The 6A Strategy Framework';
    $subtitle = $data['subtitle'] ?? 'A proven, structured approach that guides businesses from assessment to transformation — at every stage of growth.';
?>

<!-- SECTION — 6A Strategies -->
<section class="dm-6a-section">
    <div class="container container-1230">
        <div class="dm-6a-inner">
            <div class="dm-6a-header text-center">
                <span class="tp-section-subtitle-gradient ct"><?php echo e($label); ?></span>
                <h2 class="dm-6a-title"><?php echo e($title); ?></h2>
                <p class="dm-6a-subtitle"><?php echo e($subtitle); ?></p>
            </div>
            <div class="dm-6a-track">
                <div class="dm-6a-row">
                    <div class="dm-6a-node" data-index="0">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">01</span></div>
                        <h5 class="dm-6a-node-title">Assess</h5>
                        <p class="dm-6a-node-desc">Evaluate your business's current state by analyzing finances, operations, marketing, and personnel to identify gaps and opportunities.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="1">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">02</span></div>
                        <h5 class="dm-6a-node-title">Analyze</h5>
                        <p class="dm-6a-node-desc">Perform a SWOT analysis to understand strengths, weaknesses, opportunities, and threats for informed decision-making.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="2">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">03</span></div>
                        <h5 class="dm-6a-node-title">Align</h5>
                        <p class="dm-6a-node-desc">Ensure business goals and strategies are cohesive, setting clear objectives and tracking progress for greater efficiency.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="3">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">04</span></div>
                        <h5 class="dm-6a-node-title">Action</h5>
                        <p class="dm-6a-node-desc">Implement your action plan with SMART goals, monitoring progress, and making adjustments to stay on track.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="4">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">05</span></div>
                        <h5 class="dm-6a-node-title">Accountability</h5>
                        <p class="dm-6a-node-desc">Take ownership of your actions, provide regular updates, and maintain transparency to build trust and drive improvement.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="5">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">06</span></div>
                        <h5 class="dm-6a-node-title">Adaptability</h5>
                        <p class="dm-6a-node-desc">Be flexible and open to change, adjusting strategies based on evolving market conditions and feedback to stay competitive.</p>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</section>

<?php if (! $__env->hasRenderedOnce('fa3aee28-8b47-453e-9b99-2503a60ee592')): $__env->markAsRenderedOnce('fa3aee28-8b47-453e-9b99-2503a60ee592'); ?>
<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    var sixANodes = document.querySelectorAll('.dm-6a-node');
    var sixAConnectors = document.querySelectorAll('.dm-6a-connector');

    if (sixANodes.length) {
        gsap.set(sixANodes, { y: 40, opacity: 0, scale: 0.85 });
        gsap.set(sixAConnectors, { scaleX: 0, transformOrigin: 'left center' });

        ScrollTrigger.create({
            trigger: '.dm-6a-section',
            start: 'top 75%',
            once: true,
            onEnter: function () {
                var tl = gsap.timeline();
                sixANodes.forEach(function (node, i) {
                    tl.to(node, { y: 0, opacity: 1, scale: 1, duration: 0.5, ease: 'back.out(1.4)' }, i * 0.2);
                    if (sixAConnectors[i]) {
                        tl.to(sixAConnectors[i], { scaleX: 1, duration: 0.3, ease: 'power2.inOut' }, i * 0.2 + 0.25);
                    }
                });
                tl.call(function () {
                    var activeIndex = 0;
                    function activateNext() {
                        sixANodes.forEach(function (n) { n.classList.remove('is-active'); });
                        if (sixANodes[activeIndex]) sixANodes[activeIndex].classList.add('is-active');
                        activeIndex = (activeIndex + 1) % sixANodes.length;
                    }
                    activateNext();
                    setInterval(activateNext, 3000);
                });
            }
        });
    }

    var sixAHeader = document.querySelector('.dm-6a-header');
    if (sixAHeader) {
        gsap.set(sixAHeader, { y: 30, opacity: 0 });
        ScrollTrigger.create({
            trigger: '.dm-6a-section',
            start: 'top 85%',
            once: true,
            onEnter: function () {
                gsap.to(sixAHeader, { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out' });
            }
        });
    }

    document.querySelectorAll('.dm-6a-node').forEach(function (node) {
        node.addEventListener('click', function () {
            var wasActive = this.classList.contains('is-active');
            document.querySelectorAll('.dm-6a-node').forEach(function (n) { n.classList.remove('is-active'); });
            if (!wasActive) this.classList.add('is-active');
        });
    });
})();
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH /home2/devmasjc/devmantra/resources/views/components/service-sections/page-strategy-6a.blade.php ENDPATH**/ ?>