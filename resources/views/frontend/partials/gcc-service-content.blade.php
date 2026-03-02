@push('styles')
<style>
/* =============================================
   GCC SERVICE CONTENT — SCOPED STYLES
   All classes prefixed with gcc- to avoid conflicts
   ============================================= */

/* --- Shared helpers --- */
.gcc-section { font-family: var(--tp-ff-onest); }
.gcc-eyebrow {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #1b3c6b;
    background: rgba(27,60,107,0.08);
    padding: 6px 18px;
    border-radius: 20px;
    margin-bottom: 18px;
    font-family: var(--tp-ff-onest);
}
.gcc-eyebrow-light {
    display: inline-block;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.7);
    background: rgba(255,255,255,0.1);
    padding: 6px 18px;
    border-radius: 20px;
    margin-bottom: 18px;
    font-family: var(--tp-ff-onest);
}
.gcc-title {
    font-size: 40px;
    font-weight: 700;
    color: #111;
    line-height: 1.2;
    font-family: var(--tp-ff-onest);
    margin-bottom: 20px;
}
.gcc-title-white {
    font-size: 40px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    font-family: var(--tp-ff-onest);
    margin-bottom: 20px;
}
.gcc-subtitle {
    font-size: 17px;
    line-height: 1.8;
    color: rgba(0,0,0,0.65);
    font-family: var(--tp-ff-onest);
    margin-bottom: 0;
}
.gcc-subtitle-white {
    font-size: 17px;
    line-height: 1.8;
    color: rgba(255,255,255,0.7);
    font-family: var(--tp-ff-onest);
    margin-bottom: 0;
}
@media (max-width: 991px) { .gcc-title, .gcc-title-white { font-size: 32px; } }
@media (max-width: 575px) { .gcc-title, .gcc-title-white { font-size: 26px; } }

/* ==============================================
   SECTION 1 — MISSION STATEMENT
   ============================================== */
.gcc-mission-section {
    background: #fff;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-mission-section { padding: 70px 0; } }

.gcc-mission-text {
    font-size: 16px;
    line-height: 1.85;
    color: rgba(0,0,0,0.65);
    font-family: var(--tp-ff-onest);
    margin-bottom: 40px;
}
.gcc-stat-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-top: 40px;
}
@media (max-width: 575px) { .gcc-stat-grid { grid-template-columns: 1fr; } }

.gcc-stat-box {
    background: #f5f7fa;
    border-radius: 14px;
    padding: 24px 20px;
    text-align: center;
    border: 1px solid #e8ecf2;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.gcc-stat-box:hover {
    box-shadow: 0 12px 32px rgba(27,60,107,0.12);
    transform: translateY(-4px);
}
.gcc-stat-number {
    font-size: 28px;
    font-weight: 800;
    color: #1b3c6b;
    font-family: var(--tp-ff-onest);
    line-height: 1;
    margin-bottom: 6px;
}
.gcc-stat-label {
    font-size: 12px;
    font-weight: 600;
    color: rgba(0,0,0,0.5);
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-family: var(--tp-ff-onest);
}

/* Visual card stack */
.gcc-visual-stack {
    position: relative;
    height: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.gcc-stack-card {
    position: absolute;
    width: 100%;
    max-width: 360px;
    border-radius: 20px;
    padding: 28px 32px;
    font-family: var(--tp-ff-onest);
    transition: transform 0.4s ease;
}
.gcc-stack-card:nth-child(1) {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    transform: rotate(-4deg) translateY(40px);
    z-index: 1;
    opacity: 0.55;
}
.gcc-stack-card:nth-child(2) {
    background: linear-gradient(135deg, #2450a0, #5a84d4);
    transform: rotate(-2deg) translateY(20px);
    z-index: 2;
    opacity: 0.75;
}
.gcc-stack-card:nth-child(3) {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    transform: rotate(0deg);
    z-index: 3;
}
.gcc-visual-stack:hover .gcc-stack-card:nth-child(1) { transform: rotate(-6deg) translateY(60px); }
.gcc-visual-stack:hover .gcc-stack-card:nth-child(2) { transform: rotate(-3deg) translateY(30px); }
.gcc-stack-card-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.6);
    margin-bottom: 12px;
}
.gcc-stack-card-title {
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 16px;
}
.gcc-stack-card-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: rgba(255,255,255,0.85);
    font-size: 14px;
    margin-bottom: 8px;
}
.gcc-stack-card-item svg { flex-shrink: 0; }
@media (max-width: 991px) { .gcc-visual-stack { height: 360px; margin-top: 40px; } }
@media (max-width: 575px) { .gcc-visual-stack { height: 300px; } .gcc-stack-card { max-width: 280px; padding: 20px 22px; } }

/* ==============================================
   SECTION 2 — CPA FIRM REALITY
   ============================================== */
.gcc-pressure-section {
    background: #000;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-pressure-section { padding: 70px 0; } }

.gcc-pressure-intro {
    font-size: 18px;
    line-height: 1.8;
    color: rgba(255,255,255,0.65);
    font-family: var(--tp-ff-onest);
    max-width: 780px;
    margin: 0 auto 60px;
    text-align: center;
}
.gcc-pressure-heading {
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.4);
    margin-bottom: 32px;
    font-family: var(--tp-ff-onest);
}
.gcc-pressure-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 48px;
}
@media (max-width: 991px) { .gcc-pressure-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .gcc-pressure-grid { grid-template-columns: 1fr; } }

.gcc-pressure-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    padding: 28px 24px;
    transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}
