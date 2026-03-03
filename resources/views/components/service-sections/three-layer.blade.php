@props(['data' => []])
@php
    $title        = $data['title']        ?? '';
    $description  = $data['description']  ?? '';
    $description2 = $data['description2'] ?? '';
    $description3 = $data['description3'] ?? '';
    $note         = $data['note']         ?? '';
    $layers       = $data['layers']       ?? [];  // [{number, title, subtitle, points:[]}]
    // Layer backgrounds (navy → blue → dark)
    $layerBgs = ['linear-gradient(135deg,#1b3c6b,#243f70)', 'linear-gradient(135deg,#2e5fa3,#4a73c4)', 'linear-gradient(135deg,#0e1f38,#1b3c6b)'];
@endphp

@once
@push('styles')
<style>
.ss-three-layer { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-tl-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    line-height: 1.3; margin-bottom: 18px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-tl-title { font-size: 26px; } }
.ss-tl-body p { font-size: 15px; color: #555; line-height: 1.8; margin-bottom: 16px; }
.ss-tl-note {
    font-size: 15px; font-weight: 600; color: #1b3c6b;
    margin-top: 6px; font-style: italic;
}
.ss-tl-layers-title {
    font-size: 18px; font-weight: 700; color: #0d1b2a;
    margin: 40px 0 24px; font-family: var(--tp-ff-onest);
}
.ss-tl-layer {
    border-radius: 14px;
    padding: 28px 26px;
    margin-bottom: 16px;
    color: #fff;
}
.ss-tl-layer-header {
    display: flex; align-items: center; gap: 14px;
    margin-bottom: 16px;
}
.ss-tl-layer-num {
    width: 36px; height: 36px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 800;
    flex-shrink: 0;
}
.ss-tl-layer-label { }
.ss-tl-layer-title {
    font-size: 16px; font-weight: 700; margin: 0;
    font-family: var(--tp-ff-onest);
}
.ss-tl-layer-subtitle { font-size: 12px; color: rgba(255,255,255,0.65); margin: 0; }
.ss-tl-layer-points { list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 8px; }
.ss-tl-layer-points li {
    background: rgba(255,255,255,0.15);
    border-radius: 6px;
    padding: 5px 12px;
    font-size: 13px; color: rgba(255,255,255,0.9);
}
</style>
@endpush
@endonce

<section class="ss-three-layer">
    <div class="container container-1230">
        <div class="row align-items-start g-5">
            <div class="col-lg-6 tp_fade_anim" data-delay=".2">
                @if($title)<h2 class="ss-tl-title">{{ $title }}</h2>@endif
                <div class="ss-tl-body">
                    @if($description)<p>{{ $description }}</p>@endif
                    @if($description2)<p>{{ $description2 }}</p>@endif
                    @if($description3)<p>{{ $description3 }}</p>@endif
                </div>
                @if($note)<p class="ss-tl-note">{{ $note }}</p>@endif
            </div>
            <div class="col-lg-6 tp_fade_anim" data-delay=".4">
                @if(!empty($layers))
                <p class="ss-tl-layers-title">The Three-Layer GCC Structure</p>
                @foreach($layers as $i => $layer)
                <div class="ss-tl-layer" style="background: {{ $layerBgs[$i % count($layerBgs)] }}">
                    <div class="ss-tl-layer-header">
                        <div class="ss-tl-layer-num">{{ $layer['number'] ?? ($i + 1) }}</div>
                        <div class="ss-tl-layer-label">
                            <p class="ss-tl-layer-title">Layer {{ $layer['number'] ?? ($i + 1) }} — {{ $layer['title'] ?? '' }}</p>
                            @if(!empty($layer['subtitle']))
                            <p class="ss-tl-layer-subtitle">{{ $layer['subtitle'] }}</p>
                            @endif
                        </div>
                    </div>
                    @if(!empty($layer['points']))
                    <ul class="ss-tl-layer-points">
                        @foreach($layer['points'] as $point)
                        <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
