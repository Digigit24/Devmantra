// ════════════════════════════════════════════════
// BOARD COMPONENT HELPERS
// ════════════════════════════════════════════════

// `card()` builds a single Magazine board card.
//
// Live rendering no longer positions cards with pixel coordinates — cards
// are placed by normal-flow CSS Grid via the `.bc` base class plus the
// semantic `data-board-card` / `data-board-role` hooks set below.
// `cfg.x/y/w/h/rot` are accepted for backward compatibility only and are no
// longer applied as inline positioning; any future/legacy caller that omits
// the new semantic config still works without throwing.
export function card(cfg) {
  const el = document.createElement('div');
  el.className = 'bc paper' + (cfg.cls ? ' ' + cfg.cls : '');
  if (cfg.cardId) el.dataset.boardCard = cfg.cardId;
  if (cfg.role) el.dataset.boardRole = cfg.role;
  el.style.cssText = cfg.extra || '';
  el.innerHTML = cfg.html || '';
  return el;
}

// `W()` builds an Executive-style card wrapper string. `cardId` is optional
// and, when provided, is rendered as a `data-board-card` attribute on the
// root element so the desktop/tablet grid and the mobile reading order can
// target the card semantically instead of relying on its position among
// siblings. Existing calls that omit `cardId` continue to work unchanged.
export function W(bg, inner, cardId) {
  const attr = cardId ? ` data-board-card="${cardId}"` : '';
  return `<div${attr} style="background:${bg};border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07),0 1px 2px rgba(0,0,0,0.04);">${inner}</div>`;
}

export function OVL(color) {
  return `<div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:${color};margin-bottom:10px;">`;
}
