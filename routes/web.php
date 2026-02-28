<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ServiceController;
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

    // Newsletters CRUD + Trash
    Route::get('newsletters/trash', [NewsletterController::class, 'trash'])->name('newsletters.trash');
    Route::post('newsletters/{id}/restore', [NewsletterController::class, 'restore'])->name('newsletters.restore');
    Route::delete('newsletters/{id}/force-delete', [NewsletterController::class, 'forceDelete'])->name('newsletters.force-delete');
    Route::resource('newsletters', NewsletterController::class)->except(['show']);
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
