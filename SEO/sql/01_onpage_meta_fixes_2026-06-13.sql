-- =====================================================================
-- DevMantra — On-Page Meta Fixes  (run in phpMyAdmin → devmantranew)
-- Generated: 2026-06-13
-- SAFE / IDEMPOTENT: re-running causes no harm. Each section is independent.
-- BACK UP FIRST: phpMyAdmin → Export → devmantranew (Quick, SQL).
-- =====================================================================
-- Context:
--   * meta_title is varchar(60). Several content types stored meta_title
--     already ending in "— DevMantra", and the layout appended the brand
--     again → "… — DevMantra — DevMantra".
--   * The Blade layout now de-duplicates the suffix at render time, so the
--     site is already correct. This script ALSO cleans the stored values so
--     the wasted ~12 chars are freed and titles read cleanly in the admin.
-- =====================================================================


-- ─────────────────────────────────────────────────────────────────────
-- SECTION A — AUDIT (read-only). Run first to see what is empty.
-- ─────────────────────────────────────────────────────────────────────
SELECT 'blogs'        AS content_type, COUNT(*) total,
       SUM(meta_title IS NULL OR meta_title='')        AS missing_title,
       SUM(meta_description IS NULL OR meta_description='') AS missing_desc,
       SUM(og_image IS NULL OR og_image='')            AS missing_og,
       SUM(canonical_url IS NULL OR canonical_url='')  AS missing_canonical
FROM blogs WHERE deleted_at IS NULL
UNION ALL SELECT 'services', COUNT(*),
       SUM(meta_title IS NULL OR meta_title=''), SUM(meta_description IS NULL OR meta_description=''),
       SUM(og_image IS NULL OR og_image=''), SUM(canonical_url IS NULL OR canonical_url='')
FROM services WHERE deleted_at IS NULL
UNION ALL SELECT 'reports', COUNT(*),
       SUM(meta_title IS NULL OR meta_title=''), SUM(meta_description IS NULL OR meta_description=''),
       SUM(og_image IS NULL OR og_image=''), SUM(canonical_url IS NULL OR canonical_url='')
FROM reports WHERE deleted_at IS NULL
UNION ALL SELECT 'case_studies', COUNT(*),
       SUM(meta_title IS NULL OR meta_title=''), SUM(meta_description IS NULL OR meta_description=''),
       SUM(og_image IS NULL OR og_image=''), SUM(canonical_url IS NULL OR canonical_url='')
FROM case_studies WHERE deleted_at IS NULL
UNION ALL SELECT 'newsletters', COUNT(*),
       SUM(meta_title IS NULL OR meta_title=''), SUM(meta_description IS NULL OR meta_description=''),
       SUM(og_image IS NULL OR og_image=''), SUM(canonical_url IS NULL OR canonical_url='')
FROM newsletters WHERE deleted_at IS NULL
UNION ALL SELECT 'alerts', COUNT(*),
       SUM(meta_title IS NULL OR meta_title=''), SUM(meta_description IS NULL OR meta_description=''),
       SUM(og_image IS NULL OR og_image=''), SUM(canonical_url IS NULL OR canonical_url='')
FROM alerts WHERE deleted_at IS NULL
UNION ALL SELECT 'events', COUNT(*),
       SUM(meta_title IS NULL OR meta_title=''), SUM(meta_description IS NULL OR meta_description=''),
       SUM(og_image IS NULL OR og_image=''), SUM(canonical_url IS NULL OR canonical_url='')
FROM events WHERE deleted_at IS NULL;


-- ─────────────────────────────────────────────────────────────────────
-- SECTION B — Strip embedded brand suffix from stored meta_title.
-- Removes a trailing  " - DevMantra" / " — DevMantra" / " | Dev Mantra" etc.
-- Only touches rows that actually end in the brand, so it is idempotent.
-- Requires MariaDB 10.0.5+ / MySQL 8+ (REGEXP_REPLACE).
-- ─────────────────────────────────────────────────────────────────────
UPDATE blogs        SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';
UPDATE services     SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';
UPDATE reports      SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';
UPDATE case_studies SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';
UPDATE newsletters  SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';
UPDATE alerts       SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';
UPDATE events       SET meta_title = TRIM(REGEXP_REPLACE(meta_title, '[[:space:]]*[-–—|:][[:space:]]*Dev[[:space:]]?Mantra[[:space:]]*$', '')) WHERE meta_title REGEXP 'Dev[[:space:]]?Mantra[[:space:]]*$';


-- ─────────────────────────────────────────────────────────────────────
-- SECTION C — Backfill canonical_url ONLY where empty (idempotent).
-- Uses the production www host. Safe to re-run.
-- ─────────────────────────────────────────────────────────────────────
UPDATE blogs        SET canonical_url = CONCAT('https://www.devmantra.com/blog/', slug)       WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';
UPDATE services     SET canonical_url = CONCAT('https://www.devmantra.com/services/', slug)    WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';
UPDATE reports      SET canonical_url = CONCAT('https://www.devmantra.com/reports/', slug)     WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';
UPDATE case_studies SET canonical_url = CONCAT('https://www.devmantra.com/case-study/', slug)  WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';
UPDATE newsletters  SET canonical_url = CONCAT('https://www.devmantra.com/newsletter/', slug)  WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';
UPDATE alerts       SET canonical_url = CONCAT('https://www.devmantra.com/alert/', slug)       WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';
UPDATE events       SET canonical_url = CONCAT('https://www.devmantra.com/events/', slug)      WHERE (canonical_url IS NULL OR canonical_url='') AND slug IS NOT NULL AND slug<>'';


-- ─────────────────────────────────────────────────────────────────────
-- SECTION D — Newsletter meta backfill ONLY where empty (idempotent).
-- meta_title  ← edition_label or title (trimmed to 60).
-- meta_desc   ← templated archive description (covers ~60 editions).
-- ─────────────────────────────────────────────────────────────────────
UPDATE newsletters
   SET meta_title = LEFT(COALESCE(NULLIF(edition_label,''), title), 60)
 WHERE (meta_title IS NULL OR meta_title='') AND COALESCE(NULLIF(edition_label,''), title) IS NOT NULL;

UPDATE newsletters
   SET meta_description = CONCAT(
        LEFT(title, 90),
        ' — DevMantra Times monthly newsletter: regulatory updates, tax notes, GST rulings and compliance dates for Indian businesses.')
 WHERE (meta_description IS NULL OR meta_description='') AND title IS NOT NULL AND title<>'';


-- ─────────────────────────────────────────────────────────────────────
-- SECTION E — POST-CHECK (read-only). Re-run Section A; all "missing_*"
-- for canonical should be 0. Spot-check a few titles read cleanly:
-- ─────────────────────────────────────────────────────────────────────
SELECT slug, meta_title, CHAR_LENGTH(meta_title) AS len FROM blogs    WHERE deleted_at IS NULL ORDER BY id DESC LIMIT 10;
SELECT slug, meta_title, CHAR_LENGTH(meta_title) AS len FROM services WHERE deleted_at IS NULL ORDER BY id ASC  LIMIT 10;
