<style>
/* ─── NAV BASE ─────────────────────────────────────────────────── */
.tp-header-menu > nav > ul { display: flex; flex-wrap: nowrap; align-items: center; }
.tp-header-menu > nav > ul > li { flex-shrink: 0; }
.tp-header-btn-box .tp-btn-white-border { white-space: nowrap; }

.tp-header-menu > nav > ul > li > a {
    position: relative; display: flex; align-items: center; gap: 4px;
    padding: 10px 2px; font-weight: 500; color: #141414;
    text-decoration: none; transition: color .2s; white-space: nowrap;
}
.tp-header-menu > nav > ul > li > a::after {
    content: ''; position: absolute; bottom: 4px; left: 0;
    width: 0; height: 2px;
    background: linear-gradient(90deg, var(--dm-brand-from), var(--dm-brand-to));
    border-radius: 2px; transition: width .25s ease;
}
.tp-header-menu > nav > ul > li:hover > a::after,
.tp-header-menu > nav > ul > li > a.dm-nav-active::after { width: 100%; }
.tp-header-menu > nav > ul > li:hover > a,
.tp-header-menu > nav > ul > li > a.dm-nav-active { color: var(--dm-brand-from); }

.dm-nav-chevron {
    width: 13px; height: 13px; flex-shrink: 0; opacity: .45;
    transition: transform .25s ease, opacity .25s;
}
.tp-header-menu > nav > ul > li:hover .dm-nav-chevron,
.tp-header-menu > nav > ul > li.dm-mega-active .dm-nav-chevron { transform: rotate(180deg); opacity: 1; }

/* Hide desktop submenus inside mega-trigger items — mobile clone will show them */
.tp-header-menu > nav > ul > li.has-mega > .tp-submenu,
.tp-header-menu > nav > ul > li.has-mega > .submenu { display: none !important; }

/* Kill the FontAwesome ::after chevron injected by main.css on has-dropdown li —
   we use our own SVG dm-nav-chevron inside the <a> instead */
.tp-header-menu.tp-header-dropdown nav ul li.has-dropdown::after,
.tp-header-menu nav ul li.has-dropdown::after { display: none !important; }

/* ─── Fix mobile offcanvas z-index ──────────────────────────────
   main.css sets .tp-offcanvas-wrapper at z-index:999 and .body-overlay
   at z-index:99, both below the sticky header (z-index:9999). This causes
   the header to bleed on top of the offcanvas, creating a "duplicate" look.
   Stack order: overlay (10000) → offcanvas (10001) above everything. */
.tp-offcanvas-wrapper { z-index: 10001 !important; }
.body-overlay          { z-index: 10000 !important; }

/* ─── BREAKPOINTS ───────────────────────────────────────────────── */
@media (min-width:992px) and (max-width:1199px) {
    .tp-header-menu > nav > ul > li { margin: 0 5px; }
    .tp-header-menu > nav > ul > li > a { font-size: 13px; }
}
@media (min-width:1200px) and (max-width:1399px) {
    .tp-header-menu > nav > ul > li { margin: 0 10px; }
    .tp-header-menu > nav > ul > li > a { font-size: 14.5px; }
    .tp-header-btn-box .tp-btn-white-border { font-size: 13px; padding: 10px 16px; }
}
@media (min-width:1400px) and (max-width:1599px) {
    .tp-header-menu > nav > ul > li { margin: 0 14px; }
    .tp-header-menu > nav > ul > li > a { font-size: 15px; }
}
@media (min-width:1600px) {
    .tp-header-menu > nav > ul > li { margin: 0 18px; }
}
@media (max-width:1199px) {
    .tp-header-right .tp-header-btn-box { display: none !important; }
}
.tp-header-menu > nav > ul > li:last-child .tp-submenu { left: auto; right: 0; }

/* ─── MEGA OVERLAY ──────────────────────────────────────────────── */
.dm-mega-overlay {
    position: fixed; inset: 0; z-index: 9990;
    background: rgba(10,18,40,.2); backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    opacity: 0; pointer-events: none; transition: opacity .22s ease;
}
.dm-mega-overlay.is-open { opacity: 1; pointer-events: all; }

/* ─── MEGA PANEL ────────────────────────────────────────────────── */
.dm-mega {
    position: fixed; left: 0; right: 0; z-index: 9995;
    pointer-events: none; opacity: 0; transform: translateY(-10px);
    transition: opacity .22s cubic-bezier(.4,0,.2,1), transform .22s cubic-bezier(.4,0,.2,1);
    display: none;
}
@media (min-width:992px) { .dm-mega { display: block; } }
.dm-mega.is-open { opacity: 1; transform: translateY(0); pointer-events: all; }

.dm-mega-shell { max-width: 1400px; margin: 0 auto; padding: 0 24px; }
.dm-mega-card {
    background: rgba(255,255,255,.98);
    backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
    border: 1px solid rgba(0,0,0,.07);
    border-top: 2.5px solid var(--dm-brand-from);
    border-radius: 0 0 20px 20px;
    box-shadow: 0 24px 64px rgba(0,0,0,.12), 0 4px 16px rgba(0,0,0,.06);
    overflow: hidden;
    /* Flex column so footer is always pinned at the bottom */
    display: flex; flex-direction: column;
}
.dm-mega-body {
    display: grid; grid-template-columns: 260px 1fr 220px;
    /* Allow body to shrink when card hits max-height */
    flex: 1; min-height: 0; overflow: hidden;
}

