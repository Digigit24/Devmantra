# DevMantra (devmantra.com) — On-Page & Technical SEO Audit

**Prepared by:** Digitech Solutions
**Audit date:** 6 August 2026
**Method:** Live crawl of devmantra.com (curl + rendered HTML inspection), Semrush API pull (domain, organic, backlinks), and a direct code review of the Laravel repository (`Devmantranew`) — every claim below is tagged **[LIVE-VERIFIED]**, **[CODE-VERIFIED]**, or **[DOCUMENTED, NOT RE-VERIFIED]** so you know exactly how it was checked.

---

## 1. Executive Summary

DevMantra's on-page SEO foundation is genuinely strong for a mid-market advisory site — this is not a "starting from zero" audit. The codebase has a purpose-built SEO admin panel, a dynamic structured-data engine covering 9+ schema types, a real-time-generated XML sitemap, a GEO-ready `robots.txt` and `llms.txt`, and a completed sitewide internal-linking pass. Two real, previously-unflagged defects were found during this audit (Section 4.1) — one is a visible, click-through-damaging title bug on the homepage; the other is a canonical-domain mismatch between the live site and the site's own `robots.txt`/`llms.txt`/deployment docs. Both are fixable in under an hour of dev time.

Off-page authority (Section covered separately in the Off-Page SEO Audit) is the real ceiling on rankings right now — the on-page floor is close to solid.

---

## 2. Content Inventory (verified against `SEO/internal-linking-plan.md` + live site)

| Content type | Published (repo record) | Notes |
|---|---|---|
| Services (money pages) | 9 | Full list in Section 3 |
| Blogs | 9 | 8 confirmed June 2026; 9th (Virtual vs Fractional vs Outsourced CFO) added since |
| Reports | 2 | Published after the June internal-linking snapshot |
| Case Studies | 1 | Published after the June internal-linking snapshot |
| Newsletters | 40 | Full slug list in `SEO/internal-linking-plan.md` Appendix A |
| Alerts | 1 | ITCC alert |
| Events | 6 | |
| **Total indexable content records** | **68** | |

**Live sitemap check [LIVE-VERIFIED]:** `https://devmantra.com/sitemap.xml` returns HTTP 200 with 109 `<url>` entries as of this audit (the static file still in the repo root has 114 — expected, since the live one is DB-driven and the static file is a stale leftover; see Section 4.2 for the cleanup recommendation).

---

## 3. Money Pages (9 Services) — Six-On-Page-Elements Spot Check

Spot-checked live: **Virtual CFO Services** (`/services/virtual-cfo-services`).

| Element | Finding | Verdict |
|---|---|---|
| Title tag | "Virtual CFO Services in India for SMEs — DevMantra" — 54 characters | ✅ Within 50–60 char guidance, front-loaded keyword |
| Meta description | 154 characters, keyword-rich, no CTA | 🟡 Good length; add an explicit CTA ("Book a free consult") |
| H1 | Single H1: "Senior Financial Leadership, Without the Full-Time Overhead" | ✅ One H1, benefit-led (not keyword-stuffed — a genuine editorial choice; consider an H1 variant test with the exact-match keyword for comparison) |
| Structured H2s | 9 H2s, logical flow (offer → proof → process → differentiation → audience → FAQ → cross-sell → CTA) | ✅ |
| Canonical | `https://devmantra.com/services/virtual-cfo-services` (non-www) [LIVE-VERIFIED] | 🟡 Correct format, but see Section 4.1 — the canonical *domain* choice conflicts with `robots.txt`/`llms.txt` |
| JSON-LD | 2 `<script type="application/ld+json">` blocks: `Service` (+`ImageObject`), `Organization`, `BreadcrumbList` [LIVE-VERIFIED via raw HTML, not the rendered-markdown fetch which strips `<script>` tags] | ✅ |
| Images | 7 `<img>` tags, 0 missing `alt` attributes [LIVE-VERIFIED] | ✅ |
| Internal links | Related-service cross-sell block present | ✅ |

**Remaining work on the 9 money pages (per `seo-task-tracker.md` TASK 09, still open):** the SEO *fields* and *schema* exist on all 9 services, but a keyword-targeting content audit of the actual meta title/description copy per service has not been completed and verified — this is the single highest-leverage remaining on-page task (see the Status Report).

---

## 4. Technical SEO Findings

### 4.1 New issues found in this audit (not previously flagged in the repo's own docs)

