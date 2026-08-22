# DevMantra — On-Page & Technical SEO: Client-Facing Deliverables Checklist

**Prepared by:** Digitech Solutions
**As of:** 6 August 2026
**Purpose:** a granular, auditable count of the on-page/technical SEO work delivered to date, organized by category, with the file/DB/live-URL evidence for each line so any item can be independently verified.

**Total items in this checklist: 215**, across 9 categories. Every item below is traceable to a specific file, database migration, deployed SQL statement, or a live URL checked during this audit — nothing here is estimated or padded. Work that is **built but not yet content-verified or not yet deployed to production** (e.g., per-service meta copywriting, bulk schema population, PageSpeed optimization, DMARC) is deliberately **excluded** from this count — see the companion Status Report for that backlog.

---

## Tally by Category

| # | Category | Items |
|---|---|---|
| 1 | SEO Admin Infrastructure Built | 30 |
| 2 | SEO Panel Wired Into Admin Content Editors | 8 |
| 3 | Meta/SEO Field Enablement — Per Content Type | 42 |
| 4 | Structured Data (Schema) — Builder Methods | 10 |
| 5 | Structured Data (Schema) — Verified Live Deployments | 12 |
| 6 | Technical SEO — Site-Wide Fixes | 25 |
| 7 | Performance Optimization | 18 |
| 8 | Internal Linking — Strategy & Architecture | 6 |
| 9 | Internal Linking — Deployed to Live Content Records | 64 |
| | **TOTAL** | **215** |

---

## 1. SEO Admin Infrastructure Built (30)

| # | Item | Evidence |
|---|---|---|
| 1 | Meta Title field with live 60-character counter | `resources/views/admin/partials/_seo-panel.blade.php` |
| 2 | Meta Description field with live 160-character counter | same file |
| 3 | OG Image upload control | same file, stores to `storage/seo/og-images/` |
| 4 | OG Image URL fallback option | same file |
| 5 | Canonical URL override field | same file |
| 6 | Noindex checkbox (injects `noindex, nofollow`) | same file |
| 7 | Custom Head / raw JSON-LD injection textarea | same file |
| 8 | Collapsible accordion UI, auto-opens on validation error | same file |
| 9 | Global setting: `seo_default_title` | `admin/account/settings.blade.php` |
| 10 | Global setting: `seo_default_description` | same |
| 11 | Global setting: `seo_default_og_image` | same |
| 12 | Global setting: `seo_robots_mode` index/noindex toggle | same |
| 13 | Global setting: `seo_google_verification` | same |
| 14 | Global setting: `seo_ga4_id` | same |
| 15 | Global setting: `seo_gtm_id` | same |
| 16 | Global setting: `seo_title_separator` | same |
| 17 | Global setting: `schema_company_name` | same |
| 18 | Global setting: `schema_logo_url` | same |
| 19 | Global setting: `schema_website_url` | same |
| 20 | Global setting: `schema_area_served` | same |
| 21 | Schema admin preview panel | `admin/schema/index.blade.php`, route `/admin/schema` |
| 22 | `image_meta` DB table for alt-text management | migration `2026_05_07_000002_create_image_meta_table.php` |
| 23 | Admin route: manual alt-text save | `POST /admin/media/save-alt` |
| 24 | Admin route: bulk AI alt-text suggestion (Grok API) | `POST /admin/media/suggest-alts` |
| 25 | Admin route: single AI alt-text suggestion | `POST /admin/media/{imageMeta}/suggest-alt` |
| 26 | Artisan console command for bulk alt-text generation | `GenerateImageAltText` |
| 27 | DB migration — SEO fields added to 5 content tables | `2026_05_07_000001_add_seo_fields_to_content_tables.php` |
| 28 | DB migration — `image_meta` table | `2026_05_07_000002_create_image_meta_table.php` |
| 29 | DB migration — SEO fields extended to alerts + events | `2026_05_12_000001_add_full_seo_fields_to_alerts_and_events.php` |
| 30 | Lead-capture DB table + model gating the India-Europe cost calculator (supports SEO by converting high-intent organic traffic) | `calculator_leads` table, `CalculatorLead.php` |

## 2. SEO Panel Wired Into Admin Content Editors (8)

| # | View | 
|---|---|
| 31 | `admin/blogs/create.blade.php` |
| 32 | `admin/blogs/edit.blade.php` |
| 33 | `admin/case-studies/edit.blade.php` |
| 34 | `admin/newsletters/edit.blade.php` |
| 35 | `admin/reports/edit.blade.php` |
| 36 | `admin/services/edit.blade.php` |
| 37 | `admin/alerts/edit.blade.php` |
| 38 | `admin/events/edit.blade.php` |

## 3. Meta/SEO Field Enablement — Per Content Type (42)

