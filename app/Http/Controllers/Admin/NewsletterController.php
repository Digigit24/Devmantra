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
        $trashedCount = Newsletter::onlyTrashed()->count();

        return view('admin.newsletters.index', compact('newsletters', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = Newsletter::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $newsletters = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.newsletters.trash', compact('newsletters'));
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
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'edition_label' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('newsletters', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
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
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'edition_label' => 'nullable|string|max:100',
            'is_featured' => 'nullable|boolean',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($newsletter->featured_image) {
                Storage::disk('public')->delete($newsletter->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('newsletters', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && !$newsletter->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $newsletter->update($validated);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter updated successfully.');
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter moved to trash.');
    }

    public function restore(int $id)
    {
        $newsletter = Newsletter::onlyTrashed()->findOrFail($id);
        $newsletter->restore();

        return redirect()->route('admin.newsletters.trash')->with('success', 'Newsletter restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $newsletter = Newsletter::onlyTrashed()->findOrFail($id);

        if ($newsletter->featured_image) {
            Storage::disk('public')->delete($newsletter->featured_image);
        }

        $newsletter->forceDelete();

        return redirect()->route('admin.newsletters.trash')->with('success', 'Newsletter permanently deleted.');
    }
}
