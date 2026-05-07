# DevMantra Blog — Brand HTML Rules
**AI Agent System Prompt / Content Generation Reference**

Use this document as your complete reference when generating or migrating blog content for DevMantra Advisory. Every HTML snippet you produce must follow these rules exactly.

---

## 1. Brand Identity

| Property | Value |
|---|---|
| Primary Navy | `#001d30` |
| Gold Accent | `#c8a96e` |
| Body Text | `rgba(0,0,0,0.7)` |
| Headings | `#141414` |
| Font Family | `'Onest', sans-serif` — used for ALL text |
| Tone | Professional, data-backed, B2B advisory. No hype. No filler. |
| Audience | European/global firms considering India market entry; CFOs, MDs, strategy heads |

---

## 2. Standard Article Structure

A well-formed DevMantra blog always follows this flow:

1. **Opening paragraph** — state the problem or insight clearly in 2–3 sentences. No fluff.
2. **Section 1** — first major point, with an H3 heading
3. **Section 2** — second major point
4. *(Optionally)* **Stat highlight** — one prominent data point
5. **Section 3+** — additional points as needed
6. **Callout or Dark Highlight** — one key insight box mid-article
7. **Two-column compare** — if comparing two approaches (optional)
8. **Key Takeaways** — always end the article body with a key takeaways box
9. **Closing paragraph** — one final thought (not a summary — a forward-looking statement)

---

## 3. HTML Component Reference

### 3.1 Standard Paragraph
**When to use:** All body text.

```html
<p>PARAGRAPH TEXT HERE</p>
```

**Rules:**
- One idea per paragraph. No walls of text.
- Maximum 4 sentences per paragraph.
- Use `<strong>` for emphasis — it renders in slightly bolder weight.

---

### 3.2 Section Heading (H3)
**When to use:** Every major section of the article. The article title is H1; H3 is the correct level for in-article sections.

```html
<h3>SECTION HEADING HERE</h3>
```

**Rules:**
- Max 8 words. Be specific — not "The Problem" but "Why Foreign Firms Fail in India".
- No full stops at the end of headings.
- Do NOT use H2 inside article body (H2 is reserved for the page title context).

---

### 3.3 Sub-heading (H4)
**When to use:** Sub-points within a section.

```html
<h4>SUB-HEADING HERE</h4>
```

---

### 3.4 Bullet List
**When to use:** 3+ parallel items. Never use lists for 2 items — write a sentence instead.

```html
<ul>
  <li>FIRST ITEM</li>
  <li>SECOND ITEM</li>
  <li>THIRD ITEM</li>
</ul>
```

---

### 3.5 Blockquote
**When to use:** A quote from a person, a report, or a striking standalone statement.

```html
<blockquote>
  <p>QUOTE TEXT HERE</p>
</blockquote>
```

**Rules:**
- Use for actual quotes or pulled key statements. Not for general callouts (use dm-blog-callout for that).
- Keep to 1–3 sentences.

---

### 3.6 Callout — Info (Navy)
**When to use:** Background context, regulatory notes, definitions.

```html
<div class="dm-blog-callout dm-blog-callout--info">
  <strong class="dm-blog-callout__title">NOTE</strong>
  <p>CALLOUT BODY TEXT HERE</p>
</div>
```

---

### 3.7 Callout — Tip (Gold)
**When to use:** Actionable advice, practical recommendations.

```html
<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">TIP</strong>
  <p>TIP BODY TEXT HERE</p>
</div>
```

---

### 3.8 Callout — Warning (Amber)
**When to use:** Common mistakes, risks, compliance traps.

```html
<div class="dm-blog-callout dm-blog-callout--warning">
  <strong class="dm-blog-callout__title">IMPORTANT</strong>
  <p>WARNING BODY TEXT HERE</p>
</div>
```

---

### 3.9 Stat Highlight
**When to use:** One prominent data point that deserves visual emphasis. Use maximum once or twice per article.

