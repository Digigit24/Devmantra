<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(10)->withQueryString();
        $trashedCount = Report::onlyTrashed()->count();

        return view('admin.reports.index', compact('reports', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = Report::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $reports = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.reports.trash', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
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
            $validated['featured_image'] = $request->file('featured_image')->store('reports', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Report::create($validated);

        return redirect()->route('admin.reports.index')->with('success', 'Report created successfully.');
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
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
            if ($report->featured_image) {
                Storage::disk('public')->delete($report->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('reports', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && !$report->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $report->update($validated);

        return redirect()->route('admin.reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Report moved to trash.');
    }

    public function restore(int $id)
    {
        $report = Report::onlyTrashed()->findOrFail($id);
        $report->restore();

        return redirect()->route('admin.reports.trash')->with('success', 'Report restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $report = Report::onlyTrashed()->findOrFail($id);

        if ($report->featured_image) {
            Storage::disk('public')->delete($report->featured_image);
        }

        $report->forceDelete();

        return redirect()->route('admin.reports.trash')->with('success', 'Report permanently deleted.');
    }
}
