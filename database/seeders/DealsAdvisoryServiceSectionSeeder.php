<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class DealsAdvisoryServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'deals-due-diligence-transaction-advisory')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'Deals, Due Diligence & Transaction Advisory Services',
                    'title'       => "Know What You're Getting Into — Before You Commit",
                    'subtitle'    => "Dev Mantra's Deals, Due Diligence & Transaction Advisory Services provide comprehensive support for mergers, acquisitions, and investments — ensuring informed decision-making at every critical stage.",
                    'description' => 'Thorough financial analysis, rigorous risk assessment, and strategic transaction guidance — from first look to final close.',
                    'cta_text'    => 'Start Your Due Diligence',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Start Your Financial Due Diligence Now with Dev Mantra',
                    'description'  => "Unlock the power of expert financial analysis with Dev Mantra. Our dedicated team of financial specialists is ready to streamline your due diligence process through cutting-edge virtual solutions. Whether you're navigating complex investments, evaluating potential acquisitions, or assessing partnership opportunities — our comprehensive due diligence services ensure accuracy and efficiency at every step.",
                    'description2' => "Every transaction carries risk. The quality of due diligence performed before a deal closes determines not just the price you pay, but the value you realize — and the surprises you avoid. Dev Mantra brings structured methodology, experienced professionals, and a forensic level of financial rigour to every engagement.\n\nLeverage our expertise to make informed decisions, mitigate risks, and achieve your financial goals with confidence.",
                    'cta_text'     => '',
                    'cta_url'      => '#contact',
                    'stats'        => [],
                ],
            ],

            // ── 3. SERVICES GRID ─────────────────────────────────────────────
            [
                'section_type' => 'services-grid',
                'sort_order'   => 3,
                'section_data' => [
                    'title' => 'Due Diligence & Transaction Advisory Services Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Financial Due Diligence',
                            'description' => '',
                            'points'      => [
                                'Comprehensive review of financial statements and records',
                                'Assessment of revenue streams, profitability, and cash flow',
                                'Evaluation of financial projections and underlying assumptions',
                            ],
                        ],
                        [
                            'title'       => 'Operational Due Diligence',
                            'description' => '',
                            'points'      => [
                                'Analysis of business operations and workflow efficiency',
                                'Examination of supply chain management and logistics',
                                'Review of organizational structure and human resources',
                            ],
                        ],
                        [
                            'title'       => 'Commercial Due Diligence',
                            'description' => '',
                            'points'      => [
                                'Market analysis to assess competitive positioning',
                                'Customer and supplier contract evaluations',
                                'Review of sales and marketing strategies',
                            ],
                        ],
                        [
                            'title'       => 'Tax Due Diligence',
                            'description' => '',
                            'points'      => [
                                'Analysis of tax compliance and liabilities',
                                'Review of historical tax returns and future tax obligations',
                                'Identification of potential tax risks and mitigation strategies',
                            ],
                        ],
                        [
                            'title'       => 'Legal Due Diligence',
                            'description' => '',
                            'points'      => [
                                'Examination of corporate governance and legal structure',
                                'Review of pending or potential litigation and regulatory issues',
                                'Analysis of intellectual property rights and contractual obligations',
                            ],
                        ],
                        [
                            'title'       => 'Transaction Advisory Services',
                            'description' => '',
                            'points'      => [
                                'Assistance with mergers, acquisitions, and divestitures',
                                'Valuation services for businesses and assets',
                                'Support in deal structuring, negotiation, and closing processes',
                            ],
                        ],
                        [
                            'title'       => 'Investor Representation',
                            'description' => '',
                            'points'      => [
                                'Tailored due diligence to safeguard investor interests',
                                'Ensure alignment with investment objectives',
                                'Provide strategic insights to support informed investment decisions',
                            ],
                        ],
                        [
                            'title'       => 'Fund Representation',
                            'description' => '',
                            'points'      => [
                                'Detailed analysis to protect fund assets',
                                'Ensure compliance with fund policies and mandates',
                                'Evaluate potential investments to optimize fund performance',
                            ],
                        ],
                        [
                            'title'       => 'Risk Assessment',
                            'description' => '',
                            'points'      => [
                                'Identification and evaluation of potential financial risks',
                                'Actionable recommendations for risk mitigation',
                                'Efficient financial management strategies to navigate identified risks',
                            ],
                        ],
                    ],
                ],
            ],

            // ── 4. PROCESS STEPS ─────────────────────────────────────────────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 4,
                'section_data' => [
                    'title'       => 'Our Due Diligence Process — Structured, Thorough, Time-Bound',
                    'description' => 'A disciplined due diligence process protects buyers, accelerates deal timelines, and strengthens negotiating positions. Here is how Dev Mantra approaches every engagement.',
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Scope & Mandate',
                            'description' => 'Define the scope of review, priority areas, and timeline based on deal size, type, and complexity.',
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'Data Room Review',
                            'description' => 'Systematic review of financial records, legal documents, contracts, tax filings, and operational data.',
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Analysis & Red Flags',
                            'description' => 'Financial modelling, quality of earnings analysis, risk identification, and flagging of material issues.',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Management Discussion',
                            'description' => 'Structured Q&A with management to validate findings, clarify assumptions, and probe key risk areas.',
                        ],
                        [
                            'number'      => '05',
                            'stage'       => 'Reporting & Advisory',
                            'description' => 'Delivery of a comprehensive due diligence report with findings, risk ratings, and deal recommendations.',
                        ],
                    ],
                    'metrics' => [],
                ],
            ],

            // ── 5. BENEFITS LIST ─────────────────────────────────────────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 5,
                'section_data' => [
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

            // ── 6. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 6,
                'section_data' => [
                    'title' => "Why Dev Mantra's Due Diligence Services Stand Out",
                    'items' => [
                        [
                            'title'       => 'Experienced Team',
                            'description' => 'Dev Mantra has a team of highly skilled professionals who specialize in financial analysis and transaction advisory. Their deep understanding of deal structures, compliance requirements, and risk frameworks ensures that every due diligence engagement delivers defensible, actionable findings.',
                        ],
                        [
                            'title'       => 'Customized Solutions',
                            'description' => "Every transaction is different. Dev Mantra provides tailored due diligence scopes that reflect the deal's specific nature, industry, and risk profile — ensuring focus on what matters most rather than applying a generic checklist to every engagement.",
                        ],
                        [
                            'title'       => 'Responsive Support',
                            'description' => "Transactions move at speed. Dev Mantra's dedicated teams ensure that tight due diligence timelines are met without compromising depth or accuracy — keeping your deal on schedule and your counterparty engaged.",
                        ],
                        [
                            'title'       => 'Proactive Risk Management',
                            'description' => "Dev Mantra's due diligence approach is built around risk identification, not just data compilation. Our frameworks surface material issues early — giving clients time to renegotiate, restructure, or walk away before commitment.",
                        ],
                    ],
                ],
            ],

            // ── 7. FAQ ───────────────────────────────────────────────────────
            [
                'section_type' => 'faq',
                'sort_order'   => 7,
                'section_data' => [
                    'title'    => "Any Questions? We've Got You.",
                    'subtitle' => '',
                    'items'    => [
                        [
                            'question' => 'What is the difference between financial due diligence and legal due diligence?',
                            'answer'   => 'Financial due diligence focuses on the quality, accuracy, and sustainability of a company\'s financial performance — including revenue, profitability, cash flow, working capital, and balance sheet risks. Legal due diligence examines corporate structure, contracts, litigation exposure, intellectual property, and regulatory compliance. Both are typically conducted in parallel, and Dev Mantra coordinates both workstreams for a unified view.',
                        ],
                        [
                            'question' => 'How long does a typical due diligence process take?',
                            'answer'   => 'Timelines vary based on deal size, complexity, and data room quality. A standard SME acquisition due diligence typically takes 3–6 weeks from data room access to report delivery. Larger or more complex transactions may take 6–10 weeks. Dev Mantra structures the process with clear milestones to stay within agreed timelines.',
                        ],
                        [
                            'question' => 'What is "quality of earnings" and why does it matter in due diligence?',
                            'answer'   => "Quality of Earnings (QoE) analysis examines how sustainable and reliable a company's reported earnings actually are — separating recurring operational earnings from one-time items, accounting adjustments, or management estimates. QoE is increasingly a baseline expectation in M&A due diligence, particularly for PE-backed transactions, because it directly informs valuation and deal structuring.",
                        ],
                        [
                            'question' => 'Can Dev Mantra support cross-border due diligence?',
                            'answer'   => 'Yes. Our team has experience in multi-jurisdictional due diligence involving FEMA compliance, RBI approvals, transfer pricing analysis, and cross-border tax structuring — for both inbound and outbound transactions involving Indian and international entities.',
                        ],
                        [
                            'question' => 'Does Dev Mantra provide sell-side due diligence support?',
                            'answer'   => 'Yes. Vendor due diligence (VDD) — where the seller commissions a due diligence report to share with potential buyers — is increasingly common in structured sale processes. Dev Mantra provides VDD reports that accelerate buyer confidence, reduce process friction, and often support better deal pricing.',
                        ],
                    ],
                ],
            ],

            // ── 8. OTHER SERVICES ────────────────────────────────────────────
            [
                'section_type' => 'other-services',
                'sort_order'   => 8,
                'section_data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing',  'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory-augmenting-business-process'],
                        ['label' => 'IPO Advisory Services',                    'url' => '/services/ipo-advisory-services'],
                        ['label' => 'Virtual CFO Services',                     'url' => '/services/virtual-cfo-services'],
                        ['label' => 'M & A Advisory Services',                  'url' => '/services/m-a-advisory-services'],
                        ['label' => 'GCC (Global Capability Centers)',           'url' => '/services/gcc-global-capability-centers'],
                        ['label' => 'Business Setup & Startup Collaboration',   'url' => '/services/business-set-up-startup-collaboration'],
                        ['label' => 'Corporate Governance',                     'url' => '/services/corporate-governance'],
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

        $this->command->info("Seeded {$service->title}: " . count($sections) . ' sections created.');
    }
}
