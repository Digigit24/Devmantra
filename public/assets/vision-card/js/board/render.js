// ════════════════════════════════════════════════
// BOARD RENDERING ORCHESTRATOR
// ════════════════════════════════════════════════
import { state } from '../state.js';
import { renderExecutive } from './executive.js';
import { renderEditorial } from './editorial.js';
import { renderMagazine, renderCompactMagazine } from './magazine.js';
import { getIndustryImage } from './image.js';
import { createFooter } from './footer.js';

export let currentLayout = 'executive';

export function setLayout(l, tabEl) {
  document.querySelectorAll('.ltab').forEach(t => {
    t.classList.remove('on');
    t.setAttribute('aria-selected', 'false');
  });
  if (tabEl) {
    tabEl.classList.add('on');
    tabEl.setAttribute('aria-selected', 'true');
  }
  currentLayout = l;
  renderBoard(l);
}

export function renderBoard(layout) {
  const area = document.getElementById('board-render-area');
  const footerSlot = document.getElementById('board-footer');
  if (!area) return;

  area.className = 'bl-' + layout;
  area.innerHTML = '';
  if (footerSlot) footerSlot.innerHTML = '';

  // Reset inline styles set by previous layout
  area.style.cssText = '';

  const imgURL = getIndustryImage();

  if (layout === 'executive') renderExecutive(area, imgURL);
  else if (layout === 'pinterest') renderEditorial(area, imgURL);
  else renderMagazine(area, imgURL);

  // Magazine's hero + three columns are wrapped in `.magazine-inner` purely
  // to preserve the existing `.bl-magazine .magazine-inner` CSS hook — the
  // wrapper carries no positioning of its own; the live layout is normal
  // document flow (CSS Grid), so no explicit width/height is set here.
  if (layout === 'magazine') {
    const inner = document.createElement('div');
    inner.className = 'magazine-inner';
    while (area.firstChild) { inner.appendChild(area.firstChild); }
    area.appendChild(inner);
  }

  // Footer lives outside the scroll area
  const footer = createFooter();
  if (footerSlot) footerSlot.appendChild(footer);
  else area.appendChild(footer); // fallback

  // Kept for API compatibility — no longer performs transform-based scaling
  // (see function below), but still safe/cheap to call after every render.
  applyBoardScale();
}

// Render a compact, horizontally-spread version for PDF export.
export function renderCompactBoard(layout, container) {
  if (!container) return;
  container.className = 'bl-' + layout + ' compact-export';
  container.innerHTML = '';
  container.style.cssText = '';

  const imgURL = getIndustryImage();

  if (layout === 'magazine') {
    renderCompactMagazine(container, imgURL);
  } else if (layout === 'pinterest') {
    // Editorial: use existing renderer but mark compact for CSS
    renderEditorial(container, imgURL);
  } else {
    // Executive: use existing renderer but mark compact for CSS
    renderExecutive(container, imgURL);
  }
}

// Compatibility shim. The live board used to be shrunk with a CSS
// `transform: scale()` between ~1024–1240px so a fixed 1200px canvas would
// still fit. That is no longer the responsive mechanism: `#board-render-area`
// now uses `width: min(100%, 1200px)` (see styles.css) and CSS Grid handles
// tablet/mobile reflow directly, so there is nothing left to scale.
//
// The function name and its call sites (here, and the `resize` listener
// below) are kept unchanged in case anything else imports/calls it — it now
// simply guarantees no leftover transform/scale ever lingers on the board.
export function applyBoardScale() {
  const area = document.getElementById('board-render-area');
  if (!area) return;
  area.style.removeProperty('--board-scale');
  area.style.transform = 'none';
}

window.addEventListener('resize', applyBoardScale);
