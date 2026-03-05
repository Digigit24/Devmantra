@props(['data' => []])
@php
    $title      = $data['title']      ?? '';
    $columns    = $data['columns']    ?? [];  // [{title, items:[]}]
    $disclaimer = $data['disclaimer'] ?? '';
    $colCount   = count($columns);
@endphp

@once
@push('styles')
<style>
/* ── Governance & Security ── */
.ss-governance {
    padding: 100px 0;
    background: #071016;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-governance::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 15% 60%, rgba(74,115,196,0.10) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 20%, rgba(27,60,107,0.14) 0%, transparent 50%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-governance { padding: 80px 0; } }
@media (max-width: 767px) { .ss-governance { padding: 64px 0; } }

.ss-governance-header {
    text-align: center;
    margin-bottom: 56px;
}
.ss-governance-eyebrow {
    display: inline-block;
    font-size: 12px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #4a73c4;
    margin-bottom: 16px;
}
.ss-governance-title {
    font-size: 38px; font-weight: 700; color: #fff;
    font-family: var(--tp-ff-onest); line-height: 1.25;
    margin-bottom: 0;
}
@media (max-width: 991px) { .ss-governance-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-governance-title { font-size: 24px; } }

.ss-governance-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 20px;
    padding: 36px 30px 32px;
    height: 100%;
    position: relative;
    overflow: hidden;
    transition: border-color .3s, background .3s, transform .3s;
}
.ss-governance-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
}
.ss-governance-card:hover {
    border-color: rgba(74,115,196,0.28);
    background: rgba(255,255,255,0.06);
    transform: translateY(-3px);
}

.ss-governance-col-title {
    font-size: 17px; font-weight: 700; color: #fff;
    margin-bottom: 24px; padding-bottom: 18px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
    font-family: var(--tp-ff-onest);
    display: flex; align-items: center; gap: 10px;
}
.ss-governance-col-title::before {
    content: '';
    display: inline-block;
    flex-shrink: 0;
    width: 8px; height: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4a73c4, #7da3e0);
}

.ss-governance-list { list-style: none; padding: 0; margin: 0; }
.ss-governance-list li {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 11px 0;
    font-size: 14.5px; color: rgba(255,255,255,0.68);
    line-height: 1.65;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.ss-governance-list li:last-child { border-bottom: none; }

.ss-governance-check {
    flex-shrink: 0;
    width: 20px; height: 20px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex; align-items: center; justify-content: center;
    margin-top: 1px;
}
.ss-governance-check svg { width: 10px; height: 10px; }

.ss-governance-disclaimer {
    margin-top: 50px;
    background: rgba(74,115,196,0.10);
    border: 1px solid rgba(74,115,196,0.18);
    border-radius: 16px;
    padding: 28px 36px;
    font-size: 14px; color: rgba(255,255,255,0.6);
    line-height: 1.8; font-style: italic;
    text-align: center;
    position: relative; z-index: 1;
}
@media (max-width: 767px) { .ss-governance-disclaimer { padding: 22px 20px; } }
</style>
@endpush
@endonce

<section class="ss-governance">
    <div class="container container-1230" style="position:relative;z-index:1;">
        @if($title)
        <div class="ss-governance-header tp_fade_anim" data-delay=".2">
            <h2 class="ss-governance-title">{{ $title }}</h2>
        </div>
        @endif

        <div class="row g-4 tp_fade_anim" data-delay=".3">
            @foreach($columns as $col)
            <div class="col-md-{{ $colCount == 2 ? 6 : 4 }}">
                <div class="ss-governance-card">
                    <h3 class="ss-governance-col-title">{{ $col['title'] ?? '' }}</h3>
                    <ul class="ss-governance-list">
                        @foreach($col['items'] ?? [] as $item)
                        <li>
                            <span class="ss-governance-check">
                                <svg viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 4L3.5 6.5L9 1" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>

        @if($disclaimer)
        <div class="ss-governance-disclaimer tp_fade_anim" data-delay=".4">{{ $disclaimer }}</div>
        @endif
    </div>
</section>
