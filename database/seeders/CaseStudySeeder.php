<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    public function run(): void
    {
        CaseStudy::create([
            'title' => 'India 2026–27 Union Budget Impact Study for Foreign Entities',
            'slug' => 'india-2026-27-union-budget-impact-study-for-foreign-entities',
            'excerpt' => 'India\'s Union Budget 2026–27 places strong emphasis on investment promotion, ease of doing business, global integration, and long-term competitiveness, with strategic reforms aimed at positioning India as a compelling destination for foreign capital.',
            'content' => '<h3>Executive Overview</h3>
<p>India\'s Union Budget 2026–27, presented on 1 February 2026, places strong emphasis on investment promotion, ease of doing business, global integration, and long-term competitiveness, with strategic reforms aimed at positioning India as a compelling destination for foreign capital, global digital services, manufacturing linkages, financial services, and equity market participation.</p>

<h3>Implementation of the New Income Tax Act, 2025 (Effective 1 April 2026)</h3>
<p>The Income-tax Act, 2025 is a comprehensive overhaul of India\'s direct tax framework, replacing the Income-tax Act, 1961. It aims to simplify and modernise tax rules, procedures, and compliance.</p>

<h4>Key Features</h4>
<ul>
<li>Introduction of a unified Tax Year concept replacing the "assessment year / previous year" system, thereby streamlining income taxation</li>
<li>Reduction in the number of sections with clearer language to minimise ambiguity and litigation</li>
<li>Strong emphasis on digital filing and faceless assessments to reduce human interface and disputes</li>
<li>Faster processing of refunds and greater clarity on deductions such as standard deduction, house property interest, and pre-construction interest</li>
</ul>

<p><strong>Impact:</strong> Easier compliance for taxpayers, fewer disputes, and faster processing of assessments and refunds.</p>

<h3>Rationalisation of Tax &amp; Investment Incentives</h3>

<h4>20-Year Tax Holiday for IFSC &amp; Data-Driven Services</h4>
<ul>
<li>Businesses establishing operations in GIFT City are eligible for a 20-year tax holiday (earlier 10 years), followed by a 15% flat corporate tax rate</li>
<li>Foreign cloud and global digital service providers using India-based data centres are granted income tax exemption until 2047 on income derived from such services</li>
<li>A safe harbour margin of 15% on cost applies where the resident data centre provider is a related entity</li>
</ul>

<h4>Tax-free Toll Manufacturing for Electronics</h4>
<ul>
<li>Foreign companies supplying capital goods, equipment, or tooling to Indian contract manufacturers through customs-bonded warehouses are eligible for income tax exemption until 31 March 2031, subject to prescribed conditions</li>
</ul>

<p><strong>Impact:</strong> Enhanced tax certainty and major cost savings for international finance, technology, and digital services firms planning India-centric operations.</p>

<h3>FDI &amp; Capital Market Reforms</h3>

<h4>Insurance Sector: FDI Limit Raised to 100%</h4>
<ul>
<li>Foreign Direct Investment in the insurance sector has been raised from 74% to 100%, subject to the condition that the insurer invests an amount equivalent to its entire premium income in India</li>
<li>Composite insurance licences now permit a single entity to offer life, general, and health insurance products under one entity</li>
</ul>

<h4>SWAMIH 2 Fund</h4>
<ul>
<li>A ₹15,000 crore fund aimed at completing an additional 1 lakh stalled housing units, supporting real estate recovery and construction-linked sectors</li>
</ul>

<h4>Equity Market Access for Non-Residents</h4>
<ul>
<li>Non-resident Indians (NRIs) and Overseas Citizens of India (OCIs) will soon be allowed to participate directly in Indian equity markets using the Unified Pension Scheme (UPS), removing a long-standing structural barrier to retail-level portfolio investment</li>
</ul>

<h3>Transfer Pricing &amp; International Tax Compliance</h3>

<h4>Block Transfer Pricing Assessments</h4>
<ul>
<li>The budget introduces a block period assessment mechanism for transfer pricing, allowing a single consolidated review of related-party transactions over a defined period, reducing repetitive scrutiny and compliance costs</li>
</ul>

<h4>Safe Harbour for Global Digital Services</h4>
<ul>
<li>A safe harbour margin of 15% on cost is prescribed for resident data centre operators that are related to the foreign entity</li>
<li>This provides a clear margin benchmark and minimises transfer pricing disputes</li>
</ul>

<h3>Customs &amp; Tariff Rationalisation</h3>
<ul>
<li>Tariff lines reduced from over 12,000 to approximately 10,000</li>
<li>Critical minerals such as cobalt, lithium, and rare earths receive nil or concessional duty treatment</li>
<li>Customs duty exemptions for flat panel display components used in domestic manufacturing of televisions and monitors</li>
<li>Extension of concessional duties for EV battery components until March 2026</li>
</ul>

<h3>Green Energy &amp; Sustainability Incentives</h3>
<ul>
<li>Extension of excise duty exemptions for blended compressed natural gas (CNG)</li>
<li>Continued concessional treatment for EV components and critical minerals central to the clean energy supply chain</li>
<li>Nuclear energy development plan: 100 GW target by 2047, with private sector participation to be enabled through a new regulatory framework</li>
</ul>

<h3>Strategic Outlook for Foreign Entities</h3>
<p>The Union Budget 2026–27 positions India as a high-growth, reform-oriented jurisdiction. Foreign entities should focus on:</p>
<ul>
<li>Evaluating GIFT City and IFSC opportunities for financial services and digital operations</li>
<li>Leveraging toll manufacturing exemptions for electronics supply chain restructuring</li>
<li>Reassessing insurance sector entry given the 100% FDI allowance</li>
<li>Reviewing transfer pricing structures in light of safe harbour provisions</li>
<li>Exploring equity market access reforms for NRI/OCI investors</li>
</ul>',
            'category' => 'Case Study',
            'meta_description' => 'India 2026-27 Union Budget Impact Study for Foreign Entities – comprehensive analysis of tax reforms, FDI changes, and investment incentives.',
            'read_time' => '10 min read',
            'is_featured' => true,
            'status' => 'published',
            'published_at' => '2026-02-06 13:21:25',
            'created_at' => '2026-02-06 13:21:25',
            'updated_at' => '2026-02-06 13:21:25',
        ]);
    }
}
