@props(['data' => []])
@php
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];   // [{title, description, icon?}]
@endphp

@once
@push('styles')
<style>
/* ── Why Stand Out ── */
.ss-why {
    padding: 100px 0;
    background: #fff;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
/* dot-grid texture matching benefits-list */
.ss-why-texture {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(27,60,107,0.05) 1px, transparent 1px);
    background-size: 26px 26px;
    pointer-events: none;
}
@media (max-width: 991px) { .ss-why { padding: 80px 0; } }
@media (max-width: 767px) { .ss-why { padding: 64px 0; } }

.ss-why-title {
    font-size: 38px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 56px; line-height: 1.25;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-why-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-why-title { font-size: 24px; margin-bottom: 36px; } }

/* Card — homepage service card DNA: white, radius 20, lift -8 with blue shadow */
.ss-why-card {
    background: #fff;
    border-radius: 20px;
    padding: 36px 30px;
    height: 100%;
    border: 1px solid rgba(0,0,0,0.07);
    position: relative;
    overflow: hidden;
    transform: translateZ(0);
    transition: transform .35s cubic-bezier(.165,.84,.44,1),
                border-color .35s ease,
                box-shadow .35s ease;
}
/* faint bg number */
.ss-why-bg-num {
    position: absolute;
    top: -6px; right: 14px;
    font-size: 96px; font-weight: 900;
    color: rgba(27,60,107,0.04);
    line-height: 1;
    font-family: var(--tp-ff-onest);
    user-select: none; pointer-events: none;
    transition: color .35s ease;
}
/* bottom gradient reveal on hover */
.ss-why-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .4s cubic-bezier(.165,.84,.44,1);
}
.ss-why-card:hover {
    transform: translateY(-8px);
    border-color: rgba(74,115,196,0.2);
    box-shadow: 0 20px 60px rgba(27,60,107,0.13);
}
.ss-why-card:hover::after { transform: scaleX(1); }
.ss-why-card:hover .ss-why-bg-num { color: rgba(74,115,196,0.07); }

/* icon */
.ss-why-card-icon {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 20px;
    margin-bottom: 22px;
    box-shadow: 0 6px 20px rgba(27,60,107,0.22);
    position: relative; z-index: 1;
    transition: transform .35s ease, box-shadow .35s ease;
}
.ss-why-card:hover .ss-why-card-icon {
    transform: scale(1.08) rotate(-5deg);
    box-shadow: 0 10px 28px rgba(27,60,107,0.35);
}
.ss-why-card-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
    line-height: 1.3; position: relative; z-index: 1;
}
.ss-why-card-desc {
    font-size: 14.5px; color: #5a6478; line-height: 1.75;
    margin: 0; position: relative; z-index: 1;
}
</style>
@endpush
@endonce

<section class="ss-why">
    <div class="ss-why-texture"></div>
    <div class="container container-1230" style="position:relative;z-index:1;">
        @if($title)
        <h2 class="ss-why-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        <div class="row g-4">
            @foreach($items as $i => $item)
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay="{{ 0.2 + ($i * 0.1) }}">
                <div class="ss-why-card">
                    <span class="ss-why-bg-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="ss-why-card-icon">
                        @if(!empty($item['icon']))
                        <i class="{{ $item['icon'] }}"></i>
                        @else
                        <i class="fa-solid fa-star"></i>
                        @endif
                    </div>
                    <h3 class="ss-why-card-title">{{ $item['title'] ?? '' }}</h3>
                    <p class="ss-why-card-desc">{{ $item['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
