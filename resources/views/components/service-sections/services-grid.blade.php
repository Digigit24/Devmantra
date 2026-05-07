@props(['data' => []])
@php
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];   // [{title, description, icon?, points:[]}]
@endphp

@once
@push('styles')
<style>
.ss-services-grid { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-services-grid-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    line-height: 1.3; margin-bottom: 50px; text-align: center;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-services-grid-title { font-size: 26px; margin-bottom: 36px; } }
.ss-sg-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px 28px;
    height: 100%;
    transition: transform .25s, box-shadow .25s;
    border: 1px solid rgba(0,0,0,0.05);
}
.ss-sg-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,0.1); }
.ss-sg-icon {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 20px;
    font-size: 20px; color: #fff;
}
.ss-sg-card-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
}
.ss-sg-card-desc { font-size: 15px; color: #555; line-height: 1.7; margin-bottom: 16px; }
.ss-sg-points { list-style: none; padding: 0; margin: 0; }
.ss-sg-points li {
    font-size: 14px; color: #444; padding: 5px 0 5px 22px;
    position: relative; line-height: 1.6;
}
.ss-sg-points li::before {
    content: '✓';
    position: absolute; left: 0; top: 5px;
    color: #4a73c4; font-weight: 700; font-size: 13px;
}
</style>
@endpush
@endonce

<section class="ss-services-grid">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-services-grid-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        <div class="row g-4">
            @foreach($items as $i => $item)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay="{{ 0.2 + ($i * 0.1) }}">
                <div class="ss-sg-card">
                    @if(!empty($item['icon']))
                    <div class="ss-sg-icon"><i class="{{ $item['icon'] }}"></i></div>
                    @else
                    <div class="ss-sg-icon"><i class="fa-solid fa-layer-group"></i></div>
                    @endif
                    <h3 class="ss-sg-card-title">{{ $item['title'] ?? '' }}</h3>
                    @if(!empty($item['description']))
                    <p class="ss-sg-card-desc">{{ $item['description'] }}</p>
                    @endif
                    @if(!empty($item['points']))
                    <ul class="ss-sg-points">
                        @foreach($item['points'] as $point)
                        <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
