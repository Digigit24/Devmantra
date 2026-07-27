/* ============================================================
   Growth Blueprint — results sharing (#screen-board)
   Web Share API with clipboard fallback, LinkedIn share handoff,
   and the share preview modal. Per the integration plan, none of
   this claims the current URL is a private or permanent link —
   there is no signed share-token backend yet, so wording stays
   generic ("Share" / "Copy link") until that exists.
   ============================================================ */
import { state } from '../state.js';

const $ = (sel, ctx) => (ctx || document).querySelector(sel);
const $$ = (sel, ctx) => Array.from((ctx || document).querySelectorAll(sel));

function showToast(toast, msg) {
  if (!toast) return;
  toast.textContent = msg;
  toast.classList.add('show');
  clearTimeout(toast._hideTimer);
  toast._hideTimer = setTimeout(() => toast.classList.remove('show'), 2200);
}

async function copyLink(toast) {
  try {
    await navigator.clipboard.writeText(location.href);
    showToast(toast, 'Link copied');
  } catch (e) {
    showToast(toast, 'Could not copy the link');
  }
}

async function nativeOrCopyShare(toast) {
  const company = state.company || 'this business';
  const data = {
    title: `${company} · Growth Blueprint`,
    text: 'A five-year Growth Blueprint, prepared with Dev Mantra.',
    url: location.href,
  };
  if (navigator.share) {
    try { await navigator.share(data); } catch (e) { /* user cancelled — no-op */ }
  } else {
    await copyLink(toast);
  }
}

export function initResultsShare() {
  const root = document.getElementById('vcResults');
  if (!root) return;

  const shareBtn = $('#vcrShareBtn', root);
  const shareMenu = $('#vcrShareMenu', root);
  const toast = $('#vcrToast', root);
  const modal = $('#vcrShareModal', root);

  if (shareBtn && shareMenu) {
    shareBtn.addEventListener('click', () => {
      shareMenu.classList.toggle('open');
      shareBtn.setAttribute('aria-expanded', shareMenu.classList.contains('open'));
    });
  }

  document.addEventListener('click', (e) => {
    if (shareMenu && !e.target.closest('.share-wrap')) shareMenu.classList.remove('open');
  });

  $$('[data-share]', shareMenu || root).forEach((btn) => {
    btn.addEventListener('click', async () => {
      if (shareMenu) shareMenu.classList.remove('open');
      if (btn.dataset.share === 'linkedin') {
        window.open('https://www.linkedin.com/sharing/share-offsite/?url=' + encodeURIComponent(location.href), '_blank');
      } else if (btn.dataset.share === 'copy') {
        await copyLink(toast);
      } else {
        openShareModal(modal);
      }
    });
  });

  const openers = [$('#vcrClosingShare', root), $('#vcrMobileShare', root)].filter(Boolean);
  openers.forEach((btn) => btn.addEventListener('click', () => openShareModal(modal)));

  if (modal) {
    const closeBtn = $('#vcrModalClose', modal);
    if (closeBtn) closeBtn.addEventListener('click', () => modal.classList.remove('open'));
    modal.addEventListener('click', (e) => { if (e.target === modal) modal.classList.remove('open'); });

    const nativeBtn = $('#vcrModalNative', modal);
    if (nativeBtn) nativeBtn.addEventListener('click', () => nativeOrCopyShare(toast));

    const copyBtn = $('#vcrModalCopy', modal);
    if (copyBtn) copyBtn.addEventListener('click', async () => { await copyLink(toast); modal.classList.remove('open'); });
  }
}

function openShareModal(modal) {
  if (modal) modal.classList.add('open');
}
