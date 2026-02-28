@extends('layouts.frontend')
@section('title', $newsletter->title . ' - DevMantra')
@section('meta_description', $newsletter->meta_description ?? $newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 160))
@section('og_type', 'article')
@if($newsletter->featured_image)
@section('og_image', asset('storage/' . $newsletter->featured_image))
@endif

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
    @media (max-width: 767px) {
        .dm-article-hero-title { font-size: 32px; }
        .dm-article-hero { padding: 160px 0 80px; }
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
    </div>
</div>
@endsection
