# SEO Task Tracker — DevMantra
> Last audited: 2026-05-12 | Branch: main
> Purpose: Ground-truth task status for the Claude SEO Project Manager Agent.
> Each task has a STATUS, evidence path(s), and notes on what remains.

---

## 🆕 2026-06-13 SESSION — Schema / On-Page / AEO / GEO sprint

**Corrected reality (verified against live site, not the stale May audit):**
Blogs, services, reports, the case study, newsletters, alerts, and events **already have**
meta_title, meta_description, and OG images populated. The May `seo-suggestions.md` audit is
obsolete. The real defects found and fixed today:

**Shipped (code — live in repo):**
1. **Schema auto-injection** — `blog-detail.blade.php` & `service-detail.blade.php` now fall
   back to `SchemaService::blogSchema()/serviceSchema()` + BreadcrumbList when `custom_head` is
   empty. **Every blog/service (incl. all new blogs) now emits valid JSON-LD automatically.**
   (Previously schema only appeared if `custom_head` was hand-filled → new blogs had none.)
2. **Title double-suffix bug fixed site-wide** — stored `meta_title`s ended in "— DevMantra"
   and the layout appended the brand again → "… — DevMantra — DevMantra". `frontend.blade.php`
   now de-duplicates the trailing brand (regex, idempotent) and reuses one `$dmFullTitle` for
   `<title>`, `og:title`, `twitter:title`. Verified against em-dash, hyphen, and clean cases.
3. **Organization schema enriched (E-E-A-T / GEO)** — added legalName, FinancialService type,
   foundingDate 2008, areaServed, `knowsAbout` (10 expertise entities), founder (CA Nidhi Tatia),
   PostalAddress (Bengaluru). `app/Services/SchemaService.php`.
4. **AEO** — visible FAQ section + matching `FAQPage` schema on `/about` (6 Q&As from one shared
   array so schema mirrors visible content). `frontend/about.blade.php`.
5. **GEO** — `public/llms.txt` fully rewritten: current content, key facts (NAP, ICAI FRN,
   ₹5,000 Cr, founders, Korea Desk), removed banned phrase ("trusted partner") and
   robots-disallowed `?page=`/`?tag=` URLs.
6. **Homepage H1** (TASK 15) — homepage hero headline was `<h4 fs-68>` with **no H1 on the page**.
   Promoted to `<h1>` (classes unchanged → zero visual change). `components/service-sections/page-hero.blade.php`.

**Deliverable for client/PM to run:**
- `SEO/sql/01_onpage_meta_fixes_2026-06-13.sql` — idempotent: audit + strip embedded brand suffix
  from stored meta_title (frees varchar(60) space) + backfill empty canonical_url across all 7
  content types + newsletter meta backfill. Run in phpMyAdmin → devmantranew (back up first).

**Remaining / follow-ups:**
- Apply the SQL above in phpMyAdmin.
- Deploy the blade/PHP changes to production, then `php artisan view:cache`.
- Validate with Google Rich Results Test (blog, service, /about FAQ, homepage Org) + resubmit sitemap in GSC.
- Per-service FAQ blocks (extend the /about pattern to service pages) — next AEO win.
- TASK 20 DMARC/SPF/DKIM — DNS task (human).
- Internal linking (TASK 10) — **completed in the 2026-06-13 session (bulk SQL deployed).**

---

---

## Legend
- ✅ DONE — Fully implemented and verified in codebase
- 🟡 PARTIAL — Built but incomplete or not matching spec
- ❌ PENDING — Not started or no evidence found

---

## Foundation Tasks (TASKS 01–08)

---

### ✅ TASK 01 — Build `_seo-panel.blade.php` Reusable SEO Partial
**Status:** DONE

**Evidence:**
- `resources/views/admin/partials/_seo-panel.blade.php`

**What's built:**
- Meta Title (max 60 chars) with live character counter
- Meta Description (max 160 chars) with live character counter
- OG Image upload (stored to `storage/seo/og-images/`) + URL fallback
- Canonical URL field
- Noindex checkbox (injects `noindex, nofollow`)
- Custom Head Code textarea (for raw HTML / JSON-LD injection)
- Collapsible accordion UI, auto-opens on validation errors

---

### ✅ TASK 02 — Add Global SEO Settings to Admin Panel
**Status:** DONE

**Evidence:**
- `resources/views/admin/account/settings.blade.php`
- `resources/views/admin/schema/index.blade.php`

