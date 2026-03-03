@props(['data' => []])
@php
    $title    = $data['title']    ?? 'What We Do';
    $subtitle = $data['subtitle'] ?? 'Comprehensive financial and advisory services tailored for your business growth.';
    $services = \App\Models\Service::where('status', 'published')->orderBy('sort_order')->get();
@endphp

<section class="dm-hscroll-section" >
    <div class="dm-hscroll-pin">
        <div class="dm-hscroll-header">
            <h2 class="dm-hscroll-title">{{ $title }}</h2>
            <p class="dm-hscroll-subtitle">{{ $subtitle }}</p>
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

@once
@push('scripts')
<script>
(function () {
    var MOBILE_BP = 991;

    // gsap.registerPlugin(ScrollTrigger) removed — plugin.js already registers it
    // before window.load fires, so it's available when initHScroll() is called.

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

        // Extra gap so the last card fully clears the right edge
        var scrollDistance = cards.scrollWidth - window.innerWidth + 60;
        if (scrollDistance <= 0) return;

        gsap.to(cards, {
            x: -scrollDistance,
            ease: "none",
            scrollTrigger: {
                id: "dm-hscroll",
                trigger: section,
                pin: true,
                scrub: 0.6,           // low lag = snappy yet smooth
                start: "top top",
                end: "+=" + scrollDistance,
                anticipatePin: 1,     // pre-renders pin position, kills jump
                fastScrollEnd: true,  // smooth deceleration after fast fling
                invalidateOnRefresh: true
            }
        });
    }

    var swiperInstance = null;

    function initSwiper() {
        if (window.innerWidth > MOBILE_BP) {
            if (swiperInstance) { swiperInstance.destroy(true, true); swiperInstance = null; }
            return;
        }
        if (swiperInstance) return;

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

    window.addEventListener("load", function () {
        initHScroll();
        initSwiper();
        // Refresh once all card images have decoded so dimensions are exact
        if (cards) {
            var imgs = Array.from(cards.querySelectorAll("img"));
            var pending = imgs.filter(function (img) { return !img.complete; });
            if (pending.length) {
                Promise.all(
                    pending.map(function (img) {
                        return new Promise(function (res) {
                            img.addEventListener("load", res, { once: true });
                            img.addEventListener("error", res, { once: true });
                        });
                    })
                ).then(function () { ScrollTrigger.refresh(); });
            }
        }
    });

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
@endonce
