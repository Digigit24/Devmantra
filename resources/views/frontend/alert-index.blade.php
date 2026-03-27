@extends('layouts.frontend')
@section('title', 'Alerts - DevMantra')
@section('meta_description', 'Stay informed with the latest tax alerts, deal alerts, and regulatory updates from Dev Mantra.')

@push('styles')
<style>
    .dm-blog-hero { background-color: #001d30; padding: 200px 0 120px; }
    .dm-blog-hero-desc { font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px; line-height: 1.7; }
    .dm-blog-grid { padding: 100px 0 80px; }
    .dm-blog-featured { border-bottom: 1px solid var(--tp-border-1,#eee); padding-bottom: 60px; margin-bottom: 60px; }
    .dm-blog-featured-thumb img { width: 100%; height: 380px; object-fit: cover; border-radius: 12px; }
    .dm-blog-featured-title { font-size: 32px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 16px; line-height: 1.3; }
    .dm-blog-featured-title a { color: inherit; text-decoration: none; }
    .dm-blog-featured-title a:hover { opacity: 0.7; }
    .dm-blog-card { margin-bottom: 40px; }
    .dm-blog-card-thumb img { width: 100%; height: 220px; object-fit: cover; border-radius: 12px; }
    .dm-blog-card-category { display: inline-block; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 8px; color: rgba(0,0,0,0.4); }
    .dm-blog-card-title { font-size: 20px; font-weight: 600; color: var(--tp-common-black,#111); margin-bottom: 10px; line-height: 1.4; }
    .dm-blog-card-title a { color: inherit; text-decoration: none; }
    .dm-blog-card-title a:hover { opacity: 0.6; }
    .dm-blog-card-excerpt { font-size: 15px; color: rgba(0,0,0,0.55); line-height: 1.6; margin-bottom: 10px; }
    .dm-blog-card-meta { font-size: 14px; color: rgba(0,0,0,0.35); }
    .dm-blog-card-link { font-size: 14px; font-weight: 600; color: var(--tp-common-black,#111); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .dm-blog-card-link:hover { opacity: 0.6; }
    .dm-alert-tag { display: inline-block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; padding: 4px 12px; border-radius: 4px; margin-bottom: 8px; }
    .dm-alert-tag-tax { background: rgba(245,158,11,0.15); color: #d97706; }
    .dm-alert-tag-deal { background: rgba(59,130,246,0.15); color: #2563eb; }
    .dm-pagination { display: flex; justify-content: center; padding-top: 40px; }
    .dm-pagination ul { list-style: none; padding: 0; margin: 0; display: flex; align-items: center; gap: 6px; }
    .dm-pagination li a, .dm-pagination li span { display: inline-flex; align-items: center; justify-content: center; min-width: 42px; height: 42px; padding: 0 14px; border: 1px solid rgba(0,0,0,0.1); border-radius: 10px; font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest); color: var(--tp-common-black,#111); background: #fff; text-decoration: none; transition: all 0.25s ease; }
    .dm-pagination li a:hover { background: var(--tp-common-black,#111); color: #fff; border-color: var(--tp-common-black,#111); }
    .dm-pagination li.active span { background: var(--tp-common-black,#111); color: #fff; border-color: var(--tp-common-black,#111); }
    .dm-pagination li.disabled span { opacity: 0.3; cursor: default; pointer-events: none; }
    .dm-card-read-time-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; font-family: var(--tp-ff-onest); color: rgba(0,0,0,0.5); background: rgba(0,0,0,0.06); padding: 4px 10px; border-radius: 20px; }
    .dm-card-read-time-badge i { font-size: 11px; }
    .dm-filter-tabs { display: flex; gap: 8px; margin-bottom: 40px; }
    .dm-filter-tab { font-size: 14px; font-weight: 600; padding: 8px 20px; border-radius: 20px; border: 1px solid rgba(0,0,0,0.1); color: var(--tp-common-black,#111); text-decoration: none; transition: all 0.25s; font-family: var(--tp-ff-onest); }
    .dm-filter-tab:hover, .dm-filter-tab.active { background: var(--tp-common-black,#111); color: #fff; border-color: var(--tp-common-black,#111); }
</style>
@endpush

@section('content')
<div class="dm-blog-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Alerts</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Tax & Deal<br>Alerts
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-blog-hero-desc">Stay informed with the latest tax alerts, deal updates, and regulatory changes that impact your business.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dm-blog-grid">
    <div class="container container-1230">
        <div class="dm-filter-tabs">
            <a href="{{ route('alert.index') }}" class="dm-filter-tab {{ !request('tag') ? 'active' : '' }}">All</a>
            <a href="{{ route('alert.index', ['tag' => 'tax']) }}" class="dm-filter-tab {{ request('tag') === 'tax' ? 'active' : '' }}">Tax Alerts</a>
            <a href="{{ route('alert.index', ['tag' => 'deal']) }}" class="dm-filter-tab {{ request('tag') === 'deal' ? 'active' : '' }}">Deal Alerts</a>
        </div>

        <div class="row">
            @foreach($alerts as $item)
            <div class="col-lg-4 col-md-6">
                <div class="dm-blog-card tp_fade_anim" data-delay=".{{ 3 + $loop->index }}">
                    <div class="dm-blog-card-thumb">
                        <a href="{{ route('alert.show', $item->slug) }}">
                            @if($item->featured_image)
                                <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->title }}">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $item->title }}">
                            @endif
                        </a>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;margin:16px 0 8px;">
                        <span class="dm-alert-tag dm-alert-tag-{{ $item->tag }}" style="margin:0;">{{ ucfirst($item->tag) }} Alert</span>
                        <span class="dm-card-read-time-badge">
                            <i class="fa-regular fa-clock"></i>
                            {{ $item->read_time ?: '5 min read' }}
                        </span>
                    </div>
                    <h4 class="dm-blog-card-title">
                        <a href="{{ route('alert.show', $item->slug) }}">{{ $item->title }}</a>
                    </h4>
                    <p class="dm-blog-card-excerpt">{{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}</p>
                    <span class="dm-blog-card-meta">{{ $item->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>

        @if($alerts->hasPages())
            {{ $alerts->links('vendor.pagination.devmantra') }}
        @endif
    </div>
</div>
@endsection
