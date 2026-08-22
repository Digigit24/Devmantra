<?php

namespace App\Services;

/**
 * Faithful re-implementation of the grant-calculation engine in
 * ESOP_Allocation_Model_V6.xlsx (Setup + Scoring + Results sheets).
 *
 * V6 has NO per-employee minimum/maximum equity band. It instead:
 *  1. Works out an "allocatable pool" (total pool minus hiring reserve) and
 *     a "pool to distribute this cycle" (allocatable pool x a cycle %,
 *     defaults to 100%).
 *  2. Optionally lets management ring-fence a fixed % of equity per
 *     seniority level ("tier pools"). Any level left blank falls into a
 *     shared "remainder" pool instead.
 *  3. Throttles the whole payable amount by
 *     min(1, employees_scored / planned_headcount) — a partially-scored
 *     roster can never consume the whole pool prematurely.
 *  4. Within each peer group (same seniority tier-pool, or the shared
 *     remainder group), splits that group's pool basis purely pro-rata by
 *     behavioural score: grant = pool_basis x (own score / peer score total).
 *
 * There is no rounding, capping or blending anywhere in the source
 * workbook — every % is carried at full floating-point precision.
 */
class EsopAllocationCalculator
{
    /**
     * Recompute one employee's scored totals server-side. Never trust a
     * client-submitted score for years_tenure or the grand total — only the
     * 19 behavioural dropdown picks (0-5 each) are taken from the client.
     *
     * @param  array<string,int>  $paramScores  key => 0-5, for the 19 asked params (years_tenure ignored if present)
     * @param  float  $years  Years with company, used to auto-score years_tenure
     * @return array{param_scores:array<string,int>, total_score:int, max_score:int, filled:int}
     */
    public static function scoreEmployee(array $paramScores, float $years): array
    {
        $paramScores['years_tenure'] = EsopQuestionBank::scoreTenure($years);

        $total = 0;
        $filled = 0;
        foreach (EsopQuestionBank::allKeys() as $key) {
            if (array_key_exists($key, $paramScores) && $paramScores[$key] !== null && $paramScores[$key] !== '') {
                $filled++;
            }
            $total += (int) ($paramScores[$key] ?? 0);
        }

        return [
            'param_scores' => $paramScores,
            'total_score'  => $total,
            'max_score'    => EsopQuestionBank::MAX_SCORE,
            'filled'       => $filled,
        ];
    }

