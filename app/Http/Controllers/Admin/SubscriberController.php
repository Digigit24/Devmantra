<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest()->paginate(20)->withQueryString();

        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('admin.subscribers.index')->with('success', 'Subscriber removed.');
    }
}