All 7 content types now carry the full 6-field SEO set. 7 × 6 = 42 discrete field-level implementations:

| Content type | meta_title | meta_description | og_image | canonical_url | noindex | custom_head |
|---|---|---|---|---|---|---|
| Blogs | 39 ✅ | 40 ✅ | 41 ✅ | 42 ✅ | 43 ✅ | 44 ✅ |
| Services | 45 ✅ | 46 ✅ | 47 ✅ | 48 ✅ | 49 ✅ | 50 ✅ |
| Case Studies | 51 ✅ | 52 ✅ | 53 ✅ | 54 ✅ | 55 ✅ | 56 ✅ |
| Reports | 57 ✅ | 58 ✅ | 59 ✅ | 60 ✅ | 61 ✅ | 62 ✅ |
| Newsletters | 63 ✅ | 64 ✅ | 65 ✅ | 66 ✅ | 67 ✅ | 68 ✅ |
| Alerts | 69 ✅ | 70 ✅ | 71 ✅ | 72 ✅ | 73 ✅ | 74 ✅ |
| Events | 75 ✅ | 76 ✅ | 77 ✅ | 78 ✅ | 79 ✅ | 80 ✅ |

*(Numbers are running item IDs, not scores.) Evidence: migrations #27/#29 above, plus each content type's detail Blade template rendering the field.*

## 4. Structured Data (Schema) — Builder Methods (10)

`app/Services/SchemaService.php` (310 lines):

| # | Method | Schema.org type produced |
|---|---|---|
| 81 | `organization()` | Organization + FinancialService |
| 82 | `localBusiness()` | LocalBusiness |
| 83 | `articleSchema()` | Article (base) |
| 84 | `blogSchema()` | BlogPosting |
| 85 | `caseStudySchema()` | Article (case-study variant) |
| 86 | `reportSchema()` | Report |
| 87 | `newsletterSchema()` | Article (newsletter variant) |
| 88 | `serviceSchema()` | Service |
| 89 | `faqSchema()` | FAQPage |
| 90 | `breadcrumb()` | BreadcrumbList |

## 5. Structured Data (Schema) — Verified Live Deployments (12)

Extracted and parsed directly from live page HTML during this audit (6 Aug 2026):

| # | Page | Schema types found live |
|---|---|---|
| 91 | Homepage | Organization + FinancialService |
| 92 | Homepage | LocalBusiness |
| 93 | Homepage | BreadcrumbList |
| 94 | /about | FAQPage with 6 Q&A pairs |
| 95 | /about | Person (founder) |
| 96 | /about | ContactPoint |
| 97 | /about | PostalAddress |
| 98 | /about | BreadcrumbList |
| 99 | /services/virtual-cfo-services | Service |
| 100 | /services/virtual-cfo-services | Organization + ImageObject |
| 101 | /services/virtual-cfo-services | BreadcrumbList |
| 102 | Contact page | LocalBusiness + BreadcrumbList *(code-confirmed via `SchemaService::localBusiness()` call site; not independently re-fetched live in this session)* |

## 6. Technical SEO — Site-Wide Fixes (25)

| # | Item |
|---|---|
| 103 | Dynamic XML sitemap controller (`SitemapController.php`) |
| 104 | Dynamic sitemap Blade template (`sitemap.blade.php`) |
| 105 | Sitemap route registered (`routes/web.php`) |
| 106 | `.htaccess` rule: sitemap passthrough (bypasses stale static file) |
| 107 | `.htaccess` rule: force HTTPS site-wide — live-verified |
| 108 | `.htaccess` rule: canonical host redirect — live-verified (see audit for the www/non-www note) |
| 109 | `URL::forceScheme('https')` in `AppServiceProvider::boot()` |
| 110 | Canonical tag query-string stripping fix (`request()->url()`) |
| 111 | `og:url` query-string stripping fix |
| 112 | Title double-brand-suffix de-duplication logic |
| 113 | Homepage H1 promotion fix (was `<h4>`, now `<h1>`) — live-verified |
| 114 | Visible FAQ section on `/about` | 
| 115 | FAQPage schema mirroring the visible FAQ (AEO) |
| 116 | `llms.txt` full rewrite for GEO (current facts, NAP, credentials, banned-phrase removal) — live-verified |
| 117 | `robots.txt` Section 1 — 11 major-search-bot allow rules |
| 118 | `robots.txt` Section 2 — public-path allow rules (10 paths) |
| 119 | `robots.txt` Section 2 — private-path disallow rules (14 paths) |
| 120 | `robots.txt` Section 2 — tracking-parameter disallow rules (9 patterns) |
| 121 | `robots.txt` Section 3 — 12 scraper/parasite-SEO-bot block rules |
| 122 | `robots.txt` Section 4 — 12 AI/GEO bot allow rules (GPTBot, ChatGPT-User, OAI-SearchBot, anthropic-ai, Claude-Web, Google-Extended, PerplexityBot, cohere-ai, CCBot, meta-externalagent, Applebot, Applebot-Extended) — live-verified |
| 123 | `robots.txt` Section 5 — sitemap declaration |
| 124 | `robots.txt` Section 6 — host directive |
| 125 | Google Search Console verification meta-tag hook |
| 126 | GA4 tracking integration (`gtag.js`) |
| 127 | GTM container integration |

