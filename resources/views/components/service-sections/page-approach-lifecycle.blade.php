@props(['data' => []])
@php
    $label    = $data['label']    ?? 'How We Work';
    $title    = $data['title']    ?? 'Our Approach & Business Lifecycle';
    $subtitle = $data['subtitle'] ?? 'Building long-term relationships based on transparency, technical excellence, and measurable value creation.';

    $approachItems = [
        ['icon' => 'fa-solid fa-user-tie',        'text' => 'Partner-led supervision and review'],
        ['icon' => 'fa-solid fa-people-group',     'text' => 'Dedicated engagement teams'],
        ['icon' => 'fa-solid fa-file-contract',    'text' => 'Structured SLAs and turnaround commitments'],
        ['icon' => 'fa-solid fa-shield-halved',    'text' => 'Robust data security and confidentiality'],
        ['icon' => 'fa-solid fa-graduation-cap',   'text' => 'Continuous training aligned with global standards'],
        ['icon' => 'fa-solid fa-globe',            'text' => 'CPA-focused delivery model'],
        ['icon' => 'fa-solid fa-robot',            'text' => 'Automation-first approach'],
        ['icon' => 'fa-solid fa-scale-balanced',   'text' => 'Governance-embedded framework'],
        ['icon' => 'fa-solid fa-landmark',         'text' => 'Leadership with US accounting exposure'],
        ['icon' => 'fa-solid fa-magnifying-glass-chart', 'text' => 'Structured QA and review hierarchy'],
        ['icon' => 'fa-solid fa-server',           'text' => 'Secure infrastructure'],
    ];

    $stages = [
        [
            'label'   => 'Launch',
            'number'  => '01',
            'icon'    => 'fa-solid fa-rocket',
            'color'   => '#4a73c4',
            'items'   => ['Business Setup & Structuring', 'Initial Registrations', 'RBI Approvals & FEMA Compliance'],
        ],
        [
            'label'   => 'Seed Stage',
            'number'  => '02',
            'icon'    => 'fa-solid fa-seedling',
            'color'   => '#2e7d62',
            'items'   => ['Virtual CFO Services', 'Regulatory Framework Setup', 'Accounting & Compliance Process Setup', 'Asset Protection', 'Identifying Right People in the Actual Setup'],
        ],
        [
            'label'   => 'Growth',
            'number'  => '03',
            'icon'    => 'fa-solid fa-chart-line',
            'color'   => '#1b3c6b',
            'items'   => ['Funding & Due Diligence', 'Expansion Strategies', 'Process Documentation', 'Risk Mitigation', 'Investor & Transaction Management', 'Corporate Governance'],
        ],
        [
            'label'   => 'Maturity',
            'number'  => '04',
            'icon'    => 'fa-solid fa-building-columns',
            'color'   => '#7c3aed',
            'items'   => ['Business Expansion Planning', 'Continuity Planning', 'Regular Audits & Compliance', 'International Transactions & FEMA Compliance'],
        ],
        [
            'label'   => 'Decline',
            'number'  => '05',
            'icon'    => 'fa-solid fa-arrows-spin',
            'color'   => '#c0392b',
            'items'   => ['Possible Acquisition Strategies', 'Voluntary Winding Up', 'OCFC Verification', 'Liquidation Support Services', 'Closure Compliance Support'],
        ],
    ];
@endphp

