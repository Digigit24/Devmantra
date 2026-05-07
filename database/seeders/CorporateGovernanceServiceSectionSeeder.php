<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Database\Seeder;

class CorporateGovernanceServiceSectionSeeder extends Seeder
{
    public function run(): void
    {
        $service = Service::where('slug', 'corporate-governance')->firstOrFail();

        $service->sections()->delete();

        $sections = [

            // ── 1. HERO ─────────────────────────────────────────────────────
            [
                'section_type' => 'hero',
                'sort_order'   => 1,
                'section_data' => [
                    'label'       => 'Corporate Governance Services at Dev Mantra',
                    'title'       => "Strong Governance is Not a Checkbox. It's a Competitive Advantage.",
                    'subtitle'    => 'At Dev Mantra, our commitment to exemplary corporate governance ensures accountability, transparency, and ethical management. We prioritize the interests of all stakeholders — fostering trust and credibility while enhancing operational performance and mitigating risks.',
                    'description' => 'Our robust governance framework supports sustainable growth and long-term success.',
                    'cta_text'    => 'Ensure Robust Governance Today',
                    'cta_url'     => '#contact',
                ],
            ],

            // ── 2. OVERVIEW ─────────────────────────────────────────────────
            [
                'section_type' => 'overview',
                'sort_order'   => 2,
                'section_data' => [
                    'title'        => 'Introduction to Corporate Governance Advisory Services',
                    'description'  => 'Dev Mantra emphasizes the critical importance of corporate governance in ensuring the long-term success and sustainability of every organization we work with. Corporate governance encompasses the systems, principles, and processes by which a company is directed and controlled — and when done well, it becomes one of the most powerful drivers of stakeholder confidence and business resilience.',
                    'description2' => "Our commitment to exemplary governance practices ensures we maintain a balance between the interests of all stakeholders — including shareholders, management, customers, suppliers, financiers, government, and the community.\n\nGood governance is increasingly a prerequisite — not a differentiator — for investors, lenders, and board members. Companies that build governance discipline early are better positioned for fundraising, IPOs, M&A transactions, and regulatory scrutiny. Dev Mantra helps you build that foundation with the right frameworks, the right documentation, and the right advisory support at every stage.",
                    'cta_text'     => '',
                    'cta_url'      => '#contact',
                    'stats'        => [],
                ],
            ],

            // ── 3. SERVICES GRID (6 Governance Principles) ───────────────────
            [
                'section_type' => 'services-grid',
                'sort_order'   => 3,
                'section_data' => [
                    'title' => 'Corporate Governance Principles',
                    'items' => [
                        [
                            'title'       => 'Accountability',
                            'description' => 'We hold leadership accountable to stakeholders — ensuring responsible and ethical management at every level of the organization.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Transparency',
                            'description' => 'We provide stakeholders with clear, timely, and accurate information about activities and performance — removing ambiguity and building confidence.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Fairness',
                            'description' => 'We treat all stakeholders equitably, ensuring that their interests are considered in decision-making processes — from minority shareholders to employees and communities.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Responsibility',
                            'description' => 'We act responsibly towards stakeholders and the community, taking into account the social and environmental impacts of business operations.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Independence',
                            'description' => 'We support the maintenance of an independent board of directors to ensure unbiased decision-making free from conflicts of interest.',
                            'points'      => [],
                        ],
                        [
                            'title'       => 'Ethical Conduct',
                            'description' => 'We promote and uphold high ethical standards in all business practices — ensuring integrity and trust are embedded in the governance culture, not just the policies.',
                            'points'      => [],
                        ],
                    ],
                ],
            ],

            // ── 4. WHY STAND OUT (Importance of Corporate Governance) ─────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 4,
                'section_data' => [
                    'title' => 'The Importance of Corporate Governance',
                    'items' => [
                        [
                            'title'       => 'Building Trust and Credibility',
                            'description' => 'Adherence to strong corporate governance principles builds trust and credibility with stakeholders. This trust is foundational to long-term relationships, investor confidence, and business sustainability.',
                        ],
                        [
                            'title'       => 'Promoting Transparency',
                            'description' => 'Transparency in operations and decision-making is a cornerstone of governance best practice. This openness supports ethical business conduct and provides investors and regulators with the visibility they need.',
                        ],
                        [
                            'title'       => 'Ensuring Accountability',
                            'description' => 'Effective governance ensures that management is accountable to the board, and the board is accountable to shareholders — creating a framework that supports informed, responsible decision-making at every level.',
                        ],
                        [
                            'title'       => 'Mitigating Risks',
                            'description' => 'Robust governance structures enable businesses to proactively identify and manage risks — ensuring that potential issues are addressed before they become significant operational or reputational problems.',
                        ],
                    ],
                ],
            ],

            // ── 5. PROCESS STEPS (Governance Framework — 5 Components) ────────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 5,
                'section_data' => [
                    'title'       => 'Our Corporate Governance Framework',
                    'description' => "Dev Mantra's corporate governance advisory services are built around five core framework components — each designed to work together as a coherent governance system rather than isolated policies.",
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Board Oversight',
                            'description' => "The board is responsible for overseeing the company's management and ensuring alignment with the interests of all stakeholders. Dev Mantra supports board composition, charter development, and governance readiness reviews.",
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'Executive Management Alignment',
                            'description' => 'The executive management team handles day-to-day operations while adhering to governance principles — ensuring strategic alignment with long-term goals and clear accountability to the board.',
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Specialized Committees',
                            'description' => 'Audit, risk, and nomination committees support the board in fulfilling its governance responsibilities. Dev Mantra assists in designing committee charters, terms of reference, and reporting frameworks.',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Policies and Procedures',
                            'description' => 'Clear policies and procedures ensure consistent, fair, and ethical practices throughout the organization — from related party transaction policies to whistleblower frameworks and code of conduct documentation.',
                        ],
                        [
                            'number'      => '05',
                            'stage'       => 'Internal Controls',
                            'description' => 'Effective internal controls manage risk and ensure the integrity of financial reporting and operational processes. Dev Mantra reviews, documents, and strengthens internal control environments across entities.',
                        ],
                    ],
                    'metrics' => [],
                ],
            ],

            // ── 6. PROCESS STEPS (Governance Advisory Approach — 4 Steps) ─────
            [
                'section_type' => 'process-steps',
                'sort_order'   => 6,
                'section_data' => [
                    'title'       => 'Our Governance Advisory Approach',
                    'description' => '',
                    'steps'       => [
                        [
                            'number'      => '01',
                            'stage'       => 'Governance Health Check',
                            'description' => 'Assess the current state of your governance framework — identifying gaps in board composition, documentation, controls, and compliance.',
                        ],
                        [
                            'number'      => '02',
                            'stage'       => 'Framework Design',
                            'description' => "Design or strengthen governance policies, committee structures, internal controls, and reporting frameworks aligned to your company's stage and stakeholder expectations.",
                        ],
                        [
                            'number'      => '03',
                            'stage'       => 'Implementation Support',
                            'description' => 'Work alongside your leadership and board to implement governance improvements — including board packs, policy rollout, and committee operationalization.',
                        ],
                        [
                            'number'      => '04',
                            'stage'       => 'Ongoing Advisory',
                            'description' => 'Provide continuous governance support, regulatory compliance monitoring, and periodic governance reviews to ensure your framework evolves with the business.',
                        ],
                    ],
                    'metrics' => [],
                ],
            ],

            // ── 7. WHY STAND OUT (USP Cards) ─────────────────────────────────
            [
                'section_type' => 'why-stand-out',
                'sort_order'   => 7,
                'section_data' => [
                    'title' => 'Our Commitment as the Leading Corporate Governance Advisory',
                    'items' => [
                        [
                            'title'       => 'Deep Governance Expertise',
                            'description' => 'Dev Mantra has a team of professionals with deep expertise in corporate governance frameworks, regulatory requirements, and board advisory. Our understanding of governance across Indian and international contexts ensures relevant, practical guidance.',
                        ],
                        [
                            'title'       => 'Tailored Governance Frameworks',
                            'description' => "We do not apply a one-size-fits-all governance template. Every framework we design is calibrated to your company's stage, ownership structure, investor expectations, and regulatory environment.",
                        ],
                        [
                            'title'       => 'Integrated with Risk & Compliance',
                            'description' => 'Our governance advisory is fully integrated with our risk advisory and compliance outsourcing services — ensuring that governance principles are embedded in your controls and processes, not just your policy documents.',
                        ],
                        [
                            'title'       => 'Continuous Improvement Mindset',
                            'description' => 'We believe governance is a journey, not a destination. Dev Mantra supports ongoing review and improvement of governance practices — ensuring your framework keeps pace with regulatory change, business growth, and evolving stakeholder expectations.',
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
                            'question' => 'At what stage should a startup or SME start thinking about corporate governance?',
                            'answer'   => 'Earlier than most founders expect. The moment you have external investors, a formal board, or regulatory obligations — governance matters. Even pre-Series A companies benefit from basic governance hygiene: proper board minutes, a shareholder agreement, a related party transaction policy, and clean financial controls. These directly affect your valuation and how smoothly a fundraising or M&A process goes.',
                        ],
                        [
                            'question' => 'What is the difference between corporate governance advisory and company secretarial services?',
                            'answer'   => 'Company secretarial services focus on statutory compliance — MCA filings, AGM documentation, board meeting minutes, and regulatory submissions. Corporate governance advisory is broader — it covers the design of governance frameworks, board effectiveness, internal controls, risk oversight structures, and stakeholder accountability. Dev Mantra provides both, fully integrated.',
                        ],
                        [
                            'question' => 'What does a governance health check typically involve?',
                            'answer'   => 'A governance health check assesses your current state across five dimensions: board composition and effectiveness, policy and documentation completeness, internal controls design, related party transaction management, and compliance standing. We deliver a structured report with risk-rated observations and a prioritized action plan.',
                        ],
                        [
                            'question' => 'How does good corporate governance affect fundraising and investor relations?',
                            'answer'   => 'Investors — whether PE, VC, or strategic — conduct governance due diligence as part of every transaction. Weaknesses in board composition, related party transactions, internal controls, or compliance standing are common deal blockers. Companies with strong governance frameworks command better valuations, close transactions faster, and sustain investor confidence through the holding period.',
                        ],
                        [
                            'question' => 'Does Dev Mantra support governance advisory for listed companies?',
                            'answer'   => 'Yes. For listed entities, we provide SEBI compliance governance support — including Listing Obligations and Disclosure Requirements (LODR) compliance, board and committee composition advisory, related party transaction frameworks, and Corporate Social Responsibility (CSR) governance. We also support pre-IPO governance structuring for companies preparing for a public listing.',
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
                        ['label' => 'Finance Accounts Compliance Outsourcing',      'url' => '/services/finance-accounts-compliance-outsourcing-services'],
                        ['label' => 'Deals, Due Diligence & Transaction Advisory',  'url' => '/services/deals-due-diligence-transaction-advisory'],
                        ['label' => 'Risk Advisory & Augmenting Business Process',  'url' => '/services/risk-advisory-augmenting-business-process'],
                        ['label' => 'IPO Advisory Services',                        'url' => '/services/ipo-advisory-services'],
                        ['label' => 'Virtual CFO Services',                         'url' => '/services/virtual-cfo-services'],
                        ['label' => 'M & A Advisory Services',                      'url' => '/services/m-a-advisory-services'],
                        ['label' => 'GCC (Global Capability Centers)',              'url' => '/services/gcc-global-capability-centers'],
                        ['label' => 'Business Setup & Startup Collaboration',       'url' => '/services/business-set-up-startup-collaboration'],
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
