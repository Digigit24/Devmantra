@props(['data' => []])
@php
    $title       = $data['title']       ?? 'Get the Opportunity to Work with the Best Chief Financial Officer';
    $description = $data['description'] ?? '';
    $scopeTitle  = $data['scope_title'] ?? 'CFO Scope Includes';
    $scopeItems  = $data['scope_items'] ?? [];
    $typesTitle  = $data['types_title'] ?? 'CFO Engagement Types';
    $types       = $data['types']       ?? [];
@endphp

@once
@push('styles')
<style>
/* ── CFO Services ── */
.ss-cfo {
    padding: 100px 0;
    background: #001d30;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-cfo::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse at 80% 20%, rgba(74,115,196,0.09) 0%, transparent 50%),
        radial-gradient(ellipse at 10% 80%, rgba(27,60,107,0.12) 0%, transparent 45%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-cfo { padding: 80px 0; } }
@media (max-width: 767px) { .ss-cfo { padding: 64px 0; } }

.ss-cfo-header { margin-bottom: 56px; }
.ss-cfo-title {
    font-size: 38px; font-weight: 700; color: #fff;
    margin-bottom: 16px; line-height: 1.25;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-cfo-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-cfo-title { font-size: 24px; } }
.ss-cfo-desc {
    font-size: 16px; color: rgba(255,255,255,0.58);
    line-height: 1.8; max-width: 720px; margin: 0;
}

/* Column title */
.ss-cfo-col-title {
    font-size: 13px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #4a73c4;
    margin-bottom: 24px;
    display: flex; align-items: center; gap: 10px;
    font-family: var(--tp-ff-onest);
}
.ss-cfo-col-title svg { flex-shrink: 0; }

/* Left: scope checklist card */
.ss-cfo-left {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 20px;
    padding: 36px 32px;
    height: 100%;
    position: relative;
    overflow: hidden;
}
.ss-cfo-left::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
}

.ss-cfo-checklist { list-style: none; padding: 0; margin: 0; }
.ss-cfo-checklist li {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    font-size: 15px; color: rgba(255,255,255,0.75);
    line-height: 1.6;
    transition: color .2s ease;
}
.ss-cfo-checklist li:last-child { border-bottom: none; }
.ss-cfo-checklist li:hover { color: rgba(255,255,255,0.95); }
.ss-cfo-check {
    flex-shrink: 0;
    width: 22px; height: 22px;
    margin-top: 1px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.ss-cfo-check svg { width: 11px; height: 11px; }

/* Right: engagement type cards */
.ss-cfo-right {
    height: 100%;
    display: flex;
    flex-direction: column;
    gap: 0;
}
.ss-cfo-type-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}
@media (max-width: 575px) { .ss-cfo-type-grid { grid-template-columns: 1fr; } }

.ss-cfo-type-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 16px;
    padding: 28px 24px;
    position: relative;
    overflow: hidden;
    transition: transform .35s cubic-bezier(.165,.84,.44,1),
                border-color .35s ease,
                background .35s ease,
                box-shadow .35s ease;
}
/* top gradient accent line */
.ss-cfo-type-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .4s cubic-bezier(.165,.84,.44,1);
}
.ss-cfo-type-card:hover {
    transform: translateY(-5px);
    border-color: rgba(74,115,196,0.3);
    background: rgba(255,255,255,0.07);
    box-shadow: 0 16px 48px rgba(0,0,0,0.35);
}
.ss-cfo-type-card:hover::before { transform: scaleX(1); }

.ss-cfo-type-icon {
    width: 40px; height: 40px;
    background: rgba(74,115,196,0.2);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 16px;
    transition: background .3s ease;
}
.ss-cfo-type-card:hover .ss-cfo-type-icon { background: rgba(74,115,196,0.35); }
.ss-cfo-type-icon svg { width: 18px; height: 18px; }
.ss-cfo-type-name {
    font-size: 15px; font-weight: 700; color: #fff;
    font-family: var(--tp-ff-onest); line-height: 1.4;
    margin: 0;
}
</style>
@endpush
@endonce

<section class="ss-cfo">
    <div class="container container-1230" style="position:relative;z-index:1;">

        <div class="ss-cfo-header tp_fade_anim" data-delay=".2">
            @if($title)
            <h2 class="ss-cfo-title">{{ $title }}</h2>
            @endif
            @if($description)
            <p class="ss-cfo-desc">{{ $description }}</p>
            @endif
        </div>

        <div class="row g-4 align-items-start">

            {{-- Left: CFO Scope Checklist --}}
            <div class="col-lg-6 tp_fade_anim" data-delay=".3">
                <div class="ss-cfo-left">
                    @if($scopeTitle)
                    <h3 class="ss-cfo-col-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4a73c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                        {{ $scopeTitle }}
                    </h3>
                    @endif
                    <ul class="ss-cfo-checklist">
                        @foreach($scopeItems as $item)
                        <li>
                            <span class="ss-cfo-check">
                                <svg viewBox="0 0 11 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 4.5L4 7.5L10 1.5" stroke="white" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Right: CFO Engagement Types --}}
            <div class="col-lg-6 tp_fade_anim" data-delay=".4">
                <div class="ss-cfo-right">
                    @if($typesTitle)
                    <h3 class="ss-cfo-col-title mb-4">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#4a73c4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                        </svg>
                        {{ $typesTitle }}
                    </h3>
                    @endif
                    <div class="ss-cfo-type-grid">
                        @foreach($types as $i => $type)
                        <div class="ss-cfo-type-card">
                            <div class="ss-cfo-type-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#7eb8ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                                </svg>
                            </div>
                            <p class="ss-cfo-type-name">{{ $type }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
