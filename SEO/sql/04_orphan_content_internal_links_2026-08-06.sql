-- ============================================================================
-- 04_orphan_content_internal_links_2026-08-06.sql
-- Adds internal links (RELATED SERVICES / RELATED READING callouts) to the 6
-- orphan blogs, 2 reports, and 1 case study that had zero outbound internal
-- links. Also fixes 2 throwaway self-links (blogs 17 & 18) that pointed at the
-- bare homepage instead of the relevant service page.
--
-- Safe to re-run check: each UPDATE targets content by primary key id. This is
-- NOT idempotent (running twice will append the callout twice) -- run once.
-- BACK UP THE DATABASE BEFORE RUNNING.
-- ============================================================================

START TRANSACTION;

-- ---- Blogs (6 orphans) ----
-- Blog 13: The Complete US-India Accounting Team Workflow Guide -> Finance & Accounts Compliance Outsourcing
UPDATE `blogs` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance &amp; Accounts Compliance Outsourcing</a> — for teams ready to move from ad-hoc cross-border support to a structured, SOP-driven accounting function.
  </p>
</div>') WHERE `id` = 13;

-- Blog 14: Inter-State Power Sales -> Risk Advisory (primary) + Finance & Compliance (secondary)
UPDATE `blogs` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/risk-advisory-augmenting-business-process">Risk Advisory &amp; Augmenting Business Process</a> — for IPPs structuring GNA, ISTS waiver, and surcharge exposure as ongoing regulatory risk, not one-time diligence.<br><br>
    <a href="https://devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance &amp; Accounts Compliance Outsourcing</a> — for the recurring compliance load that comes with multi-state power project structures.
  </p>
</div>') WHERE `id` = 14;

-- Blog 15: How to Set Up a GCC in India -> GCC service page + cross-links to blogs 17 & 18
UPDATE `blogs` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/gcc-global-capability-centers">GCC (Global Capability Centers)</a> — for the end-to-end setup, compliance, and CFO-level support once you''ve picked a model.
  </p>
</div>

<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p>
    <a href="https://devmantra.com/blog/gcc-vs-captive-center-vs-bpo-which-india-operating-model-is-right-for-your-business-in-2026">GCC vs Captive Center vs BPO</a> — how to choose the right operating model before you commit to a structure.<br><br>
    <a href="https://devmantra.com/blog/micro-gcc-india-2026-setup-cost-paths-and-timeline">Micro GCC India 2026</a> — setup cost, paths, and timeline for the 15–80 person model this guide references.
  </p>
</div>') WHERE `id` = 15;

-- Blog 16: Virtual CFO Cost in India -> Virtual CFO Services
UPDATE `blogs` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/virtual-cfo-services">Virtual CFO Services</a> — see how Dev Mantra prices and scopes VCFO engagements against the stage-wise ranges in this guide.
  </p>
</div>') WHERE `id` = 16;

-- Blog 17: GCC vs Captive Center vs BPO -- fix throwaway self-link, then add cross-links to blogs 15 & 18
UPDATE `blogs` SET `content` = REPLACE(`content`, 'Talk to the team at <a href="https://devmantra.com">devmantra.com</a>.', 'Talk to Dev Mantra''s <a href="https://devmantra.com/services/gcc-global-capability-centers">GCC advisory team</a>.') WHERE `id` = 17;
UPDATE `blogs` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p>
    <a href="https://devmantra.com/blog/how-to-set-up-a-gcc-in-india-in-2026-costs-models-and-the-micro-gcc-explained">How to Set Up a GCC in India in 2026</a> — costs, models, and the Micro GCC explained.<br><br>
    <a href="https://devmantra.com/blog/micro-gcc-india-2026-setup-cost-paths-and-timeline">Micro GCC India 2026</a> — setup cost, paths, and timeline.
  </p>
</div>') WHERE `id` = 17;

-- Blog 18: Micro GCC India 2026 -- fix throwaway self-link, then add cross-links to blogs 15 & 17
UPDATE `blogs` SET `content` = REPLACE(`content`, 'the conversation starts at <a', 'the conversation starts with Dev Mantra''s <a') WHERE `id` = 18;
UPDATE `blogs` SET `content` = REPLACE(`content`, 'href="https://devmantra.com">devmantra.com</a>.', 'href="https://devmantra.com/services/gcc-global-capability-centers">GCC advisory team</a>.') WHERE `id` = 18;
UPDATE `blogs` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">RELATED READING</strong>
  <p>
    <a href="https://devmantra.com/blog/how-to-set-up-a-gcc-in-india-in-2026-costs-models-and-the-micro-gcc-explained">How to Set Up a GCC in India in 2026</a> — costs, models, and the Micro GCC explained.<br><br>
    <a href="https://devmantra.com/blog/gcc-vs-captive-center-vs-bpo-which-india-operating-model-is-right-for-your-business-in-2026">GCC vs Captive Center vs BPO</a> — how this setup model compares to captive and BPO alternatives.
  </p>
</div>') WHERE `id` = 18;

-- ---- Reports ----
-- Report 1: India's Critical Minerals and Battery Recycling Sector -> Business Set Up (primary) + M&A Advisory (secondary)
UPDATE `reports` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/business-set-up-startup-collaboration">Business Set Up &amp; Startup Collaboration</a> — for entities structuring a market entry into India''s critical minerals and battery recycling value chain.<br><br>
    <a href="https://devmantra.com/services/m-a-advisory-services">M&amp;A Advisory Services</a> — for consolidation and acquisition plays as the sector''s competitive window narrows.
  </p>
</div>') WHERE `id` = 1;

-- Report 2: RBI M&A Financing Rules 2026 Explained -> M&A Advisory Services
UPDATE `reports` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/m-a-advisory-services">M&amp;A Advisory Services</a> — for structuring acquisition financing within the RBI''s Tier-1 cap, promoter contribution floor, and debt-equity limits covered in this report.
  </p>
</div>') WHERE `id` = 2;

-- ---- Case Studies ----
-- Case Study 1: India 2026-27 Union Budget Impact Study -> Finance & Compliance + Corporate Governance
UPDATE `case_studies` SET `content` = CONCAT(`content`, '

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">RELATED SERVICES</strong>
  <p>
    <a href="https://devmantra.com/services/finance-accounts-compliance-outsourcing-services">Finance &amp; Accounts Compliance Outsourcing</a> — for foreign entities adapting reporting and compliance workflows to the transfer pricing and customs changes above.<br><br>
    <a href="https://devmantra.com/services/corporate-governance">Corporate Governance</a> — for boards reassessing structure and disclosure obligations under the Budget''s reforms.
  </p>
</div>') WHERE `id` = 1;

-- Verification: confirm every targeted row now contains at least one callout,
-- and that the two blog-17/18 self-links no longer point at the bare domain.
SELECT id, title,
       (content LIKE '%dm-blog-callout%') AS has_callout,
       (content LIKE '%>devmantra.com<%') AS has_bare_self_link
FROM blogs WHERE id IN (13,14,15,16,17,18);
SELECT id, title, (content LIKE '%dm-blog-callout%') AS has_callout FROM reports WHERE id IN (1,2);
SELECT id, title, (content LIKE '%dm-blog-callout%') AS has_callout FROM case_studies WHERE id = 1;

-- Review the SELECT output above -- every has_callout should read 1, every
-- has_bare_self_link should read 0 -- then COMMIT. If anything looks wrong, run
-- ROLLBACK instead.
COMMIT;
