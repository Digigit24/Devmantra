<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                'title' => 'Fresher Accountant / Compliance Executive',
                'slug' => 'fresher-accountant-compliance-executive',
                'location' => 'Bangalore, Noida, Mumbai',
                'type' => 'full-time',
                'description' => '<h3>Qualification</h3>
<p>Fresher Accountant or with maximum 2 years\' collective experience</p>

<h3>Requirements</h3>
<ul>
    <li>Creativity, highly self-motivated, action-oriented with clarity of understanding</li>
    <li>Knowledge about Tally and ZOHO preferred</li>
    <li>Team player with ability to coordinate with clients</li>
    <li>Knowledge of Microsoft Word and Excel preferred</li>
    <li>Experience working with previous CA firm preferred</li>
    <li>Knowledge on Compliance preferred</li>
</ul>

<h3>Roles &amp; Responsibilities</h3>
<ul>
    <li>Regular work updation and timely compliances</li>
    <li>Coordination with team on statutory updation</li>
    <li>Ensuring compliance with internal processes (Monthly/Quarterly Closure)</li>
</ul>

<h3>Location</h3>
<p>Bangalore (4), Noida (1), Mumbai (1)</p>

<h3>Opportunity</h3>
<p>Regular knowledge upgrade with expert interaction, trainings and work diversity. Opportunity for full-time positions with various clients.</p>