.gcc-pressure-card:hover {
    background: rgba(255,255,255,0.07);
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.4);
}
.gcc-pressure-card-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}
.gcc-pressure-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 8px;
    font-family: var(--tp-ff-onest);
}
.gcc-pressure-card-desc {
    font-size: 14px;
    color: rgba(255,255,255,0.55);
    line-height: 1.7;
    font-family: var(--tp-ff-onest);
}
.gcc-old-model-banner {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,100,100,0.15);
    border-left: 4px solid rgba(255,100,100,0.4);
    border-radius: 12px;
    padding: 28px 32px;
    margin-bottom: 40px;
}
.gcc-old-model-banner p {
    font-size: 15px;
    color: rgba(255,255,255,0.65);
    line-height: 1.8;
    font-family: var(--tp-ff-onest);
    margin: 0;
}
.gcc-shift-box {
    background: linear-gradient(135deg, #1b3c6b, #2a5298);
    border-radius: 20px;
    padding: 48px 48px;
    text-align: center;
}
@media (max-width: 767px) { .gcc-shift-box { padding: 36px 28px; } }
.gcc-shift-label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: rgba(255,255,255,0.5);
    margin-bottom: 12px;
    font-family: var(--tp-ff-onest);
}
.gcc-shift-title {
    font-size: 26px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.gcc-shift-desc {
    font-size: 15px;
    color: rgba(255,255,255,0.7);
    line-height: 1.8;
    max-width: 640px;
    margin: 0 auto;
    font-family: var(--tp-ff-onest);
}

/* ==============================================
   SECTION 3 — THE DEV MANTRA GCC MODEL
   ============================================== */
.gcc-model-section {
    background: #f5f7fa;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-model-section { padding: 70px 0; } }

.gcc-model-intro {
    font-size: 17px;
    color: rgba(0,0,0,0.65);
    line-height: 1.8;
    font-family: var(--tp-ff-onest);
    margin-bottom: 36px;
}
.gcc-benefit-list {
    list-style: none;
    padding: 0;
    margin: 0 0 60px;
}
.gcc-benefit-list li {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    font-size: 15px;
    color: rgba(0,0,0,0.7);
    line-height: 1.75;
    font-family: var(--tp-ff-onest);
    padding: 12px 0;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}
.gcc-benefit-list li:last-child { border-bottom: none; }
.gcc-check-icon {
    width: 22px;
    height: 22px;
    min-width: 22px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 2px;
}

/* Three Layer Cards */
.gcc-layer-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
    position: relative;
}
@media (max-width: 991px) { .gcc-layer-cards { grid-template-columns: 1fr; } }

.gcc-layer-card {
    padding: 44px 36px;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}
.gcc-layer-card:hover { transform: scale(1.01); }
.gcc-layer-card--1 { background: #1b3c6b; }
.gcc-layer-card--2 { background: #2a5298; }
.gcc-layer-card--3 { background: #111; }
.gcc-layer-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(255,255,255,0.5);
    background: rgba(255,255,255,0.08);
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.gcc-layer-title {
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 8px;
    font-family: var(--tp-ff-onest);
}
.gcc-layer-subtitle {
    font-size: 13px;
    color: rgba(255,255,255,0.5);
    margin-bottom: 24px;
    font-family: var(--tp-ff-onest);
    font-style: italic;
}
.gcc-layer-items {
    list-style: none;
    padding: 0;
    margin: 0;
}
.gcc-layer-items li {
    font-size: 14px;
    color: rgba(255,255,255,0.75);
    line-height: 1.6;
    padding: 7px 0;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    font-family: var(--tp-ff-onest);
    display: flex;
    align-items: center;
    gap: 10px;
}
.gcc-layer-items li:last-child { border-bottom: none; }
.gcc-layer-items li::before {
    content: '';
    width: 5px;
    height: 5px;
    min-width: 5px;
    border-radius: 50%;
    background: rgba(255,255,255,0.4);
}
.gcc-layer-divider {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 1px;
    background: rgba(255,255,255,0.1);
}
@media (max-width: 991px) { .gcc-layer-divider { display: none; } }

/* ==============================================
   SECTION 4 — AUTOMATION-LED EXECUTION FRAMEWORK
   ============================================== */
.gcc-framework-section {
    background: #fff;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-framework-section { padding: 70px 0; } }

.gcc-framework-intro {
    font-size: 17px;
    color: rgba(0,0,0,0.65);
    line-height: 1.8;
    max-width: 760px;
    margin: 0 auto 64px;
    text-align: center;
    font-family: var(--tp-ff-onest);
}
.gcc-steps-timeline {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 0;
}
.gcc-steps-timeline::before {
    content: '';
    position: absolute;
    left: 31px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #1b3c6b, #4a73c4, #1b3c6b);
    opacity: 0.2;
}
@media (max-width: 575px) { .gcc-steps-timeline::before { left: 24px; } }

.gcc-step {
    display: flex;
    gap: 28px;
    padding: 32px 0;
    border-bottom: 1px solid #f0f0f0;
    position: relative;
    transition: background 0.3s ease;
}
.gcc-step:last-child { border-bottom: none; }
.gcc-step:hover { background: #fafbff; border-radius: 12px; padding-left: 16px; padding-right: 16px; }
.gcc-step-num {
    width: 64px;
    height: 64px;
    min-width: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 800;
    color: #fff;
    font-family: var(--tp-ff-onest);
    position: relative;
    z-index: 1;
}
@media (max-width: 575px) { .gcc-step-num { width: 48px; height: 48px; min-width: 48px; font-size: 17px; } }
.gcc-step-body { flex: 1; }
.gcc-step-title {
    font-size: 20px;
    font-weight: 700;
    color: #111;
    margin-bottom: 10px;
    font-family: var(--tp-ff-onest);
}
.gcc-step-desc {
    font-size: 15px;
    color: rgba(0,0,0,0.6);
    line-height: 1.8;
    margin-bottom: 12px;
    font-family: var(--tp-ff-onest);
}
.gcc-step-value {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #1b3c6b;
    background: rgba(27,60,107,0.06);
    padding: 6px 14px;
    border-radius: 20px;
    font-family: var(--tp-ff-onest);
}

/* Impact Table */
.gcc-impact-table-wrap {
    margin-top: 64px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 40px rgba(0,0,0,0.08);
}
.gcc-impact-table-header {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    padding: 24px 36px;
}
.gcc-impact-table-header h4 {
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    font-family: var(--tp-ff-onest);
    margin: 0;
}
.gcc-impact-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}
.gcc-impact-table th {
    padding: 16px 36px;
    text-align: left;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: rgba(0,0,0,0.4);
    border-bottom: 2px solid #f0f2f5;
    font-family: var(--tp-ff-onest);
}
.gcc-impact-table td {
    padding: 18px 36px;
    font-size: 15px;
    color: #222;
    border-bottom: 1px solid #f0f2f5;
    font-family: var(--tp-ff-onest);
    vertical-align: middle;
}
.gcc-impact-table tr:last-child td { border-bottom: none; }
.gcc-impact-table tr:hover td { background: #f8faff; }
.gcc-impact-table td:last-child { font-weight: 700; color: #1b3c6b; }
@media (max-width: 575px) {
    .gcc-impact-table th, .gcc-impact-table td { padding: 14px 16px; font-size: 13px; }
}

/* ==============================================
   SECTION 5 — WHAT GETS AUTOMATED
   ============================================== */
.gcc-automation-section {
    background: #0a0a0a;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-automation-section { padding: 70px 0; } }

.gcc-automation-title {
    font-size: 38px;
    font-weight: 700;
    color: #fff;
    text-align: center;
    margin-bottom: 56px;
    font-family: var(--tp-ff-onest);
    line-height: 1.25;
}
@media (max-width: 767px) { .gcc-automation-title { font-size: 26px; } }
.gcc-compare-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    max-width: 900px;
    margin: 0 auto;
}
@media (max-width: 767px) { .gcc-compare-grid { grid-template-columns: 1fr; } }
.gcc-compare-col {
    border-radius: 20px;
    overflow: hidden;
}
.gcc-compare-col-header {
    padding: 24px 32px;
    font-size: 15px;
    font-weight: 700;
    font-family: var(--tp-ff-onest);
}
.gcc-compare-col--auto .gcc-compare-col-header {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
}
.gcc-compare-col--human .gcc-compare-col-header {
    background: #1c1c1c;
    color: rgba(255,255,255,0.85);
}
.gcc-compare-col-body {
    padding: 8px 0;
}
.gcc-compare-col--auto .gcc-compare-col-body { background: rgba(27,60,107,0.12); }
.gcc-compare-col--human .gcc-compare-col-body { background: rgba(255,255,255,0.04); }
.gcc-compare-item {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 32px;
    font-size: 15px;
    font-family: var(--tp-ff-onest);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    transition: background 0.2s ease;
}
.gcc-compare-item:last-child { border-bottom: none; }
.gcc-compare-col--auto .gcc-compare-item { color: rgba(255,255,255,0.8); }
.gcc-compare-col--auto .gcc-compare-item:hover { background: rgba(74,115,196,0.1); }
.gcc-compare-col--human .gcc-compare-item { color: rgba(255,255,255,0.65); }
.gcc-compare-col--human .gcc-compare-item:hover { background: rgba(255,255,255,0.04); }
.gcc-compare-dot {
    width: 8px; height: 8px; min-width: 8px;
    border-radius: 50%;
}
.gcc-compare-col--auto .gcc-compare-dot { background: #4a73c4; }
.gcc-compare-col--human .gcc-compare-dot { background: rgba(255,255,255,0.3); }

/* ==============================================
   SECTION 6 — ENGAGEMENT MODELS
   ============================================== */
.gcc-engagement-section {
    background: #f5f7fa;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-engagement-section { padding: 70px 0; } }

.gcc-model-group-title {
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: rgba(0,0,0,0.35);
    margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
    padding-bottom: 14px;
    border-bottom: 1px solid #e0e4ea;
}
.gcc-engagement-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 60px;
}
@media (max-width: 1100px) { .gcc-engagement-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .gcc-engagement-grid { grid-template-columns: 1fr; } }

.gcc-engagement-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
@media (max-width: 991px) { .gcc-engagement-grid-3 { grid-template-columns: 1fr; } }

.gcc-eng-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px 28px;
    border: 1px solid #e8ecf2;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.gcc-eng-card:hover {
    box-shadow: 0 12px 40px rgba(27,60,107,0.1);
    transform: translateY(-6px);
}
.gcc-eng-card-tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #4a73c4;
    background: rgba(74,115,196,0.08);
    padding: 4px 12px;
    border-radius: 20px;
    margin-bottom: 16px;
    font-family: var(--tp-ff-onest);
}
.gcc-eng-card-title {
    font-size: 17px;
    font-weight: 700;
    color: #111;
    margin-bottom: 12px;
    font-family: var(--tp-ff-onest);
}
.gcc-eng-card-desc {
    font-size: 14px;
    color: rgba(0,0,0,0.6);
    line-height: 1.75;
    font-family: var(--tp-ff-onest);
    flex: 1;
    margin-bottom: 20px;
}
.gcc-eng-card-best {
    font-size: 13px;
    color: rgba(0,0,0,0.45);
    font-family: var(--tp-ff-onest);
    padding-top: 16px;
    border-top: 1px solid #f0f2f5;
}
.gcc-eng-card-best strong {
    color: #1b3c6b;
    font-weight: 700;
}
/* CPA specific cards */
.gcc-eng-card--cpa {
    border-top: 3px solid #1b3c6b;
}
.gcc-eng-card--cpa .gcc-eng-card-tag {
    color: #1b3c6b;
    background: rgba(27,60,107,0.07);
}

/* ==============================================
   SECTION 7 — KEY GCC PILLARS
   ============================================== */
.gcc-pillars-section {
    background: #fff;
    padding: 100px 0;
    position: relative;
}
.gcc-pillars-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(0,0,0,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.025) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
}
@media (max-width: 767px) { .gcc-pillars-section { padding: 70px 0; } }

.gcc-pillars-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    position: relative;
    z-index: 1;
}
@media (max-width: 1100px) { .gcc-pillars-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .gcc-pillars-grid { grid-template-columns: 1fr; } }

.gcc-pillar-card {
    background: #f9fafb;
    border-radius: 20px;
    padding: 40px 32px;
    border: 1px solid #e8ecf2;
    transition: box-shadow 0.3s ease, transform 0.3s ease, background 0.3s ease;
    position: relative;
    overflow: hidden;
}
.gcc-pillar-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #1b3c6b, #4a73c4);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.4s ease;
}
.gcc-pillar-card:hover {
    box-shadow: 0 20px 60px rgba(27,60,107,0.12);
    transform: translateY(-6px);
    background: #fff;
}
.gcc-pillar-card:hover::before { transform: scaleX(1); }
.gcc-pillar-icon {
    width: 54px;
    height: 54px;
    border-radius: 14px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 22px;
}
.gcc-pillar-title {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 20px;
    font-family: var(--tp-ff-onest);
}
.gcc-pillar-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.gcc-pillar-list li {
    font-size: 14px;
    color: rgba(0,0,0,0.62);
    line-height: 1.7;
    padding: 8px 0;
    border-bottom: 1px solid #f0f2f5;
    font-family: var(--tp-ff-onest);
    display: flex;
    align-items: flex-start;
    gap: 10px;
}
.gcc-pillar-list li:last-child { border-bottom: none; }
.gcc-pillar-list li::before {
    content: '';
    width: 5px; height: 5px; min-width: 5px;
    border-radius: 50%;
    background: #1b3c6b;
    margin-top: 8px;
}

/* ==============================================
   SECTION 8 — WHY TRUST US + STAND OUT
   ============================================== */
.gcc-trust-section {
    background: #f5f7fa;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-trust-section { padding: 70px 0; } }

.gcc-trust-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 72px;
}
@media (max-width: 991px) { .gcc-trust-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 575px) { .gcc-trust-grid { grid-template-columns: 1fr; } }

.gcc-trust-card {
    background: #fff;
    border-radius: 16px;
    padding: 28px 24px;
    border: 1px solid #e8ecf2;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.gcc-trust-card:hover {
    box-shadow: 0 10px 32px rgba(27,60,107,0.1);
    transform: translateY(-4px);
}
.gcc-trust-icon {
    width: 46px; height: 46px; min-width: 46px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex;
    align-items: center;
    justify-content: center;
}
.gcc-trust-info-title {
    font-size: 15px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
    font-family: var(--tp-ff-onest);
}
.gcc-trust-info-desc {
    font-size: 14px;
    color: rgba(0,0,0,0.55);
    line-height: 1.6;
    font-family: var(--tp-ff-onest);
}
.gcc-standout-title {
    font-size: 28px;
    font-weight: 700;
    color: #111;
    margin-bottom: 36px;
    font-family: var(--tp-ff-onest);
}
.gcc-standout-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}
@media (max-width: 767px) { .gcc-standout-grid { grid-template-columns: 1fr; } }
.gcc-standout-item {
    background: #fff;
    border-radius: 16px;
    padding: 28px 28px;
    border: 1px solid #e8ecf2;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.gcc-standout-item:hover {
    box-shadow: 0 8px 28px rgba(27,60,107,0.09);
    transform: translateY(-4px);
}
.gcc-standout-num {
    font-size: 28px;
    font-weight: 800;
    color: rgba(27,60,107,0.12);
    line-height: 1;
    min-width: 36px;
    font-family: var(--tp-ff-onest);
}
.gcc-standout-item-title {
    font-size: 15px;
    font-weight: 700;
    color: #111;
    margin-bottom: 6px;
    font-family: var(--tp-ff-onest);
}
.gcc-standout-item-desc {
    font-size: 14px;
    color: rgba(0,0,0,0.55);
    line-height: 1.7;
    font-family: var(--tp-ff-onest);
}

/* ==============================================
   SECTION 9 — MARKETS SERVED
   ============================================== */
.gcc-markets-section {
    background: #111;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-markets-section { padding: 70px 0; } }

.gcc-markets-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: center;
    margin-top: 48px;
}
.gcc-market-pill {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 40px;
    padding: 14px 28px;
    transition: background 0.3s ease, transform 0.3s ease, border-color 0.3s ease;
    cursor: default;
}
.gcc-market-pill:hover {
    background: rgba(74,115,196,0.15);
    border-color: rgba(74,115,196,0.4);
    transform: translateY(-3px);
}
.gcc-market-pill-flag {
    font-size: 22px;
    line-height: 1;
}
.gcc-market-pill-name {
    font-size: 15px;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    font-family: var(--tp-ff-onest);
}

/* ==============================================
   SECTION 10 — GOVERNANCE, SECURITY
   ============================================== */
.gcc-governance-section {
    background: #fff;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-governance-section { padding: 70px 0; } }

.gcc-gov-col-title {
    font-size: 18px;
    font-weight: 700;
    color: #111;
    margin-bottom: 28px;
    font-family: var(--tp-ff-onest);
    display: flex;
    align-items: center;
    gap: 12px;
}
.gcc-gov-col-icon {
    width: 38px; height: 38px;
    border-radius: 10px;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.gcc-gov-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.gcc-gov-list li {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    font-size: 15px;
    color: rgba(0,0,0,0.65);
    line-height: 1.75;
    padding: 14px 0;
    border-bottom: 1px solid #f0f2f5;
    font-family: var(--tp-ff-onest);
}
.gcc-gov-list li:last-child { border-bottom: none; }
.gcc-gov-list-dot {
    width: 8px; height: 8px; min-width: 8px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    margin-top: 7px;
}
.gcc-disclaimer-banner {
    margin-top: 60px;
    background: #f9fafb;
    border: 1px solid #e0e4ea;
    border-left: 4px solid #1b3c6b;
    border-radius: 12px;
    padding: 28px 36px;
}
.gcc-disclaimer-banner p {
    font-size: 14px;
    color: rgba(0,0,0,0.55);
    line-height: 1.8;
    font-family: var(--tp-ff-onest);
    margin: 0;
    font-style: italic;
}

/* ==============================================
   SECTION 11 — FAQ ACCORDION
   ============================================== */
.gcc-faq-section {
    background: #f5f7fa;
    padding: 100px 0;
}
@media (max-width: 767px) { .gcc-faq-section { padding: 70px 0; } }

.gcc-faq-list {
    max-width: 860px;
    margin: 56px auto 0;
}
.gcc-faq-item {
    background: #fff;
    border-radius: 14px;
    margin-bottom: 12px;
    border: 1px solid #e8ecf2;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}
.gcc-faq-item.is-open { box-shadow: 0 8px 32px rgba(27,60,107,0.1); }
.gcc-faq-question {
    width: 100%;
    background: none;
    border: none;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    cursor: pointer;
    text-align: left;
    font-size: 16px;
    font-weight: 700;
    color: #111;
    font-family: var(--tp-ff-onest);
    transition: color 0.2s ease;
}
.gcc-faq-question:hover { color: #1b3c6b; }
.gcc-faq-item.is-open .gcc-faq-question { color: #1b3c6b; }
.gcc-faq-chevron {
    width: 32px; height: 32px; min-width: 32px;
    border-radius: 50%;
    border: 1px solid #e0e4ea;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease, border-color 0.3s ease, transform 0.3s ease;
}
.gcc-faq-item.is-open .gcc-faq-chevron {
    background: #1b3c6b;
    border-color: #1b3c6b;
    transform: rotate(180deg);
}
.gcc-faq-item.is-open .gcc-faq-chevron svg { stroke: #fff; }
.gcc-faq-answer {
    display: none;
    padding: 0 28px 24px;
    font-size: 15px;
    color: rgba(0,0,0,0.62);
    line-height: 1.8;
    font-family: var(--tp-ff-onest);
}
.gcc-faq-answer.is-visible { display: block; }

/* ==============================================
   SECTION 12 — OTHER SERVICES
   ============================================== */
.gcc-services-section {
    background: #fff;
    padding: 80px 0 100px;
}
@media (max-width: 767px) { .gcc-services-section { padding: 60px 0; } }

.gcc-services-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
    margin-top: 40px;
}
.gcc-service-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #1b3c6b;
    background: #f0f4ff;
    border: 1px solid rgba(27,60,107,0.12);
    border-radius: 30px;
    padding: 12px 22px;
    text-decoration: none;
    font-family: var(--tp-ff-onest);
    transition: background 0.3s ease, color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
}
.gcc-service-pill:hover {
    background: linear-gradient(135deg, #1b3c6b, #4a73c4);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 6px 20px rgba(27,60,107,0.2);
    transform: translateY(-3px);
    text-decoration: none;
}
.gcc-service-pill svg { flex-shrink: 0; transition: transform 0.3s ease; }
.gcc-service-pill:hover svg { transform: translateX(3px); }

</style>
@endpush


{{-- ============================================================
     SECTION 1 — MISSION STATEMENT
     ============================================================ --}}
<section class="gcc-mission-section gcc-section">
    <div class="container container-1230">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="tp_fade_anim" data-delay=".3">
                    <span class="tp-section-subtitle-gradient ct">Global Capability Center</span>
                    <h2 class="tp-section-title-onest gcc-title" style="margin-top:16px;">Empower Your Business with GCC Services</h2>
                    <p class="gcc-mission-text">At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation. Our mission is to deliver top-notch global financial and management consulting services tailored to meet the unique needs of clients worldwide.</p>
                    <p class="gcc-mission-text" style="margin-bottom:0;">Our growth strategy goes beyond strengthening business processes and reporting. It expands into building new business synergies, verticals, geographies, and complementary partnerships across global markets. From daily bookkeeping to compliance, payroll, cost optimization, and investment readiness, our team ensures your financial backbone remains strong and scalable. Whether you are a fast-growing startup or an established enterprise, Dev Mantra's India-based capability centers give you the delivery infrastructure to operate at scale without the overhead.</p>
                    <div class="gcc-stat-grid tp_fade_anim" data-delay=".5">
                        <div class="gcc-stat-box">
                            <div class="gcc-stat-number" data-gcc-counter="60" data-gcc-prefix="" data-gcc-suffix="%">0%</div>
                            <div class="gcc-stat-label">Cost Advantage</div>
                        </div>
                        <div class="gcc-stat-box">
                            <div class="gcc-stat-number" data-gcc-counter="24" data-gcc-prefix="" data-gcc-suffix="hr">0hr</div>
                            <div class="gcc-stat-label">Audit Progression</div>
                        </div>
                        <div class="gcc-stat-box">
                            <div class="gcc-stat-number" data-gcc-counter="99" data-gcc-prefix="" data-gcc-suffix="%">0%</div>
                            <div class="gcc-stat-label">Documentation Accuracy</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="gcc-visual-stack tp_fade_anim" data-delay=".5">
                    <div class="gcc-stack-card">
                        <div class="gcc-stack-card-label">Layer 3</div>
                        <div class="gcc-stack-card-title">CPA Partner Oversight</div>
                        <div class="gcc-stack-card-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="6" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/><path d="M4.5 7l2 2 3-3" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Final Review &amp; Regulatory Sign-off
                        </div>
                        <div class="gcc-stack-card-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="6" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/><path d="M4.5 7l2 2 3-3" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Client Advisory &amp; Governance
                        </div>
                    </div>
                    <div class="gcc-stack-card">
                        <div class="gcc-stack-card-label">Layer 2</div>
                        <div class="gcc-stack-card-title">Expert Delivery Team</div>
                        <div class="gcc-stack-card-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="6" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/><path d="M4.5 7l2 2 3-3" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Audit Associates &amp; Tax Specialists
                        </div>
                        <div class="gcc-stack-card-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="6" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/><path d="M4.5 7l2 2 3-3" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Internal QA Reviewers
                        </div>
                    </div>
                    <div class="gcc-stack-card">
                        <div class="gcc-stack-card-label">Layer 1</div>
                        <div class="gcc-stack-card-title">Automation Engine</div>
                        <div class="gcc-stack-card-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="6" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/><path d="M4.5 7l2 2 3-3" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            AI-Based Audit Tools &amp; Orchestration
                        </div>
                        <div class="gcc-stack-card-item">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="6" stroke="rgba(255,255,255,0.5)" stroke-width="1.5"/><path d="M4.5 7l2 2 3-3" stroke="rgba(255,255,255,0.8)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Smart Document Management
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 2 — THE CPA FIRM REALITY
     ============================================================ --}}
<section class="gcc-pressure-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <span class="gcc-eyebrow-light">Built Specifically for U.S. CPA Firms</span>
            <h2 class="gcc-title-white" style="max-width:760px;margin:16px auto 24px;">The Profession Is Under Structural Pressure. We Built the Answer.</h2>
            <p class="gcc-pressure-intro">The U.S. CPA profession is navigating a period of sustained structural challenge. This is not a cyclical slowdown but a fundamental shift in how audit and advisory capacity must be sourced, managed, and governed.</p>
        </div>

        <p class="gcc-pressure-heading text-center tp_fade_anim" data-delay=".3">The Pressure Points</p>

        <div class="gcc-pressure-grid tp_fade_anim" data-delay=".4">
            <div class="gcc-pressure-card">
                <div class="gcc-pressure-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="gcc-pressure-card-title">CPA Talent Shortage Crisis</div>
                <div class="gcc-pressure-card-desc">Widespread talent scarcity creating structural capacity gaps across audit and advisory practices nationwide.</div>
            </div>
            <div class="gcc-pressure-card">
                <div class="gcc-pressure-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <div class="gcc-pressure-card-title">Rising Audit Complexity</div>
                <div class="gcc-pressure-card-desc">Manual processes slow delivery as audit scope and documentation standards increase each cycle.</div>
            </div>
            <div class="gcc-pressure-card">
                <div class="gcc-pressure-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="gcc-pressure-card-title">Increased PCAOB Scrutiny</div>
                <div class="gcc-pressure-card-desc">New and evolving regulatory requirements demanding higher documentation standards and defensibility.</div>
            </div>
            <div class="gcc-pressure-card">
                <div class="gcc-pressure-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div class="gcc-pressure-card-title">Margin Compression</div>
                <div class="gcc-pressure-card-desc">Rising cost per audit hour driven by domestic labor costs and inefficient delivery models.</div>
            </div>
            <div class="gcc-pressure-card">
                <div class="gcc-pressure-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                </div>
                <div class="gcc-pressure-card-title">Partner Burnout</div>
                <div class="gcc-pressure-card-desc">Seasonal hiring pressure every quarter strains partners and reduces capacity for strategic advisory work.</div>
            </div>
            <div class="gcc-pressure-card">
                <div class="gcc-pressure-card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
                </div>
                <div class="gcc-pressure-card-title">Staff Attrition 20&ndash;30%</div>
                <div class="gcc-pressure-card-desc">High annual attrition creating recurring capacity gaps and inconsistent engagement delivery quality.</div>
            </div>
        </div>

        <div class="gcc-old-model-banner tp_fade_anim" data-delay=".4">
            <p><strong style="color:rgba(255,180,180,0.9);">Traditional offshoring was never built to solve this.</strong> The old labor-arbitrage outsourcing model introduced new risks: weak audit documentation, limited regulatory alignment, and inadequate data security.</p>
        </div>

        <div class="gcc-shift-box tp_fade_anim" data-delay=".5">
            <div class="gcc-shift-label">The Shift</div>
            <div class="gcc-shift-title">From Labor Arbitrage to Automation-First Governance</div>
            <p class="gcc-shift-desc">The modern model is built around standardized digital workflows, AI-enabled audit documentation, secure cloud environments, structured QA layers, and risk-based documentation templates. Automation combined with governance creates audit defensibility.</p>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 3 — THE DEV MANTRA GCC MODEL
     ============================================================ --}}
<section class="gcc-model-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <span class="gcc-eyebrow">The Three-Layer GCC Structure</span>
            <h2 class="tp-section-title-onest gcc-title" style="margin-top:16px;">Scaling Audit and Advisory Through Automation and Expert Delivery</h2>
        </div>

        <div class="row g-5" style="margin-top:16px;">
            <div class="col-lg-5 tp_fade_anim" data-delay=".4">
                <p class="gcc-model-intro">Dev Mantra helps U.S. CPA firms address structural pressures by building India-based audit-grade capability teams that expand capacity without increasing domestic headcount.</p>
                <ul class="gcc-benefit-list">
                    <li>
                        <span class="gcc-check-icon"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        Through AI-enabled workflows, standardized documentation, and risk-based frameworks, the firm manages rising audit complexity
                    </li>
                    <li>
                        <span class="gcc-check-icon"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        Aligning governance and quality controls with PCAOB standards to withstand regulatory scrutiny
                    </li>
                    <li>
                        <span class="gcc-check-icon"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        The automation-first delivery model reduces cost per audit hour and improves turnaround time
                    </li>
                    <li>
                        <span class="gcc-check-icon"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        By taking on execution-heavy audit and compliance work, Dev Mantra frees partners to focus on advisory
                    </li>
                    <li>
                        <span class="gcc-check-icon"><svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 6l3 3 5-5" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        We move beyond traditional outsourcing toward a structured Global Capability Center model
                    </li>
                </ul>
            </div>
            <div class="col-lg-7 tp_fade_anim" data-delay=".5">
                <div class="gcc-layer-cards">
                    <div class="gcc-layer-card gcc-layer-card--1">
                        <div class="gcc-layer-divider"></div>
                        <div class="gcc-layer-badge">Layer 1 &mdash; Technology</div>
                        <div class="gcc-layer-title">Automation Engine</div>
                        <ul class="gcc-layer-items">
                            <li>AI-based audit tools</li>
                            <li>Workflow orchestration</li>
                            <li>Automated sampling</li>
                            <li>Smart document management</li>
                            <li>Exception tracking dashboards</li>
                        </ul>
                    </div>
                    <div class="gcc-layer-card gcc-layer-card--2">
                        <div class="gcc-layer-divider"></div>
                        <div class="gcc-layer-badge">Layer 2 &mdash; India</div>
                        <div class="gcc-layer-title">Expert Delivery Team</div>
                        <div class="gcc-layer-subtitle">Led by Dev Mantra with governance support from N. Tatia &amp; Associates</div>
                        <ul class="gcc-layer-items">
                            <li>Audit associates</li>
                            <li>Tax compliance specialists</li>
                            <li>Financial reporting analysts</li>
                            <li>Data and analytics team</li>
                            <li>Internal QA reviewers</li>
                        </ul>
                    </div>
                    <div class="gcc-layer-card gcc-layer-card--3">
                        <div class="gcc-layer-badge">Layer 3 &mdash; United States</div>
                        <div class="gcc-layer-title">CPA Partner Oversight</div>
                        <ul class="gcc-layer-items">
                            <li>Final review</li>
                            <li>Client advisory</li>
                            <li>Regulatory sign-off</li>
                            <li>PCAOB-aligned documentation review</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 4 — AUTOMATION-LED EXECUTION FRAMEWORK
     ============================================================ --}}
<section class="gcc-framework-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <span class="gcc-eyebrow">Our Automation-Led Execution Framework</span>
            <h2 class="tp-section-title-onest gcc-title" style="margin-top:16px;">Five Steps to Audit Excellence</h2>
            <p class="gcc-framework-intro">Our framework integrates intelligent workflows, AI-enabled audit tools, and standardized digital documentation to deliver accuracy, speed, and regulatory defensibility at scale. This enables 24-hour audit progression, improved engagement consistency, and alignment with U.S. regulatory expectations.</p>
        </div>

        <div class="gcc-steps-timeline tp_fade_anim" data-delay=".4">
            <div class="gcc-step">
                <div class="gcc-step-num">1</div>
                <div class="gcc-step-body">
                    <div class="gcc-step-title">Digital Intake and Workflow Orchestration</div>
                    <p class="gcc-step-desc">Standardized digital checklists and workflow engines automatically assign tasks, track evidence submission, monitor SLA compliance, and provide real-time audit dashboards.</p>
                    <span class="gcc-step-value">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        20&ndash;30% reduction in coordination time
                    </span>
                </div>
            </div>
            <div class="gcc-step">
                <div class="gcc-step-num">2</div>
                <div class="gcc-step-body">
                    <div class="gcc-step-title">AI-Enabled Audit Documentation</div>
                    <p class="gcc-step-desc">Automation tools generate lead schedules, perform trial balance mapping, execute smart sampling, flag exceptions, and index workpapers through AI.</p>
                    <span class="gcc-step-value">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Lower review notes, faster audit cycles, stronger defensibility
                    </span>
                </div>
            </div>
            <div class="gcc-step">
                <div class="gcc-step-num">3</div>
                <div class="gcc-step-body">
                    <div class="gcc-step-title">Secure Cloud Audit Environment</div>
                    <p class="gcc-step-desc">Role-based access control, encrypted document vaults, controlled client data rooms, and complete audit trails maintained at every stage of engagement delivery.</p>
                    <span class="gcc-step-value">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        PCAOB-ready documentation integrity
                    </span>
                </div>
            </div>
            <div class="gcc-step">
                <div class="gcc-step-num">4</div>
                <div class="gcc-step-body">
                    <div class="gcc-step-title">Structured QA and Governance Framework</div>
                    <p class="gcc-step-desc">With oversight from N. Tatia &amp; Associates: two-level India review, U.S. CPA-aligned templates, risk-based testing matrix, and engagement quality control checklists at every phase.</p>
                    <span class="gcc-step-value">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Reduced regulatory exposure
                    </span>
                </div>
            </div>
            <div class="gcc-step">
                <div class="gcc-step-num">5</div>
                <div class="gcc-step-body">
                    <div class="gcc-step-title">Advisory Enablement Layer</div>
                    <p class="gcc-step-desc">Automation reduces operational review time so CPA partners can focus on strategic advisory and client relationships — where their expertise creates the greatest value.</p>
                    <span class="gcc-step-value">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Higher partner bandwidth and improved client retention
                    </span>
                </div>
            </div>
        </div>

        <div class="gcc-impact-table-wrap tp_fade_anim" data-delay=".4">
            <div class="gcc-impact-table-header">
                <h4>Cumulative Impact</h4>
            </div>
            <div style="overflow-x:auto;">
                <table class="gcc-impact-table">
                    <thead>
                        <tr>
                            <th>Metric</th>
                            <th>Outcome</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Audit turnaround</td><td>25&ndash;40% faster</td></tr>
                        <tr><td>Cost efficiency</td><td>40&ndash;60% improvement</td></tr>
                        <tr><td>Cost per engagement</td><td>20&ndash;35% reduction</td></tr>
                        <tr><td>Work cycles</td><td>24-hour progression</td></tr>
                        <tr><td>Documentation accuracy</td><td>99%</td></tr>
                        <tr><td>Engagement capacity</td><td>50% increase</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 5 — WHAT GETS AUTOMATED
     ============================================================ --}}
