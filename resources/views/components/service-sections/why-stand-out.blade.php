@props(['data' => []])
@php
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];   // [{title, description, icon?}]
@endphp

@once
@push('styles')
<style>
.ss-why { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-why-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 50px; line-height: 1.3;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-why-title { font-size: 26px; margin-bottom: 36px; } }
.ss-why-card {
    background: #fff;
    border-radius: 16px;
    padding: 36px 30px;
    height: 100%;
    border-top: 4px solid transparent;
    border-image: linear-gradient(135deg, #1b3c6b, #4a73c4) 1;
    transition: transform .25s, box-shadow .25s;
}
.ss-why-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); }
.ss-why-card-icon {
    width: 48px; height: 48px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 18px;
    margin-bottom: 20px;
}
.ss-why-card-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
}
.ss-why-card-desc { font-size: 15px; color: #555; line-height: 1.75; }
</style>
@endpush
@endonce

<section class="ss-why">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-why-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        <div class="row g-4">
            @foreach($items as $i => $item)
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay="{{ 0.2 + ($i * 0.1) }}">
                <div class="ss-why-card">
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
