<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactSetting;
use App\Models\Newsletter;
use App\Models\Service;

class FrontendController extends Controller
{
    public function home()
    {
        $services = Service::published()->homepage()->get();
        $blogs = Blog::published()->latest('published_at')->take(3)->get();

        return view('frontend.home', compact('services', 'blogs'));
    }

    public function blogIndex()
    {
        $featured = Blog::published()->featured()->latest('published_at')->first();
        $blogs = Blog::published()
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->paginate(6);

        return view('frontend.blog-index', compact('featured', 'blogs'));
    }

    public function blogShow(string $slug)
    {
        $blog = Blog::published()->where('slug', $slug)->firstOrFail();
        $related = Blog::published()
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        $sidebarBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.blog-detail', compact('blog', 'related', 'sidebarBlogs'));
    }

    public function serviceShow(string $slug)
    {
        $service = Service::published()->where('slug', $slug)->firstOrFail();
        $related = Service::published()
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->take(3)
            ->get();
        $sidebarServices = Service::published()
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        return view('frontend.service-detail', compact('service', 'related', 'sidebarServices'));
    }

    public function newsletterIndex()
    {
        $newsletters = Newsletter::published()->latest('published_at')->paginate(9);

        return view('frontend.newsletter-index', compact('newsletters'));
    }

    public function about()
    {
        $services = Service::published()->orderBy('sort_order')->get();

        return view('frontend.about', compact('services'));
    }

    public function contact()
    {
        $contact = ContactSetting::instance();

        return view('frontend.contact', compact('contact'));
    }

    public function newsletterShow(string $slug)
    {
        $newsletter = Newsletter::published()->where('slug', $slug)->firstOrFail();
        $related = Newsletter::published()
            ->where('id', '!=', $newsletter->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        $sidebarNewsletters = Newsletter::published()
            ->where('id', '!=', $newsletter->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.newsletter-detail', compact('newsletter', 'related', 'sidebarNewsletters'));
    }
}