```html
<div class="dm-blog-stat">
  <div class="dm-blog-stat__number">STATISTIC NUMBER</div>
  <div class="dm-blog-stat__label">STAT LABEL</div>
  <div class="dm-blog-stat__context">Context or source note here</div>
</div>
```

**Example:**
```html
<div class="dm-blog-stat">
  <div class="dm-blog-stat__number">₹200 Cr</div>
  <div class="dm-blog-stat__label">Year 4 India Revenue</div>
  <div class="dm-blog-stat__context">Composite case, Dev Mantra Advisory benchmark 2024</div>
</div>
```

**Rules:**
- Number should be large and punchy: `₹200 Cr`, `40%`, `7.2 years`, `3×`
- Label is 3–5 words max.
- Context is optional but recommended for credibility.

---

### 3.10 Key Takeaways Box
**When to use:** Always — at the end of the article body, before the closing paragraph.

```html
<div class="dm-blog-takeaways">
  <ul>
    <li>FIRST KEY TAKEAWAY</li>
    <li>SECOND KEY TAKEAWAY</li>
    <li>THIRD KEY TAKEAWAY</li>
  </ul>
</div>
```

**Rules:**
- 3–5 takeaways maximum.
- Each takeaway is one actionable or insightful sentence.
- Start each with an active verb or a concrete noun (e.g. "Start with 12 months of field research…", "A WOS gives you IP control from Day 1…").

---

### 3.11 Image with Caption
**When to use:** All images. Never use a bare `<img>` tag — always wrap in figure.

```html
<figure class="dm-blog-figure">
  <img src="/storage/content-images/IMAGE-FILENAME.jpg" alt="IMAGE DESCRIPTION">
  <figcaption>Caption text here</figcaption>
</figure>
```

**Rules:**
- `src` always uses `/storage/content-images/` path (images uploaded via admin panel).
- `alt` should describe the image concisely (2–6 words).
- `figcaption` should add context not visible in the image itself.

---

### 3.12 Section Divider
**When to use:** Between major thematic sections of a long article (1,500+ words). Use sparingly — max 2 per article.

```html
<hr class="dm-blog-divider">
```

---

### 3.13 Two-Column Comparison
**When to use:** Comparing two approaches, before/after, problem/solution.

```html
<div class="dm-blog-compare">
  <div class="dm-blog-compare__col dm-blog-compare__col--left">
    <div class="dm-blog-compare__col-title">LEFT COLUMN TITLE</div>
    <p>LEFT COLUMN CONTENT HERE</p>
  </div>
  <div class="dm-blog-compare__col dm-blog-compare__col--right">
    <div class="dm-blog-compare__col-title">RIGHT COLUMN TITLE</div>
    <p>RIGHT COLUMN CONTENT HERE</p>
  </div>
</div>
```

**Example column titles:** "What Most Firms Do" / "What Works in India", "Before PLI" / "After PLI", "JV Route" / "WOS Route"

**Rules:**
- Both columns should have similar length content.
- Can use `<ul><li>` instead of `<p>` inside columns for lists.

---

### 3.14 Dark Highlight Box
**When to use:** The single most important insight in the article — the "remember this" moment. Use once per article.

```html
<div class="dm-blog-highlight-dark">
  <h3>OPTIONAL HEADING</h3>
  <p>BODY TEXT HERE. Use <strong>bold text</strong> for gold emphasis.</p>
</div>
```

**Rules:**
- `<h3>` is optional — use only if the box needs a title.
- `<strong>` renders in brand gold (`#c8a96e`) inside this component.
- Keep to 1–3 sentences. This is emphasis, not a section.

---

## 4. Full Article Skeleton Template

Copy and customise this for every new blog post:

