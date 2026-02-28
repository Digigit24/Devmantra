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
</style>
@endpush

@section('content')

{{-- ===== DYNAMIC SERVICE SLIDER ===== --}}
@if($services->count())
<section class="dm-hscroll-section">
    <div class="dm-hscroll-pin">
        <div class="dm-hscroll-header">
            <h2 class="dm-hscroll-title">What We Do</h2>
            <p class="dm-hscroll-subtitle">Comprehensive financial and advisory services tailored for your business growth.</p>
        </div>

        <!-- Desktop: horizontal scroll -->
        <div class="dm-hscroll-track dm-hscroll-desktop">
            <div class="dm-hscroll-cards">
                @foreach($services as $service)
                <div class="dm-hscroll-card">
                    <div class="dm-hscroll-card-img">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                        @else
                            <img src="{{ asset('assets/img/home-13/feature/feature-thumb-1.png') }}" alt="{{ $service->title }}">
                        @endif
                    </div>
                    <div class="dm-hscroll-card-body">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->short_description ?? Str::limit(strip_tags($service->content), 120) }}</p>
                        <a href="{{ route('service.show', $service->slug) }}" class="dm-hscroll-btn">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Mobile: Swiper slider -->
        <div class="dm-hscroll-mobile">
            <div class="swiper dm-services-swiper">
                <div class="swiper-wrapper">
                    @foreach($services as $service)
                    <div class="swiper-slide">
                        <div class="dm-hscroll-card">
                            <div class="dm-hscroll-card-img">
                                @if($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img src="{{ asset('assets/img/home-13/feature/feature-thumb-1.png') }}" alt="{{ $service->title }}">
                                @endif
                            </div>
                            <div class="dm-hscroll-card-body">
                                <h3>{{ $service->title }}</h3>
                                <p>{{ $service->short_description ?? Str::limit(strip_tags($service->content), 120) }}</p>
                                <a href="{{ route('service.show', $service->slug) }}" class="dm-hscroll-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination dm-services-pagination"></div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ===== DYNAMIC BLOG SECTION ===== --}}
@if($blogs->count())
<div class="cr-blog-area cr-blog-area-dark">
    <div class="container container-1230">
        <div class="cr-multi-border pt-120">
            <div class="cr-blog-bottom-border">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cr-blog-heading text-center pb-60">
                            <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Insights</div>
                            <h4 class="tp-section-title-onest fs-72 tp-text-revel-anim">Explore our <br> latest insights & updates</h4>
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
                                        <img src="{{ asset('assets/img/home-13/blog/blog-thumb-1.jpg') }}" alt="{{ $blog->title }}">
                                    @endif
                                </a>
                            </div>
                            <div class="cr-blog-item-content">
                                <span class="cr-blog-item-category">{{ $blog->category }}</span>
                                <h4 class="cr-blog-item-title">
                                    <a class="tp-line-white" href="{{ route('blog.show', $blog->slug) }}">
                                        {{ $blog->title }}
                                    </a>
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
@endif

@endsection

@push('scripts')
<script>
    new Swiper(".dm-services-swiper", {
        slidesPerView: 1.2,
        spaceBetween: 20,
        pagination: { el: ".dm-services-pagination" }
    });
</script>
@endpush
