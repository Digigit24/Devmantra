@extends('layouts.admin')
@section('title', 'ESOP Calculator Session')

@section('content')
@php($pool = $esopLead->result_summary ?? [])
<div class="dm-table-wrap" style="padding:24px;">

    <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:16px;margin-bottom:20px;">
        <div>
            <h2 style="margin:0 0 4px;font-size:20px;">{{ $esopLead->name }}</h2>
            <div style="color:var(--dm-text-muted);font-size:13px;">{{ $esopLead->email }} @if($esopLead->phone) &middot; {{ $esopLead->phone }} @endif</div>
            <div style="color:var(--dm-text-muted);font-size:13px;">{{ $esopLead->company ?: 'No company name given' }} &middot; {{ $esopLead->industry ?: '—' }} &middot; {{ $esopLead->company_stage ?: '—' }}</div>
        </div>
        <a href="{{ route('admin.esop-leads.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Back to list
        </a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:12px;margin-bottom:24px;">
        <div class="dm-card" style="padding:14px;">
            <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;font-weight:700;">Total ESOP Pool</div>
            <div style="font-size:20px;font-weight:700;">{{ number_format($esopLead->esop_pool_percent ?? 0, 2) }}%</div>
        </div>
        <div class="dm-card" style="padding:14px;">
            <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;font-weight:700;">Hiring Reserve</div>
            <div style="font-size:20px;font-weight:700;">{{ number_format($esopLead->hiring_reserve_percent ?? 0, 2) }}%</div>
        </div>
        <div class="dm-card" style="padding:14px;">
            <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;font-weight:700;">Allocatable Pool</div>
            <div style="font-size:20px;font-weight:700;">{{ number_format($pool['allocatable_pool_percent'] ?? 0, 2) }}%</div>
        </div>
        <div class="dm-card" style="padding:14px;">
            <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;font-weight:700;">Total Recommended</div>
            <div style="font-size:20px;font-weight:700;color:#059669;">{{ number_format($pool['total_allocated_percent'] ?? 0, 4) }}%</div>
        </div>
        <div class="dm-card" style="padding:14px;">
            <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;font-weight:700;">Remaining Pool</div>
            <div style="font-size:20px;font-weight:700;">{{ number_format($pool['remaining_pool_percent'] ?? 0, 4) }}%</div>
        </div>
        <div class="dm-card" style="padding:14px;">
            <div style="font-size:11px;color:var(--dm-text-muted);text-transform:uppercase;font-weight:700;">Planned Headcount</div>
            <div style="font-size:20px;font-weight:700;">{{ $pool['scored_count'] ?? $esopLead->employees->count() }} / {{ $pool['planned_headcount'] ?? '—' }}</div>
        </div>
    </div>

    @if($esopLead->ai_content)
    <div class="dm-card" style="padding:18px;margin-bottom:24px;">
        <div style="font-size:12px;font-weight:700;text-transform:uppercase;color:var(--dm-purple);margin-bottom:8px;">AI Summary</div>
        <p style="margin:0 0 10px;font-size:14px;line-height:1.6;">{{ $esopLead->ai_content['summary'] ?? '' }}</p>
        @if(!empty($esopLead->ai_content['risk_flag']))
        <p style="margin:0 0 10px;font-size:13px;line-height:1.6;color:var(--dm-text-muted);"><strong>Risk flag:</strong> {{ $esopLead->ai_content['risk_flag'] }}</p>
        @endif
        @if(!empty($esopLead->ai_content['vesting_suggestion']))
        <p style="margin:0;font-size:13px;line-height:1.6;color:var(--dm-text-muted);"><strong>Vesting:</strong> {{ $esopLead->ai_content['vesting_suggestion'] }}</p>
        @endif
    </div>
    @endif

    @if($esopLead->employees->isNotEmpty())
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:16px;margin-bottom:24px;">
        <div class="dm-card" style="padding:16px;">
            <div style="font-size:12px;font-weight:700;text-transform:uppercase;color:var(--dm-text-muted);margin-bottom:10px;">By Department</div>
            <table class="dm-table" style="width:100%;">
                <thead><tr><th>Department</th><th>Employees</th><th>Allocated</th></tr></thead>
                <tbody>
                    @foreach($byDepartment as $row)
                    <tr>
                        <td>{{ $row['label'] }}</td>
                        <td>{{ $row['employees'] }}</td>
                        <td style="font-weight:700;color:#059669;">{{ number_format($row['allocated'], 4) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="dm-card" style="padding:16px;">
            <div style="font-size:12px;font-weight:700;text-transform:uppercase;color:var(--dm-text-muted);margin-bottom:10px;">By Seniority</div>
            <table class="dm-table" style="width:100%;">
                <thead><tr><th>Seniority</th><th>Employees</th><th>Allocated</th></tr></thead>
                <tbody>
                    @foreach($byLevel as $row)
                    <tr>
                        <td>{{ $row['label'] }}</td>
                        <td>{{ $row['employees'] }}</td>
                        <td style="font-weight:700;color:#059669;">{{ number_format($row['allocated'], 4) }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <h3 style="font-size:15px;margin-bottom:12px;">Scored employees</h3>
    <div style="overflow-x:auto;">
        <table class="dm-table" style="min-width:900px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Seniority</th>
                    <th>Tenure</th>
                    <th>Score</th>
                    <th>Peer group</th>
                    <th>Recommended grant</th>
                    <th>Share of pool</th>
                </tr>
            </thead>
            <tbody>
                @forelse($esopLead->employees as $e)
                <tr>
                    <td>{{ $e->rank ?: '—' }}</td>
                    <td>
                        <div style="font-weight:600;">{{ $e->emp_name ?: '—' }}</div>
                        <div style="font-size:12px;color:var(--dm-text-muted);">{{ $e->emp_designation ?: '—' }}</div>
                    </td>
                    <td style="color:var(--dm-text-muted);">{{ $e->emp_department ?: '—' }}</td>
                    <td style="color:var(--dm-text-muted);">{{ $e->emp_seniority }}</td>
                    <td style="color:var(--dm-text-muted);">{{ $e->emp_years }} yrs</td>
                    <td>{{ $e->total_score }}/100</td>
                    <td style="color:var(--dm-text-muted);font-size:12px;">{{ $e->tier_pool_applied ? 'Tier pool' : 'Remainder pool' }}</td>
                    <td style="font-weight:700;color:#059669;">{{ number_format($e->final_grant_percent ?? 0, 4) }}%</td>
                    <td style="color:var(--dm-text-muted);">{{ number_format($e->share_of_pool_percent ?? 0, 2) }}%</td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;padding:30px;color:var(--dm-text-muted);">No employees scored in this session.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
