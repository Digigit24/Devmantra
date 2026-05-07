<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\CareerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = CareerApplication::with('career');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('career_id')) {
            $query->where('career_id', $request->career_id);
        }

        $applications = $query->latest()->paginate(10)->withQueryString();
        $careers = Career::orderBy('title')->get();

        return view('admin.career-applications.index', compact('applications', 'careers'));
    }

    public function show(CareerApplication $application)
    {
        $application->load('career');

        return view('admin.career-applications.show', compact('application'));
    }

    public function updateStatus(Request $request, CareerApplication $application)
    {
        $request->validate([
            'status' => 'required|in:new,reviewed,shortlisted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Application status updated.');
    }

    public function destroy(CareerApplication $application)
    {
        if ($application->resume) {
            Storage::disk('public')->delete($application->resume);
        }

        $application->delete();

        return redirect()->route('admin.career-applications.index')->with('success', 'Application deleted.');
    }
}
