<?php

namespace App\Services;

/**
 * Single source of truth for every static list used by the ESOP Calculator —
 * the 20 behavioural parameters (with their 6 scored options each), the
 * seniority compensation bands, the department-specific evaluation hints,
 * and the department / seniority / company-stage option lists. Industry is
 * intentionally not in this file — it's a free-text field, per the source
 * Excel model (see note below).
 *
 * Both the frontend Blade view (to render the 19 dynamic question screens)
 * and the backend controller / calculator (to validate + score submissions)
 * read from this class, so the parameter list only ever needs to be edited
 * in one place.
 */
class EsopQuestionBank
{
    public const MAX_SCORE_PER_PARAM = 5;
    public const TOTAL_PARAMS = 20;
    public const MAX_SCORE = self::MAX_SCORE_PER_PARAM * self::TOTAL_PARAMS; // 100

    /**
     * Industry is a free-text field in ESOP_Allocation_Model_V6.xlsx —
     * Setup!C7 carries no data validation (unlike Company Stage, Department
     * and Seniority, which all have an Excel-defined dropdown list). There
     * is no Excel-sourced industry list, so this is intentionally not a
     * fixed option set; the calculator collects it as free text.
     */

    /**
     * Matches the exact data validation list on Setup!C8 in
     * ESOP_Allocation_Model_V6.xlsx: "Startup,Growth,IPO".
     */
    public const COMPANY_STAGES = ['Startup', 'Growth', 'IPO'];

    public const DEPARTMENTS = [
        'Procurement',
        'Production / Operations',
        'Quality Control',
        'Supply Chain & Logistics',
        'Maintenance',
        'Sales & Business Development',
        'Marketing',
        'HR',
        'Finance & Accounts',
        'R&D / Engineering',
        'IT / Digital Transformation',
        'Other',
    ];

    public const SENIORITY_LEVELS = ['Junior', 'Mid-Level', 'Senior Management', 'Leadership', 'Others (Default)'];

    /**
     * Maps a seniority level to the esop_leads column holding its optional
     * tier pool (% of total equity ring-fenced for that whole level), per
     * Setup!C28:C32 in ESOP_Allocation_Model_V6.xlsx — all five levels
     * (Leadership, Senior Management, Mid-Level, Junior, Others (Default)).
     * There is no per-employee min/max band in V6 — only these optional,
     * aggregate, per-level pools.
     */
    public const SENIORITY_TIER_FIELDS = [
        'Leadership'        => 'tier_pool_leadership',
        'Senior Management' => 'tier_pool_senior_management',
        'Mid-Level'         => 'tier_pool_mid_level',
        'Junior'            => 'tier_pool_junior',
        'Others (Default)'  => 'tier_pool_others',
    ];

    public static function tierPoolField(?string $seniority): ?string
    {
        return self::SENIORITY_TIER_FIELDS[$seniority] ?? null;
    }

    /**
     * Department-specific hint shown above the "Department Contribution"
     * behavioural question, so the visitor scores the employee against
     * criteria relevant to their actual function.
     */
    public const DEPT_HINTS = [
        'Sales & Business Development' => 'Evaluate on: Revenue generation, new customer acquisition, customer retention, order book growth, deal closures.',
        'Production / Operations'      => 'Evaluate on: Productivity improvement, output enhancement, OEE, downtime reduction, throughput.',
        'Procurement'                  => 'Evaluate on: Cost savings achieved, vendor development, supplier diversification, strategic sourcing initiatives.',
        'Finance & Accounts'           => 'Evaluate on: Cost control, working capital management, audit compliance, reporting quality, financial process improvements.',
        'HR'                           => 'Evaluate on: Talent retention, hiring effectiveness, employee development, attrition reduction, engagement initiatives.',
        'R&D / Engineering'            => 'Evaluate on: Product/process innovations, patents, quality improvements, cost engineering, new product development.',
        'Quality Control'              => 'Evaluate on: Defect reduction, audit performance, rejection rate, customer complaint reduction, compliance.',
        'Supply Chain & Logistics'     => 'Evaluate on: Inventory optimisation, delivery performance, logistics cost reduction, supply continuity.',
        'Maintenance'                  => 'Evaluate on: Equipment uptime, preventive maintenance adherence, breakdown reduction, asset efficiency.',
        'Marketing'                    => 'Evaluate on: Lead generation, campaign performance, market penetration, brand visibility, digital performance.',
        'IT / Digital Transformation'  => 'Evaluate on: Automation initiatives, ERP/system implementations, digital efficiency, cybersecurity, data quality.',
        'Other'                        => 'Evaluate on: Contribution to departmental objectives, cross-functional impact, process improvements, business goals.',
    ];

