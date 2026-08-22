-- =====================================================================
-- DevMantra -- SEO Field & Schema Gap Audit (TASK 13 remainder, read-only)
-- Generated: 2026-08-06 by Digitech Solutions
-- Purpose: find exactly which records still need meta/custom_head/schema
-- attention, across all 7 content types, in one pass. READ-ONLY -- safe
-- to run any time, no backup needed.
-- =====================================================================

SELECT 'blogs' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM blogs WHERE deleted_at IS NULL
UNION ALL
SELECT 'services' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM services WHERE deleted_at IS NULL
UNION ALL
SELECT 'case_studies' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM case_studies WHERE deleted_at IS NULL
UNION ALL
SELECT 'reports' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM reports WHERE deleted_at IS NULL
UNION ALL
SELECT 'newsletters' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM newsletters WHERE deleted_at IS NULL
UNION ALL
SELECT 'alerts' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM alerts WHERE deleted_at IS NULL
UNION ALL
SELECT 'events' AS content_type,
       COUNT(*) AS total_published,
       SUM(meta_title IS NULL OR meta_title = '')             AS missing_meta_title,
       SUM(meta_description IS NULL OR meta_description = '') AS missing_meta_description,
       SUM(og_image IS NULL OR og_image = '')                 AS missing_og_image,
       SUM(canonical_url IS NULL OR canonical_url = '')       AS missing_canonical_url,
       SUM(custom_head IS NULL OR custom_head = '')            AS missing_custom_head_schema,
       SUM(CHAR_LENGTH(meta_title) > 60)                      AS title_over_60_chars,
       SUM(CHAR_LENGTH(meta_description) > 160)               AS description_over_160_chars
FROM events WHERE deleted_at IS NULL;

-- Drill-down: list the actual records still missing meta_description
-- (swap the table name below to check a different content type).
-- SELECT id, slug, title, meta_title, meta_description FROM services
-- WHERE meta_description IS NULL OR meta_description = '';
