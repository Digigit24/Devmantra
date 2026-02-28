<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $newsletters = $query->latest()->paginate(10)->withQueryString();

        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        return view('admin.newsletters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'edition_label' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('newsletters', 'public');
        }

        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        Newsletter::create($validated);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter created successfully.');
    }

    public function edit(Newsletter $newsletter)
    {
        return view('admin.newsletters.edit', compact('newsletter'));
    }

    public function update(Request $request, Newsletter $newsletter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'edition_label' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($newsletter->featured_image) {
                Storage::disk('public')->delete($newsletter->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('newsletters', 'public');
        }

        if ($validated['status'] === 'published' && !$newsletter->published_at) {
            $validated['published_at'] = now();
        }

        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $newsletter->update($validated);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter updated successfully.');
    }

    public function destroy(Newsletter $newsletter)
    {
        if ($newsletter->featured_image) {
            Storage::disk('public')->delete($newsletter->featured_image);
        }
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter deleted successfully.');
    }
}
