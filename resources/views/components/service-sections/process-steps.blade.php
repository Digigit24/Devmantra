@props(['data' => []])
@php
    $title       = $data['title']       ?? '';
    $description = $data['description'] ?? '';
    $steps       = $data['steps']       ?? [];   // [{number, stage, title, description, value}]
    $metrics     = $data['metrics']     ?? [];   // [{metric, outcome}]
@endphp

@once
@push('styles')
<style>
/* ── Process Steps ── */
.ss-process {
    padding: 100px 0;
    background: #fff;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-process { padding: 80px 0; } }
@media (max-width: 767px) { .ss-process { padding: 64px 0; } }

.ss-process-title {
    font-size: 38px; font-weight: 700; color: #0d1b2a;
    line-height: 1.25; margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
@media (max-width: 991px) { .ss-process-title { font-size: 30px; } }
@media (max-width: 767px) { .ss-process-title { font-size: 24px; } }
.ss-process-desc { font-size: 16px; color: #5a6478; line-height: 1.8; margin-bottom: 56px; max-width: 700px; }

/* Steps wrapper — relative for the vertical connector */
.ss-process-steps-wrap { position: relative; }
/* vertical connector line */
.ss-process-steps-wrap::before {
    content: '';
    position: absolute;
    left: 27px;
    top: 56px;
    bottom: 30px;
    width: 2px;
    background: linear-gradient(180deg, #1b3c6b 0%, #4a73c4 50%, rgba(74,115,196,0.15) 100%);
    transform-origin: top;
    transform: scaleY(0);
    transition: transform 1.2s cubic-bezier(.165,.84,.44,1);
}
.ss-process-steps-wrap.ss-line-visible::before { transform: scaleY(1); }
@media (max-width: 575px) {
    .ss-process-steps-wrap::before { left: 22px; }
}

/* Individual step */
.ss-process-step {
    display: flex;
    gap: 28px;
    margin-bottom: 44px;
    align-items: flex-start;
    opacity: 0;
    transform: translateX(-20px);
    transition: opacity .55s ease, transform .55s cubic-bezier(.165,.84,.44,1);
}
.ss-process-step.ss-step-visible {
    opacity: 1;
    transform: translateX(0);
}
.ss-process-step:last-child { margin-bottom: 0; }

/* Number circle */
.ss-process-num {
    flex-shrink: 0;
    width: 56px; height: 56px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; font-weight: 800; color: #fff;
    font-family: var(--tp-ff-onest);
    box-shadow: 0 8px 24px rgba(27,60,107,0.3);
    position: relative; z-index: 1;
    transition: transform .35s ease, box-shadow .35s ease;
}
.ss-process-step:hover .ss-process-num {
    transform: scale(1.08);
    box-shadow: 0 12px 32px rgba(27,60,107,0.4);
}

.ss-process-body {
    padding-top: 6px;
    flex: 1;
}
.ss-process-stage {
    font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #4a73c4; margin-bottom: 4px;
}
.ss-process-step-title {
    font-size: 19px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
    line-height: 1.35;
}
.ss-process-step-desc { font-size: 15px; color: #555; line-height: 1.75; margin-bottom: 0; }
.ss-process-step-value {
    display: inline-block;
    margin-top: 12px;
    font-size: 13px; font-weight: 600; color: #1b3c6b;
    background: rgba(27,60,107,0.07);
    padding: 5px 14px; border-radius: 20px;
}

/* step card hover */
.ss-process-step-card {
    flex: 1;
    background: transparent;
    border-radius: 16px;
    padding: 24px 26px;
    border: 1px solid transparent;
    transition: background .3s ease, border-color .3s ease, box-shadow .3s ease;
}
.ss-process-step:hover .ss-process-step-card {
    background: #f8f9fc;
    border-color: rgba(74,115,196,0.12);
    box-shadow: 0 4px 20px rgba(27,60,107,0.06);
}

/* metrics table */
.ss-process-metrics {
    margin-top: 60px;
    background: #f5f7fc;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid rgba(27,60,107,0.07);
}
.ss-process-metrics table { width: 100%; border-collapse: collapse; }
.ss-process-metrics th {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff; text-align: left; padding: 15px 24px;
    font-size: 13px; font-weight: 600; letter-spacing: 0.5px;
}
.ss-process-metrics td {
    padding: 14px 24px; font-size: 15px; color: #333;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.ss-process-metrics tr:last-child td { border-bottom: none; }
.ss-process-metrics tr:nth-child(even) td { background: rgba(0,0,0,0.02); }
</style>
@endpush
@endonce

<section class="ss-process">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @if($title)
                <h2 class="ss-process-title tp_fade_anim" data-delay=".2">{{ $title }}</h2>
                @endif
                @if($description)
                <p class="ss-process-desc tp_fade_anim" data-delay=".3">{{ $description }}</p>
                @endif

                <div class="ss-process-steps-wrap" id="ss-process-steps-{{ md5(implode('', array_column($steps, 'title'))) }}">
                    @foreach($steps as $step)
                    <div class="ss-process-step">
                        <div class="ss-process-num">{{ $step['number'] ?? ($loop->iteration) }}</div>
                        <div class="ss-process-step-card">
                            <div class="ss-process-body">
                                @if(!empty($step['stage']))
                                <div class="ss-process-stage">{{ $step['stage'] }}</div>
                                @endif
                                @if(!empty($step['title']))
                                <div class="ss-process-step-title">{{ $step['title'] }}</div>
                                @endif
                                <div class="ss-process-step-desc">{{ $step['description'] ?? '' }}</div>
                                @if(!empty($step['value']))
                                <span class="ss-process-step-value">{{ $step['value'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                @if(!empty($metrics))
                <div class="ss-process-metrics tp_fade_anim" data-delay=".5">
                    <table>
                        <thead>
                            <tr>
                                <th>Metric</th>
                                <th>Outcome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($metrics as $row)
                            <tr>
                                <td>{{ $row['metric'] ?? '' }}</td>
                                <td>{{ $row['outcome'] ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
    var wraps = document.querySelectorAll('.ss-process-steps-wrap');
    if (!wraps.length || !('IntersectionObserver' in window)) {
        // fallback: show all immediately
        document.querySelectorAll('.ss-process-step').forEach(function (s) {
            s.classList.add('ss-step-visible');
        });
        wraps.forEach(function (w) { w.classList.add('ss-line-visible'); });
        return;
    }

    wraps.forEach(function (wrap) {
        var steps = Array.from(wrap.querySelectorAll('.ss-process-step'));
        var lineTriggered = false;

        var stepObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var idx = steps.indexOf(el);
                    setTimeout(function () {
                        el.classList.add('ss-step-visible');
                        // Trigger line draw when first step is visible
                        if (!lineTriggered) {
                            lineTriggered = true;
                            wrap.classList.add('ss-line-visible');
                        }
                    }, idx * 120);
                    stepObs.unobserve(el);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

        steps.forEach(function (step) { stepObs.observe(step); });
    });
})();
</script>
@endpush
