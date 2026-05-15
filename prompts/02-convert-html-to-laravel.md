# 02 — Convert an Existing HTML Site to Laravel

Use when the client has a live HTML/WordPress-export/static site and you must preserve the design 1:1 inside the new Laravel app.

> **Prerequisite:** the starter template (`01-build-starter-template.md`) has been cloned into this repo, OR you've run Phase 2A of the playbook. Either way: Laravel is bootable.

---

## Pre-flight (human)

1. Get the existing site files. Acceptable forms:
   - Folder of `.html` + `assets/` (best case)
   - WordPress export → run a static-site exporter first (`wget --recursive`)
   - Live URL only → `wget -mkEpnp <url>` to mirror locally
2. Drop everything into `/static-source/` at the repo root.
3. Take screenshots of every unique page type at desktop + mobile widths. Save to `/static-source/_screenshots/`. These are the visual regression reference.
4. Make sure you have the brand kit (colors, fonts, logo) — if not, run the brand sub-interview first.

---

## The prompt — paste this into Claude Code

```
You are migrating an existing static HTML site into a Laravel 12 app
without changing the visual output. The source is at /static-source/.
Screenshots of every page (desktop + mobile) are at
/static-source/_screenshots/ — these are the visual regression reference.

## Rules (read before doing anything)

1. **Pixel-fidelity first.** The migrated site must look identical to
   the screenshots. Don't "improve" the design.
2. **Keep the original CSS as-is initially.** Do NOT rewrite styles into
   Tailwind in this phase. That is a separate, optional later phase.
3. **No new dependencies.** Use whatever JS/CSS the source already
   ships, served from public/.
4. **Stop at the human gate** before binding any content to models.

## Steps (execute in order, commit per step)

### Step 1 — Survey
- Run `find /static-source -name '*.html' | head -50` and read each.
- Produce `docs/migration-map.md` with this table per page:
  | original_file | proposed_route | proposed_blade | layout_group |
- Group pages by shared header/footer chrome. Pages with the same
  chrome share a layout.
- Identify content blocks that repeat across pages (testimonials,
  feature grids, FAQ, CTAs). List them under "Repeated blocks" — these
  become section types.
- **STOP. Show me docs/migration-map.md and wait for approval before
  Step 2.**

### Step 2 — Asset relocation
- Copy /static-source/css/ /static-source/js/ /static-source/images/
  /static-source/fonts/ → public/static/{css,js,images,fonts}/.
- Do NOT touch Tailwind/Vite — keep them for the admin only.
- Update every asset reference inside HTML to absolute paths under
  /static/.

### Step 3 — Layout extraction
- For each shared chrome group, create:
  - `resources/views/layouts/site-<group>.blade.php` (or just
    `frontend.blade.php` if there's only one)
  - `resources/views/frontend/partials/header.blade.php`
  - `resources/views/frontend/partials/footer.blade.php`
- Replace `<head>` boilerplate with the SEO-ready head from
  `resources/views/layouts/frontend.blade.php` (template default).
  Preserve any analytics/Pixel snippets already present in the source.
- Replace static nav `<a href="about.html">` with
  `<a href="{{ route('about') }}">`. If the route doesn't exist yet,
  leave a `{{-- TODO: route('about') --}}` comment and use a `#`
  placeholder.

### Step 4 — Page extraction
For each unique page in the migration map:
- Create the Blade file at the proposed path.
- `@extends('layouts.site-<group>')`
- Wrap the unique-per-page HTML inside `@section('content') ... @endsection`.
- Add `@section('title', '...')`, `@section('meta_description', '...')`
  by extracting from the original `<title>` and `<meta name="description">`.
- Keep page-specific inline `<style>` blocks for now — extract later.

### Step 5 — Repeated block extraction
For each "Repeated block" identified in Step 1:
- Create a Blade partial at
  `resources/views/frontend/sections/<slug>.blade.php`.
- The partial receives `$data` (array). Hardcode the data inside the
  partial for now — Step 7 will replace with bindings.
- Replace every occurrence of the block across all pages with
  `@include('frontend.sections.<slug>', ['data' => [...]])`.

### Step 6 — Routes
- routes/web.php: one named route per page from the migration map. All
  return their view with a hard-coded `$page` view variable carrying
  title and meta_description so the layout renders correctly.
- Hit every route — confirm every page is reachable and visually
  matches the screenshot.

### Step 7 — STOP. Visual diff gate.
- Show me the list of routes.
- I will visually compare each page to /static-source/_screenshots/.
- Wait for my "looks good, continue" before binding to models.

### Step 8 — Identify content-type candidates
From the migrated pages, propose which become COLLECTIONS (blog posts,
services, case studies, etc.) versus STATIC pages (home, about,
contact).

- Write proposals to `docs/content-types-proposal.md` with one entry per
  collection: name, fields (extracted from HTML structure), URL pattern,
  example item count.
- **STOP. I will edit this file before model generation begins.**

### Step 9 — Bind layouts to template's SEO composer
- Wherever a page has a `<title>` / `<meta description>` in the HTML,
  replace with the template's SEO injection points (`$metaTitle`,
  `$metaDescription`, OG, canonical). For now, set them via
  view()->with() in routes/web.php.

### Step 10 — Migration backlinks
- For every old URL path (e.g. `/about-us.html`, `/services-old/`),
  add to `app/Http/Middleware/SeoRedirects.php` a 301 to the new route.
- Seed a `seo_redirects` table from the entries in
  docs/migration-map.md.

### Step 11 — Commit
- "feat: migrate static site to blade templates"
- Push, open PR.

### Step 12 — Hand-off to Phase 3
- Confirm `docs/content-types-proposal.md` reflects my final edits.
- Next step (not this prompt): run model generation from Phase 3 of
  CLIENT_BUILD_PLAYBOOK.md to turn collections into Eloquent models
  and replace hard-coded data with bindings.

## Anti-patterns to refuse

- Do not delete /static-source/ until Phase 5 is complete (visual
  reference).
- Do not introduce new fonts, CSS frameworks, or icon sets in this
  phase. Use only what the source already has.
- Do not "componentise" markup beyond the layouts + partials in this
  prompt. Premature abstraction = visual drift.
- Do not run Tailwind purge against the migrated pages — they don't use
  Tailwind yet.
```

---

## Acceptance criteria

- [ ] Every original page reachable at its new route
- [ ] Visually identical to `/static-source/_screenshots/` (manual check)
- [ ] `docs/migration-map.md` complete and reviewed
- [ ] `docs/content-types-proposal.md` complete and reviewed
- [ ] 301 redirects from old URLs in place
- [ ] No new dependencies added
- [ ] PR open, CI green

---

## Common gotchas

| Symptom | Cause | Fix |
|---|---|---|
| Fonts not loading | Source used relative font paths in CSS | Update `@font-face` URLs to `/static/fonts/...` |
| JS console errors | Inline scripts reference old asset paths | Search-replace asset paths globally |
| Layout shifts vs screenshot | CSS specificity changed when Blade re-ordered DOM | Diff the rendered HTML against the source HTML, not just the screenshot |
| Forms posting to old PHP endpoints | Source had `action="contact.php"` | Replace with `route('contact.submit')` in this phase |
