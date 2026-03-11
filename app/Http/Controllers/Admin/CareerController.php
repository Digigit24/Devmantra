<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $careers = $query->latest()->paginate(10)->withQueryString();
        $trashedCount = Career::onlyTrashed()->count();

        return view('admin.careers.index', compact('careers', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = Career::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $careers = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.careers.trash', compact('careers'));
    }

    public function create()
    {
        return view('admin.careers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('careers', 'public');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Career::create($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Career created successfully.');
    }

    public function edit(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($career->featured_image) {
                Storage::disk('public')->delete($career->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('careers', 'public');
        }

        if ($validated['status'] === 'published' && !$career->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $career->update($validated);

        return redirect()->route('admin.careers.index')->with('success', 'Career updated successfully.');
    }

    public function destroy(Career $career)
    {
        $career->delete();

        return redirect()->route('admin.careers.index')->with('success', 'Career moved to trash.');
    }

    public function restore(int $id)
    {
        $career = Career::onlyTrashed()->findOrFail($id);
        $career->restore();

        return redirect()->route('admin.careers.trash')->with('success', 'Career restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $career = Career::onlyTrashed()->findOrFail($id);

        if ($career->featured_image) {
            Storage::disk('public')->delete($career->featured_image);
        }

        $career->forceDelete();

        return redirect()->route('admin.careers.trash')->with('success', 'Career permanently deleted.');
    }
}
