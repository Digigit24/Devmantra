<?php

namespace App\Http\Controllers;

use App\Mail\VisionCardResultMail;
use App\Models\VisionLead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
            'lead_id'           => 'nullable|integer',
            'event_id'          => 'nullable|string|max:255',
        ]);

        // Normalise array fields
        $arrayFields = ['challenges', 'y5_achievements', 'founder_identity', 'focus_areas', 'personal_goals', 'other_answers'];
        foreach ($arrayFields as $field) {
            if (!isset($validated[$field]) || !is_array($validated[$field])) {
                $validated[$field] = [];
            }
        }

        // Build the completed lead payload.
        $leadData = [
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
        ];

        // Reuse the partial row created by autosave (if the frontend sent its
        // id) so we don't create a duplicate; otherwise create a fresh lead.
        // Either way the lead is persisted BEFORE the AI call, so nothing is
        // lost even if the AI fails.
        $lead = !empty($validated['lead_id']) ? VisionLead::find($validated['lead_id']) : null;
        if ($lead) {
            $lead->update($leadData);
        } else {
            $lead = VisionLead::create($leadData);
        }

        $aiContent = $this->callAi($validated);

        $lead->update(['ai_content' => $aiContent]);

        // Fire the Meta Conversions API event for this completed lead. Shares
        // event_id with the browser-side fbq('track', 'CompleteRegistration')
        // call in generate.js so Meta de-duplicates rather than double-counting.
        // Best-effort: never allowed to break the response to the frontend.
        $this->sendMetaConversionEvent($lead, $request, $validated['event_id'] ?? null);

        // Email the finished blueprint to the person who submitted the form,
        // using the site's configured (Brevo) mailer. Best-effort: a mail
        // failure must never break the API response or the result screen.
        if (!empty($lead->email)) {
            try {
                Mail::to($lead->email, $lead->name)->send(new VisionCardResultMail(
                    name: (string) ($lead->name ?? ''),
                    company: (string) ($lead->company ?? ''),
                    blueprint: is_array($aiContent) ? $aiContent : [],
                ));
            } catch (\Throwable $e) {
                Log::error('VisionCard result email failed: ' . $e->getMessage(), ['email' => $lead->email]);
            }
        }

        return response()->json([
            'success'    => true,
            'lead_id'    => $lead->id,
            'ai_content' => $aiContent,
        ]);
    }

    /**
     * Autosave a partial lead as the visitor progresses through the form.
     *
     * Called on every step so nothing is lost if the visitor abandons the
     * form. Returns the lead id so subsequent saves — and the final generate
     * call — update the same row instead of creating duplicates.
     *
     * Migration-free: the first server-side row is written from the moment a
     * name + email exist (step 2), which is when the lead first becomes
     * contactable. Earlier keystrokes are still held in the browser.
     */
    public function autosave(Request $request): JsonResponse
    {
        $data = $request->validate([
            'lead_id'           => 'nullable|integer',
            'step'              => 'nullable|integer',
            'name'              => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'nullable|string|max:50',
            'company'           => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'website'           => 'nullable|string|max:255',
            'industry'          => 'nullable|string|max:255',
            'business_type'     => 'nullable|string|max:255',
            'years_in_business' => 'nullable|string|max:255',
            'team_size'         => 'nullable|string|max:255',
            'annual_revenue'    => 'nullable|string|max:255',
            'current_stage'     => 'nullable|string|max:255',
            'challenges'        => 'nullable|array',
            'y1_goal'           => 'nullable|string|max:255',
            'y1_detail'         => 'nullable|string|max:1000',
            'y1_excitement'     => 'nullable|string|max:2000',
            'y3_goal'           => 'nullable|string|max:255',
            'y3_proud'          => 'nullable|string|max:2000',
            'y5_known'          => 'nullable|string|max:2000',
            'y5_achievements'   => 'nullable|array',
            'y5_headline'       => 'nullable|string|max:1000',
            'founder_identity'  => 'nullable|array',
            'focus_areas'       => 'nullable|array',
            'personal_goals'    => 'nullable|array',
            'other_answers'     => 'nullable|array',
        ]);

        // Normalise array fields.
        foreach (['challenges', 'y5_achievements', 'founder_identity', 'focus_areas', 'personal_goals', 'other_answers'] as $field) {
            if (!isset($data[$field]) || !is_array($data[$field])) {
                $data[$field] = [];
            }
        }

        $email = trim((string) ($data['email'] ?? ''));
        $name  = trim((string) ($data['name'] ?? ''));

        // Find the existing partial row: by id first, then by email.
        $lead = !empty($data['lead_id']) ? VisionLead::find($data['lead_id']) : null;
        if (!$lead && $email !== '') {
            $lead = VisionLead::where('email', $email)->where('status', 'partial')->latest()->first();
        }

        // A brand-new row needs at least the DB-required name + email. Until
        // then we acknowledge without persisting (browser keeps the data).
        if (!$lead && ($email === '' || $name === '')) {
            return response()->json(['success' => true, 'lead_id' => null, 'saved' => false]);
        }

        $payload = [
            'name'              => $name !== '' ? $name : ($lead->name ?? ''),
            'email'             => $email !== '' ? $email : ($lead->email ?? ''),
            'phone'             => $data['phone'] ?? null,
            'company'           => $data['company'] ?? null,
            'city'              => $data['city'] ?? null,
            'website'           => $data['website'] ?? null,
            'industry'          => $data['industry'] ?? null,
            'business_type'     => $data['business_type'] ?? null,
            'years_in_business' => $data['years_in_business'] ?? null,
            'team_size'         => $data['team_size'] ?? null,
            'annual_revenue'    => $data['annual_revenue'] ?? null,
            'current_stage'     => $data['current_stage'] ?? null,
            'challenges'        => $data['challenges'],
            'y1_goal'           => $data['y1_goal'] ?? null,
            'y1_detail'         => $data['y1_detail'] ?? null,
            'y1_excitement'     => $data['y1_excitement'] ?? null,
            'y3_goal'           => $data['y3_goal'] ?? null,
            'y3_proud'          => $data['y3_proud'] ?? null,
            'y5_known'          => $data['y5_known'] ?? null,
            'y5_achievements'   => $data['y5_achievements'],
            'y5_headline'       => $data['y5_headline'] ?? null,
            'founder_identity'  => $data['founder_identity'],
            'focus_areas'       => $data['focus_areas'],
            'personal_goals'    => $data['personal_goals'],
            'other_answers'     => $data['other_answers'],
            'ip_address'        => $request->ip(),
            'user_agent'        => $request->userAgent(),
        ];

        if ($lead) {
            // Only keep the "partial" flag while the lead is still partial —
            // never downgrade an already-completed lead.
            if ($lead->status === 'partial') {
                $payload['status'] = 'partial';
            }
            $lead->update($payload);
        } else {
            $payload['status'] = 'partial';
            $lead = VisionLead::create($payload);
        }

        return response()->json(['success' => true, 'lead_id' => $lead->id, 'saved' => true]);
    }

    /**
     * Send a CompleteRegistration event to the Meta Conversions API for a
     * finalized Vision Card lead. This mirrors the browser-side fbq() event
     * fired from generate.js, using the same event_id so Meta de-dupes them
     * instead of counting the conversion twice. Silently no-ops if the CAPI
     * access token isn't configured — the browser pixel keeps working either
     * way, this just adds a server-side backstop against ad blockers / iOS
     * tracking prevention dropping the browser event.
     */
    private function sendMetaConversionEvent(VisionLead $lead, Request $request, ?string $eventId): void
    {
        $pixelId = config('services.meta.pixel_id');
        $token   = config('services.meta.capi_token');

        if (empty($pixelId) || empty($token)) {
            Log::info('VisionCard Meta CAPI: skipped — pixel_id or capi_token not configured.');

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
                    'event_source_url' => $request->headers->get('referer', config('app.url') . '/vision-card'),
                    'action_source'    => 'website',
                    'user_data'        => $userData,
                ]]),
            ]);

            if (!$response->successful()) {
                Log::warning('VisionCard Meta CAPI: request failed.', [
                    'lead_id' => $lead->id,
                    'status'  => $response->status(),
                    'body'    => mb_substr((string) $response->body(), 0, 500),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('VisionCard Meta CAPI: exception — ' . $e->getMessage(), ['lead_id' => $lead->id]);
        }
    }

    /**
     * Generate the AI blueprint, trying each configured provider in order
     * (Kimi first, then Grok) and falling back to a local template only if
     * every provider is unconfigured or fails. The provider that produced the
     * content is logged and tagged onto the payload (_provider) for reporting.
     */
    private function callAi(array $state): array
    {
        $prompt = $this->buildPrompt($state);

        foreach ($this->aiProviders() as $provider) {
            if (empty($provider['key'])) {
                Log::info("VisionCard AI: skipping {$provider['name']} — no API key configured.");
                continue;
            }

            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $provider['key'],
                    'Content-Type'  => 'application/json',
                ])->timeout($provider['timeout'])->post($provider['endpoint'], [
                    'model'       => $provider['model'],
                    'max_tokens'  => 2500,
                    'temperature' => 0.7,
                    'messages'    => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

                if (!$response->successful()) {
                    Log::error("VisionCard AI: {$provider['name']} HTTP {$response->status()} — trying next provider.", [
                        'body' => mb_substr((string) $response->body(), 0, 500),
                    ]);
                    continue;
                }

                $text   = $response->json('choices.0.message.content', '');
                $clean  = trim(preg_replace('/```json|```/', '', (string) $text));
                $parsed = json_decode($clean, true);

                if (!is_array($parsed) || json_last_error() !== JSON_ERROR_NONE) {
                    Log::warning("VisionCard AI: {$provider['name']} returned non-JSON — trying next provider.", [
                        'snippet' => mb_substr((string) $text, 0, 300),
                    ]);
                    continue;
                }

                Log::info("VisionCard AI: blueprint generated via {$provider['name']} ({$provider['model']}).");
                $content = $this->normaliseAiContent($parsed, $state);
                $content['_provider'] = $provider['name'];

                return $content;
            } catch (\Throwable $e) {
                Log::error("VisionCard AI: {$provider['name']} exception — trying next provider. " . $e->getMessage());
                continue;
            }
        }

        Log::warning('VisionCard AI: all providers unavailable — using local template fallback.');
        $content = $this->fallbackAiContent($state);
        $content['_provider'] = 'template';

        return $content;
    }

    /**
     * AI providers in fallback order: OpenAI (ChatGPT) first, then Kimi,
     * then Grok, then the local template. Each is an OpenAI-compatible
     * /chat/completions endpoint, so reordering or adding a provider is just
     * an .env change — no code edit required. A provider is skipped
     * automatically whenever its *_API_KEY is empty.
     */
    private function aiProviders(): array
    {
        // Read via config() (with an env() fallback) so the keys resolve
        // whether or not `php artisan config:cache` has been run on the server.
        return [
            [
                'name'     => 'openai',
                'key'      => config('services.openai.key', env('OPENAI_API_KEY', '')),
                'endpoint' => rtrim(config('services.openai.base', env('OPENAI_API_BASE', 'https://api.openai.com/v1')), '/') . '/chat/completions',
                'model'    => config('services.openai.model', env('OPENAI_MODEL', 'gpt-4o-mini')),
                'timeout'  => 90,
            ],
            [
                'name'     => 'kimi',
                'key'      => config('services.kimi.key', env('KIMI_API_KEY', '')),
                'endpoint' => rtrim(config('services.kimi.base', env('KIMI_API_BASE', 'https://api.moonshot.ai/v1')), '/') . '/chat/completions',
                'model'    => config('services.kimi.model', env('KIMI_MODEL', 'kimi-latest')),
                'timeout'  => 90,
            ],
            [
                'name'     => 'grok',
                'key'      => config('services.grok.key', env('GROK_API_KEY', '')),
                'endpoint' => rtrim(config('services.grok.base', env('GROK_API_BASE', 'https://api.x.ai/v1')), '/') . '/chat/completions',
                'model'    => config('services.grok.model', env('GROK_MODEL', 'grok-3-mini')),
                'timeout'  => 90,
            ],
        ];
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
