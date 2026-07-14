// ════════════════════════════════════════════════
// GENERATE
// ════════════════════════════════════════════════
import { state } from './state.js';
import { wait, sha256Hex, normalizeEmailForMatching, normalizePhoneForMatching, generateEventId } from './utils.js';
import { collectData } from './navigation.js';
import { renderBoard } from './board/render.js';
import { showCongrats } from './navigation.js';
import { buildPayload, clearLeadId } from './autosave.js';

export async function runGenerate() {
  collectData();

  // Final safety check for email and phone before showing the generating screen.
  const finalErrors = [];
  if (!state.email.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(state.email)) {
    finalErrors.push('Valid business email');
  }
  const phoneDigits = (state.phone || '').replace(/\D/g, '');
  if (phoneDigits.length < 10) {
    finalErrors.push('Mobile number with at least 10 digits');
  }
  if (finalErrors.length) {
    showInlineErrors(finalErrors);
    return;
  }

  document.querySelectorAll('.screen').forEach(s => { s.style.display = 'none'; s.classList.remove('active'); });
  const gs = document.getElementById('screen-generating');
  gs.style.display = 'flex'; gs.classList.add('active');
  document.getElementById('progress-fill').style.width = '92%';
  document.getElementById('step-label').textContent = 'Generating...';

  // Animate steps
  const gids = ['gi-1', 'gi-2', 'gi-3', 'gi-4', 'gi-5'];
  for (let i = 0; i < gids.length; i++) {
    await wait(750);
    if (i > 0) { const prev = document.getElementById(gids[i - 1]); prev.classList.remove('active'); prev.classList.add('done'); }
    document.getElementById(gids[i]).classList.add('active');
  }

  // Persist the lead and generate the AI blueprint via the Laravel backend.
  // This keeps the API key secure and guarantees the response is logged.
  // event_id is generated up front and sent to the backend so the browser
  // pixel event (below) and the server-side Conversions API event fired
  // from VisionCardController@generate share one id — Meta uses this to
  // de-duplicate the two instead of counting the conversion twice.
  const eventId = generateEventId();
  const payload = { ...buildPayload(), event_id: eventId };
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const res = await fetch('/vision-card/generate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify(payload)
    });

    if (res.status === 422) {
      const err = await res.json();
      showInlineErrors(err.errors ? Object.values(err.errors).flat() : ['Please check your answers and try again.']);
      return;
    }

    if (!res.ok) {
      throw new Error('Server returned ' + res.status);
    }

    const data = await res.json();
    if (data.success && data.ai_content) {
      state.aiContent = data.ai_content;
    } else {
      state.aiContent = fallback();
    }

    // The blueprint was generated and the lead is finalized server-side —
    // this is the real conversion moment, so fire it to Meta now. Fires
    // even if the AI call itself fell back to the template, since the
    // lead was still captured either way.
    trackCompleteRegistration(eventId);
  } catch (e) {
    console.error('Vision generation failed:', e);
    state.aiContent = fallback();
  }

  await wait(500);
  document.getElementById(gids[gids.length - 1]).classList.remove('active'); document.getElementById(gids[gids.length - 1]).classList.add('done');
  await wait(300);

  // Update topbar
  document.getElementById('tb-company').textContent = state.company || 'Growth Blueprint';
  document.getElementById('tb-sub').textContent = (state.name || 'Founder') + ' · Strategic Vision Board';
  document.getElementById('cgrats-name').textContent = state.name || 'Founder';

  // Journey complete — the lead is now persisted server-side, so drop the
  // stored lead id to avoid a later session overwriting this finished lead.
  clearLeadId();

  renderBoard('executive');
  showCongrats();
}

