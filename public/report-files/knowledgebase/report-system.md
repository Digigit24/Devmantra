# Dev Mantra Report Design System — AI Knowledgebase v1.0

**Purpose:** This file teaches an AI agent exactly how to generate a polished, on-brand Dev Mantra report HTML file from raw content. Read every section before generating a report.

---

## 1. OVERVIEW

Dev Mantra publishes standalone HTML report files stored at:
```
public/report-files/{slug}.html
```

Each file is a **complete self-contained page** that:
- Looks premium when opened directly in a browser
- Links to the shared CSS theme at `/reports/report-theme.css`
- Is registered in the reports database with title, slug, edition_label, excerpt

The visual identity: **deep navy backgrounds, white content sections, a tri-color gradient (orange→magenta→blue) as the brand accent, Onest font.**

---

## 2. BRAND TOKENS (CSS Variables — defined in report-theme.css)

```
--dm-gradient: linear-gradient(230deg, #FF994B 6.7%, #D34BE9 48.83%, #3188FF 90.96%)

Dark backgrounds:
  --rpt-navy:        #001d30   ← deepest (cover, footer)
  --rpt-navy-mid:    #051e35
  --rpt-navy-light:  #0a2e4e  ← callout dark bg
  --rpt-navy-card:   #0d2d48  ← dark card bg

Light backgrounds:
  --rpt-white:    #ffffff
  --rpt-offwhite: #f4f6fb
  --rpt-grey:     #eef0f5

Accents:
  --rpt-cyan: #00b8d4   ← left borders, highlights, bullet dots
  --rpt-gold: #FFB701   ← warnings, breaking news
  --rpt-red:  #FF4851   ← risk callouts
  --rpt-blue:    var(--dm-blue)  ← positive callouts

Text:
  --rpt-text:       #1e293b
  --rpt-text-muted: rgba(30,41,59,0.55)
  --rpt-text-light: rgba(255,255,255,0.85)
  --rpt-text-faint: rgba(255,255,255,0.45)
```

---

## 3. FILE STRUCTURE TEMPLATE

Every report HTML follows this exact shell:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{REPORT TITLE} | Dev Mantra</title>
  <meta name="description" content="{150-CHAR EXCERPT}">
  <link rel="icon" href="/assets/img/favicon/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="/report-files/report-theme.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>

  <!-- 1. Reading Progress Bar -->
  <div id="rpt-progress"></div>

  <!-- 2. Sticky Chapter Nav -->
  <nav id="rpt-nav">...</nav>

  <!-- 3. Cover Section -->
  <section class="rpt-cover" id="cover">...</section>

  <!-- 4. Executive Summary -->
  <section class="rpt-exec rpt-section--alt" id="exec-summary">...</section>

  <!-- 5-N. Report Chapters (alternating white/alt/dark) -->
  <section class="rpt-section rpt-section--white" id="ch1">...</section>
  <section class="rpt-section rpt-section--alt"   id="ch2">...</section>
  ...

  <!-- N+1. CTA Footer -->
  <footer class="rpt-footer">...</footer>

  <!-- Scripts: Charts + Interactions -->
  <script>...</script>
</body>
</html>
```

---

## 4. COMPONENT LIBRARY

### 4.1 READING PROGRESS BAR
Always include. It's a thin gradient line at top of viewport that fills as user scrolls.

```html
<!-- In <body>, first element -->
<div id="rpt-progress"></div>

<!-- In <script> at bottom -->
window.addEventListener('scroll', () => {
  const el = document.getElementById('rpt-progress');
  const pct = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
  el.style.width = Math.min(pct, 100) + '%';
});
```

---

### 4.2 STICKY CHAPTER NAV

```html
<nav id="rpt-nav">
  <div class="rpt-nav-logo">
    <img src="/assets/img/logo/logo-white.png" alt="Dev Mantra">
    <span>Industry Insight</span>
  </div>
  <div class="rpt-nav-chapters">
    <button class="rpt-nav-link" onclick="scrollTo('ch1')">01 · {Short Title}</button>
    <button class="rpt-nav-link" onclick="scrollTo('ch2')">02 · {Short Title}</button>
    <!-- repeat for each chapter -->
  </div>
  <div class="rpt-nav-actions">
    <button class="rpt-nav-btn" onclick="window.print()">
      <i class="fa-solid fa-download"></i> Download
    </button>
    <a href="https://devmantra.com/contact" class="rpt-nav-btn primary">Book a Call</a>
  </div>
