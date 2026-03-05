@props(['data' => []])
@php
    $title       = $data['title']       ?? '';
    $description = $data['description'] ?? '';
    $steps       = $data['steps']       ?? [];   // [{number, stage, description}]
    $metrics     = $data['metrics']     ?? [];   // [{metric, outcome}]
@endphp

@once
@push('styles')
<style>
.ss-process { padding: 90px 0; background: #fff; font-family: var(--tp-ff-onest); }
.ss-process-title {
    font-size: 36px; font-weight: 700; color: #0d1b2a;
    line-height: 1.3; margin-bottom: 16px; font-family: var(--tp-ff-onest);
}
@media (max-width: 767px) { .ss-process-title { font-size: 26px; } }
.ss-process-desc { font-size: 16px; color: #555; line-height: 1.8; margin-bottom: 50px; max-width: 700px; }
.ss-process-step {
    display: flex; gap: 28px; margin-bottom: 40px; align-items: flex-start;
}
.ss-process-step:last-child { margin-bottom: 0; }
.ss-process-num {
    flex-shrink: 0;
    width: 56px; height: 56px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; font-weight: 800; color: #fff;
    font-family: var(--tp-ff-onest);
}
.ss-process-body { padding-top: 6px; }
.ss-process-stage {
    font-size: 12px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: #4a73c4; margin-bottom: 4px;
}
.ss-process-step-title {
    font-size: 19px; font-weight: 700; color: #0d1b2a;
    margin-bottom: 12px; font-family: var(--tp-ff-onest);
    line-height: 1.35;
}
.ss-process-step-desc { font-size: 15px; color: #555; line-height: 1.7; margin-bottom: 0; }
.ss-process-step-value {
    display: inline-block;
    margin-top: 8px;
    font-size: 13px; font-weight: 600; color: #1b3c6b;
    background: rgba(27,60,107,0.07);
    padding: 4px 12px; border-radius: 20px;
}
/* metrics table */
.ss-process-metrics {
    margin-top: 60px;
    background: #f5f7fa;
    border-radius: 16px;
    overflow: hidden;
}
.ss-process-metrics table { width: 100%; border-collapse: collapse; }
.ss-process-metrics th {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff; text-align: left; padding: 14px 24px;
    font-size: 14px; font-weight: 600;
}
.ss-process-metrics td {
    padding: 13px 24px; font-size: 15px; color: #333;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}
.ss-process-metrics tr:last-child td { border-bottom: none; }
.ss-process-metrics tr:nth-child(even) td { background: rgba(0,0,0,0.02); }
/* connector line */
.ss-process-steps-wrap { position: relative; }
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
                <div class="ss-process-steps-wrap tp_fade_anim" data-delay=".4">
                    @foreach($steps as $step)
                    <div class="ss-process-step">
                        <div class="ss-process-num">{{ $step['number'] ?? ($loop->iteration) }}</div>
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
