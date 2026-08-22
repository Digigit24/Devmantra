# Client Site Build Playbook

A repeatable, opinionated prompt-chain for building scalable, SEO-first, client-editable Laravel sites with Claude Code. Distilled from the Devmantra build.

---

## 0. What this is

This is **not** a starter codebase. It's a **prompt chain** — a sequence of prompts (with human-input gates) that drives Claude Code from "blank repo / existing HTML site" to "production-ready Laravel app with custom admin".

Two entry paths converge into the same backbone after Phase 1:

```
   ┌──────────────────────────┐
   │ A. Greenfield template   │──┐
   └──────────────────────────┘  │
                                 ├──▶ Phase 1: Requirements ──▶ 2 ──▶ 3 ──▶ 4 ──▶ 5 ──▶ 6 ──▶ 7
   ┌──────────────────────────┐  │
   │ B. Convert existing HTML │──┘
   └──────────────────────────┘
```

Each phase has: (1) a **goal**, (2) **human input** required, (3) a **Claude prompt** (copy-paste), (4) **acceptance criteria**.

---

## 1. The Architecture Recipe (non-negotiables)

Every client site follows this skeleton. Do not deviate without a reason written into Phase 1 notes.

| Layer | Choice | Why |
|---|---|---|
| Framework | Laravel 12 + Breeze auth | Stable, easy to hire for |
| Frontend | Blade + Tailwind v3 + Alpine + Vite | No SPA tax, fast TTFB, SEO-friendly |
| Admin | **Custom Blade** admin (no Filament/Nova) | Total control over UX, easy to brand-skin per client |
| Auth | `users.is_admin` boolean + `AdminMiddleware` | One flag is enough for solo-client sites; upgrade to spatie/permission only if needed |
| Editor | Summernote WYSIWYG + Gallery + AI alt-text | Familiar to non-tech clients |
| Page model | **Page → PageSection (type + JSON data)** | Client composes pages from typed sections |
| Detail model | **Service → ServiceSection (type + JSON data)** | Same builder pattern for any "detail-heavy" entity |
| Content models | SoftDeletes, auto-slug w/ collision suffix, `status` (draft/published), `published_at`, `is_featured` | Consistent CRUD, trash/restore, scheduling |
| SEO fields | `meta_title`, `meta_description`, `og_image`, `canonical_url`, `noindex`, `custom_head` on every public content table | Per-page control + raw JSON-LD injection |
| Caching | `Cache::remember()` for nav, footer, home sections (300–600s) | Cheap performance win |
| Forms | Throttled `POST` endpoints + dedicated lead model + admin inbox | Captures every conversion, never email-only |
| Brand rules | `BRAND_<CLIENT>_RULES.md` at repo root | Forces consistent blog/content HTML |

**Reference implementation:** see Devmantra models, controllers, and views — particularly:
- `app/Models/Page.php`, `app/Models/PageSection.php`
- `app/Models/ServiceSection.php` (study `sectionTypes()` — the section schema registry)
- `app/Http/Controllers/Admin/PageSectionController.php`
- `resources/views/admin/service-sections/partials/_builder.blade.php` (the JS section builder)
- `resources/views/admin/partials/_seo-panel.blade.php` (drop-in SEO panel)

---

## 2. The Prompt Chain (overview)

| Phase | Goal | Human input gate? |
|---|---|---|
| **0** | Pick entry path A or B | Yes |
| **1** | Requirements + content model | **Yes — interview** |
| **2A** | Bootstrap Laravel from skeleton | No |
| **2B** | Convert existing HTML → Blade | Yes (provide files) |
| **3** | Generate models, migrations, factories | Yes (review schema) |
| **4** | Build admin CRUD + section builder | Yes (review section types) |
| **5** | Frontend routes, controllers, views | No |
| **6** | SEO panel, sitemap, schema.org, OG | Yes (provide brand JSON-LD) |
| **7** | Lead forms, settings, tests, deploy | Yes (env, DNS, secrets) |

---

## Phase 0 — Pick entry path

**Human decision:** Does the client have an existing site you must preserve visually?

- **Path A (Greenfield):** new design or designer mockups only. → Phase 2A
- **Path B (Migration):** existing HTML/WordPress/static site to preserve pixel-for-pixel. → Phase 2B

---

## Phase 1 — Requirements & Content Model (Human-driven interview)

