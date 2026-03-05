@props(['data' => []])
@php
    $title       = $data['title']       ?? '';
    $description = $data['description'] ?? '';
    $items       = $data['items']       ?? [];  // [string, ...]
@endphp

@once
@push('styles')
<style>
/* ── Benefits List ── */
.ss-benefits {
    padding: 100px 0;
    background: #fff;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
/* dot-grid texture — same visual language as homepage feature section */
.ss-benefits-texture {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(27,60,107,0.05) 1px, transparent 1px);
    background-size: 26px 26px;
    pointer-events: none;
}
.ss-benefits-glow {
    position: absolute;
    bottom: -100px; right: -100px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(74,115,196,0.06) 0%, transparent 65%);
    pointer-events: none;
}
.ss-benefits-inner { position: relative; z-index: 1; }
@media (max-width: 991px) { .ss-benefits { padding: 80px 0; } }
@media (max-width: 767px) { .ss-benefits { padding: 64px 0; } }

/* Split header: title left, description right (matches homepage two-col headings) */
.ss-benefits-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 48px;
    margin-bottom: 52px;
    padding-bottom: 36px;
    border-bottom: 1px solid rgba(0,0,0,0.07);
}
@media (max-width: 767px) {
    .ss-benefits-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 32px;
        padding-bottom: 24px;
    }
}
.ss-benefits-title {
    font-size: 40px; font-weight: 700; color: #0d1b2a;
    line-height: 1.2; margin-bottom: 0;
    font-family: var(--tp-ff-onest); flex: 1;
}
@media (max-width: 991px) { .ss-benefits-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-benefits-title { font-size: 24px; } }
.ss-benefits-desc {
    font-size: 15px; color: #5a6478; line-height: 1.75;
    max-width: 360px; margin-bottom: 0; flex-shrink: 0;
}
@media (max-width: 767px) { .ss-benefits-desc { max-width: 100%; } }

/* Item card grid */
.ss-benefits-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}
@media (max-width: 575px) { .ss-benefits-grid { grid-template-columns: 1fr; gap: 12px; } }

.ss-benefits-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 18px;
    padding: 28px 26px;
    position: relative;
    overflow: hidden;
    cursor: default;
    transition: transform .35s cubic-bezier(.165,.84,.44,1),
                box-shadow .35s ease,
                border-color .35s ease;
}
/* faint large number watermark as bg */
.ss-benefits-card-num {
    position: absolute;
    top: 10px; right: 18px;
    font-size: 76px; font-weight: 900;
    color: rgba(27,60,107,0.04);
    line-height: 1;
    font-family: var(--tp-ff-onest);
    user-select: none;
    pointer-events: none;
    transition: color .35s ease, transform .35s ease;
}
/* bottom gradient reveal line on hover — same brand accent */
.ss-benefits-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    transform: scaleX(0);
    transform-origin: left center;
    transition: transform .4s cubic-bezier(.165,.84,.44,1);
}
.ss-benefits-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 60px rgba(27,60,107,0.13);
    border-color: rgba(74,115,196,0.22);
}
.ss-benefits-card:hover::after { transform: scaleX(1); }
.ss-benefits-card:hover .ss-benefits-card-num {
    color: rgba(74,115,196,0.07);
    transform: scale(1.04) translateX(-3px);
}
.ss-benefits-card-dot {
    display: block;
    width: 10px; height: 10px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    margin-bottom: 14px;
}
.ss-benefits-card-text {
    font-size: 15px; color: #374151;
    line-height: 1.7; font-weight: 500;
    margin: 0;
    position: relative; z-index: 1;
}
</style>
@endpush
@endonce

<section class="ss-benefits">
    <div class="ss-benefits-texture"></div>
    <div class="ss-benefits-glow"></div>
    <div class="container container-1230">
        <div class="ss-benefits-inner">
            @if($title || $description)
            <div class="ss-benefits-header tp_fade_anim" data-delay=".2">
                @if($title)
                <h2 class="ss-benefits-title">{{ $title }}</h2>
                @endif
                @if($description)
                <p class="ss-benefits-desc">{{ $description }}</p>
                @endif
            </div>
            @endif
            <div class="ss-benefits-grid">
                @foreach($items as $i => $item)
                <div class="ss-benefits-card tp_fade_anim" data-delay="{{ 0.2 + ($i * 0.04) }}">
                    <span class="ss-benefits-card-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="ss-benefits-card-dot"></span>
                    <p class="ss-benefits-card-text">{{ $item }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
