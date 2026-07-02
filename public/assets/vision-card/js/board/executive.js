import { state } from '../state.js';
import { W, OVL } from './components.js';

// ── EXECUTIVE LAYOUT ──────────────────────────
// CSS grid columns — content-aware, no absolute positioning, no overflow clipping.
export function renderExecutive(area, imgURL) {
  const ai = state.aiContent;
  const yr = new Date().getFullYear();

  area.style.cssText = 'position:static;width:1200px;display:grid;grid-template-columns:300px 1fr 320px;gap:12px;align-items:stretch;padding:0 0 12px;background:transparent;box-shadow:none;border-radius:0;min-height:unset;overflow:visible;';

  function col(items) {
    const d = document.createElement('div');
    d.style.cssText = 'display:flex;flex-direction:column;gap:12px;';
    items.forEach(h => { const w = document.createElement('div'); w.innerHTML = h; d.appendChild(w.firstElementChild); });
    return d;
  }
  // Stretchy wrapper so last card fills remaining height
  function colStretch(items) {
    const d = document.createElement('div');
    d.style.cssText = 'display:flex;flex-direction:column;gap:12px;';
    items.forEach((h, i) => {
      const w = document.createElement('div');
      w.innerHTML = h;
      const card = w.firstElementChild;
      if (i === items.length - 1) card.style.flex = '1'; // last card stretches
      d.appendChild(card);
    });
    return d;
  }

  // ── LEFT COLUMN ──
  area.appendChild(colStretch([
    W('var(--navy)', `
      <div style="height:3px;background:var(--gold);margin:-22px -24px 18px;border-radius:4px 4px 0 0;"></div>
      ${OVL('rgba(255,255,255,0.72)')}Growth Blueprint · ${yr}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:28px;font-weight:700;color:#fff;line-height:1.06;letter-spacing:-0.02em;margin-bottom:8px;">${state.company || 'Your Company'}</div>
      <div style="font-size:11px;color:rgba(255,255,255,0.3);letter-spacing:0.05em;margin-bottom:14px;">${state.industry || ''} · ${state.city || 'India'}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:13px;font-style:italic;color:rgba(255,255,255,0.92);line-height:1.5;">"${ai.tagline || ''}"</div>
    `),
    W('var(--pale)', `
      ${OVL('var(--gold)')}Strategic Theme</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:25px;font-weight:700;color:var(--navy);line-height:1.1;letter-spacing:-0.02em;">${ai.growthTheme || ''}</div>
    `),
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Core Values</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:7px;">
        ${(ai.values || []).map(v => `<div style="padding:10px 11px;border:1px solid var(--border);border-radius:3px;background:var(--warm);font-size:10px;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:var(--navy);">${v}</div>`).join('')}
      </div>
    `),
    W('var(--charcoal)', `
      ${OVL('rgba(255,255,255,0.68)')}Founder</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:20px;font-weight:700;color:#fff;margin-bottom:4px;">${state.name || 'Founder'}</div>
      <div style="font-size:10px;color:rgba(255,255,255,0.68);margin-bottom:11px;letter-spacing:0.04em;">${Array.isArray(state.focus) ? state.focus.join(' · ') : state.focus || ''}</div>
      <div style="width:22px;height:1px;background:var(--gold);opacity:0.45;margin-bottom:10px;"></div>
      <div style="font-size:11.5px;font-style:italic;color:rgba(255,255,255,0.80);line-height:1.6;">${ai.founderAdvice || ''}</div>
    `),
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Strategic Priorities</div>
      ${(ai.topPriorities || []).map((p, i) => `
      <div style="display:flex;align-items:baseline;gap:10px;padding:9px 0;border-bottom:1px solid var(--border);${i === 0 ? 'border-top:1px solid var(--border);' : ''}">
        <div style="font-family:'Cormorant Garant',serif;font-size:19px;font-weight:700;color:var(--gold);opacity:0.5;flex-shrink:0;min-width:15px;line-height:1;">${i + 1}</div>
        <div style="font-size:12px;font-weight:500;color:var(--charcoal);line-height:1.45;">${p}</div>
      </div>`).join('')}
    `)
  ]));

  // ── MIDDLE COLUMN ──
  area.appendChild(colStretch([
    `<div style="border-radius:4px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.07);height:248px;position:relative;flex-shrink:0;">
      <img src="${imgURL}" alt="" loading="lazy" style="width:100%;height:100%;object-fit:cover;filter:saturate(0.75) brightness(0.62);">
      <div style="position:absolute;inset:0;background:linear-gradient(165deg,rgba(15,31,61,0.08) 0%,rgba(15,31,61,0.93) 84%);"></div>
      <div style="position:absolute;bottom:0;left:0;right:0;padding:22px 26px;">
        <div style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-bottom:7px;">Vision</div>
        <div style="font-family:'Cormorant Garant',serif;font-size:21px;font-weight:600;color:#fff;line-height:1.3;letter-spacing:-0.01em;">${ai.vision || ''}</div>
      </div>
    </div>`,
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Executive Summary</div>
      <div style="font-size:13px;line-height:1.72;color:var(--charcoal);">${ai.executiveSummary || ''}</div>
      <div style="display:flex;gap:5px;flex-wrap:wrap;margin-top:11px;">
        <span style="padding:2px 9px;border:1px solid var(--border2);border-radius:100px;font-size:10px;font-weight:600;color:var(--slate);">${state.revenue}</span>
        <span style="padding:2px 9px;border:1px solid var(--border2);border-radius:100px;font-size:10px;font-weight:600;color:var(--slate);">${state.team} team</span>
        <span style="padding:2px 9px;border:1px solid var(--border2);border-radius:100px;font-size:10px;font-weight:600;color:var(--slate);">${state.years}</span>
      </div>
    `),
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Roadmap</div>
      ${[
      { label: '12 Months', items: ai.y1milestones || [], dot: 'var(--gold)', last: false },
      { label: '3 Years', items: ai.y3milestones || [], dot: 'var(--slate)', last: false },
      { label: '5 Years', items: ai.y5milestones || [], dot: 'var(--navy)', last: true }
    ].map(t => `
      <div style="display:flex;gap:13px;margin-bottom:${t.last ? '0' : '16px'};">
        <div style="display:flex;flex-direction:column;align-items:center;padding-top:3px;">
          <div style="width:7px;height:7px;border-radius:50%;background:${t.dot};flex-shrink:0;"></div>
          ${!t.last ? `<div style="width:1px;flex:1;min-height:20px;background:var(--border);margin-top:3px;"></div>` : ''}
        </div>
        <div style="flex:1;">
          <div style="font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:${t.dot};margin-bottom:5px;">${t.label}</div>
          ${t.items.map(m => `<div style="font-size:12px;font-weight:500;color:var(--charcoal);line-height:1.45;padding-bottom:3px;">${m}</div>`).join('')}
        </div>
      </div>`).join('')}
    `),
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Strategic Intelligence</div>
      <div style="margin-bottom:13px;">
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:6px;">
          <div style="width:16px;height:1.5px;background:var(--gold);flex-shrink:0;"></div>
          <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold);">Greatest Opportunity</div>
        </div>
        <div style="font-size:13px;line-height:1.65;color:var(--charcoal);">${ai.biggestOpportunity || ''}</div>
      </div>
      <div style="padding-top:11px;border-top:1px solid var(--border);">
        <div style="display:flex;align-items:center;gap:6px;margin-bottom:6px;">
          <div style="width:16px;height:1.5px;background:var(--slate);opacity:0.4;flex-shrink:0;"></div>
          <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--slate);">Primary Risk</div>
        </div>
        <div style="font-size:13px;line-height:1.65;color:var(--charcoal);">${ai.keyRisk || ''}</div>
      </div>
    `)
  ]));

  // ── RIGHT COLUMN ──
  const rightCards = [
    W('var(--navy)', `
      <div style="display:flex;gap:11px;align-items:flex-start;">
        <div style="width:3px;background:var(--gold);border-radius:2px;align-self:stretch;flex-shrink:0;min-height:36px;"></div>
        <div>
          ${OVL('rgba(255,255,255,0.72)')}Mission</div>
          <div style="font-family:'Cormorant Garant',serif;font-size:19px;font-style:italic;color:#fff;line-height:1.45;">${ai.mission || ''}</div>
        </div>
      </div>
    `),
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Action Plan</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
        <div>
          <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold);margin-bottom:8px;padding-bottom:5px;border-bottom:2px solid var(--gold);">30 Days</div>
          ${(ai.actions30 || []).map(a => `<div style="display:flex;gap:6px;align-items:flex-start;padding:6px 0;border-bottom:1px solid var(--border);"><div style="width:4px;height:4px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:5px;"></div><div style="font-size:11px;line-height:1.5;color:var(--charcoal);">${a}</div></div>`).join('')}
        </div>
        <div>
          <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--slate);margin-bottom:8px;padding-bottom:5px;border-bottom:2px solid var(--border2);">90 Days</div>
          ${(ai.actions90 || []).map(a => `<div style="display:flex;gap:6px;align-items:flex-start;padding:6px 0;border-bottom:1px solid var(--border);"><div style="width:4px;height:4px;border-radius:50%;background:var(--slate);opacity:0.5;flex-shrink:0;margin-top:5px;"></div><div style="font-size:11px;line-height:1.5;color:var(--charcoal);">${a}</div></div>`).join('')}
        </div>
      </div>
    `),
    W('var(--pale)', `
      ${OVL('var(--gold)')}5-Year Vision</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:17px;font-style:italic;line-height:1.5;color:var(--navy);">"${state.company || 'This business'} will be known for ${state.y5known || 'exceptional results'}."</div>
      ${(state.y5achieve || []).length ? `<div style="display:flex;flex-wrap:wrap;gap:4px;margin-top:10px;">${(state.y5achieve || []).map(a => `<span style="padding:2px 8px;background:rgba(15,31,61,0.08);border-radius:100px;font-size:10px;font-weight:600;color:var(--navy);">${a}</span>`).join('')}</div>` : ''}
    `)
  ];
  if (state.y5headline) {
    rightCards.push(W('var(--charcoal)', `
      ${OVL('rgba(255,255,255,0.68)')}The Headline</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:16px;font-weight:600;font-style:italic;color:var(--gold-lt);line-height:1.38;">"${state.y5headline}"</div>
    `));
  }
  rightCards.push(
    W('var(--white)', `
      ${OVL('rgba(0,0,0,0.28)')}Key Performance Indicators</div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;">
        ${(ai.kpis || []).map(k => `<div style="padding:9px 11px;background:var(--warm);border-radius:3px;border-left:2.5px solid var(--gold);font-size:10.5px;font-weight:600;color:var(--navy);line-height:1.35;">${k}</div>`).join('')}
      </div>
    `),
    W('var(--bone)', `
      <div style="width:22px;height:2px;background:var(--gold);margin-bottom:14px;"></div>
      <div style="font-family:'Cormorant Garant',serif;font-size:17px;font-style:italic;line-height:1.55;color:var(--charcoal);opacity:0.9;">${ai.quote || ''}</div>
      <div style="margin-top:11px;font-size:9px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--slate);opacity:0.45;">— For ${state.name || 'Founder'}</div>
    `)
  );
  area.appendChild(colStretch(rightCards));
}
