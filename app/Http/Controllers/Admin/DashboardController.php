<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Newsletter;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'blogs' => Blog::count(),
            'blogs_published' => Blog::published()->count(),
            'services' => Service::count(),
            'services_homepage' => Service::homepage()->count(),
            'newsletters' => Newsletter::count(),
            'newsletters_published' => Newsletter::published()->count(),
        ];

        $recentBlogs = Blog::latest()->take(5)->get();
        $recentServices = Service::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBlogs', 'recentServices'));
    }
}
