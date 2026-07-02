@extends('layouts.admin')
@section('title', $visionLead->name . ' — Vision Card Lead')

@section('actions')
<a href="{{ route('admin.vision-leads.index') }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Leads
</a>
@endsection

@section('content')
@php
    $ai = $visionLead->ai_content ?? [];
    $statusColors = [
        'new'      => 'background:rgba(59,130,246,0.15);color:#2563eb;',
        'read'     => 'background:rgba(245,158,11,0.15);color:#d97706;',
        'archived' => 'background:rgba(148,163,184,0.15);color:#64748b;',
    ];
@endphp

<!-- Header Card -->
<div class="dm-table-wrap" style="padding:24px 28px;margin-bottom:20px;">
    <div class="row align-items-start g-3">
        <div class="col-lg-8">
            <div class="d-flex align-items-center gap-2 mb-2">
                <h4 style="font-weight:700;color:var(--dm-text);margin:0;">{{ $visionLead->name }}</h4>
                <span class="dm-badge" style="{{ $statusColors[$visionLead->status] ?? '' }}">{{ ucfirst($visionLead->status) }}</span>
            </div>
            <div style="font-size:14px;color:var(--dm-text-muted);margin-bottom:16px;">
                {{ $visionLead->company ?: 'No company name' }}
            </div>
            <div class="d-flex flex-wrap gap-3 mb-3" style="font-size:13px;color:var(--dm-text-muted);">
                <span><i class="fa-solid fa-envelope" style="margin-right:5px;"></i>{{ $visionLead->email }}</span>
                @if($visionLead->phone)
                <span><i class="fa-solid fa-phone" style="margin-right:5px;"></i>{{ $visionLead->phone }}</span>
                @endif
                @if($visionLead->city)
                <span><i class="fa-solid fa-location-dot" style="margin-right:5px;"></i>{{ $visionLead->city }}</span>
                @endif
                @if($visionLead->website)
                <span><i class="fa-solid fa-globe" style="margin-right:5px;"></i><a href="{{ $visionLead->website }}" target="_blank">{{ $visionLead->website }}</a></span>
                @endif
                <span><i class="fa-solid fa-calendar" style="margin-right:5px;"></i>{{ $visionLead->created_at->format('M d, Y H:i') }}</span>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                @if($visionLead->industry)
                <span class="dm-badge">{{ $visionLead->industry }}</span>
                @endif
                @if($visionLead->business_type)
                <span class="dm-badge">{{ $visionLead->business_type }}</span>
                @endif
                @if($visionLead->current_stage)
                <span class="dm-badge">{{ $visionLead->current_stage }}</span>
                @endif
            </div>
        </div>
        <div class="col-lg-4 text-end">
            <form method="POST" action="{{ route('admin.vision-leads.update-status', $visionLead) }}" class="d-flex justify-content-lg-end gap-2 align-items-center">
                @csrf @method('PUT')
                <select name="status" class="dm-form-select" style="width:auto;" onchange="this.form.submit()">
                    @foreach(\App\Models\VisionLead::STATUSES as $s)
                    <option value="{{ $s }}" {{ $visionLead->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left column: responses -->
    <div class="col-lg-5">
        <div class="dm-table-wrap mb-4">
            <div class="dm-table-header">
                <div class="dm-table-title"><i class="fa-solid fa-clipboard-list" style="margin-right:6px;"></i> Question Responses</div>
            </div>
            <table class="dm-table">
                <tbody>
                    <tr><td style="color:var(--dm-text-muted);width:40%;">Name</td><td style="font-weight:600;">{{ $visionLead->name }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Email</td><td>{{ $visionLead->email }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Phone</td><td>{{ $visionLead->phone ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Company</td><td>{{ $visionLead->company ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">City</td><td>{{ $visionLead->city ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Website</td><td>{{ $visionLead->website ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Industry</td><td>{{ $visionLead->industry ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Business Type</td><td>{{ $visionLead->business_type ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Years in Business</td><td>{{ $visionLead->years_in_business ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Team Size</td><td>{{ $visionLead->team_size ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Annual Revenue</td><td>{{ $visionLead->annual_revenue ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">Current Stage</td><td>{{ $visionLead->current_stage ?: '—' }}</td></tr>
                    <tr>
                        <td style="color:var(--dm-text-muted);">Challenges</td>
                        <td>
                            @forelse($visionLead->challenges ?? [] as $c)
                                <span class="dm-badge" style="margin:2px;">{{ $c }}</span>
                            @empty — @endforelse
                        </td>
                    </tr>
                    <tr><td style="color:var(--dm-text-muted);">1-Year Goal</td><td>{{ $visionLead->y1_goal ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">1-Year Detail</td><td>{{ $visionLead->y1_detail ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">What Excites Them (1Y)</td><td>{{ $visionLead->y1_excitement ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">3-Year Aspiration</td><td>{{ $visionLead->y3_goal ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">3-Year Pride Statement</td><td>{{ $visionLead->y3_proud ?: '—' }}</td></tr>
                    <tr><td style="color:var(--dm-text-muted);">5-Year Known For</td><td>{{ $visionLead->y5_known ?: '—' }}</td></tr>
                    <tr>
                        <td style="color:var(--dm-text-muted);">5-Year Achievements</td>
                        <td>
                            @forelse($visionLead->y5_achievements ?? [] as $a)
                                <span class="dm-badge" style="margin:2px;">{{ $a }}</span>
                            @empty — @endforelse
                        </td>
                    </tr>
                    <tr><td style="color:var(--dm-text-muted);">5-Year Headline</td><td>{{ $visionLead->y5_headline ?: '—' }}</td></tr>
                    <tr>
                        <td style="color:var(--dm-text-muted);">Founder Identity</td>
                        <td>
                            @forelse($visionLead->founder_identity ?? [] as $f)
                                <span class="dm-badge" style="margin:2px;">{{ $f }}</span>
                            @empty — @endforelse
                        </td>
                    </tr>
                    <tr>
                        <td style="color:var(--dm-text-muted);">Focus Areas</td>
                        <td>
                            @forelse($visionLead->focus_areas ?? [] as $f)
                                <span class="dm-badge" style="margin:2px;">{{ $f }}</span>
                            @empty — @endforelse
                        </td>
                    </tr>
                    <tr>
                        <td style="color:var(--dm-text-muted);">Personal Goals</td>
                        <td>
                            @forelse($visionLead->personal_goals ?? [] as $p)
                                <span class="dm-badge" style="margin:2px;">{{ $p }}</span>
                            @empty — @endforelse
                        </td>
                    </tr>
                    @if(!empty($visionLead->other_answers))
                    <tr>
                        <td style="color:var(--dm-text-muted);">Other Answers</td>
                        <td>
                            @foreach($visionLead->other_answers as $k => $v)
                                <div style="margin-bottom:4px;"><strong style="font-size:12px;">{{ ucfirst($k) }}:</strong> {{ $v }}</div>
                            @endforeach
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right column: AI blueprint -->
    <div class="col-lg-7">
        @if(!empty($ai))
        <div class="dm-table-wrap mb-4" style="padding:24px;">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="fa-solid fa-wand-magic-sparkles" style="color:var(--dm-purple);"></i>
                <h5 style="margin:0;font-weight:700;">AI-Generated Growth Blueprint</h5>
            </div>

            @if(!empty($ai['tagline']))
            <div style="font-family:'Cormorant Garant',serif;font-size:26px;font-weight:600;color:var(--dm-purple);margin-bottom:4px;">"{{ $ai['tagline'] }}"</div>
            @endif
            @if(!empty($ai['growthTheme']))
            <div style="font-size:12px;text-transform:uppercase;letter-spacing:0.1em;color:var(--dm-text-muted);margin-bottom:20px;">{{ $ai['growthTheme'] }}</div>
            @endif

            <div class="row g-3 mb-4">
                @if(!empty($ai['mission']))
                <div class="col-md-6">
                    <div style="background:var(--dm-dark);border-radius:8px;padding:16px;height:100%;">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:6px;">Mission</div>
                        <div style="font-size:14px;line-height:1.6;">{{ $ai['mission'] }}</div>
                    </div>
                </div>
                @endif
                @if(!empty($ai['vision']))
                <div class="col-md-6">
                    <div style="background:var(--dm-dark);border-radius:8px;padding:16px;height:100%;">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:6px;">Vision</div>
                        <div style="font-size:14px;line-height:1.6;">{{ $ai['vision'] }}</div>
                    </div>
                </div>
                @endif
            </div>

            @if(!empty($ai['executiveSummary']))
            <div style="margin-bottom:20px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">Executive Summary</div>
                <div style="font-size:14px;line-height:1.75;color:var(--dm-text);">{{ $ai['executiveSummary'] }}</div>
            </div>
            @endif

            @if(!empty($ai['values']))
            <div style="margin-bottom:20px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">Values</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($ai['values'] as $value)
                    <span class="dm-badge" style="background:var(--dm-purple-light);color:var(--dm-purple);">{{ $value }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($ai['topPriorities']))
            <div style="margin-bottom:20px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">Top Priorities</div>
                <ol style="padding-left:18px;margin:0;">
                    @foreach($ai['topPriorities'] as $priority)
                    <li style="margin-bottom:6px;font-size:14px;line-height:1.6;">{{ $priority }}</li>
                    @endforeach
                </ol>
            </div>
            @endif

            <div class="row g-3 mb-4">
                @if(!empty($ai['biggestOpportunity']))
                <div class="col-md-6">
                    <div style="border-left:3px solid #16a34a;padding-left:14px;">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:#16a34a;margin-bottom:4px;">Biggest Opportunity</div>
                        <div style="font-size:13px;line-height:1.6;">{{ $ai['biggestOpportunity'] }}</div>
                    </div>
                </div>
                @endif
                @if(!empty($ai['keyRisk']))
                <div class="col-md-6">
                    <div style="border-left:3px solid #dc2626;padding-left:14px;">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:#dc2626;margin-bottom:4px;">Key Risk</div>
                        <div style="font-size:13px;line-height:1.6;">{{ $ai['keyRisk'] }}</div>
                    </div>
                </div>
                @endif
            </div>

            @if(!empty($ai['actions30']))
            <div style="margin-bottom:20px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">30-Day Actions</div>
                <ul style="padding-left:18px;margin:0;">
                    @foreach($ai['actions30'] as $action)
                    <li style="margin-bottom:6px;font-size:14px;line-height:1.6;">{{ $action }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($ai['actions90']))
            <div style="margin-bottom:20px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">90-Day Actions</div>
                <ul style="padding-left:18px;margin:0;">
                    @foreach($ai['actions90'] as $action)
                    <li style="margin-bottom:6px;font-size:14px;line-height:1.6;">{{ $action }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row g-3 mb-4">
                @foreach(['y1milestones' => '1-Year Milestones', 'y3milestones' => '3-Year Milestones', 'y5milestones' => '5-Year Milestones'] as $key => $label)
                @if(!empty($ai[$key]))
                <div class="col-md-4">
                    <div style="background:var(--dm-dark);border-radius:8px;padding:14px;height:100%;">
                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">{{ $label }}</div>
                        <ul style="padding-left:16px;margin:0;font-size:13px;line-height:1.6;">
                            @foreach($ai[$key] as $m)
                            <li style="margin-bottom:4px;">{{ $m }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            @if(!empty($ai['kpis']))
            <div style="margin-bottom:20px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-text-muted);margin-bottom:8px;">KPIs</div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($ai['kpis'] as $kpi)
                    <span class="dm-badge">{{ $kpi }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($ai['founderAdvice']))
            <div style="margin-bottom:20px;background:var(--dm-purple-light);border-radius:8px;padding:16px;">
                <div style="font-size:11px;text-transform:uppercase;letter-spacing:0.08em;color:var(--dm-purple);margin-bottom:6px;">Founder Advice</div>
                <div style="font-size:14px;line-height:1.7;">"{{ $ai['founderAdvice'] }}"</div>
            </div>
            @endif

            @if(!empty($ai['quote']))
            <div style="border-left:3px solid var(--gold);padding-left:16px;font-style:italic;color:var(--slate);font-size:15px;line-height:1.7;">
                “{{ $ai['quote'] }}”
            </div>
            @endif
        </div>
        @else
        <div class="dm-table-wrap" style="padding:40px;text-align:center;color:var(--dm-text-muted);">
            <i class="fa-solid fa-robot" style="font-size:32px;display:block;margin-bottom:12px;"></i>
            No AI blueprint has been generated for this lead yet.
        </div>
        @endif
    </div>
</div>
@endsection
