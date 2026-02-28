<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Newsletter;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Superadmin user
        User::updateOrCreate(
            ['email' => 'admin@devmantra.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('DevMantra@2025'),
                'is_admin' => true,
            ]
        );

        // Services (matching original static site)
        $services = [
            [
                'title' => 'Virtual CFO Services',
                'short_description' => 'Strategic financial leadership on demand — budgeting, forecasting, and cash flow management without a full-time hire.',
                'content' => '<p>At Dev Mantra, our Virtual CFO services provide your business with strategic financial leadership without the overhead of a full-time CFO. Our experienced professionals work closely with your team to deliver comprehensive financial management.</p><h3>What We Offer</h3><ul><li>Monthly Financial Reporting & Analysis</li><li>Budgeting & Forecasting</li><li>Cash Flow Management & Optimization</li><li>Financial Strategy & Planning</li><li>Investor Relations & Fundraising Support</li><li>Board Reporting & Governance</li></ul><h3>Why Choose a Virtual CFO?</h3><p>Growing businesses need strategic financial guidance but may not require or afford a full-time CFO. Our Virtual CFO service bridges this gap, providing C-suite financial expertise on a flexible, scalable basis.</p>',
                'icon' => 'fa-solid fa-chart-line',
                'show_on_homepage' => true,
                'sort_order' => 1,
                'status' => 'published',
            ],
            [
                'title' => 'Finance Accounts Compliance Outsourcing Services',
                'short_description' => 'End-to-end outsourcing for bookkeeping, accounts payable/receivable, and regulatory compliance across jurisdictions.',
                'content' => '<p>At Dev Mantra, we use state-of-the-art accounting software and proven methodologies to deliver effortless bookkeeping and accounting services. Our team ensures your financial records are accurate, compliant, and up-to-date.</p><h3>Core Services</h3><ul><li>Accounts and BookKeeping — Voucher Entry, General Ledger Adjustments, MIS Preparation</li><li>Payroll Accounting — Salary Processing, PF/ESI Compliance, TDS on Salary</li><li>Tax Planning & Strategy — Direct and Indirect Tax Planning</li><li>International Taxation — Transfer Pricing, DTAA Advisory</li><li>Regulatory & Compliance Advisory — GST, Companies Act, SEBI Compliance</li></ul>',
                'icon' => 'fa-solid fa-book',
                'show_on_homepage' => true,
                'sort_order' => 2,
                'status' => 'published',
            ],
            [
                'title' => 'Deals, Due Diligence & Transaction Advisory',
                'short_description' => 'Thorough financial, legal, and operational due diligence to ensure informed investment and acquisition decisions.',
                'content' => '<p>Our Deals and Due Diligence team provides comprehensive transaction advisory services that help you make informed decisions. Whether you\'re acquiring a business, merging operations, or divesting assets, we deliver the insights you need.</p><h3>Our Approach</h3><ul><li>Financial Due Diligence — Quality of earnings, working capital analysis</li><li>Tax Due Diligence — Tax exposure assessment, compliance review</li><li>Legal Due Diligence — Contract review, regulatory compliance</li><li>Operational Due Diligence — Process evaluation, synergy assessment</li><li>Valuation Services — Business valuation, fairness opinions</li></ul>',
                'icon' => 'fa-solid fa-magnifying-glass-chart',
                'show_on_homepage' => true,
                'sort_order' => 3,
                'status' => 'published',
            ],
            [
                'title' => 'Business Set Up & Startup Collaboration',
                'short_description' => 'From entity formation to fundraising support, we help startups launch with the right structure and strategy.',
                'content' => '<p>Dev Mantra supports entrepreneurs and businesses in setting up operations in India and abroad. From entity formation to regulatory compliance, we ensure your business starts on the right foundation.</p><h3>Services Include</h3><ul><li>Company Incorporation — Private Limited, LLP, OPC</li><li>Foreign Subsidiary Setup in India</li><li>Startup India Registration & DPIIT Recognition</li><li>Fundraising & Pitch Deck Support</li><li>Accounting & Compliance Setup from Day 1</li></ul>',
                'icon' => 'fa-solid fa-rocket',
                'show_on_homepage' => true,
                'sort_order' => 4,
                'status' => 'published',
            ],
            [
                'title' => 'IPO Advisory Services',
                'short_description' => 'Guiding companies through every stage of going public — from pre-IPO readiness to listing and beyond.',
                'content' => '<p>Our IPO Advisory practice guides companies through every stage of the public listing journey. From pre-IPO readiness assessment to post-listing compliance, we ensure a smooth transition to the public markets.</p><h3>Our IPO Services</h3><ul><li>IPO Readiness Assessment</li><li>Financial Restructuring & Audit Preparation</li><li>DRHP/RHP Preparation Support</li><li>SEBI & Stock Exchange Liaison</li><li>Post-IPO Compliance & Reporting</li></ul>',
                'icon' => 'fa-solid fa-arrow-trend-up',
                'show_on_homepage' => true,
                'sort_order' => 5,
                'status' => 'published',
            ],
            [
                'title' => 'Corporate Governance',
                'short_description' => 'Establishing governance frameworks, board advisory, and compliance programs to build stakeholder confidence.',
                'content' => '<p>Strong corporate governance is the backbone of sustainable business growth. Dev Mantra helps organizations establish robust governance frameworks that build trust with stakeholders and ensure regulatory compliance.</p><h3>Governance Services</h3><ul><li>Board Advisory & Composition Strategy</li><li>Corporate Governance Framework Design</li><li>SEBI LODR Compliance</li><li>ESG & Sustainability Reporting</li><li>Whistleblower Policy & Ethics Framework</li><li>Annual Compliance Calendar Management</li></ul>',
                'icon' => 'fa-solid fa-building-columns',
                'show_on_homepage' => true,
                'sort_order' => 6,
                'status' => 'published',
            ],
            [
                'title' => 'GCC (Global Capability Centers)',
                'short_description' => 'Setting up and scaling offshore capability centers with operational excellence and talent strategies.',
                'content' => '<p>India has emerged as the global hub for capability centers. Dev Mantra helps multinational corporations set up, scale, and optimize their Global Capability Centers in India.</p><h3>GCC Services</h3><ul><li>GCC Strategy & Feasibility Study</li><li>Entity Setup & Regulatory Compliance</li><li>Talent Acquisition & HR Framework</li><li>Finance & Accounting Operations Setup</li><li>Technology Infrastructure Advisory</li><li>Ongoing Compliance & Governance</li></ul>',
                'icon' => 'fa-solid fa-globe',
                'show_on_homepage' => true,
                'sort_order' => 7,
                'status' => 'published',
            ],
            [
                'title' => 'M & A Advisory Services',
                'short_description' => 'Full-cycle mergers and acquisitions support — target identification, valuation, negotiation, and post-merger integration.',
                'content' => '<p>Dev Mantra\'s M&A Advisory practice supports businesses through every stage of the merger and acquisition lifecycle. Our team combines financial expertise with strategic insight to maximize deal value.</p><h3>M&A Services</h3><ul><li>Target Identification & Screening</li><li>Business Valuation & Financial Modeling</li><li>Deal Structuring & Negotiation Support</li><li>Due Diligence Management</li><li>Post-Merger Integration Planning</li><li>Cross-Border M&A Advisory</li></ul>',
                'icon' => 'fa-solid fa-handshake',
                'show_on_homepage' => true,
                'sort_order' => 8,
                'status' => 'published',
            ],
            [
                'title' => 'Risk Advisory & Augmenting Business Process',
                'short_description' => 'Identifying and mitigating business risks while optimizing operations for efficiency and scalability.',
                'content' => '<p>In an increasingly complex business environment, proactive risk management is essential. Dev Mantra\'s Risk Advisory services help organizations identify, assess, and mitigate risks across all business functions.</p><h3>Risk Advisory Services</h3><ul><li>Enterprise Risk Management Framework</li><li>Internal Audit & Controls Assessment</li><li>Fraud Risk Assessment & Investigation</li><li>IT Risk & Cybersecurity Advisory</li><li>Business Continuity Planning</li><li>Process Optimization & Automation</li></ul>',
                'icon' => 'fa-solid fa-shield-halved',
                'show_on_homepage' => true,
                'sort_order' => 9,
                'status' => 'published',
            ],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['title' => $s['title']], $s);
        }

        // Blogs (matching original static content)
        $blogs = [
            [
                'title' => 'Strengthening Corporate Governance in a Global Economy',
                'excerpt' => 'As businesses expand across borders, maintaining robust corporate governance becomes both more critical and more complex.',
                'content' => '<p>As businesses expand across borders, maintaining robust corporate governance becomes both more critical and more complex. The intersection of diverse regulatory environments, cultural expectations, and stakeholder demands creates a governance landscape that requires both strategic vision and tactical precision.</p><h3>The Evolving Governance Landscape</h3><p>The last decade has fundamentally altered what governance means for businesses. Gone are the days when governance was merely about regulatory compliance and board meetings. Today, it encompasses ESG considerations, digital transformation oversight, cybersecurity governance, and stakeholder capitalism.</p><h3>Key Pillars of Global Corporate Governance</h3><h4>1. Board Composition & Independence</h4><p>A well-composed board brings diverse perspectives, industry expertise, and independent oversight. Organizations should focus on skills-based board composition that aligns with strategic objectives.</p><h4>2. Risk Management Frameworks</h4><p>Effective governance requires proactive risk identification and mitigation strategies.</p><ul><li>Establish a dedicated risk committee at the board level</li><li>Implement enterprise-wide risk assessment methodologies</li><li>Create clear escalation protocols for material risks</li><li>Regular stress testing and scenario planning</li><li>Integration of risk management into strategic planning</li></ul><h4>3. Transparency & Disclosure</h4><p>Stakeholders today expect more than statutory compliance. They demand meaningful disclosure that provides genuine insight into business performance, risks, and prospects.</p><h3>Practical Steps for Strengthening Governance</h3><p>For organizations looking to strengthen their governance frameworks, we recommend starting with a comprehensive governance audit, followed by targeted improvements aligned with both regulatory requirements and stakeholder expectations.</p>',
                'category' => 'Blog',
                'read_time' => '6 min read',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Regulatory Updates & Compliance Insights for Growing Businesses',
                'excerpt' => 'Navigate the evolving regulatory landscape with confidence. Key updates every CFO should know.',
                'content' => '<p>The regulatory environment continues to evolve rapidly, with significant changes in tax laws, corporate compliance requirements, and industry-specific regulations. Staying ahead of these changes is crucial for business continuity and growth.</p><h3>Key Regulatory Changes in 2025</h3><p>Several important regulatory developments have occurred that directly impact businesses operating in India and globally. Understanding these changes and their implications is essential for maintaining compliance and optimizing your business operations.</p><h3>GST Updates</h3><p>Recent amendments to GST regulations have introduced new compliance requirements for e-commerce operators, changes in input tax credit mechanisms, and updated return filing procedures.</p><h3>Companies Act Amendments</h3><p>The Ministry of Corporate Affairs has introduced several amendments that affect board composition requirements, related party transaction thresholds, and CSR spending guidelines.</p>',
                'category' => 'Newsletter',
                'read_time' => '5 min read',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'Enabling Scalable Growth through Strategic Financial Advisory',
                'excerpt' => 'How Dev Mantra helped a mid-size company restructure finances and scale operations across three new markets.',
                'content' => '<p>When a mid-size manufacturing company approached Dev Mantra with plans to expand into three new international markets, they faced a complex web of financial, regulatory, and operational challenges. This case study outlines how our strategic financial advisory helped them achieve sustainable growth.</p><h3>The Challenge</h3><p>The company needed to restructure their financial operations to support international expansion while maintaining compliance across multiple jurisdictions. Key challenges included multi-currency treasury management, transfer pricing compliance, and entity structuring for tax efficiency.</p><h3>Our Approach</h3><p>We deployed a cross-functional team combining our Virtual CFO, Tax Advisory, and Business Setup expertise to create a comprehensive expansion roadmap.</p><h3>Results</h3><ul><li>Successfully established entities in 3 new markets within 6 months</li><li>Reduced effective tax rate by 15% through optimal structuring</li><li>Implemented centralized treasury management saving 20% on FX costs</li><li>Achieved full regulatory compliance across all jurisdictions</li></ul>',
                'category' => 'Case Study',
                'read_time' => '8 min read',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(30),
            ],
            [
                'title' => 'The Rise of Virtual CFO Services in India',
                'excerpt' => 'Why more Indian businesses are turning to Virtual CFO services for strategic financial guidance.',
                'content' => '<p>The Virtual CFO model has seen explosive growth in India, particularly among startups, SMEs, and mid-market companies. This article explores why this trend is accelerating and what it means for the future of financial leadership.</p><h3>Why Virtual CFOs?</h3><p>The traditional model of hiring a full-time CFO is being disrupted by a more flexible, cost-effective alternative. Virtual CFOs bring the same strategic expertise at a fraction of the cost, making C-suite financial leadership accessible to growing businesses.</p><h3>Key Benefits</h3><ul><li>Cost savings of 60-70% compared to a full-time CFO</li><li>Access to diverse industry experience</li><li>Scalable engagement models</li><li>Fresh, unbiased perspective on financial strategy</li></ul>',
                'category' => 'Blog',
                'read_time' => '4 min read',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(45),
            ],
            [
                'title' => 'SEBI New Disclosure Norms: What Listed Companies Need to Know',
                'excerpt' => 'Breaking down SEBI\'s latest disclosure requirements and their impact on corporate governance practices.',
                'content' => '<p>SEBI has introduced significant changes to disclosure norms that affect all listed companies in India. These changes aim to enhance transparency, protect investor interests, and align Indian markets with global best practices.</p><h3>Key Changes</h3><p>The new norms cover enhanced related party transaction disclosures, stricter timelines for event-based disclosures, and expanded ESG reporting requirements.</p><h3>Impact on Companies</h3><p>Listed companies need to review their current disclosure practices and update their compliance frameworks to meet the new requirements within the specified timelines.</p>',
                'category' => 'Blog',
                'read_time' => '5 min read',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(60),
            ],
            [
                'title' => 'Year-End Tax Planning Strategies for Businesses',
                'excerpt' => 'Essential tax planning strategies to optimize your tax position before the financial year ends.',
                'content' => '<p>As the financial year draws to a close, businesses have a window of opportunity to optimize their tax positions through strategic planning. This guide outlines key strategies that can help reduce your tax burden while maintaining full compliance.</p><h3>Direct Tax Strategies</h3><ul><li>Accelerate deductible expenses before year-end</li><li>Review and optimize depreciation claims</li><li>Evaluate capital gains harvesting opportunities</li><li>Maximize deductions under Section 80</li></ul><h3>GST Optimization</h3><p>Review your input tax credit claims, ensure all reconciliations are complete, and file any pending returns to avoid interest and penalties.</p>',
                'category' => 'Blog',
                'read_time' => '6 min read',
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(75),
            ],
        ];

        foreach ($blogs as $b) {
            Blog::updateOrCreate(['title' => $b['title']], $b);
        }

        // Newsletters
        $newsletters = [
            [
                'title' => 'Union Budget 2025: Impact Analysis for Indian Businesses',
                'excerpt' => 'Breaking down the most impactful tax reforms and what they mean for your organization\'s financial planning.',
                'content' => '<p>The Union Budget 2025 introduced several key changes that will significantly impact businesses across sectors. In this edition, we analyze the most impactful provisions and provide actionable insights for your organization.</p><h3>Key Tax Changes</h3><p>The budget introduced revised tax slabs, new incentives for manufacturing, and changes to capital gains taxation that affect both domestic and foreign investors.</p><h3>Impact on Startups</h3><p>Extended tax holidays, increased deduction limits for R&D expenditure, and simplified compliance requirements signal continued government support for the startup ecosystem.</p><h3>What Should You Do?</h3><p>We recommend reviewing your tax planning strategy in light of these changes. Our team is available for consultations to help you optimize your position under the new regime.</p>',
                'edition_label' => 'February 2025',
                'status' => 'published',
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'SEBI\'s New Disclosure Norms: A Comprehensive Guide',
                'excerpt' => 'Understanding the new SEBI disclosure requirements and their implications for listed companies.',
                'content' => '<p>SEBI has recently introduced enhanced disclosure norms that will reshape how listed companies communicate with their stakeholders. This newsletter provides a comprehensive guide to these changes.</p><h3>Timeline for Implementation</h3><p>Companies have been given a phased timeline for compliance, with immediate effect for material event disclosures and a 6-month window for enhanced governance disclosures.</p><h3>Key Requirements</h3><ul><li>Enhanced related party transaction disclosures</li><li>Real-time material event reporting</li><li>Quarterly ESG metrics disclosure</li><li>Board evaluation results summary</li></ul>',
                'edition_label' => 'January 2025',
                'status' => 'published',
                'published_at' => now()->subDays(45),
            ],
            [
                'title' => 'Year-End Tax Planning: Comprehensive Strategy Guide',
                'excerpt' => 'A practical guide to optimizing your tax position before the financial year closes.',
                'content' => '<p>With the financial year drawing to a close, it\'s time for businesses to review their tax positions and implement last-minute optimization strategies. This edition provides a comprehensive checklist for year-end tax planning.</p><h3>Direct Tax Checklist</h3><ul><li>Review advance tax payments and make final installment</li><li>Evaluate deferred tax positions</li><li>Claim all eligible deductions and exemptions</li><li>Review transfer pricing documentation</li></ul><h3>GST Year-End Checklist</h3><ul><li>Reconcile GSTR-2B with purchase records</li><li>File any pending returns</li><li>Review ITC claims for accuracy</li></ul>',
                'edition_label' => 'December 2024',
                'status' => 'published',
                'published_at' => now()->subDays(75),
            ],
        ];

        foreach ($newsletters as $n) {
            Newsletter::updateOrCreate(['title' => $n['title']], $n);
        }
    }
}
