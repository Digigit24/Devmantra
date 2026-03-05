@props(['data' => []])
@php
    $subtitle = $data['subtitle'] ?? 'Commitment to Your Financial Success';
    $title    = $data['title']    ?? "Unleash the Power of\neXcellence Beyond Numbers";
    $description = $data['description'] ?? '';
    $ctaText  = $data['cta_text'] ?? null;   // null → x-btn-primary uses global setting
    $ctaUrl   = $data['cta_url']  ?? null;   // null → x-btn-primary uses global setting
@endphp

@once
@push('styles')
<style>
.cr-hero-btn-wrap {
    display: flex; align-items: center; justify-content: center;
    gap: 14px; flex-wrap: wrap;
}
@media (max-width: 575px) {
    .cr-hero-btn-wrap { flex-direction: column; gap: 10px; }
}
</style>
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
                        if (logo) { logo.remove(); observer.disconnect(); }
                    });
                    if (viewer.shadowRoot) observer.observe(viewer.shadowRoot, { childList: true, subtree: true });
                }
            };
            tryRemove();
        });
    }
    document.addEventListener('DOMContentLoaded', removeSplineLogo);
</script>
@endpush
@endonce

<div style="background-color: #001d30;" class="cr-hero-area fix cr-hero-ptb p-relative pt-170">
    <div class="cr-hero-bg cr-hero-spline">
        <spline-viewer url="https://prod.spline.design/xHLGA5-DjAiR6SRV/scene.splinecode"></spline-viewer>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cr-hero-heading text-center z-index-1">
                    <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">
                        {{ $subtitle }}
                    </div>
                    <h4 class="tp-section-title-onest fs-68 tp-text-revel-anim" data-delay=".5">
                        {!! nl2br(e($title)) !!}
                    </h4>
                </div>
                <div class="cr-hero-content text-center z-index-2">
                    <div class="tp_text_anim">
                        @if($description)
                        <p style="margin-bottom: 150px;">{{ $description }}</p>
                        @else
                        <p style="margin-bottom: 150px;">&nbsp;</p>
                        @endif
                    </div>
                    <div class="cr-hero-btn-wrap">
                        {{-- Primary: text/URL from section_data; falls back to global SiteSetting --}}
                        <x-btn-primary :url="$ctaUrl" :text="$ctaText" />
                        {{-- Secondary: link + text entirely from global SiteSetting --}}
                        <x-btn-secondary />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cr-hero-left">
        <div class="shape-1 tp_fade_anim" data-fade-from="left" data-delay=".5"><img src="{{ asset('assets/img/home-13/hero/hero-shape-1.png') }}" alt=""></div>
        <div class="shape-2 tp_fade_anim" data-fade-from="left" data-delay=".5"><img src="{{ asset('assets/img/home-13/hero/hero-shape-2.png') }}" alt=""></div>
    </div>
    <div class="cr-hero-right">
        <div class="shape-1 tp_fade_anim" data-fade-from="right" data-delay=".5"><img src="{{ asset('assets/img/home-13/hero/hero-shape-3.png') }}" alt=""></div>
        <div class="shape-2 tp_fade_anim" data-fade-from="right" data-delay=".5"><img src="{{ asset('assets/img/home-13/hero/hero-shape-4.png') }}" alt=""></div>
    </div>
</div>
