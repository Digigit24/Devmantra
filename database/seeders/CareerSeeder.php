<?php

namespace Database\Seeders;

use App\Models\Career;
use Carbon\Carbon;
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
                'published_at' => Carbon::now()->subDays(2),
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
                'published_at' => Carbon::now()->subDay(),
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