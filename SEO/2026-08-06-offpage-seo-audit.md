# DevMantra (devmantra.com) — Off-Page SEO Audit

**Prepared by:** Digitech Solutions
**Audit date:** 6 August 2026
**Data source:** Live Semrush API pull (domain rank, organic research, backlink analytics). **Ahrefs data could not be pulled** — the connected Ahrefs account returned "Insufficient plan" for domain-level metrics, so those checks are marked pending below. **Notion could not be pulled either** — the Notion connector is installed for this workspace but not enabled in this chat session, so any off-page activity tracked only in Notion (outreach logs, guest-post pipeline, directory-submission tracker, etc.) is not reflected in this document. See "What's Missing" at the end.

---

## 1. Where DevMantra stands today (live numbers)

| Metric | Value | Read |
|---|---|---|
| Semrush Domain Rank (India DB) | 1,179,602 | Very low authority relative to established competitors — expected for a site that has done almost no deliberate off-page/link-building work yet |
| Organic keywords ranking (India) | 43 | Nearly all branded ("dev mantra financial services") — see Section 2 |
| Estimated monthly organic traffic | 72 visits/mo | Confirms the site is not yet capturing non-branded demand |
| Total backlinks | 659 | |
| Referring domains | 156 | |
| Referring IPs | 113 | |
| Follow vs. nofollow links | 561 follow / 98 nofollow | Healthy follow ratio |
| Backlink Authority Score (Semrush) | 7 / 100 | **This is the real ceiling on rankings right now** — not content, not on-page |
| Trust Score | 7 / 100 | |

## 2. What the 43 ranking keywords actually tell you

Pulled the full keyword list — it is almost entirely **branded/navigational**: "dev mantra financial services," "dev mantra financial services pvt ltd," and a long tail of brand-name misspellings and confusable competitor/lookalike names (e.g., "dev mandal," "demorgia," "devaditya," "codemantra private limited," "divine mantra pvt ltd") that Google associates with the brand purely from search-log co-occurrence, not real competition. Only a handful of **non-branded, commercial-intent** terms show up at all: "ipo consultant" (pos. 54), "ipo advisory" (pos. 53/60), "ipo consultants in india" (pos. 52), "temporary cfo services" (pos. 75), "paymantra" (pos. 28 — likely a brand-confusion term, not real demand).

**Read:** the site currently has ~zero non-branded organic visibility for its actual money-page terms (Virtual CFO, GCC setup, M&A advisory, India entry). This is consistent with a Domain Authority of 7 — there isn't yet enough off-site signal for Google to rank the site for competitive, non-branded B2B advisory terms, regardless of how good the on-page work is.

## 3. Backlink Profile Detail

**Top referring domains by authority (Semrush Authority Score):**

| Domain | Backlinks | Domain Score | Country |
|---|---|---|---|
| wikipedia.org | 3 | 100 | US |
| internshala.com | 2 | 60 | US |
| thecompanycheck.com | 2 | 44 | — |
| owler.com | 1 | 41 | TR |
| bharatibiz.com | 1 | 36 | — |
| freelistingindia.in | 3 | 35 | — |
| bitscale.ai | 3 | 31 | — |
| filesure.in | 4 | 31 | — |
| cioinsiderindia.com | 1 | 26 | IN |
| secretsearchenginelabs.com | 12 | 16 | US |
| theseobacklink.com | 11 | 15 | GB |

**Read on the profile shape:** the top domain (Wikipedia) is almost certainly an incidental/unlinked-brand-mention crawl artifact rather than a deliberate placement — worth checking if it's a real citation worth building on. Below that, the profile is dominated by **low-authority business directories, freelisting sites, and SEO-tool "backlink checker" domains** (`secretsearchenginelabs.com`, `theseobacklink.com`, `backlinks-checker.com`, `bengaluru.directory`) rather than editorial mentions, industry publications, or genuine PR. This is a classic "the site exists, but nobody has actively built its off-page authority yet" profile — 156 referring domains sounds like a number, but almost none of them are the kind of link/mention that moves rankings or feeds AI-citation visibility.

**156 referring domains / 659 backlinks / 113 referring IPs** — no toxic or spam-pattern red flags observed in the sample pulled (no clearly manipulative anchor-text networks visible in this data pull); a full anchor-text distribution report and complete referring-domain export should be run before any disavow decision, but nothing here currently warrants one.

## 4. Local SEO / Google Business Profile

**Not independently verifiable from this session** — no live Google Business Profile / Maps connector was available to pull DevMantra's current GBP listing, primary category, review count, or NAP consistency on that listing. The repo's own `SEO/seo-implementation-plan-v2-2026-06-13.md` already flags this as an open P0 gap: *"GMB is currently backlog — that's a P1 gap, because for local queries GBP primary category gates eligibility before any on-page work matters."* This audit confirms that gap is still open — no code or content evidence of GBP work exists in the repo, and it can't be done from the codebase side at all (it's a Google Business Profile console task, not a code task).

**On-site NAP consistency (the part that *is* code-side):** verified in the on-page audit — `LocalBusiness` schema sources Name/Address/Phone from a single `ContactSetting` model, rendered consistently on homepage and detail pages. So the *code* is NAP-consistent; the *external* GBP listing status is unknown/unverified.

## 5. Off-Page Strategy Already on Record (from `SEO/seo-implementation-plan-v2-2026-06-13.md`)

The team's own June 2026 strategy document already correctly diagnoses the situation above — it explicitly separates the "floor" (on-page, mostly done) from the "ceiling" (off-page authority, where AI citations and real rankings are actually won) and prioritizes:

1. Google Business Profile primary-category audit vs. top-3 local competitors — **not started**.
2. Off-site mentions over pure backlinks: Reddit/Quora seeding, industry-publication features, founder bylines, directory listings (Clutch/GoodFirms-type) — **not started**, no evidence in repo or live backlink profile of any of this yet.
3. Original, citable research (the RBI M&A financing report and the Union Budget impact study are correctly identified as the right kind of asset) — **2 exist**, distribution/amplification effort behind them is unverified from this session.
4. Founder thought-leadership (CA Nidhi Tatia / partners on LinkedIn) — **not verifiable from this session** (no LinkedIn/social connector available).

## 6. What's Missing From This Off-Page Audit

- **Notion off-page tracker:** not pulled. The Notion connector is installed for this Claude workspace but disabled in this chat — enable it in claude.ai's connector settings (or tell me to try again once it's on) and I'll merge in whatever outreach/guest-post/directory pipeline is tracked there.
- **Ahrefs domain/backlink metrics:** the connected Ahrefs account plan doesn't include the domain-rating/backlink endpoints used here (`Insufficient plan` error) — Semrush was used instead and is a reasonable substitute, but a second-source cross-check (Ahrefs or Majestic) is good practice before any major off-page decision.
- **Google Business Profile live status, review count/sentiment.**
- **Social share-of-voice / AI Share-of-Voice** (ChatGPT/Perplexity citation testing) — the strategy doc recommends this as the leading off-page metric going forward; it requires manual incognito testing against buyer questions, not an API pull.

---

*On-page and technical findings are in the companion On-Page & Technical SEO Audit document.*
