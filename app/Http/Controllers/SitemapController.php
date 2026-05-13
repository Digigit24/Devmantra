<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Blog;
use App\Models\Career;
use App\Models\CaseStudy;
use App\Models\Event;
use App\Models\Newsletter;
use App\Models\Report;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        $blogs       = Blog::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $services    = Service::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $caseStudies = CaseStudy::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $reports     = Report::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $newsletters = Newsletter::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $alerts      = Alert::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $events      = Event::published()->select('slug', 'updated_at')->latest('updated_at')->get();
        $careers     = Career::published()->select('slug', 'updated_at')->latest('updated_at')->get();

        return response()
            ->view('sitemap', compact(
                'blogs', 'services', 'caseStudies', 'reports',
                'newsletters', 'alerts', 'events', 'careers'
            ))
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
