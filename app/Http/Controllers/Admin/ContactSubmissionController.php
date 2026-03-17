<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $submissions = $query->latest()->paginate(10)->withQueryString();

        return view('admin.contact-submissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $submission)
    {
        if ($submission->status === 'new') {
            $submission->update(['status' => 'read']);
        }

        return view('admin.contact-submissions.show', compact('submission'));
    }

    public function updateStatus(Request $request, ContactSubmission $submission)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,archived',
        ]);

        $submission->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Submission status updated.');
    }

    public function destroy(ContactSubmission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.contact-submissions.index')->with('success', 'Submission deleted.');
    }
}
