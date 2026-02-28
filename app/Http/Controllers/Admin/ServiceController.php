<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $services = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'hero_image' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'show_on_homepage' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        $validated['show_on_homepage'] = $request->boolean('show_on_homepage');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'image' => 'nullable|image|max:2048',
            'hero_image' => 'nullable|image|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'show_on_homepage' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }
        if ($request->hasFile('hero_image')) {
            if ($service->hero_image) {
                Storage::disk('public')->delete($service->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('services', 'public');
        }

        $validated['show_on_homepage'] = $request->boolean('show_on_homepage');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        if ($service->hero_image) {
            Storage::disk('public')->delete($service->hero_image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
