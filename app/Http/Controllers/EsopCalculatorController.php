<?php

namespace App\Http\Controllers;

use App\Mail\EsopResultMail;
use App\Models\EsopEmployee;
use App\Models\EsopLead;
use App\Services\EsopAllocationCalculator;
use App\Services\EsopQuestionBank;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EsopCalculatorController extends Controller
{
    /**
     * Marketing landing page for the ESOP Allocation Calculator.
     */
    public function index()
    {
        return view('frontend.esop-calculator.landing');
    }

    /**
     * The typeform-style calculator tool itself — one question per screen.
     */
    public function app()
    {
        return view('frontend.esop-calculator.app', [
            'params'          => EsopQuestionBank::askedParams(),
            'departments'     => EsopQuestionBank::DEPARTMENTS,
            'seniorityLevels' => EsopQuestionBank::SENIORITY_LEVELS,
            'companyStages'   => EsopQuestionBank::COMPANY_STAGES,
        ]);
    }

    /**
     * Validate the entire session (pool setup + contact + every employee
     * scored), persist it, compute the authoritative V6 pool split across
     * the whole cohort, generate the AI commentary, email the report, and
     * return the full result payload for the results screen.
     */
    public function submit(Request $request): JsonResponse
    {
        $askedKeys = EsopQuestionBank::askedKeys();

        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:50',
            'event_id' => 'nullable|string|max:255',

            'company'       => 'nullable|string|max:255',
            'website'       => 'nullable|string|max:255',
            'industry'      => 'nullable|string|max:255',
            'company_stage' => 'nullable|string|max:255',

            'esop_pool_percent'          => 'required|numeric|min:0|max:100',
            'hiring_reserve_percent'     => 'nullable|numeric|min:0|max:100',
            'planned_headcount'          => 'nullable|integer|min:0|max:100000',
            'pool_distribute_percent'    => 'nullable|numeric|min:0|max:100',
            'tier_pool_leadership'       => 'nullable|numeric|min:0|max:100',
            'tier_pool_senior_management' => 'nullable|numeric|min:0|max:100',
            'tier_pool_mid_level'        => 'nullable|numeric|min:0|max:100',
            'tier_pool_junior'           => 'nullable|numeric|min:0|max:100',
            'tier_pool_others'           => 'nullable|numeric|min:0|max:100',

            'employees'                   => 'required|array|min:1|max:200',
            'employees.*.emp_name'        => 'nullable|string|max:255',
            'employees.*.emp_code'        => 'nullable|string|max:255',
            'employees.*.emp_designation' => 'nullable|string|max:255',
            'employees.*.emp_department'  => 'nullable|string|max:255',
            'employees.*.emp_seniority'   => 'required|string|in:' . implode(',', EsopQuestionBank::SENIORITY_LEVELS),
            'employees.*.emp_years'       => 'required|numeric|min:0|max:60',
            'employees.*.answers'         => 'required|array',
        ];

        foreach ($askedKeys as $key) {
            $rules["employees.*.answers.$key"] = 'required|integer|min:0|max:5';
        }

        $validated = $request->validate($rules);

        $lead = EsopLead::create([
            'share_token'                 => Str::random(40),
            'name'                        => $validated['name'],
            'email'                       => $validated['email'],
            'phone'                       => $validated['phone'] ?? null,
            'company'                     => $validated['company'] ?? null,
            'website'                     => $validated['website'] ?? null,
            'industry'                    => $validated['industry'] ?? null,
            'company_stage'               => $validated['company_stage'] ?? null,
            'esop_pool_percent'           => $validated['esop_pool_percent'],
            'hiring_reserve_percent'      => $validated['hiring_reserve_percent'] ?? 10,
            'planned_headcount'           => $validated['planned_headcount'] ?? count($validated['employees']),
            'pool_distribute_percent'     => $validated['pool_distribute_percent'] ?? 100,
            'tier_pool_leadership'        => $validated['tier_pool_leadership'] ?? null,
            'tier_pool_senior_management' => $validated['tier_pool_senior_management'] ?? null,
            'tier_pool_mid_level'         => $validated['tier_pool_mid_level'] ?? null,
            'tier_pool_junior'            => $validated['tier_pool_junior'] ?? null,
            'tier_pool_others'            => $validated['tier_pool_others'] ?? null,
            'status'                      => 'new',
            'submitted_at'                => now(),
            'ip_address'                  => $request->ip(),
            'user_agent'                  => $request->userAgent(),
        ]);

        // Score every employee server-side and persist the rows.
        $employeeRows = [];
        foreach (array_values($validated['employees']) as $i => $empInput) {
            $scored = EsopAllocationCalculator::scoreEmployee($empInput['answers'], (float) $empInput['emp_years']);

            $paramSelections = [];
            foreach (EsopQuestionBank::askedParams() as $param) {
                $key   = $param['key'];
                $score = (int) $scored['param_scores'][$key];
                $optionText = null;
                foreach ($param['options'] as $option) {
                    if ((int) $option['score'] === $score) {
                        $optionText = $option['text'];
                        break;
                    }
                }
                $paramSelections[$key] = $optionText ?? (string) $score;
            }
            $paramSelections['years_tenure'] = $empInput['emp_years'] . ' years (auto-scored)';

            $employee = EsopEmployee::create([
                'esop_lead_id'      => $lead->id,
                'emp_name'          => $empInput['emp_name'] ?? null,
                'emp_code'          => $empInput['emp_code'] ?? null,
                'emp_designation'   => $empInput['emp_designation'] ?? null,
                'emp_department'    => $empInput['emp_department'] ?? null,
                'emp_seniority'     => $empInput['emp_seniority'],
                'emp_years'         => $empInput['emp_years'],
                'param_scores'      => $scored['param_scores'],
                'param_selections'  => $paramSelections,
                'total_score'       => $scored['total_score'],
                'sort_order'        => $i,
            ]);

            $employeeRows[] = $employee;
        }

        $calc = EsopAllocationCalculator::calculateSession(
            [
                'esop_pool_percent'           => $lead->esop_pool_percent,
                'hiring_reserve_percent'      => $lead->hiring_reserve_percent,
                'planned_headcount'           => $lead->planned_headcount,
                'pool_distribute_percent'     => $lead->pool_distribute_percent,
                'tier_pool_leadership'        => $lead->tier_pool_leadership,
                'tier_pool_senior_management' => $lead->tier_pool_senior_management,
                'tier_pool_mid_level'         => $lead->tier_pool_mid_level,
                'tier_pool_junior'            => $lead->tier_pool_junior,
                'tier_pool_others'            => $lead->tier_pool_others,
            ],
            array_map(fn ($e) => [
                'id'          => $e->id,
                'seniority'   => $e->emp_seniority,
                'total_score' => $e->total_score,
            ], $employeeRows)
        );

        foreach ($employeeRows as $employee) {
            $r = $calc['employees'][$employee->id];
            $employee->update([
                'final_grant_percent'   => $r['final_grant_percent'],
                'share_of_pool_percent' => $r['share_of_pool_percent'],
                'rank'                  => $r['rank'],
                'tier_pool_applied'     => $r['tier_pool_applied'],
            ]);
        }

        $aiContent = $this->callAi($lead, $employeeRows, $calc);

        $lead->update([
            'result_summary' => $calc['pool'],
            'ai_content'     => $aiContent['overall'],
        ]);

        // Fire the Meta Conversions API event for this completed lead. Shares
        // event_id with the browser-side fbq('track', 'CompleteRegistration')
        // call in calculator.js so Meta de-duplicates rather than double-counting.
        // Best-effort: never allowed to break the response to the frontend.
        $this->sendMetaConversionEvent($lead, $request, $validated['event_id'] ?? null);

        foreach ($employeeRows as $employee) {
            $note = $aiContent['employees'][$employee->id] ?? null;
            if ($note) {
                $employee->update(['ai_content' => $note]);
            }
        }

        $reportUrl = route('esop-calculator.report', $lead->share_token);

        if (!empty($lead->email)) {
            try {
                Mail::to($lead->email, $lead->name)->send(new EsopResultMail(
                    lead: $lead,
                    employees: $employeeRows,
                    calc: $calc,
                    aiContent: $aiContent,
                    reportUrl: $reportUrl,
                ));
            } catch (\Throwable $e) {
                Log::error('ESOP result email failed: ' . $e->getMessage(), ['email' => $lead->email]);
            }
        }

        $breakdowns = EsopAllocationCalculator::breakdowns($employeeRows);

        return response()->json([
            'success'      => true,
            'lead_id'      => $lead->id,
            'report_url'   => $reportUrl,
            'pool'         => $calc['pool'],
            'by_department' => $breakdowns['byDepartment'],
            'by_level'     => $breakdowns['byLevel'],
            'employees'    => collect($employeeRows)->map(function (EsopEmployee $e) use ($aiContent) {
                return [
                    'id'                    => $e->id,
                    'emp_name'              => $e->emp_name,
                    'emp_designation'       => $e->emp_designation,
                    'emp_department'        => $e->emp_department,
                    'emp_seniority'         => $e->emp_seniority,
                    'emp_years'             => $e->emp_years,
                    'total_score'           => $e->total_score,
                    'score_label'           => EsopQuestionBank::scoreLabel($e->total_score),
                    'final_grant_percent'   => $e->final_grant_percent,
                    'share_of_pool_percent' => $e->share_of_pool_percent,
                    'rank'                  => $e->rank,
                    'tier_pool_applied'     => $e->tier_pool_applied,
                    'peer_group'            => $e->tier_pool_applied ? ('Tier pool — ' . $e->emp_seniority) : 'Shared remainder pool',
                    'ai'                    => $aiContent['employees'][$e->id] ?? null,
                ];
            }),
            'ai_overall' => $aiContent['overall'],
        ]);
    }

    /**
     * Persistent, shareable, server-rendered dashboard for a completed
     * session — reachable at a private, unguessable URL so a founder can
     * bookmark or forward the result instead of it only existing as
     * ephemeral client-side state in the tab that submitted it.
     */
    public function report(string $token)
    {
        $lead = EsopLead::where('share_token', $token)->firstOrFail();
        $lead->load('employees');

        $pool = $lead->result_summary ?? [];
        $breakdowns = EsopAllocationCalculator::breakdowns($lead->employees);
        $rankedEmployees = $lead->employees->sortBy(fn ($e) => $e->rank ?: 999999)->values();

        return view('frontend.esop-calculator.report', [
            'lead'           => $lead,
            'pool'           => $pool,
            'employees'      => $rankedEmployees,
            'byDepartment'   => $breakdowns['byDepartment'],
            'byLevel'        => $breakdowns['byLevel'],
            'aiContent'      => $lead->ai_content ?? [],
        ]);
    }

    /**
     * Send a CompleteRegistration event to the Meta Conversions API for a
     * finalized ESOP Calculator lead. This mirrors the browser-side fbq()
     * event fired from calculator.js, using the same event_id so Meta
     * de-dupes them instead of counting the conversion twice. Silently
     * no-ops if the CAPI access token isn't configured — the browser pixel
     * keeps working either way, this just adds a server-side backstop
     * against ad blockers / iOS tracking prevention dropping the browser
     * event. Uses the same META_PIXEL_ID as the /vision-card funnel
     * (see VisionCardController::sendMetaConversionEvent for the twin).
     */
    private function sendMetaConversionEvent(EsopLead $lead, Request $request, ?string $eventId): void
    {
        $pixelId = config('services.meta.pixel_id');
        $token   = config('services.meta.capi_token');

        if (empty($pixelId) || empty($token)) {
            // Name the missing value explicitly. These two fail for very
            // different reasons — an absent pixel_id means the browser Pixel is
            // broken too, whereas an absent capi_token means only the
            // server-side backstop is off and the browser Pixel is fine. The
            // old combined wording made a missing token read as a missing pixel.
            Log::info('EsopCalculator Meta CAPI: skipped — ' . (empty($pixelId)
                ? 'META_PIXEL_ID is not set.'
                : 'META_CAPI_ACCESS_TOKEN is not set, so only the server-side Conversions API is disabled; the browser Pixel is unaffected.'));

            return;
        }

        try {
            $userData = [
                'client_ip_address' => $request->ip(),
                'client_user_agent' => $request->userAgent(),
            ];

            if (!empty($lead->email)) {
                $userData['em'] = [hash('sha256', strtolower(trim($lead->email)))];
            }

            if (!empty($lead->phone)) {
                $digits = preg_replace('/\D/', '', $lead->phone);
                if ($digits !== '') {
                    $userData['ph'] = [hash('sha256', $digits)];
                }
            }

            // _fbc / _fbp are first-party cookies the Pixel script sets itself;
            // forwarding them lets Meta tie this server event back to the same
            // browser/ad click as the client-side event.
            if ($request->cookie('_fbc')) {
                $userData['fbc'] = $request->cookie('_fbc');
            }
            if ($request->cookie('_fbp')) {
                $userData['fbp'] = $request->cookie('_fbp');
            }

            $version = config('services.meta.capi_version', 'v19.0');

            $response = Http::asForm()->post("https://graph.facebook.com/{$version}/{$pixelId}/events", [
                'access_token' => $token,
                'data' => json_encode([[
                    'event_name'       => 'CompleteRegistration',
                    'event_time'       => now()->timestamp,
                    'event_id'         => $eventId,
                    'event_source_url' => $request->headers->get('referer', config('app.url') . '/esop-calculator/app'),
                    'action_source'    => 'website',
                    'user_data'        => $userData,
                ]]),
            ]);

            if (!$response->successful()) {
                Log::warning('EsopCalculator Meta CAPI: request failed.', [
                    'lead_id' => $lead->id,
                    'status'  => $response->status(),
                    'body'    => mb_substr((string) $response->body(), 0, 500),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('EsopCalculator Meta CAPI: exception — ' . $e->getMessage(), ['lead_id' => $lead->id]);
        }
    }

    /**
     * Generate the AI narrative for the whole session in a single call —
     * one overall summary/risk-flag/next-steps block plus a short per-
     * employee note. Falls back to a deterministic template if every
     * configured provider fails, so the numeric result never depends on the
     * AI call succeeding.
     *
     * @param  EsopEmployee[]  $employees
     */
    private function callAi(EsopLead $lead, array $employees, array $calc): array
    {
        $prompt = $this->buildPrompt($lead, $employees, $calc);

        foreach ($this->aiProviders() as $provider) {
            if (empty($provider['key'])) {
                continue;
            }

            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $provider['key'],
                    'Content-Type'  => 'application/json',
                ])->timeout($provider['timeout'])->post($provider['endpoint'], [
                    'model'       => $provider['model'],
                    'max_tokens'  => 1800,
                    'temperature' => 0.5,
                    'messages'    => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

                if (!$response->successful()) {
                    Log::error("ESOP AI: {$provider['name']} HTTP {$response->status()} — trying next provider.");
                    continue;
                }

                $text   = $response->json('choices.0.message.content', '');
                $clean  = trim(preg_replace('/```json|```/', '', (string) $text));
                $parsed = json_decode($clean, true);

                if (!is_array($parsed) || json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning("ESOP AI: {$provider['name']} returned non-JSON — trying next provider.");
                    continue;
                }

                return $this->normaliseAiContent($parsed, $lead, $employees, $calc, $provider['name']);
            } catch (\Throwable $e) {
                Log::error("ESOP AI: {$provider['name']} exception — " . $e->getMessage());
                continue;
            }
        }

        return $this->fallbackAiContent($lead, $employees, $calc, 'template');
    }

    private function aiProviders(): array
    {
        return [
            [
                'name'     => 'openai',
                'key'      => config('services.openai.key', env('OPENAI_API_KEY', '')),
                'endpoint' => rtrim(config('services.openai.base', env('OPENAI_API_BASE', 'https://api.openai.com/v1')), '/') . '/chat/completions',
                'model'    => config('services.openai.model', env('OPENAI_MODEL', 'gpt-4o-mini')),
                'timeout'  => 60,
            ],
            [
                'name'     => 'kimi',
                'key'      => config('services.kimi.key', env('KIMI_API_KEY', '')),
                'endpoint' => rtrim(config('services.kimi.base', env('KIMI_API_BASE', 'https://api.moonshot.ai/v1')), '/') . '/chat/completions',
                'model'    => config('services.kimi.model', env('KIMI_MODEL', 'kimi-latest')),
                'timeout'  => 60,
            ],
            [
                'name'     => 'grok',
                'key'      => config('services.grok.key', env('GROK_API_KEY', '')),
                'endpoint' => rtrim(config('services.grok.base', env('GROK_API_BASE', 'https://api.x.ai/v1')), '/') . '/chat/completions',
                'model'    => config('services.grok.model', env('GROK_MODEL', 'grok-3-mini')),
                'timeout'  => 60,
            ],
        ];
    }

    /**
     * @param  EsopEmployee[]  $employees
     */
    private function buildPrompt(EsopLead $lead, array $employees, array $calc): string
    {
        $pool = $calc['pool'];

        $rows = [];
        foreach ($employees as $e) {
            $r = $calc['employees'][$e->id];
            $rows[] = sprintf(
                "- id=%d | %s (%s, %s, %s, %.1f yrs) | score %d/100 (%s) | recommended grant %.4f%% of equity | %s",
                $e->id,
                $e->emp_name ?: 'Unnamed employee',
                $e->emp_designation ?: 'n/a',
                $e->emp_department ?: 'n/a',
                $e->emp_seniority,
                $e->emp_years,
                $e->total_score,
                EsopQuestionBank::scoreLabel($e->total_score),
                $r['final_grant_percent'],
                $r['peer_group']
            );
        }

        $employeeList = implode("\n", $rows);
        $employeeIds  = implode(',', array_map(fn ($e) => $e->id, $employees));

        return <<<PROMPT
You are an ESOP design advisor writing plain, grammatically correct British/Indian business English for a founder or CFO at a manufacturing SME. Be specific and concrete, never generic filler. Do not use markdown formatting inside the text values.

Company: {$lead->company}, industry: {$lead->industry}, stage: {$lead->company_stage}.
Total ESOP pool: {$pool['esop_pool_percent']}% of equity. Hiring reserve carve-out: {$pool['hiring_reserve_percent']}%. Allocatable pool: {$pool['allocatable_pool_percent']}%. Pool to distribute this cycle: {$pool['pool_to_distribute_percent']}%.
Planned headcount to eventually score: {$pool['planned_headcount']}. Employees scored so far: {$pool['scored_count']}.
Total recommended allocation across everyone scored so far: {$pool['total_allocated_percent']}% (remaining pool: {$pool['remaining_pool_percent']}%).

Employees scored (id | name | designation | department | seniority | tenure | score | recommended grant | peer group):
{$employeeList}

Respond with ONLY valid JSON, no markdown fences, matching exactly this structure:
{
  "overall": {
    "summary": "2-3 sentences summarising the overall allocation outcome across the cohort scored so far",
    "risk_flag": "1-2 sentences flagging any pool-concentration or over-commitment risk, or state clearly there is none",
    "vesting_suggestion": "one sentence recommending a standard vesting schedule (e.g. 4-year vesting with a 1-year cliff) and why it fits this cohort",
    "next_steps": ["step 1", "step 2", "step 3"]
  },
  "employees": {
    "{$employeeIds}": {"rationale": "2-3 sentences explaining why this specific person's score supports their recommended grant", "retention_note": "1 sentence on retention urgency for this person"}
  }
}
The "employees" object must have one key per employee id listed above (use the exact numeric id as the JSON key, as a string), each with its own rationale and retention_note tailored to that person.
PROMPT;
    }

    /**
     * @param  EsopEmployee[]  $employees
     */
    private function normaliseAiContent(array $parsed, EsopLead $lead, array $employees, array $calc, string $provider): array
    {
        $defaults = $this->fallbackAiContent($lead, $employees, $calc, $provider);

        if (!empty($parsed['overall']) && is_array($parsed['overall'])) {
            foreach (['summary', 'risk_flag', 'vesting_suggestion', 'next_steps'] as $key) {
                if (!empty($parsed['overall'][$key])) {
                    $defaults['overall'][$key] = $parsed['overall'][$key];
                }
            }
        }

        if (!empty($parsed['employees']) && is_array($parsed['employees'])) {
            foreach ($employees as $e) {
                $note = $parsed['employees'][(string) $e->id] ?? null;
                if (is_array($note)) {
                    $defaults['employees'][$e->id] = array_merge($defaults['employees'][$e->id], array_filter([
                        'rationale'      => $note['rationale'] ?? null,
                        'retention_note' => $note['retention_note'] ?? null,
                    ]));
                }
            }
        }

        $defaults['overall']['_provider'] = $provider;

        return $defaults;
    }

    /**
     * @param  EsopEmployee[]  $employees
     */
    private function fallbackAiContent(EsopLead $lead, array $employees, array $calc, string $provider): array
    {
        $pool = $calc['pool'];

        $overall = [
            'summary' => sprintf(
                'Across the %d employee%s scored so far, a total of %.4f%% of fully diluted equity is recommended out of the %.2f%% allocatable pool, leaving %.4f%% still available.',
                $pool['scored_count'],
                $pool['scored_count'] === 1 ? '' : 's',
                $pool['total_allocated_percent'],
                $pool['allocatable_pool_percent'],
                $pool['remaining_pool_percent']
            ),
            'risk_flag' => $pool['tier_pool_is_over_committed']
                ? 'The seniority tier pools you entered add up to more than the pool available to distribute this cycle, so every tier pool has been scaled down proportionally to fit — consider revisiting those figures before finalising grants.'
                : 'No pool-concentration risk was detected — the tier pools and remaining allocation fit comfortably within what is available this cycle.',
            'vesting_suggestion' => 'A standard four-year vesting schedule with a one-year cliff is recommended for every grant in this batch, aligning equity with sustained contribution rather than a one-off award.',
            'next_steps' => [
                'Confirm every recommended figure with your cap table administrator or ESOP trustee before communicating a number to any employee.',
                'Draft grant letters referencing the vesting schedule and any performance conditions that apply.',
                'Revisit the remaining pool against your upcoming hiring plan before finalising this cycle\'s grants.',
            ],
            '_provider' => $provider,
        ];

        $employeeNotes = [];
        foreach ($employees as $e) {
            $r = $calc['employees'][$e->id];
            $designation = $e->emp_designation ?: 'This employee';
            $employeeNotes[$e->id] = [
                'rationale' => sprintf(
                    '%s scored %d out of 100 (%s), placing them within the %s and supporting a recommended one-time grant of %.4f%% of fully diluted equity.',
                    $designation,
                    $e->total_score,
                    $r['score_label'],
                    $r['peer_group'],
                    $r['final_grant_percent']
                ),
                'retention_note' => 'Treat this as a time-sensitive retention lever — delaying the grant reduces its motivational impact, particularly for high-scarcity or high-impact roles.',
            ];
        }

        return ['overall' => $overall, 'employees' => $employeeNotes];
    }
}
