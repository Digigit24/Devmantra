@extends('layouts.admin')
@section('title', 'Newsletters')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.newsletters.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.newsletters.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Newsletter
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search newsletters..." class="dm-form-input" style="max-width:260px;">
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
            @forelse($newsletters as $newsletter)
            <tr>
                <td>
                    @if($newsletter->featured_image)
                        <img src="{{ asset('storage/' . $newsletter->featured_image) }}" class="dm-table-thumb" alt="">
                    @else
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:var(--dm-purple-light);"><i class="fa-solid fa-image" style="color:var(--dm-purple);"></i></div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ Str::limit($newsletter->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/newsletter/{{ $newsletter->slug }}</div>
                </td>
                <td style="color:var(--dm-text-muted);">{{ $newsletter->edition_label ?? '-' }}</td>
                <td>
                    <span class="dm-badge {{ $newsletter->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($newsletter->status) }}
                    </span>
                </td>
                <td>
                    @if($newsletter->is_featured)
                        <i class="fa-solid fa-star" style="color:var(--dm-warning);"></i>
                    @endif
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">
                    {{ $newsletter->published_at ? $newsletter->published_at->format('M d, Y') : '-' }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.newsletters.edit', $newsletter) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.newsletters.destroy', $newsletter) }}" onsubmit="return confirm('Delete this newsletter?')">
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
                    <i class="fa-solid fa-newspaper" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No newsletters yet. <a href="{{ route('admin.newsletters.create') }}">Create your first newsletter</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($newsletters->hasPages())
    <div class="dm-pagination">
        {{ $newsletters->links() }}
    </div>
    @endif
</div>
@endsection