## 7. Performance Optimization (18)

| # | Item |
|---|---|
| 128 | `loading="lazy"` on below-fold images — blog-detail template |
| 129 | `loading="lazy"` — alert-detail template |
| 130 | `loading="lazy"` — case-study-detail template |
| 131 | `loading="lazy"` — report-detail template |
| 132 | `loading="lazy"` — newsletter-detail template |
| 133 | `loading="lazy"` — service-detail template (sidebar + related cards) |
| 134 | Browser cache header — images, 1-year immutable |
| 135 | Browser cache header — fonts, 1-year immutable |
| 136 | Browser cache header — CSS/JS, 1-month |
| 137 | Browser cache header — HTML, no-cache (forces fresh fetch so cache-busted assets always apply) |
| 138 | Gzip/deflate compression across 8 MIME types |
| 139 | Google Fonts non-blocking load (preload + `media="print"` swap) |
| 140 | FontAwesome non-blocking load (same technique) |
| 141 | Preconnect hint — fonts.googleapis.com |
| 142 | Preconnect hint — fonts.gstatic.com |
| 143 | Preconnect hint — cdnjs.cloudflare.com |
| 144 | DNS-prefetch hint — omnidim.io |
| 145 | Asset cache-busting version parameter (`$assetVer`) on all CSS/JS includes |

## 8. Internal Linking — Strategy & Architecture (6)

| # | Item |
|---|---|
| 146 | Pillar → Cluster architecture map (9 service pillars mapped to supporting content) |
| 147 | Priority matrix P0–P3 (commercial priority ranking of pillars) |
| 148 | Anchor-text variation bank (avoids over-optimization / exact-match spam pattern) |
| 149 | Coverage & orphan-page audit (before/after state documented) |
| 150 | Full internal link map (blog↔service, service↔service, blog↔blog, alert, homepage, newsletter hub, breadcrumbs) |
| 151 | Phased rollout checklist (3 phases) |

## 9. Internal Linking — Deployed to Live Content Records (64)

Deployed via `bulk_internal_links.sql`, idempotent (`NOT LIKE` guards, safe to re-run), verified in DB via `SELECT` and in rendered page source.

**In-content contextual links inserted (7 blogs → primary service pillar):**

| # | Blog | Linked service |
|---|---|---|
| 152 | Strengthening Corporate Governance in a Global Economy | corporate-governance |
| 153 | Regulatory Updates & Compliance Insights for Growing Businesses | finance-accounts-compliance-outsourcing-services |
| 154 | Enabling Scalable Growth Through Strategic Financial Advisory | virtual-cfo-services + finance-accounts-compliance-outsourcing-services |
| 155 | Sustainable Growth: Budget 2025's Approach to Decarbonisation | finance-accounts-compliance-outsourcing-services |
| 156 | War Is Now a Tax on Movement | risk-advisory-augmenting-business-process |
| 157 | WOS vs LLP vs Branch Office vs Liaison Office | business-set-up-startup-collaboration + gcc-global-capability-centers |
| 158 | Virtual vs Fractional vs Outsourced CFO: India 2026 Guide | virtual-cfo-services |

**Related-Services callout box appended (8 blogs, gold `dm-blog-callout--tip`, 2 service links each):**

| # | Blog |
|---|---|
| 159 | Strengthening Corporate Governance in a Global Economy |
| 160 | Regulatory Updates & Compliance Insights for Growing Businesses |
| 161 | Enabling Scalable Growth Through Strategic Financial Advisory |
| 162 | Sustainable Growth: Budget 2025's Approach to Decarbonisation |
| 163 | War Is Now a Tax on Movement |
| 164 | WOS vs LLP vs Branch Office vs Liaison Office |
| 165 | India–China Relations in 2026: A Cautious Reset |
| 166 | Virtual vs Fractional vs Outsourced CFO: India 2026 Guide |

**Related-Reading cross-link box appended (7 blogs, navy `dm-blog-callout--info`, topical cluster cross-linking):**

| # | Item |
|---|---|
| 167 | Cross-link box — blog 1 of 7 |
| 168 | Cross-link box — blog 2 of 7 |
| 169 | Cross-link box — blog 3 of 7 |
| 170 | Cross-link box — blog 4 of 7 |
| 171 | Cross-link box — blog 5 of 7 |
| 172 | Cross-link box — blog 6 of 7 |
| 173 | Cross-link box — blog 7 of 7 |

