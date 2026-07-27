
<div class="vc-landing" id="vcLanding">

  <!-- Scroll progress indicator -->
  <div class="scroll-progress" aria-hidden="true"><span class="scroll-progress__bar" id="vclScrollBar"></span></div>

  <!-- Custom cursor glow (desktop only, decorative) -->
  <div class="cursor-glow" id="vclCursorGlow" aria-hidden="true"></div>

  <!-- ================= NAV ================= -->
  <header class="nav" id="vclNav">
    <div class="container nav__inner">
      <a href="#hero" class="nav__brand" aria-label="Dev Mantra home">
        <img class="nav__logo" src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra">
      </a>
      <nav class="nav__links" aria-label="Primary">
        <a href="#timeline">Journey</a>
        <a href="#vision">Vision</a>
        <a href="#how">How&nbsp;it&nbsp;works</a>
        <a href="#benefits">Benefits</a>
      </nav>
      <a href="javascript:void(0)" class="btn btn--nav" onclick="startJourney()">Begin Your Blueprint</a>
    </div>
  </header>

  <!-- ================= SECTION 1 · HERO ================= -->
  <section class="hero" id="hero">
    <div class="hero__bg" aria-hidden="true">
      <span class="orb orb--gold"></span>
      <span class="orb orb--blue"></span>
      <span class="orb orb--soft"></span>
      <div class="grid-overlay"></div>
      <canvas id="vclParticles" class="particles"></canvas>
    </div>

    <div class="container hero__inner">
      <div class="hero__copy">
        <span class="eyebrow reveal" data-reveal>
          <span class="eyebrow__dot"></span> Dev Mantra Financial Services
        </span>

        <h1 class="hero__title">
          <span class="reveal" data-reveal>Design the Next</span>
          <span class="reveal" data-reveal data-delay="1">Chapter of Your</span>
          <span class="reveal hero__accent" data-reveal data-delay="2">Business.</span>
        </h1>

        <p class="hero__sub reveal" data-reveal data-delay="3">
          Every successful business is built twice — first through strategic thinking,
          then through disciplined execution. Start with the thinking.
        </p>

        <div class="hero__actions reveal" data-reveal data-delay="4">
          <a href="javascript:void(0)" class="btn btn--primary btn--lg" onclick="startJourney()">
            <span>Begin Your Blueprint</span>
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </a>
          <a href="#how" class="btn btn--ghost btn--lg">See how it works</a>
        </div>

        <ul class="trust reveal" data-reveal data-delay="5">
          <li><span class="trust__check">✔</span> Free</li>
          <li><span class="trust__check">✔</span> No Registration</li>
          <li><span class="trust__check">✔</span> AI Powered</li>
          <li><span class="trust__check">✔</span> 12 Minutes</li>
        </ul>
      </div>

      <div class="hero__visual reveal" data-reveal data-delay="3" data-parallax="0.06">
        <div class="macbook float">
          <div class="macbook__screen">
            <div class="macbook__camera"></div>
            <div class="dash">
              <div class="dash__top">
                <div class="dash__brand"><span class="dash__logo"></span> Growth Blueprint</div>
                <div class="dash__dots"><i></i><i></i><i></i></div>
              </div>
              <div class="dash__grid">
                <div class="dash__card dash__card--wide">
                  <span class="dash__label">Projected Revenue</span>
                  <span class="dash__value">₹42.6 Cr <em>by 2031</em></span>
                  <svg class="spark" viewBox="0 0 260 70" preserveAspectRatio="none" aria-hidden="true">
                    <defs>
                      <linearGradient id="vclSparkFill" x1="0" x2="0" y1="0" y2="1">
                        <stop offset="0" stop-color="#1b3c6b" stop-opacity=".22"/>
                        <stop offset="1" stop-color="#1b3c6b" stop-opacity="0"/>
                      </linearGradient>
                    </defs>
                    <path class="spark__area" d="M0,60 L30,54 L60,56 L90,42 L120,46 L150,30 L180,32 L210,18 L240,12 L260,6 L260,70 L0,70 Z" fill="url(#vclSparkFill)"/>
                    <path class="spark__line" d="M0,60 L30,54 L60,56 L90,42 L120,46 L150,30 L180,32 L210,18 L240,12 L260,6" fill="none" stroke="#1b3c6b" stroke-width="2.5" stroke-linecap="round"/>
                  </svg>
                </div>
                <div class="dash__card">
                  <span class="dash__label">Focus</span>
                  <div class="ring" style="--p:78">
                    <span>78<b>%</b></span>
                  </div>
                </div>
                <div class="dash__card">
                  <span class="dash__label">Milestones</span>
                  <ul class="dash__list">
                    <li><i></i> Expand to 3 cities</li>
                    <li><i></i> Series A ready</li>
                    <li class="is-muted"><i></i> Launch product line</li>
                  </ul>
                </div>
                <div class="dash__card dash__card--wide dash__bars">
                  <span class="dash__label">Growth by horizon</span>
                  <div class="bars">
                    <span style="--h:38%"><em>1Y</em></span>
                    <span style="--h:68%"><em>3Y</em></span>
                    <span style="--h:100%"><em>5Y</em></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="macbook__base"><span class="macbook__notch"></span></div>
        </div>
        <div class="glass-chip glass-chip--1 float-slow">1 Year</div>
        <div class="glass-chip glass-chip--2 float-slow">3 Years</div>
        <div class="glass-chip glass-chip--3 float-slow">5 Years</div>
      </div>
    </div>

    <a href="#timeline" class="scroll-hint" aria-label="Scroll down">
      <span class="scroll-hint__mouse"><i></i></span>
    </a>
  </section>

  <!-- ================= SECTION 2 · TIMELINE ================= -->
  <section class="section timeline-sec" id="timeline">
    <div class="container">
      <header class="sec-head">
        <span class="sec-head__kicker" data-reveal>The Journey</span>
        <h2 class="sec-head__title" data-reveal>Where will your business be?</h2>
        <p class="sec-head__lead" data-reveal>Most founders never draw the map. Trace the milestones from today to 2031 — and watch the path light up.</p>
      </header>

      <ol class="timeline" id="vclTimelineTrack">
        <li class="timeline__node" data-reveal>
          <span class="timeline__dot"></span>
          <span class="timeline__year">Today</span>
          <span class="timeline__desc">You are here.</span>
        </li>
        <li class="timeline__node" data-reveal data-delay="1">
          <span class="timeline__dot"></span>
          <span class="timeline__year">2027</span>
          <span class="timeline__desc">Foundations &amp; focus.</span>
        </li>
        <li class="timeline__node" data-reveal data-delay="2">
          <span class="timeline__dot"></span>
          <span class="timeline__year">2028</span>
          <span class="timeline__desc">Momentum builds.</span>
        </li>
        <li class="timeline__node" data-reveal data-delay="3">
          <span class="timeline__dot"></span>
          <span class="timeline__year">2029</span>
          <span class="timeline__desc">Scale with intent.</span>
        </li>
        <li class="timeline__node" data-reveal data-delay="4">
          <span class="timeline__dot"></span>
          <span class="timeline__year">2030</span>
          <span class="timeline__desc">Market leadership.</span>
        </li>
        <li class="timeline__node timeline__node--end" data-reveal data-delay="5">
          <span class="timeline__dot"></span>
          <span class="timeline__year">2031</span>
          <span class="timeline__desc">The vision, realised.</span>
        </li>
        <span class="timeline__line" aria-hidden="true"><span class="timeline__line-fill" id="vclTimelineFill"></span></span>
      </ol>

      <p class="timeline__closer" data-reveal>Your future starts here.</p>
    </div>
  </section>

  <!-- ================= SECTION 3 · VISION CARDS ================= -->
  <section class="section vision-sec" id="vision">
    <div class="container">
      <header class="sec-head">
        <span class="sec-head__kicker" data-reveal>Three Horizons</span>
        <h2 class="sec-head__title" data-reveal>One vision, three timelines.</h2>
        <p class="sec-head__lead" data-reveal>Clarity compounds. See exactly what you're building — near, mid and long term.</p>
      </header>

      <div class="vision-grid">
        <article class="v-card tilt" data-reveal>
          <div class="v-card__glow"></div>
          <div class="v-card__icon">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
          </div>
          <span class="v-card__tag">01 · Near term</span>
          <h3 class="v-card__title">1 Year Vision</h3>
          <p class="v-card__desc">Sharpen priorities and set the goals that make the next twelve months count.</p>
        </article>

        <article class="v-card tilt v-card--feature" data-reveal data-delay="1">
          <div class="v-card__glow"></div>
          <div class="v-card__icon">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 15l5-6 4 4 7-8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 5v5h-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <span class="v-card__tag">02 · Mid term</span>
          <h3 class="v-card__title">3 Year Vision</h3>
          <p class="v-card__desc">Map the strategy that turns ambition into a repeatable engine for growth.</p>
        </article>

        <article class="v-card tilt" data-reveal data-delay="2">
          <div class="v-card__glow"></div>
          <div class="v-card__icon">
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 3l2.5 5.5L20 9l-4 4 1 6-5-3-5 3 1-6-4-4 5.5-.5L12 3z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
          </div>
          <span class="v-card__tag">03 · Long term</span>
          <h3 class="v-card__title">5 Year Vision</h3>
          <p class="v-card__desc">Define the legacy — the business you're truly setting out to build.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ================= SECTION 4 · HOW IT WORKS ================= -->
  <section class="section how-sec" id="how">
    <div class="container">
      <header class="sec-head">
        <span class="sec-head__kicker" data-reveal>The Experience</span>
        <h2 class="sec-head__title" data-reveal>Five steps. Twelve minutes.</h2>
        <p class="sec-head__lead" data-reveal>No spreadsheets. No consultants. Just a guided, thoughtful experience.</p>
      </header>

      <div class="steps">
        <article class="step" data-reveal>
          <span class="step__num">01</span>
          <h3 class="step__title">Answer Questions</h3>
          <p class="step__desc">Respond to strategic prompts crafted for founders like you.</p>
        </article>
        <article class="step" data-reveal data-delay="1">
          <span class="step__num">02</span>
          <h3 class="step__title">Define Vision</h3>
          <p class="step__desc">Articulate where you want the business to be — and why.</p>
        </article>
        <article class="step" data-reveal data-delay="2">
          <span class="step__num">03</span>
          <h3 class="step__title">Build Strategy</h3>
          <p class="step__desc">Translate the vision into a clear, prioritised roadmap.</p>
        </article>
        <article class="step" data-reveal data-delay="3">
          <span class="step__num">04</span>
          <h3 class="step__title">Generate Blueprint</h3>
          <p class="step__desc">Receive a beautiful, personalised Growth Blueprint instantly.</p>
        </article>
        <article class="step" data-reveal data-delay="4">
          <span class="step__num">05</span>
          <h3 class="step__title">Download Forever</h3>
          <p class="step__desc">Keep it, share it, and return to it whenever you need direction.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ================= SECTION 5 · DASHBOARD SHOWCASE ================= -->
  <section class="section showcase-sec">
    <div class="container">
      <header class="sec-head">
        <span class="sec-head__kicker" data-reveal>The Output</span>
        <h2 class="sec-head__title" data-reveal>Not a PDF. A strategic artifact.</h2>
        <p class="sec-head__lead" data-reveal>Charts, goals, timelines and KPIs — assembled into something you'll actually keep on your desk.</p>
      </header>

      <div class="showcase" data-reveal data-parallax="0.04">
        <div class="macbook macbook--lg">
          <div class="macbook__screen">
            <div class="macbook__camera"></div>
            <div class="dash dash--full">
              <div class="dash__top">
                <div class="dash__brand"><span class="dash__logo"></span> Your Growth Blueprint · 2026–2031</div>
                <div class="dash__dots"><i></i><i></i><i></i></div>
              </div>
              <div class="dash__grid dash__grid--full">
                <div class="dash__card dash__card--tall">
                  <span class="dash__label">Revenue Trajectory</span>
                  <span class="dash__value">₹8.2 Cr → ₹42.6 Cr</span>
                  <svg class="spark" viewBox="0 0 260 90" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M0,80 L26,74 L52,76 L78,58 L104,60 L130,44 L156,46 L182,28 L208,22 L234,12 L260,6 L260,90 L0,90 Z" fill="url(#vclSparkFill)"/>
                    <path class="spark__line" d="M0,80 L26,74 L52,76 L78,58 L104,60 L130,44 L156,46 L182,28 L208,22 L234,12 L260,6" fill="none" stroke="#1b3c6b" stroke-width="2.5" stroke-linecap="round"/>
                  </svg>
                  <div class="dash__meta"><span>CAGR</span><b>38.9%</b></div>
                </div>
                <div class="dash__card">
                  <span class="dash__label">Clarity Score</span>
                  <div class="ring" style="--p:92"><span>92<b>%</b></span></div>
                </div>
                <div class="dash__card">
                  <span class="dash__label">Team Alignment</span>
                  <div class="ring ring--blue" style="--p:84"><span>84<b>%</b></span></div>
                </div>
                <div class="dash__card dash__card--wide dash__bars">
                  <span class="dash__label">Goals by horizon</span>
                  <div class="bars bars--5">
                    <span style="--h:40%"><em>1Y</em></span>
                    <span style="--h:55%"><em>2Y</em></span>
                    <span style="--h:70%"><em>3Y</em></span>
                    <span style="--h:86%"><em>4Y</em></span>
                    <span style="--h:100%"><em>5Y</em></span>
                  </div>
                </div>
                <div class="dash__card dash__card--wide">
                  <span class="dash__label">Strategic Pillars</span>
                  <ul class="dash__list dash__list--row">
                    <li><i></i> Product</li>
                    <li><i></i> Market</li>
                    <li><i></i> Talent</li>
                    <li><i></i> Capital</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="macbook__base"><span class="macbook__notch"></span></div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION 6 · BENEFITS ================= -->
  <section class="section benefits-sec" id="benefits">
    <div class="container">
      <header class="sec-head">
        <span class="sec-head__kicker" data-reveal>Why founders do this</span>
        <h2 class="sec-head__title" data-reveal>Outcomes, not features.</h2>
      </header>

      <div class="benefits-grid">
        <article class="b-card" data-reveal>
          <span class="b-card__icon">◎</span>
          <h3>Gain clarity</h3>
          <p>Cut through the noise and see what actually matters this year.</p>
        </article>
        <article class="b-card" data-reveal data-delay="1">
          <span class="b-card__icon">⧉</span>
          <h3>Align your team</h3>
          <p>Put everyone behind one direction, expressed in one page.</p>
        </article>
        <article class="b-card" data-reveal data-delay="2">
          <span class="b-card__icon">⤳</span>
          <h3>Build a roadmap</h3>
          <p>Turn a vague ambition into a sequenced, achievable plan.</p>
        </article>
        <article class="b-card" data-reveal data-delay="3">
          <span class="b-card__icon">⚡</span>
          <h3>Decide faster</h3>
          <p>With priorities set, every future decision gets easier.</p>
        </article>
        <article class="b-card" data-reveal data-delay="4">
          <span class="b-card__icon">◐</span>
          <h3>Stay focused</h3>
          <p>A reference you return to when the day-to-day pulls you away.</p>
        </article>
        <article class="b-card" data-reveal data-delay="5">
          <span class="b-card__icon">✦</span>
          <h3>Grow intentionally</h3>
          <p>Scale on purpose — not by accident, and not by burnout.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ================= SECTION 8 · STATISTICS ================= -->
  <section class="section stats-sec">
    <div class="container">
      <div class="stats">
        <div class="stat" data-reveal>
          <span class="stat__num" data-count="12" data-suffix="">0</span>
          <span class="stat__label">Minutes</span>
        </div>
        <div class="stat" data-reveal data-delay="1">
          <span class="stat__num" data-count="1000" data-suffix="+">0</span>
          <span class="stat__label">Possibilities</span>
        </div>
        <div class="stat" data-reveal data-delay="2">
          <span class="stat__num" data-count="3" data-suffix="">0</span>
          <span class="stat__label">Time Horizons</span>
        </div>
        <div class="stat" data-reveal data-delay="3">
          <span class="stat__num" data-count="1" data-suffix="">0</span>
          <span class="stat__label">Personalized Blueprint</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION 9 · FINAL CTA ================= -->
  <section class="section cta-sec" id="start">
    <div class="cta-sec__bg" aria-hidden="true">
      <span class="orb orb--gold"></span>
      <span class="orb orb--blue"></span>
    </div>
    <div class="container cta-sec__inner">
      <h2 class="cta-sec__title" data-reveal>
        Your future business<br>won't build itself.
      </h2>
      <p class="cta-sec__lead" data-reveal>Take twelve minutes today. Keep the blueprint forever.</p>
      <a href="javascript:void(0)" class="btn btn--primary btn--xl glow" data-reveal onclick="startJourney()">
        <span>Begin Your Blueprint</span>
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <ul class="trust trust--center" data-reveal>
        <li><span class="trust__check">✔</span> Free</li>
        <li><span class="trust__check">✔</span> No Registration</li>
        <li><span class="trust__check">✔</span> AI Powered</li>
        <li><span class="trust__check">✔</span> 12 Minutes</li>
      </ul>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer class="footer">
    <div class="container footer__inner">
      <div class="footer__brand">
        <img class="nav__logo" src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra">
      </div>
      <p class="footer__note">Growth Blueprint · A premium strategic planning experience.</p>
      <p class="footer__copy">© <span id="vclYear"><?php echo e(date('Y')); ?></span> Dev Mantra. All rights reserved.</p>
    </div>
  </footer>

  <!-- Sticky mobile / scroll CTA -->
  <div class="sticky-cta" id="vclStickyCta" aria-hidden="true">
    <div class="container sticky-cta__inner">
      <span class="sticky-cta__text">Design the next chapter of your business.</span>
      <a href="javascript:void(0)" class="btn btn--primary" onclick="startJourney()">Begin Your Blueprint</a>
    </div>
  </div>

</div>
<?php /**PATH C:\Users\hrith\ritik\Devmantranew\resources\views/frontend/vision-card/partials/landing.blade.php ENDPATH**/ ?>