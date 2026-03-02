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
    .dm-article-body .row { align-items: flex-start; }
    .dm-sidebar {
        position: sticky;
        top: 120px;
        padding-left: 40px;
        max-height: calc(100vh - 140px);
        overflow-y: auto;
    }
    .dm-sidebar::-webkit-scrollbar { width: 0; background: transparent; }
    @media (max-width: 991px) { .dm-sidebar { padding-left: 0; margin-top: 60px; position: static; max-height: none; } }

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

    /* ── CTA Section ── */
    .dm-service-cta { padding: 100px 0; background: #fafafa; }
    @media (max-width: 767px) { .dm-service-cta { padding: 60px 0; } }

    /* ── Consultation Modal ── */
    .dm-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .dm-modal-overlay.active {
        display: flex;
        opacity: 1;
    }
    .dm-modal {
        background: #fff;
        border-radius: 20px;
        width: 100%;
        max-width: 580px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 48px;
        position: relative;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }
    .dm-modal-overlay.active .dm-modal { transform: translateY(0); }
    @media (max-width: 767px) { .dm-modal { padding: 28px; } }
    .dm-modal::-webkit-scrollbar { width: 4px; }
    .dm-modal::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 4px; }
    .dm-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.1);
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        color: #111;
        transition: all 0.3s ease;
        z-index: 1;
    }
    .dm-modal-close:hover {
        background: #111;
        color: #fff;
        border-color: #111;
    }
    .dm-modal-title {
        font-size: 28px;
        font-weight: 600;
        color: #111;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal-desc {
        font-size: 15px;
        color: rgba(0,0,0,0.5);
        margin-bottom: 32px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal .dm-cf-group { margin-bottom: 20px; }
    .dm-modal .dm-cf-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #111;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal .dm-cf-input,
    .dm-modal .dm-cf-select,
    .dm-modal .dm-cf-textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        font-size: 15px;
        color: #111;
        background: #fafafa;
        font-family: var(--tp-ff-onest);
        transition: border-color 0.3s ease;
        outline: none;
    }
    .dm-modal .dm-cf-input:focus,
    .dm-modal .dm-cf-select:focus,
    .dm-modal .dm-cf-textarea:focus {
        border-color: #111;
        background: #fff;
    }
    .dm-modal .dm-cf-input::placeholder,
    .dm-modal .dm-cf-textarea::placeholder {
        color: rgba(0,0,0,0.3);
    }
    .dm-modal .dm-cf-textarea { min-height: 120px; resize: vertical; }
    .dm-modal .dm-cf-submit {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: #000;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
        width: 100%;
        justify-content: center;
    }
    .dm-modal .dm-cf-submit:hover {
        background: #222;
        transform: translateY(-2px);
    }
    .dm-modal .dm-cf-error {
        font-size: 13px;
        color: #dc2626;
        margin-top: 6px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal .dm-cf-success {
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.2);
        color: #16a34a;
        padding: 16px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 24px;
        font-family: var(--tp-ff-onest);
        display: flex;
        align-items: center;
        gap: 10px;
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

<!-- CTA Section -->
<div class="dm-service-cta">
    <div class="cr-cta-ptb p-relative pt-120 pb-100">
        <div class="cr-cta-bg">
            <img src="{{ asset('assets/img/home-13/cta/cta-thumb-bg.png') }}" alt="">
        </div>
        <div class="cr-cta-shape">
            <span class="shape-1"></span>
            <span class="shape-2"></span>
            <span class="shape-3"></span>
            <span class="shape-4"></span>
            <span class="shape-5"></span>
            <span class="shape-6"></span>
            <span class="shape-7"></span>
            <span class="shape-8"></span>
            <span class="shape-9"></span>
            <span class="shape-10"></span>
            <span class="shape-11"></span>
            <span class="shape-12"></span>
            <span class="shape-13"></span>
            <span class="shape-14"></span>
            <span class="shape-15"></span>
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
                                Dev Mantra is here to help you scale with confidence through
                                future-ready financial, governance, and advisory solutions.
                            </p>
                        </div>
                        <div class="cr-cta-btn tp_fade_anim" data-delay=".7"
                            data-fade-from="top" data-ease="bounce">
                            <a href="javascript:void(0);" class="tp-btn-white-border tp-btn-light-bg" id="openConsultationModal">
                                Book a Consultation
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15"
                                        height="12" viewBox="0 0 15 12" fill="none">
                                        <path
                                            d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Consultation Popup Modal -->
<div class="dm-modal-overlay" id="consultationModal">
    <div class="dm-modal">
        <button class="dm-modal-close" id="closeConsultationModal" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h3 class="dm-modal-title">Book a Consultation</h3>
        <p class="dm-modal-desc">Fill in the details below and our team will get back to you within 24 hours.</p>

        <div class="dm-cf-success" id="consultationSuccess" style="display:none;">
            <i class="fa-solid fa-check-circle"></i> <span>Thank you! We'll get back to you soon.</span>
        </div>

        <form id="consultationForm" method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <input type="hidden" name="subject" value="Consultation Request - {{ $service->title }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Full Name *</label>
                        <input type="text" name="name" class="dm-cf-input" placeholder="Your full name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Email Address *</label>
                        <input type="email" name="email" class="dm-cf-input" placeholder="your@email.com" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Phone Number</label>
                        <input type="text" name="phone" class="dm-cf-input" placeholder="+91 XXXXX XXXXX">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Company Name</label>
                        <input type="text" name="company" class="dm-cf-input" placeholder="Your company">
                    </div>
                </div>
                <div class="col-12">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Requirements *</label>
                        <textarea name="message" class="dm-cf-textarea" placeholder="Tell us about your requirements, goals, and how we can help..." required></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="dm-cf-submit" id="consultationSubmitBtn">
                        Submit Request
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                            <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- 6A Framework & AI Platform sections -->
@include('frontend.partials.section-6a-framework')
@include('frontend.partials.section-ai-platform')
@endsection

@push('scripts')
<script>
(function() {
    var overlay = document.getElementById('consultationModal');
    var form = document.getElementById('consultationForm');
    var successMsg = document.getElementById('consultationSuccess');
    var submitBtn = document.getElementById('consultationSubmitBtn');

    // Open modal
    document.getElementById('openConsultationModal').addEventListener('click', function(e) {
        e.preventDefault();
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    // Close modal
    function closeModal() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    document.getElementById('closeConsultationModal').addEventListener('click', closeModal);
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) closeModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay.classList.contains('active')) closeModal();
    });

    // AJAX form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Submitting...';

        // Remove previous errors
        form.querySelectorAll('.dm-cf-error').forEach(function(el) { el.remove(); });

        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(function(response) { return response.json().then(function(data) { return { status: response.status, data: data }; }); })
        .then(function(result) {
            if (result.status === 422 && result.data.errors) {
                Object.keys(result.data.errors).forEach(function(field) {
                    var input = form.querySelector('[name="' + field + '"]');
                    if (input) {
                        var errDiv = document.createElement('div');
                        errDiv.className = 'dm-cf-error';
                        errDiv.textContent = result.data.errors[field][0];
                        input.parentNode.appendChild(errDiv);
                    }
                });
            } else {
                form.reset();
                successMsg.style.display = 'flex';
                setTimeout(function() {
                    successMsg.style.display = 'none';
                    closeModal();
                }, 3000);
            }
        })
        .catch(function() {
            form.reset();
            successMsg.style.display = 'flex';
            setTimeout(function() {
                successMsg.style.display = 'none';
                closeModal();
            }, 3000);
        })
        .finally(function() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit Request <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none"><path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/></svg>';
        });
    });
})();
</script>
@endpush
