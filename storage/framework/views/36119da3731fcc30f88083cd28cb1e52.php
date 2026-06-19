<?php $__env->startSection('title', 'India vs Europe Manufacturing Cost Calculator — DevMantra'); ?>
<?php $__env->startSection('meta_description', 'Compare India vs Europe manufacturing costs with real-time freight, duty and FX rates. Landed cost analysis with 2025-26 benchmark data.'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.cc-page,.cc-page *,.cc-page *::before,.cc-page *::after{box-sizing:border-box}

/* ── Hero ─────────────────────────────────────────────────────────────────*/
.cc-hero{background:var(--dm-brand-gradient,linear-gradient(135deg,#1b3c6b,#4a73c4));padding:140px 0 0;overflow:hidden}
.cc-hero-inner{max-width:1100px;margin:0 auto;padding:0 1.25rem 1.75rem;display:flex;justify-content:space-between;align-items:flex-end;gap:1rem;flex-wrap:wrap}
.cc-hero-left{display:flex;align-items:center;gap:0.875rem;min-width:0;flex:1}
.cc-hero-eyebrow{font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.5);margin-bottom:0.15rem;font-family:var(--tp-ff-onest,inherit)}
.cc-hero-title{font-size:clamp(1rem,2.5vw,1.55rem);font-weight:700;color:#fff;letter-spacing:-0.02em;line-height:1.2;font-family:var(--tp-ff-onest,inherit);margin:0}
.cc-hero-sub{font-size:0.72rem;color:rgba(255,255,255,0.55);margin-top:0.2rem;font-family:var(--tp-ff-onest,inherit)}
.cc-hero-actions{display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;flex-shrink:0}
.cc-api-pill{display:flex;align-items:center;gap:0.4rem;font-size:0.7rem;padding:0.28rem 0.65rem;background:rgba(255,255,255,0.12);border-radius:100px;color:rgba(255,255,255,0.85);font-family:var(--tp-ff-onest,inherit);white-space:nowrap}
.cc-api-pill .dot{width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,0.3);flex-shrink:0}
.cc-api-pill.online .dot{background:#34d399;box-shadow:0 0 5px #34d399}
.cc-api-pill.offline .dot{background:#f87171}
.cc-api-pill.loading .dot{background:#fbbf24;animation:cc-pulse 1.5s infinite}
@keyframes cc-pulse{0%,100%{opacity:1}50%{opacity:0.2}}

/* FX fallback warning banner */
.cc-fallback-banner{display:none;background:#fef3c7;border:1px solid #f59e0b;border-radius:0;padding:0.55rem 1.25rem;font-size:0.78rem;font-weight:600;color:#92400e;align-items:center;gap:0.5rem}
.cc-fallback-banner.visible{display:flex}
.cc-fallback-banner i{color:#d97706;flex-shrink:0}

@media(max-width:600px){.cc-hero{padding-top:115px}.cc-hero-inner{flex-direction:column;align-items:flex-start}.cc-hero-actions{width:100%}}

/* ── Wizard bg ────────────────────────────────────────────────────────────*/
.cc-wizard-bg{background:#f1f5f9;min-height:60vh;overflow-x:hidden;padding-bottom:4rem}
.cc-wiz-outer{width:100%;max-width:740px;margin:0 auto;padding:2rem 1.25rem 0;transition:max-width 0.35s ease}
.cc-wiz-outer.is-results{max-width:1160px}
@media(max-width:600px){.cc-wiz-outer{padding:1.25rem 0.875rem 0}}

/* ── Stepper ──────────────────────────────────────────────────────────────*/
.cc-stepper{display:flex;align-items:center;margin-bottom:1.5rem;padding:0 0.25rem;user-select:none}
.cc-stepper-dot{width:30px;height:30px;border-radius:50%;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:0.7rem;font-weight:800;position:relative;z-index:1;cursor:pointer;background:#e2e8f0;color:#94a3b8;border:2px solid #e2e8f0;transition:all 0.25s}
.cc-stepper-dot.done{background:var(--dm-brand-from,#1b3c6b);color:#fff;border-color:var(--dm-brand-from,#1b3c6b)}
.cc-stepper-dot.done::after{content:'✓';font-size:0.65rem}
.cc-stepper-dot.done span{display:none}
.cc-stepper-dot.current{background:var(--dm-brand-from,#1b3c6b);color:#fff;border-color:var(--dm-brand-from,#1b3c6b);box-shadow:0 0 0 4px rgba(27,60,107,0.18)}
.cc-stepper-line{flex:1;height:2px;background:#e2e8f0;transition:background 0.3s}
.cc-stepper-line.done{background:var(--dm-brand-from,#1b3c6b)}
.cc-progress-strip{margin-bottom:1.25rem}
.cc-progress-strip-track{height:3px;background:#e2e8f0;border-radius:2px;overflow:hidden}
.cc-progress-strip-fill{height:100%;background:var(--dm-brand-gradient,linear-gradient(90deg,#1b3c6b,#4a73c4));border-radius:2px;transition:width 0.4s ease}
.cc-progress-meta{display:flex;justify-content:space-between;margin-top:0.4rem}
.cc-progress-label{font-size:0.7rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.06em;font-family:var(--tp-ff-onest,inherit)}
.cc-progress-step-name{font-size:0.7rem;font-weight:600;color:var(--dm-brand-from,#1b3c6b);font-family:var(--tp-ff-onest,inherit)}

/* ── Wizard card ──────────────────────────────────────────────────────────*/
.cc-wiz-card{background:#fff;border-radius:14px;box-shadow:0 2px 8px rgba(0,0,0,0.06),0 8px 24px rgba(0,0,0,0.05);border:1px solid #e2e8f0;overflow:hidden;width:100%}
.cc-step{display:none}
.cc-step.active{display:block;animation:cc-step-in 0.22s ease}
@keyframes cc-step-in{from{opacity:0;transform:translateY(7px)}to{opacity:1;transform:translateY(0)}}
.cc-step-hdr{padding:1.375rem 1.5rem 1.125rem;border-bottom:1px solid #f1f5f9;display:flex;align-items:flex-start;gap:0.875rem}
@media(max-width:480px){.cc-step-hdr{padding:1rem 1.125rem 0.875rem}}
.cc-step-icon-box{width:38px;height:38px;border-radius:10px;flex-shrink:0;background:var(--dm-brand-gradient,linear-gradient(135deg,#1b3c6b,#4a73c4));display:flex;align-items:center;justify-content:center;color:#fff;font-size:0.95rem;margin-top:2px}
.cc-step-title{font-size:1.1rem;font-weight:700;color:#1e293b;margin:0;letter-spacing:-0.01em;font-family:var(--tp-ff-onest,inherit)}
.cc-step-desc{font-size:0.78rem;color:#64748b;margin-top:0.2rem;line-height:1.4}
.cc-step-body{padding:1.25rem 1.5rem}
@media(max-width:480px){.cc-step-body{padding:1rem 1.125rem}}
.cc-step-footer{padding:0.875rem 1.5rem;border-top:1px solid #f1f5f9;background:#fafbfc;display:flex;justify-content:space-between;align-items:center;gap:0.75rem}
@media(max-width:480px){.cc-step-footer{padding:0.75rem 1.125rem}}

/* ── Form fields ──────────────────────────────────────────────────────────*/
.cc-fg{margin-bottom:0.875rem}
.cc-fg:last-child{margin-bottom:0}
.cc-label{display:block;font-size:0.68rem;font-weight:700;color:#64748b;margin-bottom:0.28rem;text-transform:uppercase;letter-spacing:0.04em}
.cc-hint{font-size:0.65rem;color:#94a3b8;margin-top:0.18rem;font-style:italic}
.cc-hint a{color:var(--dm-brand-to,#4a73c4);text-decoration:none}
.cc-select,.cc-input{width:100%;min-width:0;padding:0.5rem 0.7rem;border:1.5px solid #e2e8f0;border-radius:7px;font-size:0.875rem;font-family:inherit;color:#1e293b;background:#fafbfc;transition:border-color 0.18s,box-shadow 0.18s;outline:none}
.cc-select:focus,.cc-input:focus{border-color:var(--dm-brand-to,#4a73c4);background:#fff;box-shadow:0 0 0 3px rgba(74,115,196,0.1)}
.cc-select{cursor:pointer;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 0.7rem center;padding-right:2rem}
.cc-input[readonly]{background:#f8fafc;color:#64748b;cursor:default}
.cc-row2{display:grid;grid-template-columns:1fr 1fr;gap:0.75rem}
@media(max-width:420px){.cc-row2{grid-template-columns:1fr}}
.cc-override{position:relative;min-width:0}
.cc-override .cc-undo{position:absolute;right:0.5rem;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--dm-brand-to,#4a73c4);font-size:0.72rem;cursor:pointer;opacity:0;transition:opacity 0.18s;padding:0.2rem}
.cc-override:hover .cc-undo{opacity:1}
.cc-overridden{border-color:#d97706!important;background:#fffbeb!important}
.cc-badge-tco{font-size:0.58rem;background:#fef3c7;color:#d97706;padding:0.08rem 0.28rem;border-radius:3px;margin-left:3px;font-style:normal;font-weight:700;vertical-align:middle}
.cc-badge-pir{font-size:0.58rem;background:#dbeafe;color:#1d40ae;padding:0.08rem 0.28rem;border-radius:3px;margin-left:3px;font-style:normal;font-weight:700;vertical-align:middle}
.cc-section-sep{font-size:0.63rem;font-weight:800;text-transform:uppercase;letter-spacing:0.07em;color:#cbd5e1;margin:1rem 0 0.625rem;padding-bottom:0.35rem;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:0.35rem}
.cc-read-only-field{display:flex;align-items:center;gap:0.5rem;padding:0.5rem 0.7rem;border:1.5px solid #e2e8f0;border-radius:7px;background:#f8fafc;font-size:0.875rem;color:#64748b;font-family:inherit}
.cc-read-only-val{font-weight:700;color:var(--dm-brand-from,#1b3c6b);margin-left:auto}
.cc-validation-warn{display:none;font-size:0.68rem;color:#b45309;background:#fef3c7;border:1px solid #fde68a;border-radius:4px;padding:0.28rem 0.55rem;margin-top:0.25rem}
.cc-validation-warn.show{display:block}
.cc-bcd-disclaimer{font-size:0.65rem;color:#92400e;background:#fff7ed;border:1px solid #fed7aa;border-radius:6px;padding:0.45rem 0.7rem;margin-top:0.75rem;line-height:1.5}

/* ── Entity toggle ────────────────────────────────────────────────────────*/
.cc-entity-toggle{display:flex;gap:0.5rem;margin-top:0.3rem}
.cc-entity-btn{flex:1;padding:0.45rem;border:1.5px solid #e2e8f0;border-radius:6px;background:#fafbfc;font-size:0.78rem;font-weight:600;color:#64748b;cursor:pointer;text-align:center;transition:all 0.18s;font-family:inherit}
.cc-entity-btn.active{background:var(--dm-brand-from,#1b3c6b);color:#fff;border-color:var(--dm-brand-from,#1b3c6b)}

/* ── TCO view tabs ────────────────────────────────────────────────────────*/
.cc-view-tabs{display:flex;border-bottom:2px solid #e2e8f0;background:#f8fafc;padding:0 0.875rem}
.cc-view-tab{padding:0.55rem 1rem;background:none;border:none;border-bottom:2px solid transparent;margin-bottom:-2px;font-size:0.72rem;font-weight:700;color:#64748b;cursor:pointer;transition:all 0.2s;text-transform:uppercase;letter-spacing:0.04em;font-family:var(--tp-ff-onest,inherit)}
.cc-view-tab.active{color:var(--dm-brand-from,#1b3c6b);border-bottom-color:var(--dm-brand-from,#1b3c6b)}
.cc-view-tab:hover:not(.active){color:#1e293b;background:#f1f5f9}
.cc-tco-note{display:none;padding:0.45rem 0.875rem;background:#fef9c3;font-size:0.72rem;color:#92400e;border-bottom:1px solid #fde68a}
.cc-tco-note.show{display:block}
.cc-tbl tr.tco-only{display:none}
.tco-mode .cc-tbl tr.tco-only{display:table-row}
.cc-tbl .igst td{background:#fff7ed;color:#9a3412;font-size:0.75rem;font-style:italic}

/* ── KPI row ──────────────────────────────────────────────────────────────*/
.cc-kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:0.875rem;margin-bottom:1.125rem}
@media(max-width:700px){.cc-kpi-row{grid-template-columns:1fr 1fr}}
@media(max-width:380px){.cc-kpi-row{grid-template-columns:1fr}}
.cc-kpi{background:#fff;border-radius:10px;box-shadow:0 1px 3px rgba(0,0,0,0.05),0 4px 12px rgba(0,0,0,0.04);border:1px solid #e2e8f0;padding:1rem;position:relative;overflow:hidden}
.cc-kpi::before{content:'';position:absolute;top:0;left:0;right:0;height:3px}
.cc-kpi.india::before{background:var(--dm-brand-gradient,linear-gradient(90deg,#1b3c6b,#4a73c4))}
.cc-kpi.europe::before{background:#7c3aed}
.cc-kpi.savings::before{background:#059669}
.cc-kpi.negative::before{background:#dc2626}
.cc-kpi-label{font-size:0.65rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.35rem}
.cc-kpi-val{font-size:clamp(1rem,2.5vw,1.5rem);font-weight:800;color:#1e293b;letter-spacing:-0.02em;line-height:1.1}
.cc-kpi-sub{font-size:0.7rem;color:#94a3b8;margin-top:0.18rem}
@media(max-width:700px){.cc-kpi.savings,.cc-kpi.negative{grid-column:1/-1}}

.cc-insight{background:linear-gradient(90deg,#d1fae5,#ecfdf5);border:1px solid #a7f3d0;border-radius:10px;padding:0.875rem 1rem;margin-bottom:1.125rem;display:flex;align-items:flex-start;gap:0.6rem}
.cc-insight.neg{background:linear-gradient(90deg,#fee2e2,#fef2f2);border-color:#fecaca}
.cc-insight-ico{font-size:1rem;flex-shrink:0;margin-top:1px}
.cc-insight-text{font-weight:600;color:#059669;font-size:0.85rem;line-height:1.5}
.cc-insight.neg .cc-insight-text{color:#dc2626}

.cc-charts{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.125rem}
@media(max-width:640px){.cc-charts{grid-template-columns:1fr}}
.cc-chart-box{background:#fff;border-radius:10px;border:1px solid #e2e8f0;overflow:hidden}
.cc-chart-title{padding:0.625rem 0.875rem;font-size:0.72rem;font-weight:700;color:var(--dm-brand-from,#1b3c6b);text-transform:uppercase;letter-spacing:0.05em;border-bottom:1px solid #f1f5f9}
.cc-chart-body{padding:0.875rem}
.cc-chart-wrap{position:relative;height:260px}

.cc-sens-card{background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;padding:1rem;margin-bottom:1.125rem}
.cc-sens-label{font-size:0.68rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:0.5rem}
.cc-slider{width:100%;accent-color:var(--dm-brand-to,#4a73c4);margin:0.4rem 0}
.cc-slider-marks{display:flex;justify-content:space-between;font-size:0.65rem;color:#94a3b8}
.cc-slider-val{text-align:center;font-weight:700;color:var(--dm-brand-from,#1b3c6b);font-size:0.95rem;margin-top:0.15rem}
.cc-slider-impact{text-align:center;font-size:0.75rem;color:#64748b;margin-top:0.25rem;min-height:1.1em}

.cc-breakdown-card{background:#fff;border-radius:10px;border:1px solid #e2e8f0;overflow:hidden;margin-bottom:1.125rem}
.cc-breakdown-title{padding:0.625rem 0.875rem;font-size:0.72rem;font-weight:700;color:var(--dm-brand-from,#1b3c6b);text-transform:uppercase;letter-spacing:0.05em;border-bottom:1px solid #f1f5f9}
.cc-tbl-scroll{overflow-x:auto;-webkit-overflow-scrolling:touch}
.cc-tbl{width:100%;border-collapse:collapse;font-size:0.8rem;min-width:480px}
.cc-tbl th{text-align:left;padding:0.5rem 0.875rem;background:#f8fafc;font-weight:700;color:#64748b;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.04em;border-bottom:2px solid #e2e8f0;white-space:nowrap}
.cc-tbl td{padding:0.5rem 0.875rem;border-bottom:1px solid #f1f5f9}
.cc-tbl tr:hover td{background:#fafbfc}
.cc-tbl .sec td{background:linear-gradient(90deg,#f1f5f9,#fff);font-weight:700;color:var(--dm-brand-from,#1b3c6b);font-size:0.68rem;text-transform:uppercase;letter-spacing:0.04em;padding-top:0.75rem}
.cc-tbl .tot td{font-weight:800;color:#1e293b;background:#d1fae5;border-top:2px solid #059669}
.cc-tbl .etot td{font-weight:800;color:#1e293b;background:#ede9fe;border-top:2px solid #7c3aed}
.cc-tbl .tco td{background:#fef9c3;border-top:1px dashed #d97706;color:#92400e;font-style:italic;font-size:0.75rem}
.cc-nr{text-align:right;font-variant-numeric:tabular-nums;font-weight:500}
.cc-nr.b{font-weight:800}
.cc-pc{text-align:right;color:#94a3b8;font-size:0.72rem}
.cc-data-note{font-size:0.62rem;color:#94a3b8;font-style:italic;padding:0.35rem 0.875rem 0.5rem;border-top:1px solid #e2e8f0;background:#fafbfc}
.cc-data-note a{color:var(--dm-brand-to,#4a73c4);text-decoration:none}

/* ── API Logs ─────────────────────────────────────────────────────────────*/
#apiLogsWrap{display:none}
.cc-log-panel{background:#0b1120;border-radius:10px;border:1px solid #1e293b;overflow:hidden;margin-top:1rem}
.cc-log-hdr{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:0.4rem;padding:0.6rem 1rem;background:#0f172a;border-bottom:1px solid #1e293b}
.cc-log-title{font-size:0.65rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.08em;display:flex;align-items:center;gap:0.4rem;font-family:'SF Mono',Monaco,monospace}
.cc-log-count{background:#1e293b;color:#94a3b8;font-size:0.6rem;padding:0.08rem 0.38rem;border-radius:100px;font-weight:700;font-family:'SF Mono',Monaco,monospace}
.cc-log-scroll{max-height:340px;overflow:auto}
.cc-ltbl{width:100%;border-collapse:collapse;font-size:0.72rem;font-family:'SF Mono',Monaco,monospace;min-width:500px}
.cc-ltbl th{text-align:left;padding:0.38rem 0.875rem;background:#0f172a;color:#334155;font-weight:600;font-size:0.58rem;text-transform:uppercase;letter-spacing:0.06em;position:sticky;top:0;z-index:10;border-bottom:1px solid #1e293b}
.cc-ltbl td{padding:0.42rem 0.875rem;color:#cbd5e1;border-bottom:1px solid #111827;vertical-align:middle}
.cc-ltbl tr:last-child td{border-bottom:none}
.cc-ltbl tr:hover td{background:#0f172a55}
.clt{color:#334155!important;white-space:nowrap;font-size:0.65rem}
.cla{color:#60a5fa!important;font-weight:600}
.clep{color:#334155;font-size:0.62rem;display:block;margin-top:1px}
.cld{color:#64748b!important;font-size:0.65rem;word-break:break-all}
.cldr{text-align:right!important;white-space:nowrap;color:#334155!important;font-size:0.65rem}
.cls-s{color:#34d399!important;font-weight:700}
.cls-e{color:#f87171!important;font-weight:700}
.cls-f{color:#fbbf24!important;font-weight:700}
.cls-p{color:#fbbf24!important;font-weight:700;animation:cc-pulse 1.2s ease-in-out infinite}
.cle{text-align:center;padding:2rem 1rem;color:#1e293b;font-style:italic;font-size:0.75rem}
.clb{display:inline-block;padding:0.06rem 0.32rem;border-radius:3px;font-size:0.58rem;font-weight:800;text-transform:uppercase;letter-spacing:0.04em;background:#0c2340;color:#3b82f6;border:1px solid #1e3a5f}

/* ── Toast ────────────────────────────────────────────────────────────────*/
.cc-toasts{position:fixed;bottom:1.25rem;right:1.25rem;z-index:9100;display:flex;flex-direction:column;gap:0.4rem}
@media(max-width:480px){.cc-toasts{left:0.75rem;right:0.75rem;bottom:0.75rem}}
.cc-toast{background:#fff;border-radius:8px;box-shadow:0 6px 20px rgba(0,0,0,0.12);padding:0.75rem 1rem;border-left:4px solid #4a73c4;display:flex;align-items:center;gap:0.6rem;animation:cc-slide 0.25s ease;max-width:360px;font-size:0.82rem;font-family:var(--tp-ff-onest,inherit)}
.cc-toast.success{border-left-color:#059669}
.cc-toast.error{border-left-color:#dc2626}
.cc-toast.warning{border-left-color:#d97706}
@keyframes cc-slide{from{transform:translateX(110%);opacity:0}to{transform:translateX(0);opacity:1}}
.cc-toast-x{background:none;border:none;color:#94a3b8;cursor:pointer;margin-left:auto;font-size:0.85rem}

/* ── Prime Insights locked card ───────────────────────────────────────────*/
.cc-prime-card{background:#fff;border-radius:10px;border:1.5px solid #e0e7ff;overflow:hidden;margin-bottom:1.125rem}
.cc-prime-hdr{display:flex;align-items:center;gap:0.5rem;padding:0.75rem 1rem;background:linear-gradient(90deg,#1b3c6b,#4a73c4);color:#fff;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.06em}
.cc-prime-hdr i{font-size:0.85rem}
.cc-prime-badge{margin-left:auto;background:rgba(255,255,255,0.2);font-size:0.6rem;padding:0.18rem 0.55rem;border-radius:100px;letter-spacing:0.04em;font-weight:600}
.cc-prime-teaser{padding:0.75rem 1rem 0.5rem;border-bottom:1px dashed #e0e7ff}
.cc-prime-teaser-label{font-size:0.65rem;font-weight:700;color:#4a73c4;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:0.3rem}
.cc-prime-teaser-row{display:flex;align-items:center;gap:0.6rem;font-size:0.82rem;color:#1e293b;font-weight:600}
.cc-prime-teaser-val{font-weight:800;color:#059669;font-size:0.95rem}
.cc-prime-locked-wrap{position:relative}
.cc-prime-content{padding:1rem;display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;filter:blur(5px);user-select:none;pointer-events:none;transition:filter 0.4s ease}
@media(max-width:560px){.cc-prime-content{grid-template-columns:1fr}}
.cc-prime-card.unlocked .cc-prime-content{filter:none;pointer-events:auto}
.cc-prime-item{background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;padding:0.75rem}
.cc-prime-item-label{font-size:0.63rem;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;color:#64748b;margin-bottom:0.35rem;display:flex;align-items:center;gap:0.3rem}
.cc-prime-item-val{font-size:1rem;font-weight:800;color:#1e293b;margin-bottom:0.15rem}
.cc-prime-item-sub{font-size:0.7rem;color:#64748b;line-height:1.4}
.cc-prime-lock-overlay{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:linear-gradient(to bottom,rgba(248,250,252,0.55) 0%,rgba(248,250,252,0.92) 55%,rgba(248,250,252,1) 100%);z-index:2}
.cc-prime-card.unlocked .cc-prime-lock-overlay{display:none}
.cc-prime-lock-inner{text-align:center;padding:1rem}
.cc-prime-lock-inner i.fa-lock{font-size:1.5rem;color:#94a3b8;margin-bottom:0.5rem;display:block}
.cc-prime-lock-inner p{font-size:0.82rem;color:#64748b;margin:0 0 0.75rem;font-weight:500}
.cc-prime-unlock-btn{display:inline-flex;align-items:center;gap:0.45rem;padding:0.6rem 1.25rem;background:var(--dm-brand-gradient,linear-gradient(135deg,#1b3c6b,#4a73c4));color:#fff;border:none;border-radius:8px;font-size:0.82rem;font-weight:700;cursor:pointer;font-family:inherit;transition:opacity 0.18s;box-shadow:0 4px 14px rgba(27,60,107,0.25)}
.cc-prime-unlock-btn:hover{opacity:0.88}

@media print{
    .cc-hero{padding-top:1rem!important}
    .cc-fallback-banner,.cc-stepper,.cc-progress-strip,.cc-step-footer,#apiLogsWrap,.no-print,.cc-hero-actions,.cc-view-tabs,.cc-tco-note,.cc-sens-card{display:none!important}
    .cc-wiz-outer,.cc-wiz-outer.is-results{max-width:100%!important;padding:0!important}
    .cc-step{display:block!important;animation:none!important}
    .cc-wiz-card{box-shadow:none;border:1px solid #ddd}
    .cc-kpi,.cc-chart-box,.cc-breakdown-card{box-shadow:none;border:1px solid #ddd;break-inside:avoid}
    .cc-tbl tr.tco-only{display:none!important}
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="cc-page">


<div class="cc-hero">
    
    <div class="cc-fallback-banner" id="fallbackBanner">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Live EUR/INR unavailable &mdash; using fallback &#8377;110.92 (<span id="fallbackDate">last known</span>). Outputs may differ slightly. Click <strong>Refresh Rates</strong> to retry.</span>
    </div>
    <div class="cc-hero-inner">
        <div class="cc-hero-left">
            <div>
                <div class="cc-hero-eyebrow">DevMantra Analytics</div>
                <h1 class="cc-hero-title">India Cost Benchmarking Calculator for European Manufacturers</h1>
                
                <p class="cc-hero-sub">Manufacturing Cost Comparison &middot; Landed Cost Analysis &middot; NACE C Manufacturing Rates</p>
            </div>
        </div>
        <div class="cc-hero-actions no-print">
            <!-- <div class="cc-api-pill loading" id="apiStatus">
                <div class="dot"></div>
                <span id="apiStatusText">Loading rates...</span>
            </div> -->
            <button class="dm-btn-primary dm-btn-sm" onclick="refreshRates()">
                <i class="fas fa-sync-alt"></i> Refresh Rates
            </button>
        </div>
    </div>
</div>


<div class="cc-wizard-bg">
<div class="cc-wiz-outer" id="wizOuter">

    <div class="cc-stepper no-print" id="stepper">
        <div class="cc-stepper-dot current" id="sd1" onclick="ccGo(1)" title="Sector"><span>1</span></div>
        <div class="cc-stepper-line" id="sl1"></div>
        <div class="cc-stepper-dot" id="sd2" onclick="ccGo(2)" title="Production"><span>2</span></div>
        <div class="cc-stepper-line" id="sl2"></div>
        <div class="cc-stepper-dot" id="sd3" onclick="ccGo(3)" title="Labour"><span>3</span></div>
        <div class="cc-stepper-line" id="sl3"></div>
        <div class="cc-stepper-dot" id="sd4" onclick="ccGo(4)" title="Logistics"><span>4</span></div>
        <div class="cc-stepper-line" id="sl4"></div>
        <div class="cc-stepper-dot" id="sd5" onclick="ccGo(5)" title="Assumptions"><span>5</span></div>
        <div class="cc-stepper-line" id="sl5"></div>
        <div class="cc-stepper-dot" id="sd6" onclick="ccGo(6)" title="Results"><span>6</span></div>
    </div>
    <div class="cc-progress-strip no-print">
        <div class="cc-progress-strip-track"><div class="cc-progress-strip-fill" id="progressFill" style="width:16.67%"></div></div>
        <div class="cc-progress-meta">
            <span class="cc-progress-label" id="progressLabel">Step 1 of 6</span>
            <span class="cc-progress-step-name" id="progressName">Sector &amp; Geography</span>
        </div>
    </div>

    <div class="cc-wiz-card">

        
        <div class="cc-step active" id="step-1">
            <div class="cc-step-hdr">
                <div class="cc-step-icon-box"><i class="fas fa-globe-europe"></i></div>
                <div><h2 class="cc-step-title">Where are you comparing?</h2>
                <p class="cc-step-desc">Select the European country and manufacturing sector. HS code and duty rates auto-populate.</p></div>
            </div>
            <div class="cc-step-body">
                <div class="cc-fg">
                    <label class="cc-label">European Country</label>
                    <select class="cc-select" id="europeanCountry" onchange="onCountryChange()">
                        <option value="Germany" selected>Germany</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="France">France</option>
                        <option value="Italy">Italy</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Austria">Austria</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Spain">Spain</option>
                        <option value="Poland">Poland</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Finland">Finland</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Portugal">Portugal</option>
                    </select>
                </div>
                <div class="cc-fg">
                    <label class="cc-label">Manufacturing Sector</label>
                    <select class="cc-select" id="sector" onchange="onSectorChange()">
                        <option value="Auto Components" selected>Auto Components</option>
                        <option value="Industrial Machinery">Industrial Machinery</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Textiles &amp; Apparel">Textiles &amp; Apparel</option>
                        <option value="Pharmaceuticals">Pharmaceuticals</option>
                        <option value="Precision Engineering">Precision Engineering</option>
                        <option value="Food Processing">Food Processing</option>
                        <option value="Medical Devices">Medical Devices</option>
                        <option value="Chemicals">Chemicals</option>
                        <option value="Plastics &amp; Rubber">Plastics &amp; Rubber</option>
                        <option value="Steel &amp; Metals">Steel &amp; Metals</option>
                    </select>
                </div>
                <div class="cc-fg">
                    <label class="cc-label">HS Code / Import Category</label>
                    
                    <select class="cc-select" id="hsCode" onchange="onHsCodeChange()">
                        <option value="8708" selected>8708 &mdash; Auto Parts (7.5% BCD)</option>
                        <option value="8467">8467 &mdash; Industrial Machinery (0&ndash;7.5% BCD) <span class="cc-badge-pir">PIR applies</span></option>
                        <option value="8541">8541 &mdash; Electronics / Semiconductors (0% BCD)</option>
                        <option value="6203">6203 &mdash; Textiles / Clothing (20% BCD)</option>
                        <option value="3004">3004 &mdash; Pharmaceuticals (5% BCD)</option>
                        <option value="9031">9031 &mdash; Precision Instruments (7.5% BCD)</option>
                        <option value="2106">2106 &mdash; Food Preparations (10&ndash;30% BCD, varies)</option>
                        <option value="9018">9018 &mdash; Medical Devices (5% BCD)</option>
                        <option value="2710">2710 &mdash; Chemicals (10% BCD)</option>
                        <option value="3926">3926 &mdash; Plastics / Rubber (10% BCD)</option>
                        <option value="7228">7228 &mdash; Steel / Metals (7.5&ndash;15% BCD)</option>
                    </select>
                    
                    <div class="cc-bcd-disclaimer">
                        <strong>Important:</strong> BCD rates shown are indicative per CBIC Budget 2025-26. Actual rates depend on the specific 8-digit HS subheading, applicable exemptions, and current notifications.
                        Industrial Machinery may qualify for <strong>0% BCD</strong> under the <strong>Project Import Regulations (PIR)</strong> scheme if setting up a manufacturing facility in India.
                        Always verify at <a href="https://icegate.gov.in" target="_blank" rel="noopener" style="color:var(--dm-brand-to,#4a73c4)">icegate.gov.in</a> before making investment decisions.
                    </div>
                </div>
            </div>
            <div class="cc-step-footer">
                <div></div>
                <button class="dm-btn-primary dm-btn-sm" onclick="ccNext()">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        
        <div class="cc-step" id="step-2">
            <div class="cc-step-hdr">
                <div class="cc-step-icon-box"><i class="fas fa-cogs"></i></div>
                <div><h2 class="cc-step-title">Production Parameters</h2>
                <p class="cc-step-desc">Annual volume, batch size, production hours and raw material costs for both India and Europe.</p></div>
            </div>
            <div class="cc-step-body">
                <div class="cc-fg">
                    <label class="cc-label">Annual Production Volume (units)</label>
                    <input type="number" class="cc-input" id="annualVolume" value="10000" min="1" oninput="calculate()">
                </div>
                <div class="cc-row2">
                    <div class="cc-fg">
                        <label class="cc-label">Units per Batch</label>
                        <input type="number" class="cc-input" id="unitsPerBatch" value="500" min="1" oninput="calculate()">
                    </div>
                    <div class="cc-fg">
                        <label class="cc-label">Prod. Hours / Unit
                            <span id="prodHoursBadge" style="font-size:0.58rem;background:#dbeafe;color:#1d40ae;padding:0.06rem 0.3rem;border-radius:3px;margin-left:3px;font-weight:600;text-transform:none;letter-spacing:0;font-style:normal;vertical-align:middle"></span>
                        </label>
                        <input type="number" class="cc-input" id="prodHours" value="2.5" min="0.01" step="0.1" oninput="onProdHoursChange()">
                        <div class="cc-validation-warn" id="prodHoursWarn"></div>
                        <div class="cc-hint" id="prodHoursBenchmarkHint">Sector benchmark: 1.5&ndash;4 hrs/unit</div>
                    </div>
                </div>

                
                <div class="cc-section-sep"><i class="fas fa-boxes"></i> Raw Material Costs</div>
                <div class="cc-fg">
                    <label class="cc-label">Europe Raw Material Cost / Unit (EUR)</label>
                    <input type="number" class="cc-input" id="rawMaterialCost" value="18.50" min="0" step="0.10" oninput="onEuropeRMChange()">
                    <div class="cc-hint">Your European sourcing cost. Used as the full-cost baseline.</div>
                </div>
                <div class="cc-fg">
                    <label class="cc-label">India Raw Material Cost / Unit (EUR)
                        <span id="indiaMaterialBadge" style="font-size:0.58rem;background:#dcfce7;color:#15803d;padding:0.06rem 0.3rem;border-radius:3px;margin-left:3px;font-weight:600;text-transform:none;letter-spacing:0;font-style:normal;vertical-align:middle"></span>
                    </label>
                    <input type="number" class="cc-input" id="indiaRawMaterialCost" value="15.17" min="0" step="0.10" oninput="onIndiaRMChange()">
                    <div class="cc-hint" id="indiaMaterialHint">Sector default pre-populated. Override with your actual India supplier quote.</div>
                </div>
                <div class="cc-fg">
                    <label class="cc-label">India Material Saving vs Europe</label>
                    <div class="cc-read-only-field" id="materialSavingDisplay">
                        Derived from above inputs <span class="cc-read-only-val" id="materialSavingVal">&mdash;</span>
                    </div>
                    <div class="cc-hint">Calculated automatically: (Europe RM &minus; India RM) &divide; Europe RM &times; 100</div>
                </div>
            </div>
            <div class="cc-step-footer">
                <button class="dm-btn-secondary dm-btn-sm" onclick="ccPrev()"><i class="fas fa-arrow-left"></i> Back</button>
                <button class="dm-btn-primary dm-btn-sm" onclick="ccNext()">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        
        <div class="cc-step" id="step-3">
            <div class="cc-step-hdr">
                <div class="cc-step-icon-box"><i class="fas fa-users"></i></div>
                <div><h2 class="cc-step-title">Labour Costs</h2>
                <p class="cc-step-desc">India rates stored in INR and converted live via Step&nbsp;4 FX rate. Europe rates are Eurostat 2024 NACE&nbsp;C manufacturing sector.</p></div>
            </div>
            <div class="cc-step-body">
                <div class="cc-section-sep"><i class="fas fa-flag" style="color:#ff9933"></i> India Labour</div>
                
                <div class="cc-fg">
                    <label class="cc-label">India Manufacturing Region</label>
                    <select class="cc-select" id="indiaRegion" onchange="onRegionChange()">
                        <option value="Central VDA">Central VDA (All India — Central sphere only)</option>
                        <option value="Tamil Nadu" selected>Tamil Nadu (Chennai / Hosur)</option>
                        <option value="Maharashtra">Maharashtra (Pune / Aurangabad)</option>
                        <option value="Gujarat">Gujarat (Ahmedabad / Sanand)</option>
                        <option value="Karnataka">Karnataka (Bengaluru / Tumkur)</option>
                        <option value="Telangana">Telangana (Hyderabad)</option>
                        <option value="Haryana">Haryana (Gurugram / Neemrana)</option>
                        <option value="Rajasthan">Rajasthan (Neemrana / Bhiwadi)</option>
                    </select>
                    <div class="cc-hint">State minimum wage notifications 2024-25. Rates are stored in INR and converted at the live EUR/INR rate.</div>
                </div>
                <div class="cc-fg">
                    <label class="cc-label">Labour Grade</label>
                    
                    <select class="cc-select" id="labourGrade" onchange="onGradeChange()">
                        <option value="Unskilled">Unskilled (VDA/state minimum)</option>
                        <option value="Semi-Skilled">Semi-Skilled</option>
                        <option value="Skilled" selected>Skilled</option>
                        <option value="Skilled Metro">Skilled Metro</option>
                        <option value="Highly Skilled">Highly Skilled</option>
                    </select>
                </div>
                <div class="cc-row2">
                    <div class="cc-fg">
                        <label class="cc-label">India Rate (INR/hr)</label>
                        <div class="cc-override">
                            <input type="number" class="cc-input" id="indiaHourlyRateINR" value="162" min="0" step="1" oninput="markOverride('indiaHourlyRateINR'); calculate()">
                            <button class="cc-undo" onclick="resetRate()" title="Reset to region/grade benchmark">&#8635;</button>
                        </div>
                        <div class="cc-hint" id="indiaRateEurHint">= &euro;<span id="indiaRateEurCalc">1.18</span>/hr at current FX</div>
                    </div>
                    <div class="cc-fg">
                        <label class="cc-label">India Overhead %</label>
                        <input type="number" class="cc-input" id="indiaOverheadPct" value="35" min="0" step="1" oninput="calculate()">
                        <div class="cc-hint">% of India labour cost</div>
                    </div>
                </div>

                <div class="cc-section-sep" style="margin-top:1.25rem"><i class="fas fa-flag" style="color:#003399"></i> Europe Labour</div>
                <div class="cc-row2">
                    <div class="cc-fg">
                        <label class="cc-label">Europe Rate (EUR/hr)</label>
                        <div class="cc-override">
                            <input type="number" class="cc-input" id="europeHourlyRate" value="45.00" min="0" step="0.50" oninput="markOverride('europeHourlyRate'); calculate()">
                            <button class="cc-undo" onclick="resetEuropeRate()" title="Reset to Eurostat NACE C">&#8635;</button>
                        </div>
                    </div>
                    <div class="cc-fg">
                        
                        <label class="cc-label">Europe Overhead %</label>
                        <div class="cc-override">
                            <input type="number" class="cc-input" id="overheadPct" value="21" min="0" step="1" oninput="markOverride('overheadPct'); calculate()">
                            <button class="cc-undo" onclick="resetEuropeOverhead()" title="Reset to country default">&#8635;</button>
                        </div>
                        <div class="cc-hint" id="overheadHint">Employer social contributions. Auto-set per country.</div>
                    </div>
                </div>
                <div class="cc-hint">Eurostat 2024 NACE&nbsp;C (Manufacturing sector) incl. all employer social contributions. Auto-set from country &amp; region selection.</div>
            </div>
            <div class="cc-step-footer">
                <button class="dm-btn-secondary dm-btn-sm" onclick="ccPrev()"><i class="fas fa-arrow-left"></i> Back</button>
                <button class="dm-btn-primary dm-btn-sm" onclick="ccNext()">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        
        <div class="cc-step" id="step-4">
            <div class="cc-step-hdr">
                <div class="cc-step-icon-box"><i class="fas fa-ship"></i></div>
                <div><h2 class="cc-step-title">Logistics &amp; Import Duties</h2>
                <p class="cc-step-desc">Shipping rates, FX, BCD, Social Welfare Surcharge, and IGST. All auto-fetched from backend APIs.</p></div>
            </div>
            <div class="cc-step-body">
                
                <div class="cc-fg">
                    <label class="cc-label">Logistics Mode</label>
                    
                    <select class="cc-select" id="logisticsMode" onchange="onLogisticsModeChange()">
                        <option value="Sea" selected>Sea FCL &mdash; dynamic (Drewry WCI 2025-26, rate &divide; fill weight)</option>
                        <option value="SeaLCL">Sea LCL &mdash; &euro;0.27/kg (consolidation)</option>
                        <option value="Air">Air Freight &mdash; &euro;5.20/kg (IATA 2025-26 avg, India&ndash;Europe)</option>
                        <option value="Road">Road+Sea Multimodal &mdash; &euro;0.34/kg</option>
                    </select>
                </div>
                <div class="cc-row2" id="fclRow">
                    <div class="cc-fg">
                        <label class="cc-label">Shipment Weight (kg / batch)</label>
                        <input type="number" class="cc-input" id="shipmentWeight" value="1000" min="0" oninput="calculate()">
                    </div>
                    <div class="cc-fg" id="fillRateFg">
                        <label class="cc-label">Container Fill Rate %</label>
                        <input type="number" class="cc-input" id="containerFillRate" value="65" min="10" max="100" step="5" oninput="calculate()">
                        <div class="cc-hint">% of 40ft FEU capacity (26,000 kg) your cargo fills. Higher fill = lower per-kg rate.</div>
                    </div>
                </div>
                <div class="cc-fg" id="nonFclWeightRow" style="display:none">
                    <label class="cc-label">Shipment Weight (kg / batch)</label>
                    <input type="number" class="cc-input" id="shipmentWeightAlt" value="1000" min="0" oninput="calculate()">
                </div>
                <div class="cc-fg">
                    <label class="cc-label">Calculated Freight Rate (EUR/kg)</label>
                    <div class="cc-read-only-field">
                        FCL: Drewry WCI &divide; fill weight
                        <span class="cc-read-only-val" id="calcFreightRate">€0.085/kg</span>
                    </div>
                </div>
                <div class="cc-row2">
                    <div class="cc-fg">
                        <label class="cc-label">EUR / INR Rate</label>
                        <div class="cc-override">
                            <input type="number" class="cc-input" id="exchangeRate" value="110.92" min="0" step="0.01" oninput="markOverride('exchangeRate'); calculate()">
                            <button class="cc-undo" onclick="resetExchangeRate()" title="Fetch live rate">&#8635;</button>
                        </div>
                        <div class="cc-hint">Auto-fetched from ECB / ExchangeRate-API. Click &#8635; to restore.</div>
                    </div>
                    <div class="cc-fg">
                        <label class="cc-label">Import Duty BCD %</label>
                        <div class="cc-override">
                            <input type="number" class="cc-input" id="dutyPct" value="7.5" min="0" step="0.1" oninput="markOverride('dutyPct'); calculate()">
                            <button class="cc-undo" onclick="resetDuty()" title="Reset to HS code">&#8635;</button>
                        </div>
                        <div class="cc-hint">Auto-set from HS code. Override for project imports / PIR.</div>
                    </div>
                </div>

                
                <div class="cc-section-sep"><i class="fas fa-file-invoice-dollar"></i> India Import Tax (IGST + SWS)</div>
                <div class="cc-row2">
                    <div class="cc-fg">
                        <label class="cc-label">Social Welfare Surcharge (SWS)</label>
                        <div class="cc-read-only-field">
                            = BCD &times; 10% (auto-computed)
                            <span class="cc-read-only-val" id="swsDisplay">0.75%</span>
                        </div>
                        <div class="cc-hint">Non-waivable; applies on top of BCD.</div>
                    </div>
                    <div class="cc-fg">
                        <label class="cc-label">IGST Rate %</label>
                        <div class="cc-override">
                            <select class="cc-select" id="igstRate" onchange="markOverride('igstRate'); calculate()">
                                <option value="5">5% (agri / basic food)</option>
                                <option value="12">12% (pharma / med devices / textiles)</option>
                                <option value="18" selected>18% (general manufacturing)</option>
                                <option value="28">28% (auto / luxury)</option>
                            </select>
                            <button class="cc-undo" onclick="resetIGST()" title="Reset to HS code default">&#8635;</button>
                        </div>
                        <div class="cc-hint">Auto-set from HS code. IGST base = CIF + BCD + SWS.</div>
                    </div>
                </div>
                <div class="cc-fg">
                    <label class="cc-label">Will you set up an Indian legal entity? (Pvt Ltd / LLP / Branch)</label>
                    <div class="cc-entity-toggle">
                        <button class="cc-entity-btn" id="entityYes" onclick="setEntity('yes')">Yes &mdash; IGST recoverable as ITC</button>
                        <button class="cc-entity-btn active" id="entityNo" onclick="setEntity('no')">No &mdash; IGST is a hard landed cost</button>
                    </div>
                    <div class="cc-hint" id="entityHint">No Indian entity: IGST adds to landed cost. With entity: IGST is recovered via Input Tax Credit &mdash; effectively zero net cost.</div>
                </div>
            </div>
            <div class="cc-step-footer">
                <button class="dm-btn-secondary dm-btn-sm" onclick="ccPrev()"><i class="fas fa-arrow-left"></i> Back</button>
                <button class="dm-btn-primary dm-btn-sm" onclick="ccNext()">Next <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>

        
        <div class="cc-step" id="step-5">
            <div class="cc-step-hdr">
                <div class="cc-step-icon-box"><i class="fas fa-sliders-h"></i></div>
                <div><h2 class="cc-step-title">European Cost Assumptions</h2>
                <p class="cc-step-desc">EU regulatory and energy premiums. Repatriation buffer is TCO-only and does not affect the unit cost comparison.</p></div>
            </div>
            <div class="cc-step-body">
                <div class="cc-row2">
                    <div class="cc-fg">
                        <label class="cc-label">EU Regulatory % (of mfg)</label>
                        <input type="number" class="cc-input" id="regulatoryPct" value="8" min="0" step="1" oninput="calculate()">
                        <div class="cc-hint">CE marking, compliance costs etc.</div>
                    </div>
                    <div class="cc-fg">
                        <label class="cc-label">EU Energy Premium %</label>
                        <input type="number" class="cc-input" id="energyPct" value="5" min="0" step="1" oninput="calculate()">
                        <div class="cc-hint">Eurostat energy cost premium</div>
                    </div>
                </div>
                <div class="cc-fg" style="margin-top:0.25rem">
                    <label class="cc-label">Repatriation Buffer % <span class="cc-badge-tco">TCO TAB ONLY</span></label>
                    <input type="number" class="cc-input" id="repatriationPct" value="3" min="0" step="1" oninput="calculate()">
                    <div class="cc-hint">FX hedge &amp; transfer pricing buffer. Visible in TCO tab only &mdash; excluded from unit cost comparison.</div>
                </div>
            </div>
            <div class="cc-step-footer">
                <button class="dm-btn-secondary dm-btn-sm" onclick="ccPrev()"><i class="fas fa-arrow-left"></i> Back</button>
                <button class="dm-btn-primary dm-btn-sm" onclick="ccNext()"><i class="fas fa-chart-bar"></i> See Results</button>
            </div>
        </div>

        
        <div class="cc-step" id="step-6">
            <div class="cc-step-hdr">
                <div class="cc-step-icon-box"><i class="fas fa-chart-bar"></i></div>
                <div>
                    <h2 class="cc-step-title">Your Cost Analysis</h2>
                    <p class="cc-step-desc" id="resultsDesc">India vs Europe &middot; <span class="year-tag">2025</span>-26 benchmarks</p>
                </div>
            </div>
            <div class="cc-step-body">

                <div class="cc-kpi-row">
                    <div class="cc-kpi india">
                        <div class="cc-kpi-label"><i class="fas fa-flag" style="color:#ff9933"></i> India Landed Cost</div>
                        <div class="cc-kpi-val" id="kpiIndia">&mdash;</div>
                        <div class="cc-kpi-sub" id="kpiIndiaEur">per unit (EUR)</div>
                    </div>
                    <div class="cc-kpi europe">
                        <div class="cc-kpi-label"><i class="fas fa-flag" style="color:#003399"></i> Europe Mfg Cost</div>
                        <div class="cc-kpi-val" id="kpiEurope">&mdash;</div>
                        <div class="cc-kpi-sub" id="kpiEuropeEur">per unit (EUR)</div>
                    </div>
                    <div class="cc-kpi savings" id="kpiSavingsCard">
                        <div class="cc-kpi-label"><i class="fas fa-piggy-bank"></i> Annual Savings</div>
                        <div class="cc-kpi-val" id="kpiSavings">&mdash;</div>
                        <div class="cc-kpi-sub" id="kpiSavingsSub">vs Europe manufacturing</div>
                    </div>
                </div>

                <div class="cc-insight" id="insightBanner">
                    <div class="cc-insight-ico">&#128161;</div>
                    <div class="cc-insight-text" id="insightText">Calculating...</div>
                </div>

                <div class="cc-charts">
                    <div class="cc-chart-box">
                        <div class="cc-chart-title"><i class="fas fa-chart-bar"></i> Cost Comparison</div>
                        <div class="cc-chart-body"><div class="cc-chart-wrap"><canvas id="comparisonChart"></canvas></div></div>
                    </div>
                    <div class="cc-chart-box">
                        <div class="cc-chart-title"><i class="fas fa-chart-pie"></i> India Cost Breakdown</div>
                        <div class="cc-chart-body"><div class="cc-chart-wrap"><canvas id="breakdownChart"></canvas></div></div>
                    </div>
                </div>

                
                <div class="cc-sens-card">
                    <div class="cc-sens-label"><i class="fas fa-sliders-h"></i> Volume Sensitivity (&plusmn;50%) &mdash; updates Annual Savings above</div>
                    <input type="range" class="cc-slider" id="sensitivitySlider" min="-50" max="50" value="0" step="5" oninput="updateSensitivity()">
                    <div class="cc-slider-marks"><span>&minus;50%</span><span>&minus;25%</span><span>Base</span><span>+25%</span><span>+50%</span></div>
                    <div class="cc-slider-val" id="sensitivityValue">0% (Base Volume)</div>
                    <div class="cc-slider-impact" id="sensitivityImpact">Adjust slider to see annual savings impact</div>
                </div>

                <div class="cc-breakdown-card" id="breakdownCard">
                    <div class="cc-breakdown-title"><i class="fas fa-table"></i> Detailed Cost Breakdown (per unit)</div>
                    <div class="cc-view-tabs no-print">
                        <button class="cc-view-tab active" id="tabUnitCost" onclick="switchTab('unit')">Unit Manufacturing Cost</button>
                        <button class="cc-view-tab" id="tabTCO" onclick="switchTab('tco')">Total Cost of Ownership (TCO)</button>
                    </div>
                    <div class="cc-tco-note" id="tcoNote">
                        <i class="fas fa-info-circle"></i> TCO view adds IGST cash-flow impact (if no Indian entity) and repatriation buffer. These do <strong>not</strong> affect the unit cost comparison above.
                    </div>
                    <div class="cc-tbl-scroll">
                        <table class="cc-tbl" id="breakdownTable">
                            <thead><tr>
                                <th style="width:44%">Line Item</th>
                                <th class="cc-nr">EUR / unit</th>
                                <th class="cc-nr">Annual (EUR)</th>
                                <th class="cc-pc">% of Total</th>
                            </tr></thead>
                            <tbody id="breakdownBody"></tbody>
                        </table>
                    </div>
                    <div class="cc-data-note">
                        Sources: State/Central Minimum Wage Notifications 2024-25 &middot; Eurostat NACE&nbsp;C 2024 &middot; Drewry WCI 2025-26 &middot; IATA 2025-26 &middot; CBIC Budget 2025-26 &middot;
                        <a href="https://icegate.gov.in" target="_blank" rel="noopener">icegate.gov.in</a> &middot;
                        IGST reclaimable as ITC for registered Indian entities. SWS = BCD &times; 10%, non-waivable.
                    </div>
                </div>

                
                <div class="cc-prime-card no-print" id="primeInsightsCard">
                    <div class="cc-prime-hdr">
                        <i class="fas fa-gem"></i> Prime Insights
                        <span class="cc-prime-badge">Personalised Analysis</span>
                    </div>
                    
                    <div class="cc-prime-teaser">
                        <div class="cc-prime-teaser-label"><i class="fas fa-bolt"></i> Your Cost Advantage at a Glance</div>
                        <div class="cc-prime-teaser-row">
                            India sourcing saves you approximately
                            <span class="cc-prime-teaser-val" id="primeTeaserPct">&mdash;</span>
                            vs <span id="primeTeaserCountry">Europe</span> &mdash; here's what drives it.
                        </div>
                    </div>
                    
                    <div class="cc-prime-locked-wrap">
                        <div class="cc-prime-content" id="primeInsightsContent">
                            <div class="cc-prime-item">
                                <div class="cc-prime-item-label"><i class="fas fa-trophy"></i> Biggest Cost Lever</div>
                                <div class="cc-prime-item-val" id="piLever">&mdash;</div>
                                <div class="cc-prime-item-sub" id="piLeverSub"></div>
                            </div>
                            <div class="cc-prime-item">
                                <div class="cc-prime-item-label"><i class="fas fa-calendar-check"></i> Break-even Horizon</div>
                                <div class="cc-prime-item-val" id="piBreakeven">&mdash;</div>
                                <div class="cc-prime-item-sub" id="piBreakevenSub"></div>
                            </div>
                            <div class="cc-prime-item">
                                <div class="cc-prime-item-label"><i class="fas fa-chart-line"></i> 3-Year Savings Potential</div>
                                <div class="cc-prime-item-val" id="pi3yr">&mdash;</div>
                                <div class="cc-prime-item-sub" id="pi3yrSub"></div>
                            </div>
                            <div class="cc-prime-item">
                                <div class="cc-prime-item-label"><i class="fas fa-shield-alt"></i> Risk-adjusted Verdict</div>
                                <div class="cc-prime-item-val" id="piVerdict">&mdash;</div>
                                <div class="cc-prime-item-sub" id="piVerdictSub"></div>
                            </div>
                        </div>
                        <div class="cc-prime-lock-overlay" id="primeLockOverlay">
                            <div class="cc-prime-lock-inner">
                                <i class="fas fa-lock"></i>
                                <p>Get your personalised sourcing roadmap — free</p>
                                <button class="cc-prime-unlock-btn" onclick="ccShowLeadGate()">
                                    <i class="fas fa-unlock-alt"></i> Unlock Full Insights
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="cc-step-footer">
                <button class="dm-btn-secondary dm-btn-sm" onclick="ccPrev()"><i class="fas fa-arrow-left"></i> Edit Inputs</button>
                <div style="display:flex;gap:0.5rem;flex-wrap:wrap">
                    <button class="dm-btn-secondary dm-btn-sm" onclick="ccGo(1)"><i class="fas fa-redo"></i> Recalculate</button>
                    <button class="dm-btn-primary dm-btn-sm" onclick="ccExportPdf()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                </div>
            </div>
        </div>

    </div>

    
    <div id="apiLogsWrap">
        <div class="cc-log-panel">
            <div class="cc-log-hdr">
                <div class="cc-log-title"><i class="fas fa-terminal"></i> Live API Call Log <span class="cc-log-count" id="logCount">0</span></div>
                <div style="display:flex;gap:0.4rem;flex-wrap:wrap">
                    <button style="background:#0c2340;color:#60a5fa;border:1px solid #1e3a5f;padding:0.22rem 0.55rem;border-radius:5px;font-size:0.68rem;cursor:pointer" onclick="fetchFreightOnly()"><i class="fas fa-ship"></i> Fetch Freight</button>
                    <button style="background:#0c2340;color:#60a5fa;border:1px solid #1e3a5f;padding:0.22rem 0.55rem;border-radius:5px;font-size:0.68rem;cursor:pointer" onclick="fetchDutyOnly()"><i class="fas fa-file-invoice-dollar"></i> Fetch Duty</button>
                    <button style="background:#1c0a0a;color:#f87171;border:1px solid #450a0a;padding:0.22rem 0.55rem;border-radius:5px;font-size:0.68rem;cursor:pointer" onclick="clearLogs()"><i class="fas fa-trash"></i> Clear</button>
                </div>
            </div>
            <div class="cc-log-scroll">
                <table class="cc-ltbl">
                    <thead><tr>
                        <th style="width:68px">Time</th><th style="width:50px">Method</th>
                        <th style="width:220px">API / Endpoint</th><th style="width:85px">Status</th>
                        <th>Details</th><th style="width:68px;text-align:right">Duration</th>
                    </tr></thead>
                    <tbody id="apiLogsBody"><tr><td colspan="6" class="cle">No API calls yet &mdash; click <strong style="color:#3b82f6;font-style:normal">Refresh Rates</strong> in the header.</td></tr></tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div style="text-align:center;padding:2rem 0 0.5rem">
        <p style="font-size:0.8rem;color:#64748b;margin-bottom:0.75rem">Need help interpreting these results for your specific product?</p>
        <a href="/contact" class="dm-btn-primary dm-btn-sm"><i class="fas fa-calendar-check"></i> Book a Discovery Call</a>
    </div>

</div>
</div>

</div>


<div id="ccLeadGate" style="display:none;position:fixed;inset:0;z-index:9500;background:rgba(15,23,42,0.72);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);align-items:center;justify-content:center;padding:1rem;">
    <div style="background:#fff;border-radius:16px;box-shadow:0 24px 60px rgba(0,0,0,0.22);width:100%;max-width:420px;overflow:hidden;animation:cc-step-in 0.25s ease;">
        
        <div style="background:var(--dm-brand-gradient,linear-gradient(135deg,#1b3c6b,#4a73c4));padding:1.5rem 1.75rem 1.25rem;">
            <div style="font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.55);margin-bottom:0.3rem;font-family:var(--tp-ff-onest,inherit)">Free — Instant Access</div>
            <h2 style="font-size:1.25rem;font-weight:800;color:#fff;margin:0;letter-spacing:-0.02em;font-family:var(--tp-ff-onest,inherit)">Unlock Your Prime Insights</h2>
            <p style="font-size:0.78rem;color:rgba(255,255,255,0.65);margin:0.35rem 0 0;line-height:1.45;">Get your personalised sourcing roadmap, break-even horizon, and risk-adjusted verdict.</p>
        </div>
        
        <div style="padding:1.5rem 1.75rem;">
            <div id="ccLeadError" style="display:none;font-size:0.78rem;color:#dc2626;background:#fef2f2;border:1px solid #fecaca;border-radius:6px;padding:0.5rem 0.75rem;margin-bottom:1rem;"></div>
            <div style="margin-bottom:0.875rem;">
                <label style="display:block;font-size:0.68rem;font-weight:700;color:#64748b;margin-bottom:0.28rem;text-transform:uppercase;letter-spacing:0.04em;">Full Name <span style="color:#dc2626">*</span></label>
                <input id="lgName" type="text" autocomplete="name"
                       style="width:100%;padding:0.55rem 0.75rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.875rem;font-family:inherit;color:#1e293b;background:#fafbfc;outline:none;transition:border-color 0.18s;"
                       onfocus="this.style.borderColor='#4a73c4'" onblur="this.style.borderColor='#e2e8f0'">
            </div>
            <div style="margin-bottom:0.875rem;">
                <label style="display:block;font-size:0.68rem;font-weight:700;color:#64748b;margin-bottom:0.28rem;text-transform:uppercase;letter-spacing:0.04em;">Work Email <span style="color:#dc2626">*</span></label>
                <input id="lgEmail" type="email" autocomplete="email"
                       style="width:100%;padding:0.55rem 0.75rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.875rem;font-family:inherit;color:#1e293b;background:#fafbfc;outline:none;transition:border-color 0.18s;"
                       onfocus="this.style.borderColor='#4a73c4'" onblur="this.style.borderColor='#e2e8f0'">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;margin-bottom:0.875rem;">
                <div>
                    <label style="display:block;font-size:0.68rem;font-weight:700;color:#64748b;margin-bottom:0.28rem;text-transform:uppercase;letter-spacing:0.04em;">Phone <span style="color:#dc2626">*</span></label>
                    <input id="lgPhone" type="tel" autocomplete="tel"
                           style="width:100%;padding:0.55rem 0.75rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.875rem;font-family:inherit;color:#1e293b;background:#fafbfc;outline:none;transition:border-color 0.18s;"
                           onfocus="this.style.borderColor='#4a73c4'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
                <div>
                    <label style="display:block;font-size:0.68rem;font-weight:700;color:#64748b;margin-bottom:0.28rem;text-transform:uppercase;letter-spacing:0.04em;">Company <span style="color:#dc2626">*</span></label>
                    <input id="lgCompany" type="text" autocomplete="organization"
                           style="width:100%;padding:0.55rem 0.75rem;border:1.5px solid #e2e8f0;border-radius:8px;font-size:0.875rem;font-family:inherit;color:#1e293b;background:#fafbfc;outline:none;transition:border-color 0.18s;"
                           onfocus="this.style.borderColor='#4a73c4'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
            </div>
            <button id="lgSubmitBtn" onclick="ccLeadSubmit()"
                    style="width:100%;padding:0.7rem;background:var(--dm-brand-gradient,linear-gradient(135deg,#1b3c6b,#4a73c4));color:#fff;border:none;border-radius:8px;font-size:0.875rem;font-weight:700;cursor:pointer;font-family:inherit;transition:opacity 0.18s;">
                <i class="fas fa-unlock-alt"></i> Unlock Full Insights
            </button>
            <p style="font-size:0.68rem;color:#94a3b8;text-align:center;margin:0.65rem 0 0;line-height:1.5;">
                We respect your privacy. No spam — just insights.
            </p>
        </div>
    </div>
</div>

<div class="cc-toasts" id="toastContainer"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
// ═══════════════════════════════════════════════════════════════════════════
// India vs Europe Cost Calculator — All 17 issues addressed
// ═══════════════════════════════════════════════════════════════════════════
const STEPS={1:'Sector & Geography',2:'Production',3:'Labour',4:'Logistics',5:'Assumptions',6:'Results'};
let currentStep=1, currentTab='unit', hasIndianEntity=false;
const TOTAL_STEPS=6;

// ── #17 FIX: dynamic year tag ──────────────────────────────────────────────
document.querySelectorAll('.year-tag').forEach(el=>el.textContent=new Date().getFullYear());

// ═══════════════════════════════════════════════════════════════════════════
// LOOKUP TABLES
// ═══════════════════════════════════════════════════════════════════════════
const LOOKUPS = {

    // #03 FIX — India labour rates in INR/hr, by region + grade (state notifications 2024-25)
    // Converted at runtime using live EUR/INR rate from Step 4
    indiaLabourINR: {
        "Central VDA":  { "Unskilled":97.88, "Semi-Skilled":117.5, "Skilled":131.25, "Skilled Metro":187.5, "Highly Skilled":312.5 },
        "Tamil Nadu":   { "Unskilled":108,   "Semi-Skilled":130,   "Skilled":162,    "Skilled Metro":194,   "Highly Skilled":281 },
        "Maharashtra":  { "Unskilled":112,   "Semi-Skilled":136,   "Skilled":170,    "Skilled Metro":204,   "Highly Skilled":306 },
        "Gujarat":      { "Unskilled":103,   "Semi-Skilled":124,   "Skilled":155,    "Skilled Metro":186,   "Highly Skilled":279 },
        "Karnataka":    { "Unskilled":110,   "Semi-Skilled":132,   "Skilled":165,    "Skilled Metro":204,   "Highly Skilled":300 },
        "Telangana":    { "Unskilled":105,   "Semi-Skilled":126,   "Skilled":158,    "Skilled Metro":189,   "Highly Skilled":278 },
        "Haryana":      { "Unskilled":114,   "Semi-Skilled":137,   "Skilled":171,    "Skilled Metro":205,   "Highly Skilled":308 },
        "Rajasthan":    { "Unskilled":100,   "Semi-Skilled":120,   "Skilled":150,    "Skilled Metro":180,   "Highly Skilled":270 }
    },

    // #04 FIX — Eurostat 2024 NACE C (Manufacturing sector) rates
    europeLabour: {
        "Germany":40.5,"Switzerland":65,"France":38.2,"Italy":29.4,
        "Netherlands":40.1,"Sweden":46.8,"Austria":43.2,"Belgium":44.1,
        "Spain":26.1,"Poland":13.8,"Denmark":49.3,"Finland":41,
        "Czech Republic":14.6,"Hungary":12.9,"Portugal":14.8
    },

    // #08 FIX — country-specific employer overhead % (social contributions)
    europeOverhead: {
        "Germany":21,"Switzerland":13,"France":45,"Italy":33,
        "Netherlands":18,"Sweden":31,"Austria":22,"Belgium":35,
        "Spain":32,"Poland":20,"Denmark":12,"Finland":24,
        "Czech Republic":34,"Hungary":28,"Portugal":24
    },

    // #06 FIX — Drewry WCI 2025-26; FCL rate computed dynamically from fill rate
    freight: { WCI_USD:2213, "SeaLCL":0.27, "Air":5.20, "Road":0.34 },
    EUR_USD_APPROX: 1.10,

    // #07 FIX — corrected BCD rates per CBIC 2025-26
    duty: {
        "8708":0.075,"8467":0.075,"8541":0.00,"6203":0.20,"3004":0.05,
        "9031":0.075,"2106":0.20,"9018":0.05,"2710":0.10,"3926":0.10,"7228":0.10
    },

    // #05 FIX — IGST rates by HS code
    igstRates: {
        "8708":28,"8467":18,"8541":18,"6203":12,"3004":12,
        "9031":18,"2106":18,"9018":12,"2710":18,"3926":18,"7228":18
    },

    // #02 FIX — India RM cost as % of Europe RM cost, by sector
    indiaMaterialFactor: {
        "Auto Components":0.82,"Industrial Machinery":0.78,"Electronics":0.88,
        "Textiles & Apparel":0.50,"Pharmaceuticals":0.70,"Precision Engineering":0.80,
        "Food Processing":0.75,"Medical Devices":0.85,"Chemicals":0.75,
        "Plastics & Rubber":0.72,"Steel & Metals":0.80
    },

    // #13 FIX — prod hours benchmarks
    prodHoursBenchmark: {
        "Auto Components":      {min:0.5, typical:2.0, max:8,  label:"0.5–8 hrs"},
        "Industrial Machinery": {min:2,   typical:6,   max:40, label:"2–40 hrs"},
        "Electronics":          {min:0.1, typical:1.5, max:6,  label:"0.1–6 hrs"},
        "Textiles & Apparel":   {min:0.1, typical:0.5, max:5,  label:"0.1–5 hrs"},
        "Pharmaceuticals":      {min:0.05,typical:0.3, max:4,  label:"0.05–4 hrs"},
        "Precision Engineering":{min:1,   typical:4,   max:30, label:"1–30 hrs"},
        "Food Processing":      {min:0.02,typical:0.2, max:2,  label:"0.02–2 hrs"},
        "Medical Devices":      {min:0.5, typical:3,   max:20, label:"0.5–20 hrs"},
        "Chemicals":            {min:0.01,typical:0.1, max:2,  label:"0.01–2 hrs"},
        "Plastics & Rubber":    {min:0.1, typical:0.5, max:4,  label:"0.1–4 hrs"},
        "Steel & Metals":       {min:0.2, typical:1.5, max:10, label:"0.2–10 hrs"}
    },

    sectorToHs: {
        "Auto Components":"8708","Industrial Machinery":"8467","Electronics":"8541",
        "Textiles & Apparel":"6203","Pharmaceuticals":"3004","Precision Engineering":"9031",
        "Food Processing":"2106","Medical Devices":"9018","Chemicals":"2710",
        "Plastics & Rubber":"3926","Steel & Metals":"7228"
    }
};

let compChart=null, donutChart=null, lastCalc=null, liveExchangeRate=null;
let apiLogs=[], logIdCounter=0;

// ── Lead gate (contact modal for Prime Insights + Export PDF) ──────────────
let ccLeadUnlocked = false;

function ccExportPdf() {
    if (ccLeadUnlocked) { window.print(); return; }
    ccShowLeadGate();
}

function ccShowLeadGate() {
    const gate = document.getElementById('ccLeadGate');
    gate.style.display = 'flex';
    setTimeout(() => document.getElementById('lgName').focus(), 120);
}

function ccHideLeadGate() {
    document.getElementById('ccLeadGate').style.display = 'none';
}

function ccUnlockPrimeInsights() {
    document.getElementById('primeInsightsCard').classList.add('unlocked');
    document.getElementById('primeLockOverlay').style.display = 'none';
    document.getElementById('primeInsightsCard').scrollIntoView({behavior:'smooth', block:'center'});
}

async function ccLeadSubmit() {
    const name    = document.getElementById('lgName').value.trim();
    const email   = document.getElementById('lgEmail').value.trim();
    const phone   = document.getElementById('lgPhone').value.trim();
    const company = document.getElementById('lgCompany').value.trim();
    const errEl   = document.getElementById('ccLeadError');
    const btn     = document.getElementById('lgSubmitBtn');

    errEl.style.display = 'none';
    if (!name || !email || !phone || !company) {
        errEl.textContent = 'All fields are required.';
        errEl.style.display = 'block';
        return;
    }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errEl.textContent = 'Please enter a valid email address.';
        errEl.style.display = 'block';
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';

    try {
        const res = await fetch('<?php echo e(route("cost-calculator.lead")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, email, phone, company }),
        });

        if (res.ok) {
            ccLeadUnlocked = true;
            ccHideLeadGate();
            ccUnlockPrimeInsights();
            ccGo(TOTAL_STEPS);
        } else {
            const data = await res.json().catch(() => ({}));
            errEl.textContent = data.message || 'Something went wrong. Please try again.';
            errEl.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-unlock-alt"></i> Unlock Full Insights';
        }
    } catch {
        errEl.textContent = 'Network error. Please check your connection and try again.';
        errEl.style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-unlock-alt"></i> Unlock Full Insights';
    }
}

// Close gate on backdrop click
document.getElementById('ccLeadGate').addEventListener('click', function(e) {
    if (e.target === this) ccHideLeadGate();
});

// ── Step navigation ────────────────────────────────────────────────────────
function ccGo(n) {
    if(n<1||n>TOTAL_STEPS) return;
    if(n===TOTAL_STEPS && !ccLeadUnlocked) { ccShowLeadGate(); return; }
    document.getElementById(`step-${currentStep}`).classList.remove('active');
    currentStep=n;
    document.getElementById(`step-${currentStep}`).classList.add('active');
    updateProgress();
    if(n===TOTAL_STEPS){
        document.getElementById('wizOuter').classList.add('is-results');
        calculate(); setTimeout(()=>{ renderCharts(lastCalc); renderPrimeInsights(lastCalc); },50);
    } else { document.getElementById('wizOuter').classList.remove('is-results'); }
    document.getElementById('wizOuter').scrollIntoView({behavior:'smooth',block:'start'});
}
function ccNext(){ccGo(currentStep+1)} function ccPrev(){ccGo(currentStep-1)}

function updateProgress(){
    const pct=(currentStep/TOTAL_STEPS*100).toFixed(2);
    document.getElementById('progressFill').style.width=pct+'%';
    document.getElementById('progressLabel').textContent=`Step ${currentStep} of ${TOTAL_STEPS}`;
    document.getElementById('progressName').textContent=STEPS[currentStep]||'';
    for(let i=1;i<=TOTAL_STEPS;i++){
        const d=document.getElementById(`sd${i}`),l=i<TOTAL_STEPS?document.getElementById(`sl${i}`):null;
        d.classList.remove('done','current');
        if(i<currentStep){d.classList.add('done');if(l)l.classList.add('done');}
        else if(i===currentStep){d.classList.add('current');if(l)l.classList.remove('done');}
        else{if(l)l.classList.remove('done');}
    }
}

// ── Formatters ─────────────────────────────────────────────────────────────
const fmtINR   = n=>'₹'+new Intl.NumberFormat('en-IN',{maximumFractionDigits:0}).format(n);
const fmtEUR   = n=>'€'+new Intl.NumberFormat('en-DE',{minimumFractionDigits:2,maximumFractionDigits:2}).format(n);
const fmtEURLg = n=>'€'+new Intl.NumberFormat('en-IN',{maximumFractionDigits:0}).format(n);
const fmtPct   = n=>(n*100).toFixed(1)+'%';

// ── Tab switcher ───────────────────────────────────────────────────────────
function switchTab(tab){
    currentTab=tab;
    document.getElementById('tabUnitCost').className='cc-view-tab'+(tab==='unit'?' active':'');
    document.getElementById('tabTCO').className='cc-view-tab'+(tab==='tco'?' active':'');
    document.getElementById('tcoNote').classList.toggle('show',tab==='tco');
    const card=document.getElementById('breakdownCard');
    tab==='tco'?card.classList.add('tco-mode'):card.classList.remove('tco-mode');
}

// ── Entity toggle (#05 FIX) ────────────────────────────────────────────────
function setEntity(v){
    hasIndianEntity=(v==='yes');
    document.getElementById('entityYes').classList.toggle('active',hasIndianEntity);
    document.getElementById('entityNo').classList.toggle('active',!hasIndianEntity);
    document.getElementById('entityHint').textContent=hasIndianEntity
        ?'With an Indian entity, IGST is recovered via Input Tax Credit (ITC) — effectively zero net import tax beyond BCD+SWS.'
        :'Without an Indian entity, IGST is a hard sunk cost included in your landed cost.';
    calculate();
}

// ── FCL logistics toggle (#06 FIX) ────────────────────────────────────────
function onLogisticsModeChange(){
    const mode=document.getElementById('logisticsMode').value;
    const isFCL=mode==='Sea';
    document.getElementById('fclRow').style.display=isFCL?'':'none';
    document.getElementById('fillRateFg').style.display=isFCL?'':'none';
    document.getElementById('nonFclWeightRow').style.display=isFCL?'none':'';
    calculate();
}

// ── Input handlers ─────────────────────────────────────────────────────────
function onCountryChange(){
    const c=document.getElementById('europeanCountry').value;
    document.getElementById('europeHourlyRate').value=(LOOKUPS.europeLabour[c]||40.5).toFixed(2);
    markOverride('europeHourlyRate',false);
    // #08 FIX: auto-set country-specific overhead
    document.getElementById('overheadPct').value=LOOKUPS.europeOverhead[c]||21;
    markOverride('overheadPct',false);
    calculate();
}

function onSectorChange(){
    const s=document.getElementById('sector').value;
    // Sync HS code
    const hs=LOOKUPS.sectorToHs[s]||'8708';
    const sel=document.getElementById('hsCode');
    for(let i=0;i<sel.options.length;i++) if(sel.options[i].value===hs){sel.selectedIndex=i;break;}
    onHsCodeChange();
    // #02 FIX: update India RM cost from sector factor
    const euroRM=parseFloat(document.getElementById('rawMaterialCost').value)||18.50;
    const factor=LOOKUPS.indiaMaterialFactor[s]||0.82;
    document.getElementById('indiaRawMaterialCost').value=(euroRM*factor).toFixed(2);
    const badge=document.getElementById('indiaMaterialBadge');
    if(badge) badge.textContent='benchmark '+(Math.round((1-factor)*100))+'% saving';
    const hint=document.getElementById('indiaMaterialHint');
    if(hint) hint.textContent='Sector default for '+s+'. Override with your actual India supplier quote.';
    updateMaterialSaving();
    // #13 FIX: benchmark hint
    updateProdHoursBenchmark();
    calculate();
}

function onHsCodeChange(){
    const hs=document.getElementById('hsCode').value;
    document.getElementById('dutyPct').value=((LOOKUPS.duty[hs]||0)*100).toFixed(1);
    markOverride('dutyPct',false);
    // #05 FIX: sync IGST rate
    const igstSel=document.getElementById('igstRate');
    const igstVal=LOOKUPS.igstRates[hs]||18;
    for(let i=0;i<igstSel.options.length;i++) if(parseInt(igstSel.options[i].value)===igstVal){igstSel.selectedIndex=i;break;}
    markOverride('igstRate',false);
    updateSWSDisplay();
    calculate();
}

// #03 FIX: region and grade drive INR-based lookup
function onRegionChange(){ onGradeChange(); }
function onGradeChange(){
    const region=document.getElementById('indiaRegion').value;
    const grade=document.getElementById('labourGrade').value;
    const rateINR=(LOOKUPS.indiaLabourINR[region]||LOOKUPS.indiaLabourINR["Central VDA"])[grade]||131;
    document.getElementById('indiaHourlyRateINR').value=rateINR;
    markOverride('indiaHourlyRateINR',false);
    updateIndiaRateEurHint(rateINR);
    calculate();
}

function updateIndiaRateEurHint(rateINR){
    const fx=parseFloat(document.getElementById('exchangeRate').value)||110.92;
    const eur=(rateINR/fx).toFixed(2);
    const span=document.getElementById('indiaRateEurCalc');
    if(span) span.textContent=eur;
}

// #02 FIX: derive material saving from two RM inputs
function onEuropeRMChange(){
    const euroRM=parseFloat(document.getElementById('rawMaterialCost').value)||0;
    const sector=document.getElementById('sector').value;
    const factor=LOOKUPS.indiaMaterialFactor[sector]||0.82;
    document.getElementById('indiaRawMaterialCost').value=(euroRM*factor).toFixed(2);
    updateMaterialSaving(); calculate();
}
function onIndiaRMChange(){ updateMaterialSaving(); calculate(); }
function updateMaterialSaving(){
    const euroRM=parseFloat(document.getElementById('rawMaterialCost').value)||0;
    const indiaRM=parseFloat(document.getElementById('indiaRawMaterialCost').value)||0;
    const savingPct=euroRM>0?((euroRM-indiaRM)/euroRM*100):0;
    const el=document.getElementById('materialSavingVal');
    if(el) el.textContent=(savingPct>=0?'+':'')+savingPct.toFixed(1)+'% saving';
}

// #05 FIX: SWS display
function updateSWSDisplay(){
    const bcd=parseFloat(document.getElementById('dutyPct').value)||0;
    const sws=(bcd*0.1).toFixed(2);
    const el=document.getElementById('swsDisplay');
    if(el) el.textContent=sws+'%';
}

function onProdHoursChange(){ updateProdHoursBenchmark(); calculate(); }
function updateProdHoursBenchmark(){
    const s=document.getElementById('sector').value;
    const h=parseFloat(document.getElementById('prodHours').value)||0;
    const b=LOOKUPS.prodHoursBenchmark[s];
    if(!b) return;
    const hintEl=document.getElementById('prodHoursBenchmarkHint');
    const warnEl=document.getElementById('prodHoursWarn');
    const badgeEl=document.getElementById('prodHoursBadge');
    if(hintEl) hintEl.textContent='Sector benchmark: '+b.label+' (typical ~'+b.typical+'h)';
    if(badgeEl) badgeEl.textContent='~'+b.typical+'h typical';
    if(warnEl){
        if(h>0&&(h<b.min*0.5||h>b.max*2)){
            warnEl.textContent='⚠ '+h+' hrs/unit is outside normal range for '+s+' ('+b.label+'). Please verify.';
            warnEl.classList.add('show');
        } else warnEl.classList.remove('show');
    }
}

function markOverride(id,active=true){
    const el=document.getElementById(id);
    if(el) el.classList.toggle('cc-overridden',active);
}
function resetRate()          { onGradeChange();    showToast('India rate reset to region/grade benchmark','success'); }
function resetEuropeRate()    { onCountryChange();  showToast('Europe rate reset to Eurostat NACE C 2024','success'); }
function resetEuropeOverhead(){ onCountryChange();  showToast('Overhead reset to country default','success'); }
function resetExchangeRate()  {
    document.getElementById('exchangeRate').value=(liveExchangeRate||110.92).toFixed(2);
    markOverride('exchangeRate',false); calculate();
    showToast('Rate reset to '+(liveExchangeRate?'live':'fallback')+' value','success');
}
function resetDuty()  { onHsCodeChange(); showToast('Duty reset to CBIC 2025-26','success'); }
function resetIGST()  { onHsCodeChange(); showToast('IGST reset to HS code default','success'); }

// ── Calculation engine ─────────────────────────────────────────────────────
function getFreightRate(){
    const mode=document.getElementById('logisticsMode').value;
    if(mode==='Sea'){
        const fillRate=(parseFloat(document.getElementById('containerFillRate').value)||65)/100;
        const kgFilled=26000*fillRate;
        const rate=LOOKUPS.freight.WCI_USD/kgFilled/LOOKUPS.EUR_USD_APPROX;
        const el=document.getElementById('calcFreightRate');
        if(el) el.textContent='€'+rate.toFixed(3)+'/kg';
        return rate;
    }
    const el=document.getElementById('calcFreightRate');
    if(el) el.textContent='per-kg rate';
    return LOOKUPS.freight[mode]||0.27;
}

function calculate(){
    const g=id=>parseFloat(document.getElementById(id)?.value)||0;
    const country       = document.getElementById('europeanCountry').value;
    const sector        = document.getElementById('sector').value;
    const annualVolume  = g('annualVolume');
    const unitsPerBatch = Math.max(g('unitsPerBatch')||1,1);
    const prodHours     = g('prodHours');
    const europeRM      = g('rawMaterialCost');
    const indiaRM       = g('indiaRawMaterialCost');
    const rateINR       = g('indiaHourlyRateINR');
    const europeHourly  = g('europeHourlyRate');
    const logMode       = document.getElementById('logisticsMode').value;
    const weight        = logMode==='Sea'?g('shipmentWeight'):g('shipmentWeightAlt')||g('shipmentWeight');
    const exchangeRate  = g('exchangeRate')||110.92;
    const indOH         = g('indiaOverheadPct')/100;
    const eurOH         = g('overheadPct')/100;
    const dutyPct       = g('dutyPct')/100;
    const igstRate      = parseInt(document.getElementById('igstRate')?.value||18)/100;
    const regPct        = g('regulatoryPct')/100;
    const enPct         = g('energyPct')/100;
    const repPct        = g('repatriationPct')/100;

    // #03 FIX: India labour converted at runtime from INR
    const indiaHourly   = rateINR/exchangeRate;
    updateIndiaRateEurHint(rateINR);

    const freightRate   = getFreightRate();
    updateSWSDisplay();

    // ── India ──
    const iL   = indiaHourly*prodHours;
    const iOH  = iL*indOH;
    const iMfg = iL+iOH+indiaRM;
    const log  = (weight*freightRate)/unitsPerBatch;
    const ins  = iMfg*0.005;
    const cif  = iMfg+log+ins;
    const bcd  = cif*dutyPct;
    const sws  = bcd*0.10;                           // #05 FIX: SWS = BCD × 10%
    const igstBase = cif+bcd+sws;
    const igstFull = igstBase*igstRate;
    const igstHard = hasIndianEntity?0:igstFull;     // #05 FIX: entity toggle
    const port = cif*0.01;
    const iT   = cif+bcd+sws+igstHard+port;         // #05 FIX: includes SWS; IGST only if no entity
    const rep  = iT*repPct;
    const iTCO = iT+rep+(hasIndianEntity?igstFull:0);

    // ── Europe ──
    const eL   = europeHourly*prodHours;
    const eOH  = eL*eurOH;
    const eMfg = eL+eOH+europeRM;
    const eReg = eMfg*regPct;
    const eEn  = eMfg*enPct;
    const eT   = eMfg+eReg+eEn;

    // ── Savings ──
    const savEur=eT-iT, savPct=eT>0?savEur/eT:0;
    const annSavEur=savEur*annualVolume;

    lastCalc={
        indiaLabourCost:iL, indiaOverheadCost:iOH, indiaMaterialCost:indiaRM, indiaManufCost:iMfg,
        logisticsCost:log, insurance:ins, cifValue:cif,
        importDuty:bcd, sws, igstFull, igstHard, portHandling:port,
        indiaTotalEur:iT, indiaTotalInr:iT*exchangeRate,
        repatriationCost:rep, indiaTCOEur:iTCO,
        europeLabourCost:eL, europeOverheadCost:eOH, europeMaterialCost:europeRM, europeManufCost:eMfg,
        europeRegulatory:eReg, europeEnergy:eEn, europeTotalEur:eT, europeTotalInr:eT*exchangeRate,
        savingsEur:savEur, savingsPct:savPct, annualSavingEur:annSavEur,
        exchangeRate, annualVolume, country, sector, dutyPct,
        hasIndianEntity, freightRate
    };
    if(currentStep===TOTAL_STEPS) updateUI(lastCalc);
    return lastCalc;
}

// ── UI update ──────────────────────────────────────────────────────────────
function updateUI(d){
    document.getElementById('kpiIndia').textContent    =fmtINR(d.indiaTotalInr);
    document.getElementById('kpiIndiaEur').textContent =fmtEUR(d.indiaTotalEur)+' / unit';
    document.getElementById('kpiEurope').textContent   =fmtINR(d.europeTotalInr);
    document.getElementById('kpiEuropeEur').textContent=fmtEUR(d.europeTotalEur)+' / unit';
    // #10 FIX: also call updateSensitivity to sync slider with KPI
    updateSensitivity();
    document.getElementById('kpiSavingsCard').className='cc-kpi '+(d.savingsEur>=0?'savings':'negative');
    document.getElementById('resultsDesc').textContent=`India vs ${d.country} · ${d.annualVolume.toLocaleString('en-IN')} units/yr · ${d.sector}`;

    const banner=document.getElementById('insightBanner'),iText=document.getElementById('insightText');
    if(d.savingsEur>0){
        banner.className='cc-insight';
        iText.textContent=`India is ${fmtPct(d.savingsPct)} cheaper than ${d.country} per unit. At ${d.annualVolume.toLocaleString('en-IN')} units/year → ${fmtEURLg(d.annualSavingEur)} (${fmtINR(d.annualSavingEur*d.exchangeRate)}) annual savings.`;
    } else {
        banner.className='cc-insight neg';
        iText.textContent=`India is ${fmtPct(-d.savingsPct)} more expensive than ${d.country} with current parameters. Review logistics, duty, labour grade.`;
    }
    renderBreakdownTable(d);
}

// ── #10 FIX: slider updates Annual Savings KPI ────────────────────────────
function updateSensitivity(){
    const pct=parseInt(document.getElementById('sensitivitySlider')?.value||0);
    const label=pct===0?'0% (Base Volume)':(pct>0?`+${pct}%`:`${pct}%`);
    document.getElementById('sensitivityValue').textContent=label;
    if(!lastCalc) return;
    const base=parseFloat(document.getElementById('annualVolume').value)||0;
    const adj=base*(1+pct/100);
    const annSav=lastCalc.savingsEur*adj;
    const annSavINR=annSav*lastCalc.exchangeRate;
    // Update Annual Savings KPI card
    document.getElementById('kpiSavings').textContent=fmtINR(annSavINR);
    document.getElementById('kpiSavingsSub').textContent=
        fmtPct(lastCalc.savingsPct)+' · '+adj.toLocaleString('en-IN',{maximumFractionDigits:0})+' units/yr'+(pct!==0?' (adjusted)':'');
    document.getElementById('sensitivityImpact').textContent=
        `${adj.toLocaleString('en-IN',{maximumFractionDigits:0})} units/yr → ${annSav>=0?'Savings':'Extra cost'}: ${fmtEURLg(Math.abs(annSav))} (${fmtINR(Math.abs(annSavINR))})`;
}

function renderBreakdownTable(d){
    const iT=d.indiaTotalEur,eT=d.europeTotalEur;
    const rp=parseFloat(document.getElementById('repatriationPct').value)||0;
    const igstLabel=d.hasIndianEntity
        ?'IGST (recoverable via ITC — not in landed cost)'
        :'IGST on import (no Indian entity — hard landed cost)';
    const rows=[
        {s:'🇮🇳  India — Landed Cost'},
        {l:'Labour Cost (INR converted at live FX)',  v:d.indiaLabourCost,   b:iT},
        {l:'Overhead & Facilities (India)',           v:d.indiaOverheadCost, b:iT},
        {l:'Raw Material (India local sourcing)',     v:d.indiaMaterialCost, b:iT},
        {l:'Manufacturing Sub-total',                 v:d.indiaManufCost,    b:iT, sub:1},
        {l:'Sea/Air/Road Freight',                    v:d.logisticsCost,     b:iT},
        {l:'Cargo Insurance (0.5%)',                 v:d.insurance,         b:iT},
        {l:'CIF Value (Duty Base = Mfg+Frt+Ins.)',   v:d.cifValue,          b:iT, sub:1},
        {l:`BCD (${(d.dutyPct*100).toFixed(1)}% of CIF)`, v:d.importDuty,  b:iT},
        {l:'SWS (BCD × 10%, non-waivable)',          v:d.sws,               b:iT},
        {l:igstLabel,                                 v:d.igstHard,          b:iT, igstRow:1},
        {l:'Port Handling + Inland (1% of CIF)',     v:d.portHandling,      b:iT},
        {l:'INDIA TOTAL LANDED COST / UNIT',         v:d.indiaTotalEur,     tot:1},
        {l:d.hasIndianEntity?'IGST (recovered as ITC — for TCO cash-flow awareness)':'',
            v:d.igstFull, tco:1, tcoOnly:1, skip:d.hasIndianEntity?false:true},
        {l:`Repatriation Buffer (${rp}%) — FX hedge/transfer pricing`, v:d.repatriationCost, tco:1, tcoOnly:1},
        {l:'India TCO / Unit',                        v:d.indiaTCOEur,      tcoT:1, tcoOnly:1},
        {s:'🇪🇺  Europe — Manufacturing Cost'},
        {l:'Labour Cost (Eurostat NACE C 2024)',      v:d.europeLabourCost,  b:eT},
        {l:'Overhead & Facilities (Europe)',          v:d.europeOverheadCost,b:eT},
        {l:'Raw Material (full cost, no India disc.)',v:d.europeMaterialCost,b:eT},
        {l:'Manufacturing Sub-total',                 v:d.europeManufCost,   b:eT, sub:1},
        {l:'EU Regulatory Compliance',                v:d.europeRegulatory,  b:eT},
        {l:'EU Energy Cost Premium',                  v:d.europeEnergy,      b:eT},
        {l:'EUROPE TOTAL MFG COST / UNIT',            v:d.europeTotalEur,    etot:1},
        {s:'💰  Savings Summary'},
        {l:'Saving per Unit (Europe − India)',        v:d.savingsEur,        sav:1},
        {l:`Annual Saving (${d.annualVolume.toLocaleString('en-IN')} units)`,v:d.annualSavingEur,sav:1,bold:1},
    ];
    const tb=document.getElementById('breakdownBody'); tb.innerHTML='';
    rows.forEach(r=>{
        if(r.skip) return;
        const tr=document.createElement('tr');
        if(r.tcoOnly) tr.classList.add('tco-only');
        if(r.s){
            tr.className=(tr.className+' sec').trim();
            tr.innerHTML=`<td colspan="4">${r.s}</td>`;
        } else {
            if(r.tot)   tr.classList.add('tot');
            else if(r.etot) tr.classList.add('etot');
            else if(r.tco||r.tcoT) tr.classList.add('tco');
            else if(r.igstRow) tr.classList.add('igst');
            const ps=(r.b&&r.b>0&&!r.tot&&!r.etot&&!r.sav&&!r.tco&&!r.tcoT&&!r.igstRow)?fmtPct(r.v/r.b):(r.sub&&r.b>0?fmtPct(r.v/r.b):'');
            const bld=r.tot||r.etot||r.sav||r.tcoT||r.bold;
            const nc='cc-nr'+(bld?' b':'');
            const col=r.sav?(r.v>=0?'color:#059669':'color:#dc2626'):'';
            const sg=r.sav&&r.v>=0?'+':'';
            const ann=r.sav?(sg+fmtEURLg(r.v*d.annualVolume)):(r.tco||r.tcoT?'—':fmtEURLg(r.v*d.annualVolume));
            tr.innerHTML=`<td>${r.l}</td><td class="${nc}" style="${col}">${sg}${fmtEUR(r.v)}</td><td class="${nc}" style="${col}">${ann}</td><td class="cc-pc">${ps}</td>`;
        }
        tb.appendChild(tr);
    });
}

function renderCharts(d){
    if(!d) return;
    const c1=document.getElementById('comparisonChart').getContext('2d');
    if(compChart) compChart.destroy();
    compChart=new Chart(c1,{type:'bar',data:{
        labels:['Labour','Overhead','Material','Logistics','Duty+SWS+IGST','Reg.+Energy'],
        datasets:[
            {label:'India', data:[d.indiaLabourCost,d.indiaOverheadCost,d.indiaMaterialCost,d.logisticsCost+d.insurance,d.importDuty+d.sws+d.igstHard+d.portHandling,0],backgroundColor:'#4a73c4',borderRadius:4},
            {label:'Europe',data:[d.europeLabourCost,d.europeOverheadCost,d.europeMaterialCost,0,0,d.europeRegulatory+d.europeEnergy],backgroundColor:'#7c3aed',borderRadius:4}
        ]},
        options:{responsive:true,maintainAspectRatio:false,
        plugins:{legend:{position:'top',labels:{font:{size:11},boxWidth:12}}},
        scales:{y:{beginAtZero:true,ticks:{callback:v=>'€'+v.toFixed(0),font:{size:10}},grid:{color:'#f8fafc'}},x:{grid:{display:false},ticks:{font:{size:10}}}}}
    });
    const c2=document.getElementById('breakdownChart').getContext('2d');
    if(donutChart) donutChart.destroy();
    donutChart=new Chart(c2,{type:'doughnut',data:{
        labels:['Labour','Overhead','Material','Logistics','BCD+SWS','IGST','Port'],
        datasets:[{data:[d.indiaLabourCost,d.indiaOverheadCost,d.indiaMaterialCost,d.logisticsCost+d.insurance,d.importDuty+d.sws,d.igstHard,d.portHandling],
            backgroundColor:['#4a73c4','#60a5fa','#93c5fd','#f59e0b','#ef4444','#f97316','#10b981'],hoverOffset:8,borderWidth:0}]},
        options:{responsive:true,maintainAspectRatio:false,cutout:'62%',
        plugins:{legend:{position:'bottom',labels:{font:{size:10},boxWidth:10,padding:8}},
            tooltip:{callbacks:{label:c=>`${c.label}: ${fmtEUR(c.raw)} (${((c.raw/d.indiaTotalEur)*100).toFixed(1)}%)`}}}}
    });
}

// ── Prime Insights population ──────────────────────────────────────────────
function renderPrimeInsights(d) {
    if (!d) return;

    // Teaser row
    document.getElementById('primeTeaserPct').textContent = fmtPct(Math.abs(d.savingsPct));
    document.getElementById('primeTeaserCountry').textContent = d.country;

    // ── Biggest Cost Lever ──────────────────────────────────────────────────
    const levers = [
        { label: 'Labour',    val: d.indiaLabourCost + d.indiaOverheadCost },
        { label: 'Materials', val: d.indiaMaterialCost },
        { label: 'Logistics', val: d.logisticsCost },
        { label: 'Duties',    val: d.importDuty + d.sws },
    ];
    levers.sort((a,b) => b.val - a.val);
    const topLever = levers[0];
    const leverPct = d.indiaTotalEur > 0 ? (topLever.val / d.indiaTotalEur) : 0;
    document.getElementById('piLever').textContent    = topLever.label;
    document.getElementById('piLeverSub').textContent = `${fmtEUR(topLever.val)} / unit · ${fmtPct(leverPct)} of India landed cost. Optimising ${topLever.label.toLowerCase()} yields the highest per-unit savings.`;

    // ── Break-even Horizon ──────────────────────────────────────────────────
    // Estimate: typical India market-entry cost €25k–€60k; use midpoint €40k
    const entryEst = 40000;
    const annSav   = d.annualSavingEur || (d.savingsEur * d.annualVolume);
    const months   = annSav > 0 ? Math.ceil((entryEst / annSav) * 12) : null;
    if (months !== null && months <= 48) {
        document.getElementById('piBreakeven').textContent = months <= 3 ? '< 3 months' : `~${months} months`;
        document.getElementById('piBreakevenSub').textContent = `Based on est. €${(entryEst/1000).toFixed(0)}k market-entry cost (entity setup + supplier qualification). Actual timeline varies.`;
    } else {
        document.getElementById('piBreakeven').textContent = annSav <= 0 ? 'N/A' : '4 + years';
        document.getElementById('piBreakevenSub').textContent = annSav <= 0
            ? 'Europe is competitive for this configuration.'
            : 'High entry cost relative to savings — reassess volume assumptions.';
    }

    // ── 3-Year Savings ──────────────────────────────────────────────────────
    const yr3 = annSav * 3;
    document.getElementById('pi3yr').textContent    = fmtEURLg(yr3);
    document.getElementById('pi3yrSub').textContent = yr3 > 0
        ? `At ${d.annualVolume.toLocaleString('en-IN')} units/yr over 3 years vs ${d.country} manufacturing — assuming stable FX and volume.`
        : `Europe manufacturing is cost-competitive for this volume and configuration.`;

    // ── Risk-adjusted Verdict ───────────────────────────────────────────────
    const savPct = d.savingsPct * 100;
    let verdict, verdictSub;
    if (savPct >= 30) {
        verdict    = 'Strong ✓';
        verdictSub = `${fmtPct(d.savingsPct)} cost advantage makes India a compelling sourcing hub for ${d.sector}. FX hedging recommended given EUR/INR exposure.`;
    } else if (savPct >= 15) {
        verdict    = 'Moderate ✓';
        verdictSub = `Viable sourcing case. Ensure logistics lead times and minimum order quantities are accounted for in your total landed cost model.`;
    } else if (savPct > 0) {
        verdict    = 'Marginal';
        verdictSub = `Thin margin of advantage. Consider increasing volume or negotiating better freight rates before committing to India sourcing.`;
    } else {
        verdict    = 'Not Recommended';
        verdictSub = `For this configuration, ${d.country} manufacturing is cost-competitive. Review HS code or logistics mode for a different outcome.`;
    }
    document.getElementById('piVerdict').textContent    = verdict;
    document.getElementById('piVerdictSub').textContent = verdictSub;
}

// ── API log engine ─────────────────────────────────────────────────────────
function startApiLog({method,api,endpoint,detail}){
    const id=++logIdCounter;
    apiLogs.unshift({id,timeStr:new Date().toTimeString().slice(0,8),method,api,endpoint,status:'PENDING',detail,durationMs:-1});
    if(apiLogs.length>100) apiLogs.pop();
    renderLogs(); document.getElementById('logCount').textContent=apiLogs.length; return id;
}
function finishApiLog(id,{status,detail,durationMs}){
    const l=apiLogs.find(x=>x.id===id);
    if(l){l.status=status;l.detail=detail;l.durationMs=durationMs;}
    renderLogs();
    const ok=apiLogs.filter(x=>x.status==='SUCCESS').length;
    const er=apiLogs.filter(x=>x.status==='ERROR').length;
    const fb=apiLogs.filter(x=>x.status==='FALLBACK').length;
    document.getElementById('apiStatusText').textContent=`${ok} OK · ${er} Err · ${fb} Fallback`;
}
function renderLogs(){
    const tb=document.getElementById('apiLogsBody');
    if(!apiLogs.length){tb.innerHTML='<tr><td colspan="6" class="cle">No API calls yet.</td></tr>';return;}
    const cm={SUCCESS:'cls-s',ERROR:'cls-e',FALLBACK:'cls-f',PENDING:'cls-p'};
    tb.innerHTML=apiLogs.map(l=>`<tr>
        <td class="clt">${l.timeStr}</td><td><span class="clb">${l.method}</span></td>
        <td class="cla">${l.api}<span class="clep">${l.endpoint}</span></td>
        <td class="${cm[l.status]||'cls-p'}">${l.status}</td><td class="cld">${l.detail}</td>
        <td class="cldr">${l.durationMs<0?'<span style="opacity:.3;animation:cc-pulse 1.2s infinite">…</span>':l.durationMs+'ms'}</td>
    </tr>`).join('');
}
function clearLogs(){apiLogs=[];logIdCounter=0;renderLogs();document.getElementById('logCount').textContent=0;}

// ── Exchange rate — proxied through Laravel backend (no CORS issues) ──────
// The controller tries Frankfurter then ExchangeRate-API server-to-server.
// Browser never touches external APIs directly → no "Failed to fetch" CORS errors.
async function fetchExchangeRateWithFallback(){
    const sEl=document.getElementById('apiStatus'); sEl.className='cc-api-pill loading';
    const s=Date.now();
    const id=startApiLog({method:'GET',api:'DevMantra FX API',endpoint:'/api/calculator/exchange-rate',detail:'Fetching live EUR/INR via backend (Frankfurter → ExchangeRate-API fallback)…'});
    try{
        const res=await fetch('/api/calculator/exchange-rate');
        if(!res.ok) throw new Error('HTTP '+res.status);
        const d=await res.json();
        const rate=d.rate;
        if(!rate||rate<50) throw new Error('Invalid rate in response');

        document.getElementById('exchangeRate').value=rate.toFixed(2);
        markOverride('exchangeRate',false);

        if(d.fallback){
            // Backend also failed — both external APIs unreachable server-side
            liveExchangeRate=null;
            const today=new Date().toLocaleDateString('en-GB',{day:'numeric',month:'short',year:'numeric'});
            document.getElementById('fallbackDate').textContent='last known as of '+today;
            document.getElementById('fallbackBanner').classList.add('visible');
            finishApiLog(id,{status:'FALLBACK',detail:`Backend APIs also failed. Using fallback ₹${rate} · source: ${d.source}`,durationMs:Date.now()-s});
            sEl.className='cc-api-pill offline';
            showToast(`Rate unavailable — using fallback ₹${rate}`,'warning');
        } else {
            liveExchangeRate=rate;
            document.getElementById('fallbackBanner').classList.remove('visible');
            finishApiLog(id,{status:'SUCCESS',detail:`1 EUR = ₹${rate.toFixed(4)} · date: ${d.date} · source: ${d.source}${d.cached?' (cached 30m)':''}`,durationMs:Date.now()-s});
            sEl.className='cc-api-pill online';
            showToast(`Live EUR/INR: ₹${rate.toFixed(2)} (${d.source})`,'success');
        }
        return rate;
    }catch(e){
        // Backend itself is unreachable (XAMPP not running, etc.)
        liveExchangeRate=null;
        document.getElementById('exchangeRate').value='110.92';
        markOverride('exchangeRate',false);
        const today=new Date().toLocaleDateString('en-GB',{day:'numeric',month:'short',year:'numeric'});
        document.getElementById('fallbackDate').textContent='last known as of '+today;
        document.getElementById('fallbackBanner').classList.add('visible');
        finishApiLog(id,{status:'ERROR',detail:`Backend unreachable: ${e.message}. Using fallback ₹110.92.`,durationMs:Date.now()-s});
        sEl.className='cc-api-pill offline';
        showToast('FX backend unreachable — using fallback ₹110.92','error');
        return 110.92;
    }
}

async function fetchFreightOnly(){
    const s=Date.now(),id=startApiLog({method:'GET',api:'DevMantra Freight API',endpoint:'/api/calculator/freight-rate',detail:'Fetching current Drewry WCI freight rates from backend…'});
    try{
        const res=await fetch('/api/calculator/freight-rate');
        if(!res.ok) throw new Error('HTTP '+res.status+' — backend may not be running');
        const d=await res.json();
        if(d.Sea)    LOOKUPS.freight.WCI_USD = d.Sea * 26000 * LOOKUPS.EUR_USD_APPROX; // back-convert to USD
        if(d.SeaLCL) LOOKUPS.freight.SeaLCL=d.SeaLCL;
        if(d.Air)    LOOKUPS.freight.Air=d.Air;
        if(d.Road)   LOOKUPS.freight.Road=d.Road;
        finishApiLog(id,{status:'SUCCESS',detail:`Sea FCL base €${d.Sea}/kg · LCL €${d.SeaLCL}/kg · Air €${d.Air}/kg · ${d.source||'backend'}`,durationMs:Date.now()-s});
        calculate(); showToast('Freight rates updated','success');
    }catch(e){
        finishApiLog(id,{status:'ERROR',detail:`${e.message}. Drewry WCI 2025-26 fallback in use.`,durationMs:Date.now()-s});
        showToast('Freight API unavailable — cached rates in use','error');
    }
}

async function fetchDutyOnly(){
    const hs=document.getElementById('hsCode').value;
    const s=Date.now(),id=startApiLog({method:'GET',api:'DevMantra Duty API',endpoint:`/api/calculator/duty-rate?hs_code=${hs}`,detail:`Fetching BCD + IGST + SWS for HS ${hs}…`});
    try{
        const res=await fetch(`/api/calculator/duty-rate?hs_code=${hs}`);
        if(!res.ok) throw new Error('HTTP '+res.status+' — backend may not be running');
        const d=await res.json();
        if(d.bcd_pct===undefined) throw new Error(d.error||'bcd_pct missing');
        LOOKUPS.duty[hs]=d.bcd_pct/100;
        document.getElementById('dutyPct').value=d.bcd_pct.toFixed(1);
        markOverride('dutyPct',false);
        if(d.igst_pct){
            const igstSel=document.getElementById('igstRate');
            for(let i=0;i<igstSel.options.length;i++) if(parseInt(igstSel.options[i].value)===d.igst_pct){igstSel.selectedIndex=i;break;}
            markOverride('igstRate',false);
        }
        updateSWSDisplay();
        finishApiLog(id,{status:'SUCCESS',detail:`HS ${hs}: BCD ${d.bcd_pct}% · SWS ${(d.bcd_pct*0.1).toFixed(2)}% · IGST ${d.igst_pct??18}% (ITC reclaimable) · ${d.source||'CBIC 2025-26'}`,durationMs:Date.now()-s});
        calculate(); showToast(`HS ${hs}: BCD ${d.bcd_pct}% + SWS + IGST loaded`,'success');
    }catch(e){
        const fb=(LOOKUPS.duty[hs]||0.075)*100;
        finishApiLog(id,{status:'ERROR',detail:`${e.message}. CBIC 2025-26 fallback: ${fb.toFixed(1)}% BCD.`,durationMs:Date.now()-s});
        showToast('Duty API unavailable — cached rates in use','error');
    }
}

async function refreshRates(){
    await fetchExchangeRateWithFallback();
    await fetchFreightOnly();
    await fetchDutyOnly();
    calculate();
}

function showToast(msg,type='info'){
    const c=document.getElementById('toastContainer'),t=document.createElement('div');
    t.className=`cc-toast ${type}`;
    const i={success:'check-circle',error:'exclamation-circle',warning:'exclamation-triangle'}[type]||'info-circle';
    t.innerHTML=`<i class="fas fa-${i}" style="flex-shrink:0"></i><span>${msg}</span><button class="cc-toast-x" onclick="this.parentElement.remove()">&#10005;</button>`;
    c.appendChild(t); setTimeout(()=>t.remove(),4500);
}

// ── Init ───────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded',()=>{
    onSectorChange();    // seeds all sector-linked defaults
    onCountryChange();   // seeds Europe rate + overhead
    calculate();
    refreshRates();
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\frontend\cost-calculator.blade.php ENDPATH**/ ?>