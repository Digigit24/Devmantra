@props(['data' => []])
@php
    $title    = $data['title']    ?? 'Ready to Elevate Your Business with Dev Mantra?';
    $subtitle = $data['subtitle'] ?? 'Dev Mantra is here to help you scale with confidence through future-ready financial, governance, and advisory solutions.';
    $ctaText  = $data['cta_text'] ?? null;
    $ctaUrl   = $data['cta_url']  ?? null;
@endphp

@once
@push('styles')
<style>
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
@endonce

<!-- CTA section start -->
<div class="cr-cta-area-light">
    <div class="cr-cta-ptb p-relative pt-50 pb-100">
        <div class="cr-cta-bg">
            <img src="{{ asset('assets/img/home-13/cta/cta-thumb-bg.png') }}" alt="" loading="lazy">
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
                            <img src="{{ asset('assets/img/home-13/cta/cta-thumb.gif') }}" alt="" loading="lazy">
                        </div>
                        <h4 class="tp-section-title-onest fs-50 tp-text-revel-anim" style="color: #111;">
                            {!! nl2br(e($title)) !!}
                        </h4>
                        <div class="tp_text_anim">
                            <p class="cr-cta-text" style="color: #555;">{{ $subtitle }}</p>
                        </div>
                        <div class="cr-cta-btn tp_fade_anim" data-delay=".7" data-fade-from="top" data-ease="bounce">
                            <x-btn-primary :url="$ctaUrl" :text="$ctaText" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CTA section end -->
