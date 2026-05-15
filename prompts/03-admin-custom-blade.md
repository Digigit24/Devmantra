# 03A — Custom Blade Admin (Premium Path)

Use when the client paid for (or expects) a fully brand-customised admin UI. This is the Devmantra pattern.

> **Choose this when:** the admin will be screenshot-shared with the client's stakeholders, or the brand demands consistency across public + admin surfaces, or you've been hired for "premium" delivery.
>
> **Alternative:** `03-admin-filament-fastpath.md` — ships in 1/3 the time but looks generic.

---

## Prerequisites

- Starter template cloned (`01-build-starter-template.md` output) — this already includes the custom admin shell, SEO panel partial, gallery, settings, and the section builder JS.
- `docs/data-model.md` exists (from Phase 3 of the playbook) listing every collection + field.
- `docs/content-types-proposal.md` reviewed (if you came from Phase 2 migration).

---

## The prompt — paste this into Claude Code

```
You are generating a fully custom Blade admin for this Laravel app. The
template already ships with the admin shell, sidebar layout, SEO panel
partial, gallery, settings, and section builder JS. Your job is to
generate the per-content-type CRUD on top of that shell.

Reference files (read before generating):
- app/Http/Controllers/Admin/BlogController.php (Devmantra) — canonical
  index/create/store/edit/update/destroy/trash/restore/forceDelete with
  search + status filter.
- app/Http/Controllers/Admin/ServiceSectionController.php (Devmantra) —
  canonical section CRUD with reorder, toggle, preview iframe endpoint.
- resources/views/admin/blogs/* (Devmantra) — canonical CRUD views.
- resources/views/admin/partials/_seo-panel.blade.php — drop-in SEO meta
  panel; include on EVERY create/edit form.
- resources/views/admin/service-sections/partials/_builder.blade.php —
  section builder JS bound to sectionTypes() schema.

Inputs: docs/data-model.md (collections + fields) and
docs/content-types-proposal.md (if migrating).

## Steps (one commit per content type)

### Step 1 — Generate per-collection CRUD

For each collection in docs/data-model.md:

1. **Controller** `app/Http/Controllers/Admin/<Name>Controller.php` with:
   - index(Request): paginated 20/page, search by title, filter by
     status (draft/published/all), filter by featured. withQueryString()
     on the paginator.
   - create(): return view with empty model.
   - store(Request): inline validation
     (title required|max:255, slug optional unique, status in
     draft/published, plus SEO block: meta_title|max:60,
     meta_description|max:280, og_image|nullable|image|max:2048 OR
     og_image_url|nullable|url, canonical_url|nullable|url,
     noindex|boolean, custom_head|nullable|string). Save, redirect with
     success flash.
   - edit($id): bind model, return view.
   - update(Request, $id): same validation as store.
   - destroy($id): soft-delete, flash, redirect.
   - trash(): paginated list of onlyTrashed().
   - restore($id): bring back.
   - forceDelete($id): hard delete + remove associated images.

2. **Form Request** (optional but preferred): extract validation into
   `<Name>StoreRequest` and `<Name>UpdateRequest`. Cleaner controllers.

3. **Views** under `resources/views/admin/<plural>/`:
   - index.blade.php — table with: thumb, title, status pill, featured
     star toggle, updated_at, actions (edit/delete). Top bar: search
     box, status filter, "New <Name>" CTA. Bulk actions: publish,
     unpublish, delete (optional).
   - create.blade.php and edit.blade.php — shared `_form.blade.php`
     partial containing:
     - Title (text), slug (text with auto-fill from title), excerpt
       (textarea), content (textarea + Summernote init script),
       featured_image (file upload + preview), status (select),
       is_featured (checkbox), published_at (datetime-local),
       category/tags as needed,
     - `@include('admin.partials._seo-panel', ['model' => $model])` —
       MANDATORY,
     - Submit + Cancel buttons.
   - trash.blade.php — listing with Restore and Force-Delete buttons.

4. **Routes** in `routes/admin.php`:
   ```
   Route::resource('<plural>', <Name>Controller::class)
       ->except(['show']);
   Route::get('<plural>/trash', [<Name>Controller::class, 'trash'])
       ->name('<plural>.trash');
   Route::post('<plural>/{id}/restore', [<Name>Controller::class,
       'restore'])->name('<plural>.restore');
   Route::delete('<plural>/{id}/force-delete', [<Name>Controller::class,
       'forceDelete'])->name('<plural>.force-delete');
   ```

5. **Sidebar entry** in `resources/views/layouts/admin.blade.php` under
   the "Content" group. Use a representative FontAwesome icon.

### Step 2 — Section-enabled models

For any collection marked "has detail sections" in docs/data-model.md:

1. Create `<Name>Section` model + migration mirroring ServiceSection
   exactly (FK to parent, section_type string, section_data json,
   sort_order int, is_active bool).
2. Static `sectionTypes()` on the section model — list of allowed
   types with label, icon, fields schema. Start with: hero, overview,
   text-block, image-text, faq, cta. Add more per requirements.
3. Controller `Admin/<Name>SectionController` with: index (list
   sections for parent), store, update, destroy, reorder (POST
   accepts ordered ids array), toggle (flip is_active), preview
   (POST renders one section in an iframe-safe HTML response).
4. Nested routes:
   ```
   Route::prefix('<parent-plural>/{parent}/sections')->name(
       '<parent-singular>.sections.')->group(function () {
     Route::get('/', ...)->name('index');
     Route::post('/', ...)->name('store');
     Route::put('{section}', ...)->name('update');
     Route::delete('{section}', ...)->name('destroy');
     Route::post('reorder', ...)->name('reorder');
     Route::post('{section}/toggle', ...)->name('toggle');
   });
   Route::match(['get','post'], 'section-preview', ...)
       ->name('section-preview');
   ```
5. Builder view — reuse `resources/views/admin/service-sections/
   partials/_builder.blade.php`. It is generic; pass the URL prefix
   as a variable.

### Step 3 — Static pages (Page/PageSection)

If docs/data-model.md lists static pages (home, about, services overview,
contact, privacy):

1. Seed one Page row per static page in DatabaseSeeder.
2. `Admin/PageController` lists all pages (index only — no create/
   destroy; static pages are seeded).
3. `Admin/PageSectionController` reuses the builder JS against
   `/admin/pages/{page}/sections` — same pattern as Step 2.

### Step 4 — Image handling rules

- Every file upload writes to
  `storage/app/public/<plural>/<yyyy>/<mm>/<uuid>.<ext>` via
  `Storage::disk('public')->putFileAs(...)`.
- `php artisan storage:link` must be in the README setup steps.
- Replace old image on update — store the previous path, delete after
  successful save.
- Generate alt text via the Gallery's existing AI endpoint
  (POST /admin/media/{imageMeta}/suggest-alt) when an image is uploaded
  without one.

### Step 5 — Validation against requirements

Run `php artisan route:list --path=admin` and confirm every collection
from docs/data-model.md has:
- index, create, store, edit, update, destroy, trash, restore,
  force-delete routes
- if section-enabled: 6 nested section routes + the preview endpoint.

### Step 6 — Smoke test

Generate one PHPUnit test per collection that:
- Logs in as admin, hits index → 200.
- Posts to store with valid payload → 302 + DB row created.
- Hits edit → 200, posts to update → 302 + DB row updated.
- Deletes → soft-deleted; trash → contains the row; restore → undeleted.

### Step 7 — Commit per content type

One commit per collection:
- "feat(admin): <collection> crud + sections"

Push, open one PR per content type if there are >3, otherwise one PR
total.

## Anti-patterns

- Do not generate admin "show" pages. Edit is enough.
- Do not allow `custom_head` from non-admin users — it's a raw HTML
  field. Middleware-protected.
- Do not duplicate the section builder JS — pass parameters to the
  shared partial.
- Do not skip SoftDeletes. Clients delete things by accident.
- Do not write Filament/Nova resources here. This prompt is custom
  Blade only — if Filament is wanted, switch to
  03-admin-filament-fastpath.md.

## Acceptance criteria

- [ ] Every collection has full CRUD + trash/restore + force-delete.
- [ ] Every create/edit form includes _seo-panel.
- [ ] Section-enabled collections have working builder + preview
  iframe.
- [ ] PHPUnit smoke tests green per collection.
- [ ] Sidebar lists every collection in the right group.
- [ ] No N+1 on admin index pages (eager-load relations used in the
  table).
```

---

## Time estimate

- ~30–45 min per collection of CRUD generation by Claude Code.
- ~15 min per section-enabled collection to wire the builder.
- Plan ~half a day for an 8-collection client site.

---

## When to abandon this and switch to Filament

If after Step 1 of the first collection, you find yourself fighting Blade for things Filament gives free (relation managers, bulk actions, exports, file managers), **switch**. Don't sunk-cost.

The deciding question: *will the client ever screenshot the admin to a stakeholder?* If no, Filament wins on time. If yes, stay custom.
