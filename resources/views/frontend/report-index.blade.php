@extends('layouts.frontend')
@section('title', 'Reports - DevMantra')
@section('meta_description', 'Access in-depth reports on industry trends, regulatory analysis, financial insights, and strategic business advisory.')

@push('styles')
<style>
    .dm-report-hero { background-color: #001d30; padding: 200px 0 120px; }
    @media (max-width: 767px) { .dm-report-hero { padding: 150px 0 70px; } }
    .dm-report-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; font-family: var(--tp-ff-onest); }
    .dm-past-editions { padding: 100px 0; }
    @media (max-width: 767px) { .dm-past-editions { padding: 60px 0; } }

    /* Featured Report */
    .dm-report-featured { border-bottom: 1px solid var(--tp-border-1,#eee); padding-bottom: 60px; margin-bottom: 60px; }
    .dm-report-featured-thumb img { width: 100%; height: 380px; object-fit: cover; border-radius: 12px; }
    .dm-report-featured-title { font-size: 32px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 16px; line-height: 1.3; font-family: var(--tp-ff-onest); }
    .dm-report-featured-title a { color: inherit; text-decoration: none; }
    .dm-report-featured-title a:hover { opacity: 0.7; }

    /* Edition Cards */
    .dm-edition-card { margin-bottom: 40px; transition: transform 0.3s; }
    .dm-edition-card:hover { transform: translateY(-4px); }
    .dm-edition-card-thumb img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; }
    .dm-edition-card-date {
        font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        color: rgba(0,0,0,0.4); display: inline-flex; align-items: center; gap: 8px;
        margin: 16px 0 8px; font-family: var(--tp-ff-onest);
    }
    .dm-edition-card-date i { font-size: 12px; color: rgba(0,0,0,0.25); }
    .dm-edition-card-title { font-size: 20px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 12px; line-height: 1.4; font-family: var(--tp-ff-onest); }
    .dm-edition-card-title a { color: inherit; text-decoration: none; transition: opacity 0.3s; }
    .dm-edition-card-title a:hover { opacity: 0.6; }
    .dm-edition-card-excerpt { font-size: 15px; color: rgba(0,0,0,0.55); line-height: 1.6; font-family: var(--tp-ff-onest); margin-bottom: 16px; }
    .dm-edition-card-link {
        font-size: 14px; font-weight: 600; color: var(--tp-common-black,#111);
        text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        font-family: var(--tp-ff-onest); transition: opacity 0.3s;
    }
    .dm-edition-card-link:hover { opacity: 0.6; }
    .dm-edition-card-link i { font-size: 12px; transition: transform 0.3s; }
    .dm-edition-card:hover .dm-edition-card-link i { transform: translateX(3px); }

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
    .dm-pagination li.disabled span {
        opacity: 0.3; cursor: default; pointer-events: none;
    }
    .dm-pagination li.dots span {
        border: none; background: transparent; min-width: 28px; padding: 0;
        font-size: 16px; letter-spacing: 2px; color: rgba(0,0,0,0.3);
    }
    .dm-pagination li a i,
    .dm-pagination li span i { font-size: 12px; }
    @media (max-width: 575px) {
        .dm-pagination li a,
        .dm-pagination li span { min-width: 36px; height: 36px; padding: 0 10px; font-size: 13px; }
        .dm-pagination ul { gap: 4px; }
    }
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="dm-report-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Reports</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    In-Depth Analysis<br>& Research
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-report-hero-desc">Access comprehensive reports on industry trends, regulatory analysis, financial insights, and strategic business advisory.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reports -->
<div class="dm-past-editions">
    <div class="container container-1230">

        @if($featured)
        <!-- Featured Report -->
        <div class="dm-report-featured">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="dm-report-featured-thumb tp_fade_anim" data-delay=".3">
                        <a href="{{ route('report.show', $featured->slug) }}">
                            @if($featured->featured_image)
                                <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-1.jpg') }}" alt="{{ $featured->title }}">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dm-report-featured-content tp_fade_anim" data-delay=".5">
                        <span class="dm-edition-card-date">
                            <i class="fa-regular fa-calendar"></i> Featured
                        </span>
                        <h3 class="dm-report-featured-title">
                            <a href="{{ route('report.show', $featured->slug) }}">{{ $featured->title }}</a>
                        </h3>
                        <p class="dm-edition-card-excerpt">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 160) }}</p>
                        <span class="dm-edition-card-date" style="display:block;margin-bottom:20px;">{{ $featured->published_at?->format('M d, Y') }}</span>
                        <div>
                            <a href="{{ route('report.show', $featured->slug) }}" class="dm-edition-card-link">
                                Read Report
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                    <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="section-label mb-40 tp_fade_anim" data-delay=".3" style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;font-family:var(--tp-ff-onest);color:rgba(0,0,0,0.4);">All Reports</div>

        <!-- Report Cards -->
        <div class="row">
            @forelse($reports as $report)
            <div class="col-lg-4 col-md-6">
                <div class="dm-edition-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 3) }}">
                    <div class="dm-edition-card-thumb">
                        <a href="{{ route('report.show', $report->slug) }}">
                            @if($report->featured_image)
                                <img src="{{ asset('storage/' . $report->featured_image) }}" alt="{{ $report->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $report->title }}">
                            @endif
                        </a>
                    </div>
                    <span class="dm-edition-card-date">
                        <i class="fa-regular fa-calendar"></i>
                        {{ $report->edition_label ?? $report->published_at?->format('F Y') ?? $report->created_at->format('F Y') }}
                    </span>
                    <h4 class="dm-edition-card-title">
                        <a href="{{ route('report.show', $report->slug) }}">{{ $report->title }}</a>
                    </h4>
                    <p class="dm-edition-card-excerpt">{{ $report->excerpt ?? Str::limit(strip_tags($report->content), 140) }}</p>
                    <a href="{{ route('report.show', $report->slug) }}" class="dm-edition-card-link">
                        Read Report <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p style="text-align:center;color:rgba(0,0,0,0.4);padding:60px 0;font-family:var(--tp-ff-onest);">No reports published yet. Check back soon.</p>
            </div>
            @endforelse
        </div>

        @if($reports->hasPages())
            {{ $reports->links('vendor.pagination.devmantra') }}
        @endif
    </div>
</div>
@endsection