**Issue 1 — Double-encoded ampersand in the homepage `<title>` and `og:title` [LIVE-VERIFIED, HIGH PRIORITY]**

Raw HTML source of the homepage `<title>` tag:

```
DevMantra - Strategic Financial &amp;amp; Advisory Services — DevMantra
```

Because `&amp;amp;` only decodes one level in the browser, this renders — and will show in the Google search result title and every social share card — as:

```
DevMantra - Strategic Financial &amp; Advisory Services — DevMantra
```

i.e. the literal text "&amp;" is visible to end users instead of "&". This is a real, live, click-through-damaging defect. Root cause is almost certainly that the `seo_default_title` value in `site_settings` was saved with the ampersand already HTML-entity-encoded (e.g. pasted from a rich-text field), and Blade's auto-escaping `{{ }}` in `frontend.blade.php` encodes it a second time on output. **Fix:** in the admin, open Global SEO Settings → Homepage Title, replace the stored value's `&amp;` with a literal `&`, or decode once (`html_entity_decode()`) before display if the field is meant to allow rich text. Five-minute fix, high visibility impact.

**Issue 2 — Canonical domain mismatch: live site vs. own robots.txt/llms.txt/deployment docs [LIVE-VERIFIED, MEDIUM-HIGH PRIORITY]**

Live redirect behavior, tested directly:

| Request | Result |
|---|---|
| `http://devmantra.com` | 301 → `https://devmantra.com` (non-www) |
| `http://www.devmantra.com` | 301 → `https://www.devmantra.com` → **301 again** → `https://devmantra.com` (non-www) |
| `https://www.devmantra.com` | 301 → `https://devmantra.com` (non-www) |

So the site's *actual* canonical host is **non-www** (`devmantra.com`), confirmed by every canonical tag and JSON-LD `url` field checked live. But:

- `public/robots.txt` declares `Sitemap: https://www.devmantra.com/sitemap.xml` and `Host: https://www.devmantra.com` — the **www** version.
- `public/llms.txt` states `Website: https://www.devmantra.com`.
- `production.md` and `seo-task-tracker.md` TASK 16 both document the *opposite* intent ("force non-www → www").

This means the `.htaccess` rewrite rules currently live on production actually redirect **www → non-www**, which is the **reverse** of what the team's own deployment notes say should happen, and it forces an unnecessary extra redirect hop for anyone who lands on the www version via the sitemap declaration in robots.txt. It also risks a **Google Search Console property mismatch** if GSC is verified against the www property while Google is crawling and indexing the non-www canonical. **Fix (pick one, don't leave it mixed):** either (a) update `robots.txt`'s `Sitemap:`/`Host:` and `llms.txt`'s `Website:` to the non-www URL to match what's actually live, or (b) flip the `.htaccess` rewrite condition back to force www and update `APP_URL` accordingly. Given the canonical tags, JSON-LD, and sitemap `<loc>` values are *already* all non-www in production, option (a) is the lower-risk, one-file fix.

**Issue 3 — Static leftover `sitemap.xml` in repo root [CODE-VERIFIED, LOW PRIORITY]**
The repo root still has a static `sitemap.xml` (114 URLs, stale) alongside the dynamic Laravel-generated one. `production.md` already flags deleting the production copy of this file as a required manual step — confirm it was actually deleted on the live server (the live sitemap *is* serving dynamically, so this is very likely already done; recommend a one-line confirmation).

### 4.2 Confirmed-working (verified live, not just documented)

| Item | Verification |
|---|---|
| HTTPS enforced sitewide | `http://` → 301 → `https://` on both host variants [LIVE-VERIFIED] |
| Single H1 per page | Homepage = 1, Virtual CFO service page = 1 [LIVE-VERIFIED] |
| Organization + FinancialService + LocalBusiness + BreadcrumbList schema on homepage | Raw JSON-LD extracted and parsed [LIVE-VERIFIED] |
| FAQPage schema + 6 visible Q&As on /about | Raw JSON-LD extracted (`FAQPage`, `Question`, `Answer`) + visible FAQ section confirmed [LIVE-VERIFIED] |
| Service/Organization/BreadcrumbList schema on service template | Confirmed on Virtual CFO Services page [LIVE-VERIFIED] |
| Alt text present on all images (spot check) | 7/7 images had `alt` attributes on the Virtual CFO page [LIVE-VERIFIED] |
| Dynamic sitemap live | 109 URLs returned at `/sitemap.xml`, correct `<priority>`/`<changefreq>` [LIVE-VERIFIED] |
| GEO/AI-bot allowlist in robots.txt | 12 distinct `Allow: /` rules for GPTBot, ChatGPT-User, OAI-SearchBot, anthropic-ai, Claude-Web, Google-Extended, PerplexityBot, cohere-ai, CCBot, meta-externalagent, Applebot, Applebot-Extended [LIVE-VERIFIED] |
| Scraper/parasite-SEO bot blocking | 12 `Disallow: /` rules incl. AhrefsBot, SemrushBot, MJ12bot, DotBot, BLEXBot, PetalBot, ia_archiver [LIVE-VERIFIED] |