<section class="gcc-automation-section gcc-section">
    <div class="container container-1230">
        <h2 class="gcc-automation-title tp_fade_anim" data-delay=".3">Automation Handles Execution.<br>Partners Handle Judgment.</h2>
        <div class="gcc-compare-grid tp_fade_anim" data-delay=".4">
            <div class="gcc-compare-col gcc-compare-col--auto">
                <div class="gcc-compare-col-header">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;vertical-align:middle;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Automated by Dev Mantra
                </div>
                <div class="gcc-compare-col-body">
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Data ingestion</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Workpaper preparation</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Reconciliations</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Tax computation</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Compliance checklists</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Audit trail documentation</div>
                </div>
            </div>
            <div class="gcc-compare-col gcc-compare-col--human">
                <div class="gcc-compare-col-header">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.7)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;vertical-align:middle;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Retained by CPA Partner
                </div>
                <div class="gcc-compare-col-body">
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Client relationship</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Risk judgment</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Audit opinion</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Strategic advisory</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Final sign-off</div>
                    <div class="gcc-compare-item"><div class="gcc-compare-dot"></div>Governance oversight</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 6 — ENGAGEMENT MODELS
     ============================================================ --}}
<section class="gcc-engagement-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <span class="gcc-eyebrow">Choose What Works for You</span>
            <h2 class="tp-section-title-onest gcc-title" style="margin-top:16px;">Engagement Models</h2>
            <p class="gcc-subtitle" style="max-width:620px;margin:0 auto 56px;">Select the right model based on your audit volume, seasonal demand, and long-term growth strategy.</p>
        </div>

        <p class="gcc-model-group-title tp_fade_anim" data-delay=".3">Standard Engagement Models</p>
        <div class="gcc-engagement-grid tp_fade_anim" data-delay=".4">
            <div class="gcc-eng-card">
                <span class="gcc-eng-card-tag">Model 1</span>
                <div class="gcc-eng-card-title">Process Outsourcing Model</div>
                <div class="gcc-eng-card-desc">Your finance and accounting operations are handled end-to-end by our team with defined SLAs, reporting frameworks, and quality controls.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> companies seeking a complete outsourced finance function.</div>
            </div>
            <div class="gcc-eng-card">
                <span class="gcc-eng-card-tag">Model 2</span>
                <div class="gcc-eng-card-title">Offshore Process Model</div>
                <div class="gcc-eng-card-desc">A dedicated offshore team in India works exclusively for your organization as an extension of your in-house finance function.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> companies wanting an embedded India team without setup complexity.</div>
            </div>
            <div class="gcc-eng-card">
                <span class="gcc-eng-card-tag">Model 3</span>
                <div class="gcc-eng-card-title">Job-by-Job Model</div>
                <div class="gcc-eng-card-desc">Specific financial tasks such as reconciliations, payroll, filings, or cleanup assignments are delivered on demand with full accountability.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> organizations with variable or project-based workloads.</div>
            </div>
            <div class="gcc-eng-card">
                <span class="gcc-eng-card-tag">Model 4</span>
                <div class="gcc-eng-card-title">Build-Operate-Transfer Model</div>
                <div class="gcc-eng-card-desc">Dev Mantra builds and operates a finance team in India and eventually transfers operational control to your organization.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> enterprises planning a long-term India presence.</div>
            </div>
        </div>

        <p class="gcc-model-group-title tp_fade_anim" data-delay=".3">CPA Firm-Specific Engagement Models</p>
        <div class="gcc-engagement-grid-3 tp_fade_anim" data-delay=".4">
            <div class="gcc-eng-card gcc-eng-card--cpa">
                <span class="gcc-eng-card-tag">Model A</span>
                <div class="gcc-eng-card-title">Dedicated GCC</div>
                <div class="gcc-eng-card-desc">A full India audit team with long-term engagement and customized automation stack built specifically around your firm's workflows and standards.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> firms with high-volume audit and compliance work.</div>
            </div>
            <div class="gcc-eng-card gcc-eng-card--cpa">
                <span class="gcc-eng-card-tag">Model B</span>
                <div class="gcc-eng-card-title">Hybrid Model</div>
                <div class="gcc-eng-card-desc">A core automation engine combined with seasonal scaling during peak audit periods — providing flexibility without permanent headcount commitments.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> firms with seasonal workloads.</div>
            </div>
            <div class="gcc-eng-card gcc-eng-card--cpa">
                <span class="gcc-eng-card-tag">Model C</span>
                <div class="gcc-eng-card-title">Managed Automation Service</div>
                <div class="gcc-eng-card-desc">Automation architecture and workflow modernization without a full team build — ideal for firms ready to modernize before committing to a full GCC structure.</div>
                <div class="gcc-eng-card-best"><strong>Best for:</strong> firms modernizing processes before committing to a full GCC.</div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 7 — KEY GCC PILLARS
     ============================================================ --}}
