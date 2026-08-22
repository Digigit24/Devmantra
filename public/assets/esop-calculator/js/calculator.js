/* ============================================================
   ESOP Allocation Calculator — typeform-style wizard
   One question per screen, Next/Back navigation, dynamic
   multi-employee loop, then a single authoritative submit to
   the Laravel backend (App\Http\Controllers\EsopCalculatorController::submit),
   which recomputes everything server-side using the exact
   ESOP_Allocation_Model_V6.xlsx pool-splitting logic.
   ============================================================ */
(function () {
    'use strict';

    var DATA = window.ESOP_DATA || {};
    var PARAMS = DATA.params || [];
    var stage = document.getElementById('esopStage');
    var topFill = document.getElementById('esopTopFill');
    var topLabel = document.getElementById('esopTopLabel');

    var POOL_STEPS_COUNT = 6;
    var EMP_STEPS_COUNT = 6 + PARAMS.length + 1; // profile(6) + questions + add-another
    var CONTACT_STEPS_COUNT = 3;
    var REVIEW_STEPS_COUNT = 1;

    var state = {
        pool: {
            company: '', website: '', industry: '', company_stage: '',
            esop_pool_percent: '', hiring_reserve_percent: '',
            planned_headcount: '', pool_distribute_percent: 100,
            tier_pool_leadership: '', tier_pool_senior_management: '', tier_pool_mid_level: '',
            tier_pool_junior: '', tier_pool_others: ''
        },
        contact: { name: '', email: '', phone: '' },
        employees: [],   // completed employees
        draft: null,     // employee currently being filled
        stepsCompleted: 0,
    };

    var navStack = [];   // history of screen ids, for Back
    var current = null;  // current screen id

    function esc(s) { return (s == null ? '' : String(s)).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; }); }

    /* ── Meta Pixel helpers ───────────────────────────────────────────
       Mirrors assets/vision-card/js/utils.js + generate.js so the ESOP
       Calculator funnel tracks the same way as the Vision Card funnel,
       against the same META_PIXEL_ID (set in app.blade.php). This file
       is a plain (non-module) script, so the helpers live here directly
       instead of being imported. */
    function sha256Hex(input) {
        if (!input || !window.crypto || !window.crypto.subtle) return Promise.resolve(null);
        try {
            var bytes = new TextEncoder().encode(input);
            return window.crypto.subtle.digest('SHA-256', bytes).then(function (digest) {
                return Array.prototype.map.call(new Uint8Array(digest), function (b) { return b.toString(16).padStart(2, '0'); }).join('');
            }).catch(function () { return null; });
        } catch (e) {
            return Promise.resolve(null);
        }
    }

    function normalizeEmailForMatching(email) { return (email || '').trim().toLowerCase(); }
    function normalizePhoneForMatching(phone) { return (phone || '').replace(/\D/g, ''); }

    function generateEventId() {
        if (window.crypto && window.crypto.randomUUID) return window.crypto.randomUUID();
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = (Math.random() * 16) | 0;
            var val = c === 'x' ? r : (r & 0x3) | 0x8;
            return val.toString(16);
        });
    }

    // Fire the Meta Pixel conversion event for a completed ESOP report
    // submission. Advanced Matching data (em/ph) is hashed client-side per
    // Meta's requirements before it ever reaches fbq(). Best-effort: pixel
    // failures (blocked script, no fbq, etc.) must never break the funnel.
    function trackCompleteRegistration(eventId) {
        if (typeof fbq !== 'function') return;
        Promise.all([
            sha256Hex(normalizeEmailForMatching(state.contact.email)),
            sha256Hex(normalizePhoneForMatching(state.contact.phone))
        ]).then(function (hashes) {
            var em = hashes[0], ph = hashes[1];
            var matchData = {};
            if (em) matchData.em = em;
            if (ph) matchData.ph = ph;
            if (Object.keys(matchData).length) {
                fbq('init', window.META_PIXEL_ID, matchData);
            }
            fbq('track', 'CompleteRegistration', {
                content_name: 'ESOP Allocation Calculator',
                status: true
            }, { eventID: eventId });
        }).catch(function () {
            // Swallow — tracking must never block the user's result screen.
        });
    }

    function newDraft() {
        return {
            emp_name: '', emp_code: '', emp_designation: '', emp_department: '',
            emp_seniority: '', emp_years: '', answers: {}
        };
    }

    /* ---------------- progress ---------------- */
    function updateProgress(label) {
        var extraEmployeeInFlight = state.draft ? 1 : 0;
        var totalEstimate = POOL_STEPS_COUNT
            + EMP_STEPS_COUNT * (state.employees.length + Math.max(1, extraEmployeeInFlight))
            + CONTACT_STEPS_COUNT + REVIEW_STEPS_COUNT;
        var pct = Math.min(96, Math.round((state.stepsCompleted / totalEstimate) * 100));
        if (topFill) topFill.style.width = pct + '%';
        if (topLabel) topLabel.textContent = label || 'Step ' + state.stepsCompleted;
    }

    /* ---------------- navigation ---------------- */
    function goTo(screenId, opts) {
        opts = opts || {};
        if (current && !opts.replace) navStack.push(current);
        if (!opts.isBack) state.stepsCompleted++;
        current = screenId;
        render(screenId);
    }

    function goBack() {
        var prev = navStack.pop();
        if (!prev) return;
        state.stepsCompleted = Math.max(0, state.stepsCompleted - 1);
        current = prev;
        render(prev, true);
    }

    /* ---------------- generic screen chrome ---------------- */
    function screen(html) {
        stage.innerHTML = '<div class="esop-screen active">' + html + '</div>';
    }

    function navBar(opts) {
        opts = opts || {};
        var backBtn = navStack.length ? '<button type="button" class="esop-btn esop-btn-ghost" id="esopBackBtn"><i class="fas fa-arrow-left"></i> Back</button>' : '<span></span>';
        var nextLabel = opts.nextLabel || 'Next';
        return '<div class="esop-nav">' + backBtn +
            '<button type="button" class="esop-btn esop-btn-primary" id="esopNextBtn"' + (opts.disabled ? ' disabled' : '') + '>' + esc(nextLabel) + ' <i class="fas fa-arrow-right"></i></button>' +
            '</div>';
    }

    function bindNav(onNext, opts) {
        var backBtn = document.getElementById('esopBackBtn');
        var nextBtn = document.getElementById('esopNextBtn');
        if (backBtn) backBtn.addEventListener('click', goBack);
        if (nextBtn) nextBtn.addEventListener('click', onNext);
        if (opts && opts.enterAdvances !== false) {
            stage.querySelectorAll('input.esop-input').forEach(function (el) {
                el.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') { e.preventDefault(); onNext(); }
                });
            });
            var first = stage.querySelector('input.esop-input, select.esop-select');
            if (first) setTimeout(function () { first.focus(); }, 50);
        }
    }

    function errorBanner(msg) {
        var el = document.getElementById('esopErrorBanner');
        if (!el) return;
        if (!msg) { el.classList.remove('show'); el.textContent = ''; return; }
        el.textContent = msg;
        el.classList.add('show');
    }

    /* ============================================================
       POOL SETUP SCREENS
       ============================================================ */
    function renderPool1() {
        updateProgress('Company details');
        screen(
            '<div class="esop-eyebrow">Step 1 of 5 &middot; Set up the pool</div>' +
            '<h1 class="esop-q-title">Tell us about your company.</h1>' +
            '<p class="esop-q-sub">This appears on your emailed report — it is not used in the allocation formula.</p>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Company name</label>' +
            '<input type="text" class="esop-input" id="fCompany" placeholder="Acme Manufacturing Pvt Ltd" value="' + esc(state.pool.company) + '"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Website (optional)</label>' +
            '<input type="text" class="esop-input" id="fWebsite" placeholder="https://" value="' + esc(state.pool.website) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            state.pool.company = document.getElementById('fCompany').value.trim();
            state.pool.website = document.getElementById('fWebsite').value.trim();
            goTo('pool2');
        });
    }

    function renderPool2() {
        updateProgress('Industry & stage');
        var stageOptions = (DATA.companyStages || []).map(function (s) {
            return '<option value="' + esc(s) + '"' + (state.pool.company_stage === s ? ' selected' : '') + '>' + esc(s) + '</option>';
        }).join('');
        screen(
            '<div class="esop-eyebrow">Step 1 of 5 &middot; Set up the pool</div>' +
            '<h1 class="esop-q-title">What industry and stage is ' + (esc(state.pool.company) || 'your company') + ' in?</h1>' +
            '<div class="esop-field"><label class="esop-field-label">Industry</label>' +
            '<input type="text" class="esop-input" id="fIndustry" placeholder="e.g. Auto Components Manufacturing" value="' + esc(state.pool.industry) + '"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Company stage</label>' +
            '<select class="esop-select" id="fStage"><option value="">Select stage</option>' + stageOptions + '</select></div>' +
            navBar()
        );
        bindNav(function () {
            state.pool.industry = document.getElementById('fIndustry').value.trim();
            state.pool.company_stage = document.getElementById('fStage').value;
            goTo('pool3');
        }, { enterAdvances: true });
    }

    function renderPool3() {
        updateProgress('ESOP pool size');
        screen(
            '<div class="esop-eyebrow">Step 1 of 5 &middot; Set up the pool</div>' +
            '<h1 class="esop-q-title">What is your total ESOP pool?</h1>' +
            '<p class="esop-q-sub">As a percentage of fully diluted equity — e.g. 10 for a 10% pool.</p>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Total ESOP pool (%)</label>' +
            '<input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fPoolPct" placeholder="10" value="' + esc(state.pool.esop_pool_percent) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            var v = parseFloat(document.getElementById('fPoolPct').value);
            if (isNaN(v) || v < 0 || v > 100) { errorBanner('Enter the ESOP pool as a number between 0 and 100.'); return; }
            state.pool.esop_pool_percent = v;
            goTo('pool4');
        });
    }

    function renderPool4() {
        updateProgress('Hiring reserve');
        var poolPct = Number(state.pool.esop_pool_percent) || 0;
        screen(
            '<div class="esop-eyebrow">Step 1 of 5 &middot; Set up the pool</div>' +
            '<h1 class="esop-q-title">How many percentage points do you want to hold back for future hires?</h1>' +
            '<p class="esop-q-sub">This "hiring reserve" is subtracted directly from your total ESOP pool (' + poolPct + '% of equity) to get what is allocatable today — it is percentage points of equity, not a share of the pool. Enter 0 if you don\'t want to hold anything back.</p>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Hiring reserve (percentage points of equity)</label>' +
            '<input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fReservePct" placeholder="e.g. 10" value="' + esc(state.pool.hiring_reserve_percent) + '"></div>' +
            '<div class="esop-field-hint" id="esopReservePreview"></div>' +
            navBar()
        );

        function updatePreview() {
            var el = document.getElementById('esopReservePreview');
            if (!el) return;
            var raw = document.getElementById('fReservePct').value;
            if (raw === '') { el.textContent = ''; return; }
            var reserve = parseFloat(raw);
            if (isNaN(reserve)) { el.textContent = ''; return; }
            var allocatable = poolPct - reserve;
            if (allocatable <= 0) {
                el.innerHTML = '<span style="color:#e2725b;font-weight:600;">&#9888; With a ' + poolPct + '% pool and a ' + reserve + '-point reserve, ' + allocatable.toFixed(2) + '% would be allocatable today — nothing would be left to distribute this cycle. Lower the reserve or raise the pool.</span>';
            } else {
                el.innerHTML = 'Allocatable today: <strong>' + allocatable.toFixed(2) + '%</strong> of equity (' + poolPct + '% pool &minus; ' + reserve + ' point' + (reserve === 1 ? '' : 's') + ' reserved).';
            }
        }
        updatePreview();
        var reserveInput = document.getElementById('fReservePct');
        if (reserveInput) reserveInput.addEventListener('input', updatePreview);

        bindNav(function () {
            var raw = document.getElementById('fReservePct').value;
            if (raw === '') { errorBanner('Enter a hiring reserve (0 or more) to continue.'); return; }
            var v = parseFloat(raw);
            if (isNaN(v) || v < 0 || v > 100) { errorBanner('Enter a hiring reserve between 0 and 100.'); return; }
            state.pool.hiring_reserve_percent = v;
            goTo('pool5');
        });
    }

    function renderPool5() {
        updateProgress('Planned headcount');
        screen(
            '<div class="esop-eyebrow">Step 1 of 5 &middot; Set up the pool</div>' +
            '<h1 class="esop-q-title">How many employees do you plan to score in total?</h1>' +
            '<p class="esop-q-sub">If you plan to come back and score more people later, the tool only releases a proportional share of the pool today — the rest stays reserved until everyone is scored. If you are scoring everyone right now, just enter that number.</p>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Planned headcount</label>' +
            '<input type="number" inputmode="decimal" min="1" max="100000" step="1" class="esop-input" id="fHeadcount" placeholder="e.g. 5" value="' + esc(state.pool.planned_headcount) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            var v = parseInt(document.getElementById('fHeadcount').value, 10);
            if (isNaN(v) || v < 1) { errorBanner('Enter how many employees you plan to score (at least 1).'); return; }
            state.pool.planned_headcount = v;
            goTo('pool6');
        });
    }

    function renderPool6() {
        updateProgress('Advanced pool controls');
        screen(
            '<div class="esop-eyebrow">Step 1 of 5 &middot; Set up the pool (optional)</div>' +
            '<h1 class="esop-q-title">Want to ring-fence equity by seniority level?</h1>' +
            '<p class="esop-q-sub">Optional. Leave any level blank to let it share the remaining pool with everyone else, split purely by score. Only fill this in if you want a hard cap per level.</p>' +
            '<div class="esop-field"><label class="esop-field-label">Pool to distribute this cycle (%)</label>' +
            '<input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fDistributePct" value="' + esc(state.pool.pool_distribute_percent) + '">' +
            '<div class="esop-field-hint">% of the allocatable pool you want to release right now (defaults to 100%).</div></div>' +
            '<div class="esop-row2">' +
            '<div class="esop-field"><label class="esop-field-label">Leadership tier pool (%)</label><input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fTierLeadership" placeholder="Leave blank to skip" value="' + esc(state.pool.tier_pool_leadership) + '"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Senior Mgmt tier pool (%)</label><input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fTierSenior" placeholder="Leave blank to skip" value="' + esc(state.pool.tier_pool_senior_management) + '"></div>' +
            '</div>' +
            '<div class="esop-row2">' +
            '<div class="esop-field"><label class="esop-field-label">Mid-Level tier pool (%)</label><input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fTierMid" placeholder="Leave blank to skip" value="' + esc(state.pool.tier_pool_mid_level) + '"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Junior tier pool (%)</label><input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fTierJunior" placeholder="Leave blank to skip" value="' + esc(state.pool.tier_pool_junior) + '"></div>' +
            '</div>' +
            '<div class="esop-field"><label class="esop-field-label">Others (Default) tier pool (%)</label><input type="number" inputmode="decimal" min="0" max="100" step="0.01" class="esop-input" id="fTierOthers" placeholder="Leave blank to skip" value="' + esc(state.pool.tier_pool_others) + '"></div>' +
            navBar({ nextLabel: 'Continue' })
        );
        bindNav(function () {
            var dist = document.getElementById('fDistributePct').value;
            state.pool.pool_distribute_percent = dist === '' ? 100 : parseFloat(dist);
            state.pool.tier_pool_leadership = document.getElementById('fTierLeadership').value || '';
            state.pool.tier_pool_senior_management = document.getElementById('fTierSenior').value || '';
            state.pool.tier_pool_mid_level = document.getElementById('fTierMid').value || '';
            state.pool.tier_pool_junior = document.getElementById('fTierJunior').value || '';
            state.pool.tier_pool_others = document.getElementById('fTierOthers').value || '';
            state.draft = newDraft();
            goTo('empIntro');
        }, { enterAdvances: false });
    }

    /* ============================================================
       EMPLOYEE INTRO + PROFILE SCREENS
       ============================================================ */
    function renderEmpIntro() {
        updateProgress('Add employees');
        var n = state.employees.length;
        screen(
            '<div class="esop-eyebrow">Step 2 of 5 &middot; Add your people</div>' +
            '<h1 class="esop-q-title">' + (n === 0 ? "Now let's add the people you're considering for equity." : "Great — let's add the next person.") + '</h1>' +
            '<p class="esop-q-sub">You will answer 5 quick profile questions, then a 20-point behavioural assessment for each person.</p>' +
            navBar({ nextLabel: n === 0 ? "Let's go" : 'Continue' })
        );
        bindNav(function () { goTo('empName'); });
    }

    function renderEmpName() {
        updateProgress('Employee name');
        var d = state.draft;
        screen(
            '<div class="esop-eyebrow">Employee ' + (state.employees.length + 1) + '</div>' +
            '<h1 class="esop-q-title">What is this employee’s name?</h1>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><input type="text" class="esop-input" id="fEmpName" placeholder="Full name" value="' + esc(d.emp_name) + '"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Employee ID (optional)</label><input type="text" class="esop-input" id="fEmpCode" placeholder="e.g. EMP-014" value="' + esc(d.emp_code) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            var v = document.getElementById('fEmpName').value.trim();
            if (!v) { errorBanner('Enter the employee’s name to continue.'); return; }
            state.draft.emp_name = v;
            state.draft.emp_code = document.getElementById('fEmpCode').value.trim();
            goTo('empDesignation');
        });
    }

    function renderEmpDesignation() {
        updateProgress('Designation');
        var d = state.draft;
        screen(
            '<div class="esop-eyebrow">' + esc(d.emp_name) + '</div>' +
            '<h1 class="esop-q-title">What is their designation?</h1>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><input type="text" class="esop-input" id="fEmpDesignation" placeholder="e.g. Plant Manager" value="' + esc(d.emp_designation) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            var v = document.getElementById('fEmpDesignation').value.trim();
            if (!v) { errorBanner('Enter a designation to continue.'); return; }
            state.draft.emp_designation = v;
            goTo('empDepartment');
        });
    }

    function renderEmpDepartment() {
        updateProgress('Department');
        var d = state.draft;
        var options = (DATA.departments || []).map(function (dep) {
            return '<option value="' + esc(dep) + '"' + (d.emp_department === dep ? ' selected' : '') + '>' + esc(dep) + '</option>';
        }).join('');
        screen(
            '<div class="esop-eyebrow">' + esc(d.emp_name) + '</div>' +
            '<h1 class="esop-q-title">Which department are they in?</h1>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><select class="esop-select" id="fEmpDept"><option value="">Select department</option>' + options + '</select></div>' +
            navBar()
        );
        bindNav(function () {
            var v = document.getElementById('fEmpDept').value;
            if (!v) { errorBanner('Select a department to continue.'); return; }
            state.draft.emp_department = v;
            goTo('empSeniority');
        }, { enterAdvances: false });
    }

    function renderEmpSeniority() {
        updateProgress('Seniority level');
        var d = state.draft;
        var levels = DATA.seniorityLevels || [];
        var html = levels.map(function (level) {
            return '<button type="button" class="esop-choice-btn' + (d.emp_seniority === level ? ' selected' : '') + '" data-val="' + esc(level) + '">' + esc(level) + '</button>';
        }).join('');
        screen(
            '<div class="esop-eyebrow">' + esc(d.emp_name) + '</div>' +
            '<h1 class="esop-q-title">What is their seniority level?</h1>' +
            '<p class="esop-q-sub">This determines whether they draw from a dedicated tier pool (if you set one) or the shared remaining pool.</p>' +
            '<div class="esop-choice-row">' + html + '</div>' +
            navBar({ disabled: !d.emp_seniority })
        );
        stage.querySelectorAll('.esop-choice-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                stage.querySelectorAll('.esop-choice-btn').forEach(function (b) { b.classList.remove('selected'); });
                btn.classList.add('selected');
                state.draft.emp_seniority = btn.getAttribute('data-val');
                document.getElementById('esopNextBtn').removeAttribute('disabled');
            });
        });
        bindNav(function () {
            if (!state.draft.emp_seniority) { errorBanner('Select a seniority level to continue.'); return; }
            goTo('empYears');
        }, { enterAdvances: false });
    }

    function renderEmpYears() {
        updateProgress('Tenure');
        var d = state.draft;
        screen(
            '<div class="esop-eyebrow">' + esc(d.emp_name) + '</div>' +
            '<h1 class="esop-q-title">How many years have they been with the company?</h1>' +
            '<p class="esop-q-sub">This is scored automatically — you do not need to answer a separate tenure question later.</p>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><input type="number" inputmode="decimal" min="0" max="60" step="0.1" class="esop-input" id="fEmpYears" placeholder="e.g. 4.5" value="' + esc(d.emp_years) + '"></div>' +
            navBar({ nextLabel: 'Start the assessment' })
        );
        bindNav(function () {
            var v = parseFloat(document.getElementById('fEmpYears').value);
            if (isNaN(v) || v < 0 || v > 60) { errorBanner('Enter years with the company as a number between 0 and 60.'); return; }
            state.draft.emp_years = v;
            goTo('empQ0');
        });
    }

    /* ---------------- behavioural question screens ---------------- */
    function renderEmpQuestion(index) {
        var param = PARAMS[index];
        var d = state.draft;
        updateProgress('Question ' + (index + 1) + ' of ' + PARAMS.length);

        var hintHtml = '';
        if (param.deptSpecific) {
            var hint = (DATA.deptHints || {})[d.emp_department];
            if (hint) hintHtml = '<div class="esop-q-hint show">' + esc(hint) + '</div>';
        }

        var selected = d.answers[param.key];
        var optionsHtml = param.options.map(function (opt, i) {
            var isSel = (selected !== undefined && String(selected) === String(opt.score));
            return '<div class="esop-option' + (isSel ? ' selected' : '') + '" data-score="' + opt.score + '">' +
                '<div class="esop-option-badge">' + String.fromCharCode(65 + i) + '</div>' +
                '<div class="esop-option-text">' + esc(opt.text) + '</div></div>';
        }).join('');

        screen(
            '<div class="esop-eyebrow">' + esc(d.emp_name) + ' &middot; Behavioural assessment ' + (index + 1) + '/' + PARAMS.length + '</div>' +
            '<h1 class="esop-q-title">' + esc(param.label) + '</h1>' +
            hintHtml +
            '<div class="esop-options" id="esopOptions">' + optionsHtml + '</div>' +
            navBar({ disabled: selected === undefined })
        );

        function selectScore(score) {
            state.draft.answers[param.key] = score;
            stage.querySelectorAll('.esop-option').forEach(function (el) {
                el.classList.toggle('selected', el.getAttribute('data-score') === String(score));
            });
            document.getElementById('esopNextBtn').removeAttribute('disabled');
        }

        var advanced = false; // guards against a rapid double-click auto-advancing twice and skipping a question
        stage.querySelectorAll('.esop-option').forEach(function (el) {
            el.addEventListener('click', function () {
                if (advanced) return;
                selectScore(parseInt(el.getAttribute('data-score'), 10));
                setTimeout(advanceQuestion, 220); // typeform-style auto-advance
            });
        });

        function advanceQuestion() {
            if (advanced) return;
            if (state.draft.answers[param.key] === undefined) { errorBanner('Select the statement that best fits, or the closest one.'); return; }
            advanced = true;
            if (index + 1 < PARAMS.length) {
                goTo('empQ' + (index + 1));
            } else {
                // Last question answered — this is the single correct point where a
                // draft becomes a committed employee. Committing here (a user action),
                // rather than as a side effect of rendering empAddAnother, means
                // re-rendering empAddAnother (e.g. via Back) never re-runs this logic.
                state.employees.push(state.draft);
                state.draft = null;
                goTo('empAddAnother');
            }
        }

        bindNav(advanceQuestion, { enterAdvances: false });
    }

    function renderEmpAddAnother() {
        updateProgress('Add another?');
        // Pure display: reads the already-committed last employee, no state mutation.
        var justAdded = state.employees[state.employees.length - 1];
        var total = 0;
        if (justAdded) PARAMS.forEach(function (p) { total += (justAdded.answers[p.key] || 0); });

        var backBtnHtml = navStack.length ? '<button type="button" class="esop-btn esop-btn-ghost" id="esopBackBtn"><i class="fas fa-arrow-left"></i> Back</button>' : '<span></span>';

        screen(
            '<div class="esop-eyebrow">' + esc(justAdded ? justAdded.emp_name : '') + ' scored ' + total + '/100</div>' +
            '<h1 class="esop-q-title">Do you want to score another employee?</h1>' +
            '<p class="esop-q-sub">You have added ' + state.employees.length + ' employee' + (state.employees.length === 1 ? '' : 's') + ' so far. The pool splits pro-rata across everyone you add in this session.</p>' +
            '<div class="esop-choice-row">' +
            '<button type="button" class="esop-choice-btn" id="btnAddAnotherYes">Yes, add another</button>' +
            '<button type="button" class="esop-choice-btn" id="btnAddAnotherNo">No, I’m done</button>' +
            '</div>' +
            '<div class="esop-nav">' + backBtnHtml + '<span></span></div>'
        );
        document.getElementById('btnAddAnotherYes').addEventListener('click', function () {
            state.draft = newDraft();
            goTo('empIntro');
        });
        document.getElementById('btnAddAnotherNo').addEventListener('click', function () {
            goTo('contactName');
        });
        var backBtn = document.getElementById('esopBackBtn');
        if (backBtn) {
            backBtn.addEventListener('click', function () {
                // Un-commit the just-added employee so their answers are editable
                // again on the previous (last question) screen, then navigate back.
                var last = state.employees.pop();
                state.draft = last || newDraft();
                goBack();
            });
        }
    }

    /* ============================================================
       CONTACT SCREENS
       ============================================================ */
    function renderContactName() {
        updateProgress('Your details');
        screen(
            '<div class="esop-eyebrow">Step 4 of 5 &middot; Get your report</div>' +
            '<h1 class="esop-q-title">Where should we send the full report?</h1>' +
            '<p class="esop-q-sub">We’ll email you a copy alongside the on-screen results.</p>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><label class="esop-field-label">Your name</label><input type="text" class="esop-input" id="fContactName" value="' + esc(state.contact.name) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            var v = document.getElementById('fContactName').value.trim();
            if (!v) { errorBanner('Enter your name to continue.'); return; }
            state.contact.name = v;
            goTo('contactEmail');
        });
    }

    function renderContactEmail() {
        updateProgress('Your email');
        screen(
            '<div class="esop-eyebrow">Step 4 of 5 &middot; Get your report</div>' +
            '<h1 class="esop-q-title">And your email address?</h1>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            '<div class="esop-field"><input type="email" class="esop-input" id="fContactEmail" placeholder="you@company.com" value="' + esc(state.contact.email) + '"></div>' +
            navBar()
        );
        bindNav(function () {
            var v = document.getElementById('fContactEmail').value.trim();
            if (!v || v.indexOf('@') === -1) { errorBanner('Enter a valid email address to continue.'); return; }
            state.contact.email = v;
            goTo('contactPhone');
        });
    }

    function renderContactPhone() {
        updateProgress('Phone (optional)');
        screen(
            '<div class="esop-eyebrow">Step 4 of 5 &middot; Get your report</div>' +
            '<h1 class="esop-q-title">Phone number? <span style="color:#94a3b8;font-weight:400;">(optional)</span></h1>' +
            '<div class="esop-field"><input type="text" class="esop-input" id="fContactPhone" value="' + esc(state.contact.phone) + '"></div>' +
            navBar({ nextLabel: 'Review my session' })
        );
        bindNav(function () {
            state.contact.phone = document.getElementById('fContactPhone').value.trim();
            goTo('review');
        });
    }

    /* ============================================================
       REVIEW + SUBMIT
       ============================================================ */
    function renderReview() {
        updateProgress('Review');
        var rows = state.employees.map(function (e) {
            var total = 0;
            PARAMS.forEach(function (p) { total += (e.answers[p.key] || 0); });
            // Colours here are light-theme values. The wizard renders on white,
            // so the earlier rgba(255,255,255,…) values left the seniority label
            // and the row divider invisible.
            return '<div style="display:flex;justify-content:space-between;padding:0.6rem 0;border-bottom:1px solid #e2e8f0;">' +
                '<span style="color:#0f172a;">' + esc(e.emp_name) + ' <span style="color:#64748b;">&middot; ' + esc(e.emp_seniority) + '</span></span>' +
                '<span style="color:#4a73c4;font-weight:700;">' + total + '/100</span></div>';
        }).join('');

        screen(
            '<div class="esop-eyebrow">Step 5 of 5 &middot; Review</div>' +
            '<h1 class="esop-q-title">Ready to generate your ESOP allocation report.</h1>' +
            '<p class="esop-q-sub">Pool: ' + esc(state.pool.esop_pool_percent) + '% of equity, ' + esc(state.pool.hiring_reserve_percent) + '% held in reserve. ' + state.employees.length + ' employee' + (state.employees.length === 1 ? '' : 's') + ' scored.</p>' +
            '<div style="margin-bottom:1.4rem;">' + rows + '</div>' +
            '<div id="esopErrorBanner" class="esop-error-banner"></div>' +
            navBar({ nextLabel: 'Get my ESOP report' })
        );
        bindNav(submitSession, { enterAdvances: false });
    }

    function renderSubmitting() {
        screen(
            '<div class="esop-loading">' +
            '<div class="esop-spinner"></div>' +
            '<p style="color:#64748b;font-size:0.9rem;">Scoring every employee and splitting the pool…</p>' +
            '</div>'
        );
    }

    function submitSession() {
        goTo('submitting');
        // event_id is generated up front and sent to the backend so the browser
        // pixel event (fired below on success) and the server-side Conversions
        // API event fired from EsopCalculatorController@submit share one id —
        // Meta uses this to de-duplicate the two instead of counting the
        // conversion twice. Mirrors the /vision-card funnel's setup.
        var esopEventId = generateEventId();
        var payload = {
            event_id: esopEventId,
            name: state.contact.name, email: state.contact.email, phone: state.contact.phone,
            company: state.pool.company, website: state.pool.website, industry: state.pool.industry,
            company_stage: state.pool.company_stage,
            esop_pool_percent: state.pool.esop_pool_percent,
            hiring_reserve_percent: state.pool.hiring_reserve_percent,
            planned_headcount: state.pool.planned_headcount,
            pool_distribute_percent: state.pool.pool_distribute_percent,
            tier_pool_leadership: state.pool.tier_pool_leadership || null,
            tier_pool_senior_management: state.pool.tier_pool_senior_management || null,
            tier_pool_mid_level: state.pool.tier_pool_mid_level || null,
            tier_pool_junior: state.pool.tier_pool_junior || null,
            tier_pool_others: state.pool.tier_pool_others || null,
            employees: state.employees.map(function (e) {
                return {
                    emp_name: e.emp_name, emp_code: e.emp_code, emp_designation: e.emp_designation,
                    emp_department: e.emp_department, emp_seniority: e.emp_seniority, emp_years: e.emp_years,
                    answers: e.answers
                };
            })
        };

        fetch(DATA.submitUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': DATA.csrfToken, 'Accept': 'application/json' },
            body: JSON.stringify(payload)
        }).then(function (res) {
            if (!res.ok) return res.json().then(function (body) { throw body; });
            return res.json();
        }).then(function (data) {
            state.stepsCompleted = POOL_STEPS_COUNT + EMP_STEPS_COUNT * (state.employees.length + 1) + CONTACT_STEPS_COUNT + REVIEW_STEPS_COUNT;
            updateProgress('Your results');
            // The report was generated and the lead is finalized server-side —
            // this is the real conversion moment, so fire it to Meta now. Fires
            // even if the AI commentary itself fell back to the template, since
            // the lead + report were still captured either way.
            trackCompleteRegistration(esopEventId);

            // By this point the lead is saved and the report exists at its own
            // URL. A fault while DRAWING it is therefore not a submission
            // failure, and must not dump the user back on the form as though
            // their work was lost — fall back to the server-rendered report,
            // which carries the same content.
            try {
                renderResults(data);
            } catch (renderErr) {
                if (window.console && console.error) console.error('ESOP results render failed:', renderErr);
                if (data && data.report_url) {
                    window.location.href = data.report_url;
                    return;
                }
                throw renderErr;
            }
        }).catch(function (err) {
            var msg = (err && err.message) ? err.message : 'Something went wrong while generating your report. Please check your answers and try again.';
            goTo('review', { replace: true, isBack: true });
            errorBanner(msg);
        });
    }

    /* ============================================================
       RESULTS — full-width dashboard (shares design system + JS
       helpers with the standalone shareable report page; see
       assets/esop-calculator/css/dashboard.css and js/dashboard.js)
       ============================================================ */
    function renderResults(data) {
        current = 'results';
        stage.classList.add('is-results');

        var pool = data.pool || {};
        // Order the table by rank, which is now driven by the recommended grant
        // (see EsopAllocationCalculator) — so the Rank column reads top-down and
        // matches the order on the shareable report page. Unranked (zero-grant)
        // people fall to the bottom rather than being scattered through it.
        var employees = (data.employees || []).slice().sort(function (a, b) {
            var ra = a.rank || 999999, rb = b.rank || 999999;
            if (ra !== rb) return ra - rb;
            return (Number(b.final_grant_percent) || 0) - (Number(a.final_grant_percent) || 0);
        });
        var byDepartment = (data.by_department || []).slice(0, 12);
        var byLevel = data.by_level || [];
        var ai = data.ai_overall || {};
        var D = window.EsopDashboard;

        var company = state.pool.company || 'Your Company';
        var totalAllocated = Number(pool.total_allocated_percent || 0);
        var allocatable = Number(pool.allocatable_pool_percent || 0);
        var remaining = Number(pool.remaining_pool_percent || 0);
        var reserve = Number(state.pool.hiring_reserve_percent || 0);
        var underPlanned = pool.scored_count < pool.planned_headcount;

        // Stamp the actual generation time rather than "just now" — the results
        // screen can sit open in a tab for hours, and the PDF exported from it
        // needs a real timestamp on it. Pinned to IST so this always matches the
        // shareable report page (which renders server-side), instead of drifting
        // when the founder happens to be viewing from another timezone.
        var generatedAt;
        try {
            generatedAt = new Date().toLocaleString('en-IN', {
                timeZone: 'Asia/Kolkata',
                day: '2-digit', month: 'short', year: 'numeric',
                hour: 'numeric', minute: '2-digit', hour12: true
            }) + ' IST';
        } catch (e) {
            generatedAt = new Date().toLocaleString();
        }

        var rows = employees.map(function (e) {
            var scoreColor = D.scoreColor(e.total_score);
            var avatarBg = D.avatarColor(e.emp_name || e.id);
            var isTier = !!e.tier_pool_applied;
            var hasNote = e.ai && (e.ai.rationale || e.ai.retention_note);
            return '<tr class="emp-row" data-detail-for="detail-' + e.id + '">' +
                '<td><span class="esop-rank-badge' + (e.rank === 1 ? ' top' : '') + '">' + (e.rank || '—') + '</span></td>' +
                '<td><div class="esop-emp-name-cell"><span class="esop-avatar" style="background:' + avatarBg + '">' + esc(D.initials(e.emp_name)) + '</span>' +
                    '<div class="info"><strong>' + esc(e.emp_name || '—') + '</strong><span>' + esc(e.emp_designation || '—') + '</span></div></div></td>' +
                '<td>' + esc(e.emp_department || '—') + '</td>' +
                '<td>' + esc(e.emp_seniority || '—') + '</td>' +
                '<td>' + e.total_score + '/100<div class="esop-scorebar"><div class="esop-scorebar-fill" style="width:' + e.total_score + '%;background:' + scoreColor + '"></div></div></td>' +
                '<td><span class="esop-chip' + (isTier ? '' : ' remainder') + '">' + (isTier ? 'Tier pool' : 'Remainder') + '</span></td>' +
                '<td><div class="esop-grant-figure">' + Number(e.final_grant_percent).toFixed(4) + '%</div><div class="esop-grant-share">' + Number(e.share_of_pool_percent || 0).toFixed(2) + '% of pool</div></td>' +
                '</tr>' +
                '<tr class="emp-detail-row" id="detail-' + e.id + '"><td colspan="7"><div class="emp-detail-inner">' +
                (hasNote && e.ai.rationale ? '<div class="note">' + esc(e.ai.rationale) + '</div>' : '') +
                (hasNote && e.ai.retention_note ? '<div class="note retention">' + esc(e.ai.retention_note) + '</div>' : '') +
                (!hasNote ? '<div class="note">No additional advisory note was generated for this employee.</div>' : '') +
                '</div></td></tr>';
        }).join('');

        var nextStepsHtml = (ai.next_steps || []).map(function (s) { return '<li>' + esc(s) + '</li>'; }).join('');
        var riskIsBad = !!pool.tier_pool_is_over_committed;

        screen(
            '<div class="esop-dashboard" id="esopResultsPrintArea">' +

            '<div class="esop-dash-hero">' +
            '<div class="esop-dash-hero-bg" style="--esop-hero-img:url(\'' + (DATA.heroImageUrl || '') + '\')"></div>' +
            '<div class="esop-dash-hero-scrim"></div>' +
            '<div class="esop-dash-hero-content">' +
                '<div class="esop-dash-hero-top">' +
                    '<div><div class="esop-dash-eyebrow">Dev Mantra &middot; ESOP Advisory</div><h1 class="esop-dash-hero-title">' + esc(company) + '</h1></div>' +
                    '<div class="esop-dash-hero-meta">Generated ' + esc(generatedAt) + '<br>' + esc(state.pool.industry || '—') + ' &middot; ' + esc(state.pool.company_stage || '—') + '</div>' +
                '</div>' +
                '<p class="esop-dash-hero-sub">A copy has been emailed to ' + esc(state.contact.email) + '. Figures are indicative — confirm with your cap table administrator and legal counsel before communicating any number.</p>' +
                '<div class="esop-dash-hero-bottom">' +
                    '<div><div class="esop-dash-headline-label">Total Recommended Allocation</div><div class="esop-dash-headline-value">' + totalAllocated.toFixed(4) + '%</div><div class="esop-dash-headline-sub">of fully diluted equity &middot; ' + remaining.toFixed(4) + '% still available</div></div>' +
                    '<div class="esop-dash-hero-actions">' +
                        (data.report_url ? '<button type="button" class="esop-dash-btn primary" id="btnCopyLink"><i class="fas fa-link"></i> Copy share link</button>' : '') +
                        '<button type="button" class="esop-dash-btn" id="btnDownloadPdf"><i class="fas fa-file-pdf"></i> Download PDF</button>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '</div>' +

            '<div class="esop-dash-grid-2">' +
                '<div class="esop-dash-card"><div class="esop-dash-card-title">Pool Overview</div>' +
                    '<div class="esop-dash-donut-wrap">' +
                        '<div class="esop-dash-donut-box"><canvas id="esopPoolDonut"></canvas>' +
                            '<div class="esop-dash-donut-center"><div class="val">' + Number(pool.esop_pool_percent || 0).toFixed(2) + '%</div><div class="lbl">Total Pool</div></div></div>' +
                        '<div class="esop-dash-legend">' +
                            '<div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#059669"></span><span class="esop-dash-legend-label">Allocated</span><span class="esop-dash-legend-val">' + totalAllocated.toFixed(4) + '%</span></div>' +
                            '<div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#4a73c4"></span><span class="esop-dash-legend-label">Remaining (allocatable)</span><span class="esop-dash-legend-val">' + Math.max(0, remaining).toFixed(4) + '%</span></div>' +
                            '<div class="esop-dash-legend-row"><span class="esop-dash-legend-dot" style="background:#d9a441"></span><span class="esop-dash-legend-label">Hiring reserve (held back)</span><span class="esop-dash-legend-val">' + reserve.toFixed(2) + '%</span></div>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="esop-dash-card"><div class="esop-dash-card-title">Key Metrics</div>' +
                    '<div class="esop-dash-stat-grid">' +
                        // These two tiles mirror the Pool Overview donut legend exactly, so the
                        // two cards can never appear to disagree. (The older labels showed the
                        // 7% gross allocatable figure — mathematically right, but it read as a
                        // contradiction next to the donut's 0.35% / 6.65% split.)
                        '<div class="esop-dash-stat"><div class="lbl">Total Allocated</div><div class="val money">' + totalAllocated.toFixed(4) + '%</div></div>' +
                        '<div class="esop-dash-stat"><div class="lbl">Remaining To Allocate</div><div class="val">' + Math.max(0, remaining).toFixed(4) + '%</div></div>' +
                        '<div class="esop-dash-stat"><div class="lbl">Employees Scored</div><div class="val">' + pool.scored_count + ' / ' + pool.planned_headcount + '</div></div>' +
                        '<div class="esop-dash-stat"><div class="lbl">Score Range</div><div class="val small">' + (pool.score_range_low != null ? pool.score_range_low + ' – ' + pool.score_range_high : '—') + ' / 100</div></div>' +
                        '<div class="esop-dash-stat"><div class="lbl">Average Grant</div><div class="val money">' + (pool.average_grant_percent != null ? Number(pool.average_grant_percent).toFixed(4) + '%' : '—') + '</div></div>' +
                        '<div class="esop-dash-stat"><div class="lbl">Tier Split</div><div class="val small">' + esc(pool.tier_split_status || 'Not used') + '</div></div>' +
                    '</div>' +
                    (underPlanned ? '<div class="esop-dash-note">Only ' + pool.scored_count + ' of your planned ' + pool.planned_headcount + ' employees are scored so far, so only ' + (Math.round(pool.completion_factor * 1000) / 10) + '% of the pool is being released this cycle. The rest is released automatically as you score the remaining people in a future session.</div>' : '') +
                '</div>' +
            '</div>' +

            (byDepartment.length || byLevel.length ?
            '<div class="esop-dash-grid-2 even">' +
                '<div class="esop-dash-card"><div class="esop-dash-card-title">Allocation By Department</div><div id="esopDeptDist"></div></div>' +
                '<div class="esop-dash-card"><div class="esop-dash-card-title">Allocation By Seniority</div><div id="esopLevelDist"></div></div>' +
            '</div>' : '') +

            '<div class="esop-dash-section-title"><span class="bar"></span> Recommended Allocation By Employee</div>' +
            '<div class="esop-dash-table-wrap">' +
                '<div class="esop-dash-table-head"><h3>' + employees.length + ' employee' + (employees.length === 1 ? '' : 's') + ' scored</h3><span class="esop-expand-hint"><i class="fas fa-hand-pointer"></i> Click a row for advisory notes</span></div>' +
                '<div style="overflow-x:auto;"><table class="esop-dash-table"><thead><tr><th>Rank</th><th>Employee</th><th>Department</th><th>Seniority</th><th>Score</th><th>Peer Group</th><th>Recommended Grant</th></tr></thead><tbody>' + rows + '</tbody></table></div>' +
            '</div>' +

            (ai.summary || ai.risk_flag || ai.vesting_suggestion || nextStepsHtml ?
            '<div class="esop-dash-card" style="margin-bottom:1.25rem;"><div class="esop-dash-card-title">Advisory Notes</div><div class="esop-dash-notes">' +
                (ai.summary ? '<div class="esop-note-item"><div class="esop-note-icon summary"><i class="fas fa-chart-pie"></i></div><div class="esop-note-body"><h4>Summary</h4><p>' + esc(ai.summary) + '</p></div></div>' : '') +
                (ai.risk_flag ? '<div class="esop-note-item"><div class="esop-note-icon risk' + (riskIsBad ? '' : ' ok') + '"><i class="fas ' + (riskIsBad ? 'fa-triangle-exclamation' : 'fa-shield-halved') + '"></i></div><div class="esop-note-body"><h4>Risk Flag</h4><p>' + esc(ai.risk_flag) + '</p></div></div>' : '') +
                (ai.vesting_suggestion ? '<div class="esop-note-item"><div class="esop-note-icon vesting"><i class="fas fa-hourglass-half"></i></div><div class="esop-note-body"><h4>Vesting Suggestion</h4><p>' + esc(ai.vesting_suggestion) + '</p></div></div>' : '') +
                (nextStepsHtml ? '<div class="esop-note-item"><div class="esop-note-icon steps"><i class="fas fa-list-check"></i></div><div class="esop-note-body"><h4>Next Steps</h4><ol>' + nextStepsHtml + '</ol></div></div>' : '') +
            '</div></div>' : '') +

            '<div class="esop-dash-cta">' +
                '<div class="esop-dash-cta-text">' +
                    '<div class="esop-dash-cta-eyebrow">Free 30-Minute Consultation</div>' +
                    '<h3 class="esop-dash-cta-title">Want to talk this through with someone?</h3>' +
                    '<p class="esop-dash-cta-sub">If you\'d like a second opinion on your allocation, vesting schedule, or anything else ESOP-related, our team is happy to help — no pressure, no obligation.</p>' +
                '</div>' +
                '<a href="https://calendly.com/devmantra-info/30min" target="_blank" rel="noopener" class="esop-dash-btn calendly"><i class="fas fa-calendar-check"></i> Book a Free ESOP Clarity Call</a>' +
            '</div>' +

            '<div class="esop-dash-footer"><div class="esop-dash-actions">' +
                '<a href="' + (DATA.homeUrl || '/esop-calculator') + '" class="esop-dash-btn light"><i class="fas fa-rotate-left"></i> Start a new session</a>' +
            '</div></div>' +
            '<p class="esop-dash-disclaimer">This is an indicative recommendation generated from the inputs you provided, using the same pool-splitting logic as Dev Mantra’s ESOP Allocation Model. It is not legal, tax or compliance advice.</p>' +

            '</div>'
        );

        // Every call below is feature-detected. dashboard.js is a separately
        // cached file, so a browser can pair an older copy of it with a newer
        // calculator.js; when that happens the affected panel should simply be
        // absent rather than throwing and taking the whole report down with it.
        if (D && D.renderDonut) {
            D.renderDonut('esopPoolDonut', [
                { label: 'Allocated', value: totalAllocated, color: '#059669' },
                { label: 'Remaining (allocatable)', value: Math.max(0, remaining), color: '#4a73c4' },
                { label: 'Hiring reserve', value: reserve, color: '#d9a441' }
            ]);
        }

        if (D && D.renderDistribution) {
            var deptTotal = (DATA.departments || []).length;
            D.renderDistribution('esopDeptDist', byDepartment, {
                accent: '#4a73c4', accentSoft: '#7aa2e8',
                note: deptTotal
                    ? 'Only departments with at least one scored employee are listed — ' +
                      byDepartment.length + ' of ' + deptTotal + ' represented in this cycle.'
                    : ''
            });
            D.renderDistribution('esopLevelDist', byLevel, {
                accent: '#1b3c6b', accentSoft: '#4a73c4',
                emptyLabel: 'No one scored at this level yet',
                note: 'Every seniority tier is listed. A tier at 0% has nobody scored against it yet, so any pool set aside for that level is still unallocated.'
            });
        }

        if (D && D.initRowToggles) {
            D.initRowToggles('.esop-dash-table-wrap');
        }

        var pdfBtn = document.getElementById('btnDownloadPdf');
        if (pdfBtn) pdfBtn.addEventListener('click', function () { D.exportPdf('esopResultsPrintArea', (company || 'ESOP-Allocation') + '-Report'); });

        var copyBtn = document.getElementById('btnCopyLink');
        if (copyBtn && data.report_url) copyBtn.addEventListener('click', function () { D.copyLink(data.report_url, copyBtn); });
    }

    /* ============================================================
       RENDER DISPATCH
       ============================================================ */
    function render(screenId) {
        errorBanner(null);
        switch (screenId) {
            case 'pool1': return renderPool1();
            case 'pool2': return renderPool2();
            case 'pool3': return renderPool3();
            case 'pool4': return renderPool4();
            case 'pool5': return renderPool5();
            case 'pool6': return renderPool6();
            case 'empIntro': return renderEmpIntro();
            case 'empName': return renderEmpName();
            case 'empDesignation': return renderEmpDesignation();
            case 'empDepartment': return renderEmpDepartment();
            case 'empSeniority': return renderEmpSeniority();
            case 'empYears': return renderEmpYears();
            case 'empAddAnother': return renderEmpAddAnother();
            case 'contactName': return renderContactName();
            case 'contactEmail': return renderContactEmail();
            case 'contactPhone': return renderContactPhone();
            case 'review': return renderReview();
            case 'submitting': return renderSubmitting();
            default:
                if (screenId && screenId.indexOf('empQ') === 0) {
                    return renderEmpQuestion(parseInt(screenId.substring(4), 10));
                }
        }
    }

    // Kick off.
    goTo('pool1', { isBack: true }); // isBack:true so the first screen doesn't double-count progress
})();