// Fire the Meta Pixel conversion event for a completed Growth Blueprint
// submission. Advanced Matching data (em/ph) is hashed client-side per
// Meta's requirements before it ever reaches fbq(). Best-effort: pixel
// failures (blocked script, no fbq, etc.) must never break the funnel.
async function trackCompleteRegistration(eventId) {
  if (typeof fbq !== 'function') return;
  try {
    const [em, ph] = await Promise.all([
      sha256Hex(normalizeEmailForMatching(state.email)),
      sha256Hex(normalizePhoneForMatching(state.phone)),
    ]);
    const matchData = {};
    if (em) matchData.em = em;
    if (ph) matchData.ph = ph;
    if (Object.keys(matchData).length) {
      fbq('init', window.META_PIXEL_ID, matchData);
    }
    fbq('track', 'CompleteRegistration', {
      content_name: 'Growth Blueprint',
      status: true,
    }, { eventID: eventId });
  } catch (e) {
    // Swallow — tracking must never block the user's result screen.
  }
}

function showInlineErrors(errors) {
  // Return to the ready screen so the user can correct the issue.
  document.querySelectorAll('.screen').forEach(s => { s.style.display = 'none'; s.classList.remove('active'); });
  const contact = document.getElementById('screen-contact');
  if (contact) { contact.style.display = 'flex'; contact.classList.add('active'); }

  let box = document.getElementById('inline-errors-contact');
  if (!box) {
    box = document.createElement('div');
    box.id = 'inline-errors-contact';
    box.className = 'inline-errors';
    const inner = contact.querySelector('.q-inner');
    if (inner) inner.insertBefore(box, inner.firstChild);
  }
  box.innerHTML = '<div class="inline-error-title">Please complete the following before generating:</div><ul class="inline-error-list">' +
    errors.map(e => '<li>' + e + '</li>').join('') + '</ul>';
  box.style.display = 'block';
}

function buildPrompt() {
  const all = Object.keys(state.otherAnswers).map(k => `Custom answer for ${k}: "${state.otherAnswers[k]}"`).join('\n');
  return `You are a senior strategy consultant. Generate a focused JSON strategy blueprint for this business owner. Every custom answer they provided must be incorporated verbatim into the output.

Founder: ${state.name || 'Founder'} | Company: ${state.company || 'the company'} | City: ${state.city || 'India'}
Industry: ${state.industry} | Type: ${state.btype} | Revenue: ${state.revenue} | Team: ${state.team} | Years: ${state.years}
Current Stage: ${state.stage} | Challenges: ${state.challenges.join(', ')}
1-Year Priority: ${state.y1goal} — ${state.y1detail} | In their words: "${state.excite1}"
3-Year Aspiration: ${state.y3goal} | In their words: "${state.proud3}"
5-Year Vision: "${state.y5known}" | Achievements: ${state.y5achieve.join(', ')} | Headline: "${state.y5headline}"
Founder Identity: ${Array.isArray(state.founder) ? state.founder.join(', ') : state.founder} | Focus Area: ${Array.isArray(state.focus) ? state.focus.join(', ') : state.focus} | Personal goals: ${state.personal.join(', ')}
Custom / Other answers:
${all || 'None'}

Respond with ONLY valid JSON, no markdown fences, matching this exact structure:
{"tagline":"compelling 7-8 word company tagline","growthTheme":"4-5 word strategic theme for next 5 years","mission":"one authoritative mission statement (15-20 words), direct and powerful","vision":"one aspirational vision statement (15-20 words), bold and specific","values":["Value 1","Value 2","Value 3","Value 4"],"executiveSummary":"3 polished, sophisticated sentences written in the style of a leading business publication — present tense, confident, no filler phrases. Sentence 1: the company today and what makes it distinctive. Sentence 2: the strategic inflection it is navigating. Sentence 3: the defining ambition that frames the next five years. If custom answers were provided, weave them in naturally.","topPriorities":["Priority 1 — written as a decisive strategic imperative (max 10 words)","Priority 2","Priority 3","Priority 4","Priority 5"],"biggestOpportunity":"One precise, industry-specific sentence that a senior analyst would write — no platitudes","keyRisk":"One frank, stage-specific sentence. Specific, not generic.","actions30":["Concrete, owner-level action — specific enough to be calendared","Concrete action 2","Concrete action 3"],"actions90":["Action 1 with measurable outcome implied","Action 2","Action 3"],"y1milestones":["Milestone 1 — specific and verifiable","Milestone 2","Milestone 3"],"y3milestones":["Milestone 1 — clear marker of transformation","Milestone 2","Milestone 3"],"y5milestones":["Milestone 1 — legacy-level achievement","Milestone 2","Milestone 3"],"kpis":["KPI 1 — metric name only, no targets","KPI 2","KPI 3","KPI 4"],"founderAdvice":"One authoritative, personalised sentence of counsel — written as a senior mentor would speak to this specific founder about their specific journey. No generalities.","quote":"An original, memorable 12-18 word strategic insight specific to their industry and situation — written to stand alone as a framing idea. NEVER use 'The best strategy is not the most ambitious one' or any generic quote. Make it feel like it could only have been written for this business."}`;
}

