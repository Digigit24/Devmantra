@props(['data' => []])
@php
    $title   = $data['title']    ?? 'Ready to Transform Your Business?';
    $subtitle = $data['subtitle'] ?? "Let's discuss how Dev Mantra can help you achieve your financial goals.";
    $ctaText = $data['cta_text'] ?? 'Book a Free Consultation';
    $ctaUrl  = $data['cta_url']  ?? '/contact';
@endphp

@once
@push('styles')
<style>
.dm-about-cta {
    padding: 100px 0;
    text-align: center;
    background: #fff;
}
@media (max-width: 767px) { .dm-about-cta { padding: 60px 0; } }
.dm-about-cta h3 {
    font-size: 36px;
    font-weight: 600;
    color: #111 !important;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .dm-about-cta h3 { font-size: 26px; } }
.dm-about-cta p {
    font-size: 17px;
    color: rgba(0,0,0,0.55) !important;
    margin-bottom: 32px;
    font-family: var(--tp-ff-onest);
}
.dm-about-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: var(--dm-brand-gradient, linear-gradient(135deg, #1b3c6b, #4a73c4));
    color: #fff;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.25s, transform 0.25s, box-shadow 0.25s;
    box-shadow: 0 4px 20px rgba(0,0,0,0.18);
    font-family: var(--tp-ff-onest);
}
.dm-about-cta-btn:hover {
    opacity: 0.88;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.25);
}
</style>
@endpush
@endonce

<div class="dm-about-cta">
    <div class="container container-1230">
        <h3 class="tp_fade_anim" data-delay=".3">{{ $title }}</h3>
        <p class="tp_fade_anim" data-delay=".5">{{ $subtitle }}</p>
        <a href="{{ $ctaUrl }}" class="dm-about-cta-btn tp_fade_anim" data-delay=".7">
            {{ $ctaText }}
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
            </svg>
        </a>
    </div>
</div>
