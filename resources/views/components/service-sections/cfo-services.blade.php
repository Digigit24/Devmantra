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
.ss-cfo { padding: 90px 0; background: #f4f6fb; font-family: var(--tp-ff-onest); }
.ss-cfo-header { margin-bottom: 48px; }
.ss-cfo-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 16px; line-height: 1.3; font-family: var(--tp-ff-onest);
}
.ss-cfo-desc { font-size: 16px; color: #555; line-height: 1.75; max-width: 720px; margin: 0; }
@media (max-width: 767px) { .ss-cfo-title { font-size: 26px; } }

.ss-cfo-col-title {
    font-size: 17px; font-weight: 700; color: #1b3c6b;
    margin-bottom: 24px; display: flex; align-items: center; gap: 10px;
    font-family: var(--tp-ff-onest);
}
.ss-cfo-col-title svg { flex-shrink: 0; }

/* Left: checklist */
.ss-cfo-left { background: #fff; border-radius: 14px; padding: 36px 32px; height: 100%; box-shadow: 0 2px 20px rgba(0,0,0,0.06); }
.ss-cfo-checklist { list-style: none; padding: 0; margin: 0; }
.ss-cfo-checklist li {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 9px 0; border-bottom: 1px solid rgba(0,0,0,0.06);
    font-size: 15px; color: #444; line-height: 1.6;
}
.ss-cfo-checklist li:last-child { border-bottom: none; }
.ss-cfo-check {
    flex-shrink: 0; width: 20px; height: 20px; margin-top: 2px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 50%;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 12 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4L4.5 7.5L11 1' stroke='white' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat; background-position: center; background-size: 12px;
}

/* Right: type cards */
.ss-cfo-right { display: flex; flex-direction: column; gap: 0; }
.ss-cfo-type-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.ss-cfo-type-card {
    background: #fff; border-radius: 12px; padding: 28px 24px;
    border-left: 4px solid #1b3c6b; box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    font-size: 16px; font-weight: 600; color: #0d1b2a;
    font-family: var(--tp-ff-onest); line-height: 1.4;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.ss-cfo-type-card:hover { transform: translateY(-3px); box-shadow: 0 6px 24px rgba(27,60,107,0.12); }
@media (max-width: 575px) { .ss-cfo-type-grid { grid-template-columns: 1fr; } }
</style>
@endpush
@endonce

<section class="ss-cfo">
    <div class="container container-1230">
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
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1b3c6b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                        </svg>
                        {{ $scopeTitle }}
                    </h3>
                    @endif
                    <ul class="ss-cfo-checklist">
                        @foreach($scopeItems as $item)
                        <li>
                            <span class="ss-cfo-check"></span>
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
                    <h3 class="ss-cfo-col-title mb-3">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1b3c6b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                        </svg>
                        {{ $typesTitle }}
                    </h3>
                    @endif
                    <div class="ss-cfo-type-grid">
                        @foreach($types as $type)
                        <div class="ss-cfo-type-card">{{ $type }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
