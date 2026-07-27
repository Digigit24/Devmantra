// ════════════════════════════════════════════════
// ENTRY POINT
// ════════════════════════════════════════════════
import { state, updateRev } from './state.js';
import {
  startJourney, goBack, nextScreen,
  showCongrats, showBoard
} from './navigation.js';
import {
  pickCard, pickCardOther, pickChip, toggleChip,
  toggleAchieve, toggleAchieveOther,
  toggleFounderCard, toggleFounderCardOther, toggleFocusChip
} from './form-handlers.js';
import { runGenerate } from './generate.js';
import { setLayout, renderBoard, applyBoardScale } from './board/render.js';
import { exportBoard } from './export.js';
import { initLanding } from './landing.js';
import { renderResults } from './results/render.js';
import { initResultsInteractions } from './results/interactions.js';
import { initResultsShare } from './results/share.js';

// Expose handlers used by inline onclick attributes
window.startJourney = startJourney;
window.goBack = goBack;
window.nextScreen = nextScreen;
window.showCongrats = showCongrats;
window.showBoard = showBoard;
window.pickCard = pickCard;
window.pickCardOther = pickCardOther;
window.pickChip = pickChip;
window.toggleChip = toggleChip;
window.toggleAchieve = toggleAchieve;
window.toggleAchieveOther = toggleAchieveOther;
window.toggleFounderCard = toggleFounderCard;
window.toggleFounderCardOther = toggleFounderCardOther;
window.toggleFocusChip = toggleFocusChip;
window.runGenerate = runGenerate;
window.setLayout = setLayout;
window.exportBoard = exportBoard;
window.updateRev = updateRev;

// Initialize
updateRev(3);

// Redesigned landing (#screen-hero) and results (#screen-board) experiences.
// Both are safe to boot unconditionally: landing's effects only touch
// elements inside #vcLanding, and results' interactions only bind to
// static chrome (progress bar, tabs, share modal) — the actual AI content
// is filled in by renderResults(), called below on reload and from
// generate.js's runGenerate() on first completion.
initLanding();
initResultsInteractions();
initResultsShare();

// If aiContent exists (e.g. page reload), re-render both the legacy PDF
// board mount and the new interactive results content.
if (state.aiContent) {
  const tbCompany = document.getElementById('tb-company');
  const tbSub = document.getElementById('tb-sub');
  const cgratsName = document.getElementById('cgrats-name');
  if (tbCompany) tbCompany.textContent = state.company || 'Growth Blueprint';
  if (tbSub) tbSub.textContent = (state.name || 'Founder') + ' · Strategic Vision Board';
  if (cgratsName) cgratsName.textContent = state.name || 'Founder';
  renderResults();
}

// Initial board scale
applyBoardScale();