</nav>
```

JS for active chapter tracking:
```js
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.rpt-nav-link');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      navLinks.forEach(l => l.classList.remove('active'));
      const active = document.querySelector(`.rpt-nav-link[data-target="${e.target.id}"]`);
      if (active) active.classList.add('active');
    }
  });
}, { threshold: 0.3 });
sections.forEach(s => observer.observe(s));
```
Add `data-target="chN"` to each nav button and `onclick="document.getElementById('chN').scrollIntoView({behavior:'smooth'})"`.

---

### 4.3 COVER SECTION

```html
<section class="rpt-cover" id="cover">
  <div class="rpt-cover-inner">
    <div class="rpt-cover-tag">Industry Insight &nbsp;·&nbsp; {Report Type}</div>
    <h1 class="rpt-cover-title">{FULL REPORT TITLE}</h1>
    <p class="rpt-cover-subtitle">{2-3 sentence compelling hook from the report intro}</p>
    <div class="rpt-cover-edition">
      <span>{Month Year}</span>
      <span>|</span>
      <span>AOne Dev Mantra Financial Services Pvt. Ltd.</span>
    </div>
  </div>
  <!-- KPI strip: always 3 stats from the report -->
  <div class="rpt-kpi-strip">
    <div class="rpt-kpi-item">
      <div class="rpt-kpi-num">{STAT 1 VALUE}</div>
      <div class="rpt-kpi-label">{Stat 1 Label}</div>
      <div class="rpt-kpi-sub">{Source / context}</div>
    </div>
    <div class="rpt-kpi-item">
      <div class="rpt-kpi-num">{STAT 2 VALUE}</div>
      <div class="rpt-kpi-label">{Stat 2 Label}</div>
      <div class="rpt-kpi-sub">{Source / context}</div>
    </div>
    <div class="rpt-kpi-item">
      <div class="rpt-kpi-num">{STAT 3 VALUE}</div>
      <div class="rpt-kpi-label">{Stat 3 Label}</div>
      <div class="rpt-kpi-sub">{Source / context}</div>
    </div>
  </div>
</section>
```

**Rules:**
- Title: max 10 words, no period
- Hook: max 60 words, end with an observation not a question
- KPIs: always exactly 3, must be from the report data

---

### 4.4 EXECUTIVE SUMMARY

```html
<section class="rpt-exec rpt-section--alt" id="exec-summary">
  <div class="rpt-container">
    <div class="rpt-exec-label">Executive Summary</div>
    <div class="rpt-exec-grid">
      <div class="rpt-exec-item">
        <div class="rpt-exec-num">01</div>
        <div class="rpt-exec-text">{Key takeaway sentence 1 — ~25 words}</div>
      </div>
      <div class="rpt-exec-item">
        <div class="rpt-exec-num">02</div>
        <div class="rpt-exec-text">{Key takeaway sentence 2}</div>
      </div>
      <div class="rpt-exec-item">
        <div class="rpt-exec-num">03</div>
        <div class="rpt-exec-text">{Key takeaway sentence 3}</div>
      </div>
      <div class="rpt-exec-item">
        <div class="rpt-exec-num">04</div>
        <div class="rpt-exec-text">{Key takeaway sentence 4}</div>
      </div>
    </div>
  </div>
</section>
```

**Rules:** 3-5 items. Each is one assertion, not a topic label. State the finding, not the section name.

---

### 4.5 CHAPTER HEADER (light sections)

```html
<div class="rpt-ch-header">
  <div class="rpt-ch-num">0{N}</div>
  <div class="rpt-ch-title-wrap">
    <div class="rpt-ch-tag">Chapter {N}</div>
    <h2 class="rpt-ch-title">{Chapter Title}</h2>
    <p class="rpt-ch-lead">{1-2 sentence chapter intro}</p>
  </div>
