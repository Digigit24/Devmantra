@php
    // Safe accessors — the blueprint comes straight from the AI/template payload.
    $g = function ($k, $d = '') use ($blueprint) {
        return (isset($blueprint[$k]) && $blueprint[$k] !== null && $blueprint[$k] !== '') ? $blueprint[$k] : $d;
    };
    $arr = function ($k) use ($blueprint) {
        return array_values(array_filter((array) ($blueprint[$k] ?? []), function ($v) {
            return trim((string) $v) !== '';
        }));
    };
    $companyLabel = trim($company) !== '' ? trim($company) : 'your business';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Growth Blueprint</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f9;padding:40px 20px;">
  <tr>
    <td align="center">
      <table width="640" cellpadding="0" cellspacing="0" border="0" style="max-width:640px;width:100%;">

        {{-- Header --}}
        <tr>
          <td style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
            <img src="{{ asset('favicon.png') }}" alt="DevMantra" width="56" height="56" style="border-radius:50%;display:block;margin:0 auto 16px;border:3px solid rgba(255,255,255,0.25);">
            <p style="margin:0;font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.65);">DevMantra · Growth Blueprint</p>
            <h1 style="margin:8px 0 0;font-size:24px;font-weight:600;color:#ffffff;letter-spacing:-0.3px;">{{ $company ?: 'Your Strategic Vision' }}</h1>
            @if($g('tagline'))
              <p style="margin:12px 0 0;font-size:15px;color:rgba(255,255,255,0.85);font-style:italic;">“{{ $g('tagline') }}”</p>
            @endif
            @if($g('growthTheme'))
              <p style="margin:16px auto 0;display:inline-block;padding:6px 16px;background:rgba(255,255,255,0.15);border-radius:20px;font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:#ffffff;">{{ $g('growthTheme') }}</p>
            @endif
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="background:#ffffff;padding:40px;">

            <p style="margin:0 0 20px;font-size:16px;color:#1a1a2e;font-weight:500;">Hi {{ $name ?: 'Founder' }},</p>

            <p style="margin:0 0 32px;font-size:15px;color:#555;line-height:1.7;">
              Congratulations on completing your Growth Blueprint. Below is the strategic vision we crafted for
              <strong style="color:#1a1a2e;">{{ $companyLabel }}</strong> — your mission, priorities and a clear roadmap for the next five years. Keep this handy; it is written to be revisited.
            </p>

            @if($g('executiveSummary'))
            {{-- Executive Summary --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border:1px solid #e8ecf0;border-radius:10px;margin-bottom:28px;">
              <tr>
                <td style="padding:22px 24px;">
                  <p style="margin:0 0 8px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Executive Summary</p>
                  <p style="margin:0;font-size:15px;color:#333;line-height:1.75;">{{ $g('executiveSummary') }}</p>
                </td>
              </tr>
            </table>
            @endif

            {{-- Mission & Vision --}}
            @if($g('mission') || $g('vision'))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
              @if($g('mission'))
              <tr>
                <td style="padding:0 0 16px;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#4a73c4;">Mission</p>
                  <p style="margin:0;font-size:16px;color:#1a1a2e;line-height:1.6;font-weight:500;">{{ $g('mission') }}</p>
                </td>
              </tr>
              @endif
              @if($g('vision'))
              <tr>
                <td style="padding:0;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#4a73c4;">Vision</p>
                  <p style="margin:0;font-size:16px;color:#1a1a2e;line-height:1.6;font-weight:500;">{{ $g('vision') }}</p>
                </td>
              </tr>
              @endif
            </table>
            @endif

            {{-- Core Values --}}
            @if(count($arr('values')))
            <div style="margin-bottom:28px;">
              <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Core Values</p>
              @foreach($arr('values') as $val)
                <span style="display:inline-block;margin:0 8px 8px 0;padding:8px 16px;background:#eef3fb;border:1px solid #dce6f5;border-radius:8px;font-size:14px;color:#1b3c6b;font-weight:500;">{{ $val }}</span>
              @endforeach
            </div>
            @endif

            {{-- Top Priorities --}}
            @if(count($arr('topPriorities')))
            <div style="margin-bottom:28px;">
              <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Top Priorities</p>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
                @foreach($arr('topPriorities') as $i => $p)
                <tr>
                  <td width="34" valign="top" style="padding:6px 0;">
                    <span style="display:inline-block;width:24px;height:24px;line-height:24px;text-align:center;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;border-radius:50%;font-size:12px;font-weight:600;">{{ $i + 1 }}</span>
                  </td>
                  <td valign="top" style="padding:6px 0;font-size:15px;color:#333;line-height:1.6;">{{ $p }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            @endif

            {{-- Opportunity & Risk --}}
            @if($g('biggestOpportunity') || $g('keyRisk'))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
              @if($g('biggestOpportunity'))
              <tr>
                <td style="padding:16px 20px;background:#effaf3;border:1px solid #d6f0e0;border-radius:10px;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#1e9e5a;">Biggest Opportunity</p>
                  <p style="margin:0;font-size:14px;color:#2b4a38;line-height:1.65;">{{ $g('biggestOpportunity') }}</p>
                </td>
              </tr>
              <tr><td style="height:12px;line-height:12px;font-size:0;">&nbsp;</td></tr>
              @endif
              @if($g('keyRisk'))
              <tr>
                <td style="padding:16px 20px;background:#fdf3f2;border:1px solid #f5dcd9;border-radius:10px;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#d15a4a;">Key Risk to Manage</p>
                  <p style="margin:0;font-size:14px;color:#5a332e;line-height:1.65;">{{ $g('keyRisk') }}</p>
                </td>
              </tr>
              @endif
            </table>
            @endif

            {{-- Action plan --}}
            @if(count($arr('actions30')) || count($arr('actions90')))
            <div style="margin-bottom:8px;">
              <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Your Action Plan</p>
            </div>
            @if(count($arr('actions30')))
            <p style="margin:0 0 8px;font-size:14px;color:#1b3c6b;font-weight:600;">First 30 Days</p>
            <ul style="margin:0 0 20px;padding:0 0 0 20px;">
              @foreach($arr('actions30') as $a)
                <li style="margin:0 0 8px;font-size:14px;color:#444;line-height:1.6;">{{ $a }}</li>
              @endforeach
            </ul>
            @endif
            @if(count($arr('actions90')))
            <p style="margin:0 0 8px;font-size:14px;color:#1b3c6b;font-weight:600;">Next 90 Days</p>
            <ul style="margin:0 0 28px;padding:0 0 0 20px;">
              @foreach($arr('actions90') as $a)
                <li style="margin:0 0 8px;font-size:14px;color:#444;line-height:1.6;">{{ $a }}</li>
              @endforeach
            </ul>
            @endif
            @endif

            {{-- Milestones --}}
            @if(count($arr('y1milestones')) || count($arr('y3milestones')) || count($arr('y5milestones')))
            <div style="margin-bottom:8px;">
              <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Milestones</p>
            </div>
            @php
              $milestoneGroups = [
                ['1-Year', $arr('y1milestones')],
                ['3-Year', $arr('y3milestones')],
                ['5-Year', $arr('y5milestones')],
              ];
            @endphp
            @foreach($milestoneGroups as $group)
              @if(count($group[1]))
              <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border:1px solid #e8ecf0;border-radius:10px;margin-bottom:12px;">
                <tr>
                  <td style="padding:16px 20px;">
                    <p style="margin:0 0 8px;font-size:13px;font-weight:700;color:#1b3c6b;">{{ $group[0] }}</p>
                    <ul style="margin:0;padding:0 0 0 18px;">
                      @foreach($group[1] as $m)
                        <li style="margin:0 0 6px;font-size:14px;color:#444;line-height:1.6;">{{ $m }}</li>
                      @endforeach
                    </ul>
                  </td>
                </tr>
              </table>
              @endif
            @endforeach
            <div style="height:16px;line-height:16px;font-size:0;">&nbsp;</div>
            @endif

            {{-- KPIs --}}
            @if(count($arr('kpis')))
            <div style="margin-bottom:28px;">
              <p style="margin:0 0 12px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Metrics to Track</p>
              @foreach($arr('kpis') as $kpi)
                <span style="display:inline-block;margin:0 8px 8px 0;padding:7px 14px;background:#f4f6f9;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;color:#41506b;font-weight:500;">{{ $kpi }}</span>
              @endforeach
            </div>
            @endif

            {{-- Founder advice --}}
            @if($g('founderAdvice'))
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:28px;">
              <tr>
                <td style="padding:20px 24px;background:#fbf8ef;border-left:4px solid #d9a441;border-radius:0 10px 10px 0;">
                  <p style="margin:0 0 6px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#b8862d;">A Word of Counsel</p>
                  <p style="margin:0;font-size:15px;color:#4a3f28;line-height:1.7;">{{ $g('founderAdvice') }}</p>
                </td>
              </tr>
            </table>
            @endif

            {{-- Quote --}}
            @if($g('quote'))
            <p style="margin:0 0 32px;padding:0 12px;font-size:17px;color:#1b3c6b;line-height:1.6;text-align:center;font-style:italic;font-weight:500;">“{{ $g('quote') }}”</p>
            @endif

            {{-- CTA --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center">
                  <a href="https://devmantra.com/vision-card" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#ffffff;text-decoration:none;border-radius:8px;font-size:15px;font-weight:600;letter-spacing:0.2px;">
                    View Your Vision Board
                  </a>
                </td>
              </tr>
            </table>

            <p style="margin:28px 0 0;font-size:14px;color:#666;line-height:1.7;">
              Want to turn this blueprint into action? Reply to this email or reach us at
              <a href="mailto:info@devmantra.com" style="color:#4a73c4;text-decoration:none;font-weight:500;">info@devmantra.com</a> — we would be glad to help you get there.
            </p>

          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td style="background:#f8fafc;border-top:1px solid #e8ecf0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
            <p style="margin:0 0 8px;font-size:13px;color:#aab4be;line-height:1.6;">
              DevMantra &nbsp;|&nbsp; <a href="https://devmantra.com" style="color:#4a73c4;text-decoration:none;">devmantra.com</a>
            </p>
            <p style="margin:0;font-size:12px;color:#c5cdd6;">
              You are receiving this email because you generated a Growth Blueprint on our website.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
