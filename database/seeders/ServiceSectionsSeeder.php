<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

/**
 * Seeds section-driven content for GCC, M&A Advisory, and Deals/Due Diligence service pages.
 *
 * Run: php artisan db:seed --class=ServiceSectionsSeeder
 *
 * This seeder is safe to run multiple times — it deletes existing sections for each
 * matched service before re-inserting, so you won't get duplicates.
 *
 * Slug matching:  partial case-insensitive match on the slug column.
 * If your slugs differ, update the $map keys below.
 */
class ServiceSectionsSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'gcc'                  => $this->gccSections(),
            'ma-advisory'          => $this->maSections(),
            'due-diligence'        => $this->dealsSections(),
        ];

        foreach ($map as $slugFragment => $sections) {
            $service = Service::where('slug', 'like', "%{$slugFragment}%")->first();

            if (! $service) {
                $this->command->warn("Service with slug containing '{$slugFragment}' not found — skipping.");
                continue;
            }

            // Wipe existing sections so we can re-seed cleanly
            $service->sections()->delete();

            foreach ($sections as $i => $section) {
                $service->sections()->create([
                    'section_type' => $section['type'],
                    'section_data' => $section['data'],
                    'sort_order'   => $i,
                    'is_active'    => true,
                ]);
            }

            $this->command->info("Seeded " . count($sections) . " sections for: {$service->title}");
        }
    }

    /* ─────────────────────────────────────────────────────────────────────
     * GCC — Global Capability Centers
     * ───────────────────────────────────────────────────────────────────── */
    private function gccSections(): array
    {
        return [
            [
                'type' => 'hero',
                'data' => [
                    'label'    => 'GCC (Global Capability Centers)',
                    'title'    => 'Reliable, Compliant, End-to-End Corporate Financial Operations from India',
                    'subtitle' => 'Dev Mantra provides fully managed accounting and financial operations for startups, SMEs, and professional service firms worldwide — helping global companies streamline bookkeeping, investment banking, reporting, compliance, and finance operations with accuracy, speed, and trust.',
                    'cta_text' => 'Book a Consultation',
                    'cta_url'  => '#contact',
                ],
            ],
            [
                'type' => 'overview',
                'data' => [
                    'title'        => 'Empower Your Business with GCC Services by Dev Mantra',
                    'description'  => 'At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation. Our mission is to deliver top-notch global financial and management consulting services that are tailored to meet the unique needs of our clients worldwide. Our growth strategy includes not just strengthening business processes and reporting — it expands into building new business synergies, verticals, geographies, and complementary partnerships globally.',
                    'description2' => 'From daily bookkeeping to compliance, payroll, cost optimization, and investment-readiness — our team ensures your financial backbone stays strong and scalable. Whether you are a fast-growing startup or an established enterprise, Dev Mantra\'s India-based capability centers give you the delivery infrastructure to operate at scale, without the overhead.',
                ],
            ],
            [
                'type' => 'cpa-reality',
                'data' => [
                    'eyebrow'              => 'Built Specifically for U.S. CPA Firms',
                    'title'                => 'The Profession Is Under Structural Pressure. We Built the Answer.',
                    'opening'              => 'The U.S. CPA profession is navigating a period of sustained structural challenge — not a cyclical dip, but a fundamental shift in how audit and advisory capacity must be sourced, managed, and governed.',
                    'pressure_points'      => [
                        'CPA talent shortage crisis',
                        'Rising audit complexity',
                        'Increased PCAOB scrutiny',
                        'Margin compression',
                        'Partner burnout',
                    ],
                    'description'          => 'Staff attrition running at 20–30%. Seasonal hiring pressure every quarter. Manual audit processes slowing delivery. High cost per audit hour compressing margins. Traditional offshoring was never built to solve this.',
                    'old_model_title'      => 'The Old Model',
                    'old_model_description'=> 'Low-cost BPO, weak audit documentation, no regulatory alignment, and poor data security — created rework, review fatigue, and audit defensibility risks. It replaced one problem with several others.',
                    'shift_title'          => 'The Shift',
                    'shift_description'    => 'From Labor Arbitrage → To Automation-First + Audit-Grade Governance. Standardized digital workflows, AI-based audit documentation, secure cloud environments, structured QA layers, and risk-based documentation templates. Automation + Governance = Audit Defensibility.',
                ],
            ],
            [
                'type' => 'three-layer',
                'data' => [
                    'title'        => 'Scaling Audit & Advisory Through Automation + Expert Delivery',
                    'description'  => 'Dev Mantra helps U.S. CPA firms address structural pressures by building India-based, audit-grade capability teams that expand capacity without increasing domestic headcount. Through AI-enabled workflows, standardized documentation, and risk-based frameworks, the firm manages rising audit complexity while aligning governance and quality controls with PCAOB standards.',
                    'description2' => 'Its automation-first delivery model reduces cost per audit hour and improves turnaround time, protecting margins. By taking on execution-heavy audit and compliance work, Dev Mantra frees partners to focus on advisory, client relationships, and strategic growth — significantly reducing burnout.',
                    'description3' => 'We move beyond traditional outsourcing toward a structured Global Capability Center model designed specifically for CPA firms.',
                    'note'         => 'Dev Mantra is a long-term capability hub — not a vendor.',
                    'layers'       => [
                        [
                            'number'   => '1',
                            'title'    => 'Automation Engine',
                            'subtitle' => '(Technology)',
                            'points'   => ['AI-based audit tools', 'Workflow orchestration', 'Automated sampling', 'Smart document management', 'Exception tracking dashboards'],
                        ],
                        [
                            'number'   => '2',
                            'title'    => 'Expert Delivery Team',
                            'subtitle' => '(India — Led by Dev Mantra with governance support from N. Tatia & Associates)',
                            'points'   => ['Audit associates', 'Tax compliance specialists', 'Financial reporting analysts', 'Data & analytics team', 'Internal QA reviewers'],
                        ],
                        [
                            'number'   => '3',
                            'title'    => 'CPA Partner Oversight',
                            'subtitle' => '(USA)',
                            'points'   => ['Final review', 'Client advisory', 'Regulatory sign-off', 'PCAOB-aligned documentation review'],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'process-steps',
                'data' => [
                    'title'       => 'Our Automation-Led Execution Framework',
                    'description' => 'Our framework integrates intelligent workflows, AI-enabled audit tools, and standardized digital documentation to deliver accuracy, speed, and regulatory defensibility at scale.',
                    'steps'       => [
                        ['number' => '01', 'stage' => 'Digital Intake & Workflow Orchestration', 'description' => 'Standardized digital checklists and workflow engines that auto-assign tasks, track evidence submission, monitor SLA compliance, and provide real-time audit dashboards.', 'value' => '20–30% reduction in coordination time'],
                        ['number' => '02', 'stage' => 'AI-Enabled Audit Documentation', 'description' => 'Automated lead schedules, trial balance mapping, smart sampling, exception flagging, and AI-based workpaper indexing.', 'value' => 'Lower review notes, faster audit cycles, improved defensibility'],
                        ['number' => '03', 'stage' => 'Secure Cloud Audit Environment', 'description' => 'Role-based access control, encrypted document vault, controlled client data rooms, and full audit trail maintained throughout.', 'value' => 'PCAOB-ready documentation integrity'],
                        ['number' => '04', 'stage' => 'Structured QA & Governance Framework', 'description' => 'With oversight from N. Tatia & Associates: 2-level India review, U.S. CPA-aligned templates, risk-based testing matrix, and engagement quality control checklists.', 'value' => 'Reduced regulatory exposure'],
                        ['number' => '05', 'stage' => 'Advisory Enablement Layer', 'description' => 'Because delivery is automated, partners spend less time reviewing and more time advising — improving realization rates and client retention.', 'value' => 'Higher partner bandwidth. Stronger client relationships.'],
                    ],
                    'metrics' => [
                        ['metric' => 'Audit turnaround', 'outcome' => '25–40% faster'],
                        ['metric' => 'Cost efficiency', 'outcome' => '40–60% improvement'],
                        ['metric' => 'Cost per engagement', 'outcome' => '20–35% reduction'],
                        ['metric' => 'Work cycles', 'outcome' => '24-hour progression'],
                        ['metric' => 'Documentation accuracy', 'outcome' => '99% (QA framework)'],
                        ['metric' => 'Engagement capacity', 'outcome' => '50% increase'],
                    ],
                ],
            ],
            [
                'type' => 'comparison-table',
                'data' => [
                    'title'         => 'Automation Handles Execution. Partners Handle Judgment.',
                    'column1_title' => 'Automated by Dev Mantra',
                    'column2_title' => 'Retained by CPA Partner',
                    'rows'          => [
                        ['Data ingestion', 'Client relationship'],
                        ['Workpaper preparation', 'Risk judgment'],
                        ['Reconciliations', 'Audit opinion'],
                        ['Tax computation', 'Strategic advisory'],
                        ['Compliance checklists (ISO 27001, HIPAA, SOC, SOX)', 'Final sign-off'],
                        ['Audit trail documentation', 'Governance oversight'],
                    ],
                ],
            ],
            [
                'type' => 'engagement-models',
                'data' => [
                    'title'           => 'Engagement Models — Choose What Works for You',
                    'standard_label'  => 'All Clients',
                    'cpa_label'       => 'CPA Firms',
                    'standard_models' => [
                        ['title' => 'Process Outsourcing Model', 'description' => 'Your finance and accounting operations are fully handled by our team end-to-end. We manage processes continuously with defined SLAs, reporting, and quality controls.', 'best_for' => 'Companies seeking a complete outsourced finance function'],
                        ['title' => 'Offshore Process Model', 'description' => 'A dedicated offshore team in India working exclusively for your company — operating as an extension of your in-house finance function at significantly lower cost.', 'best_for' => 'Businesses that want an embedded India team without setup complexity'],
                        ['title' => 'Job by Job Model', 'description' => 'You assign specific tasks — reconciliations, cleanups, payroll, or filings — as needed. Ideal for ad-hoc, short-term, or project-based financial work.', 'best_for' => 'Companies with variable workloads or one-time requirements'],
                        ['title' => 'Build Operate Transfer (BOT)', 'description' => 'We set up and run a fully operational finance team for you in India. Once systems stabilize and quality benchmarks are met, control is transferred to your organization.', 'best_for' => 'Enterprises planning a permanent India presence'],
                    ],
                    'cpa_models' => [
                        ['title' => 'Model A — Dedicated GCC', 'description' => 'A full India audit team, long-term engagement, and a custom automation stack built around your firm\'s workflows and regulatory requirements.', 'best_for' => 'Firms with consistent, high-volume audit and compliance work'],
                        ['title' => 'Model B — Hybrid Model', 'description' => 'A core automation engine combined with seasonal capacity scaling — ramping up during peak periods without long-term headcount commitments.', 'best_for' => 'Firms with seasonal audit peaks or variable workloads'],
                        ['title' => 'Model C — Managed Automation Service', 'description' => 'Process transformation and technology implementation support — without a full team build. We configure and manage the automation stack; your team handles delivery.', 'best_for' => 'Firms looking to modernize workflows before committing to a full GCC'],
                    ],
                ],
            ],
            [
                'type' => 'pillars',
                'data' => [
                    'title'   => 'What Makes Our GCC Model Work',
                    'pillars' => [
                        ['title' => 'Automation-First Delivery', 'points' => ['AI-enabled audit workflows', '24-hour audit cycle capability', 'AI-enabled documentation & testing', 'Structured QA & defensible audit framework']],
                        ['title' => 'Talent Advantage', 'points' => ['Strong US GAAP & IFRS knowledge', 'English fluency across all delivery teams', 'Dedicated specialised pods', 'Trained workforce with adequate depth and bench']],
                        ['title' => 'Infrastructure Strength', 'points' => ['Mature IT ecosystem and cybersecurity frameworks', 'Secure cloud adoption maturity', 'SOC 2 compliant infrastructure', 'Role-based access and encrypted document environments', '40–60% cost advantage vs. U.S. domestic delivery']],
                    ],
                ],
            ],
            [
                'type' => 'trust-signals',
                'data' => [
                    'title' => 'Why Trust Us',
                    'items' => [
                        ['icon' => 'fa-solid fa-circle-check', 'label' => 'Accuracy you can trust — 3-level quality checks'],
                        ['icon' => 'fa-solid fa-screwdriver-wrench', 'label' => 'Industry-standard tools (Xero, QBO, Tally, Zoho, SAP)'],
                        ['icon' => 'fa-solid fa-coins', 'label' => 'Cost-effective global finance team — 50–70% cost savings'],
                        ['icon' => 'fa-solid fa-lock', 'label' => 'Secure data handling — NDA + encrypted file exchange'],
                        ['icon' => 'fa-solid fa-clock', 'label' => 'Time-zone aligned support (US, UK, Australia, UAE, South East Asia)'],
                        ['icon' => 'fa-solid fa-chart-line', 'label' => 'Scalable operations — from 10 to 10,000 transactions/month'],
                    ],
                ],
            ],
            [
                'type' => 'why-stand-out',
                'data' => [
                    'title' => "Why Dev Mantra's GCC Services Stand Out",
                    'items' => [
                        ['icon' => 'fa-solid fa-earth-asia', 'title' => 'Local Expertise with a Global Perspective', 'description' => 'Our team combines in-depth knowledge of the Indian market with a global outlook, ensuring strategies that are both locally relevant and internationally informed.'],
                        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Comprehensive Support Across All Stages', 'description' => 'From initial market entry to ongoing expansion, Dev Mantra offers end-to-end support, guiding you through every phase of your business journey in India.'],
                        ['icon' => 'fa-solid fa-sliders', 'title' => 'Tailored Solutions for Your Unique Needs', 'description' => 'We customize our services to address the specific challenges and opportunities of your business, providing solutions that are precise and effective for your goals.'],
                        ['icon' => 'fa-solid fa-handshake', 'title' => 'Strong Network and Proven Track Record', 'description' => 'Leveraging our extensive local network and successful track record, we facilitate connections and deliver results that enhance your market presence and drive growth.'],
                    ],
                ],
            ],
            [
                'type' => 'markets-served',
                'data' => [
                    'title'   => 'Markets Served',
                    'markets' => ['USA', 'Europe', 'Korea', 'Japan', 'Singapore', 'Dubai', 'Abu Dhabi', 'Australia', 'New Zealand'],
                ],
            ],
            [
                'type' => 'governance',
                'data' => [
                    'title'   => 'Governance, Security & Audit Defensibility',
                    'columns' => [
                        ['title' => 'Security Framework', 'items' => ['SOC 2 compliant infrastructure', 'Role-based access control', 'Encrypted document environments', 'Audit logs & full traceability']],
                        ['title' => 'Regulatory Alignment', 'items' => ['PCAOB documentation standards', 'AICPA peer review readiness', 'Engagement quality control checklists', 'Risk-based documentation templates']],
                    ],
                    'disclaimer' => 'Dev Mantra Financial Services Pvt. Ltd. + N. Tatia & Associates do not offer traditional outsourcing. We build automation-led audit capability centers, governance-aligned compliance engines, and structured GCC models for U.S. CPA firms. We don\'t replace CPA judgment. We enhance CPA capacity.',
                ],
            ],
            [
                'type' => 'faq',
                'data' => [
                    'title'    => "Any Questions? We've Got You.",
                    'subtitle' => "Find answers to common questions about Dev Mantra's GCC and financial operations services.",
                    'items'    => [
                        ['question' => 'What finance and accounting services does Dev Mantra offer through its GCC model?', 'answer' => 'Dev Mantra provides end-to-end outsourced accounting, bookkeeping, financial reporting, audit support, tax compliance, payroll, virtual CFO services, and M&A support — all delivered through a structured India-based capability center with defined SLAs, quality controls, and governance oversight.'],
                        ['question' => 'How does Dev Mantra ensure data security and confidentiality?', 'answer' => 'All engagements are covered by NDAs. We operate on a SOC 2 compliant infrastructure with role-based access control, encrypted document vaults, controlled data rooms, and full audit trails. Our security framework is aligned to ISO 27001, HIPAA, and PCAOB documentation standards where applicable.'],
                        ['question' => 'What is the cost advantage of using Dev Mantra\'s India-based GCC?', 'answer' => 'Clients typically realize a 40–60% cost advantage compared to equivalent U.S. domestic delivery, and 50–70% overall cost savings across finance and accounting operations. This is achieved through India\'s talent cost differential, automation-led delivery, and efficient team structures — without compromising quality.'],
                        ['question' => 'How does Dev Mantra handle regulatory compliance for U.S. CPA firms?', 'answer' => 'Our delivery model is specifically designed for U.S. regulatory environments — including PCAOB standards, AICPA peer review readiness, SOX and SOC compliance, and GAAP-aligned documentation. N. Tatia & Associates provides the governance overlay and multi-level review structure that ensures audit defensibility at every stage.'],
                        ['question' => 'What engagement model is right for our firm?', 'answer' => 'It depends on your volume, seasonality, and long-term objectives. We offer four standard models (Process Outsourcing, Offshore Process, Job by Job, and Build-Operate-Transfer) and three CPA-specific models (Dedicated GCC, Hybrid, and Managed Automation Service). Our team typically runs a scoping call to recommend the right fit before any commitment is made.'],
                    ],
                ],
            ],
            [
                'type' => 'other-services',
                'data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing', 'url' => '/services/finance-accounts-compliance-outsourcing'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory'],
                        ['label' => 'IPO Advisory Services', 'url' => '/services/ipo-advisory'],
                        ['label' => 'Virtual CFO Services', 'url' => '/services/virtual-cfo'],
                        ['label' => 'M&A Advisory Services', 'url' => '/services/ma-advisory'],
                        ['label' => 'Business Setup & Startup Collaboration', 'url' => '/services/business-setup'],
                        ['label' => 'Corporate Governance', 'url' => '/services/corporate-governance'],
                    ],
                ],
            ],
        ];
    }

    /* ─────────────────────────────────────────────────────────────────────
     * M&A Advisory Services
     * ───────────────────────────────────────────────────────────────────── */
    private function maSections(): array
    {
        return [
            [
                'type' => 'hero',
                'data' => [
                    'label'       => 'M&A Advisory Services',
                    'title'       => 'Navigating Mergers & Acquisitions with Precision and Purpose',
                    'subtitle'    => 'Dev Mantra provides expert M&A advisory services, assisting businesses in achieving successful mergers and acquisitions. We offer strategic insights and personalized solutions to ensure smooth transactions and optimal outcomes for our clients.',
                    'cta_text'    => 'Talk to an M&A Expert',
                    'cta_url'     => '#contact',
                ],
            ],
            [
                'type' => 'overview',
                'data' => [
                    'title'        => 'Unlock Growth with Premier M&A Advisory Services',
                    'description'  => 'At Dev Mantra, our M&A Advisory Services are designed to help businesses navigate the complex landscape of mergers and acquisitions. We bring strategic expertise and industry insights to ensure each transaction aligns with your growth objectives. Our team of seasoned professionals collaborates closely with clients, offering tailored solutions that address unique challenges and opportunities.',
                    'description2' => 'Every M&A transaction is more than a financial event. It is a strategic inflection point. Dev Mantra\'s role is to ensure that inflection point becomes an advantage — with the rigour, preparation, and cross-functional depth your deal deserves.',
                    'cta_text'     => 'Connect with Our Experts',
                    'cta_url'      => '#contact',
                ],
            ],
            [
                'type' => 'services-grid',
                'data' => [
                    'title' => 'M&A Advisory Services Offered by Dev Mantra',
                    'items' => [
                        ['title' => 'M&A Advisory — Buy & Integrate', 'icon' => 'fa-solid fa-handshake', 'description' => 'We provide comprehensive buy-side advisory, guiding businesses through target identification, valuation, negotiation, and post-merger integration. Our structured approach ensures that acquisitions are not just completed — they are embedded effectively into your business to deliver the intended value.'],
                        ['title' => 'Reshaping Results — Strategic M&A Planning', 'icon' => 'fa-solid fa-chess', 'description' => 'Every successful transaction begins long before term sheets are signed. We work with leadership teams to define transaction rationale, evaluate strategic fit, and build the business case that forms the backbone of a credible deal process.'],
                        ['title' => 'Divestment Strategy — Sell & Separate', 'icon' => 'fa-solid fa-arrow-right-from-bracket', 'description' => 'Our sell-side advisory covers the full divestment lifecycle — from carve-out planning and asset preparation to buyer identification, process management, and deal closure. We help you separate cleanly, position well, and negotiate terms that reflect the true value of what you\'re offering.'],
                        ['title' => 'Corporate Finance Consulting', 'icon' => 'fa-solid fa-building-columns', 'description' => 'We offer comprehensive corporate finance consulting services, including capital raising, debt restructuring, and financial modelling to support your M&A initiatives. Our advisory helps align capital structure with the strategic demands of the transaction.'],
                        ['title' => 'Infrastructure Advisory & Consulting', 'icon' => 'fa-solid fa-building', 'description' => 'Dev Mantra provides specialised advice on infrastructure investments and project finance — ensuring that your projects are evaluated for financial soundness, risk-adjusted returns, and operational viability before capital is committed.'],
                        ['title' => 'M&A Tools — Connected Capital Technologies', 'icon' => 'fa-solid fa-microchip', 'description' => 'We leverage advanced M&A tools and technologies to streamline transactions, improve decision-making, and enhance the efficiency of your capital management processes. From data room management to deal analytics, we bring the right technology to every stage of the process.'],
                    ],
                ],
            ],
            [
                'type' => 'process-steps',
                'data' => [
                    'title'       => 'Our M&A Process — From First Call to Deal Close',
                    'description' => 'A structured, disciplined approach is what separates a smooth transaction from a complicated one. Here is how we work.',
                    'steps'       => [
                        ['number' => '01', 'stage' => 'Discovery & Mandate', 'description' => 'Understand your strategic intent, define objectives, and structure the engagement.'],
                        ['number' => '02', 'stage' => 'Preparation & Positioning', 'description' => 'Financial analysis, valuation, information memorandum, and deal readiness.'],
                        ['number' => '03', 'stage' => 'Market Approach', 'description' => 'Identify and approach suitable targets or buyers; manage the outreach process confidentially.'],
                        ['number' => '04', 'stage' => 'Negotiation & Structuring', 'description' => 'Lead or support negotiations, structure deal terms, and manage due diligence.'],
                        ['number' => '05', 'stage' => 'Closure & Integration', 'description' => 'Coordinate signing, regulatory filings, and post-deal integration or separation planning.'],
                    ],
                ],
            ],
            [
                'type' => 'why-stand-out',
                'data' => [
                    'title' => "Why Dev Mantra's M&A Advisory Services Stand Out",
                    'items' => [
                        ['icon' => 'fa-solid fa-graduation-cap', 'title' => 'Industry Expertise', 'description' => "Dev Mantra's seasoned professionals provide deep insights and strategic advice tailored to each client's unique needs — across sectors, deal sizes, and transaction types."],
                        ['icon' => 'fa-solid fa-microchip', 'title' => 'Advanced Tools & Technologies', 'description' => 'Our use of cutting-edge M&A tools and connected capital technologies streamlines transactions, improves decision-making, and gives our clients an edge at every stage of the deal process.'],
                        ['icon' => 'fa-solid fa-sliders', 'title' => 'Personalized Solutions', 'description' => 'We offer customized M&A strategies that align with your specific business goals, risk appetite, and stakeholder expectations — ensuring optimal outcomes rather than generic process outputs.'],
                        ['icon' => 'fa-solid fa-trophy', 'title' => 'Proven Track Record', 'description' => 'With a history of successful transactions and over ₹5,000 crore in deals advised, Dev Mantra consistently delivers measurable results — making us a trusted partner in M&A advisory.'],
                    ],
                ],
            ],
            [
                'type' => 'faq',
                'data' => [
                    'title'    => "Any Questions? We've Got You.",
                    'subtitle' => "Find answers to common questions about Dev Mantra's M&A advisory services.",
                    'items'    => [
                        ['question' => 'What types of M&A transactions does Dev Mantra advise on?', 'answer' => 'Dev Mantra advises on a full range of transactions including mergers, acquisitions, divestitures, joint ventures, management buyouts, and strategic partnerships — across sectors and transaction sizes. Our team works with both buy-side and sell-side clients.'],
                        ['question' => 'How does Dev Mantra determine the valuation of a business in an M&A deal?', 'answer' => 'We use a combination of valuation methodologies including Discounted Cash Flow (DCF) analysis, comparable company analysis, precedent transaction multiples, and asset-based approaches — selecting the most appropriate method based on the nature of the business and the deal context.'],
                        ['question' => 'What is the typical timeline for an M&A transaction?', 'answer' => 'Timelines vary depending on deal complexity, due diligence requirements, and regulatory approvals. A straightforward transaction may close in 3–6 months, while more complex cross-border deals can take 9–18 months. Dev Mantra structures clear milestones at the outset to keep the process on track.'],
                        ['question' => 'How does Dev Mantra support post-merger integration?', 'answer' => 'We assist with integration planning across functions — finance, operations, compliance, and reporting. Our focus is on ensuring the merged entity operates with a unified control environment, clear accountability structures, and the financial discipline needed to realize deal synergies.'],
                        ['question' => 'Does Dev Mantra handle cross-border M&A transactions?', 'answer' => 'Yes. Our team has experience navigating multi-jurisdictional M&A, including FEMA compliance, RBI approvals, transfer pricing considerations, and cross-border due diligence — supporting inbound and outbound transactions for Indian and international clients.'],
                    ],
                ],
            ],
            [
                'type' => 'other-services',
                'data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing', 'url' => '/services/finance-accounts-compliance-outsourcing'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory'],
                        ['label' => 'IPO Advisory Services', 'url' => '/services/ipo-advisory'],
                        ['label' => 'Virtual CFO Services', 'url' => '/services/virtual-cfo'],
                        ['label' => 'GCC (Global Capability Centers)', 'url' => '/services/gcc'],
                        ['label' => 'Business Setup & Startup Collaboration', 'url' => '/services/business-setup'],
                        ['label' => 'Corporate Governance', 'url' => '/services/corporate-governance'],
                    ],
                ],
            ],
        ];
    }

    /* ─────────────────────────────────────────────────────────────────────
     * Deals, Due Diligence & Transaction Advisory
     * ───────────────────────────────────────────────────────────────────── */
    private function dealsSections(): array
    {
        return [
            [
                'type' => 'hero',
                'data' => [
                    'label'       => 'Deals, Due Diligence & Transaction Advisory',
                    'title'       => "Know What You're Getting Into — Before You Commit",
                    'subtitle'    => "Dev Mantra's Deals, Due Diligence & Transaction Advisory Services provide comprehensive support for mergers, acquisitions, and investments — ensuring informed decision-making at every critical stage.",
                    'description' => 'Thorough financial analysis, rigorous risk assessment, and strategic transaction guidance — from first look to final close.',
                    'cta_text'    => 'Start Your Due Diligence',
                    'cta_url'     => '#contact',
                ],
            ],
            [
                'type' => 'overview',
                'data' => [
                    'title'        => 'Start Your Financial Due Diligence Now with Dev Mantra',
                    'description'  => 'Unlock the power of expert financial analysis with Dev Mantra. Our dedicated team of financial specialists is ready to streamline your due diligence process through cutting-edge virtual solutions. Whether you\'re navigating complex investments, evaluating potential acquisitions, or assessing partnership opportunities — our comprehensive due diligence services ensure accuracy and efficiency at every step.',
                    'description2' => 'Every transaction carries risk. The quality of due diligence performed before a deal closes determines not just the price you pay, but the value you realize — and the surprises you avoid. Dev Mantra brings structured methodology, experienced professionals, and a forensic level of financial rigour to every engagement.',
                ],
            ],
            [
                'type' => 'services-grid',
                'data' => [
                    'title' => 'Due Diligence & Transaction Advisory Services Offered by Dev Mantra',
                    'items' => [
                        ['title' => 'Financial Due Diligence', 'icon' => 'fa-solid fa-chart-bar', 'description' => 'Comprehensive review of financial statements and records.', 'points' => ['Assessment of revenue streams, profitability, and cash flow', 'Evaluation of financial projections and underlying assumptions']],
                        ['title' => 'Operational Due Diligence', 'icon' => 'fa-solid fa-gears', 'description' => 'Analysis of business operations and workflow efficiency.', 'points' => ['Examination of supply chain management and logistics', 'Review of organizational structure and human resources']],
                        ['title' => 'Commercial Due Diligence', 'icon' => 'fa-solid fa-store', 'description' => 'Market analysis to assess competitive positioning.', 'points' => ['Customer and supplier contract evaluations', 'Review of sales and marketing strategies']],
                        ['title' => 'Tax Due Diligence', 'icon' => 'fa-solid fa-file-invoice-dollar', 'description' => 'Analysis of tax compliance and liabilities.', 'points' => ['Review of historical tax returns and future tax obligations', 'Identification of potential tax risks and mitigation strategies']],
                        ['title' => 'Legal Due Diligence', 'icon' => 'fa-solid fa-scale-balanced', 'description' => 'Examination of corporate governance and legal structure.', 'points' => ['Review of pending or potential litigation and regulatory issues', 'Analysis of intellectual property rights and contractual obligations']],
                        ['title' => 'Transaction Advisory Services', 'icon' => 'fa-solid fa-handshake', 'description' => 'Assistance with mergers, acquisitions, and divestitures.', 'points' => ['Valuation services for businesses and assets', 'Support in deal structuring, negotiation, and closing processes']],
                        ['title' => 'Investor Representation', 'icon' => 'fa-solid fa-user-tie', 'description' => 'Tailored due diligence to safeguard investor interests.', 'points' => ['Ensure alignment with investment objectives', 'Provide strategic insights to support informed investment decisions']],
                        ['title' => 'Fund Representation', 'icon' => 'fa-solid fa-building-columns', 'description' => 'Detailed analysis to protect fund assets.', 'points' => ['Ensure compliance with fund policies and mandates', 'Evaluate potential investments to optimize fund performance']],
                        ['title' => 'Risk Assessment', 'icon' => 'fa-solid fa-shield-halved', 'description' => 'Identification and evaluation of potential financial risks.', 'points' => ['Actionable recommendations for risk mitigation', 'Efficient financial management strategies to navigate identified risks']],
                    ],
                ],
            ],
            [
                'type' => 'process-steps',
                'data' => [
                    'title'       => 'Our Due Diligence Process — Structured, Thorough, Time-Bound',
                    'description' => 'A disciplined due diligence process protects buyers, accelerates deal timelines, and strengthens negotiating positions. Here is how Dev Mantra approaches every engagement.',
                    'steps'       => [
                        ['number' => '01', 'stage' => 'Scope & Mandate', 'description' => 'Define the scope of review, priority areas, and timeline based on deal size, type, and complexity.'],
                        ['number' => '02', 'stage' => 'Data Room Review', 'description' => 'Systematic review of financial records, legal documents, contracts, tax filings, and operational data.'],
                        ['number' => '03', 'stage' => 'Analysis & Red Flags', 'description' => 'Financial modelling, quality of earnings analysis, risk identification, and flagging of material issues.'],
                        ['number' => '04', 'stage' => 'Management Discussion', 'description' => 'Structured Q&A with management to validate findings, clarify assumptions, and probe key risk areas.'],
                        ['number' => '05', 'stage' => 'Reporting & Advisory', 'description' => 'Delivery of a comprehensive due diligence report with findings, risk ratings, and deal recommendations.'],
                    ],
                ],
            ],
            [
                'type' => 'benefits-list',
                'data' => [
                    'title' => 'Benefits of Due Diligence & Transaction Advisory Services',
                    'items' => [
                        "Provides a comprehensive understanding of the target company's true financial position",
                        'Helps identify potential risks and opportunities early in the process',
                        'Identifies financial, operational, and legal risks before deal close',
                        'Reduces the likelihood of post-transaction surprises and disputes',
                        'Ensures fair valuation and pricing of the deal',
                        'Helps in structuring the transaction to maximize value for all parties',
                        'Equips buyers and sellers with detailed information to negotiate with confidence',
                        'Strengthens the negotiating position with facts and verified insights',
                        'Ensures adherence to legal and regulatory requirements',
                        'Minimizes the risk of regulatory penalties and compliance issues post-close',
                        'Facilitates a smoother transition and post-transaction integration',
                        'Identifies potential integration challenges early — so they can be planned for',
                    ],
                ],
            ],
            [
                'type' => 'why-stand-out',
                'data' => [
                    'title' => "Why Dev Mantra's Due Diligence Services Stand Out",
                    'items' => [
                        ['icon' => 'fa-solid fa-users', 'title' => 'Experienced Team', 'description' => 'Dev Mantra has a team of highly skilled professionals who specialize in financial analysis and transaction advisory. Their deep understanding of deal structures, compliance requirements, and risk frameworks ensures that every due diligence engagement delivers defensible, actionable findings.'],
                        ['icon' => 'fa-solid fa-sliders', 'title' => 'Customized Solutions', 'description' => 'Every transaction is different. Dev Mantra provides tailored due diligence scopes that reflect the deal\'s specific nature, industry, and risk profile — ensuring focus on what matters most rather than applying a generic checklist to every engagement.'],
                        ['icon' => 'fa-solid fa-headset', 'title' => 'Responsive Support', 'description' => 'Transactions move at speed. Dev Mantra\'s dedicated teams ensure that tight due diligence timelines are met without compromising depth or accuracy — keeping your deal on schedule and your counterparty engaged.'],
                        ['icon' => 'fa-solid fa-shield-halved', 'title' => 'Proactive Risk Management', 'description' => "Dev Mantra's due diligence approach is built around risk identification, not just data compilation. Our frameworks surface material issues early — giving clients time to renegotiate, restructure, or walk away before commitment."],
                    ],
                ],
            ],
            [
                'type' => 'faq',
                'data' => [
                    'title'    => "Any Questions? We've Got You.",
                    'subtitle' => null,
                    'items'    => [
                        ['question' => 'What is the difference between financial due diligence and legal due diligence?', 'answer' => 'Financial due diligence focuses on the quality, accuracy, and sustainability of a company\'s financial performance — including revenue, profitability, cash flow, working capital, and balance sheet risks. Legal due diligence examines corporate structure, contracts, litigation exposure, intellectual property, and regulatory compliance. Both are typically conducted in parallel, and Dev Mantra coordinates both workstreams for a unified view.'],
                        ['question' => 'How long does a typical due diligence process take?', 'answer' => 'Timelines vary based on deal size, complexity, and data room quality. A standard SME acquisition due diligence typically takes 3–6 weeks from data room access to report delivery. Larger or more complex transactions may take 6–10 weeks. Dev Mantra structures the process with clear milestones to stay within agreed timelines.'],
                        ['question' => 'What is "quality of earnings" and why does it matter in due diligence?', 'answer' => 'Quality of Earnings (QoE) analysis examines how sustainable and reliable a company\'s reported earnings actually are — separating recurring operational earnings from one-time items, accounting adjustments, or management estimates. QoE is increasingly a baseline expectation in M&A due diligence, particularly for PE-backed transactions, because it directly informs valuation and deal structuring.'],
                        ['question' => 'Can Dev Mantra support cross-border due diligence?', 'answer' => 'Yes. Our team has experience in multi-jurisdictional due diligence involving FEMA compliance, RBI approvals, transfer pricing analysis, and cross-border tax structuring — for both inbound and outbound transactions involving Indian and international entities.'],
                        ['question' => 'Does Dev Mantra provide sell-side due diligence support?', 'answer' => 'Yes. Vendor due diligence (VDD) — where the seller commissions a due diligence report to share with potential buyers — is increasingly common in structured sale processes. Dev Mantra provides VDD reports that accelerate buyer confidence, reduce process friction, and often support better deal pricing.'],
                    ],
                ],
            ],
            [
                'type' => 'other-services',
                'data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing', 'url' => '/services/finance-accounts-compliance-outsourcing'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory'],
                        ['label' => 'IPO Advisory Services', 'url' => '/services/ipo-advisory'],
                        ['label' => 'Virtual CFO Services', 'url' => '/services/virtual-cfo'],
                        ['label' => 'M&A Advisory Services', 'url' => '/services/ma-advisory'],
                        ['label' => 'GCC (Global Capability Centers)', 'url' => '/services/gcc'],
                        ['label' => 'Business Setup & Startup Collaboration', 'url' => '/services/business-setup'],
                        ['label' => 'Corporate Governance', 'url' => '/services/corporate-governance'],
                    ],
                ],
            ],
        ];
    }
}
