@props(['data' => []])
@php
    $title          = $data['title']           ?? 'Engagement Models';
    $standardLabel  = $data['standard_label']  ?? 'Standard Models';
    $cpaLabel       = $data['cpa_label']       ?? '';
    $standardModels = $data['standard_models'] ?? [];  // [{title, description, best_for}]
    $cpaModels      = $data['cpa_models']      ?? [];  // [{title, description, best_for}]
    $hasTabs        = !empty($cpaModels);
    $uid = 'em_' . substr(md5(json_encode($data)), 0, 8);
@endphp

@once
@push('styles')
<style>
.ss-engagement { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-engagement-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    text-align: center; margin-bottom: 16px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-engagement-title { font-size: 26px; } }
/* Tabs */
.ss-em-tabs {
    display: flex; justify-content: center; gap: 8px; margin-bottom: 40px;
}
.ss-em-tab {
    padding: 10px 24px;
    border-radius: 30px; border: 1.5px solid #1b3c6b;
    font-size: 14px; font-weight: 600;
    color: #1b3c6b; background: #fff; cursor: pointer;
    transition: background .2s, color .2s;
}
.ss-em-tab.active {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff; border-color: transparent;
}
.ss-em-panel { display: none; }
.ss-em-panel.active { display: block; }
/* Cards */
.ss-em-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px 26px;
    height: 100%;
    border: 1px solid rgba(0,0,0,0.06);
    transition: transform .25s, box-shadow .25s;
    position: relative;
}
.ss-em-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
.ss-em-card-title {
    font-size: 17px; font-weight: 700; color: #1b3c6b;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
}
.ss-em-card-desc { font-size: 14px; color: #555; line-height: 1.75; margin-bottom: 16px; }
.ss-em-card-best {
    font-size: 12px; font-weight: 600; color: #4a73c4;
    background: rgba(74,115,196,0.08);
    padding: 5px 12px; border-radius: 20px;
    display: inline-block;
}
</style>
@endpush
@endonce

<section class="ss-engagement">
    <div class="container container-1230">
        @if($title)
        <h2 class="ss-engagement-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
        @endif

        @if($hasTabs)
        <div class="ss-em-tabs tp_fade_anim" data-delay=".3" id="{{ $uid }}-tabs">
            <button class="ss-em-tab active" data-panel="{{ $uid }}-standard">{{ $standardLabel }}</button>
            <button class="ss-em-tab" data-panel="{{ $uid }}-cpa">{{ $cpaLabel ?: 'CPA-Specific' }}</button>
        </div>
        @endif

        <div class="ss-em-panel active tp_fade_anim" data-delay=".4" id="{{ $uid }}-standard">
            <div class="row g-4">
                @foreach($standardModels as $i => $model)
                <div class="col-lg-{{ count($standardModels) <= 2 ? 6 : 3 }} col-md-6">
                    <div class="ss-em-card">
                        <h3 class="ss-em-card-title">{{ $model['title'] ?? '' }}</h3>
                        <p class="ss-em-card-desc">{{ $model['description'] ?? '' }}</p>
                        @if(!empty($model['best_for']))
                        <span class="ss-em-card-best">Best for: {{ $model['best_for'] }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @if($hasTabs)
        <div class="ss-em-panel" id="{{ $uid }}-cpa">
            <div class="row g-4">
                @foreach($cpaModels as $i => $model)
                <div class="col-lg-{{ count($cpaModels) <= 2 ? 6 : 4 }} col-md-6">
                    <div class="ss-em-card">
                        <h3 class="ss-em-card-title">{{ $model['title'] ?? '' }}</h3>
                        <p class="ss-em-card-desc">{{ $model['description'] ?? '' }}</p>
                        @if(!empty($model['best_for']))
                        <span class="ss-em-card-best">Best for: {{ $model['best_for'] }}</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@if($hasTabs)
@push('scripts')
<script>
(function(){
    var tabs = document.querySelectorAll('#{{ $uid }}-tabs .ss-em-tab');
    tabs.forEach(function(tab){
        tab.addEventListener('click', function(){
            tabs.forEach(function(t){ t.classList.remove('active'); });
            document.querySelectorAll('.ss-em-panel').forEach(function(p){ p.classList.remove('active'); });
            this.classList.add('active');
            document.getElementById(this.dataset.panel).classList.add('active');
        });
    });
})();
</script>
@endpush
@endif
