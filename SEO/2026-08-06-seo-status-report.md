# DevMantra SEO — Status Report: Done / In Progress / Pending / Ready to Start

**Prepared by:** Digitech Solutions
**As of:** 6 August 2026
**Sources cross-checked:** `SEO/seo-task-tracker.md`, `SEO/devmantra-seo-may-2026-delivery-report.md`, `SEO/seo-implementation-plan-v2-2026-06-13.md`, live site crawl, Semrush API — plus 2 new findings from this audit that aren't in any prior doc.

This is the real, current-state picture — not a plan, not a pitch. Where a prior doc's claim couldn't be independently verified this session, it's marked accordingly.

---

## Snapshot

| Status | Count | 
|---|---|
| ✅ Done | 10 tasks + 2 new fixes needed (see below) |
| 🟡 Partial / in progress | 5 tasks |
| ❌ Pending / not started | 5 tasks |
| 🆕 New issues found this audit | 2 |

---

## ✅ DONE (verified — either live-checked this session or confirmed in repo with strong evidence)

| Task | What | Verification |
|---|---|---|
| TASK 01 | Reusable SEO admin panel built | Code-verified |
| TASK 02 | Global SEO settings in admin | Code-verified |
| TASK 03 | `SchemaService.php` — 10 schema builder methods | Code-verified, 4 types confirmed live |
| TASK 04 | SEO panel wired into 6+ admin edit views | Code-verified |
| TASK 05 | Dynamic XML sitemap | **Live-verified** — 109 URLs at `/sitemap.xml`, HTTP 200 |
| TASK 06 | Alt-tag management system | Code-verified; 0/7 images missing alt on live spot-check |
| TASK 07 | Full SEO fields on all 7 content types | Code-verified via migrations |
| TASK 08 | Tax calculator gated with lead capture | Code-verified |
| TASK 10 | Internal linking structure deployed | Code + DB-verified (see Deliverables Checklist for the full record-level list) |
| TASK 16 | HTTPS enforced site-wide | **Live-verified** — both host variants 301 to HTTPS |
| TASK 17 | NAP consistency + LocalBusiness schema | **Live-verified** on homepage |
| — | Homepage H1 fix | **Live-verified** — single H1 present |
| — | About-page visible FAQ + FAQPage schema | **Live-verified** — 6 Q&As, schema present |
| — | llms.txt GEO rewrite | **Live-verified** |
| — | robots.txt AI-bot allowlist (GEO) | **Live-verified** — 12 AI bots explicitly allowed |

## 🆕 NEW — found during this audit, not previously flagged

| Priority | Issue | Detail |
|---|---|---|
| **P0** | Homepage `<title>` / `og:title` shows a literal `&amp;amp;` instead of "&" | Double-encoding bug — visible in Google's search result title and every social share right now. 5-minute admin fix (see On-Page Audit §4.1). |
| **P0/P1** | Canonical domain mismatch: live site redirects to **non-www**, but `robots.txt`'s `Sitemap:`/`Host:` and `llms.txt`'s `Website:` still say **www** | Creates an unnecessary redirect hop off the sitemap declaration and a real risk of a Search Console property mismatch. Pick one host and make every file agree (recommend non-www, since that's what's actually live). |

## 🟡 IN PROGRESS / PARTIAL (built, not fully finished)

| Task | What's done | What remains |
|---|---|---|
| TASK 09 | SEO panel + DB fields exist on all 9 services | Keyword-targeted title/description **copywriting** per service not yet audited/rewritten. Spot-checked 1/9 (Virtual CFO) this session — passed on length/structure, needs a CTA added to the description. Extend the same check to the other 8. |
| TASK 13 | Schema auto-injects on blogs/services/alerts/events; homepage + about verified live | FAQ schema not yet extended past `/about` to individual service/blog pages; bulk `custom_head` population for older records unverified |
| TASK 15 | Homepage H1 fixed and live-verified | Homepage meta description is still the short (98-char) global default — no page-specific, keyword-rich, CTA-driven homepage description has been written |
| TASK 18 | `loading="lazy"` on 6 templates; browser caching + gzip live in `.htaccess` | No PageSpeed Insights baseline has been run yet; asset minification/WebP conversion and HTTP/2 enablement not started |

## ❌ PENDING (not started — queued)

| Task | What | Why it's next, not now |
|---|---|---|
| TASK 11 | Write & publish 10 priority SEO blog posts | Needs keyword research first; per the June strategy doc, this should come *after* the 9 money pages are optimized, not before |
| TASK 12 | Bulk-update remaining blog/report/newsletter meta tags via a DB pass | Depends on the same content audit as TASK 09 |
| TASK 14 | Monthly SEO review & reporting SOP | Process doc, not code — needs a decision on cadence/format before it can be written |
| TASK 19 | PageSpeed Insights optimization (mobile + desktop) | Requires the TASK 18 baseline run first |
| TASK 20 | DMARC / SPF / DKIM email records | DNS-level task — needs client's cPanel/DNS access, cannot be done from the codebase |
| — | Google Business Profile primary-category audit + local SEO | Flagged as a P0 gap in the team's own June strategy doc; zero code or content evidence this has started. Cannot be done from the repo — needs direct GBP console access |
| — | Off-page authority building (digital PR, Reddit/Quora seeding, directory listings, founder LinkedIn thought-leadership) | See the companion Off-Page Audit — this is the actual ceiling on rankings right now, more so than any remaining on-page item |

## ✅ READY TO START RIGHT NOW (no blockers, no dependencies)

These can be picked up today with zero prerequisites:

1. **Fix the `&amp;amp;` title bug** — one settings-panel edit. *Do this first; it's live and visible to every visitor and every search result right now.*
2. **Fix the www/non-www mismatch** in `robots.txt` and `llms.txt` — one file edit each, no deploy risk.
3. **Add a CTA to the Virtual CFO service meta description**, then repeat the Six-On-Page-Elements check across the remaining 8 services (TASK 09) — this is the single highest-leverage remaining *on-page* item and has zero dependencies.
4. **Write a page-specific homepage meta description** (currently using the generic sitewide default).
5. **Run a PageSpeed Insights baseline** on mobile + desktop (5 minutes, unlocks TASK 19).
6. **Pull DevMantra's current Google Business Profile** and compare its primary category against the top-3 local competitors (the June strategy doc's explicit P0 local move) — this needs GBP console access, which we don't have from this session; ready to start the moment that access is shared.
7. **Enable the Notion connector** for this workspace (currently installed but off) so the off-page/outreach tracker in Notion can be merged into future audits — a client-side toggle, no dev work needed.

---

## What This Means, Plainly

The on-page/technical floor described in the June strategy doc as "mostly shipped" is accurate — and this audit found it to be true, with two real live defects (both quick fixes) added to the list. The actual constraint on DevMantra's rankings today is not on-page work — it's authority: a Domain Authority of 7, almost no non-branded keyword visibility (43 keywords, nearly all branded), and a backlink profile made up mostly of directories and SEO-tool artifacts rather than editorial mentions. The next dollar of effort should go to the "ready to start" list above (all cheap, all yours to greenlight today) plus the off-page/GBP work in the companion Off-Page Audit — not more on-page polishing.