**Settings available:**
- `seo_default_title` — site-wide fallback title
- `seo_default_description` — fallback meta description
- `seo_default_og_image` — fallback OG image
- `seo_robots_mode` — global index/noindex toggle
- `seo_google_verification` — Google Search Console tag
- `seo_ga4_id` — GA4 tracking ID
- `seo_gtm_id` — GTM container ID
- `seo_title_separator` — customizable separator (default: "—")
- `schema_company_name`, `schema_logo_url`, `schema_website_url`, `schema_area_served`

---

### ✅ TASK 03 — Build `SchemaService.php` for Dynamic Schema Markup
**Status:** DONE

**Evidence:**
- `app/Services/SchemaService.php`

**Schema types implemented:**
- `organization()` — Organization with sameAs social links
- `localBusiness()` — LocalBusiness with address, phone, email, hours (from ContactSetting model)
- `blogSchema($blog)` — BlogPosting
- `caseStudySchema($caseStudy)` — Article (case study type)
- `reportSchema($report)` — Report
- `newsletterSchema($newsletter)` — Article (newsletter type)
- `serviceSchema($service)` — Service
- `faqSchema($faqs)` — FAQPage with Q&A pairs
- `breadcrumb($items)` — BreadcrumbList
- Auto image resolution: og_image → featured_image fallback chain
- Schema preview panel in admin at `/admin/schema`

---

### ✅ TASK 04 — Add SEO Panel to All Admin Edit Views
**Status:** DONE

**Evidence — Views with `_seo-panel` included:**
1. `resources/views/admin/blogs/create.blade.php`
2. `resources/views/admin/blogs/edit.blade.php`
3. `resources/views/admin/case-studies/edit.blade.php`
4. `resources/views/admin/newsletters/edit.blade.php`
5. `resources/views/admin/reports/edit.blade.php`
6. `resources/views/admin/services/edit.blade.php`

**Note:** Check if `alerts/edit.blade.php` and `events/edit.blade.php` also need it — not confirmed in audit.

---

### ✅ TASK 05 — Build Dynamic Sitemap
**Status:** DONE — 2026-05-12

**What was built (no spatie needed — custom controller):**
- `app/Http/Controllers/SitemapController.php` — queries all published content live
- `resources/views/sitemap.blade.php` — XML template with proper priorities and real `lastmod`
- Route added to `routes/web.php`: `GET /sitemap.xml`
- `.htaccess` rule added: `RewriteRule ^sitemap\.xml$ index.php [L]` — bypasses the old static file
- Covers: services (0.90), blogs, case studies, reports (0.70), newsletters, alerts, events, careers (0.60)
- Static pages hardcoded with appropriate `changefreq`

**HUMAN ACTION REQUIRED on production:**
- Delete `/home2/devmasjc/public_html/sitemap.xml` after uploading the new `.htaccess`
- Visit `https://www.devmantra.com/sitemap.xml` to verify it renders live XML
- Re-submit sitemap in GSC: Sitemaps → Remove old → Add `https://www.devmantra.com/sitemap.xml`

---

### ✅ TASK 06 — Build Alt Tag Management System
**Status:** DONE

**Evidence:**
- `app/Models/ImageMeta.php`
- `database/migrations/2026_05_07_000002_create_image_meta_table.php`

**What's built:**
- `image_meta` table: `rel_path` (unique), `alt_text`, `alt_text_suggestion`
- Admin routes:
  - `POST /admin/media/save-alt` — manual save
  - `POST /admin/media/suggest-alts` — bulk AI generation via Grok API
  - `POST /admin/media/{imageMeta}/suggest-alt` — single AI suggestion
- Console command: `GenerateImageAltText` for bulk generation

---

### ✅ TASK 07 — HOTFIX: Fix Broken Meta Tags on All Existing Pages
**Status:** DONE — 2026-05-12

**All content models now have full SEO fields:**
- `database/migrations/2026_05_07_000001_add_seo_fields_to_content_tables.php` — blogs, services, case_studies, reports, newsletters
- `database/migrations/2026_05_12_000001_add_full_seo_fields_to_alerts_and_events.php` — **NEW** alerts, events
- All 7 content types now have: `meta_title`, `meta_description`, `og_image`, `canonical_url`, `noindex`, `custom_head`
- Full SEO panel added to: `admin/alerts/edit.blade.php`, `admin/events/edit.blade.php`
- `AlertController` + `EventController` both validate and save SEO fields
- `alert-detail.blade.php` + `events.blade.php` both render full SEO sections (title, description, og:image, canonical, noindex)

**HUMAN ACTION REQUIRED:**
- Run `php artisan migrate` on production to apply the new alerts/events SEO columns
- Content task: fill `meta_title` + `meta_description` for existing alert/event records via admin (see TASK 12)

