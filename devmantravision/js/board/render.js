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
  document.querySelectorAll('.ltab').forEach(t => t.classList.remove('on'));
  if (tabEl) tabEl.classList.add('on');
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

  // Magazine needs its absolute children wrapped so the area can have a real height
  if (layout === 'magazine') {
    const inner = document.createElement('div');
    inner.className = 'magazine-inner';
    inner.style.cssText = 'position:relative;width:1200px;min-height:980px;';
    while (area.firstChild) { inner.appendChild(area.firstChild); }
    area.style.cssText = 'width:1200px;display:flex;flex-direction:column;gap:0;background:transparent;';
    area.appendChild(inner);
  }

  // Footer lives outside the scroll area
  const footer = createFooter();
  if (footerSlot) footerSlot.appendChild(footer);
  else area.appendChild(footer); // fallback

  // After render, recalculate mobile scale
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

// Responsive scaling for the board canvas
export function applyBoardScale() {
  const area = document.getElementById('board-render-area');
  const container = document.querySelector('.board-area');
  if (!area) return;

  // On narrow viewports the CSS reflows the board into a single column,
  // so we keep the scale at 1 and let the responsive styles take over.
  if (window.innerWidth <= 1024) {
    area.style.setProperty('--board-scale', 1);
    return;
  }

  const boardWidth = 1240; // 1200 + padding
  let available = container ? container.clientWidth : window.innerWidth;
  if (!available) available = window.innerWidth;
  const scale = available < boardWidth ? available / boardWidth : 1;
  area.style.setProperty('--board-scale', scale);
}

window.addEventListener('resize', applyBoardScale);
