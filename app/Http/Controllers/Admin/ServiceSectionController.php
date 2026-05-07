<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceSection;
use Illuminate\Http\Request;

class ServiceSectionController extends Controller
{
    public function index(Service $service)
    {
        $sections = $service->sections()->get();

        if (request()->wantsJson()) {
            return response()->json($sections);
        }

        return view('admin.service-sections.index', compact('service', 'sections'));
    }

    public function create(Service $service)
    {
        $sectionTypes = ServiceSection::sectionTypes();

        return view('admin.service-sections.create', compact('service', 'sectionTypes'));
    }

    public function store(Request $request, Service $service)
    {
        $request->validate([
            'section_type' => ['required', 'string', 'max:100'],
            'section_data' => ['required', 'string'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable'],
        ]);

        $jsonData = json_decode($request->section_data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Invalid JSON: ' . json_last_error_msg()], 422);
            }
            return back()->withInput()->withErrors(['section_data' => 'Invalid JSON: ' . json_last_error_msg()]);
        }

        $maxOrder = $service->sections()->max('sort_order') ?? -1;

        $section = $service->sections()->create([
            'section_type' => $request->section_type,
            'section_data' => $jsonData,
            'sort_order'   => $request->filled('sort_order') ? (int) $request->sort_order : $maxOrder + 1,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'section' => $section->refresh()]);
        }

        return redirect()
            ->route('admin.services.sections.index', $service)
            ->with('success', 'Section added successfully.');
    }

    public function edit(Service $service, ServiceSection $section)
    {
        abort_if($section->service_id !== $service->id, 404);
        $sectionTypes = ServiceSection::sectionTypes();

        return view('admin.service-sections.edit', compact('service', 'section', 'sectionTypes'));
    }

    public function update(Request $request, Service $service, ServiceSection $section)
    {
        abort_if($section->service_id !== $service->id, 404);

        $request->validate([
            'section_type' => ['required', 'string', 'max:100'],
            'section_data' => ['required', 'string'],
            'sort_order'   => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable'],
        ]);

        $jsonData = json_decode($request->section_data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Invalid JSON: ' . json_last_error_msg()], 422);
            }
            return back()->withInput()->withErrors(['section_data' => 'Invalid JSON: ' . json_last_error_msg()]);
        }

        $section->update([
            'section_type' => $request->section_type,
            'section_data' => $jsonData,
            'sort_order'   => $request->filled('sort_order') ? (int) $request->sort_order : $section->sort_order,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'section' => $section->refresh()]);
        }

        return redirect()
            ->route('admin.services.sections.index', $service)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Service $service, ServiceSection $section)
    {
        abort_if($section->service_id !== $service->id, 404);
        $section->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Section deleted.');
    }

    public function reorder(Request $request, Service $service)
    {
        $request->validate(['order' => ['required', 'array'], 'order.*' => ['integer']]);

        foreach ($request->order as $position => $sectionId) {
            $service->sections()->where('id', $sectionId)->update(['sort_order' => $position]);
        }

        return response()->json(['ok' => true]);
    }

    public function toggle(Service $service, ServiceSection $section)
    {
        abort_if($section->service_id !== $service->id, 404);
        $section->update(['is_active' => ! $section->is_active]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'is_active' => $section->is_active]);
        }

        return back()->with('success', 'Section visibility updated.');
    }

    public function preview(Request $request)
    {
        $type = $request->input('type', '');
        $data = json_decode($request->input('data', '{}'), true) ?? [];

        return view('admin.service-sections.preview', compact('type', 'data'));
    }

    public function library()
    {
        return view('admin.sections.library', [
            'sectionTypes' => ServiceSection::sectionTypes(),
        ]);
    }
}
