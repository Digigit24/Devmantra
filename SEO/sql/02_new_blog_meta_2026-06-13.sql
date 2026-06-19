-- =====================================================================
-- DevMantra — Meta for the 2 new cluster blogs missing meta_title/desc
-- Run in phpMyAdmin → devmantranew  (after 01_onpage_meta_fixes...)
-- Idempotent: keyed by slug; safe to re-run.
-- Brand voice: front-loaded keyword, <=60 char title, 150-160 char desc,
-- specific numbers, no banned words.
-- =====================================================================

-- Blog #17 — GCC vs Captive vs BPO (GCC cluster → GCC money page)
UPDATE blogs SET
    meta_title       = 'GCC vs Captive vs BPO: India Operating Models 2026',
    meta_description = 'Outsource, offshore, or own it? Compare GCC, captive and BPO models for India operations on control, cost, IP and scale, and how to choose the right setup in 2026.',
    canonical_url    = COALESCE(NULLIF(canonical_url,''), 'https://www.devmantra.com/blog/gcc-vs-captive-center-vs-bpo-which-india-operating-model-is-right-for-your-business-in-2026')
WHERE slug = 'gcc-vs-captive-center-vs-bpo-which-india-operating-model-is-right-for-your-business-in-2026';

-- Blog #16 — Virtual CFO cost in India 2026 (Virtual CFO cluster → VCFO money page)
UPDATE blogs SET
    meta_title       = 'Virtual CFO Cost in India 2026: Stage-Wise Pricing',
    meta_description = 'What does a Virtual CFO cost in India in 2026? Stage-wise pricing from Rs 25,000/month for pre-revenue startups to Rs 3.5 lakh+ for Series B and GCC finance teams.',
    canonical_url    = COALESCE(NULLIF(canonical_url,''), 'https://www.devmantra.com/blog/virtual-cfo-cost-in-india-2026-stage-wise-pricing-guide')
WHERE slug = 'virtual-cfo-cost-in-india-2026-stage-wise-pricing-guide';

-- Verify
SELECT slug, meta_title, CHAR_LENGTH(meta_title) AS len,
       (meta_description IS NOT NULL AND meta_description<>'') AS has_desc,
       (canonical_url IS NOT NULL AND canonical_url<>'') AS has_canonical
FROM blogs
WHERE slug IN (
  'gcc-vs-captive-center-vs-bpo-which-india-operating-model-is-right-for-your-business-in-2026',
  'virtual-cfo-cost-in-india-2026-stage-wise-pricing-guide'
);
