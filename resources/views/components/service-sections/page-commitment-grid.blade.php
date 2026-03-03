@props(['data' => []])
@php
    $label       = $data['label']       ?? 'Our Commitment';
    $title       = $data['title']       ?? 'Our Commitment to Your Financial Success';
    $description = $data['description'] ?? 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy';
@endphp

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
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-1.png') }}" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-2.png') }}" alt=""></div></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-3.png') }}" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-4.png') }}" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-5.png') }}" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-6.png') }}" alt=""></div></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-7.png') }}" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-8.png') }}" alt=""></div></div></div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CENTER CONTENT -->
            <div class="col-xxl-4 order-xl-12 order-1 order-xxl-2">
                <div class="cr-feature-2-heading text-center">
                    <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">{{ $label }}</div>
                    <h4 class="tp-section-title-onest tp-text-revel-anim">{{ $title }}</h4>
                    <div class="tp_text_anim"><p>{{ $description }}</p></div>
                    <div class="cr-feature-2-btn tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                        <a href="javascript:void(0)" class="tp-btn-white-border">Find out more
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none"><path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/></svg></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- RIGHT GRID -->
            <div class="col-xxl-4 col-xl-6 order-2 order-xxl-3">
                <div class="cr-feature-2-right">
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0 justify-content-end">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-9.png') }}" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-10.png') }}" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-11.png') }}" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-12.png') }}" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-13.png') }}" alt=""></div></div></div>
                        </div>
                    </div>
                    <div class="cr-feature-2-box">
                        <div class="row row-cols-xl-5 gx-0">
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-14.png') }}" alt=""></div></div></div>
                            <div class="col"></div>
                            <div class="col"><div class="cr-feature-2-item"><span class="bullet-top-left"></span><span class="bullet-top-right"></span><span class="bullet-bottom-left"></span><span class="bullet-bottom-right"></span><div class="cr-feature-2-item-icon animation-2"><img src="{{ asset('assets/img/home-13/feature/feature-2/feature-2-15.png') }}" alt=""></div></div></div>
                            <div class="col"><div class="cr-feature-2-item"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
