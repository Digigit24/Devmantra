// ════════════════════════════════════════════════
// UTILS
// ════════════════════════════════════════════════
export function wait(ms) { return new Promise(r => setTimeout(r, ms)); }

export function v(id) {
  const el = document.getElementById(id);
  return el ? el.value.trim() : '';
}

// ── Meta Pixel helpers ───────────────────────────────────────────────
// SHA-256 hex digest via the Web Crypto API. Used to hash email/phone
// client-side for Advanced Matching before they ever go into fbq() —
// Meta requires PII passed to Advanced Matching to be pre-hashed.
export async function sha256Hex(input) {
  if (!input) return null;
  try {
    const bytes = new TextEncoder().encode(input);
    const digest = await crypto.subtle.digest('SHA-256', bytes);
    return Array.from(new Uint8Array(digest)).map(b => b.toString(16).padStart(2, '0')).join('');
  } catch (e) {
    return null;
  }
}

// Meta's spec for the `em` field: lowercase, trimmed, no other normalisation.
export function normalizeEmailForMatching(email) {
  return (email || '').trim().toLowerCase();
}

// Meta's spec for the `ph` field: digits only (country code included, no
// leading +, no spaces/dashes). We can't reliably infer a missing country
// code, so this simply strips everything that isn't a digit.
export function normalizePhoneForMatching(phone) {
  return (phone || '').replace(/\D/g, '');
}

// A v4-ish UUID for the shared browser/server event ID (dedup key for the
// Conversions API). Falls back to Math.random for older browsers that lack
// crypto.randomUUID.
export function generateEventId() {
  if (crypto.randomUUID) return crypto.randomUUID();
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
    const r = (Math.random() * 16) | 0;
    const val = c === 'x' ? r : (r & 0x3) | 0x8;
    return val.toString(16);
  });
}
