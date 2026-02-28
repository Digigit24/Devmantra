@extends('layouts.frontend')
@section('title', $newsletter->title . ' - DevMantra')
@section('meta_description', $newsletter->meta_description ?? $newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 160))
@section('og_type', 'article')
@if($newsletter->featured_image)
@section('og_image', asset('storage/' . $newsletter->featured_image))
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

    /* Article content */
    .dm-article-body { padding: 80px 0 100px; }
    @media (max-width: 767px) { .dm-article-body { padding: 50px 0 60px; } }

    .dm-article-featured-img {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 60px;
    }
    .dm-article-featured-img img {
        width: 100%;
        height: auto;
        display: block;
    }

    .dm-article-content {
        max-width: 740px;
        margin: 0 auto;
    }
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

    .dm-article-content blockquote {
        border-left: 3px solid var(--tp-common-black);
        padding: 24px 0 24px 32px;
        margin: 40px 0;
    }
    .dm-article-content blockquote p {
        font-size: 20px;
        font-weight: 500;
        color: var(--tp-common-black);
        line-height: 1.6;
        margin-bottom: 8px;
        font-style: italic;
    }

    /* Footer tags & share */
    .dm-article-footer {
        max-width: 740px;
        margin: 0 auto;
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
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="dm-article-hero">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-meta tp_fade_anim" data-delay=".3">
                    <span class="dm-article-meta-tag">Newsletter</span>
                    @if($newsletter->edition_label)
                    <span class="dm-article-meta-item">{{ $newsletter->edition_label }}</span>
                    @endif
                    <span class="dm-article-meta-item">{{ $newsletter->published_at?->format('M d, Y') ?? $newsletter->created_at->format('M d, Y') }}</span>
                </div>
                <h1 class="dm-article-hero-title tp-text-revel-anim" data-delay=".5">{{ $newsletter->title }}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Body -->
<div class="dm-article-body">
    <div class="container container-1230">
        @if($newsletter->featured_image)
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-featured-img tp_fade_anim" data-delay=".3">
                    <img src="{{ asset('storage/' . $newsletter->featured_image) }}" alt="{{ $newsletter->title }}">
                </div>
            </div>
        </div>
        @endif

        <div class="dm-article-content tp_fade_anim" data-delay=".5">
            {!! $newsletter->content !!}
        </div>

        <!-- Footer -->
        <div class="dm-article-footer">
            <div class="dm-article-tags">
                <a href="{{ route('newsletter.index') }}">Newsletter</a>
                @if($newsletter->edition_label)
                <a href="{{ route('newsletter.index') }}">{{ $newsletter->edition_label }}</a>
                @endif
            </div>
            <div class="dm-article-share">
                <span>Share</span>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($newsletter->title) }}" target="_blank" rel="noopener" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
