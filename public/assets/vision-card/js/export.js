// ════════════════════════════════════════════════
// PDF EXPORT
// ════════════════════════════════════════════════
import { state } from './state.js';
import { DM_LOGO_B64 } from './board/logo.js';
import { currentLayout, renderCompactBoard } from './board/render.js';

export async function exportBoard() {
  const overlay = document.getElementById('export-overlay');
  if (overlay) overlay.classList.add('show');

  if (!document.getElementById('board-render-area')) {
    if (overlay) overlay.classList.remove('show');
    return;
  }

  // Determine the active layout from the selected tab (fall back to currentLayout)
  let layout = currentLayout;
  const activeTab = document.querySelector('.ltab.on');
  if (activeTab) {
    const label = activeTab.textContent.trim().toLowerCase();
    if (label.includes('magazine')) layout = 'magazine';
    else if (label.includes('executive')) layout = 'executive';
  }

  // Build a compact capture wrapper sized for a single A4 landscape sheet
  const wrapper = document.createElement('div');
  wrapper.id = 'pdf-capture-wrapper';
  wrapper.style.cssText = 'position:absolute;left:-9999px;top:0;width:1240px;background:#EDEDEB;padding:0;';

  // Compact header bar (no buttons, single line)
  const header = document.createElement('div');
  header.style.cssText = 'width:1240px;height:32px;background:var(--navy);box-sizing:border-box;padding:0 24px;display:flex;align-items:center;justify-content:space-between;';
  header.innerHTML = `
    <div style="display:flex;align-items:center;gap:12px;">
      <span style="font-size:9px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--gold);">Business Growth Blueprint</span>
      <span style="font-size:9px;color:rgba(255,255,255,0.4);">|</span>
      <span style="font-family:'Cormorant Garant',serif;font-size:14px;font-weight:600;color:#fff;letter-spacing:-0.01em;">${state.company || 'Your Company'}</span>
    </div>
    <div style="display:flex;align-items:center;gap:12px;">
      <span style="font-size:9px;color:rgba(255,255,255,0.72);">${state.name || 'Founder'} · ${new Date().getFullYear()}</span>
      <img src="${DM_LOGO_B64}" alt="" style="height:16px;width:auto;opacity:0.9;">
    </div>`;
  wrapper.appendChild(header);

  // Render a fresh compact, horizontally-spread board for the PDF
  const boardClone = document.createElement('div');
  boardClone.id = 'board-render-area-export';
  try {
    renderCompactBoard(layout, boardClone);
  } catch (renderErr) {
    console.error('PDF render failed for layout:', layout, renderErr);
    throw new Error('Board render failed: ' + (renderErr && renderErr.message ? renderErr.message : renderErr));
  }
  boardClone.style.transform = 'none';
  boardClone.style.margin = '0';
  boardClone.style.boxSizing = 'border-box';
  boardClone.style.width = '1200px';
  boardClone.style.padding = '8px';
  boardClone.style.background = '#fff';
  boardClone.style.maxWidth = 'none';
  wrapper.appendChild(boardClone);

  // Compact footer
  const f = document.createElement('div');
  f.className = 'board-footer compact-export';
  f.style.cssText = 'width:1200px;margin:0;padding:8px 24px;background:var(--navy);border-radius:0;display:flex;align-items:center;justify-content:space-between;box-sizing:border-box;';
  f.innerHTML = `
    <div class="bf-left">Business Growth Blueprint</div>
    <div class="bf-center">${state.company || 'Your Company'} · ${state.name || 'Founder'} · ${new Date().getFullYear()}</div>
    <div class="bf-right"><span>Growth Partner</span><img src="${DM_LOGO_B64}" alt="Growth Partner" style="height:14px;"></div>`;
  wrapper.appendChild(f);

  document.body.appendChild(wrapper);

  try {
    const canvas = await html2canvas(wrapper, {
      scale: 2,
      useCORS: true,
      allowTaint: true,
      backgroundColor: '#EDEDEB',
      logging: false,
      windowWidth: 1240,
      width: 1240
    });

    const imgData = canvas.toDataURL('image/jpeg', 0.93);
    const { jsPDF } = window.jspdf;

    // A4 landscape dimensions
    const A4_W = 297;
    const A4_H = 210;
    const MARGIN = 5; // mm — small uniform print-safe margin
    const maxW = A4_W - MARGIN * 2;
    const maxH = A4_H - MARGIN * 2;

    const imgAspect = canvas.width / canvas.height;

    // Landscape strategy: always fill the full page WIDTH (increase width),
    // and only compress the HEIGHT if the natural height would overflow the
    // page (decrease height). Width is never horizontally distorted.
    let drawW = maxW;
    let drawH = drawW / imgAspect;
    if (drawH > maxH) {
      // Too tall for a single sheet — squeeze the height down to fit.
      drawH = maxH;
    }

    const offsetX = MARGIN; // flush to the left margin, full-width spread
    const offsetY = (A4_H - drawH) / 2; // vertically centered

    const pdf = new jsPDF({ orientation: 'landscape', unit: 'mm', format: 'a4' });
    pdf.addImage(imgData, 'JPEG', offsetX, offsetY, drawW, drawH);

    pdf.save(`${(state.company || 'Growth-Blueprint').replace(/\s+/g, '-')}-Vision-Board.pdf`);
  } catch (e) {
    console.error('PDF export error:', e);
    alert('Export encountered an issue: ' + (e && e.message ? e.message : 'unknown error') + '. Please try the Print option (Ctrl/Cmd + P) instead.');
  } finally {
    wrapper.remove();
    if (overlay) overlay.classList.remove('show');
  }
}
