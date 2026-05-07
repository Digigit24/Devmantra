@props(['data' => []])
@php
    $label      = $data['label']      ?? 'Who We Are';
    $title      = $data['title']      ?? '';
    $paragraphs = $data['paragraphs'] ?? [];
@endphp

@once
@push('styles')
<style>
.dm-about-intro { padding: 100px 0; }
@media (max-width: 767px) { .dm-about-intro { padding: 60px 0; } }
.dm-about-intro-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(0,0,0,0.35);
    margin-bottom: 20px;
    font-family: var(--tp-ff-onest);
}
.dm-about-intro-title {
    font-size: 36px;
    font-weight: 600;
    color: #111;
    line-height: 1.3;
    margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .dm-about-intro-title { font-size: 26px; } }
.dm-about-intro-text p {
    font-size: 17px;
    line-height: 1.8;
    color: rgba(0,0,0,0.65);
    margin-bottom: 20px;
    font-family: var(--tp-ff-onest);
}
</style>
@endpush
@endonce

<div class="dm-about-intro">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-5 tp_fade_anim" data-delay=".3">
                <div class="dm-about-intro-label">{{ $label }}</div>
                <h2 class="dm-about-intro-title">{{ $title }}</h2>
            </div>
            <div class="col-lg-7 tp_fade_anim" data-delay=".5">
                <div class="dm-about-intro-text">
                    @foreach($paragraphs as $para)
                    <p>{{ $para }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
