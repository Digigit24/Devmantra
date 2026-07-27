<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>ESOP Allocation Calculator — Dev Mantra</title>
<meta name="description" content="A free tool that turns your ESOP pool decision into a defensible, board-ready allocation — score every employee on a 20-factor behavioural framework and see exactly how the pool splits.">
<link rel="canonical" href="<?php echo e(request()->url()); ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.png')); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
*,*::before,*::after{box-sizing:border-box}
body{margin:0;font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif}
.esopl{background:#fff;color:#1e293b}

/* Minimal header — logo + single CTA, no site nav */
.esopl-header{position:sticky;top:0;z-index:30;background:#fff;border-bottom:1px solid #e2e8f0;padding:0.9rem 1.5rem;display:flex;align-items:center;justify-content:space-between}
.esopl-header img{width:130px;height:auto;border-radius:50px;display:block}
.esopl-header .esopl-btn{padding:0.65rem 1.35rem;font-size:0.85rem}

.esopl-eyebrow{display:flex;align-items:center;gap:0.6rem;font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:#1b3c6b;margin-bottom:0.9rem}
.esopl-eyebrow .dash{width:26px;height:2px;background:#4a73c4;display:inline-block}
.esopl-section{padding:4.5rem 1.5rem}
.esopl-inner{max-width:1080px;margin:0 auto}
.esopl h2{font-size:clamp(1.6rem,4vw,2.3rem);font-weight:800;color:#0f172a;letter-spacing:-0.02em;line-height:1.25;margin:0 0 1rem}
.esopl p.lede{font-size:1rem;color:#475569;line-height:1.75;max-width:640px}

/* Hero */
.esopl-hero{background:#fff;padding-top:3.5rem}
.esopl-hero-grid{display:grid;grid-template-columns:1.15fr 0.85fr;gap:3rem;align-items:start;max-width:1080px;margin:0 auto;padding:0 1.5rem 4rem}
@media(max-width:900px){.esopl-hero-grid{grid-template-columns:1fr}}
.esopl-hero h1{font-size:clamp(2rem,5vw,3rem);font-weight:800;color:#1b3c6b;letter-spacing:-0.02em;line-height:1.18;margin:0 0 1.1rem}
.esopl-hero ul{list-style:none;margin:1.4rem 0 0;padding:0}
.esopl-hero li{position:relative;padding-left:1.3rem;margin-bottom:0.6rem;font-size:0.9rem;color:#475569;line-height:1.6}
.esopl-hero li::before{content:'';position:absolute;left:0;top:0.5em;width:6px;height:6px;border-radius:50%;background:#4a73c4}
.esopl-side-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;box-shadow:0 12px 32px rgba(15,23,42,0.06);padding:1.75rem}
.esopl-side-title{font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#64748b;margin-bottom:1.2rem}
.esopl-stat{display:flex;gap:1rem;padding:0.9rem 0;border-bottom:1px solid #f1f5f9}
.esopl-stat:last-child{border-bottom:none}
.esopl-stat-num{font-size:2rem;font-weight:800;color:#1b3c6b;flex-shrink:0;width:52px}
.esopl-stat-text{font-size:0.85rem;color:#475569;line-height:1.5;padding-top:0.35rem}

.esopl-cta-row{display:flex;gap:0.9rem;flex-wrap:wrap;margin-top:1.8rem}
.esopl-btn{display:inline-flex;align-items:center;gap:0.5rem;padding:0.85rem 1.6rem;border-radius:9px;font-weight:700;font-size:0.92rem;text-decoration:none;transition:opacity .15s;font-family:inherit;border:none;cursor:pointer}
.esopl-btn-primary{background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#fff}
.esopl-btn-primary:hover{opacity:0.92;color:#fff}
.esopl-btn-outline{border:1.5px solid #cbd5e1;color:#1e293b;background:#fff}
.esopl-btn-outline:hover{border-color:#4a73c4;color:#4a73c4}

/* Who it's for */
.esopl-section.grey{background:#f8fafc}
.esopl-cards{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem;margin-top:2rem}
@media(max-width:760px){.esopl-cards{grid-template-columns:1fr}}
.esopl-card{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:1.5rem}
.esopl-card h3{font-size:1.05rem;font-weight:700;color:#1b3c6b;margin:0 0 0.6rem}
.esopl-card p{font-size:0.88rem;color:#475569;line-height:1.65;margin:0}
.esopl-footnote{font-size:0.8rem;color:#94a3b8;margin-top:1.6rem;font-style:italic}

/* How it works */
.esopl-steps{display:grid;grid-template-columns:1fr 1fr;gap:1.1rem;margin-top:2rem}
@media(max-width:760px){.esopl-steps{grid-template-columns:1fr}}
.esopl-step{background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:1.5rem;display:flex;gap:1.1rem}
.esopl-step-num{font-size:1.9rem;font-weight:800;color:#4a73c4;flex-shrink:0;width:44px}
.esopl-step h3{font-size:1rem;font-weight:700;color:#0f172a;margin:0 0 0.4rem}
.esopl-step p{font-size:0.85rem;color:#475569;line-height:1.6;margin:0}

/* Framework */
.esopl-factor-row{display:flex;flex-wrap:wrap;gap:0.6rem;margin-top:1.6rem}
.esopl-factor-chip{font-size:0.78rem;font-weight:600;color:#1b3c6b;background:#eff6ff;border:1px solid #dbeafe;border-radius:999px;padding:0.4rem 0.85rem}

.esopl-final-cta{background:linear-gradient(135deg,#1b3c6b,#4a73c4);border-radius:20px;padding:3rem 2rem;text-align:center;margin:0 auto;max-width:1080px}
.esopl-final-cta h2{color:#fff}
.esopl-final-cta p{color:rgba(255,255,255,0.8);margin:0 auto 1.6rem;max-width:520px}

.esopl-footer{padding:2rem 1.5rem;text-align:center;font-size:0.78rem;color:#94a3b8;border-top:1px solid #f1f5f9}

/* ══════════════ Motion &amp; modern-UI layer ══════════════ */
.esopl-scrollbar{position:fixed;left:0;top:0;z-index:60;width:0;height:3px;background:linear-gradient(90deg,#1b3c6b,#4a73c4);transition:width .1s linear}

[data-reveal]{opacity:0;transform:translateY(26px);transition:opacity .7s cubic-bezier(.22,1,.36,1),transform .7s cubic-bezier(.22,1,.36,1)}
[data-reveal].in{opacity:1;transform:none}
[data-reveal][data-delay="1"]{transition-delay:.08s}
[data-reveal][data-delay="2"]{transition-delay:.16s}
[data-reveal][data-delay="3"]{transition-delay:.24s}
[data-reveal][data-delay="4"]{transition-delay:.32s}
@media(prefers-reduced-motion:reduce){[data-reveal]{opacity:1;transform:none;transition:none}}

/* Ambient hero orbs */
.esopl-hero{position:relative;overflow:hidden}
.esopl-hero-bg{position:absolute;inset:0;z-index:0;pointer-events:none}
.esopl-orb{position:absolute;border-radius:50%;filter:blur(60px);opacity:0.35}
.esopl-orb--a{width:340px;height:340px;background:#4a73c4;top:-120px;right:-60px;animation:esoplDrift 14s ease-in-out infinite}
.esopl-orb--b{width:260px;height:260px;background:#1b3c6b;top:220px;left:-100px;opacity:0.18;animation:esoplDrift 18s ease-in-out infinite reverse}
@keyframes esoplDrift{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(24px,18px) scale(1.08)}}
@media(prefers-reduced-motion:reduce){.esopl-orb{animation:none}}
.esopl-hero-grid,.esopl-header{position:relative;z-index:1}

/* Card lift on hover */
.esopl-card,.esopl-step,.esopl-side-card{transition:transform .3s cubic-bezier(.22,1,.36,1),box-shadow .3s ease}
.esopl-card:hover,.esopl-step:hover{transform:translateY(-5px);box-shadow:0 16px 32px rgba(15,23,42,0.08);border-color:#cbd5e1}
.esopl-side-card:hover{transform:translateY(-3px);box-shadow:0 18px 44px rgba(15,23,42,0.09)}

/* Buttons: lift + soft glow */
.esopl-btn{transition:transform .18s ease,box-shadow .18s ease,opacity .15s,border-color .18s,color .18s}
.esopl-btn-primary{box-shadow:0 6px 18px rgba(27,60,107,0.18)}
.esopl-btn:hover{transform:translateY(-2px)}
.esopl-btn-primary:hover{box-shadow:0 12px 28px rgba(27,60,107,0.28)}
.esopl-final-cta .esopl-btn-primary{animation:esoplPulse 2.6s ease-in-out infinite}
@keyframes esoplPulse{0%,100%{box-shadow:0 6px 18px rgba(0,0,0,0.12)}50%{box-shadow:0 10px 30px rgba(0,0,0,0.22)}}
@media(prefers-reduced-motion:reduce){.esopl-final-cta .esopl-btn-primary{animation:none}}

/* Factor chips: subtle stagger pop */
.esopl-factor-chip{transition:transform .2s ease,background .2s ease,border-color .2s ease}
.esopl-factor-chip:hover{transform:translateY(-2px);background:#dbeafe;border-color:#bfdbfe}

/* Header shrink-on-scroll */
.esopl-header{transition:box-shadow .25s ease,padding .25s ease}
.esopl-header.is-scrolled{box-shadow:0 4px 18px rgba(15,23,42,0.06)}

/* Stat number count-up */
.esopl-stat-num{font-variant-numeric:tabular-nums}

/* Sticky mobile CTA */
.esopl-sticky-cta{position:fixed;left:0;right:0;bottom:0;z-index:50;display:flex;gap:0.6rem;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.96);backdrop-filter:blur(10px);border-top:1px solid #e2e8f0;padding:0.7rem 1rem calc(0.7rem + env(safe-area-inset-bottom));transform:translateY(110%);transition:transform .3s cubic-bezier(.22,1,.36,1)}
.esopl-sticky-cta.is-visible{transform:translateY(0)}
.esopl-sticky-cta span{font-size:0.8rem;font-weight:600;color:#334155;display:none}
@media(min-width:640px){.esopl-sticky-cta span{display:block}}
.esopl-sticky-cta .esopl-btn{flex-shrink:0;margin-left:auto}
@media(min-width:901px){.esopl-sticky-cta{display:none}}
</style>
</head>
<body>
<div class="esopl-scrollbar" id="esoplScrollBar" aria-hidden="true"></div>
<div class="esopl">

    
    <div class="esopl-header" id="esoplHeader">
        <a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('assets/img/logo/logo.jpeg')); ?>" alt="Dev Mantra"></a>
        <a href="<?php echo e(route('esop-calculator.app')); ?>" class="esopl-btn esopl-btn-primary"><i class="fas fa-calculator"></i> Launch the Calculator</a>
    </div>

    
    <div class="esopl-hero" id="esoplHero">
        <div class="esopl-hero-bg" aria-hidden="true">
            <span class="esopl-orb esopl-orb--a"></span>
            <span class="esopl-orb esopl-orb--b"></span>
        </div>
        <div class="esopl-hero-grid">
            <div>
                <div class="esopl-eyebrow" data-reveal><span class="dash"></span> Free tool &middot; ESOP ownership allocation framework</div>
                <h1 data-reveal data-delay="1">You have decided to give equity. Now comes the hard part: who gets how much.</h1>
                <p class="lede" data-reveal data-delay="2">The ESOP Allocation Calculator turns a decision most founders make on gut feel into a framework you can defend to your board, your co-founders and the employees themselves. Score each person on the same 20 factors, and see exactly how your pool splits before anyone sees a number.</p>
                <ul data-reveal data-delay="3">
                    <li>Behavioural evidence: the reasoning recorded against each of the 20 factors.</li>
                    <li>Pool analysis: how much is allocated, how much is reserved, and where the concentration risk sits.</li>
                </ul>
                <div class="esopl-cta-row" data-reveal data-delay="4">
                    <a href="<?php echo e(route('esop-calculator.app')); ?>" class="esopl-btn esopl-btn-primary"><i class="fas fa-calculator"></i> Launch the calculator</a>
                    <a href="<?php echo e(route('contact')); ?>" class="esopl-btn esopl-btn-outline"><i class="fas fa-comments"></i> Talk to an advisor</a>
                </div>
            </div>
            <div class="esopl-side-card" data-reveal data-delay="2">
                <div class="esopl-side-title">What the scoring gives you</div>
                <div class="esopl-stat"><div class="esopl-stat-num" data-count="20">0</div><div class="esopl-stat-text">factors, scored 0–5 each, for a total out of 100.</div></div>
                <div class="esopl-stat"><div class="esopl-stat-num" data-count="3">0</div><div class="esopl-stat-text">seniority tiers, each with its own optional ring-fenced pool.</div></div>
                <div class="esopl-stat"><div class="esopl-stat-num" data-count="1">0</div><div class="esopl-stat-text">emailed report with the full audit trail behind every number.</div></div>
            </div>
        </div>
    </div>

    
    <div class="esopl-section grey">
        <div class="esopl-inner">
            <div class="esopl-eyebrow" data-reveal><span class="dash"></span> Who it is for</div>
            <h2 data-reveal>Built for the people who actually make this call.</h2>
            <div class="esopl-cards">
                <div class="esopl-card" data-reveal>
                    <h3>Founders and promoters</h3>
                    <p>You are giving away a slice of the company you built. You want it to land with the right people and to hold up when someone asks why. The tool gives you both.</p>
                </div>
                <div class="esopl-card" data-reveal data-delay="1">
                    <h3>CFOs and finance heads</h3>
                    <p>You have to model the dilution and defend the logic to the board. You get a clean allocation, a pool view, and a report you can drop straight into your own workings.</p>
                </div>
                <div class="esopl-card" data-reveal data-delay="2">
                    <h3>HR and compensation leads</h3>
                    <p>You run the assessment conversations. A shared 20-factor rubric means every manager is scoring against the same bar, not their own gut feel.</p>
                </div>
                <div class="esopl-card" data-reveal data-delay="3">
                    <h3>Boards and investors</h3>
                    <p>You need to know a grant was earned, not guessed. Every recommendation comes with the score, the peer comparison and the pool maths behind it.</p>
                </div>
            </div>
            <p class="esopl-footnote" data-reveal>Designed for Indian manufacturing SMEs and mid-market companies. Backed by Dev Mantra's corporate advisory practice.</p>
        </div>
    </div>

    
    <div class="esopl-section">
        <div class="esopl-inner">
            <div class="esopl-eyebrow" data-reveal><span class="dash"></span> The problem</div>
            <h2 data-reveal>Splitting the pool is where good intentions turn into a political problem.</h2>
            <p class="lede" data-reveal data-delay="1">Deciding to share ownership is the easy part. The hard part starts the moment you open the spreadsheet and try to put a number next to each name — your longest-serving plant manager or the engineer who redesigned the line last year, the loyal head of accounts or the sales lead who actually moves revenue. Give too much to the wrong people and you cannot fix it later. Give too little to the ones you cannot afford to lose, and they find out what the market pays.</p>
            <p class="lede" data-reveal data-delay="2" style="margin-top:1rem;">Most companies solve this with a spreadsheet, a gut feel and a hope that nobody compares notes. The ESOP Allocation Calculator replaces that with a documented, repeatable framework — the same one behind Dev Mantra's ESOP Allocation Model.</p>
        </div>
    </div>

    
    <div class="esopl-section grey">
        <div class="esopl-inner">
            <div class="esopl-eyebrow" data-reveal><span class="dash"></span> How it works</div>
            <h2 data-reveal>From a blank pool to a board-ready allocation in five steps.</h2>
            <p class="lede" data-reveal data-delay="1">The calculator walks you through the same sequence a good advisor would. You move forward only when each step is complete.</p>
            <div class="esopl-steps">
                <div class="esopl-step" data-reveal><div class="esopl-step-num">01</div><div><h3>Set up the pool.</h3><p>Enter your company details and the total ESOP pool you are allocating. Set aside a reserve for future hires (the tool defaults to 10%), and it shows you exactly how much is available to grant now.</p></div></div>
                <div class="esopl-step" data-reveal data-delay="1"><div class="esopl-step-num">02</div><div><h3>Add your people.</h3><p>Register every employee you are considering: name, designation, department, seniority level, and years with the company. Manufacturing departments and roles are built in, from Production and Quality Control to R&amp;D and Finance.</p></div></div>
                <div class="esopl-step" data-reveal data-delay="2"><div class="esopl-step-num">03</div><div><h3>Score the behaviour.</h3><p>Answer 20 short, plain-English statements per employee — the same evidence your HR and finance teams would use to justify a number to the board, one question per screen.</p></div></div>
                <div class="esopl-step" data-reveal data-delay="3"><div class="esopl-step-num">04</div><div><h3>Review the pool split.</h3><p>See exactly how the pool divides across everyone scored, how much stays reserved, and whether any seniority tier is over-committed — before anyone sees a number.</p></div></div>
                <div class="esopl-step" data-reveal data-delay="4" style="grid-column:1/-1;max-width:none;"><div class="esopl-step-num">05</div><div><h3>Export the report.</h3><p>Download a boardroom-ready PDF with the full audit trail, or keep the emailed copy for your own records. This is the document you put in front of your compensation committee and board.</p></div></div>
            </div>
            <div class="esopl-cta-row" data-reveal>
                <a href="<?php echo e(route('esop-calculator.app')); ?>" class="esopl-btn esopl-btn-primary"><i class="fas fa-play"></i> Start with Step 1</a>
            </div>
        </div>
    </div>

    
    <div class="esopl-section">
        <div class="esopl-inner">
            <div class="esopl-eyebrow" data-reveal><span class="dash"></span> The framework</div>
            <h2 data-reveal>Twenty factors, because "he's been here a long time" is not a framework.</h2>
            <p class="lede" data-reveal data-delay="1">Tenure matters, but it is one input, not the answer. The calculator scores each employee from 0–5 across twenty factors covering ownership mindset, problem-solving, leadership, retention importance, replacement difficulty and more — for a total out of 100. Every score is backed by a specific, plain-English statement, so the reasoning is on record, not just the number.</p>
            <div class="esopl-factor-row" data-reveal data-delay="2">
                <span class="esopl-factor-chip">Ownership mindset</span>
                <span class="esopl-factor-chip">Ability to drive change</span>
                <span class="esopl-factor-chip">Strategic contribution</span>
                <span class="esopl-factor-chip">Leadership &amp; influence</span>
                <span class="esopl-factor-chip">Problem solving</span>
                <span class="esopl-factor-chip">Innovation</span>
                <span class="esopl-factor-chip">Cost optimisation</span>
                <span class="esopl-factor-chip">Customer impact</span>
                <span class="esopl-factor-chip">Retention importance</span>
                <span class="esopl-factor-chip">Replacement difficulty</span>
                <span class="esopl-factor-chip">Knowledge contribution</span>
                <span class="esopl-factor-chip">+ 9 more</span>
            </div>
        </div>
    </div>

    
    <div class="esopl-section">
        <div class="esopl-final-cta" data-reveal>
            <h2>Stop guessing who gets what.</h2>
            <p>Set up your pool, add your people, and get a defensible allocation you can put in front of your board today — free.</p>
            <a href="<?php echo e(route('esop-calculator.app')); ?>" class="esopl-btn esopl-btn-primary" style="background:#fff;color:#1b3c6b;"><i class="fas fa-calculator"></i> Launch the calculator</a>
        </div>
    </div>

    <div class="esopl-footer">&copy; <?php echo e(date('Y')); ?> Dev Mantra Financial Services. This tool provides an indicative recommendation only — not legal, tax or compliance advice.</div>

</div>


<div class="esopl-sticky-cta" id="esoplStickyCta" aria-hidden="true">
    <span>Get your board-ready ESOP split.</span>
    <a href="<?php echo e(route('esop-calculator.app')); ?>" class="esopl-btn esopl-btn-primary"><i class="fas fa-calculator"></i> Launch the Calculator</a>
</div>

<script>
(function(){
    'use strict';
    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function rafThrottle(fn){
        var ticking = false;
        return function(){
            var args = arguments, ctx = this;
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(function(){ fn.apply(ctx, args); ticking = false; });
        };
    }

    // Scroll progress bar
    var bar = document.getElementById('esoplScrollBar');
    var updateBar = rafThrottle(function(){
        var d = document.documentElement;
        var max = d.scrollHeight - d.clientHeight;
        if (bar) bar.style.width = (max > 0 ? (d.scrollTop / max) * 100 : 0) + '%';
    });
    window.addEventListener('scroll', updateBar, {passive:true});
    updateBar();

    // Header shrink-on-scroll shadow
    var header = document.getElementById('esoplHeader');
    var updateHeader = rafThrottle(function(){
        if (header) header.classList.toggle('is-scrolled', window.scrollY > 8);
    });
    window.addEventListener('scroll', updateHeader, {passive:true});
    updateHeader();

    // Reveal on scroll
    var revealEls = Array.prototype.slice.call(document.querySelectorAll('[data-reveal]'));
    if (prefersReduced || !('IntersectionObserver' in window)) {
        revealEls.forEach(function(el){ el.classList.add('in'); });
    } else {
        var io = new IntersectionObserver(function(entries){
            entries.forEach(function(entry){
                if (entry.isIntersecting) { entry.target.classList.add('in'); io.unobserve(entry.target); }
            });
        }, {threshold:0.12, rootMargin:'0px 0px -6% 0px'});
        revealEls.forEach(function(el){ io.observe(el); });
    }

    // Animated stat counters
    function animateCount(el){
        var target = parseFloat(el.dataset.count || '0');
        var duration = 1100;
        var start = null;
        function step(ts){
            if (start === null) start = ts;
            var p = Math.min((ts - start) / duration, 1);
            var eased = p === 1 ? 1 : 1 - Math.pow(2, -10 * p);
            el.textContent = Math.round(eased * target);
            if (p < 1) requestAnimationFrame(step);
            else el.textContent = target;
        }
        requestAnimationFrame(step);
    }
    var counters = Array.prototype.slice.call(document.querySelectorAll('[data-count]'));
    if (counters.length) {
        if (prefersReduced || !('IntersectionObserver' in window)) {
            counters.forEach(function(el){ el.textContent = el.dataset.count; });
        } else {
            var cio = new IntersectionObserver(function(entries){
                entries.forEach(function(entry){
                    if (entry.isIntersecting) { animateCount(entry.target); cio.unobserve(entry.target); }
                });
            }, {threshold:0.6});
            counters.forEach(function(el){ cio.observe(el); });
        }
    }

    // Sticky mobile CTA — show once the hero has scrolled past, hide near the final CTA
    var sticky = document.getElementById('esoplStickyCta');
    var hero = document.getElementById('esoplHero');
    var finalCta = document.querySelector('.esopl-final-cta');
    var updateSticky = rafThrottle(function(){
        if (!sticky || !hero) return;
        var y = window.scrollY;
        var heroBottom = hero.offsetTop + hero.offsetHeight;
        var nearFinal = finalCta && (y + window.innerHeight > finalCta.getBoundingClientRect().top + window.scrollY + 40);
        var show = y > heroBottom - 160 && !nearFinal;
        sticky.classList.toggle('is-visible', show);
        sticky.setAttribute('aria-hidden', show ? 'false' : 'true');
    });
    window.addEventListener('scroll', updateSticky, {passive:true});
    updateSticky();
})();
</script>

</body>
</html>
<?php /**PATH C:\Users\hrith\ritik\Devmantranew\resources\views/frontend/esop-calculator/landing.blade.php ENDPATH**/ ?>