<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\ContactSetting;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $homePage = Page::where('name', 'home')->first();
        $pageSections = $homePage ? $homePage->activeSections()->get() : collect();
        $blogs = Blog::published()->latest('published_at')->take(3)->get();

        return view('frontend.home', compact('pageSections', 'blogs'));
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
        $service = Service::published()
            ->with(['activeSections'])
            ->where('slug', $slug)
            ->firstOrFail();
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
        $featured = Newsletter::published()->featured()->latest('published_at')->first();
        $newsletters = Newsletter::published()
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.newsletter-index', compact('featured', 'newsletters'));
    }

    public function about()
    {
        $aboutPage = Page::where('name', 'about')->first();
        $pageSections = $aboutPage ? $aboutPage->activeSections()->get() : collect();

        return view('frontend.about', compact('pageSections'));
    }

    public function contact()
    {
        $contact = ContactSetting::instance();

        return view('frontend.contact', compact('contact'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contact = ContactSetting::instance();
        $adminEmail = $contact->email ?: 'support@devmantra.com';

        // Send email to admin
        \Illuminate\Support\Facades\Mail::raw(
            "Name: {$request->name}\nEmail: {$request->email}\nPhone: {$request->phone}\nSubject: {$request->subject}\n\nMessage:\n{$request->message}",
            function ($mail) use ($request, $adminEmail) {
                $mail->to($adminEmail)
                    ->subject('Contact Form: ' . $request->subject)
                    ->replyTo($request->email, $request->name);
            }
        );

        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you shortly.');
    }

    public function careers()
    {
        $careers = Career::published()->latest('published_at')->paginate(10);

        return view('frontend.careers-index', compact('careers'));
    }

    public function careerShow(string $slug)
    {
        $career = Career::published()->where('slug', $slug)->firstOrFail();

        return view('frontend.career-detail', compact('career'));
    }

    public function careerApply(Request $request, string $slug)
    {
        $career = Career::published()->where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        CareerApplication::create([
            'career_id' => $career->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $resumePath,
        ]);

        return redirect()->route('career.show', $slug)->with('success', 'Your application has been submitted successfully! We will get back to you soon.');
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
