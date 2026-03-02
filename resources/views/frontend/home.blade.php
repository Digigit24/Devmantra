@extends('layouts.frontend')
@section('title', 'DevMantra - Strategic Financial & Advisory Services')

@push('styles')
<script type="module" src="https://unpkg.com/@splinetool/viewer@1.12.53/build/spline-viewer.js"></script>
<script>
    function removeSplineLogo() {
        const viewers = document.querySelectorAll('spline-viewer');
        viewers.forEach(viewer => {
            const tryRemove = () => {
                const logo = viewer.shadowRoot?.querySelector('#logo');
                if (logo) {
                    logo.remove();
                } else {
                    const observer = new MutationObserver(() => {
                        const logo = viewer.shadowRoot?.querySelector('#logo');
                        if (logo) {
                            logo.remove();
                            observer.disconnect();
                        }
                    });
                    if (viewer.shadowRoot) {
                        observer.observe(viewer.shadowRoot, { childList: true, subtree: true });
                    }
                }
            };
            tryRemove();
        });
    }
    document.addEventListener('DOMContentLoaded', removeSplineLogo);
</script>
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
    /* Light CTA section (outside dark blog wrapper) */
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

                <!-- cr hero area start -->
                <div style="background-color: black;" class="cr-hero-area fix cr-hero-ptb p-relative pt-170">
                    <div class="cr-hero-bg cr-hero-spline">
                        <spline-viewer
                            url="https://prod.spline.design/xHLGA5-DjAiR6SRV/scene.splinecode"></spline-viewer>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="cr-hero-heading text-center z-index-1">
                                    <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">
                                        Commitment to Your Financial Success
                                    </div>
                                    <h4 class="tp-section-title-onest fs-68 tp-text-revel-anim" data-delay=".5">Unleash
                                        the Power of <br> eXcellence Beyond Numbers</h4>
                                </div>
                                <div class="cr-hero-content text-center z-index-2">
                                    <div class="tp_text_anim">
                                        <p style="margin-bottom: 150px;">At Dev Mantra, the pinnacle of global financial
                                            <br> services, we are driven
                                            by a commitment to <br> excellence, integrity, and innovation.
                                        </p>
                                    </div>
                                    <div class="cr-hero-btn">
                                        <a href="#" class="tp-btn-white-border">Book a Free
                                            Consultation
                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12"
                                                    viewBox="0 0 15 12" fill="none">
                                                    <path
                                                        d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z"
                                                        fill="currentColor" />
                                                </svg></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cr-hero-left">
                        <div class="shape-1 tp_fade_anim" data-fade-from="left" data-delay=".5"><img
                                src="{{ asset('assets/img/home-13/hero/hero-shape-1.png') }}" alt=""></div>
                        <div class="shape-2 tp_fade_anim" data-fade-from="left" data-delay=".5"><img
                                src="{{ asset('assets/img/home-13/hero/hero-shape-2.png') }}" alt=""></div>
                    </div>
                    <div class="cr-hero-right">
                        <div class="shape-1 tp_fade_anim" data-fade-from="right" data-delay=".5"><img
                                src="{{ asset('assets/img/home-13/hero/hero-shape-3.png') }}" alt=""></div>
                        <div class="shape-2 tp_fade_anim" data-fade-from="right" data-delay=".5"><img
                                src="{{ asset('assets/img/home-13/hero/hero-shape-4.png') }}" alt=""></div>
                    </div>
                </div>
                <!-- cr hero area end -->


                <!-- horizontal scroll services start -->
                <section class="dm-hscroll-section">
                    <div class="dm-hscroll-pin">
                        <div class="dm-hscroll-header">
                            <h2 class="dm-hscroll-title">What We Do</h2>
                            <p class="dm-hscroll-subtitle">Comprehensive financial and advisory services tailored for
                                your business growth.</p>
                        </div>
                        <!-- Desktop: horizontal GSAP scroll -->
                        <div class="dm-hscroll-track dm-hscroll-desktop">
                            <div class="dm-hscroll-cards">
                                @foreach($services as $service)
                                <div class="dm-hscroll-card">
                                    <div class="dm-hscroll-card-img">
                                        <img src="{{ $service->image ? asset('storage/'.$service->image) : asset('assets/img/home-13/feature/feature-thumb-'.(($loop->index % 3)+1).'.png') }}" alt="{{ $service->title }}">
                                    </div>
                                    <div class="dm-hscroll-card-body">
                                        <h3>{{ $service->title }}</h3>
                                        <p>{{ $service->short_description }}</p>
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
                                                <img src="{{ $service->image ? asset('storage/'.$service->image) : asset('assets/img/home-13/feature/feature-thumb-'.(($loop->index % 3)+1).'.png') }}" alt="{{ $service->title }}">
                                            </div>
                                            <div class="dm-hscroll-card-body">
                                                <h3>{{ $service->title }}</h3>
                                                <p>{{ $service->short_description }}</p>
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
                <!-- horizontal scroll services end -->


                <!-- cr brand area start -->
                <div class="cr-brand-area cr-brand-ptb fix cr-multi-border-bottom">
                    <div class="container container-1230">
                        <div class="cr-multi-border pt-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <div class="cr-brand-heading text-center mb-60">
                                        <div class="ca-brand-sub mb-70">
                                            <img src="{{ asset('assets/img/home-13/brand/brand-sub.png') }}" alt="">
                                        </div>
                                        <div class="tp_text_anim">
                                            <p>Our Clientele</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="cr-brand-wrapper pb-80">
                                        <div class="swiper-container app-brand-active fix">
                                            <div class="swiper-wrapper slider-transtion">
                                                @for($i = 1; $i <= 20; $i++)
                                                <div class="swiper-slide">
                                                    <div class="app-brand-item">
                                                        <img src="{{ asset('assets/img/logo/'.$i.'.png') }}" alt="">
                                                    </div>
                                                </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cr-brand-bottom">
                                        <img src="{{ asset('assets/img/home-13/brand/brand-bottom.png') }}" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cr-feature-heading text-center pt-100 pb-100">
                                        <div class="tp-section-subtitle-gradient ct mb-20">
                                            What We Do
                                        </div>

                                        <h4 class="tp-section-title-onest fs-72">
                                            Services to Boost Business Growth
                                        </h4>

                                        <div class="tp_text_anim">
                                            <p style="padding: 20px;">
                                                We know navigating financial documentation and regulations can be
                                                challenging. Rest easy our expert guidance in financial planning and
                                                risk management is designed to enhance your performance and ensure
                                                lasting success. Let's unlock your business's full potential together!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cr-feature-item-box">
                                <div class="row gx-0">
                                    <!-- CARD 1 — Dev Mantra -->
                                    <div class="col-md-6">
                                        <div class="cr-feature-item mb-15">
                                            <div class="cr-feature-item-content">
                                                <div class="cr-feature-item-icon d-flex">
                                                    <span>
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-icon-1.png') }}" alt="">
                                                    </span>
                                                    <h5 class="cr-feature-item-icon-title">
                                                        Dev Mantra Financial Services
                                                    </h5>
                                                </div>

                                                <p>
                                                    A Bengaluru-based financial services company founded in 2008,
                                                    specializing in outsourced accounting, bookkeeping, financial
                                                    reporting,
                                                    virtual CFO services, audit support, compliance solutions and
                                                    M&amp;A Services.
                                                    With a structured delivery model and trained finance professionals,
                                                    Dev Mantra supports clients across industries with accuracy,
                                                    efficiency,
                                                    and data security at its core. With over ₹5,000 crore (~USD 558
                                                    million)
                                                    in transactions and 150+ years of combined leadership experience,
                                                    we bring deep expertise to every engagement.
                                                </p>
                                            </div>

                                            <div class="cr-feature-thumb text-center anim-zoomin-wrap"
                                                style="padding:25px;">
                                                <div class="cr-feature-thumb text-start" style="padding:25px 35px;">
                                                    <div class="metric">
                                                        <span>Accounting &amp; Bookkeeping</span>
                                                        <div class="bar">
                                                            <div style="width:95%"></div>
                                                        </div>
                                                    </div>

                                                    <div class="metric">
                                                        <span>Financial Reporting</span>
                                                        <div class="bar">
                                                            <div style="width:90%"></div>
                                                        </div>
                                                    </div>

                                                    <div class="metric">
                                                        <span>Virtual CFO Services</span>
                                                        <div class="bar">
                                                            <div style="width:85%"></div>
                                                        </div>
                                                    </div>

                                                    <div class="metric">
                                                        <span>Audit Support &amp; Compliance</span>
                                                        <div class="bar">
                                                            <div style="width:88%"></div>
                                                        </div>
                                                    </div>

                                                    <div class="metric">
                                                        <span>M&amp;A Services</span>
                                                        <div class="bar">
                                                            <div style="width:82%"></div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CARD 2 — N. Tatia & Associates -->
                                    <div class="col-md-6">
                                        <div class="cr-feature-item mb-15">
                                            <div class="cr-feature-item-content">
                                                <div class="cr-feature-item-icon d-flex">
                                                    <span>
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-icon-2.png') }}" alt="">
                                                    </span>
                                                    <h5 class="cr-feature-item-icon-title">
                                                        N. Tatia &amp; Associates
                                                    </h5>
                                                </div>

                                                <p>
                                                    A professionally managed, peer-reviewed firm offering assurance,
                                                    taxation, and advisory services. Known for its partner-driven
                                                    approach,
                                                    compliance expertise, and strong governance framework — ensuring
                                                    every
                                                    client engagement adheres to the highest professional standards.
                                                </p>

                                                <p style="margin-top:14px; font-style:italic; opacity:0.85;">
                                                    Guided by core values of trust, transparency, and professionalism,
                                                    our client-first approach and local insight help us deliver
                                                    consistent value and long-term impact.
                                                </p>
                                            </div>

                                            <div class="cr-feature-thumb anim-zoomin-wrap text-center">
                                                <div class="cr-feature-thumb text-center">
                                                    <img width="70%" src="{{ asset('assets/img/logo/graph.png') }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CARD 3 — Mission & Vision -->
                                    <div class="col-lg-12">
                                        <div class="cr-feature-item hight mb-15">
                                            <div class="cr-feature-thumb big anim-zoomin-wrap text-center">
                                                <div class="cr-feature-thumb big text-center"
                                                    style="padding:20px 30px;">
                                                    <div class="mv-grid">

                                                        <div class="mv-card">
                                                            <h4>Our Mission</h4>
                                                            <p>
                                                                To empower businesses across the globe by providing
                                                                comprehensive financial and management consulting
                                                                services
                                                                that drive growth, ensure compliance, and enhance
                                                                operational
                                                                efficiency. We strive to build lasting relationships
                                                                with
                                                                our clients based on trust, transparency, and a deep
                                                                understanding of their unique needs.
                                                            </p>
                                                        </div>

                                                        <div class="mv-card">
                                                            <h4>Our Vision</h4>
                                                            <p>
                                                                To be a trusted global financial services partner for
                                                                CPA firms and businesses seeking reliability, expertise,
                                                                and scalable support.
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- VALUES 6-CARD GRID -->
                            <div class="row mt-50 pb-100">
                                <div class="col-lg-12">
                                    <div class="text-center mb-40">
                                        <div class="tp-section-subtitle-gradient ct mb-15">
                                            What Drives Us
                                        </div>
                                        <h4 class="tp-section-title-onest" style="font-size:42px;">
                                            Our Values
                                        </h4>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="dm-values-grid">

                                        <div class="dm-value-card">
                                            <div class="dm-value-icon">
                                                <img src="{{ asset('assets/img/logo/icon/1.png') }}" alt="">
                                            </div>
                                            <h5>Trust</h5>
                                            <p style="color: black;">
                                                We build strong, lasting relationships with our clients based on
                                                mutual trust and respect. Our commitment to integrity ensures
                                                that we always act in the best interest of our clients.
                                            </p>
                                        </div>

                                        <div class="dm-value-card">
                                            <div class="dm-value-icon">
                                                <img src="{{ asset('assets/img/logo/icon/2.png') }}" alt="">
                                            </div>
                                            <h5>Transparency</h5>
                                            <p style="color: black;">
                                                We maintain open and honest communication, ensuring our clients
                                                are fully informed and confident in their financial decisions.
                                            </p>
                                        </div>

                                        <div class="dm-value-card">
                                            <div class="dm-value-icon">
                                                <img src="{{ asset('assets/img/logo/icon/3.png') }}" alt="">
                                            </div>
                                            <h5>Integrity</h5>
                                            <p style="color: black;">
                                                We uphold the highest ethical standards in all our dealings,
                                                ensuring fairness and honesty. Integrity is the foundation
                                                of our practice, guiding our actions and decisions.
                                            </p>
                                        </div>

                                        <div class="dm-value-card">
                                            <div class="dm-value-icon">
                                                <img src="{{ asset('assets/img/logo/icon/4.png') }}" alt="">
                                            </div>
                                            <h5>Tech Integration</h5>
                                            <p style="color: black;">
                                                We leverage the latest technology to provide innovative solutions
                                                that enhance efficiency, accuracy, and convenience for our clients.
                                            </p>
                                        </div>

                                        <div class="dm-value-card">
                                            <div class="dm-value-icon">
                                                <img src="{{ asset('assets/img/logo/icon/5.png') }}" alt="">
                                            </div>
                                            <h5>Excellence</h5>
                                            <p style="color: black;">
                                                We are committed to delivering the highest quality services and
                                                continuously improving our processes. Our dedication to excellence
                                                drives us to exceed client expectations.
                                            </p>
                                        </div>

                                        <div class="dm-value-card">
                                            <div class="dm-value-icon">
                                                <img src="{{ asset('assets/img/logo/icon/6.png') }}" alt="">
                                            </div>
                                            <h5>Client-Centric Approach</h5>
                                            <p style="color: black;">
                                                We prioritize the needs and goals of our clients, offering
                                                tailored solutions that align with their unique requirements.
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- cr brand area end -->


                @include('frontend.partials.section-6a-framework')


                @include('frontend.partials.section-ai-platform')


                <!-- Map area start -->
                <section class="cr-world-area cr-brand-ptb fix">
                    <div class="container container-1230">
                        <div class="cr-multi-border pt-100 pb-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 text-center mb-60">
                                    <h3 class="tp-section-title-onest fs-72">Countries that we serve</h3>
                                    <p>We work with clients across the globe, delivering solutions without borders.</p>
                                </div>

                                <div class="col-lg-10">
                                    <div class="world-map-box">
                                        <!-- Base SVG (unchanged) -->
                                        <div class="map-base">
                                            <img src="{{ asset('assets/img/logo/map.svg') }}" alt="">
                                        </div>

                                        <!-- Overlay SVG for pins (same viewBox as your base SVG) -->
                                        <svg class="map-overlay" viewBox="0 0 1000 500"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <!-- Pins (use circles at precise coordinates) -->
                                            <g id="pins">
                                                <circle class="pin" cx="150" cy="90" r="6" data-country="USA"></circle>
                                                <circle class="pin" cx="395" cy="75" r="6" data-country="UK"></circle>
                                                <circle class="pin" cx="450" cy="95" r="6" data-country="Italy">
                                                </circle>
                                                <circle class="pin" cx="570" cy="145" r="6" data-country="Oman">
                                                </circle>
                                                <circle class="pin" cx="670" cy="175" r="6" data-country="Sri Lanka">
                                                </circle>
                                                <circle class="pin" cx="740" cy="195" r="6" data-country="Singapore">
                                                </circle>
                                                <circle class="pin" cx="880" cy="245" r="6" data-country="Australia">
                                                </circle>
                                            </g>
                                        </svg>

                                        <div class="map-tooltip" id="mapTooltip"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Map area end -->


                <!-- cr feature 2 area start -->
                <div class="cr-feature-2-area p-relative cr-feature-2-ptb">
                    <div class="cr-feature-2-bg">
                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-bg.png') }}" alt="">
                    </div>
                    <div class="container-fluid gx-0">
                        <div class="row g-0">
                            <div class="col-xxl-4 col-xl-6 order-2 order-xxl-1">
                                <div class="cr-feature-2-left">
                                    <div class="cr-feature-2-box">
                                        <div class="row row-cols-xl-5 gx-0">
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-1.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-2.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cr-feature-2-box">
                                        <div class="row row-cols-xl-5 gx-0">
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-3.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-4.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-5.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-6.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cr-feature-2-box">
                                        <div class="row row-cols-xl-5 gx-0">
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-7.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-8.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CENTER CONTENT -->
                            <div class="col-xxl-4 order-xl-12 order-1 order-xxl-2">
                                <div class="cr-feature-2-heading text-center">
                                    <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">
                                        Our Commitment
                                    </div>
                                    <h4 class="tp-section-title-onest tp-text-revel-anim">
                                        Our Commitment to Your Financial Success
                                    </h4>
                                    <div class="tp_text_anim">
                                        <p>
                                            Dev Mantra is a strategic partner in progress for businesses operating in a
                                            global and digital economy
                                        </p>
                                    </div>
                                    <div class="cr-feature-2-btn tp_fade_anim" data-delay=".7" data-fade-from="top"
                                        data-ease="bounce">
                                        <a href="javascript:void(0)" class="tp-btn-white-border">
                                            Find out more
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12"
                                                    viewBox="0 0 15 12" fill="none">
                                                    <path
                                                        d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- RIGHT GRID -->
                            <div class="col-xxl-4 col-xl-6 order-2 order-xxl-3">
                                <div class="cr-feature-2-right">
                                    <div class="cr-feature-2-box">
                                        <div class="row row-cols-xl-5 gx-0 justify-content-end">
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-9.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="cr-feature-2-item"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cr-feature-2-box">
                                        <div class="row row-cols-xl-5 gx-0">
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-10.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-11.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-12.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-13.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cr-feature-2-box">
                                        <div class="row row-cols-xl-5 gx-0">
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-14.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col"></div>
                                            <div class="col">
                                                <div class="cr-feature-2-item">
                                                    <span class="bullet-top-left"></span>
                                                    <span class="bullet-top-right"></span>
                                                    <span class="bullet-bottom-left"></span>
                                                    <span class="bullet-bottom-right"></span>
                                                    <div class="cr-feature-2-item-icon animation-2">
                                                        <img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-15.png') }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="cr-feature-2-item"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- cr feature 2 area end -->


                <!-- team section start -->
                <section class="dm-team-section">
                    <div class="container">
                        <div class="dm-team-header text-center">
                            <h2 class="dm-team-main-title">Meet Our Team</h2>
                            <p class="dm-team-main-subtitle">The people behind Devmantra who drive excellence every day.
                            </p>
                        </div>

                        <!-- Founders -->
                        <h3 class="dm-team-group-title">Founders</h3>
                        <div class="row dm-team-row justify-content-center">
                            <div class="dm-team-col">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/6.jpg') }}" alt="Vikash Tatia">
                                    </div>
                                    <span class="dm-team-role">Founder & MD</span>
                                    <h4 class="dm-team-name">Vikash Tatia</h4>
                                </div>
                            </div>
                            <div class="dm-team-col">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/7.jpg') }}" alt="Nidhi Tatia">
                                    </div>
                                    <span class="dm-team-role">Founder & Director</span>
                                    <h4 class="dm-team-name">Nidhi Tatia</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Partners -->
                        <h3 class="dm-team-group-title">Partners & Advisory Board</h3>
                        <div class="row dm-team-row justify-content-center">
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/8.jpg') }}" alt="">
                                    </div>
                                    <span class="dm-team-role">Director & Associate Partner</span>
                                    <h4 class="dm-team-name">Sankaranarayanan</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/9.jpeg') }}" alt="Kamal Parakh">
                                    </div>
                                    <span class="dm-team-role">Associate Director & Senior Partner</span>
                                    <h4 class="dm-team-name">Kamal Parakh</h4>
                                </div>
                            </div>
                            <div style="border-right: 2px solid #1b3c6b;" class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/10.png') }}" alt="Darshit Bombaywala">
                                    </div>
                                    <span class="dm-team-role">Associate Partner</span>
                                    <h4 class="dm-team-name">Darshit Bombaywala</h4>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/11.jpg') }}" alt="">
                                    </div>
                                    <span class="dm-team-role">Advisor - Agri Business</span>
                                    <h4 class="dm-team-name">Pawan Bhotika</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/12.jpg') }}" alt="BC Datta">
                                    </div>
                                    <span class="dm-team-role">Associate Director - Corporate Affairs</span>
                                    <h4 class="dm-team-name">BC Datta</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Team -->
                        <h3 class="dm-team-group-title">Team</h3>
                        <div class="row dm-team-row justify-content-center">
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/1.jpg') }}" alt="Abhinaya Udayakumar">
                                    </div>
                                    <span class="dm-team-role">Associate - Investment Banking</span>
                                    <h4 class="dm-team-name">Abhinaya U</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/2.jpg') }}" alt="Sandeep Dhupar">
                                    </div>
                                    <span class="dm-team-role">Associate Director</span>
                                    <h4 class="dm-team-name">Sandeep Dhupar</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/3.jpg') }}" alt="Jalandhar Behera">
                                    </div>
                                    <span class="dm-team-role">Associate VP - FAO Services</span>
                                    <h4 class="dm-team-name">Jalandhar Behera</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/4.jpg') }}" alt="Rajani M">
                                    </div>
                                    <span class="dm-team-role">Talent Acquisition Lead</span>
                                    <h4 class="dm-team-name">Rajani M</h4>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                                <div class="dm-team-member">
                                    <div class="dm-team-photo">
                                        <img src="{{ asset('assets/img/team/5.jpg') }}" alt="Namrata Parakh Marothi">
                                    </div>
                                    <span class="dm-team-role">Associate - Intl Relations</span>
                                    <h4 class="dm-team-name">Namrata Parakh</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- team section end -->


                <!-- approach + lifecycle combined section start -->
                <section class="dm-apl-section">
                    <div class="dm-apl-pin">
                        <div class="container">
                            <!-- Section Header -->
                            <div class="dm-apl-header text-center">
                                <span class="dm-apl-label">How We Work</span>
                                <h2 class="dm-apl-title">Our Approach &amp; Business Lifecycle</h2>
                                <p class="dm-apl-subtitle">Building long-term relationships based on transparency,
                                    technical excellence, and measurable value creation.</p>
                            </div>

                            <div class="dm-apl-grid">
                                <!-- Left: Our Approach -->
                                <div class="dm-apl-left">
                                    <h3 class="dm-apl-col-title">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" />
                                            <path d="m9 12 2 2 4-4" />
                                        </svg>
                                        Our Approach
                                    </h3>
                                    <div class="dm-apl-checklist">
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Partner-led supervision and
                                                review</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Dedicated engagement teams</span>
                                        </div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Structured SLAs and turnaround
                                                commitments</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Robust data security and
                                                confidentiality</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Continuous training aligned with
                                                global standards</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">CPA-focused delivery model</span>
                                        </div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Automation-first approach</span>
                                        </div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Governance-embedded
                                                framework</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Leadership with US accounting
                                                exposure</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Structured QA and review
                                                hierarchy</span></div>
                                        <div class="dm-apl-item"><span class="dm-apl-check"><svg width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12" />
                                                </svg></span><span class="dm-apl-text">Secure infrastructure</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right: Business Lifecycle (vertical tabs) -->
                                <div class="dm-apl-right">
                                    <h3 class="dm-apl-col-title">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <polyline points="12 6 12 12 16 14" />
                                        </svg>
                                        Business Lifecycle
                                    </h3>

                                    <div class="dm-lc-vtabs">
                                        <!-- Vertical tab buttons -->
                                        <div class="dm-lc-vtabs-nav">
                                            <button class="dm-lc-vtab is-active" data-tab="0">
                                                <span class="dm-lc-vtab-indicator"></span>
                                                <span class="dm-lc-vtab-label">Launch</span>
                                            </button>
                                            <button class="dm-lc-vtab" data-tab="1">
                                                <span class="dm-lc-vtab-indicator"></span>
                                                <span class="dm-lc-vtab-label">Seed Stage</span>
                                            </button>
                                            <button class="dm-lc-vtab" data-tab="2">
                                                <span class="dm-lc-vtab-indicator"></span>
                                                <span class="dm-lc-vtab-label">Growth</span>
                                            </button>
                                            <button class="dm-lc-vtab" data-tab="3">
                                                <span class="dm-lc-vtab-indicator"></span>
                                                <span class="dm-lc-vtab-label">Maturity</span>
                                            </button>
                                            <button class="dm-lc-vtab" data-tab="4">
                                                <span class="dm-lc-vtab-indicator"></span>
                                                <span class="dm-lc-vtab-label">Decline</span>
                                            </button>
                                        </div>

                                        <!-- Tab content panels -->
                                        <div class="dm-lc-vtabs-content">
                                            <div class="dm-lc-vpanel is-active" data-panel="0">
                                                <h4 class="dm-lc-vpanel-title">Launch</h4>
                                                <ul class="dm-lc-vpanel-list">
                                                    <li>Business Setup &amp; Structuring</li>
                                                    <li>Initial Registrations</li>
                                                    <li>RBI Approvals &amp; FEMA Compliance</li>
                                                </ul>
                                            </div>
                                            <div class="dm-lc-vpanel" data-panel="1">
                                                <h4 class="dm-lc-vpanel-title">Seed Stage</h4>
                                                <ul class="dm-lc-vpanel-list">
                                                    <li>Virtual CFO Services</li>
                                                    <li>Regulatory Framework Setup</li>
                                                    <li>Accounting &amp; Compliance Process Setup</li>
                                                    <li>Asset Protection</li>
                                                    <li>Identifying Right People in the Actual Setup</li>
                                                </ul>
                                            </div>
                                            <div class="dm-lc-vpanel" data-panel="2">
                                                <h4 class="dm-lc-vpanel-title">Growth</h4>
                                                <ul class="dm-lc-vpanel-list">
                                                    <li>Funding &amp; Due Diligence</li>
                                                    <li>Expansion Strategies</li>
                                                    <li>Process Documentation</li>
                                                    <li>Risk Mitigation</li>
                                                    <li>Investor &amp; Transaction Management</li>
                                                    <li>Corporate Governance</li>
                                                </ul>
                                            </div>
                                            <div class="dm-lc-vpanel" data-panel="3">
                                                <h4 class="dm-lc-vpanel-title">Maturity</h4>
                                                <ul class="dm-lc-vpanel-list">
                                                    <li>Business Expansion Planning</li>
                                                    <li>Continuity Planning</li>
                                                    <li>Regular Audits &amp; Compliance</li>
                                                    <li>International Transactions &amp; FEMA Compliance</li>
                                                </ul>
                                            </div>
                                            <div class="dm-lc-vpanel" data-panel="4">
                                                <h4 class="dm-lc-vpanel-title">Decline</h4>
                                                <ul class="dm-lc-vpanel-list">
                                                    <li>Possible Acquisition Strategies</li>
                                                    <li>Voluntary Winding Up</li>
                                                    <li>OCFC Verification</li>
                                                    <li>Liquidation Support Services</li>
                                                    <li>Closure Compliance Support</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- approach + lifecycle combined section end -->


                <!-- testimonial area start -->
                <div class="cr-testimonial-area cr-testimonial-ptb">
                    <div class="container container-1230">
                        <div class="cr-testimonial-box">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="cr-testimonial-wrap pt-40 pl-50">
                                        <div class="cr-testimonial-content">
                                            <span>4.8
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 18 18" fill="none">
                                                    <path
                                                        d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z"
                                                        fill="#F9A811" />
                                                </svg>
                                            </span>
                                            <p>Client Success Stories</p>
                                        </div>
                                        <h3 class="cr-testimonial-title">
                                            Join the ranks of our satisfied clients and experience the Dev Mantra
                                            difference.
                                        </h3>
                                        <div class="cr-testimonial-nav">
                                            <button class="cr-testimonial-prev">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13 7H1M1 7L7 1M1 7L7 13" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                            <button class="cr-testimonial-next">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div class="cr-testimonial-wrapper z-index-1">
                                        <div class="cr-testimonial-item-shape">
                                            <img src="{{ asset('assets/img/home-13/testimonial/testimonial-line.png') }}" alt="">
                                        </div>
                                        <div class="swiper-container cr-testimonial-active fix">
                                            <div class="swiper-wrapper">

                                                <!-- 1 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "We have been working with them since the inception of our
                                                            company and we never had to look back at this relationship.
                                                            Not only on regular matters, they have also given us very
                                                            sound guidance, counsel and options when we have had any new
                                                            developments. We truly value this relationship with Dev
                                                            Mantra and look forward to working with them for a very long
                                                            time to come."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>Vaibhav Singh</span>
                                                            <p>Director, Leap Group</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "SecureSearch started working with Dev Mantra when starting
                                                            up as a new business. Their focus and understanding of the
                                                            needs of a new business were very good and were able to
                                                            guide us through the maze of starting up a new business,
                                                            dealing with new and large contracts and being compliant
                                                            always. The team at Dev Mantra has added real value to
                                                            SecureSearch by helping the Company through the various
                                                            stages of growth from start-up to scaling up."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>Chetan Desai</span>
                                                            <p>Founder & CEO, SecureSearch Screening Services</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 3 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "We had an urgent need to raise finance. Dev Mantra Team was
                                                            able to guide us through troubled waters with skill and
                                                            intelligence. Their expertise in restructuring and corporate
                                                            finance, along with the wider firm's knowledge of
                                                            intellectual property, gave us the advice we needed in a
                                                            quick and efficient manner."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>MBR Homes</span>
                                                            <p>Real Estate Developers</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 4 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "We were really pleased with all of the support from the
                                                            entire team throughout the whole deal process. Great advice
                                                            in the areas we didn't understand and at the same time full
                                                            recognition of our requirements. Our interests were always
                                                            represented very professionally which was a major
                                                            contribution to a successful outcome. The investment
                                                            transaction was completed successfully thanks to the
                                                            diligence and remarkable contribution by the Dev Mantra
                                                            team."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>Gouthami T S</span>
                                                            <p>Founder & CEO, AquaairX Autonomous Systems</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 5 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "N. Tatia & Associates, Chartered Accountants have been
                                                            appointed as tax advisors and representatives for litigation
                                                            support. This office acknowledged the satisfactory services
                                                            extended by them from time to time."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>C. V. Sajeevan</span>
                                                            <p>Official Liquidator, High Court of Karnataka</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 6 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "Dev Mantra has been a huge help to our business since
                                                            incorporation. They are a really friendly and professional
                                                            team and always quick to respond. They really take the
                                                            stress out of our finance function."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>MVS Prasad</span>
                                                            <p>Founder & CEO, Prashaste Group</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 7 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "Impact Group of Institutions has greatly benefitted with
                                                            tax and consulting with Dev Mantra for all our financial
                                                            compliances and other tax related issues — it has been
                                                            immensely beneficial. Their quality of work is highly
                                                            professional with a proactive approach. We can always count
                                                            on them for all our audit and taxation needs without
                                                            worrying about the deadlines."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>Dr Alice Abrahaim</span>
                                                            <p>President, Impact Group of Institutions</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 8 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "Dev Mantra team under the leadership of director Vikash
                                                            Tatia has special capabilities to contribute across business
                                                            functions. The team contributes immensely to the growth of
                                                            the organisation and we are able to see turnaround results."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>Shri Sudhir Jain</span>
                                                            <p>Founder & CEO, Bionova</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 9 -->
                                                <div class="swiper-slide">
                                                    <div class="cr-testimonial-item z-index-1 text-center">
                                                        <div class="cr-testimonial-item-top pb-40">
                                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                                            <img width="70"
                                                                src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png"
                                                                alt="Google">
                                                        </div>
                                                        <h3 class="cr-testimonial-item-title">
                                                            "We appreciate the association of Dev Mantra in all tax
                                                            related matters and are always confident of meeting various
                                                            deadlines."
                                                        </h3>
                                                        <div class="cr-testimonial-item-user">
                                                            <span>Director (Admin)</span>
                                                            <p>Ministry of Communications</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- testimonial area end -->


                <!-- cr blog area start -->
                <div class="cr-blog-area cr-blog-area-dark">
                    <div class="container container-1230">
                        <div class="cr-multi-border pt-120">
                            <div class="cr-blog-bottom-border">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="cr-blog-heading text-center pb-60">
                                            <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim"
                                                data-delay=".3">Insights</div>
                                            <h4 class="tp-section-title-onest fs-72 tp-text-revel-anim">Explore our <br>
                                                latest insights & updates</h4>
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
                                        <div class="cr-blog-bottom text-center tp_fade_anim" data-delay=".7"
                                            data-fade-from="top" data-ease="bounce">
                                            <a href="{{ route('blog.index') }}" class="cr-blog-bottom-text">Explore more insights from Dev
                                                Mantra</a>
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
                                            <a href="{{ url('/contact') }}" class="tp-btn-white-border tp-btn-light-bg">
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
                <!-- CTA end -->

