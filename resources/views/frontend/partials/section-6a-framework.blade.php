<!-- SECTION — 6A Strategies -->
<section class="dm-6a-section">
    <div class="container container-1230">
        <div class="dm-6a-inner">
            <div class="dm-6a-header text-center">
                <span class="tp-section-subtitle-gradient ct">Our Framework</span>
                <h2 class="dm-6a-title">The 6A Strategy Framework</h2>
                <p class="dm-6a-subtitle">A proven, structured approach that guides businesses from
                    assessment to transformation — at every stage of growth.</p>
            </div>
            <div class="dm-6a-track">
                <div class="dm-6a-row">
                    <div class="dm-6a-node" data-index="0">
                        <div class="dm-6a-circle">
                            <span class="dm-6a-step-num">01</span>
                        </div>
                        <h5 class="dm-6a-node-title">Assess</h5>
                        <p class="dm-6a-node-desc">Evaluate your business's current state by analyzing
                            finances, operations, marketing, and personnel to identify gaps and
                            opportunities.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="1">
                        <div class="dm-6a-circle">
                            <span class="dm-6a-step-num">02</span>
                        </div>
                        <h5 class="dm-6a-node-title">Analyze</h5>
                        <p class="dm-6a-node-desc">Perform a SWOT analysis to understand strengths,
                            weaknesses, opportunities, and threats for informed decision-making.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="2">
                        <div class="dm-6a-circle">
                            <span class="dm-6a-step-num">03</span>
                        </div>
                        <h5 class="dm-6a-node-title">Align</h5>
                        <p class="dm-6a-node-desc">Ensure business goals and strategies are cohesive,
                            setting clear objectives and tracking progress for greater efficiency.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="3">
                        <div class="dm-6a-circle">
                            <span class="dm-6a-step-num">04</span>
                        </div>
                        <h5 class="dm-6a-node-title">Action</h5>
                        <p class="dm-6a-node-desc">Implement your action plan with SMART goals,
                            monitoring progress, and making adjustments to stay on track.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="4">
                        <div class="dm-6a-circle">
                            <span class="dm-6a-step-num">05</span>
                        </div>
                        <h5 class="dm-6a-node-title">Accountability</h5>
                        <p class="dm-6a-node-desc">Take ownership of your actions, provide regular
                            updates, and maintain transparency to build trust and drive improvement.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="5">
                        <div class="dm-6a-circle">
                            <span class="dm-6a-step-num">06</span>
                        </div>
                        <h5 class="dm-6a-node-title">Adaptability</h5>
                        <p class="dm-6a-node-desc">Be flexible and open to change, adjusting strategies
                            based on evolving market conditions and feedback to stay competitive.</p>
                    </div>
                </div>
            </div>
            <div class="dm-6a-cta">
                <a href="#" class="tp-btn-white-border">View Complete Structure</a>
            </div>
        </div>
    </div>
</section>
<!-- 6A section end -->

@pushonce('scripts')
<script>
(function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    // -- 6A hexagons sequential reveal --
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
                    tl.to(node, {
                        y: 0,
                        opacity: 1,
                        scale: 1,
                        duration: 0.5,
                        ease: 'back.out(1.4)'
                    }, i * 0.2);

                    if (sixAConnectors[i]) {
                        tl.to(sixAConnectors[i], {
                            scaleX: 1,
                            duration: 0.3,
                            ease: 'power2.inOut'
                        }, i * 0.2 + 0.25);
                    }
                });

                // After all nodes revealed, auto-activate them sequentially
                tl.call(function () {
                    var activeIndex = 0;
                    function activateNext() {
                        sixANodes.forEach(function (n) { n.classList.remove('is-active'); });
                        if (sixANodes[activeIndex]) {
                            sixANodes[activeIndex].classList.add('is-active');
                        }
                        activeIndex = (activeIndex + 1) % sixANodes.length;
                    }
                    activateNext();
                    setInterval(activateNext, 3000);
                });
            }
        });
    }

    // 6A header elements
    var sixAHeader = document.querySelector('.dm-6a-header');
    if (sixAHeader) {
        gsap.set(sixAHeader, { y: 30, opacity: 0 });
        ScrollTrigger.create({
            trigger: '.dm-6a-section',
            start: 'top 85%',
            once: true,
            onEnter: function () {
                gsap.to(sixAHeader, {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    ease: 'power2.out'
                });
            }
        });
    }

    // Click to toggle active node
    document.querySelectorAll('.dm-6a-node').forEach(function (node) {
        node.addEventListener('click', function () {
            var wasActive = this.classList.contains('is-active');
            document.querySelectorAll('.dm-6a-node').forEach(function (n) {
                n.classList.remove('is-active');
            });
            if (!wasActive) {
                this.classList.add('is-active');
            }
        });
    });
})();
</script>
@endpushonce