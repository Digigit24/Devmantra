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
    background: #f5f7fc;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-benefits::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4, #1b3c6b);
}
.ss-benefits::after {
    content: '';
    position: absolute;
    bottom: -80px; right: -80px;
    width: 320px; height: 320px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(74,115,196,0.06) 0%, transparent 70%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-benefits { padding: 80px 0; } }
@media (max-width: 767px) { .ss-benefits { padding: 64px 0; } }

.ss-benefits-header { margin-bottom: 52px; }
.ss-benefits-title {
    font-size: 38px; font-weight: 700; color: #0d1b2a;
    line-height: 1.25; margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-benefits-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-benefits-title { font-size: 24px; margin-bottom: 12px; } }

.ss-benefits-desc {
    font-size: 16px; color: #5a6478; line-height: 1.75;
    max-width: 680px; margin-bottom: 0;
}

.ss-benefits-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}
@media (max-width: 767px) { .ss-benefits-grid { grid-template-columns: 1fr; gap: 10px; } }

.ss-benefits-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    background: #fff;
    border: 1px solid rgba(27,60,107,0.07);
    border-radius: 14px;
    padding: 20px 22px;
    transition: border-color .25s, box-shadow .25s, transform .25s;
    position: relative;
    overflow: hidden;
}
.ss-benefits-item::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #1b3c6b, #4a73c4);
    border-radius: 3px 0 0 3px;
    opacity: 0;
    transition: opacity .25s;
}
.ss-benefits-item:hover {
    border-color: rgba(74,115,196,0.22);
    box-shadow: 0 6px 28px rgba(27,60,107,0.08);
    transform: translateY(-2px);
}
.ss-benefits-item:hover::before { opacity: 1; }

.ss-benefits-icon {
    flex-shrink: 0;
    width: 36px; height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex; align-items: center; justify-content: center;
    margin-top: 1px;
}
.ss-benefits-icon svg { width: 15px; height: 15px; }

.ss-benefits-item-text {
    font-size: 15px; color: #374151;
    line-height: 1.65; font-weight: 500;
}
</style>
@endpush
@endonce

<section class="ss-benefits">
    <div class="container container-1230" style="position:relative;z-index:1;">
        @if($title || $description)
        <div class="ss-benefits-header">
            @if($title)
            <h2 class="ss-benefits-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
            @endif
            @if($description)
            <p class="ss-benefits-desc tp_fade_anim" data-delay=".25">{{ $description }}</p>
            @endif
        </div>
        @endif

        <div class="ss-benefits-grid tp_fade_anim" data-delay=".3">
            @foreach($items as $item)
            <div class="ss-benefits-item">
                <div class="ss-benefits-icon">
                    <svg viewBox="0 0 15 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 6L5.5 10.5L13.5 1.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="ss-benefits-item-text">{{ $item }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