<section class="gcc-pillars-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <span class="gcc-eyebrow">What Makes Our GCC Model Work</span>
            <h2 class="tp-section-title-onest gcc-title" style="margin-top:16px;margin-bottom:56px;">Key GCC Pillars</h2>
        </div>
        <div class="gcc-pillars-grid tp_fade_anim" data-delay=".4">
            <div class="gcc-pillar-card">
                <div class="gcc-pillar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div class="gcc-pillar-title">Automation-First Delivery</div>
                <ul class="gcc-pillar-list">
                    <li>AI-enabled audit workflows</li>
                    <li>24-hour audit cycle capability</li>
                    <li>AI-enabled documentation and testing</li>
                    <li>Structured QA and defensible audit framework</li>
                </ul>
            </div>
            <div class="gcc-pillar-card">
                <div class="gcc-pillar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="gcc-pillar-title">Talent Advantage</div>
                <ul class="gcc-pillar-list">
                    <li>Strong US GAAP and IFRS knowledge</li>
                    <li>High English fluency across teams</li>
                    <li>Dedicated specialized pods</li>
                    <li>Deep and trained delivery workforce</li>
                </ul>
            </div>
            <div class="gcc-pillar-card">
                <div class="gcc-pillar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                </div>
                <div class="gcc-pillar-title">Infrastructure Strength</div>
                <ul class="gcc-pillar-list">
                    <li>Mature IT ecosystem and cybersecurity frameworks</li>
                    <li>Secure cloud adoption maturity</li>
                    <li>SOC 2 compliant infrastructure</li>
                    <li>Role-based access and encrypted document environments</li>
                </ul>
            </div>
            <div class="gcc-pillar-card">
                <div class="gcc-pillar-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div class="gcc-pillar-title">Cost Advantage</div>
                <ul class="gcc-pillar-list">
                    <li>40&ndash;60% cost advantage versus U.S. domestic delivery</li>
                    <li>India-based expert teams</li>
                    <li>No domestic overhead</li>
                    <li>Scalable engagement structures</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 8 — WHY TRUST US + STAND OUT
     ============================================================ --}}