---

## 5. Code & Architecture Review

Reviewed directly in the Laravel repository (`Devmantranew`):

- **`app/Services/SchemaService.php`** (310 lines) — clean, single-responsibility JSON-LD builder with 10 static methods (`organization`, `localBusiness`, `articleSchema`, `blogSchema`, `caseStudySchema`, `reportSchema`, `newsletterSchema`, `serviceSchema`, `faqSchema`, `breadcrumb`), an image-resolution fallback chain, and a shared `wrap()` helper. This is a well-structured, maintainable pattern — new content types can get schema support by adding one method, not touching templates.
- **`resources/views/layouts/frontend.blade.php`** — the meta-tag block is defensive (falls back to global defaults for title/description/OG image, de-duplicates a trailing brand suffix in the title, strips query strings from canonical/`og:url`). The title-dedup regex is well-commented and idempotent. The one gap is the double-encoding issue in Section 4.1 — the regex assumes a *decoded* title comes in from the DB, which isn't always true.
- **`_seo-panel.blade.php`** — reusable partial with live character counters, OG image upload + URL fallback, noindex checkbox, and a raw custom-head textarea for manual JSON-LD injection. Wired into 6 of 8 content-type edit views at last check (alerts/events wiring should be re-confirmed since the May report and the June session note slightly different completion states for this).
- **`app/Http/Controllers/SitemapController.php` + `resources/views/sitemap.blade.php`** — queries published content live rather than a cron-generated static file, so `lastmod` is always accurate. Reasonable trade-off (small DB query cost per crawl) for a site this size.
- **DB migrations** — SEO columns were added to all 7 content tables in two passes (blogs/services/case_studies/reports/newsletters, then alerts/events as a hotfix). This two-pass history is why alerts/events lagged behind — worth a regression check that both migrations actually ran on production (`php artisan migrate:status`).
- **`public/robots.txt` / `public/llms.txt`** — both hand-maintained static files, not generated from settings. This is fine at current size but means the canonical-domain mismatch in 4.1 can silently drift again after any future domain/redirect change — consider generating the `Sitemap:`/`Host:` lines from `config('app.url')` at some point so they can't drift from the `.htaccess` truth.
- **Out of SEO scope but reviewed since you asked me to look at the code generally:** `ESOP_Implementation_Audit.md` documents a separate, unrelated lead-magnet calculator (`/esop-calculator`). It's a faithful port of the client's Excel model (verified formula-by-formula), with one real security/integrity gap worth flagging to your dev team: the scoring key is shipped to the browser in `window.ESOP_DATA.params` and the server trusts the submitted numeric score rather than re-deriving it from the selected answer — a crafted POST could submit maximum scores. Not an SEO issue, but since you asked me to look at the code, it's worth a ticket.

---

## 6. Priority Fix List (this audit's net-new findings only — see the Status Report for the full backlog)

1. **Fix the double-encoded `&amp;amp;` in the homepage title/OG title** — 5-minute admin fix, real CTR impact. *P0.*
2. **Resolve the www vs non-www canonical mismatch** across `robots.txt`, `llms.txt`, and (if GSC is verified on the www property) Search Console — pick non-www since that's what's actually live. *P0.*
3. **Confirm the stale static `sitemap.xml` was deleted from the production server**, per `production.md`'s own checklist. *P2, quick confirmation only.*
4. **Add a CTA to the Virtual CFO service meta description** and extend the Six-On-Page-Elements spot check across the remaining 8 services (part of the already-open TASK 09). *P1.*

---

*This audit covers on-page and technical SEO. Off-page/authority findings are in the companion Off-Page SEO Audit document.*
