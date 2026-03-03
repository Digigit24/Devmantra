@props(['data' => []])
@php
    $title   = $data['title']   ?? '';
    $pillars = $data['pillars'] ?? [];  // [{title, points:[]}]
@endphp

@once
@push('styles')
<style>
.ss-pillars { padding: 90px 0; background: #fff; font-family: var(--tp-ff-onest); }
.ss-pillars-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 50px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-pillars-title { font-size: 26px; margin-bottom: 36px; } }
.ss-pillar-card {
    border-radius: 16px;
    padding: 32px 28px;
    height: 100%;
    border: 1px solid rgba(0,0,0,0.07);
    border-top: 4px solid transparent;
    transition: border-color .2s, transform .25s, box-shadow .25s;
    background: #fff;
}
.ss-pillar-card:hover {
    border-top-color: #4a73c4;
    transform: translateY(-6px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.09);
}
.ss-pillar-icon {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 19px;
    margin-bottom: 20px;
}
.ss-pillar-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 16px; font-family: var(--tp-ff-onest);
}
.ss-pillar-points { list-style: none; padding: 0; margin: 0; }
.ss-pillar-points li {
    font-size: 14px; color: #555; line-height: 1.65;
    padding: 6px 0 6px 20px; position: relative;
    border-bottom: 1px solid rgba(0,0,0,0.04);
}
.ss-pillar-points li:last-child { border-bottom: none; }
.ss-pillar-points li::before {
    content: '→';
    position: absolute; left: 0; top: 6px;
    color: #4a73c4; font-size: 12px;
}
</style>
@endpush
@endonce

<section class="ss-pillars">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-pillars-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        <div class="row g-4">
            @foreach($pillars as $i => $pillar)
            <div class="col-lg-{{ count($pillars) <= 2 ? 6 : (count($pillars) <= 3 ? 4 : 3) }} col-md-6 tp_fade_anim" data-delay="{{ 0.2 + ($i * 0.1) }}">
                <div class="ss-pillar-card">
                    <div class="ss-pillar-icon"><i class="fa-solid fa-layer-group"></i></div>
                    <h3 class="ss-pillar-title">{{ $pillar['title'] ?? '' }}</h3>
                    @if(!empty($pillar['points']))
                    <ul class="ss-pillar-points">
                        @foreach($pillar['points'] as $point)
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
