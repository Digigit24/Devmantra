@props(['data' => []])
@php
    $title        = $data['title']        ?? '';
    $description  = $data['description']  ?? '';
    $description2 = $data['description2'] ?? '';
    $description3 = $data['description3'] ?? '';
    $note         = $data['note']         ?? '';
    $layers       = $data['layers']       ?? [];  // [{number, title, subtitle, points:[]}]
    $layerColors  = [
        ['#0e2444', '#1b3c6b'],
        ['#163566', '#2e5fa3'],
        ['#081830', '#0e2444'],
    ];
@endphp

@once
@push('styles')
<style>
/* ── Three Layer ── */
.ss-three-layer {
    padding: 110px 0;
    background: #001d30;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-three-layer::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 70% 50%, rgba(74,115,196,0.09) 0%, transparent 55%),
        radial-gradient(ellipse at 10% 80%, rgba(27,60,107,0.12) 0%, transparent 45%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-three-layer { padding: 80px 0; } }
@media (max-width: 767px) { .ss-three-layer { padding: 64px 0; } }

/* Left text column */
.ss-tl-eyebrow {
    font-size: 12px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #4a73c4;
    margin-bottom: 20px; display: block;
}
.ss-tl-title {
    font-size: 38px; font-weight: 700; color: #fff;
    line-height: 1.25; margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-tl-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-tl-title { font-size: 24px; } }
.ss-tl-body p {
    font-size: 15.5px; color: rgba(255,255,255,0.58);
    line-height: 1.8; margin-bottom: 16px;
}
.ss-tl-body p:last-child { margin-bottom: 0; }
.ss-tl-note {
    font-size: 14px; font-weight: 600; color: #4a73c4;
    margin-top: 28px;
    padding: 14px 18px;
    background: rgba(74,115,196,0.1);
    border-left: 3px solid #4a73c4;
    border-radius: 0 10px 10px 0;
    line-height: 1.6;
}

/* Layer cards */
.ss-tl-layers-wrap {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
.ss-tl-layer {
    border-radius: 20px;
    padding: 36px 32px;
    position: relative;
    overflow: hidden;
    min-height: 170px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: 1px solid rgba(255,255,255,0.06);
    transition: transform .35s cubic-bezier(.165,.84,.44,1),
                box-shadow .35s ease,
                border-color .35s ease;
}
.ss-tl-layer:hover {
    transform: translateY(-4px);
    box-shadow: 0 24px 60px rgba(0,0,0,0.4);
    border-color: rgba(74,115,196,0.3);
}
/* large faint background number */
.ss-tl-layer-bg-num {
    position: absolute;
    right: -8px; bottom: -20px;
    font-size: 130px; font-weight: 900;
    color: rgba(255,255,255,0.055);
    line-height: 1;
    font-family: var(--tp-ff-onest);
    user-select: none;
    pointer-events: none;
    transition: color .35s ease;
}
.ss-tl-layer:hover .ss-tl-layer-bg-num { color: rgba(255,255,255,0.08); }

.ss-tl-layer-header {
    display: flex; align-items: flex-start; gap: 18px;
    margin-bottom: 22px;
}
.ss-tl-layer-num {
    flex-shrink: 0;
    width: 46px; height: 46px;
    background: rgba(255,255,255,0.14);
    border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; font-weight: 800; color: #fff;
    font-family: var(--tp-ff-onest);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.12);
}
.ss-tl-layer-info { flex: 1; }
.ss-tl-layer-title {
    font-size: 18px; font-weight: 700; margin: 0 0 5px;
    font-family: var(--tp-ff-onest); color: #fff;
    line-height: 1.3;
}
.ss-tl-layer-subtitle {
    font-size: 13px; color: rgba(255,255,255,0.55);
    margin: 0; line-height: 1.5;
}
/* Pills */
.ss-tl-layer-points {
    list-style: none; padding: 0; margin: 0;
    display: flex; flex-wrap: wrap; gap: 8px;
}
.ss-tl-layer-points li {
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 7px 14px;
    font-size: 13px; color: rgba(255,255,255,0.88);
    line-height: 1.4;
    transition: background .25s ease, border-color .25s ease;
}
.ss-tl-layer:hover .ss-tl-layer-points li {
    background: rgba(255,255,255,0.15);
    border-color: rgba(255,255,255,0.16);
}
@media (max-width: 991px) {
    .ss-tl-layer { padding: 28px 24px; min-height: 140px; }
    .ss-tl-layer-bg-num { font-size: 100px; }
}
</style>
@endpush
@endonce

<section class="ss-three-layer">
    <div class="container container-1230" style="position:relative;z-index:1;">
        <div class="row align-items-center g-5">

            {{-- Left: description text --}}
            <div class="col-lg-5 tp_fade_anim" data-delay=".2">
                <span class="ss-tl-eyebrow">Architecture</span>
                @if($title)<h2 class="ss-tl-title">{{ $title }}</h2>@endif
                <div class="ss-tl-body">
                    @if($description)<p>{{ $description }}</p>@endif
                    @if($description2)<p>{{ $description2 }}</p>@endif
                    @if($description3)<p>{{ $description3 }}</p>@endif
                </div>
                @if($note)<p class="ss-tl-note">{{ $note }}</p>@endif
            </div>

            {{-- Right: layer cards --}}
            <div class="col-lg-7 tp_fade_anim" data-delay=".35">
                @if(!empty($layers))
                <div class="ss-tl-layers-wrap">
                    @foreach($layers as $i => $layer)
                    @php
                        $c1 = $layerColors[$i % count($layerColors)][0];
                        $c2 = $layerColors[$i % count($layerColors)][1];
                        $num = str_pad($layer['number'] ?? ($i + 1), 2, '0', STR_PAD_LEFT);
                    @endphp
                    <div class="ss-tl-layer" style="background: linear-gradient(140deg, {{ $c1 }}, {{ $c2 }});">
                        <span class="ss-tl-layer-bg-num">{{ $num }}</span>
                        <div class="ss-tl-layer-header">
                            <div class="ss-tl-layer-num">{{ $layer['number'] ?? ($i + 1) }}</div>
                            <div class="ss-tl-layer-info">
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
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
