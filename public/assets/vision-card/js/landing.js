/* ============================================================
   Growth Blueprint — redesigned landing experience (#screen-hero)
   Adapted from the Open Design prototype's script.js.

   Scope: purely decorative/interaction behavior for the landing
   partial (reveal-on-scroll, scroll progress, sticky nav/CTA,
   animated counters, timeline fill, mock dashboard "live" state,
   hero particles, cursor glow/parallax, card tilt). It never
   touches the questionnaire state machine — every CTA in
   partials/landing.blade.php calls the existing global
   startJourney() directly via inline onclick, so there is no
   redirect logic to own here (unlike the standalone prototype,
   which linked out to a separate URL).
   ============================================================ */

  const $ = (sel, ctx) => (ctx || document).querySelector(sel);
  const $$ = (sel, ctx) => Array.from((ctx || document).querySelectorAll(sel));

  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const finePointer = window.matchMedia('(pointer: fine)').matches;

  function rafThrottle(fn) {
    let ticking = false;
    return function (...args) {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(() => { fn.apply(this, args); ticking = false; });
    };
  }

  function initReveal(root) {
    const items = $$('[data-reveal]', root);
    const observed = items.filter((el) => !el.closest('.hero'));

    if (prefersReduced || !('IntersectionObserver' in window)) {
      observed.forEach((el) => el.classList.add('is-in'));
      return;
    }

    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -8% 0px' });

    observed.forEach((el) => io.observe(el));
  }

  function initScrollProgress() {
    const bar = $('#vclScrollBar');
    if (!bar) return;
    const update = rafThrottle(() => {
      const h = document.documentElement;
      const max = h.scrollHeight - h.clientHeight;
      const pct = max > 0 ? (h.scrollTop / max) * 100 : 0;
      bar.style.width = pct + '%';
    });
    window.addEventListener('scroll', update, { passive: true });
    update();
  }

  function initStickyChrome() {
    const nav = $('#vclNav');
    const sticky = $('#vclStickyCta');
    const hero = $('#hero');
    const finalCta = $('#start');

    const onScroll = rafThrottle(() => {
      const y = window.scrollY;
      if (nav) nav.classList.toggle('is-scrolled', y > 40);

      if (sticky && hero) {
        const heroBottom = hero.offsetTop + hero.offsetHeight;
        const nearFinal = finalCta && y + window.innerHeight > finalCta.offsetTop + 120;
        const show = y > heroBottom - 200 && !nearFinal;
        sticky.classList.toggle('is-visible', show);
        sticky.setAttribute('aria-hidden', show ? 'false' : 'true');
      }
    });
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  function animateCount(el) {
    const target = parseFloat(el.dataset.count || '0');
    const suffix = el.dataset.suffix || '';
    const duration = 1600;
    let start = null;

    function step(ts) {
      if (start === null) start = ts;
      const p = Math.min((ts - start) / duration, 1);
      const eased = p === 1 ? 1 : 1 - Math.pow(2, -10 * p);
      const val = Math.round(eased * target);
      el.textContent = val.toLocaleString('en-IN') + suffix;
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = target.toLocaleString('en-IN') + suffix;
    }
    requestAnimationFrame(step);
  }

  function initCounters(root) {
    const nums = $$('[data-count]', root);
    if (!nums.length) return;

    if (prefersReduced || !('IntersectionObserver' in window)) {
      nums.forEach((el) => {
        el.textContent = parseFloat(el.dataset.count).toLocaleString('en-IN') + (el.dataset.suffix || '');
      });
      return;
    }
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) { animateCount(entry.target); io.unobserve(entry.target); }
      });
    }, { threshold: 0.6 });
    nums.forEach((el) => io.observe(el));
  }

  function initTimeline() {
    const track = $('#vclTimelineTrack');
    const fill = $('#vclTimelineFill');
    const nodes = $$('.timeline__node', track || document);
    if (!track || !fill) return;

    const isHorizontal = () => window.matchMedia('(min-width: 768px)').matches;

    const update = rafThrottle(() => {
      const rect = track.getBoundingClientRect();
      const vh = window.innerHeight;
      const raw = (vh * 0.75 - rect.top) / (rect.height + vh * 0.35);
      const p = Math.max(0, Math.min(1, raw));

      if (isHorizontal()) { fill.style.width = (p * 100) + '%'; fill.style.height = '100%'; }
      else { fill.style.height = (p * 100) + '%'; fill.style.width = '100%'; }

      nodes.forEach((node, i) => {
        const threshold = i / Math.max(1, nodes.length - 1);
        node.classList.toggle('is-active', p >= threshold - 0.02);
      });
    });

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
  }

  function initDashboards(root) {
    const dashes = $$('.dash', root);
    if (!dashes.length) return;
    if (prefersReduced || !('IntersectionObserver' in window)) {
      dashes.forEach((d) => d.classList.add('is-live'));
      return;
    }
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) { entry.target.classList.add('is-live'); io.unobserve(entry.target); }
      });
    }, { threshold: 0.25 });
    dashes.forEach((d) => io.observe(d));
  }

  function initParticles() {
    const canvas = $('#vclParticles');
    if (!canvas || prefersReduced) return;
    const ctx = canvas.getContext('2d');
    let w, h, dpr, particles = [], raf;

    const COUNT = window.innerWidth < 700 ? 26 : 54;

    function resize() {
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      w = canvas.clientWidth; h = canvas.clientHeight;
      canvas.width = w * dpr; canvas.height = h * dpr;
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    }

    function seed() {
      particles = Array.from({ length: COUNT }, () => ({
        x: Math.random() * w,
        y: Math.random() * h,
        r: Math.random() * 1.8 + 0.5,
        vx: (Math.random() - 0.5) * 0.25,
        vy: (Math.random() - 0.5) * 0.25,
        a: Math.random() * 0.5 + 0.2
      }));
    }

    function draw() {
      ctx.clearRect(0, 0, w, h);
      for (const p of particles) {
        p.x += p.vx; p.y += p.vy;
        if (p.x < 0 || p.x > w) p.vx *= -1;
        if (p.y < 0 || p.y > h) p.vy *= -1;
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.globalAlpha = p.a * 0.38;
        ctx.fillStyle = '#1b3c6b';
        ctx.fill();
        ctx.globalAlpha = 1;
      }
      raf = requestAnimationFrame(draw);
    }

    function start() { resize(); seed(); cancelAnimationFrame(raf); draw(); }

    const hero = $('#hero');
    if ('IntersectionObserver' in window && hero) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) draw();
          else cancelAnimationFrame(raf);
        });
      }, { threshold: 0 });
      io.observe(hero);
    }

    window.addEventListener('resize', rafThrottle(() => { resize(); seed(); }));
    start();
  }

  function initPointerFx() {
    if (!finePointer || prefersReduced) return;

    const glow = $('#vclCursorGlow');
    const parallaxEls = $$('[data-parallax]');

    if (glow) {
      window.addEventListener('mousemove', rafThrottle((e) => {
        glow.style.opacity = '1';
        glow.style.transform = `translate(${e.clientX}px, ${e.clientY}px) translate(-50%, -50%)`;
      }), { passive: true });
      window.addEventListener('mouseleave', () => { glow.style.opacity = '0'; });
    }

    if (parallaxEls.length) {
      window.addEventListener('mousemove', rafThrottle((e) => {
        const cx = (e.clientX / window.innerWidth - 0.5);
        const cy = (e.clientY / window.innerHeight - 0.5);
        parallaxEls.forEach((el) => {
          const depth = parseFloat(el.dataset.parallax) || 0.05;
          el.style.transform = `translate(${cx * depth * 100}px, ${cy * depth * 100}px)`;
        });
      }), { passive: true });
    }
  }

  function initTilt() {
    if (!finePointer || prefersReduced) return;
    $$('.tilt').forEach((card) => {
      card.addEventListener('mousemove', (e) => {
        const r = card.getBoundingClientRect();
        const px = (e.clientX - r.left) / r.width - 0.5;
        const py = (e.clientY - r.top) / r.height - 0.5;
        card.style.transform = `translateY(-8px) rotateX(${-py * 7}deg) rotateY(${px * 7}deg)`;
      });
      card.addEventListener('mouseleave', () => { card.style.transform = ''; });
    });
  }

  function initMisc() {
    const year = $('#vclYear');
    if (year) year.textContent = String(new Date().getFullYear());
  }

  // The fixed #progress-track / #step-label chrome exists for the
  // questionnaire ("Step X of Y") and was never meant to float over the new
  // landing nav — hide it while the landing screen is showing. navigation.js
  // un-hides both the moment startJourney() moves past the hero.
  function hideQuestionnaireChrome() {
    const track = $('#progress-track');
    const label = $('#step-label');
    if (track) track.style.display = 'none';
    if (label) label.style.display = 'none';
  }

export function initLanding() {
  const root = $('#vcLanding');
  if (!root) return;
  initReveal(root);
  initScrollProgress();
  initStickyChrome();
  initCounters(root);
  initTimeline();
  initDashboards(root);
  initParticles();
  initPointerFx();
  initTilt();
  initMisc();
  hideQuestionnaireChrome();
}
