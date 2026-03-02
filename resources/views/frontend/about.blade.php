@extends('layouts.frontend')
@section('title', 'About Us - DevMantra')
@section('meta_description', 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy. Founded in 2008 in Bengaluru.')

@push('styles')
<style>
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

<!-- Services Cards (same as homepage) -->
<div class="cr-feature-area">
    <div class="container container-1230">
        <div class="cr-feature-inner-box">
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
                                    specializing in outsourced accounting, bookkeeping, financial reporting,
                                    virtual CFO services, audit support, compliance solutions and M&amp;A Services.
                                    With a structured delivery model and trained finance professionals,
                                    Dev Mantra supports clients across industries with accuracy, efficiency,
                                    and data security at its core. With over ₹5,000 crore (~USD 558 million)
                                    in transactions and 150+ years of combined leadership experience,
                                    we bring deep expertise to every engagement.
                                </p>
                            </div>
                            <div class="cr-feature-thumb text-center anim-zoomin-wrap" style="padding:25px;">
                                <div class="cr-feature-thumb text-start" style="padding:25px 35px;">
                                    <div class="metric">
                                        <span>Accounting &amp; Bookkeeping</span>
                                        <div class="bar"><div style="width:95%"></div></div>
                                    </div>
                                    <div class="metric">
                                        <span>Financial Reporting</span>
                                        <div class="bar"><div style="width:90%"></div></div>
                                    </div>
                                    <div class="metric">
                                        <span>Virtual CFO Services</span>
                                        <div class="bar"><div style="width:85%"></div></div>
                                    </div>
                                    <div class="metric">
                                        <span>Audit Support &amp; Compliance</span>
                                        <div class="bar"><div style="width:88%"></div></div>
                                    </div>
                                    <div class="metric">
                                        <span>M&amp;A Services</span>
                                        <div class="bar"><div style="width:82%"></div></div>
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
                                    taxation, and advisory services. Known for its partner-driven approach,
                                    compliance expertise, and strong governance framework — ensuring every
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
                                <div class="cr-feature-thumb big text-center" style="padding:20px 30px;">
                                    <div class="mv-grid">
                                        <div class="mv-card">
                                            <h4>Our Mission</h4>
                                            <p>
                                                To empower businesses across the globe by providing
                                                comprehensive financial and management consulting services
                                                that drive growth, ensure compliance, and enhance operational
                                                efficiency. We strive to build lasting relationships with
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

<!-- 6A Strategy Framework (same as homepage) -->
<section class="dm-6a-section">
    <div class="container container-1230">
        <div class="dm-6a-inner">
            <div class="dm-6a-header text-center">
                <span class="tp-section-subtitle-gradient ct">Our Framework</span>
                <h2 class="dm-6a-title">The 6A Strategy Framework</h2>
                <p class="dm-6a-subtitle">A proven, structured approach that guides businesses from
                    assessment to transformation — at every stage of growth.</p>
            </div>
            <div class="dm-6a-track">
                <div class="dm-6a-row">
                    <div class="dm-6a-node" data-index="0">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">01</span></div>
                        <h5 class="dm-6a-node-title">Assess</h5>
                        <p class="dm-6a-node-desc">Evaluate your business's current state by analyzing finances, operations, marketing, and personnel to identify gaps and opportunities.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="1">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">02</span></div>
                        <h5 class="dm-6a-node-title">Analyze</h5>
                        <p class="dm-6a-node-desc">Perform a SWOT analysis to understand strengths, weaknesses, opportunities, and threats for informed decision-making.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="2">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">03</span></div>
                        <h5 class="dm-6a-node-title">Align</h5>
                        <p class="dm-6a-node-desc">Ensure business goals and strategies are cohesive, setting clear objectives and tracking progress for greater efficiency.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="3">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">04</span></div>
                        <h5 class="dm-6a-node-title">Action</h5>
                        <p class="dm-6a-node-desc">Implement your action plan with SMART goals, monitoring progress, and making adjustments to stay on track.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="4">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">05</span></div>
                        <h5 class="dm-6a-node-title">Accountability</h5>
                        <p class="dm-6a-node-desc">Take ownership of your actions, provide regular updates, and maintain transparency to build trust and drive improvement.</p>
                    </div>
                    <div class="dm-6a-connector"></div>
                    <div class="dm-6a-node" data-index="5">
                        <div class="dm-6a-circle"><span class="dm-6a-step-num">06</span></div>
                        <h5 class="dm-6a-node-title">Adaptability</h5>
                        <p class="dm-6a-node-desc">Be flexible and open to change, adjusting strategies based on evolving market conditions and feedback to stay competitive.</p>
                    </div>
                </div>
            </div>
            <div class="dm-6a-cta">
                <a href="{{ route('contact') }}" class="tp-btn-white-border">Book a Free Consultation</a>
            </div>
        </div>
    </div>
</section>

@endsection
