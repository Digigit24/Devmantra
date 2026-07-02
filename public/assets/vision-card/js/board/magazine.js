import { state } from '../state.js';
import { card } from './components.js';

// ── COMPACT LANDSCAPE MAGAZINE (for PDF export) ───────────────────────────
// Spreads the same content across 4 columns so the board is shorter and
// fills more of an A4 landscape page.
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

// ── MAGAZINE LAYOUT ───────────────────────────
export function renderMagazine(area, imgURL) {
  const ai = state.aiContent;
  area.style.minHeight = '980px';
  area.style.width = '1200px';

  // Full-width hero bar
  const hero = document.createElement('div');
  hero.className = 'bc paper';
  hero.style.cssText = 'position:absolute;left:0;top:0;width:1200px;height:300px;padding:0;overflow:hidden;';
  hero.innerHTML = `
    <div class="bc-img-wrap"><img src="${imgURL}" alt="" loading="lazy" style="filter:saturate(0.7) brightness(0.65);"><div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(15,31,61,0.97) 0%,rgba(15,31,61,0.6) 50%,rgba(15,31,61,0.2) 100%);"></div></div>
    <div style="position:absolute;top:0;left:0;bottom:0;width:600px;padding:40px 48px;display:flex;flex-direction:column;justify-content:center;">
      <div style="font-size:10px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);margin-bottom:14px;">Business Growth Blueprint · ${state.industry || ''} · ${new Date().getFullYear()}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:54px;font-weight:700;color:#fff;line-height:1.0;letter-spacing:-0.025em;">${state.company || 'Your Company'}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:20px;font-style:italic;color:rgba(255,255,255,0.85);margin-top:10px;">"${ai.tagline || ''}"</div>
    </div>
    <div style="position:absolute;right:48px;bottom:40px;">
      <div style="font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.72);margin-bottom:8px;">Strategic Theme</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:32px;font-weight:700;color:var(--gold-lt);">${ai.growthTheme || ''}</div>
    </div>
  `;
  area.appendChild(hero);

  // Three columns below hero
  // Col A: 0–360
  area.appendChild(card({ x: 0, y: 316, w: 360, h: 160, html: `
    <span class="bt-overline">Mission</span>
    <div class="bt-quote" style="font-size:17px;">${ai.mission || ''}</div>
  ` }));

  area.appendChild(card({ x: 0, y: 488, w: 360, h: 200, cls: 'bc-pale', html: `
    <span class="bt-overline">12-Month Priority</span>
    <div class="bt-h3" style="color:var(--navy);margin-bottom:10px;">${state.y1goal || 'Growth'}</div>
    ${(ai.y1milestones || []).map(m => `<div style="font-size:13px;padding:6px 0;border-bottom:1px solid rgba(0,0,0,0.06);">${m}</div>`).join('')}
  ` }));

  area.appendChild(card({ x: 0, y: 700, w: 360, h: 120, cls: 'bc-charcoal', html: `
    <span class="bt-overline" style="color:rgba(255,255,255,0.72)">Founder</span>
    <div class="bt-h3" style="color:#fff;">${state.name || 'Founder'}</div>
    <div style="font-size:12px;color:rgba(255,255,255,0.78);margin-top:4px;">${Array.isArray(state.founder) ? state.founder.join(', ') : state.founder} · ${Array.isArray(state.focus) ? state.focus.join(' · ') : state.focus}</div>
  ` }));

  area.appendChild(card({ x: 0, y: 832, w: 360, h: 110, html: `
    <span class="bt-overline">30-Day Start</span>
    ${(ai.actions30 || []).slice(0, 2).map(a => `<div style="font-size:13px;padding:5px 0;border-bottom:1px solid var(--border);">${a}</div>`).join('')}
  ` }));

  // Col B: 372–768
  area.appendChild(card({ x: 372, y: 316, w: 396, h: 130, cls: 'bc-navy', html: `
    <span class="bt-overline" style="color:rgba(255,255,255,0.72)">Vision</span>
    <div class="bt-quote" style="color:#fff;font-size:17px;">${ai.vision || ''}</div>
  ` }));

  area.appendChild(card({ x: 372, y: 458, w: 396, h: 240, html: `
    <span class="bt-overline">Strategic Priorities</span>
    <div class="bt-plist">
      ${(ai.topPriorities || []).map((p, i) => `<div class="bt-plist-item"><div class="bt-plist-n">${i + 1}</div><div class="bt-plist-txt">${p}</div></div>`).join('')}
    </div>
  ` }));

  area.appendChild(card({ x: 372, y: 710, w: 396, h: 110, cls: 'bc-gold', html: `
    <span class="bt-overline" style="color:rgba(15,31,61,0.45)">5-Year Vision</span>
    <div style="font-family:'Cormorant Garant',serif;font-size:16px;font-style:italic;color:var(--navy);line-height:1.5;">"${state.company || 'Our business'} will be known for ${state.y5known || 'excellence'}."</div>
  ` }));

  area.appendChild(card({ x: 372, y: 832, w: 396, h: 110, html: `
    <span class="bt-overline">Core Values</span>
    <div style="display:flex;flex-wrap:wrap;gap:8px;">
      ${(ai.values || []).map(v => `<span class="bt-tag" style="background:var(--bone);border:1px solid var(--border);color:var(--navy);font-size:11px;font-weight:700;">${v}</span>`).join('')}
    </div>
  ` }));

  // Col C: 780–1200
  area.appendChild(card({ x: 780, y: 316, w: 408, h: 200, html: `
    <span class="bt-overline">Roadmap to the Future</span>
    <div class="bt-tl">
      <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div><div class="bt-tl-line"></div></div><div><div class="bt-tl-yr">Year 1</div>${(ai.y1milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:3px;">${m}</div>`).join('')}</div></div>
      <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div><div class="bt-tl-line"></div></div><div><div class="bt-tl-yr">Year 3</div>${(ai.y3milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:3px;">${m}</div>`).join('')}</div></div>
      <div class="bt-tl-item"><div class="bt-tl-spine"><div class="bt-tl-dot"></div></div><div><div class="bt-tl-yr">Year 5</div>${(ai.y5milestones || []).map(m => `<div class="bt-tl-txt" style="margin-bottom:3px;">${m}</div>`).join('')}</div></div>
    </div>
  ` }));

  area.appendChild(card({ x: 780, y: 528, w: 408, h: 130, cls: 'bc-bone', html: `
    <div style="width:24px;height:2px;background:var(--gold);margin-bottom:14px;"></div>
    <div class="bt-quote" style="font-size:18px;">${ai.quote || ''}</div>
  ` }));

  area.appendChild(card({ x: 780, y: 670, w: 408, h: 140, html: `
    <span class="bt-overline">Key Metrics</span>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;">
      ${(ai.kpis || []).map(k => `<div style="padding:8px 10px;background:var(--warm);border-radius:3px;font-size:11px;font-weight:600;color:var(--navy);">${k}</div>`).join('')}
    </div>
  ` }));

  area.appendChild(card({ x: 780, y: 822, w: 408, h: 120, html: `
    <span class="bt-overline">Strategic Intelligence</span>
    <div class="bt-body" style="font-size:13px;opacity:1;">${ai.biggestOpportunity || ''}</div>
  ` }));

  // Compute true bottom from rendered card heights to prevent footer overlap
  requestAnimationFrame(() => {
    let maxBottom = 0;
    area.querySelectorAll('.bc').forEach(c => {
      const top = parseInt(c.style.top || 0);
      const h = c.getBoundingClientRect().height;
      if (top + h > maxBottom) maxBottom = top + h;
    });
    const needed = maxBottom + 20; // 20px safety gap
    area.style.minHeight = needed + 'px';
    const inner = area.querySelector('.magazine-inner');
    if (inner) inner.style.minHeight = needed + 'px';
  });
}
