@props(['data' => []])
@php
    $title    = $data['title']    ?? 'Countries that we serve';
    $subtitle = $data['subtitle'] ?? 'We work with clients across the globe, delivering solutions without borders.';
@endphp

<section class="cr-world-area cr-brand-ptb fix">
    <div class="container container-1230">
        <div class="cr-multi-border pt-100 pb-50">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center mb-60">
                    <h3 class="tp-section-title-onest fs-72">{{ $title }}</h3>
                    <p>{{ $subtitle }}</p>
                </div>
                <div class="col-lg-10">
                    <div class="world-map-box">
                        <div class="map-base">
                            <img src="{{ asset('assets/img/logo/map.png') }}" alt="">
                        </div>
                        <svg class="map-overlay" viewBox="0 0 1000 500" xmlns="http://www.w3.org/2000/svg">
                            <g id="pins">
                                <circle class="pin" cx="190" cy="180" r="6" data-country="USA"></circle>
                                <circle class="pin" cx="445" cy="165" r="6" data-country="UK"></circle>
                                <circle class="pin" cx="510" cy="210" r="6" data-country="Italy"></circle>
                                <circle class="pin" cx="620" cy="270" r="6" data-country="Oman"></circle>
                                <circle class="pin" cx="695" cy="310" r="6" data-country="Sri Lanka"></circle>
                                <circle class="pin" cx="760" cy="325" r="6" data-country="Singapore"></circle>
                                <circle class="pin" cx="840" cy="395" r="6" data-country="Australia"></circle>
                            </g>
                        </svg>
                        <div class="map-tooltip" id="mapTooltip"></div>
                    </div>

                    {{-- Mobile-only country list --}}
                    <div class="map-mobile-list">
                        @foreach(['USA','UK','Italy','Oman','Sri Lanka','Singapore','Australia'] as $country)
                        <span class="map-mobile-tag">{{ $country }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@once
@push('scripts')
<script>
(function () {
    var pins = document.querySelectorAll(".pin");
    var box = document.querySelector(".world-map-box");
    if (!pins.length || !box) return;

    var oldTooltip = document.getElementById("mapTooltip");
    if (oldTooltip) oldTooltip.remove();

    // Only render floating tooltips on non-mobile
    if (window.innerWidth <= 767) return;

    pins.forEach(function (pin) {
        var name = pin.getAttribute("data-country");
        var tip = document.createElement("div");
        tip.className = "map-tooltip map-tooltip-always";
        tip.textContent = name;
        box.appendChild(tip);

        function positionTip() {
            if (window.innerWidth <= 767) { tip.style.display = "none"; return; }
            tip.style.display = "";
            var rect = box.getBoundingClientRect();
            var pt = pin.getBoundingClientRect();
            tip.style.left = (pt.left - rect.left + pt.width / 2) + "px";
            tip.style.top = (pt.top - rect.top) + "px";
        }

        window.addEventListener("load", positionTip);
        window.addEventListener("resize", positionTip);
        setTimeout(positionTip, 200);
        setTimeout(positionTip, 800);
    });
})();
</script>
@endpush
@endonce