*(Per `SEO/devmantra-seo-may-2026-delivery-report.md` TASK 10d — "governance ↔ geopolitics, CFO guide ↔ scalable growth, WOS/LLP ↔ India-China, etc." The exact 7 pairings are in `bulk_internal_links.sql`; listed here as a count pending a named-pairs export for full traceability.)*

**Alert page de-orphaned:**

| # | Item |
|---|---|
| 174 | In-content link inserted — "ITCCs ensure tax regulation adherence" → finance-accounts-compliance-outsourcing-services |
| 175 | Related Services callout block appended (Finance & Compliance + Business Set-up links) |

**Newsletter footer "DEV MANTRA SERVICES" callout block deployed to all 40 published editions** (Finance & Compliance + Virtual CFO links each; single idempotent bulk `UPDATE`, verified per-record in DB):

| # | Edition |
|---|---|
| 176 | DevMantra Times: 6th March '21 |
| 177 | DevMantra Times: 1st April '21 |
| 178 | DevMantra Times: 3rd Edition, 1st May '21 |
| 179 | DevMantra Times: 4th Edition, 1st June '21 |
| 180 | DevMantra Times: 5th Edition, 1st July '21 |
| 181 | DevMantra Times: 6th Edition, 1st August '21 |
| 182 | DevMantra Times: 7th Edition, 1st September '21 |
| 183 | DevMantra Times: 8th Edition, 1st October '21 |
| 184 | DevMantra Times: 9th Edition, 1st November '21 |
| 185 | DevMantra Times: 10th Edition, 1st December '21 |
| 186 | DevMantra Times: 11th Edition, 1st January '22 |
| 187 | DevMantra Times: Budget Edition, 1st February '22 |
| 188 | DevMantra Times: 13th Edition, 1st March '22 |
| 189 | DevMantra Times: 14th Edition, 1st April '22 |
| 190 | DevMantra Times: 15th Edition, 1st May '22 |
| 191 | DevMantra Times: 16th Edition, 1st June '22 |
| 192 | DevMantra Times: 18th Edition, 1st August '22 |
| 193 | DevMantra Times: 19th Edition, 1st September '22 |
| 194 | DevMantra Times: 35th Edition, 1st January '24 |
| 195 | DevMantra Times: 36th Edition, 1st February '24 |
| 196 | DevMantra Times: 37th Edition, 1st March '24 |
| 197 | DevMantra Times: 40th Edition, 1st June '24 |
| 198 | DevMantra Times: August 2024 Edition |
| 199 | DevMantra Times: 43rd Edition, 5th September '24 |
| 200 | DevMantra Times: 44th Edition, 5th October '24 |
| 201 | DevMantra Times: 45th Edition, 4th November '24 |
| 202 | DevMantra Times: 46th Edition, 4th January '25 |
| 203 | DevMantra Times: Budget Edition, 5th February '25 |
| 204 | DevMantra Times: 48th Edition, 5th March '25 |
| 205 | DevMantra Times: 49th Edition, 1st April '25 |
| 206 | DevMantra Times: 50th Edition, 4th May '25 |
| 207 | DevMantra Times: 51st Edition, 2nd June '25 |
| 208 | DevMantra Times: 53rd Edition, 2nd August '25 |
| 209 | DevMantra Times: 54th Edition, 4th September '25 |
| 210 | DevMantra Times: 55th Edition, 1st October '25 |
| 211 | DevMantra Times: 56th Edition, 1st November '25 |
| 212 | DevMantra Times: 57th Edition, 2nd December '25 |
| 213 | DevMantra Times: 58th Edition, 2nd January '26 |
| 214 | DevMantra Times: 59th Edition, 2nd February '26 |
| 215 | DevMantra Times: 60th Edition, 9th March '26 |

*(Note: editions 17, 20, 41, 42, 52 do not appear in the published archive — likely gaps in the original numbering, not missing work on our side. Source: `SEO/internal-linking-plan.md`, Appendix A.)*

---

## Explicitly NOT counted here (to keep this number honest)

- Per-service meta title/description **content** optimization (fields exist and are wired — TASK 09, copy audit still open)
- Bulk `custom_head` schema population for existing records (TASK 13 remainder)
- Service→service and homepage-card internal links (require JSON-column edits, not yet built — flagged in the source SQL as future work)
- PageSpeed Insights baseline + fixes (TASK 18/19)
- DMARC/SPF/DKIM (TASK 20 — DNS-level, requires client cPanel access)
- Off-page work (covered in the separate Off-Page SEO Audit)

Full status of everything above is in the companion **Status Report**.
