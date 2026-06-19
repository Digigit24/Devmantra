<?php $__env->startSection('title', ($lead['founderName'] ?? 'Lead') . ' — Fundability Report'); ?>

<?php $__env->startSection('actions'); ?>
<a href="<?php echo e(route('admin.fundability-leads.index')); ?>" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Leads
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
    $tierLabels = [
        'top_decile'           => 'Top Decile',
        'series_a_fundable'    => 'Series A Ready',
        'seed_ready_with_gaps' => 'Seed Ready',
        'idea_stage'           => 'Idea Stage',
    ];
    $tierStyles = [
        'top_decile'           => 'background:rgba(34,197,94,0.15);color:#16a34a;',
        'series_a_fundable'    => 'background:rgba(116,99,255,0.15);color:var(--dm-purple);',
        'seed_ready_with_gaps' => 'background:rgba(245,158,11,0.15);color:#d97706;',
        'idea_stage'           => 'background:rgba(220,38,38,0.15);color:#dc2626;',
    ];
    $dimNames = [
        'stage'       => 'Stage',
        'opportunity' => 'Opportunity',
        'mgmt'        => 'Management',
        'competitive' => 'Competitive',
        'channels'    => 'Channels',
        'funding'     => 'Funding',
    ];
    $scoreColor = function($s) {
        if ($s >= 90) return '#16a34a';
        if ($s >= 70) return 'var(--dm-purple)';
        if ($s >= 50) return '#d97706';
        return '#dc2626';
    };
    $parseDate = function($dateStr) {
        if (!$dateStr) return '—';
        $cleaned = trim(preg_replace('/\s*\([^)]+\)/', '', $dateStr));
        try {
            return \Carbon\Carbon::parse($cleaned)->format('M d, Y');
        } catch (\Exception $e) {
            return '—';
        }
    };
    $founderName = $lead['founderName'] ?? 'the founder';
    $companyName = $lead['companyName'] ?? 'the startup';

    $questionLabels = [
        'q1a' => 'What\'s your name?',
        'q1b' => "What's your startup called, {$founderName}?",
        'q2'  => "Which sector best describes {$companyName}?",
        'q3'  => "Where is {$companyName} today?",
        'q4'  => "What's {$companyName}'s current annual revenue?",
        'q5'  => 'What\'s the total addressable market (TAM) for your product or service in India?',
        'q6'  => "What's your honest 5-year revenue projection for {$companyName}?",
        'q7'  => "What's your professional background before {$companyName}?",
        'q8'  => 'Which best describes your current team?',
        'q9'  => 'What\'s your defensibility — what stops a competitor from copying you?',
        'q10' => "How is {$companyName} reaching customers today?",
        'q11' => 'How much capital are you looking to raise in your next round?',
        'q12' => 'Lead capture (email & phone)',
    ];

    // Flat map of every answer value → human-readable label across all questions
    $answerLabels = [
        // Q2 — Sector
        'saas'          => 'SaaS / B2B Software',
        'd2c'           => 'D2C / Consumer',
        'fintech'       => 'Fintech',
        'manufacturing' => 'Manufacturing / Deep Tech',
        'services'      => 'Services / Professional Services',
        'other'         => 'Other',

        // Q3 — Business Stage
        'business_plan'     => 'Only have a business plan',
        'product_described' => 'Product / service description ready',
        'product_ready'     => 'Product ready for customer evaluation',
        'beta_acceptance'   => 'Positive customer acceptance via beta testing',
        'full_acceptance'   => 'Full customer acceptance of product / service',

        // Q4 — Annual Revenue
        'under_1cr'  => 'Under ₹1 cr',
        '1_to_5cr'   => '₹1 – 5 cr',
        '5_to_25cr'  => '₹5 – 25 cr',
        '25_to_50cr' => '₹25 – 50 cr',
        'over_50cr'  => '₹50 cr+',

        // Q5 — TAM
        'under_100cr'    => 'Less than ₹100 cr',
        '100_to_500cr'   => '₹100 – 500 cr',
        '500_to_1000cr'  => '₹500 – 1,000 cr',
        '1000_to_5000cr' => '₹1,000 – 5,000 cr',
        'over_5000cr'    => '₹5,000 cr+',
        'not_sure'       => 'Not sure yet',

        // Q6 — 5-year projection
        'under_10cr'  => 'Less than ₹10 cr',
        '10_to_25cr'  => '₹10 – 25 cr',
        '25_to_50cr'  => '₹25 – 50 cr',
        '50_to_100cr' => '₹50 – 100 cr',
        'over_100cr'  => '₹100 cr+',

        // Q7 — Founder experience
        'fresh_grad'        => 'Straight out of college',
        'exec_no_client'    => 'Executive role, no client interface',
        'senior_mgmt'       => 'Senior management role',
        'sector_experience' => 'Experience in this specific sector',
        'prior_ceo'         => 'Prior MD / CEO / CFO role',

        // Q8 — Team strength
        'solo'                  => 'Solo founder, no management team yet',
        'team_no_mgmt'          => 'Team in place but no strong management background',
        'team_with_degrees'     => 'Team with professional / management degrees',
        'team_plus_advisors'    => 'Complete core team + strong advisory board',
        'team_with_successors'  => 'Complete experienced team with named successors',

        // Q9 — Defensibility (SaaS)
        'saas_no_moat'          => "No moat yet — we're first to market",
        'saas_brand'            => 'Brand recognition and early customer relationships',
        'saas_data'             => 'Proprietary data / network effects building',
        'saas_patents_pending'  => 'Core patents pending or trademarks filed',
        'saas_patents_at_scale' => 'Patents issued + proprietary platform at scale',

        // Q9 — Defensibility (D2C)
        'd2c_no_moat'      => 'No moat yet',
        'd2c_brand'        => 'Brand and customer reviews',
        'd2c_loyalty'      => 'Strong repeat purchase / customer loyalty metrics',
        'd2c_supply_chain' => 'Proprietary supply chain or trademarks',
        'd2c_full_estate'  => 'Full brand estate + exclusive distribution',

        // Q9 — Defensibility (Fintech)
        'fintech_no_license'         => 'No regulatory license yet',
        'fintech_license_pending'    => 'License application in process',
        'fintech_license_approved'   => 'License approved, building compliance moat',
        'fintech_proprietary_models' => 'Licensed + proprietary risk / underwriting models',
        'fintech_full_stack'         => 'Licensed + patents + scale-based network effects',

        // Q9 — Defensibility (Manufacturing / Other)
        'mfg_no_ip'               => 'No IP yet',
        'mfg_proprietary_process' => 'Proprietary process, no patents',
        'mfg_patents_pending'     => 'Patents pending',
        'mfg_patents_issued'      => 'Patents issued',
        'mfg_full_estate'         => 'Complete patent estate + proprietary equipment',

        // Q9 — Defensibility (Services)
        'svc_no_diff'              => 'No differentiation yet',
        'svc_brand'                => 'Brand and team expertise',
        'svc_contracts'            => 'Signed client contracts and case studies',
        'svc_methodology'          => 'Proprietary methodology / frameworks',
        'svc_industry_recognition' => 'Published frameworks + trademarked process + industry recognition',

        // Q10 — Sales channels
        'no_channels'         => "Haven't worked out sales channels yet",
        'identified_partners' => 'Identified potential channel partners',
        'testing_channels'    => 'Narrowed to one or two channels, testing',
        'verified_revenue'    => 'Initial channels verified, generating revenue',
        'multi_channel_scale' => 'Multiple channels established and scalable',

        // Q11 — Funding ask
        'under_2cr'  => 'Under ₹2 cr (Pre-seed)',
        '2_to_5cr'   => '₹2 – 5 cr (Seed)',
        '5_to_10cr'  => '₹5 – 10 cr (Pre-Series A)',
        '10_to_20cr' => '₹10 – 20 cr (Series A)',
        'over_20cr'  => '₹20 cr+ (Series A / B)',
    ];

    $score     = $lead['totalScore'] ?? 0;
    $dims      = $lead['dimensionScores'] ?? [];
    $flags     = $lead['flags'] ?? [];
    $actions   = $lead['aiOutput']['top3Actions'] ?? [];
    $responses = $lead['responses'] ?? [];