@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    /* ---------------- CPA FIRM PRESSURE ---------------- */
    if(document.getElementById('cpaPressureChart')) {
        new Chart(document.getElementById('cpaPressureChart'), {
            type: 'bar',
            data: {
                labels: ['Talent Shortage', 'Audit Complexity', 'Partner Burnout', 'Reporting Delays', 'Regulatory Scrutiny'],
                datasets: [{
                    data: [85, 78, 82, 70, 88],
                    backgroundColor: [
                        '#0f2b5c',
                        '#1b3c6b',
                        '#2a4f8f',
                        '#3b61a8',
                        '#4a73c4'
                    ],
                    borderRadius: 6
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, max: 100, grid: { color: '#eeeeee' } }
                }
            }
        });
    }

    /* ---------------- WORKFLOW IMPROVEMENT ---------------- */
    if(document.getElementById('workflowChart')) {
        new Chart(document.getElementById('workflowChart'), {
            type: 'doughnut',
            data: {
                labels: ['Automation Processing', 'QA Review', 'CPA Oversight'],
                datasets: [{
                    data: [50, 25, 25],
                    backgroundColor: [
                        '#1b3c6b',
                        '#2ca24c',
                        '#9aa7bd'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                },
                cutout: '70%'
            }
        });
    }

    /* ---------------- BUSINESS IMPACT ---------------- */
    if(document.getElementById('impactChart')) {
        new Chart(document.getElementById('impactChart'), {
            type: 'line',
            data: {
                labels: ['Cost Savings', 'Audit Speed', 'Capacity', 'Accuracy'],
                datasets: [{
                    data: [60, 40, 50, 99],
                    borderColor: '#2ca24c',
                    backgroundColor: 'rgba(44,162,76,0.15)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#2ca24c'
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { beginAtZero: true, max: 100, grid: { color: '#eeeeee' } }
                }
            }
        });
    }
</script>

<script>
    (function () {
        var pins = document.querySelectorAll(".pin");
        var box = document.querySelector(".world-map-box");
        if (!pins.length || !box) return;

        // Remove the single shared tooltip
        var oldTooltip = document.getElementById("mapTooltip");
        if (oldTooltip) oldTooltip.remove();

        // Create a permanent tooltip for each pin
        pins.forEach(function (pin) {
            var name = pin.getAttribute("data-country");
            var tip = document.createElement("div");
            tip.className = "map-tooltip map-tooltip-always";
            tip.textContent = name;
            box.appendChild(tip);

            function positionTip() {
                var rect = box.getBoundingClientRect();
                var pt = pin.getBoundingClientRect();
                tip.style.left = (pt.left - rect.left + pt.width / 2) + "px";
                tip.style.top = (pt.top - rect.top) + "px";
            }

            // Position on load and resize
            window.addEventListener("load", positionTip);
            window.addEventListener("resize", positionTip);
            // Also position immediately in case already loaded
            setTimeout(positionTip, 200);
            setTimeout(positionTip, 800);
        });
    })();
</script>


<!-- GSAP animations for USP + 6A Sections -->
<script>
    (function () {
        gsap.registerPlugin(ScrollTrigger);

        // -- Section 04: USP cards stagger-in --
        var uspCards = document.querySelectorAll('.dm-usp-card');
        if (uspCards.length) {
            gsap.set(uspCards, { y: 60, opacity: 0 });
            ScrollTrigger.create({
                trigger: '.dm-usp-section',
                start: 'top 80%',
                once: true,
                onEnter: function () {
                    gsap.to(uspCards, {
                        y: 0,
                        opacity: 1,
                        duration: 0.7,
                        stagger: 0.15,
                        ease: 'power3.out'
                    });
                }
            });
        }

        // USP title reveal
        var uspTitle = document.querySelector('.dm-usp-title');
        if (uspTitle) {
            gsap.set(uspTitle, { y: 30, opacity: 0 });
            ScrollTrigger.create({
                trigger: '.dm-usp-section',
                start: 'top 85%',
                once: true,
                onEnter: function () {
                    gsap.to(uspTitle, {
                        y: 0,
                        opacity: 1,
                        duration: 0.6,
                        ease: 'power2.out'
                    });
                }
            });
        }

    })();
</script>


<!-- Approach + Lifecycle section animations -->
<script>
    (function () {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

        var aplSection = document.querySelector('.dm-apl-section');
        var aplPin = document.querySelector('.dm-apl-pin');
        if (!aplSection || !aplPin) return;

        // -- Header fade-in --
        var aplHeader = aplSection.querySelector('.dm-apl-header');
        if (aplHeader) {
            gsap.set(aplHeader, { y: 30, opacity: 0 });
            ScrollTrigger.create({
                trigger: aplSection,
                start: 'top 85%',
                once: true,
                onEnter: function () {
                    gsap.to(aplHeader, { y: 0, opacity: 1, duration: 0.6, ease: 'power2.out' });
                }
            });
        }

        // -- Checklist items stagger-in --
        var aplItems = aplSection.querySelectorAll('.dm-apl-item');
        if (aplItems.length) {
            gsap.set(aplItems, { x: -15, opacity: 0 });
            ScrollTrigger.create({
                trigger: '.dm-apl-left',
                start: 'top 80%',
                once: true,
                onEnter: function () {
                    gsap.to(aplItems, { x: 0, opacity: 1, duration: 0.4, stagger: 0.05, ease: 'power2.out' });
                }
            });
        }

        // -- Hover microanimations on checklist items --
        aplItems.forEach(function (item) {
            var check = item.querySelector('.dm-apl-check');
            item.addEventListener('mouseenter', function () {
                gsap.to(item, { x: 4, duration: 0.25, ease: 'power2.out' });
                if (check) gsap.to(check, { scale: 1.15, rotation: 10, duration: 0.3, ease: 'back.out(2)' });
            });
            item.addEventListener('mouseleave', function () {
                gsap.to(item, { x: 0, duration: 0.25, ease: 'power2.out' });
                if (check) gsap.to(check, { scale: 1, rotation: 0, duration: 0.25, ease: 'power2.out' });
            });
        });

        // ===============================================
        // LIFECYCLE -- Vertical tab switching (click-based)
        // ===============================================

        var lcTabs = aplSection.querySelectorAll('.dm-lc-vtab');
        var lcPanels = aplSection.querySelectorAll('.dm-lc-vpanel');

        if (!lcTabs.length || !lcPanels.length) return;

        var activeTab = 0;

        function switchTab(index) {
            if (index === activeTab) return;
            var prevIndex = activeTab;
            activeTab = index;
            var direction = index > prevIndex ? 1 : -1;

            // Update tab buttons
            lcTabs.forEach(function (tab, i) {
                tab.classList.toggle('is-active', i === index);
            });

            // Kill any running panel/list animations
            lcPanels.forEach(function (panel) {
                gsap.killTweensOf(panel);
                var items = panel.querySelectorAll('li');
                if (items.length) gsap.killTweensOf(items);
            });

            // Hide all panels except the new one
            lcPanels.forEach(function (panel, i) {
                if (i !== index) {
                    panel.classList.remove('is-active');
                    gsap.set(panel, { opacity: 0, y: 0 });
                }
            });

            // Animate in the new panel
            var inPanel = lcPanels[index];
            inPanel.classList.add('is-active');
            gsap.fromTo(inPanel,
                { opacity: 0, y: 14 * direction },
                { opacity: 1, y: 0, duration: 0.35, ease: 'power2.out' }
            );

            // Stagger-in list items
            var newItems = inPanel.querySelectorAll('li');
            if (newItems.length) {
                gsap.fromTo(newItems,
                    { x: 8, opacity: 0 },
                    { x: 0, opacity: 1, duration: 0.3, stagger: 0.04, delay: 0.1, ease: 'power2.out' }
                );
            }
        }

        // -- Auto-rotate every 5 seconds --
        var AUTO_INTERVAL = 5000;
        var autoTimer = null;

        function startAutoRotate() {
            stopAutoRotate();
            autoTimer = setInterval(function () {
                var nextTab = (activeTab + 1) % lcTabs.length;
                switchTab(nextTab);
            }, AUTO_INTERVAL);
        }

        function stopAutoRotate() {
            if (autoTimer) {
                clearInterval(autoTimer);
                autoTimer = null;
            }
        }

        // Tab click handlers -- reset timer on manual click
        lcTabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () {
                switchTab(i);
                startAutoRotate(); // restart timer from this tab
            });
        });

        // Pause auto-rotate on hover, resume on leave
        var vtabsContainer = aplSection.querySelector('.dm-lc-vtabs');
        if (vtabsContainer) {
            vtabsContainer.addEventListener('mouseenter', stopAutoRotate);
            vtabsContainer.addEventListener('mouseleave', startAutoRotate);
        }

        // Start auto-rotate
        startAutoRotate();

        // Entrance animation for the vertical tabs container
        if (vtabsContainer) {
            gsap.set(vtabsContainer, { y: 20, opacity: 0 });
            ScrollTrigger.create({
                trigger: '.dm-apl-right',
                start: 'top 80%',
                once: true,
                onEnter: function () {
                    gsap.to(vtabsContainer, { y: 0, opacity: 1, duration: 0.5, ease: 'power2.out' });
                }
            });
        }

    })();
