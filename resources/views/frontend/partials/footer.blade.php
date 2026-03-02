@php $footerContact = \App\Models\ContactSetting::instance(); @endphp
<footer class="z-index-1 include-bg">
    <div class="cr-footer-bg">
        <img src="{{ asset('assets/img/home-13/footer/cr-footer-bg.png') }}" alt="">
    </div>
    <div class="dgm-footer-area cr-footer-area pb-60">
        <div class="container container-1230">
            <div class="cr-footer-border-wrap pt-140">
                <div class="cr-footer-inner-warp z-index-1">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 mb-40 tp_fade_anim" data-delay=".3">
                            <div class="dgm-footer-widget cr-footer-col-1 z-index-1">
                                <div class="dgm-footer-logo mb-20">
                                    <a href="{{ route('home') }}"><img style="border-radius: 20px;" data-width="160px" src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra"></a>
                                </div>
                                <div class="dgm-footer-widget-paragraph mb-30">
                                    <p>Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy.</p>
                                </div>
                                <div class="cr-footer-widget-social mb-35">
                                    <div class="tp-footer-widget-social">
                                        <a href="{{ $footerContact->facebook_url ?? 'javascript:void(0)' }}" {{ $footerContact->facebook_url ? 'target="_blank" rel="noopener"' : '' }} aria-label="Facebook"><span><i class="fa-brands fa-facebook-f"></i></span></a>
                                        <a href="{{ $footerContact->twitter_url ?? 'javascript:void(0)' }}" {{ $footerContact->twitter_url ? 'target="_blank" rel="noopener"' : '' }} aria-label="X"><span><i class="fa-brands fa-x-twitter"></i></span></a>
                                        <a href="{{ $footerContact->linkedin_url ?? 'javascript:void(0)' }}" {{ $footerContact->linkedin_url ? 'target="_blank" rel="noopener"' : '' }} aria-label="LinkedIn"><span><i class="fa-brands fa-linkedin-in"></i></span></a>
                                        <a href="{{ $footerContact->instagram_url ?? 'javascript:void(0)' }}" {{ $footerContact->instagram_url ? 'target="_blank" rel="noopener"' : '' }} aria-label="Instagram"><span><i class="fa-brands fa-instagram"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 mb-40 tp_fade_anim" data-delay=".5">
                            <div class="dgm-footer-widget app-footer-widget cr-footer-col-2">
                                <h4 class="dgm-footer-widget-title">Quick Links</h4>
                                <div class="dgm-footer-widget-menu">
                                    <ul>
                                        <li><a href="{{ route('home') }}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                        <li><a href="{{ route('newsletter.index') }}">Newsletter</a></li>
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-3 mb-40 tp_fade_anim" data-delay=".7">
                            <div class="dgm-footer-widget app-footer-widget cr-footer-col-3">
                                <h4 class="dgm-footer-widget-title">Expertise</h4>
                                <div class="dgm-footer-widget-menu">
                                    <ul>
                                        @php $footerServices = \App\Models\Service::published()->orderBy('sort_order')->take(5)->get(); @endphp
                                        @foreach($footerServices as $fs)
                                        <li><a href="{{ route('service.show', $fs->slug) }}">{{ $fs->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3 mb-40 tp_fade_anim" data-delay=".9">
                            <div class="dgm-footer-widget app-footer-widget cr-footer-col-4">
                                <h4 class="dgm-footer-widget-title">Contact</h4>
                                @if($footerContact->phone)
                                <div class="app-footer-widget-info mb-20">
                                    <div class="app-footer-widget-info-title">Call us</div>
                                    <a class="tp-line-white" href="tel:{{ preg_replace('/[^0-9+]/', '', $footerContact->phone) }}">{{ $footerContact->phone }}</a>
                                </div>
                                @endif
                                @if($footerContact->email)
                                <div class="app-footer-widget-info mb-20">
                                    <div class="app-footer-widget-info-title">Email</div>
                                    <a class="tp-line-white" href="mailto:{{ $footerContact->email }}">{{ $footerContact->email }}</a>
                                </div>
                                @endif
                                @if($footerContact->address)
                                <div class="app-footer-widget-info">
                                    <div class="app-footer-widget-info-title">Address</div>
                                    <a>{{ $footerContact->address }}</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tp-copyright-2-area tp-copyright-2-border cr-copyright-border">
        <div class="container container-1430">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="app-copyright-text text-center z-index-1">
                        <p>&copy; {{ date('Y') }} Dev Mantra. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
