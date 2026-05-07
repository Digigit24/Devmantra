@extends('layouts.frontend')
@section('title', 'Events - DevMantra')
@section('meta_description', 'Dev Mantra events, news coverage, and media highlights.')

@push('styles')
<style>
    /* ── Hero ── */
    .dm-events-hero { background-color: #001d30; padding: 200px 0 120px; }
    .dm-events-hero-desc {
        font-size: 18px; color: rgba(255,255,255,0.6); max-width: 540px;
        line-height: 1.7; font-family: var(--tp-ff-onest);
    }
    @media (max-width: 767px) { .dm-events-hero { padding: 150px 0 70px; } }

    /* ── Tab Bar ── */
    .dm-events-tabs-wrap {
        background: #fff;
        border-bottom: 1px solid rgba(0,0,0,0.08);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .dm-events-tabs-inner {
        display: flex;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;          /* Firefox */
        -ms-overflow-style: none;       /* IE/Edge */
        padding: 0 16px;
    }
    .dm-events-tabs-inner::-webkit-scrollbar { display: none; }

    .dm-events-tab {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 18px 22px;
        font-size: 14px;
        font-weight: 600;
        font-family: var(--tp-ff-onest);
        color: rgba(0,0,0,0.45);
        white-space: nowrap;
        flex-shrink: 0;
        cursor: pointer;
        border: none;
        background: none;
        border-bottom: 2px solid transparent;
        transition: color .2s, border-color .2s;
        text-decoration: none;
        position: relative;
        top: 1px;               /* sit on the border-bottom of wrapper */
    }
    .dm-events-tab:hover { color: #1b3c6b; }
    .dm-events-tab.active {
        color: #1b3c6b;
        border-bottom-color: #1b3c6b;
    }
    .dm-tab-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: rgba(27,60,107,0.08);
        color: #1b3c6b;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 700;
        transition: background .2s, color .2s;
    }
    .dm-events-tab.active .dm-tab-count {
        background: #1b3c6b;
        color: #fff;
    }
    @media (max-width: 575px) {
        .dm-events-tab { padding: 16px 16px; font-size: 13px; }
    }

    /* ── Wrapper ── */
    .dm-events-all { padding: 80px 0 60px; }

    /* ── Single event outer section ── */
    .dm-event-section {
        padding: 0 0 60px;
        position: relative;
    }
    .dm-event-section + .dm-event-section {
        border-top: 1px solid rgba(0,0,0,0.08);
        padding-top: 80px;
    }

    /* ── Clamped body — the 200vh container ── */
    .dm-event-body {
        max-height: 200vh;
        overflow: hidden;
        transition: max-height 0.9s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .dm-event-body.expanded {
        max-height: 9999px;
    }

    /* ── Gradient fade overlay ── */
    .dm-event-fade {
        position: relative;
        margin-top: -180px;
        height: 180px;
        background: linear-gradient(to bottom, transparent 0%, #ffffff 85%);
        pointer-events: none;
        transition: opacity 0.4s ease;
        z-index: 2;
    }
    .dm-event-fade.hidden {
        opacity: 0;
        height: 0;
        margin-top: 0;
    }

    /* ── Read more / less button ── */
    .dm-event-readmore-wrap {
        text-align: center;
        padding-top: 10px;
        transition: opacity 0.3s;
    }
    .dm-event-readmore-wrap.hidden { display: none; }

    .dm-event-readmore-btn {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff;
        border: 1.5px solid #1b3c6b;
        color: #1b3c6b;
        font-size: 14px; font-weight: 600;
        font-family: var(--tp-ff-onest);
        padding: 10px 28px; border-radius: 50px;
        cursor: pointer; transition: background 0.25s, color 0.25s;
    }
    .dm-event-readmore-btn:hover {
        background: #1b3c6b;
        color: #fff;
    }
    .dm-event-readmore-btn i { font-size: 12px; transition: transform 0.3s; }
    .dm-event-readmore-btn.expanded i { transform: rotate(180deg); }

    /* ── Title / description ── */
    .dm-event-intro { margin-bottom: 48px; }

    .dm-event-section-title {
        font-size: 32px; font-weight: 700; line-height: 1.3;
        color: #111; font-family: var(--tp-ff-onest);
        margin-bottom: 6px;
        text-decoration: none;
        display: inline-block;
        transition: color 0.2s;
    }
    .dm-event-section-title:hover { color: #1d6aa9; text-decoration: none; }

    .dm-event-section-date {
        font-size: 13px; font-weight: 600; color: #1d6aa9;
        font-family: var(--tp-ff-onest); text-transform: uppercase;
        letter-spacing: 0.6px; margin-bottom: 18px;
    }

    .dm-event-tag-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 12px;
        font-family: var(--tp-ff-onest);
    }
    .dm-event-tag-badge.tag-events          { background: rgba(27,60,107,0.08);  color: #1b3c6b; }
    .dm-event-tag-badge.tag-media-and-news  { background: rgba(22,163,74,0.08);  color: #1d6aa9; }
    .dm-event-tag-badge.tag-team-activities { background: rgba(217,119,6,0.08);  color: #d97706; }
    .dm-event-tag-badge.tag-achievements    { background: rgba(124,58,237,0.08); color: #7c3aed; }

    .dm-event-section-desc {
        font-size: 15px; line-height: 1.8; color: rgba(0,0,0,0.6);
        font-family: var(--tp-ff-onest);
    }
    .dm-event-section-desc p { margin-bottom: 14px; }

    .dm-event-section-link {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: 14px; font-weight: 600; color: #1b3c6b;
        font-family: var(--tp-ff-onest); margin-top: 10px;
        text-decoration: none; transition: gap 0.2s;
    }
    .dm-event-section-link:hover { gap: 12px; color: #1b3c6b; text-decoration: none; }
    .dm-event-section-link i { font-size: 12px; }

    /* ── Hero banner image (per-event, full-width) ── */
    .dm-event-hero-img {
        width: 100%;
        aspect-ratio: 16 / 6;
        object-fit: cover;
        border-radius: 14px;
        display: block;
        margin-bottom: 36px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    }
    @media (max-width: 767px) {
        .dm-event-hero-img { aspect-ratio: 16 / 9; border-radius: 10px; margin-bottom: 24px; }
    }

    /* ── Featured image ── */
    .dm-event-featured-wrap { display: flex; align-items: flex-start; justify-content: center; }
    .dm-event-featured-wrap img {
        max-width: 100%; height: auto;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    @media (max-width: 991px) {
        .dm-event-section-title { font-size: 26px; }
        .dm-event-intro { margin-bottom: 32px; }
        .dm-event-featured-wrap { margin-top: 28px; }
    }

    /* ── Masonry gallery ── */
    .dm-masonry {
        column-count: 3;
        column-gap: 14px;
    }
    .dm-masonry-item {
        break-inside: avoid;
        margin-bottom: 14px;
        border-radius: 10px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        border: 1px solid rgba(0,0,0,0.06);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .dm-masonry-item:hover {
        box-shadow: 0 8px 28px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }
    .dm-masonry-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.4s ease;
    }
    .dm-masonry-item:hover img { transform: scale(1.03); }
    .dm-masonry-item::after {
        content: '\f002';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute; inset: 0;
        background: rgba(0,0,0,0.25);
        color: #fff; font-size: 22px;
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s;
    }
    .dm-masonry-item:hover::after { opacity: 1; }

    @media (max-width: 991px) { .dm-masonry { column-count: 2; } }
    @media (max-width: 575px)  {
        .dm-masonry { column-count: 2; column-gap: 8px; }
        .dm-masonry-item { margin-bottom: 8px; }
    }

    /* ── Empty state ── */
    .dm-events-empty {
        text-align: center; padding: 100px 20px;
        color: rgba(0,0,0,0.4); font-size: 18px;
        font-family: var(--tp-ff-onest);
    }
    .dm-events-empty i { font-size: 48px; display: block; margin-bottom: 16px; opacity: 0.3; }

    /* ── Hidden by tab filter ── */
    .dm-event-section.tab-hidden {
        display: none !important;
    }

    /* ── Lightbox ── */
    .dm-lightbox-overlay {
        display: none; position: fixed; top: 0; left: 0;
        width: 100%; height: 100%; background: rgba(0,0,0,0.92);
        z-index: 9999; align-items: center; justify-content: center;
        cursor: pointer;
    }
    .dm-lightbox-overlay.active { display: flex; }
    .dm-lightbox-overlay img {
        max-width: 92vw; max-height: 90vh;
        width: auto; height: auto;
        border-radius: 8px; object-fit: contain; cursor: default;
    }
    .dm-lightbox-close {
        position: absolute; top: 20px; right: 30px;
        color: #fff; font-size: 32px; cursor: pointer;
        background: none; border: none; z-index: 10000;
    }
    .dm-lightbox-nav {
        position: absolute; top: 50%; transform: translateY(-50%);
        color: #fff; font-size: 22px; cursor: pointer;
        background: rgba(255,255,255,0.15); border: none;
        width: 48px; height: 48px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        transition: background 0.3s; z-index: 10000;
    }
    .dm-lightbox-nav:hover { background: rgba(255,255,255,0.3); }
    .dm-lightbox-prev { left: 18px; }
    .dm-lightbox-next { right: 18px; }
    .dm-lightbox-counter {
        position: absolute; bottom: 18px; left: 50%; transform: translateX(-50%);
        color: rgba(255,255,255,0.6); font-size: 13px;
        font-family: var(--tp-ff-onest);
    }
</style>
@endpush

@section('content')

<!-- Hero -->
<div class="dm-events-hero">
    <div class="container container-1230">
        <div class="row">
            <div class="col-xl-8">
                <div class="tp-section-subtitle-gradient ct mb-20 tp_fade_anim" data-delay=".3">Events</div>
                <h2 class="tp-section-title-onest fs-68 tp-text-revel-anim" style="color:#fff;">
                    Our Events &<br>Media Presence
                </h2>
                <div class="tp_text_anim mt-30">
                    <p class="dm-events-hero-desc">Discover Dev Mantra's latest events, industry recognition, and media coverage that highlight our commitment to driving innovation.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $tagLabels = [
        'events'          => 'Events',
        'media-and-news'  => 'Media & News',
        'team-activities' => 'Team Activities',
        'achievements'    => 'Achievements',
    ];
    $tagIcons = [
        'events'          => 'fa-solid fa-calendar-days',
        'media-and-news'  => 'fa-solid fa-newspaper',
        'team-activities' => 'fa-solid fa-people-group',
        'achievements'    => 'fa-solid fa-trophy',
    ];
    // Count events per tag (an event can have multiple tags)
    $tagCounts = collect($tagLabels)->mapWithKeys(fn($label, $key) =>
        [$key => $events->filter(fn($e) => in_array($key, $e->tags ?? []))->count()]
    );
@endphp

<!-- Tab Bar -->
<div class="dm-events-tabs-wrap">
    <div class="container container-1230" style="padding-left:0;padding-right:0;">
        <div class="dm-events-tabs-inner" role="tablist">
            <button class="dm-events-tab active" data-tab="all" role="tab" aria-selected="true">
                All
                <span class="dm-tab-count" id="count-all">{{ $events->count() }}</span>
            </button>
            @foreach($tagLabels as $value => $label)
            <button class="dm-events-tab" data-tab="{{ $value }}" role="tab" aria-selected="false">
                <i class="{{ $tagIcons[$value] }}" style="font-size:12px;"></i>
                {{ $label }}
                <span class="dm-tab-count" id="count-{{ $value }}">{{ $tagCounts[$value] ?? 0 }}</span>
            </button>
            @endforeach
        </div>
    </div>
</div>

<!-- All Events -->
<div class="dm-events-all">
    <div class="container container-1230">

        @if($events->count())

            <div id="events-list">
            @foreach($events as $event)
            @php
                $featuredSrc = $event->featured_image
                    ? (str_starts_with($event->featured_image, 'http') ? $event->featured_image : asset('storage/' . $event->featured_image))
                    : null;
                $eventKey  = 'ev' . $event->id;
                $eventTags = $event->tags ?? ['events'];
            @endphp

            <div class="dm-event-section tp_fade_anim" data-delay=".3" data-tags="{{ json_encode($eventTags) }}">

                {{-- ── Clamped body ── --}}
                <div class="dm-event-body" id="body-{{ $eventKey }}">

                    {{-- Hero image (full-width banner URL) --}}
                    @if($event->hero_image_url)
                    <img class="dm-event-hero-img" src="{{ $event->hero_image_url }}" alt="{{ $event->title }}">
                    @endif

                    {{-- Title + description + featured image --}}
                    <div class="dm-event-intro row align-items-start">
                        <div class="col-lg-7">
                            {{-- Tag badges --}}
                            @foreach($eventTags as $etag)
                            <div class="dm-event-tag-badge tag-{{ $etag }}" style="margin-right:6px;">
                                <i class="{{ $tagIcons[$etag] ?? 'fa-solid fa-tag' }}" style="font-size:10px;"></i>
                                {{ $tagLabels[$etag] ?? $etag }}
                            </div>
                            @endforeach

                            @if($event->published_at)
                            <div class="dm-event-section-date">{{ $event->published_at->format('d M Y') }}</div>
                            @endif
                            <a href="{{ route('event.show', $event->slug) }}" class="dm-event-section-title">
                                {{ $event->title }}
                            </a>
                            <div class="dm-event-section-desc mt-3">
                                {!! $event->description !!}
                            </div>
                            <a href="{{ route('event.show', $event->slug) }}" class="dm-event-section-link mt-3">
                                View full page <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                        @if($featuredSrc)
                        <div class="col-lg-5">
                            <div class="dm-event-featured-wrap">
                                <img src="{{ $featuredSrc }}" alt="{{ $event->title }}">
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Masonry gallery --}}
                    @if($event->galleryImages->count())
                    <div class="dm-masonry">
                        @foreach($event->galleryImages as $idx => $img)
                        @php $src = str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path); @endphp
                        <div class="dm-masonry-item"
                             onclick="dmLightbox.open('{{ $eventKey }}', {{ $idx }})"
                             title="{{ $event->title }} — image {{ $idx + 1 }}">
                            <img src="{{ $src }}" alt="{{ $event->title }} {{ $idx + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>{{-- /.dm-event-body --}}

                {{-- Gradient fade --}}
                <div class="dm-event-fade" id="fade-{{ $eventKey }}"></div>

                {{-- Read more / less button --}}
                <div class="dm-event-readmore-wrap" id="rm-{{ $eventKey }}">
                    <button class="dm-event-readmore-btn"
                            onclick="dmToggleExpand('{{ $eventKey }}', this)">
                        Show More <i class="fa-solid fa-chevron-down"></i>
                    </button>
                </div>

            </div>
            @endforeach
            </div>

            {{-- Empty state shown when a tab has no events --}}
            <div id="events-tab-empty" style="display:none;">
                <div class="dm-events-empty">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    No events in this category yet.
                </div>
            </div>

        @else
        <div class="dm-events-empty">
            <i class="fa-solid fa-calendar-days"></i>
            No events published yet. Check back soon!
        </div>
        @endif

    </div>
</div>

{{-- Lightbox --}}
<div class="dm-lightbox-overlay" id="dmLightboxOverlay" onclick="dmLightbox.bgClose(event)">
    <button class="dm-lightbox-close" onclick="dmLightbox.close()"><i class="fa-solid fa-xmark"></i></button>
    <button class="dm-lightbox-nav dm-lightbox-prev" onclick="dmLightbox.nav(event,-1)"><i class="fa-solid fa-chevron-left"></i></button>
    <img id="dmLightboxImg" src="" alt="">
    <button class="dm-lightbox-nav dm-lightbox-next" onclick="dmLightbox.nav(event,1)"><i class="fa-solid fa-chevron-right"></i></button>
    <div class="dm-lightbox-counter" id="dmLightboxCounter"></div>
</div>

@endsection

@push('scripts')
<script>
(function () {

    /* ── Tab filtering ── */
    var currentTab = 'all';

    function filterByTab(tab) {
        currentTab = tab;
        var sections  = document.querySelectorAll('.dm-event-section');
        var emptyEl   = document.getElementById('events-tab-empty');
        var visible   = 0;

        sections.forEach(function (sec) {
            var tags = [];
            try { tags = JSON.parse(sec.dataset.tags || '[]'); } catch(e) {}
            var matches = (tab === 'all') || tags.indexOf(tab) !== -1;
            sec.classList.toggle('tab-hidden', !matches);
            if (matches) visible++;
        });

        if (emptyEl) emptyEl.style.display = (visible === 0) ? '' : 'none';

        // Fix consecutive-border: first visible section should have no top border
        var first = true;
        sections.forEach(function (sec) {
            if (!sec.classList.contains('tab-hidden')) {
                sec.style.borderTop = first ? 'none' : '';
                sec.style.paddingTop = first ? '0' : '';
                first = false;
            }
        });
    }

    document.querySelectorAll('.dm-events-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.dm-events-tab').forEach(function (b) {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');
            filterByTab(btn.dataset.tab);

            // Scroll tab into view on mobile
            btn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        });
    });

    /* ── Expand / collapse ── */
    window.dmToggleExpand = function (key, btn) {
        var body = document.getElementById('body-' + key);
        var fade = document.getElementById('fade-' + key);
        var expanded = body.classList.toggle('expanded');

        fade.classList.toggle('hidden', expanded);
        btn.classList.toggle('expanded', expanded);
        btn.innerHTML = expanded
            ? 'Show Less <i class="fa-solid fa-chevron-down"></i>'
            : 'Show More <i class="fa-solid fa-chevron-down"></i>';
    };

    /* ── Hide gradient + button for sections that don't actually overflow ── */
    function checkOverflow() {
        var clampPx = window.innerHeight * 2;
        document.querySelectorAll('.dm-event-body').forEach(function (body) {
            var key    = body.id.replace('body-', '');
            var fade   = document.getElementById('fade-' + key);
            var rmWrap = document.getElementById('rm-' + key);

            if (body.scrollHeight <= clampPx + 20) {
                if (fade)   { fade.classList.add('hidden'); }
                if (rmWrap) { rmWrap.classList.add('hidden'); }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', checkOverflow);
    window.addEventListener('load', checkOverflow);
    window.addEventListener('load', function () { setTimeout(checkOverflow, 800); });

    /* ── Lightbox ── */
    var registry = @json($events->mapWithKeys(function ($event) {
        $imgs = $event->galleryImages->map(fn($img) =>
            str_starts_with($img->image_path, 'http') ? $img->image_path : asset('storage/' . $img->image_path)
        );
        return ['ev' . $event->id => $imgs];
    }));

    var currentKey = null, currentIdx = 0;
    var overlay = document.getElementById('dmLightboxOverlay');
    var imgEl   = document.getElementById('dmLightboxImg');
    var counter = document.getElementById('dmLightboxCounter');

    function show() {
        var imgs = registry[currentKey] || [];
        imgEl.src = imgs[currentIdx] || '';
        counter.textContent = (currentIdx + 1) + ' / ' + imgs.length;
    }

    window.dmLightbox = {
        open: function (key, idx) {
            currentKey = key; currentIdx = idx;
            show();
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        },
        close: function () {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            imgEl.src = '';
        },
        bgClose: function (e) {
            if (e.target === overlay) this.close();
        },
        nav: function (e, dir) {
            e.stopPropagation();
            var len = (registry[currentKey] || []).length;
            currentIdx = (currentIdx + dir + len) % len;
            show();
        }
    };

    document.addEventListener('keydown', function (e) {
        if (!overlay.classList.contains('active')) return;
        if (e.key === 'Escape')     dmLightbox.close();
        if (e.key === 'ArrowLeft')  dmLightbox.nav(e, -1);
        if (e.key === 'ArrowRight') dmLightbox.nav(e, 1);
    });

})();
</script>
@endpush
