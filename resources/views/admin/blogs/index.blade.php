@extends('layouts.admin')
@section('title', 'Blogs')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.blogs.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.blogs.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Blog
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs..." class="dm-form-input" style="max-width:260px;">
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
                <th>Category</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
            <tr>
                <td>
                    @if($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" class="dm-table-thumb" alt="">
                    @else
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:var(--dm-purple-light);"><i class="fa-solid fa-image" style="color:var(--dm-purple);"></i></div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600;color:#fff;">{{ Str::limit($blog->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/blog/{{ $blog->slug }}</div>
                </td>
                <td>{{ $blog->category }}</td>
                <td>
                    <span class="dm-badge {{ $blog->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($blog->status) }}
                    </span>
                </td>
                <td>
                    @if($blog->is_featured)
                        <i class="fa-solid fa-star" style="color:var(--dm-warning);"></i>
                    @endif
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $blog->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" onsubmit="return confirm('Delete this blog?')">
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
                    <i class="fa-solid fa-pen-to-square" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No blogs yet. <a href="{{ route('admin.blogs.create') }}">Create your first blog</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($blogs->hasPages())
    <div class="dm-pagination">
        {{ $blogs->links() }}
    </div>
    @endif
</div>
@endsection
