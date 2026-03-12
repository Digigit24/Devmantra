<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CareerApplicationController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/careers', [FrontendController::class, 'careers'])->name('careers');
Route::get('/careers/{slug}', [FrontendController::class, 'careerShow'])->name('career.show');
Route::post('/careers/{slug}/apply', [FrontendController::class, 'careerApply'])->name('career.apply');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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

    // Contact Settings
    Route::get('contact-settings', [ContactSettingController::class, 'edit'])->name('contact-settings.edit');
    Route::put('contact-settings', [ContactSettingController::class, 'update'])->name('contact-settings.update');

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