    public static function deptHint(?string $department): string
    {
        return self::DEPT_HINTS[$department] ?? self::DEPT_HINTS['Other'];
    }

    /**
     * The 20 behavioural parameters. 'years_tenure' is marked auto:true —
     * it is never rendered as a question screen; its score is always
     * derived server-side (and mirrored client-side for the live preview)
     * from the "Years with Company" answer. See scoreTenure().
     *
     * @return array<int, array<string, mixed>>
     */
    public static function params(): array
    {
        return [
            ['key' => 'years_tenure', 'label' => 'Years with Company', 'auto' => true],

            ['key' => 'drive_change', 'label' => 'Ability to Drive Change', 'options' => [
                ['score' => 1, 'text' => 'Shows little initiative towards change; needs constant direction'],
                ['score' => 0, 'text' => 'Blocks or actively resists implementation of changes'],
                ['score' => 4, 'text' => 'Adopts new technologies and ideas quickly and helps others adapt'],
                ['score' => 2, 'text' => 'Implements changes when instructed without significant resistance'],
                ['score' => 5, 'text' => 'Drives and champions new implementations and transformations across the organisation'],
                ['score' => 3, 'text' => 'Suggests process improvements and actively supports implementation'],
            ]],

            ['key' => 'ownership_mindset', 'label' => 'Ownership Mindset', 'options' => [
                ['score' => 4, 'text' => 'Consistently takes responsibility for outcomes beyond their immediate job description'],
                ['score' => 2, 'text' => 'Completes tasks when assigned; ownership limited to own immediate role'],
                ['score' => 0, 'text' => 'Deflects responsibility; blame-shifts or disengages from difficult outcomes'],
                ['score' => 3, 'text' => 'Reliable within defined scope; follows through on commitments without close supervision'],
                ['score' => 5, 'text' => 'Takes full ownership of outcomes — treats company problems as personal responsibilities, acts without being asked'],
                ['score' => 1, 'text' => 'Requires frequent follow-up; avoids accountability for outcomes'],
            ]],

            ['key' => 'strategic_contribution', 'label' => 'Strategic Contribution', 'options' => [
                ['score' => 0, 'text' => 'Actions misaligned with or counterproductive to business strategy'],
                ['score' => 1, 'text' => 'Focused entirely on operational tasks with no strategic involvement'],
                ['score' => 3, 'text' => 'Understands and aligns their function with strategic priorities; delivers meaningful outcomes'],
                ['score' => 5, 'text' => 'Plays a central role in shaping company strategy, market positioning, or critical business decisions'],
                ['score' => 4, 'text' => 'Contributes significantly to strategic planning and business direction within their function'],
                ['score' => 2, 'text' => 'Executes within defined functional goals; limited strategic input'],
            ]],

            ['key' => 'leadership_influence', 'label' => 'Leadership & Influence', 'options' => [
                ['score' => 1, 'text' => 'Minimal leadership footprint; primarily an individual contributor'],
                ['score' => 4, 'text' => 'Effectively leads a team, takes ownership of team outcomes and resolves conflicts constructively'],
                ['score' => 3, 'text' => 'Guides peers and juniors; beginning to demonstrate leadership in specific situations'],
                ['score' => 0, 'text' => 'Negative influence on team morale, performance or culture'],
                ['score' => 2, 'text' => 'Manages own work independently but limited team leadership or influence'],
                ['score' => 5, 'text' => 'Recognised leader who develops teams, influences decisions at a senior level and builds future leadership'],
            ]],

            ['key' => 'problem_solving', 'label' => 'Problem Solving Ability', 'options' => [
                ['score' => 4, 'text' => 'Resolves significant problems with structured thinking; seeks root causes, not just quick fixes'],
                ['score' => 5, 'text' => 'Independently identifies and solves complex, high-impact problems — often before they escalate'],
                ['score' => 3, 'text' => 'Handles routine problems effectively and escalates complex ones with context and options'],
                ['score' => 1, 'text' => 'Struggles to resolve even standard issues without significant support'],
                ['score' => 2, 'text' => 'Solves straightforward problems with guidance; limited ability to handle ambiguity'],
                ['score' => 0, 'text' => 'Avoids problems or creates escalations through inaction or poor decisions'],
            ]],

            ['key' => 'innovation', 'label' => 'Innovation & New Ideas', 'options' => [
                ['score' => 2, 'text' => 'Implements new ideas when directed but rarely initiates independently'],
                ['score' => 3, 'text' => 'Occasionally suggests new ideas and is open to experimenting with better approaches'],
                ['score' => 5, 'text' => 'Consistently generates and implements innovative ideas that create measurable business value'],
                ['score' => 1, 'text' => 'Resistant to new ideas; prefers existing methods even when ineffective'],
                ['score' => 0, 'text' => 'Actively discourages or dismisses innovation; creates barriers to new thinking'],
                ['score' => 4, 'text' => 'Regularly brings new ideas and successfully pilots at least some of them'],
            ]],

            ['key' => 'process_improvement', 'label' => 'Process Improvement Contribution', 'options' => [
                ['score' => 5, 'text' => 'Has led and successfully implemented process changes that significantly reduced time, cost or error rates'],
                ['score' => 3, 'text' => 'Actively participates in process improvement initiatives and contributes practical suggestions'],
                ['score' => 0, 'text' => 'Creates process inefficiencies or fails to follow established best practices'],
                ['score' => 4, 'text' => 'Identified and actioned process improvements that delivered measurable results'],
                ['score' => 2, 'text' => 'Follows improved processes when introduced but rarely initiates changes'],
                ['score' => 1, 'text' => 'Has not contributed to process improvement beyond basic job requirements'],
            ]],

            ['key' => 'cost_optimisation', 'label' => 'Cost Optimisation Contribution', 'options' => [
                ['score' => 2, 'text' => 'Works within budget but has not proactively contributed to cost reduction'],
                ['score' => 5, 'text' => 'Directly responsible for identifiable cost savings or efficiency gains with quantifiable impact'],
                ['score' => 0, 'text' => 'Actions have resulted in cost overruns, waste or financial losses to the business'],
                ['score' => 3, 'text' => 'Mindful of cost; makes reasonable trade-offs and avoids unnecessary expenditure'],
                ['score' => 1, 'text' => 'Operates without cost awareness; decisions frequently increase costs unnecessarily'],
                ['score' => 4, 'text' => 'Consistently makes cost-conscious decisions and has driven measurable savings in their area'],
            ]],

            ['key' => 'customer_impact', 'label' => 'Customer / Business Impact', 'options' => [
                ['score' => 3, 'text' => 'Contributes meaningfully to customer or business outcomes in their functional area'],
                ['score' => 2, 'text' => 'Has basic customer/business interactions; limited direct impact on outcomes'],
                ['score' => 0, 'text' => 'Actions have negatively impacted customers, relationships or business outcomes'],
                ['score' => 4, 'text' => 'Significant positive impact on customer satisfaction, retention or business outcomes'],
                ['score' => 5, 'text' => 'Directly responsible for winning, retaining or growing major customers or revenue streams'],
                ['score' => 1, 'text' => 'Minimal customer or business impact beyond basic function delivery'],
            ]],

            ['key' => 'learning_agility', 'label' => 'Learning Agility', 'options' => [
                ['score' => 4, 'text' => 'Proactively seeks learning; adapts quickly to new tools, methods and challenges'],
                ['score' => 3, 'text' => 'Open to learning when given opportunity; applies new knowledge reasonably well'],
                ['score' => 2, 'text' => 'Learns when required but rarely self-driven; takes time to adapt to new approaches'],
                ['score' => 0, 'text' => 'Refuses to adapt; learning avoidance causes disruption or quality issues'],
                ['score' => 5, 'text' => 'Continuously learns new skills, applies them rapidly and helps others upskill — adapts to any environment'],
                ['score' => 1, 'text' => 'Slow to learn new skills; resists changes to familiar ways of working'],
            ]],

            ['key' => 'reliability', 'label' => 'Reliability & Accountability', 'options' => [
                ['score' => 1, 'text' => 'Unreliable; frequent delays, missed deadlines or excuses instead of results'],
                ['score' => 5, 'text' => 'Exceptionally reliable — always delivers on commitments, owns outcomes completely, zero follow-up needed'],
                ['score' => 3, 'text' => 'Generally meets commitments; occasionally needs reminders but follows through'],
                ['score' => 4, 'text' => 'Highly reliable; delivers consistently with minimal supervision and takes responsibility for outcomes'],
                ['score' => 2, 'text' => 'Delivers basic responsibilities but inconsistent; misses deadlines occasionally'],
                ['score' => 0, 'text' => 'Has caused business damage through failure to deliver or by deflecting accountability'],
            ]],

            ['key' => 'cross_functional', 'label' => 'Cross Functional Contribution', 'options' => [
                ['score' => 5, 'text' => 'Actively collaborates across departments; drives cross-functional projects that deliver business value'],
                ['score' => 3, 'text' => 'Participates in cross-functional work when asked; good interdepartmental relationships'],
                ['score' => 0, 'text' => 'Actions have damaged cross-functional relationships or created inter-departmental conflict'],
                ['score' => 4, 'text' => 'Works effectively with other teams; is sought out as a collaborator beyond their own department'],
                ['score' => 1, 'text' => 'Rarely engages with other departments; creates friction or communication barriers'],
                ['score' => 2, 'text' => 'Primarily works in silo; limited cross-functional engagement'],
            ]],

            ['key' => 'future_leadership', 'label' => 'Future Leadership Potential', 'options' => [
                ['score' => 2, 'text' => 'May grow into a modestly larger role but limited trajectory beyond current level'],
                ['score' => 1, 'text' => 'Unlikely to progress beyond current role in the foreseeable future'],
                ['score' => 4, 'text' => 'Strong leadership trajectory; demonstrating progressive capability with visible growth'],
                ['score' => 0, 'text' => 'Negative trajectory — performance or behaviour suggests regression risk'],
                ['score' => 3, 'text' => 'Shows potential for growth into a larger role over the medium term with the right support'],
                ['score' => 5, 'text' => 'Clear high-potential candidate — ready or near-ready to take on a significantly larger leadership role'],
            ]],

            ['key' => 'retention_importance', 'label' => 'Retention Importance', 'options' => [
                ['score' => 0, 'text' => 'Retention is not a priority; departure may actually benefit the organisation'],
                ['score' => 3, 'text' => 'Important to retain; departure would cause meaningful disruption but is manageable with planning'],
                ['score' => 2, 'text' => 'Moderate retention importance; departure would be inconvenient but manageable'],
                ['score' => 4, 'text' => 'High retention priority — departure would cause significant disruption and performance risk'],
                ['score' => 5, 'text' => 'Losing this person would create a severe, immediate business impact — critical to retain at any reasonable cost'],
                ['score' => 1, 'text' => 'Limited retention urgency; role can be refilled relatively easily'],
            ]],

            ['key' => 'replacement_difficulty', 'label' => 'Replacement Difficulty', 'options' => [
                ['score' => 4, 'text' => 'Hard to replace within a short timeframe; requires significant hiring and transition effort'],
                ['score' => 3, 'text' => 'Replaceable but requires 3–6 months of hiring and onboarding effort'],
                ['score' => 1, 'text' => 'Easily replaceable from external market; standard skill set'],
                ['score' => 2, 'text' => 'Can be replaced within 1–3 months with reasonable effort'],
                ['score' => 5, 'text' => 'Extremely difficult to replace — rare skill set, deep institutional knowledge and/or domain expertise'],
                ['score' => 0, 'text' => 'No meaningful replacement difficulty; role can be absorbed or backfilled immediately'],
            ]],

            ['key' => 'knowledge_contribution', 'label' => 'Knowledge Contribution', 'options' => [
                ['score' => 3, 'text' => 'Good functional knowledge; shares when asked and contributes to team capability'],
                ['score' => 2, 'text' => 'Adequate knowledge for the role; limited knowledge-sharing beyond immediate needs'],
                ['score' => 5, 'text' => 'Holds critical institutional or technical knowledge; actively documents, trains and transfers knowledge to others'],
                ['score' => 4, 'text' => 'Deep functional knowledge with significant knowledge-sharing behaviour across the team'],
                ['score' => 0, 'text' => 'Hoards knowledge, withholds information or has caused knowledge gaps'],
                ['score' => 1, 'text' => 'Knowledge concentration risk — does not share; creates single points of failure'],
            ]],

            ['key' => 'cultural_contribution', 'label' => 'Cultural Contribution', 'options' => [
                ['score' => 4, 'text' => 'Strong cultural alignment; positive influence on team morale and organisational values'],
                ['score' => 2, 'text' => 'Adequate cultural fit; neutral impact on culture'],
                ['score' => 0, 'text' => 'Actively toxic — behaviours damage culture, morale or team cohesion'],
                ['score' => 1, 'text' => 'Cultural misfit — values or behaviours occasionally create dissonance with the organisation'],
                ['score' => 3, 'text' => 'Generally aligned with values; positive presence without being a visible culture driver'],
                ['score' => 5, 'text' => 'Culture carrier — embodies company values, sets the tone for others and actively builds a positive culture'],
            ]],

            ['key' => 'value_creation', 'label' => 'Value Creation for Business', 'options' => [
                ['score' => 0, 'text' => 'Net negative — has cost the business more than they have contributed'],
                ['score' => 2, 'text' => 'Maintains value but does not significantly grow it'],
                ['score' => 3, 'text' => 'Contributes to value creation in a meaningful but supporting capacity'],
                ['score' => 5, 'text' => 'Has directly and demonstrably created significant business value — revenue, cost savings, IP, partnerships or capability'],
                ['score' => 4, 'text' => 'Consistently creates meaningful value across their domain with traceable business outcomes'],
                ['score' => 1, 'text' => 'Limited value creation beyond role requirements'],
            ]],

            ['key' => 'dept_contribution', 'label' => 'Department Contribution / Functional Impact', 'deptSpecific' => true, 'options' => [
                ['score' => 1, 'text' => 'Below-expectation departmental performance — functional output is inconsistent or falls short of department standards'],
                ['score' => 2, 'text' => 'Basic contribution — meets minimum departmental expectations; contribution is adequate but limited in scope or impact'],
                ['score' => 5, 'text' => 'Exceptional departmental impact — has measurably transformed functional outcomes (e.g. revenue growth, cost reduction, process breakthroughs, quality improvement) with quantifiable results attributed directly to this person'],
                ['score' => 3, 'text' => 'Good departmental contribution — reliably meets functional objectives and contributes to departmental goals; outputs are solid but incremental rather than transformative'],
                ['score' => 4, 'text' => 'Strong functional contributor — consistently delivers above-expectation results within their department; outputs have directly improved business performance metrics'],
                ['score' => 0, 'text' => 'Negative departmental impact — actions, decisions or behaviour have harmed departmental outcomes, team morale or functional performance'],
            ]],
        ];
    }

