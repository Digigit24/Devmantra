# 03B — Filament v3 Fast-Path Admin

Use when the client doesn't care about admin branding and you want to ship 3× faster.

> **Choose this when:** the admin is internal-only, no stakeholder ever screenshots it, the client is budget-constrained, or you're prototyping. Reach to `03-admin-custom-blade.md` when premium branding matters.

---

## Prerequisites

- Starter template cloned (`01-build-starter-template.md` output).
- `docs/data-model.md` exists with every collection + field.
- You're OK with Filament's default UI (purple-ish, Tailwind-based) — it's clean but generic.

---

## What you gain vs. Custom Blade

| Capability | Custom Blade | Filament |
|---|---|---|
| CRUD form generation | hand-written per field | `Forms\Components\TextInput::make(...)` |
| Tables with sort/filter/search | manual | built-in |
| Bulk actions, exports | bolted on | first-class |
| File uploads + previews | hand-rolled | built-in |
| Relation managers | tedious | declarative |
| Notifications, toasts | DIY | built-in |
| Time-to-ship one collection | ~45 min | ~10 min |
| Brand control | total | limited (theme overrides only) |

---

## The prompt — paste this into Claude Code

```
You are installing Filament v3 over the existing Laravel template and
generating Filament Resources for every collection in docs/data-model.md.

The template already includes:
- A custom admin login at /admin (Breeze).
- Public-facing models (SiteSetting, ContactSetting, Page/PageSection,
  ContactSubmission, NewsletterSubscriber, ImageMeta).
- SEO fields convention (meta_title, meta_description, og_image,
  canonical_url, noindex, custom_head) on content tables.

We're REPLACING the custom Blade admin with Filament for /admin while
preserving the public frontend untouched.

## Steps

### Step 1 — Install Filament
```
composer require filament/filament:"^3.2"
php artisan filament:install --panels
```
Configure the admin panel at /admin:
- `app/Providers/Filament/AdminPanelProvider.php`:
  - ->id('admin')
  - ->path('admin')
  - ->login()  // use Breeze-compatible login by extending or replacing
  - ->colors([...])  // pull from config/brand.php
  - ->discoverResources, discoverPages, discoverWidgets
  - ->authMiddleware(['auth', 'admin'])

If Breeze's /login and Filament's /admin/login conflict, keep Breeze for
public auth (password reset emails, register) and tell Filament to use
Breeze's User model with the existing `is_admin` flag. Implement
`FilamentUser` on User: canAccessPanel(Panel) returns is_admin.

### Step 2 — Theme to brand
- Publish Filament's theme assets if needed.
- In AdminPanelProvider, set:
  ```
  ->colors([
    'primary' => Color::hex(config('brand.primary')),
  ])
  ->brandName(config('brand.name'))
  ->brandLogo(asset(config('brand.logo')))
  ->favicon(asset('favicon.ico'))
  ```
- Optional: publish vendor views ONLY if a stakeholder screenshot
  requirement appears. Otherwise stop here.

### Step 3 — Shared SEO field block
Create `app/Filament/Forms/SeoFields.php` returning a reusable Section
component:

```php
public static function make(): Section {
    return Section::make('SEO')
        ->collapsed()
        ->schema([
            TextInput::make('meta_title')->maxLength(60)
                ->helperText('Up to 60 chars'),
            Textarea::make('meta_description')->maxLength(280)
                ->rows(2)->helperText('Up to 160-280 chars'),
            FileUpload::make('og_image')->image()
                ->directory('seo/og-images')->maxSize(2048),
            TextInput::make('canonical_url')->url(),
            Toggle::make('noindex'),
            Textarea::make('custom_head')->rows(4)
                ->helperText('Raw HTML / JSON-LD'),
        ])->columns(2);
}
```

Every Resource form `->schema()` ends with `SeoFields::make()`.

### Step 4 — Generate Resources

For each collection in docs/data-model.md:
```
php artisan make:filament-resource <Name> --generate --soft-deletes
```
Then customise:

**Form schema** — match the model's fields:
- title (TextInput required, live, afterStateUpdated → set slug)
- slug (TextInput unique, hidden after creation)
- excerpt (Textarea)
- content (RichEditor or Tiptap editor — Filament's RichEditor is the
  default; for Summernote parity install `awcodes/filament-tiptap-editor`)
- featured_image (FileUpload image directory <plural>/featured)
- category / tags (Select or TagsInput)
- status (Select: draft/published)
- is_featured (Toggle)
- published_at (DateTimePicker)
- SeoFields::make() at the bottom

**Table** — columns:
- ImageColumn featured_image (square thumb)
- TextColumn title (searchable, sortable)
- BadgeColumn status (colors: draft=gray, published=success)
- IconColumn is_featured (boolean, star)
- TextColumn updated_at (since)

**Filters:**
- SelectFilter status
- TernaryFilter is_featured
- TrashedFilter (from SoftDeletingScope)

**Actions:**
- EditAction, DeleteAction, RestoreAction, ForceDeleteAction
- Bulk: DeleteBulkAction, ForceDeleteBulkAction, RestoreBulkAction,
  publish/unpublish custom bulk actions

**Navigation:**
- ->navigationGroup('Content')
- ->navigationIcon('heroicon-o-...')

### Step 5 — Section builder for section-enabled models

Filament doesn't have a built-in "typed JSON section builder" matching
the Devmantra pattern. Two options:

OPTION A (recommended for Filament path) — Use Filament's
`Forms\Components\Builder`:
- On the parent Resource form, add:
  ```
  Builder::make('sections')
    ->blocks([
      Builder\Block::make('hero')->schema([...]),
      Builder\Block::make('text-block')->schema([...]),
      Builder\Block::make('image-text')->schema([...]),
      Builder\Block::make('faq')->schema([Repeater::make('items')...]),
      Builder\Block::make('cta')->schema([...]),
    ])
    ->collapsed()
    ->reorderable();
  ```
- Cast the `sections` column as JSON on the parent model — no separate
  Section table needed.
- This is simpler than the Devmantra two-table approach but locks you
  into Filament for editing. Frontend rendering still iterates the
  array and includes per-type partials.

OPTION B — Keep the Devmantra two-table pattern with a Filament
RelationManager on the parent Resource. Use when you want to preserve
the schema for portability.

Pick OPTION A unless docs/requirements.md specifies otherwise.

### Step 6 — Frontend rendering of Builder JSON
Add Blade partials at `resources/views/frontend/sections/<type>.blade.php`
for every block type. Detail view loops:
```blade
@foreach($model->sections ?? [] as $section)
    @include('frontend.sections.' . $section['type'],
             ['data' => $section['data']])
