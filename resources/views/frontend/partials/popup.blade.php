@php
    /* ── Read all popup settings from SiteSetting store ── */
    $popupEnabled      = \App\Models\SiteSetting::get('popup_enabled', '0') === '1';
    $showExitIntent    = \App\Models\SiteSetting::get('popup_show_exit_intent', '1') === '1';
    $showScroll        = \App\Models\SiteSetting::get('popup_show_scroll', '1') === '1';
    $scrollDepth       = (int) \App\Models\SiteSetting::get('popup_trigger_scroll', '55');
    $headline          = \App\Models\SiteSetting::get('popup_headline', '');
    $subtext           = \App\Models\SiteSetting::get('popup_subtext', '');
    $pointsRaw         = \App\Models\SiteSetting::get('popup_points', '');
    $points            = array_values(array_filter(array_map('trim', explode("\n", $pointsRaw))));
    $primaryCtaText    = \App\Models\SiteSetting::get('popup_primary_cta_text', '');
    $primaryCtaUrl     = \App\Models\SiteSetting::get('popup_primary_cta_url', '/contact');
    $secondaryCtaText  = \App\Models\SiteSetting::get('popup_secondary_cta_text', '');
    $secondaryCtaUrl   = \App\Models\SiteSetting::get('popup_secondary_cta_url', '/services');
    $supportingText    = \App\Models\SiteSetting::get('popup_supporting_text', '');
@endphp

@if($popupEnabled && ($headline || $primaryCtaText))
@push('styles')
<style>
/* ═══════════════════════════════════════════════
   DM POPUP BANNER — Brand-grade exit/scroll popup
   ═══════════════════════════════════════════════ */

/* Backdrop */
.dm-popup-overlay {
    position: fixed;
    inset: 0;
    background: rgba(4, 8, 16, 0.75);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: opacity .45s ease, visibility .45s ease;
}
.dm-popup-overlay.dm-popup-open {
    opacity: 1;
    visibility: visible;
}

/* Card */
.dm-popup-card {
    position: relative;
    width: 100%;
    max-width: 560px;
    max-height: 92vh;
    overflow-y: auto;
    background: #001d30;
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.07);
    box-shadow:
        0 0 0 1px rgba(74,115,196,0.12),
        0 32px 80px rgba(0,0,0,0.65),
        0 0 60px rgba(27,60,107,0.18);
    transform: translateY(28px) scale(0.96);
    transition: transform .45s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.dm-popup-card::-webkit-scrollbar { width: 0; background: transparent; }
.dm-popup-overlay.dm-popup-open .dm-popup-card {
    transform: translateY(0) scale(1);
}

/* Top gradient accent bar */
.dm-popup-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b 0%, #4a73c4 50%, #7da3e0 100%);
    border-radius: 24px 24px 0 0;
}

/* Decorative background glows */
.dm-popup-glow-1 {
    position: absolute;
    top: -60px; right: -60px;
    width: 280px; height: 280px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(74,115,196,0.14) 0%, transparent 65%);
    pointer-events: none;
}
.dm-popup-glow-2 {
    position: absolute;
    bottom: -40px; left: -40px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(27,60,107,0.18) 0%, transparent 65%);
    pointer-events: none;
}

/* Inner padding */
.dm-popup-inner {
    padding: 44px 44px 40px;
    position: relative;
    z-index: 1;
}
@media (max-width: 575px) {
    .dm-popup-inner { padding: 36px 24px 32px; }
}

/* Close button */
.dm-popup-close {
    position: absolute;
    top: 18px; right: 18px;
    width: 34px; height: 34px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: rgba(255,255,255,0.6);
    font-size: 14px;
    line-height: 1;
    transition: background .2s ease, color .2s ease, transform .2s ease;
    z-index: 10;
}
.dm-popup-close:hover {
    background: rgba(255,255,255,0.14);
    color: #fff;
    transform: scale(1.08) rotate(90deg);
}

/* Eyebrow */
.dm-popup-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #7eb8ff;
    background: rgba(74,115,196,0.12);
    border: 1px solid rgba(74,115,196,0.22);
    padding: 6px 16px;
    border-radius: 30px;
    margin-bottom: 22px;
}
.dm-popup-eyebrow-dot {
    width: 6px; height: 6px; border-radius: 50%;
    background: #4a73c4;
    animation: dm-pulse 2s infinite;
}
@keyframes dm-pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.5; transform: scale(0.8); }
}