---

### ✅ TASK 08 — Gate India-Europe Tax Calculator with Lead Capture
**Status:** DONE — 2026-05-12

**What was done:**
- Modified `ccGo()` in `cost-calculator.blade.php`: navigating to Step 6 (Results) now checks `ccLeadUnlocked`. If not unlocked, shows the lead gate overlay first — user must submit their details to see results
- After successful lead submission, `ccGo(TOTAL_STEPS)` is called automatically — user lands on results immediately
- Added admin email notification in `CostBenchmarkController::storeLead()`: sends a plain-text email to the admin email from ContactSetting with name, email, phone, company, IP and a link to `/admin/calculator-leads`
- Email sending is wrapped in `try/catch` — lead is always saved even if email fails

**Remaining (content/UX):**
- Add a more prominent success toast or confirmation message after lead submission (currently uses existing toast system)

---

## Content & Optimization Tasks (TASKS 09–13)

---

### 🟡 TASK 09 — Optimize All Service Page Title Tags & Meta Descriptions
**Status:** PARTIAL — Fields exist, content optimization unverified

**What's done:**
- SEO panel added to `admin/services/edit.blade.php`
- `meta_title`, `meta_description` columns exist on `services` table
- Frontend service detail page renders these fields dynamically

**What's unverified:**
- Are all service records in DB populated with optimized, keyword-targeted meta titles and descriptions?
- Do titles follow the pattern: `Primary Keyword | DevMantra` (max 60 chars)?
- Are descriptions 140–160 chars with a CTA?

**Remaining work:**
- [ ] Export all service records: `SELECT id, name, meta_title, meta_description FROM services`
- [ ] Audit each for keyword targeting, length, and uniqueness
- [ ] Rewrite any generic or empty meta tags

---

### ✅ TASK 10 — Build Internal Linking Structure Across All Pages
**Status:** DONE — Bulk SQL deployed to devmantranew DB on 2026-06-13

**What was delivered (`bulk_internal_links.sql`):**

- **TASK 10a** — Pillar → Cluster architecture map: 9 service pillar pages, 8 blogs + 40 newsletters + 1 alert mapped to primary/secondary pillars. Priority matrix (P0–P3) defined.
- **TASK 10b** — In-content links: 8 anchor tags inserted via `REPLACE()` into 7 blogs, wrapping exact keyword phrases to point to relevant service pages.
- **TASK 10c** — Related Services callout (`dm-blog-callout--tip`, gold) appended via `CONCAT()` to bottom of all 8 blogs. 2 contextual service links each.
- **TASK 10d** — Related Reading callout (`dm-blog-callout--info`, navy) appended to 7 blogs as blog→blog cross-links for topical depth.
- **TASK 10e** — Alert page (`/alert/importance-process-of-income-tax-clearance-certificate`): 1 in-content link + related services block. No longer an orphan.
- **TASK 10f** — All 40 published newsletter editions: `DEV MANTRA SERVICES` callout block appended (Finance & Compliance + Virtual CFO links). All newsletters de-orphaned.
- **TASK 10g** — Full SQL file generated, verified, and deployed via phpMyAdmin. All UPDATEs are idempotent (`NOT LIKE` guards). Step-1 single-blog test confirmed before bulk run.

**Verified:** Links confirmed present in DB via SELECT verification queries + page source (Ctrl+U).

**Not covered (requires JSON editing — out of SQL scope):**
- Service → Service cross-sell links (`service_sections` JSON)
- Homepage service card keyword anchors (`page_sections` JSON)
- Breadcrumb template changes (Blade-level)

---

### ❌ TASK 11 — Write & Publish 10 Priority SEO Blog Posts
**Status:** PENDING — Content task, no code evidence

**Remaining work:**
- [ ] Identify 10 target keywords with search volume + low competition
- [ ] Draft and publish 10 blog posts via admin panel
- [ ] Each post needs: meta_title, meta_description, og_image, internal links, schema

---

### ❌ TASK 12 — Bulk Update All Blog Meta Tags via Claude Code (DB)
**Status:** PENDING

**Remaining work:**
- [ ] Run audit query: find all blogs, reports, newsletters, case studies with NULL meta fields
- [ ] Use Claude Code to generate optimized meta_title + meta_description for each
- [ ] Bulk update via DB seed or artisan command

---

### 🟡 TASK 13 — Bulk Add Schema Markup to All Pages via Claude Code (DB)
**Status:** PARTIAL — Alert/Event schema done; FAQ and bulk DB population pending

