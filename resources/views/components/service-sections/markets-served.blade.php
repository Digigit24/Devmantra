@props(['data' => []])
@php
    $title   = $data['title']   ?? 'Markets Served';
    $markets = $data['markets'] ?? [];   // [string, ...]
    // Map market name → flag emoji
    $flags = [
        'usa' => '🇺🇸', 'united states' => '🇺🇸', 'us' => '🇺🇸',
        'uk' => '🇬🇧', 'united kingdom' => '🇬🇧',
        'europe' => '🇪🇺',
        'korea' => '🇰🇷', 'south korea' => '🇰🇷',
        'japan' => '🇯🇵',
        'singapore' => '🇸🇬',
        'dubai' => '🇦🇪', 'uae' => '🇦🇪', 'abu dhabi' => '🇦🇪',
        'australia' => '🇦🇺',
        'new zealand' => '🇳🇿',
        'canada' => '🇨🇦',
        'india' => '🇮🇳',
    ];
@endphp

@once
@push('styles')
<style>
.ss-markets { padding: 80px 0; background: #111; font-family: var(--tp-ff-onest); }
.ss-markets-title {
    font-size: 34px; font-weight: 700; color: #fff;
    text-align: center; margin-bottom: 44px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-markets-title { font-size: 24px; } }
.ss-markets-grid { display: flex; flex-wrap: wrap; gap: 14px; justify-content: center; }
.ss-markets-badge {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 12px 22px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 100px;
    font-size: 15px; color: #fff;
    transition: background .2s, border-color .2s;
}
.ss-markets-badge:hover {
    background: rgba(74,115,196,0.3);
    border-color: #4a73c4;
}
.ss-markets-badge-flag { font-size: 18px; }
</style>
@endpush
@endonce

<section class="ss-markets">
    <div class="container container-1230">
        <h2 class="ss-markets-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        <div class="ss-markets-grid tp_fade_anim" data-delay=".3">
            @foreach($markets as $market)
            @php
                $flag = $flags[strtolower(trim($market))] ?? '🌍';
            @endphp
            <div class="ss-markets-badge">
                <span class="ss-markets-badge-flag">{{ $flag }}</span>
                <span>{{ $market }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
