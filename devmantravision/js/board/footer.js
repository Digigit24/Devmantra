// ════════════════════════════════════════════════
// BOARD FOOTER
// ════════════════════════════════════════════════
import { state } from '../state.js';
import { DM_LOGO_B64 } from './logo.js';

export function createFooter() {
  const footer = document.createElement('div');
  footer.className = 'board-footer';
  footer.innerHTML = `
    <div class="bf-left">Business Growth Blueprint</div>
    <div class="bf-center">${state.company || 'Your Company'} &nbsp;·&nbsp; ${state.name || 'Founder'} &nbsp;·&nbsp; ${new Date().getFullYear()}</div>
    <div class="bf-right">
      <span>Growth Partner</span>
      <img src="${DM_LOGO_B64}" alt="Growth Partner">
    </div>`;
  return footer;
}
