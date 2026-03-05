@props(['data' => []])
@php
    $title     = $data['title']          ?? '';
    $col1Title = $data['column1_title']  ?? 'Column 1';
    $col2Title = $data['column2_title']  ?? 'Column 2';
    $rows      = $data['rows']           ?? [];  // [["left", "right"], ...]
@endphp

@once
@push('styles')
<style>
/* ── Comparison Table ── */
.ss-comparison {
    padding: 100px 0;
    background: #0a0a0a;
    font-family: var(--tp-ff-onest);
    position: relative;
    overflow: hidden;
}
.ss-comparison::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 50% 100%, rgba(74,115,196,0.08) 0%, transparent 60%);
    pointer-events: none;
}
@media (max-width: 991px) { .ss-comparison { padding: 80px 0; } }
@media (max-width: 767px) { .ss-comparison { padding: 64px 0; } }

.ss-comparison-title {
    font-size: 38px; font-weight: 700; color: #fff;
    text-align: center; margin-bottom: 56px; line-height: 1.25;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-comparison-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-comparison-title { font-size: 24px; margin-bottom: 36px; } }

/* Table wrapper */
.ss-comparison-wrap {
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.07);
}

/* Header row */
.ss-comparison-header {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
.ss-comparison-head-cell {
    padding: 20px 32px;
    font-size: 13px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase;
    display: flex; align-items: center; gap: 10px;
}
.ss-comparison-head-cell:first-child {
    background: rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.7);
    border-right: 1px solid rgba(255,255,255,0.06);
}
.ss-comparison-head-cell:last-child {
    background: linear-gradient(135deg, #1b3c6b, #2e5fa3);
    color: #fff;
}
.ss-comparison-head-icon {
    width: 28px; height: 28px;
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 800; flex-shrink: 0;
}
.ss-comparison-head-cell:first-child .ss-comparison-head-icon {
    background: rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.6);
}
.ss-comparison-head-cell:last-child .ss-comparison-head-icon {
    background: rgba(255,255,255,0.2);
    color: #fff;
}

/* Data rows */
.ss-comparison-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-top: 1px solid rgba(255,255,255,0.05);
    transition: background .2s ease;
    cursor: default;
}
.ss-comparison-row:hover { background: rgba(255,255,255,0.02); }

.ss-comparison-cell {
    padding: 16px 32px;
    font-size: 14.5px;
    display: flex; align-items: center; gap: 14px;
    line-height: 1.5;
}
.ss-comparison-cell:first-child {
    background: rgba(255,255,255,0.02);
    color: rgba(255,255,255,0.55);
    border-right: 1px solid rgba(255,255,255,0.05);
}
.ss-comparison-cell:last-child {
    background: rgba(27,60,107,0.12);
    color: rgba(255,255,255,0.88);
}
/* icon badges */
.ss-comparison-cell-icon {
    flex-shrink: 0;
    width: 24px; height: 24px;
    border-radius: 50%;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800;
}
.ss-comparison-cell:first-child .ss-comparison-cell-icon {
    background: rgba(255,80,80,0.15);
    color: #ff6b6b;
}
.ss-comparison-cell:last-child .ss-comparison-cell-icon {
    background: rgba(74,115,196,0.25);
    color: #7eb8ff;
}
.ss-comparison-row:hover .ss-comparison-cell:last-child {
    background: rgba(27,60,107,0.2);
}

@media (max-width: 575px) {
    .ss-comparison-header,
    .ss-comparison-row { grid-template-columns: 1fr; }
    .ss-comparison-cell:first-child { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.05); }
    .ss-comparison-head-cell:first-child { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.06); }
    .ss-comparison-cell { padding: 14px 20px; }
    .ss-comparison-head-cell { padding: 16px 20px; }
}
</style>
@endpush
@endonce

<section class="ss-comparison">
    <div class="container container-1230" style="position:relative;z-index:1;">
        @if($title)
        <h2 class="ss-comparison-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif

        <div class="ss-comparison-wrap tp_fade_anim" data-delay=".3">
            {{-- Header --}}
            <div class="ss-comparison-header">
                <div class="ss-comparison-head-cell">
                    <span class="ss-comparison-head-icon">✕</span>
                    {{ $col1Title }}
                </div>
                <div class="ss-comparison-head-cell">
                    <span class="ss-comparison-head-icon">✓</span>
                    {{ $col2Title }}
                </div>
            </div>

            {{-- Rows --}}
            @foreach($rows as $row)
            <div class="ss-comparison-row">
                <div class="ss-comparison-cell">
                    <span class="ss-comparison-cell-icon">✕</span>
                    {{ $row[0] ?? '' }}
                </div>
                <div class="ss-comparison-cell">
                    <span class="ss-comparison-cell-icon">✓</span>
                    {{ $row[1] ?? '' }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