**What's done:**
- SchemaService generates schema for all content types
- Homepage: Organization + LocalBusiness + BreadcrumbList
- Detail pages (blog, service, case study, report, newsletter): type-specific schema + BreadcrumbList
- Contact page: LocalBusiness + BreadcrumbList
- `alert-detail.blade.php`: **NEW** — NewsArticle schema + BreadcrumbList auto-generated from model data
- `events.blade.php`: **NEW** — Event schema + BreadcrumbList auto-generated from model data
- `custom_head` field on all content models for manual JSON-LD injection per page

**Remaining (content tasks):**
- [ ] Verify FAQ schema is rendered on service/blog pages that have FAQ sections
- [ ] Bulk-populate `custom_head` with additional schema for existing content via admin

---

## Process & Reporting Tasks (TASK 14)

---

### ❌ TASK 14 — Monthly SEO Review & Reporting SOP
**Status:** PENDING — Process/document task

**Remaining work:**
- [ ] Define monthly SEO review checklist (rankings, traffic, crawl errors, Core Web Vitals)
- [ ] Set up Google Search Console + GA4 reporting cadence
- [ ] Create reporting template (Notion / Google Sheets)
- [ ] Document SOP: who reviews, what tools, what actions triggered by which signals

---

## Technical SEO Tasks (TASKS 15–20)

---

### 🟡 TASK 15 — Fix Missing H1 + Extend Meta Description on Homepage
**Status:** PARTIAL — Needs manual verification

**What's done:**
- Global SEO settings include `seo_default_title` and `seo_default_description`
- Frontend layout renders meta description dynamically

**What's unverified:**
- Does the homepage have a visible `<h1>` tag in the rendered HTML?
- Is the homepage meta description >120 chars, keyword-rich, with a CTA?
- Is there only ONE `<h1>` on the page?

**Remaining work:**
- [ ] Open homepage in browser, inspect for `<h1>` tag
- [ ] Check `resources/views/frontend/home.blade.php` for H1 placement
- [ ] Update homepage meta description in admin settings if too short

---

### ✅ TASK 16 — Force HTTP → HTTPS Redirect (Site-wide)
**Status:** DONE — 2026-05-12

**What was done:**
- Added to `public/.htaccess` inside `<IfModule mod_rewrite.c>`:
  ```apache
  # Force HTTPS
  RewriteCond %{HTTPS} off
  RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

  # Force www
  RewriteCond %{HTTP_HOST} !^www\. [NC]
  RewriteRule ^ https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
  ```
- Added `URL::forceScheme('https')` in `AppServiceProvider::boot()` (production only) — ensures all Laravel-generated asset/route/url() calls use https://
- Also fixed `og:url` and canonical tag: changed `url()->current()` → `request()->url()` to strip query strings from canonicals

**HUMAN — Test after upload:**
- Run: `curl -I http://devmantra.com` → should return `301` to `https://www.devmantra.com`
- Run: `curl -I https://devmantra.com` → should return `301` to `https://www.devmantra.com`
- Check GSC → Settings → HTTPS: should show green/valid

---

### ✅ TASK 17 — NAP Consistency + LocalBusiness Schema (Local SEO)
**Status:** DONE

**Evidence:**
- `app/Services/SchemaService.php` → `localBusiness()` method
- Source model: `ContactSetting` (single source of truth for NAP)
- Schema output includes: `name`, `telephone`, `email`, `address` (PostalAddress), `openingHours`, `sameAs` (social links)
- Rendered on: Homepage, Contact page, and all detail pages
- Admin editable at: `admin/contact-settings/edit`

**Note:** All pages pull from `ContactSetting` model — NAP is consistent by design.

---

### 🟡 TASK 18 — Site Performance Optimization (Page Size, Minify, HTTP/2)
**Status:** PARTIAL — 2026-05-12

**What's done:**
- `loading="lazy"` added to all below-fold content images across: `blog-detail`, `alert-detail`, `case-study-detail`, `report-detail`, `newsletter-detail`, `service-detail` (sidebar + related cards)
- Browser caching headers already in `public/.htaccess` (images: 1 year, CSS/JS: 1 month)
- Gzip compression already configured in `public/.htaccess`

**Remaining (server/human actions):**
- [ ] Run `npm run build` locally and upload fresh minified assets to production
- [ ] Enable HTTP/2 in cPanel → MultiPHP Manager or contact host
- [ ] Run PageSpeed Insights: https://pagespeed.web.dev — record baseline (mobile + desktop)
- [ ] Compress images: convert uploaded JPGs/PNGs to WebP (cPanel → Image Manager or ImageMagick)

