// ════════════════════════════════════════════════
// AUTOSAVE — server-side partial-lead capture
// Saves the lead to the database on every step so nothing is lost
// if the visitor abandons the form part-way through. Best-effort:
// failures never disrupt the form.
// ════════════════════════════════════════════════
import { state } from './state.js';

// Build the full payload the backend expects. Shared by the per-step
// autosave and the final generate call so the two never drift apart.
export function buildPayload(step) {
  return {
    lead_id: state.leadId || null,
    step: (step === undefined || step === null) ? null : step,
    name: state.name,
    email: state.email,
    phone: state.phone,
    company: state.company,
    city: state.city,
    website: state.website,
    industry: state.industry,
    business_type: state.btype,
    years_in_business: state.years,
    team_size: state.team,
    annual_revenue: state.revenue,
    current_stage: state.stage,
    challenges: state.challenges,
    y1_goal: state.y1goal,
    y1_detail: state.y1detail,
    y1_excitement: state.excite1,
    y3_goal: state.y3goal,
    y3_proud: state.proud3,
    y5_known: state.y5known,
    y5_achievements: state.y5achieve,
    y5_headline: state.y5headline,
    founder_identity: state.founder,
    focus_areas: state.focus,
    personal_goals: state.personal,
    other_answers: state.otherAnswers,
  };
}

function csrf() {
  return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

function persistLeadId(id) {
  state.leadId = id;
  try {
    const s = JSON.parse(localStorage.getItem('gbv2') || '{}');
    s.leadId = id;
    localStorage.setItem('gbv2', JSON.stringify(s));
  } catch (e) { /* ignore */ }
}

// Forget the lead id once the journey is complete, so a page reload or a
// different visitor on the same browser starts a fresh lead instead of
// overwriting a finished one.
export function clearLeadId() {
  state.leadId = null;
  try {
    const s = JSON.parse(localStorage.getItem('gbv2') || '{}');
    delete s.leadId;
    localStorage.setItem('gbv2', JSON.stringify(s));
  } catch (e) { /* ignore */ }
}

// Serialise saves so a create can't race with itself and produce
// duplicate rows before the first lead_id comes back.
let _saving = false;
let _pending = false;

export async function autosave(step) {
  // Nothing worth persisting server-side until we have an email
  // (or an existing partial row to update).
  if (!state.leadId && !(state.email && state.email.trim())) return;

  if (_saving) { _pending = true; return; }
  _saving = true;

  try {
    const res = await fetch('/vision-card/autosave', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrf(),
      },
      body: JSON.stringify(buildPayload(step)),
      keepalive: true,
    });
    if (res.ok) {
      const data = await res.json();
      if (data && data.lead_id) persistLeadId(data.lead_id);
    }
  } catch (e) {
    // Best-effort only — swallow errors so the form is never blocked.
  } finally {
    _saving = false;
    if (_pending) { _pending = false; autosave(step); }
  }
}