**Goal:** lock the content model before writing any code. This is the single most important phase. Skipping it produces models you'll rewrite in Phase 4.

**Human input gate:** you sit with the client (or the client brief) and answer the interview. Claude Code drives the interview.

### Prompt 1.1 — Requirements interview

```
You are a senior Laravel architect. Run a requirements interview for a new
client site. Use the AskUserQuestion tool one batch at a time. Ask in this order;
do not skip steps:

1. Client name, industry, primary audience.
2. List every page type the site needs (e.g. home, about, services, blog,
   case-studies, careers, events, alerts, reports, newsletter, contact,
   privacy). Mark each as: STATIC (one fixed page) or COLLECTION (many items).
3. For each COLLECTION, ask:
   - Does the client need to add/edit items themselves? (assume yes)
   - Fields required (title, slug, excerpt, body, hero image, gallery,
     tags, category, published_at, featured flag, custom fields)
   - Does each item have a long detail page composed of multiple sections?
     (If yes, we'll generate a SectionBuilder for it like ServiceSection.)
4. For STATIC pages, ask: which sections (hero, feature grid, FAQ, CTA, etc.)
   and which must be client-editable.
5. Forms: list every lead form (contact, newsletter signup, careers,
   calculator, demo request). For each: fields, where leads go (admin inbox,
   email, webhook).
6. Integrations: Google Analytics, Meta Pixel, HubSpot, Mailchimp, Calendly,
   payment gateway? Capture IDs/keys placeholders only — do not request real
   secrets.
7. SEO non-negotiables: target keywords per page type, schema.org types to
   emit (Organization, Article, Service, FAQPage, BreadcrumbList).
8. Brand: primary/accent colors (hex), font family, logo path, tone-of-voice
   one-pager. Will become BRAND_<CLIENT>_RULES.md.
9. Admin users: how many, named accounts or shared, any role separation
   beyond admin/non-admin?
10. Hosting: shared host / VPS / Forge / Vapor / Cloudways? PHP version?
    MySQL or Postgres?

After the interview, write the answers to `docs/requirements.md` with these
sections: Client, Pages, Collections, Static Pages, Forms, Integrations, SEO,
Brand, Admin, Hosting. Stop. Do not begin implementation.
```

**Acceptance criteria:** `docs/requirements.md` exists, every collection has its field list, every static page has its section list.

---

## Phase 2A — Bootstrap from skeleton (Greenfield)

**Goal:** working Laravel 12 install with the Devmantra conventions baked in.

### Prompt 2A.1

```
Bootstrap a fresh Laravel 12 app at the repo root. Steps:

1. composer create-project laravel/laravel . "12.*"
2. Install: laravel/breeze (dev), then `php artisan breeze:install blade`.
3. Add Tailwind v3, Alpine, axios (npm). Confirm Vite builds.
4. Add `is_admin` boolean to `users` table via migration. Default false.
5. Create `app/Http/Middleware/AdminMiddleware.php`:
   - Aborts 403 unless `auth()->user()?->is_admin`.
   - Register alias `admin` in bootstrap/app.php.
6. Create empty admin scaffold: `routes/admin.php` (loaded from bootstrap),
   `app/Http/Controllers/Admin/DashboardController.php`,
   `resources/views/layouts/admin.blade.php` (sidebar + top bar, brand
   color CSS vars: --brand-primary, --brand-accent, --brand-bg, --brand-text).
7. Create base frontend layout `resources/views/layouts/frontend.blade.php`
   with: <title>, meta description slot, OG/Twitter meta, canonical, JSON-LD
   slot, GA/Pixel slot — all driven by @yield/@stack.
8. Create `app/Models/SiteSetting.php` (key/value with all_cached()) and
   `app/Models/ContactSetting.php` (singleton) — copy the pattern from
   Devmantra references in this repo.
9. Seed one admin user (email/password from .env: ADMIN_EMAIL, ADMIN_PASS).
10. Verify: `php artisan serve` → / shows blank frontend layout, /login works,
    /admin redirects unauthenticated, /admin works after login.

Commit as: "chore: bootstrap laravel skeleton with admin shell".
```

**Acceptance:** `/admin` reachable as admin, `/` renders empty frontend layout, `php artisan test` is green.

---

## Phase 2B — Convert existing HTML to Blade (Migration)

