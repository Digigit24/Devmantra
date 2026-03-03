@props(['data' => []])
@php
    $title         = $data['title']          ?? '';
    $col1Title     = $data['column1_title']  ?? 'Column 1';
    $col2Title     = $data['column2_title']  ?? 'Column 2';
    $rows          = $data['rows']           ?? [];  // [["left", "right"], ...]
@endphp

@once
@push('styles')
<style>
.ss-comparison { padding: 90px 0; background: #0a0a0a; font-family: var(--tp-ff-onest); }
.ss-comparison-title {
    font-size: 34px; font-weight: 700; color: #fff;
    text-align: center; margin-bottom: 48px; line-height: 1.3;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-comparison-title { font-size: 24px; margin-bottom: 32px; } }
.ss-comparison-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0; border-radius: 16px; overflow: hidden; }
@media (max-width: 767px) { .ss-comparison-grid { grid-template-columns: 1fr; } }
.ss-comparison-col { }
.ss-comparison-col-head {
    padding: 20px 28px;
    font-size: 14px; font-weight: 700; letter-spacing: 0.5px;
    text-align: center;
}
.ss-comparison-col:first-child .ss-comparison-col-head {
    background: rgba(255,255,255,0.06);
    color: rgba(255,255,255,0.9);
    border-bottom: 1px solid rgba(255,255,255,0.08);
}
.ss-comparison-col:last-child .ss-comparison-col-head {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
}
.ss-comparison-cell {
    padding: 14px 28px;
    font-size: 15px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
    display: flex; align-items: center; gap: 12px;
}
.ss-comparison-col:first-child .ss-comparison-cell {
    background: rgba(255,255,255,0.03);
    color: rgba(255,255,255,0.6);
}
.ss-comparison-col:first-child .ss-comparison-cell::before {
    content: '•';
    color: rgba(255,255,255,0.3); flex-shrink: 0;
}
.ss-comparison-col:last-child .ss-comparison-cell {
    background: rgba(27,60,107,0.15);
    color: rgba(255,255,255,0.85);
}
.ss-comparison-col:last-child .ss-comparison-cell::before {
    content: '✓';
    color: #4a73c4; font-weight: 800; flex-shrink: 0;
}
</style>
@endpush
@endonce

<section class="ss-comparison">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-comparison-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        <div class="ss-comparison-grid tp_fade_anim" data-delay=".3">
            <div class="ss-comparison-col">
                <div class="ss-comparison-col-head">{{ $col1Title }}</div>
                @foreach($rows as $row)
                <div class="ss-comparison-cell">{{ $row[0] ?? '' }}</div>
                @endforeach
            </div>
            <div class="ss-comparison-col">
                <div class="ss-comparison-col-head">{{ $col2Title }}</div>
                @foreach($rows as $row)
                <div class="ss-comparison-cell">{{ $row[1] ?? '' }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>
