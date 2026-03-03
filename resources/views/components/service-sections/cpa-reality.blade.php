@props(['data' => []])
@php
    $eyebrow          = $data['eyebrow']           ?? '';
    $title            = $data['title']             ?? '';
    $opening          = $data['opening']           ?? '';
    $pressurePoints   = $data['pressure_points']   ?? [];
    $description      = $data['description']       ?? '';
    $oldModelTitle    = $data['old_model_title']   ?? 'The Old Model';
    $oldModelDesc     = $data['old_model_description'] ?? '';
    $shiftTitle       = $data['shift_title']       ?? 'The Shift';
    $shiftDesc        = $data['shift_description'] ?? '';
@endphp

@once
@push('styles')
<style>
.ss-cpa-reality {
    padding: 90px 0;
    background: #000;
    font-family: var(--tp-ff-onest);
    color: #fff;
}
.ss-cpa-eyebrow {
    display: inline-block;
    font-size: 12px; font-weight: 700; letter-spacing: 1.8px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.55);
    border: 1px solid rgba(255,255,255,0.18);
    padding: 5px 16px; border-radius: 20px;
    margin-bottom: 22px;
}
.ss-cpa-title {
    font-size: 38px; font-weight: 800; color: #fff;
    line-height: 1.2; margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-cpa-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-cpa-title { font-size: 24px; } }
.ss-cpa-opening { font-size: 16px; color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 36px; }
.ss-cpa-pressures {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;
    margin-bottom: 30px;
}
@media (max-width: 575px) { .ss-cpa-pressures { grid-template-columns: 1fr; } }
.ss-cpa-pressure-item {
    display: flex; align-items: center; gap: 12px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    padding: 12px 16px; border-radius: 10px;
    font-size: 14px; color: rgba(255,255,255,0.8);
}
.ss-cpa-pressure-item::before {
    content: '!';
    flex-shrink: 0;
    width: 24px; height: 24px;
    background: rgba(220,50,50,0.3);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 800; color: #ff6b6b;
    text-align: center; line-height: 24px;
}
.ss-cpa-desc { font-size: 15px; color: rgba(255,255,255,0.6); line-height: 1.8; margin-bottom: 40px; }
.ss-cpa-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
@media (max-width: 767px) { .ss-cpa-cards { grid-template-columns: 1fr; } }
.ss-cpa-old-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,100,100,0.3);
    border-radius: 14px; padding: 28px 24px;
}
.ss-cpa-old-label {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #ff6b6b; margin-bottom: 12px;
}
.ss-cpa-old-text { font-size: 14px; color: rgba(255,255,255,0.65); line-height: 1.75; }
.ss-cpa-shift-card {
    background: linear-gradient(135deg, rgba(27,60,107,0.6), rgba(74,115,196,0.4));
    border: 1px solid rgba(74,115,196,0.4);
    border-radius: 14px; padding: 28px 24px;
}
.ss-cpa-shift-label {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #7eb8ff; margin-bottom: 12px;
}
.ss-cpa-shift-text { font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.75; }
</style>
@endpush
@endonce

<section class="ss-cpa-reality">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="tp_fade_anim" data-delay=".2">
                    @if($eyebrow)<span class="ss-cpa-eyebrow">{{ $eyebrow }}</span>@endif
                    <h2 class="ss-cpa-title">{{ $title }}</h2>
                    @if($opening)<p class="ss-cpa-opening">{{ $opening }}</p>@endif

                    @if(!empty($pressurePoints))
                    <div class="ss-cpa-pressures">
                        @foreach($pressurePoints as $point)
                        <div class="ss-cpa-pressure-item">{{ $point }}</div>
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
