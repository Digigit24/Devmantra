@extends('layouts.frontend')
@section('title', $newsletter->meta_title ?: $newsletter->title)
@section('meta_description', $newsletter->meta_description ?? $newsletter->excerpt ?? Str::limit(strip_tags($newsletter->content), 160))
@section('og_type', 'article')
@php $newsletterOg = $newsletter->og_image ?: ($newsletter->featured_image ?: null); @endphp
@if($newsletterOg)
@section('og_image', $newsletterOg)
@endif
@if($newsletter->canonical_url)
@section('canonical_url', $newsletter->canonical_url)
@endif
@if($newsletter->noindex)
@section('noindex', '1')
@endif

@push('schema')
{!! \App\Services\SchemaService::newsletterSchema($newsletter) !!}
{!! \App\Services\SchemaService::breadcrumb([
    ['name' => 'Home',       'url' => '/'],
    ['name' => 'Newsletter', 'url' => '/newsletter'],
    ['name' => $newsletter->meta_title ?: $newsletter->title],
]) !!}
@endpush
@if($newsletter->custom_head)
@push('custom_head')
{!! $newsletter->custom_head !!}
@endpush
@endif

@push('styles')
<style>
    .dm-article-hero {
        background-color: #001d30;
        padding: 200px 0 100px;
        position: relative;
        overflow: hidden;
    }
    @media (max-width: 767px) { .dm-article-hero { padding: 150px 0 70px; } }

    .dm-article-meta {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }
    .dm-article-meta-item {
        font-size: 14px;
        color: rgba(255,255,255,0.5);
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-meta-tag {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #fff;
        padding: 6px 16px;
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
    }
    .dm-read-time-badge {
        background: rgba(255,255,255,0.12);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 13px !important;
    }

    /* Subscribe widget (detail page) */
    .dm-subscribe-widget-detail { margin-top: 36px; max-width: 400px; }
    .dm-sub-trigger {
        display: inline-flex; align-items: center; gap: 9px;
        padding: 12px 24px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.25);
        background: rgba(255,255,255,0.08); color: #fff;
        font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest);
        cursor: pointer; transition: background 0.25s, border-color 0.25s;
    }
    .dm-sub-trigger:hover { background: rgba(255,255,255,0.15); border-color: rgba(255,255,255,0.4); }
    .dm-sub-panel {
        max-height: 0; overflow: hidden;
        transition: max-height 0.4s ease, opacity 0.35s ease;
        opacity: 0;
    }
    .dm-sub-panel.open { max-height: 220px; opacity: 1; }
    .dm-sub-inner { padding-top: 16px; display: flex; flex-direction: column; gap: 10px; }
    .dm-sub-input {
        width: 100%; padding: 13px 16px; box-sizing: border-box;
        background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18);
        border-radius: 8px; color: #fff; font-size: 14px; font-family: var(--tp-ff-onest);
        outline: none; transition: border-color 0.2s, background 0.2s;
    }
    .dm-sub-input::placeholder { color: rgba(255,255,255,0.38); }
    .dm-sub-input:focus { border-color: rgba(255,255,255,0.55); background: rgba(255,255,255,0.12); }
    .dm-sub-btn {
        width: 100%; padding: 13px 20px; border-radius: 8px; border: none; cursor: pointer;
        font-size: 14px; font-weight: 600; font-family: var(--tp-ff-onest);
        background: #fff; color: #001d30;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        transition: all 0.3s ease;
    }
    .dm-sub-btn:hover:not(:disabled) { background: rgba(255,255,255,0.88); }
    .dm-sub-btn:disabled { cursor: default; }
    .dm-sub-btn.loading { background: rgba(255,255,255,0.55); color: #001d30; }
    .dm-sub-btn.success { background: #22c55e; color: #fff; }
    .dm-sub-btn.already { background: rgba(255,255,255,0.2); color: #fff; }
    .dm-sub-msg { font-size: 13px; font-family: var(--tp-ff-onest); margin-top: 6px; min-height: 18px; }
    .dm-sub-msg.error { color: #f87171; }
    .dm-sub-msg.success { color: #86efac; }
    .dm-sub-msg.already { color: rgba(255,255,255,0.6); }
    .dm-article-hero-title {
        font-size: 48px;
        font-weight: 600;
        color: #fff;
        line-height: 1.25;
        max-width: 800px;
        font-family: var(--tp-ff-onest);
    }
    @media (max-width: 991px) { .dm-article-hero-title { font-size: 36px; } }
    @media (max-width: 767px) { .dm-article-hero-title { font-size: 28px; } }

    /* Featured image - full width below hero */
    .dm-article-featured-section {
        margin-top: -40px;
        position: relative;
        z-index: 2;
        padding-bottom: 60px;
    }
    .dm-article-featured-img {
        border-radius: 16px;
        overflow: hidden;
    }
    .dm-article-featured-img img {
        width: 100%;
        height: auto;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 767px) {
        .dm-article-featured-img img { aspect-ratio: 4 / 3; }
        .dm-article-featured-section { margin-top: -20px; padding-bottom: 40px; }
    }

    /* Article body - 2 column layout */
    .dm-article-body { padding: 0 0 100px; }
    @media (max-width: 767px) { .dm-article-body { padding: 0 0 60px; } }

    /* Content column */
    .dm-article-content p {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.7);
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content h3 {
        font-size: 28px;
        font-weight: 600;
        color: var(--tp-common-black);
        margin-top: 48px;
        margin-bottom: 20px;
        font-family: var(--tp-ff-onest);
        line-height: 1.35;
    }
    .dm-article-content h4 {
        font-size: 22px;
        font-weight: 600;
        color: var(--tp-common-black);
        margin-top: 36px;
        margin-bottom: 16px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content ul {
        padding-left: 0;
        margin-bottom: 28px;
        list-style: none;
    }
    .dm-article-content ul li {
        font-size: 17px;
        line-height: 1.8;
        color: rgba(0,0,0,0.7);
        padding-left: 24px;
        position: relative;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-content ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 12px;
        width: 6px;
        height: 6px;
        background: var(--tp-common-black);
        border-radius: 50%;
    }

    .dm-article-content blockquote,
    .dm-article-quote {
        border-left: 3px solid var(--tp-common-black);
        padding: 24px 0 24px 32px;
        margin: 40px 0;
    }
    .dm-article-content blockquote p,
    .dm-article-quote p {
        font-size: 20px;
        font-weight: 500;
        color: var(--tp-common-black);
        line-height: 1.6;
        margin-bottom: 8px;
        font-style: italic;
    }
    .dm-article-content blockquote cite,
    .dm-article-quote cite {
        font-size: 14px;
        color: rgba(0,0,0,0.5);
        font-style: normal;
        font-weight: 600;
    }

    .dm-article-inline-img {
        margin: 40px 0;
        border-radius: 12px;
        overflow: hidden;
    }
    .dm-article-inline-img img {
        width: 100%;
        height: auto;
    }

    /* Tags & share */
    .dm-article-footer {
        padding-top: 40px;
        border-top: 1px solid var(--tp-border-1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .dm-article-tags { display: flex; gap: 8px; flex-wrap: wrap; }
    .dm-article-tags a {
        font-size: 13px;
        font-weight: 500;
        color: var(--tp-common-black);
        padding: 6px 16px;
        border: 1px solid var(--tp-border-1);
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
    }
    .dm-article-tags a:hover {
        background: var(--tp-common-black);
        color: #fff;
        border-color: var(--tp-common-black);
    }

    .dm-article-share {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .dm-article-share span {
        font-size: 14px;
        font-weight: 600;
        color: rgba(0,0,0,0.4);
        font-family: var(--tp-ff-onest);
    }
    .dm-article-share a {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--tp-border-1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--tp-common-black);
        text-decoration: none;
        font-size: 14px;
        line-height: 1;
        transition: all 0.3s ease;
    }
    .dm-article-share a i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 14px;
        height: 14px;
        line-height: 1;
    }
    .dm-article-share a:hover {
        background: var(--tp-common-black);
        color: #fff;
        border-color: var(--tp-common-black);
    }

    /* ── Sticky sidebar ── */
    .dm-article-body .row { align-items: flex-start; }
    .dm-sidebar {
        position: sticky;
        top: 120px;
        padding-left: 40px;
        max-height: calc(100vh - 140px);
        overflow-y: auto;
    }
    .dm-sidebar::-webkit-scrollbar { width: 0; background: transparent; }
    @media (max-width: 991px) { .dm-sidebar { padding-left: 0; margin-top: 60px; position: static; max-height: none; } }

    .dm-sidebar-label {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 28px;
        font-family: var(--tp-ff-onest);
    }
    .dm-sidebar-post {
        display: flex;
        gap: 16px;
        padding: 20px 0;
        border-bottom: 1px solid var(--tp-border-1);
        transition: all 0.3s ease;
    }
    .dm-sidebar-post:first-of-type {
        border-top: 1px solid var(--tp-border-1);
    }
    .dm-sidebar-post:hover {
        padding-left: 6px;
    }
    .dm-sidebar-post-thumb {
        width: 72px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
    }
    .dm-sidebar-post-thumb img {
        width: 100%;
        height: auto;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        transition: transform 0.4s ease;
        display: block;
    }
    .dm-sidebar-post:hover .dm-sidebar-post-thumb img {
        transform: scale(1.06);
    }
    .dm-sidebar-post-info {
        flex: 1;
        min-width: 0;
    }
    .dm-sidebar-post-category {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.35);
        margin-bottom: 6px;
        display: block;
        font-family: var(--tp-ff-onest);
    }
    .dm-sidebar-post-title {
        font-size: 15px;
        font-weight: 600;
        color: var(--tp-common-black);
        line-height: 1.45;
        font-family: var(--tp-ff-onest);
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .dm-sidebar-post-title a {
        color: inherit;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .dm-sidebar-post-title a:hover { opacity: 0.6; }

    .dm-sidebar-post-date {
        font-size: 12px;
        color: rgba(0,0,0,0.35);
        margin-top: 4px;
        font-family: var(--tp-ff-onest);
    }

    /* Related posts (bottom section) */
    .dm-related-posts {
        padding: 80px 0;
        border-top: 1px solid var(--tp-border-1);
    }
    .dm-related-posts-title {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.4);
        margin-bottom: 40px;
        font-family: var(--tp-ff-onest);
    }

    .dm-related-card {
        margin-bottom: 30px;
        transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .dm-related-card:hover { transform: translateY(-4px); }
    .dm-related-card-thumb {
        overflow: hidden;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .dm-related-card-thumb img {
        width: 100%;
        height: auto;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .dm-related-card:hover .dm-related-card-thumb img { transform: scale(1.04); }
    .dm-related-card-category {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(0,0,0,0.4);
        margin-bottom: 8px;
        display: block;
        font-family: var(--tp-ff-onest);
    }
    .dm-related-card-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--tp-common-black);
        line-height: 1.4;
        font-family: var(--tp-ff-onest);
    }
    .dm-related-card-title a {
        color: inherit;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }
    .dm-related-card-title a:hover { opacity: 0.6; }
</style>
@endpush

@section('content')
<!-- Article Hero -->
<div class="dm-article-hero">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-meta tp_fade_anim" data-delay=".3">
                    <span class="dm-article-meta-tag">Newsletter</span>
                    @if($newsletter->edition_label)
                    <span class="dm-article-meta-item">{{ $newsletter->edition_label }}</span>
                    @endif
                    <span class="dm-article-meta-item">{{ $newsletter->published_at?->format('M d, Y') ?? $newsletter->created_at->format('M d, Y') }}</span>
                    <span class="dm-article-meta-item dm-read-time-badge">
                        <i class="fa-regular fa-clock"></i>
                        {{ $newsletter->read_time ?: '5 min read' }}
                    </span>
                </div>
                <h1 class="dm-article-hero-title tp-text-revel-anim" data-delay=".5">{{ $newsletter->title }}</h1>
                <div class="dm-subscribe-widget-detail tp_fade_anim" data-delay=".7">
                    <button class="dm-sub-trigger" id="dm-sub-trigger-det" onclick="dmOpenSubscribe('det')">
                        <i class="fa-regular fa-bell"></i> Subscribe to Newsletter
                    </button>
                    <div class="dm-sub-panel" id="dm-sub-panel-det">
                        <div class="dm-sub-inner">
                            <input type="text" id="dm-sub-name-det" class="dm-sub-input" placeholder="Your Name" autocomplete="name">
                            <input type="email" id="dm-sub-email-det" class="dm-sub-input" placeholder="Your Email Address" autocomplete="email">
                            <button id="dm-sub-btn-det" class="dm-sub-btn" onclick="dmSubscribe('det')">
                                <i class="fa-regular fa-paper-plane"></i> Subscribe
                            </button>
                            <p class="dm-sub-msg" id="dm-sub-msg-det"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Image - Full Width -->
@if($newsletter->featured_image)
<div class="dm-article-featured-section">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="dm-article-featured-img tp_fade_anim" data-delay=".3">
                   
                <!--<img src="{{  $newsletter->featured_image }}" alt="{{ $newsletter->title }}">-->
                
              <img src="{{ asset('storage/' . $newsletter->featured_image) }}" alt="{{ $newsletter->title }}" loading="lazy">
            </div>


            </div>
        </div>
    </div>
</div>
@endif

<!-- Article Body + Sidebar -->
<div class="dm-article-body">
    <div class="container container-1230">
        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-8">
                <div class="dm-article-content tp_fade_anim" data-delay=".5">
                    {!! $newsletter->content !!}
                </div>

                @if($newsletter->button_url)
                <!-- Read More Button -->
                <div style="margin:40px 0 0;">
                    <a href="{{ $newsletter->button_url }}" target="_blank" rel="noopener noreferrer" style="
                        display:inline-flex;align-items:center;gap:8px;
                        font-size:15px;font-weight:600;font-family:var(--tp-ff-onest);
                        color:#fff;background:var(--tp-common-black,#111);
                        padding:12px 28px;border-radius:8px;
                        text-decoration:none;transition:opacity 0.25s;
                    " onmouseover="this.style.opacity='.75'" onmouseout="this.style.opacity='1'">
                        {{ $newsletter->button_text ?: 'Read More' }}
                        <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:13px;"></i>
                    </a>
                </div>
                @endif

                <!-- Article Footer -->
                <div class="dm-article-footer">
                    <div class="dm-article-tags">
                        <a href="{{ route('newsletter.index') }}">Newsletter</a>
                        @if($newsletter->edition_label)
                        <a href="{{ route('newsletter.index') }}">{{ $newsletter->edition_label }}</a>
                        @endif
                    </div>
                    <div class="dm-article-share">
                        <span>Share</span>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($newsletter->title) }}" target="_blank" rel="noopener" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sticky Sidebar -->
            <div class="col-lg-4">
                <div class="dm-sidebar">
                    <div class="dm-sidebar-label">Recent Newsletters</div>
                    @foreach($sidebarNewsletters as $sidePost)
                    <div class="dm-sidebar-post">
                        <div class="dm-sidebar-post-thumb">
                            @if($sidePost->featured_image)
                                <a href="{{ route('newsletter.show', $sidePost->slug) }}">
                                    <img src="{{ asset( $sidePost->featured_image) }}" alt="{{ $sidePost->title }}">
                                </a>
                            @else
                                <a href="{{ route('newsletter.show', $sidePost->slug) }}">
                                    <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $sidePost->title }}">
                                </a>
                            @endif
                        </div>

                         <!-- <div class="dm-sidebar-post-thumb">
                            @if($sidePost->featured_image)
                                <a href="{{ route('newsletter.show', $sidePost->slug) }}">
                                    <img src="{{ asset('storage/' . $sidePost->featured_image) }}" alt="{{ $sidePost->title }}" loading="lazy">
                                </a>
                            @else
                                <a href="{{ route('newsletter.show', $sidePost->slug) }}">
                                    <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $sidePost->title }}">
                                </a>
                            @endif
                        </div> -->
                        <div class="dm-sidebar-post-info">
                            <span class="dm-sidebar-post-category">
                                {{ $sidePost->edition_label ?? 'Newsletter' }}
                            </span>
                            <h5 class="dm-sidebar-post-title">
                                <a href="{{ route('newsletter.show', $sidePost->slug) }}">{{ $sidePost->title }}</a>
                            </h5>
                            <div class="dm-sidebar-post-date">{{ $sidePost->published_at?->format('M d, Y') ?? $sidePost->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Newsletters -->
@if($related->count())
<div class="dm-related-posts">
    <div class="container container-1230">
        <div class="dm-related-posts-title tp_fade_anim" data-delay=".3">More Newsletters</div>
        <div class="row">
            @foreach($related as $post)
            <div class="col-lg-4 col-md-6">
                <div class="dm-related-card tp_fade_anim" data-delay=".{{ 3 + ($loop->index * 2) }}">
                    <div class="dm-related-card-thumb">
                        <a href="{{ route('newsletter.show', $post->slug) }}">
                           @if($post->featured_image)
                                <img src="{{ Str::startsWith($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
                            @else
                                <img src="{{ asset('assets/img/home-13/blog/blog-thumb-' . (($loop->index % 3) + 1) . '.jpg') }}" alt="{{ $post->title }}">
                            @endif
                        </a>
                    </div>
                    <span class="dm-related-card-category">{{ $post->edition_label ?? 'Newsletter' }}</span>
                    <h4 class="dm-related-card-title">
                        <a href="{{ route('newsletter.show', $post->slug) }}">{{ $post->title }}</a>
                    </h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if($newsletter->button_url)
<div style="padding:60px 0;text-align:center;border-top:1px solid var(--tp-border-1);">
    <div class="container container-1230">
        <a href="{{ $newsletter->button_url }}" target="_blank" rel="noopener noreferrer" style="
            display:inline-flex;align-items:center;gap:10px;
            font-size:16px;font-weight:600;font-family:var(--tp-ff-onest);
            color:#fff;background:var(--tp-common-black,#111);
            padding:16px 36px;border-radius:8px;
            text-decoration:none;transition:opacity 0.25s;
        " onmouseover="this.style.opacity='.75'" onmouseout="this.style.opacity='1'">
            {{ $newsletter->button_text ?: 'Read More' }}
            <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:14px;"></i>
        </a>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
function dmOpenSubscribe(id) {
    const trigger = document.getElementById('dm-sub-trigger-' + id);
    const panel   = document.getElementById('dm-sub-panel-' + id);
    trigger.style.display = 'none';
    panel.classList.add('open');
    setTimeout(() => document.getElementById('dm-sub-name-' + id).focus(), 50);
}

async function dmSubscribe(id) {
    const nameEl  = document.getElementById('dm-sub-name-' + id);
    const emailEl = document.getElementById('dm-sub-email-' + id);
    const btn     = document.getElementById('dm-sub-btn-' + id);
    const msg     = document.getElementById('dm-sub-msg-' + id);

    const name  = nameEl.value.trim();
    const email = emailEl.value.trim();

    msg.className = 'dm-sub-msg';
    msg.textContent = '';

    if (!name) { msg.className = 'dm-sub-msg error'; msg.textContent = 'Please enter your name.'; nameEl.focus(); return; }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { msg.className = 'dm-sub-msg error'; msg.textContent = 'Please enter a valid email address.'; emailEl.focus(); return; }

    btn.disabled = true;
    btn.classList.add('loading');
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Subscribing…';

    try {
        const res = await fetch('{{ route("newsletter.subscribe") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, email }),
        });

        const data = await res.json();
        btn.classList.remove('loading');

        if (data.status === 'success') {
            btn.classList.add('success');
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Subscribed!';
            msg.className = 'dm-sub-msg success';
            msg.textContent = data.message;
            nameEl.value = '';
            emailEl.value = '';
        } else if (data.status === 'already') {
            btn.classList.add('already');
            btn.innerHTML = '<i class="fa-solid fa-check-double"></i> Already Subscribed';
            msg.className = 'dm-sub-msg already';
            msg.textContent = data.message;
        } else {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-regular fa-paper-plane"></i> Subscribe';
            msg.className = 'dm-sub-msg error';
            msg.textContent = data.message || 'Something went wrong. Please try again.';
        }
    } catch (e) {
        btn.disabled = false;
        btn.classList.remove('loading');
        btn.innerHTML = '<i class="fa-regular fa-paper-plane"></i> Subscribe';
        msg.className = 'dm-sub-msg error';
        msg.textContent = 'Network error. Please try again.';
    }
}
</script>
@endpush
