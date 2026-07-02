// ════════════════════════════════════════════════
// STATE
// ════════════════════════════════════════════════
export const state = {
  name: '', company: '', city: '',
  industry: '', btype: '', years: '', team: '', revenue: '₹2–5 Cr',
  stage: '', challenges: [], y1goal: '', y1detail: '', excite1: '',
  y3goal: '', proud3: '', y5known: '', y5achieve: [], y5headline: '',
  founder: [], focus: [], personal: [],
  email: '', phone: '', website: '',
  aiContent: null,
  otherAnswers: {}
};

export const REV_LABELS = ['Pre-revenue', 'Under ₹1 Cr', '₹1–2 Cr', '₹2–5 Cr', '₹5–25 Cr', '₹25–100 Cr', '₹100–500 Cr', '₹500 Cr+'];

export function updateRev(v) {
  state.revenue = REV_LABELS[v];
  const disp = document.getElementById('rev-disp');
  if (disp) disp.textContent = REV_LABELS[v];
}

// Load saved scalar state
try {
  const s = JSON.parse(localStorage.getItem('gbv2') || '{}');
  const scalar = ['name', 'company', 'city', 'industry', 'btype', 'years', 'team', 'revenue', 'stage', 'y1goal', 'y1detail', 'excite1', 'y3goal', 'proud3', 'y5known', 'y5headline', 'email', 'phone', 'website'];
  scalar.forEach(k => { if (s[k]) state[k] = s[k]; });
} catch (e) { /* ignore */ }

// Autosave every 5 seconds (scalars only)
setInterval(() => {
  try {
    localStorage.setItem('gbv2', JSON.stringify({
      ...state, aiContent: null, challenges: [], personal: [], founder: [], focus: [], y5achieve: []
    }));
  } catch (e) { /* ignore */ }
}, 5000);
