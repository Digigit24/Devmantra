@props(['data' => []])
@php
    $label    = $data['label'] ?? 'What We Do';
    $title    = $data['title'] ?? 'Our Expertise';
    $services = \App\Models\Service::where('status', 'published')->orderBy('sort_order')->get();
@endphp

@once
@push('styles')
<style>
.dm-about-services { padding: 80px 0; background: #000; }
@media (max-width: 767px) { .dm-about-services { padding: 50px 0; } }
.dm-about-service-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 14px;
    padding: 32px;
    margin-bottom: 24px;
    transition: all 0.3s ease;
    height: 100%;
}
.dm-about-service-card:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-3px);
}
.dm-about-service-card h5 {
    font-size: 18px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 10px;
    font-family: var(--tp-ff-onest);
}
.dm-about-service-card p {
    font-size: 15px;
    line-height: 1.7;
    color: rgba(255,255,255,0.5);
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.dm-about-service-card a {
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    border-bottom: 1px solid rgba(255,255,255,0.3);
    padding-bottom: 2px;
    transition: border-color 0.3s ease;
    font-family: var(--tp-ff-onest);
}
.dm-about-service-card a:hover { border-color: #fff; }
.dm-about-services-label {
    color: rgba(255,255,255,0.35);
}
.dm-about-services-title {
    color: #fff !important;
}
</style>
@endpush
@endonce

@if($services->count())
<div class="dm-about-services">
    <div class="container container-1230">
        <div class="text-center mb-50 tp_fade_anim" data-delay=".3">
            <div class="dm-about-section-label dm-about-services-label">{{ $label }}</div>
            <h3 class="dm-about-section-title dm-about-services-title">{{ $title }}</h3>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 6) }}">
                <div class="dm-about-service-card">
                    <h5>{{ $service->title }}</h5>
                    <p>{{ Str::limit($service->short_description, 120) }}</p>
                    <a href="{{ route('service.show', $service->slug) }}">Learn More &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
