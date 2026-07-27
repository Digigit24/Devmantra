/* ============================================================
   Growth Blueprint — results interactions (#screen-board)
   Owns: scroll progress bar, chapter reveal + nav spy, the
   30/90-day action tabs, the action checklist (lead-specific
   localStorage key), and the mobile action bar. Share behavior
   lives in share.js.
   ============================================================ */
import { state } from '../state.js';

const $ = (sel, ctx) => (ctx || document).querySelector(sel);
const $$ = (sel, ctx) => Array.from((ctx || document).querySelectorAll(sel));

function rafThrottle(fn) {
  let ticking = false;
  return function (...args) {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => { fn.apply(this, args); ticking = false; });
  };
}

function initProgressBar(root) {
  const bar = $('#vcrProgress', root);
  if (!bar) return;
  const update = rafThrottle(() => {
    const d = document.documentElement;
    const max = d.scrollHeight - d.clientHeight;
    bar.style.width = (max > 0 ? (d.scrollTop / max) * 100 : 0) + '%';
  });
  window.addEventListener('scroll', update, { passive: true });
  update();
}

function initReveal(root) {
  const items = $$('[data-reveal]', root);
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) {
    items.forEach((el) => el.classList.add('in'));
    return;
  }
  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) { entry.target.classList.add('in'); io.unobserve(entry.target); }
    });
  }, { threshold: 0.12 });
  items.forEach((el) => io.observe(el));
}

function initChapterSpy(root) {
  const links = $$('.toc a', root);
  if (!links.length) return;
  const sections = links.map((a) => document.querySelector(a.getAttribute('href')));
  const spy = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        links.forEach((a) => a.classList.toggle('active', a.getAttribute('href') === '#' + entry.target.id));
      }
    });
  }, { rootMargin: '-35% 0px -55%' });
  sections.forEach((s) => s && spy.observe(s));
}

function initTabs(root) {
  $$('.tab', root).forEach((btn) => {
    btn.addEventListener('click', () => {
      $$('.tab', root).forEach((b) => { b.classList.toggle('active', b === btn); b.setAttribute('aria-selected', b === btn); });
      $$('.tab-panel', root).forEach((p) => p.classList.toggle('active', p.dataset.panel === btn.dataset.tab));
    });
  });
}

// Bind (or re-bind) the checklist toggle to whatever .action rows currently
// exist in the DOM. Called again after render.js repopulates the action
// lists for a freshly generated blueprint, so it must be idempotent.
export function bindActionChecklist(root) {
  root = root || document.getElementById('vcResults');
  if (!root) return;

  const leadId = state.leadId || state.email || 'anonymous';
  const storageKey = `vision-actions-${leadId}`;
  let saved = [];
  try { saved = JSON.parse(localStorage.getItem(storageKey) || '[]'); } catch (e) { /* ignore */ }

  const rows = $$('.action', root);
  rows.forEach((row, i) => {
    if (row.dataset.boundChecklist) return;
    row.dataset.boundChecklist = '1';
    row.classList.toggle('done', saved.includes(i));
    const check = row.querySelector('.action__check');
    if (!check) return;
    check.addEventListener('click', () => {
      row.classList.toggle('done');
      const rowsNow = $$('.action', root);
      const next = rowsNow.map((r, n) => (r.classList.contains('done') ? n : null)).filter((n) => n !== null);
      try { localStorage.setItem(storageKey, JSON.stringify(next)); } catch (e) { /* ignore */ }
    });
  });
}

export function initResultsInteractions() {
  const root = document.getElementById('vcResults');
  if (!root) return;
  initProgressBar(root);
  initReveal(root);
  initChapterSpy(root);
  initTabs(root);
  bindActionChecklist(root);
}
