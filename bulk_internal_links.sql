-- ======================================================================
-- DEV MANTRA — BULK INTERNAL LINKING
-- Database: devmantranew
-- Generated: June 2026
--
-- SECTIONS:
--   A. Blog → Service  (in-content REPLACE on exact phrases)
--   B. Blog → Service  (related-block CONCAT at page bottom)
--   C. Blog → Blog     (related-reading CONCAT at page bottom)
--   D. Alert → Service (in-content + related-block)
--   E. Newsletters     (service footer block appended to all editions)
--
-- NOT COVERED HERE (requires JSON edits in service_sections / page_sections):
--   - Service → Service cross-sell links (6b)
--   - Homepage service card anchors (6e)
--   - Breadcrumbs (template-level change)
--   - Newsletter hub page
--
-- HOW TO RUN:
--   1. phpMyAdmin → devmantranew → SQL tab
--   2. Paste entire file → Go
--   3. Check the VERIFICATION SELECTs at the bottom — all should show ✓
--   4. Visit each blog in browser and confirm links + blocks render
--
-- BACKUP FIRST: phpMyAdmin → Export → Quick → SQL → Go
-- ======================================================================

START TRANSACTION;

-- ======================================================================
-- SECTION A: Blog → Service (in-content REPLACE)
-- Wraps existing phrases with anchor tags. Idempotent — safe to re-run.
-- ======================================================================

-- Blog 1: Strengthening Corporate Governance
-- → /services/corporate-governance
UPDATE blogs
SET content = REPLACE(
  content,
  'to strengthen governance, the most',
  'to <a href="https://www.devmantra.com/services/corporate-governance">strengthen governance</a>, the most'
)
WHERE slug = 'strengthening-corporate-governance-in-a-global-economy'
  AND content NOT LIKE '%/services/corporate-governance%';

-- Blog 2: Regulatory Updates & Compliance Insights
-- → /services/finance-accounts-compliance-outsourcing-services
UPDATE blogs
SET content = REPLACE(
  content,
  'compliance review into the quarterly cadence',
  '<a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">compliance review</a> into the quarterly cadence'
)
WHERE slug = 'regulatory-updates-compliance-insights-for-growing-businesses'
  AND content NOT LIKE '%/services/finance-accounts-compliance-outsourcing-services%';

-- Blog 3: Enabling Scalable Growth
-- → /services/virtual-cfo-services
UPDATE blogs
SET content = REPLACE(
  content,
  'combining Virtual CFO, Tax Advisory, and',
  'combining <a href="https://www.devmantra.com/services/virtual-cfo-services">Virtual CFO</a>, Tax Advisory, and'
)
WHERE slug = 'enabling-scalable-growth-through-strategic-financial-advisory'
  AND content NOT LIKE '%/services/virtual-cfo-services%';

-- Blog 3: Enabling Scalable Growth
-- → /services/finance-accounts-compliance-outsourcing-services
UPDATE blogs
SET content = REPLACE(
  content,
  'transfer pricing compliance across new',
  '<a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">transfer pricing compliance</a> across new'
)
WHERE slug = 'enabling-scalable-growth-through-strategic-financial-advisory'
  AND content NOT LIKE '%/services/finance-accounts-compliance-outsourcing-services%';

-- Blog 4: India–China Relations (geopolitical analysis — no clean in-content fit)
-- Service links added via related-block in Section B below.

-- Blog 5: Sustainable Growth / Budget 2025 Decarbonisation
-- → /services/finance-accounts-compliance-outsourcing-services
UPDATE blogs
SET content = REPLACE(
  content,
  'Innovative financing — green bonds, tax',
  '<a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">Innovative financing</a> — green bonds, tax'
)
WHERE slug = 'sustainable-growth-budget-2025s-approach-to-decarbonisation-1'
  AND content NOT LIKE '%/services/finance-accounts-compliance-outsourcing-services%';

-- Blog 6: War Is Now a Tax on Movement
-- → /services/risk-advisory-augmenting-business-process
UPDATE blogs
SET content = REPLACE(
  content,
  'as risk premiums widen',
  'as <a href="https://www.devmantra.com/services/risk-advisory-augmenting-business-process">risk premiums</a> widen'
)
WHERE slug = 'war-is-now-a-tax-on-movement-what-the-us-iran-crisis-means-for-global-finance'
  AND content NOT LIKE '%/services/risk-advisory-augmenting-business-process%';

-- Blog 7: WOS vs LLP vs Branch Office vs Liaison Office
-- → /services/business-set-up-startup-collaboration
UPDATE blogs
SET content = REPLACE(
  content,
  'does not just help you enter India',
  'does not just help you <a href="https://www.devmantra.com/services/business-set-up-startup-collaboration">enter India</a>'
)
WHERE slug = 'wos-vs-llp-vs-branch-office-vs-liaison-office-how-foreign-companies-should-choose-the-right-india-entry-structure'
  AND content NOT LIKE '%/services/business-set-up-startup-collaboration%';

