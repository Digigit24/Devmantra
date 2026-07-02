// ════════════════════════════════════════════════
// CARD / CHIP HELPERS
// ════════════════════════════════════════════════
import { state } from './state.js';

export function pickCard(el, key, value) {
  el.closest('.cards-grid').querySelectorAll('.ccard').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  state[key] = value;
  if (key === 'y1goal') showY1Followup(value);
}

export function pickCardOther(el, key, gridId) {
  document.getElementById(gridId).querySelectorAll('.ccard').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  const reveal = el.querySelector('.other-reveal');
  if (reveal) { reveal.classList.add('visible'); reveal.querySelector('input').focus(); }
}

export function pickChip(el, key, value) {
  el.closest('.chip-row').querySelectorAll('.chip').forEach(c => c.classList.remove('on'));
  el.classList.add('on'); state[key] = value;
}

export function toggleChip(el, key, value) {
  if (!Array.isArray(state[key])) state[key] = [];
  const cap = (key === 'challenges') ? 2 : 999;
  if (el.classList.contains('on')) {
    el.classList.remove('on');
    state[key] = state[key].filter(v => v !== value);
  } else {
    if (state[key].length >= cap) return;
    el.classList.add('on');
    state[key].push(value);
  }
  // For capped fields, dim unchosen chips when cap reached
  if (cap < 999) {
    const row = el.closest('.chip-row');
    if (row) {
      const atCap = state[key].length >= cap;
      row.querySelectorAll('.chip').forEach(c => {
        if (!c.classList.contains('on')) c.style.opacity = atCap ? '0.38' : '1';
      });
    }
  }
  if (value === 'Other — see below') {
    const wrap = document.getElementById('challenges-other-wrap') || document.getElementById('challenge-other-wrap');
    if (wrap) wrap.style.display = el.classList.contains('on') ? 'block' : 'none';
  }
}

export function toggleAchieve(el, key, value) {
  if (!Array.isArray(state[key])) state[key] = [];
  if (el.classList.contains('selected')) {
    el.classList.remove('selected');
    state[key] = state[key].filter(v => v !== value);
  } else {
    el.classList.add('selected');
    state[key].push(value);
  }
}

export function toggleAchieveOther(el) {
  const wrap = document.getElementById('y5achieve-other-wrap');
  if (!wrap) return;
  if (el.classList.contains('selected')) {
    el.classList.remove('selected');
    wrap.style.display = 'none';
    if (state.otherAnswers.y5achieve) { state.y5achieve = state.y5achieve.filter(v => v !== state.otherAnswers.y5achieve); }
  } else {
    el.classList.add('selected');
    wrap.style.display = 'block';
    wrap.querySelector('input').focus();
  }
}

// Founder card multi-select (cap 2)
export function toggleFounderCard(el, value) {
  if (!Array.isArray(state.founder)) state.founder = [];
  if (el.classList.contains('selected')) {
    el.classList.remove('selected');
    state.founder = state.founder.filter(v => v !== value);
  } else {
    if (state.founder.length >= 2) return;
    el.classList.add('selected');
    state.founder.push(value);
  }
  const atCap = state.founder.length >= 2;
  el.closest('.cards-grid').querySelectorAll('.ccard').forEach(c => {
    if (!c.classList.contains('selected')) c.style.opacity = atCap ? '0.38' : '1';
  });
}

export function toggleFounderCardOther(el) {
  if (!Array.isArray(state.founder)) state.founder = [];
  const reveal = el.querySelector('.other-reveal');
  if (el.classList.contains('selected')) {
    el.classList.remove('selected');
    if (reveal) reveal.classList.remove('visible');
    if (state.otherAnswers.founder) state.founder = state.founder.filter(v => v !== state.otherAnswers.founder);
  } else {
    if (state.founder.length >= 2) return;
    el.classList.add('selected');
    if (reveal) { reveal.classList.add('visible'); reveal.querySelector('input').focus(); }
    const input = reveal ? reveal.querySelector('input') : null;
    if (input) {
      input.oninput = function () {
        state.founder = state.founder.filter(v => v !== state.otherAnswers.founder);
        state.otherAnswers.founder = this.value;
        if (this.value) state.founder.push(this.value);
      };
    }
  }
}

// Focus chip multi-select (cap 2)
export function toggleFocusChip(el, value) {
  if (!Array.isArray(state.focus)) state.focus = [];
  if (el.classList.contains('on')) {
    el.classList.remove('on');
    state.focus = state.focus.filter(v => v !== value);
  } else {
    if (state.focus.length >= 2) return;
    el.classList.add('on');
    state.focus.push(value);
  }
  const atCap = state.focus.length >= 2;
  const row = el.closest('.chip-row');
  if (row) row.querySelectorAll('.chip').forEach(c => {
    if (!c.classList.contains('on')) c.style.opacity = atCap ? '0.38' : '1';
  });
}

// Y1 followup
const Y1FL = {
  'Increase Revenue': ['What revenue target are you aiming for?', 'e.g. ₹15 Cr ARR by year end'],
  'Expand Team': ['How large should your team become?', 'e.g. From 30 to 80 people'],
  'Enter New Markets': ['Which markets are you targeting?', 'e.g. Southeast Asia and the Middle East'],
  'Launch New Services': ['What service are you planning to launch?', 'e.g. A managed IT services offering'],
  'Improve Profitability': ['What margin improvement are you targeting?', 'e.g. From 10% to 18% net margin'],
  'Build Leadership Team': ['Which roles are you prioritising?', 'e.g. COO, CFO and Head of Sales'],
  'Digital Transformation': ['Which area are you digitising first?', 'e.g. Field operations and customer portal'],
  'Improve Customer Experience': ['What would a transformed CX look like?', 'e.g. NPS above 70 and zero-escalation support'],
  'Strengthen Operations': ['Which operational area is the priority?', 'e.g. Supply chain and inventory management'],
};

export function showY1Followup(goal) {
  const area = document.getElementById('y1-followup');
  const data = Y1FL[goal];
  if (data) {
    document.getElementById('y1-fl-label').textContent = data[0];
    document.getElementById('y1-fl-input').placeholder = data[1];
    area.style.display = 'block';
  } else {
    area.style.display = 'none';
  }
}
