# DevMantra — SEO / GEO Strategy & Implementation Plan (v2)

> **Revised:** 13 June 2026 · Re-framed through the **SEO Authority Architect** skill.
> v1 was a task checklist. v2 is a strategy: business goal first, then floor → ceiling.
> Supersedes `seo-implementation-plan-2026-06-13.md` for sequencing and posture.

---

## 0. Business goal (sits above every SEO metric)

**Goal:** qualified inbound leads for high-value mandates — cross-border M&A, India entry / FDI, Virtual CFO, GCC setup — especially from foreign / cross-border buyers and US CPA firms.

SEO is the channel, not the goal. "Rank one for *what*?" — we optimise for **becoming the cited answer and the default recommendation**, not a trophy keyword. Traffic that doesn't convert is vanity.

**Report top-down (never traffic-first):**
1. **Business** — consultation requests, calculator/lead-gate submissions, mandate enquiries.
2. **Influence** — AI Share of Voice (cited in ChatGPT/Perplexity/Google AI answers), brand-search growth, share of voice vs CFO Bridge / Grant Thornton / BDO / Resurgent.
3. **Foundation** — impressions → clicks → indexed pages → rankings.

---

## 1. Posture (why this isn't a generic plan)

Dev Mantra is **two-front + third-front**:

- **Front 1 — Website (authority-led).** Category is competitive, brand-led B2B advisory. The lever is *authority*: definitive money pages, original research/reports, and off-site mentions — not more thin blogs.
- **Front 2 — Local (GBP).** Bengaluru, with a real local-intent layer ("Virtual CFO Bangalore", "M&A advisory Bengaluru"). GMB is currently **backlog** — that's a P1 gap, because for local queries **GBP primary category gates eligibility** before any on-page work matters.
- **Front 3 — AI search.** Largely follows if Fronts 1–2 are done well (GEO ≈ 70–80% traditional SEO), *plus* the off-site "ceiling" work below.

**Floor vs Ceiling.** Everything shipped today (schema, titles, H1, FAQ) is the **floor** — required, now largely in place. It does **not** by itself win AI citations. The **ceiling** — brand mentions, digital PR, Reddit/Quora/industry-pub presence — is where AI visibility and share of voice are actually won. *"The brands dominating AI citations didn't get there by writing better blog posts — they got there by being talked about in more places."*

> **Skill caveat honoured:** `llms.txt` is **nice-to-have only** ("we haven't seen much impact"). We keep the refreshed file (cheap, correct) but it is **not** a GEO strategy. Real GEO = consensus across many sources.

---

## 2. Money-pages-first (the core re-prioritisation)

The **9 service pages are the money pages.** Blogs are clusters that funnel into them. Rule: **go wide on money pages first, then finish ONE cluster funnel before starting the next.** A keyword without a conversion path is wasted traffic.

**Topical map — pillar (money page) → cluster (supporting blogs):**

| Pillar (money page) | Cluster blogs (existing → gaps) |
|---|---|
| **India Entry / FDI** | ✅ WOS vs LLP vs Branch vs Liaison → +"DTAA optimisation", "GIFT City vs mainland", "FDI approval routes 2026" |
| **M&A Advisory** | ✅ RBI M&A financing report → +"buy-side vs sell-side process", "M&A due diligence checklist India" |
| **Virtual CFO** (quick-win) | ✅ Enabling scalable growth → +"when to hire a Virtual CFO", "Virtual CFO cost India", "fractional CFO vs full-time" |
| **GCC Setup** (unique differentiator) | +"GCC setup cost India", "GCC vs GIC vs captive", "Bengaluru GCC talent" |
| **Finance/Accounts Outsourcing** | ✅ US–India accounting workflow → +"US CPA offshore model", "audit outsourcing SLAs" |
| **Corporate Governance** | ✅ Strengthening corporate governance → cluster funnel into the service |

GCC is the **unique** differentiator (no direct competitor offers it) — prioritise its money page + cluster for both ranking and AI-citation upside.

---

## 3. Where we are vs the SEO Maturity Timeline

| Phase | Expectation | DevMantra status |
|---|---|---|
| 0–3 mo: tracking + fix + schema | GSC/GA4 conversions, schema, indexing | ✅ Largely done. Schema now auto-injects; titles/H1 fixed; sitemap live. **Verify GA4 conversions + AI-SoV tracking.** |
| 3–6 mo: impressions rise, long-tail, all indexed | everything indexed | 🟡 ~20 indexed, target 35→80. Index-recovery + internal links pending. |
| 6–12 mo: top-10, steady leads | rankings + leads | ⏳ ahead of us |

We are at the **0–3 → 3–6 boundary.** Correct next move is **finish the floor + start the ceiling**, not chase head terms.

---

## 4. Revised roadmap (Foundation → Build → Amplify → Compound)

