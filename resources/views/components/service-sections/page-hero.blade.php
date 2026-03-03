@props(['data' => []])
@php
    $subtitle            = $data['subtitle']              ?? 'Commitment to Your Financial Success';
    $title               = $data['title']                 ?? "Unleash the Power of\neXcellence Beyond Numbers";
    $description         = $data['description']           ?? '';
    $ctaText             = $data['cta_text']              ?? 'Book a Free Consultation';
    $ctaUrl              = $data['cta_url']               ?? '#';
    $secondaryButtonLink = $data['secondary_button_link'] ?? '';
@endphp

@once
@push('styles')
<style>
.cr-hero-btn-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
}
.cr-hero-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    border-radius: 30px;
    text-decoration: none;
    white-space: nowrap;
    transition: opacity 0.25s, transform 0.25s, box-shadow 0.25s;
    box-shadow: 0 6px 24px rgba(27, 60, 107, 0.45);
    font-family: var(--tp-ff-onest);
}
.cr-hero-btn-secondary:hover {
    opacity: 0.88;
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(27, 60, 107, 0.55);
    color: #fff;
}
.cr-hero-btn-secondary span {
    display: inline-flex;
    align-items: center;
}
@media (max-width: 575px) {
    .cr-hero-btn-wrap { flex-direction: column; gap: 10px; }
    .cr-hero-btn-secondary { font-size: 13px; padding: 12px 22px; }
}
</style>
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
@endpush
@endonce

<div style="background-color: black;" class="cr-hero-area fix cr-hero-ptb p-relative pt-170">
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
                        @if($ctaText)
                        <a href="{{ $ctaUrl }}" class="tp-btn-white-border">{{ $ctaText }}
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                            </svg></span>
                        </a>
                        @endif
                        @if($secondaryButtonLink)
                        <a href="{{ $secondaryButtonLink }}" class="cr-hero-btn-secondary">Get a Free Financial Review
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                            </svg></span>
                        </a>
                        @endif
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
