<?php

namespace App\Http\Controllers;

use App\Models\VisionLead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class VisionCardController extends Controller
{
    /**
     * Display the Growth Blueprint / Vision Card landing page.
     */
    public function index()
    {
        return view('frontend.vision-card.index');
    }

    /**
     * Validate the lead data, persist it, call the AI backend,
     * save the AI response and return it to the frontend.
     */
    public function generate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:50|regex:/^(?:\D*\d){10,}\D*$/',
            'company'           => 'required|string|max:255',
            'city'              => 'required|string|max:255',
            'website'           => 'nullable|string|max:255',
            'industry'          => 'required|string|max:255',
            'business_type'     => 'required|string|max:255',
            'years_in_business' => 'required|string|max:255',
            'team_size'         => 'required|string|max:255',
            'annual_revenue'    => 'nullable|string|max:255',
            'current_stage'     => 'required|string|max:255',
            'challenges'        => 'nullable|array',
            'y1_goal'           => 'required|string|max:255',
            'y1_detail'         => 'nullable|string|max:1000',
            'y1_excitement'     => 'nullable|string|max:2000',
            'y3_goal'           => 'required|string|max:255',
            'y3_proud'          => 'nullable|string|max:2000',
            'y5_known'          => 'required|string|max:2000',
            'y5_achievements'   => 'nullable|array',
            'y5_headline'       => 'nullable|string|max:1000',
            'founder_identity'  => 'nullable|array',
            'focus_areas'       => 'nullable|array',
            'personal_goals'    => 'nullable|array',
            'other_answers'     => 'nullable|array',
        ]);

        // Normalise array fields
        $arrayFields = ['challenges', 'y5_achievements', 'founder_identity', 'focus_areas', 'personal_goals', 'other_answers'];
        foreach ($arrayFields as $field) {
            if (!isset($validated[$field]) || !is_array($validated[$field])) {
                $validated[$field] = [];
            }
        }

        // Persist the lead first so nothing is lost even if AI fails.
        $lead = VisionLead::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'phone'             => $validated['phone'] ?? null,
            'company'           => $validated['company'] ?? null,
            'city'              => $validated['city'] ?? null,
            'website'           => $validated['website'] ?? null,
            'industry'          => $validated['industry'] ?? null,
            'business_type'     => $validated['business_type'] ?? null,
            'years_in_business' => $validated['years_in_business'] ?? null,
            'team_size'         => $validated['team_size'] ?? null,
            'annual_revenue'    => $validated['annual_revenue'] ?? null,
            'current_stage'     => $validated['current_stage'] ?? null,
            'challenges'        => $validated['challenges'],
            'y1_goal'           => $validated['y1_goal'] ?? null,
            'y1_detail'         => $validated['y1_detail'] ?? null,
            'y1_excitement'     => $validated['y1_excitement'] ?? null,
            'y3_goal'           => $validated['y3_goal'] ?? null,
            'y3_proud'          => $validated['y3_proud'] ?? null,
            'y5_known'          => $validated['y5_known'] ?? null,
            'y5_achievements'   => $validated['y5_achievements'],
            'y5_headline'       => $validated['y5_headline'] ?? null,
            'founder_identity'  => $validated['founder_identity'],
            'focus_areas'       => $validated['focus_areas'],
            'personal_goals'    => $validated['personal_goals'],
            'other_answers'     => $validated['other_answers'],
            'status'            => 'new',
            'ip_address'        => $request->ip(),
            'user_agent'        => $request->userAgent(),
        ]);

        $aiContent = $this->callAi($validated);

        $lead->update(['ai_content' => $aiContent]);

        return response()->json([
            'success'    => true,
            'lead_id'    => $lead->id,
            'ai_content' => $aiContent,
        ]);
    }

    /**
     * Build the prompt and call the Kimi (Moonshot) API, falling back to a
     * local template if the API is unavailable or unconfigured.
     */
    private function callAi(array $state): array
    {
        $apiKey = env('KIMI_API_KEY');
        $model  = env('KIMI_MODEL', 'kimi-latest');

        if (empty($apiKey)) {
            Log::warning('VisionCard AI skipped: KIMI_API_KEY is not set. Using fallback content.', ['email' => $state['email'] ?? null]);
            return $this->fallbackAiContent($state);
        }

        $prompt = $this->buildPrompt($state);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'content-type'  => 'application/json',
            ])->timeout(90)->post('https://api.moonshot.cn/v1/chat/completions', [
                'model'       => $model,
                'max_tokens'  => 2500,
                'temperature' => 0.7,
                'messages'    => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if (!$response->successful()) {
                Log::error('VisionCard Kimi API error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return $this->fallbackAiContent($state);
            }

            $data = $response->json();
            $text = $data['choices'][0]['message']['content'] ?? '';
            $clean = preg_replace('/```json|```/', '', $text);
            $clean = trim($clean);

            $parsed = json_decode($clean, true);
            if (!is_array($parsed) || json_last_error() !== JSON_ERROR_NONE) {
                Log::warning('VisionCard AI response was not valid JSON; using fallback.', ['response' => $text]);
                return $this->fallbackAiContent($state);
            }

            return $this->normaliseAiContent($parsed, $state);
        } catch (\Throwable $e) {
            Log::error('VisionCard AI exception: ' . $e->getMessage());
            return $this->fallbackAiContent($state);
        }
    }

    /**
     * Build the strategy prompt from the collected state.
     */
    private function buildPrompt(array $state): string
    {
        $other = collect($state['other_answers'] ?? [])
            ->map(fn ($v, $k) => "Custom answer for {$k}: \"{$v}\"")
            ->implode("\n");

        return <<<PROMPT
You are a senior strategy consultant. Generate a focused JSON strategy blueprint for this business owner. Every custom answer they provided must be incorporated verbatim into the output.

Founder: {$state['name']} | Company: {$state['company']} | City: {$state['city']}
Industry: {$state['industry']} | Type: {$state['business_type']} | Revenue: {$state['annual_revenue']} | Team: {$state['team_size']} | Years: {$state['years_in_business']}
Current Stage: {$state['current_stage']} | Challenges: {$this->join($state['challenges'])}
1-Year Priority: {$state['y1_goal']} — {$state['y1_detail']} | In their words: "{$state['y1_excitement']}"
3-Year Aspiration: {$state['y3_goal']} | In their words: "{$state['y3_proud']}"
5-Year Vision: "{$state['y5_known']}" | Achievements: {$this->join($state['y5_achievements'])} | Headline: "{$state['y5_headline']}"
Founder Identity: {$this->join($state['founder_identity'])} | Focus Area: {$this->join($state['focus_areas'])} | Personal goals: {$this->join($state['personal_goals'])}
Custom / Other answers:
{$other}

Respond with ONLY valid JSON, no markdown fences, matching this exact structure:
{"tagline":"compelling 7-8 word company tagline","growthTheme":"4-5 word strategic theme for next 5 years","mission":"one authoritative mission statement (15-20 words), direct and powerful","vision":"one aspirational vision statement (15-20 words), bold and specific","values":["Value 1","Value 2","Value 3","Value 4"],"executiveSummary":"3 polished, sophisticated sentences written in the style of a leading business publication — present tense, confident, no filler phrases.","topPriorities":["Priority 1 — max 10 words","Priority 2","Priority 3","Priority 4","Priority 5"],"biggestOpportunity":"One precise, industry-specific sentence.","keyRisk":"One frank, stage-specific sentence.","actions30":["Action 1","Action 2","Action 3"],"actions90":["Action 1","Action 2","Action 3"],"y1milestones":["Milestone 1","Milestone 2","Milestone 3"],"y3milestones":["Milestone 1","Milestone 2","Milestone 3"],"y5milestones":["Milestone 1","Milestone 2","Milestone 3"],"kpis":["KPI 1","KPI 2","KPI 3","KPI 4"],"founderAdvice":"One authoritative, personalised sentence of counsel.","quote":"An original, memorable 12-18 word strategic insight specific to their industry and situation."}
PROMPT;
    }

    /**
     * Join array values safely for the prompt.
     */
    private function join(?array $values): string
    {
        return implode(', ', array_filter($values ?? []));
    }

    /**
     * Ensure the AI response has every key the board renderer expects.
     */
    private function normaliseAiContent(array $parsed, array $state): array
    {
        $defaults = $this->fallbackAiContent($state);

        $keys = [
            'tagline', 'growthTheme', 'mission', 'vision', 'values',
            'executiveSummary', 'topPriorities', 'biggestOpportunity', 'keyRisk',
            'actions30', 'actions90', 'y1milestones', 'y3milestones', 'y5milestones',
            'kpis', 'founderAdvice', 'quote',
        ];

        foreach ($keys as $key) {
            if (!empty($parsed[$key])) {
                $defaults[$key] = $parsed[$key];
            }
        }

        return $defaults;
    }

    /**
     * Fallback AI content used when the API fails or is not configured.
     */
    private function fallbackAiContent(array $state): array
    {
        $industry = $state['industry'] ?? 'business';
        $company = $state['company'] ?? 'This business';
        $team = $state['team_size'] ?? 'dedicated';
        $revenue = $state['annual_revenue'] ?? 'current revenue';

        return [
            'tagline'          => "Defining the Future of {$industry}",
            'growthTheme'      => 'Scale. Lead. Endure.',
            'mission'          => 'To deliver exceptional outcomes for every client while building a business worthy of the next generation.',
            'vision'           => "To be the most trusted and respected {$industry} enterprise in our chosen markets within five years.",
            'values'           => ['Excellence', 'Integrity', 'Innovation', 'Resilience'],
            'executiveSummary' => "{$company} is an established {$industry} enterprise at a pivotal inflection point. With {$revenue} in annual revenue and a {$team} team, the business is well positioned to execute an ambitious growth agenda. The next five years represent a defining chapter in its evolution.",
            'topPriorities'    => [
                'Accelerate core revenue growth',
                'Build scalable systems and processes',
                'Strengthen the leadership team',
                'Deepen customer and market relationships',
                'Establish a clear competitive moat',
            ],
            'biggestOpportunity' => "The convergence of digital adoption and changing customer expectations creates a compelling first-mover advantage for {$industry} businesses that move decisively.",
            'keyRisk'            => 'Scaling without simultaneously building the operational, financial and people infrastructure to sustain it is the single greatest risk to manage.',
            'actions30'          => [
                'Define and communicate the 90-day priority to the full team',
                'Map the three highest-value customer segments to double down on',
                'Identify one process to systematise or automate this month',
            ],
            'actions90'          => [
                'Complete a customer satisfaction and NPS benchmark',
                'Fill the most critical leadership or capability gap',
                'Launch one new initiative aligned to the 12-month priority',
            ],
            'y1milestones'       => [
                ($state['y1_goal'] ? "{$state['y1_goal']} — target achieved" : 'Achieve key revenue milestone'),
                'Build core team and systems capability',
                'Establish clear competitive differentiation',
            ],
            'y3milestones'       => [
                ($state['y3_goal'] ? "{$state['y3_goal']} — fully realised" : 'Achieve regional market leadership'),
                'Expand product and service portfolio',
                'Build brand reputation nationally',
            ],
            'y5milestones'       => [
                (!empty($state['y5_achievements'][0]) ? $state['y5_achievements'][0] : 'Achieve national recognition'),
                'Deliver strong, diversified revenue streams',
                'Create a business that operates without the founder day-to-day',
            ],
            'kpis'               => [
                'Revenue growth rate (month-on-month)',
                'Gross and net profit margin',
                'Customer acquisition cost and lifetime value',
                'Team retention and engagement score',
            ],
            'founderAdvice'      => 'The quality of your decisions over the next 12 months will compound into the company you are in five years — choose with that lens.',
            'quote'              => 'Clarity of direction is the rarest and most valuable competitive advantage a business can possess.',
        ];
    }
}
