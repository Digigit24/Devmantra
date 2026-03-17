<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CaseStudyController extends Controller
{
    public function index(Request $request)
    {
        $query = CaseStudy::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $caseStudies = $query->latest()->paginate(10)->withQueryString();
        $trashedCount = CaseStudy::onlyTrashed()->count();

        return view('admin.case-studies.index', compact('caseStudies', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = CaseStudy::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $caseStudies = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.case-studies.trash', compact('caseStudies'));
    }

    public function create()
    {
        return view('admin.case-studies.create');
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
            $validated['featured_image'] = $request->file('featured_image')->store('case-studies', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        CaseStudy::create($validated);

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study created successfully.');
    }

    public function edit(CaseStudy $caseStudy)
    {
        return view('admin.case-studies.edit', compact('caseStudy'));
    }

    public function update(Request $request, CaseStudy $caseStudy)
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
            if ($caseStudy->featured_image) {
                Storage::disk('public')->delete($caseStudy->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('case-studies', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($validated['status'] === 'published' && !$caseStudy->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $caseStudy->update($validated);

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study updated successfully.');
    }

    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->delete();

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study moved to trash.');
    }

    public function restore(int $id)
    {
        $caseStudy = CaseStudy::onlyTrashed()->findOrFail($id);
        $caseStudy->restore();

        return redirect()->route('admin.case-studies.trash')->with('success', 'Case study restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $caseStudy = CaseStudy::onlyTrashed()->findOrFail($id);

        if ($caseStudy->featured_image) {
            Storage::disk('public')->delete($caseStudy->featured_image);
        }

        $caseStudy->forceDelete();

        return redirect()->route('admin.case-studies.trash')->with('success', 'Case study permanently deleted.');
    }
}
