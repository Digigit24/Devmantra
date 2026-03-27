@extends('layouts.admin')
@section('title', 'Newsletter Subscribers')

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." class="dm-form-input" style="max-width:280px;">
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Search</button>
            @if(request('search'))
            <a href="{{ route('admin.subscribers.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">Clear</a>
            @endif
        </form>
        <div style="font-size:13px;color:var(--dm-text-muted);margin-left:auto;">
            Total: <strong>{{ $subscribers->total() }}</strong> subscribers
        </div>
    </div>
    <table class="dm-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subscribed On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subscribers as $subscriber)
            <tr>
                <td style="color:var(--dm-text-muted);font-size:13px;">{{ $subscribers->firstItem() + $loop->index }}</td>
                <td style="font-weight:600;color:var(--dm-text);">{{ $subscriber->name }}</td>
                <td style="color:var(--dm-text-muted);">{{ $subscriber->email }}</td>
                <td style="color:var(--dm-text-muted);font-size:13px;">{{ $subscriber->created_at->format('M d, Y') }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber) }}" onsubmit="return confirm('Remove this subscriber?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="dm-btn dm-btn-sm" style="background:rgba(239,68,68,0.1);color:#ef4444;border:none;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:60px 0;color:var(--dm-text-muted);">No subscribers yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($subscribers->hasPages())
    <div style="padding:20px 24px;border-top:1px solid var(--dm-border);">
        {{ $subscribers->links() }}
    </div>
    @endif
</div>
@endsection
