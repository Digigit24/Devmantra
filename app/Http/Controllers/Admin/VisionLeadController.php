<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionLead;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VisionLeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = $this->filtered($request)->latest()->paginate(20)->withQueryString();

        return view('admin.vision-leads.index', compact('leads'));
    }

    /**
     * Search + status filtering, shared by the table and the CSV export so
     * "Export All" always returns exactly the rows the admin is looking at
     * rather than silently dumping the whole table.
     */
    private function filtered(Request $request): Builder
    {
        $query = VisionLead::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->input('status'), VisionLead::STATUSES, true)) {
            $query->where('status', $request->input('status'));
        }

        return $query;
    }

    /**
     * Stream every matching lead as CSV — the full submission plus the
     * generated AI blueprint.
     *
     * Streamed and chunked so a large export never holds the whole table in
     * memory, and prefixed with a UTF-8 BOM so Excel detects the encoding
     * instead of mangling accented characters. Mirrors the Fundability export.
     */
    public function export(Request $request): StreamedResponse
    {
        $filename = 'vision-card-leads-' . now()->format('Y-m-d') . '.csv';
        $query    = $this->filtered($request);

        $columns = [
            'Name', 'Email', 'Phone', 'Company', 'City', 'Website',
            'Industry', 'Business Type', 'Years in Business', 'Team Size',
            'Annual Revenue', 'Current Stage', 'Challenges',
            '1-Year Goal', '1-Year Detail', '1-Year — In Their Words',
            '3-Year Goal', '3-Year — Proud Of',
            '5-Year — Known For', '5-Year Achievements', '5-Year Headline',
            'Founder Identity', 'Focus Areas', 'Personal Goals', 'Other Answers',
            'AI Tagline', 'AI Growth Theme', 'AI Mission', 'AI Vision', 'AI Values',
            'AI Executive Summary', 'AI Top Priorities', 'AI Biggest Opportunity',
            'AI Key Risk', 'AI 30-Day Actions', 'AI 90-Day Actions',
            'AI Year 1 Milestones', 'AI Year 3 Milestones', 'AI Year 5 Milestones',
            'AI KPIs', 'AI Founder Advice', 'AI Quote', 'AI Provider',
            'Status', 'Submitted',
        ];

        return $this->streamCsv($filename, function ($handle) use ($query, $columns) {
            fputcsv($handle, $columns);

            // chunkById (rather than chunk) so paging through the export cannot
            // skip or repeat rows if the table is written to mid-download.
            $query->chunkById(200, function ($leads) use ($handle) {
                foreach ($leads as $lead) {
                    $ai = is_array($lead->ai_content) ? $lead->ai_content : [];

                    fputcsv($handle, [
                        $lead->name,
                        $lead->email,
                        $lead->phone,
                        $lead->company,
                        $lead->city,
                        $lead->website,
                        $lead->industry,
                        $lead->business_type,
                        $lead->years_in_business,
                        $lead->team_size,
                        $lead->annual_revenue,
                        $lead->current_stage,
                        self::flatten($lead->challenges),
                        $lead->y1_goal,
                        $lead->y1_detail,
                        $lead->y1_excitement,
                        $lead->y3_goal,
                        $lead->y3_proud,
                        $lead->y5_known,
                        self::flatten($lead->y5_achievements),
                        $lead->y5_headline,
                        self::flatten($lead->founder_identity),
                        self::flatten($lead->focus_areas),
                        self::flatten($lead->personal_goals),
                        self::flatten($lead->other_answers),
                        self::flatten($ai['tagline'] ?? null),
                        self::flatten($ai['growthTheme'] ?? null),
                        self::flatten($ai['mission'] ?? null),
                        self::flatten($ai['vision'] ?? null),
                        self::flatten($ai['values'] ?? null),
                        self::flatten($ai['executiveSummary'] ?? null),
                        self::flatten($ai['topPriorities'] ?? null),
                        self::flatten($ai['biggestOpportunity'] ?? null),
                        self::flatten($ai['keyRisk'] ?? null),
                        self::flatten($ai['actions30'] ?? null),
                        self::flatten($ai['actions90'] ?? null),
                        self::flatten($ai['y1milestones'] ?? null),
                        self::flatten($ai['y3milestones'] ?? null),
                        self::flatten($ai['y5milestones'] ?? null),
                        self::flatten($ai['kpis'] ?? null),
                        self::flatten($ai['founderAdvice'] ?? null),
                        self::flatten($ai['quote'] ?? null),
                        self::flatten($ai['_provider'] ?? null),
                        $lead->status,
                        optional($lead->created_at)->timezone('Asia/Kolkata')->format('d M Y, g:i A'),
                    ]);
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
     * Render a stored value as a single readable cell.
     *
     * Several columns are JSON-cast arrays (challenges, focus areas, the AI
     * blueprint's list fields) and one — other_answers — is an associative map
     * of question => answer. Lists join with "; "; maps render as
     * "question: answer" so the pairing survives the flattening.
     */
    private static function flatten($value): string
    {
        if (!is_array($value)) {
            return (string) ($value ?? '');
        }

        $parts = [];
        foreach ($value as $key => $item) {
            $item = is_array($item) ? self::flatten($item) : trim((string) $item);
            if ($item === '') {
                continue;
            }
            $parts[] = is_int($key) ? $item : "{$key}: {$item}";
        }

        return implode('; ', $parts);
    }

    public function show(VisionLead $visionLead)
    {
        return view('admin.vision-leads.show', compact('visionLead'));
    }

    public function updateStatus(Request $request, VisionLead $visionLead)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', VisionLead::STATUSES),
        ]);

        $visionLead->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function destroy(VisionLead $visionLead)
    {
        $visionLead->delete();

        return redirect()->route('admin.vision-leads.index')->with('success', 'Lead deleted.');
    }
}