@endforeach
```

### Step 7 — Static pages
- Keep the Page/PageSection tables from the template.
- Create a `PageResource` with `Builder` for the sections column on
  Page (migrate page_sections into a JSON column on pages, OR keep
  the RelationManager). Pick whichever matches Option A/B above.

### Step 8 — Singletons (ContactSetting, Site settings)
- Use the `awcodes/filament-curator` or `outerweb/filament-settings`
  package, OR create custom Filament Pages:
  - `app/Filament/Pages/ContactSettings.php` — extends `Page` with a
    form bound to ContactSetting::instance().
  - `app/Filament/Pages/SiteSettings.php` — form bound to
    SiteSetting::all_cached().

### Step 9 — Lead inboxes
Generate Resources for ContactSubmission, NewsletterSubscriber,
plus any custom lead model from docs/requirements.md. These are
read-mostly:
- Disable create action.
- Add `updateStatus` action (Select: new/contacted/closed).
- Add export to CSV via `pxlrbt/filament-excel`.

### Step 10 — Tests
PHPUnit smoke per Resource:
- Admin can list, create, edit, delete, restore.
- Non-admin gets 403 on /admin.

### Step 11 — Cleanup
- Delete the custom Blade admin views under `resources/views/admin/`
  (keep `resources/views/admin/partials/_seo-panel.blade.php` only if
  still used elsewhere; otherwise delete).
- Delete custom `app/Http/Controllers/Admin/*Controller.php` controllers
  superseded by Filament. Keep:
  - GalleryController (or migrate to Filament's MediaLibrary)
  - SubscriberController (if still wanted for non-admin endpoints)
- Update sidebar reference: there is no custom sidebar now — Filament
  owns it.
- Update README setup steps.

### Step 12 — Commit
One commit per Resource:
- "feat(admin): filament <model> resource"

## Anti-patterns

- Do not publish Filament's vendor views unless absolutely required.
  The moment you do, you've bought into maintaining them across
  Filament upgrades.
- Do not try to make Filament look like Devmantra's custom admin. If
  that's the goal, use 03-admin-custom-blade.md instead.
- Do not expose Filament panels to non-admin users — keep the
  `is_admin` gate.
- Do not run `php artisan filament:upgrade` blindly between minor
  versions — read the changelog first.

## Acceptance criteria

- [ ] /admin loads Filament dashboard for admin users.
- [ ] Every collection has a Resource with full CRUD + soft-delete
  actions.
- [ ] SeoFields::make() included on every content Resource form.
- [ ] Builder field (or RelationManager) on section-enabled Resources.
- [ ] Singleton settings pages working.
- [ ] PHPUnit smoke tests green.
- [ ] Brand colors picked up from config/brand.php.
- [ ] Non-admin users get 403 on /admin.
```

---

## Time estimate

- ~2 hours total install + theme.
- ~10–15 min per Resource thanks to `--generate`.
- ~1 day end-to-end for 8 collections including section builder + tests.

---

## Reversibility

If after launch the client demands a fully custom admin (it happens), the migration path is:

1. Keep all models, migrations, frontend untouched — they're framework-agnostic.
2. Re-run `03-admin-custom-blade.md` over the same models.
3. Remove Filament: `composer remove filament/filament` and delete `app/Filament/`.

Nothing in this prompt locks you in beyond a 1-day migration if you ever want out.
