@props(['data' => []])
@php
    $title = $data['title'] ?? 'Why Trust Us';
    $items = $data['items'] ?? [];   // [{icon?, label}]
@endphp

@once
@push('styles')
<style>
/* ── Trust Signals ── */
.ss-trust {
    padding: 100px 0;
    background: #001d30;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-trust::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 50% 0%, rgba(74,115,196,0.10) 0%, transparent 60%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-trust { padding: 80px 0; } }
@media (max-width: 767px) { .ss-trust { padding: 64px 0; } }

.ss-trust-title {
    font-size: 38px; font-weight: 700; color: #fff;
    text-align: center; margin-bottom: 56px;
    font-family: var(--tp-ff-onest); line-height: 1.25;
}
@media (max-width: 991px) { .ss-trust-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-trust-title { font-size: 24px; margin-bottom: 36px; } }

/* Grid */
.ss-trust-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
@media (max-width: 991px) { .ss-trust-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .ss-trust-grid { grid-template-columns: 1fr; gap: 12px; } }

/* Card */
.ss-trust-item {
    display: flex;
    align-items: center;
    gap: 18px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 16px;
    padding: 22px 24px;
    transition: background .3s ease,
                border-color .3s ease,
                transform .35s cubic-bezier(.165,.84,.44,1),
                box-shadow .35s ease;
    position: relative;
    overflow: hidden;
}
/* left accent reveal */
.ss-trust-item::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #1b3c6b, #4a73c4);
    border-radius: 3px 0 0 3px;
    opacity: 0;
    transition: opacity .3s ease;
}
.ss-trust-item:hover {
    background: rgba(255,255,255,0.07);
    border-color: rgba(74,115,196,0.25);
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.3);
}
.ss-trust-item:hover::before { opacity: 1; }

/* icon */
.ss-trust-icon {
    flex-shrink: 0;
    width: 46px; height: 46px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 18px;
    box-shadow: 0 6px 20px rgba(27,60,107,0.35);
    transition: transform .35s ease, box-shadow .35s ease;
}
.ss-trust-item:hover .ss-trust-icon {
    transform: scale(1.08) rotate(-4deg);
    box-shadow: 0 10px 28px rgba(27,60,107,0.5);
}
.ss-trust-label {
    font-size: 14.5px; font-weight: 500;
    color: rgba(255,255,255,0.78);
    line-height: 1.5;
}
</style>
@endpush
@endonce

<section class="ss-trust">
    <div class="container container-1230" style="position:relative;z-index:1;">
        <h2 class="ss-trust-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        <div class="ss-trust-grid tp_fade_anim" data-delay=".3">
            @foreach($items as $i => $item)
            <div class="ss-trust-item">
                <div class="ss-trust-icon">
                    @if(!empty($item['icon']))
                    <i class="{{ $item['icon'] }}"></i>
                    @else
                    <i class="fa-solid fa-shield-halved"></i>
                    @endif
                </div>
                <span class="ss-trust-label">{{ $item['label'] ?? '' }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
