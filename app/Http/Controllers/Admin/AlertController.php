<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlertController extends Controller
{
    public function index(Request $request)
    {
        $query = Alert::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('tag')) {
            $query->where('tag', $request->tag);
        }

        $alerts = $query->latest()->paginate(10)->withQueryString();
        $trashedCount = Alert::onlyTrashed()->count();

        return view('admin.alerts.index', compact('alerts', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = Alert::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $alerts = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.alerts.trash', compact('alerts'));
    }

    public function create()
    {
        return view('admin.alerts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tag' => 'required|in:tax,deal',
            'meta_description' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('alerts', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Alert::create($validated);

        return redirect()->route('admin.alerts.index')->with('success', 'Alert created successfully.');
    }

    public function edit(Alert $alert)
    {
        return view('admin.alerts.edit', compact('alert'));
    }

    public function update(Request $request, Alert $alert)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tag' => 'required|in:tax,deal',
            'meta_description' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($alert->featured_image) {
                Storage::disk('public')->delete($alert->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('alerts', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && !$alert->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $alert->update($validated);

        return redirect()->route('admin.alerts.index')->with('success', 'Alert updated successfully.');
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();

        return redirect()->route('admin.alerts.index')->with('success', 'Alert moved to trash.');
    }

    public function restore(int $id)
    {
        $alert = Alert::onlyTrashed()->findOrFail($id);
        $alert->restore();

        return redirect()->route('admin.alerts.trash')->with('success', 'Alert restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $alert = Alert::onlyTrashed()->findOrFail($id);

        if ($alert->featured_image) {
            Storage::disk('public')->delete($alert->featured_image);
        }

        $alert->forceDelete();

        return redirect()->route('admin.alerts.trash')->with('success', 'Alert permanently deleted.');
    }
}
