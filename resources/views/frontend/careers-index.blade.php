@extends('layouts.frontend')
@section('title', 'Careers - DevMantra')
@section('meta_description', 'Join the DevMantra team. Explore current openings and apply for roles that match your expertise.')

@push('styles')
<style>
    .dm-careers-hero { background-color: #001d30; padding: 200px 0 120px; }
    .dm-careers-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; font-family: var(--tp-ff-onest); }
    .dm-careers-grid { padding: 100px 0 80px; }
    @media (max-width: 767px) {
        .dm-careers-hero { padding: 150px 0 70px; }
        .dm-careers-grid { padding: 60px 0 40px; }
    }

    /* Job Card */
    .dm-job-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 16px;
        padding: 32px;
        height: 100%;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .dm-job-card:hover {
        border-color: rgba(0,0,0,0.15);
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }
    .dm-job-card-type {
        display: inline-block;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 8px;
        font-family: var(--tp-ff-onest);
        margin-bottom: 20px;
        align-self: flex-start;
    }
    .dm-job-type-full-time { background: rgba(34,197,94,0.1); color: #16a34a; }
    .dm-job-type-part-time { background: rgba(59,130,246,0.1); color: #2563eb; }
    .dm-job-type-remote { background: rgba(139,92,246,0.1); color: #7c3aed; }
    .dm-job-type-contract { background: rgba(245,158,11,0.1); color: #d97706; }

    .dm-job-card-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--tp-common-black,#111);
        margin-bottom: 12px;
        line-height: 1.4;
        font-family: var(--tp-ff-onest);
    }
    .dm-job-card-title a { color: inherit; text-decoration: none; }
    .dm-job-card-title a:hover { opacity: 0.7; }
    .dm-job-card-meta {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 24px;
        flex: 1;
    }
    .dm-job-card-meta span {
        font-size: 14px;
        color: rgba(0,0,0,0.45);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-job-card-meta span i { width: 16px; text-align: center; color: rgba(0,0,0,0.3); }
    .dm-job-card-link {
        font-size: 14px;
        font-weight: 600;
        color: var(--tp-common-black,#111);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: var(--tp-ff-onest);
        transition: opacity 0.3s;
        margin-top: auto;
    }
    .dm-job-card-link:hover { opacity: 0.6; }

    .dm-careers-empty {
        text-align: center;
        padding: 80px 20px;
        color: rgba(0,0,0,0.4);
        font-size: 18px;
        font-family: var(--tp-ff-onest);
    }
    .dm-careers-empty i { font-size: 48px; display: block; margin-bottom: 16px; opacity: 0.3; }

    /* Pagination */
    .dm-pagination { display: flex; justify-content: center; padding-top: 40px; }
    .dm-pagination ul {
        list-style: none; padding: 0; margin: 0;
        display: flex; align-items: center; gap: 6px;
    }
    .dm-pagination li a,
    .dm-pagination li span {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 42px; height: 42px; padding: 0 14px;
        border: 1px solid rgba(0,0,0,0.1); border-radius: 10px;
        font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest);
        color: var(--tp-common-black,#111); background: #fff;
        text-decoration: none; transition: all 0.25s ease;
    }
    .dm-pagination li a:hover {
        background: var(--tp-common-black,#111); color: #fff;
        border-color: var(--tp-common-black,#111);
    }
    .dm-pagination li.active span {
        background: var(--tp-common-black,#111); color: #fff;
        border-color: var(--tp-common-black,#111);
    }
    .dm-pagination li.disabled span { opacity: 0.3; cursor: default; pointer-events: none; }
    .dm-pagination li.dots span {
        border: none; background: transparent; min-width: 28px; padding: 0;
        font-size: 16px; letter-spacing: 2px; color: rgba(0,0,0,0.3);
    }
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

<!-- Careers Grid -->
<div class="dm-careers-grid">
    <div class="container container-1230">
        @php
            $typeClasses = [
                'Full-time' => 'dm-job-type-full-time',
                'Part-time' => 'dm-job-type-part-time',
                'Remote' => 'dm-job-type-remote',
                'Contract' => 'dm-job-type-contract',
            ];
        @endphp

        <div class="row">
            @forelse($careers as $career)
            <div class="col-lg-4 col-md-6">
                <div class="dm-job-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 3) }}" style="margin-bottom:30px;">
                    <span class="dm-job-card-type {{ $typeClasses[$career->type] ?? 'dm-job-type-full-time' }}">{{ $career->type }}</span>
                    <h4 class="dm-job-card-title">
                        <a href="{{ route('career.show', $career->slug) }}">{{ $career->title }}</a>
                    </h4>
                    <div class="dm-job-card-meta">
                        @if($career->location)
                        <span><i class="fa-solid fa-location-dot"></i> {{ $career->location }}</span>
                        @endif
                        <span><i class="fa-solid fa-calendar"></i> {{ $career->published_at?->format('M d, Y') }}</span>
                    </div>
                    <a href="{{ route('career.show', $career->slug) }}" class="dm-job-card-link">
                        View Details
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                            <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="dm-careers-empty tp_fade_anim" data-delay=".3">
                    <i class="fa-solid fa-briefcase"></i>
                    No open positions at the moment. Check back soon!
                </div>
            </div>
            @endforelse
        </div>

        @if($careers->hasPages())
            {{ $careers->links('vendor.pagination.devmantra') }}
        @endif
    </div>
</div>
@endsection
