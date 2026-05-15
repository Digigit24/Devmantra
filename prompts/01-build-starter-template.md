# 01 — Build the Starter Template (one-time)

Run this **once** to produce your agency's reusable Laravel template repo. Every client engagement starts by cloning the output of this prompt.

> **Target output:** a GitHub repo named `digigit-laravel-template` (or whatever your agency picks) that you `git clone` for every new client.

---

## Pre-flight (human, not Claude Code)

Before running:

1. Create an empty GitHub repo: `digigit-laravel-template`.
2. Clone it locally: `git clone <url> && cd digigit-laravel-template`.
3. Open Claude Code in that empty folder.
4. Paste the prompt below.

---

## The prompt — paste this into Claude Code

```
You are bootstrapping a reusable Laravel 12 starter template that will be
cloned for every future client engagement. This is the agency's "skeleton"
— it must be opinionated, working, and easy to customise per client.

Reference architecture: see /home/user/Devmantra (the Devmantra repo) for
the canonical implementation of every pattern below. When in doubt, mirror
its file structure exactly.

## Goals

1. Bootable on `php artisan serve` immediately after `composer install &&
   npm install && npm run build && php artisan migrate:fresh --seed`.
2. Admin login works out of the box with a seeded admin user.
3. Frontend renders a placeholder home page using the section-builder
   pattern.
4. Every reusable piece (SEO panel, gallery, settings, lead capture) is
   present and wired — clients only add their content models on top.

## Steps (execute in order, commit per step)

### Step 1 — Laravel skeleton
- `composer create-project laravel/laravel . "12.*"`
- Install Breeze (Blade stack): `composer require laravel/breeze --dev` then
  `php artisan breeze:install blade`.
- Tailwind v3 already included; add Alpine.js and axios via npm.
- Confirm `npm run build` succeeds.

### Step 2 — Users + admin gate
- Migration: add `is_admin` boolean (default false) to users table.
- Middleware: `app/Http/Middleware/AdminMiddleware.php` aborts 403 unless
  `auth()->user()?->is_admin`. Register alias `admin` in
  bootstrap/app.php.
- Seeder: DatabaseSeeder creates one admin user from env vars
  `ADMIN_EMAIL` and `ADMIN_PASSWORD` (default to admin@example.com /
  password123).

### Step 3 — Routing
- `routes/admin.php` loaded by RouteServiceProvider (or
  bootstrap/app.php in Laravel 12), prefixed `/admin`, middleware
  `['auth','admin']`.
- Empty `app/Http/Controllers/Admin/DashboardController@index` returns
  `admin.dashboard` view.

### Step 4 — Layouts
- `resources/views/layouts/admin.blade.php`:
  Sidebar + topbar + content slot. Brand CSS variables in :root —
  `--brand-primary`, `--brand-accent`, `--brand-bg`, `--brand-text`,
  `--brand-sidebar`. Default to neutral grays so the template looks
  "unbranded" until a client overrides them.
- `resources/views/layouts/frontend.blade.php`:
  `<head>` includes — title, meta description, canonical, robots
  (conditional noindex), OG tags, Twitter card, @stack('jsonld'),
  {!! $customHead ?? '' !!}. Body has @yield('content') + footer + GA
  slot (commented).
- `resources/views/layouts/guest.blade.php` — login/register pages from
  Breeze, themed to the template colors.

### Step 5 — Core reusable models

Always-included models (every client uses them):

- `Page` — id, name (unique), title. hasMany sections, activeSections.
- `PageSection` — page_id, section_type, section_data (json),
  sort_order, is_active. Mirror Devmantra's PageSection exactly.
- `SiteSetting` — key, value. Static `get/set/setMany/all_cached`.
- `ContactSetting` — singleton (phone, email, address, social URLs,
  office hours, google_map_embed). Static `instance()`.
- `ImageMeta` — path, alt. Used by gallery for alt-text management.
- `NewsletterSubscriber` — email (unique), is_active, subscribed_at.
- `ContactSubmission` — name, email, phone, subject, message, status
  (new/contacted/closed), ip, user_agent, timestamps.

Migrations, models, factories for each. Soft deletes on
ContactSubmission only.

### Step 6 — SEO panel + composer
- `resources/views/admin/partials/_seo-panel.blade.php` — collapsible
  card with fields: meta_title (max 60, char counter),
  meta_description (max 160, char counter), og_image (file upload OR
  URL input), canonical_url, noindex checkbox, custom_head textarea.
  This partial is the contract every future content-type CRUD form
  uses: `@include('admin.partials._seo-panel', ['model' => $model])`.
- `app/View/Composers/SeoComposer.php` — populates $metaTitle,
  $metaDescription, $canonical, $noindex, $customHead from any view's
  bound `$seo` model. Register against `frontend.*`.
- `app/Support/Schema.php` — static helpers: organization(),
  breadcrumbs(array), faqPage(array), article($model), service($model).
  Each returns an array; views push wrapped <script type="application/
  ld+json"> via @push('jsonld').

### Step 7 — Sitemap + robots
- Route GET /sitemap.xml → SitemapController@index. Builds from all
  published Page rows for now (clients extend per-content-type later).
  Cache 3600s.
- public/robots.txt with `Sitemap:` directive.

### Step 8 — Admin: settings + gallery + subscribers + contact inbox
Generate these controllers and views (mirror Devmantra one-for-one):

- `Admin/PageSectionController` — index/store/update/destroy/reorder/
  toggle + preview iframe endpoint.
- `Admin/ContactSettingController` — singleton edit page.
- `Admin/SiteSettingController` — key/value editor + bulk save.
- `Admin/GalleryController` — index, browse, replace, delete,
  save-alt. Use Devmantra's gallery views as reference.
- `Admin/SubscriberController` — index + destroy.
- `Admin/ContactSubmissionController` — index, show, updateStatus,
  destroy.
- `Admin/AccountController` — profile, password, settings for the
  current admin.

Sidebar groups (in layouts/admin.blade.php):
- Dashboard
- Content (empty group — clients add resources here)
- Forms (Contact Submissions, Newsletter Subscribers)
- Media (Gallery)
- Settings (Site, Contact, Account)

### Step 9 — Section registry stub
- In `app/Models/PageSection.php` add `static sectionTypes()` returning
  five generic types every client needs: `hero`, `text-block`,
  `image-text`, `feature-grid`, `cta`. Each with label, icon, and
  fields schema. Future clients extend this list.
- Create the matching frontend partials at
  `resources/views/frontend/sections/<type>.blade.php` rendering
  Tailwind-styled, brand-variable-driven markup. No client-specific
  content.

### Step 10 — Section builder JS
- Copy `resources/views/admin/service-sections/partials/_builder.blade.
  php` from Devmantra into this template. Generalise so it accepts any
  builder URL prefix (e.g. /admin/pages/{page}/sections OR
  /admin/services/{service}/sections — clients reuse the same JS for
  any builder model).

### Step 11 — Public placeholder routes
- routes/web.php: GET / → renders home page with hard-coded "Welcome"
  PageSection. Confirm the section partials render.
- POST /contact (throttled), POST /newsletter/subscribe (throttled).

### Step 12 — Forms infrastructure
- ContactRequest, NewsletterSubscribeRequest FormRequest classes with
  honeypot + time-trap.
- Mailables: ContactAdminNotification (queued),
  ContactUserAutoresponder. Templates in resources/views/emails/.

### Step 13 — Brand variables file
- Create `config/brand.php` with keys: name, primary, accent, bg,
  text, sidebar, logo. Loaded into Blade via @push or composer.
- Tailwind theme.extend reads these so a single config change reskins
  the whole site.

### Step 14 — Documentation
Generate at repo root:
- `README.md` — quickstart (clone, install, migrate, seed, run).
- `TEMPLATE_USAGE.md` — how to clone and customise for a new client
  (search/replace agency name, set config/brand.php, run requirements
  interview, etc.).
- `CHANGELOG.md` — empty stub.
- Copy `CLIENT_BUILD_PLAYBOOK.md` and the `/prompts/` folder from the
  Devmantra repo into this template.

### Step 15 — Tests
PHPUnit smoke tests:
- Home returns 200.
- /admin redirects guest; reachable as seeded admin.
- ContactSubmission persists from POST /contact.
- /sitemap.xml returns valid XML.

### Step 16 — CI
- .github/workflows/ci.yml runs composer install, npm ci, npm run
  build, php artisan test on push.

### Step 17 — Final verification
- `php artisan migrate:fresh --seed && php artisan serve` — visit /,
  /admin (log in with seeded creds), submit a section, confirm preview
  iframe works. Visit /sitemap.xml.
- `php artisan test` green.
- Commit final state as "chore: template ready for cloning".
- Tag v1.0.0.

## After this prompt completes

The repo is now your agency's permanent template. For every new client:

  git clone digigit-laravel-template <client-slug>
  cd <client-slug>
  rm -rf .git && git init
  # edit config/brand.php
  # follow /prompts/MASTER_PROMPT_CHAIN.md from Q1
```

---

## Acceptance criteria

- [ ] `php artisan test` green
- [ ] Home page renders with placeholder section
- [ ] Admin login works (seeded credentials)
- [ ] Contact form persists submissions
- [ ] Sitemap valid XML
- [ ] Tailwind config reads from `config/brand.php`
- [ ] `prompts/` folder copied into the template
- [ ] Tagged v1.0.0
