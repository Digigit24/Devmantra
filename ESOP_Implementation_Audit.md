# ESOP Calculator — Implementation Audit vs `ESOP_Allocation_Model_V6.xlsx`

**Scope:** Cross-check the Dev Mantra ESOP lead-magnet calculator (route `/esop-calculator`) against the source workbook, sheet by sheet, formula by formula.
**Date:** 19 Jul 2026
**Verdict:** The calculation engine is a faithful, numerically-verified port of the workbook. Every computational rule in Setup, Scoring and Results is implemented and produces the exact Excel numbers. The gaps that remain are confidentiality/integrity design choices, a few input-list mismatches, and reporting placement — not calculation errors.

---

## Files reviewed

| Layer | File |
|---|---|
| Engine | `app/Services/EsopAllocationCalculator.php` |
| Rubric / lists / scoring key | `app/Services/EsopQuestionBank.php` |
| Public controller (validate, persist, score, AI, email) | `app/Http/Controllers/EsopCalculatorController.php` |
| Admin controller (Dashboard aggregation) | `app/Http/Controllers/Admin/EsopLeadController.php` |
| Wizard UI + client scoring | `public/assets/esop-calculator/js/calculator.js`, `resources/views/frontend/esop-calculator/app.blade.php` |
| Schema | 3 migrations (`esop_leads`, `esop_employees`, `add_junior_others_tier_pools`) |
| Models | `app/Models/EsopLead.php`, `app/Models/EsopEmployee.php` |
| Admin / email views | `resources/views/admin/esop-leads/*`, `resources/views/emails/esop-result.blade.php` |

---

## A. Implemented AND correct (verified against the workbook)

