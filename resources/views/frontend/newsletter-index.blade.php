@extends('layouts.frontend')
@section('title', 'Newsletter - DevMantra')
@section('meta_description', 'Get the latest on corporate governance, regulatory changes, tax alerts, and strategic business advisory.')

@push('styles')
<style>
    .dm-newsletter-hero { background-color: #000; padding: 200px 0 120px; }
    .dm-newsletter-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; }
    .dm-past-editions { padding: 100px 0; }
    .dm-edition-card { margin-bottom: 40px; transition: transform 0.3s; }
    .dm-edition-card:hover { transform: translateY(-4px); }
    .dm-edition-card-date { font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: rgba(0,0,0,0.4); display: block; margin-bottom: 12px; }
    .dm-edition-card-title { font-size: 20px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 12px; line-height: 1.4; }
    .dm-edition-card-title a { color: inherit; text-decoration: none; }
    .dm-edition-card-title a:hover { opacity: 0.6; }
    .dm-edition-card-excerpt { font-size: 15px; color: rgba(0,0,0,0.55); line-height: 1.6; }
</style>
@endpush

@section('content')
<!-- Hero -->
<div class="dm-newsletter-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Newsletter</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Stay Ahead with<br>Expert Insights
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-newsletter-hero-desc">Get the latest on corporate governance, regulatory changes, tax alerts, and strategic business advisory delivered to your inbox.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Editions -->
<div class="dm-past-editions">
    <div class="container container-1230">
        <div class="section-label mb-40 tp_fade_anim" data-delay=".3" style="font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;">All Editions</div>
        <div class="row">
            @forelse($newsletters as $newsletter)
            <div class="col-lg-4 col-md-6">
                <div class="dm-edition-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index % 3) }}">
                    <span class="dm-edition-card-date">{{ $newsletter->edition_label ?? $newsletter->published_at?->format('F Y') ?? $newsletter->created_at->format('F Y') }}</span>
                    <h4 class="dm-edition-card-title">
                        <a href="{{ route('newsletter.show', $newsletter->slug) }}">{{ $newsletter->title }}</a>
                    </h4>
                    <p class="dm-edition-card-excerpt">{{ $newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 140) }}</p>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p style="text-align:center;color:rgba(0,0,0,0.4);padding:60px 0;">No newsletters published yet. Check back soon.</p>
            </div>
            @endforelse
        </div>

        @if($newsletters->hasPages())
        <div class="d-flex justify-content-center pt-40">
            {{ $newsletters->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
