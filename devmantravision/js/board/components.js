// ════════════════════════════════════════════════
// BOARD COMPONENT HELPERS
// ════════════════════════════════════════════════

export function card(cfg) {
  const el = document.createElement('div');
  el.className = 'bc paper' + (cfg.cls ? ' ' + cfg.cls : '');
  el.style.cssText = `left:${cfg.x}px;top:${cfg.y}px;width:${cfg.w}px;min-height:${cfg.h}px;${cfg.rot ? 'transform:rotate(' + cfg.rot + 'deg);' : ''}${cfg.extra || ''}`;
  el.innerHTML = cfg.html || '';
  return el;
}

export function W(bg, inner) {
  return `<div style="background:${bg};border-radius:4px;padding:22px 24px;box-shadow:0 2px 8px rgba(0,0,0,0.07),0 1px 2px rgba(0,0,0,0.04);">${inner}</div>`;
}

export function OVL(color) {
  return `<div style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:${color};margin-bottom:10px;">`;
}
