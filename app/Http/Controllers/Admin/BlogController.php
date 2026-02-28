<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $blogs = $query->latest()->paginate(10)->withQueryString();
        $trashedCount = Blog::onlyTrashed()->count();

        return view('admin.blogs.index', compact('blogs', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = Blog::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.blogs.trash', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string|max:100',
            'meta_description' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'required|string|max:100',
            'meta_description' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:50',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && !$blog->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog moved to trash.');
    }

    public function restore(int $id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();

        return redirect()->route('admin.blogs.trash')->with('success', 'Blog restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);

        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->forceDelete();

        return redirect()->route('admin.blogs.trash')->with('success', 'Blog permanently deleted.');
    }
}
