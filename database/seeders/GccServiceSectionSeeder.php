<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class GccServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Try exact slug first, fallback to partial match
        $service = Service::where('slug', 'gcc-global-capability-centers')->first()
            ?? Service::where('slug', 'like', '%gcc%')->first()
            ?? Service::where('slug', 'like', '%global-capability%')->first();

        if (! $service) {
            $this->command->error('GCC service not found. Check the slug in the services table.');
            return;
        }

        // Wipe existing sections for this service
        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ────────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'GCC (Global Capability Centers)',
                    'title'       => 'Your India-Based Finance Capability Center — Built for Global Operations',
                    'subtitle'    => 'Dev Mantra builds fully managed accounting, reporting, and financial operations centers for businesses worldwide — helping global companies streamline bookkeeping, financial reporting, compliance, and advisory functions with accuracy, speed, and trust.',
                    'cta_text'    => 'Book a Consultation',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ────────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Empower Your Business with GCC Services by Dev Mantra',
                    'description'  => "At Dev Mantra, we are driven by a commitment to excellence, integrity, and innovation in global financial and management consulting. Our mission is to deliver top-tier financial operations and advisory services — tailored to the unique needs of clients across every geography we serve.\n\nOur GCC model goes beyond traditional outsourcing. It is a structured capability partnership — combining India's talent advantage, automation-led delivery, and governance-aligned quality frameworks to give global businesses a finance backbone that is accurate, scalable, and always compliant.",
                    'description2' => 'From daily bookkeeping to statutory compliance, payroll, financial reporting, cost optimization, and investment-readiness — our India-based teams operate as a true extension of your finance function. Whether you are a fast-growing startup, a mid-market enterprise, or a professional services firm managing client accounts, Dev Mantra gives you the delivery infrastructure to operate at scale without the overhead.',
                    'cta_text'     => 'Connect with Our Experts',
                    'cta_url'      => '#contact',
                    'stats'        => [],
                ],
            ],

            // ── 3. CPA REALITY — Why Traditional Outsourcing No Longer Works ──
            [
                'section_type' => 'cpa-reality',
                'sort_order'   => 3,
                'section_data' => [
                    'eyebrow'            => 'Built for Global Businesses, Not Generic BPO',
                    'title'              => 'The World Has Changed. The Finance Outsourcing Model Needs to Keep Up.',
                    'opening'            => 'Global businesses today are navigating a period of structural pressure — not just economic volatility, but a fundamental shift in how finance capacity must be sourced, managed, and governed.',
                    'pressure_points'    => [
                        'Finance talent shortages across key markets',
                        'Rising regulatory complexity across jurisdictions',
                        'Margin compression in professional services',
                        'Increasing volume of compliance obligations',
                        'Demand for faster, more transparent reporting from investors and boards',
                    ],
                    'description'        => "High attrition. Seasonal capacity crunches. Manual processes slowing delivery. Compliance complexity compressing margins.\n\nTraditional offshoring was never built to solve this. The old labor arbitrage model — low-cost BPO, weak documentation standards, misaligned governance, and poor data security — often created rework, review fatigue, and defensibility risks. It replaced one problem with several others.",
                    'old_model_title'    => 'The Old Model',
                    'old_model_description' => 'Labor arbitrage. Low-cost BPO. Weak documentation standards, misaligned governance, and poor data security — creating rework, review fatigue, and defensibility risks. It replaced one problem with several others.',
                    'shift_title'        => 'The Shift',
                    'shift_description'  => "From Labor Arbitrage → To Automation-First + Governance-Grade Delivery.\n\nThe new model is built around standardized digital workflows, AI-enabled documentation, secure cloud environments, structured QA and review layers, and risk-based process frameworks that meet the standards of global regulators, institutional investors, and professional bodies.\n\nAutomation + Governance = Delivery You Can Stand Behind. This is the operating model jointly implemented by Dev Mantra & N. Tatia & Associates.",
                ],
            ],

            // ── 4. THREE-LAYER — The Dev Mantra GCC Model ─────────────────────
            [
                'section_type' => 'three-layer',
                'sort_order'   => 4,
                'section_data' => [
                    'title'        => 'Scaling Finance & Advisory Through Automation + Expert Delivery',
                    'description'  => "Dev Mantra helps global businesses address structural finance capacity pressures by building India-based, governance-grade capability teams that expand delivery without increasing client-side headcount. Through AI-enabled workflows, standardized documentation, and risk-based frameworks, we manage rising complexity while ensuring quality controls align with the regulatory and reporting standards of each client's home jurisdiction.",
                    'description2' => 'Our automation-first delivery model reduces cost per engagement and improves turnaround time — protecting your margins. By taking on execution-heavy finance and compliance work, Dev Mantra frees your leadership to focus on client relationships, strategy, and growth.',
                    'description3' => 'We move beyond traditional outsourcing toward a structured Global Capability Center model — allowing businesses to increase capacity, margins, and turnaround speed, without increasing headcount.',
                    'note'         => 'Dev Mantra is a long-term capability hub — not a vendor.',
                    'layers'       => [
                        [
                            'number'   => 1,
                            'title'    => 'Automation Engine',
                            'subtitle' => 'Technology',
                            'points'   => [
                                'AI-based workflow tools',
                                'Workflow orchestration and task assignment',
                                'Automated reconciliations and sampling',
                                'Smart document management',
                                'Exception tracking dashboards',
                            ],
                        ],
                        [
                            'number'   => 2,
                            'title'    => 'Expert Delivery Team',
                            'subtitle' => 'India — Led by Dev Mantra with governance support from N. Tatia & Associates',
                            'points'   => [
                                'Accounting and bookkeeping associates',
                                'Tax and compliance specialists',
                                'Financial reporting analysts',
                                'Data and analytics team',
                                'Internal QA reviewers',
                            ],
                        ],
                        [
                            'number'   => 3,
                            'title'    => 'Client / Partner Oversight',
                            'subtitle' => 'Your Home Jurisdiction',
                            'points'   => [
                                'Final review and sign-off',
                                'Client advisory and relationship management',
                                'Regulatory and statutory approvals',
                                'Governance oversight aligned to local standards',
                            ],
                        ],
                    ],
                ],
            ],

            // ── 5. PROCESS STEPS — Automation-Led Execution Framework ──────────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 5,
                'section_data' => [
                    'title'       => 'Our Automation-Led Execution Framework',
                    'description' => 'Our framework integrates intelligent workflows, AI-enabled tools, and standardized digital documentation to deliver accuracy, speed, and regulatory defensibility across every engagement. This enables continuous delivery cycles, improved consistency, and alignment with the reporting standards of your jurisdiction.',
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Digital Intake & Workflow Orchestration',
                            'description' => 'We implement standardized digital checklists and workflow engines that auto-assign tasks, track evidence submission, monitor SLA compliance, and provide real-time engagement dashboards.',
                            'value'       => '20–30% reduction in coordination time',
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'AI-Enabled Documentation & Processing',
                            'description' => 'Automated lead schedules, trial balance mapping, smart sampling, exception flagging, and AI-based workpaper and document indexing — removing manual bottlenecks from high-volume processes.',
                            'value'       => 'Faster cycles, lower review notes, stronger documentation quality',
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Secure Cloud Operating Environment',
                            'description' => 'Role-based access control, encrypted document vaults, controlled client data rooms, and a full audit trail maintained throughout every engagement.',
                            'value'       => 'Governance-ready documentation integrity',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Structured QA & Multi-Level Review',
                            'description' => 'Two-level India-side review with governance oversight from N. Tatia & Associates — using standardized templates, risk-based testing matrices, and engagement quality checklists aligned to your reporting standards.',
                            'value'       => 'Reduced errors, reduced regulatory exposure',
                        ],
                        [
                            'number'      => '05',
                            'stage'       => 'Advisory Enablement Layer',
                            'description' => 'Because execution is automated, your leadership spends less time reviewing and more time advising — improving realization rates and client or stakeholder satisfaction.',
                            'value'       => 'Higher partner bandwidth. Stronger relationships.',
                        ],
                    ],
                    'metrics' => [
                        ['metric' => 'Turnaround time',        'outcome' => '25–40% faster'],
                        ['metric' => 'Cost efficiency',        'outcome' => '40–60% improvement'],
                        ['metric' => 'Cost per engagement',    'outcome' => '20–35% reduction'],
                        ['metric' => 'Work progression',       'outcome' => '24-hour delivery cycles'],
                        ['metric' => 'Documentation accuracy', 'outcome' => '99% (QA framework)'],
                        ['metric' => 'Engagement capacity',    'outcome' => '50% increase'],
                    ],
                ],
            ],

            // ── 6. COMPARISON TABLE — Automated vs Retained ───────────────────
            [
                'section_type' => 'comparison-table',
                'sort_order'   => 6,
                'section_data' => [
                    'title'        => 'Automation Handles Execution. Your Team Handles Judgment.',
                    'column1_title' => 'Automated by Dev Mantra',
                    'column2_title' => 'Retained by Client / Partner',
                    'rows'         => [
                        ['Data ingestion and categorization',           'Client and stakeholder relationships'],
                        ['Workpaper and document preparation',          'Professional judgment and interpretation'],
                        ['Reconciliations',                             'Statutory sign-off and approvals'],
                        ['Tax computation',                             'Strategic advisory'],
                        ['Compliance checklists and documentation',     'Final review and governance'],
                        ['Audit trail maintenance',                     'Regulatory oversight'],
                    ],
                ],
            ],

            // ── 7. ENGAGEMENT MODELS ──────────────────────────────────────────
            [
                'section_type' => 'engagement-models',
                'sort_order'   => 7,
                'section_data' => [
                    'title'           => 'Engagement Models — Choose What Works for You',
                    'standard_label'  => 'Our Engagement Models',
                    'standard_models' => [
                        [
                            'title'       => 'Process Outsourcing Model',
                            'description' => 'Your finance and accounting operations are fully handled by our team end-to-end. We manage processes continuously with defined SLAs, reporting cadences, and quality controls.',
                            'best_for'    => 'Companies seeking a complete outsourced finance function',
                        ],
                        [
                            'title'       => 'Offshore Process Model',
                            'description' => 'You get a dedicated offshore team in India working exclusively for your organization — operating as a seamless extension of your in-house finance function at significantly lower cost.',
                            'best_for'    => 'Businesses that want an embedded India team without the setup complexity',
                        ],
                        [
                            'title'       => 'Job by Job Model',
                            'description' => 'You assign specific tasks — reconciliations, cleanups, payroll processing, or compliance filings — as needed. Ideal for ad-hoc, short-term, or project-based financial work.',
                            'best_for'    => 'Organizations with variable workloads or one-time requirements',
                        ],
                        [
                            'title'       => 'Build Operate Transfer (BOT) Model',
                            'description' => 'We set up and run a fully operational finance team in India. Once systems are stable and quality benchmarks are met, control is transferred to your organization for long-term, independently managed scaling.',
                            'best_for'    => 'Enterprises planning a permanent India-based finance presence',
                        ],
                    ],
                ],
            ],

            // ── 8. PILLARS — Key GCC Pillars ──────────────────────────────────
            [
                'section_type' => 'pillars',
                'sort_order'   => 8,
                'section_data' => [
                    'title'   => 'What Makes Our GCC Model Work',
                    'pillars' => [
                        [
                            'title'  => 'Automation-First Delivery',
                            'points' => [
                                'AI-enabled workflows and smart documentation',
                                '24-hour delivery cycle capability',
                                'Standardized process templates',
                                'Structured QA and defensible output framework',
                            ],
                        ],
                        [
                            'title'  => 'Talent Advantage',
                            'points' => [
                                'Strong US GAAP, IFRS, and multi-standard knowledge',
                                'English fluency across all delivery teams',
                                'Dedicated specialised delivery pods',
                                'Trained workforce with adequate depth and bench strength',
                            ],
                        ],
                        [
                            'title'  => 'Infrastructure Strength',
                            'points' => [
                                'Mature IT ecosystem and cybersecurity frameworks',
                                'Secure cloud adoption with SOC 2 compliant infrastructure',
                                'Role-based access and encrypted document environments',
                                '40–60% cost advantage vs. equivalent home-market delivery',
                            ],
                        ],
                    ],
                ],
            ],

            // ── 9. TRUST SIGNALS ──────────────────────────────────────────────
            [
                'section_type' => 'trust-signals',
                'sort_order'   => 9,
                'section_data' => [
                    'title' => 'Why Trust Us',
                    'items' => [
                        ['icon' => 'fa-solid fa-circle-check',     'label' => 'Accuracy you can depend on — 3-level quality checks on every engagement'],
                        ['icon' => 'fa-solid fa-toolbox',          'label' => 'Industry-standard tools across all major platforms (Xero, QuickBooks, Tally, Zoho, SAP)'],
                        ['icon' => 'fa-solid fa-coins',            'label' => 'Cost-effective global finance team — 50–70% cost savings vs. in-house or local delivery'],
                        ['icon' => 'fa-solid fa-lock',             'label' => 'Secure data handling — NDA-bound engagements with encrypted file exchange'],
                        ['icon' => 'fa-solid fa-globe',            'label' => 'Time-zone aligned support across US, UK, Europe, Australia, UAE, and South East Asia'],
                        ['icon' => 'fa-solid fa-chart-line',       'label' => 'Scalable operations — from 10 to 10,000 transactions per month'],
                    ],
                ],
            ],

            // ── 10. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 10,
                'section_data' => [
                    'title' => "Why Dev Mantra's GCC Services Stand Out",
                    'items' => [
                        [
                            'icon'        => 'fa-solid fa-earth-asia',
                            'title'       => 'Local Expertise with a Global Perspective',
                            'description' => "Our team combines in-depth knowledge of the Indian market with a global outlook — ensuring delivery frameworks that are locally compliant, internationally relevant, and calibrated to the standards of your home jurisdiction.",
                        ],
                        [
                            'icon'        => 'fa-solid fa-layer-group',
                            'title'       => 'Comprehensive Support Across All Stages',
                            'description' => 'From initial scope design to full operational delivery, Dev Mantra offers end-to-end GCC support — guiding you through every phase of building and running your India-based capability center.',
                        ],
                        [
                            'icon'        => 'fa-solid fa-sliders',
                            'title'       => 'Tailored Solutions for Your Unique Needs',
                            'description' => 'We customize our services to address the specific workflow, volume, reporting, and compliance requirements of your business — providing solutions that are precise and effective, not generic.',
                        ],
                        [
                            'icon'        => 'fa-solid fa-handshake',
                            'title'       => 'Strong Network and Proven Track Record',
                            'description' => 'Leveraging our extensive professional network and successful delivery track record across 200+ global clients, we bring the experience and connections that translate into results — not just activity.',
                        ],
                    ],
                ],
            ],

            // ── 11. MARKETS SERVED ────────────────────────────────────────────
            [
                'section_type' => 'markets-served',
                'sort_order'   => 11,
                'section_data' => [
                    'title'   => 'Markets Served',
                    'markets' => ['USA', 'UK', 'Europe', 'Korea', 'Japan', 'Singapore', 'Dubai', 'Abu Dhabi', 'Australia', 'New Zealand'],
                ],
            ],

            // ── 12. GOVERNANCE — Security & Quality ───────────────────────────
            [
                'section_type' => 'governance',
                'sort_order'   => 12,
                'section_data' => [
                    'title'      => 'Governance, Security & Delivery Integrity',
                    'columns'    => [
                        [
                            'title' => 'Security Framework',
                            'items' => [
                                'SOC 2 compliant infrastructure',
                                'Role-based access control across all engagements',
                                'Encrypted document environments and controlled data rooms',
                                'Full audit logs and end-to-end traceability',
                            ],
                        ],
                        [
                            'title' => 'Governance & Quality',
                            'items' => [
                                'Multi-level review structure (India QA + Partner oversight)',
                                'Standardized engagement quality control checklists',
                                'Risk-based documentation templates',
                                'SLA-bound delivery with escalation protocols',
                            ],
                        ],
                    ],
                    'disclaimer' => 'Dev Mantra Financial Services Pvt. Ltd. + N. Tatia & Associates do not offer traditional outsourcing. We build automation-led finance capability centers, governance-aligned compliance engines, and structured GCC models for global businesses. We don\'t replace your professional judgment. We enhance your delivery capacity.',
                ],
            ],

            // ── 13. FAQ ───────────────────────────────────────────────────────
            [
                'section_type' => 'faq',
                'sort_order'   => 13,
                'section_data' => [
                    'title'    => "Any Questions? We've Got You.",
                    'subtitle' => "Find answers to common questions about Dev Mantra's GCC and global financial operations services.",
                    'items'    => [
                        [
                            'question' => 'What services does Dev Mantra provide through its GCC model?',
                            'answer'   => 'Dev Mantra provides end-to-end outsourced accounting, bookkeeping, financial reporting, statutory compliance, payroll, audit support, virtual CFO services, tax compliance, and M&A support — all delivered through a structured India-based capability center with defined SLAs, quality controls, and governance oversight.',
                        ],
                        [
                            'question' => 'How does Dev Mantra ensure data security and confidentiality?',
                            'answer'   => 'All engagements are covered by NDAs. We operate on a SOC 2 compliant infrastructure with role-based access control, encrypted document vaults, controlled data rooms, and full audit trails. Our security framework is aligned to ISO 27001 and applicable regulatory standards across the jurisdictions we serve.',
                        ],
                        [
                            'question' => 'What is the cost advantage of using Dev Mantra\'s India-based GCC?',
                            'answer'   => 'Clients typically realize a 40–60% cost advantage compared to equivalent home-market delivery, and 50–70% overall savings across finance and accounting operations. This is achieved through India\'s talent cost differential, automation-led delivery, and efficient team structures — without compromising quality, governance, or turnaround time.',
                        ],
                        [
                            'question' => 'How does Dev Mantra handle compliance for clients across different countries?',
                            'answer'   => 'Our team has strong working knowledge of US GAAP, IFRS, UK GAAP, and the reporting standards of the major markets we serve. For jurisdiction-specific compliance requirements, our delivery teams are structured to align with local statutory obligations — and N. Tatia & Associates provides governance oversight to ensure quality and regulatory alignment at every stage.',
                        ],
                        [
                            'question' => 'What engagement model is right for our organization?',
                            'answer'   => 'It depends on your volume, operating model, seasonality, and long-term objectives. We offer four engagement models — Process Outsourcing, Offshore Process, Job by Job, and Build-Operate-Transfer. Our team typically runs a scoping conversation to understand your requirements and recommend the right fit before any commitment is made.',
                        ],
                    ],
                ],
            ],

            // ── 14. OTHER SERVICES ────────────────────────────────────────────
            [
                'section_type' => 'other-services',
                'sort_order'   => 14,
                'section_data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing',     'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory-augmenting-business-process'],
                        ['label' => 'IPO Advisory Services',                       'url' => '/services/ipo-advisory-services'],
                        ['label' => 'Virtual CFO Services',                        'url' => '/services/virtual-cfo-services'],
                        ['label' => 'M & A Advisory Services',                     'url' => '/services/m-a-advisory-services'],
                        ['label' => 'Business Setup & Startup Collaboration',      'url' => '/services/business-set-up-startup-collaboration'],
                        ['label' => 'Corporate Governance',                        'url' => '/services/corporate-governance'],
                    ],
                ],
            ],

        ];

        foreach ($sections as $section) {
            ServiceSection::create([
                'service_id'   => $service->id,
                'section_type' => $section['section_type'],
                'sort_order'   => $section['sort_order'],
                'is_active'    => true,
                'section_data' => $section['section_data'],
            ]);
        }

        $this->command->info("✓ Seeded GCC page '{$service->title}': " . count($sections) . ' sections created.');
    }
}