?>

<!-- Hero Card -->
<div class="dm-table-wrap" style="padding:24px 28px;margin-bottom:20px;">
    <div class="row align-items-start g-3">
        <div class="col-lg-8">
            <h4 style="font-weight:700;color:var(--dm-text);margin-bottom:4px;"><?php echo e($lead['founderName'] ?? '—'); ?></h4>
            <div style="font-size:14px;color:var(--dm-text-muted);margin-bottom:16px;"><?php echo e($lead['companyName'] ?? ''); ?></div>
            <div class="d-flex flex-wrap gap-3 mb-3" style="font-size:13px;color:var(--dm-text-muted);">
                <?php if($lead['email'] ?? false): ?>
                <span><i class="fa-solid fa-envelope" style="margin-right:5px;"></i><?php echo e($lead['email']); ?></span>
                <?php endif; ?>
                <?php if($lead['phone'] ?? false): ?>
                <span><i class="fa-solid fa-phone" style="margin-right:5px;"></i><?php echo e($lead['phone']); ?></span>
                <?php endif; ?>
                <?php if($lead['createdAt'] ?? false): ?>
                <span><i class="fa-solid fa-calendar" style="margin-right:5px;"></i><?php echo e($parseDate($lead['createdAt'])); ?></span>
                <?php endif; ?>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <?php if($lead['sector'] ?? false): ?>
                <span class="dm-badge"><?php echo e($lead['sector']); ?></span>
                <?php endif; ?>
                <span class="dm-badge" style="<?php echo e($tierStyles[$lead['tier'] ?? ''] ?? ''); ?>">
                    <?php echo e($tierLabels[$lead['tier'] ?? ''] ?? ($lead['tier'] ?? '—')); ?>

                </span>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <div style="display:inline-flex;flex-direction:column;align-items:center;">
                <div style="width:90px;height:90px;border-radius:50%;border:3px solid <?php echo e($scoreColor($score)); ?>;display:flex;flex-direction:column;align-items:center;justify-content:center;margin-bottom:8px;">
                    <span style="font-size:28px;font-weight:800;color:<?php echo e($scoreColor($score)); ?>;line-height:1;"><?php echo e($score); ?></span>
                    <span style="font-size:10px;color:var(--dm-text-muted);">/ 100</span>
                </div>
                <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;letter-spacing:1px;">Total Score</div>
            </div>
        </div>
    </div>
