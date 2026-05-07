<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class MaAdvisoryServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'm-a-advisory-services')->firstOrFail();

        // Clear existing sections for a clean re-seed
        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'M & A Advisory Services',
                    'title'       => 'Navigating Mergers & Acquisitions with Precision and Purpose',
                    'subtitle'    => 'Dev Mantra provides expert M&A advisory services, assisting businesses in achieving successful mergers and acquisitions. We offer strategic insights and personalized solutions to ensure smooth transactions and optimal outcomes for our clients.',
                    'description' => '',
                    'cta_text'    => 'Talk to an M&A Expert',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Unlock Growth with Premier M&A Advisory Services',
                    'description'  => 'At Dev Mantra, our M&A Advisory Services are designed to help businesses navigate the complex landscape of mergers and acquisitions. We bring strategic expertise and industry insights to ensure each transaction aligns with your growth objectives.',
                    'description2' => "Our team of seasoned professionals collaborates closely with clients, offering tailored solutions that address unique challenges and opportunities. We pride ourselves on delivering seamless, value-driven results — whether you're looking to expand through acquisition, consolidate through merger, or exit through a well-structured divestment.\n\nEvery M&A transaction is more than a financial event. It is a strategic inflection point. Dev Mantra's role is to ensure that inflection point becomes an advantage — with the rigour, preparation, and cross-functional depth your deal deserves.",
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
                    'title' => 'M & A Advisory Services Offered by Dev Mantra',
                    'items' => [
                        [
                            'title'       => 'M & A Advisory — Buy & Integrate',
                            'description' => 'We provide comprehensive buy-side advisory, guiding businesses through target identification, valuation, negotiation, and post-merger integration. Our structured approach ensures that acquisitions are not just completed — they are embedded effectively into your business to deliver the intended value.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Reshaping Results — Strategic M&A Planning',
                            'description' => 'Every successful transaction begins long before term sheets are signed. We work with leadership teams to define transaction rationale, evaluate strategic fit, and build the business case that forms the backbone of a credible deal process.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Divestment Strategy — Sell & Separate',
                            'description' => 'Our sell-side advisory covers the full divestment lifecycle — from carve-out planning and asset preparation to buyer identification, process management, and deal closure. We help you separate cleanly, position well, and negotiate terms that reflect the true value of what you\'re offering.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Corporate Finance Consulting',
                            'description' => 'We offer comprehensive corporate finance consulting services, including capital raising, debt restructuring, and financial modelling to support your M&A initiatives. Our advisory helps align capital structure with the strategic demands of the transaction.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Infrastructure Advisory & Consulting Services',
                            'description' => 'Dev Mantra provides specialised advice on infrastructure investments and project finance — ensuring that your projects are evaluated for financial soundness, risk-adjusted returns, and operational viability before capital is committed.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'M&A Tools — Connected Capital Technologies',
                            'description' => 'We leverage advanced M&A tools and technologies to streamline transactions, improve decision-making, and enhance the efficiency of your capital management processes. From data room management to deal analytics, we bring the right technology to every stage of the process.',
                            'points'      => [],
                        ],
                    ],
                ],
            ],

            // ── 4. PROCESS STEPS ─────────────────────────────────────────────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 4,
                'section_data' => [
                    'title'       => 'Our M&A Process — From First Call to Deal Close',
                    'description' => 'A structured, disciplined approach is what separates a smooth transaction from a complicated one. Here is how we work.',
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Discovery & Mandate',
                            'description' => 'Understand your strategic intent, define objectives, and structure the engagement.',
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'Preparation & Positioning',
                            'description' => 'Financial analysis, valuation, information memorandum, and deal readiness.',
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Market Approach',
                            'description' => 'Identify and approach suitable targets or buyers; manage the outreach process confidentially.',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Negotiation & Structuring',
                            'description' => 'Lead or support negotiations, structure deal terms, and manage due diligence.',
                        ],
                        [
                            'number'      => '05',
                            'stage'       => 'Closure & Integration',
                            'description' => 'Coordinate signing, regulatory filings, and post-deal integration or separation planning.',
                        ],
                    ],
                    'metrics' => [],
                ],
            ],

            // ── 5. WHY STAND OUT ─────────────────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 5,
                'section_data' => [
                    'title' => "Why Dev Mantra's M & A Advisory Services Stand Out",
                    'items' => [
                        [
                            'title'       => 'Industry Expertise',
                            'description' => "Dev Mantra's seasoned professionals provide deep insights and strategic advice tailored to each client's unique needs — across sectors, deal sizes, and transaction types.",
                        ],
                        [
                            'title'       => 'Advanced Tools & Technologies',
                            'description' => 'Our use of cutting-edge M&A tools and connected capital technologies streamlines transactions, improves decision-making, and gives our clients an edge at every stage of the deal process.',
                        ],
                        [
                            'title'       => 'Personalized Solutions',
                            'description' => 'We offer customized M&A strategies that align with your specific business goals, risk appetite, and stakeholder expectations — ensuring optimal outcomes rather than generic process outputs.',
                        ],
                        [
                            'title'       => 'Proven Track Record',
                            'description' => 'With a history of successful transactions and over ₹5,000 crore in deals advised, Dev Mantra consistently delivers measurable results — making us a trusted partner in M&A advisory.',
                        ],
                    ],
                ],
            ],

            // ── 6. FAQ ───────────────────────────────────────────────────────
            [
                'section_type' => 'faq',
                'sort_order'   => 6,
                'section_data' => [
                    'title'    => "Any questions? We've got you.",
                    'subtitle' => "Find answers to common questions about Dev Mantra's M&A advisory services.",
                    'items'    => [
                        [
                            'question' => 'What types of M&A transactions does Dev Mantra advise on?',
                            'answer'   => 'Dev Mantra advises on a full range of transactions including mergers, acquisitions, divestitures, joint ventures, management buyouts, and strategic partnerships — across sectors and transaction sizes. Our team works with both buy-side and sell-side clients.',
                        ],
                        [
                            'question' => 'How does Dev Mantra determine the valuation of a business in an M&A deal?',
                            'answer'   => 'We use a combination of valuation methodologies including Discounted Cash Flow (DCF) analysis, comparable company analysis, precedent transaction multiples, and asset-based approaches — selecting the most appropriate method based on the nature of the business and the deal context.',
                        ],
                        [
                            'question' => 'What is the typical timeline for an M&A transaction?',
                            'answer'   => 'Timelines vary depending on deal complexity, due diligence requirements, and regulatory approvals. A straightforward transaction may close in 3–6 months, while more complex cross-border deals can take 9–18 months. Dev Mantra structures clear milestones at the outset to keep the process on track.',
                        ],
                        [
                            'question' => 'How does Dev Mantra support post-merger integration?',
                            'answer'   => 'We assist with integration planning across functions — finance, operations, compliance, and reporting. Our focus is on ensuring the merged entity operates with a unified control environment, clear accountability structures, and the financial discipline needed to realize deal synergies.',
                        ],
                        [
                            'question' => 'Does Dev Mantra handle cross-border M&A transactions?',
                            'answer'   => 'Yes. Our team has experience navigating multi-jurisdictional M&A, including FEMA compliance, RBI approvals, transfer pricing considerations, and cross-border due diligence — supporting inbound and outbound transactions for Indian and international clients.',
                        ],
                    ],
                ],
            ],

            // ── 7. OTHER SERVICES ────────────────────────────────────────────
            [
                'section_type' => 'other-services',
                'sort_order'   => 7,
                'section_data' => [
                    'title' => 'Explore Our Other Services',
                    'items' => [
                        ['label' => 'Finance Accounts Compliance Outsourcing', 'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory', 'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process',  'url' => '/services/risk-advisory-augmenting-business-process'],
                        ['label' => 'IPO Advisory Services',                        'url' => '/services/ipo-advisory-services'],
                        ['label' => 'Virtual CFO Services',                         'url' => '/services/virtual-cfo-services'],
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