<section class="gcc-trust-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <h2 class="tp-section-title-onest gcc-title" style="margin-bottom:40px;">Why Trust Us</h2>
        </div>
        <div class="gcc-trust-grid tp_fade_anim" data-delay=".4">
            <div class="gcc-trust-card">
                <div class="gcc-trust-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div>
                    <div class="gcc-trust-info-title">Accuracy</div>
                    <div class="gcc-trust-info-desc">Three-level quality checks ensuring near-perfect documentation at every engagement stage.</div>
                </div>
            </div>
            <div class="gcc-trust-card">
                <div class="gcc-trust-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
                <div>
                    <div class="gcc-trust-info-title">Industry Tools</div>
                    <div class="gcc-trust-info-desc">Xero, QuickBooks, Tally, Zoho, SAP and all major audit and accounting platforms.</div>
                </div>
            </div>
            <div class="gcc-trust-card">
                <div class="gcc-trust-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <div class="gcc-trust-info-title">Cost-Effective</div>
                    <div class="gcc-trust-info-desc">50&ndash;70% savings versus domestic delivery without sacrificing quality or governance standards.</div>
                </div>
            </div>
            <div class="gcc-trust-card">
                <div class="gcc-trust-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div>
                    <div class="gcc-trust-info-title">Secure</div>
                    <div class="gcc-trust-info-desc">NDA protection and encrypted file exchange for every client engagement and data transfer.</div>
                </div>
            </div>
            <div class="gcc-trust-card">
                <div class="gcc-trust-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <div class="gcc-trust-info-title">Time-zone Aligned</div>
                    <div class="gcc-trust-info-desc">Serving US, UK, Australia, UAE, and Southeast Asia markets with overlap-friendly delivery windows.</div>
                </div>
            </div>
            <div class="gcc-trust-card">
                <div class="gcc-trust-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                </div>
                <div>
                    <div class="gcc-trust-info-title">Scalable</div>
                    <div class="gcc-trust-info-desc">From 10 to 10,000 transactions per month &mdash; our delivery infrastructure scales with your business.</div>
                </div>
            </div>
        </div>

        <div class="tp_fade_anim" data-delay=".4">
            <div class="gcc-standout-title">Why Dev Mantra GCC Services Stand Out</div>
            <div class="gcc-standout-grid">
                <div class="gcc-standout-item">
                    <div class="gcc-standout-num">01</div>
                    <div>
                        <div class="gcc-standout-item-title">Local Expertise with a Global Perspective</div>
                        <div class="gcc-standout-item-desc">Deep knowledge of the Indian market combined with a global strategic outlook that anticipates cross-border regulatory and commercial requirements.</div>
                    </div>
                </div>
                <div class="gcc-standout-item">
                    <div class="gcc-standout-num">02</div>
                    <div>
                        <div class="gcc-standout-item-title">Comprehensive Support Across All Stages</div>
                        <div class="gcc-standout-item-desc">From market entry to long-term expansion &mdash; Dev Mantra provides end-to-end support across every phase of your growth journey.</div>
                    </div>
                </div>
                <div class="gcc-standout-item">
                    <div class="gcc-standout-num">03</div>
                    <div>
                        <div class="gcc-standout-item-title">Tailored Solutions for Unique Business Needs</div>
                        <div class="gcc-standout-item-desc">Every engagement is customized to your firm's structure, volume, regulatory exposure, and long-term capability goals.</div>
                    </div>
                </div>
                <div class="gcc-standout-item">
                    <div class="gcc-standout-num">04</div>
                    <div>
                        <div class="gcc-standout-item-title">Strong Network and Proven Track Record</div>
                        <div class="gcc-standout-item-desc">A strong regional network and consistent project success across diverse industries and jurisdictions speaks to our delivery reliability.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 9 — MARKETS SERVED
     ============================================================ --}}