// ── QUOTE POOL (60 quotes, session-randomized, no repeats) ──────────────
const QUOTE_POOL = [
  "Clarity of direction is the rarest and most valuable competitive advantage a business can possess.",
  "The businesses that endure are not the most aggressive — they are the most consistent.",
  "Strategy without execution is fantasy. Execution without strategy is chaos.",
  "Your first market is not your final market. Build for where you are going, not where you have been.",
  "Profitable growth and rapid growth are not the same thing. Choose deliberately.",
  "The founder who delegates boldly builds a company. The one who cannot remains trapped in a job.",
  "Revenue is vanity, profit is sanity, and cash is reality — in that order of urgency.",
  "Your brand is not your logo. It is the promise your customers believe you will keep.",
  "Scale breaks everything that was held together by effort alone. Systems are what survive.",
  "The best customer is not the one who pays the most — it is the one who stays the longest.",
  "Every business decision is ultimately a bet on your own conviction. Make sure it is an informed one.",
  "The leaders who win are rarely the smartest. They are the ones who build the best teams.",
  "Pricing is the fastest lever you have. Most founders are afraid to pull it.",
  "If your business cannot survive a week without you, you have built a job, not a company.",
  "Growth that cannot be sustained is not growth — it is a problem deferred.",
  "The market does not reward effort. It rewards value delivered at scale.",
  "Strategy is choosing what not to do as much as deciding what to pursue.",
  "A clear vision shared with the right people is the most powerful management tool ever invented.",
  "The founders who think in decades build businesses that outlast any single product cycle.",
  "Operational excellence is not a function. It is a culture — one that starts at the top.",
  "Most businesses fail in the middle — after initial success and before durable systems are built.",
  "Your cash conversion cycle is the heartbeat of your business health.",
  "The hardest transition in any founder journey is from doing to leading.",
  "A business that solves a real problem for a specific customer wins. Everything else is noise.",
  "Decisions made slowly in crisis are more expensive than decisions made quickly in calm.",
  "The companies that last are the ones that earn the right to grow before they demand it.",
  "Market leadership is rented, not owned. Renew the lease through relentless reinvention.",
  "Speed of execution separates businesses at the same strategic level.",
  "Talent is the one constraint that money alone cannot resolve. Build your hiring capability early.",
  "The bottleneck in your business is almost always where you are most comfortable spending time.",
  "A focused business in a large market will always outperform a scattered one.",
  "Customers do not buy products — they buy better versions of their situation.",
  "The moment a founder stops learning, the business starts declining.",
  "Profitability is not the destination — it is the fuel that powers the real journey.",
  "The best strategic plan is the one your team can execute without needing the founder in the room.",
  "Simplicity scales. Complexity stalls. Audit your operations accordingly.",
  "Culture is what your team does when no one is watching. Build it with intention.",
  "The businesses that compound are the ones where today's customers bring tomorrow's customers.",
  "Every constraint you remove from your team multiplies the business by more than you expect.",
  "Risk is not the enemy of growth — unmanaged risk is.",
  "The gap between knowing and doing is where most business potential is lost.",
  "Recurring revenue is not a business model feature. It is the business model.",
  "Your competitors can copy your product. They cannot copy your relationships and your culture.",
  "The strongest market position is built on what you refuse to compromise, not what you add.",
  "A one-page strategy executed flawlessly beats a hundred-page plan that stays on the shelf.",
  "Build for the customer you want to serve in five years, not the one you are chasing today.",
  "The founder's greatest leverage is the quality of the questions they ask their team.",
  "Scaling prematurely is the most common cause of profitable businesses running out of cash.",
  "If your team does not understand your strategy, your strategy does not exist.",
  "The most durable moat any business can build is a reputation that takes years to earn and seconds to lose.",
  "Capital follows clarity. The businesses that raise and retain investment are the ones with the sharpest thesis.",
  "Process is not bureaucracy — it is freedom with direction.",
  "The quality of your decisions in the next twelve months will compound into the company you are in five years.",
  "Excellence in one vertical will always outperform mediocrity across many.",
  "Your pricing tells the market what you believe you are worth. Price accordingly.",
  "The business that knows its numbers governs itself. The one that does not is governed by surprise.",
  "Momentum is the most underrated business asset — and the hardest to rebuild once lost.",
  "Every hour the founder spends on tasks that can be delegated is an hour not spent on strategy.",
  "Sustainable advantage lives in what is hard to replicate, not in what is easy to announce.",
  "The future of your business is decided in the conversations you are willing to have today."
];

