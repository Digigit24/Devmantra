@props(['data' => []])
@php
    $label    = $data['label']    ?? 'How We Work';
    $title    = $data['title']    ?? 'Our Approach & Business Lifecycle';
    $subtitle = $data['subtitle'] ?? 'Building long-term relationships based on transparency, technical excellence, and measurable value creation.';
@endphp

<section class="dm-apl-section">
    <div class="dm-apl-pin">
        <div class="container">
            <div class="dm-apl-header text-center">
                <span class="dm-apl-label">{{ $label }}</span>
                <h2 class="dm-apl-title">{{ $title }}</h2>
                <p class="dm-apl-subtitle">{{ $subtitle }}</p>
            </div>

            <div class="dm-apl-grid">
                <!-- Left: Our Approach -->
                <div class="dm-apl-left">
                    <h3 class="dm-apl-col-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                        Our Approach
                    </h3>
                    <div class="dm-apl-checklist">
                        @php
                        $checkIcon = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
                        $approachItems = [
                            'Partner-led supervision and review',
                            'Dedicated engagement teams',
                            'Structured SLAs and turnaround commitments',
                            'Robust data security and confidentiality',
                            'Continuous training aligned with global standards',
                            'CPA-focused delivery model',
                            'Automation-first approach',
                            'Governance-embedded framework',
                            'Leadership with US accounting exposure',
                            'Structured QA and review hierarchy',
                            'Secure infrastructure',
                        ];
                        @endphp
                        @foreach($approachItems as $item)
                        <div class="dm-apl-item">
                            <span class="dm-apl-check">{!! $checkIcon !!}</span>
                            <span class="dm-apl-text">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right: Business Lifecycle (vertical tabs) -->
                <div class="dm-apl-right">
                    <h3 class="dm-apl-col-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Business Lifecycle
                    </h3>

                    <div class="dm-lc-vtabs">
                        <div class="dm-lc-vtabs-nav">
                            <button class="dm-lc-vtab is-active" data-tab="0"><span class="dm-lc-vtab-indicator"></span><span class="dm-lc-vtab-label">Launch</span></button>
                            <button class="dm-lc-vtab" data-tab="1"><span class="dm-lc-vtab-indicator"></span><span class="dm-lc-vtab-label">Seed Stage</span></button>
                            <button class="dm-lc-vtab" data-tab="2"><span class="dm-lc-vtab-indicator"></span><span class="dm-lc-vtab-label">Growth</span></button>
                            <button class="dm-lc-vtab" data-tab="3"><span class="dm-lc-vtab-indicator"></span><span class="dm-lc-vtab-label">Maturity</span></button>
                            <button class="dm-lc-vtab" data-tab="4"><span class="dm-lc-vtab-indicator"></span><span class="dm-lc-vtab-label">Decline</span></button>
                        </div>
                        <div class="dm-lc-vtabs-content">
                            <div class="dm-lc-vpanel is-active" data-panel="0">
                                <h4 class="dm-lc-vpanel-title">Launch</h4>
                                <ul class="dm-lc-vpanel-list">
                                    <li>Business Setup &amp; Structuring</li>
                                    <li>Initial Registrations</li>
                                    <li>RBI Approvals &amp; FEMA Compliance</li>
                                </ul>
                            </div>
                            <div class="dm-lc-vpanel" data-panel="1">
                                <h4 class="dm-lc-vpanel-title">Seed Stage</h4>
                                <ul class="dm-lc-vpanel-list">
                                    <li>Virtual CFO Services</li>
                                    <li>Regulatory Framework Setup</li>
                                    <li>Accounting &amp; Compliance Process Setup</li>
                                    <li>Asset Protection</li>
                                    <li>Identifying Right People in the Actual Setup</li>
                                </ul>
                            </div>
                            <div class="dm-lc-vpanel" data-panel="2">
                                <h4 class="dm-lc-vpanel-title">Growth</h4>
                                <ul class="dm-lc-vpanel-list">
                                    <li>Funding &amp; Due Diligence</li>
                                    <li>Expansion Strategies</li>
                                    <li>Process Documentation</li>
                                    <li>Risk Mitigation</li>
                                    <li>Investor &amp; Transaction Management</li>
                                    <li>Corporate Governance</li>
                                </ul>
                            </div>
                            <div class="dm-lc-vpanel" data-panel="3">
                                <h4 class="dm-lc-vpanel-title">Maturity</h4>
                                <ul class="dm-lc-vpanel-list">
                                    <li>Business Expansion Planning</li>
                                    <li>Continuity Planning</li>
                                    <li>Regular Audits &amp; Compliance</li>
                                    <li>International Transactions &amp; FEMA Compliance</li>
                                </ul>
                            </div>
                            <div class="dm-lc-vpanel" data-panel="4">
                                <h4 class="dm-lc-vpanel-title">Decline</h4>
                                <ul class="dm-lc-vpanel-list">
                                    <li>Possible Acquisition Strategies</li>
                                    <li>Voluntary Winding Up</li>
                                    <li>OCFC Verification</li>
                                    <li>Liquidation Support Services</li>
                                    <li>Closure Compliance Support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
