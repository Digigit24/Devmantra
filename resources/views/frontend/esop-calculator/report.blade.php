@php
    // Cache-buster for the shared dashboard CSS/JS — see the matching block in
    // app.blade.php. In production the web-served folder is separate from the
    // Laravel root, so public_path() can't be used to stat these files.
    $esopAssetRoot = app()->environment('local') ? public_path() : '/home2/devmasjc/public_html';
    $esopAssetVer = function (string $relative) use ($esopAssetRoot) {
        $path = rtrim($esopAssetRoot, '/') . '/' . ltrim($relative, '/');

        return is_file($path) ? filemtime($path) : time();
    };
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $lead->company ? $lead->company.' — ' : '' }}ESOP Allocation Report — Dev Mantra</title>
<meta name="description" content="Data-driven ESOP allocation report generated with Dev Mantra's ESOP Allocation Model.">
<meta name="robots" content="noindex, nofollow">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/esop-calculator/css/dashboard.css') }}?v={{ $esopAssetVer('assets/esop-calculator/css/dashboard.css') }}">
<style>
*,*::before,*::after{box-sizing:border-box}
body{margin:0;background:#f4f6f9;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif}
.esop-report-topbar{background:#ffffff;border-bottom:1px solid #e2e8f0;padding:0.85rem 1.5rem;display:flex;align-items:center;justify-content:space-between}
.esop-report-topbar img{width:118px;height:auto;border-radius:50px;display:block}
.esop-report-topbar a.back{font-size:0.82rem;font-weight:700;color:#4a73c4;text-decoration:none;display:inline-flex;align-items:center;gap:0.4rem}
.esop-report-page{padding:2rem 1.5rem 4rem}
@media print { .esop-report-topbar { display:none; } body{background:#fff;} }
</style>
</head>
<body>

<div class="esop-report-topbar">
    <a href="{{ route('esop-calculator.index') }}"><img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra"></a>
    <a href="{{ route('esop-calculator.app') }}" class="back"><i class="fas fa-arrow-left"></i> Start a new session</a>
</div>

<div class="esop-report-page">
<div class="esop-dashboard" id="esopReportPrintArea">

    @php
        $company = trim((string) $lead->company) !== '' ? trim($lead->company) : 'Your Company';
        $totalAllocated = (float) ($pool['total_allocated_percent'] ?? 0);
        $allocatable = (float) ($pool['allocatable_pool_percent'] ?? 0);
        $remaining = (float) ($pool['remaining_pool_percent'] ?? 0);
        $reserve = (float) ($lead->hiring_reserve_percent ?? 0);
        $overall = $aiContent ?: [];
    @endphp

    {{-- HERO --}}
    <div class="esop-dash-hero">
        <div class="esop-dash-hero-bg" style="--esop-hero-img:url('{{ asset('assets/esop-calculator/img/hero-banner.jpg') }}')"></div>
        <div class="esop-dash-hero-scrim"></div>
        <div class="esop-dash-hero-content">
            <div class="esop-dash-hero-top">
                <div>
                    <div class="esop-dash-eyebrow">Dev Mantra &middot; ESOP Advisory</div>
                    <h1 class="esop-dash-hero-title">{{ $company }}</h1>
                </div>
                @php
                    // Timestamps are stored in UTC (config/app.php timezone), so convert
                    // for display — otherwise an Indian founder sees a time 5h30m behind
                    // when they actually ran it. Pinned to IST (not the viewer's locale)
                    // so a forwarded report reads the same for everyone who opens it.
                    $generatedAt = ($lead->submitted_at ?? $lead->created_at)
                        ->timezone('Asia/Kolkata')
                        ->format('d M Y, g:i A') . ' IST';
                @endphp
                <div class="esop-dash-hero-meta">
                    Generated {{ $generatedAt }}<br>
                    {{ $lead->industry ?: '—' }} &middot; {{ $lead->company_stage ?: '—' }}
                </div>
            </div>
            <p class="esop-dash-hero-sub">Recommended equity allocation across {{ $employees->count() }} employee{{ $employees->count() === 1 ? '' : 's' }}, calculated using Dev Mantra's ESOP Allocation Model pool-splitting logic — a defensible, board-ready figure for each person.</p>
            <div class="esop-dash-hero-bottom">
                <div>
                    <div class="esop-dash-headline-label">Total Recommended Allocation</div>
                    <div class="esop-dash-headline-value">{{ number_format($totalAllocated, 4) }}%</div>
                    <div class="esop-dash-headline-sub">of fully diluted equity &middot; {{ number_format($remaining, 4) }}% still available</div>
                </div>
                <div class="esop-dash-hero-actions">
                    <button type="button" class="esop-dash-btn primary" id="btnCopyLink"><i class="fas fa-link"></i> Copy share link</button>
                    <button type="button" class="esop-dash-btn" id="btnDownloadPdf"><i class="fas fa-file-pdf"></i> Download PDF</button>
                </div>
            </div>
        </div>
    </div>

    {{-- POOL OVERVIEW --}}
    <div class="esop-dash-grid-2">
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Pool Overview</div>
            <div class="esop-dash-donut-wrap">
                <div class="esop-dash-donut-box">
                    <canvas id="poolDonut"></canvas>
                    <div class="esop-dash-donut-center">
                        <div class="val">{{ number_format($pool['esop_pool_percent'] ?? 0, 2) }}%</div>
                        <div class="lbl">Total Pool</div>
                    </div>
                </div>
                <div class="esop-dash-legend">
                    <div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#059669"></span><span class="esop-dash-legend-label">Allocated</span><span class="esop-dash-legend-val">{{ number_format($totalAllocated, 4) }}%</span></div>
                    <div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#4a73c4"></span><span class="esop-dash-legend-label">Remaining (allocatable)</span><span class="esop-dash-legend-val">{{ number_format(max(0,$remaining), 4) }}%</span></div>
                    <div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#d9a441"></span><span class="esop-dash-legend-label">Hiring reserve (held back)</span><span class="esop-dash-legend-val">{{ number_format($reserve, 2) }}%</span></div>
                </div>
            </div>
        </div>
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Key Metrics</div>
            <div class="esop-dash-stat-grid">
                {{-- These two tiles mirror the Pool Overview donut legend exactly, so the two
                     cards can never appear to disagree. (The older labels showed the gross
                     allocatable figure — mathematically right, but it read as a contradiction
                     next to the donut's allocated / remaining split.) --}}
                <div class="esop-dash-stat"><div class="lbl">Total Allocated</div><div class="val money">{{ number_format($totalAllocated, 4) }}%</div></div>
                <div class="esop-dash-stat"><div class="lbl">Remaining To Allocate</div><div class="val">{{ number_format(max(0, $remaining), 4) }}%</div></div>
                <div class="esop-dash-stat"><div class="lbl">Employees Scored</div><div class="val">{{ $pool['scored_count'] ?? $employees->count() }} / {{ $pool['planned_headcount'] ?? '—' }}</div></div>
                <div class="esop-dash-stat"><div class="lbl">Score Range</div><div class="val small">{{ $pool['score_range_low'] ?? '—' }} – {{ $pool['score_range_high'] ?? '—' }} / 100</div></div>
                <div class="esop-dash-stat"><div class="lbl">Average Grant</div><div class="val money">{{ isset($pool['average_grant_percent']) ? number_format($pool['average_grant_percent'], 4).'%' : '—' }}</div></div>
                <div class="esop-dash-stat"><div class="lbl">Tier Split</div><div class="val small">{{ $pool['tier_split_status'] ?? 'Not used — pure score split' }}</div></div>
            </div>
            @if(($pool['scored_count'] ?? 0) < ($pool['planned_headcount'] ?? 0))
            <div class="esop-dash-note">Only {{ $pool['scored_count'] }} of the planned {{ $pool['planned_headcount'] }} employees were scored in this session, so only a proportional share of the pool was released. The rest stays reserved until the remaining people are scored in a future session.</div>
            @endif
        </div>
    </div>

    {{-- DEPARTMENT / SENIORITY CHARTS --}}
    @if($employees->isNotEmpty())
    <div class="esop-dash-grid-2 even">
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Allocation By Department</div>
            <div id="deptDist"></div>
        </div>
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Allocation By Seniority</div>
            <div id="levelDist"></div>
        </div>
    </div>
    @endif

    {{-- EMPLOYEE TABLE --}}
    <div class="esop-dash-section-title"><span class="bar"></span> Recommended Allocation By Employee</div>
    <div class="esop-dash-table-wrap">
        <div class="esop-dash-table-head">
            <h3>{{ $employees->count() }} employee{{ $employees->count() === 1 ? '' : 's' }} scored</h3>
            <span class="esop-expand-hint"><i class="fas fa-hand-pointer"></i> Click a row for advisory notes</span>
        </div>
        <div style="overflow-x:auto;">
        <table class="esop-dash-table">
            <thead>
                <tr><th>Rank</th><th>Employee</th><th>Department</th><th>Seniority</th><th>Score</th><th>Peer Group</th><th>Recommended Grant</th></tr>
            </thead>
            <tbody>
                @forelse($employees as $e)
                @php
                    $initials = \Illuminate\Support\Str::of(trim(($e->emp_name ?: '?')))->explode(' ')->filter()->map(fn($p) => mb_strtoupper(mb_substr($p,0,1)))->take(2)->implode('');
                    $note = $e->ai_content ?? [];
                @endphp
                <tr class="emp-row" data-detail-for="detail-{{ $e->id }}">
                    <td><span class="esop-rank-badge{{ ($e->rank ?? 0) === 1 ? ' top' : '' }}">{{ $e->rank ?: '—' }}</span></td>
                    <td>
                        <div class="esop-emp-name-cell">
                            <span class="esop-avatar" style="background:{{ ['#1b3c6b','#4a73c4','#7aa2e8','#059669','#d9a441','#7c3aed','#0891b2','#dc2626'][abs(crc32($e->emp_name ?: 'x')) % 8] }}">{{ $initials ?: '?' }}</span>
                            <div class="info"><strong>{{ $e->emp_name ?: '—' }}</strong><span>{{ $e->emp_designation ?: '—' }}</span></div>
                        </div>
                    </td>
                    <td>{{ $e->emp_department ?: '—' }}</td>
                    <td>{{ $e->emp_seniority }}</td>
                    <td>
                        {{ $e->total_score }}/100
                        <div class="esop-scorebar"><div class="esop-scorebar-fill" style="width:{{ $e->total_score }}%;background:{{ $e->total_score >= 90 ? '#d9a441' : ($e->total_score >= 75 ? '#059669' : ($e->total_score >= 60 ? '#4a73c4' : ($e->total_score >= 40 ? '#f59e0b' : '#94a3b8'))) }}"></div></div>
                    </td>
                    <td><span class="esop-chip{{ $e->tier_pool_applied ? '' : ' remainder' }}">{{ $e->tier_pool_applied ? 'Tier pool' : 'Remainder' }}</span></td>
                    <td>
                        <div class="esop-grant-figure">{{ number_format($e->final_grant_percent ?? 0, 4) }}%</div>
                        <div class="esop-grant-share">{{ number_format($e->share_of_pool_percent ?? 0, 2) }}% of pool</div>
                    </td>
                </tr>
                <tr class="emp-detail-row" id="detail-{{ $e->id }}">
                    <td colspan="7">
                        <div class="emp-detail-inner">
                            @if(!empty($note['rationale']))
                            <div class="note">{{ $note['rationale'] }}</div>
                            @endif
                            @if(!empty($note['retention_note']))
                            <div class="note retention">{{ $note['retention_note'] }}</div>
                            @endif
                            @if(empty($note))
                            <div class="note">No additional advisory note was generated for this employee.</div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:#94a3b8;">No employees scored in this session.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    {{-- ADVISORY NOTES --}}
    @if(!empty($overall))
    <div class="esop-dash-card" style="margin-bottom:1.25rem;">
        <div class="esop-dash-card-title">Advisory Notes</div>
        <div class="esop-dash-notes">
            @if(!empty($overall['summary']))
            <div class="esop-note-item"><div class="esop-note-icon summary"><i class="fas fa-chart-pie"></i></div><div class="esop-note-body"><h4>Summary</h4><p>{{ $overall['summary'] }}</p></div></div>
            @endif
            @if(!empty($overall['risk_flag']))
            <div class="esop-note-item"><div class="esop-note-icon risk{{ ($pool['tier_pool_is_over_committed'] ?? false) ? '' : ' ok' }}"><i class="fas {{ ($pool['tier_pool_is_over_committed'] ?? false) ? 'fa-triangle-exclamation' : 'fa-shield-halved' }}"></i></div><div class="esop-note-body"><h4>Risk Flag</h4><p>{{ $overall['risk_flag'] }}</p></div></div>
            @endif
            @if(!empty($overall['vesting_suggestion']))
            <div class="esop-note-item"><div class="esop-note-icon vesting"><i class="fas fa-hourglass-half"></i></div><div class="esop-note-body"><h4>Vesting Suggestion</h4><p>{{ $overall['vesting_suggestion'] }}</p></div></div>
            @endif
            @if(!empty($overall['next_steps']))
            <div class="esop-note-item"><div class="esop-note-icon steps"><i class="fas fa-list-check"></i></div><div class="esop-note-body"><h4>Next Steps</h4><ol>@foreach($overall['next_steps'] as $step)<li>{{ $step }}</li>@endforeach</ol></div></div>
            @endif
        </div>
    </div>
    @endif

    {{-- SOFT CTA: book a free ESOP Clarity call --}}
    <div class="esop-dash-cta">
        <div class="esop-dash-cta-text">
            <div class="esop-dash-cta-eyebrow">Free 30-Minute Consultation</div>
            <h3 class="esop-dash-cta-title">Want to talk this through with someone?</h3>
            <p class="esop-dash-cta-sub">If you'd like a second opinion on your allocation, vesting schedule, or anything else ESOP-related, our team is happy to help — no pressure, no obligation.</p>
        </div>
        <a href="https://calendly.com/devmantra-info/30min" target="_blank" rel="noopener" class="esop-dash-btn calendly"><i class="fas fa-calendar-check"></i> Book a Free ESOP Clarity Call</a>
    </div>

    <div class="esop-dash-footer">
        <div class="esop-dash-actions">
            <a href="{{ route('esop-calculator.app') }}" class="esop-dash-btn light"><i class="fas fa-rotate-left"></i> Start a new session</a>
        </div>
    </div>
    <p class="esop-dash-disclaimer">This is an indicative recommendation generated from the inputs provided, using the same pool-splitting logic as Dev Mantra's ESOP Allocation Model. It is not legal, tax or compliance advice — please confirm the final allocation with your cap table administrator, legal counsel and ESOP trustee before communicating any figure to an employee.</p>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.5.0/chart.umd.min.js"></script>
<script src="{{ asset('assets/esop-calculator/js/dashboard.js') }}?v={{ $esopAssetVer('assets/esop-calculator/js/dashboard.js') }}"></script>
<script>
(function () {
    var byDepartment = @json(collect($byDepartment)->take(12));
    var byLevel = @json($byLevel);

    EsopDashboard.renderDonut('poolDonut', [
        { label: 'Allocated', value: @json(round($totalAllocated, 6)), color: '#059669' },
        { label: 'Remaining (allocatable)', value: @json(round(max(0, $remaining), 6)), color: '#4a73c4' },
        { label: 'Hiring reserve', value: @json(round($reserve, 6)), color: '#d9a441' }
    ]);

    var deptTotal = @json(count(\App\Services\EsopQuestionBank::DEPARTMENTS));
    EsopDashboard.renderDistribution('deptDist', byDepartment, {
        accent: '#4a73c4', accentSoft: '#7aa2e8',
        note: 'Only departments with at least one scored employee are listed — ' +
              byDepartment.length + ' of ' + deptTotal + ' represented in this cycle.'
    });
    EsopDashboard.renderDistribution('levelDist', byLevel, {
        accent: '#1b3c6b', accentSoft: '#4a73c4',
        emptyLabel: 'No one scored at this level yet',
        note: 'Every seniority tier is listed. A tier at 0% has nobody scored against it yet, so any pool set aside for that level is still unallocated.'
    });

    EsopDashboard.initRowToggles('.esop-dash-table-wrap');

    var copyBtn = document.getElementById('btnCopyLink');
    if (copyBtn) copyBtn.addEventListener('click', function () { EsopDashboard.copyLink(window.location.href, copyBtn); });

    var pdfBtn = document.getElementById('btnDownloadPdf');
    if (pdfBtn) pdfBtn.addEventListener('click', function () { EsopDashboard.exportPdf('esopReportPrintArea', '{{ $company }}-ESOP-Report'); });
})();
</script>

</body>
</html>
