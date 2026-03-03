<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class IpoAdvisoryServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'ipo-advisory-services')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'IPO Advisory Services',
                    'title'       => 'From Private to Public — With the Right Partner at Every Step',
                    'subtitle'    => "Dev Mantra offers expert IPO advisory services to guide you through every step of going public. From strategic planning to execution, our IPO consultants provide tailored advice to ensure a successful and smooth process — helping you achieve your financial and strategic goals.",
                    'description' => '',
                    'cta_text'    => 'Start Your IPO Journey',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Navigating Your IPO Journey with Confidence',
                    'description'  => "Dev Mantra's IPO Advisory Services are designed to transform your public offering into a success story. Our objective is to provide comprehensive, tailored guidance throughout the entire IPO process — from initial planning to market debut.\n\nWe specialize in crafting strategic roadmaps, ensuring regulatory compliance, and optimizing market positioning. With our expertise, we help you navigate complex financial landscapes, attract investors, and achieve a seamless transition to public company status.",
                    'description2' => "Our commitment is to add value, mitigate risks, and drive your business toward its growth aspirations. Going public is one of the most significant milestones a company can achieve. The decisions made in the 12–18 months before listing define how the market will perceive and price your business for years to come. Dev Mantra ensures those decisions are made with the right preparation, the right counsel, and the right documentation in place.",
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
                    'title' => 'IPO Advisory Services Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Pre-IPO Advisory Services',
                            'description' => 'We provide expert pre-IPO advisory services to prepare your business for a successful public offering. This includes strategic planning, financial analysis, and market positioning to ensure readiness for the IPO process — well before the official filing window opens.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'IPO Strategy Development',
                            'description' => 'Our team helps develop a robust IPO strategy, including timing, valuation, and market approach. We tailor strategies to align with your business goals and maximize investor appeal across retail, HNI, and institutional segments.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Regulatory Compliance Guidance',
                            'description' => 'Ensure seamless compliance with all regulatory requirements through our comprehensive IPO services. We guide you through legal and financial regulations, mitigating risks and ensuring adherence to SEBI guidelines, industry standards, and disclosure requirements.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Investor Relations Management',
                            'description' => 'Our IPO advisory services include managing investor relations, preparing pitch materials, and facilitating communications with potential investors — building confidence and broad-based support ahead of your listing.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Market Positioning & Valuation',
                            'description' => "Dev Mantra offers expert services in market positioning and valuation to accurately assess your company's worth. We help you craft a compelling valuation narrative that attracts investors and supports your desired pricing band.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Post-IPO Support',
                            'description' => 'Beyond the IPO, our services extend to post-IPO support — including financial reporting, compliance, and ongoing advisory to ensure sustained performance and credibility in the public market.',
                            'points'      => [],
                        ],
                    ],
                ],
            ],

            // ── 4. IPO READINESS CHECKLIST (pillars) ─────────────────────────
            [
                'section_type' => 'pillars',
                'sort_order'   => 4,
                'section_data' => [
                    'title'   => 'Is Your Business IPO-Ready?',
                    'pillars' => [
                        [
                            'title'  => 'Financial Readiness',
                            'points' => [
                                '3 years of audited financial statements (restated if required)',
                                'Clean and documented revenue recognition policies',
                                'Management accounts aligned to statutory reporting',
                                'Robust budgeting and forecasting model in place',
                            ],
                        ],
                        [
                            'title'  => 'Governance & Compliance',
                            'points' => [
                                'Board composition meeting SEBI/listing requirements',
                                'Related party transactions documented and arm\'s-length verified',
                                'Internal controls reviewed and documented',
                                'Secretarial and MCA compliance up to date',
                            ],
                        ],
                        [
                            'title'  => 'Transaction Readiness',
                            'points' => [
                                'Clear shareholding structure and cap table',
                                'ESOP scheme documented and valued',
                                'Data room organized and populated',
                                'DRHP drafting initiated',
                            ],
                        ],
                        [
                            'title'  => 'Investor & Market Readiness',
                            'points' => [
                                'Investment thesis and equity story defined',
                                'Analyst-ready financial model prepared',
                                'Investor FAQ and pitch deck ready',
                                'IR communication plan in place',
                            ],
                        ],
                    ],
                ],
            ],

            // ── 5. BENEFITS LIST ─────────────────────────────────────────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 5,
                'section_data' => [
                    'title' => 'Benefits of Getting IPO Advisory Services',
                    'items' => [
                        'Tailored strategic planning for a successful IPO, including market positioning, valuation, and timing to maximize value and attract investors.',
                        'Expert support in navigating complex regulatory requirements, ensuring adherence to legal standards and minimizing risks associated with the IPO process.',
                        'Professional management of investor relations, including communication and pitch preparation, to build confidence and secure investor support.',
                        'Ongoing assistance with financial reporting, compliance, and strategic adjustments to ensure continued success and growth after going public.',
                    ],
                ],
            ],

            // ── 6. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 6,
                'section_data' => [
                    'title' => "Why Dev Mantra's IPO Advisory Services Stand Out",
                    'items' => [
                        [
                            'title'       => 'Experienced Team',
                            'description' => 'Dev Mantra has a team of highly skilled professionals who specialize in financial regulations. Their deep understanding of compliance requirements ensures that all IPO-related activities adhere to the latest legal standards — reducing risk throughout the listing process.',
                        ],
                        [
                            'title'       => 'Customized Solutions',
                            'description' => 'Dev Mantra provides tailored IPO advisory that caters to the specific stage, sector, and scale of each client. We design bespoke solutions that address distinct IPO challenges — ensuring optimal alignment with your listing objectives.',
                        ],
                        [
                            'title'       => 'Responsive Support',
                            'description' => 'Dev Mantra prides itself on its responsive support model. During the high-intensity IPO process, timely responses matter. Our dedicated teams ensure that client queries and regulatory deadlines are addressed promptly and without delay.',
                        ],
                        [
                            'title'       => 'Proactive Risk Management',
                            'description' => 'Dev Mantra employs a proactive approach to IPO risk management, identifying potential issues — from documentation gaps to regulatory red flags — before they reach the regulators or investors.',
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
                            'question' => 'How early should a company begin the IPO advisory process?',
                            'answer'   => 'Ideally 18–24 months before the target listing date. This allows sufficient time for financial restatements, governance structuring, regulatory alignment, and building an investor-ready narrative. Starting early also gives flexibility to adjust timelines based on market conditions.',
                        ],
                        [
                            'question' => 'What is the role of a financial advisor in an IPO versus a merchant banker?',
                            'answer'   => "A merchant banker (Book Running Lead Manager) is the SEBI-registered entity responsible for managing the official IPO process, including DRHP filing and book-building. Dev Mantra's role as financial advisor is complementary — we focus on IPO readiness, financial structuring, valuation support, investor relations preparation, and post-IPO compliance. We work alongside your BRLM, not in place of them.",
                        ],
                        [
                            'question' => 'What are the most common reasons IPOs get delayed or fail?',
                            'answer'   => "The most common causes are: inadequate financial documentation and restatements, governance gaps (board composition, related party transactions), unresolved litigation or regulatory matters, weak internal controls, and poor investor relations strategy. Dev Mantra's pre-IPO advisory process is specifically designed to identify and resolve these issues well before the filing window.",
                        ],
                        [
                            'question' => 'Does Dev Mantra support both SME IPOs and mainboard listings?',
                            'answer'   => 'Yes. Our advisory covers both SME IPO listings on NSE Emerge and BSE SME platforms, as well as mainboard listings. The scope and complexity differ significantly, and we scope engagements accordingly.',
                        ],
                        [
                            'question' => 'What post-IPO support does Dev Mantra provide?',
                            'answer'   => 'Post-listing, we support quarterly financial reporting compliance, SEBI disclosure obligations, investor communication, related party transaction management, and ongoing governance advisory — ensuring your company meets its obligations as a listed entity.',
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
                        ['label' => 'Finance Accounts Compliance Outsourcing',     'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory-augmenting-business-process'],
                        ['label' => 'Virtual CFO Services',                        'url' => '/services/virtual-cfo-services'],
                        ['label' => 'M & A Advisory Services',                     'url' => '/services/m-a-advisory-services'],
                        ['label' => 'GCC (Global Capability Centers)',             'url' => '/services/gcc-global-capability-centers'],
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

        $this->command->info("Seeded {$service->title}: " . count($sections) . ' sections created.');
    }
}
