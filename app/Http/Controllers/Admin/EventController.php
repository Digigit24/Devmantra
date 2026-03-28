<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->latest()->paginate(10)->withQueryString();
        $trashedCount = Event::onlyTrashed()->count();

        return view('admin.events.index', compact('events', 'trashedCount'));
    }

    public function trash(Request $request)
    {
        $query = Event::onlyTrashed();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->latest('deleted_at')->paginate(10)->withQueryString();

        return view('admin.events.trash', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('events', 'public');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        unset($validated['gallery_images']);
        $event = Event::create($validated);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('events/gallery', 'public');
                $event->galleryImages()->create([
                    'image_path' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $event->load('galleryImages');
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_description' => 'nullable|string|max:255',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'integer',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($event->featured_image) {
                Storage::disk('public')->delete($event->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('events', 'public');
        } else {
            unset($validated['featured_image']);
        }

        if ($validated['status'] === 'published' && !$event->published_at && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        unset($validated['gallery_images'], $validated['remove_gallery']);
        $event->update($validated);

        // Remove selected gallery images
        if ($request->filled('remove_gallery')) {
            $imagesToRemove = EventImage::where('event_id', $event->id)
                ->whereIn('id', $request->remove_gallery)
                ->get();
            foreach ($imagesToRemove as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // Add new gallery images
        if ($request->hasFile('gallery_images')) {
            $maxOrder = $event->galleryImages()->max('sort_order') ?? -1;
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('events/gallery', 'public');
                $event->galleryImages()->create([
                    'image_path' => $path,
                    'sort_order' => $maxOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function quickUpdate(Request $request, Event $event)
    {
        $validated = $request->validate([
            'hero_image_url' => 'nullable|string|max:500',
            'sort_order'     => 'nullable|integer|min:0',
        ]);

        $event->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event moved to trash.');
    }

    public function restore(int $id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);
        $event->restore();

        return redirect()->route('admin.events.trash')->with('success', 'Event restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $event = Event::onlyTrashed()->findOrFail($id);

        if ($event->featured_image) {
            Storage::disk('public')->delete($event->featured_image);
        }

        // Delete gallery images
        foreach ($event->galleryImages as $img) {
            Storage::disk('public')->delete($img->image_path);
        }
        $event->galleryImages()->delete();

        $event->forceDelete();

        return redirect()->route('admin.events.trash')->with('success', 'Event permanently deleted.');
    }
}
