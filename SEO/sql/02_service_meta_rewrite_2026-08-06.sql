-- =====================================================================
-- DevMantra -- Service Page Meta Title/Description Rewrite (TASK 09)
-- Generated: 2026-08-06 by Digitech Solutions
-- SAFE: only updates meta_title/meta_description on the 9 published
-- services, matched by slug. BACK UP FIRST (phpMyAdmin -> Export).
-- Run against whichever DB mirrors production content --
-- local dev DB is `devmantra` per .env; adjust if targeting `devmantra_production`.
-- =====================================================================

START TRANSACTION;

UPDATE services SET meta_title = 'Virtual CFO Services in India for SMEs | DevMantra', meta_description = 'On-demand Virtual CFO services for Indian SMEs & mid-market companies — strategic finance, cash flow, MIS and fundraising support. Book a free consult.' WHERE slug = 'virtual-cfo-services';
UPDATE services SET meta_title = 'Finance & Compliance Outsourcing Services India', meta_description = 'Bookkeeping, statutory compliance and a 24-hour US-India accounting workflow for CPA firms and growing businesses. Get a free process audit today.' WHERE slug = 'finance-accounts-compliance-outsourcing-services';
UPDATE services SET meta_title = 'Deals, Due Diligence & Transaction Advisory India', meta_description = 'Financial, tax, legal and operational due diligence for M&A and cross-border transactions in India, led by a CA-qualified team. Talk to us today.' WHERE slug = 'deals-due-diligence-transaction-advisory';
UPDATE services SET meta_title = 'India Business Set-Up & FDI Structuring Services', meta_description = 'End-to-end India entity formation, FDI structuring and fundraising support for startups and foreign entrants. Start your India entry plan now.' WHERE slug = 'business-set-up-startup-collaboration';
UPDATE services SET meta_title = 'IPO Advisory Services India | Pre-IPO Readiness', meta_description = 'Pre-IPO readiness, DRHP support, listing compliance and post-IPO governance from a CA-led advisory team. Schedule your IPO readiness review.' WHERE slug = 'ipo-advisory-services';
UPDATE services SET meta_title = 'Corporate Governance Advisory Services | DevMantra', meta_description = 'Governance frameworks, board structures and compliance programs for companies scaling across India and global markets. Talk to our team today.' WHERE slug = 'corporate-governance';
UPDATE services SET meta_title = 'GCC Setup Services India | Global Capability Centers', meta_description = 'End-to-end setup and scaling of India Global Capability Centers — site selection, entity, talent and governance. Plan your GCC with us today.' WHERE slug = 'gcc-global-capability-centers';
UPDATE services SET meta_title = 'Cross-Border M&A Advisory Services India | DevMantra', meta_description = 'Full-cycle buy-side and sell-side M&A — target identification, valuation, audit-grade due diligence and post-merger integration. Get in touch.' WHERE slug = 'm-a-advisory-services';
UPDATE services SET meta_title = 'Risk Advisory & Business Process Services India', meta_description = 'Internal audit, risk identification and business-process controls for companies operating in complex regulatory environments. Talk to our risk advisory team.' WHERE slug = 'risk-advisory-augmenting-business-process';

-- Verify before committing:
SELECT slug, meta_title, CHAR_LENGTH(meta_title) AS title_len, meta_description, CHAR_LENGTH(meta_description) AS desc_len
FROM services WHERE slug IN (
'virtual-cfo-services', 'finance-accounts-compliance-outsourcing-services', 'deals-due-diligence-transaction-advisory', 'business-set-up-startup-collaboration', 'ipo-advisory-services', 'corporate-governance', 'gcc-global-capability-centers', 'm-a-advisory-services', 'risk-advisory-augmenting-business-process'
);

COMMIT;
-- If any row above looks wrong, run ROLLBACK; instead of COMMIT;, fix, and re-run.
