<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class VirtualCfoServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'virtual-cfo-services')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'Virtual CFO Services',
                    'title'       => 'Senior Financial Leadership, Without the Full-Time Overhead',
                    'subtitle'    => "Dev Mantra's Virtual CFO services offer expert financial guidance tailored for startups and growing businesses. We provide strategic insights, financial planning, and reporting to optimize your financial management and drive growth.",
                    'description' => 'Partner with us for Virtual CFO support that thinks like a finance leader — and acts like one.',
                    'cta_text'    => 'Hire a Virtual CFO',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => "Boost Operational Efficiency & Productivity with Dev Mantra's Smart Virtual CFO",
                    'description'  => "Boost your operational efficiency and productivity with Dev Mantra's Smart Virtual CFO services. This service offers expert financial management and strategic guidance without the need for a full-time, in-house CFO.\n\nBy leveraging advanced technology and deep financial expertise, Dev Mantra's Virtual CFO service provides accurate financial forecasting, budget planning, and insightful analysis — helping you make informed decisions at every stage of growth.",
                    'description2' => "It streamlines financial operations, reduces overhead costs, and ensures compliance with regulatory standards. With Dev Mantra's Smart Virtual CFO, your business can focus on growth and core activities while enjoying the benefits of top-tier financial management and enhanced productivity. Whether you are a seed-stage startup navigating your first audit or a scaling enterprise preparing for an investor round, our Virtual CFOs bring the depth and discipline your finance function needs — exactly when you need it.",
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
                    'title' => 'Smart Virtual CFO Services Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Financial Planning & Analysis',
                            'description' => "Dev Mantra's Virtual CFO service provides comprehensive financial planning and analysis, including budgeting, forecasting, and strategic financial advice to help you make informed business decisions.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Cash Flow Management',
                            'description' => 'The Virtual CFO ensures efficient cash flow management by monitoring, analyzing, and optimizing your cash flow — ensuring your business has the necessary liquidity to operate and grow smoothly.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Cost Control & Reduction',
                            'description' => "With a focus on cost control, the Virtual CFO identifies areas for cost reduction and implements strategies to minimize expenses, improving your company's profitability without compromising on delivery.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Regulatory Compliance & Risk Management',
                            'description' => "Dev Mantra's Virtual CFO ensures your business adheres to all regulatory requirements, minimizing legal risks and safeguarding your company against potential compliance issues across jurisdictions.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Performance Monitoring & Reporting',
                            'description' => "The Virtual CFO tracks key performance indicators (KPIs) and generates detailed financial reports, providing you with valuable insights into your business's financial health and performance.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Strategic Financial Guidance',
                            'description' => "Offering expert strategic financial guidance, Dev Mantra's Virtual CFO helps you navigate complex financial challenges, supports long-term planning, and aligns your financial strategies with your business goals.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Growth Consulting',
                            'description' => 'Tailored guidance to support business expansion, develop effective scaling strategies, and drive market development — ensuring sustainable growth and competitive advantage at every stage.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Assurance Services',
                            'description' => 'We provide assurance on financial accuracy and integrity through audits and reviews, building trust and transparency with stakeholders, investors, and board members.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Investment Analysis & Strategy',
                            'description' => "Expert analysis and strategic advice on investment opportunities to maximize returns and align with your business's financial goals. We help identify valuable ROI opportunities through smart, structured steps.",
                            'points'      => [],
                        ],
                    ],
                ],
            ],

            // ── 4. WHAT YOUR VIRTUAL CFO HANDLES (benefits-list) ─────────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 4,
                'section_data' => [
                    'title' => 'Get the Opportunity to Work with the Best Chief Financial Officer',
                    'items' => [
                        'Fund Raising and Deal Assistance',
                        'Mergers and Acquisitions',
                        'Transaction Advisory Services',
                        'Accounting and Payroll Services',
                        'Assistance in Critical Tax Matters',
                        'Board Reporting and Representation',
                        'Team Evaluation and GAP Analysis',
                        'Budgeting, Forecasting and Variance Analysis',
                    ],
                ],
            ],

            // ── 5. HOW IT WORKS (process-steps) ─────────────────────────────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 5,
                'section_data' => [
                    'title'       => 'How Our Virtual CFO Engagement Works',
                    'description' => 'From the first scoping call to ongoing monthly oversight — a structured, predictable engagement model so you always know what to expect.',
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Discovery & Scoping',
                            'description' => 'We assess your current financial function, gaps, reporting needs, and business stage to define scope and priorities.',
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'Onboarding & Setup',
                            'description' => 'We integrate with your existing tools, set up reporting templates, align on SLAs, and introduce your dedicated CFO team.',
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Active Engagement',
                            'description' => 'Monthly financial reviews, budget vs. actuals, cash flow management, compliance oversight, and board-ready reporting.',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Strategic Advisory',
                            'description' => 'Ongoing guidance on fundraising, investor readiness, expansion decisions, cost strategy, and M&A preparation as needed.',
                        ],
                    ],
                    'metrics' => [],
                ],
            ],

            // ── 6. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 6,
                'section_data' => [
                    'title' => "Why Dev Mantra's Virtual CFO Services Stand Out",
                    'items' => [
                        [
                            'title'       => 'Experienced Team',
                            'description' => "Dev Mantra has a team of highly skilled professionals who specialize in financial regulations. Their deep understanding of compliance requirements ensures that all financial activities adhere to the latest legal standards — reducing the risk of non-compliance and associated penalties.",
                        ],
                        [
                            'title'       => 'Customized Solutions',
                            'description' => 'Dev Mantra provides tailored Virtual CFO services that cater to the specific needs of each client. By understanding the unique requirements of different businesses and industries, we design and implement bespoke solutions that address distinct financial challenges effectively.',
                        ],
                        [
                            'title'       => 'Responsive Support',
                            'description' => 'Dev Mantra prides itself on its responsive support model. Our dedicated teams ensure that client queries and concerns are addressed promptly and efficiently — fostering the long-term partnerships that define our practice.',
                        ],
                        [
                            'title'       => 'Proactive Risk Management',
                            'description' => "Dev Mantra employs a proactive approach to risk management, continuously monitoring and assessing financial and compliance risks. Our early warning systems help identify potential issues before they escalate, maintaining the integrity of your financial operations.",
                        ],
                    ],
                ],
            ],

            // ── 7. WHO THIS IS RIGHT FOR (why-stand-out with 3 items) ─────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 7,
                'section_data' => [
                    'title' => 'Who Benefits from a Virtual CFO?',
                    'items' => [
                        [
                            'title'       => 'Startups & Early-Stage Businesses',
                            'description' => "You need financial discipline and investor-ready reporting but aren't at the stage to justify a full-time CFO hire. A Virtual CFO gives you the structure and credibility to raise capital and scale with confidence.",
                        ],
                        [
                            'title'       => 'Growing SMEs',
                            'description' => "You've outgrown spreadsheets and need cleaner forecasting, cost controls, and board reporting — without a six-figure finance hire. Our Virtual CFO fits directly into your current team and systems.",
                        ],
                        [
                            'title'       => 'Businesses Preparing for M&A or Fundraising',
                            'description' => 'Investors and acquirers scrutinize financial hygiene. A Virtual CFO ensures your books are clean, your reporting is accurate, and your data room is ready — well before the process begins.',
                        ],
                    ],
                ],
            ],

            // ── 8. FAQ ───────────────────────────────────────────────────────
            [
                'section_type' => 'faq',
                'sort_order'   => 8,
                'section_data' => [
                    'title'    => "Any Questions? We've Got You.",
                    'subtitle' => "Find answers to common questions about Dev Mantra's Virtual CFO services.",
                    'items'    => [
                        [
                            'question' => 'What does a Virtual CFO actually do differently from a bookkeeper or accountant?',
                            'answer'   => "A bookkeeper records transactions. An accountant ensures accuracy and compliance. A Virtual CFO uses that financial data to advise on strategy — cash runway, fundraising readiness, cost structure, investor reporting, and growth decisions. Dev Mantra's Virtual CFOs operate at the strategic level while our accounting teams handle the operational layer beneath them.",
                        ],
                        [
                            'question' => 'How is a Virtual CFO engagement structured — full-time, part-time, or retainer?',
                            'answer'   => 'Our Virtual CFO engagements are typically structured as monthly retainers, scoped by the complexity of your business and the level of involvement required. Some clients need a few hours a week for oversight and reporting; others need a near full-time engagement during fundraising or M&A processes. We define scope clearly at onboarding.',
                        ],
                        [
                            'question' => 'Can a Virtual CFO work with my existing accounting tools and team?',
                            'answer'   => 'Yes. Our Virtual CFOs are experienced across major platforms including Xero, QuickBooks, Tally, Zoho Books, SAP, and others. They integrate with your existing team and tools — augmenting what you have rather than replacing it.',
                        ],
                        [
                            'question' => 'How does Dev Mantra ensure continuity if my assigned CFO is unavailable?',
                            'answer'   => 'All client engagements are documented and team-based — not dependent on a single individual. Your engagement is backed by a structured team with defined knowledge transfer protocols, so continuity is never at risk.',
                        ],
                        [
                            'question' => 'At what stage should a startup consider bringing in a Virtual CFO?',
                            'answer'   => 'The right time is earlier than most founders expect — typically from Seed stage onwards, or when you begin raising institutional capital. Investor due diligence, board reporting, regulatory filings, and financial modelling all require CFO-level thinking, and getting the right structures in place early saves significant time and cost later.',
                        ],
                    ],
                ],
            ],

            // ── 9. OTHER SERVICES ────────────────────────────────────────────
            [
                'section_type' => 'other-services',
                'sort_order'   => 9,
                'section_data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing',     'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process', 'url' => '/services/risk-advisory-augmenting-business-process'],
                        ['label' => 'IPO Advisory Services',                       'url' => '/services/ipo-advisory-services'],
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
