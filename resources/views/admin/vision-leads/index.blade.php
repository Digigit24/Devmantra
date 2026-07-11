@extends('layouts.admin')
@section('title', 'Vision Card Leads')

@section('content')
<div class="dm-table-wrap">
    <div class="dm-table-header">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search name, email, company or industry..."
                   class="dm-form-input" style="max-width:320px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                @foreach(\App\Models\VisionLead::STATUSES as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
        <div style="font-size:13px;color:var(--dm-text-muted);">
            {{ $leads->total() }} lead{{ $leads->total() !== 1 ? 's' : '' }}
        </div>
    </div>

    @if(session('success'))
    <div class="dm-alert dm-alert-success" style="margin:16px 24px 0;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div style="overflow-x:auto;">
        <table class="dm-table" style="min-width:780px;">
            <thead>
                <tr>
                    <th>Lead</th>
                    <th>Company / Industry</th>
                    <th>Stage</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr>
                    <td>
                        <a href="{{ route('admin.vision-leads.show', $lead) }}"
                           style="font-weight:600;color:var(--dm-text);text-decoration:none;display:block;"
                           onmouseover="this.style.color='var(--dm-purple)'"
                           onmouseout="this.style.color='var(--dm-text)'">
                            {{ $lead->name }}
                        </a>
                        <div style="font-size:12px;color:var(--dm-text-muted);">{{ $lead->email }}</div>
                        @if($lead->phone)
                        <div style="font-size:12px;color:var(--dm-text-muted);">{{ $lead->phone }}</div>
                        @endif
                    </td>
                    <td style="color:var(--dm-text-muted);">
                        <div>{{ $lead->company ?: '—' }}</div>
                        <div style="font-size:12px;">{{ $lead->industry ?: '—' }}</div>
                    </td>
                    <td style="color:var(--dm-text-muted);">{{ $lead->current_stage ?: '—' }}</td>
                    <td>
                        @php
                            $colors = [
                                'partial'  => 'background:rgba(217,119,6,0.12);color:#b45309;',
                                'new'      => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                                'read'     => 'background:rgba(245,158,11,0.15);color:#d97706;',
                                'archived' => 'background:rgba(148,163,184,0.15);color:#64748b;',
                            ];
                        @endphp
                        <form method="POST" action="{{ route('admin.vision-leads.update-status', $lead) }}" style="display:inline">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()"
                                    class="dm-badge" style="{{ $colors[$lead->status] ?? '' }} border:none;cursor:pointer;font-size:12px;font-weight:600;padding:4px 10px;border-radius:6px;">
                                @foreach(\App\Models\VisionLead::STATUSES as $s)
                                <option value="{{ $s }}" {{ $lead->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td style="font-size:13px;color:var(--dm-text-muted);">{{ $lead->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.vision-leads.show', $lead) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.vision-leads.destroy', $lead) }}"
                                  onsubmit="return confirm('Delete this lead?')">
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
                        <i class="fa-solid fa-lightbulb" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                        No vision card leads yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($leads->hasPages())
    <div class="dm-pagination">
        {{ $leads->links() }}
    </div>
    @endif
</div>
@endsection
