// ════════════════════════════════════════════════
// SCREEN MANAGEMENT
// ════════════════════════════════════════════════
import { state } from './state.js';
import { v } from './utils.js';
import { applyBoardScale } from './board/render.js';
import { autosave } from './autosave.js';

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

export function startJourney() {
  // Re-show the progress bar / step label — landing.js hides both while
  // the redesigned landing screen is up, since they otherwise float over
  // its nav bar.
  const track = document.getElementById('progress-track');
  const label = document.getElementById('step-label');
  if (track) track.style.display = '';
  if (label) label.style.display = '';

  currentIdx = 1; showScreen(SCREENS[1]); updateProg(); clearErrors(SCREENS[1]);
}
export function goBack() {
  if (currentIdx > 1) {
    clearErrors(SCREENS[currentIdx]);
    currentIdx--;
    showScreen(SCREENS[currentIdx]);
    updateProg();
    clearErrors(SCREENS[currentIdx]);
  }
}
export function nextScreen() {
  collectData();
  clearErrors(SCREENS[currentIdx]);

  const errors = validateScreen(currentIdx);
  if (errors.length) {
    showErrors(SCREENS[currentIdx], errors);
    return;
  }

  if (currentIdx < SCREENS.length - 1) { currentIdx++; showScreen(SCREENS[currentIdx]); updateProg(); }

  // Persist progress to the server on every step (fire-and-forget so the
  // UI is never blocked). No-ops until an email exists.
  autosave(currentIdx);
}

export function showErrors(screenId, errors) {
  const screen = document.getElementById(screenId);
  if (!screen) return;
  let box = screen.querySelector('.inline-errors');
  if (!box) {
    box = document.createElement('div');
    box.className = 'inline-errors';
    const inner = screen.querySelector('.q-inner');
    if (inner) inner.insertBefore(box, inner.firstChild);
    else screen.appendChild(box);
  }
  box.innerHTML = '<div class="inline-error-title">Please complete the following before continuing:</div><ul class="inline-error-list">' +
    errors.map(e => '<li>' + e + '</li>').join('') + '</ul>';
  box.style.display = 'block';
}

export function clearErrors(screenId) {
  const screen = document.getElementById(screenId);
  if (!screen) return;
  screen.querySelectorAll('.inline-errors').forEach(box => { box.style.display = 'none'; box.innerHTML = ''; });
}

function validateScreen(idx) {
  const required = [];

  if (idx === 1) {
    if (!state.name.trim()) required.push('Your name');
    if (!state.company.trim()) required.push('Company name');
    if (!state.city.trim()) required.push('City');
  }

  if (idx === 2) {
    if (!state.industry) required.push('Industry');
    if (!state.email.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(state.email)) required.push('Valid business email');

    const phoneDigits = (state.phone || '').replace(/\D/g, '');
    if (phoneDigits.length < 10) required.push('Mobile number with at least 10 digits');
  }

  if (idx === 3) {
    if (!state.btype) required.push('Business type');
    if (!state.years) required.push('Years in business');
    if (!state.team) required.push('Team size');
  }

  if (idx === 4 && !state.stage) {
    required.push('Current stage');
  }

  if (idx === 5 && !state.y1goal) {
    required.push('1-year priority');
  }

  if (idx === 6 && !state.y3goal) {
    required.push('3-year aspiration');
  }

  if (idx === 7 && !state.y5known.trim()) {
    required.push('5-year vision statement');
  }

  return required;
}

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
  if (currentIdx === 2) { state.email = v('f-email'); state.phone = v('f-phone'); state.website = v('f-website'); }
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
