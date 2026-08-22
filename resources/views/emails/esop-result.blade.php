@php
    $companyLabel = trim((string) $lead->company) !== '' ? trim($lead->company) : 'your business';
    // EsopResultMail hands employees to Content::with() wrapped in collect(),
    // but Mailable::buildViewData() applies the mailable's PUBLIC properties
    // *after* the with() data — so the raw `public array $employees` property
    // wins and this view actually receives a plain array. Wrapping in collect()
    // here is what makes the sort work whichever of the two arrives.
    $rankedEmployees = collect($employees)->sortBy(fn ($e) => $e->rank ?: 999999)->values();
    $overall = $aiContent['overall'] ?? [];
    $empNotes = $aiContent['employees'] ?? [];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your ESOP Allocation Report</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f9;padding:40px 20px;">
  <tr>
    <td align="center">
      <table width="640" cellpadding="0" cellspacing="0" border="0" style="max-width:640px;width:100%;">

        {{-- Header --}}
        <tr>
          <td style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
            <img src="{{ asset('favicon.png') }}" alt="Dev Mantra" width="56" height="56" style="border-radius:50%;display:block;margin:0 auto 16px;border:3px solid rgba(255,255,255,0.25);">
            <p style="margin:0;font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.65);">Dev Mantra &middot; ESOP Advisory</p>
            <h1 style="margin:8px 0 0;font-size:24px;font-weight:600;color:#ffffff;letter-spacing:-0.3px;">Your ESOP Allocation Report</h1>
            <p style="margin:12px 0 0;font-size:15px;color:rgba(255,255,255,0.85);">{{ $companyLabel }}</p>
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="background:#ffffff;padding:40px;">

            <p style="margin:0 0 20px;font-size:16px;color:#1a1a2e;font-weight:500;">Hi {{ $lead->name }},</p>

            <p style="margin:0 0 24px;font-size:15px;color:#555;line-height:1.7;">
                Thank you for using the ESOP Allocation Calculator{{ $lead->company ? ' for '.$lead->company : '' }}.
                Below is the recommended equity allocation for the {{ count($employees) }} employee{{ count($employees) === 1 ? '' : 's' }} you scored, calculated using the same pool-splitting logic as Dev Mantra's ESOP Allocation Model — a defensible, board-ready figure for each person, not a guess.
            </p>

            @if(!empty($reportUrl))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
              <tr>
                <td align="center" style="padding:22px 20px;background:linear-gradient(135deg,#0a1c3a,#1b3c6b);border-radius:12px;">
                  <p style="margin:0 0 4px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.6);">Full interactive dashboard</p>
                  <p style="margin:0 0 16px;font-size:14px;color:rgba(255,255,255,0.85);">Charts, department &amp; seniority breakdowns, and per-employee notes — saved to a private link you can revisit anytime.</p>
                  <a href="{{ $reportUrl }}" style="display:inline-block;padding:13px 28px;background:linear-gradient(135deg,#d9a441,#b9832f);color:#241a04;text-decoration:none;border-radius:8px;font-size:14px;font-weight:700;">
                    View Full Report &rarr;
                  </a>
                </td>
              </tr>
            </table>
            @endif

            {{-- Pool summary strip --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border:1px solid #e8ecf0;border-radius:10px;margin-bottom:28px;">
              <tr>
                <td style="padding:22px 24px;">
                  <p style="margin:0 0 14px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Your Pool Setup</p>
                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td width="50%" style="padding:0 8px 12px 0;">
                        <p style="margin:0;font-size:11px;color:#8a9bb0;text-transform:uppercase;letter-spacing:0.5px;">Total ESOP Pool</p>
                        <p style="margin:2px 0 0;font-size:19px;font-weight:700;color:#1a1a2e;">{{ number_format($pool['esop_pool_percent'], 2) }}%</p>
                      </td>
                      <td width="50%" style="padding:0 0 12px 8px;">
                        <p style="margin:0;font-size:11px;color:#8a9bb0;text-transform:uppercase;letter-spacing:0.5px;">Hiring Reserve</p>
                        <p style="margin:2px 0 0;font-size:19px;font-weight:700;color:#1a1a2e;">{{ number_format($pool['hiring_reserve_percent'], 2) }}%</p>
                      </td>
                    </tr>
                    <tr>
                      <td width="50%" style="padding:0 8px 0 0;">
                        <p style="margin:0;font-size:11px;color:#8a9bb0;text-transform:uppercase;letter-spacing:0.5px;">Allocatable Pool</p>
                        <p style="margin:2px 0 0;font-size:19px;font-weight:700;color:#1a1a2e;">{{ number_format($pool['allocatable_pool_percent'], 2) }}%</p>
                      </td>
                      <td width="50%" style="padding:0 0 0 8px;">
                        <p style="margin:0;font-size:11px;color:#8a9bb0;text-transform:uppercase;letter-spacing:0.5px;">Total Recommended</p>
                        <p style="margin:2px 0 0;font-size:19px;font-weight:700;color:#1e9e5a;">{{ number_format($pool['total_allocated_percent'], 4) }}%</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>

            {{-- Employee allocation table --}}
            <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Recommended Allocation By Employee</p>
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;margin-bottom:28px;">
              <tr style="background:#f8fafc;">
                <td style="padding:10px 12px;border-bottom:2px solid #e8ecf0;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#8a9bb0;">Rank</td>
                <td style="padding:10px 12px;border-bottom:2px solid #e8ecf0;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#8a9bb0;">Employee</td>
                <td style="padding:10px 12px;border-bottom:2px solid #e8ecf0;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#8a9bb0;">Score</td>
                <td style="padding:10px 12px;border-bottom:2px solid #e8ecf0;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#8a9bb0;" align="right">Grant</td>
              </tr>
              @foreach($rankedEmployees as $e)
              @php($r = $calc[$e->id] ?? [])
              <tr>
                <td style="padding:12px;border-bottom:1px solid #f1f5f9;vertical-align:top;">
                  <span style="display:inline-block;width:24px;height:24px;line-height:24px;text-align:center;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;border-radius:50%;font-size:12px;font-weight:600;">{{ $e->rank ?: '—' }}</span>
                </td>
                <td style="padding:12px;border-bottom:1px solid #f1f5f9;vertical-align:top;">
                  <p style="margin:0;font-size:14px;font-weight:600;color:#1a1a2e;">{{ $e->emp_name ?: '—' }}</p>
                  <p style="margin:2px 0 0;font-size:12px;color:#8a9bb0;">{{ $e->emp_designation ?: '—' }} &middot; {{ $e->emp_seniority }}</p>
                </td>
                <td style="padding:12px;border-bottom:1px solid #f1f5f9;font-size:13px;color:#444;vertical-align:top;">{{ $e->total_score }}/100</td>
                <td style="padding:12px;border-bottom:1px solid #f1f5f9;font-size:15px;font-weight:700;color:#1e9e5a;vertical-align:top;" align="right">{{ number_format($r['final_grant_percent'] ?? 0, 4) }}%</td>
              </tr>
              @endforeach
            </table>

            {{-- Summary --}}
            @if(!empty($overall['summary']))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
              <tr>
                <td style="padding:18px 22px;background:#f8fafc;border:1px solid #e8ecf0;border-radius:10px;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Summary</p>
                  <p style="margin:0;font-size:14px;color:#333;line-height:1.7;">{{ $overall['summary'] }}</p>
                </td>
              </tr>
            </table>
            @endif

            {{-- Risk flag --}}
            @if(!empty($overall['risk_flag']))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
              <tr>
                <td style="padding:16px 20px;background:{{ ($pool['tier_pool_is_over_committed'] ?? false) ? '#fdf3f2' : '#effaf3' }};border:1px solid {{ ($pool['tier_pool_is_over_committed'] ?? false) ? '#f5dcd9' : '#d6f0e0' }};border-radius:10px;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:{{ ($pool['tier_pool_is_over_committed'] ?? false) ? '#d15a4a' : '#1e9e5a' }};">Risk Flag</p>
                  <p style="margin:0;font-size:14px;color:{{ ($pool['tier_pool_is_over_committed'] ?? false) ? '#5a332e' : '#2b4a38' }};line-height:1.65;">{{ $overall['risk_flag'] }}</p>
                </td>
              </tr>
            </table>
            @endif

            {{-- Vesting suggestion --}}
            @if(!empty($overall['vesting_suggestion']))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
              <tr>
                <td style="padding:16px 20px;background:#eef3fb;border:1px solid #dce6f5;border-radius:10px;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#1b3c6b;">Vesting Suggestion</p>
                  <p style="margin:0;font-size:14px;color:#243044;line-height:1.65;">{{ $overall['vesting_suggestion'] }}</p>
                </td>
              </tr>
            </table>
            @endif

            {{-- Next steps --}}
            @if(!empty($overall['next_steps']))
            <div style="margin-bottom:28px;">
              <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Next Steps</p>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                @foreach($overall['next_steps'] as $i => $step)
                <tr>
                  <td width="34" valign="top" style="padding:6px 0;">
                    <span style="display:inline-block;width:24px;height:24px;line-height:24px;text-align:center;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;border-radius:50%;font-size:12px;font-weight:600;">{{ $i + 1 }}</span>
                  </td>
                  <td valign="top" style="padding:6px 0;font-size:14px;color:#333;line-height:1.6;">{{ $step }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            @endif

            {{-- Per-employee notes --}}
            @if(count($empNotes))
            <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Notes By Employee</p>
            @foreach($rankedEmployees as $e)
            @php($note = $empNotes[$e->id] ?? null)
            @if($note)
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:12px;">
              <tr>
                <td style="padding:14px 18px;background:#fbf8ef;border-left:4px solid #d9a441;border-radius:0 10px 10px 0;">
                  <p style="margin:0 0 4px;font-size:13px;font-weight:700;color:#1b3c6b;">{{ $e->emp_name ?: 'Employee' }}</p>
                  @if(!empty($note['rationale']))
                  <p style="margin:0 0 6px;font-size:13px;color:#4a3f28;line-height:1.6;">{{ $note['rationale'] }}</p>
                  @endif
                  @if(!empty($note['retention_note']))
                  <p style="margin:0;font-size:12.5px;color:#6b5a35;line-height:1.6;font-style:italic;">{{ $note['retention_note'] }}</p>
                  @endif
                </td>
              </tr>
            </table>
            @endif
            @endforeach
            @endif

            {{-- CTA --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:8px;">
              <tr>
                <td align="center">
                  <a href="{{ route('esop-calculator.app') }}" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#ffffff;text-decoration:none;border-radius:8px;font-size:15px;font-weight:600;letter-spacing:0.2px;">
                    Score Another Employee
                  </a>
                </td>
              </tr>
            </table>

            <p style="margin:28px 0 0;font-size:13px;color:#94a3b8;font-style:italic;line-height:1.7;">
                This is an indicative recommendation generated from the inputs you provided, following the same pool-splitting logic as Dev Mantra's ESOP Allocation Model. It is not legal, tax or compliance advice — please confirm the final allocation with your cap table administrator, legal counsel and ESOP trustee before communicating any figure to an employee.
            </p>

            <p style="margin:20px 0 0;font-size:14px;color:#666;line-height:1.7;">
                Want a second opinion on your ESOP structure? Reply to this email or reach us at
                <a href="mailto:info@devmantra.com" style="color:#4a73c4;text-decoration:none;font-weight:500;">info@devmantra.com</a> — we would be glad to help you get there.
            </p>

          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td style="background:#f8fafc;border-top:1px solid #e8ecf0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
            <p style="margin:0 0 8px;font-size:13px;color:#aab4be;line-height:1.6;">
              Dev Mantra &nbsp;|&nbsp; <a href="https://devmantra.com" style="color:#4a73c4;text-decoration:none;">devmantra.com</a>
            </p>
            <p style="margin:0;font-size:12px;color:#c5cdd6;">
              You are receiving this email because you generated an ESOP Allocation Report on our website.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
