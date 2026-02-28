<style>
    .tp-header-menu > nav > ul { display: flex; flex-wrap: nowrap; align-items: center; }
    .tp-header-menu > nav > ul > li { flex-shrink: 0; }
    .tp-header-btn-box .tp-btn-white-border { white-space: nowrap; }
    @media (min-width: 1200px) and (max-width: 1399px) {
        .tp-header-menu > nav > ul > li { margin: 0 10px; }
        .tp-header-menu > nav > ul > li > a { font-size: 15px; }
        .tp-header-btn-box .tp-btn-white-border { font-size: 13px; padding: 10px 16px; }
    }
    @media (min-width: 1400px) and (max-width: 1599px) {
        .tp-header-menu > nav > ul > li { margin: 0 14px; }
        .tp-header-menu > nav > ul > li > a { font-size: 15px; }
    }
    @media (min-width: 1600px) {
        .tp-header-menu > nav > ul > li { margin: 0 18px; }
    }
    @media (max-width: 1199px) {
        .tp-header-right .tp-header-btn-box { display: none !important; }
    }
    @media (min-width: 768px) and (max-width: 1199px) {
        .tp-header-right .tp-header-btn-box:first-of-type { display: block !important; }
        .tp-header-right .tp-header-btn-box .tp-btn-white-border { font-size: 13px; padding: 10px 16px; }
    }
</style>

<!-- Offcanvas -->
<div class="tp-offcanvas-area">
    <div class="tp-offcanvas-wrapper">
        <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">
            <div class="tp-offcanvas-logo">
                <a href="{{ route('home') }}">
                    <img class="logo-1" data-width="120" src="{{ asset('assets/img/logo/logo-black.png') }}" alt="Dev Mantra">
                    <img class="logo-2" data-width="120" src="{{ asset('assets/img/logo/logo-white.png') }}" alt="Dev Mantra">
                </a>
            </div>
            <div class="tp-offcanvas-close">
                <button class="tp-offcanvas-close-btn">
                    <svg width="37" height="38" viewBox="0 0 37 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.19141 9.80762L27.5762 28.1924" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.19141 28.1924L27.5762 9.80761" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="tp-offcanvas-main">
            <div class="tp-offcanvas-content d-none d-xl-block">
                <h3 class="tp-offcanvas-title">Dev Mantra</h3>
                <p>Strategic partner in progress for businesses operating in a global and digital economy.</p>
            </div>
            <div class="tp-offcanvas-menu d-xl-none">
                <nav></nav>
            </div>
            <div class="tp-offcanvas-contact">
                <h3 class="tp-offcanvas-title sm">Information</h3>
                <ul>
                    <li><a href="tel:+918042061247">+91-8042061247</a></li>
                    <li><a href="mailto:support@devmantra.com">support@devmantra.com</a></li>
                    <li><a href="#">Bengaluru, India</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>

<!-- Header -->
<header>
    <div id="header-sticky" class="tp-header-area tp-header-13-ptb sticky-white-bg tp-header-blur header-transparent">
        <div class="container container-1750">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-5 col-5">
                    <div class="tp-header-logo">
                        <a href="{{ route('home') }}"><img style="border-radius: 50px;" data-width="140" src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra"></a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-7 col-7">
                    <div class="tp-header-box d-flex align-items-center justify-content-end justify-content-xl-between">
                        <div class="tp-header-menu tp-header-13-menu tp-header-dropdown dropdown-black-bg d-none d-xl-flex">
                            <nav class="tp-mobile-menu-active">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ url('/about') }}">About Us</a></li>
                                    <li class="has-dropdown">
                                        <a href="javascript:void(0)">Expertise</a>
                                        <ul class="tp-submenu submenu">
                                            @php $navServices = \App\Models\Service::published()->orderBy('sort_order')->get(); @endphp
                                            @foreach($navServices as $navService)
                                            <li><a href="{{ route('service.show', $navService->slug) }}">{{ $navService->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="javascript:void(0)">Insights</a>
                                        <ul class="tp-submenu submenu">
                                            <li><a href="{{ route('newsletter.index') }}">Newsletters</a></li>
                                            <li><a href="{{ route('blog.index') }}">Blogs</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="tp-header-right d-flex align-items-center justify-content-end">
                            <div class="tp-header-btn-box d-none d-md-block ml-15">
                                <a href="{{ url('/contact') }}" class="tp-btn-white-border">Free Consultation
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                        <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"></path>
                                    </svg></span>
                                </a>
                            </div>
                            <div class="tp-header-bar ml-20 d-xl-none">
                                <button class="tp-offcanvas-open-btn">
                                    <i></i><i></i><i></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
