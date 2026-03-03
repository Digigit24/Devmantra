<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    public function pages()
    {
        $pages = Page::withCount('sections')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function index(Page $page)
    {
        $sections = $page->sections()->get();

        if (request()->wantsJson()) {
            return response()->json($sections);
        }

        return view('admin.pages.edit', compact('page', 'sections'));
    }

    public function store(Request $request, Page $page)
    {
        $request->validate([
            'section_type' => 'required|string|max:100',
            'section_data' => 'required|string',
        ]);

        $data = json_decode($request->section_data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['success' => false, 'error' => 'Invalid JSON data.'], 422);
        }

        $maxOrder = $page->sections()->max('sort_order') ?? -1;

        $section = $page->sections()->create([
            'section_type' => $request->section_type,
            'section_data' => $data,
            'sort_order'   => $request->filled('sort_order') ? (int) $request->sort_order : $maxOrder + 1,
            'is_active'    => filter_var($request->input('is_active', true), FILTER_VALIDATE_BOOLEAN),
        ]);

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function update(Request $request, Page $page, PageSection $section)
    {
        abort_if($section->page_id !== $page->id, 404);

        $request->validate([
            'section_type' => 'required|string|max:100',
            'section_data' => 'required|string',
        ]);

        $data = json_decode($request->section_data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['success' => false, 'error' => 'Invalid JSON data.'], 422);
        }

        $section->update([
            'section_type' => $request->section_type,
            'section_data' => $data,
            'sort_order'   => $request->filled('sort_order') ? (int) $request->sort_order : $section->sort_order,
            'is_active'    => filter_var($request->input('is_active', true), FILTER_VALIDATE_BOOLEAN),
        ]);

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function destroy(Page $page, PageSection $section)
    {
        abort_if($section->page_id !== $page->id, 404);
        $section->delete();
        return response()->json(['success' => true]);
    }

    public function reorder(Request $request, Page $page)
    {
        $ids = $request->input('order', []);
        foreach ($ids as $i => $id) {
            $page->sections()->where('id', $id)->update(['sort_order' => $i]);
        }
        return response()->json(['success' => true]);
    }

    public function toggle(Page $page, PageSection $section)
    {
        abort_if($section->page_id !== $page->id, 404);
        $section->update(['is_active' => !$section->is_active]);
        return response()->json(['success' => true]);
    }
}
