@extends('layouts.admin')
@section('title', 'Contact Submissions')

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email or subject..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                @foreach(['new', 'read', 'replied', 'archived'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Sender</th>
                <th>Subject</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Received</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $sub)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ $sub->name }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">{{ $sub->email }}</div>
                </td>
                <td style="color:var(--dm-text-muted);max-width:220px;">{{ Str::limit($sub->subject, 40) }}</td>
                <td style="color:var(--dm-text-muted);">{{ $sub->phone ?: '—' }}</td>
                <td>
                    @php
                        $statusColors = [
                            'new' => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                            'read' => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'replied' => 'background:rgba(34,197,94,0.15);color:#16a34a;',
                            'archived' => 'background:rgba(148,163,184,0.15);color:#64748b;',
                        ];
                    @endphp
                    <span class="dm-badge" style="{{ $statusColors[$sub->status] ?? '' }}">
                        {{ ucfirst($sub->status) }}
                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $sub->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.contact-submissions.show', $sub) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.contact-submissions.destroy', $sub) }}" onsubmit="return confirm('Delete this submission?')">
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
                    No contact submissions yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($submissions->hasPages())
    <div class="dm-pagination">
        {{ $submissions->links() }}
    </div>
    @endif
</div>
@endsection
