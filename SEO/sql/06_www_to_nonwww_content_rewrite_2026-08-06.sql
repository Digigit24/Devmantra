-- ============================================================================
-- 06_www_to_nonwww_content_rewrite_2026-08-06.sql
-- Bulk find/replace: 'https://www.devmantra.com' -> 'https://devmantra.com'
-- inside stored content, matching the non-www canonical decision already
-- applied to robots.txt / llms.txt / .htaccess this batch.
--
-- Scope confirmed against the real production DB dump: only these 3 tables'
-- `content` column contain any 'www.devmantra.com' references --
-- reports, case_studies, services, events, and service_sections have none.
--   blogs:        8 rows (ids 1,2,3,7,10,11,12,19)
--   newsletters: 61 rows
--   alerts:       1 row
--
-- All occurrences checked are 'https://www.devmantra.com' (no bare/http://
-- variants found) -- REPLACE() below is a straight domain swap, no regex
-- needed. This does not touch the internal-linking content added in
-- 04_orphan_content_internal_links_2026-08-06.sql, which was already written
-- non-www from the start.
--
-- BACK UP THE DATABASE BEFORE RUNNING.
-- ============================================================================

START TRANSACTION;

UPDATE `blogs` SET `content` = REPLACE(`content`, 'https://www.devmantra.com', 'https://devmantra.com') WHERE `content` LIKE '%www.devmantra.com%';
SELECT ROW_COUNT() AS blogs_rows_updated;

UPDATE `newsletters` SET `content` = REPLACE(`content`, 'https://www.devmantra.com', 'https://devmantra.com') WHERE `content` LIKE '%www.devmantra.com%';
SELECT ROW_COUNT() AS newsletters_rows_updated;

UPDATE `alerts` SET `content` = REPLACE(`content`, 'https://www.devmantra.com', 'https://devmantra.com') WHERE `content` LIKE '%www.devmantra.com%';
SELECT ROW_COUNT() AS alerts_rows_updated;

-- Verification: all three counts below should read 0.
SELECT
 (SELECT COUNT(*) FROM blogs WHERE content LIKE '%www.devmantra.com%') AS blogs_remaining,
 (SELECT COUNT(*) FROM newsletters WHERE content LIKE '%www.devmantra.com%') AS newsletters_remaining,
 (SELECT COUNT(*) FROM alerts WHERE content LIKE '%www.devmantra.com%') AS alerts_remaining;

-- If all three read 0, COMMIT. Otherwise ROLLBACK and let me know.
COMMIT;