@once
@push('styles')
<style>
/* ═══════════════════════════════════════════════════
   SECTION 1 — OUR APPROACH (Dark)
═══════════════════════════════════════════════════ */
.dm-ap {
    padding: 100px 0;
    background: #0d1b2a;
    position: relative;
    overflow: hidden;
    font-family: var(--tp-ff-onest);
}
.dm-ap::before {
    content: '';
    position: absolute; inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(74,115,196,0.12) 0%, transparent 55%),
        radial-gradient(circle at 80% 20%, rgba(27,60,107,0.18) 0%, transparent 50%);
    pointer-events: none;
}
/* dot-grid overlay */
.dm-ap::after {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(rgba(255,255,255,0.045) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
}

/* Left header */
.dm-ap-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #7db8f7;
    background: rgba(74,115,196,0.15);
    border: 1px solid rgba(74,115,196,0.3);
    padding: 6px 16px; border-radius: 20px;
    margin-bottom: 24px;
}
.dm-ap-eyebrow::before {
    content: '';
    width: 6px; height: 6px;
    background: #4a73c4;
    border-radius: 50%;
    box-shadow: 0 0 8px #4a73c4;
}
.dm-ap-title {
    font-size: 42px; font-weight: 800; color: #fff;
    line-height: 1.2; margin-bottom: 20px;
    font-family: var(--tp-ff-onest);
}
.dm-ap-title span {
    background: linear-gradient(135deg, #7db8f7, #4a73c4);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.dm-ap-subtitle {
    font-size: 16px; color: rgba(255,255,255,0.55);
    line-height: 1.8; margin-bottom: 36px;
}
.dm-ap-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(74,115,196,0.15); border: 1px solid rgba(74,115,196,0.25);
    border-radius: 10px; padding: 10px 18px;
    color: rgba(255,255,255,0.7); font-size: 13px;
}
.dm-ap-badge i { color: #4a73c4; }

/* Items grid */
.dm-ap-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}
.dm-ap-item {
    display: flex; align-items: center; gap: 14px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 14px 18px;
    transition: background 0.25s, border-color 0.25s, transform 0.25s;
    cursor: default;
}
.dm-ap-item:hover {
    background: rgba(74,115,196,0.12);
    border-color: rgba(74,115,196,0.35);
    transform: translateX(4px);
}
.dm-ap-item-icon {
    flex-shrink: 0;
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 13px;
}
.dm-ap-item-text {
    font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.82);
    line-height: 1.45;
}

@media (max-width: 991px) {
    .dm-ap-title { font-size: 32px; }
    .dm-ap-grid { grid-template-columns: 1fr; }
}
@media (max-width: 575px) {
    .dm-ap { padding: 70px 0; }
    .dm-ap-title { font-size: 26px; }
    .dm-ap-subtitle { font-size: 15px; }
}

/* ═══════════════════════════════════════════════════
   SECTION 2 — BUSINESS LIFECYCLE (Light)
═══════════════════════════════════════════════════ */
.dm-lc {
    padding: 100px 0 110px;
    background: #f4f6fb;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.dm-lc::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(27,60,107,0.06) 0%, transparent 70%);
    pointer-events: none;
}