/* Left panel */
.dm-mega-left {
    background: linear-gradient(155deg, var(--dm-brand-from, #1b3c6b) 0%, #2f5faa 100%);
    padding: 28px 24px 24px; display: flex; flex-direction: column;
    color: #fff; position: relative; overflow: hidden;
}
.dm-mega-left::before {
    content:''; position:absolute; top:-30px; right:-30px;
    width:140px; height:140px; background:rgba(255,255,255,.05); border-radius:50%;
    pointer-events:none;
}
.dm-mega-left::after {
    content:''; position:absolute; bottom:-40px; left:-20px;
    width:160px; height:160px; background:rgba(255,255,255,.04); border-radius:50%;
    pointer-events:none;
}
.dm-mega-left-icon {
    width:40px; height:40px; border-radius:10px;
    background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.22);
    display:flex; align-items:center; justify-content:center;
    font-size:17px; color:#fff; margin-bottom:14px; position:relative; z-index:1;
    flex-shrink:0;
}
.dm-mega-left-eyebrow {
    font-size:10px; font-weight:700; letter-spacing:2px;
    text-transform:uppercase; opacity:.65; margin-bottom:8px; position:relative; z-index:1;
}
.dm-mega-left-heading {
    font-size:18px; font-weight:700; line-height:1.3;
    color:#fff; margin-bottom:8px; position:relative; z-index:1;
}
.dm-mega-left-body {
    font-size:12.5px; line-height:1.6; color:rgba(255,255,255,.85); position:relative; z-index:1;
}
.dm-mega-left-cta {
    display:inline-flex; align-items:center; gap:8px; margin-top:auto; padding-top:18px;
    padding:18px 0 0; background:none; border:none; border-top:1px solid rgba(255,255,255,.15);
    color:rgba(255,255,255,.9); font-size:12.5px; font-weight:600; text-decoration:none; width:100%;
    transition:color .2s,gap .2s; position:relative; z-index:1;
}
.dm-mega-left-cta:hover { color:#fff; gap:12px; }

/* Center panel */
.dm-mega-center {
    padding:28px 28px; border-left:1px solid rgba(0,0,0,.06);
    border-right:1px solid rgba(0,0,0,.06);
    overflow-y:auto;
    /* max-height driven by parent flex, not a fixed px value */
}
/* ─── Scrollbars for center/right panels only ──────────────────── */
.dm-mega-center,
.dm-mega-right { scrollbar-width: thin; scrollbar-color: rgba(0,0,0,.12) transparent; }
.dm-mega-center::-webkit-scrollbar,
.dm-mega-right::-webkit-scrollbar { width: 3px; background: transparent; }
.dm-mega-center::-webkit-scrollbar-thumb,
.dm-mega-right::-webkit-scrollbar-thumb { background: rgba(0,0,0,.15); border-radius: 99px; }
.dm-section-label {
    font-size:10.5px; font-weight:700; letter-spacing:1.8px;
    text-transform:uppercase; color:#aaa; margin-bottom:14px; display:block;
}

/* Service cards */
.dm-svc-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:6px; }
.dm-svc-card {
    display:flex; align-items:flex-start; gap:11px; padding:13px 14px;
    border-radius:12px; border:1px solid transparent;
    text-decoration:none; color:#1a1a1a;
    transition:background .18s,border-color .18s,box-shadow .18s,transform .18s;
}
.dm-svc-card:hover {
    background:#f3f6ff; border-color:rgba(74,115,196,.18);
    box-shadow:0 4px 18px rgba(74,115,196,.1); transform:translateY(-1px); color:#1a1a1a;
}
.dm-svc-card:focus-visible { outline:2px solid var(--dm-brand-from); outline-offset:2px; }
.dm-svc-icon {
    width:36px; height:36px; flex-shrink:0; border-radius:9px;
    background:linear-gradient(135deg,var(--dm-brand-from),var(--dm-brand-to));
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:14px; transition:transform .2s,box-shadow .2s;
}
.dm-svc-card:hover .dm-svc-icon { transform:scale(1.1); box-shadow:0 4px 12px rgba(27,60,107,.3); }
.dm-svc-title { font-size:13px; font-weight:600; line-height:1.3; }
.dm-svc-desc {
    font-size:11.5px; color:#888; line-height:1.4; margin-top:2px;
    display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;
}
.dm-svc-arrow {
    margin-left:auto; opacity:0; transform:translateX(-4px);
    transition:opacity .18s,transform .18s; color:var(--dm-brand-from);
    font-size:11px; align-self:center; flex-shrink:0;
}
.dm-svc-card:hover .dm-svc-arrow { opacity:1; transform:translateX(0); }

/* Featured / cross-category service card (dark blue gradient, white text) */
.dm-svc-card--feature {
    background:linear-gradient(135deg,var(--dm-brand-from,#1b3c6b) 0%,#2f5faa 100%);
    border-color:transparent; color:#fff;
    box-shadow:0 6px 20px rgba(27,60,107,.22);
}
.dm-svc-card--feature .dm-svc-title { color:#fff; }
.dm-svc-card--feature .dm-svc-desc { color:rgba(255,255,255,.82); }
.dm-svc-card--feature .dm-svc-arrow { color:#fff; opacity:1; transform:translateX(0); }
.dm-svc-card--feature .dm-svc-icon {
    background:rgba(255,255,255,.16); color:#fff;
    box-shadow:inset 0 0 0 1px rgba(255,255,255,.25);
}
.dm-svc-card--feature:hover {
    background:linear-gradient(135deg,#1b3c6b 0%,#3768bd 100%); color:#fff;
    border-color:transparent;
    box-shadow:0 10px 28px rgba(27,60,107,.34); transform:translateY(-1px);
}
.dm-svc-card--feature:hover .dm-svc-icon {
    background:rgba(255,255,255,.24); transform:scale(1.1);
    box-shadow:inset 0 0 0 1px rgba(255,255,255,.35),0 4px 12px rgba(0,0,0,.25);
}

/* Insight cards */
.dm-ins-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:8px; }
.dm-ins-card {
    display:flex; flex-direction:column; gap:8px; padding:16px 14px;
    border-radius:12px; border:1px solid #eaebed; background:#fff;
    text-decoration:none; color:#1a1a1a;
    transition:border-color .2s,box-shadow .2s,transform .2s;
}
.dm-ins-card:hover {
    border-color:rgba(74,115,196,.3);
    box-shadow:0 6px 24px rgba(74,115,196,.12);
    transform:translateY(-2px); color:#1a1a1a;
}
.dm-ins-card:focus-visible { outline:2px solid var(--dm-brand-from); outline-offset:2px; }
.dm-ins-icon {
    width:38px; height:38px; border-radius:10px;
    display:flex; align-items:center; justify-content:center; font-size:17px;
}
.dm-ins-title { font-size:13px; font-weight:600; }
.dm-ins-desc { font-size:11.5px; color:#888; line-height:1.42; }
.dm-ins-link {
    font-size:11px; font-weight:600; color:var(--dm-brand-from);
    opacity:0; transition:opacity .18s; margin-top:auto;
}
.dm-ins-card:hover .dm-ins-link { opacity:1; }

/* Right sidebar */
.dm-mega-right { padding:28px 20px; background:#f9fafb; overflow-y:auto; }
.dm-quick-links {
    list-style:none; padding:0; margin:0;
    display:flex; flex-direction:column; gap:1px;
}
.dm-quick-links li a {
    display:flex; align-items:center; gap:10px; padding:9px 11px;
    border-radius:10px; font-size:13px; font-weight:500; color:#2c2c2c;
    text-decoration:none; transition:background .16s,color .16s,transform .16s;
}
.dm-quick-links li a:hover { background:rgba(27,60,107,.07); color:var(--dm-brand-from); transform:translateX(3px); }
.dm-quick-links li a:focus-visible { outline:2px solid var(--dm-brand-from); outline-offset:2px; border-radius:10px; }
.dm-ql-dot {
    width:27px; height:27px; border-radius:7px; flex-shrink:0;
    background:#fff; border:1px solid #eaebed;
    display:flex; align-items:center; justify-content:center; font-size:12px;
    transition:background .16s,border-color .16s,color .16s;
}
.dm-quick-links li a:hover .dm-ql-dot {
    background:linear-gradient(135deg,var(--dm-brand-from),var(--dm-brand-to));
    border-color:transparent; color:#fff;
}

/* Prevent scroll chaining out of the mega panel into the page */
.dm-mega { overscroll-behavior: contain; }
.dm-mega-center { overscroll-behavior: contain; }

/* Body scroll-lock — position:fixed preserves scroll position on iOS Safari too */
body.dm-scroll-lock {
    overflow: hidden !important;
    position: fixed !important;
    left: 0; right: 0;
    /* top is set dynamically by JS to -scrollY */
}

/* Footer strip */
.dm-mega-foot {
    border-top:1px solid #eaebed; padding:16px 28px;
    display:flex; align-items:center; gap:12px; background:#f9fafb;
}
.dm-foot-label {
    font-size:10.5px; font-weight:700; letter-spacing:1.5px;
    text-transform:uppercase; color:#aaa; white-space:nowrap; flex-shrink:0;
}
.dm-foot-pills { display:flex; gap:6px; overflow-x:auto; scrollbar-width:none; }
.dm-foot-pills::-webkit-scrollbar { display:none; }
.dm-foot-pill {
    display:inline-flex; align-items:center; gap:6px; padding:6px 14px;
    border-radius:30px; border:1px solid #dde0e8; background:#fff;
    font-size:12px; font-weight:500; color:#3a3a3a; text-decoration:none; white-space:nowrap;
    transition:border-color .18s,color .18s,box-shadow .18s,background .18s;
}
.dm-foot-pill:hover {
    border-color:var(--dm-brand-from); color:var(--dm-brand-from);
    box-shadow:0 2px 12px rgba(27,60,107,.12); background:#f3f6ff;
}
</style>

{{-- ── Backdrop overlay ─────────────────────────────────────────── --}}
<div class="dm-mega-overlay" id="dmOverlay" aria-hidden="true"></div>

{{-- ── EXPERTISE MEGA MENU ──────────────────────────────────────── --}}
@php
$svcIcons = ['fa-chart-line','fa-shield-halved','fa-scale-balanced','fa-building-columns','fa-globe','fa-handshake','fa-calculator','fa-file-contract','fa-landmark','fa-briefcase','fa-magnifying-glass-chart','fa-coins'];
$firstSvc  = $navServices->first();
$secondSvc = $navServices->skip(1)->first();
@endphp

<div class="dm-mega" id="dmMegaExpertise" role="region" aria-label="Expertise navigation" aria-hidden="true">
    <div class="dm-mega-shell">
        <div class="dm-mega-card">
            <div class="dm-mega-body">
                <div class="dm-mega-left">
                    <div class="dm-mega-left-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2v-4M9 21H5a2 2 0 01-2-2v-4m0 0h18"/></svg>
                    </div>
                    <div class="dm-mega-left-eyebrow">Our Expertise</div>
                    <div class="dm-mega-left-heading">Strategic Advisory for a Complex World</div>
                    <p class="dm-mega-left-body">From regulatory compliance to global expansion — we deliver precision-led advisory that moves your business forward with confidence.</p>
                    <a href="{{ route('contact') }}" class="dm-mega-left-cta">
                        Book a Consultation
                        <svg width="14" height="14" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M1 7h12M8 2l5 5-5 5"/></svg>
                    </a>
                </div>
                <div class="dm-mega-center">
                    <span class="dm-section-label">Services</span>
                    <div class="dm-svc-grid">
                        <a href="https://www.devmantra.com/Korea-india-entry.html" class="dm-svc-card dm-svc-card--feature" tabindex="-1" data-mf>
                            <div class="dm-svc-icon">
                                <i class="fa-solid fa-earth-asia"></i>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="dm-svc-title">Korea–India Entry</div>
                                <div class="dm-svc-desc">End-to-end market entry support for Korean businesses expanding into India — strategy, compliance, and on-ground execution.</div>
                            </div>
                            <span class="dm-svc-arrow">→</span>
                        </a>
                        @forelse($navServices as $i => $svc)
                        <a href="{{ route('service.show', $svc->slug) }}" class="dm-svc-card" tabindex="-1" data-mf>
                            <div class="dm-svc-icon">
                                <i class="fa-solid {{ $svcIcons[$i % count($svcIcons)] }}"></i>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="dm-svc-title">{{ $svc->title }}</div>
                                @if(!empty($svc->short_description))
                                <div class="dm-svc-desc">{{ Str::limit($svc->short_description, 80) }}</div>
                                @endif
                            </div>
                            <span class="dm-svc-arrow">→</span>
                        </a>
                        @empty
                        <p style="color:#aaa;font-size:13px;grid-column:span 2;">No services listed yet.</p>
                        @endforelse
                    </div>
                </div>
                <div class="dm-mega-right">
                    <span class="dm-section-label">Quick Links</span>
                    <ul class="dm-quick-links">
                        <li>
                            <a href="{{ route('cost-calculator') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-calculator" style="font-size:11px;"></i></span>Cost Calculator
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('case-study.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-folder-open" style="font-size:11px;"></i></span>Case Studies
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-circle-info" style="font-size:11px;"></i></span>About DevMantra
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('report.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-file-lines" style="font-size:11px;"></i></span>Industry Reports
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-envelope" style="font-size:11px;"></i></span>Get in Touch
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('careers') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-user-tie" style="font-size:11px;"></i></span>Join Our Team
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dm-mega-foot">
                <span class="dm-foot-label">Solutions</span>
                <div class="dm-foot-pills">
                    @foreach($navServices->take(5) as $pill)
                    <a href="{{ route('service.show', $pill->slug) }}" class="dm-foot-pill" tabindex="-1" data-mf>
                        <i class="fa-solid fa-circle-dot" style="font-size:9px;opacity:.6;"></i>
                        {{ Str::limit($pill->title, 28) }}
                    </a>
                    @endforeach
                    <a href="{{ route('contact') }}" class="dm-foot-pill" tabindex="-1" data-mf>
                        <i class="fa-solid fa-rocket" style="font-size:9px;opacity:.6;"></i> Start a Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── INSIGHTS MEGA MENU ───────────────────────────────────────── --}}
<div class="dm-mega" id="dmMegaInsights" role="region" aria-label="Insights navigation" aria-hidden="true">
    <div class="dm-mega-shell">
        <div class="dm-mega-card">
            <div class="dm-mega-body">
                <div class="dm-mega-left">
                    <div class="dm-mega-left-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="dm-mega-left-eyebrow">Knowledge Hub</div>
                    <div class="dm-mega-left-heading">Stay Sharp, Stay Ahead</div>
                    <p class="dm-mega-left-body">Expert analysis, regulatory alerts, and thought leadership on corporate governance, tax strategy, and global business advisory.</p>
                    <a href="{{ route('newsletter.index') }}" class="dm-mega-left-cta">
                        Subscribe to Newsletter
                        <svg width="14" height="14" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M1 7h12M8 2l5 5-5 5"/></svg>
                    </a>
                </div>
                <div class="dm-mega-center">
                    <span class="dm-section-label">Explore Content</span>
                    <div class="dm-ins-grid">
                        <a href="{{ route('newsletter.index') }}" class="dm-ins-card" tabindex="-1" data-mf>
                            <div class="dm-ins-icon" style="background:#eef2ff;">
                                <i class="fa-solid fa-envelope-open-text" style="color:#4a73c4;"></i>
                            </div>
                            <div class="dm-ins-title">Newsletters</div>
                            <div class="dm-ins-desc">Curated insights on governance, tax, and regulatory shifts.</div>
                            <span class="dm-ins-link">Browse issues →</span>
                        </a>
                        <a href="{{ route('report.index') }}" class="dm-ins-card" tabindex="-1" data-mf>
                            <div class="dm-ins-icon" style="background:#fef3c7;">
                                <i class="fa-solid fa-file-chart-column" style="color:#d97706;"></i>
                            </div>
                            <div class="dm-ins-title">Reports</div>
                            <div class="dm-ins-desc">In-depth industry research and strategic benchmarks.</div>
                            <span class="dm-ins-link">View reports →</span>
                        </a>
                        <a href="{{ route('case-study.index') }}" class="dm-ins-card" tabindex="-1" data-mf>
                            <div class="dm-ins-icon" style="background:#dcfce7;">
                                <i class="fa-solid fa-folder-tree" style="color:#16a34a;"></i>
                            </div>
                            <div class="dm-ins-title">Case Studies</div>
                            <div class="dm-ins-desc">Real-world client outcomes in finance and compliance.</div>
                            <span class="dm-ins-link">Explore cases →</span>
                        </a>
                        <a href="{{ route('alert.index') }}" class="dm-ins-card" tabindex="-1" data-mf>
                            <div class="dm-ins-icon" style="background:#fee2e2;">
                                <i class="fa-solid fa-triangle-exclamation" style="color:#dc2626;"></i>
                            </div>
                            <div class="dm-ins-title">Alerts</div>
                            <div class="dm-ins-desc">Time-critical tax, deal, and compliance updates.</div>
                            <span class="dm-ins-link">See alerts →</span>
                        </a>
                        <a href="{{ route('blog.index') }}" class="dm-ins-card" tabindex="-1" data-mf>
                            <div class="dm-ins-icon" style="background:#f3e8ff;">
                                <i class="fa-solid fa-pen-nib" style="color:#7c3aed;"></i>
                            </div>
                            <div class="dm-ins-title">Blog</div>
                            <div class="dm-ins-desc">Expert perspectives on growth and digital economy.</div>
                            <span class="dm-ins-link">Read articles →</span>
                        </a>
                        <a href="{{ route('cost-calculator') }}" class="dm-ins-card" tabindex="-1" data-mf>
                            <div class="dm-ins-icon" style="background:#e0f2fe;">
                                <i class="fa-solid fa-calculator" style="color:#0284c7;"></i>
                            </div>
                            <div class="dm-ins-title">Cost Benchmarking</div>
                            <div class="dm-ins-desc">India vs Europe cost calculator for expansion decisions.</div>
                            <span class="dm-ins-link">Use tool →</span>
                        </a>
                    </div>
                </div>
                <div class="dm-mega-right">
                    <span class="dm-section-label">Trending Topics</span>
                    <ul class="dm-quick-links">
                        <li>
                            <a href="{{ route('alert.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-bolt" style="font-size:11px;color:#dc2626;"></i></span>Tax Alerts
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('report.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-landmark" style="font-size:11px;"></i></span>Regulatory Updates
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('case-study.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-globe-asia" style="font-size:11px;"></i></span>Global Expansion
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('newsletter.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-building" style="font-size:11px;"></i></span>Corporate Governance
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog.index') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-chart-bar" style="font-size:11px;"></i></span>Financial Strategy
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dm-mega-foot">
                <span class="dm-foot-label">Popular</span>
                <div class="dm-foot-pills">
                    <a href="{{ route('newsletter.index') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-envelope" style="font-size:10px;opacity:.7;"></i> Newsletters</a>
                    <a href="{{ route('report.index') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-file-lines" style="font-size:10px;opacity:.7;"></i> Reports</a>
                    <a href="{{ route('alert.index') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-bell" style="font-size:10px;opacity:.7;"></i> Latest Alerts</a>
                    <a href="{{ route('blog.index') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-rss" style="font-size:10px;opacity:.7;"></i> Blog</a>
                    <a href="{{ route('cost-calculator') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-calculator" style="font-size:10px;opacity:.7;"></i> Calculator</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── MORE MEGA MENU ───────────────────────────────────────────── --}}
<div class="dm-mega" id="dmMegaMore" role="region" aria-label="More navigation" aria-hidden="true">
    <div class="dm-mega-shell">
        <div class="dm-mega-card">
            <div class="dm-mega-body">
                {{-- Left --}}
                <div class="dm-mega-left">
                    <div class="dm-mega-left-icon">
                        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div class="dm-mega-left-eyebrow">Connect</div>
                    <div class="dm-mega-left-heading">Let's Build Something Together</div>
                    <p class="dm-mega-left-body">Explore opportunities, attend events, join our team, or simply reach out — we'd love to hear from you.</p>
                    <a href="{{ route('contact') }}" class="dm-mega-left-cta">
                        Get in Touch
                        <svg width="14" height="14" fill="none" viewBox="0 0 14 14" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M1 7h12M8 2l5 5-5 5"/></svg>
                    </a>
                </div>
                {{-- Center --}}
                <div class="dm-mega-center">
                    <span class="dm-section-label">Explore</span>
                    <div class="dm-svc-grid">
                        <a href="{{ route('events') }}" class="dm-svc-card" tabindex="-1" data-mf>
                            <div class="dm-svc-icon" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="dm-svc-title">Events</div>
                                <div class="dm-svc-desc">Webinars, conferences, and thought-leadership sessions from DevMantra.</div>
                            </div>
                            <span class="dm-svc-arrow">→</span>
                        </a>
                        <a href="{{ route('careers') }}" class="dm-svc-card" tabindex="-1" data-mf>
                            <div class="dm-svc-icon" style="background:linear-gradient(135deg,#059669,#34d399);">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="dm-svc-title">Careers</div>
                                <div class="dm-svc-desc">Join a team of strategic advisors shaping the future of global business.</div>
                            </div>
                            <span class="dm-svc-arrow">→</span>
                        </a>
                        <a href="{{ route('contact') }}" class="dm-svc-card" tabindex="-1" data-mf>
                            <div class="dm-svc-icon" style="background:linear-gradient(135deg,var(--dm-brand-from),var(--dm-brand-to));">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="dm-svc-title">Contact Us</div>
                                <div class="dm-svc-desc">Talk to our advisory team for a tailored consultation or project inquiry.</div>
                            </div>
                            <span class="dm-svc-arrow">→</span>
                        </a>
                        <a href="{{ route('about') }}" class="dm-svc-card" tabindex="-1" data-mf>
                            <div class="dm-svc-icon" style="background:linear-gradient(135deg,#ea580c,#fb923c);">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <div style="flex:1;min-width:0;">
                                <div class="dm-svc-title">About DevMantra</div>
                                <div class="dm-svc-desc">Founded in 2008, DevMantra partners with businesses navigating a global, digital economy.</div>
                            </div>
                            <span class="dm-svc-arrow">→</span>
                        </a>
                    </div>
                </div>
                {{-- Right --}}
                <div class="dm-mega-right">
                    <span class="dm-section-label">Reach Us</span>
                    <div style="display:flex;flex-direction:column;gap:12px;margin-bottom:20px;">
                        <a href="tel:+918042061247" style="display:flex;align-items:center;gap:10px;text-decoration:none;color:#2c2c2c;font-size:13px;font-weight:500;transition:color .16s;" tabindex="-1" data-mf>
                            <span class="dm-ql-dot"><i class="fa-solid fa-phone" style="font-size:11px;"></i></span>
                            +91-80-4206 1247
                        </a>
                        <a href="mailto:support@devmantra.com" style="display:flex;align-items:center;gap:10px;text-decoration:none;color:#2c2c2c;font-size:13px;font-weight:500;transition:color .16s;" tabindex="-1" data-mf>
                            <span class="dm-ql-dot"><i class="fa-solid fa-envelope" style="font-size:11px;"></i></span>
                            support@devmantra.com
                        </a>
                        <span style="display:flex;align-items:center;gap:10px;color:#2c2c2c;font-size:13px;font-weight:500;">
                            <span class="dm-ql-dot"><i class="fa-solid fa-location-dot" style="font-size:11px;"></i></span>
                            Bengaluru, India
                        </span>
                    </div>
                    <span class="dm-section-label" style="margin-top:8px;">More Links</span>
                    <ul class="dm-quick-links">
                        <li>
                            <a href="{{ route('cost-calculator') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-calculator" style="font-size:11px;"></i></span>Cost Calculator
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('bookmarks') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-bookmark" style="font-size:11px;"></i></span>Resources Hub
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('privacy-policy') }}" tabindex="-1" data-mf>
                                <span class="dm-ql-dot"><i class="fa-solid fa-shield-halved" style="font-size:11px;"></i></span>Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dm-mega-foot">
                <span class="dm-foot-label">Quick Access</span>
                <div class="dm-foot-pills">
                    <a href="{{ route('events') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-calendar-days" style="font-size:10px;opacity:.7;"></i> Events</a>
                    <a href="{{ route('careers') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-briefcase" style="font-size:10px;opacity:.7;"></i> Careers</a>
                    <a href="{{ route('contact') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-envelope" style="font-size:10px;opacity:.7;"></i> Contact</a>
                    <a href="{{ route('about') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-building" style="font-size:10px;opacity:.7;"></i> About Us</a>
                    <a href="{{ route('cost-calculator') }}" class="dm-foot-pill" tabindex="-1" data-mf><i class="fa-solid fa-calculator" style="font-size:10px;opacity:.7;"></i> Calculator</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Offcanvas (mobile) — nav populated by main.js clone ────────── --}}
<div class="tp-offcanvas-area">
    <div class="tp-offcanvas-wrapper">
        <div class="tp-offcanvas-top d-flex align-items-center justify-content-between">
            <div class="tp-offcanvas-logo">
                <a href="{{ route('home') }}">
                    <img class="logo-1" width="120" data-width="120" src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra" style="border-radius:50px;width:120px;height:auto;">
                    <img class="logo-2" width="120" data-width="120" src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra" style="border-radius:50px;width:120px;height:auto;">
                </a>
            </div>
            <div class="tp-offcanvas-close">
                <button class="tp-offcanvas-close-btn" aria-label="Close menu">
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
            {{-- main.js clones .tp-mobile-menu-active > ul here --}}
            <div class="tp-offcanvas-menu d-xl-none">
                <nav></nav>
            </div>
            <div class="tp-offcanvas-contact">
                <h3 class="tp-offcanvas-title sm">Information</h3>
                <ul>
                    <li><a href="tel:+9180-42061247">+91-80-42061247</a></li>
                    <li><a href="mailto:support@devmantra.com">support@devmantra.com</a></li>
                    <li><a href="#">Bengaluru, India</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="body-overlay"></div>

{{-- ── Header ──────────────────────────────────────────────────── --}}
<header>
    <div id="header-sticky" class="tp-header-area tp-header-13-ptb sticky-white-bg tp-header-blur header-transparent">
        <div class="container container-1750">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-5">
                    <div class="tp-header-logo">
                        <a href="{{ route('home') }}">
                            <img style="border-radius:50px;width:140px;height:auto;" width="140" data-width="140" src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra">
                        </a>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-9 col-7">
                    <div class="tp-header-box d-flex align-items-center justify-content-end justify-content-xl-between">
                        <div class="tp-header-menu tp-header-13-menu tp-header-dropdown dropdown-black-bg d-none d-lg-flex">
                            <nav class="tp-mobile-menu-active" aria-label="Main navigation">
                                <ul>
                                    <li>
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}">About Us</a>
                                    </li>
                                    {{-- Expertise: mega on desktop, accordion on mobile (via cloned submenu) --}}
                                    <li class="has-mega has-dropdown" data-mega="dmMegaExpertise">
                                        <a href="javascript:void(0)"
                                           aria-haspopup="true" aria-expanded="false"
                                           id="dmTriggerExpertise">
                                            Expertise
                                            <svg class="dm-nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg>
                                        </a>
                                        {{-- Hidden on desktop; cloned to mobile accordion by main.js --}}
                                        <ul class="tp-submenu submenu">
                                            <li><a href="https://www.devmantra.com/Korea-india-entry.html">Korea–India Entry</a></li>
                                            @foreach($navServices as $navService)
                                            <li><a href="{{ route('service.show', $navService->slug) }}">{{ $navService->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    {{-- Insights: mega on desktop, accordion on mobile --}}
                                    <li class="has-mega has-dropdown" data-mega="dmMegaInsights">
                                        <a href="javascript:void(0)"
                                           aria-haspopup="true" aria-expanded="false"
                                           id="dmTriggerInsights">
                                            Insights
                                            <svg class="dm-nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg>
                                        </a>
                                        <ul class="tp-submenu submenu">
                                            <li><a href="{{ route('newsletter.index') }}">Newsletters</a></li>
                                            <li><a href="{{ route('report.index') }}">Reports</a></li>
                                            <li><a href="{{ route('case-study.index') }}">Case Studies</a></li>
                                            <li><a href="{{ route('alert.index') }}">Alerts</a></li>
                                            <li><a href="{{ route('blog.index') }}">Blogs</a></li>
                                        </ul>
                                    </li>
                                    {{-- More: mega on desktop, accordion on mobile --}}
                                    <li class="has-mega has-dropdown" data-mega="dmMegaMore">
                                        <a href="javascript:void(0)"
                                           aria-haspopup="true" aria-expanded="false"
                                           id="dmTriggerMore">
                                            More
                                            <svg class="dm-nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg>
                                        </a>
                                        {{-- Hidden on desktop; cloned to mobile accordion by main.js --}}
                                        <ul class="tp-submenu submenu">
                                            <li><a href="{{ route('events') }}">Events</a></li>
                                            <li><a href="{{ route('careers') }}">Careers</a></li>
                                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                            <li><a href="{{ route('about') }}">About Us</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="tp-header-right d-flex align-items-center justify-content-end">
                            <div class="tp-header-btn-box d-none d-xl-block ml-15">
                                <x-btn-secondary class="dm-btn-sm" />
                            </div>
                            <div class="tp-header-btn-box d-none d-xl-block ml-15">
                                <x-btn-primary class="dm-btn-sm" />
                            </div>
                            <div class="tp-header-bar ml-20 d-lg-none">
                                <button class="tp-offcanvas-open-btn" type="button" aria-label="Open menu">
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

{{-- ── MEGA MENU JAVASCRIPT ─────────────────────────────────────── --}}
<script>
(function () {
    'use strict';

    var overlay    = document.getElementById('dmOverlay');
    var megaItems  = document.querySelectorAll('.tp-header-menu .has-mega');
    var openId     = null;
    var closeTimer = null;
    var HOVER_DELAY = 130;   // ms before hover-close fires
    var lastWasTouch = false; // guards against synthetic mouseenter from touch taps

    /* ── Touch / mouse detection ──────────────────────────────────
       touchstart fires before mouseenter on the same tap.
       We set lastWasTouch = true so mouseenter can skip itself,
       letting the subsequent click event own the toggle instead. */
    document.addEventListener('touchstart', function () {
        lastWasTouch = true;
    }, { passive: true });
    document.addEventListener('mousemove', function () {
        lastWasTouch = false;
    }, { passive: true });

    /* ── Scroll lock ──────────────────────────────────────────────
       Prevents the background page from scrolling while mega is open.
       Uses position:fixed trick so iOS Safari is also covered. */
    function lockScroll() {
        if (document.body.classList.contains('dm-scroll-lock')) return;
        var sy = window.pageYOffset || document.documentElement.scrollTop;
        document.body.style.top = '-' + sy + 'px';
        document.body.classList.add('dm-scroll-lock');
        document.body.dataset.dmSy = sy;
    }
    function unlockScroll() {
        if (!document.body.classList.contains('dm-scroll-lock')) return;
        var sy = parseInt(document.body.dataset.dmSy || '0', 10);
        document.body.classList.remove('dm-scroll-lock');
        document.body.style.top = '';
        window.scrollTo(0, sy);
    }

    /* ── Positioning ──────────────────────────────────────────── */
    function headerBottom() {
        var h = document.getElementById('header-sticky');
        return h ? h.getBoundingClientRect().bottom : 0;
    }
    function positionMega(el) {
        var hb = headerBottom();
        el.style.top       = hb + 'px';
        el.style.maxHeight = (window.innerHeight - hb) + 'px';
    }

    /* ── Open / close ─────────────────────────────────────────── */
    function openMega(id, triggerEl) {
        if (openId === id) return;
        /* Close any currently open panel without releasing scroll yet */
        _closeAll(true);
        openId = id;

        var panel = document.getElementById(id);
        if (!panel) return;

        var li = triggerEl ? triggerEl.closest('li') : null;
        if (li) li.classList.add('dm-mega-active');
        if (triggerEl) triggerEl.setAttribute('aria-expanded', 'true');

        positionMega(panel);
        panel.setAttribute('aria-hidden', 'false');
        panel.classList.add('is-open');
        overlay.classList.add('is-open');
        lockScroll();

        panel.querySelectorAll('[data-mf]').forEach(function (el) {
            el.removeAttribute('tabindex');
        });
    }

    /* _closeAll(keepLock) – internal; skips unlockScroll when keepLock=true */
    function _closeAll(keepLock) {
        if (closeTimer) { clearTimeout(closeTimer); closeTimer = null; }

        document.querySelectorAll('.dm-mega.is-open').forEach(function (p) {
            p.classList.remove('is-open');
            p.setAttribute('aria-hidden', 'true');
            p.querySelectorAll('[data-mf]').forEach(function (el) {
                el.setAttribute('tabindex', '-1');
            });
        });
        megaItems.forEach(function (li) {
            li.classList.remove('dm-mega-active');
            var a = li.querySelector(':scope > a');
            if (a) a.setAttribute('aria-expanded', 'false');
        });
        overlay.classList.remove('is-open');
        if (!keepLock) unlockScroll();
        openId = null;
    }

    function closeAll() { _closeAll(false); }

    function scheduleClose() {
        if (closeTimer) clearTimeout(closeTimer);
        closeTimer = setTimeout(closeAll, HOVER_DELAY);
    }
    function cancelClose() {
        if (closeTimer) { clearTimeout(closeTimer); closeTimer = null; }
    }

    /* ── Wire up each mega-trigger <li> ──────────────────────── */
    megaItems.forEach(function (li) {
        var a      = li.querySelector(':scope > a');
        var megaId = li.getAttribute('data-mega');
        var panel  = document.getElementById(megaId);

        /* Hover – mouse only; skipped when lastWasTouch is true */
        li.addEventListener('mouseenter', function () {
            if (lastWasTouch) return;
            cancelClose();
            openMega(megaId, a);
        });
        li.addEventListener('mouseleave', function () {
            if (lastWasTouch) return;
            scheduleClose();
        });

        /* Click / tap – works on every device.
           On touch the sequence is: touchstart → mouseenter (skipped) → click.
           On mouse: clicking an already-hover-opened menu closes it (toggle). */
        if (a) {
            a.addEventListener('click', function (e) {
                e.preventDefault();
                if (openId === megaId) { closeAll(); } else { openMega(megaId, a); }
            });

            /* Keyboard */
            a.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ' || e.key === 'ArrowDown') {
                    e.preventDefault();
                    openId === megaId ? closeAll() : openMega(megaId, a);
                }
                if (e.key === 'Escape') { closeAll(); a.focus(); }
            });
        }

        /* Keep open while mouse is inside the panel */
        if (panel) {
            panel.addEventListener('mouseenter', function () {
                if (lastWasTouch) return;
                cancelClose();
            });
            panel.addEventListener('mouseleave', function () {
                if (lastWasTouch) return;
                scheduleClose();
            });
        }
    });

    /* ── Global close triggers ───────────────────────────────── */
    overlay.addEventListener('click', closeAll);
    /* touchend on overlay for touch devices */
    overlay.addEventListener('touchend', function (e) {
        e.preventDefault();
        closeAll();
    });

    /* Escape key */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && openId) {
            var activeLi = document.querySelector('.has-mega.dm-mega-active');
            closeAll();
            if (activeLi) {
                var ta = activeLi.querySelector(':scope > a');
                if (ta) ta.focus();
            }
        }
    });

    /* Reposition on resize */
    window.addEventListener('resize', function () {
        /* Close on resize below desktop breakpoint */
        if (window.innerWidth < 992 && openId) { closeAll(); return; }
        if (!openId) return;
        var p = document.getElementById(openId);
        if (p) positionMega(p);
    });

    /* Close when focus moves completely outside nav + panel */
    document.addEventListener('focusin', function (e) {
        if (!openId) return;
        var panel  = document.getElementById(openId);
        var inNav  = e.target.closest('.tp-header-menu');
        var inPanel = panel && panel.contains(e.target);
        if (!inNav && !inPanel) closeAll();
    });

    /* ── Active nav highlight ────────────────────────────────── */
    var path = window.location.pathname;
    document.querySelectorAll('.tp-header-menu nav a[href]').forEach(function (a) {
        try {
            var url = new URL(a.href, window.location.origin);
            var match = url.pathname === '/'
                ? path === '/'
                : path.startsWith(url.pathname);
            if (match) a.classList.add('dm-nav-active');
        } catch (e) {}
    });
})();
</script>
