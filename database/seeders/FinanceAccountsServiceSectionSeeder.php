<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class FinanceAccountsServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'finance-accounts-compliance-outsourcing-services')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'Finance Accounts Compliance Outsourcing Services',
                    'title'       => 'Accurate, Compliant, and Scalable Finance Operations — Outsourced to Experts',
                    'subtitle'    => "Dev Mantra offers comprehensive finance and accounting outsourcing services, ensuring your business stays compliant with regulations. Our expert team handles financial reporting, tax compliance, and auditing — allowing you to focus on core operations while we manage the complexities with precision and efficiency.",
                    'description' => '',
                    'cta_text'    => 'Streamline Your Finance Function',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Effortless Bookkeeping and Accounting with Dev Mantra',
                    'description'  => 'At Dev Mantra, we use state-of-the-art accounting software and technology to ensure that your books are accurate and error-free. You can trust our experience in serving clients for more than a decade globally.',
                    'description2' => "We are living in an era of innovative business, which brings new challenges in understanding business models and evaluating the applicability of statutory guidelines. Finance is the most important function in any organization — yet for most businesses, it is not a core function. There is every advantage to outsourcing it to experts who bring the right combination of experience, accuracy, availability, reliability, and trust.\n\nDev Mantra assumes the responsibility for data backups, data security, and continuous compliance — so your management team can focus more aggressively on operational and business matters that are critical for growth and survival.",
                    'cta_text'     => 'Connect with Our Experts',
                    'cta_url'      => '#contact',
                    'stats'        => [],
                ],
            ],

            // ── 3. SERVICES GRID ─────────────────────────────────────────────
            [
                'section_type' => 'services-grid',
                'sort_order'   => 3,
                'section_data' => [
                    'title' => 'Core Finance and Accounting Outsourcing Services Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Accounts and Bookkeeping',
                            'description' => '',
                            'points'      => [
                                'Voucher Entry',
                                'General Ledger Adjustments',
                                'Setting up Chart of Accounts',
                                'MIS Preparation',
                                'Financial Statements Preparation',
                            ],
                        ],
                        [
                            'title'       => 'Payroll Accounting',
                            'description' => '',
                            'points'      => [
                                'Designing Salary Structure',
                                'Payroll Processing',
                                'Tax Declaration Audit',
                                'TDS on Salary',
                                'Issue of Form 16',
                            ],
                        ],
                        [
                            'title'       => 'Business & Financial Advisory',
                            'description' => '',
                            'points'      => [
                                'Business Strategy',
                                'Business Plans & Forecast',
                                'Cost Optimization',
                                'Financial Restructuring',
                                'Treasury Management',
                            ],
                        ],
                        [
                            'title'       => 'Tax Planning',
                            'description' => '',
                            'points'      => [
                                'Tax Optimization Strategies',
                                'Tax Compliance Management',
                                'Tax Risk Assessment',
                            ],
                        ],
                        [
                            'title'       => 'International Taxation',
                            'description' => '',
                            'points'      => [
                                'Cross-border Tax Compliance',
                                'Transfer Pricing Documentation',
                                'Double Taxation Avoidance Advisory',
                            ],
                        ],
                        [
                            'title'       => 'Dispute Resolution Services',
                            'description' => '',
                            'points'      => [
                                'Tax Litigation Support',
                                'Representation before Tax Authorities',
                                'Dispute Resolution Mechanisms',
                            ],
                        ],
                        [
                            'title'       => 'Tax Litigation Support Services',
                            'description' => '',
                            'points'      => [
                                'Compliance Support',
                                'Transfer Pricing Study',
                                'Health Checks & Review',
                                'Ongoing Advisory Service',
                                'Representations & Litigation Support',
                            ],
                        ],
                        [
                            'title'       => 'RBI and FEMA Compliance',
                            'description' => '',
                            'points'      => [
                                'Evolving Overseas and India Investment Advisory',
                                'Government Relationship Management',
                                'Regulatory Advisory Service',
                                'Advising on Regulatory Implications',
                            ],
                        ],
                        [
                            'title'       => 'Corporate Secretarial Services',
                            'description' => '',
                            'points'      => [
                                'Conduct of Board Meetings & AGM',
                                'Drafting of Minutes of Meetings',
                                'Ongoing MCA Compliances',
                                'Capital Restructuring',
                                'Ongoing Advisory',
                            ],
                        ],
                    ],
                ],
            ],

            // ── 4. CFO SERVICES ──────────────────────────────────────────────
            [
                'section_type' => 'cfo-services',
                'sort_order'   => 4,
                'section_data' => [
                    'title'       => 'Get the Opportunity to Work with the Best Chief Financial Officer',
                    'description' => 'Every finance outsourcing engagement with Dev Mantra comes with access to CFO-level oversight — whether you need an interim, virtual, part-time, or special-purpose financial leader.',
                    'scope_title' => 'CFO Scope Includes',
                    'scope_items' => [
                        'Fund Raising and Deal Assistance',
                        'Mergers and Acquisitions',
                        'Transaction Advisory Services',
                        'Accounting and Payroll Services',
                        'Assistance in Critical Tax Matters',
                        'Board Reporting and Representation',
                        'Team Evaluation and GAP Analysis',
                        'Budgeting, Forecasting and Variance Analysis',
                    ],
                    'types_title' => 'CFO Engagement Types',
                    'types'       => [
                        'Interim CFO',
                        'Virtual CFO',
                        'Part-time CFO',
                        'Special Purpose CFO',
                    ],
                ],
            ],

            // ── 5. BENEFITS LIST ─────────────────────────────────────────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 5,
                'section_data' => [
                    'title' => 'Benefits of Finance & Accounting Outsourcing Services',
                    'items' => [
                        'Reduce personnel and infrastructure expenses significantly',
                        'Strict SLAs ensure timely, predictable deliverables',
                        'Fast turnaround times boost overall operational efficiency',
                        'Centralized compliance tracking ensures all deadlines are met',
                        'Enhanced financial visibility and control with integrated tax compliance',
                        'Access to an expert team and a Virtual CFO for strategic support',
                        'Utilize the latest accounting software and automation tools',
                        'Employ Robotic Process Automation (RPA) to manage high volumes with fewer resources',
                    ],
                ],
            ],

            // ── 6. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 6,
                'section_data' => [
                    'title' => 'Why Dev Mantra is Better than Others',
                    'items' => [
                        [
                            'title'       => 'Experienced Team',
                            'description' => 'Dev Mantra has a team of highly skilled professionals who specialize in financial regulations. Their deep understanding of compliance requirements ensures that all financial activities adhere to the latest legal standards — reducing the risk of non-compliance and associated penalties.',
                        ],
                        [
                            'title'       => 'Customized Solutions',
                            'description' => 'Dev Mantra provides tailored compliance services that cater to the specific needs of each client. By understanding the unique requirements of different financial institutions, they design and implement bespoke solutions that address distinct compliance challenges effectively.',
                        ],
                        [
                            'title'       => 'Responsive Customer Support',
                            'description' => 'Dev Mantra prides itself on its responsive support team. Available around the clock, our dedicated staff ensures that client queries and concerns are addressed promptly and efficiently — fostering long-term partnerships.',
                        ],
                        [
                            'title'       => 'Proactive Risk Management',
                            'description' => 'Dev Mantra employs a proactive approach to risk management, continuously monitoring and assessing compliance risks. Our robust frameworks and early warning systems help identify potential issues before they escalate.',
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
                            'question' => 'What finance and accounting services does Dev Mantra offer?',
                            'answer'   => 'Dev Mantra provides end-to-end finance and accounting outsourcing — including bookkeeping, payroll processing, financial statement preparation, MIS reporting, tax compliance (domestic and international), RBI/FEMA advisory, corporate secretarial services, and CFO-level oversight. We serve startups, SMEs, and global enterprises across industries.',
                        ],
                        [
                            'question' => 'How can Dev Mantra assist with tax planning?',
                            'answer'   => 'Our tax advisory covers optimization strategies, compliance management, and risk assessment for both domestic and cross-border tax requirements. We also provide transfer pricing documentation, double taxation avoidance advisory, and litigation support before tax authorities — ensuring your business is proactive rather than reactive on tax matters.',
                        ],
                        [
                            'question' => "What is included in Dev Mantra's business and financial advisory services?",
                            'answer'   => 'Our advisory covers business strategy, financial planning and forecasting, cost optimization, financial restructuring, and treasury management. For businesses at growth inflection points, we layer in Virtual CFO services — including board reporting, investor readiness, and deal support.',
                        ],
                        [
                            'question' => 'How does Dev Mantra support regulatory compliance?',
                            'answer'   => 'We maintain a centralized compliance tracking framework covering MCA filings, FEMA requirements, RBI approvals, GST, TDS, and other statutory obligations. Our team stays current with regulatory changes and proactively flags upcoming deadlines and obligations — so nothing falls through the cracks.',
                        ],
                        [
                            'question' => 'Is outsourcing my accounting function secure? How is data handled?',
                            'answer'   => 'Dev Mantra operates with robust data security protocols including encrypted file exchange, role-based access controls, NDA-bound engagements, and regular data backups. We additionally assume responsibility for data security as part of every engagement — not as an add-on.',
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
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process',  'url' => '/services/risk-advisory-augmenting-business-process'],
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
