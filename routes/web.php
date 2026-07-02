<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\SchemaController;
use App\Http\Controllers\Admin\AlertController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CareerApplicationController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\BookmarkController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\TypographyController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\CalculatorLeadController;
use App\Http\Controllers\Admin\FundabilityLeadController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\CostBenchmarkController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\VisionCardController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Admin\VisionLeadController;
use Illuminate\Support\Facades\Route;

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Frontend routes
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/blog', [FrontendController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::get('/services/{slug}', [FrontendController::class, 'serviceShow'])->name('service.show');
Route::get('/newsletter', [FrontendController::class, 'newsletterIndex'])->name('newsletter.index');
Route::get('/newsletter/{slug}', [FrontendController::class, 'newsletterShow'])->name('newsletter.show');
Route::get('/reports', [FrontendController::class, 'reportIndex'])->name('report.index');
Route::get('/reports/{slug}', [FrontendController::class, 'reportShow'])->name('report.show');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit')->middleware('throttle:5,1');
Route::get('/careers', [FrontendController::class, 'careers'])->name('careers');
Route::get('/careers/{slug}', [FrontendController::class, 'careerShow'])->name('career.show');
Route::post('/careers/{slug}/apply', [FrontendController::class, 'careerApply'])->name('career.apply');
Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/events/{slug}', [FrontendController::class, 'eventShow'])->name('event.show');
Route::get('/case-study', [FrontendController::class, 'caseStudyIndex'])->name('case-study.index');
Route::get('/case-study/{slug}', [FrontendController::class, 'caseStudyShow'])->name('case-study.show');
Route::get('/alert', [FrontendController::class, 'alertIndex'])->name('alert.index');
Route::get('/alert/{slug}', [FrontendController::class, 'alertShow'])->name('alert.show');
Route::post('/newsletter/subscribe', [SubscriberController::class, 'store'])->name('newsletter.subscribe');
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/bookmarks', [FrontendController::class, 'bookmarks'])->name('bookmarks');
Route::get('/india-europe-benchmarking-calculator', [CostBenchmarkController::class, 'calculator'])->name('cost-calculator');

// Cost calculator API endpoints — public, no auth required
Route::get('/api/calculator/exchange-rate', [CostBenchmarkController::class, 'getExchangeRate']);
Route::get('/api/calculator/freight-rate',  [CostBenchmarkController::class, 'getFreightRates']);
Route::get('/api/calculator/duty-rate',     [CostBenchmarkController::class, 'getDutyRate']);
Route::post('/india-europe-benchmarking-calculator/lead', [CostBenchmarkController::class, 'storeLead'])->name('cost-calculator.lead')->middleware('throttle:10,1');