</div>
```

For dark sections, add `--dark` modifiers:
```html
<div class="rpt-ch-header rpt-ch-header--dark">
  <div class="rpt-ch-num rpt-ch-num--dark">0{N}</div>
  <div class="rpt-ch-title-wrap">
    <div class="rpt-ch-tag">Chapter {N}</div>
    <h2 class="rpt-ch-title rpt-ch-title--white">{Title}</h2>
    <p class="rpt-ch-lead rpt-ch-lead--light">{Intro}</p>
  </div>
</div>
```

---

### 4.6 STAT CARDS

For 4+ company/OEM stats:
```html
<div class="rpt-oem-grid">
  <div class="rpt-oem-card">
    <div class="rpt-oem-name">{Company Name}</div>
    <div class="rpt-oem-stat">{+000% YoY}</div>
    <div class="rpt-oem-desc">{What the stat measures}</div>
  </div>
  <!-- repeat -->
</div>
```

For 3-4 general stat cards:
```html
<div class="rpt-stat-grid">
  <div class="rpt-stat-card">
    <div class="rpt-stat-val">{VALUE}</div>
    <div class="rpt-stat-name">{Metric Name}</div>
    <div class="rpt-stat-sub">{Source, period, context}</div>
  </div>
  <!-- repeat -->
</div>
```

For dark-background stat cards, add class `rpt-stat-card--dark`.

---

### 4.7 CALLOUT BOXES

**Types:**
- `rpt-callout--insight` → dark navy, cyan border. Use for "WHY THIS MATTERS", strategic insight
- `rpt-callout--breaking` → dark card, gradient top. Use for breaking news, announcements
- `rpt-callout--warning` → gold border. Use for implementation challenges, risks to note
- `rpt-callout--risk`    → red border. Use for serious risks, legal challenges
- `rpt-callout--positive`→ green border. Use for opportunities, advantages

```html
<div class="rpt-callout rpt-callout--{TYPE}">
  <span class="rpt-callout-tag">{TYPE LABEL e.g. "Breaking News" / "Why This Matters" / "Key Risk"}</span>
  <p>{Main callout text. Can use <strong>bold</strong> for key phrases.}</p>
  <!-- Optional bullet list inside callout: -->
  <ul>
    <li>{Point 1}</li>
    <li>{Point 2}</li>
  </ul>
</div>
```

---

### 4.8 DATA TABLES

Standard policy/comparison table:
```html
<div class="rpt-table-wrap">
  <table class="rpt-table">
    <thead>
      <tr>
        <th>{Column 1 Header}</th>
        <th>{Column 2 Header}</th>
        <!-- add more if needed -->
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{Row Label}</td>
        <td>{Row Content — can include HTML}</td>
      </tr>
      <!-- repeat rows -->
    </tbody>
  </table>
</div>
<p class="rpt-table-caption">Source: {data source}</p>
```

For dark-background sections, add `rpt-table--dark` class to `<table>`.

---

### 4.9 CHART CONTAINERS

```html
<div class="rpt-chart-wrap">
  <div class="rpt-chart-title">{Chart Title}</div>
  <div class="rpt-chart-sub">{Source / Period}</div>
  <div class="rpt-chart-canvas">
    <canvas id="{uniqueChartId}"></canvas>
  </div>