<section class="gcc-markets-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <h2 class="gcc-title-white" style="margin-bottom:0;">Markets Served</h2>
            <div class="gcc-markets-grid tp_fade_anim" data-delay=".4">
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127482;&#127480;</span>
                    <span class="gcc-market-pill-name">USA</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127466;&#127482;</span>
                    <span class="gcc-market-pill-name">Europe</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127472;&#127479;</span>
                    <span class="gcc-market-pill-name">Korea</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127471;&#127477;</span>
                    <span class="gcc-market-pill-name">Japan</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127480;&#127468;</span>
                    <span class="gcc-market-pill-name">Singapore</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127462;&#127466;</span>
                    <span class="gcc-market-pill-name">Dubai</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127462;&#127466;</span>
                    <span class="gcc-market-pill-name">Abu Dhabi</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127462;&#127482;</span>
                    <span class="gcc-market-pill-name">Australia</span>
                </div>
                <div class="gcc-market-pill">
                    <span class="gcc-market-pill-flag">&#127475;&#127487;</span>
                    <span class="gcc-market-pill-name">New Zealand</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 10 — GOVERNANCE, SECURITY AND AUDIT DEFENSIBILITY
     ============================================================ --}}
<section class="gcc-governance-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <h2 class="tp-section-title-onest gcc-title" style="margin-bottom:56px;">Governance, Security and Audit Defensibility</h2>
        </div>
        <div class="row g-5 tp_fade_anim" data-delay=".4">
            <div class="col-lg-6">
                <div class="gcc-gov-col-title">
                    <span class="gcc-gov-col-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </span>
                    Security Framework
                </div>
                <ul class="gcc-gov-list">
                    <li><span class="gcc-gov-list-dot"></span>SOC 2 compliant infrastructure across all delivery environments</li>
                    <li><span class="gcc-gov-list-dot"></span>Role-based access control with granular permission management</li>
                    <li><span class="gcc-gov-list-dot"></span>Encrypted document environments and secure client data rooms</li>
                    <li><span class="gcc-gov-list-dot"></span>Full audit logs and traceability at every stage of engagement delivery</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="gcc-gov-col-title">
                    <span class="gcc-gov-col-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </span>
                    Regulatory Alignment
                </div>
                <ul class="gcc-gov-list">
                    <li><span class="gcc-gov-list-dot"></span>PCAOB documentation standards aligned at every workpaper level</li>
                    <li><span class="gcc-gov-list-dot"></span>AICPA peer review readiness built into engagement quality controls</li>
                    <li><span class="gcc-gov-list-dot"></span>Engagement quality control checklists reviewed by N. Tatia &amp; Associates</li>
                    <li><span class="gcc-gov-list-dot"></span>Risk-based documentation templates for defensible audit evidence</li>
                </ul>
            </div>
        </div>
        <div class="gcc-disclaimer-banner tp_fade_anim" data-delay=".4">
            <p>Dev Mantra Financial Services Pvt. Ltd. and N. Tatia &amp; Associates do not offer traditional outsourcing. We build automation-led audit capability centers, governance-aligned compliance engines, and structured GCC models for U.S. CPA firms. We do not replace CPA judgment. We enhance CPA capacity.</p>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 11 — FAQ ACCORDION
     ============================================================ --}}