    /**
     * Compute the full V6 pool-split for every employee in a session at once
     * — this MUST be run over the whole cohort together; a single employee's
     * grant cannot be computed in isolation because the split is pro-rata
     * across peers.
     *
     * @param  array{
     *   esop_pool_percent: float,
     *   hiring_reserve_percent: float,
     *   planned_headcount: int|null,
     *   pool_distribute_percent: float|null,
     *   tier_pool_leadership: float|null,
     *   tier_pool_senior_management: float|null,
     *   tier_pool_mid_level: float|null,
     *   tier_pool_junior: float|null,
     *   tier_pool_others: float|null,
     * } $pool
     * @param  array<int, array{id:int|string, seniority:string, total_score:int}>  $employees
     * @return array{pool: array<string,mixed>, employees: array<int, array<string,mixed>>}
     */
    public static function calculateSession(array $pool, array $employees): array
    {
        $poolPercent      = (float) ($pool['esop_pool_percent'] ?? 0);
        $reservePercent   = (float) ($pool['hiring_reserve_percent'] ?? 0);
        $plannedHeadcount = (int) ($pool['planned_headcount'] ?? 0);
        $distributePct    = $pool['pool_distribute_percent'] ?? 100;
        $distributePct    = ($distributePct === null || $distributePct === '') ? 100.0 : (float) $distributePct;

        $tierPools = [
            'Leadership'        => self::numOrNull($pool['tier_pool_leadership'] ?? null),
            'Senior Management' => self::numOrNull($pool['tier_pool_senior_management'] ?? null),
            'Mid-Level'         => self::numOrNull($pool['tier_pool_mid_level'] ?? null),
            'Junior'            => self::numOrNull($pool['tier_pool_junior'] ?? null),
            'Others (Default)'  => self::numOrNull($pool['tier_pool_others'] ?? null),
        ];

        $allocatablePool  = $poolPercent - $reservePercent;
        $poolToDistribute = $allocatablePool * ($distributePct / 100);

        $tierPoolSum = array_sum(array_map(fn ($v) => $v ?? 0, $tierPools));
        $remainder   = $poolToDistribute - $tierPoolSum;
        $tierScale   = $tierPoolSum > 0 ? min(1.0, $poolToDistribute / $tierPoolSum) : 1.0;
        $isOverCommitted = $tierPoolSum > ($poolToDistribute + 0.0000001);

        // Only employees with a non-zero total score count toward "scored".
        $scoredCount = 0;
        $scoredScores = [];
        foreach ($employees as $emp) {
            $s = (int) ($emp['total_score'] ?? 0);
            if ($s > 0) {
                $scoredCount++;
                $scoredScores[] = $s;
            }
        }
        $completionFactor = $plannedHeadcount > 0 ? min(1.0, $scoredCount / $plannedHeadcount) : 1.0;

        // Results!B5 — Score Range (Lowest - Highest) among fully scored employees only.
        $scoreRangeLow  = $scoredCount > 0 ? min($scoredScores) : null;
        $scoreRangeHigh = $scoredCount > 0 ? max($scoredScores) : null;

        // Results!B16 — Tier Split Status.
        if ($tierPoolSum <= 0) {
            $tierSplitStatus = 'Not used — pure score split';
        } elseif ($tierPoolSum <= ($poolToDistribute + 0.0000001)) {
            $tierSplitStatus = 'Active — tier pools within the pool to distribute';
        } else {
            $tierSplitStatus = 'Active — tier pools exceeded the pool and were scaled down proportionally';
        }

        // Build peer groups: key = "tier:<seniority>" if that level has a
        // tier pool entered, otherwise the shared "remainder" bucket.
        $peerTotals = [];
        $groupKeyFor = function (array $emp) use ($tierPools) {
            $seniority = $emp['seniority'] ?? '';
            $hasTier   = array_key_exists($seniority, $tierPools) && $tierPools[$seniority] !== null;

            return $hasTier ? ('tier:' . $seniority) : 'remainder';
        };

        foreach ($employees as $emp) {
            $key = $groupKeyFor($emp);
            $peerTotals[$key] = ($peerTotals[$key] ?? 0) + (int) ($emp['total_score'] ?? 0);
        }

        // NOTE: rank is assigned after this loop, off the final grant rather
        // than the raw score — see the ranking block below.
        $results = [];
        $totalAllocated = 0.0;

        foreach ($employees as $emp) {
            $seniority  = $emp['seniority'] ?? '';
            $totalScore = (int) ($emp['total_score'] ?? 0);
            $key        = $groupKeyFor($emp);
            $hasTier    = str_starts_with($key, 'tier:');

            $poolBasis = $hasTier
                ? ($tierPools[$seniority] ?? 0) * $tierScale * $completionFactor
                : max(0.0, $remainder) * $completionFactor;

            $peerTotal  = $peerTotals[$key] ?? 0;
            $scoreShare = ($totalScore > 0 && $peerTotal > 0) ? ($totalScore / $peerTotal) : 0.0;
            $finalGrant = $poolBasis * $scoreShare;
            // Results!L18 = K18 / $B$3, where B3 = Setup!C16 = the ALLOCATABLE
            // pool (total pool minus hiring reserve) — not the total pool.
            $shareOfPool = $allocatablePool > 0 ? ($finalGrant / $allocatablePool) : 0.0;

            $totalAllocated += $finalGrant;

            $results[$emp['id']] = [
                'total_score'            => $totalScore,
                'max_score'               => EsopQuestionBank::MAX_SCORE,
                'score_label'             => EsopQuestionBank::scoreLabel($totalScore),
                'peer_group'              => $hasTier ? "Tier pool — {$seniority}" : 'Shared remainder pool',
                'peer_score_total'        => $peerTotal,
                'score_share_percent'     => round($scoreShare * 100, 2),
                'pool_basis_percent'      => round($poolBasis, 6),
                'final_grant_percent'     => round($finalGrant, 6),
                'share_of_pool_percent'   => round($shareOfPool * 100, 2),
                'tier_pool_applied'       => $hasTier,
                'rank'                    => 0, // assigned below, off the final grant
            ];
        }

        // Rank by the recommended grant rather than the raw score. The table
        // this feeds leads with the grant column, and under tier pools a high
        // scorer inside a small tier can legitimately receive less equity than
        // a lower scorer in a large one — so a score-derived rank read as wrong
        // sitting next to the numbers. Ties share a rank (standard competition
        // ranking, matching the previous behaviour), and anyone allocated
        // nothing stays rank 0 so the UI keeps showing them as "—".
        //
        // Presentation only: nothing in the allocation maths reads `rank`, and
        // every figure above is already final by this point.
        $grantsDesc = array_map(fn ($r) => $r['final_grant_percent'], $results);
        rsort($grantsDesc);

        foreach ($results as $id => $result) {
            $grant = $result['final_grant_percent'];
            if ($grant <= 0) {
                continue;
            }

            $rank = 1;
            foreach ($grantsDesc as $g) {
                if ($g > $grant) {
                    $rank++;
                }
            }

            $results[$id]['rank'] = $rank;
        }

        return [
            'pool' => [
                'esop_pool_percent'        => round($poolPercent, 4),
                'hiring_reserve_percent'   => round($reservePercent, 4),
                'allocatable_pool_percent' => round($allocatablePool, 4),
                'pool_distribute_percent'  => round($distributePct, 4),
                'pool_to_distribute_percent' => round($poolToDistribute, 4),
                'tier_pools'               => $tierPools,
                'tier_pool_sum_percent'    => round($tierPoolSum, 4),
                'tier_pool_is_over_committed' => $isOverCommitted,
                'tier_pool_scale'          => round($tierScale, 6),
                'remainder_pool_percent'   => round($remainder, 4),
                'planned_headcount'        => $plannedHeadcount,
                'scored_count'             => $scoredCount,
                'completion_factor'        => round($completionFactor, 6),
                'total_allocated_percent'  => round($totalAllocated, 6),
                'remaining_pool_percent'   => round($allocatablePool - $totalAllocated, 6),
                'within_pool'              => $totalAllocated <= ($allocatablePool + 0.0000001),
                'score_range_low'          => $scoreRangeLow,
                'score_range_high'         => $scoreRangeHigh,
                'average_grant_percent'    => $scoredCount > 0 ? round($totalAllocated / $scoredCount, 6) : null,
                'tier_split_status'        => $tierSplitStatus,
            ],
            'employees' => $results,
        ];
    }

