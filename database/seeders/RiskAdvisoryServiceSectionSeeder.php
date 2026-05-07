<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class RiskAdvisoryServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'risk-advisory-augmenting-business-process')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'Risk Advisory & Augmenting Business Process Services',
                    'title'       => 'Identify the Risk Before It Identifies You',
                    'subtitle'    => 'Dev Mantra offers expert Risk Advisory Services and Business Process Augmentation to enhance your operational efficiency and mitigate potential risks. Our tailored solutions identify vulnerabilities, streamline processes, and drive strategic growth.',
                    'description' => 'Partner with us to safeguard your business and build a foundation for sustainable success.',
                    'cta_text'    => 'Talk to a Risk Advisor',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => "Safeguarding Your Business Success with Dev Mantra's Risk Management & Business Process Services",
                    'description'  => "At Dev Mantra, we specialize in fortifying your business's future through our comprehensive Risk Management Services and Business Process Augmentation. Our expert team meticulously analyzes potential risks, identifies vulnerabilities, and crafts tailored strategies to safeguard your operations.",
                    'description2' => "Effective risk management is not about eliminating risk — it is about understanding it well enough to make better decisions. Whether the risk lives at the board level, within a business unit, or inside a specific process, Dev Mantra brings the frameworks, tools, and experience to surface it, quantify it, and manage it systematically.\n\nTrust Dev Mantra to be your partner in securing business success and achieving strategic excellence.",
                    'cta_text'     => '',
                    'cta_url'      => '#contact',
                    'stats'        => [],
                ],
            ],

            // ── 3. SERVICES GRID (Three Risk Levels) ─────────────────────────
            [
                'section_type' => 'services-grid',
                'sort_order'   => 3,
                'section_data' => [
                    'title' => 'Risk Advisory and Augmenting Business Process at Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Level 1 — Group Level: Strategic Risk Management',
                            'description' => 'Risk advisory at the Group Level focuses on the strategic landscape in which the organization operates — including economic, geopolitical, technological, and environmental factors that shape long-term resilience.',
                            'points'      => [
                                'Enterprise Risk Management (ERM)',
                                'Scenario Planning and Stress Testing',
                                'Regulatory Compliance',
                                'Stakeholder Engagement',
                            ],
                        ],
                        [
                            'title'       => 'Level 2 — Entity Level: Operational Risk Management',
                            'description' => 'At the Entity Level, risk advisory services focus on the operational aspects of individual business units or subsidiaries — ensuring each entity operates within defined risk parameters while contributing to overall objectives.',
                            'points'      => [
                                'Risk Identification and Assessment',
                                'Control Environment that Mitigates Identified Risks',
                                'Risk Reporting',
                                'Crisis Management and Business Continuity Planning',
                            ],
                        ],
                        [
                            'title'       => 'Level 3 — Functional / Process Level: Process Risk Management',
                            'description' => 'At the Functional and Process Level, risk advisory embeds risk management directly into specific business processes and functions — managing risk at the point where it arises for more efficient and effective operations.',
                            'points'      => [
                                'Process Mapping and Risk Identification',
                                'Risk Control and Mitigation',
                                'Performance Monitoring',
                                'Training and Awareness',
                            ],
                        ],
                    ],
                ],
            ],

            // ── 4. BENEFITS LIST (How We Augment Business Processes) ──────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 4,
                'section_data' => [
                    'title'       => 'How We Augment Business Processes and Mitigate Risks',
                    'description' => 'Beyond identifying risk, Dev Mantra works alongside your team to strengthen the underlying processes — building the operational discipline that makes risk management sustainable.',
                    'items'       => [
                        'Documenting Standard Operating Procedures (SOPs)',
                        'Standardising Chart of Accounts',
                        'Regular Internal Audits and Risk Advisory',
                        'Virtual Internal Audits and Risk Advisory',
                        'Internal Financial Controls — Review and Audit',
                        'Corporate Governance Advisory',
                        "Process Development — the 3 P's (People, Process, Platform)",
                        'Information System and ISO Audit',
                        'Business Plans & Variance Analysis',
                    ],
                ],
            ],

            // ── 5. BENEFITS LIST ─────────────────────────────────────────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 5,
                'section_data' => [
                    'title' => 'Benefits of Risk Advisory & Augmenting Business Process Services',
                    'items' => [
                        'Improve risk-based decision making at every level of the organization',
                        'More effective and efficient use of capital',
                        'Comply confidently with regulatory changes as they occur',
                        'Improve shareholder value through stronger governance',
                        'Anticipate problems before they become a material threat',
                        'Co-ordinate various risk management activities into a unified framework',
                    ],
                ],
            ],

            // ── 6. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 6,
                'section_data' => [
                    'title' => "Why Dev Mantra's Risk Advisory Services Stand Out",
                    'items' => [
                        [
                            'title'       => 'Experienced Team',
                            'description' => 'Dev Mantra has a team of highly skilled professionals who specialize in financial regulations and risk frameworks. Their deep understanding of compliance requirements ensures that all activities adhere to the latest legal standards — reducing the risk of non-compliance and associated penalties.',
                        ],
                        [
                            'title'       => 'Customized Solutions',
                            'description' => "Risk is not generic. Dev Mantra provides tailored risk advisory that reflects the specific industry, scale, and risk profile of each client — designing bespoke solutions that address real vulnerabilities rather than applying standard templates.",
                        ],
                        [
                            'title'       => 'Responsive Support',
                            'description' => "Dev Mantra's dedicated teams ensure that risk-related concerns are addressed promptly. When an issue surfaces, speed of response matters — and our teams are built for exactly that.",
                        ],
                        [
                            'title'       => 'Proactive Risk Management',
                            'description' => "Dev Mantra's approach is fundamentally proactive. Our robust frameworks and early warning systems help identify potential issues before they escalate — maintaining the integrity of your financial and operational environment.",
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
                            'question' => 'What is the difference between risk advisory and internal audit?',
                            'answer'   => 'Internal audit evaluates the effectiveness of existing controls and processes retrospectively — it looks at what happened and whether controls worked. Risk advisory is forward-looking — it identifies where risks exist, assesses their likelihood and impact, and recommends controls and strategies before issues occur. Dev Mantra provides both, and they work best when delivered together.',
                        ],
                        [
                            'question' => 'What does Business Process Augmentation mean in practice?',
                            'answer'   => 'It means we work alongside your existing team to strengthen the processes that underpin your operations — documenting SOPs, standardizing controls, building audit-ready frameworks, and filling capability gaps without requiring you to hire full-time. The result is a more disciplined, defensible, and scalable operating model.',
                        ],
                        [
                            'question' => 'What is Enterprise Risk Management (ERM) and does my business need it?',
                            'answer'   => 'ERM is a structured, organization-wide approach to identifying, assessing, prioritizing, and managing all categories of risk — strategic, operational, financial, and compliance. If your business is scaling, investor-backed, or operating across multiple geographies or regulatory environments, a formal ERM framework is not optional — it is increasingly expected by investors, boards, and regulators.',
                        ],
                        [
                            'question' => "How does Dev Mantra approach internal financial controls review?",
                            'answer'   => 'We assess the design and operating effectiveness of your internal financial controls — covering authorization matrices, segregation of duties, financial reporting controls, and IT general controls. We deliver a findings report with risk-rated observations and practical recommendations that can be acted on immediately.',
                        ],
                        [
                            'question' => 'Can Dev Mantra conduct virtual internal audits?',
                            'answer'   => 'Yes. Dev Mantra offers virtual internal audit services — combining structured remote review processes with secure document sharing and digital audit trails. This is particularly effective for multi-location businesses or organizations with India-based operations being overseen by overseas stakeholders.',
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
                        ['label' => 'Finance Accounts Compliance Outsourcing',      'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory',  'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'IPO Advisory Services',                        'url' => '/services/ipo-advisory-services'],
                        ['label' => 'Virtual CFO Services',                         'url' => '/services/virtual-cfo-services'],
                        ['label' => 'M & A Advisory Services',                      'url' => '/services/m-a-advisory-services'],
                        ['label' => 'GCC (Global Capability Centers)',              'url' => '/services/gcc-global-capability-centers'],
                        ['label' => 'Business Setup & Startup Collaboration',       'url' => '/services/business-set-up-startup-collaboration'],
                        ['label' => 'Corporate Governance',                         'url' => '/services/corporate-governance'],
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
