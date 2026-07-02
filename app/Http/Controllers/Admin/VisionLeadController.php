<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisionLead;
use Illuminate\Http\Request;

class VisionLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = VisionLead::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && in_array($request->input('status'), VisionLead::STATUSES, true)) {
            $query->where('status', $request->input('status'));
        }

        $leads = $query->latest()->paginate(20)->withQueryString();

        return view('admin.vision-leads.index', compact('leads'));
    }

    public function show(VisionLead $visionLead)
    {
        return view('admin.vision-leads.show', compact('visionLead'));
    }

    public function updateStatus(Request $request, VisionLead $visionLead)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', VisionLead::STATUSES),
        ]);

        $visionLead->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function destroy(VisionLead $visionLead)
    {
        $visionLead->delete();

        return redirect()->route('admin.vision-leads.index')->with('success', 'Lead deleted.');
    }
}