</div>

<!-- Dimension Scores + Flags -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:20px;">
                <i class="fa-solid fa-chart-bar" style="margin-right:6px;"></i> Dimension Scores
            </h6>
            <?php $__currentLoopData = $dims; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $isWeak = ($key === ($lead['weakestDimension'] ?? '')); ?>
            <div class="d-flex align-items-center gap-3 mb-3">
                <div style="width:105px;font-size:12px;text-transform:uppercase;letter-spacing:.4px;flex-shrink:0;color:<?php echo e($isWeak ? '#dc2626' : 'var(--dm-text-muted)'); ?>;">
                    <?php echo e($dimNames[$key] ?? $key); ?><?php echo e($isWeak ? ' ↓' : ''); ?>

                </div>
                <div style="flex:1;height:6px;background:var(--dm-border);border-radius:3px;overflow:hidden;">
                    <div style="height:100%;width:<?php echo e($val); ?>%;background:<?php echo e($scoreColor($val)); ?>;border-radius:3px;"></div>
                </div>
                <div style="font-size:13px;font-weight:600;color:<?php echo e($scoreColor($val)); ?>;min-width:28px;text-align:right;"><?php echo e($val); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:20px;">
                <i class="fa-solid fa-triangle-exclamation" style="margin-right:6px;"></i> Flags & Weaknesses
            </h6>
            <?php if(count($flags)): ?>
            <div class="d-flex flex-wrap gap-2 mb-4">
                <?php $__currentLoopData = $flags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="dm-badge" style="background:rgba(220,38,38,0.12);color:#dc2626;">
                    <?php echo e(str_replace('_', ' ', $flag)); ?>

                </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <div style="color:var(--dm-text-muted);font-size:13px;margin-bottom:16px;">No flags raised ✓</div>
            <?php endif; ?>

            <div style="border-top:1px solid var(--dm-border);padding-top:16px;margin-bottom:16px;">
                <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:8px;">Weakest Dimension</div>
                <span style="font-size:16px;font-weight:700;color:#dc2626;">
                    <?php echo e(isset($lead['weakestDimension']) ? ($dimNames[$lead['weakestDimension']] ?? $lead['weakestDimension']) : '—'); ?>

                </span>
            </div>

            <?php if($lead['aiOutput']['industryBenchmark'] ?? false): ?>
            <div style="border-top:1px solid var(--dm-border);padding-top:16px;">
                <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:10px;">Industry Benchmark</div>
                <div style="border-left:2px solid #d97706;padding-left:12px;font-size:13px;color:var(--dm-text-muted);line-height:1.7;font-style:italic;">
                    <?php echo e($lead['aiOutput']['industryBenchmark']); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- AI Executive Verdict -->
