// ════════════════════════════════════════════════
// UTILS
// ════════════════════════════════════════════════
export function wait(ms) { return new Promise(r => setTimeout(r, ms)); }

export function v(id) {
  const el = document.getElementById(id);
  return el ? el.value.trim() : '';
}
