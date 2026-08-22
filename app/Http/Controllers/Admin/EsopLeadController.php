<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EsopLead;
use App\Services\EsopAllocationCalculator;
use App\Services\EsopQuestionBank;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EsopLeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = $this->filtered($request)
            ->withCount('employees')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.esop-leads.index', compact('leads'));
    }

    /**
     * Search + status filtering, shared by the table and both CSV exports so
     * an export always returns exactly the sessions the admin is looking at
     * rather than silently dumping the whole table.
     */
    private function filtered(Request $request): Builder
    {
        $query = EsopLead::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhereHas('employees', function ($eq) use ($search) {
                      $eq->where('emp_name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && in_array($request->input('status'), EsopLead::STATUSES, true)) {
            $query->where('status', $request->input('status'));
        }

        return $query;
    }

    /**
     * One row per session: the contact, the pool setup they entered, and the
     * headline outcome. This is the sales-follow-up view of the data — the
     * per-employee allocations live in exportEmployees() below.
     */
    public function export(Request $request): StreamedResponse
    {
        $filename = 'esop-sessions-' . now()->format('Y-m-d') . '.csv';
        $query    = $this->filtered($request)->withCount('employees');

        $columns = [
            'Contact Name', 'Email', 'Phone', 'Company', 'Website', 'Industry', 'Company Stage',
            'ESOP Pool %', 'Hiring Reserve %', 'Allocatable Pool %', 'Pool To Distribute %',
            'Planned Headcount', 'Employees Scored',
            'Tier Pool — Leadership', 'Tier Pool — Senior Management', 'Tier Pool — Mid-Level',
            'Tier Pool — Junior', 'Tier Pool — Others',
            'Total Allocated %', 'Remaining Pool %', 'Average Grant %',
            'Score Range', 'Tier Split Status',
            'AI Summary', 'AI Risk Flag', 'AI Vesting Suggestion', 'AI Next Steps', 'AI Provider',
            'Report URL', 'Status', 'Submitted',
        ];

        return $this->streamCsv($filename, function ($handle) use ($query, $columns) {
            fputcsv($handle, $columns);

            $query->chunkById(200, function ($leads) use ($handle) {
                foreach ($leads as $lead) {
                    // result_summary is the calculator's own pool block, stored
                    // at submit time — reused rather than recomputed so the
                    // export always matches what the founder was actually shown.
                    $pool = is_array($lead->result_summary) ? $lead->result_summary : [];
                    $ai   = is_array($lead->ai_content) ? $lead->ai_content : [];

                    $scoreRange = isset($pool['score_range_low'], $pool['score_range_high'])
                        ? $pool['score_range_low'] . ' – ' . $pool['score_range_high'] . ' / 100'
                        : '';

                    fputcsv($handle, [
                        $lead->name,
                        $lead->email,
                        $lead->phone,
                        $lead->company,
                        $lead->website,
                        $lead->industry,
                        $lead->company_stage,
                        self::num($lead->esop_pool_percent, 2),
                        self::num($lead->hiring_reserve_percent, 2),
                        self::num($pool['allocatable_pool_percent'] ?? null, 4),
                        self::num($pool['pool_to_distribute_percent'] ?? null, 4),
                        $lead->planned_headcount,
                        $lead->employees_count,
                        self::num($lead->tier_pool_leadership, 4),
                        self::num($lead->tier_pool_senior_management, 4),
                        self::num($lead->tier_pool_mid_level, 4),
                        self::num($lead->tier_pool_junior, 4),
                        self::num($lead->tier_pool_others, 4),
                        self::num($pool['total_allocated_percent'] ?? null, 4),
                        self::num($pool['remaining_pool_percent'] ?? null, 4),
                        self::num($pool['average_grant_percent'] ?? null, 4),
                        $scoreRange,
                        $pool['tier_split_status'] ?? '',
                        $ai['summary'] ?? '',
                        $ai['risk_flag'] ?? '',
                        $ai['vesting_suggestion'] ?? '',
                        self::flatten($ai['next_steps'] ?? null),
                        $ai['_provider'] ?? '',
                        $lead->share_token ? route('esop-calculator.report', $lead->share_token) : '',
                        $lead->status,
                        optional($lead->submitted_at ?? $lead->created_at)
                            ->timezone('Asia/Kolkata')->format('d M Y, g:i A'),
                    ]);
                }
            });
        });
    }

    /**
     * One row per scored employee, with the session's company and contact
     * repeated on each row so the file stands alone in Excel. This is the
     * actual output of the calculator: score, rank and recommended grant.
     *
     * Rows are grouped by session and ordered by rank within each, matching
     * the order the founder saw on their own report.
     */
    public function exportEmployees(Request $request): StreamedResponse
    {
        $filename = 'esop-employee-allocations-' . now()->format('Y-m-d') . '.csv';
        $query    = $this->filtered($request)->with('employees');

        $columns = [
            'Company', 'Contact Name', 'Contact Email', 'Session Submitted',
            'Rank', 'Employee Name', 'Employee Code', 'Designation', 'Department',
            'Seniority', 'Years of Service', 'Total Score', 'Score Label', 'Peer Group',
            'Final Grant %', 'Share of Pool %',
            'AI Rationale', 'AI Retention Note',
        ];

        return $this->streamCsv($filename, function ($handle) use ($query, $columns) {
            fputcsv($handle, $columns);

            $query->chunkById(50, function ($leads) use ($handle) {
                foreach ($leads as $lead) {
                    $submitted = optional($lead->submitted_at ?? $lead->created_at)
                        ->timezone('Asia/Kolkata')->format('d M Y, g:i A');

                    // Unranked employees (zero grant) sort last rather than
                    // first, which is what rank 0 would otherwise do.
                    $employees = $lead->employees->sortBy(fn ($e) => $e->rank ?: 999999);

                    foreach ($employees as $employee) {
                        $note = is_array($employee->ai_content) ? $employee->ai_content : [];

                        fputcsv($handle, [
                            $lead->company,
                            $lead->name,
                            $lead->email,
                            $submitted,
                            $employee->rank ?: '',
                            $employee->emp_name,
                            $employee->emp_code,
                            $employee->emp_designation,
                            $employee->emp_department,
                            $employee->emp_seniority,
                            $employee->emp_years,
                            $employee->total_score,
                            EsopQuestionBank::scoreLabel((int) $employee->total_score),
                            $employee->tier_pool_applied
                                ? 'Tier pool — ' . $employee->emp_seniority
                                : 'Shared remainder pool',
                            self::num($employee->final_grant_percent, 4),
                            self::num($employee->share_of_pool_percent, 2),
                            $note['rationale'] ?? '',
                            $note['retention_note'] ?? '',
                        ]);
                    }
                }
            });
        });
    }

    /**
     * Shared CSV response wrapper: UTF-8 BOM for Excel, no-store so a stale
     * download is never served from cache.
     */
    private function streamCsv(string $filename, callable $writer): StreamedResponse
    {
        return response()->stream(function () use ($writer) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            $writer($handle);
            fclose($handle);
        }, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control'       => 'no-store',
        ]);
    }

    /**
     * Format a percentage for the sheet, leaving a genuinely absent value as an
     * empty cell rather than printing a misleading "0.0000".
     */
    private static function num($value, int $decimals): string
    {
        return ($value === null || $value === '') ? '' : number_format((float) $value, $decimals, '.', '');
    }

    private static function flatten($value): string
    {
        if (!is_array($value)) {
            return (string) ($value ?? '');
        }

        return implode('; ', array_filter(array_map(
            fn ($item) => is_array($item) ? self::flatten($item) : trim((string) $item),
            $value
        ), fn ($item) => $item !== ''));
    }

    public function show(EsopLead $esopLead)
    {
        $esopLead->load('employees');

        // Mirrors the Excel model's Dashboard sheet: headcount + total
        // allocated % grouped by department and by seniority level.
        $breakdowns = EsopAllocationCalculator::breakdowns($esopLead->employees);
        $byDepartment = $breakdowns['byDepartment'];
        $byLevel = $breakdowns['byLevel'];

        return view('admin.esop-leads.show', compact('esopLead', 'byDepartment', 'byLevel'));
    }

    public function updateStatus(Request $request, EsopLead $esopLead)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', EsopLead::STATUSES),
        ]);

        $esopLead->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function destroy(EsopLead $esopLead)
    {
        $esopLead->delete();

        return redirect()->route('admin.esop-leads.index')->with('success', 'Lead deleted.');
    }
}
