@props(['data' => []])
@php
    $clienteleTitle      = $data['clientele_title']      ?? 'Our Clientele';
    $featuresLabel       = $data['features_label']       ?? 'What We Do';
    $featuresTitle       = $data['features_title']       ?? 'Services to Boost Business Growth';
    $featuresDescription = $data['features_description'] ?? '';
@endphp

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
                            <p>{{ $clienteleTitle }}</p>
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
                        <div class="tp-section-subtitle-gradient ct mb-20">{{ $featuresLabel }}</div>
                        <h4 class="tp-section-title-onest fs-72">{{ $featuresTitle }}</h4>
                        @if($featuresDescription)
                        <div class="tp_text_anim">
                            <p style="padding: 20px;">{{ $featuresDescription }}</p>
                        </div>
                        @endif
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
                                    <span><img src="{{ asset('assets/img/home-13/feature/feature-icon-1.png') }}" alt=""></span>
                                    <h5 class="cr-feature-item-icon-title">Dev Mantra Financial Services</h5>
                                </div>
                                <p>A Bengaluru-based financial services company founded in 2008, specializing in outsourced accounting, bookkeeping, financial reporting, virtual CFO services, audit support, compliance solutions and M&amp;A Services. With a structured delivery model and trained finance professionals, Dev Mantra supports clients across industries with accuracy, efficiency, and data security at its core. With over ₹5,000 crore (~USD 558 million) in transactions and 150+ years of combined leadership experience, we bring deep expertise to every engagement.</p>
                            </div>
                            <div class="cr-feature-thumb text-center anim-zoomin-wrap" style="padding:25px;">
                                <div class="cr-feature-thumb text-start" style="padding:25px 35px;">
                                    <div class="metric"><span>Accounting &amp; Bookkeeping</span><div class="bar"><div style="width:95%"></div></div></div>
                                    <div class="metric"><span>Financial Reporting</span><div class="bar"><div style="width:90%"></div></div></div>
                                    <div class="metric"><span>Virtual CFO Services</span><div class="bar"><div style="width:85%"></div></div></div>
                                    <div class="metric"><span>Audit Support &amp; Compliance</span><div class="bar"><div style="width:88%"></div></div></div>
                                    <div class="metric"><span>M&amp;A Services</span><div class="bar"><div style="width:82%"></div></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2 — N. Tatia & Associates -->
                    <div class="col-md-6">
                        <div class="cr-feature-item mb-15">
                            <div class="cr-feature-item-content">
                                <div class="cr-feature-item-icon d-flex">
                                    <span><img src="{{ asset('assets/img/home-13/feature/feature-icon-2.png') }}" alt=""></span>
                                    <h5 class="cr-feature-item-icon-title">N. Tatia &amp; Associates</h5>
                                </div>
                                <p>A professionally managed, peer-reviewed firm offering assurance, taxation, and advisory services. Known for its partner-driven approach, compliance expertise, and strong governance framework — ensuring every client engagement adheres to the highest professional standards.</p>
                                <p style="margin-top:14px; font-style:italic; opacity:0.85;">Guided by core values of trust, transparency, and professionalism, our client-first approach and local insight help us deliver consistent value and long-term impact.</p>
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
                                            <p>To empower businesses across the globe by providing comprehensive financial and management consulting services that drive growth, ensure compliance, and enhance operational efficiency. We strive to build lasting relationships with our clients based on trust, transparency, and a deep understanding of their unique needs.</p>
                                        </div>
                                        <div class="mv-card">
                                            <h4>Our Vision</h4>
                                            <p>To be a trusted global financial services partner for CPA firms and businesses seeking reliability, expertise, and scalable support.</p>
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
                        <div class="tp-section-subtitle-gradient ct mb-15">What Drives Us</div>
                        <h4 class="tp-section-title-onest" style="font-size:42px;">Our Values</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="dm-values-grid">
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="{{ asset('assets/img/logo/icon/1.png') }}" alt=""></div>
                            <h5>Trust</h5>
                            <p style="color: black;">We build strong, lasting relationships with our clients based on mutual trust and respect. Our commitment to integrity ensures that we always act in the best interest of our clients.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="{{ asset('assets/img/logo/icon/2.png') }}" alt=""></div>
                            <h5>Transparency</h5>
                            <p style="color: black;">We maintain open and honest communication, ensuring our clients are fully informed and confident in their financial decisions.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="{{ asset('assets/img/logo/icon/3.png') }}" alt=""></div>
                            <h5>Integrity</h5>
                            <p style="color: black;">We uphold the highest ethical standards in all our dealings, ensuring fairness and honesty. Integrity is the foundation of our practice, guiding our actions and decisions.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="{{ asset('assets/img/logo/icon/4.png') }}" alt=""></div>
                            <h5>Tech Integration</h5>
                            <p style="color: black;">We leverage the latest technology to provide innovative solutions that enhance efficiency, accuracy, and convenience for our clients.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="{{ asset('assets/img/logo/icon/5.png') }}" alt=""></div>
                            <h5>Excellence</h5>
                            <p style="color: black;">We are committed to delivering the highest quality services and continuously improving our processes. Our dedication to excellence drives us to exceed client expectations.</p>
                        </div>
                        <div class="dm-value-card">
                            <div class="dm-value-icon"><img src="{{ asset('assets/img/logo/icon/6.png') }}" alt=""></div>
                            <h5>Client-Centric Approach</h5>
                            <p style="color: black;">We prioritize the needs and goals of our clients, offering tailored solutions that align with their unique requirements.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