    private static function numOrNull($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (float) $value;
    }

    /**
     * Headcount + total allocated % grouped by department and by seniority
     * level — mirrors the Excel model's Dashboard sheet. Shared by the admin
     * lead detail view and the public shareable report page so both render
     * identical analytics from the same logic.
     *
     * @param  iterable<int, \App\Models\EsopEmployee>  $employees
     * @return array{byDepartment: array<int, array{label:string, employees:int, allocated:float}>, byLevel: array<int, array{label:string, employees:int, allocated:float}>}
     */
    public static function breakdowns(iterable $employees): array
    {
        $employees = collect($employees);

        $byDepartment = $employees
            ->groupBy(fn ($e) => $e->emp_department ?: 'Unspecified')
            ->map(fn ($group, $name) => [
                'label'     => $name,
                'employees' => $group->count(),
                'allocated' => (float) $group->sum('final_grant_percent'),
            ])
            ->sortByDesc('allocated')
            ->values()
            ->all();

        // Seniority is a closed list of five tiers, and each one can carry its
        // own tier pool — so every level is seeded here, including the ones
        // nobody was scored against. A level sitting at 0% is meaningful
        // information (that tier is still entirely unallocated), whereas simply
        // omitting the row leaves the reader to notice an absence. Any
        // unexpected or legacy value still in the data keeps its own row and is
        // appended after the five known tiers.
        $seniorityOrder = EsopQuestionBank::SENIORITY_LEVELS;
        $groupedByLevel = $employees->groupBy(fn ($e) => $e->emp_seniority ?: 'Unspecified');

        $byLevel = collect($seniorityOrder)
            ->merge($groupedByLevel->keys())
            ->unique()
            ->values()
            ->map(function ($name) use ($groupedByLevel) {
                $group = $groupedByLevel->get($name);

                return [
                    'label'     => $name,
                    'employees' => $group ? $group->count() : 0,
                    'allocated' => $group ? (float) $group->sum('final_grant_percent') : 0.0,
                ];
            })
            ->all();

        return ['byDepartment' => $byDepartment, 'byLevel' => $byLevel];
    }
}