**Goal:** preserve the existing visual design 1:1 inside the new Laravel skeleton.

**Human input gate:** drop the existing site into `/static-source/` (HTML/CSS/JS/assets).

### Prompt 2B.1

```
The folder /static-source/ contains the current production site. Migrate it
into Laravel without changing visual output.

Steps:
1. First run Phase 2A bootstrap if Laravel isn't installed yet. Then continue.
2. Read every .html in /static-source/. Group them into:
   - Layouts (anything that shares header/footer)
   - Page templates (home, about, contact, etc.)
   - Detail templates (blog post, service page, etc.)
3. Extract the shared chrome into `resources/views/layouts/frontend.blade.php`
   and partials/header, partials/footer.
4. Convert each unique page to a Blade file under `resources/views/frontend/`.
   Replace static nav links with `{{ route(...) }}` placeholders (commented
   if route doesn't exist yet).
5. Move CSS/JS/images to `public/`. Update asset references to use
   `{{ asset('...') }}`. Do NOT compile via Vite yet — keep existing CSS files
   as-is to avoid visual regressions. Tailwind is for new admin only at this
   stage.
6. For repeated content blocks (testimonials, feature grids, FAQ items),
   identify the loop boundary and replace with `@foreach` over a placeholder
   variable. Leave a `// TODO: bind to Model` comment.
7. Add minimal routes in routes/web.php returning each view with hard-coded
   placeholder data so every page is browsable.
8. Stop. Output a `docs/migration-map.md` listing: original-file → blade-file
   → model-to-bind-later.

Do not delete /static-source/ — keep as reference. Commit as:
"feat: migrate static site to blade templates".
```

**Acceptance:** every original page is reachable at its new route, visually identical, with a `docs/migration-map.md` ready for Phase 3 binding.

---

## Phase 3 — Models, migrations, factories

**Goal:** turn `docs/requirements.md` into Eloquent models and tables using the Devmantra conventions.

### Prompt 3.1 — Generate models from requirements

```
Read `docs/requirements.md` (and `docs/migration-map.md` if it exists).
For every COLLECTION listed there, generate:

1. A migration following these conventions:
   - id, then domain fields, then SEO block (meta_title:string(60) nullable,
     meta_description:text nullable, og_image:string(500) nullable,
     canonical_url:string(500) nullable, noindex:boolean default false,
     custom_head:text nullable), then status enum('draft','published')
     default 'draft', is_featured boolean default false, sort_order int
     default 0, published_at timestamp nullable, timestamps, softDeletes.
   - slug column unique.
2. A model with: $fillable, SoftDeletes, HasFactory; scopes published(),
   featured(); boot() hook that auto-generates slug from title using
   ensureUniqueSlug() (copy from app/Models/Blog.php).
3. A factory in database/factories/ with sensible faker data and a
   published() state.
4. If the requirements mark this collection as "has detail sections",
   also generate <Name>Section model + migration (foreign key,
   section_type string, section_data json, sort_order int, is_active bool)
   and a sectionTypes() static map with at least: hero, overview,
   text-block, image-text, faq, cta. Mirror app/Models/ServiceSection.php.

