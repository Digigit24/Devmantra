@props(['data' => []])
@php
    $title      = $data['title']      ?? '';
    $columns    = $data['columns']    ?? [];  // [{title, items:[]}]
    $disclaimer = $data['disclaimer'] ?? '';
@endphp

@once
@push('styles')
<style>
.ss-governance { padding: 90px 0; background: #fff; font-family: var(--tp-ff-onest); }
.ss-governance-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 50px; font-family: var(--tp-ff-onest); line-height: 1.3;
}
@media (max-width: 767px) { .ss-governance-title { font-size: 26px; margin-bottom: 36px; } }
.ss-governance-col {
    background: #f5f7fa;
    border-radius: 16px;
    padding: 32px 28px;
    height: 100%;
}
.ss-governance-col-title {
    font-size: 17px; font-weight: 700; color: #1b3c6b;
    margin-bottom: 20px; padding-bottom: 14px;
    border-bottom: 2px solid rgba(27,60,107,0.15);
    font-family: var(--tp-ff-onest);
}
.ss-governance-list { list-style: none; padding: 0; margin: 0; }
.ss-governance-list li {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 9px 0;
    font-size: 15px; color: #444; line-height: 1.6;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.ss-governance-list li:last-child { border-bottom: none; }
.ss-governance-list li::before {
    content: '✓';
    flex-shrink: 0;
    color: #1b3c6b; font-weight: 700;
    margin-top: 1px;
}
.ss-governance-disclaimer {
    margin-top: 40px;
    background: linear-gradient(135deg, #1b3c6b, #2e5fa3);
    border-radius: 14px;
    padding: 24px 32px;
    font-size: 14px; color: rgba(255,255,255,0.85);
    line-height: 1.75; font-style: italic;
    text-align: center;
}
</style>
@endpush
@endonce

<section class="ss-governance">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-governance-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        <div class="row g-4 tp_fade_anim" data-delay=".3">
            @foreach($columns as $col)
            <div class="col-md-{{ count($columns) == 2 ? 6 : 4 }}">
                <div class="ss-governance-col">
                    <h3 class="ss-governance-col-title">{{ $col['title'] ?? '' }}</h3>
                    <ul class="ss-governance-list">
                        @foreach($col['items'] ?? [] as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        @if($disclaimer)
        <div class="ss-governance-disclaimer tp_fade_anim" data-delay=".4">{{ $disclaimer }}</div>
        @endif
    </div>
</section>
