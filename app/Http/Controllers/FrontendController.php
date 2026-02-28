<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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

        return view('frontend.service-detail', compact('service'));
    }

    public function newsletterIndex()
    {
        $newsletters = Newsletter::published()->latest('published_at')->paginate(9);

        return view('frontend.newsletter-index', compact('newsletters'));
    }

    public function newsletterShow(string $slug)
    {
        $newsletter = Newsletter::published()->where('slug', $slug)->firstOrFail();

        return view('frontend.newsletter-detail', compact('newsletter'));
    }
}
