@extends('layouts.admin')
@section('title', 'ESOP Calculator Leads')

@section('content')
<div class="dm-table-wrap">
    @php
        // Carry the active filters into the export links so a download always
        // matches the rows on screen rather than dumping the whole table.
        $exportFilters = array_filter(request()->only('search', 'status'));
    @endphp

    <div class="dm-table-header" style="flex-wrap:wrap;gap:12px;">
        <form method="GET" class="d-flex gap-2 flex-wrap">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search name, email or company..."
                   class="dm-form-input" style="max-width:320px;">
            <select name="status" class="dm-form-select" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">All Status</option>
                @foreach(\App\Models\EsopLead::STATUSES as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm">Filter</button>
        </form>
        <div class="d-flex gap-2 flex-wrap align-items-center" style="margin-left:auto;">
            <span style="font-size:13px;color:var(--dm-text-muted);">
                {{ $leads->total() }} session{{ $leads->total() !== 1 ? 's' : '' }}
            </span>
            <a href="{{ route('admin.esop-leads.export', $exportFilters) }}"
               class="dm-btn dm-btn-outline dm-btn-sm"
               title="One row per session — contact, pool setup and headline result">
                <i class="fa-solid fa-file-csv"></i> Export Sessions
            </a>
            <a href="{{ route('admin.esop-leads.export-employees', $exportFilters) }}"
               class="dm-btn dm-btn-outline dm-btn-sm"
               title="One row per scored employee — score, rank and recommended grant">
                <i class="fa-solid fa-users"></i> Export Employees
            </a>
        </div>
    </div>

    <!-- Selection action bar (hidden until rows are checked) -->
    <div id="selection-bar" style="display:none;padding:10px 16px;background:var(--dm-purple-light);border-bottom:1px solid rgba(116,99,255,0.2);align-items:center;justify-content:space-between;gap:12px;">
        <span style="font-size:13px;color:var(--dm-purple);font-weight:600;">
            <i class="fa-solid fa-check-square" style="margin-right:6px;"></i>
            <span id="selected-count">0</span> session(s) selected
        </span>
        <div class="d-flex gap-2">
            <button onclick="exportSelected()" class="dm-btn dm-btn-sm" style="background:var(--dm-purple);color:#fff;border-color:var(--dm-purple);">
                <i class="fa-solid fa-file-csv"></i> Export Selected
            </button>
            <button onclick="clearSelection()" class="dm-btn dm-btn-outline dm-btn-sm">
                <i class="fa-solid fa-xmark"></i> Clear
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="dm-alert dm-alert-success" style="margin:16px 24px 0;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div style="overflow-x:auto;">
        <table class="dm-table" style="min-width:820px;">
            <thead>
                <tr>
                    <th style="width:40px;padding-left:16px;">
                        <input type="checkbox" id="select-all" title="Select all on this page"
                               style="width:15px;height:15px;cursor:pointer;accent-color:var(--dm-purple);">
                    </th>
                    <th>Contact</th>
                    <th>Company</th>
                    <th>Pool</th>
                    <th>Employees scored</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                @php $summary = is_array($lead->result_summary) ? $lead->result_summary : []; @endphp
                <tr>
                    <td style="padding-left:16px;width:40px;">
                        <input type="checkbox" class="row-checkbox"
                               style="width:15px;height:15px;cursor:pointer;accent-color:var(--dm-purple);"
                               data-name="{{ $lead->name }}"
                               data-email="{{ $lead->email }}"
                               data-phone="{{ $lead->phone }}"
                               data-company="{{ $lead->company }}"
                               data-industry="{{ $lead->industry }}"
                               data-stage="{{ $lead->company_stage }}"
                               data-pool="{{ $lead->esop_pool_percent !== null ? number_format($lead->esop_pool_percent, 2) : '' }}"
                               data-reserve="{{ $lead->hiring_reserve_percent !== null ? number_format($lead->hiring_reserve_percent, 2) : '' }}"
                               data-scored="{{ $lead->employees_count }}"
                               data-allocated="{{ isset($summary['total_allocated_percent']) ? number_format($summary['total_allocated_percent'], 4) : '' }}"
                               data-status="{{ $lead->status }}"
                               data-date="{{ optional($lead->submitted_at ?? $lead->created_at)->timezone('Asia/Kolkata')->format('d M Y, g:i A') }}">
                    </td>
                    <td>
                        <a href="{{ route('admin.esop-leads.show', $lead) }}"
                           style="font-weight:600;color:var(--dm-text);text-decoration:none;display:block;"
                           onmouseover="this.style.color='var(--dm-purple)'"
                           onmouseout="this.style.color='var(--dm-text)'">
                            {{ $lead->name }}
                        </a>
                        <div style="font-size:12px;color:var(--dm-text-muted);">{{ $lead->email }}</div>
                    </td>
                    <td style="color:var(--dm-text-muted);">
                        <div>{{ $lead->company ?: '—' }}</div>
                        <div style="font-size:12px;">{{ $lead->industry ?: '—' }}</div>
                    </td>
                    <td style="color:var(--dm-text-muted);font-size:13px;">
                        {{ $lead->esop_pool_percent !== null ? number_format($lead->esop_pool_percent, 2).'%' : '—' }}
                    </td>
                    <td style="color:var(--dm-text-muted);">{{ $lead->employees_count }}</td>
                    <td>
                        @php
                            $colors = [
                                'partial'  => 'background:rgba(217,119,6,0.12);color:#b45309;',
                                'new'      => 'background:rgba(59,130,246,0.15);color:#2563eb;',
                                'read'     => 'background:rgba(245,158,11,0.15);color:#d97706;',
                                'archived' => 'background:rgba(148,163,184,0.15);color:#64748b;',
                            ];
                        @endphp
                        <form method="POST" action="{{ route('admin.esop-leads.update-status', $lead) }}" style="display:inline">
                            @csrf @method('PUT')
                            <select name="status" onchange="this.form.submit()"
                                    class="dm-badge" style="{{ $colors[$lead->status] ?? '' }} border:none;cursor:pointer;font-size:12px;font-weight:600;padding:4px 10px;border-radius:6px;">
                                @foreach(\App\Models\EsopLead::STATUSES as $s)
                                <option value="{{ $s }}" {{ $lead->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td style="font-size:13px;color:var(--dm-text-muted);">{{ $lead->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.esop-leads.show', $lead) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.esop-leads.destroy', $lead) }}"
                                  onsubmit="return confirm('Delete this session and all its scored employees?')">
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
                    <td colspan="8" style="text-align:center;padding:40px;color:var(--dm-text-muted);">
                        <i class="fa-solid fa-chart-pie" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                        No ESOP calculator sessions yet.
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

<script>
// Row selection + client-side CSV of the checked sessions. "Export Sessions"
// above hits the server and covers every filtered row across all pages; this
// covers an ad-hoc pick from the current page only, built from the data-*
// attributes already in the DOM.
(function () {
    const selectAll = document.getElementById('select-all');
    const selBar    = document.getElementById('selection-bar');
    const selCount  = document.getElementById('selected-count');
    if (!selectAll || !selBar || !selCount) return;

    const allBoxes = () => [...document.querySelectorAll('.row-checkbox')];
    const getChecked = () => [...document.querySelectorAll('.row-checkbox:checked')];

    function updateBar() {
        const checked = getChecked();
        const total   = allBoxes().length;
        selBar.style.display = checked.length ? 'flex' : 'none';
        selCount.textContent = checked.length;
        selectAll.indeterminate = checked.length > 0 && checked.length < total;
        selectAll.checked = total > 0 && checked.length === total;
    }

    selectAll.addEventListener('change', function () {
        allBoxes().forEach(cb => { cb.checked = this.checked; });
        updateBar();
    });

    allBoxes().forEach(cb => cb.addEventListener('change', updateBar));

    window.clearSelection = function () {
        allBoxes().forEach(cb => { cb.checked = false; });
        selectAll.checked = false;
        selectAll.indeterminate = false;
        updateBar();
    };

    function csvEscape(val) {
        const str = String(val ?? '');
        return /[",\n\r]/.test(str) ? '"' + str.replace(/"/g, '""') + '"' : str;
    }

    window.exportSelected = function () {
        const checked = getChecked();
        if (!checked.length) return;

        const cols = ['Contact Name', 'Email', 'Phone', 'Company', 'Industry', 'Company Stage',
                      'ESOP Pool %', 'Hiring Reserve %', 'Employees Scored', 'Total Allocated %',
                      'Status', 'Submitted'];
        const rows = checked.map(cb => [
            cb.dataset.name, cb.dataset.email, cb.dataset.phone, cb.dataset.company,
            cb.dataset.industry, cb.dataset.stage, cb.dataset.pool, cb.dataset.reserve,
            cb.dataset.scored, cb.dataset.allocated, cb.dataset.status, cb.dataset.date,
        ]);

        // Leading BOM so Excel reads it as UTF-8, matching the server exports.
        const csv  = '﻿' + [cols, ...rows].map(r => r.map(csvEscape).join(',')).join('\r\n');
        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const url  = URL.createObjectURL(blob);
        const a    = document.createElement('a');
        a.href     = url;
        a.download = 'esop-sessions-selected-{{ now()->format("Y-m-d") }}.csv';
        a.click();
        URL.revokeObjectURL(url);
    };
})();
</script>
@endsection