</div>
```

For dark-bg sections, add `rpt-chart-wrap--dark` to the wrapper.

Chart JS (place in `<script>` at bottom):

**Bar Chart:**
```js
new Chart(document.getElementById('{id}'), {
  type: 'bar',
  data: {
    labels: ['{Label1}', '{Label2}', ...],
    datasets: [{
      label: '{Dataset Label}',
      data: [{val1}, {val2}, ...],
      backgroundColor: ['rgba(49,136,255,0.8)', 'rgba(212,75,233,0.8)', 'rgba(255,153,75,0.8)', ...],
      borderRadius: 6,
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } } }
  }
});
```

**Horizontal Bar:**
```js
new Chart(document.getElementById('{id}'), {
  type: 'bar',
  data: { labels: [...], datasets: [{ data: [...], backgroundColor: [...], borderRadius: 4 }] },
  options: {
    indexAxis: 'y',
    responsive: true,
    plugins: { legend: { display: false } },
    scales: { x: { beginAtZero: true } }
  }
});
```

**Line Chart:**
```js
new Chart(document.getElementById('{id}'), {
  type: 'line',
  data: {
    labels: [...],
    datasets: [{
      label: '{Label}',
      data: [...],
      borderColor: '#3188FF',
      backgroundColor: 'rgba(49,136,255,0.08)',
      fill: true,
      tension: 0.4,
      pointBackgroundColor: '#3188FF',
      pointRadius: 5,
    }]
  },
  options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
});
```

**Recommended colors for charts (use in order):**
1. `rgba(49,136,255,0.85)`  — brand blue
2. `rgba(212,75,233,0.85)`  — brand magenta
3. `rgba(255,153,75,0.85)`  — brand orange
4. `rgba(0,184,212,0.85)`   — cyan
5. `rgba(16,185,129,0.85)`  — green
6. `rgba(255,72,81,0.85)`   — red

---

### 4.10 PULL QUOTE

Use for key regulatory/analyst statements. 1-2 sentences max.
```html
<blockquote class="rpt-pullquote">
  <p>{The statement being quoted or highlighted.}</p>
  <cite>{Source — e.g. "NITI Aayog, 2024"}</cite>
</blockquote>
```

---

### 4.11 TWO-COLUMN LAYOUT

```html
<div class="rpt-two-col">        <!-- or rpt-two-col--60-40 or rpt-two-col--40-60 -->
  <div>
    <!-- Left column content -->
  </div>
  <div>
    <!-- Right column content (often a chart or stat card) -->
  </div>
</div>
```

---

### 4.12 RISK / CHALLENGE LIST

For listing implementation challenges or risks:
```html
<ul class="rpt-risk-list">
  <li class="rpt-risk-item">
    <div class="rpt-risk-title">{Challenge Name}</div>
    <div class="rpt-risk-desc">{1-2 sentence explanation}</div>
  </li>
  <!-- repeat -->
</ul>
```

---

### 4.13 CTA FOOTER

Always use this exact structure:
```html
<footer class="rpt-footer">
  <div class="rpt-footer-inner">
    <div class="rpt-footer-logo">
      <img src="/assets/img/logo/logo-white.png" alt="Dev Mantra">
    </div>
    <div class="rpt-footer-tagline">AOne Dev Mantra Financial Services Pvt. Ltd.</div>
    <h2 class="rpt-footer-heading">{CTA heading — 6-10 words about taking action}</h2>
    <p class="rpt-footer-sub">{2-3 sentences about why they should contact Dev Mantra}</p>
    <div class="rpt-footer-actions">
      <a href="https://devmantra.com/contact" class="rpt-btn rpt-btn--primary">
        <i class="fa-solid fa-calendar"></i> Book a Discovery Call
      </a>
      <button class="rpt-btn rpt-btn--ghost" onclick="window.print()">
        <i class="fa-solid fa-download"></i> Download PDF
      </button>
    </div>
    <div class="rpt-footer-bottom">
      <p class="rpt-footer-disc">
        This report has been prepared by AOne Dev Mantra Financial Services Private Limited for informational purposes only.
        The contents should not be construed as investment, financial, legal, or professional advice.
        This document is the intellectual property of AOne Dev Mantra Financial Services Private Limited.
      </p>
      <div class="rpt-footer-copy">© {YEAR} Dev Mantra. All rights reserved.</div>
    </div>
  </div>
