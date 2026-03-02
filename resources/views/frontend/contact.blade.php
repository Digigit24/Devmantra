@extends('layouts.frontend')
@section('title', 'Contact Us - DevMantra')
@section('meta_description', 'Get in touch with Dev Mantra. We are here to help with your financial and advisory needs.')

@push('styles')
<style>
    /* Hero */
    .dm-contact-hero {
        background-color: #000;
        padding: 200px 0 100px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 767px) { .dm-contact-hero { padding: 150px 0 70px; } }
    .dm-contact-hero-subtitle {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: rgba(255,255,255,0.5);
        margin-bottom: 24px;
        font-family: var(--tp-ff-onest);
    }
    .dm-contact-hero-title {
        font-size: 52px;
        font-weight: 600;
        color: #fff;
        line-height: 1.2;
        max-width: 600px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 991px) { .dm-contact-hero-title { font-size: 38px; } }
    @media (max-width: 767px) { .dm-contact-hero-title { font-size: 28px; } }
    .dm-contact-hero-desc {
        font-size: 18px;
        color: rgba(255,255,255,0.6);
        line-height: 1.7;
        max-width: 550px;
        margin-top: 24px;
        font-family: var(--tp-ff-onest);
    }

    /* Contact Info Section */
    .dm-contact-info { padding: 100px 0 80px; }
    @media (max-width: 767px) { .dm-contact-info { padding: 60px 0 40px; } }
    .dm-contact-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 16px;
        padding: 36px;
        height: 100%;
        transition: all 0.3s ease;
    }
    .dm-contact-card:hover {
        border-color: rgba(0,0,0,0.15);
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
    }
    .dm-contact-card-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        background: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: #fff;
        font-size: 20px;
    }
    .dm-contact-card h5 {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 12px;
        font-family: var(--tp-ff-onest);
    }
    .dm-contact-card p,
    .dm-contact-card a {
        font-size: 17px;
        color: #111;
        line-height: 1.6;
        font-weight: 500;
        text-decoration: none;
        font-family: var(--tp-ff-onest);
        display: block;
    }
    .dm-contact-card a:hover { color: #555; }

    /* Social Links */
    .dm-contact-social { padding: 0 0 80px; }
    .dm-contact-social-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 20px;
        font-family: var(--tp-ff-onest);
    }
    .dm-contact-social-links { display: flex; gap: 12px; flex-wrap: wrap; }
    .dm-contact-social-link {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #111;
        text-decoration: none;
        font-size: 18px;
        transition: all 0.3s ease;
    }
    .dm-contact-social-link:hover {
        background: #000;
        color: #fff;
        border-color: #000;
    }

    /* Map */
    .dm-contact-map { padding: 0 0 100px; }
    @media (max-width: 767px) { .dm-contact-map { padding: 0 0 60px; } }
    .dm-contact-map-wrap {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.06);
    }
    .dm-contact-map-wrap iframe {
        width: 100%;
        height: 450px;
        border: 0;
        display: block;
    }
    @media (max-width: 767px) { .dm-contact-map-wrap iframe { height: 300px; } }

    /* CTA */
    .dm-contact-cta {
        padding: 80px 0;
        background: #f8f9fa;
        text-align: center;
    }
    .dm-contact-cta h3 {
        font-size: 32px;
        font-weight: 600;
        color: #111;
        margin-bottom: 12px;
        font-family: var(--tp-ff-onest);
    }
    .dm-contact-cta p {
        font-size: 17px;
        color: rgba(0,0,0,0.55);
        font-family: var(--tp-ff-onest);
    }
</style>
@endpush

@section('content')

<!-- Hero -->
<div class="dm-contact-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-lg-8">
                <div class="dm-contact-hero-subtitle tp_fade_anim" data-delay=".3">Contact Us</div>
                <h1 class="dm-contact-hero-title tp-text-revel-anim" data-delay=".5">Let's Start a Conversation</h1>
                <p class="dm-contact-hero-desc tp_fade_anim" data-delay=".7">Have a question or need a consultation? We'd love to hear from you. Reach out and our team will get back to you promptly.</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Info Cards -->
<div class="dm-contact-info">
    <div class="container container-1230">
        <div class="row g-4">
            @if($contact->phone)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".3">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h5>Call Us</h5>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->phone) }}">{{ $contact->phone }}</a>
                </div>
            </div>
            @endif

            @if($contact->email)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".4">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h5>Email Us</h5>
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </div>
            </div>
            @endif

            @if($contact->address)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".5">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h5>Visit Us</h5>
                    <p>{{ $contact->address }}</p>
                </div>
            </div>
            @endif

            @if($contact->office_hours)
            <div class="col-lg-4 col-md-6 tp_fade_anim" data-delay=".6">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h5>Office Hours</h5>
                    <p>{{ $contact->office_hours }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Social Media -->
@if($contact->facebook_url || $contact->twitter_url || $contact->linkedin_url || $contact->instagram_url)
<div class="dm-contact-social">
    <div class="container container-1230">
        <div class="dm-contact-social-label tp_fade_anim" data-delay=".3">Follow Us</div>
        <div class="dm-contact-social-links tp_fade_anim" data-delay=".4">
            @if($contact->facebook_url)
            <a href="{{ $contact->facebook_url }}" target="_blank" rel="noopener" class="dm-contact-social-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
            @endif
            @if($contact->twitter_url)
            <a href="{{ $contact->twitter_url }}" target="_blank" rel="noopener" class="dm-contact-social-link" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            @endif
            @if($contact->linkedin_url)
            <a href="{{ $contact->linkedin_url }}" target="_blank" rel="noopener" class="dm-contact-social-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            @endif
            @if($contact->instagram_url)
            <a href="{{ $contact->instagram_url }}" target="_blank" rel="noopener" class="dm-contact-social-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            @endif
        </div>
    </div>
</div>
@endif

<!-- Google Map -->
@if($contact->google_map_embed)
<div class="dm-contact-map">
    <div class="container container-1230">
        <div class="dm-contact-map-wrap tp_fade_anim" data-delay=".3">
            <iframe src="{{ $contact->google_map_embed }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
@endif

<!-- CTA -->
<div class="dm-contact-cta">
    <div class="container container-1230">
        <h3 class="tp_fade_anim" data-delay=".3">We're Here to Help</h3>
        <p class="tp_fade_anim" data-delay=".5">Our team of experts is ready to assist you with your financial and advisory needs. Don't hesitate to reach out.</p>
    </div>
</div>

@endsection
