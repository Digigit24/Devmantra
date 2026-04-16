<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Rules\BusinessEmailRule;
use App\Rules\NotSpamBot;
use App\Services\RateLimitService;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        // Check rate limit
        $rateLimitService = new RateLimitService();
        $rateLimitResult = $rateLimitService->checkRateLimit($request->ip(), 'newsletter');

        if (!$rateLimitResult['allowed']) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Too many submissions. Please try again in a few moments.',
            ], 429);
        }

        $validated = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => ['required', 'email', 'max:255', new BusinessEmailRule()],
            'website' => [new NotSpamBot()],
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
