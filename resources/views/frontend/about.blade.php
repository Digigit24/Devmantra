@extends('layouts.frontend')
@section('title', 'About Us - DevMantra')
@section('meta_description', 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy. Founded in 2008 in Bengaluru.')

@push('styles')
<style>
    /* Hero */
    .dm-about-hero {
        background-color: #000;
        padding: 200px 0 100px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 767px) { .dm-about-hero { padding: 150px 0 70px; } }
    .dm-about-hero-subtitle {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255,255,255,0.5);
        margin-bottom: 24px;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-hero-title {
        font-size: 52px;
        font-weight: 600;
        color: #fff;
        line-height: 1.2;
        max-width: 700px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 991px) { .dm-about-hero-title { font-size: 38px; } }
    @media (max-width: 767px) { .dm-about-hero-title { font-size: 28px; } }
    .dm-about-hero-desc {
        font-size: 18px;
        color: rgba(255,255,255,0.6);
        line-height: 1.7;
        max-width: 600px;
        margin-top: 24px;
        font-family: var(--tp-ff-onest);
    }

    /* Intro */
    .dm-about-intro { padding: 100px 0; }
    @media (max-width: 767px) { .dm-about-intro { padding: 60px 0; } }
    .dm-about-intro-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 20px;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-intro-title {
        font-size: 36px;
        font-weight: 600;
        color: #111;
        line-height: 1.3;
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 767px) { .dm-about-intro-title { font-size: 26px; } }
    .dm-about-intro-text p {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.65);
        margin-bottom: 20px;
        font-family: var(--tp-ff-onest);
    }

    /* Mission Vision */
    .dm-about-mv { padding: 80px 0; background: #f8f9fa; }
    @media (max-width: 767px) { .dm-about-mv { padding: 50px 0; } }
    .dm-mv-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.08);
        border-radius: 16px;
        padding: 40px;
        height: 100%;
        transition: transform 0.3s ease;
    }
    .dm-mv-card:hover { transform: translateY(-4px); }
    .dm-mv-card h4 {
        font-size: 24px;
        font-weight: 700;
        color: #111;
        margin-bottom: 16px;
        font-family: var(--tp-ff-onest);
    }
    .dm-mv-card p {
        font-size: 16px;
        line-height: 1.75;
        color: rgba(0,0,0,0.6);
        font-family: var(--tp-ff-onest);
    }

    /* Values */
    .dm-about-values { padding: 100px 0; }
    @media (max-width: 767px) { .dm-about-values { padding: 60px 0; } }
    .dm-about-section-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(0,0,0,0.35);
        font-family: var(--tp-ff-onest);
    }
    .dm-about-section-title {
        font-size: 36px;
        font-weight: 600;
        color: #111;
        margin-top: 12px;
        margin-bottom: 50px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 767px) { .dm-about-section-title { font-size: 26px; } }
    .dm-value-item {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 14px;
        padding: 32px;
        margin-bottom: 24px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .dm-value-item:hover {
        border-color: rgba(0,0,0,0.15);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }
    .dm-value-item-icon {
        width: 48px;
        height: 48px;
        margin-bottom: 18px;
    }
    .dm-value-item-icon img { width: 100%; height: 100%; object-fit: contain; }
    .dm-value-item h5 {
        font-size: 18px;
        font-weight: 700;
        color: #111;
        margin-bottom: 10px;
        font-family: var(--tp-ff-onest);
    }
    .dm-value-item p {
        font-size: 15px;
        line-height: 1.7;
        color: rgba(0,0,0,0.6);
        margin: 0;
        font-family: var(--tp-ff-onest);
    }

    /* Services overview */
    .dm-about-services { padding: 80px 0; background: #000; }
    @media (max-width: 767px) { .dm-about-services { padding: 50px 0; } }
    .dm-about-service-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 32px;
        margin-bottom: 24px;
        transition: all 0.3s ease;
        height: 100%;
    }
    .dm-about-service-card:hover {
        background: rgba(255,255,255,0.08);
        transform: translateY(-3px);
    }
    .dm-about-service-card h5 {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 10px;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-service-card p {
        font-size: 15px;
        line-height: 1.7;
        color: rgba(255,255,255,0.5);
        margin-bottom: 16px;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-service-card a {
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        padding-bottom: 2px;
        transition: border-color 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-service-card a:hover { border-color: #fff; }

    /* CTA */
    .dm-about-cta {
        padding: 100px 0;
        text-align: center;
        background: #fff;
        color: #111;
    }
    @media (max-width: 767px) { .dm-about-cta { padding: 60px 0; } }
    .dm-about-cta h3 {
        font-size: 36px;
        font-weight: 600;
        color: #111 !important;
        margin-bottom: 16px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 767px) { .dm-about-cta h3 { font-size: 26px; } }
    .dm-about-cta p {
        font-size: 17px;
        color: rgba(0,0,0,0.55) !important;
        margin-bottom: 32px;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-cta-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: #000;
        color: #fff;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-about-cta-btn:hover {
        background: #222;
        color: #fff;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')

<!-- Hero -->
<div class="dm-about-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-8">
                <div class="dm-about-hero-subtitle tp_fade_anim" data-delay=".3">About Dev Mantra</div>
                <h1 class="dm-about-hero-title tp-text-revel-anim" data-delay=".5">Strategic Partner in Progress for Global Businesses</h1>
                <p class="dm-about-hero-desc tp_fade_anim" data-delay=".7">Founded in 2008, Dev Mantra is a Bengaluru-based financial services company empowering businesses across the globe with excellence, integrity, and innovation.</p>
            </div>
        </div>
    </div>
</div>

<!-- Intro -->
<div class="dm-about-intro">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-5 tp_fade_anim" data-delay=".3">
                <div class="dm-about-intro-label">Who We Are</div>
                <h2 class="dm-about-intro-title">Unleash the Power of eXcellence Beyond Numbers</h2>
            </div>
            <div class="col-lg-7 tp_fade_anim" data-delay=".5">
                <div class="dm-about-intro-text">
                    <p>At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation. We specialize in outsourced accounting, bookkeeping, financial reporting, virtual CFO services, audit support, compliance solutions, and M&A Services.</p>
                    <p>With a structured delivery model and trained finance professionals, Dev Mantra supports clients across industries with accuracy, efficiency, and data security at its core. With over &#8377;5,000 crore (~USD 558 million) in transactions and 150+ years of combined leadership experience, we bring deep expertise to every engagement.</p>
                    <p>N. Tatia & Associates, our professionally managed, peer-reviewed firm offers assurance, taxation, and advisory services. Known for its partner-driven approach, compliance expertise, and strong governance framework — ensuring every client engagement adheres to the highest professional standards.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission & Vision -->
<div class="dm-about-mv">
    <div class="container container-1230">
        <div class="row g-4">
            <div class="col-md-6 tp_fade_anim" data-delay=".3">
                <div class="dm-mv-card">
                    <h4>Our Mission</h4>
                    <p>To empower businesses across the globe by providing comprehensive financial and management consulting services that drive growth, ensure compliance, and enhance operational efficiency. We strive to build lasting relationships with our clients based on trust, transparency, and a deep understanding of their unique needs.</p>
                </div>
            </div>
            <div class="col-md-6 tp_fade_anim" data-delay=".5">
                <div class="dm-mv-card">
                    <h4>Our Vision</h4>
                    <p>To be a trusted global financial services partner for CPA firms and businesses seeking reliability, expertise, and scalable support. Guided by core values of trust, transparency, and professionalism, our client-first approach and local insight help us deliver consistent value and long-term impact.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Values -->
<div class="dm-about-values">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <div class="dm-about-section-label">What Drives Us</div>
            <h3 class="dm-about-section-title">Our Values</h3>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".3">
                <div class="dm-value-item">
                    <div class="dm-value-item-icon"><img src="{{ asset('assets/img/logo/icon/1.png') }}" alt=""></div>
                    <h5>Trust</h5>
                    <p>We build strong, lasting relationships with our clients based on mutual trust and respect. Our commitment to integrity ensures that we always act in the best interest of our clients.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".4">
                <div class="dm-value-item">
                    <div class="dm-value-item-icon"><img src="{{ asset('assets/img/logo/icon/2.png') }}" alt=""></div>
                    <h5>Transparency</h5>
                    <p>We maintain open and honest communication, ensuring our clients are fully informed and confident in their financial decisions.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".5">
                <div class="dm-value-item">
                    <div class="dm-value-item-icon"><img src="{{ asset('assets/img/logo/icon/3.png') }}" alt=""></div>
                    <h5>Integrity</h5>
                    <p>We uphold the highest ethical standards in all our dealings, ensuring fairness and honesty. Integrity is the foundation of our practice, guiding our actions and decisions.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".6">
                <div class="dm-value-item">
                    <div class="dm-value-item-icon"><img src="{{ asset('assets/img/logo/icon/4.png') }}" alt=""></div>
                    <h5>Tech Integration</h5>
                    <p>We leverage the latest technology to provide innovative solutions that enhance efficiency, accuracy, and convenience for our clients.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".7">
                <div class="dm-value-item">
                    <div class="dm-value-item-icon"><img src="{{ asset('assets/img/logo/icon/5.png') }}" alt=""></div>
                    <h5>Excellence</h5>
                    <p>We are committed to delivering the highest quality services and continuously improving our processes. Our dedication to excellence drives us to exceed client expectations.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".8">
                <div class="dm-value-item">
                    <div class="dm-value-item-icon"><img src="{{ asset('assets/img/logo/icon/6.png') }}" alt=""></div>
                    <h5>Client-Centric Approach</h5>
                    <p>We prioritize the needs and goals of our clients, offering tailored solutions that align with their unique requirements.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Overview -->
@if($services->count())
<div class="dm-about-services">
    <div class="container container-1230">
        <div class="text-center mb-50 tp_fade_anim" data-delay=".3">
            <div class="dm-about-section-label" style="color:rgba(255,255,255,0.35);">What We Do</div>
            <h3 class="dm-about-section-title" style="color:#fff;">Our Expertise</h3>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 6) }}">
                <div class="dm-about-service-card">
                    <h5>{{ $service->title }}</h5>
                    <p>{{ Str::limit($service->short_description, 120) }}</p>
                    <a href="{{ route('service.show', $service->slug) }}">Learn More &rarr;</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- CTA -->
<div class="dm-about-cta">
    <div class="container container-1230">
        <h3 class="tp_fade_anim" data-delay=".3">Ready to Transform Your Business?</h3>
        <p class="tp_fade_anim" data-delay=".5">Let's discuss how Dev Mantra can help you achieve your financial goals.</p>
        <a href="{{ route('contact') }}" class="dm-about-cta-btn tp_fade_anim" data-delay=".7">
            Book a Free Consultation
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
            </svg>
        </a>
    </div>
</div>

@endsection