const _usedQuotes = new Set();
function getRandomQuote() {
  const unused = QUOTE_POOL.filter(q => !_usedQuotes.has(q));
  const pool = unused.length > 0 ? unused : QUOTE_POOL;
  const q = pool[Math.floor(Math.random() * pool.length)];
  _usedQuotes.add(q);
  if (_usedQuotes.size >= QUOTE_POOL.length) _usedQuotes.clear();
  return q;
}

function fallback() {
  return {
    tagline: `Defining the Future of ${state.industry || 'Business'}`,
    growthTheme: 'Scale. Lead. Endure.',
    mission: `To deliver exceptional outcomes for every client while building a business worthy of the next generation.`,
    vision: `To be the most trusted and respected ${state.industry || 'business'} enterprise in our chosen markets within five years.`,
    values: ['Excellence', 'Integrity', 'Innovation', 'Resilience'],
    executiveSummary: `${state.company || 'This business'} is an established ${state.industry || ''} enterprise at a pivotal inflection point. With ${state.revenue} in annual revenue and a ${state.team || 'dedicated'} team, the business is well positioned to execute an ambitious growth agenda. The next five years represent a defining chapter in its evolution.`,
    topPriorities: ['Accelerate core revenue growth', 'Build scalable systems and processes', 'Strengthen the leadership team', 'Deepen customer and market relationships', 'Establish a clear competitive moat'],
    biggestOpportunity: `The convergence of digital adoption and changing customer expectations creates a compelling first-mover advantage for ${state.industry || 'businesses'} that move decisively.`,
    keyRisk: `Scaling without simultaneously building the operational, financial and people infrastructure to sustain it is the single greatest risk to manage.`,
    actions30: ['Define and communicate the 90-day priority to the full team', 'Map the three highest-value customer segments to double down on', 'Identify one process to systematise or automate this month'],
    actions90: ['Complete a customer satisfaction and NPS benchmark', 'Fill the most critical leadership or capability gap', 'Launch one new initiative aligned to the 12-month priority'],
    y1milestones: [
      state.y1goal ? `${state.y1goal} — target achieved ahead of schedule` : 'Achieve key revenue milestone',
      'Build core team and systems capability',
      'Establish clear competitive differentiation'
    ],
    y3milestones: [
      state.y3goal ? `${state.y3goal} — fully realised` : 'Achieve regional market leadership',
      'Expand product and service portfolio',
      'Build brand reputation nationally'
    ],
    y5milestones: [(state.y5achieve || [''])[0] || 'Achieve national recognition', 'Deliver strong, diversified revenue streams', 'Create a business that operates without the founder day-to-day'],
    kpis: ['Revenue growth rate (month-on-month)', 'Gross and net profit margin', 'Customer acquisition cost and lifetime value', 'Team retention and engagement score'],
    founderAdvice: `The quality of your decisions over the next 12 months will compound into the company you are in five years — choose with that lens.`,
    quote: getRandomQuote()
  };
}
