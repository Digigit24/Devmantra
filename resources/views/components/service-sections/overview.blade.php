@props(['data' => []])
@php
    $title        = $data['title']        ?? '';
    $description  = $data['description']  ?? '';
    $description2 = $data['description2'] ?? '';
    $ctaText      = $data['cta_text']     ?? '';
    $ctaUrl       = $data['cta_url']      ?? '#contact';
    $stats        = $data['stats']        ?? [];   // [{value, label}]
@endphp

@once
@push('styles')
<style>
.ss-overview {
    padding: 90px 0;
    background: #fff;
    font-family: var(--tp-ff-onest);
}
.ss-overview-eyebrow {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #1b3c6b;
    background: rgba(27,60,107,0.07);
    padding: 5px 16px;
    border-radius: 20px;
    margin-bottom: 20px;
}
.ss-overview-title {
    font-size: 36px;
    font-weight: 700;
    color: #0d1b2a;
    line-height: 1.3;
    margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-overview-title { font-size: 26px; } }
.ss-overview-body p {
    font-size: 16px;
    color: #444;
    line-height: 1.8;
    margin-bottom: 20px;
}
.ss-overview-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #1b3c6b;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border-bottom: 2px solid #1b3c6b;
    padding-bottom: 2px;
    margin-top: 8px;
    cursor: pointer;
    background: none;
    border-left: none; border-right: none; border-top: none;
    transition: gap .2s;
}
.ss-overview-cta:hover { gap: 16px; }
/* Stats */
.ss-overview-stats { display: flex; gap: 28px; flex-wrap: wrap; margin-top: 32px; }
.ss-overview-stat {
    background: #f5f7fa;
    border-radius: 12px;
    padding: 20px 28px;
    min-width: 130px;
    text-align: center;
}
.ss-overview-stat-value {
    font-size: 32px;
    font-weight: 800;
    color: #1b3c6b;
    line-height: 1;
    margin-bottom: 6px;
    font-family: var(--tp-ff-onest);
}
.ss-overview-stat-label { font-size: 13px; color: #666; }
/* Visual side */
.ss-overview-visual {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 16px;
    height: 100%;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
}
.ss-overview-visual-text {
    font-size: 18px;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    text-align: center;
    line-height: 1.6;
}
</style>
@endpush
@endonce

<section class="ss-overview">
    <div class="container container-1230">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 tp_fade_anim" data-delay=".2">
                <h2 class="ss-overview-title">{{ $title }}</h2>
                <div class="ss-overview-body">
                    @if($description)<p>{{ $description }}</p>@endif
                    @if($description2)<p>{{ $description2 }}</p>@endif
                </div>
                @if(!empty($stats))
                <div class="ss-overview-stats">
                    @foreach($stats as $stat)
                    <div class="ss-overview-stat">
                        <div class="ss-overview-stat-value">{{ $stat['value'] ?? '' }}</div>
                        <div class="ss-overview-stat-label">{{ $stat['label'] ?? '' }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
                @if($ctaText)
                <div style="margin-top:32px;">
                @if(str_starts_with($ctaUrl, '#'))
                <button class="ss-overview-cta"
                    onclick="window.openConsultationModal && window.openConsultationModal()">
                    {{ $ctaText }} <i class="fa-solid fa-arrow-right"></i>
                </button>
                @else
                <a href="{{ $ctaUrl }}" class="ss-overview-cta">{{ $ctaText }} <i class="fa-solid fa-arrow-right"></i></a>
                @endif
                </div>
                @endif
            </div>
            <div class="col-lg-5 tp_fade_anim" data-delay=".4">
                <div class="ss-overview-visual">
                    <p class="ss-overview-visual-text">{{ $title }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
