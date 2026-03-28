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

@push('styles')
<style>
.ev-qi { display:flex; align-items:center; gap:6px; }
.ev-qi input[type="number"] { width:64px; padding:5px 8px; border:1px solid rgba(0,0,0,0.15); border-radius:6px; font-size:13px; text-align:center; }
.ev-qi input[type="text"] { flex:1; min-width:0; padding:5px 8px; border:1px solid rgba(0,0,0,0.15); border-radius:6px; font-size:12px; }
.ev-qi input:focus { outline:none; border-color:#4a73c4; }
.ev-save-btn {
    flex-shrink:0; width:28px; height:28px; border:none; border-radius:6px;
    background:rgba(22,163,74,0.1); color:#16a34a; cursor:pointer; font-size:13px;
    display:flex; align-items:center; justify-content:center; transition:background .15s;
}
.ev-save-btn:hover { background:rgba(22,163,74,0.2); }
.ev-save-btn.saving { opacity:.5; pointer-events:none; }
.ev-save-btn.saved { background:rgba(22,163,74,0.25); }
.ev-save-btn.error { background:rgba(239,68,68,0.15); color:#ef4444; }
</style>
@endpush

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
                <th style="min-width:200px;">Hero Image URL</th>
                <th style="width:110px;">Order</th>
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

                {{-- Hero Image URL inline edit --}}
                <td>
                    <div class="ev-qi">
                        <input type="text"
                               id="hero-{{ $event->id }}"
                               value="{{ $event->hero_image_url }}"
                               placeholder="https://..."
                               title="Hero image URL">
                        <button class="ev-save-btn"
                                onclick="evSave({{ $event->id }}, this)"
                                title="Save">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    </div>
                </td>

                {{-- Sort order inline edit --}}
                <td>
                    <div class="ev-qi">
                        <input type="number"
                               id="order-{{ $event->id }}"
                               value="{{ $event->sort_order }}"
                               min="0"
                               title="Display order (lower = first)">
                        <button class="ev-save-btn"
                                onclick="evSave({{ $event->id }}, this)"
                                title="Save">
                            <i class="fa-solid fa-floppy-disk"></i>
                        </button>
                    </div>
                </td>

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
                <td colspan="6" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
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

@push('scripts')
<script>
const evQuickUrls = @json($events->pluck('id')->mapWithKeys(fn($id) => [$id => route('admin.events.quick-update', $id)]));
const evCsrf = '{{ csrf_token() }}';

async function evSave(id, btn) {
    const heroInput = document.getElementById('hero-' + id);
    const orderInput = document.getElementById('order-' + id);

    btn.classList.add('saving');
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

    try {
        const res = await fetch(evQuickUrls[id], {
            method: 'PATCH',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': evCsrf },
            body: JSON.stringify({
                hero_image_url: heroInput ? heroInput.value : undefined,
                sort_order: orderInput ? parseInt(orderInput.value) || 0 : undefined,
            }),
        });
        if (!res.ok) throw new Error();
        btn.classList.remove('saving');
        btn.classList.add('saved');
        btn.innerHTML = '<i class="fa-solid fa-check"></i>';
        setTimeout(() => {
            btn.classList.remove('saved');
            btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
        }, 1800);
    } catch (e) {
        btn.classList.remove('saving');
        btn.classList.add('error');
        btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        setTimeout(() => {
            btn.classList.remove('error');
            btn.innerHTML = '<i class="fa-solid fa-floppy-disk"></i>';
        }, 2000);
    }
}

// Also save on Enter key in inputs
document.querySelectorAll('.ev-qi input').forEach(input => {
    input.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
            const btn = input.closest('.ev-qi').querySelector('.ev-save-btn');
            btn && btn.click();
        }
    });
});
</script>
@endpush
