@extends('layouts.frontend')
@section('title', 'DevMantra - Strategic Financial & Advisory Services')

@push('styles')
<style>
    .cr-blog-area-dark { background: #000; }
    .cr-blog-area-dark .tp-section-subtitle-gradient.ct { color: #fff; }
    .cr-blog-area-dark .tp-section-title-onest { color: #fff !important; }
    .cr-blog-area-dark .cr-blog-item-category { color: #fff; }
    .cr-blog-area-dark .cr-blog-item-title { color: #fff; }
    .cr-blog-area-dark .cr-blog-item-title a { color: #fff; }
    .cr-blog-area-dark .cr-blog-item-meta { color: rgba(255,255,255,0.5); }
    .cr-blog-area-dark .cr-blog-bottom-text { color: #fff; }
    .cr-blog-area-dark .cr-blog-bottom-border { border-bottom-color: rgba(255,255,255,0.07); }
    .cr-blog-area-dark .cr-multi-border { border-color: rgba(255,255,255,0.07); }
    .cr-blog-area-dark .cr-multi-border::after,
    .cr-blog-area-dark .cr-multi-border::before { background-color: rgba(255,255,255,0.07); }
    .cr-cta-area-light { background: #f8f9fa; }
    .cr-cta-area-light .tp-section-title-onest { color: #111 !important; }
    .cr-cta-area-light .cr-cta-text { color: #555; }
    .cr-cta-area-light .cr-cta-btn .tp-btn-white-border,
    .cr-cta-area-light .cr-cta-btn .tp-btn-light-bg {
        color: #fff;
        background-color: #1b3c6b;
        border-color: #1b3c6b;
    }
    .cr-cta-area-light .cr-cta-btn .tp-btn-white-border:hover,
    .cr-cta-area-light .cr-cta-btn .tp-btn-light-bg:hover {
        background-color: #0f2b5c;
        color: #fff;
        border-color: #0f2b5c;
    }
</style>
@endpush

@section('content')

{{-- Dynamic page sections managed via admin --}}
@foreach($pageSections as $section)
    <x-dynamic-component :component="'service-sections.' . $section->section_type" :data="$section->section_data ?? []" />
@endforeach

<!-- cr blog area start -->
<div class="cr-blog-area cr-blog-area-dark">
    <div class="container container-1230">
        <div class="cr-multi-border pt-120">
            <div class="cr-blog-bottom-border">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-blog-heading text-center pb-60">
                            <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Insights</div>
                            <h4 class="tp-section-title-onest fs-72 tp-text-revel-anim">Explore our <br> latest insights &amp; updates</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="cr-blog-item mb-30">
                            <div class="cr-blog-item-thumb">
                                <a href="{{ route('blog.show', $blog->slug) }}">
                                    @if($blog->featured_image)
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}">
                                    @else
                                        <img src="{{ asset('assets/img/home-13/blog/blog-thumb-'.(($loop->index % 3)+1).'.jpg') }}" alt="{{ $blog->title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="cr-blog-item-content">
                                <span class="cr-blog-item-category">{{ $blog->category ?? 'Blog' }}</span>
                                <h4 class="cr-blog-item-title">
                                    <a class="tp-line-white" href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                </h4>
                                <p class="cr-blog-item-meta">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cr-blog-bottom text-center tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                            <a href="{{ route('blog.index') }}" class="cr-blog-bottom-text">Explore more insights from Dev Mantra</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cr blog area end -->

<!-- CTA (light section) -->
<div class="cr-cta-area-light">
    <div class="cr-cta-ptb p-relative pt-120 pb-100">
        <div class="cr-cta-bg">
            <img src="{{ asset('assets/img/home-13/cta/cta-thumb-bg.png') }}" alt="">
        </div>
        <div class="cr-cta-shape">
            <span class="shape-1"></span><span class="shape-2"></span><span class="shape-3"></span>
            <span class="shape-4"></span><span class="shape-5"></span><span class="shape-6"></span>
            <span class="shape-7"></span><span class="shape-8"></span><span class="shape-9"></span>
            <span class="shape-10"></span><span class="shape-11"></span><span class="shape-12"></span>
            <span class="shape-13"></span><span class="shape-14"></span><span class="shape-15"></span>
        </div>
        <div class="container container-1230">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cr-cta-content text-center">
                        <div class="cr-cta-img p-relative mb-20">
                            <img src="{{ asset('assets/img/home-13/cta/cta-thumb.gif') }}" alt="">
                        </div>
                        <h4 class="tp-section-title-onest fs-50 tp-text-revel-anim" style="color: #111;">
                            Ready to Elevate Your <br> Business with Dev Mantra?
                        </h4>
                        <div class="tp_text_anim">
                            <p class="cr-cta-text" style="color: #555;">
                                Dev Mantra is here to help you scale with confidence through future-ready financial, governance, and advisory solutions.
                            </p>
                        </div>
                        <div class="cr-cta-btn tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                            <x-btn-primary />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA end -->

@endsection
