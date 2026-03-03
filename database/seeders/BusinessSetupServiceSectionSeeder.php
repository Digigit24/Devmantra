<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class BusinessSetupServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'business-set-up-startup-collaboration')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'Business Setup & Startup Collaboration Services',
                    'title'       => 'Your Business Vision, Built on the Right Foundation',
                    'subtitle'    => 'Dev Mantra provides comprehensive Business Setup and Startup Collaboration Services — guiding you through company registration, compliance, and operational setup. Our expert consultants streamline the process, ensuring a smooth launch and a strategic foundation for long-term growth.',
                    'description' => 'Transform your startup vision into a thriving business reality — with the right partners from day one.',
                    'cta_text'    => 'Start Your Business Setup',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Prepare Your Business to Enter the Competitive Market',
                    'description'  => "At Dev Mantra, we equip your business with the tools and insights needed to thrive in a competitive market. Our comprehensive services include strategic business planning, market analysis, and financial advisory to ensure you make informed decisions from the start.\n\nWe help streamline your operations, optimize cost structures, and develop robust strategies for growth. Our expert team provides tailored solutions to navigate the challenges of early-stage business — from incorporation and regulatory filings to funding, governance, and scale-up planning.",
                    'description2' => "Setting up a business involves far more than registration. The structural decisions made in the first six months — entity type, shareholding, regulatory standing, financial processes, and governance framework — shape how investable, scalable, and compliant your business is for years to come. Dev Mantra ensures those decisions are made well.",
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
                    'title' => 'Business Set Up & Startup Collaboration Services Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Business Incorporation',
                            'description' => 'Assisting in the legal and procedural aspects of company formation — ensuring compliance with all regulatory requirements across entity types including Private Limited, LLP, OPC, and branch structures.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Strategic Planning',
                            'description' => 'Developing tailored strategies to guide startups through the initial phases of growth — from market entry and product positioning to operational setup and scaling operations.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Financial Advisory',
                            'description' => 'Offering financial planning, budgeting, and fundraising assistance to help you secure capital, optimize financial management, and build investor-ready financials from the ground up.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Digital Enablement',
                            'description' => 'Providing IT infrastructure setup, software selection, and digital process design to enhance operational efficiency and ensure your business runs on scalable, modern systems from launch.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Collaboration Opportunities',
                            'description' => 'Facilitating partnerships, joint ventures, and networking opportunities to expand your business reach and leverage synergies with the right strategic partners.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Mentorship from Experts',
                            'description' => 'Offering guidance and mentorship from seasoned entrepreneurs and industry experts to navigate early-stage challenges, refine business strategies, and accelerate time to market.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Financial Inclusion',
                            'description' => 'Ensuring access to the right financial services, banking relationships, and funding resources to promote equitable growth and long-term sustainability for your startup.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Succession Planning',
                            'description' => "Developing strategies for leadership transition and long-term business continuity — safeguarding your company's future from the earliest stages of its journey.",
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Internal Audit',
                            'description' => 'Conducting thorough audits to assess internal controls, compliance standing, and operational efficiency — helping to mitigate risks and build the governance discipline that investors and regulators expect.',
                            'points'      => [],
                        ],
                    ],
                ],
            ],

            // ── 4. PROGRAM OFFERINGS (why-stand-out) ─────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 4,
                'section_data' => [
                    'title' => 'Program Designing Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'Incubation',
                            'description' => 'Our incubation services are designed to nurture early-stage startups with the resources, mentorship, and expert guidance they need to develop and refine their business models before going to market.',
                        ],
                        [
                            'title'       => 'Acceleration',
                            'description' => 'For startups poised to scale, our acceleration programs deliver the strategic boost needed to reach new heights — focused on growth strategies, advanced networking, investor relations, and market expansion.',
                        ],
                        [
                            'title'       => 'Government Projects',
                            'description' => 'Navigating government projects and public sector opportunities can be complex. Dev Mantra provides expert consultation, proposal assistance, partnership facilitation, and resource access to help you succeed in this space.',
                        ],
                        [
                            'title'       => 'Social Impact',
                            'description' => 'We believe in businesses that do good while doing well. Our social impact focus ensures that your startup not only thrives economically but also contributes positively to the communities and ecosystems around it.',
                        ],
                    ],
                ],
            ],

            // ── 5. BUSINESS LIFECYCLE SUPPORT (process-steps) ────────────────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 5,
                'section_data' => [
                    'title'       => 'We Support Your Business at Every Stage of Growth',
                    'description' => "Dev Mantra's setup and collaboration services are designed to be relevant beyond incorporation — supporting your business from first registration through to scale.",
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Launch',
                            'description' => 'Business incorporation, initial registrations, RBI approvals & FEMA compliance.',
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'Seed',
                            'description' => 'Virtual CFO setup, accounting & compliance process design, regulatory framework.',
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Early Growth',
                            'description' => 'Financial planning, fundraising support, governance framework, process documentation.',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Scale',
                            'description' => 'Investor readiness, due diligence preparation, strategic partnerships, expansion planning.',
                        ],
                        [
                            'number'      => '05',
                            'stage'       => 'Maturity',
                            'description' => 'Succession planning, corporate governance advisory, internal audit, international structuring.',
                        ],
                    ],
                    'metrics' => [],
                ],
            ],

            // ── 6. BENEFITS LIST ─────────────────────────────────────────────
            [
                'section_type' => 'benefits-list',
                'sort_order'   => 6,
                'section_data' => [
                    'title' => 'Benefits of Company Incorporation and Registration Services',
                    'items' => [
                        'Comprehensive support across all legal, regulatory, and operational setup requirements',
                        'Full fulfillment of incorporation and ongoing compliance obligations — nothing missed',
                        'Cost-effective, structured solutions designed for the budgets and priorities of growing businesses',
                    ],
                ],
            ],

            // ── 7. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 7,
                'section_data' => [
                    'title' => "Why Dev Mantra's Business Setup Services Stand Out",
                    'items' => [
                        [
                            'title'       => 'Comprehensive Solutions',
                            'description' => 'Dev Mantra offers end-to-end services covering all aspects of business setup and startup collaboration — from legal incorporation to financial systems, governance, and growth strategy — ensuring a seamless, integrated experience.',
                        ],
                        [
                            'title'       => 'Proven Track Record',
                            'description' => 'Dev Mantra has a history of successful business incorporations and startup collaborations, backed by positive client outcomes and long-term relationships that extend well beyond the initial setup phase.',
                        ],
                        [
                            'title'       => 'Customized Approach',
                            'description' => 'We tailor our services to meet the unique needs of each client — providing personalized solutions that align with your specific business model, industry, and growth ambitions.',
                        ],
                        [
                            'title'       => 'Strong Network',
                            'description' => 'We leverage our extensive network of industry contacts, investors, legal professionals, and regulatory specialists to provide valuable connections and real opportunities that accelerate your business growth.',
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
                    'subtitle' => '',
                    'items'    => [
                        [
                            'question' => 'What type of business entity should I register in India?',
                            'answer'   => 'The right entity type depends on your ownership structure, liability preferences, funding plans, and operational requirements. The most common options are Private Limited Company (recommended for most startups seeking investment), Limited Liability Partnership (LLP), One Person Company (OPC), and Branch / Liaison Office (for foreign companies entering India). Dev Mantra helps you evaluate the right structure before you file — because changing it later is costly and complex.',
                        ],
                        [
                            'question' => 'How long does company incorporation take in India?',
                            'answer'   => 'A standard Private Limited Company can typically be incorporated within 10–15 working days, assuming all documents are in order. Delays usually arise from name approval, DIN/DSC issues, or incomplete documentation. Dev Mantra manages the entire process end-to-end to keep timelines predictable.',
                        ],
                        [
                            'question' => 'What regulatory approvals are required for foreign companies setting up in India?',
                            'answer'   => "Foreign companies entering India need to navigate FEMA compliance, RBI approvals (for FDI-funded entities), sectoral licensing requirements, and GST registration. Depending on the business activity, additional approvals from DPIIT, SEBI, or RBI may apply. Dev Mantra's India Entry advisory covers all of these — as part of our GCC and Business Setup services.",
                        ],
                        [
                            'question' => 'Does Dev Mantra support startups that are pre-revenue?',
                            'answer'   => 'Yes. Many of our clients come to us at the idea or pre-product stage. We help with entity structuring, cap table design, founder agreements, ESOP setup, compliance calendar setup, and early-stage financial processes — building the governance and financial discipline that investors look for before a seed round.',
                        ],
                        [
                            'question' => 'Can Dev Mantra help with fundraising and investor readiness?',
                            'answer'   => 'Yes. Our financial advisory and Virtual CFO services include fundraising support — covering financial modelling, investor-ready pitch decks, data room preparation, and due diligence readiness. We also facilitate introductions through our network of investors and industry partners where relevant.',
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
                        ['label' => 'Virtual CFO Services',                        'url' => '/services/virtual-cfo-services'],
                        ['label' => 'M & A Advisory Services',                     'url' => '/services/m-a-advisory-services'],
                        ['label' => 'GCC (Global Capability Centers)',             'url' => '/services/gcc-global-capability-centers'],
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
