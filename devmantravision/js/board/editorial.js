import { state } from '../state.js';

// ── EDITORIAL LAYOUT ──────────────────────────
// Distinct magazine-spread aesthetic: bold hero with a centred pull-quote,
// then a 4-column mosaic below — no resemblance to the executive grid.
export function renderEditorial(area, imgURL) {
  const ai = state.aiContent;
  const yr = new Date().getFullYear();

  area.style.cssText = 'position:static;width:1200px;display:flex;flex-direction:column;gap:12px;padding:0;background:transparent;box-shadow:none;border-radius:0;min-height:unset;overflow:visible;';

  // ── MASTHEAD STRIP ── full width, dark, text-only, no image
  const masthead = document.createElement('div');
  masthead.style.cssText = 'background:var(--navy);border-radius:4px;padding:20px 32px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,0.1);';
  masthead.innerHTML = `
    <div style="display:flex;align-items:baseline;gap:24px;">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.22em;text-transform:uppercase;color:rgba(255,255,255,0.72);">Business Growth Blueprint · ${yr}</div>
      <div style="width:1px;height:12px;background:rgba(255,255,255,0.12);"></div>
      <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold);">${state.industry || ''}</div>
    </div>
    <div style="font-family:'Cormorant Garant',serif;font-size:11px;font-style:italic;color:rgba(255,255,255,0.68);letter-spacing:0.06em;">${state.name || 'Founder'} · ${state.city || 'India'}</div>`;
  area.appendChild(masthead);

  // ── HERO: large image left, giant company name + pull-quote right ──
  const heroRow = document.createElement('div');
  heroRow.style.cssText = 'display:grid;grid-template-columns:560px 1fr;gap:12px;align-items:stretch;';

  // Hero image panel
  const imgPanel = document.createElement('div');
  imgPanel.style.cssText = 'position:relative;border-radius:4px;overflow:hidden;min-height:320px;box-shadow:0 2px 8px rgba(0,0,0,0.1);';
  imgPanel.innerHTML = `
    <img src="${imgURL}" alt="" loading="lazy" style="width:100%;height:100%;object-fit:cover;filter:saturate(0.5) brightness(0.55);position:absolute;inset:0;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(15,31,61,0.2) 0%,rgba(15,31,61,0.88) 100%);"></div>
    <div style="position:absolute;bottom:0;left:0;right:0;padding:28px 32px;">
      <div style="width:36px;height:2px;background:var(--gold);margin-bottom:14px;"></div>
      <div style="font-family:'Cormorant Garant',serif;font-size:48px;font-weight:700;color:#fff;line-height:1.0;letter-spacing:-0.025em;margin-bottom:10px;">${state.company || 'Your Company'}</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:16px;font-style:italic;color:rgba(255,255,255,0.92);">"${ai.tagline || ''}"</div>
    </div>`;
  heroRow.appendChild(imgPanel);

  // Right of hero: theme + mission + vision stacked
  const heroRight = document.createElement('div');
  heroRight.style.cssText = 'display:flex;flex-direction:column;gap:12px;';

  heroRight.innerHTML = `
    <div style="background:var(--gold);background:linear-gradient(135deg,#B8975A,#D4B47A);border-radius:4px;padding:24px 26px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(15,31,61,0.45);margin-bottom:10px;">Strategic Theme</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:32px;font-weight:700;color:var(--navy);line-height:1.05;letter-spacing:-0.025em;">${ai.growthTheme || ''}</div>
    </div>
    <div style="background:var(--navy);border-radius:4px;padding:24px 26px;flex:1;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.72);margin-bottom:12px;">Mission</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:20px;font-style:italic;color:#fff;line-height:1.5;opacity:0.9;margin-bottom:16px;">${ai.mission || ''}</div>
      <div style="border-top:1px solid rgba(255,255,255,0.08);padding-top:14px;">
        <div style="font-size:9px;font-weight:700;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.72);margin-bottom:9px;">Vision</div>
        <div style="font-family:'Cormorant Garant',serif;font-size:16px;color:rgba(255,255,255,0.88);line-height:1.5;">${ai.vision || ''}</div>
      </div>
    </div>`;
  heroRow.appendChild(heroRight);
  area.appendChild(heroRow);

  // ── PULL QUOTE BANNER ── full-width bone strip, large centred italic
  const pullQuote = document.createElement('div');
  pullQuote.style.cssText = 'background:var(--bone);border-radius:4px;border:1px solid var(--border);padding:22px 48px;text-align:center;box-shadow:0 1px 4px rgba(0,0,0,0.04);';
  pullQuote.innerHTML = `
    <div style="font-family:'Cormorant Garant',serif;font-size:24px;font-style:italic;color:var(--charcoal);line-height:1.45;max-width:800px;margin:0 auto;">${ai.quote || ''}</div>
    <div style="margin-top:10px;font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold);">— For ${state.name || 'Founder'}</div>`;
  area.appendChild(pullQuote);

  // ── 4-COLUMN MOSAIC ──
  const mosaic = document.createElement('div');
  mosaic.style.cssText = 'display:grid;grid-template-columns:repeat(4,1fr);gap:12px;align-items:start;';

  // Col 1: Core Values (full column)
  const col1 = document.createElement('div');
  col1.style.cssText = 'display:flex;flex-direction:column;gap:12px;';
  col1.innerHTML = `
    <div style="background:var(--white);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(0,0,0,0.28);margin-bottom:14px;">Core Values</div>
      ${(ai.values || []).map((v, i) => `<div style="padding:12px 0;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:10px;">
        <div style="font-family:'Cormorant Garant',serif;font-size:22px;font-weight:700;color:var(--gold);opacity:0.3;line-height:1;flex-shrink:0;">${i + 1}</div>
        <div style="font-size:13px;font-weight:600;color:var(--navy);">${v}</div>
      </div>`).join('')}
    </div>
    <div style="background:var(--pale);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--gold);margin-bottom:10px;">Greatest Opportunity</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:15px;font-style:italic;line-height:1.6;color:var(--navy);opacity:0.9;">${ai.biggestOpportunity || ''}</div>
    </div>`;
  mosaic.appendChild(col1);

  // Col 2: Executive Summary + 5yr vision
  const col2 = document.createElement('div');
  col2.style.cssText = 'display:flex;flex-direction:column;gap:12px;';
  col2.innerHTML = `
    <div style="background:var(--white);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(0,0,0,0.28);margin-bottom:12px;">Executive Summary</div>
      <div style="font-size:13px;line-height:1.72;color:var(--charcoal);">${ai.executiveSummary || ''}</div>
      <div style="display:flex;gap:5px;flex-wrap:wrap;margin-top:11px;">
        <span style="padding:2px 9px;border:1px solid var(--border2);border-radius:100px;font-size:10px;font-weight:600;color:var(--slate);">${state.revenue}</span>
        <span style="padding:2px 9px;border:1px solid var(--border2);border-radius:100px;font-size:10px;font-weight:600;color:var(--slate);">${state.team} team</span>
        <span style="padding:2px 9px;border:1px solid var(--border2);border-radius:100px;font-size:10px;font-weight:600;color:var(--slate);">${state.years}</span>
      </div>
    </div>
    <div style="background:var(--charcoal);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.68);margin-bottom:12px;">5-Year Vision</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:16px;font-style:italic;color:rgba(255,255,255,0.92);line-height:1.5;margin-bottom:12px;">"${state.company || 'This business'} will be known for ${state.y5known || 'exceptional results'}."</div>
      ${(state.y5achieve || []).length ? `<div style="display:flex;flex-wrap:wrap;gap:4px;">${(state.y5achieve || []).map(a => `<span style="padding:2px 8px;background:rgba(255,255,255,0.08);border-radius:100px;font-size:10px;font-weight:600;color:rgba(255,255,255,0.85);">${a}</span>`).join('')}</div>` : ''}
    </div>
    <div style="background:var(--white);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(0,0,0,0.28);margin-bottom:8px;">Primary Risk</div>
      <div style="font-size:13px;line-height:1.65;color:var(--charcoal);">${ai.keyRisk || ''}</div>
    </div>`;
  mosaic.appendChild(col2);

  // Col 3: Strategic Priorities
  const col3 = document.createElement('div');
  col3.style.cssText = 'display:flex;flex-direction:column;gap:12px;';
  col3.innerHTML = `
    <div style="background:var(--navy);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.72);margin-bottom:14px;">Strategic Priorities</div>
      ${(ai.topPriorities || []).map((p, i) => `
      <div style="display:flex;align-items:baseline;gap:10px;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.07);${i === 0 ? 'border-top:1px solid rgba(255,255,255,0.07);' : ''}">
        <div style="font-family:'Cormorant Garant',serif;font-size:22px;font-weight:700;color:var(--gold);opacity:0.45;flex-shrink:0;min-width:16px;line-height:1;">${i + 1}</div>
        <div style="font-size:12px;font-weight:500;color:rgba(255,255,255,0.8);line-height:1.45;">${p}</div>
      </div>`).join('')}
    </div>
    <div style="background:var(--white);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(0,0,0,0.28);margin-bottom:11px;">Key Metrics</div>
      <div style="display:flex;flex-direction:column;gap:6px;">
        ${(ai.kpis || []).map(k => `<div style="padding:9px 12px;background:var(--warm);border-radius:3px;border-left:2.5px solid var(--gold);font-size:11px;font-weight:600;color:var(--navy);line-height:1.35;">${k}</div>`).join('')}
      </div>
    </div>`;
  mosaic.appendChild(col3);

  // Col 4: Roadmap + Actions
  const col4 = document.createElement('div');
  col4.style.cssText = 'display:flex;flex-direction:column;gap:12px;';

  // Roadmap — vertical timeline style
  const roadmapHTML = `
    <div style="background:var(--white);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(0,0,0,0.28);margin-bottom:16px;">Roadmap</div>
      ${[
      { label: '12 Months', items: ai.y1milestones || [], dot: 'var(--gold)', last: false },
      { label: '3 Years', items: ai.y3milestones || [], dot: 'var(--slate)', last: false },
      { label: '5 Years', items: ai.y5milestones || [], dot: 'var(--navy)', last: true }
    ].map(t => `
      <div style="display:flex;gap:12px;margin-bottom:${t.last ? '0' : '14px'};">
        <div style="display:flex;flex-direction:column;align-items:center;padding-top:3px;">
          <div style="width:7px;height:7px;border-radius:50%;background:${t.dot};flex-shrink:0;"></div>
          ${!t.last ? `<div style="width:1px;flex:1;min-height:16px;background:var(--border);margin-top:3px;"></div>` : ''}
        </div>
        <div style="flex:1;">
          <div style="font-size:9px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:${t.dot};margin-bottom:4px;">${t.label}</div>
          ${t.items.map(m => `<div style="font-size:11px;font-weight:500;color:var(--charcoal);line-height:1.4;padding-bottom:3px;">${m}</div>`).join('')}
        </div>
      </div>`).join('')}
    </div>`;

  const actionsHTML = `
    <div style="background:var(--warm);border-radius:4px;padding:22px 24px;border:1px solid var(--border);box-shadow:0 1px 4px rgba(0,0,0,0.04);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(0,0,0,0.28);margin-bottom:14px;">Action Plan</div>
      <div style="margin-bottom:14px;">
        <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold);margin-bottom:8px;padding-bottom:4px;border-bottom:2px solid var(--gold);">30 Days</div>
        ${(ai.actions30 || []).map(a => `<div style="display:flex;gap:6px;align-items:flex-start;padding:5px 0;border-bottom:1px solid var(--border);"><div style="width:4px;height:4px;border-radius:50%;background:var(--gold);flex-shrink:0;margin-top:5px;"></div><div style="font-size:11px;line-height:1.45;color:var(--charcoal);">${a}</div></div>`).join('')}
      </div>
      <div>
        <div style="font-size:9px;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--slate);margin-bottom:8px;padding-bottom:4px;border-bottom:2px solid var(--border2);">90 Days</div>
        ${(ai.actions90 || []).map(a => `<div style="display:flex;gap:6px;align-items:flex-start;padding:5px 0;border-bottom:1px solid var(--border);"><div style="width:4px;height:4px;border-radius:50%;background:var(--slate);opacity:0.5;flex-shrink:0;margin-top:5px;"></div><div style="font-size:11px;line-height:1.45;color:var(--charcoal);">${a}</div></div>`).join('')}
      </div>
    </div>`;

  const founderHTML = `
    <div style="background:var(--charcoal);border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07);">
      <div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:rgba(255,255,255,0.68);margin-bottom:10px;">Founder</div>
      <div style="font-family:'Cormorant Garant',serif;font-size:20px;font-weight:700;color:#fff;margin-bottom:4px;">${state.name || 'Founder'}</div>
      <div style="font-size:10px;color:rgba(255,255,255,0.68);margin-bottom:11px;">${Array.isArray(state.founder) ? state.founder.join(', ') : state.founder || ''}</div>
      <div style="font-size:11.5px;font-style:italic;color:rgba(255,255,255,0.80);line-height:1.6;">${ai.founderAdvice || ''}</div>
    </div>`;

  col4.innerHTML = roadmapHTML + actionsHTML + founderHTML;
  mosaic.appendChild(col4);
  area.appendChild(mosaic);
}
