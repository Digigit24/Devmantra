@extends('layouts.frontend')
@section('title', 'Newsletter - DevMantra')
@section('meta_description', 'Get the latest on corporate governance, regulatory changes, tax alerts, and strategic business advisory.')

@push('styles')
<style>
    .dm-newsletter-hero { background-color: #001d30; padding: 200px 0 120px; }
    @media (max-width: 767px) { .dm-newsletter-hero { padding: 150px 0 70px; } }
    .dm-newsletter-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; font-family: var(--tp-ff-onest); }
    .dm-past-editions { padding: 100px 0; }
    @media (max-width: 767px) { .dm-past-editions { padding: 60px 0; } }
    .dm-edition-card { margin-bottom: 40px; transition: transform 0.3s; }
    .dm-edition-card:hover { transform: translateY(-4px); }
    .dm-edition-card-date {
        font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;
        color: rgba(0,0,0,0.4); display: inline-flex; align-items: center; gap: 8px;
        margin-bottom: 12px; font-family: var(--tp-ff-onest);
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

    /* ── Pagination ── */
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
<div class="dm-newsletter-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Newsletter</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Stay Ahead with<br>Expert Insights
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-newsletter-hero-desc">Get the latest on corporate governance, regulatory changes, tax alerts, and strategic business advisory delivered to your inbox.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Editions -->
<div class="dm-past-editions">
    <div class="container container-1230">
        <div class="section-label mb-40 tp_fade_anim" data-delay=".3" style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;font-family:var(--tp-ff-onest);color:rgba(0,0,0,0.4);">All Editions</div>
        <div class="row">
            @forelse($newsletters as $newsletter)
            <div class="col-lg-4 col-md-6">
                <div class="dm-edition-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 3) }}">
                    <span class="dm-edition-card-date">
                        <i class="fa-regular fa-calendar"></i>
                        {{ $newsletter->edition_label ?? $newsletter->published_at?->format('F Y') ?? $newsletter->created_at->format('F Y') }}
                    </span>
                    <h4 class="dm-edition-card-title">
                        <a href="{{ route('newsletter.show', $newsletter->slug) }}">{{ $newsletter->title }}</a>
                    </h4>
                    <p class="dm-edition-card-excerpt">{{ $newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 140) }}</p>
                    <a href="{{ route('newsletter.show', $newsletter->slug) }}" class="dm-edition-card-link">
                        Read Edition <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p style="text-align:center;color:rgba(0,0,0,0.4);padding:60px 0;font-family:var(--tp-ff-onest);">No newsletters published yet. Check back soon.</p>
            </div>
            @endforelse
        </div>

        @if($newsletters->hasPages())
            {{ $newsletters->links('vendor.pagination.devmantra') }}
        @endif
    </div>
</div>
@endsection
