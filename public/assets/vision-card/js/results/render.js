/* ============================================================
   Growth Blueprint — results binding module (#screen-board)
   Binds `state` and `state.aiContent` into the redesigned
   .vc-results DOM (partials/results.blade.php).

   Safety rules (per the integration plan):
     - Every string is written via textContent, never innerHTML,
       so AI output can never inject markup.
     - Missing/empty arrays or strings simply omit their section
       instead of rendering "undefined" or empty shells.
     - This module owns ONLY the results content; it does not
       touch #board-render-area or anything export.js depends on.
   ============================================================ */
import { state } from '../state.js';
import { bindActionChecklist } from './interactions.js';

function setText(id, value) {
  const el = document.getElementById(id);
  if (!el) return;
  if (value === undefined || value === null || value === '') {
    el.textContent = '';
    return;
  }
  el.textContent = value;
}

function hideIfEmpty(el, isEmpty) {
  if (!el) return;
  const section = el.closest('section, article, div.mission-grid, div.signal-grid');
  if (section) section.style.display = isEmpty ? 'none' : '';
}

function pill(text) {
  const span = document.createElement('span');
  span.className = 'pill';
  span.textContent = text;
  return span;
}

function renderMeta() {
  const meta = document.getElementById('vcrMeta');
  if (!meta) return;
  meta.innerHTML = '';
  const items = [state.industry, state.btype, state.city].filter(Boolean);
  const prepared = new Date().toLocaleDateString('en-IN', { day: 'numeric', month: 'long', year: 'numeric' });
  items.forEach((t) => meta.appendChild(pill(t)));
  meta.appendChild(pill('Prepared ' + prepared));
}

function renderValues(values) {
  const wrap = document.getElementById('vcrValues');
  if (!wrap) return;
  wrap.innerHTML = '';
  (values || []).forEach((v) => {
    if (!v) return;
    const span = document.createElement('span');
    span.className = 'value';
    span.textContent = v;
    wrap.appendChild(span);
  });
}

function renderPriorities(priorities) {
  const wrap = document.getElementById('vcrPriorities');
  if (!wrap) return;
  wrap.innerHTML = '';
  (priorities || []).forEach((p, i) => {
    if (!p) return;
    const article = document.createElement('article');
    article.className = 'priority';
    const num = document.createElement('span');
    num.className = 'priority__num';
    num.textContent = String(i + 1).padStart(2, '0');
    const h3 = document.createElement('h3');
    h3.textContent = p;
    article.appendChild(num);
    article.appendChild(h3);
    wrap.appendChild(article);
  });
}

function renderActions(containerId, actions) {
  const wrap = document.getElementById(containerId);
  if (!wrap) return;
  wrap.innerHTML = '';
  (actions || []).forEach((a) => {
    if (!a) return;
    const row = document.createElement('div');
    row.className = 'action';
    row.innerHTML = '<button class="action__check" aria-label="Mark action complete"></button>';
    const textWrap = document.createElement('div');
    const strong = document.createElement('strong');
    strong.textContent = a;
    textWrap.appendChild(strong);
    row.appendChild(textWrap);
    wrap.appendChild(row);
  });
}

function renderMilestones(listId, milestones) {
  const ul = document.getElementById(listId);
  if (!ul) return;
  ul.innerHTML = '';
  (milestones || []).forEach((m) => {
    if (!m) return;
    const li = document.createElement('li');
    li.textContent = m;
    ul.appendChild(li);
  });
}

function renderKpis(kpis) {
  const wrap = document.getElementById('vcrKpis');
  if (!wrap) return;
  wrap.innerHTML = '';
  (kpis || []).forEach((k, i) => {
    if (!k) return;
    const article = document.createElement('article');
    article.className = 'kpi';
    const idx = document.createElement('span');
    idx.className = 'kpi__index';
    idx.textContent = 'KPI ' + String(i + 1).padStart(2, '0');
    const strong = document.createElement('strong');
    strong.textContent = k;
    article.appendChild(idx);
    article.appendChild(strong);
    wrap.appendChild(article);
  });
}

export function renderResults() {
  const root = document.getElementById('vcResults');
  if (!root) return;
  const ai = state.aiContent || {};

  const company = state.company || 'your company';
  const name = state.name || 'Founder';

  document.getElementById('vcrContext') && (document.getElementById('vcrContext').textContent = 'Growth Blueprint · ' + name);
  setText('vcrDek', `A personalised five-year growth blueprint for ${name} and ${company}—turning today's ambition into an execution-ready path forward.`);
  renderMeta();

  setText('vcrGrowthTheme', ai.growthTheme || ai.tagline || '—');
  setText('vcrExecutiveSummary', ai.executiveSummary);
  hideIfEmpty(document.getElementById('vcrExecutiveSummary'), !ai.executiveSummary);

  setText('vcrMission', ai.mission);
  setText('vcrVision', ai.vision);
  renderValues(ai.values);

  renderPriorities(ai.topPriorities);
  setText('vcrOpportunity', ai.biggestOpportunity);
  setText('vcrRisk', ai.keyRisk);

  renderActions('vcrActions30', ai.actions30);
  renderActions('vcrActions90', ai.actions90);

  renderMilestones('vcrY1', ai.y1milestones);
  renderMilestones('vcrY3', ai.y3milestones);
  renderMilestones('vcrY5', ai.y5milestones);

  renderKpis(ai.kpis);

  setText('vcrFounderAdvice', ai.founderAdvice);
  setText('vcrQuote', ai.quote ? '"' + ai.quote + '"' : '');

  setText('vcrFooterCompany', 'Prepared for ' + company);
  const modalContext = document.getElementById('vcrModalContext');
  if (modalContext) modalContext.textContent = company + ' · Growth Blueprint';

  // Re-bind the action checklist now that the 30/90-day action rows exist —
  // initResultsInteractions() ran at page load before this content existed.
  bindActionChecklist(root);
}
