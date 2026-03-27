@extends('layouts.admin')
@section('title', 'Events')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.events.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.events.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Event
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="dm-form-input" style="max-width:260px;">
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
                <th>Title</th>
                <th>Gallery</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ Str::limit($event->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/events/{{ $event->slug }}</div>
                </td>
                <td style="color:var(--dm-text-muted);">{{ $event->galleryImages()->count() }} images</td>
                <td>
                    <span class="dm-badge {{ $event->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($event->status) }}
                    </span>
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $event->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.events.edit', $event) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}" onsubmit="return confirm('Delete this event?')">
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
                <td colspan="5" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-calendar-days" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No events yet. <a href="{{ route('admin.events.create') }}">Create your first event</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($events->hasPages())
    <div class="dm-pagination">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
