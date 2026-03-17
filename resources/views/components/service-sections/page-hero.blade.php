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

/* ── Card animation hero ─────────────────────────────── */
.cr-hero-area { position: relative; overflow: hidden; min-height: 100vh; }
.cr-hero-area > .container-fluid { position: relative; z-index: 5; }
.dm-hero-scene {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    perspective: 1200px;
    pointer-events: none;
    overflow: hidden;
}
.dm-hero-scene .card {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    object-fit: cover;
    will-change: transform;
    transform-style: preserve-3d;
    pointer-events: none;
}
.dm-hero-scene .card-top { z-index: 2; }
.dm-hero-scene .card-topbg { z-index: 1; }
.dm-hero-scene .card-text { z-index: 3; }
.dm-hero-scene .card-bottom {
    z-index: 14;
    filter: brightness(0.95);
}
.dm-hero-scene .hover-zone {
    position: absolute;
    width: 400px;
    height: 200px;
    top: 50%;
    right: 30%;
    transform: translateY(-50%);
    z-index: 50;
    pointer-events: auto;
}
/* Content layers above the scene */
.cr-hero-area .cr-hero-heading,
.cr-hero-area .cr-hero-content { pointer-events: none; position: relative; z-index: 5; }
.cr-hero-area .cr-hero-btn-wrap,
.cr-hero-area .cr-hero-btn-wrap a,
.cr-hero-area .cr-hero-btn-wrap button { pointer-events: auto; }
.cr-hero-area .cr-hero-left,
.cr-hero-area .cr-hero-right { z-index: 2; }
</style>
@endpush
@endonce

<div style="background-color: #0b0f14;" class="cr-hero-area fix cr-hero-ptb p-relative pt-170">
    <div class="dm-hero-scene">
        <img src="https://i.ibb.co/cc5cXJyP/card1.webp" class="card card-top" alt="" />
        <img src="https://i.ibb.co/xqHCcQj0/background.webp" class="card card-topbg" alt="" />
        <img src="https://i.ibb.co/4ngJL4jK/Connecting-Card-1-1536x695-4.webp" class="card card-text" alt="" />
        <img src="https://i.ibb.co/cXtnRh6H/card2.webp" class="card card-bottom" alt="" />
        <div class="hover-zone"></div>
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
                        @if(request()->routeIs('home'))
                        <p style="margin-bottom: 150px; max-width: 820px; margin-left: auto; margin-right: auto;">
                            At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment<br>
                            to excellence, integrity, and innovation. Our mission is to deliver top-notch global financial<br>
                            and management consulting services that are tailored to meet the unique needs of our clients<br>
                            world wide. Our growth strategy includes not just strengthening business processes and reporting,<br>
                            it expands building new business synergies, verticals, geographies, and complementary partnerships globally.
                        </p>
                        @elseif($description)
                        <p style="margin-bottom: 150px;">{{ $description }}</p>
                        @else
                        <p style="margin-bottom: 150px;">&nbsp;</p>
                        @endif
                    </div>
                    @if(!request()->routeIs('home'))
                    <div class="cr-hero-btn-wrap">
                        {{-- Primary: text/URL from section_data; falls back to global SiteSetting --}}
                        <x-btn-primary :url="$ctaUrl" :text="$ctaText" />
                        {{-- Secondary: link + text entirely from global SiteSetting --}}
                        <x-btn-secondary />
                    </div>
                    @endif
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

@once
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;

    gsap.registerPlugin(ScrollTrigger);

    /* 1. Create timeline */
    var tl = gsap.timeline({ paused: true });
    tl.to(".dm-hero-scene .card-bottom", {
        y: -46, x: 26, z: 10,
        rotationX: 0, rotationY: 0, scale: 1,
        ease: "power3.out", duration: 1
    }, 0)
    .to(".dm-hero-scene .card-text", {
        opacity: 1, y: 0,
        duration: 0.8, ease: "power2.out"
    }, 0.2);

    /* 2. Initial state */
    gsap.set(".dm-hero-scene .card-bottom", {
        y: 40, x: -50, z: -100,
        rotationX: -12, rotationY: 15, scale: 0.96
    });
    gsap.set(".dm-hero-scene .card-text", {
        opacity: 0, y: 20
    });

    /* 3. Scroll control */
    var st = ScrollTrigger.create({
        trigger: ".cr-hero-area",
        start: "bottom 95%",
        end: "bottom 90%",
        scrub: 1.2,
        animation: tl
    });

    /* 4. Hover zone */
    var hoverZone = document.querySelector(".dm-hero-scene .hover-zone");
    var hoverTween = null;

    if (hoverZone) {
        hoverZone.addEventListener("mouseenter", function () {
            st.disable();
            if (hoverTween) hoverTween.kill();
            hoverTween = gsap.to(tl, {
                progress: 1, duration: 0.35, ease: "power2.out"
            });
        });

        hoverZone.addEventListener("mouseleave", function () {
            if (hoverTween) hoverTween.kill();
            hoverTween = gsap.to(tl, {
                progress: 0, duration: 0.35, ease: "power2.out",
                onComplete: function () { st.enable(); }
            });
        });
    }
});
</script>
@endpush
@endonce