<h3>Challenges</h3>
<p>Working on multiple client engagements simultaneously while ensuring high quality and timelines to meet stringent deadlines.</p>',
                'featured_image' => null,
                'meta_description' => 'Join Dev Mantra as a Fresher Accountant / Compliance Executive. Openings in Bangalore, Noida & Mumbai. Apply now for a rewarding career in finance.',
                'status' => 'published',
                'published_at' => '2026-03-25 00:00:00',
            ],
            [
                'title' => 'Lead – Accounting and Compliance Outsourcing',
                'slug' => 'lead-accounting-and-compliance-outsourcing',
                'location' => 'Bangalore, Noida',
                'type' => 'full-time',
                'description' => '<h3>Qualification</h3>
<p>Qualified Chartered Accountant with 2+ years of industry experience or equivalent</p>

<h3>Requirements</h3>
<ul>
    <li>Knowledge of GST and current relevant practices</li>
    <li>Practical understanding of client business</li>
    <li>Knowledge of international transactions and implications</li>
    <li>Disciplined with good team management and leadership skills</li>
    <li>Good knowledge of various software and Excel usage</li>
    <li>Multi-tasking and good client coordination</li>
</ul>

<h3>Roles &amp; Responsibilities</h3>
<ul>
    <li>Guide on best industry practices</li>
    <li>Lead team of Compliance Executives, including technical trainings</li>
    <li>Ensure timely compliances and track Internal MIS</li>
    <li>Team updation on statutory modifications</li>
    <li>Tax advisory wherever required</li>
    <li>Liaison with other experts and professionals for Audit Closure</li>
</ul>

<h3>Location</h3>
<p>Bangalore (1), Noida (1)</p>

<h3>Opportunity</h3>
<p>Quick appraisal for deserving candidates with Equity Stock Options.</p>

<h3>Challenges</h3>
<p>Working on multiple client engagements simultaneously while ensuring high quality and timelines.</p>',
                'featured_image' => null,
                'meta_description' => 'Join Dev Mantra as Lead – Accounting and Compliance Outsourcing. Openings in Bangalore & Noida. Apply now for leadership roles in finance and compliance.',
                'status' => 'published',
                'published_at' => '2026-03-26 00:00:00',
            ],
            [
                'title' => 'Chartered Accountant | Audit, Financial Reporting, Direct & Indirect Tax',
                'slug' => 'chartered-accountant-audit-financial-reporting-direct-indirect-tax',
                'location' => 'Bengaluru',
                'type' => 'full-time',
                'description' => '<h3>About the Role</h3>
<p>We are looking for a motivated and technically strong Chartered Accountant to join our professional practice in Bengaluru.</p>
<p>The role offers diverse exposure across Audit, Financial Reporting, Ind AS, Direct Tax, Indirect Tax (GST), Tax Advisory and Business Consulting assignments for SMEs, startups, family-owned businesses and corporates.</p>
<p>The ideal candidate should have strong fundamentals in accounting, auditing and taxation, along with a good understanding of Ind AS and financial reporting requirements.</p>

<h3>Key Responsibilities</h3>

<h4>1. Audit &amp; Assurance</h4>
<ul>
    <li>Conduct and manage Statutory Audit assignments.</li>
    <li>Perform Internal Audit and process review assignments.</li>
    <li>Review financial statements and accounting records.</li>
    <li>Conduct vouching, verification and analytical procedures.</li>
    <li>Evaluate internal financial controls and business processes.</li>
    <li>Identify financial, operational and compliance risks.</li>
    <li>Prepare audit working papers and audit documentation.</li>
    <li>Assist in preparation and finalisation of financial statements.</li>
    <li>Prepare audit observations and management reports.</li>
    <li>Interact with client finance teams and management.</li>
    <li>Ensure timely completion of audit assignments.</li>
</ul>

<h4>2. Financial Reporting &amp; Ind AS</h4>
<ul>
    <li>Prepare, review and analyse financial statements in accordance with applicable accounting standards.</li>
    <li>Work on Ind AS financial reporting and disclosure requirements.</li>
    <li>Assist clients in transition and implementation of Ind AS, where applicable.</li>
    <li>Review accounting treatments under Ind AS.</li>
    <li>Assist in preparation of Ind AS adjustments and reconciliations.</li>
    <li>Support preparation of financial statements, notes to accounts and disclosures.</li>
    <li>Analyse complex accounting transactions and determine the appropriate accounting treatment.</li>
    <li>Coordinate with client finance teams and auditors on financial reporting matters.</li>
    <li>Keep updated with amendments and developments in Ind AS, Companies Act and financial reporting requirements.</li>
</ul>

<h4>3. Direct Tax</h4>
<ul>
    <li>Prepare and review Income Tax Returns for companies, LLPs, firms, trusts and individuals.</li>
    <li>Prepare and review Income Tax computations.</li>
    <li>Handle Tax Audit assignments and related documentation.</li>
    <li>Assist in tax planning and advisory assignments.</li>
    <li>Handle TDS compliance and reconciliations.</li>
    <li>Assist in responding to Income Tax notices and departmental queries.</li>
    <li>Support assessment and appeal-related assignments.</li>
    <li>Research Income Tax provisions, circulars, notifications and judicial precedents.</li>
    <li>Analyse tax implications of business transactions.</li>
    <li>Assist in capital gains and transaction-related taxation matters.</li>
</ul>

<h4>4. Indirect Tax – GST</h4>
<ul>
    <li>Handle GST compliance and return filing.</li>
    <li>Review GST returns and reconciliations.</li>
    <li>Conduct GST compliance reviews and health checks.</li>
    <li>Review Input Tax Credit (ITC) and reconciliations.</li>
    <li>Assist in GST advisory and review assignments.</li>
    <li>Handle GST notices and departmental correspondence.</li>
    <li>Assist in GST assessments and litigation-related matters.</li>
    <li>Analyse GST implications of business transactions.</li>
    <li>Keep updated with changes in GST laws, notifications and judicial developments.</li>
</ul>

<h4>5. Advisory &amp; Consulting Exposure</h4>
<p>The candidate may also get exposure to advisory assignments involving:</p>
<ul>
    <li>Business and financial analysis.</li>
    <li>Financial statement review.</li>
    <li>Ind AS implementation and accounting advisory.</li>
    <li>Internal control and process improvement.</li>
    <li>Tax planning and transaction structuring.</li>
    <li>Financial and tax due diligence.</li>
    <li>Startup and SME advisory.</li>
    <li>MIS and management reporting.</li>
    <li>Working capital and profitability analysis.</li>
</ul>

<h3>Client Management &amp; Execution</h3>
<ul>
    <li>Interact directly with clients and understand their business, financial reporting and compliance requirements.</li>
    <li>Coordinate with client finance and accounts teams.</li>
    <li>Manage multiple assignments and deadlines.</li>
    <li>Ensure quality and timely delivery of assignments.</li>
    <li>Prepare professional emails, reports and client submissions.</li>
    <li>Assist in building long-term client relationships.</li>
</ul>

<h3>Requirements</h3>
<ul>
    <li>Qualified Chartered Accountant (CA).</li>
    <li>0–5 years of post-qualification experience.</li>
    <li>Strong fundamentals in Accounting, Audit and Taxation.</li>
    <li>Working knowledge and practical exposure to Ind AS and financial statement preparation/review.</li>
    <li>Working knowledge of Income Tax and GST.</li>
    <li>Good analytical and problem-solving abilities.</li>
    <li>Strong MS Excel skills.</li>
    <li>Good written and verbal communication skills.</li>
    <li>Ability to independently manage assignments with appropriate senior guidance.</li>
</ul>

<h3>Preferred Skills &amp; Experience</h3>
<p>Experience or exposure in one or more of the following will be an added advantage:</p>
<ul>
    <li>Ind AS financial reporting and implementation</li>
    <li>Statutory Audit</li>
    <li>Internal Audit</li>
    <li>Financial Statement Preparation and Review</li>
    <li>Tax Audit</li>
    <li>Income Tax Assessments</li>
    <li>GST Advisory and Compliance</li>
    <li>GST Assessments</li>
    <li>Tax Litigation Support</li>
    <li>Corporate Taxation</li>
    <li>Internal Financial Controls</li>
</ul>

<h3>What We Offer</h3>
<ul>
    <li>Diverse exposure across Audit, Ind AS, Financial Reporting, Direct Tax, GST and Advisory.</li>
    <li>Opportunity to work on complex accounting and financial reporting assignments.</li>
    <li>Exposure to SMEs, startups and established businesses.</li>
    <li>Opportunity to develop strong technical, analytical and client-handling capabilities.</li>
    <li>Continuous learning and professional development.</li>
    <li>Entrepreneurial and growth-oriented work environment.</li>
</ul>

<h3>Location</h3>
<p>Bengaluru</p>

<h3>Experience</h3>
<p>0–5 Years Post Qualification</p>

<h3>Qualification</h3>
<p>Chartered Accountant (CA)</p>',
                'featured_image' => null,
                'meta_description' => 'Join Dev Mantra as a Chartered Accountant in Bengaluru. Diverse exposure across Audit, Financial Reporting, Ind AS, Direct Tax and GST. 0–5 years post-qualification experience.',
                'status' => 'published',
                'published_at' => '2026-09-05 00:00:00',
            ],
            [
                'title' => 'Article Trainee',
                'slug' => 'article-trainee',
                'location' => 'Bengaluru',
                'type' => 'full-time',
                'description' => '<h3>About the Role</h3>
<p>CA Articleship – Audit, Taxation &amp; Advisory at N Tatia &amp; Associates, Chartered Accountants.</p>
<p>We are looking for motivated and ambitious CA Articles who want to build strong practical knowledge across audit, taxation, accounting and business advisory.</p>
<p>The candidate will get an opportunity to work directly on client assignments and gain exposure to different industries and business models.</p>

<h3>Qualification / Eligibility</h3>
<p>CA Intermediate / CA Foundation as per ICAI eligibility requirements</p>

<h3>Key Responsibilities</h3>

<h4>Audit &amp; Assurance</h4>
<ul>
    <li>Assist in statutory and internal audits.</li>
    <li>Perform vouching, verification and audit procedures.</li>
    <li>Review books of accounts and supporting documents.</li>
    <li>Assist in preparation of audit working papers.</li>
    <li>Understand and evaluate internal financial controls.</li>
    <li>Participate in physical verification and audit fieldwork.</li>
    <li>Assist in preparation of financial statements and audit reports.</li>
</ul>

<h4>Taxation</h4>
<ul>
    <li>Assist in preparation and filing of income tax returns.</li>
    <li>Assist with tax audits and related documentation.</li>
    <li>Work on GST compliance and reconciliations.</li>
    <li>Assist in preparation of tax computations and supporting schedules.</li>
    <li>Research and analyse tax provisions and case laws.</li>
</ul>

<h4>Accounting &amp; MIS</h4>
<ul>
    <li>Assist clients with accounting and financial reporting.</li>
    <li>Prepare bank, ledger and balance-sheet reconciliations.</li>
    <li>Assist in preparation of MIS reports.</li>
    <li>Analyse financial statements and key business ratios.</li>
    <li>Support monthly and quarterly financial reporting.</li>
</ul>

<h4>Advisory &amp; Consulting</h4>
<p>Articles will also get exposure to selected advisory assignments, including:</p>
<ul>
    <li>Business analysis</li>
    <li>Financial modelling</li>
    <li>Due diligence</li>
    <li>Working capital analysis</li>
    <li>Business process review</li>
    <li>Management reporting</li>
    <li>Startup and SME advisory</li>
    <li>Corporate restructuring and transaction-related assignments</li>
</ul>

<h4>Technology &amp; AI Exposure</h4>
<p>Articles interested in technology will have opportunities to learn and implement:</p>
<ul>
    <li>AI productivity tools</li>
    <li>Accounting automation</li>
    <li>Automated audit procedures</li>
    <li>Digital documentation and reporting</li>
</ul>

<h3>Requirements</h3>
<ul>
    <li>CA student eligible for articleship (CA Intermediate / CA Foundation).</li>
    <li>Strong academic fundamentals in Accounting, Taxation and Auditing.</li>
    <li>Good communication and interpersonal skills.</li>
    <li>Good working knowledge of MS Excel.</li>
    <li>Willingness to work at client locations when required.</li>
    <li>Attention to detail and willingness to learn.</li>
    <li>Ability to work as part of a team.</li>
    <li>Professional attitude and integrity.</li>
    <li>Interest in technology and automation is an advantage.</li>
</ul>

<h3>What You Will Gain</h3>
<p>Exposure across Audit, Tax, Accounting, Advisory, Business Analysis and Technology. You will work with different types of businesses and gain practical understanding of how companies actually operate.</p>
<ul>
    <li>Diverse exposure rather than routine compliance work.</li>
    <li>Practical experience across multiple areas of CA practice.</li>
    <li>Direct client interaction.</li>
    <li>Exposure to SMEs, startups and growing businesses.</li>
    <li>Opportunity to work on advisory and consulting assignments.</li>
    <li>Technology and AI-oriented working environment.</li>
    <li>Mentoring from experienced Chartered Accountants.</li>
    <li>Strong foundation for a career in Audit, Tax, Consulting, Investment Banking or Corporate Finance.</li>
</ul>

<h3>Career Opportunity</h3>
<p>High-performing candidates may have opportunities to continue with the firm after qualification and develop a career in Audit, Tax, Consulting, Corporate Finance or Investment Banking.</p>

<h3>Location</h3>
<p>Bengaluru</p>

<h3>Position</h3>
<p>Article Assistant / CA Article</p>',
                'featured_image' => null,
                'meta_description' => 'CA Articleship opportunity at Dev Mantra – N Tatia & Associates, Bengaluru. Gain exposure across Audit, Taxation, Accounting and Advisory. Apply now.',
                'status' => 'published',
                'published_at' => '2026-09-05 00:00:00',
            ],
        ];

        foreach ($careers as $career) {
            Career::updateOrCreate(
                ['slug' => $career['slug']],
                $career
            );
        }
    }
}
