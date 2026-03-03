@props(['data' => []])
@php
    $subtitle    = $data['subtitle']    ?? 'About Dev Mantra';
    $title       = $data['title']       ?? 'Strategic Partner in Progress for Global Businesses';
    $description = $data['description'] ?? '';
@endphp

@once
@push('styles')
<style>
.dm-about-hero {
    background-color: #071016;
    padding: 200px 0 100px;
    position: relative;
    overflow: hidden;
}
@media (max-width: 767px) { .dm-about-hero { padding: 150px 0 70px; } }
.dm-about-hero-subtitle {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.5);
    margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
}
.dm-about-hero-title {
    font-size: 52px;
    font-weight: 600;
    color: #fff;
    line-height: 1.2;
    max-width: 700px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .dm-about-hero-title { font-size: 38px; } }
@media (max-width: 767px) { .dm-about-hero-title { font-size: 28px; } }
.dm-about-hero-desc {
    font-size: 18px;
    color: rgba(255,255,255,0.6);
    line-height: 1.7;
    max-width: 600px;
    margin-top: 24px;
    font-family: var(--tp-ff-onest);
}
</style>
@endpush
@endonce

<div class="dm-about-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-8">
                <div class="dm-about-hero-subtitle tp_fade_anim" data-delay=".3">{{ $subtitle }}</div>
                <h1 class="dm-about-hero-title tp-text-revel-anim" data-delay=".5">{{ $title }}</h1>
                @if($description)
                <p class="dm-about-hero-desc tp_fade_anim" data-delay=".7">{{ $description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