/* Headline */
.dm-popup-headline {
    font-size: 26px;
    font-weight: 800;
    color: #fff;
    line-height: 1.22;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest, 'Onest', sans-serif);
    letter-spacing: -0.3px;
}
@media (max-width: 575px) { .dm-popup-headline { font-size: 22px; } }

/* Gradient on the key phrase in headline */
.dm-popup-headline-accent {
    background: linear-gradient(135deg, #7da3e0, #4a73c4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Subtext */
.dm-popup-subtext {
    font-size: 15px;
    color: rgba(255,255,255,0.55);
    line-height: 1.7;
    margin-bottom: 24px;
}

/* Divider */
.dm-popup-divider {
    height: 1px;
    background: rgba(255,255,255,0.07);
    margin: 0 0 24px;
}

/* Numbered points */
.dm-popup-points { display: flex; flex-direction: column; gap: 12px; margin-bottom: 28px; }
.dm-popup-point {
    display: flex;
    align-items: flex-start;
    gap: 14px;
}
.dm-popup-point-num {
    flex-shrink: 0;
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
    font-size: 11px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    font-family: var(--tp-ff-onest, 'Onest', sans-serif);
    box-shadow: 0 4px 12px rgba(27,60,107,0.35);
    margin-top: 2px;
}
.dm-popup-point-text {
    font-size: 15px;
    color: rgba(255,255,255,0.82);
    line-height: 1.55;
    font-weight: 500;
}

/* Buttons */
.dm-popup-actions { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }

.dm-popup-btn-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 15px 28px;
    border-radius: 50px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff !important;
    font-size: 15px; font-weight: 700;
    text-decoration: none !important;
    font-family: var(--tp-ff-onest, 'Onest', sans-serif);
    transition: transform .3s cubic-bezier(.165,.84,.44,1),
                box-shadow .3s ease,
                opacity .3s ease;
    box-shadow: 0 8px 28px rgba(27,60,107,0.4);
    border: none; cursor: pointer;
    white-space: nowrap;
}
.dm-popup-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 40px rgba(27,60,107,0.55);
    opacity: 0.93;
    color: #fff !important;
}
.dm-popup-btn-primary svg { flex-shrink: 0; }

.dm-popup-btn-secondary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 28px;
    border-radius: 50px;
    background: transparent;
    color: rgba(255,255,255,0.72) !important;
    font-size: 14px; font-weight: 600;
    text-decoration: none !important;
    font-family: var(--tp-ff-onest, 'Onest', sans-serif);
    border: 1px solid rgba(255,255,255,0.18);
    transition: background .25s ease, border-color .25s ease, color .25s ease;
    cursor: pointer;
}
.dm-popup-btn-secondary:hover {
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,255,255,0.32);
    color: #fff !important;
}

/* Supporting text */
.dm-popup-support {
    font-size: 12px;
    color: rgba(255,255,255,0.28);
    text-align: center;
    line-height: 1.6;
    padding-top: 4px;
    display: flex; align-items: center; justify-content: center; gap: 6px;
}
.dm-popup-support::before {
    content: '';
    display: inline-block;
    width: 16px; height: 1px;
    background: rgba(255,255,255,0.15);
}
.dm-popup-support::after {
    content: '';
    display: inline-block;
    width: 16px; height: 1px;
    background: rgba(255,255,255,0.15);
}
</style>
@endpush

{{-- ══ POPUP MARKUP ══ --}}
<div class="dm-popup-overlay" id="dmPopupOverlay" role="dialog" aria-modal="true" aria-label="Advisory popup">
    <div class="dm-popup-card">

        {{-- Decorative glows --}}
        <div class="dm-popup-glow-1"></div>
        <div class="dm-popup-glow-2"></div>

        {{-- Close button --}}
        <button class="dm-popup-close" id="dmPopupClose" aria-label="Close">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                <path d="M1 1L11 11M11 1L1 11" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="dm-popup-inner">

            {{-- Eyebrow --}}
            <div class="dm-popup-eyebrow">
                <span class="dm-popup-eyebrow-dot"></span>
                India Expansion Advisory
            </div>

            {{-- Headline --}}
            @if($headline)
            <h2 class="dm-popup-headline">{{ $headline }}</h2>
            @endif

            {{-- Subtext --}}
            @if($subtext)
            <p class="dm-popup-subtext">{{ $subtext }}</p>
            @endif

            {{-- Numbered Points --}}
            @if(!empty($points))
            <div class="dm-popup-divider"></div>
            <div class="dm-popup-points">
                @foreach($points as $i => $point)
                <div class="dm-popup-point">
                    <span class="dm-popup-point-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="dm-popup-point-text">{{ $point }}</span>
                </div>
                @endforeach
            </div>
            @endif

            {{-- CTA Buttons --}}
            <div class="dm-popup-actions">
                @if($primaryCtaText)
                <a href="{{ $primaryCtaUrl }}" class="dm-popup-btn-primary" id="dmPopupPrimary">
                    {{ $primaryCtaText }}
                    <svg width="14" height="11" viewBox="0 0 14 11" fill="none">
                        <path d="M1 5.5H13M8.5 1L13 5.5L8.5 10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                @endif
                @if($secondaryCtaText)
                <a href="{{ $secondaryCtaUrl }}" class="dm-popup-btn-secondary" id="dmPopupSecondary">
                    {{ $secondaryCtaText }}
                </a>
                @endif
            </div>

            {{-- Supporting text --}}
            @if($supportingText)
            <p class="dm-popup-support">{{ $supportingText }}</p>
            @endif

        </div>{{-- /.dm-popup-inner --}}
    </div>{{-- /.dm-popup-card --}}
