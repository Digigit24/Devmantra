# DevMantra — Internal Linking Batch: Implementation Summary (2026-08-06)

**Prepared by:** Digitech Solutions
**Basis:** `SEO/internal-linking-plan.md`, cross-checked against your real production DB dump (`devmasjc_devmantra_4.sql`, imported and tested in a disposable sandbox this session — every statement below was run against your actual content and verified byte-for-byte before being handed to you).

This closes out the 5-part batch you approved ("okay so lets go"). Nothing has touched your live database — these are ready-to-run SQL scripts, same workflow as `SEO/sql/01_...` and `02_...`. Two small template edits were made directly to your local repo (see §6).

---

## 1. What each SQL file does

| File | What it does | Rows affected |
|---|---|---|
| `04_orphan_content_internal_links_2026-08-06.sql` | Adds "RELATED SERVICES" / "RELATED READING" link callouts to the 6 blogs, 2 reports, and 1 case study that had **zero outbound internal links** (found during the internal-linking audit). Also fixes 2 throwaway self-links on blogs 17 & 18 that pointed at the bare homepage instead of the GCC service page. | 9 rows (6 blogs + 2 reports + 1 case study) |
| `05_service_cross_links_rebuild_2026-08-06.sql` | Replaces the "Explore Our Other Services" block on **all 9 service pages** — was a flat grid linking to all 8 siblings, now 2 curated, thematically-related links per page (per the plan's Section 6b). This also fixes the live P0 bug on service #3 (Deals, Due Diligence & Transaction Advisory), whose grid had 7 of 8 links pointing at shortened, non-existent slugs (e.g. `/services/virtual-cfo` instead of `/services/virtual-cfo-services`). | 9 rows |
| `06_www_to_nonwww_content_rewrite_2026-08-06.sql` | Bulk-swaps `https://www.devmantra.com` → `https://devmantra.com` inside stored content, matching the non-www canonical decision. | 8 blogs, 61 newsletters, 1 alert |
| `07_newsletter_66_footer_fix_2026-08-06.sql` | Adds the missing "DEV MANTRA SERVICES" footer callout to newsletter #66 (July 2026 Tax/GST edition) — every other recent edition has one, this one didn't. Links chosen to match this edition's actual content (Finance & Compliance Outsourcing + Corporate Governance), not just copied from another edition. | 1 row |

**Run order:** 04 → 05 → 06 → 07 (each is independent, but this is the order they were tested in together). Each file is wrapped in `START TRANSACTION` / `COMMIT` with a verification `SELECT` in between — check the output looks right before the `COMMIT` fires, same pattern as your existing scripts. **Back up the database before running.**

## 2. Content → Service link map (what got linked to what, and why)

| Content | Links added | Why this pairing |
|---|---|---|
| Blog: The Complete US–India Accounting Team Workflow Guide | Finance & Accounts Compliance Outsourcing | Direct topical match — the post is about the accounting workflow this service delivers |
| Blog: Inter-State Power Sales in India | Risk Advisory & Augmenting Business Process (primary), Finance & Accounts Compliance Outsourcing (secondary) | Regulatory/surcharge risk is the post's core theme; the compliance load is the natural secondary |
| Blog: How to Set Up a GCC in India in 2026 | GCC (Global Capability Centers) + cross-links to "GCC vs Captive vs BPO" and "Micro GCC India 2026" | Pillar page for this post's whole topic, plus its two closest-sibling posts |
| Blog: Virtual CFO Cost in India 2026 | Virtual CFO Services | Direct pillar match |
| Blog: GCC vs Captive Center vs BPO | GCC service page (fixed from a bare homepage self-link) + cross-links to the other 2 GCC blogs | Same GCC cluster as above |
| Blog: Micro GCC India 2026 | GCC service page (fixed from a bare homepage self-link) + cross-links to the other 2 GCC blogs | Same GCC cluster |
| Report: India's Critical Minerals and Battery Recycling Sector | Business Set Up & Startup Collaboration (primary), M&A Advisory Services (secondary) | Market-entry angle is primary; consolidation/M&A plays as the sector matures is secondary |
| Report: RBI M&A Financing Rules 2026 Explained | M&A Advisory Services | Direct topical match |
| Case Study: India 2026–27 Union Budget Impact Study | Finance & Accounts Compliance Outsourcing + Corporate Governance | Budget's transfer-pricing/customs changes hit compliance workflows; its disclosure reforms hit governance |
| Newsletter #66 (July 2026 Tax/GST edition) | Finance & Accounts Compliance Outsourcing + Corporate Governance | Matches this specific edition's GST/tax and SEBI/IBBI/MCA content, not a generic default |

## 3. Service → Service cross-links (all 9 pages, from the plan's Section 6b)

| Service | Links to |
|---|---|
| Virtual CFO Services | Finance & Accounts Compliance Outsourcing, IPO Advisory Services |
| Finance & Accounts Compliance Outsourcing | Virtual CFO Services, Risk Advisory & Augmenting Business Process |
| Deals, Due Diligence & Transaction Advisory | M&A Advisory Services, IPO Advisory Services |
| Business Set Up & Startup Collaboration | GCC (Global Capability Centers), Finance & Accounts Compliance Outsourcing |
| IPO Advisory Services | Corporate Governance, Virtual CFO Services |
| Corporate Governance | M&A Advisory Services, Risk Advisory & Augmenting Business Process |
| GCC (Global Capability Centers) | Business Set Up & Startup Collaboration, Virtual CFO Services |
| M&A Advisory Services | Deals, Due Diligence & Transaction Advisory, Corporate Governance |
| Risk Advisory & Augmenting Business Process | Finance & Accounts Compliance Outsourcing, Corporate Governance |

**Design call I made:** kept the existing `{label, url}` schema and the existing "Explore Our Other Services" heading/card labels (e.g. "Finance Accounts Compliance Outsourcing") rather than swapping in the plan's SEO-phrased anchor text (e.g. "finance and compliance outsourcing"). That keeps the visual grid looking exactly as it does today — just correct and curated instead of broken and exhaustive. If you'd rather use the plan's keyword-phrased anchor text as the visible label, tell me and I'll rewrite this one script.

## 4. Everything was tested before being handed to you

Every statement in all 4 files was run against a disposable, freshly-imported copy of your real production dump (not a stale/synthetic sample) in an isolated sandbox on my end, then verified: correct link targets (no typos, no broken slugs), correct callout markup, no leftover bare self-links, and — for the two files that needed find/replace on real body copy (blog 17 and 18's self-link fix) — a byte-for-byte diff confirming the final content matches exactly what was designed. I also ran all 4 files back-to-back in sequence to confirm they don't conflict with each other.

One thing worth flagging: while building this, I found that MariaDB's command-line client silently drops embedded CRLF line-wraps when a SQL string search spans that line break — a search string containing a literal newline can fail to match with zero error, silently leaving the "fix" unapplied. I hit this exact bug once while building blog 18's self-link fix, caught it because the finished-vs-expected content diff came up wrong, and rewrote that one fix as two single-line `REPLACE()` calls instead. Flagging it in case it's useful context for anyone on your team writing raw content-replace SQL by hand in the future.

## 5. Post-run verification query (optional, read-only)

```sql
SELECT 'blogs_with_dm_callout' AS metric, COUNT(*) FROM blogs WHERE content LIKE '%dm-blog-callout%'
UNION ALL SELECT 'reports_with_dm_callout', COUNT(*) FROM reports WHERE content LIKE '%dm-blog-callout%'
UNION ALL SELECT 'case_studies_with_dm_callout', COUNT(*) FROM case_studies WHERE content LIKE '%dm-blog-callout%'
UNION ALL SELECT 'newsletters_with_dm_callout', COUNT(*) FROM newsletters WHERE content LIKE '%dm-blog-callout%'
UNION ALL SELECT 'remaining_www_refs',
  (SELECT COUNT(*) FROM blogs WHERE content LIKE '%www.devmantra.com%')
  + (SELECT COUNT(*) FROM newsletters WHERE content LIKE '%www.devmantra.com%')
  + (SELECT COUNT(*) FROM alerts WHERE content LIKE '%www.devmantra.com%');
```
Expected after running 04–07: `blogs_with_dm_callout` = 16, `reports_with_dm_callout` = 2, `case_studies_with_dm_callout` = 1, `newsletters_with_dm_callout` = 62, `remaining_www_refs` = 0.

## 6. Code change made directly to your repo (already done, not a script)

The callout markup used above (`dm-blog-callout`) only had its CSS (`assets/css/dm-blog-components.css`) enqueued on the blog-detail template — reports and case studies would have rendered these new callouts completely unstyled. I added the same one-line stylesheet `<link>` to both templates, matching exactly how `blog-detail.blade.php` already does it:

- `resources/views/frontend/report-detail.blade.php`
- `resources/views/frontend/case-study-detail.blade.php`

**Deploy note:** upload both files alongside the SQL run, then `php artisan view:cache`. No visual change on any page except that the new "RELATED SERVICES" boxes on reports/case studies will now render with the same styled look as the blog callouts.

## 7. What this batch does NOT cover (still open)

- Newsletter recent-editions cross-linking beyond #66 (plan Section 6f — older editions), and the P2/older-newsletter phase of the plan generally.
- Inbound links *to* the reports/case study (they now link out, but nothing else on the site currently links to them — that's a separate "who should link in" pass, not part of the orphan-outbound-link problem this batch solved).
- Blog → blog links beyond the 3-post GCC cluster (plan Section 6c has a few more pairs not touched here since they weren't part of the 5 approved batches).

Say the word if you want any of those queued next.
