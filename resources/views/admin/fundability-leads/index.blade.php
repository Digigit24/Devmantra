@extends('layouts.admin')
@section('title', 'Fundability Leads')

@section('content')
@php
    $tierLabels = [
        'top_decile'           => 'Top Decile',
        'series_a_fundable'    => 'Series A',
        'seed_ready_with_gaps' => 'Seed Ready',
        'idea_stage'           => 'Idea Stage',
    ];
    $tierStyles = [
        'top_decile'           => 'background:rgba(34,197,94,0.15);color:#16a34a;',
        'series_a_fundable'    => 'background:rgba(116,99,255,0.15);color:var(--dm-purple);',
        'seed_ready_with_gaps' => 'background:rgba(245,158,11,0.15);color:#d97706;',
        'idea_stage'           => 'background:rgba(220,38,38,0.15);color:#dc2626;',
    ];
    $scoreColor = function($s) {
        if ($s >= 90) return '#16a34a';
        if ($s >= 70) return 'var(--dm-purple)';
        if ($s >= 50) return '#d97706';
        return '#dc2626';
    };
    $parseDate = function($dateStr) {
        if (!$dateStr) return '—';
        $cleaned = trim(preg_replace('/\s*\([^)]+\)/', '', $dateStr));
        try {
            return \Carbon\Carbon::parse($cleaned)->format('M d, Y');
        } catch (\Exception $e) {
            return '—';
        }
    };