<?php if($lead['aiOutput']['executiveVerdict'] ?? false): ?>
<div class="dm-table-wrap" style="padding:24px;margin-bottom:20px;">
    <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">
        <i class="fa-solid fa-brain" style="margin-right:6px;"></i> AI Executive Verdict
    </h6>
    <div style="background:var(--dm-dark);border-left:3px solid var(--dm-purple);padding:16px 18px;border-radius:0 8px 8px 0;font-size:13px;line-height:1.75;color:var(--dm-text);">
        <?php echo e($lead['aiOutput']['executiveVerdict']); ?>

    </div>
</div>
<?php endif; ?>

<!-- Top 3 Priority Actions -->
<?php if(count($actions)): ?>
<div class="dm-table-wrap" style="padding:24px;margin-bottom:20px;">
    <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:20px;">
        <i class="fa-solid fa-list-check" style="margin-right:6px;"></i> Top 3 Priority Actions
    </h6>
    <div class="d-flex flex-column gap-3">
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="border:1px solid var(--dm-border);border-radius:8px;padding:16px;background:var(--dm-dark);">
            <div class="d-flex align-items-start gap-3">
                <div style="width:24px;height:24px;border-radius:50%;background:var(--dm-purple);color:#fff;font-size:11px;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                    <?php echo e($i + 1); ?>

                </div>
                <div>
                    <div style="font-weight:700;color:var(--dm-text);margin-bottom:6px;"><?php echo e($action['title'] ?? ''); ?></div>
                    <div style="font-size:13px;color:var(--dm-text-muted);line-height:1.6;"><?php echo e($action['body'] ?? ''); ?></div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

<!-- Question Responses -->
<?php if(count($responses)): ?>
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <div class="dm-table-title">
            <i class="fa-solid fa-comment-dots" style="margin-right:6px;"></i> Question Responses
        </div>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th style="width:40px;">#</th>
                <th>Question</th>
                <th>Answer</th>
                <th style="width:70px;">Score</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $responses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $resp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $qId     = $resp['questionId'] ?? '';
                $qText   = $questionLabels[$qId] ?? $qId;
                $ansVal  = $resp['answer'] ?? '';
                $ansText = $answerLabels[$ansVal] ?? ucwords(str_replace('_', ' ', $ansVal));
                $rs      = $resp['score'] ?? 0;
            ?>
            <tr>
                <td style="color:var(--dm-text-muted);font-size:12px;font-weight:600;"><?php echo e(strtoupper($qId)); ?></td>
                <td style="color:var(--dm-text-muted);font-size:13px;"><?php echo e($qText); ?></td>
                <td style="color:var(--dm-text);font-weight:500;"><?php echo e($ansText); ?></td>
                <td>
                    <?php if($rs > 0): ?>
                    <span style="display:inline-flex;align-items:center;gap:5px;color:<?php echo e($scoreColor($rs)); ?>;font-weight:600;font-size:13px;">
                        <span style="width:8px;height:8px;border-radius:50%;background:<?php echo e($scoreColor($rs)); ?>;display:inline-block;"></span>
                        <?php echo e($rs); ?>

                    </span>
                    <?php else: ?>
                    <span style="color:var(--dm-text-muted);font-size:12px;">—</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\admin\fundability-leads\show.blade.php ENDPATH**/ ?>