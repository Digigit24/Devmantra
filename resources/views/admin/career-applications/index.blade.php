@extends('layouts.admin')
@section('title', 'Career Applications')

@section('actions')
<a href="{{ route('admin.careers.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Careers
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="dm-form-input" style="max-width:220px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                @foreach(['new', 'reviewed', 'shortlisted', 'rejected'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <select name="career_id" class="dm-form-select" style="max-width:200px;" onchange="this.form.submit()">
                <option value="">All Positions</option>
                @foreach($careers as $career)
                <option value="{{ $career->id }}" {{ request('career_id') == $career->id ? 'selected' : '' }}>{{ Str::limit($career->title, 30) }}</option>
                @endforeach
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Position</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Applied</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $app)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ $app->name }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">{{ $app->email }}</div>
                </td>
                <td style="color:var(--dm-text-muted);">{{ $app->career?->title ?? 'Deleted' }}</td>
                <td style="color:var(--dm-text-muted);">{{ $app->phone ?: '—' }}</td>
                <td>
                    @php
                        $statusColors = [
                            'new' => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                            'reviewed' => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'shortlisted' => 'background:rgba(34,197,94,0.15);color:#16a34a;',
                            'rejected' => 'background:rgba(239,68,68,0.15);color:#dc2626;',
                        ];
                    @endphp
                    <span class="dm-badge" style="{{ $statusColors[$app->status] ?? '' }}">
                        {{ ucfirst($app->status) }}
                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $app->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.career-applications.show', $app) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.career-applications.destroy', $app) }}" onsubmit="return confirm('Delete this application?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="dm-btn dm-btn-danger dm-btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-inbox" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No applications yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($applications->hasPages())
    <div class="dm-pagination">
        {{ $applications->links() }}
    </div>
    @endif
</div>
@endsection