@endphp

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-lg-2 col-md-4 col-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:var(--dm-purple-light);color:var(--dm-purple);">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['totalSubmissions'] ?? '—' }}</div>
            <div class="dm-stat-label">Total Leads</div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(245,158,11,0.15);color:#d97706;">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="dm-stat-value">{{ isset($stats['avgScore']) ? number_format($stats['avgScore'], 1) : '—' }}</div>
            <div class="dm-stat-label">Avg Score</div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(34,197,94,0.15);color:#16a34a;">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['tierBreakdown']['top_decile'] ?? 0 }}</div>
            <div class="dm-stat-label">Top Decile</div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:var(--dm-purple-light);color:var(--dm-purple);">
                <i class="fa-solid fa-rocket"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['tierBreakdown']['series_a_fundable'] ?? 0 }}</div>
            <div class="dm-stat-label">Series A</div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(245,158,11,0.15);color:#d97706;">
                <i class="fa-solid fa-seedling"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['tierBreakdown']['seed_ready_with_gaps'] ?? 0 }}</div>
            <div class="dm-stat-label">Seed Ready</div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="dm-stat-card">
            <div class="dm-stat-icon" style="background:rgba(220,38,38,0.15);color:#dc2626;">
                <i class="fa-solid fa-lightbulb"></i>
            </div>
            <div class="dm-stat-value">{{ $stats['tierBreakdown']['idea_stage'] ?? 0 }}</div>
            <div class="dm-stat-label">Idea Stage</div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="dm-table-wrap">

    <!-- Toolbar row 1: filters + search + export all -->
    <div class="dm-table-header" style="flex-wrap:wrap;gap:12px;">
        <div class="d-flex gap-2 flex-wrap align-items-center">
            @php $tiers = ['' => 'All', 'top_decile' => 'Top Decile', 'series_a_fundable' => 'Series A', 'seed_ready_with_gaps' => 'Seed Ready', 'idea_stage' => 'Idea Stage']; @endphp
            @foreach($tiers as $val => $label)
                <a href="{{ route('admin.fundability-leads.index', array_filter(['tier' => $val, 'search' => $search])) }}"
                   class="dm-btn dm-btn-sm {{ $currentTier === $val ? 'dm-btn-primary' : 'dm-btn-outline' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
        <div class="d-flex gap-2" style="margin-left:auto;">
            <!-- Search -->
            <form method="GET" class="d-flex gap-2">
                @if($currentTier)<input type="hidden" name="tier" value="{{ $currentTier }}">@endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Search name, company…" class="dm-form-input" style="width:200px;">
                <button type="submit" class="dm-btn dm-btn-outline dm-btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <!-- Export All button -->
            <a href="{{ route('admin.fundability-leads.export', array_filter(['tier' => $currentTier])) }}"
               class="dm-btn dm-btn-outline dm-btn-sm" title="Export all{{ $currentTier ? ' ('.$tierLabels[$currentTier].')' : '' }} leads to CSV">
                <i class="fa-solid fa-file-csv"></i> Export All
            </a>
        </div>
    </div>

    <!-- Selection action bar (hidden until rows are checked) -->
    <div id="selection-bar" style="display:none;padding:10px 16px;background:var(--dm-purple-light);border-bottom:1px solid rgba(116,99,255,0.2);align-items:center;justify-content:space-between;gap:12px;">
        <span style="font-size:13px;color:var(--dm-purple);font-weight:600;">
            <i class="fa-solid fa-check-square" style="margin-right:6px;"></i>
            <span id="selected-count">0</span> row(s) selected
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

    <div style="overflow-x:auto;">
    <table class="dm-table" style="min-width:780px;">
        <thead>
            <tr>
                <th style="width:40px;padding-left:16px;">
                    <input type="checkbox" id="select-all" title="Select all on this page"
                           style="width:15px;height:15px;cursor:pointer;accent-color:var(--dm-purple);">
                </th>
                <th>Founder / Company</th>
                <th>Email</th>
                <th>Sector</th>
                <th>Score</th>
                <th>Tier</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($leads as $lead)
            @php $score = $lead['totalScore'] ?? 0; @endphp
            <tr>
                <td style="padding-left:16px;width:40px;">
                    <input type="checkbox" class="row-checkbox"
                           style="width:15px;height:15px;cursor:pointer;accent-color:var(--dm-purple);"
                           data-name="{{ $lead['founderName'] ?? '' }}"
                           data-company="{{ $lead['companyName'] ?? '' }}"
                           data-email="{{ $lead['email'] ?? '' }}"
                           data-phone="{{ $lead['phone'] ?? '' }}"
                           data-sector="{{ $lead['sector'] ?? '' }}"
                           data-score="{{ $score }}"
                           data-tier="{{ $tierLabels[$lead['tier'] ?? ''] ?? ($lead['tier'] ?? '') }}"
                           data-date="{{ $parseDate($lead['createdAt'] ?? null) }}">
                </td>
                <td>
                    <a href="{{ route('admin.fundability-leads.show', $lead['id']) }}"
                       style="font-weight:600;color:var(--dm-text);text-decoration:none;display:block;"
                       onmouseover="this.style.color='var(--dm-purple)'"
                       onmouseout="this.style.color='var(--dm-text)'">
                        {{ $lead['founderName'] ?? '—' }}
                    </a>
                    <div style="font-size:12px;color:var(--dm-text-muted);">{{ $lead['companyName'] ?? '' }}</div>
                </td>
                <td style="font-size:12px;color:var(--dm-text-muted);">{{ $lead['email'] ?? '—' }}</td>
                <td><span class="dm-badge">{{ $lead['sector'] ?? '—' }}</span></td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <span style="font-weight:600;color:{{ $scoreColor($score) }};min-width:28px;">{{ $score }}</span>
                        <div style="flex:1;height:5px;background:var(--dm-border);border-radius:3px;overflow:hidden;min-width:60px;">
                            <div style="height:100%;width:{{ $score }}%;background:{{ $scoreColor($score) }};border-radius:3px;"></div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="dm-badge" style="{{ $tierStyles[$lead['tier'] ?? ''] ?? '' }}">
                        {{ $tierLabels[$lead['tier'] ?? ''] ?? ($lead['tier'] ?? '—') }}
                    </span>
                </td>
                <td style="font-size:12px;color:var(--dm-text-muted);">
                    {{ $parseDate($lead['createdAt'] ?? null) }}
                </td>
                <td>
                    <a href="{{ route('admin.fundability-leads.show', $lead['id']) }}" class="dm-btn dm-btn-outline dm-btn-sm">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;padding:48px;color:var(--dm-text-muted);">
                    <i class="fa-solid fa-inbox" style="font-size:32px;display:block;margin-bottom:12px;"></i>
                    No fundability leads found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>{{-- /overflow-x:auto --}}

    @php
        $totalPages     = $meta['totalPages'] ?? 1;
        $currentPageNum = $meta['page'] ?? 1;
        $total          = $meta['total'] ?? count($leads);
    @endphp
    @if($totalPages > 1)
    <div style="padding:14px 16px;display:flex;align-items:center;justify-content:space-between;border-top:1px solid var(--dm-border);font-size:12px;color:var(--dm-text-muted);">
        <span>Page {{ $currentPageNum }} of {{ $totalPages }} &middot; {{ $total }} total</span>
        <div class="d-flex gap-1">
            @if($currentPageNum > 1)
                <a href="{{ route('admin.fundability-leads.index', array_filter(['page' => $currentPageNum - 1, 'tier' => $currentTier, 'search' => $search])) }}"
                   class="dm-btn dm-btn-outline dm-btn-sm"><i class="fa-solid fa-chevron-left"></i></a>
            @endif
            @for($i = 1; $i <= min($totalPages, 7); $i++)
                <a href="{{ route('admin.fundability-leads.index', array_filter(['page' => $i, 'tier' => $currentTier, 'search' => $search])) }}"
                   class="dm-btn dm-btn-sm {{ $i === $currentPageNum ? 'dm-btn-primary' : 'dm-btn-outline' }}">{{ $i }}</a>
            @endfor
            @if($currentPageNum < $totalPages)
                <a href="{{ route('admin.fundability-leads.index', array_filter(['page' => $currentPageNum + 1, 'tier' => $currentTier, 'search' => $search])) }}"
                   class="dm-btn dm-btn-outline dm-btn-sm"><i class="fa-solid fa-chevron-right"></i></a>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
