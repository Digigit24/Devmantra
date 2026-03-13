@extends('layouts.frontend')
@section('title', 'Contact Us - DevMantra')
@section('meta_description', 'Get in touch with Dev Mantra. We are here to help with your financial and advisory needs.')

@push('styles')
<style>
    /* Hero */
    .dm-contact-hero {
        background-color: #001d30;
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

    /* Contact Info Cards */
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
        background: #001d30;
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

    /* Contact Form */
    .dm-contact-form-section { padding: 0 0 100px; }
    @media (max-width: 767px) { .dm-contact-form-section { padding: 0 0 60px; } }
    .dm-contact-form-wrap {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 16px;
        padding: 48px;
    }
    @media (max-width: 767px) { .dm-contact-form-wrap { padding: 28px; } }
    .dm-contact-form-title {
        font-size: 28px;
        font-weight: 600;
        color: #111;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-contact-form-desc {
        font-size: 16px;
        color: rgba(0,0,0,0.5);
        margin-bottom: 36px;
        font-family: var(--tp-ff-onest);
    }
    .dm-cf-group { margin-bottom: 24px; }
    .dm-cf-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #111;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-cf-input,
    .dm-cf-textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        font-size: 15px;
        color: #111;
        background: #fafafa;
        font-family: var(--tp-ff-onest);
        transition: border-color 0.3s ease;
        outline: none;
    }
    .dm-cf-input:focus,
    .dm-cf-textarea:focus {
        border-color: #111;
        background: #fff;
    }
    .dm-cf-input::placeholder,
    .dm-cf-textarea::placeholder {
        color: rgba(0,0,0,0.3);
    }
    .dm-cf-textarea {
        min-height: 160px;
        resize: vertical;
    }
    .dm-cf-error {
        font-size: 13px;
        color: #dc2626;
        margin-top: 6px;
        font-family: var(--tp-ff-onest);
    }
    .dm-cf-submit {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: #001d30;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-cf-submit:hover {
        background: #222;
        transform: translateY(-2px);
    }
    .dm-cf-success {
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.2);
        color: #16a34a;
        padding: 16px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 24px;
        font-family: var(--tp-ff-onest);
        display: flex;
        align-items: center;
        gap: 10px;
    }

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
        background: #001d30;
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
@php
    $phone = $contact->phone ?: '+91-8042061247';
    $contactEmail = $contact->email ?: 'support@devmantra.com';
    $address = $contact->address ?: 'NO.85/1, 2ND FLOOR, 10TH CROSS CBI ROAD, GANGANAGAR BENGALURU 560024';
    $officeHours = $contact->office_hours ?: 'Mon - Fri: 9:00 AM - 6:00 PM';
@endphp
<div class="dm-contact-info">
    <div class="container container-1230">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay=".3">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h5>Call Us</h5>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay=".4">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h5>Email Us</h5>
                    <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay=".5">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h5>Visit Us</h5>
                    <p>{{ $address }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 tp_fade_anim" data-delay=".6">
                <div class="dm-contact-card">
                    <div class="dm-contact-card-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h5>Office Hours</h5>
                    <p>{{ $officeHours }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form -->
<div class="dm-contact-form-section">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="dm-contact-form-wrap tp_fade_anim" data-delay=".3">
                    <h3 class="dm-contact-form-title">Send Us a Message</h3>
                    <p class="dm-contact-form-desc">Fill out the form below and our team will get back to you within 24 hours.</p>

                    @if(session('success'))
                    <div class="dm-cf-success">
                        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="dm-cf-group">
                                    <label class="dm-cf-label">Full Name *</label>
                                    <input type="text" name="name" class="dm-cf-input" placeholder="Your full name" value="{{ old('name') }}" required>
                                    @error('name') <div class="dm-cf-error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dm-cf-group">
                                    <label class="dm-cf-label">Email Address *</label>
                                    <input type="email" name="email" class="dm-cf-input" placeholder="your@email.com" value="{{ old('email') }}" required>
                                    @error('email') <div class="dm-cf-error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dm-cf-group">
                                    <label class="dm-cf-label">Phone Number</label>
                                    <input type="text" name="phone" class="dm-cf-input" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}">
                                    @error('phone') <div class="dm-cf-error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="dm-cf-group">
                                    <label class="dm-cf-label">Subject *</label>
                                    <input type="text" name="subject" class="dm-cf-input" placeholder="How can we help?" value="{{ old('subject') }}" required>
                                    @error('subject') <div class="dm-cf-error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="dm-cf-group">
                                    <label class="dm-cf-label">Message *</label>
                                    <textarea name="message" class="dm-cf-textarea" placeholder="Tell us about your project or inquiry..." required>{{ old('message') }}</textarea>
                                    @error('message') <div class="dm-cf-error">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="dm-cf-submit">
                                    Send Message
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                                        <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Media -->
@if($contact->facebook_url || $contact->twitter_url || $contact->linkedin_url || $contact->instagram_url || $contact->whatsapp_url)
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
            @if($contact->whatsapp_url)
            <a href="{{ $contact->whatsapp_url }}" target="_blank" rel="noopener" class="dm-contact-social-link" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
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

@endsection