</footer>
```

---

## 5. PAGE ASSEMBLY RULES

### Section Alternation (light reports)
```
Cover (dark)
→ Executive Summary (alt/offwhite)
→ Ch 1 (white)
→ Ch 2 (alt)
→ Ch 3 (white)
→ Ch 4 (dark) ← every 4th or at major turning points, use a dark section
→ Ch 5 (white)
...
→ CTA Footer (dark)
```

### Dark Section Content Rules
When a section has `rpt-section--dark`:
- Use `rpt-ch-title--white` on the chapter title
- Use `rpt-ch-num--dark` on the number
- Use `rpt-ch-lead--light` on the intro
- Use `rpt-body--dark` on the body div
- Use `rpt-table--dark` on tables
- Use `rpt-chart-wrap--dark` on chart wrappers
- Use `rpt-stat-card--dark` on stat cards

### Mandatory Components Per Report
Every report MUST include:
1. Progress bar + JS
2. Sticky nav with all chapters listed
3. Cover with exactly 3 KPIs
4. Executive summary (3-5 items)
5. At least 1 chart (use capacity/market data)
6. At least 1 policy/data table
7. At least 1 insight callout (--insight type)
8. CTA footer

### Optional Components (use when data supports it)
- OEM grid (when multiple company stats are given)
- Breaking news callout (for recent announcements)
- Risk list (for challenge sections)
- Pull quote (for key regulatory language)
- Two-column layout (when chart pairs with text well)

---

## 6. CONTENT GUIDELINES

### Tone
- Professional but not dry — read like a Bloomberg brief, not a government document
- Active voice: "India is building..." not "Infrastructure is being built..."
- Numbers always present context: not "60x gap" but "60x recycling capacity gap (2 GWh vs 128 GWh needed)"
- Bold key metrics and company names inline in `<strong>` tags

### Headlines
- Chapter titles: 4-7 words, declarative, no punctuation
- Section headers within chapters: Sentence case, under 8 words

### Paragraphs
- Max 4 sentences per paragraph in body copy
- After every 3-4 paragraphs, break with a component (callout, stat, chart, table)
- Never put 2 callout boxes back-to-back without body text between them

### Citations
- Add source to table captions and chart subtitles
- Use footnote pattern: `Source: Grand View Research, 2024`

---

## 7. HOW TO GENERATE A NEW REPORT

Given a report content document (PDF, text, notes), follow this order:

1. **Extract 3 headline KPIs** for the cover strip
2. **Write 4 executive summary points** — findings not section names
3. **Identify chapter breaks** — usually each major section in source becomes a chapter
4. **Choose section colors** — alternate white/alt, put biggest data chapter on dark
5. **Identify chart opportunities** — any data showing: growth over time, comparisons between firms/options, gap between current vs target
6. **Map content to components** — policy tables → `rpt-table`, challenges → `rpt-risk-list`, announcements → `rpt-callout--breaking`, key insights → `rpt-callout--insight`
7. **Write the nav links** — short (2-4 words) per chapter
8. **Write the CTA footer** — headline relevant to the report's opportunity
9. **Verify**: Does every dark section use `--dark` class variants? Is there at least 1 chart? Does the footer have the disclaimer?

---

## 8. FILE NAMING

```
{topic-slug}-{month}-{year}.html
```
Examples:
- `india-critical-minerals-battery-recycling-march-2026.html`
- `india-ev-policy-landscape-april-2026.html`
- `renewable-energy-financing-q1-2026.html`

---

## 9. DATABASE RECORD (when registering in Laravel)

When adding a report to the DB:
```
title:          "India's Critical Minerals & Battery Recycling Sector"
slug:           "india-critical-minerals-battery-recycling-march-2026"
edition_label:  "Market Intelligence Insight | March 2026"
excerpt:        "A $2 billion recycling market by 2034. A 60x capacity gap. Government subsidies live and waiting."
button_url:     "/reports/india-critical-minerals-battery-recycling-march-2026.html"
button_text:    "View Full Report"
content:        (leave empty or store a summary — the real content is the HTML file)
featured_image: (upload a cover image if available)
published_at:   2026-03-01
```

---

## 10. LOGO PATHS

```
White logo (for dark backgrounds): /assets/img/logo/logo-white.png
Black logo (for light backgrounds): /assets/img/logo/logo-black.png
Color logo:                         /assets/img/logo/logo.jpeg
Favicon:                            /assets/img/favicon/favicon.png
```

---

## 11. EXTERNAL DEPENDENCIES (always include in `<head>`)

```html
<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Report theme CSS (shared across all reports) -->
<link rel="stylesheet" href="/report-files/report-theme.css">

<!-- Chart.js (only if report has charts) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
```

Google Fonts (Onest) is already imported inside `report-theme.css` — do NOT import it again.

---

*End of knowledgebase — v1.0 | Updated: April 2026*
