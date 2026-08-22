# DevMantra — Deployment Checklist: 2026-08-06 On-Page SEO Batch

**Prepared by:** Digitech Solutions
**Scope:** the fixes below were made directly to your local `Devmantranew` repo this session. Nothing has touched production — per your standard workflow (`production.md`), these need a manual upload to cPanel + the DB script run in phpMyAdmin before they go live. This list is the exact set of what changed and what to do with each item.

**Decisions this batch was built against:** canonical domain = **non-www** (`https://devmantra.com`); homepage positioning = **Virtual CFO** as primary lead service.

---

## Files changed (upload to `/home2/devmasjc/devmantra/` unless noted)

| # | File | What changed | Deploy note |
|---|---|---|---|
| 1 | `public/robots.txt` | `Sitemap:` and `Host:` directives switched from `www.devmantra.com` to `devmantra.com`, to match what's actually live | Upload to `public_html/` (this is a `public/` file) |
| 2 | `public/llms.txt` | All 32 `www.devmantra.com` links switched to `devmantra.com` | Upload to `public_html/` |
| 3 | `public/.htaccess` | Reordered the two redirect rules so `http://www.devmantra.com` and `https://www.devmantra.com` both resolve in **one** 301 hop instead of two (was: https-upgrade first, then www-strip — now: www-strip first, landing straight on the final HTTPS non-www URL) | Upload to `public_html/`. **Test after upload:** `curl -I http://www.devmantra.com` should show exactly one redirect, landing on `https://devmantra.com` |
| 4 | `production.md` | Internal doc only — updated all redirect-test instructions and the `APP_URL` reference to non-www, so this doc stops contradicting the live site | Repo housekeeping, not deployed |
| 5 | `resources/views/frontend/home.blade.php` | Added `@section('meta_description', ...)` — homepage previously had **no** page-specific description and was silently using the sitewide fallback. New copy leads with Virtual CFO per your decision (161 chars) | Upload to `devmantra/` |
| 6 | `resources/views/frontend/service-detail.blade.php` | Added automatic `FAQPage` schema generation from each service's existing on-page FAQ section (the "Any Questions? We've Got You." block you already have per service) — only emits schema if a service actually has FAQ content, so structured data never gets ahead of visible content | Upload to `devmantra/`, then run `php artisan view:cache` |

## ⚠️ About the `&amp;amp;` title bug — no code fix needed, but a deploy check is required

I went looking for this in the local repo and **the local `home.blade.php` title is already correct** — it's a plain `&`, not a pre-encoded one. That means whatever's live on production is a **stale deployed copy**. When you upload item #5 above (which touches this same file), the encoding bug should disappear automatically. **After deploying, view-source the live homepage and confirm the `<title>` reads `...Financial & Advisory Services...` with a plain "&", not `&amp;amp;`.** If it's still wrong after deploy + `view:cache`, the value is coming from a database setting instead of this file and will need a DB-level fix — let me know and I'll write that SQL too.

## SQL to run in phpMyAdmin (in order)

**You told me your local mirror is `devmantra_production` in XAMPP MySQL (with `devmantra` as the Laravel `.env` default) — I couldn't reach either from this session (no network path from my sandbox to your local MySQL), so these are ready-to-run scripts, same as your existing `SEO/sql/01_...` pattern. Confirm which database name is the one you want these applied to before running.**

1. **`SEO/sql/02_service_meta_rewrite_2026-08-06.sql`** *(new)* — rewrites `meta_title` + `meta_description` for all 9 services (TASK 09). Wrapped in `START TRANSACTION` with a verification `SELECT` before `COMMIT` — check the output looks right before committing. Back up first.
2. **`SEO/sql/03_seo_field_schema_gap_audit_2026-08-06.sql`** *(new)* — **read-only**, no backup needed. One query, one row per content type, showing exactly how many records are still missing `meta_title`/`meta_description`/`og_image`/`canonical_url`/`custom_head`, plus which titles/descriptions are running long. Run this to scope the remaining TASK 12/13 content work with real numbers instead of guessing.

## Blocked / needs your input

- **PageSpeed Insights baseline (TASK 18/19):** Google's public API quota was exhausted from this session (shared quota, not specific to your site) — I could not pull automated Core Web Vitals numbers. Run https://pagespeed.web.dev manually against the homepage and one service page (mobile + desktop), or share a Google API key and I'll pull it programmatically next time.
- **Blog FAQ + FAQPage schema:** services already have a working FAQ section I could wire schema into (done, item #6 above). **Blogs have no FAQ mechanism at all** — no admin field, no template block. Building one is a real feature addition (admin UI + schema), not a quick fix, so I didn't build it unasked. Blogs *can* already carry FAQ schema today via the existing `custom_head` field if you want to hand-write JSON-LD for 1–2 priority blogs in the meantime — say the word and I'll draft it.
- **Google Business Profile / local SEO:** still needs direct GBP console access from you or your client — not reachable from this session.

## Recommended deploy order

1. Back up the DB.
2. Run SQL script #2 (read-only audit) first — no risk, gives you the current gap numbers for your own records.
3. Run SQL script #1 (service meta rewrite) — review the verification `SELECT` output, then `COMMIT`.
4. Upload the 3 `public/` files + `home.blade.php` + `service-detail.blade.php`.
5. `php artisan view:cache` (and `config:cache`/`route:cache` if you do those together per your usual routine).
6. Verify: view-source the homepage (title/meta description), one service page (FAQ schema in Rich Results Test), and `curl -I http://www.devmantra.com` (single-hop redirect).
7. If GSC is verified on the www property, add/confirm the non-www property too, since non-www is now the documented canonical everywhere.
