# DevMantra — SEO Implementation Plan

> **Planned:** 13 June 2026 · **Owner:** SEO team (Digitech)
> **Source of truth:** this file + `SEO/seo-task-tracker.md` + Notion PM Navigation Index
> **Goal:** Lock the on-page foundation (meta + schema for *every* page including new blogs), then layer AEO + GEO and internal linking. Ship as many verified wins today as possible.

---

## 1. Where we are (verified in codebase, 13 June)

**Infrastructure is strong — already built and live:**

| Capability | Status | Evidence |
|---|---|---|
| Reusable SEO panel (title/desc/og/canonical/noindex/custom_head) | ✅ | `admin/partials/_seo-panel.blade.php` |
| Global SEO settings (GA4, GTM, verification, defaults) | ✅ | `admin/account/settings.blade.php` |
| `SchemaService` (Org, LocalBusiness, Article, Blog, CaseStudy, Report, Newsletter, Service, FAQ, Breadcrumb) | ✅ | `app/Services/SchemaService.php` |
| Dynamic sitemap | ✅ | `SitemapController.php` + `/sitemap.xml` |
| Alt-tag management + AI suggestions | ✅ | `ImageMeta.php` |
| OG + Twitter cards in layout | ✅ | `layouts/frontend.blade.php` |
| robots.txt (AI/LLM bots explicitly allowed) | ✅ | `public/robots.txt` |
| HTTPS + www redirect, canonical de-query | ✅ | `.htaccess`, `AppServiceProvider` |

**The gaps that matter (the work for this engagement):**

1. **🔴 Schema is NOT auto-injected on blogs + services.** `blog-detail.blade.php` and `service-detail.blade.php` only output JSON-LD *if the `custom_head` DB field is manually filled*. They never call `SchemaService::blogSchema()` / `serviceSchema()`. → **New blogs have zero schema.** (Other pages — about, contact, alerts, events, case studies, reports, newsletters — DO auto-inject.)
2. **🔴 On-page meta largely empty.** Per the May audit (`seo-suggestions.md`): Blogs 12/12 missing meta_title, Services 9/9 missing, Newsletters 59/59 missing, Reports 2/2. New blogs added since → also unmeta'd.
3. **🟡 AEO weak.** FAQPage schema used on only one GCC partial; no answer-first / TL;DR blocks for featured snippets + AI answers.
4. **🟡 GEO partial.** `llms.txt` exists but is stale (April) — new content not represented; no Person/E-E-A-T schema for founders.
5. **🟡 Internal linking** — only relational sidebars; no contextual blog→service in-content links (Notion TASK 26–37).
6. **🟡 Homepage H1 / meta description** unverified (TASK 15).

---

## 2. Strategy framing (from Brand Brain)

- **Positioning:** audit-grade, CA-led India execution partner for cross-border M&A, India entry/FDI, Virtual CFO, GCC. ICAI FRN 011067S (N Tatia & Associates), ₹5,000 Cr transactions, 20+ years.
- **Voice for meta/content:** specific numbers + named credentials, calm authority. **Banned:** "trusted partner", "end-to-end", "empower/unlock", "in today's fast-paced world".
- **Priority themes:** Virtual CFO (quick-win rankings), India entry/FDI, M&A advisory, GCC setup, **Korea Desk** (top strategic initiative Q3).
- **NAP (use exactly):** Dev Mantra Financial Services · Bengaluru, Karnataka, India · +91 99001 92697 · info@devmantra.com · devmantra.com.

---

## 3. The plan — 7 phases (highest ROI first)

### Phase 1 — Auto-inject schema on blogs + services  ⚡ *biggest fast win, code-only*
Make `blog-detail` and `service-detail` fall back to `SchemaService` when `custom_head` is empty:
- Blog → `BlogPosting` + `BreadcrumbList` + author `Person` + `Organization` publisher.
- Service → `Service` + `BreadcrumbList` + provider `Organization`.
- Keeps manual `custom_head` override working; every page now ships valid JSON-LD regardless of DB state.
- **Result:** 100% schema coverage on all current + future blogs/services in one change.

### Phase 2 — Bulk on-page meta for all content  *(DB / phpMyAdmin)*
- Audit NULL/empty `meta_title`, `meta_description`, `canonical_url`, `og_image` across blogs, services, newsletters, reports, case studies, alerts, events.
- Generate brand-voiced values: `meta_title ≤ 60` (`Primary Keyword | Dev Mantra`), `meta_description 150–160` with CTA, canonical from slug, og_image from featured image fallback.
- Apply via batched `UPDATE` statements in phpMyAdmin. Start with **new blogs + all blogs + all services**, then newsletters/reports.
- Covers Notion **TASK 09 + 12**.

### Phase 3 — AEO (Answer Engine Optimization)
- `FAQPage` schema + visible Q&A blocks on service pages and priority blogs (the questions AI assistants actually get asked: "How much does India entry cost?", "What is a Virtual CFO?", "GIFT City vs mainland?").
- "TL;DR / Key Takeaways" answer-first block at top of blogs → featured snippets + AI extraction.
- Enforce single `<h1>` + clean H2/H3 semantic structure.
- Covers Notion **TASK 13**.

### Phase 4 — GEO (Generative Engine Optimization)
- Regenerate `llms.txt` (+ optional `llms-full.txt`) with new blogs/services, entity-rich descriptions, key stats and credentials.
- Add `Person` schema for founders + `Organization` `sameAs` / `knowsAbout` (E-E-A-T signals AI engines weight).
- Confirm AI crawler allow-list (already in robots) and citation-friendly factual blocks.
- Covers Notion **TASK 21 + 24**.

### Phase 5 — Internal linking
- Contextual blog→service in-content links, keyword-rich homepage service anchors, index-recovery links for "crawled-not-indexed" pages, related-content blocks.
- Covers Notion **TASK 10 / 26–29**.

### Phase 6 — Technical + performance finishing
- Verify/fix single homepage H1 + meta description (TASK 15).
- Image WebP + compression, `fetchpriority="high"` on LCP hero (TASK 18/19).
- DMARC/SPF/DKIM DNS records (TASK 20 — **human/DNS action**).

### Phase 7 — Verify, validate + report
- Validate every schema type (Rich Results / schema validator), resubmit sitemap in GSC, spot-check rendered meta on live URLs.
- Update `seo-task-tracker.md` + Notion; stand up the monthly SEO review SOP (TASK 14).

---

## 4. What ships *today* (proposed)
1. **Phase 1** schema auto-injection (code) — instant 100% blog/service schema coverage.
2. **Phase 2** bulk meta for all blogs (incl. new) + all services (DB).
3. **Phase 3** FAQ schema on top 5 service pages + TL;DR blocks on new blogs.
4. **Phase 4** refreshed `llms.txt`.
5. **Phase 7** validate + resubmit sitemap.

Phases 5–6 (internal linking, perf/DNS) queued next.

---

## 5. Open decisions (need confirmation)
- **DB apply method:** drive phpMyAdmin in the browser directly, or generate ready-to-run `.sql` files for you to import?
- **Edit live repo directly** (`C:\xampp\htdocs\Devmantranew`, under git) vs. produce diffs for review?
- **Today's scope:** confirm the Section 4 batch or re-prioritize.