For every STATIC page, do NOT create a model. Instead, ensure a row exists
in the `pages` table (create the pages + page_sections migration if absent,
mirroring Devmantra's schema). Pages get sections at runtime; no schema
changes needed per static page.

After generation: run `php artisan migrate`, seed one example row per
collection from the factory, and write a one-paragraph summary of the
schema to `docs/data-model.md`. Stop and wait for human review before
Phase 4.
```

**Human input gate:** review `docs/data-model.md`. Confirm field names, types, and the `sectionTypes()` list per detail model. Section type list is hard to change later — get it right here.

---

## Phase 4 — Admin CRUD + Section Builder

**Goal:** non-tech client can log in and edit everything.

### Prompt 4.1 — Generate admin CRUD

```
For every model created in Phase 3, generate an admin controller and
views following the Devmantra pattern. Reference files (study before
generating):
- app/Http/Controllers/Admin/BlogController.php (index/create/store/edit/
  update/destroy/trash/restore/forceDelete with search + status filter)
- app/Http/Controllers/Admin/ServiceSectionController.php (section CRUD,
  reorder, toggle, preview iframe endpoint)
- resources/views/admin/blogs/ (index, create, edit, trash)
- resources/views/admin/partials/_seo-panel.blade.php (SEO meta panel,
  include this on EVERY create/edit form)
- resources/views/admin/service-sections/partials/_builder.blade.php
  (JS section builder bound to sectionTypes())

For each model:
1. Resource controller in app/Http/Controllers/Admin with trash/restore/
   forceDelete actions and inline validation.
2. Views: index (paginated, search, status filter, action buttons),
   create, edit, trash. Edit/create includes the _seo-panel partial.
3. Long-text fields use Summernote (copy init JS from existing blog
   create view); image uploads write to storage/public/<model>/ with
   `php artisan storage:link` already run.
4. Routes in routes/admin.php using Route::resource() + extra routes for
   trash/restore/force-delete/reorder/toggle.
5. Sidebar nav entry in layouts/admin.blade.php under the right group
   (Content / Forms / Settings / Media).

For section-enabled models (those with <Name>Section): generate the
nested /admin/<parent>/{id}/sections routes + builder view + preview
endpoint. Reuse the section builder JS — only the sectionTypes() map
differs per model.

Also generate (always, regardless of requirements):
- GalleryController with browse/upload/replace/delete + alt-text editor
- ContactSettingController (singleton edit page)
- SiteSettingController (key/value editor for site-wide strings)
- SubscriberController (admin: list + delete)
- AccountController (profile, password, settings for the admin user)

Commit per model as: "feat(admin): <model> crud + sections".
```

**Acceptance:** every collection editable end-to-end in `/admin`. Section builder reorders + previews. Trash/restore works. SEO panel saves all six SEO fields.

---

## Phase 5 — Frontend wiring

**Goal:** bind the Blade views (from 2A new design, or 2B converted statics) to the models.

### Prompt 5.1

```
Wire the frontend:

1. Create app/Http/Controllers/FrontendController.php with one method per
   route (home, <collection>Index, <collection>Show, contact, etc.). Use
   Cache::remember() for home page sections (300s) and any nav/footer
   queries (600s) — see Devmantra's FrontendController and
   AppServiceProvider view composers as reference.
2. For each Blade view, replace placeholder data with model bindings.
   Use the same variable names as the controller passes.
3. Section rendering: home + static pages iterate $page->activeSections,
   each section renders a partial at
   resources/views/frontend/sections/<section_type>.blade.php receiving
   $data = $section->section_data. Generate one partial per type listed
   in ServiceSection::sectionTypes() / PageSection equivalent.
4. Detail pages with section-enabled models do the same against
   $model->activeSections.
5. Header composer: cache published top-level nav items.
   Footer composer: cache top services + ContactSetting::instance().
   Both in app/Providers/AppServiceProvider.php (mirror Devmantra).
6. Pagination on every index. Related-items sidebar on every detail
   (same category, latest 3, exclude current).

Smoke test by visiting every route in routes/web.php as guest. Fix any
view that errors with missing keys by adding @isset / default values.

Commit as: "feat(frontend): bind views to models with caching".
```

**Acceptance:** every page renders real data, no N+1 queries on home/index pages (use `php artisan db:profile` or Telescope to verify), nav/footer come from cache.

---

## Phase 6 — SEO, sitemap, schema.org

**Goal:** every public page emits correct meta, OG, canonical, robots, and JSON-LD. This is where most client sites lose Google traffic — do it right.

### Prompt 6.1

```
Implement SEO infrastructure:

1. In layouts/frontend.blade.php @section('head'), render in this exact
   order:
   - <title>{{ $metaTitle ?? config('app.name') }}</title>
   - <meta name="description" content="{{ $metaDescription }}">
   - <link rel="canonical" href="{{ $canonical ?? url()->current() }}">
   - @if($noindex ?? false)<meta name="robots" content="noindex,nofollow">@endif
   - OG: og:title, og:description, og:image, og:type, og:url
   - Twitter: summary_large_image card
   - @stack('jsonld')  — for per-page JSON-LD
   - {!! $customHead ?? '' !!}  — for raw client overrides (CAUTION: only
     admins can set this, never user input)
2. Create app/View/Composers/SeoComposer.php that, for any view bound to a
   model with SEO fields, populates $metaTitle/$metaDescription/$canonical/
   $noindex/$customHead — with fallbacks to title / excerpt / current URL /
   false / null respectively. Register globally.
3. Emit JSON-LD per page type. Create app/Support/Schema.php with static
   helpers: organization(), article(Blog $b), service(Service $s),
   breadcrumbs(array $crumbs), faqPage(array $qa). Each returns an array
   to be pushed via @push('jsonld') wrapped in <script type="application/
   ld+json">.
4. Generate a sitemap at runtime: route GET /sitemap.xml served by
   SitemapController that streams XML built from all published content
   models + static pages. Cache 3600s. Also generate robots.txt with
   Sitemap: directive.
5. Add an `seo_redirects` table + middleware for 301s from old URLs to new
   — populated from docs/migration-map.md when coming from Phase 2B.

Verify: visit /sitemap.xml, view-source any blog post and validate JSON-LD
with `npx structured-data-testing-tool` or paste into Google Rich Results
Test. All canonicals absolute. No noindex on production pages.

Commit as: "feat(seo): meta + jsonld + sitemap + redirects".
```

**Human input gate:** paste the client's Organization JSON-LD (name, logo URL, sameAs social links). Drop into `app/Support/Schema.php::organization()`.

---

## Phase 7 — Forms, settings, tests, deploy

### Prompt 7.1 — Lead forms

```
For every form in docs/requirements.md (contact, newsletter, careers,
calculator, etc.):

1. Generate a model + migration for the submission (e.g. ContactSubmission,
   NewsletterSubscriber). Include a status enum where it makes sense
   (new/contacted/closed).
2. Public POST route with throttle:5,1 middleware. FormRequest class for
   validation. Honeypot field + simple time-trap.
3. Mailable to admin (queued) + autoresponder to user. Templates under
   resources/views/emails/.
4. Admin inbox controller + index/show/updateStatus/destroy.
5. Sidebar entry under "Leads" group.

Commit as: "feat(forms): lead capture + admin inbox".
```

### Prompt 7.2 — Tests

```
Write a smoke test suite (PHPUnit) covering:
- Every public route returns 200 as guest
- Every admin route returns 302 (redirect to login) as guest, 200 as admin
- Trash/restore round-trip for one content model
- One form submission persists and triggers a mail
- Sitemap returns valid XML containing at least one URL per published model

Run `php artisan test`. Fix until green. Commit as: "test: smoke coverage".
```

### Prompt 7.3 — Deploy

```
Generate deployment artifacts:
- .env.production.example with every key the app reads
- DEPLOY.md with step-by-step for the chosen host (from requirements.md):
  Forge / Vapor / Cloudways / plain VPS.
- Cron entry: php artisan schedule:run, php artisan queue:work
- Storage symlink, opcache config, queue worker supervisor
- Backup strategy: nightly mysqldump + storage/ tarball to S3 (commented if
  no S3 yet)
- Pre-launch checklist: APP_DEBUG=false, APP_ENV=production, HTTPS forced,
  admin password rotated, GA/Pixel IDs filled, robots.txt allows indexing.

Stop. Do not run the deploy. The human runs it.
```

---

## 3. Reusable prompt snippets

Save these to `.claude/snippets/` (or paste as needed):

### "Add a new content type later"

```
Add a new content type "<Name>" with fields: <list>. Follow the existing
pattern in this repo: SoftDeletes, auto-slug, SEO panel, draft/published
status, admin CRUD with trash/restore, frontend index + detail, sitemap
inclusion, related-items sidebar. Mirror Blog as the closest reference.
```

### "Add a new section type"

```
Add section type "<slug>" to <PageSection|ServiceSection>::sectionTypes()
with fields: <list>. Then create the frontend partial at
resources/views/frontend/sections/<slug>.blade.php that consumes
$data = $section->section_data and renders Tailwind-styled markup matching
the brand. Update the admin builder JS to render input fields for the new
schema.
```

### "Brand re-skin"

```
Re-skin the admin and frontend to the brand defined in BRAND_<CLIENT>_RULES.md.
Touch only: tailwind.config.js (theme.extend.colors), layouts/admin.blade.php
:root CSS vars, layouts/frontend.blade.php :root CSS vars, and the logo
asset. Do not change any markup structure.
```

---

## 4. Quality gates (every phase)

Before moving to the next phase, Claude Code must confirm:

- [ ] `php artisan test` green
- [ ] `php artisan route:list` shows no duplicate names
- [ ] No N+1 on index pages (eager-load relations)
- [ ] Every public form is throttled
- [ ] No raw `request()->input()` reaching the DB without validation
- [ ] No `{!! $userInput !!}` outside admin-controlled `custom_head`
- [ ] `.env` not committed; `.env.example` updated
- [ ] All images have alt text (run `php artisan tinker --execute="App\Models\ImageMeta::whereNull('alt')->count()"`)

---

## 5. Anti-patterns to refuse

If the client (or future-you) asks for any of these, push back:

1. **"Just use a page builder package"** — you lose section type discipline; clients add infinite layouts and the site becomes inconsistent. The typed section registry is the whole point.
2. **"Add Filament"** — fine for internal tools, but you give up brand control of the admin which is a selling point.
3. **"We don't need SoftDeletes"** — yes you do. Clients delete things by accident.
4. **"Skip the SEO fields, we'll add later"** — adding meta columns to ten tables retroactively is the worst migration of your life.
5. **"Inline editing on the frontend"** — out of scope. Admin-only edits keep the security model tractable.
6. **"Let's split admin into a SPA"** — Blade + Alpine ships a full admin in days. SPA admin takes weeks for no user-visible win.

---

## 6. File map cheat-sheet

When in doubt about where something goes:

```
app/
  Http/
    Controllers/
      FrontendController.php          # all public GET/POST
      Admin/*.php                     # all /admin/*
    Middleware/AdminMiddleware.php    # is_admin gate
  Models/
    <Content>.php                     # SoftDeletes, auto-slug, scopes
    <Content>Section.php              # type + JSON data + sectionTypes()
    Page.php / PageSection.php        # static page builder
    SiteSetting.php / ContactSetting.php
    <Lead>Submission.php              # form captures
  Support/Schema.php                  # JSON-LD helpers
  View/Composers/SeoComposer.php
  Providers/AppServiceProvider.php    # nav/footer cache composers
resources/views/
  layouts/{frontend,admin,guest}.blade.php
  frontend/{home,<content>-index,<content>-show,contact,...}.blade.php
  frontend/sections/<section_type>.blade.php
  admin/<resource>/{index,create,edit,trash}.blade.php
  admin/partials/_seo-panel.blade.php
  admin/<sections>/partials/_builder.blade.php
  emails/{contact-user,contact-admin,...}.blade.php
routes/
  web.php                             # public + auth
  admin.php                           # all admin (auth+admin mw)
docs/
  requirements.md                     # output of Phase 1
  data-model.md                       # output of Phase 3
  migration-map.md                    # output of Phase 2B
  DEPLOY.md                           # output of Phase 7
BRAND_<CLIENT>_RULES.md               # content HTML rules + colors
```

---

## 7. Lessons learned from Devmantra (read before starting Phase 1)

- **The section registry is the heart of the system.** Spend an hour on it. The list in `ServiceSection::sectionTypes()` defines what the client can build forever.
- **Cache nav + footer always.** They run on every request; uncached queries here dominate p95.
- **SEO fields belong in every public content table from day one.** Retrofitting is painful.
- **One `is_admin` flag beats role packages** until you have at least three distinct admin roles. YAGNI.
- **Summernote > TipTap/Quill** for non-tech clients — familiar toolbar, paste-from-Word works.
- **`BRAND_*_RULES.md` is enforced by the prompt, not the code.** Reference it in every "write a blog post" / "convert HTML" prompt so Claude produces compliant markup.
- **The `custom_head` escape hatch** is the difference between a client who can ship a Google-verified site and one who files a ticket every week. Keep it.
- **Throttle every public POST.** Forms get scraped within hours of go-live.
- **Soft-delete everything user-facing.** Hard-delete only via explicit `forceDelete` in admin.

---

## 8. How to use this playbook with Claude Code

1. `cd` into the client repo (empty or with `/static-source/`).
2. Open Claude Code.
3. Paste the Phase 0 question, then walk through phases in order.
4. **Do not skip the human-input gates.** They exist because Claude will happily invent a content model that looks plausible and costs you a week to undo.
5. After each phase, commit on the feature branch. The branch naming convention is `claude/build-<client>-phase-<n>`.
6. When stuck, reference the Devmantra files cited in section 1 — they are the canonical implementation.

---

*This playbook is the artifact. Treat it as code: version it, update it after every client build, and PR improvements back.*
