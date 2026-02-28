@extends('layouts.frontend')
@section('title', $service->title . ' - DevMantra')
@section('meta_description', $service->meta_description ?? $service->short_description ?? Str::limit(strip_tags($service->content), 160))

@push('styles')
<style>
    .futuristic-hero {
        position: relative; overflow: hidden;
        background: linear-gradient(135deg, #050505 0%, #1c1c1c 100%);
        padding: 160px 0 100px; min-height: 60vh;
    }
    .futuristic-badge {
        display: inline-block; padding: 6px 18px; font-size: 13px;
        font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        border: 1px solid rgba(255,255,255,0.15); border-radius: 100px;
        color: #fff; margin-bottom: 20px;
    }
    .futuristic-headline {
        font-size: 48px; font-weight: 800; line-height: 1.1;
        color: #fff; margin-bottom: 20px;
    }
    .futuristic-headline span {
        background: linear-gradient(135deg, #7463FF, #a78bfa);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .futuristic-subtext { font-size: 18px; color: rgba(255,255,255,0.7); line-height: 1.6; margin-bottom: 30px; }
    .futuristic-image-container img { width: 100%; border-radius: 16px; }
    .dm-service-body { padding: 80px 0; }
    .dm-service-content { max-width: 840px; }
    .dm-service-content p { font-size: 17px; line-height: 1.8; margin-bottom: 24px; color: #444; }
    .dm-service-content h3 { font-size: 28px; font-weight: 600; margin-top: 40px; margin-bottom: 16px; }
    .dm-service-content h4 { font-size: 22px; font-weight: 600; margin-top: 32px; margin-bottom: 14px; }
    .dm-service-content ul { padding-left: 24px; margin-bottom: 24px; }
    .dm-service-content ul li { font-size: 16px; line-height: 1.8; margin-bottom: 6px; }
    @media (max-width: 767px) {
        .futuristic-headline { font-size: 32px; }
        .futuristic-hero { padding: 140px 0 60px; }
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<section class="futuristic-hero">
    <div class="container container-1230">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="futuristic-content">
                    <div class="futuristic-badge">Expertise</div>
                    <h1 class="futuristic-headline">{{ $service->title }}</h1>
                    @if($service->short_description)
                    <p class="futuristic-subtext">{{ $service->short_description }}</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                @if($service->hero_image)
                <div class="futuristic-image-container tp_fade_anim" data-delay=".5">
                    <img src="{{ asset('storage/' . $service->hero_image) }}" alt="{{ $service->title }}">
                </div>
                @elseif($service->image)
                <div class="futuristic-image-container tp_fade_anim" data-delay=".5">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Service Content -->
<div class="dm-service-body">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-8">
                <div class="dm-service-content tp_fade_anim" data-delay=".3">
                    {!! $service->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
