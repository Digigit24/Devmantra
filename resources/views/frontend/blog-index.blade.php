@extends('layouts.frontend')
@section('title', 'Blog - DevMantra')
@section('meta_description', 'Stay ahead with expert perspectives on corporate governance, financial strategy, and business growth.')

@push('styles')
<style>
    .dm-blog-hero { background-color: #001d30; padding: 200px 0 120px; }
    .dm-blog-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; }
    .dm-blog-grid { padding: 100px 0 80px; }
    .dm-blog-featured { border-bottom: 1px solid var(--tp-border-1,#eee); padding-bottom: 60px; margin-bottom: 60px; }
    .dm-blog-featured-thumb img { width: 100%; height: 380px; object-fit: cover; border-radius: 12px; }
    .dm-blog-featured-title { font-size: 32px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 16px; line-height: 1.3; }
    .dm-blog-featured-title a { color: inherit; text-decoration: none; }
    .dm-blog-featured-title a:hover { opacity: 0.7; }
    .dm-blog-card { margin-bottom: 40px; }
    .dm-blog-card-thumb img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; }
    .dm-blog-card-category { display: inline-block; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 8px; color: rgba(0,0,0,0.4); }
    .dm-blog-card-title { font-size: 20px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 10px; line-height: 1.4; }
    .dm-blog-card-title a { color: inherit; text-decoration: none; }
    .dm-blog-card-title a:hover { opacity: 0.6; }
    .dm-blog-card-excerpt { font-size: 15px; color: rgba(0,0,0,0.55); line-height: 1.6; margin-bottom: 10px; }
    .dm-blog-card-meta { font-size: 14px; color: rgba(0,0,0,0.35); }
    .dm-blog-card-link { font-size: 14px; font-weight: 600; color: var(--tp-common-black,#111); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .dm-blog-card-link:hover { opacity: 0.6; }
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="dm-blog-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Insights</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Explore Our Latest<br>Insights & Updates
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-blog-hero-desc">Stay ahead with expert perspectives on corporate governance, financial strategy, regulatory compliance, and business growth.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Blog Grid -->
<div class="dm-blog-grid">
    <div class="container container-1230">

        @if($featured)
        <!-- Featured Post -->
        <div class="dm-blog-featured">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="dm-blog-featured-thumb tp_fade_anim" data-delay=".3">
                        <a href="{{ route('blog.show', $featured->slug) }}">
                            @if($featured->featured_image)
                                <img src="{{ asset('storage/' . $featured->featured_image) }}" alt="{{ $featured->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-1.jpg') }}" alt="{{ $featured->title }}">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dm-blog-featured-content tp_fade_anim" data-delay=".5">
                        <span class="dm-blog-card-category">Featured</span>
                        <h3 class="dm-blog-featured-title">
                            <a href="{{ route('blog.show', $featured->slug) }}">{{ $featured->title }}</a>
                        </h3>
                        <p class="dm-blog-card-excerpt">{{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 160) }}</p>
                        <span class="dm-blog-card-meta mb-20" style="display:block;">{{ $featured->published_at?->format('M d, Y') }}</span>
                        <div>
                            <a href="{{ route('blog.show', $featured->slug) }}" class="dm-blog-card-link">
                                Read Article
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

        <!-- Blog Cards -->
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="dm-blog-card tp_fade_anim" data-delay=".{{ 3 + $loop->index }}">
                    <div class="dm-blog-card-thumb">
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            @if($blog->featured_image)
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $blog->title }}">
                            @endif
                        </a>
                    </div>
                    <span class="dm-blog-card-category">{{ $blog->category }}</span>
                    <h4 class="dm-blog-card-title">
                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                    </h4>
                    <p class="dm-blog-card-excerpt">{{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 120) }}</p>
                    <span class="dm-blog-card-meta">{{ $blog->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>

        @if($blogs->hasPages())
        <div class="d-flex justify-content-center pt-40">
            {{ $blogs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
