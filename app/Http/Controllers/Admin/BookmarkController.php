<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.bookmarks.index', compact('bookmarks'));
    }

    public function create()
    {
        return view('admin.bookmarks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|url|max:2048',
            'description' => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['is_active']  = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? Bookmark::max('sort_order') + 1;

        Bookmark::create($validated);

        return redirect()->route('admin.bookmarks.index')->with('success', 'Link added successfully.');
    }

    public function edit(Bookmark $bookmark)
    {
        return view('admin.bookmarks.edit', compact('bookmark'));
    }

    public function update(Request $request, Bookmark $bookmark)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|url|max:2048',
            'description' => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:100',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['is_active']  = $request->boolean('is_active', true);

        $bookmark->update($validated);

        return redirect()->route('admin.bookmarks.index')->with('success', 'Link updated successfully.');
    }

    public function destroy(Bookmark $bookmark)
    {
        $bookmark->delete();

        return redirect()->route('admin.bookmarks.index')->with('success', 'Link deleted.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['order' => 'required|array', 'order.*' => 'integer']);

        foreach ($request->order as $position => $id) {
            Bookmark::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json(['ok' => true]);
    }
}