/* Header */
.dm-lc-header { text-align: center; margin-bottom: 60px; }
.dm-lc-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #1b3c6b;
    background: rgba(27,60,107,0.08);
    border: 1px solid rgba(27,60,107,0.15);
    padding: 6px 16px; border-radius: 20px;
    margin-bottom: 20px;
}
.dm-lc-title {
    font-size: 40px; font-weight: 800; color: #0d1b2a;
    line-height: 1.2; margin-bottom: 14px;
    font-family: var(--tp-ff-onest);
}
.dm-lc-subtitle { font-size: 16px; color: #666; max-width: 580px; margin: 0 auto; line-height: 1.7; }

/* Stage nav */
.dm-lc-nav-wrap {
    position: relative;
    margin-bottom: 48px;
}
.dm-lc-track {
    display: flex; align-items: stretch;
    gap: 0;
    background: #fff;
    border-radius: 16px;
    padding: 8px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    overflow-x: auto;
    scrollbar-width: none;
}
.dm-lc-track::-webkit-scrollbar { display: none; }

.dm-lc-stab {
    flex: 1; min-width: 140px;
    display: flex; flex-direction: column; align-items: center;
    gap: 6px;
    padding: 16px 12px;
    border: none; background: transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
    position: relative;
}
.dm-lc-stab + .dm-lc-stab::before {
    content: '';
    position: absolute; left: 0; top: 50%;
    transform: translateY(-50%);
    width: 1px; height: 60%;
    background: rgba(0,0,0,0.08);
}
.dm-lc-stab.is-active { background: linear-gradient(135deg, #1b3c6b, #4a73c4); }
.dm-lc-stab.is-active + .dm-lc-stab::before { display: none; }

.dm-lc-stab-num {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    color: #999; transition: color 0.3s;
}
.dm-lc-stab.is-active .dm-lc-stab-num { color: rgba(255,255,255,0.6); }

.dm-lc-stab-icon {
    font-size: 18px; color: #1b3c6b; transition: color 0.3s;
}
.dm-lc-stab.is-active .dm-lc-stab-icon { color: #fff; }

.dm-lc-stab-label {
    font-size: 13px; font-weight: 600; color: #444;
    transition: color 0.3s; text-align: center;
    white-space: nowrap;
}
.dm-lc-stab.is-active .dm-lc-stab-label { color: #fff; }

/* Progress bar */
.dm-lc-progress {
    height: 3px;
    background: rgba(27,60,107,0.1);
    border-radius: 2px;
    margin-top: 12px;
    overflow: hidden;
}
.dm-lc-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    border-radius: 2px;
    transition: width 0.4s ease;
    width: 20%;
}

/* Content panels */
.dm-lc-panels { position: relative; }
.dm-lc-panel {
    display: none;
    animation: lcFadeIn 0.35s ease;
}
.dm-lc-panel.is-active { display: block; }

@keyframes lcFadeIn {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

.dm-lc-card {
    background: #fff;
    border-radius: 20px;
    padding: 48px 52px;
    box-shadow: 0 8px 48px rgba(0,0,0,0.08);
    border-top: 4px solid transparent;
    position: relative;
    overflow: hidden;
}
.dm-lc-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 4px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
}
.dm-lc-card-inner {
    display: flex; gap: 48px; align-items: flex-start;
}
.dm-lc-card-left { flex-shrink: 0; }
.dm-lc-card-icon-wrap {
    width: 72px; height: 72px;
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: #fff;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    box-shadow: 0 8px 24px rgba(27,60,107,0.25);
    margin-bottom: 16px;
}
.dm-lc-card-num {
    font-size: 13px; font-weight: 700; letter-spacing: 2px;
    color: #999; text-align: center;
}
.dm-lc-card-right { flex: 1; }
.dm-lc-card-stage {
    font-size: 13px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #4a73c4;
    margin-bottom: 10px;
}
.dm-lc-card-title {
    font-size: 30px; font-weight: 800; color: #0d1b2a;
    line-height: 1.2; margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
}
.dm-lc-badges {
    display: flex; flex-wrap: wrap; gap: 10px;
}
.dm-lc-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(27,60,107,0.06);
    border: 1px solid rgba(27,60,107,0.14);
    color: #1b3c6b;
    font-size: 14px; font-weight: 500;
    padding: 9px 18px; border-radius: 40px;
    transition: background 0.2s, border-color 0.2s, transform 0.2s;
}
.dm-lc-badge:hover {
    background: rgba(27,60,107,0.12);
    border-color: rgba(27,60,107,0.3);
    transform: translateY(-2px);
}
.dm-lc-badge::before {
    content: '';
    width: 6px; height: 6px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 50%;
    flex-shrink: 0;
}

@media (max-width: 991px) {
    .dm-lc-title { font-size: 32px; }
    .dm-lc-stab { min-width: 110px; padding: 12px 8px; }
    .dm-lc-stab-label { font-size: 12px; }
    .dm-lc-card { padding: 36px 32px; }
    .dm-lc-card-inner { gap: 28px; }
    .dm-lc-card-title { font-size: 24px; }
}
@media (max-width: 767px) {
    .dm-lc { padding: 70px 0 80px; }
    .dm-lc-title { font-size: 26px; }
    .dm-lc-header { margin-bottom: 40px; }
    .dm-lc-stab { min-width: 90px; }
    .dm-lc-stab-label { font-size: 11px; }
    .dm-lc-card { padding: 28px 24px; }
    .dm-lc-card-inner { flex-direction: column; gap: 20px; }
    .dm-lc-card-icon-wrap { width: 56px; height: 56px; font-size: 22px; margin-bottom: 0; border-radius: 14px; }
    .dm-lc-card-left { display: flex; align-items: center; gap: 16px; }
    .dm-lc-card-num { margin-bottom: 0; }
    .dm-lc-card-title { font-size: 22px; margin-bottom: 20px; }
    .dm-lc-badge { font-size: 13px; padding: 8px 14px; }
}
@media (max-width: 480px) {
    .dm-lc-stab { min-width: 80px; padding: 10px 6px; }
    .dm-lc-stab-icon { font-size: 15px; }
    .dm-lc-stab-label { font-size: 10px; }
}
</style>
@endpush
@endonce

{{-- ══════════════════════════════════════════════════════════
     SECTION 1 — OUR APPROACH (Dark)
══════════════════════════════════════════════════════════ --}}
<section class="dm-ap">
    <div class="container container-1230" style="position:relative;z-index:1;">
        <div class="row align-items-center g-5">

            {{-- Left: Header --}}
            <div class="col-lg-5 dm-ap-header-col">
                <div class="dm-ap-eyebrow">{{ $label }}</div>
                <h2 class="dm-ap-title">Our <span>Approach</span></h2>
                <p class="dm-ap-subtitle">{{ $subtitle }}</p>
                <div class="dm-ap-badge">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ count($approachItems) }} core delivery principles
                </div>
            </div>

            {{-- Right: Items grid --}}
            <div class="col-lg-7 dm-ap-items-col">
                <div class="dm-ap-grid">
                    @foreach($approachItems as $item)
                    <div class="dm-ap-item">
                        <div class="dm-ap-item-icon">
                            <i class="{{ $item['icon'] }}"></i>
                        </div>
                        <span class="dm-ap-item-text">{{ $item['text'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════
     SECTION 2 — BUSINESS LIFECYCLE (Light)
══════════════════════════════════════════════════════════ --}}
<section class="dm-lc">
    <div class="container container-1230" style="position:relative;z-index:1;">

        {{-- Header --}}
        <div class="dm-lc-header">
            <div class="dm-lc-eyebrow">Growth Journey</div>
            <h2 class="dm-lc-title">Business Lifecycle</h2>
            <p class="dm-lc-subtitle">Dev Mantra supports your business at every stage — from first registration to final exit.</p>
        </div>

        {{-- Stage nav strip --}}
        <div class="dm-lc-nav-wrap">
            <div class="dm-lc-track" id="lcTrack">
                @foreach($stages as $i => $stage)
                <button class="dm-lc-stab {{ $i === 0 ? 'is-active' : '' }}" data-lc-tab="{{ $i }}">
                    <span class="dm-lc-stab-num">{{ $stage['number'] }}</span>
                    <i class="dm-lc-stab-icon {{ $stage['icon'] }}"></i>
                    <span class="dm-lc-stab-label">{{ $stage['label'] }}</span>
                </button>
                @endforeach
            </div>
            <div class="dm-lc-progress">
                <div class="dm-lc-progress-bar" id="lcProgressBar"></div>
            </div>
        </div>

        {{-- Content panels --}}
        <div class="dm-lc-panels" id="lcPanels">
            @foreach($stages as $i => $stage)
            <div class="dm-lc-panel {{ $i === 0 ? 'is-active' : '' }}" data-lc-panel="{{ $i }}">
                <div class="dm-lc-card">
                    <div class="dm-lc-card-inner">
                        <div class="dm-lc-card-left">
                            <div class="dm-lc-card-icon-wrap" style="background: linear-gradient(135deg, {{ $stage['color'] }}, {{ $stage['color'] }}bb);">
                                <i class="{{ $stage['icon'] }}"></i>
                            </div>
                            <div class="dm-lc-card-num">{{ $stage['number'] }} / 05</div>
                        </div>
                        <div class="dm-lc-card-right">
                            <div class="dm-lc-card-stage">Stage {{ $stage['number'] }}</div>
                            <h3 class="dm-lc-card-title">{{ $stage['label'] }}</h3>
                            <div class="dm-lc-badges">
                                @foreach($stage['items'] as $item)
                                <span class="dm-lc-badge">{{ $item }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@once
@push('scripts')
<script>
(function () {

    /* ── Section 1: Approach items GSAP ── */
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        var apItems = document.querySelectorAll('.dm-ap-item');
        var apHeader = document.querySelector('.dm-ap-header-col');

        if (apHeader) {
            gsap.set(apHeader, { x: -30, opacity: 0 });
            ScrollTrigger.create({
                trigger: '.dm-ap', start: 'top 80%', once: true,
                onEnter: function () {
                    gsap.to(apHeader, { x: 0, opacity: 1, duration: 0.7, ease: 'power3.out' });
                }
            });
        }
        if (apItems.length) {
            gsap.set(apItems, { y: 20, opacity: 0 });
            ScrollTrigger.create({
                trigger: '.dm-ap-items-col', start: 'top 82%', once: true,
                onEnter: function () {
                    gsap.to(apItems, { y: 0, opacity: 1, duration: 0.4, stagger: 0.04, ease: 'power2.out' });
                }
            });
        }
    }

    /* ── Section 2: Lifecycle tabs ── */
    var tabs    = document.querySelectorAll('.dm-lc-stab');
    var panels  = document.querySelectorAll('.dm-lc-panel');
    var progBar = document.getElementById('lcProgressBar');
    if (!tabs.length || !panels.length) return;

    var total   = tabs.length;
    var current = 0;
    var timer   = null;

    function setProgress(index) {
        if (progBar) progBar.style.width = ((index + 1) / total * 100) + '%';
    }

    function goTo(index) {
        if (index === current) return;
        tabs[current].classList.remove('is-active');
        panels[current].classList.remove('is-active');
        current = index;
        tabs[current].classList.add('is-active');
        panels[current].classList.add('is-active');
        setProgress(current);

        /* scroll the active tab into view on mobile */
        var activeTab = tabs[current];
        var track = document.getElementById('lcTrack');
        if (track && activeTab) {
            var tabLeft   = activeTab.offsetLeft;
            var tabWidth  = activeTab.offsetWidth;
            var trackW    = track.offsetWidth;
            track.scrollTo({ left: tabLeft - (trackW / 2) + (tabWidth / 2), behavior: 'smooth' });
        }
    }

    function startAuto() {
        stopAuto();
        timer = setInterval(function () { goTo((current + 1) % total); }, 4500);
    }
    function stopAuto() { if (timer) { clearInterval(timer); timer = null; } }

    tabs.forEach(function (tab, i) {
        tab.addEventListener('click', function () { goTo(i); startAuto(); });
    });

    var lcSection = document.querySelector('.dm-lc');
    if (lcSection) {
        lcSection.addEventListener('mouseenter', stopAuto);
        lcSection.addEventListener('mouseleave', startAuto);
    }

    /* GSAP entrance for lifecycle section */
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.set('.dm-lc-header', { y: 24, opacity: 0 });
        gsap.set('.dm-lc-nav-wrap', { y: 20, opacity: 0 });
        gsap.set('.dm-lc-panels', { y: 20, opacity: 0 });
        ScrollTrigger.create({
            trigger: '.dm-lc', start: 'top 80%', once: true,
            onEnter: function () {
                gsap.to('.dm-lc-header', { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out' });
                gsap.to('.dm-lc-nav-wrap', { y: 0, opacity: 1, duration: 0.5, delay: 0.15, ease: 'power2.out' });
                gsap.to('.dm-lc-panels', { y: 0, opacity: 1, duration: 0.5, delay: 0.3, ease: 'power2.out' });
            }
        });
    }

    setProgress(0);
    startAuto();

})();
</script>
@endpush
@endonce