</div>{{-- /.dm-popup-overlay --}}

@push('scripts')
<script>
(function () {
    'use strict';

    var STORAGE_KEY   = 'dm_popup_seen';
    var SESSION_KEY   = 'dm_popup_dismissed';
    var COOLDOWN_DAYS = 3;   // don't re-show for 3 days after dismissal
    var DELAY_MS      = 800; // brief delay before triggering

    var exitIntentEnabled = {{ $showExitIntent ? 'true' : 'false' }};
    var scrollEnabled     = {{ $showScroll ? 'true' : 'false' }};
    var scrollDepth       = {{ $scrollDepth }};

    var overlay  = document.getElementById('dmPopupOverlay');
    var closeBtn = document.getElementById('dmPopupClose');
    if (!overlay) return;

    /* ── Cooldown check ── */
    function isCooledDown() {
        // Session dismissal: don't show again in same tab session
        if (sessionStorage.getItem(SESSION_KEY)) return true;
        // Persistent cooldown: store last-shown timestamp in localStorage
        var ts = localStorage.getItem(STORAGE_KEY);
        if (!ts) return false;
        var elapsed = Date.now() - parseInt(ts, 10);
        return elapsed < COOLDOWN_DAYS * 24 * 60 * 60 * 1000;
    }

    function markShown() {
        localStorage.setItem(STORAGE_KEY, String(Date.now()));
    }

    /* ── Show / hide ── */
    var triggered = false;
    function showPopup() {
        if (triggered || isCooledDown()) return;
        triggered = true;
        markShown();
        setTimeout(function () {
            overlay.classList.add('dm-popup-open');
            document.body.style.overflow = 'hidden';
        }, DELAY_MS);
    }

    function hidePopup() {
        overlay.classList.remove('dm-popup-open');
        document.body.style.overflow = '';
        sessionStorage.setItem(SESSION_KEY, '1');
    }

    /* ── Close handlers ── */
    closeBtn.addEventListener('click', hidePopup);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) hidePopup();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('dm-popup-open')) hidePopup();
    });

    /* ── CTA click — dismiss popup ── */
    ['dmPopupPrimary', 'dmPopupSecondary'].forEach(function (id) {
        var el = document.getElementById(id);
        if (el) el.addEventListener('click', function () {
            setTimeout(hidePopup, 80); // small delay so navigation isn't blocked
        });
    });

    /* ── Wait for full page load before wiring triggers ── */
    window.addEventListener('load', function () {
        if (isCooledDown()) return;

        /* Exit-intent trigger — mouse leaves document from the top */
        if (exitIntentEnabled) {
            document.addEventListener('mouseleave', function (e) {
                if (e.clientY <= 0) showPopup();
            });
        }

        /* Scroll depth trigger */
        if (scrollEnabled) {
            var scrollFired = false;
            function onScroll() {
                if (scrollFired) return;
                var scrolled  = window.scrollY || document.documentElement.scrollTop;
                var docHeight = document.documentElement.scrollHeight - window.innerHeight;
                if (docHeight <= 0) return;
                var pct = (scrolled / docHeight) * 100;
                if (pct >= scrollDepth) {
                    scrollFired = true;
                    showPopup();
                    window.removeEventListener('scroll', onScroll, { passive: true });
                }
            }
            window.addEventListener('scroll', onScroll, { passive: true });
        }
    });
})();
</script>
@endpush

@endif {{-- $popupEnabled --}}