### ✅ FOUNDATION — the floor (mostly shipped 13 Jun)
Schema auto-injection (every blog/service), site-wide title de-dup, homepage H1, About FAQ + FAQPage schema, enriched Organization (E-E-A-T), refreshed llms.txt. **Remaining:** apply meta/canonical SQL on **production**; run `php artisan migrate` on any DB missing SEO columns; deploy + `view:cache`; validate in Rich Results Test; resubmit sitemap; confirm GA4 conversion tracking.

### 🔨 BUILD — money pages + one cluster (next 2–4 weeks)
- **P0 Money pages:** audit all 9 service pages against the **Six On-Page Elements** (title 50–60 front-loaded, meta 150–160 ad-copy, one H1, keyword in first 100 words + an H2 + conclusion, descriptive anchors, FAQ block). Add per-service **FAQPage** (extend the /about pattern). Make each page **5× better than the current top-5 result** (read the SERP first).
- **P0 Local front:** GBP audit — pull top-3 competitors' **primary category** via Maps; match it. Single highest-leverage local move (page-2 → 3-pack in <30 days). Then NAP consistency (Brand Brain audit already lists the platforms).
- **P1 One cluster funnel:** pick **Virtual CFO** (fastest commercial intent) OR **GCC** (unique). Build the full pillar→cluster set, internally linked, before moving to the next cluster.
- **P1 Indexing gate:** manually request indexing for unindexed pages; confirm re-indexing after edits; keep AI bots whitelisted (done in robots).

### 📣 AMPLIFY — the ceiling (starts in parallel, this is the real GEO lever)
- **Off-site mentions > backlinks.** Seed semantically-matched, genuinely useful answers on **Reddit / Quora** (India-entry, Virtual CFO, GCC threads), pursue **industry-publication features** and founder bylines, and get listed/reviewed where buyers look (G2-type for finance ops, directories like Clutch/GoodFirms). *Mentions teach AI the brand↔topic link even without a link.*
- **Brand as the consensus answer.** The LLM Consensus Model: the more places Dev Mantra is named a category leader (esp. GCC + cross-border M&A), the more AI defaults to it. Founder thought-leadership (CA Nidhi Tatia / partners) on LinkedIn feeds this.
- **Amplify 2× more than you create.** Each report/blog gets twice the effort in distribution (LinkedIn, newsletter, outreach) as in writing.
- **Original research = citation magnet.** The RBI M&A financing and Budget-impact pieces are the right kind — definitive, quotable, data-led. Do more of these; they earn AI citations and PR.

### 🪴 COMPOUND — topical authority + measurement (month 3+)
Expand the topical map cluster-by-cluster; monthly GSC read (impressions vs clicks); incognito **AI-competition test** (ask ChatGPT the buyer's question, see who's named); track **AI Share of Voice** + brand search as the leading metrics.

---

## 5. AEO / GEO specifics (becoming the cited answer)

- **AEO is binary** — you're cited or you're "literally zero." Target the actual buyer questions with definitive, **structured, quotable** answers (FAQ + tables + clear H2 questions). The /about FAQ is step one; extend to every money page and top cluster blog.
- **Create for humans, package for AI** — one liftable sentence per key claim, backed by a number (₹5,000 Cr, ICAI FRN 011067S, 20+ years). Marketing-debt fluff ("we're the best") is invisible to AI — keep claims quantitative.
- **Comparison + definitive pieces** rank and get cited (WOS-vs-LLP is exactly right). Build more: "GCC vs captive vs GIC", "Virtual CFO vs full-time CFO", "Big 4 vs boutique for India entry".
- **Off-site is where AI citations come from** — prioritise it over more on-site blogging once the floor is solid.

---

## 6. Do-NOT list (explicit)
- ❌ No mass AI-slop blogging (short bump, then below baseline ~6 mo).
- ❌ No new blogs before the **money pages** are 5×-better and FAQ'd.
- ❌ No chasing #1 on head terms at current authority — win long-tail + AI citations first.
- ❌ Don't treat `llms.txt` or schema as a GEO silver bullet — they're table stakes.
- ❌ No DB writes to production without a backup; no AI publishing to the live site unsupervised.
- ❌ Don't report rank-tracking/traffic as the scorecard — lead with leads + AI SoV.

---

## 7. Immediate next actions (this week)
1. **Unblock DB:** confirm prod vs local; `php artisan migrate` where columns missing; run meta/canonical SQL on **production** after backup.
2. **Deploy** today's blade/PHP changes → `view:cache` → validate schema in Rich Results Test → resubmit sitemap.
3. **GBP:** competitor primary-category pull + match (P0 local).
4. **Money pages:** Six-On-Page audit of all 9 services + add per-service FAQ schema.
5. **Pick the first cluster** (Virtual CFO or GCC) and brief it via the Task Engine (acceptance criteria per task).
6. **Stand up measurement:** confirm GA4 conversions; baseline AI-SoV via incognito ChatGPT/Perplexity tests on the 6 buyer questions.