<section class="gcc-faq-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <span class="gcc-eyebrow">Frequently Asked Questions</span>
            <h2 class="tp-section-title-onest gcc-title" style="margin-top:16px;">Any Questions? We&#39;ve Got You.</h2>
        </div>
        <div class="gcc-faq-list tp_fade_anim" data-delay=".4">
            <div class="gcc-faq-item">
                <button class="gcc-faq-question" aria-expanded="false">
                    What finance and accounting services does Dev Mantra offer through its GCC model?
                    <span class="gcc-faq-chevron">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div class="gcc-faq-answer">Dev Mantra provides outsourced accounting, bookkeeping, financial reporting, audit support, tax compliance, payroll, virtual CFO services, and M&amp;A support delivered through a structured India-based capability center.</div>
            </div>
            <div class="gcc-faq-item">
                <button class="gcc-faq-question" aria-expanded="false">
                    How does Dev Mantra ensure data security and confidentiality?
                    <span class="gcc-faq-chevron">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div class="gcc-faq-answer">All engagements operate under NDAs. Infrastructure follows SOC 2 security standards with role-based access control, encrypted document vaults, and full audit trails aligned with ISO 27001, HIPAA, and PCAOB documentation practices.</div>
            </div>
            <div class="gcc-faq-item">
                <button class="gcc-faq-question" aria-expanded="false">
                    What is the cost advantage of using Dev Mantra&#39;s GCC?
                    <span class="gcc-faq-chevron">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div class="gcc-faq-answer">Clients typically see a 40&ndash;60 percent cost advantage compared to U.S. domestic delivery and up to 70 percent savings across finance and accounting operations.</div>
            </div>
            <div class="gcc-faq-item">
                <button class="gcc-faq-question" aria-expanded="false">
                    How does Dev Mantra handle regulatory compliance for U.S. CPA firms?
                    <span class="gcc-faq-chevron">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div class="gcc-faq-answer">The delivery model aligns with PCAOB standards, AICPA peer review requirements, SOX and SOC frameworks, and GAAP-aligned documentation with governance oversight from N. Tatia &amp; Associates.</div>
            </div>
            <div class="gcc-faq-item">
                <button class="gcc-faq-question" aria-expanded="false">
                    Which engagement model is right for our firm?
                    <span class="gcc-faq-chevron">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#111" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </span>
                </button>
                <div class="gcc-faq-answer">The correct model depends on audit volume, seasonal demand, and long-term strategy. Dev Mantra offers four standard models and three CPA-specific GCC models to fit different operational structures.</div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================
     SECTION 12 — OTHER SERVICES
     ============================================================ --}}
