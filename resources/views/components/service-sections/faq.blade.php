@props(['data' => []])
@php
    $title    = $data['title']    ?? 'Frequently Asked Questions';
    $subtitle = $data['subtitle'] ?? '';
    $items    = $data['items']    ?? [];   // [{question, answer}]
    $uid      = 'faq_' . substr(md5(json_encode($data)), 0, 8);
@endphp

@once
@push('styles')
<style>
.ss-faq { padding: 90px 0; background: #f5f7fa; font-family: var(--tp-ff-onest); }
.ss-faq-header { text-align: center; margin-bottom: 50px; }
.ss-faq-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 14px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-faq-title { font-size: 26px; } }
.ss-faq-subtitle { font-size: 16px; color: #666; line-height: 1.7; }
.ss-faq-item {
    background: #fff;
    border-radius: 12px;
    margin-bottom: 12px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.06);
}
.ss-faq-q {
    width: 100%; text-align: left;
    padding: 22px 28px;
    font-size: 16px; font-weight: 600; color: #0d1b2a;
    background: none; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: space-between; gap: 16px;
    font-family: var(--tp-ff-onest);
    transition: color .2s;
}
.ss-faq-q:hover { color: #1b3c6b; }
.ss-faq-q.open { color: #1b3c6b; }
.ss-faq-q-icon { font-size: 12px; transition: transform .25s; flex-shrink: 0; }
.ss-faq-q.open .ss-faq-q-icon { transform: rotate(180deg); }
.ss-faq-a {
    max-height: 0; overflow: hidden;
    font-size: 15px; color: #555; line-height: 1.8;
    transition: max-height .35s ease, padding .35s ease;
}
.ss-faq-a.open {
    max-height: 600px;
    padding: 0 28px 22px;
}
</style>
@endpush
@endonce

<section class="ss-faq">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="ss-faq-header tp_fade_anim" data-delay=".2">
                    <h2 class="ss-faq-title">{{ $title }}</h2>
                    @if($subtitle)<p class="ss-faq-subtitle">{{ $subtitle }}</p>@endif
                </div>
                <div id="{{ $uid }}" class="tp_fade_anim" data-delay=".3">
                    @foreach($items as $i => $item)
                    <div class="ss-faq-item">
                        <button class="ss-faq-q" data-faq="{{ $uid }}-{{ $i }}">
                            {{ $item['question'] ?? '' }}
                            <i class="fa-solid fa-chevron-down ss-faq-q-icon"></i>
                        </button>
                        <div class="ss-faq-a" id="{{ $uid }}-a-{{ $i }}">{{ $item['answer'] ?? '' }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function(){
    document.querySelectorAll('#{{ $uid }} .ss-faq-q').forEach(function(btn){
        btn.addEventListener('click', function(){
            var idx = this.dataset.faq;
            var ans = document.getElementById(idx.replace('-{{ $uid }}-', '{{ $uid }}-a-').replace(/.*-(\d+)$/, '{{ $uid }}-a-$1'));
            // find the answer sibling
            var ansEl = this.nextElementSibling;
            var isOpen = ansEl.classList.contains('open');
            // close all in this faq block
            document.querySelectorAll('#{{ $uid }} .ss-faq-a').forEach(function(a){ a.classList.remove('open'); });
            document.querySelectorAll('#{{ $uid }} .ss-faq-q').forEach(function(b){ b.classList.remove('open'); });
            if(!isOpen){ ansEl.classList.add('open'); this.classList.add('open'); }
        });
    });
})();
</script>
@endpush
