@props(['data' => []])
@php
    $title       = $data['title']       ?? '';
    $description = $data['description'] ?? '';
    $items = $data['items'] ?? [];  // [string, ...]
    // Split into two columns
    $half  = (int) ceil(count($items) / 2);
    $col1  = array_slice($items, 0, $half);
    $col2  = array_slice($items, $half);
@endphp

@once
@push('styles')
<style>
.ss-benefits { padding: 90px 0; background: #fff; font-family: var(--tp-ff-onest); }
.ss-benefits-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 46px; font-family: var(--tp-ff-onest); line-height: 1.3;
}
@media (max-width: 767px) { .ss-benefits-title { font-size: 26px; margin-bottom: 32px; } }
.ss-benefits-list { list-style: none; padding: 0; margin: 0; }
.ss-benefits-list li {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 10px 0;
    font-size: 15px; color: #444; line-height: 1.65;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.ss-benefits-list li:last-child { border-bottom: none; }
.ss-benefits-list li::before {
    content: '';
    flex-shrink: 0;
    width: 20px; height: 20px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 50%;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 12 9' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 4L4.5 7.5L11 1' stroke='white' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 12px;
    margin-top: 2px;
}
</style>
@endpush
@endonce

<section class="ss-benefits">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-benefits-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif
        @if($description)
        <p class="ss-benefits-desc tp_fade_anim" data-delay=".25" style="color:#555;font-size:16px;line-height:1.7;max-width:780px;margin-bottom:36px;">{{ $description }}</p>
        @endif
        <div class="row g-4">
            <div class="col-md-6 tp_fade_anim" data-delay=".3">
                <ul class="ss-benefits-list">
                    @foreach($col1 as $item)<li>{{ $item }}</li>@endforeach
                </ul>
            </div>
            <div class="col-md-6 tp_fade_anim" data-delay=".4">
                <ul class="ss-benefits-list">
                    @foreach($col2 as $item)<li>{{ $item }}</li>@endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