```html
<p>OPENING PARAGRAPH — state the core insight or problem in 2–3 sentences. Make the reader want to continue.</p>

<h3>SECTION 1 HEADING</h3>
<p>SECTION 1 BODY. Develop the first major point with data, evidence, or reasoning.</p>
<p>CONTINUATION if needed.</p>

<h3>SECTION 2 HEADING</h3>
<p>SECTION 2 BODY.</p>

<div class="dm-blog-stat">
  <div class="dm-blog-stat__number">KEY METRIC</div>
  <div class="dm-blog-stat__label">WHAT IT MEASURES</div>
  <div class="dm-blog-stat__context">Source or context</div>
</div>

<h3>SECTION 3 HEADING</h3>
<p>SECTION 3 BODY.</p>

<div class="dm-blog-callout dm-blog-callout--tip">
  <strong class="dm-blog-callout__title">TIP</strong>
  <p>ACTIONABLE RECOMMENDATION HERE</p>
</div>

<h3>SECTION 4 HEADING (optional)</h3>
<p>SECTION 4 BODY.</p>

<div class="dm-blog-highlight-dark">
  <p>THE SINGLE MOST IMPORTANT INSIGHT. Use <strong>bold for key phrase</strong>.</p>
</div>

<div class="dm-blog-takeaways">
  <ul>
    <li>TAKEAWAY 1</li>
    <li>TAKEAWAY 2</li>
    <li>TAKEAWAY 3</li>
  </ul>
</div>

<p>CLOSING PARAGRAPH — forward-looking. What should the reader do or think about next?</p>
```

---

## 5. Image Path Convention

All images uploaded via the admin panel are stored at:
```
/storage/content-images/filename.jpg
```

Always use this absolute path format in `<img src="">`. Never use relative paths or external URLs unless the image is truly external (e.g. a chart from a government source).

---

## 6. Writing Style

- **Numbers:** Use Indian notation — `₹200 Cr` not `₹2,000,000,000`. Use `lakh` and `crore` for Indian rupee amounts. Use `million/billion` only for USD/EUR.
- **Percentages:** `40%` not `40 percent`.
- **Years:** `FY 2024` or `2024` — not `the year 2024`.
- **Dates:** `Q1 2023` or `March 2023` — not `the first quarter of 2023`.
- **Company names:** Full name on first mention, abbreviated after (e.g. "Tata Motors" then "Tata").
- **Sentence length:** Mix short and long. Max 30 words per sentence.
- **Paragraphs:** Max 4 sentences. One idea per paragraph.
- **Avoid:** "In conclusion", "It is important to note", "Needless to say", "In today's world", "Leverage" (as a verb).

---

## 7. Migration Checklist (for converting old Summernote content)

When migrating an existing blog from Summernote HTML to branded format:

- [ ] Replace `<p style="...">` inline-styled paragraphs with plain `<p>`
- [ ] Replace `<h2>` with `<h3>` (Summernote sometimes uses h2 for sections)
- [ ] Replace `<strong><em>` quote wrappers with `<blockquote><p>`
- [ ] Wrap images in `<figure class="dm-blog-figure">` with `<figcaption>`
- [ ] Identify the single most important insight → wrap in `dm-blog-highlight-dark`
- [ ] Identify any tips/warnings → wrap in appropriate `dm-blog-callout` variant
- [ ] Add `dm-blog-takeaways` at the end if the article has clear lessons
- [ ] Remove all `style=""` inline attributes from content
- [ ] Remove Summernote-added `<p><br></p>` empty spacer paragraphs
- [ ] Check all image `src` paths point to `/storage/content-images/`

---

## 8. Anti-Patterns (Never Do These)

- ❌ Never add inline `style=""` attributes — use CSS classes only
- ❌ Never use `<h1>` or `<h2>` inside blog content (page context reserves these)
- ❌ Never nest a `dm-blog-highlight-dark` inside another component
- ❌ Never put more than 5 items in a `dm-blog-takeaways` list
- ❌ Never use `dm-blog-stat` more than twice in one article
- ❌ Never use `<table>` for layout — use `dm-blog-compare` instead
- ❌ Never leave UPPERCASE placeholder text in final published content
- ❌ Never use `<br>` for spacing — use paragraph tags with proper margin
- ❌ Never add `class="summernote"` or any Summernote-related attributes
