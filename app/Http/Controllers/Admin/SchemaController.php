<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Newsletter;
use App\Models\Report;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Services\SchemaService;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all_cached();

        // Grab first published record of each type for live preview
        $blog       = Blog::published()->latest('published_at')->first();
        $service    = Service::published()->first();
        $caseStudy  = CaseStudy::published()->latest('published_at')->first();
        $report     = Report::published()->latest('published_at')->first();
        $newsletter = Newsletter::published()->latest('published_at')->first();

        // Pre-render schemas for display in the preview cards
        $previews = [
            'organization'  => SchemaService::organization(),
            'localBusiness' => SchemaService::localBusiness(),
            'article'       => $blog       ? SchemaService::blogSchema($blog)             : null,
            'caseStudy'     => $caseStudy  ? SchemaService::caseStudySchema($caseStudy)   : null,
            'report'        => $report     ? SchemaService::reportSchema($report)         : null,
            'newsletter'    => $newsletter ? SchemaService::newsletterSchema($newsletter) : null,
            'service'       => $service    ? SchemaService::serviceSchema($service)       : null,
            'faq'           => SchemaService::faqSchema([
                ['question' => 'Sample question?', 'answer' => 'Sample answer.'],
            ]),
            'breadcrumb'    => SchemaService::breadcrumb([
                ['name' => 'Home',  'url' => '/'],
                ['name' => 'Blog',  'url' => '/blog'],
                ['name' => 'Sample Post', 'url' => '/blog/sample'],
            ]),
        ];

        return view('admin.schema.index', compact(
            'settings', 'previews',
            'blog', 'service', 'caseStudy', 'report', 'newsletter'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'schema_company_name' => ['nullable', 'string', 'max:255'],
            'schema_logo_url'     => ['nullable', 'url',    'max:500'],
            'schema_website_url'  => ['nullable', 'url',    'max:500'],
            'schema_area_served'  => ['nullable', 'string', 'max:255'],
        ]);

        foreach (['schema_company_name', 'schema_logo_url', 'schema_website_url', 'schema_area_served'] as $key) {
            SiteSetting::set($key, $request->input($key, ''));
        }

        return back()->with('success', 'Schema settings saved successfully.');
    }
}
