@extends('layouts.admin')
@section('title', 'Careers')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.careers.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.careers.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Career
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search careers..." class="dm-form-input" style="max-width:260px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <select name="type" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Types</option>
                @foreach(['Full-time', 'Part-time', 'Remote', 'Contract'] as $t)
                <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Type</th>
                <th>Status</th>
                <th>Applications</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($careers as $career)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ Str::limit($career->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/careers/{{ $career->slug }}</div>
                </td>
                <td style="color:var(--dm-text-muted);">{{ $career->location ?: '—' }}</td>
                <td><span class="dm-badge dm-badge-published">{{ $career->type }}</span></td>
                <td>
                    <span class="dm-badge {{ $career->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($career->status) }}
                    </span>
                </td>
                <td style="text-align:center;">
                    <a href="{{ route('admin.career-applications.index', ['career_id' => $career->id]) }}" style="font-weight:600;">
                        {{ $career->applications_count ?? $career->applications()->count() }}
                    </a>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $career->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.careers.edit', $career) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.careers.destroy', $career) }}" onsubmit="return confirm('Delete this career?')">
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
                    <i class="fa-solid fa-briefcase" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No careers yet. <a href="{{ route('admin.careers.create') }}">Create your first career listing</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($careers->hasPages())
    <div class="dm-pagination">
        {{ $careers->links() }}
    </div>
    @endif
</div>
@endsection
