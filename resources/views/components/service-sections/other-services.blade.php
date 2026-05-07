@props(['data' => []])
@php
    $title = $data['title'] ?? 'Explore Our Other Services';
    $items = $data['items'] ?? [];   // [{label, url}]
@endphp

@once
@push('styles')
<style>
.ss-other-services { padding: 80px 0; background: #fff; font-family: var(--tp-ff-onest); }
.ss-other-services-title {
    font-size: 32px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 40px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-other-services-title { font-size: 24px; } }
.ss-other-pills {
    display: flex; flex-wrap: wrap; gap: 14px; justify-content: center;
}
.ss-other-pill {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 24px;
    border: 1.5px solid #1b3c6b;
    border-radius: 100px;
    font-size: 14px; font-weight: 600; color: #1b3c6b;
    text-decoration: none;
    transition: background .2s, color .2s, transform .2s;
}
.ss-other-pill:hover {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
    border-color: transparent;
    transform: translateY(-2px);
}
.ss-other-pill i { font-size: 11px; }
</style>
@endpush
@endonce

<section class="ss-other-services">
    <div class="container container-1230">
        <h2 class="ss-other-services-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        <div class="ss-other-pills tp_fade_anim" data-delay=".3">
            @foreach($items as $item)
            <a href="{{ $item['url'] ?? route('home') }}" class="ss-other-pill">
                {{ $item['label'] ?? '' }} <i class="fa-solid fa-arrow-right"></i>
            </a>
            @endforeach
        </div>
    </div>
</section>