-- Blog 7: WOS vs LLP vs Branch Office vs Liaison Office
-- → /services/gcc-global-capability-centers
UPDATE blogs
SET content = REPLACE(
  content,
  'a regional operating base for global firms',
  'a <a href="https://www.devmantra.com/services/gcc-global-capability-centers">regional operating base for global firms</a>'
)
WHERE slug = 'wos-vs-llp-vs-branch-office-vs-liaison-office-how-foreign-companies-should-choose-the-right-india-entry-structure'
  AND content NOT LIKE '%/services/gcc-global-capability-centers%';


-- ======================================================================
-- SECTION B: Blog → Service (related-block CONCAT)
-- Appends a gold callout box with 2 service links at the end of each blog.
-- ======================================================================

-- Blog 1: Corporate Governance → M&A + IPO Advisory
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/m-a-advisory-services">M&amp;A advisory India</a> — governance due diligence is a non-negotiable part of every cross-border transaction.<br><br>
    <a href="https://www.devmantra.com/services/ipo-advisory-services">IPO advisory services India</a> — strong board governance is the foundation of a successful public listing.
  </p>
</div>')
WHERE slug = 'strengthening-corporate-governance-in-a-global-economy'
  AND content NOT LIKE '%RELATED SERVICES%';

-- Blog 2: Regulatory Compliance → Finance & Compliance + Virtual CFO
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance and compliance outsourcing</a> — GST, direct tax, Companies Act, and FEMA compliance managed end-to-end.<br><br>
    <a href="https://www.devmantra.com/services/virtual-cfo-services">Virtual CFO services in India</a> — these updates tracked and acted upon by a dedicated finance leader on your behalf.
  </p>
</div>')
WHERE slug = 'regulatory-updates-compliance-insights-for-growing-businesses'
  AND content NOT LIKE '%RELATED SERVICES%';

-- Blog 3: Scalable Growth → IPO Advisory + Deals & Transaction
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/ipo-advisory-services">IPO readiness consulting</a> — for companies scaling toward a public listing after multi-market expansion.<br><br>
    <a href="https://www.devmantra.com/services/deals-due-diligence-transaction-advisory">Deal structuring and due diligence</a> — end-to-end transaction support for cross-border entry and expansion.
  </p>
</div>')
WHERE slug = 'enabling-scalable-growth-through-strategic-financial-advisory'
  AND content NOT LIKE '%RELATED SERVICES%';

-- Blog 4: India–China Relations → GCC + Business Set-up
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/gcc-global-capability-centers">GCC advisory services India</a> — for multinationals establishing Global Capability Centers as their primary India operating base.<br><br>
    <a href="https://www.devmantra.com/services/business-set-up-startup-collaboration">India business set-up advisory</a> — entity selection, regulatory filings, and local banking setup, end to end.
  </p>
</div>')
WHERE slug = 'india-china-relations-in-2026-a-cautious-reset-shaped-by-global-pressures'
  AND content NOT LIKE '%RELATED SERVICES%';

-- Blog 5: Decarbonisation → Risk Advisory + Corporate Governance
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/risk-advisory-augmenting-business-process">Business risk augmentation</a> — transition risks from decarbonisation mandates need proactive management and process controls.<br><br>
    <a href="https://www.devmantra.com/services/corporate-governance">Corporate governance advisory</a> — embedding ESG accountability at the board level, not just in annual reports.
  </p>
</div>')
WHERE slug = 'sustainable-growth-budget-2025s-approach-to-decarbonisation-1'
  AND content NOT LIKE '%RELATED SERVICES%';

-- Blog 6: War / Geopolitics → M&A Advisory + Deals
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/m-a-advisory-services">M&amp;A advisory India</a> — repricing geopolitical risk into deal valuations and restructuring cross-border transactions.<br><br>
    <a href="https://www.devmantra.com/services/deals-due-diligence-transaction-advisory">Deal structuring and due diligence</a> — full due diligence before committing to a cross-border transaction in a volatile environment.
  </p>
</div>')
WHERE slug = 'war-is-now-a-tax-on-movement-what-the-us-iran-crisis-means-for-global-finance'
  AND content NOT LIKE '%RELATED SERVICES%';

-- Blog 7: WOS vs LLP → Business Set-up + Deals
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/business-set-up-startup-collaboration">Company formation India</a> — end-to-end entity registration, regulatory filings, and banking setup for foreign entrants.<br><br>
    <a href="https://www.devmantra.com/services/deals-due-diligence-transaction-advisory">M&amp;A transaction support India</a> — already in India and considering an acquisition? Full transaction advisory available.
  </p>
