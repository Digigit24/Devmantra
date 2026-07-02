// ════════════════════════════════════════════════
// SCREEN MANAGEMENT
// ════════════════════════════════════════════════
import { state } from './state.js';
import { v } from './utils.js';
import { applyBoardScale } from './board/render.js';

export const SCREENS = ['screen-hero', 'screen-intro', 'screen-industry', 'screen-profile', 'screen-today', 'screen-year1', 'screen-year3', 'screen-year5', 'screen-founder', 'screen-contact'];
export let currentIdx = 0;

export function showScreen(id) {
  document.querySelectorAll('.screen').forEach(s => { s.style.display = 'none'; s.classList.remove('active'); });
  const el = document.getElementById(id);
  if (el) { el.style.display = 'flex'; el.classList.add('active'); }
  window.scrollTo(0, 0);
}

export function updateProg() {
  const pct = (currentIdx / (SCREENS.length - 1)) * 100;
  const fill = document.getElementById('progress-fill');
  const label = document.getElementById('step-label');
  if (fill) fill.style.width = pct + '%';
  const labels = ['Introduction', 'Introduction', 'Industry', 'Profile', 'Current State', '12-Month Strategy', '3-Year Strategy', '5-Year Vision', 'The Founder', 'Final Step'];
  if (label) {
    label.textContent = labels[currentIdx] || '';
    label.style.display = '';
  }
}

export function startJourney() { currentIdx = 1; showScreen(SCREENS[1]); updateProg(); }
export function goBack() { if (currentIdx > 1) { currentIdx--; showScreen(SCREENS[currentIdx]); updateProg(); } }
export function nextScreen() { collectData(); if (currentIdx < SCREENS.length - 1) { currentIdx++; showScreen(SCREENS[currentIdx]); updateProg(); } }

export function collectData() {
  if (currentIdx === 1) { state.name = v('f-name'); state.company = v('f-company'); state.city = v('f-city'); }
  if (currentIdx === 4) {
    if (document.querySelector('#chips-challenge .chip.on[onclick*="Other"]')) {
      state.challenges = state.challenges.filter(c => c !== 'Other — see below');
      if (state.otherAnswers.challenge) state.challenges.push(state.otherAnswers.challenge);
    }
  }
  if (currentIdx === 5) { state.y1detail = v('y1-fl-input'); state.excite1 = v('f-excite1'); }
  if (currentIdx === 6) { state.proud3 = v('f-proud3'); }
  if (currentIdx === 7) {
    state.y5known = v('f-known'); state.y5headline = v('f-headline');
    if (state.otherAnswers.y5achieve && state.y5achieve.includes('Other — see below')) {
      state.y5achieve = state.y5achieve.filter(x => x !== 'Other — see below');
      state.y5achieve.push(state.otherAnswers.y5achieve);
    }
  }
  if (currentIdx === 8) {
    if (state.otherAnswers.founder && !state.founder.includes(state.otherAnswers.founder)) state.founder.push(state.otherAnswers.founder);
  }
  if (currentIdx === 9) { state.email = v('f-email'); state.phone = v('f-phone'); state.website = v('f-website'); }
}

export function showCongrats() {
  document.querySelectorAll('.screen').forEach(s => { s.style.display = 'none'; s.classList.remove('active'); });
  const s = document.getElementById('screen-congrats');
  if (s) { s.style.display = 'flex'; s.classList.add('active'); }
  document.getElementById('progress-fill').style.width = '100%';
  document.getElementById('step-label').textContent = '';
  document.getElementById('step-label').style.display = 'none';
}

export function showBoard() {
  document.querySelectorAll('.screen').forEach(s => { s.style.display = 'none'; s.classList.remove('active'); });
  const s = document.getElementById('screen-board');
  if (s) { s.style.display = 'flex'; s.classList.add('active'); }
  const stepLabel = document.getElementById('step-label');
  stepLabel.textContent = '';
  stepLabel.style.display = 'none';
  applyBoardScale();
  window.scrollTo(0, 0);
}
