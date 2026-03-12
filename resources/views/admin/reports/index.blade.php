@extends('layouts.admin')
@section('title', 'Reports')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.reports.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.reports.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Report
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reports..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Edition</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $report)
            <tr>
                <td>
                    @if($report->featured_image)
                        <img src="{{ asset('storage/' . $report->featured_image) }}" class="dm-table-thumb" alt="">
                    @else
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:var(--dm-purple-light);"><i class="fa-solid fa-image" style="color:var(--dm-purple);"></i></div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ Str::limit($report->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/reports/{{ $report->slug }}</div>
                </td>
                <td style="color:var(--dm-text-muted);">{{ $report->edition_label ?? '-' }}</td>
                <td>
                    <span class="dm-badge {{ $report->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($report->status) }}
                    </span>
                </td>
                <td>
                    @if($report->is_featured)
                        <i class="fa-solid fa-star" style="color:var(--dm-warning);"></i>
                    @endif
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">
                    {{ $report->published_at ? $report->published_at->format('M d, Y') : '-' }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.reports.edit', $report) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.reports.destroy', $report) }}" onsubmit="return confirm('Delete this report?')">
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
                <td colspan="7" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-file-lines" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No reports yet. <a href="{{ route('admin.reports.create') }}">Create your first report</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($reports->hasPages())
    <div class="dm-pagination">
        {{ $reports->links() }}
    </div>
    @endif
</div>
@endsection
