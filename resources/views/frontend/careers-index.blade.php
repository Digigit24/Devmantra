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

    /* Type Block */
    .dm-type-block { margin-bottom: 64px; }
    .dm-type-block:last-child { margin-bottom: 0; }
    .dm-type-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0,0,0,0.08);
    }
    .dm-type-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #001d30;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        flex-shrink: 0;
    }
    .dm-type-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--tp-common-black,#111);
        font-family: var(--tp-ff-onest);
        margin: 0;
    }
    .dm-type-count {
        font-size: 13px;
        font-weight: 600;
        color: rgba(0,0,0,0.4);
        background: rgba(0,0,0,0.05);
        padding: 4px 12px;
        border-radius: 20px;
        font-family: var(--tp-ff-onest);
    }

    /* Job Card */
    .dm-job-card {
        background: #fff !important;
        border: 1px solid rgba(0,0,0,0.06) !important;
        border-radius: 14px;
        padding: 28px 32px;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        text-decoration: none !important;
        cursor: pointer;
    }
    .dm-job-card:hover {
        border-color: rgba(0,0,0,0.15) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }
    .dm-job-card-title {
        font-size: 19px;
        font-weight: 600;
        color: var(--tp-common-black,#111);
        margin-bottom: 8px;
        line-height: 1.3;
        font-family: var(--tp-ff-onest);
    }
    .dm-job-card-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .dm-job-card-meta span {
        font-size: 13px;
        color: rgba(0,0,0,0.45);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-family: var(--tp-ff-onest);
    }
    .dm-job-card-type {
        font-size: 12px;
        font-weight: 600;
        padding: 5px 14px;
        border-radius: 8px;
        font-family: var(--tp-ff-onest);
        white-space: nowrap;
    }
    .dm-job-type-full-time { background: rgba(34,197,94,0.1); color: #16a34a; }
    .dm-job-type-part-time { background: rgba(59,130,246,0.1); color: #2563eb; }
    .dm-job-type-remote { background: rgba(139,92,246,0.1); color: #7c3aed; }
    .dm-job-type-contract { background: rgba(245,158,11,0.1); color: #d97706; }

    .dm-job-card-arrow {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.1) !important;
        background: transparent !important;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.3s ease;
        color: #111;
    }
    .dm-job-card:hover .dm-job-card-arrow {
        background: #001d30 !important;
        color: #fff;
        border-color: #001d30 !important;
    }

    /* Stats bar */
    .dm-careers-stats {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
        margin-bottom: 60px;
        padding: 32px 36px;
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 16px;
    }
    .dm-careers-stat { text-align: center; }
    .dm-careers-stat-value {
        font-size: 32px;
        font-weight: 700;
        color: var(--tp-common-black,#111);
        font-family: var(--tp-ff-onest);
        line-height: 1;
    }
    .dm-careers-stat-label {
        font-size: 13px;
        color: rgba(0,0,0,0.45);
        margin-top: 6px;
        font-family: var(--tp-ff-onest);
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

        @if($careers->count())
            @php
                $totalJobs = $careers->flatten()->count();
                $typeIcons = [
                    'Full-time' => 'fa-solid fa-building',
                    'Part-time' => 'fa-solid fa-clock',
                    'Remote' => 'fa-solid fa-wifi',
                    'Contract' => 'fa-solid fa-file-signature',
                ];
                $typeClasses = [
                    'Full-time' => 'dm-job-type-full-time',
                    'Part-time' => 'dm-job-type-part-time',
                    'Remote' => 'dm-job-type-remote',
                    'Contract' => 'dm-job-type-contract',
                ];
            @endphp

            <!-- Stats -->
            <div class="dm-careers-stats tp_fade_anim" data-delay=".3">
                <div class="dm-careers-stat">
                    <div class="dm-careers-stat-value">{{ $totalJobs }}</div>
                    <div class="dm-careers-stat-label">Open Positions</div>
                </div>
                @foreach($careers as $type => $jobs)
                <div class="dm-careers-stat">
                    <div class="dm-careers-stat-value">{{ $jobs->count() }}</div>
                    <div class="dm-careers-stat-label">{{ $type }}</div>
                </div>
                @endforeach
            </div>

            <!-- Type Blocks -->
            @foreach($careers as $type => $jobs)
            <div class="dm-type-block">
                <div class="dm-type-header tp_fade_anim" data-delay=".3">
                    <div class="dm-type-icon">
                        <i class="{{ $typeIcons[$type] ?? 'fa-solid fa-briefcase' }}"></i>
                    </div>
                    <h3 class="dm-type-title">{{ $type }}</h3>
                    <span class="dm-type-count">{{ $jobs->count() }} {{ Str::plural('position', $jobs->count()) }}</span>
                </div>

                @foreach($jobs as $career)
                <a href="{{ route('career.show', $career->slug) }}" class="dm-job-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 4) }}">
                    <div>
                        <h4 class="dm-job-card-title">{{ $career->title }}</h4>
                        <div class="dm-job-card-meta">
                            @if($career->location)
                            <span><i class="fa-solid fa-location-dot"></i> {{ $career->location }}</span>
                            @endif
                            <span><i class="fa-solid fa-calendar"></i> {{ $career->published_at?->format('M d, Y') }}</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="dm-job-card-type {{ $typeClasses[$type] ?? 'dm-job-type-full-time' }}">{{ $type }}</span>
                        <div class="dm-job-card-arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="10" viewBox="0 0 15 12" fill="none">
                                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                            </svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endforeach

        @else
            <div class="dm-careers-empty tp_fade_anim" data-delay=".3">
                <i class="fa-solid fa-briefcase"></i>
                No open positions at the moment. Check back soon!
            </div>
        @endif
    </div>
</div>
@endsection
