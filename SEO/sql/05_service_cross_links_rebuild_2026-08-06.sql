-- ============================================================================
-- 05_service_cross_links_rebuild_2026-08-06.sql
-- Rebuilds the 'Explore Our Other Services' block on all 9 service pages.
--
-- BEFORE: each service page linked to all 8 sibling services in one flat grid.
-- On service #3 (Deals, Due Diligence & Transaction Advisory), 7 of those 8
-- links used shortened, NON-EXISTENT slugs (e.g. /services/virtual-cfo instead
-- of /services/virtual-cfo-services) -- a live P0 broken-link bug this fixes.
--
-- AFTER: each service links to exactly 2 thematically-related services, per
-- the curated pairs in SEO/internal-linking-plan.md Section 6b. This also
-- fixes service #3's broken slugs as a side effect of the full rebuild.
--
-- Design note: kept the existing {label, url} schema and the existing
-- 'Explore Our Other Services' heading/labels as-is (no template change
-- needed) -- only which services are listed and how many changed. If you'd
-- rather use the plan's SEO-phrased anchor text (e.g. 'finance and compliance
-- outsourcing') as the visible label instead of the service's proper title,
-- say so and I'll rewrite this batch.
--
-- BACK UP THE DATABASE BEFORE RUNNING.
-- ============================================================================

START TRANSACTION;

-- Service 1: Virtual CFO Services (service_sections.id = 65)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "Finance Accounts Compliance Outsourcing", "url": "/services/finance-accounts-compliance-outsourcing-services"}, {"label": "IPO Advisory Services", "url": "/services/ipo-advisory-services"}]}' WHERE `id` = 65 AND `service_id` = 1 AND `section_type` = 'other-services';

-- Service 2: Finance Accounts Compliance Outsourcing (service_sections.id = 73)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "Virtual CFO Services", "url": "/services/virtual-cfo-services"}, {"label": "Risk Advisory & Augmenting Business Process", "url": "/services/risk-advisory-augmenting-business-process"}]}' WHERE `id` = 73 AND `service_id` = 2 AND `section_type` = 'other-services';

-- Service 3: Deals, Due Diligence & Transaction Advisory (service_sections.id = 126)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "M & A Advisory Services", "url": "/services/m-a-advisory-services"}, {"label": "IPO Advisory Services", "url": "/services/ipo-advisory-services"}]}' WHERE `id` = 126 AND `service_id` = 3 AND `section_type` = 'other-services';

-- Service 4: Business Setup & Startup Collaboration (service_sections.id = 56)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "GCC (Global Capability Centers)", "url": "/services/gcc-global-capability-centers"}, {"label": "Finance Accounts Compliance Outsourcing", "url": "/services/finance-accounts-compliance-outsourcing-services"}]}' WHERE `id` = 56 AND `service_id` = 4 AND `section_type` = 'other-services';

-- Service 5: IPO Advisory Services (service_sections.id = 47)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "Corporate Governance", "url": "/services/corporate-governance"}, {"label": "Virtual CFO Services", "url": "/services/virtual-cfo-services"}]}' WHERE `id` = 47 AND `service_id` = 5 AND `section_type` = 'other-services';

-- Service 6: Corporate Governance (service_sections.id = 90)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "M & A Advisory Services", "url": "/services/m-a-advisory-services"}, {"label": "Risk Advisory & Augmenting Business Process", "url": "/services/risk-advisory-augmenting-business-process"}]}' WHERE `id` = 90 AND `service_id` = 6 AND `section_type` = 'other-services';

-- Service 7: GCC (Global Capability Centers) (service_sections.id = 140)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "Business Setup & Startup Collaboration", "url": "/services/business-set-up-startup-collaboration"}, {"label": "Virtual CFO Services", "url": "/services/virtual-cfo-services"}]}' WHERE `id` = 140 AND `service_id` = 7 AND `section_type` = 'other-services';

-- Service 8: M & A Advisory Services (service_sections.id = 31)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "Deals, Due Diligence & Transaction Advisory", "url": "/services/deals-due-diligence-transaction-advisory"}, {"label": "Corporate Governance", "url": "/services/corporate-governance"}]}' WHERE `id` = 31 AND `service_id` = 8 AND `section_type` = 'other-services';

-- Service 9: Risk Advisory & Augmenting Business Process (service_sections.id = 81)
UPDATE `service_sections` SET `section_data` = '{"title": "Explore Our Other Services", "items": [{"label": "Finance Accounts Compliance Outsourcing", "url": "/services/finance-accounts-compliance-outsourcing-services"}, {"label": "Corporate Governance", "url": "/services/corporate-governance"}]}' WHERE `id` = 81 AND `service_id` = 9 AND `section_type` = 'other-services';

-- Verification: every row below should show exactly 2 items, and no URL
-- should be a shortened/broken slug.
SELECT ss.id, s.title AS service, ss.section_data
FROM service_sections ss JOIN services s ON s.id = ss.service_id
WHERE ss.section_type = 'other-services'
ORDER BY ss.service_id;

-- Review the section_data JSON above for all 9 rows, then COMMIT.
-- If anything looks wrong, run ROLLBACK instead.
COMMIT;