</script>

<!-- Horizontal scroll services (desktop GSAP + mobile Swiper) -->
<script>
    (function () {
        var MOBILE_BP = 991;

        // -- Desktop: GSAP horizontal scroll --
        gsap.registerPlugin(ScrollTrigger);

        var section = document.querySelector(".dm-hscroll-section");
        var cards = document.querySelector(".dm-hscroll-cards");

        function killHScroll() {
            ScrollTrigger.getAll().forEach(function (t) {
                if (t.vars && t.vars.id === "dm-hscroll") t.kill();
            });
            if (cards) gsap.set(cards, { x: 0 });
        }

        function initHScroll() {
            killHScroll();
            if (!section || !cards) return;
            if (window.innerWidth <= MOBILE_BP) return;

            var scrollDistance = cards.scrollWidth - window.innerWidth + 120;
            if (scrollDistance <= 0) return;

            gsap.to(cards, {
                x: -scrollDistance,
                ease: "none",
                scrollTrigger: {
                    id: "dm-hscroll",
                    trigger: section,
                    pin: true,
                    scrub: 1,
                    start: "top top",
                    end: "+=" + scrollDistance,
                    invalidateOnRefresh: true
                }
            });
        }

        // -- Mobile: Swiper slider --
        var swiperInstance = null;

        function initSwiper() {
            if (window.innerWidth > MOBILE_BP) {
                if (swiperInstance) { swiperInstance.destroy(true, true); swiperInstance = null; }
                return;
            }
            if (swiperInstance) return; // already running

            swiperInstance = new Swiper(".dm-services-swiper", {
                slidesPerView: 1.15,
                spaceBetween: 16,
                centeredSlides: true,
                grabCursor: true,
                pagination: {
                    el: ".dm-services-pagination",
                    clickable: true
                },
                breakpoints: {
                    480: { slidesPerView: 1.3, spaceBetween: 20 },
                    768: { slidesPerView: 2.2, spaceBetween: 24 }
                }
            });
        }

        // -- Init on load --
        window.addEventListener("load", function () {
            setTimeout(function () {
                initHScroll();
                initSwiper();
            }, 300);
        });

        // -- Re-init on resize --
        var resizeTimer;
        window.addEventListener("resize", function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                initHScroll();
                initSwiper();
            }, 250);
        });
    })();
</script>
@endpush