@push('scripts')
<script>
(function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    var aplSection = document.querySelector('.dm-apl-section');
    if (!aplSection) return;

    var aplHeader = aplSection.querySelector('.dm-apl-header');
    if (aplHeader) {
        gsap.set(aplHeader, { y: 30, opacity: 0 });
        ScrollTrigger.create({ trigger: aplSection, start: 'top 85%', once: true, onEnter: function () { gsap.to(aplHeader, { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out' }); } });
    }

    var aplItems = aplSection.querySelectorAll('.dm-apl-item');
    if (aplItems.length) {
        gsap.set(aplItems, { x: -15, opacity: 0 });
        ScrollTrigger.create({ trigger: '.dm-apl-left', start: 'top 80%', once: true, onEnter: function () { gsap.to(aplItems, { x: 0, opacity: 1, duration: 0.4, stagger: 0.05, ease: 'power2.out' }); } });
    }

    aplItems.forEach(function (item) {
        var check = item.querySelector('.dm-apl-check');
        item.addEventListener('mouseenter', function () {
            gsap.to(item, { x: 4, duration: 0.25, ease: 'power2.out' });
            if (check) gsap.to(check, { scale: 1.15, rotation: 10, duration: 0.3, ease: 'back.out(2)' });
        });
        item.addEventListener('mouseleave', function () {
            gsap.to(item, { x: 0, duration: 0.25, ease: 'power2.out' });
            if (check) gsap.to(check, { scale: 1, rotation: 0, duration: 0.25, ease: 'power2.out' });
        });
    });

    var lcTabs = aplSection.querySelectorAll('.dm-lc-vtab');
    var lcPanels = aplSection.querySelectorAll('.dm-lc-vpanel');
    if (!lcTabs.length || !lcPanels.length) return;

    var activeTab = 0;

    function switchTab(index) {
        if (index === activeTab) return;
        var prevIndex = activeTab;
        activeTab = index;
        var direction = index > prevIndex ? 1 : -1;

        lcTabs.forEach(function (tab, i) { tab.classList.toggle('is-active', i === index); });

        lcPanels.forEach(function (panel) {
            gsap.killTweensOf(panel);
            var items = panel.querySelectorAll('li');
            if (items.length) gsap.killTweensOf(items);
        });

        lcPanels.forEach(function (panel, i) {
            if (i !== index) { panel.classList.remove('is-active'); gsap.set(panel, { opacity: 0, y: 0 }); }
        });

        var inPanel = lcPanels[index];
        inPanel.classList.add('is-active');
        gsap.fromTo(inPanel, { opacity: 0, y: 14 * direction }, { opacity: 1, y: 0, duration: 0.35, ease: 'power2.out' });

        var newItems = inPanel.querySelectorAll('li');
        if (newItems.length) {
            gsap.fromTo(newItems, { x: 8, opacity: 0 }, { x: 0, opacity: 1, duration: 0.3, stagger: 0.04, delay: 0.1, ease: 'power2.out' });
        }
    }

    var autoTimer = null;

    function startAutoRotate() {
        stopAutoRotate();
        autoTimer = setInterval(function () { switchTab((activeTab + 1) % lcTabs.length); }, 5000);
    }

    function stopAutoRotate() {
        if (autoTimer) { clearInterval(autoTimer); autoTimer = null; }
    }

    lcTabs.forEach(function (tab, i) {
        tab.addEventListener('click', function () { switchTab(i); startAutoRotate(); });
    });

    var vtabsContainer = aplSection.querySelector('.dm-lc-vtabs');
    if (vtabsContainer) {
        vtabsContainer.addEventListener('mouseenter', stopAutoRotate);
        vtabsContainer.addEventListener('mouseleave', startAutoRotate);
        gsap.set(vtabsContainer, { y: 20, opacity: 0 });
        ScrollTrigger.create({ trigger: '.dm-apl-right', start: 'top 80%', once: true, onEnter: function () { gsap.to(vtabsContainer, { y: 0, opacity: 1, duration: 0.5, ease: 'power2.out' }); } });
    }

    startAutoRotate();
})();
</script>
@endpush
@endonce
