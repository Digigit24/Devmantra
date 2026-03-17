@extends('layouts.admin')
@section('title', 'Alerts')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.alerts.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.alerts.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Alert
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search alerts..." class="dm-form-input" style="max-width:260px;">
            <select name="tag" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Tags</option>
                <option value="tax" {{ request('tag') === 'tax' ? 'selected' : '' }}>Tax</option>
                <option value="deal" {{ request('tag') === 'deal' ? 'selected' : '' }}>Deal</option>
            </select>
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
                <th>Tag</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alerts as $item)
            <tr>
                <td>
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" class="dm-table-thumb" alt="">
                    @else
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:var(--dm-purple-light);"><i class="fa-solid fa-image" style="color:var(--dm-purple);"></i></div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ Str::limit($item->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/alert/{{ $item->slug }}</div>
                </td>
                <td>
                    @php
                        $tagColors = [
                            'tax' => 'background:rgba(245,158,11,0.15);color:#d97706;',
                            'deal' => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                        ];
                    @endphp
                    <span class="dm-badge" style="{{ $tagColors[$item->tag] ?? '' }}">
                        {{ ucfirst($item->tag) }}
                    </span>
                </td>
                <td>
                    <span class="dm-badge {{ $item->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>
                    @if($item->is_featured)
                        <i class="fa-solid fa-star" style="color:var(--dm-warning);"></i>
                    @endif
                </td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $item->created_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.alerts.edit', $item) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.alerts.destroy', $item) }}" onsubmit="return confirm('Delete this alert?')">
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
                    <i class="fa-solid fa-bell" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No alerts yet. <a href="{{ route('admin.alerts.create') }}">Create your first alert</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($alerts->hasPages())
    <div class="dm-pagination">
        {{ $alerts->links() }}
    </div>
    @endif
</div>
@endsection
