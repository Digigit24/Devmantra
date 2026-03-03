@props(['data' => []])
@php
    $missionTitle = $data['mission_title'] ?? 'Our Mission';
    $missionText  = $data['mission_text']  ?? '';
    $visionTitle  = $data['vision_title']  ?? 'Our Vision';
    $visionText   = $data['vision_text']   ?? '';
@endphp

@once
@push('styles')
<style>
.dm-about-mv { padding: 80px 0; background: #f8f9fa; }
@media (max-width: 767px) { .dm-about-mv { padding: 50px 0; } }
.dm-mv-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 16px;
    padding: 40px;
    height: 100%;
    transition: transform 0.3s ease;
}
.dm-mv-card:hover { transform: translateY(-4px); }
.dm-mv-card h4 {
    font-size: 24px;
    font-weight: 700;
    color: #111;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.dm-mv-card p {
    font-size: 16px;
    line-height: 1.75;
    color: rgba(0,0,0,0.6);
    font-family: var(--tp-ff-onest);
}
</style>
@endpush
@endonce

<div class="dm-about-mv">
    <div class="container container-1230">
        <div class="row g-4">
            <div class="col-md-6 tp_fade_anim" data-delay=".3">
                <div class="dm-mv-card">
                    <h4>{{ $missionTitle }}</h4>
                    <p>{{ $missionText }}</p>
                </div>
            </div>
            <div class="col-md-6 tp_fade_anim" data-delay=".5">
                <div class="dm-mv-card">
                    <h4>{{ $visionTitle }}</h4>
                    <p>{{ $visionText }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
