{{--
    Growth Blueprint — redesigned interactive results experience.
    Converted from the Open Design prototype (vision-blueprint-results.html).
    Lives inside #screen-board as the new *visible* content. The original
    board-topbar / layout-tabs / board-render-area / board-footer markup
    stays in the DOM (wrapped in .vc-pdf-mount, see index.blade.php) purely
    as the PDF export surface — export.js clones its own off-screen render
    every time exportBoard() runs, so hiding that markup here does not
    affect the downloadable PDF in any way.

    Every content block below is either static UI chrome or an empty,
    bindable container that public/assets/vision-card/js/results/render.js
    fills in from `state` and `state.aiContent` right after generation.
--}}
<div class="vc-results" id="vcResults">

  <div class="progress" id="vcrProgress"></div>

  <header class="topbar" data-od-id="results-navigation">
    <div class="shell topbar__inner">
      <a class="brand" href="#vcrTop" aria-label="Dev Mantra">
        <img src="{{ asset('assets/img/logo/logo.jpeg') }}" alt="Dev Mantra">
      </a>
      <div class="topbar__context" id="vcrContext">Growth Blueprint</div>
      <div class="actions">
        <a class="btn" href="#contact"><span>Book a review</span></a>
        <button class="btn" id="vcrPrintBtn" onclick="exportBoard()" aria-label="Download blueprint as PDF">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 19h14"/></svg>
          <span>Download</span>
        </button>
        <div class="share-wrap">
          <button class="btn btn--primary" id="vcrShareBtn" aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="18" cy="5" r="2.5"/><circle cx="6" cy="12" r="2.5"/><circle cx="18" cy="19" r="2.5"/><path d="m8.2 10.8 7.6-4.5M8.2 13.2l7.6 4.5"/></svg>
            <span>Share</span>
          </button>
          <div class="share-menu" id="vcrShareMenu">
            <button data-share="native">Share blueprint</button>
            <button data-share="copy">Copy link</button>
            <button data-share="linkedin">Share on LinkedIn</button>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main id="vcrTop">
    <section class="hero" data-od-id="results-hero">
      <div class="shell"><div class="hero__frame">
        <div class="hero__copy" data-reveal>
          <div class="eyebrow">Your five-year strategic vision</div>
          <h1>Build with clarity.<span>Lead with intent.</span></h1>
          <p class="hero__dek" id="vcrDek">Your personalised growth blueprint is ready.</p>
          <div class="hero__meta" id="vcrMeta"></div>
          <div class="hero__quick"><b>Personalised blueprint</b><span>Shareable · PDF ready · Built for leadership alignment</span></div>
        </div>
        <div class="hero__image" data-reveal>
          <img src="{{ asset('assets/vision-card/img/vision-founder-hero.png') }}" alt="Business founder reviewing a strategic growth blueprint">
          <div class="image-card"><span class="image-card__label">Strategic theme</span><strong id="vcrGrowthTheme">—</strong></div>
        </div>
      </div></div>
    </section>

    <div class="shell layout">
      <aside class="toc" aria-label="Blueprint chapters">
        <div class="toc__title">Your blueprint</div>
        <nav>
          <a href="#north-star">North star</a>
          <a href="#priorities">Strategic priorities</a>
          <a href="#actions">Action plan</a>
          <a href="#roadmap">Five-year roadmap</a>
          <a href="#scorecard">Scorecard</a>
          <a href="#counsel">Founder counsel</a>
        </nav>
        <div class="toc__score"><span>Blueprint structure</span><strong>6 strategic chapters</strong><small>From direction to execution</small></div>
      </aside>

      <div class="content">
        <section class="chapter" id="north-star" data-od-id="north-star-section">
          <div class="chapter__head" data-reveal><span class="chapter__num">01 · NORTH STAR</span><div><h2>The business you are choosing to become.</h2><p class="chapter__intro">The blueprint aligns the company's purpose, ambition and operating character before defining the work required to get there.</p></div></div>
          <div class="summary" data-reveal id="vcrExecutiveSummary"></div>
          <div class="mission-grid">
            <article class="statement" data-reveal><span class="kicker">Mission</span><p id="vcrMission"></p></article>
            <article class="statement statement--accent" data-reveal><span class="kicker">Vision · Five years</span><p id="vcrVision"></p></article>
          </div>
          <div class="values" id="vcrValues" data-reveal></div>
        </section>

        <section class="chapter" id="priorities" data-od-id="priorities-section">
          <div class="chapter__head" data-reveal><span class="chapter__num">02 · DIRECTION</span><div><h2>Strategic priorities. One coherent growth thesis.</h2><p class="chapter__intro">Each priority is designed to reinforce the others—commercial ambition supported by operating discipline.</p></div></div>
          <div class="priority-grid" id="vcrPriorities" data-reveal></div>
          <div class="signal-grid">
            <article class="signal" data-reveal><div class="signal__top"><span>Biggest opportunity</span><b>Market signal</b></div><p id="vcrOpportunity"></p></article>
            <article class="signal" data-reveal><div class="signal__top"><span>Key risk</span><b>Execution signal</b></div><p id="vcrRisk"></p></article>
          </div>
        </section>

        <section class="chapter" id="actions" data-od-id="action-plan-section">
          <div class="chapter__head" data-reveal><span class="chapter__num">03 · EXECUTION</span><div><h2>Move from vision to visible momentum.</h2><p class="chapter__intro">The first ninety days should create focus, ownership and evidence that the strategy is moving.</p></div></div>
          <div class="action-tabs" role="tablist">
            <button class="tab active" data-tab="30" role="tab" aria-selected="true">First 30 days</button>
            <button class="tab" data-tab="90" role="tab" aria-selected="false">By day 90</button>
          </div>
          <div class="tab-panel active" data-panel="30" id="vcrActions30"></div>
          <div class="tab-panel" data-panel="90" id="vcrActions90"></div>
        </section>

        <section class="chapter" id="roadmap" data-od-id="roadmap-section">
          <div class="chapter__head" data-reveal><span class="chapter__num">04 · HORIZONS</span><div><h2>Three horizons for one enduring company.</h2><p class="chapter__intro">Near-term proof, mid-term transformation and long-term market position—sequenced so capability keeps pace with ambition.</p></div></div>
          <div class="roadmap">
            <article class="horizon" data-reveal><div class="horizon__year"><strong>1Y</strong><span>Focus</span></div><ul id="vcrY1"></ul></article>
            <article class="horizon horizon--focus" data-reveal><div class="horizon__year"><strong>3Y</strong><span>Scale</span></div><ul id="vcrY3"></ul></article>
            <article class="horizon" data-reveal><div class="horizon__year"><strong>5Y</strong><span>Lead</span></div><ul id="vcrY5"></ul></article>
          </div>
        </section>

        <section class="chapter" id="scorecard" data-od-id="scorecard-section">
          <div class="chapter__head" data-reveal><span class="chapter__num">05 · MEASURES</span><div><h2>Measure what proves the strategy is working.</h2><p class="chapter__intro">A concise leadership scorecard keeps the team aligned without turning the blueprint into a reporting exercise.</p></div></div>
          <div class="kpis" id="vcrKpis" data-reveal></div>
        </section>

        <section class="chapter" id="counsel" data-od-id="founder-counsel-section">
          <div class="chapter__head" data-reveal><span class="chapter__num">06 · COUNSEL</span><div><h2>The founder's next chapter is leadership by design.</h2></div></div>
          <div class="advice" data-reveal><span class="advice__label">Founder advice</span><blockquote id="vcrFounderAdvice"></blockquote></div>
          <div class="quote" data-reveal><p id="vcrQuote"></p><span>Your strategic framing idea</span></div>
          <div class="conversion" id="strategy-review" data-od-id="strategy-review-cta" data-reveal>
            <div class="conversion__copy">
              <span>Turn insight into execution</span>
              <h3>Review this blueprint with a Dev Mantra strategist.</h3>
              <p>A focused working session to pressure-test priorities, define ownership and convert the first ninety days into an operating plan.</p>
              <a class="btn btn--primary" href="#contact">Book your strategy review</a>
            </div>
            <div class="conversion__proof">
              <div><strong>Blueprint-led discussion</strong><span>Start from your actual priorities, not a generic discovery call.</span></div>
              <div><strong>Leadership alignment</strong><span>Clarify the decisions, owners and measures that matter first.</span></div>
              <div><strong>Execution-ready outcome</strong><span>Leave with a practical ninety-day operating focus.</span></div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <section class="closing" data-od-id="closing-cta">
      <div class="shell">
        <h2 data-reveal>The blueprint is complete. The work begins now.</h2>
        <p data-reveal>Share it with your leadership team, choose the first owner, and turn the next ninety days into evidence of the company you intend to build.</p>
        <div class="closing__actions" data-reveal>
          <button class="btn btn--primary" onclick="exportBoard()">Download your blueprint</button>
          <button class="btn" id="vcrClosingShare">Share with your team</button>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer"><div class="shell footer__inner"><span>Dev Mantra · Growth Blueprint</span><span id="vcrFooterCompany">Prepared for your business</span></div></footer>

  <div class="mobile-convert">
    <a class="btn btn--primary" href="#contact">Book a review</a>
    <button class="btn" id="vcrMobileShare">Share</button>
  </div>

  <div class="modal" id="vcrShareModal" role="dialog" aria-modal="true" aria-labelledby="vcrShareTitle">
    <div class="modal__panel">
      <div class="modal__head">
        <div><span class="eyebrow">Share-ready preview</span><h3 id="vcrShareTitle">Send the strategy, not another attachment.</h3></div>
        <button id="vcrModalClose" aria-label="Close share preview">×</button>
      </div>
      <div class="social-card">
        <img src="{{ asset('assets/vision-card/img/vision-founder-hero.png') }}" alt="Blueprint cover preview">
        <div class="social-card__copy"><span id="vcrModalContext">Growth Blueprint</span><strong>Build with clarity. Lead with intent.</strong></div>
      </div>
      <div class="modal__actions">
        <button class="btn btn--primary" id="vcrModalNative">Share</button>
        <button class="btn" id="vcrModalCopy">Copy link</button>
      </div>
    </div>
  </div>
  <div class="toast" id="vcrToast" role="status" aria-live="polite"></div>

</div>