</div>')
WHERE slug = 'wos-vs-llp-vs-branch-office-vs-liaison-office-how-foreign-companies-should-choose-the-right-india-entry-structure'
  AND content NOT LIKE '%RELATED SERVICES%';


-- ======================================================================
-- SECTION C: Blog → Blog (related-reading CONCAT)
-- Cross-links between topically related blogs.
-- ======================================================================

-- Blog 1 → Blog 6 (geopolitical risk + governance)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/war-is-now-a-tax-on-movement-what-the-us-iran-crisis-means-for-global-finance">How geopolitical risk is reshaping global deal-making</a> — the US–Iran crisis and what it means for capital allocation, supply chains, and board-level risk strategy.</p>
</div>')
WHERE slug = 'strengthening-corporate-governance-in-a-global-economy'
  AND content NOT LIKE '%war-is-now-a-tax-on-movement%';

-- Blog 3 → Blog 19 (CFO model guide)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/virtual-vs-fractional-vs-outsourced-cfo-india-2026-guide">Virtual vs Fractional vs Outsourced CFO: India 2026 Guide</a> — understand which finance leadership model fits your current stage and budget before you hire.</p>
</div>')
WHERE slug = 'enabling-scalable-growth-through-strategic-financial-advisory'
  AND content NOT LIKE '%virtual-vs-fractional-vs-outsourced-cfo-india-2026-guide%';

-- Blog 4 → Blog 7 (India entry structure)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/wos-vs-llp-vs-branch-office-vs-liaison-office-how-foreign-companies-should-choose-the-right-india-entry-structure">WOS vs LLP vs Branch vs Liaison Office: India Entry Structure Guide</a> — if you are considering India as your new operating base, this is the structural decision that determines how well you can scale.</p>
</div>')
WHERE slug = 'india-china-relations-in-2026-a-cautious-reset-shaped-by-global-pressures'
  AND content NOT LIKE '%wos-vs-llp-vs-branch-office%';

-- Blog 5 → Blog 2 (regulatory compliance updates)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/regulatory-updates-compliance-insights-for-growing-businesses">Regulatory Updates &amp; Compliance Insights for Growing Businesses</a> — monthly compliance updates covering GST, Companies Act, and direct tax obligations.</p>
</div>')
WHERE slug = 'sustainable-growth-budget-2025s-approach-to-decarbonisation-1'
  AND content NOT LIKE '%regulatory-updates-compliance-insights%';

-- Blog 6 → Blog 1 (board-level governance framework)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/strengthening-corporate-governance-in-a-global-economy">Strengthening Corporate Governance in a Global Economy</a> — how to build a board-level governance framework that absorbs geopolitical and operational shocks.</p>
</div>')
WHERE slug = 'war-is-now-a-tax-on-movement-what-the-us-iran-crisis-means-for-global-finance'
  AND content NOT LIKE '%strengthening-corporate-governance%';

-- Blog 7 → Blog 4 (geopolitics driving India pivot)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/india-china-relations-in-2026-a-cautious-reset-shaped-by-global-pressures">India–China Relations in 2026: A Cautious Reset</a> — the geopolitical forces accelerating the shift of multinational operations from China to India.</p>
</div>')
WHERE slug = 'wos-vs-llp-vs-branch-office-vs-liaison-office-how-foreign-companies-should-choose-the-right-india-entry-structure'
  AND content NOT LIKE '%india-china-relations-in-2026%';

-- Blog 19 → Blog 3 (scalable growth case study)
UPDATE blogs
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p><a href="https://www.devmantra.com/blog/enabling-scalable-growth-through-strategic-financial-advisory">Enabling Scalable Growth through Strategic Financial Advisory</a> — a case study on how cross-functional financial advisory drove three-market expansion in six months.</p>
</div>')
WHERE slug = 'virtual-vs-fractional-vs-outsourced-cfo-india-2026-guide'
  AND content NOT LIKE '%enabling-scalable-growth%';


-- ======================================================================
-- SECTION D: Alert → Service links
-- ======================================================================

-- Alert: Income Tax Clearance Certificate
-- In-content → /services/finance-accounts-compliance-outsourcing-services
UPDATE alerts
SET content = REPLACE(
  content,
  'ITCCs ensure tax regulation adherence',
  'ITCCs ensure <a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">tax regulation adherence</a>'
)
WHERE slug = 'importance-process-of-income-tax-clearance-certificate'
  AND content NOT LIKE '%/services/finance-accounts-compliance-outsourcing-services%';

