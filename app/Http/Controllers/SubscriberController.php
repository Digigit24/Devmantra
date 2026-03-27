<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:255',
        ]);

        $exists = NewsletterSubscriber::where('email', $validated['email'])->exists();

        if ($exists) {
            return response()->json([
                'status'  => 'already',
                'message' => 'You are already subscribed!',
            ], 200);
        }

        NewsletterSubscriber::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Thank you for subscribing!',
        ], 201);
    }
}
