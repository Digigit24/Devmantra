<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Blog;
use App\Models\Bookmark;
use App\Models\Career;
use App\Models\Event;
use App\Models\CareerApplication;
use App\Models\CaseStudy;
use App\Models\ContactSetting;
use App\Models\ContactSubmission;
use App\Models\Newsletter;
use App\Models\Page;
use App\Models\Report;
use App\Models\Service;
use App\Mail\ContactAdminMail;
use App\Mail\ContactUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function home()
    {
        $pageSections = Cache::remember('home.page_sections', 300, function () {
            $homePage = Page::where('name', 'home')->first();
            return $homePage ? $homePage->activeSections()->get() : collect();
        });

        return view('frontend.home', compact('pageSections'));
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

    public function privacyPolicy()
    {
        $page = Page::where('name', 'privacy-policy')->first();
        $pageSections = $page ? $page->activeSections()->get() : collect();

        return view('frontend.privacy-policy', compact('pageSections'));
    }

    public function contact()
    {
        $contact = ContactSetting::instance();

        return view('frontend.contact', compact('contact'));
    }

    public function contactSubmit(Request $request)
    {
        // Honeypot check — bots fill this, humans don't
        if ($request->filled('website')) {
            return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you shortly.');
        }

        // Verify reCAPTCHA v3 token
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ])->json();

        if (empty($recaptchaResponse['success']) || $recaptchaResponse['score'] < 0.5) {
            return back()->withInput()->withErrors(['captcha' => 'We could not verify you are human. Please try again.']);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Save to database
        ContactSubmission::create($request->only('name', 'email', 'phone', 'subject', 'message'));

        $contact = ContactSetting::instance();
        $adminEmail = $contact->email ?: 'support@devmantra.com';

        Mail::to($adminEmail)->send(new ContactAdminMail(
            name: $request->name,
            email: $request->email,
            phone: $request->phone,
            enquirySubject: $request->subject,
            userMessage: $request->message,
        ));

        Mail::to($request->email, $request->name)->send(new ContactUserMail(
            name: $request->name,
            email: $request->email,
            enquirySubject: $request->subject,
            userMessage: $request->message,
        ));

        // Fire n8n webhook — failure must never block form submission
        try {
            $webhookResponse = Http::withBasicAuth(env('N8N_WEBHOOK_USERNAME'), env('N8N_WEBHOOK_PASSWORD'))
                ->timeout(5)
                ->post(env('N8N_WEBHOOK_URL'), [
                    'name'    => $request->name,
                    'email'   => $request->email,
                    'phone'   => $request->phone,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]);

            \Log::info('n8n webhook response', [
                'status' => $webhookResponse->status(),
                'body'   => $webhookResponse->body(),
            ]);
        } catch (\Exception $e) {
            \Log::error('n8n webhook failed: ' . $e->getMessage());
        }

        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you shortly.');
    }

    public function events()
    {
        $events = Event::published()->with('galleryImages')->orderBy('sort_order')->orderBy('published_at', 'desc')->get();

        return view('frontend.event-index', compact('events'));
    }

    public function eventShow(string $slug)
    {
        $event = Event::published()->with('galleryImages')->where('slug', $slug)->firstOrFail();

        return view('frontend.events', compact('event'));
    }

    public function careers()
    {
        $careers = Career::published()->latest('published_at')->paginate(9);

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

    public function reportIndex()
    {
        $featured = Report::published()->featured()->latest('published_at')->first();
        $reports = Report::published()
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.report-index', compact('featured', 'reports'));
    }

    public function reportShow(string $slug)
    {
        $report = Report::published()->where('slug', $slug)->firstOrFail();
        $related = Report::published()
            ->where('id', '!=', $report->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        $sidebarReports = Report::published()
            ->where('id', '!=', $report->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.report-detail', compact('report', 'related', 'sidebarReports'));
    }

    public function caseStudyIndex()
    {
        $featured = CaseStudy::published()->featured()->latest('published_at')->first();
        $caseStudies = CaseStudy::published()
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.case-study-index', compact('featured', 'caseStudies'));
    }

    public function caseStudyShow(string $slug)
    {
        $caseStudy = CaseStudy::published()->where('slug', $slug)->firstOrFail();
        $related = CaseStudy::published()
            ->where('id', '!=', $caseStudy->id)
            ->latest('published_at')
            ->take(3)
            ->get();
        $sidebarItems = CaseStudy::published()
            ->where('id', '!=', $caseStudy->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.case-study-detail', compact('caseStudy', 'related', 'sidebarItems'));
    }

    public function alertIndex(Request $request)
    {
        $query = Alert::published();

        if ($request->filled('tag')) {
            $query->where('tag', $request->tag);
        }

        $alerts = $query->latest('published_at')->paginate(9);

        return view('frontend.alert-index', compact('alerts'));
    }

    public function alertShow(string $slug)
    {
        $alert = Alert::published()->where('slug', $slug)->firstOrFail();
        $related = Alert::published()
            ->where('id', '!=', $alert->id)
            ->where('tag', $alert->tag)
            ->latest('published_at')
            ->take(3)
            ->get();
        $sidebarItems = Alert::published()
            ->where('id', '!=', $alert->id)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.alert-detail', compact('alert', 'related', 'sidebarItems'));
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

    public function bookmarks()
    {
        $bookmarks = Bookmark::active()->orderBy('sort_order')->orderBy('id')->get();

        return view('frontend.bookmarks', compact('bookmarks'));
    }
}
