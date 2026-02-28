@extends('layouts.frontend')
@section('title', $service->title . ' - DevMantra')
@section('meta_description', $service->meta_description ?? $service->short_description ?? Str::limit(strip_tags($service->content), 160))
@if($service->featured_image)
@section('og_image', asset('storage/' . $service->featured_image))
@elseif($service->hero_image)
@section('og_image', asset('storage/' . $service->hero_image))
@elseif($service->image)
@section('og_image', asset('storage/' . $service->image))
@endif

@push('styles')
<style>
    .dm-article-hero {
        background-color: #000;
        padding: 200px 0 100px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 767px) { .dm-article-hero { padding: 150px 0 70px; } }

    .dm-article-meta {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }
    .dm-article-meta-item {
        font-size: 14px;
        color: rgba(255,255,255,0.5);
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-meta-tag {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #fff;
        padding: 6px 16px;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
    }
    .dm-article-hero-title {
        font-size: 48px;
        font-weight: 600;
        color: #fff;
        line-height: 1.25;
        max-width: 800px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 991px) { .dm-article-hero-title { font-size: 36px; } }
    @media (max-width: 767px) { .dm-article-hero-title { font-size: 28px; } }

    /* Featured image - full width below hero */
    .dm-article-featured-section {
        margin-top: -40px;
        position: relative;
        z-index: 2;
        padding-bottom: 60px;
    }
    .dm-article-featured-img {
        border-radius: 16px;
        overflow: hidden;
    }
    .dm-article-featured-img img {
        width: 100%;
        height: 480px;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 767px) {
        .dm-article-featured-img img { height: 260px; }
        .dm-article-featured-section { margin-top: -20px; padding-bottom: 40px; }
    }

    /* Article body - 2 column layout */
    .dm-article-body { padding: 0 0 100px; }
    @media (max-width: 767px) { .dm-article-body { padding: 0 0 60px; } }

    /* Content column */
    .dm-article-content p {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.7);
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content h3 {
        font-size: 28px;
        font-weight: 600;
        color: var(--tp-common-black);
        margin-top: 48px;
        margin-bottom: 20px;
        font-family: var(--tp-ff-onest);
        line-height: 1.35;
    }
    .dm-article-content h4 {
        font-size: 22px;
        font-weight: 600;
        color: var(--tp-common-black);
        margin-top: 36px;
        margin-bottom: 16px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content ul {
        padding-left: 0;
        margin-bottom: 28px;
        list-style: none;
    }
    .dm-article-content ul li {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.7);
        padding-left: 24px;
        position: relative;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 12px;
        width: 6px;
        height: 6px;
        background: var(--tp-common-black);
        border-radius: 50%;
    }

    .dm-article-content blockquote,
    .dm-article-quote {
        border-left: 3px solid var(--tp-common-black);
        padding: 24px 0 24px 32px;
        margin: 40px 0;
    }
    .dm-article-content blockquote p,
    .dm-article-quote p {
        font-size: 20px;
        font-weight: 500;
        color: var(--tp-common-black);
        line-height: 1.6;
        margin-bottom: 8px;
        font-style: italic;
    }
    .dm-article-content blockquote cite,
    .dm-article-quote cite {
        font-size: 14px;
        color: rgba(0,0,0,0.5);
        font-style: normal;
        font-weight: 600;
    }

    .dm-article-inline-img {
        margin: 40px 0;
        border-radius: 12px;
        overflow: hidden;
    }
    .dm-article-inline-img img {
        width: 100%;
        height: auto;
    }

    /* Tags & share */
    .dm-article-footer {
        padding-top: 40px;
        border-top: 1px solid var(--tp-border-1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .dm-article-tags { display: flex; gap: 8px; flex-wrap: wrap; }
    .dm-article-tags a {
        font-size: 13px;
        font-weight: 500;
        color: var(--tp-common-black);
        padding: 6px 16px;
        border: 1px solid var(--tp-border-1);
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-tags a:hover {
        background: var(--tp-common-black);
        color: #fff;
        border-color: var(--tp-common-black);
    }

    .dm-article-share {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .dm-article-share span {
        font-size: 14px;
        font-weight: 600;
        color: rgba(0,0,0,0.4);
        font-family: var(--tp-ff-onest);
    }
    .dm-article-share a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--tp-border-1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--tp-common-black);
        text-decoration: none;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .dm-article-share a:hover {
        background: var(--tp-common-black);
        color: #fff;
        border-color: var(--tp-common-black);
    }

    /* ── Sticky sidebar ── */
    .dm-sidebar {
        position: sticky;
        top: 120px;
        padding-left: 40px;
    }
    @media (max-width: 991px) { .dm-sidebar { padding-left: 0; margin-top: 60px; position: static; } }

    .dm-sidebar-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    .dm-sidebar-post {
        display: flex;
        gap: 16px;
        padding: 20px 0;
        border-bottom: 1px solid var(--tp-border-1);
        transition: all 0.3s ease;
    }
    .dm-sidebar-post:first-of-type {
        border-top: 1px solid var(--tp-border-1);
    }
    .dm-sidebar-post:hover {
        padding-left: 6px;
    }
    .dm-sidebar-post-thumb {
        width: 72px;
        height: 72px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .dm-sidebar-post-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .dm-sidebar-post:hover .dm-sidebar-post-thumb img {
        transform: scale(1.06);
    }
    .dm-sidebar-post-info {
        flex: 1;
        min-width: 0;
    }
    .dm-sidebar-post-category {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 6px;
        display: block;
        font-family: var(--tp-ff-onest);
    }
    .dm-sidebar-post-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--tp-common-black);
        line-height: 1.45;
        font-family: var(--tp-ff-onest);
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .dm-sidebar-post-title a {
        color: inherit;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .dm-sidebar-post-title a:hover { opacity: 0.6; }

    .dm-sidebar-post-date {
        font-size: 12px;
        color: rgba(0,0,0,0.35);
        margin-top: 4px;
        font-family: var(--tp-ff-onest);
    }

    /* Related posts (bottom section) */
    .dm-related-posts {
        padding: 80px 0;
        border-top: 1px solid var(--tp-border-1);
    }
    .dm-related-posts-title {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.4);
        margin-bottom: 40px;
        font-family: var(--tp-ff-onest);
    }

    .dm-related-card {
        margin-bottom: 30px;
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .dm-related-card:hover { transform: translateY(-4px); }
    .dm-related-card-thumb {
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .dm-related-card-thumb img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .dm-related-card:hover .dm-related-card-thumb img { transform: scale(1.04); }
    .dm-related-card-category {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.4);
        margin-bottom: 8px;
        display: block;
        font-family: var(--tp-ff-onest);
    }
    .dm-related-card-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--tp-common-black);
        line-height: 1.4;
        font-family: var(--tp-ff-onest);
    }
    .dm-related-card-title a {
        color: inherit;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .dm-related-card-title a:hover { opacity: 0.6; }
</style>
@endpush

@section('content')
<!-- Article Hero -->
<div class="dm-article-hero">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-meta tp_fade_anim" data-delay=".3">
                    <span class="dm-article-meta-tag">Service</span>
                    @if($service->short_description)
                    <span class="dm-article-meta-item">{{ Str::limit($service->short_description, 80) }}</span>
                    @endif
                </div>
                <h1 class="dm-article-hero-title tp-text-revel-anim" data-delay=".5">{{ $service->title }}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Featured Image - Full Width -->
@if($service->featured_image || $service->hero_image || $service->image)
<div class="dm-article-featured-section">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-featured-img tp_fade_anim" data-delay=".3">
                    <img src="{{ asset('storage/' . ($service->featured_image ?? $service->hero_image ?? $service->image)) }}" alt="{{ $service->title }}">
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Article Body + Sidebar -->
<div class="dm-article-body">
    <div class="container container-1230">
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-8">
                <div class="dm-article-content tp_fade_anim" data-delay=".5">
                    {!! $service->content !!}
                </div>

                <!-- Article Footer -->
                <div class="dm-article-footer">
                    <div class="dm-article-tags">
                        <a href="{{ route('home') }}#services">Service</a>
                    </div>
                    <div class="dm-article-share">
                        <span>Share</span>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($service->title) }}" target="_blank" rel="noopener" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div class="col-lg-4">
                <div class="dm-sidebar">
                    <div class="dm-sidebar-label">Other Services</div>
                    @foreach($sidebarServices as $sideService)
                    <div class="dm-sidebar-post">
                        <div class="dm-sidebar-post-thumb">
                            @if($sideService->image)
                                <a href="{{ route('service.show', $sideService->slug) }}">
                                    <img src="{{ asset('storage/' . $sideService->image) }}" alt="{{ $sideService->title }}">
                                </a>
                            @elseif($sideService->hero_image)
                                <a href="{{ route('service.show', $sideService->slug) }}">
                                    <img src="{{ asset('storage/' . $sideService->hero_image) }}" alt="{{ $sideService->title }}">
                                </a>
                            @else
                                <a href="{{ route('service.show', $sideService->slug) }}">
                                    <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $sideService->title }}">
                                </a>
                            @endif
                        </div>
                        <div class="dm-sidebar-post-info">
                            <span class="dm-sidebar-post-category">Service</span>
                            <h5 class="dm-sidebar-post-title">
                                <a href="{{ route('service.show', $sideService->slug) }}">{{ $sideService->title }}</a>
                            </h5>
                            @if($sideService->short_description)
                            <div class="dm-sidebar-post-date">{{ Str::limit($sideService->short_description, 50) }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Services -->
@if($related->count())
<div class="dm-related-posts">
    <div class="container container-1230">
        <div class="dm-related-posts-title tp_fade_anim" data-delay=".3">Other Services</div>
        <div class="row">
            @foreach($related as $relService)
            <div class="col-lg-4 col-md-6">
                <div class="dm-related-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index * 2) }}">
                    <div class="dm-related-card-thumb">
                        <a href="{{ route('service.show', $relService->slug) }}">
                            @if($relService->image)
                                <img src="{{ asset('storage/' . $relService->image) }}" alt="{{ $relService->title }}">
                            @elseif($relService->hero_image)
                                <img src="{{ asset('storage/' . $relService->hero_image) }}" alt="{{ $relService->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $relService->title }}">
                            @endif
                        </a>
                    </div>
                    <span class="dm-related-card-category">Service</span>
                    <h4 class="dm-related-card-title">
                        <a href="{{ route('service.show', $relService->slug) }}">{{ $relService->title }}</a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