const selectAll   = document.getElementById('select-all');
const selBar      = document.getElementById('selection-bar');
const selCount    = document.getElementById('selected-count');

function getChecked() {
    return [...document.querySelectorAll('.row-checkbox:checked')];
}

function updateBar() {
    const checked = getChecked();
    selBar.style.display = checked.length ? 'flex' : 'none';
    selCount.textContent = checked.length;
    selectAll.indeterminate = checked.length > 0 && checked.length < document.querySelectorAll('.row-checkbox').length;
    selectAll.checked = checked.length > 0 && checked.length === document.querySelectorAll('.row-checkbox').length;
}

selectAll.addEventListener('change', function () {
    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = this.checked);
    updateBar();
});

document.querySelectorAll('.row-checkbox').forEach(cb => {
    cb.addEventListener('change', updateBar);
});

function clearSelection() {
    document.querySelectorAll('.row-checkbox').forEach(cb => cb.checked = false);
    selectAll.checked = false;
    updateBar();
}

function csvEscape(val) {
    const str = String(val ?? '');
    return str.includes(',') || str.includes('"') || str.includes('\n')
        ? '"' + str.replace(/"/g, '""') + '"'
        : str;
}

function exportSelected() {
    const checked = getChecked();
    if (!checked.length) return;

    const cols = ['Founder Name', 'Company Name', 'Email', 'Phone', 'Sector', 'Score', 'Tier', 'Date Submitted'];
    const rows = checked.map(cb => [
        cb.dataset.name,
        cb.dataset.company,
        cb.dataset.email,
        cb.dataset.phone,
        cb.dataset.sector,
        cb.dataset.score,
        cb.dataset.tier,
        cb.dataset.date,
    ]);

    const csv = '﻿' + [cols, ...rows].map(r => r.map(csvEscape).join(',')).join('\r\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = 'fundability-leads-selected-{{ now()->format("Y-m-d") }}.csv';
    a.click();
    URL.revokeObjectURL(url);
}
</script>
@endsection