<section class="gcc-services-section gcc-section">
    <div class="container container-1230">
        <div class="text-center tp_fade_anim" data-delay=".3">
            <h2 class="tp-section-title-onest gcc-title" style="margin-bottom:8px;">Explore Our Other Services</h2>
            <p class="gcc-subtitle" style="max-width:560px;margin:0 auto;">Comprehensive financial, advisory, and governance solutions for every stage of your business.</p>
        </div>
        <div class="gcc-services-pills tp_fade_anim" data-delay=".4">
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                Finance Accounts Compliance Outsourcing
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                Deals, Due Diligence and Transaction Advisory
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                Risk Advisory and Augmenting Business Process
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                IPO Advisory Services
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                Virtual CFO Services
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                M&amp;A Advisory Services
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                Business Setup and Startup Collaboration
            </a>
            <a href="{{ route('home') }}#services" class="gcc-service-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                Corporate Governance
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function() {
    'use strict';

    /* -------------------------------------------------------
       FAQ ACCORDION
    ------------------------------------------------------- */
    var faqItems = document.querySelectorAll('.gcc-faq-item');
    faqItems.forEach(function(item) {
        var btn = item.querySelector('.gcc-faq-question');
        var answer = item.querySelector('.gcc-faq-answer');
        if (!btn || !answer) return;
        btn.addEventListener('click', function() {
            var isOpen = item.classList.contains('is-open');
            // Close all
            faqItems.forEach(function(i) {
                i.classList.remove('is-open');
                var a = i.querySelector('.gcc-faq-answer');
                var b = i.querySelector('.gcc-faq-question');
                if (a) a.classList.remove('is-visible');
                if (b) b.setAttribute('aria-expanded', 'false');
            });
            // Open clicked (if was closed)
            if (!isOpen) {
                item.classList.add('is-open');
                answer.classList.add('is-visible');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    /* -------------------------------------------------------
       COUNTER ANIMATION FOR STAT BOXES
    ------------------------------------------------------- */
    function animateCounter(el) {
        var target = parseInt(el.getAttribute('data-gcc-counter'), 10);
        var prefix = el.getAttribute('data-gcc-prefix') || '';
        var suffix = el.getAttribute('data-gcc-suffix') || '';
        var start = 0;
        var duration = 1800;
        var startTime = null;
        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = Math.round(eased * target);
            el.textContent = prefix + current + suffix;
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = prefix + target + suffix;
            }
        }
        requestAnimationFrame(step);
    }

    /* Intersection Observer to trigger counters on scroll */
    var counterEls = document.querySelectorAll('[data-gcc-counter]');
    if ('IntersectionObserver' in window) {
        var counterObserver = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counterEls.forEach(function(el) { counterObserver.observe(el); });
    } else {
        counterEls.forEach(animateCounter);
    }

    /* -------------------------------------------------------
       GSAP SCROLL REVEAL (progressive enhancement)
    ------------------------------------------------------- */
    try {
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            var gccRevealEls = document.querySelectorAll(
                '.gcc-mission-section, .gcc-pressure-section, .gcc-model-section, ' +
                '.gcc-framework-section, .gcc-automation-section, .gcc-engagement-section, ' +
                '.gcc-pillars-section, .gcc-trust-section, .gcc-markets-section, ' +
                '.gcc-governance-section, .gcc-faq-section, .gcc-services-section'
            );
            gccRevealEls.forEach(function(section) {
                var cards = section.querySelectorAll(
                    '.gcc-stat-box, .gcc-pressure-card, .gcc-layer-card, .gcc-step, ' +
                    '.gcc-eng-card, .gcc-pillar-card, .gcc-trust-card, .gcc-standout-item, ' +
                    '.gcc-faq-item, .gcc-service-pill, .gcc-market-pill'
                );
                if (cards.length) {
                    gsap.from(cards, {
                        y: 30,
                        opacity: 0,
                        duration: 0.55,
                        stagger: 0.08,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: section,
                            start: 'top 85%',
                            once: true
                        }
                    });
                }
            });
        }
    } catch (e) { /* animations are progressive enhancement */ }

})();
</script>
@endpush
