-- ============================================================================
-- 07_newsletter_66_footer_fix_2026-08-06.sql
-- Newsletter #66 (DevMantra Times July 2026 | Tax, GST & Compliance Update) is
-- the one edition missing the 'DEV MANTRA SERVICES' footer callout that every
-- other recent edition carries (template copied exactly from newsletter #60).
--
-- Links chosen to match this edition's actual content: Finance & Compliance
-- Outsourcing (direct match to the GST/tax-compliance focus of the issue) and
-- Corporate Governance (matches the SEBI/IBBI/MCA corporate-law roundup in
-- this specific edition) -- rather than defaulting to the Virtual CFO pairing
-- newsletter #60 used, which isn't what this edition is about.
--
-- BACK UP THE DATABASE BEFORE RUNNING.
-- ============================================================================

START TRANSACTION;

UPDATE `newsletters` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">DEV MANTRA SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance and compliance outsourcing</a> — GST, direct tax, payroll, and regulatory compliance managed end-to-end.<br><br>
    <a href="https://devmantra.com/services/corporate-governance">Corporate governance advisory</a> — keeping board structures and disclosures ahead of this month''s SEBI, IBBI, and MCA updates.
  </p>
</div>
') WHERE `id` = 66;

-- Verification: should return 1 row with has_footer = 1.
SELECT id, title, (content LIKE '%DEV MANTRA SERVICES%') AS has_footer FROM newsletters WHERE id = 66;

-- If has_footer = 1, COMMIT. Otherwise ROLLBACK.
COMMIT;