---

### ❌ TASK 19 — PageSpeed Insights Optimization (Mobile + Desktop)
**Status:** PENDING — requires live audit first

**What's done:**
- Google Fonts already non-blocking (media="print" trick in `frontend.blade.php:99-101`)
- FontAwesome already non-blocking (`media="print"` trick in `frontend.blade.php:110`)
- `loading="lazy"` now on all below-fold images

**Remaining (needs live PageSpeed run first):**
- [ ] Run https://pagespeed.web.dev on homepage — get real LCP, CLS, FID numbers
- [ ] Target: Mobile ≥ 80, Desktop ≥ 90
- [ ] Add `fetchpriority="high"` to the hero LCP image once identified from PageSpeed report
- [ ] Address specific issues from Lighthouse (CLS shifts, render-blocking resources)

---

### ❌ TASK 20 — Email Privacy + DMARC Mail Record
**Status:** PENDING — DNS-level task

**Remaining work:**
- [ ] Log into cPanel DNS Zone Editor
- [ ] Verify SPF record exists: `v=spf1 include:... ~all`
- [ ] Add DKIM record (generate via cPanel Email → Email Deliverability)
- [ ] Add DMARC record: `v=DMARC1; p=quarantine; rua=mailto:dgtechsolutions23@gmail.com`
- [ ] Test with: https://mxtoolbox.com/dmarc.aspx
- [ ] Check email headers on sent emails for DMARC pass

---

## Summary Table

| Task | Title | Status |
|------|-------|--------|
| TASK 01 | Build `_seo-panel.blade.php` | ✅ DONE |
| TASK 02 | Add Global SEO Settings to Admin | ✅ DONE |
| TASK 03 | Build `SchemaService.php` | ✅ DONE |
| TASK 04 | Add SEO Panel to All Admin Edit Views | ✅ DONE |
| TASK 05 | Build Dynamic Sitemap | ✅ DONE |
| TASK 06 | Build Alt Tag Management System | ✅ DONE |
| TASK 07 | Fix Broken Meta Tags on All Pages | ✅ DONE |
| TASK 08 | Gate Tax Calculator with Lead Capture | ✅ DONE |
| TASK 09 | Optimize Service Page Meta Tags | 🟡 PARTIAL |
| TASK 10 | Build Internal Linking Structure | ✅ DONE |
| TASK 11 | Write & Publish 10 SEO Blog Posts | ❌ PENDING |
| TASK 12 | Bulk Update Blog Meta Tags (DB) | ❌ PENDING |
| TASK 13 | Bulk Add Schema Markup (DB) | 🟡 PARTIAL |
| TASK 14 | Monthly SEO Review & Reporting SOP | ❌ PENDING |
| TASK 15 | Fix Missing H1 + Homepage Meta Desc | 🟡 PARTIAL |
| TASK 16 | Force HTTP → HTTPS Redirect | ✅ DONE |
| TASK 17 | NAP Consistency + LocalBusiness Schema | ✅ DONE |
| TASK 18 | Site Performance Optimization | 🟡 PARTIAL |
| TASK 19 | PageSpeed Insights Optimization | ❌ PENDING |
| TASK 20 | Email Privacy + DMARC Record | ❌ PENDING |

**Done: 10 | Partial: 5 | Pending: 5**

---

## Key Files Reference

| Purpose | Path |
|---------|------|
| SEO partial | `resources/views/admin/partials/_seo-panel.blade.php` |
| Schema service | `app/Services/SchemaService.php` |
| Frontend layout (meta output) | `resources/views/layouts/frontend.blade.php` |
| SEO migration (content tables) | `database/migrations/2026_05_07_000001_add_seo_fields_to_content_tables.php` |
| Alt tag migration | `database/migrations/2026_05_07_000002_create_image_meta_table.php` |
| ImageMeta model | `app/Models/ImageMeta.php` |
| Global settings view | `resources/views/admin/account/settings.blade.php` |
| Schema admin preview | `resources/views/admin/schema/index.blade.php` |
| Robots.txt | `public/robots.txt` |
| Dynamic sitemap controller | `app/Http/Controllers/SitemapController.php` |
| Dynamic sitemap view | `resources/views/sitemap.blade.php` |
| Calculator controller | `app/Http/Controllers/CostBenchmarkController.php` |
| Calculator lead model | `app/Models/CalculatorLead.php` |
| Alert SEO migration | `database/migrations/2026_05_12_000001_add_full_seo_fields_to_alerts_and_events.php` |
