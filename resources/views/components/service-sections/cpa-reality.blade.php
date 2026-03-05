@props(['data' => []])
@php
    $eyebrow          = $data['eyebrow']              ?? '';
    $title            = $data['title']                ?? '';
    $opening          = $data['opening']              ?? '';
    $pressurePoints   = $data['pressure_points']      ?? [];
    $description      = $data['description']          ?? '';
    $oldModelTitle    = $data['old_model_title']      ?? 'The Old Model';
    $oldModelDesc     = $data['old_model_description'] ?? '';
    $shiftTitle       = $data['shift_title']          ?? 'The Shift';
    $shiftDesc        = $data['shift_description']    ?? '';
@endphp

@once
@push('styles')
<style>
/* ── CPA Reality ── */
.ss-cpa-reality {
    padding: 100px 0;
    background: #000;
    font-family: var(--tp-ff-onest);
    color: #fff;
    position: relative;
    overflow: hidden;
}
.ss-cpa-reality::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 0% 100%, rgba(27,60,107,0.15) 0%, transparent 50%),
        radial-gradient(ellipse at 100% 0%, rgba(74,115,196,0.08) 0%, transparent 50%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-cpa-reality { padding: 80px 0; } }
@media (max-width: 767px) { .ss-cpa-reality { padding: 64px 0; } }

.ss-cpa-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 700; letter-spacing: 1.8px;
    text-transform: uppercase;
    color: #4a73c4;
    border: 1px solid rgba(74,115,196,0.3);
    padding: 6px 18px; border-radius: 20px;
    margin-bottom: 24px;
    background: rgba(74,115,196,0.08);
}
.ss-cpa-title {
    font-size: 42px; font-weight: 800; color: #fff;
    line-height: 1.2; margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-cpa-title { font-size: 32px; } }
@media (max-width: 767px) { .ss-cpa-title { font-size: 26px; } }

.ss-cpa-opening {
    font-size: 16px; color: rgba(255,255,255,0.65);
    line-height: 1.8; margin-bottom: 40px;
}

/* Pressure points grid */
.ss-cpa-pressures {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 36px;
}
@media (max-width: 575px) { .ss-cpa-pressures { grid-template-columns: 1fr; } }

.ss-cpa-pressure-item {
    display: flex; align-items: flex-start; gap: 14px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    padding: 16px 18px; border-radius: 12px;
    font-size: 14px; color: rgba(255,255,255,0.78);
    line-height: 1.55;
    transition: background .25s ease, border-color .25s ease;
}
.ss-cpa-pressure-item:hover {
    background: rgba(255,255,255,0.07);
    border-color: rgba(220,60,60,0.25);
}
.ss-cpa-pressure-icon {
    flex-shrink: 0;
    width: 28px; height: 28px;
    background: rgba(220,50,50,0.18);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 900; color: #ff6b6b;
    margin-top: 1px;
}

.ss-cpa-desc {
    font-size: 15px; color: rgba(255,255,255,0.55);
    line-height: 1.8; margin-bottom: 48px;
}

/* Before/After cards */
.ss-cpa-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
@media (max-width: 767px) { .ss-cpa-cards { grid-template-columns: 1fr; } }

/* Old model card */
.ss-cpa-old-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,80,80,0.2);
    border-radius: 18px; padding: 32px 28px;
    position: relative; overflow: hidden;
}
.ss-cpa-old-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #dc2626, #ff6b6b);
}
.ss-cpa-old-label {
    font-size: 11px; font-weight: 700; letter-spacing: 1.8px;
    text-transform: uppercase; color: #ff6b6b;
    margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
}
.ss-cpa-old-label::before {
    content: '✕';
    width: 20px; height: 20px;
    background: rgba(220,50,50,0.2);
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 11px;
}
.ss-cpa-old-text {
    font-size: 14.5px; color: rgba(255,255,255,0.6); line-height: 1.8;
    margin: 0;
}

/* Shift card */
.ss-cpa-shift-card {
    background: linear-gradient(140deg, rgba(27,60,107,0.55), rgba(74,115,196,0.35));
    border: 1px solid rgba(74,115,196,0.35);
    border-radius: 18px; padding: 32px 28px;
    position: relative; overflow: hidden;
}
.ss-cpa-shift-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
}
.ss-cpa-shift-label {
    font-size: 11px; font-weight: 700; letter-spacing: 1.8px;
    text-transform: uppercase; color: #7eb8ff;
    margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
}
.ss-cpa-shift-label::before {
    content: '✓';
    width: 20px; height: 20px;
    background: rgba(74,115,196,0.3);
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800; color: #7eb8ff;
}
.ss-cpa-shift-text {
    font-size: 14.5px; color: rgba(255,255,255,0.88); line-height: 1.8;
    margin: 0;
}
</style>
@endpush
@endonce

<section class="ss-cpa-reality">
    <div class="container container-1230" style="position:relative;z-index:1;">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="tp_fade_anim" data-delay=".2">
                    @if($eyebrow)<span class="ss-cpa-eyebrow">{{ $eyebrow }}</span>@endif
                    <h2 class="ss-cpa-title">{{ $title }}</h2>
                    @if($opening)<p class="ss-cpa-opening">{{ $opening }}</p>@endif

                    @if(!empty($pressurePoints))
                    <div class="ss-cpa-pressures">
                        @foreach($pressurePoints as $point)
                        <div class="ss-cpa-pressure-item">
                            <span class="ss-cpa-pressure-icon">!</span>
                            {{ $point }}
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($description)<p class="ss-cpa-desc">{{ $description }}</p>@endif

                    <div class="ss-cpa-cards">
                        @if($oldModelDesc)
                        <div class="ss-cpa-old-card">
                            <div class="ss-cpa-old-label">{{ $oldModelTitle }}</div>
                            <p class="ss-cpa-old-text">{{ $oldModelDesc }}</p>
                        </div>
                        @endif
                        @if($shiftDesc)
                        <div class="ss-cpa-shift-card">
                            <div class="ss-cpa-shift-label">{{ $shiftTitle }}</div>
                            <p class="ss-cpa-shift-text">{{ $shiftDesc }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
