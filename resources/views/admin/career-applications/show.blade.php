@extends('layouts.admin')
@section('title', 'Application Details')

@section('actions')
<a href="{{ route('admin.career-applications.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back
</a>
@endsection

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Applicant Details</h6>
            <table class="dm-table" style="margin:0;">
                <tr>
                    <td style="font-weight:600;width:140px;">Name</td>
                    <td>{{ $application->name }}</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Email</td>
                    <td><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Phone</td>
                    <td>{{ $application->phone ?: '—' }}</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Position</td>
                    <td>{{ $application->career?->title ?? 'Deleted' }}</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Applied On</td>
                    <td>{{ $application->created_at->format('M d, Y \a\t h:i A') }}</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Resume</td>
                    <td>
                        <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-download"></i> Download Resume
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:12px;text-transform:uppercase;letter-spacing:1px;color:var(--dm-text-muted);margin-bottom:16px;">Update Status</h6>
            <form method="POST" action="{{ route('admin.career-applications.update-status', $application) }}">
                @csrf @method('PUT')
                <div class="dm-form-group">
                    <select name="status" class="dm-form-select">
                        @foreach(['new', 'reviewed', 'shortlisted', 'rejected'] as $s)
                        <option value="{{ $s }}" {{ $application->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary w-100">
                    <i class="fa-solid fa-check"></i> Update Status
                </button>
            </form>

            <hr style="border-color:var(--dm-border);margin:20px 0;">

            <form method="POST" action="{{ route('admin.career-applications.destroy', $application) }}" onsubmit="return confirm('Delete this application permanently?')">
                @csrf @method('DELETE')
                <button type="submit" class="dm-btn dm-btn-danger w-100">
                    <i class="fa-solid fa-trash"></i> Delete Application
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
