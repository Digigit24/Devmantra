@extends('layouts.admin')
@section('title', 'Services')

@section('actions')
@if($trashedCount > 0)
<a href="{{ route('admin.services.trash') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-trash-can"></i> Trash ({{ $trashedCount }})
</a>
@endif
<a href="{{ route('admin.services.create') }}" class="dm-btn dm-btn-primary">
    <i class="fa-solid fa-plus"></i> New Service
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..." class="dm-form-input" style="max-width:260px;">
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
                <th>Homepage</th>
                <th>Order</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" class="dm-table-thumb" alt="">
                    @else
                        <div class="dm-table-thumb d-flex align-items-center justify-content-center" style="background:rgba(34,197,94,0.15);"><i class="fa-solid fa-briefcase" style="color:var(--dm-success);"></i></div>
                    @endif
                </td>
                <td>
                    <div style="font-weight:600;color:#fff;">{{ Str::limit($service->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/services/{{ $service->slug }}</div>
                </td>
                <td>
                    @if($service->show_on_homepage)
                        <span class="dm-badge dm-badge-published"><i class="fa-solid fa-check"></i> Slider</span>
                    @else
                        <span style="color:var(--dm-text-muted);">-</span>
                    @endif
                </td>
                <td style="color:var(--dm-text-muted);">{{ $service->sort_order }}</td>
                <td>
                    <span class="dm-badge {{ $service->status === 'published' ? 'dm-badge-published' : 'dm-badge-draft' }}">
                        {{ ucfirst($service->status) }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.services.edit', $service) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')">
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
                    <i class="fa-solid fa-briefcase" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No services yet. <a href="{{ route('admin.services.create') }}">Create your first service</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($services->hasPages())
    <div class="dm-pagination">
        {{ $services->links() }}
    </div>
    @endif
</div>
@endsection
