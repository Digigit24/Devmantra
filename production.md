# Production Deployment Reference

## Server Architecture

| | Local | Production (cPanel) |
|---|---|---|
| Public folder | `public/` | `/home2/devmasjc/public_html/` |
| Laravel root | `c:\xampp\htdocs\Devmantranew\` | `/home2/devmasjc/devmantra/` |

The production `public_html/index.php` points one level up to the `devmantra/` folder:
```php
require __DIR__.'/../devmantra/vendor/autoload.php';
$app = require_once __DIR__.'/../devmantra/bootstrap/app.php';
```

---

## Current Deployment — 2026-05-12 (SEO Indexing Fixes)

### Files Changed — Upload These

#### To `/home2/devmasjc/public_html/` (from local `public/`)
- `public/.htaccess` — **HTTPS + www redirect added, dynamic sitemap passthrough added**

#### To `/home2/devmasjc/devmantra/` (from local root)
- `app/Providers/AppServiceProvider.php` — added `URL::forceScheme('https')` for production
- `app/Http/Controllers/SitemapController.php` — **NEW FILE** — dynamic sitemap controller
- `resources/views/sitemap.blade.php` — **NEW FILE** — sitemap XML template
- `resources/views/layouts/frontend.blade.php` — fixed canonical + og:url (no more query strings)
- `routes/web.php` — added `/sitemap.xml` route

### Special Steps for This Deployment

1. **Delete the old static sitemap** — after uploading `.htaccess`, delete `/home2/devmasjc/public_html/sitemap.xml`
   - If you don't delete it, Apache serves the stale static file instead of the dynamic Laravel one

2. **Verify dynamic sitemap works** — visit `https://www.devmantra.com/sitemap.xml` in browser
   - Should show live XML with all published content, real `lastmod` dates, no `?tag=` or `?page=` junk URLs

3. **Re-submit sitemap in GSC**:
   - Google Search Console → Sitemaps
   - Remove the old entry if shown as error
   - Re-add: `https://www.devmantra.com/sitemap.xml`

4. **Test redirects** — open browser incognito:
   - `http://devmantra.com` → should redirect to `https://www.devmantra.com`
   - `https://devmantra.com` (no www) → should redirect to `https://www.devmantra.com`
   - `http://www.devmantra.com` → should redirect to `https://www.devmantra.com`

5. **Check canonical tags** — view source on any blog post that previously had `?tag=` params:
   - `<link rel="canonical">` must NOT contain query strings
   - `<meta property="og:url">` must NOT contain query strings

---

## Standard Deployment Checklist

### Before Upload
- [ ] Confirm `APP_ENV=production` and `APP_DEBUG=false` in server `.env`
- [ ] Confirm `APP_URL=https://www.devmantra.com` in server `.env`

### Files to Upload
- [ ] Upload changed files from `public/` → `/home2/devmasjc/public_html/`
- [ ] Upload Laravel changes → `/home2/devmasjc/devmantra/`
- [ ] **NEVER overwrite** `/home2/devmasjc/public_html/index.php` — it has production-specific paths pointing to `../devmantra/`

### After Upload
- [ ] Run `php artisan migrate` if there are new migrations
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Check storage symlink exists: `php artisan storage:link`

### Verify
- [ ] Homepage loads correctly
- [ ] Images and assets load (check browser console for 404s)
- [ ] Forms submit correctly
- [ ] No Laravel errors in `/home2/devmasjc/devmantra/storage/logs/laravel.log`
- [ ] `https://www.devmantra.com/sitemap.xml` returns live XML
- [ ] HTTP and non-www redirect to `https://www.devmantra.com`
