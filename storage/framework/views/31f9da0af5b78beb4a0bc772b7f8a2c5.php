<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo e($lead->company ? $lead->company.' — ' : ''); ?>ESOP Allocation Report — Dev Mantra</title>
<meta name="description" content="Data-driven ESOP allocation report generated with Dev Mantra's ESOP Allocation Model.">
<meta name="robots" content="noindex, nofollow">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(asset('assets/esop-calculator/css/dashboard.css')); ?>">
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
    <a href="<?php echo e(route('esop-calculator.index')); ?>"><img src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra"></a>
    <a href="<?php echo e(route('esop-calculator.app')); ?>" class="back"><i class="fas fa-arrow-left"></i> Start a new session</a>
</div>

<div class="esop-report-page">
<div class="esop-dashboard" id="esopReportPrintArea">

    <?php
        $company = trim((string) $lead->company) !== '' ? trim($lead->company) : 'Your Company';
        $totalAllocated = (float) ($pool['total_allocated_percent'] ?? 0);
        $allocatable = (float) ($pool['allocatable_pool_percent'] ?? 0);
        $remaining = (float) ($pool['remaining_pool_percent'] ?? 0);
        $reserve = (float) ($lead->hiring_reserve_percent ?? 0);
        $overall = $aiContent ?: [];
    ?>

    
    <div class="esop-dash-hero">
        <div class="esop-dash-hero-bg" style="--esop-hero-img:url('<?php echo e(asset('assets/esop-calculator/img/hero-banner.jpg')); ?>')"></div>
        <div class="esop-dash-hero-scrim"></div>
        <div class="esop-dash-hero-content">
            <div class="esop-dash-hero-top">
                <div>
                    <div class="esop-dash-eyebrow">Dev Mantra &middot; ESOP Advisory</div>
                    <h1 class="esop-dash-hero-title"><?php echo e($company); ?></h1>
                </div>
                <div class="esop-dash-hero-meta">
                    Generated <?php echo e($lead->submitted_at?->format('d M Y') ?? $lead->created_at->format('d M Y')); ?><br>
                    <?php echo e($lead->industry ?: '—'); ?> &middot; <?php echo e($lead->company_stage ?: '—'); ?>

                </div>
            </div>
            <p class="esop-dash-hero-sub">Recommended equity allocation across <?php echo e($employees->count()); ?> employee<?php echo e($employees->count() === 1 ? '' : 's'); ?>, calculated using Dev Mantra's ESOP Allocation Model pool-splitting logic — a defensible, board-ready figure for each person.</p>
            <div class="esop-dash-hero-bottom">
                <div>
                    <div class="esop-dash-headline-label">Total Recommended Allocation</div>
                    <div class="esop-dash-headline-value"><?php echo e(number_format($totalAllocated, 4)); ?>%</div>
                    <div class="esop-dash-headline-sub">of fully diluted equity &middot; <?php echo e(number_format($remaining, 4)); ?>% still available</div>
                </div>
                <div class="esop-dash-hero-actions">
                    <button type="button" class="esop-dash-btn primary" id="btnCopyLink"><i class="fas fa-link"></i> Copy share link</button>
                    <button type="button" class="esop-dash-btn" id="btnDownloadPdf"><i class="fas fa-file-pdf"></i> Download PDF</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="esop-dash-grid-2">
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Pool Overview</div>
            <div class="esop-dash-donut-wrap">
                <div class="esop-dash-donut-box">
                    <canvas id="poolDonut"></canvas>
                    <div class="esop-dash-donut-center">
                        <div class="val"><?php echo e(number_format($pool['esop_pool_percent'] ?? 0, 2)); ?>%</div>
                        <div class="lbl">Total Pool</div>
                    </div>
                </div>
                <div class="esop-dash-legend">
                    <div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#059669"></span><span class="esop-dash-legend-label">Allocated</span><span class="esop-dash-legend-val"><?php echo e(number_format($totalAllocated, 4)); ?>%</span></div>
                    <div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#4a73c4"></span><span class="esop-dash-legend-label">Remaining (allocatable)</span><span class="esop-dash-legend-val"><?php echo e(number_format(max(0,$remaining), 4)); ?>%</span></div>
                    <div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#d9a441"></span><span class="esop-dash-legend-label">Hiring reserve (held back)</span><span class="esop-dash-legend-val"><?php echo e(number_format($reserve, 2)); ?>%</span></div>
                </div>
            </div>
        </div>
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Key Metrics</div>
            <div class="esop-dash-stat-grid">
                <div class="esop-dash-stat"><div class="lbl">Allocatable Pool</div><div class="val"><?php echo e(number_format($allocatable, 2)); ?>%</div></div>
                <div class="esop-dash-stat"><div class="lbl">Pool To Distribute</div><div class="val"><?php echo e(number_format($pool['pool_to_distribute_percent'] ?? 0, 2)); ?>%</div></div>
                <div class="esop-dash-stat"><div class="lbl">Employees Scored</div><div class="val"><?php echo e($pool['scored_count'] ?? $employees->count()); ?> / <?php echo e($pool['planned_headcount'] ?? '—'); ?></div></div>
                <div class="esop-dash-stat"><div class="lbl">Score Range</div><div class="val small"><?php echo e($pool['score_range_low'] ?? '—'); ?> – <?php echo e($pool['score_range_high'] ?? '—'); ?> / 100</div></div>
                <div class="esop-dash-stat"><div class="lbl">Average Grant</div><div class="val money"><?php echo e(isset($pool['average_grant_percent']) ? number_format($pool['average_grant_percent'], 4).'%' : '—'); ?></div></div>
                <div class="esop-dash-stat"><div class="lbl">Tier Split</div><div class="val small"><?php echo e($pool['tier_split_status'] ?? 'Not used — pure score split'); ?></div></div>
            </div>
            <?php if(($pool['scored_count'] ?? 0) < ($pool['planned_headcount'] ?? 0)): ?>
            <div class="esop-dash-note">Only <?php echo e($pool['scored_count']); ?> of the planned <?php echo e($pool['planned_headcount']); ?> employees were scored in this session, so only a proportional share of the pool was released. The rest stays reserved until the remaining people are scored in a future session.</div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if($employees->isNotEmpty()): ?>
    <div class="esop-dash-grid-2 even">
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Allocation By Department</div>
            <div class="esop-chart-box"><canvas id="deptChart"></canvas></div>
        </div>
        <div class="esop-dash-card">
            <div class="esop-dash-card-title">Allocation By Seniority</div>
            <div class="esop-chart-box"><canvas id="levelChart"></canvas></div>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="esop-dash-section-title"><span class="bar"></span> Recommended Allocation By Employee</div>
    <div class="esop-dash-table-wrap">
        <div class="esop-dash-table-head">
            <h3><?php echo e($employees->count()); ?> employee<?php echo e($employees->count() === 1 ? '' : 's'); ?> scored</h3>
            <span class="esop-expand-hint"><i class="fas fa-hand-pointer"></i> Click a row for advisory notes</span>
        </div>
        <div style="overflow-x:auto;">
        <table class="esop-dash-table">
            <thead>
                <tr><th>Rank</th><th>Employee</th><th>Department</th><th>Seniority</th><th>Score</th><th>Peer Group</th><th>Recommended Grant</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $initials = \Illuminate\Support\Str::of(trim(($e->emp_name ?: '?')))->explode(' ')->filter()->map(fn($p) => mb_strtoupper(mb_substr($p,0,1)))->take(2)->implode('');
                    $note = $e->ai_content ?? [];
                ?>
                <tr class="emp-row" data-detail-for="detail-<?php echo e($e->id); ?>">
                    <td><span class="esop-rank-badge<?php echo e(($e->rank ?? 0) === 1 ? ' top' : ''); ?>"><?php echo e($e->rank ?: '—'); ?></span></td>
                    <td>
                        <div class="esop-emp-name-cell">
                            <span class="esop-avatar" style="background:<?php echo e(['#1b3c6b','#4a73c4','#7aa2e8','#059669','#d9a441','#7c3aed','#0891b2','#dc2626'][abs(crc32($e->emp_name ?: 'x')) % 8]); ?>"><?php echo e($initials ?: '?'); ?></span>
                            <div class="info"><strong><?php echo e($e->emp_name ?: '—'); ?></strong><span><?php echo e($e->emp_designation ?: '—'); ?></span></div>
                        </div>
                    </td>
                    <td><?php echo e($e->emp_department ?: '—'); ?></td>
                    <td><?php echo e($e->emp_seniority); ?></td>
                    <td>
                        <?php echo e($e->total_score); ?>/100
                        <div class="esop-scorebar"><div class="esop-scorebar-fill" style="width:<?php echo e($e->total_score); ?>%;background:<?php echo e($e->total_score >= 90 ? '#d9a441' : ($e->total_score >= 75 ? '#059669' : ($e->total_score >= 60 ? '#4a73c4' : ($e->total_score >= 40 ? '#f59e0b' : '#94a3b8')))); ?>"></div></div>
                    </td>
                    <td><span class="esop-chip<?php echo e($e->tier_pool_applied ? '' : ' remainder'); ?>"><?php echo e($e->tier_pool_applied ? 'Tier pool' : 'Remainder'); ?></span></td>
                    <td>
                        <div class="esop-grant-figure"><?php echo e(number_format($e->final_grant_percent ?? 0, 4)); ?>%</div>
                        <div class="esop-grant-share"><?php echo e(number_format($e->share_of_pool_percent ?? 0, 2)); ?>% of pool</div>
                    </td>
                </tr>
                <tr class="emp-detail-row" id="detail-<?php echo e($e->id); ?>">
                    <td colspan="7">
                        <div class="emp-detail-inner">
                            <?php if(!empty($note['rationale'])): ?>
                            <div class="note"><?php echo e($note['rationale']); ?></div>
                            <?php endif; ?>
                            <?php if(!empty($note['retention_note'])): ?>
                            <div class="note retention"><?php echo e($note['retention_note']); ?></div>
                            <?php endif; ?>
                            <?php if(empty($note)): ?>
                            <div class="note">No additional advisory note was generated for this employee.</div>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" style="text-align:center;padding:2rem;color:#94a3b8;">No employees scored in this session.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
    </div>

    
    <?php if(!empty($overall)): ?>
    <div class="esop-dash-card" style="margin-bottom:1.25rem;">
        <div class="esop-dash-card-title">Advisory Notes</div>
        <div class="esop-dash-notes">
            <?php if(!empty($overall['summary'])): ?>
            <div class="esop-note-item"><div class="esop-note-icon summary"><i class="fas fa-chart-pie"></i></div><div class="esop-note-body"><h4>Summary</h4><p><?php echo e($overall['summary']); ?></p></div></div>
            <?php endif; ?>
            <?php if(!empty($overall['risk_flag'])): ?>
            <div class="esop-note-item"><div class="esop-note-icon risk<?php echo e(($pool['tier_pool_is_over_committed'] ?? false) ? '' : ' ok'); ?>"><i class="fas <?php echo e(($pool['tier_pool_is_over_committed'] ?? false) ? 'fa-triangle-exclamation' : 'fa-shield-halved'); ?>"></i></div><div class="esop-note-body"><h4>Risk Flag</h4><p><?php echo e($overall['risk_flag']); ?></p></div></div>
            <?php endif; ?>
            <?php if(!empty($overall['vesting_suggestion'])): ?>
            <div class="esop-note-item"><div class="esop-note-icon vesting"><i class="fas fa-hourglass-half"></i></div><div class="esop-note-body"><h4>Vesting Suggestion</h4><p><?php echo e($overall['vesting_suggestion']); ?></p></div></div>
            <?php endif; ?>
            <?php if(!empty($overall['next_steps'])): ?>
            <div class="esop-note-item"><div class="esop-note-icon steps"><i class="fas fa-list-check"></i></div><div class="esop-note-body"><h4>Next Steps</h4><ol><?php $__currentLoopData = $overall['next_steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($step); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol></div></div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="esop-dash-footer">
        <div class="esop-dash-actions">
            <a href="<?php echo e(route('esop-calculator.app')); ?>" class="esop-dash-btn light"><i class="fas fa-rotate-left"></i> Start a new session</a>
        </div>
    </div>
    <p class="esop-dash-disclaimer">This is an indicative recommendation generated from the inputs provided, using the same pool-splitting logic as Dev Mantra's ESOP Allocation Model. It is not legal, tax or compliance advice — please confirm the final allocation with your cap table administrator, legal counsel and ESOP trustee before communicating any figure to an employee.</p>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
<script src="<?php echo e(asset('assets/esop-calculator/js/dashboard.js')); ?>"></script>
<script>
(function () {
    var byDepartment = <?php echo json_encode(collect($byDepartment)->take(12), 15, 512) ?>;
    var byLevel = <?php echo json_encode($byLevel, 15, 512) ?>;

    EsopDashboard.renderDonut('poolDonut', [
        { label: 'Allocated', value: <?php echo json_encode(round($totalAllocated, 6), 512) ?>, color: '#059669' },
        { label: 'Remaining (allocatable)', value: <?php echo json_encode(round(max(0, $remaining), 6)) ?>, color: '#4a73c4' },
        { label: 'Hiring reserve', value: <?php echo json_encode(round($reserve, 6), 512) ?>, color: '#d9a441' }
    ]);

    if (byDepartment.length) {
        EsopDashboard.renderBar('deptChart', byDepartment.map(function (r) { return r.label; }), byDepartment.map(function (r) { return r.allocated; }), '#4a73c4');
    }
    if (byLevel.length) {
        EsopDashboard.renderBar('levelChart', byLevel.map(function (r) { return r.label; }), byLevel.map(function (r) { return r.allocated; }), '#1b3c6b');
    }

    EsopDashboard.initRowToggles('.esop-dash-table-wrap');

    var copyBtn = document.getElementById('btnCopyLink');
    if (copyBtn) copyBtn.addEventListener('click', function () { EsopDashboard.copyLink(window.location.href, copyBtn); });

    var pdfBtn = document.getElementById('btnDownloadPdf');
    if (pdfBtn) pdfBtn.addEventListener('click', function () { EsopDashboard.exportPdf('esopReportPrintArea', '<?php echo e($company); ?>-ESOP-Report'); });
})();
</script>

</body>
</html>
<?php /**PATH C:\Users\hrith\ritik\Devmantranew\resources\views/frontend/esop-calculator/report.blade.php ENDPATH**/ ?>