<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CalculatorLead;
use Illuminate\Http\Request;

class CalculatorLeadController extends Controller
{
    public function index(Request $request)
    {
        $query = CalculatorLead::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('company', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->latest()->paginate(20)->withQueryString();

        return view('admin.calculator-leads.index', compact('leads'));
    }

    public function updateStatus(Request $request, CalculatorLead $calculatorLead)
    {
        $request->validate(['status' => 'required|in:new,read,archived']);
        $calculatorLead->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated.');
    }

    public function destroy(CalculatorLead $calculatorLead)
    {
        $calculatorLead->delete();

        return redirect()->route('admin.calculator-leads.index')->with('success', 'Lead deleted.');
    }
}