-- Alert: Related block → Finance & Compliance + Business Set-up
UPDATE alerts
SET content = CONCAT(content, '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance and compliance outsourcing</a> — ITCC applications and all India tax compliance managed as part of a comprehensive mandate.<br><br>
    <a href="https://www.devmantra.com/services/business-set-up-startup-collaboration">India business set-up advisory</a> — for foreign nationals and companies entering or exiting India, ITCC requirements are built into our entity lifecycle planning.
  </p>
</div>')
WHERE slug = 'importance-process-of-income-tax-clearance-certificate'
  AND content NOT LIKE '%RELATED SERVICES%';


-- ======================================================================
-- SECTION E: Newsletters → Service footer block (all 40 editions)
-- Single UPDATE appends to all published editions at once.
-- Uses COALESCE to handle any NULL content fields safely.
-- ======================================================================

UPDATE newsletters
SET content = CONCAT(
  COALESCE(content, ''),
  '\n\n<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">DEV MANTRA SERVICES</strong>
  <p>
    <a href="https://www.devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance and compliance outsourcing</a> — GST, direct tax, payroll, and regulatory compliance managed end-to-end.<br><br>
    <a href="https://www.devmantra.com/services/virtual-cfo-services">Virtual CFO services in India</a> — strategic financial leadership for growing businesses without the full-time overhead.
  </p>
</div>'
)
WHERE status = 'published'
  AND (content NOT LIKE '%DEV MANTRA SERVICES%' OR content IS NULL);


-- ======================================================================
-- VERIFICATION — Run after COMMIT. All results should show ✓
-- ======================================================================

SELECT 'BLOG CHECKS' AS section;

SELECT slug,
  IF(content LIKE '%/services/corporate-governance%',         '✓', '✗') AS corp_gov_link,
  IF(content LIKE '%war-is-now-a-tax-on-movement%',           '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'strengthening-corporate-governance-in-a-global-economy';

SELECT slug,
  IF(content LIKE '%/services/finance-accounts%',             '✓', '✗') AS compliance_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'regulatory-updates-compliance-insights-for-growing-businesses';

SELECT slug,
  IF(content LIKE '%/services/virtual-cfo-services%',         '✓', '✗') AS vcfo_link,
  IF(content LIKE '%/services/finance-accounts%',             '✓', '✗') AS compliance_link,
  IF(content LIKE '%virtual-vs-fractional%',                  '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'enabling-scalable-growth-through-strategic-financial-advisory';

SELECT slug,
  IF(content LIKE '%gcc-global-capability-centers%',          '✓', '✗') AS gcc_link,
  IF(content LIKE '%wos-vs-llp-vs-branch-office%',            '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'india-china-relations-in-2026-a-cautious-reset-shaped-by-global-pressures';

SELECT slug,
  IF(content LIKE '%/services/finance-accounts%',             '✓', '✗') AS compliance_link,
  IF(content LIKE '%regulatory-updates-compliance%',          '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'sustainable-growth-budget-2025s-approach-to-decarbonisation-1';

SELECT slug,
  IF(content LIKE '%risk-advisory-augmenting%',               '✓', '✗') AS risk_link,
  IF(content LIKE '%strengthening-corporate-governance%',     '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'war-is-now-a-tax-on-movement-what-the-us-iran-crisis-means-for-global-finance';

SELECT slug,
  IF(content LIKE '%business-set-up-startup%',                '✓', '✗') AS setup_link,
  IF(content LIKE '%gcc-global-capability-centers%',          '✓', '✗') AS gcc_link,
  IF(content LIKE '%india-china-relations-in-2026%',          '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'wos-vs-llp-vs-branch-office-vs-liaison-office-how-foreign-companies-should-choose-the-right-india-entry-structure';

SELECT slug,
  IF(content LIKE '%enabling-scalable-growth%',               '✓', '✗') AS blog_blog_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM blogs WHERE slug = 'virtual-vs-fractional-vs-outsourced-cfo-india-2026-guide';

SELECT 'ALERT CHECK' AS section;
SELECT slug,
  IF(content LIKE '%/services/finance-accounts%',             '✓', '✗') AS compliance_link,
  IF(content LIKE '%RELATED SERVICES%',                       '✓', '✗') AS related_services
FROM alerts WHERE slug = 'importance-process-of-income-tax-clearance-certificate';

SELECT 'NEWSLETTER CHECK' AS section;
SELECT
  COUNT(*)                                                         AS total_published,
  SUM(IF(content LIKE '%DEV MANTRA SERVICES%', 1, 0))             AS with_service_block,
  SUM(IF(content NOT LIKE '%DEV MANTRA SERVICES%', 1, 0))         AS missing_block
FROM newsletters WHERE status = 'published';

COMMIT;
