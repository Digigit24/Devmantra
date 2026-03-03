@props(['data' => []])
@php
    $title = $data['title'] ?? 'Why Trust Us';
    $items = $data['items'] ?? [];   // [{icon?, label}]
@endphp

@once
@push('styles')
<style>
.ss-trust { padding: 80px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-trust-title {
    font-size: 34px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 44px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-trust-title { font-size: 24px; margin-bottom: 32px; } }
.ss-trust-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
@media (max-width: 991px) { .ss-trust-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .ss-trust-grid { grid-template-columns: 1fr; } }
.ss-trust-item {
    display: flex; align-items: center; gap: 16px;
    background: #fff;
    border-radius: 12px;
    padding: 20px 22px;
    border: 1px solid rgba(0,0,0,0.05);
    transition: box-shadow .2s;
}
.ss-trust-item:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.08); }
.ss-trust-icon {
    flex-shrink: 0;
    width: 42px; height: 42px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 16px;
}
.ss-trust-label { font-size: 14px; font-weight: 500; color: #333; line-height: 1.5; }
</style>
@endpush
@endonce

<section class="ss-trust">
    <div class="container container-1230">
        <h2 class="ss-trust-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        <div class="ss-trust-grid tp_fade_anim" data-delay=".3">
            @foreach($items as $item)
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
