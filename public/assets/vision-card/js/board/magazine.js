import { state } from '../state.js';
import { card } from './components.js';

// ── COMPACT LANDSCAPE MAGAZINE (for PDF export) ───────────────────────────
// UNCHANGED — this renderer is intentionally kept separate from the live
// view (see renderMagazine below). It already uses CSS Grid with no
// absolute positioning, so it is not affected by the live-layout rework.
export function renderCompactMagazine(area, imgURL) {
  const ai = state.aiContent;
  area.style.cssText = 'width:1200px;min-height:680px;position:relative;';
  area.classList.add('compact-magazine');

  const yr = new Date().getFullYear();

  // Hero
  const hero = document.createElement('div');
  hero.className = 'cm-hero';
  hero.innerHTML = `
    <div class="cm-hero-img"><img src="${imgURL}" alt="" loading="lazy"><div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(15,31,61,0.97) 0%,rgba(15,31,61,0.6) 50%,rgba(15,31,61,0.2) 100%);"></div></div>
    <div class="cm-hero-left">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--gold);margin-bottom:8px;">Business Growth Blueprint · ${state.industry || ''} · ${yr}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:38px;font-weight:700;color:#fff;line-height:1.0;letter-spacing:-0.025em;">${state.company || 'Your Company'}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:16px;font-style:italic;color:rgba(255,255,255,0.85);margin-top:6px;">"${ai.tagline || ''}"</div>
    </div>
    <div class="cm-hero-right">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.72);margin-bottom:4px;">Strategic Theme</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:22px;font-weight:700;color:var(--gold-lt);">${ai.growthTheme || ''}</div>
    </div>`;
  area.appendChild(hero);

  const cmCard = (cls, title, body) => {
    const el = document.createElement('div');
    el.className = 'cm-card' + (cls ? ' ' + cls : '');
    el.innerHTML = `<span class="bt-overline">${title}</span>${body}`;
    return el;
  };

  // Column 1
  area.appendChild(cmCard('', 'Mission', `<div class="bt-quote" style="font-size:14px;">${ai.mission || ''}</div>`));
  area.appendChild(cmCard('bc-charcoal', 'Founder', `
    <div class="bt-h3" style="color:#fff;">${state.name || 'Founder'}</div>
    <div style="font-size:10px;color:rgba(255,255,255,0.78);margin-top:3px;">${Array.isArray(state.founder) ? state.founder.join(', ') : state.founder} · ${Array.isArray(state.focus) ? state.focus.join(' · ') : state.focus}</div>
  `));
  area.appendChild(cmCard('', '30-Day Start', `${(ai.actions30 || []).slice(0, 2).map(a => `<div style="font-size:11px;padding:4px 0;border-bottom:1px solid var(--border);">${a}</div>`).join('')}`));

  // Column 2
  area.appendChild(cmCard('bc-pale', '12-Month Priority', `
    <div class="bt-h3" style="color:var(--navy);margin-bottom:6px;">${state.y1goal || 'Growth'}</div>
    ${(ai.y1milestones || []).map(m => `<div style="font-size:11px;padding:4px 0;border-bottom:1px solid rgba(0,0,0,0.06);">${m}</div>`).join('')}
  `));
  area.appendChild(cmCard('', 'Core Values', `<div style="display:flex;flex-wrap:wrap;gap:6px;">${(ai.values || []).map(v => `<span class="bt-tag" style="background:var(--bone);border:1px solid var(--border);color:var(--navy);font-size:9px;font-weight:700;">${v}</span>`).join('')}</div>`));

  // Column 3
  area.appendChild(cmCard('bc-navy', 'Vision', `<div class="bt-quote" style="color:#fff;font-size:14px;">${ai.vision || ''}</div>`));
  area.appendChild(cmCard('bc-gold', '5-Year Vision', `<div style="font-family:'Cormorant Garant',serif;font-size:13px;font-style:italic;color:var(--navy);line-height:1.45;">"${state.company || 'Our business'} will be known for ${state.y5known || 'excellence'}."</div>`));
  area.appendChild(cmCard('', 'Key Metrics', `<div style="display:grid;grid-template-columns:1fr 1fr;gap:5px;">${(ai.kpis || []).map(k => `<div style="padding:6px 8px;background:var(--warm);border-radius:3px;font-size:9px;font-weight:600;color:var(--navy);">${k}</div>`).join('')}</div>`));

  // Column 4
  area.appendChild(cmCard('', 'Strategic Priorities', `<div class="bt-plist">${(ai.topPriorities || []).map((p, i) => `<div class="bt-plist-item"><div class="bt-plist-n">${i + 1}</div><div class="bt-plist-txt">${p}</div></div>`).join('')}</div>`));
  area.appendChild(cmCard('bc-bone', 'Quote', `<div style="width:18px;height:2px;background:var(--gold);margin-bottom:10px;"></div><div class="bt-quote" style="font-size:15px;">${ai.quote || ''}</div>`));
  area.appendChild(cmCard('', 'Strategic Intelligence', `<div class="bt-body" style="font-size:12px;opacity:1;">${ai.biggestOpportunity || ''}</div>`));

  // Roadmap spans two rows in column 4 if possible, or just placed as a tall card
  // We place it in column 4 as the last card
  area.appendChild(cmCard('', 'Roadmap to the Future', `
    <div class="bt-tl">
      <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div><div class="bt-tl-line"></div></div><div><div class="bt-tl-yr">Year 1</div>${(ai.y1milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:2px;">${m}</div>`).join('')}</div></div>
      <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div><div class="bt-tl-line"></div></div><div><div class="bt-tl-yr">Year 3</div>${(ai.y3milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:2px;">${m}</div>`).join('')}</div></div>
      <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div></div><div><div class="bt-tl-yr">Year 5</div>${(ai.y5milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:2px;">${m}</div>`).join('')}</div></div>
    </div>
  `));
}

// ── MAGAZINE LAYOUT (live) ─────────────────────
// Normal-flow CSS Grid at every viewport width — no absolute positioning,
// no pixel x/y coordinates, no JS height/footer calculation. The hero and
// three content columns are ordinary flow children, so the board's own
// height (and the footer position below it) fall out of normal layout
// automatically, and cards below a taller neighbour move down on their own.
//
// Cards keep the same visual grouping as before (column A/B/C) so the
// desktop/tablet composition matches the original design; at mobile the
// column groups collapse via CSS `display:contents` (see styles.css) so
// each card can be placed independently in the requested reading order
// through `data-board-card` + `order`, without duplicating any markup.
export function renderMagazine(area, imgURL) {
  const ai = state.aiContent;
  area.style.cssText = 'width:100%;max-width:1200px;';

  // ── Hero — image is an absolutely-positioned decorative background
  // layer; the caption sits in normal flow so it can never be clipped and
  // simply grows the hero (and pushes everything below it down) if the
  // dynamic tagline/theme text is unusually long.
  const hero = card({
    cardId: 'business-identity',
    role: 'hero',
    cls: 'bc-hero',
    extra: 'position:relative;min-height:300px;padding:0;display:flex;flex-direction:column;justify-content:center;',
    html: `
    <div class="bc-img-wrap" style="position:absolute;inset:0;overflow:hidden;"><img src="${imgURL}" alt="" loading="lazy" style="width:100%;height:100%;object-fit:cover;filter:saturate(0.7) brightness(0.65);"><div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(15,31,61,0.97) 0%,rgba(15,31,61,0.6) 50%,rgba(15,31,61,0.2) 100%);"></div></div>
    <div class="bc-hero-inner" style="position:relative;display:flex;flex-wrap:wrap;gap:24px;align-items:center;justify-content:space-between;padding:40px 48px;">
      <div style="min-width:0;flex:1 1 360px;">
        <div style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:14px;">Business Growth Blueprint · ${state.industry || ''} · ${new Date().getFullYear()}</div>
        <div style="font-family:'Cormorant Garant',serif;font-size:clamp(30px,4vw,54px);font-weight:700;color:#fff;line-height:1.05;letter-spacing:-0.025em;overflow-wrap:anywhere;">${state.company || 'Your Company'}</div>
        <div style="font-family:'Cormorant Garant',serif;font-size:20px;font-style:italic;color:rgba(255,255,255,0.85);margin-top:10px;">"${ai.tagline || ''}"</div>
      </div>
      <div style="min-width:0;flex:0 1 280px;text-align:right;">
        <div style="font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.72);margin-bottom:8px;">Strategic Theme</div>
        <div style="font-family:'Cormorant Garant',serif;font-size:28px;font-weight:700;color:var(--gold-lt);">${ai.growthTheme || ''}</div>
      </div>
    </div>`
  });
  area.appendChild(hero);

  function magColumn(items, role) {
    const d = document.createElement('div');
    d.className = 'magazine-column magazine-column--' + role;
    d.dataset.boardColumn = role;
    d.style.cssText = 'display:flex;flex-direction:column;gap:12px;min-width:0;';
    items.forEach(el => d.appendChild(el));
    return d;
  }

  // ── Column A ──
  area.appendChild(magColumn([
    card({ cardId: 'mission', html: `
      <span class="bt-overline">Mission</span>
      <div class="bt-quote" style="font-size:17px;">${ai.mission || ''}</div>
    ` }),
    card({ cardId: 'year-one-priority', cls: 'bc-pale', html: `
      <span class="bt-overline">12-Month Priority</span>
      <div class="bt-h3" style="color:var(--navy);margin-bottom:10px;">${state.y1goal || 'Growth'}</div>
      ${(ai.y1milestones || []).map(m => `<div style="font-size:13px;padding:6px 0;border-bottom:1px solid rgba(0,0,0,0.06);">${m}</div>`).join('')}
    ` }),
    card({ cardId: 'founder', cls: 'bc-charcoal', html: `
      <span class="bt-overline" style="color:rgba(255,255,255,0.72)">Founder</span>
      <div class="bt-h3" style="color:#fff;overflow-wrap:anywhere;">${state.name || 'Founder'}</div>
      <div style="font-size:12px;color:rgba(255,255,255,0.78);margin-top:4px;">${Array.isArray(state.founder) ? state.founder.join(', ') : state.founder} · ${Array.isArray(state.focus) ? state.focus.join(' · ') : state.focus}</div>
    ` }),
    card({ cardId: 'action-plan', html: `
      <span class="bt-overline">30-Day Start</span>
      ${(ai.actions30 || []).slice(0, 2).map(a => `<div style="font-size:13px;padding:5px 0;border-bottom:1px solid var(--border);">${a}</div>`).join('')}
    ` })
  ], 'a'));

  // ── Column B ──
  area.appendChild(magColumn([
    card({ cardId: 'vision', cls: 'bc-navy', html: `
      <span class="bt-overline" style="color:rgba(255,255,255,0.72)">Vision</span>
      <div class="bt-quote" style="color:#fff;font-size:17px;">${ai.vision || ''}</div>
    ` }),
    card({ cardId: 'strategic-priorities', html: `
      <span class="bt-overline">Strategic Priorities</span>
      <div class="bt-plist">
        ${(ai.topPriorities || []).map((p, i) => `<div class="bt-plist-item"><div class="bt-plist-n">${i + 1}</div><div class="bt-plist-txt">${p}</div></div>`).join('')}
      </div>
    ` }),
    card({ cardId: 'five-year-vision', cls: 'bc-gold', html: `
      <span class="bt-overline" style="color:rgba(15,31,61,0.45)">5-Year Vision</span>
      <div style="font-family:'Cormorant Garant',serif;font-size:16px;font-style:italic;color:var(--navy);line-height:1.5;">"${state.company || 'Our business'} will be known for ${state.y5known || 'excellence'}."</div>
    ` }),
    card({ cardId: 'core-values', html: `
      <span class="bt-overline">Core Values</span>
      <div style="display:flex;flex-wrap:wrap;gap:8px;">
        ${(ai.values || []).map(v => `<span class="bt-tag" style="background:var(--bone);border:1px solid var(--border);color:var(--navy);font-size:11px;font-weight:700;">${v}</span>`).join('')}
      </div>
    ` })
  ], 'b'));

  // ── Column C ──
  area.appendChild(magColumn([
    card({ cardId: 'roadmap', extra: 'flex:1;', html: `
      <span class="bt-overline">Roadmap to the Future</span>
      <div class="bt-tl">
        <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div><div class="bt-tl-line"></div></div><div><div class="bt-tl-yr">Year 1</div>${(ai.y1milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:3px;">${m}</div>`).join('')}</div></div>
        <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div><div class="bt-tl-line"></div></div><div><div class="bt-tl-yr">Year 3</div>${(ai.y3milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:3px;">${m}</div>`).join('')}</div></div>
        <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div></div><div><div class="bt-tl-yr">Year 5</div>${(ai.y5milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:3px;">${m}</div>`).join('')}</div></div>
      </div>
    ` }),
    card({ cardId: 'closing-insight', cls: 'bc-bone', html: `
      <div style="width:24px;height:2px;background:var(--gold);margin-bottom:14px;"></div>
      <div class="bt-quote" style="font-size:18px;">${ai.quote || ''}</div>
    ` }),
    card({ cardId: 'kpis', html: `
      <span class="bt-overline">Key Metrics</span>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;">
        ${(ai.kpis || []).map(k => `<div style="padding:8px 10px;background:var(--warm);border-radius:3px;font-size:11px;font-weight:600;color:var(--navy);">${k}</div>`).join('')}
      </div>
    ` }),
    card({ cardId: 'strategic-intelligence', html: `
      <span class="bt-overline">Strategic Intelligence</span>
      <div class="bt-body" style="font-size:13px;opacity:1;">${ai.biggestOpportunity || ''}</div>
    ` })
  ], 'c'));

  // No JS height/footer calculation: every card above is a normal-flow
  // element, so the board's height (and the footer docked below it in
  // render.js) is produced entirely by ordinary document flow.
}
