@extends('layouts.admin')
@section('title', 'Trashed Case Studies')

@section('actions')
<a href="{{ route('admin.case-studies.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Case Studies
</a>
@endsection

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search trashed case studies..." class="dm-form-input" style="max-width:260px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
        </form>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($caseStudies as $item)
            <tr>
                <td>
                    <div style="font-weight:600;color:var(--dm-text);">{{ Str::limit($item->title, 50) }}</div>
                    <div style="font-size:12px;color:var(--dm-text-muted);">/case-study/{{ $item->slug }}</div>
                </td>
                <td style="color:var(--dm-text-muted);">{{ $item->category }}</td>
                <td style="font-size:13px;color:var(--dm-text-muted);">{{ $item->deleted_at->format('M d, Y') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route('admin.case-studies.restore', $item->id) }}">
                            @csrf
                            <button type="submit" class="dm-btn dm-btn-primary dm-btn-sm">
                                <i class="fa-solid fa-rotate-left"></i> Restore
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.case-studies.force-delete', $item->id) }}" onsubmit="return confirm('Permanently delete this case study? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="dm-btn dm-btn-danger dm-btn-sm">
                                <i class="fa-solid fa-trash"></i> Delete Forever
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-trash-can" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    Trash is empty.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($caseStudies->hasPages())
    <div class="dm-pagination">
        {{ $caseStudies->links() }}
    </div>
    @endif
</div>
@endsection