| # | Excel rule (sheet) | Where implemented | Status |
|---|---|---|---|
| 1 | 20 parameters, 6 statements each scored 0–5 (Rubric / Lists) | `EsopQuestionBank::params()` | ✅ **All 108 option→score pairs match the hidden key exactly** — same scores *and* same shuffled order |
| 2 | Hidden key row-aligned to shuffled statements (Lists B12:T17) | `params()` option scores | ✅ Verified programmatically, 0 mismatches |
| 3 | Tenure auto-score bands: ≥10→5, ≥6→4, ≥3→3, ≥1→2, >0→1, else 0 (Scoring H) | `EsopQuestionBank::scoreTenure()` | ✅ Identical |
| 4 | Max score = 20 × 5 = 100 (Setup C17) | `MAX_SCORE = 100` | ✅ |
| 5 | Total score = tenure + 19 picks (Scoring AC) | `scoreEmployee()` | ✅ (recomputed server-side) |
| 6 | Allocatable pool = pool − hiring reserve (Setup C16) | `$allocatablePool` | ✅ |
| 7 | Pool to distribute = allocatable × distribute% (Setup C22, default 100%) | `$poolToDistribute` | ✅ |
| 8 | Optional tier pools for all 5 seniority levels (Setup C28:C32) | tier fields + 3rd migration | ✅ (junior/others added in `2026_07_19_000001`) |
| 9 | Tier over-commit scaling = MIN(1, ptd / Σtiers) (Results H) | `$tierScale` | ✅ Verified: tiers 12% vs pool 8% → scale 0.6667 |
| 10 | Remainder = ptd − Σtiers, floored at 0 (Setup C34 / Results H) | `max(0, $remainder)` | ✅ |
| 11 | Completion throttle = MIN(1, scored ÷ planned headcount) (Results B6) | `$completionFactor` | ✅ Verified: 5 of 20 → 25% of pool released |
| 12 | Peer groups: each tiered level is its own group; blank levels share the remainder (Results G/I) | `groupKeyFor()` + `$peerTotals` | ✅ |
| 13 | Grant = pool basis × (own score ÷ peer score total) (Results K) | `$finalGrant` | ✅ |
| 14 | Share of pool = grant ÷ **allocatable** pool, i.e. Setup C16 not C11 (Results L) | `$shareOfPool` | ✅ Correct base (a common place to get wrong — it's right) |
| 15 | Rank with tied ranks (Results M) | rank loop | ✅ (ties share rank) |
| 16 | Score range, average grant, tier-split status, pool-cap check (Results B5/B15/B16/B9) | `pool` summary array | ✅ |
| 17 | Dashboard: headcount + allocated % by department and by seniority | `Admin\EsopLeadController::show()` + `admin/esop-leads/show.blade.php` | ✅ (see §C for placement) |
| 18 | Pool can never be exceeded (How It Works checks) | `within_pool`, `max(0,remainder)`, scaling | ✅ Verified in all 3 scenarios |

**Numeric proof (Excel sample data reproduced exactly):** pool 10% / reserve 2% / 20 planned / 5 scored, tiers 2/3/1/1/1.
Engine output — allocatable **8.0**, to-distribute **8.0**, remainder **0**, scale **1.0**, completion **0.25**, total allocated **2.0%**; grants A=0.50 B=0.75 C=0.25 D=0.25 E=0.25; share-of-pool A=6.25 B=9.375 C=3.125 D=3.125 E=3.125 — **all identical to the workbook's computed cells.**

---

## B. Implemented differently / potentially wrong (with severity)

| # | Issue | Excel says | Code does | Severity | Note |
|---|---|---|---|---|---|
| B1 | **Scoring key exposed to the browser** | Whole design principle: statements shuffled, key on a *hidden, password-protected* sheet so assessors never see the numbers | `app()` ships every option's numeric `score` to the client in `window.ESOP_DATA.params`; each option carries `data-score` in the DOM | **Medium (fidelity/design)** | Shuffled *order* is preserved (badges are A–F, not scores), so it's not obvious — but the scores are readable in page source. Acceptable for a self-serve lead magnet; breaks the workbook's core confidentiality property |
| B2 | **Server trusts the submitted numeric score** | Score is always *looked up* from the picked statement via the hidden key (INDEX/MATCH) | Controller validates `answers.*` as int 0–5 and uses it directly; only *tenure* is re-derived. It does **not** re-map the picked statement text → score | **Medium (integrity)** | Code comment claims "never trust client scores," but it does trust the behavioural digits. A crafted POST could submit all 5s. Fix: send only statement IDs and score them server-side from `EsopQuestionBank` |
| B3 | **Company-stage options mismatch** | Setup E8: "Startup / Growth / IPO" | `COMPANY_STAGES = ['Growth','Expansion','Mature']` | Low (cosmetic) | No calculation impact; label only. Align if the workbook is canonical |
| B4 | **Hiring-reserve default** | Example value 2% | Defaults to **10%** (migration default, controller `?? 10`, JS pre-fill 10) | Low (by design) | Field is always shown pre-filled and editable, so real submissions carry the user's value. Only matters if left blank via the API |
| B5 | **Industry is a fixed manufacturing dropdown** | Free text | 15 hard-coded manufacturing industries | Low (intentional) | Reasonable given Dev Mantra's manufacturing-SME audience; note it diverges from the free-text workbook |
| B6 | **"Fully scored" gate lives in validation, not the engine** | Employee counts / receives a grant only if all 20 filled AND total>0 (Results F) | Engine gates on `total_score > 0` only; completeness is enforced by the controller's `required` rules | Low (structural) | No real-world effect (form always sends all 19). Risk only if `calculateSession()` is reused with partial rows |
| B7 | **`planned_headcount` blank path** | Blank/0 headcount → completion factor = 1 (Results B6) | Wizard forces headcount ≥ 1; API fallback = `count(employees)` | Low (structural) | Excel's "blank → deploy 100%" path isn't reachable from the UI |
| B8 | **Reserve > pool not guarded** | No guard in Excel either (C16 can go negative) | No guard (`allocatablePool` can go negative) | Low (shared edge case) | Consider validating `reserve ≤ pool` — an improvement over the workbook |
| B9 | Rank of a 0-score employee | Blank | Returns `0` | Negligible | Cosmetic |
| B10 | Rounding | Full float precision | `final_grant`/`pool_basis` → 6 dp; shares → 2 dp | Negligible | 6 dp of a percent ≈ 1e-8 of equity; total summed before rounding, so no compounding |

---

## C. Pending / not surfaced (nothing computational is missing)

1. **Dashboard by department & seniority is admin-only.** The workbook's Dashboard sheet is fully reproduced in `Admin\EsopLeadController::show()` + the admin view, but the **public results screen** (`calculator.js → renderResults`) shows only KPIs + the per-employee table + AI narrative. If the by-department / by-seniority breakdown is meant for the end user too, it's still pending on the public side. (If it's a management-only view, this is correct as-is.)
2. **`status = 'partial'` is unused.** Schema default is `'partial'` and `STATUSES` includes it, but the wizard is a single all-or-nothing submit and the controller always creates leads as `'new'`. No partial/resume save exists. Not from the workbook — a latent capability only.
3. **`resources/views/frontend/esop-calculator/index.blade.php` appears unused.** Routes serve `landing` (index) and `app`; `index.blade.php` isn't referenced. Likely dead file — worth confirming/removing.

---

## D. Extras beyond the workbook (additions, working)

These are net-new vs the Excel and are not defects — listed for completeness:

- AI narrative (summary, risk flag, vesting suggestion, next steps, per-employee rationale) with 3-provider fallback (OpenAI → Kimi → Grok) and a deterministic template if all fail, so numbers never depend on the AI call.
- Emailed report (`EsopResultMail`) + client-side PDF export.
- Lead capture + admin CRM (list / search / status / delete).
- Qualitative score labels (Exceptional / Strong / Good / Developing / Early-stage) — not in the workbook.
- Server-side re-scoring of tenure and totals (a security improvement over a shared spreadsheet).

---

## E. Recommended actions (priority order)

1. **B2 (integrity):** score behavioural answers server-side from the statement selection instead of trusting the posted digit. This also naturally fixes **B1** — stop shipping `score` to the client; send statement IDs only.
2. **C1:** decide whether the department/seniority breakdown belongs on the public results screen; add it if so.
3. **B3 / B5:** reconcile company-stage and industry lists with the workbook (or confirm the web lists are the new canonical source).
4. **B8:** add a `reserve ≤ pool` (and optionally `Σtiers` sanity) validation.
5. **C2 / C3:** remove the unused `partial` status path and the unused `index.blade.php`, or wire them up.

---

*Bottom line: the money math is correct and matches `ESOP_Allocation_Model_V6.xlsx` to the digit. The open items are about protecting the scoring key, hardening input trust, and where the Dashboard is shown — not about how grants are calculated.*
