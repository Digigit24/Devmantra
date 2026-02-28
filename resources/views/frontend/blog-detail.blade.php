@extends('layouts.frontend')
@section('title', $blog->title . ' - DevMantra')
@section('meta_description', $blog->meta_description ?? $blog->excerpt ?? Str::limit(strip_tags($blog->content), 160))

@push('styles')
<style>
    .dm-article-hero { background-color: #000; padding: 200px 0 100px; }
    .dm-article-meta { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; }
    .dm-article-meta-tag { font-size: 13px; font-weight: 600; border: 1px solid rgba(255,255,255,0.2); padding: 6px 16px; border-radius: 20px; color: #fff; }
    .dm-article-meta-item { font-size: 14px; color: rgba(255,255,255,0.5); }
    .dm-article-hero-title { font-size: 48px; font-weight: 600; color: #fff; line-height: 1.25; }
    .dm-article-body { padding: 80px 0; }
    .dm-article-featured-img { margin-bottom: 48px; }
    .dm-article-featured-img img { width: 100%; height: auto; border-radius: 16px; }
    .dm-article-content { max-width: 740px; margin: 0 auto; }
    .dm-article-content p { font-size: 17px; line-height: 1.8; margin-bottom: 28px; color: #333; }
    .dm-article-content h3 { font-size: 28px; font-weight: 600; margin-top: 48px; margin-bottom: 20px; }
    .dm-article-content h4 { font-size: 22px; font-weight: 600; margin-top: 36px; margin-bottom: 16px; }
    .dm-article-content ul { padding-left: 24px; margin-bottom: 28px; }
    .dm-article-content ul li { font-size: 17px; line-height: 1.8; margin-bottom: 8px; }
    .dm-article-footer { max-width: 740px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding-top: 32px; border-top: 1px solid var(--tp-border-1,#eee); }
    .dm-article-tags { display: flex; gap: 8px; flex-wrap: wrap; }
    .dm-article-tags a { font-size: 13px; padding: 6px 16px; border: 1px solid var(--tp-border-1,#eee); border-radius: 20px; color: inherit; text-decoration: none; }
    .dm-article-tags a:hover { background: var(--tp-common-black,#111); color: #fff; }
    .dm-related-posts { padding: 80px 0; background: #f8f9fb; }
    .dm-related-posts-title { font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 40px; }
    .dm-related-card { margin-bottom: 30px; transition: transform 0.3s; }
    .dm-related-card:hover { transform: translateY(-4px); }
    .dm-related-card-thumb img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; }
    .dm-related-card-category { display: inline-block; font-size: 13px; font-weight: 600; text-transform: uppercase; margin: 16px 0 8px; color: rgba(0,0,0,0.4); }
    .dm-related-card-title { font-size: 18px; font-weight: 600; line-height: 1.4; }
    .dm-related-card-title a { color: inherit; text-decoration: none; }
    .dm-related-card-title a:hover { opacity: 0.6; }
    @media (max-width: 767px) {
        .dm-article-hero-title { font-size: 32px; }
        .dm-article-hero { padding: 160px 0 80px; }
    }
</style>
@endpush

@section('content')
<!-- Article Hero -->
<div class="dm-article-hero">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-meta tp_fade_anim" data-delay=".3">
                    <span class="dm-article-meta-tag">{{ $blog->category }}</span>
                    <span class="dm-article-meta-item">{{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}</span>
                    @if($blog->read_time)
                    <span class="dm-article-meta-item">{{ $blog->read_time }}</span>
                    @endif
                </div>
                <h1 class="dm-article-hero-title tp-text-revel-anim" data-delay=".5">{{ $blog->title }}</h1>
            </div>
        </div>
    </div>
</div>

<!-- Article Body -->
<div class="dm-article-body">
    <div class="container container-1230">
        @if($blog->featured_image)
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-featured-img tp_fade_anim" data-delay=".3">
                    <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                </div>
            </div>
        </div>
        @endif

        <div class="dm-article-content tp_fade_anim" data-delay=".5">
            {!! $blog->content !!}
        </div>

        <div class="dm-article-footer">
            <div class="dm-article-tags">
                <a href="{{ route('blog.index') }}">{{ $blog->category }}</a>
            </div>
        </div>
    </div>
</div>

<!-- Related Posts -->
@if($related->count())
<div class="dm-related-posts">
    <div class="container container-1230">
        <div class="dm-related-posts-title tp_fade_anim" data-delay=".3">Related Articles</div>
        <div class="row">
            @foreach($related as $post)
            <div class="col-lg-4 col-md-6">
                <div class="dm-related-card tp_fade_anim" data-delay=".{{ 3 + $loop->index }}">
                    <div class="dm-related-card-thumb">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $post->title }}">
                            @endif
                        </a>
                    </div>
                    <span class="dm-related-card-category">{{ $post->category }}</span>
                    <h4 class="dm-related-card-title">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