    /**
     * All 19 non-auto (user-answered) parameters, in order.
     */
    public static function askedParams(): array
    {
        return array_values(array_filter(self::params(), fn ($p) => empty($p['auto'])));
    }

    /**
     * All 20 parameter keys, in order (including years_tenure).
     */
    public static function allKeys(): array
    {
        return array_column(self::params(), 'key');
    }

    /**
     * The 19 user-answered parameter keys.
     */
    public static function askedKeys(): array
    {
        return array_column(self::askedParams(), 'key');
    }

    /**
     * Derive the 0-5 tenure score from years-with-company. Never trust a
     * client-submitted score for this parameter — always recompute here.
     */
    public static function scoreTenure(float $years): int
    {
        if ($years >= 10) {
            return 5;
        }
        if ($years >= 6) {
            return 4;
        }
        if ($years >= 3) {
            return 3;
        }
        if ($years >= 1) {
            return 2;
        }
        if ($years > 0) {
            return 1;
        }

        return 0;
    }

    /**
     * Qualitative label for a total score out of 100.
     */
    public static function scoreLabel(int $totalScore): string
    {
        if ($totalScore >= 90) {
            return 'Exceptional';
        }
        if ($totalScore >= 75) {
            return 'Strong';
        }
        if ($totalScore >= 60) {
            return 'Good / Solid';
        }
        if ($totalScore >= 40) {
            return 'Developing';
        }

        return 'Early-stage / Foundational';
    }
}
