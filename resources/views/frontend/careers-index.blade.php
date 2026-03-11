@extends('layouts.frontend')
@section('title', 'Careers - DevMantra')
@section('meta_description', 'Join the DevMantra team. Explore current openings and apply for roles that match your expertise.')

@push('styles')
<style>
    .dm-careers-hero { background-color: #001d30; padding: 200px 0 120px; }
    .dm-careers-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; }
    .dm-careers-grid { padding: 100px 0 80px; }
    @media (max-width: 767px) {
        .dm-careers-hero { padding: 150px 0 70px; }
        .dm-careers-grid { padding: 60px 0 40px; }
    }

    .dm-career-card {
        background: #fff !important;
        border: 1px solid rgba(0,0,0,0.06) !important;
        border-radius: 16px;
        padding: 36px;
        margin-bottom: 24px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        text-decoration: none;
        cursor: pointer;
    }
    .dm-career-card:hover {
        border-color: rgba(0,0,0,0.15) !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }
    .dm-career-card-title {
        font-size: 22px;
        font-weight: 600;
        color: var(--tp-common-black,#111);
        margin-bottom: 10px;
        line-height: 1.3;
        font-family: var(--tp-ff-onest);
    }
    .dm-career-card-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .dm-career-card-meta span {
        font-size: 14px;
        color: rgba(0,0,0,0.5);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--tp-ff-onest);
    }
    .dm-career-card-arrow {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.1) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
        color: #111;
    }
    .dm-career-card:hover .dm-career-card-arrow {
        background: #001d30 !important;
        color: #fff;
        border-color: #001d30 !important;
    }
    .dm-careers-empty {
        text-align: center;
        padding: 80px 20px;
        color: rgba(0,0,0,0.4);
        font-size: 18px;
        font-family: var(--tp-ff-onest);
    }
    .dm-careers-empty i { font-size: 48px; display: block; margin-bottom: 16px; opacity: 0.3; }
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="dm-careers-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Careers</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Join Our Team &<br>Grow With Us
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-careers-hero-desc">We're looking for talented people who share our passion for excellence. Explore current openings and find your next opportunity.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Careers Listing -->
<div class="dm-careers-grid">
    <div class="container container-1230">
        @forelse($careers as $career)
        <a href="{{ route('career.show', $career->slug) }}" class="dm-career-card tp_fade_anim" data-delay=".{{ 3 + $loop->index }}">
            <div>
                <h3 class="dm-career-card-title">{{ $career->title }}</h3>
                <div class="dm-career-card-meta">
                    @if($career->location)
                    <span><i class="fa-solid fa-location-dot"></i> {{ $career->location }}</span>
                    @endif
                    <span><i class="fa-solid fa-briefcase"></i> {{ $career->type }}</span>
                    <span><i class="fa-solid fa-calendar"></i> {{ $career->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
            <div class="dm-career-card-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                    <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                </svg>
            </div>
        </a>
        @empty
        <div class="dm-careers-empty tp_fade_anim" data-delay=".3">
            <i class="fa-solid fa-briefcase"></i>
            No open positions at the moment. Check back soon!
        </div>
        @endforelse

        @if($careers->hasPages())
            {{ $careers->links('vendor.pagination.devmantra') }}
        @endif
    </div>
</div>
@endsection