// Vision Card / Growth Blueprint
Route::get('/vision-card', [VisionCardController::class, 'index'])->name('vision-card.index');
Route::post('/vision-card/generate', [VisionCardController::class, 'generate'])->name('vision-card.generate')->middleware('throttle:10,1');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Structured Data / Schema
    Route::get('schema',  [SchemaController::class, 'index'])->name('schema.index');
    Route::put('schema',  [SchemaController::class, 'update'])->name('schema.update');

    // Media Gallery
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('gallery/browse', [GalleryController::class, 'browse'])->name('gallery.browse');
    Route::post('gallery/replace', [GalleryController::class, 'replace'])->name('gallery.replace');
    Route::post('gallery/delete', [GalleryController::class, 'delete'])->name('gallery.delete');
    // Alt text — static routes BEFORE {imageMeta} to avoid shadowing
    Route::post('media/save-alt',    [GalleryController::class, 'saveAlt'])->name('media.saveAlt');
    Route::post('media/suggest-alts',[GalleryController::class, 'suggestAlts'])->name('media.suggestAlts');
    Route::post('media/{imageMeta}/suggest-alt', [GalleryController::class, 'suggestAlt'])->name('media.suggestAlt');

    // Blogs CRUD + Trash
    Route::get('blogs/trash', [BlogController::class, 'trash'])->name('blogs.trash');
    Route::post('blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');
    Route::delete('blogs/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blogs.force-delete');
    Route::resource('blogs', BlogController::class)->except(['show']);

    // Services CRUD + Trash
    Route::get('services/trash', [ServiceController::class, 'trash'])->name('services.trash');
    Route::post('services/{id}/restore', [ServiceController::class, 'restore'])->name('services.restore');
    Route::delete('services/{id}/force-delete', [ServiceController::class, 'forceDelete'])->name('services.force-delete');
    Route::resource('services', ServiceController::class)->except(['show']);

    // Section preview (used by builder iframe in create/edit/sidebar)
    Route::match(['get', 'post'], 'section-preview', [ServiceSectionController::class, 'preview'])->name('section-preview');

    // Sections library — standalone reference page
    Route::get('sections', [ServiceSectionController::class, 'library'])->name('sections.library');

    // Service Sections
    Route::prefix('services/{service}/sections')->name('services.sections.')->group(function () {
        Route::get('/', [ServiceSectionController::class, 'index'])->name('index');
        Route::get('/create', [ServiceSectionController::class, 'create'])->name('create');
        Route::post('/', [ServiceSectionController::class, 'store'])->name('store');
        Route::get('/{section}/edit', [ServiceSectionController::class, 'edit'])->name('edit');
        Route::put('/{section}', [ServiceSectionController::class, 'update'])->name('update');
        Route::delete('/{section}', [ServiceSectionController::class, 'destroy'])->name('destroy');
        Route::post('/reorder', [ServiceSectionController::class, 'reorder'])->name('reorder');
        Route::post('/{section}/toggle', [ServiceSectionController::class, 'toggle'])->name('toggle');
    });

    // Pages index + Page Sections CRUD
    Route::get('pages', [PageSectionController::class, 'pages'])->name('pages.index');
    Route::prefix('pages/{page}/sections')->name('pages.sections.')->group(function () {
        Route::get('/', [PageSectionController::class, 'index'])->name('index');
        Route::post('/', [PageSectionController::class, 'store'])->name('store');
        Route::put('/{section}', [PageSectionController::class, 'update'])->name('update');
        Route::delete('/{section}', [PageSectionController::class, 'destroy'])->name('destroy');
        Route::post('/reorder', [PageSectionController::class, 'reorder'])->name('reorder');
        Route::post('/{section}/toggle', [PageSectionController::class, 'toggle'])->name('toggle');
    });

    // Bookmarks (LinkInBio)
    Route::post('bookmarks/reorder', [BookmarkController::class, 'reorder'])->name('bookmarks.reorder');
    Route::resource('bookmarks', BookmarkController::class)->except(['show']);

    // Events CRUD + Trash
    Route::get('events/trash', [EventController::class, 'trash'])->name('events.trash');
    Route::post('events/{id}/restore', [EventController::class, 'restore'])->name('events.restore');
    Route::delete('events/{id}/force-delete', [EventController::class, 'forceDelete'])->name('events.force-delete');
    Route::patch('events/{event}/quick-update', [EventController::class, 'quickUpdate'])->name('events.quick-update');
    Route::resource('events', EventController::class)->except(['show']);

    // Careers CRUD + Trash
    Route::get('careers/trash', [CareerController::class, 'trash'])->name('careers.trash');
    Route::post('careers/{id}/restore', [CareerController::class, 'restore'])->name('careers.restore');
    Route::delete('careers/{id}/force-delete', [CareerController::class, 'forceDelete'])->name('careers.force-delete');
    Route::resource('careers', CareerController::class)->except(['show']);

    // Career Applications
    Route::get('career-applications', [CareerApplicationController::class, 'index'])->name('career-applications.index');
    Route::get('career-applications/{application}', [CareerApplicationController::class, 'show'])->name('career-applications.show');
    Route::put('career-applications/{application}/status', [CareerApplicationController::class, 'updateStatus'])->name('career-applications.update-status');
    Route::delete('career-applications/{application}', [CareerApplicationController::class, 'destroy'])->name('career-applications.destroy');

    // India vs Europe Calculator Leads
    Route::get('calculator-leads', [CalculatorLeadController::class, 'index'])->name('calculator-leads.index');
    Route::put('calculator-leads/{calculatorLead}/status', [CalculatorLeadController::class, 'updateStatus'])->name('calculator-leads.update-status');
    Route::delete('calculator-leads/{calculatorLead}', [CalculatorLeadController::class, 'destroy'])->name('calculator-leads.destroy');

    // Vision Card / Growth Blueprint Leads
    Route::get('vision-leads', [VisionLeadController::class, 'index'])->name('vision-leads.index');
    Route::get('vision-leads/{visionLead}', [VisionLeadController::class, 'show'])->name('vision-leads.show');
    Route::put('vision-leads/{visionLead}/status', [VisionLeadController::class, 'updateStatus'])->name('vision-leads.update-status');
    Route::delete('vision-leads/{visionLead}', [VisionLeadController::class, 'destroy'])->name('vision-leads.destroy');

    // Fundability Leads (proxied server-side — credentials never exposed to browser)
    Route::get('fundability-leads', [FundabilityLeadController::class, 'index'])->name('fundability-leads.index');
    Route::get('fundability-leads/export', [FundabilityLeadController::class, 'export'])->name('fundability-leads.export');
    Route::get('fundability-leads/{id}', [FundabilityLeadController::class, 'show'])->name('fundability-leads.show');

    // Contact Submissions
    Route::get('contact-submissions', [ContactSubmissionController::class, 'index'])->name('contact-submissions.index');
    Route::get('contact-submissions/{submission}', [ContactSubmissionController::class, 'show'])->name('contact-submissions.show');
    Route::put('contact-submissions/{submission}/status', [ContactSubmissionController::class, 'updateStatus'])->name('contact-submissions.update-status');
    Route::delete('contact-submissions/{submission}', [ContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');

    // Case Studies CRUD + Trash
    Route::get('case-studies/trash', [CaseStudyController::class, 'trash'])->name('case-studies.trash');
    Route::post('case-studies/{id}/restore', [CaseStudyController::class, 'restore'])->name('case-studies.restore');
    Route::delete('case-studies/{id}/force-delete', [CaseStudyController::class, 'forceDelete'])->name('case-studies.force-delete');
    Route::resource('case-studies', CaseStudyController::class)->except(['show']);

    // Alerts CRUD + Trash
    Route::get('alerts/trash', [AlertController::class, 'trash'])->name('alerts.trash');
    Route::post('alerts/{id}/restore', [AlertController::class, 'restore'])->name('alerts.restore');
    Route::delete('alerts/{id}/force-delete', [AlertController::class, 'forceDelete'])->name('alerts.force-delete');
    Route::resource('alerts', AlertController::class)->except(['show']);

    // Newsletters CRUD + Trash
    Route::get('newsletters/trash', [NewsletterController::class, 'trash'])->name('newsletters.trash');
    Route::post('newsletters/{id}/restore', [NewsletterController::class, 'restore'])->name('newsletters.restore');
    Route::delete('newsletters/{id}/force-delete', [NewsletterController::class, 'forceDelete'])->name('newsletters.force-delete');
    Route::resource('newsletters', NewsletterController::class)->except(['show']);

    // Reports CRUD + Trash
    Route::get('reports/trash', [ReportController::class, 'trash'])->name('reports.trash');
    Route::post('reports/{id}/restore', [ReportController::class, 'restore'])->name('reports.restore');
    Route::delete('reports/{id}/force-delete', [ReportController::class, 'forceDelete'])->name('reports.force-delete');
    Route::resource('reports', ReportController::class)->except(['show']);

    // Newsletter Subscribers
    Route::get('subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');

    // Contact Settings
    Route::get('contact-settings', [ContactSettingController::class, 'edit'])->name('contact-settings.edit');
    Route::put('contact-settings', [ContactSettingController::class, 'update'])->name('contact-settings.update');

    // Typography Settings
    Route::get('typography', [TypographyController::class, 'edit'])->name('typography.edit');
    Route::put('typography', [TypographyController::class, 'update'])->name('typography.update');

    // Popup Banner
    Route::get('popup', [PopupController::class, 'edit'])->name('popup.edit');
    Route::put('popup', [PopupController::class, 'update'])->name('popup.update');

    // Image upload for Summernote editor
    Route::post('upload-image', function (\Illuminate\Http\Request $request) {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048']);
        $path = $request->file('image')->store('content-images', 'public');
        return response()->json(['url' => asset('storage/' . $path)]);
    })->name('upload-image');

    // Account
    Route::get('profile', [AccountController::class, 'profile'])->name('profile');
    Route::put('profile', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::get('password', [AccountController::class, 'password'])->name('password');
    Route::put('password', [AccountController::class, 'updatePassword'])->name('password.update');
    Route::get('settings', [AccountController::class, 'settings'])->name('settings');
    Route::put('settings', [AccountController::class, 'updateSettings'])->name('settings.update');

    // Artisan cache management
    Route::post('cache/clear-config', [AccountController::class, 'clearConfig'])->name('cache.clear-config');
    Route::post('cache/clear-views',  [AccountController::class, 'clearViews'])->name('cache.clear-views');
    Route::post('cache/clear-cache',  [AccountController::class, 'clearCache'])->name('cache.clear-cache');
    Route::post('cache/clear-all',    [AccountController::class, 'clearAll'])->name('cache.clear-all');
});

// Redirect /dashboard to /admin
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin login shortcut — redirects to /login if not authenticated, /admin if already logged in
Route::get('/admin/login', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('login');
})->name('admin.login');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
