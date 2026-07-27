<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EsopLead;
use Illuminate\Http\Request;

class EsopLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = EsopLead::query()->withCount('employees');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhereHas('employees', function ($eq) use ($search) {
                      $eq->where('emp_name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && in_array($request->input('status'), EsopLead::STATUSES, true)) {
            $query->where('status', $request->input('status'));
        }

        $leads = $query->latest()->paginate(20)->withQueryString();

        return view('admin.esop-leads.index', compact('leads'));
    }

    public function show(EsopLead $esopLead)
    {
        $esopLead->load('employees');

        // Mirrors the Excel model's Dashboard sheet: headcount + total
        // allocated % grouped by department and by seniority level.
        $breakdowns = \App\Services\EsopAllocationCalculator::breakdowns($esopLead->employees);
        $byDepartment = $breakdowns['byDepartment'];
        $byLevel = $breakdowns['byLevel'];

        return view('admin.esop-leads.show', compact('esopLead', 'byDepartment', 'byLevel'));
    }

    public function updateStatus(Request $request, EsopLead $esopLead)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', EsopLead::STATUSES),
        ]);

        $esopLead->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function destroy(EsopLead $esopLead)
    {
        $esopLead->delete();

        return redirect()->route('admin.esop-leads.index')->with('success', 'Lead deleted.');
    }
}
