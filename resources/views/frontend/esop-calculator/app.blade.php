<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>ESOP Allocation Calculator — Dev Mantra</title>
<meta name="description" content="Score every employee you are considering for equity and get a data-driven, defensible ESOP pool split in minutes — built on Dev Mantra's ESOP Allocation Model.">
<meta name="robots" content="noindex, follow">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/esop-calculator/css/dashboard.css') }}">
<style>
*,*::before,*::after{box-sizing:border-box}
body{margin:0;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif}

.esop-app{background:#ffffff;min-height:100vh;padding-top:76px}

.esop-topbar{position:fixed;top:0;left:0;right:0;z-index:20;background:#ffffff;border-bottom:1px solid #e2e8f0;padding:0.85rem 1.5rem;display:flex;align-items:center;gap:1.25rem}
.esop-topbar-logo{display:flex;align-items:center;flex-shrink:0}
.esop-topbar-logo img{width:118px;height:auto;border-radius:50px;display:block}
.esop-topbar-track{flex:1;height:6px;background:#e2e8f0;border-radius:3px;overflow:hidden}
.esop-topbar-fill{position:relative;height:100%;background:linear-gradient(90deg,#1b3c6b,#4a73c4);width:2%;transition:width .5s cubic-bezier(.22,1,.36,1);overflow:hidden}
.esop-topbar-fill::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.45),transparent);animation:esopShimmer 1.8s ease-in-out infinite}
@keyframes esopShimmer{0%{transform:translateX(-100%)}100%{transform:translateX(100%)}}
@media(prefers-reduced-motion:reduce){.esop-topbar-fill::after{animation:none}}
.esop-topbar-label{font-size:0.72rem;font-weight:700;color:#64748b;white-space:nowrap;letter-spacing:0.03em;flex-shrink:0}

.esop-app{position:relative;overflow:hidden}
.esop-app::before,.esop-app::after{content:'';position:fixed;z-index:0;border-radius:50%;filter:blur(70px);opacity:0.15;pointer-events:none}
.esop-app::before{width:360px;height:360px;background:#4a73c4;top:-140px;right:-100px}
.esop-app::after{width:280px;height:280px;background:#1b3c6b;bottom:-120px;left:-90px;opacity:0.1}
@media(prefers-reduced-motion:reduce){.esop-app::before,.esop-app::after{display:none}}

.esop-stage{position:relative;z-index:1;max-width:640px;margin:0 auto;padding:3rem 1.5rem 4rem;min-height:calc(100vh - 76px);display:flex;flex-direction:column;justify-content:center;transition:max-width .3s ease}
.esop-stage.is-results{max-width:1400px;justify-content:flex-start;padding:2rem 1.75rem 4rem}
@media(max-width:1000px){.esop-stage.is-results{padding:1.5rem 1rem 3rem}}
.esop-screen{display:none;animation:esopFade .45s cubic-bezier(.22,1,.36,1) both}
.esop-screen.active{display:block}
@keyframes esopFade{from{opacity:0;transform:translateY(14px) scale(.988)}to{opacity:1;transform:translateY(0) scale(1)}}
@media(prefers-reduced-motion:reduce){.esop-screen{animation:none}}

/* Staggered entrance for repeated elements — these are fresh DOM nodes on
   every screen render (calculator.js rebuilds #esopStage via innerHTML), so
   a plain CSS @keyframes animation auto-plays each time without any JS. */
.esop-option,.esop-choice-btn{animation:esopItemIn .4s cubic-bezier(.22,1,.36,1) both}
.esop-options .esop-option:nth-child(1){animation-delay:.03s}
.esop-options .esop-option:nth-child(2){animation-delay:.07s}
.esop-options .esop-option:nth-child(3){animation-delay:.11s}
.esop-options .esop-option:nth-child(4){animation-delay:.15s}
.esop-options .esop-option:nth-child(5){animation-delay:.19s}
.esop-options .esop-option:nth-child(6){animation-delay:.23s}
@keyframes esopItemIn{from{opacity:0;transform:translateX(-10px)}to{opacity:1;transform:translateX(0)}}
@media(prefers-reduced-motion:reduce){.esop-option,.esop-choice-btn{animation:none}}

.esop-eyebrow{font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#4a73c4;margin-bottom:0.6rem}
.esop-q-title{font-size:clamp(1.25rem,3vw,1.7rem);font-weight:800;color:#0f172a;letter-spacing:-0.01em;margin:0 0 0.6rem;line-height:1.3}
.esop-q-sub{font-size:0.92rem;color:#64748b;margin:0 0 1.6rem;line-height:1.6}
.esop-q-hint{font-size:0.8rem;color:#1e4d8f;background:#eff6ff;border:1px solid #dbeafe;border-radius:8px;padding:0.65rem 0.9rem;margin-bottom:1.4rem;display:none;line-height:1.6}
.esop-q-hint.show{display:block}

.esop-field{margin-bottom:1.1rem}
.esop-input,.esop-select{width:100%;padding:0.85rem 1rem;border:1.5px solid #e2e8f0;border-radius:9px;font-size:1.05rem;font-family:inherit;color:#0f172a;background:#f8fafc;outline:none;transition:border-color .18s,background .18s,box-shadow .18s ease}
.esop-input::placeholder{color:#94a3b8}
.esop-input:focus,.esop-select:focus{border-color:#4a73c4;background:#fff;box-shadow:0 0 0 3px rgba(74,115,196,0.12)}
.esop-select option{background:#fff;color:#0f172a}
.esop-field-label{display:block;font-size:0.78rem;font-weight:700;color:#64748b;margin-bottom:0.4rem;text-transform:uppercase;letter-spacing:0.04em}
.esop-field-hint{font-size:0.75rem;color:#94a3b8;margin-top:0.35rem;line-height:1.5}
.esop-row2{display:grid;grid-template-columns:1fr 1fr;gap:0.9rem}
@media(max-width:560px){.esop-row2{grid-template-columns:1fr}}

.esop-options{display:flex;flex-direction:column;gap:0.6rem;margin-bottom:1.4rem}
.esop-option{display:flex;align-items:flex-start;gap:0.75rem;padding:0.85rem 1rem;border:1.5px solid #e2e8f0;border-radius:10px;cursor:pointer;transition:border-color .18s,background .18s,transform .18s cubic-bezier(.22,1,.36,1),box-shadow .18s ease;background:#fff}
.esop-option:hover{border-color:#a8c1ea;background:#f5f8fd;transform:translateX(3px)}
.esop-option.selected{border-color:#4a73c4;background:#eff6ff;transform:translateX(3px);box-shadow:0 6px 18px rgba(74,115,196,0.14)}
.esop-option-badge{flex-shrink:0;width:26px;height:26px;border-radius:50%;background:#f1f5f9;color:#64748b;font-size:0.72rem;font-weight:700;display:flex;align-items:center;justify-content:center;margin-top:0.05rem;transition:background .18s,color .18s,transform .25s cubic-bezier(.34,1.56,.64,1)}
.esop-option.selected .esop-option-badge{background:#4a73c4;color:#fff;transform:scale(1.12)}
.esop-option-text{font-size:0.9rem;color:#334155;line-height:1.55}

.esop-choice-row{display:flex;gap:0.75rem;margin-bottom:1.4rem;flex-wrap:wrap}
.esop-choice-btn{flex:1;min-width:140px;padding:0.9rem;border-radius:10px;border:1.5px solid #e2e8f0;background:#fff;color:#0f172a;font-weight:700;font-size:0.95rem;cursor:pointer;transition:border-color .18s,background .18s,transform .18s ease;font-family:inherit}
.esop-choice-btn:hover{transform:translateY(-2px)}
.esop-choice-btn:hover,.esop-choice-btn.selected{border-color:#4a73c4;background:#eff6ff}

.esop-nav{display:flex;align-items:center;justify-content:space-between;gap:1rem;margin-top:0.5rem}
.esop-btn{display:inline-flex;align-items:center;gap:0.5rem;padding:0.8rem 1.7rem;border-radius:9px;font-size:0.92rem;font-weight:700;cursor:pointer;border:none;font-family:inherit;transition:opacity .18s,transform .18s cubic-bezier(.22,1,.36,1),box-shadow .18s ease}
.esop-btn:active{transform:scale(0.98)}
.esop-btn-primary{background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff;box-shadow:0 6px 16px rgba(27,60,107,0.18)}
.esop-btn-primary:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 10px 24px rgba(27,60,107,0.26)}
.esop-btn-primary:disabled{opacity:0.4;cursor:not-allowed}
.esop-btn-ghost{background:transparent;color:#94a3b8;padding:0.8rem 0.5rem}
.esop-btn-ghost:hover{color:#0f172a;transform:translateX(-2px)}

.esop-error-banner{display:none;background:#fef2f2;border:1px solid #fecaca;color:#b91c1c;font-size:0.85rem;border-radius:9px;padding:0.75rem 1rem;margin-bottom:1.2rem}
.esop-error-banner.show{display:block;animation:esopShake .4s cubic-bezier(.36,.07,.19,.97) both}
@keyframes esopShake{10%,90%{transform:translateX(-1px)}20%,80%{transform:translateX(2px)}30%,50%,70%{transform:translateX(-4px)}40%,60%{transform:translateX(4px)}}
@media(prefers-reduced-motion:reduce){.esop-error-banner.show{animation:none}}

/* Loading */
.esop-loading{text-align:center;padding:2rem 0}
.esop-spinner{width:44px;height:44px;border-radius:50%;border:3px solid #e2e8f0;border-top-color:#4a73c4;margin:0 auto 1.2rem;animation:esopSpin .8s linear infinite}
@keyframes esopSpin{to{transform:rotate(360deg)}}

/* Results — the full-width dashboard design system lives in
   assets/esop-calculator/css/dashboard.css (shared with the standalone
   shareable report page). renderResults() in calculator.js renders into
   a .esop-dashboard wrapper that opts out of the narrow wizard column via
   .esop-stage.is-results above. */
</style>

{{-- ══════════════════════════════════════════════
     Meta (Facebook) Pixel — /esop-calculator/app ONLY
     Loaded here (not in layouts/frontend.blade.php)
     so the pixel fires only on the ESOP Calculator
     funnel. Fires a standard PageView on load. Same
     pixel ID and setup as the /vision-card funnel.
══════════════════════════════════════════════ --}}
<script>
window.META_PIXEL_ID = '{{ config('services.meta.pixel_id') }}';
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', window.META_PIXEL_ID);
fbq('track', 'PageView');
</script>
{{-- ─────────── End Meta Pixel ───────────
     NOTE: the actual conversion (form submission) is tracked from
     assets/esop-calculator/js/calculator.js as a CompleteRegistration
     event, fired only after the backend confirms the lead + report were
     saved. A matching server-side Conversions API call is fired from
     EsopCalculatorController@submit using the same event_id, so Meta
     de-dupes the browser + server events instead of double counting. --}}
</head>
<body>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ config('services.meta.pixel_id') }}&ev=PageView&noscript=1"/></noscript>

<div class="esop-app">
    <div class="esop-topbar">
        <a href="{{ route('esop-calculator.index') }}" class="esop-topbar-logo">
            <img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra">
        </a>
        <div class="esop-topbar-track"><div class="esop-topbar-fill" id="esopTopFill"></div></div>
        <div class="esop-topbar-label" id="esopTopLabel">Getting started</div>
    </div>

    <div class="esop-stage" id="esopStage">
        {{-- All screens are rendered client-side into #esopStage by calculator.js --}}
        <div class="esop-loading">
            <div class="esop-spinner"></div>
            <p style="color:#94a3b8;font-size:0.85rem;">Loading the calculator…</p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
<script src="{{ asset('assets/esop-calculator/js/dashboard.js') }}"></script>
<script>
window.ESOP_DATA = {
    params: @json($params),
    departments: @json($departments),
    seniorityLevels: @json($seniorityLevels),
    companyStages: @json($companyStages),
    deptHints: @json(collect($departments)->mapWithKeys(fn($d) => [$d => \App\Services\EsopQuestionBank::deptHint($d)])),
    submitUrl: "{{ route('esop-calculator.submit') }}",
    homeUrl: "{{ route('esop-calculator.index') }}",
    csrfToken: "{{ csrf_token() }}",
    heroImageUrl: "{{ asset('assets/esop-calculator/img/hero-banner.jpg') }}",
};
</script>
@php
    // production.md: the live server runs Laravel from /home2/devmasjc/devmantra
    // while the actual web-served directory is the separate /home2/devmasjc/public_html
    // — so public_path() does NOT point at the real asset folder in production
    // (same reason config/filesystems.php hardcodes the 'links' target below).
    // Resolve the real on-disk public folder the same way before touching
    // filemtime(), and fall back to time() if the file still isn't found so a
    // missing/renamed asset can never crash this page again.
    $esopCalcJsRoot = app()->environment('local')
        ? public_path()
        : '/home2/devmasjc/public_html';
    $esopCalcJsPath = $esopCalcJsRoot.'/assets/esop-calculator/js/calculator.js';
    $esopCalcJsVer = is_file($esopCalcJsPath) ? filemtime($esopCalcJsPath) : time();
@endphp
<script src="{{ asset('assets/esop-calculator/js/calculator.js') }}?v={{ $esopCalcJsVer }}"></script>
</body>
</html>
