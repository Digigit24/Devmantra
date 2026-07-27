# Vox-Style Motion Graphics Explainer (Higgsfield MCP)

Turn one request — a topic, or nothing at all — into a finished Vox-style
explainer video: bold editorial collage visuals, a documentary narrator, tight
fact-driven writing, one final MP4. The pipeline runs on the Higgsfield MCP
`video-explainer` workflow with the **Mixed Media** preset as the default look.

**The Vox look, in one line:** archival photo cutouts with paper edges drifting
over flat color fields and textured paper, halftone accents, hand-drawn circles
and underlines, abstract growing charts and maps, snappy camera pushes — a
motion-designed magazine spread, never a filmed scene. Motion reads as **brisk,
decisive, and stable** — never a slow drift or a wobbly handheld feel (see
Motion vocabulary below).

**Two house styles** — pick per brief, each with its own reference file:

- **Mixed Media collage** (default; the "Reference: Vox Prompt Templates (Mixed Media)" section below) — flat, bright,
  playful-editorial; no text in clips. Best for data stories, "why X"
  explainers, shorts.
- **Paper-diorama documentary** (the "Reference: Paper-Diorama Documentary Style" section below) — cinematic sepia
  newsprint dioramas, censor-bar cutout figures, one burnt-orange accent,
  letterpress text ON props, fake-oner FPV camera. Best for geopolitics,
  money, power, anything the user wants "cinematic" or high-energy. Comes
  with a ready style key and a registry of reusable prop assets.

## Operating mode

This skill is built to run **hands-off**. The user delegates everything:
topic discovery, script, voice, assets, assembly. That means:

- If the user gave a topic, angle, duration, voice preference, or **brand
  colors/palette** — honor it. Everything they didn't specify, decide
  yourself using the defaults below — **except brand palette, which is
  never silently defaulted** (see Phase 0 below).
- Right before submitting the first **paid** generation, post one short plan
  message (topic, angle, block count, voice, palette, estimated credits) so
  the user can interrupt — then **proceed immediately without waiting for
  approval**, unless the user asked to be consulted.
- Never stop mid-pipeline to ask a question you can answer with a default.
  Delivering loose clips instead of an assembled MP4 is a failure.

Deviation note: the underlying Higgsfield `video-explainer` workflow asks the
user to pick style and voice interactively. This skill intentionally
pre-answers those questions (Mixed Media preset, auto-picked documentary
voice) because the user has delegated the whole run. Only show the preset
gallery / voice picker if the user explicitly asks to choose.

## Phase 0 — Brand palette (ask before generating anything)

Before Phase 1 (style key), check whether the user has already told you a
brand palette, brand colors, logo colors, or "use my brand" anywhere in the
conversation or attached files this session.

- **Palette already known** → use it. Treat it as the dominant color system
  for the entire video: state explicitly which color is the light/background
  tone and which is the accent, and roughly what share of the frame each
  should occupy if the user specified that (e.g. "mostly light, accent at
  20-30%"). Carry the exact hex values into the STYLE KEY prompt.
- **Palette not known and this is clearly for a named brand/company/product**
  → ask a short clarifying question before generating the style key (e.g.
  "What's your brand palette — primary color(s) and roughly light or dark
  background? Any specific fonts I should keep in mind for on-screen feel,
  even though clips carry no readable text?"). Do not guess a company's
  colors from memory.
- **Palette not known and this is a generic/topical explainer with no brand
  attached** → no need to ask; fall back to the classic multi-color Vox
  editorial palette (warm yellow, off-white paper, deep navy, coral red)
  described in the "Reference: Vox Prompt Templates (Mixed Media)" section below.

Once resolved, carry the palette into Phase 1's STYLE KEY prompt and into
every block's STYLE REFERENCE line for the rest of the run — never mix in
off-palette colors (yellow/navy/coral) once a custom brand palette is active.

## Defaults

| Setting    | Default                                | Override when… |
|------------|-----------------------------------------|----------------|
| Style      | Mixed Media preset, id `80e4dd7b-cd65-42d4-b191-b58d62558602` (recolored to brand palette if one is active — see Phase 1) | user names another preset or supplies reference images |
| Palette    | Ask if brand-attached and unknown (Phase 0); classic Vox multi-color palette otherwise | user gives brand colors |
| Aspect     | 9:16 vertical (shorts/TikTok/Reels) — pass `aspect_ratio: "9:16"` explicitly on every clip; the style key alone does NOT set framing (verified: `gemini_omni` defaults to 16:9 regardless of a vertical key) | user says YouTube/landscape → 16:9 |
| Duration   | 1 minute → N = 6 blocks (N = minutes × 6, each block = one 10s clip) | user gives a length (1–10 min) |
| Character  | Faceless (no mascot)                   | user asks for a host/mascot |
| Language   | English narration                      | user asks otherwise (prompts stay English regardless) |
| Voice      | Auto-pick a deep, measured documentary narrator from `list_voices` | user wants to choose → show the picker and wait |
| Motion     | Brisk, decisive, stable — quick ease-out entrances, no drift, no wobble, no lingering static holds (see Motion vocabulary) | never — this is a hard style rule, not a per-project default |
| Captions   | **OFF.** This skill no longer burns captions. Captioning is handled by a separate, dedicated captioning skill — do not pass `subtitles` to `explainer_video`. | user explicitly says "no dedicated captioning skill, burn captions here" — if so, use `font: "anton"` and warn it's 0.05 credit/block |

## Story engine (what separates a banger from postcards)

A sequence of pretty, disconnected scenes reads as a museum slideshow. What
makes the reference-grade videos hit:

- **One through-line object.** A single physical metaphor travels through
  EVERY block and escalates (a burning fuse crossing all scenes, a balloon
  being pumped toward a needle). The viewer holds it the whole runtime; the
  finale pays it off. Design this object before writing any block.
- **A question hook, answered last.** Put the question ON a prop's shape or
  pose (never literal letters) in block 1 or the finale; the narration
  withholds the answer until the kicker.
- **Fake-oner.** Write every clip as one continuous FPV camera move that
  begins and ends in full motion — hard cuts between blocks then read as one
  unbroken shot. Parallax layering, no frame-matching needed.
- **An impact every ~2-3 seconds** (slam, stamp, shockwave, snap) — faster
  and more frequent than a slow documentary pace — and at least one quick
  speed-up beat per block. Alternate extreme macro and wide diorama;
  whiplash the scale (giant face → ant-sized figures → colossal prop). Every
  beat should read as intentional and locked-in, never a soft meander.
- **One reveal shot** the whole video is remembered by (crowd arranged into
  a meaningful silhouette, a reveal only visible when the camera cranes up).

## Pipeline

| Phase | What happens | Tools |
|---|---|---|
| T Topic | use the given topic, or research what's trending and pick one | WebSearch / WebFetch |
| R Research | gather verified facts, numbers, names; keep a Sources list | WebSearch / WebFetch |
| 0 Brand | resolve brand palette — ask if unknown and brand-attached (see above) | reasoning / one clarifying question (free) |
| 1 Style key | resolve the Mixed Media preset into a style-reference media_id (free), or generate a custom brand-palette key | `resolve_explainer_preset` or `generate_image` |
| 2 Script | N narration blocks, Vox formula, ~20–24 words each | reasoning (free) |
| 3 Block prompts | N labeled video prompts in the Vox visual language | reasoning (free) — templates in the "Reference: Vox Prompt Templates (Mixed Media)" section below |
| 4 Clips | N × 10s clips, style key attached to every one | `generate_video` (`gemini_omni`) |
| 5 Voice | one narrator, N takes, same voice_id on every block | `list_voices` + `generate_audio` (`seed_audio`) |
| 6 Assemble | stitch clips + takes into one MP4 — **no subtitles** | `explainer_video` |

Read the "Reference: Vox Prompt Templates (Mixed Media)" section below before Phase 1 — it holds the style
descriptor, the block-prompt template with worked examples, and the negative
list. Phases T, R, 0, 2, 3 are free; 1 (custom-palette branch), 4, 5 cost
credits.

**Job model:** every `generate_*` call submits an async job and returns a job
id. Poll with `job_status { jobId, sync: true }` where the server exposes it;
if not, check completion via the tool-result/notification stream or
`show_generations`. A completed job id is reused directly as a
`medias[].value` on later generations and as `video`/`audio` in Phase 6 —
you rarely need the raw URLs. Use `get_cost: true` on one `generate_video`
call before Phase 4 to estimate total spend for the plan message.

## Phase T — Topic

**Topic given** → use it, go to Phase R.

**No topic** → find one that's popular *right now*:

1. WebSearch 2–3 angles: `trending topics this week <current month year>`,
   `most searched questions this week`, plus one vertical the user cares
   about if known (tech, money, science, sports…).
2. A good Vox-able topic has: a **"why/how" question** at its core, at least
   one **surprising number or reversal**, strong **visual potential** (maps,
   charts, objects, archival imagery), and broad appeal. "Why X is suddenly
   everywhere", "The real reason X costs so much", "How X quietly changed Y"
   are the shape you want.
3. Avoid: breaking tragedies and active disasters, raw celebrity gossip with
   no data angle, anything you can't verify with two independent sources.
4. Pick the strongest candidate yourself and state it in the plan message
   (with one runner-up in case the user swaps).

## Phase R — Research

Never script from memory. WebSearch the chosen topic, fetch the 2–3 best
sources, and collect: the hook stat, 3–5 concrete facts/numbers/dates, the
counterintuitive turn, and who/what/where specifics that make blocks vivid.
Cross-check every number against a second source. Keep a short **Sources**
list and include it in the final delivery message. No fabricated quotes, no
invented numbers — a vague true line beats a specific false one.

## Phase 1 — Style key

**Default (9:16, no brand palette active):** call `resolve_explainer_preset`
with preset id `80e4dd7b-cd65-42d4-b191-b58d62558602` (Mixed Media). The
returned `media_id` IS the style key — attach it as `medias: [{ value:
<media_id>, role: "image" }]` on **every** clip in Phase 4. This branch is
free. The preset image is 9:16, and `gemini_omni` inherits framing from the
key, so the video comes out vertical.

**Brand palette active (from Phase 0):** skip the stock preset — generate a
custom style key with `generate_image`, model `nano_banana_pro`,
`aspect_ratio: "9:16"` (or `"16:9"` if requested), describing the Vox
collage vocabulary but recolored: state the light/background tone and the
accent color explicitly (with hex values), state the accent's approximate
frame coverage if the user specified one, and explicitly exclude the
classic Vox palette colors that aren't part of the brand ("no yellow, no
navy, no coral" etc. as applicable). This costs one image generation.

**16:9 requested, no brand palette:** the stock preset key would force
vertical framing, so generate a landscape Vox-style key with
`generate_image`, model `nano_banana_pro`, `aspect_ratio: "16:9"`, using the
STYLE KEY prompt in the "Reference: Vox Prompt Templates (Mixed Media)" section below. Poll to completion; that
job id becomes the style key.

## Phase 2 — Script (Vox formula)

Write N blocks, labeled `Block 1 … Block N`, one per 10s clip. Each block is
**~20–24 words** (~8–9s spoken; hard ceiling ≈9.5s — a slight overrun gets
pitch-safe speed-up at assembly, a big one needs a shorter line). Plain
spoken text only: no stage directions, no parentheticals, numbers spelled
out ("seventy percent", "twenty twenty-four"). Prefer single flowing
sentences over choppy comma-heavy ones — narrator voices pause at every
period, so fewer sentence breaks means more predictable pacing.

Structure the N blocks like a Vox piece:

- **Block 1 — cold open.** The most surprising fact or question, stated
  flat. No greeting, no "in this video".
- **Block 2 — stakes.** Why this is weird or why it matters to the viewer.
- **Middle blocks — evidence.** One idea per block, each anchored to a
  concrete number, date, place, or comparison from Phase R. Escalate.
- **Block N−1 — the turn.** The counterintuitive reveal, the "but here's
  the thing".
- **Block N — resolution + kicker.** Land the answer, end on a line that
  reframes the opening fact.

Tone: curious, precise, a little wry. Short declarative sentences. The
narrator explains, never hypes.

## Phase 3 — Block prompts

Write N video prompts, one per block, each visually translating its
narration line into the Vox collage language. Use the exact labeled template
and the scene vocabulary in the "Reference: Vox Prompt Templates (Mixed Media)" section below. Rules that are easy
to forget:

- **No readable text anywhere in the clips.** AI-generated lettering
  garbles; typography beats are expressed as abstract highlight bars,
  redaction blocks, circles and underlines instead. There are no captions
  burned at assembly either now — this skill ships silent-of-text video,
  full stop.
- **No one speaks on screen.** The `AUDIO:` line is ambient/SFX/music only;
  narration is added per block at assembly.
- **Motion must read as brisk, decisive, and stable — never slow or
  wobbly.** Every MOTION line should describe quick ease-out entrances,
  confident snaps into place, and a camera that is either locked or moving
  with clear, fast intent (a decisive push-in, a quick whip-pan) — not a
  gentle drift, not a lingering static hold, not handheld shake. See the
  MOTION guidance in the "Reference: Vox Prompt Templates (Mixed Media)" section below.

## Phase 4 — Clips

**Engine:** `gemini_omni` — 30 cr/clip, fast, the workhorse for Mixed Media
collage.

Submit N `generate_video` jobs — style key on every single one:

```
generate_video
  model: "gemini_omni"
  prompt: <Block N video prompt>
  duration: 10
  resolution: "720p"
  medias: [ { value: "<style key media_id or job id>", role: "image" } ]
```

Pass `aspect_ratio` explicitly ("9:16" or "16:9") — despite what the base
workflow claims, the key image does not reliably set framing; a real run with
a 9:16 key still produced 16:9 clips. Also expect the server to intercept the
first submission with a `preset_recommendation` notice (it pattern-matches
collage prompts to its "3D RENDER" preset): decline it by resubmitting with
`declined_preset_id` from the notice's `retry_literal_with` — never accept a
photoreal/3D preset. Submit in batches, record every job id against its block
number, re-submit only failed blocks. If a clip renders photoreal/live-action,
strengthen the STYLE and NEGATIVE lines and re-run that block — two identical
failures means the prompt is wrong, not the seed. If a clip's motion comes
back slow/drifty/wobbly instead of brisk and stable, add "brisk, decisive,
locked camera, no drift, no wobble, no handheld shake" to that block's
NEGATIVE and STYLE lines and re-run it. If `gemini_omni` is rejected, confirm
the current video model id with `models_explore(type: 'video')`; never
silently switch to a photoreal model.

## Phase 5 — Voiceover

1. Call `list_voices`. Auto-pick a **deep, measured, documentary** narrator
   (calm authority, not ad-read energy); note its exact `voice_id` and
   `voice_type`. Only show the picker and wait if the user asked to choose.
2. One `generate_audio` call per block, same voice every time:

```
generate_audio
  model: "seed_audio"
  voice_type: "<preset|element>"
  voice_id: "<from list_voices>"
  prompt: "<Block N line, plain text>"
```

Fitting knobs if a take runs long: `speech_rate` (-50..100) up a notch, or
shorten the line and re-voice. Record each take's job id against its block.

**Verify every take's real duration before assembling** — read `durationSec`
from the completed job (`show_generations`) and target **9.0–10.5s** per
take. The assembler centers short takes (a 7s take starts ~1.5s late — reads
as desync) and speed-compresses long ones (a 13s take gets squeezed 30% —
reads as rushed). TTS pacing is wildly unpredictable: narrator voices pause
~0.7s at every period, so choppy name-heavy lines read ~1.8 words/s while
one flowing comma-joined sentence reads ~2.5 words/s — the same word count
can differ by 4+ seconds. Prefer single flowing sentences, expect 1–2
re-voice rounds, keep the best take per block; a slight overrun beats a
late start.

## Phase 6 — Assemble (automatic, mandatory, no captions)

The moment all clips and takes are done, assemble — in the same run, without
being asked:

Before assembling, read the finished clips' actual `width`/`height` from
their job records and pass THOSE — if the clips rendered in a different
aspect than planned, the assembly must match the clips, not the plan.

```
explainer_video
  params:
    width: 720            # 1280 for 16:9 — always the clips' real size
    height: 1280          # 720 for 16:9
    items:
      - { video: "<clip 1 job id>", audio: "<voice 1 job id>" }
      …
      - { video: "<clip N job id>", audio: "<voice N job id>" }
```

**Do not pass `subtitles`.** Captioning is out of scope for this skill —
it's handled by a separate, dedicated captioning skill the user runs
afterward if they want captions.

Blocks are fixed 10s windows: short takes are centered, slight overruns are
sped up pitch-safely, video is never stretched — total = N × 10s exact.
Poll the returned job to completion, then present the final MP4 with
`job_display`.

## Delivery

Final message: the video, the topic + angle + palette used in one or two
sentences, the full script (so the user can reuse it), and the Sources list.
Mention that captions were intentionally skipped and can be added with the
dedicated captioning skill. Then offer — don't run unasked — the
`youtube-seo` skill for titles/description/tags if the video is headed to
YouTube.

## Failure handling

- Clip drifts off-style or off-palette → re-attach the key, tighten
  STYLE/NEGATIVE (include exact palette hex values again), rerun that block
  only.
- Clip motion reads slow, drifty, or wobbly → add brisk/stable/no-drift
  language to STYLE and NEGATIVE, rerun that block only.
- Voice take > ~9.5s → shorten the line or raise `speech_rate`, re-voice
  that block only.
- `voice_id`/`voice_type` errors → you skipped `list_voices`; call it and
  reuse one exact pair everywhere.
- Assembly rejects an id → the job isn't terminal yet; poll it, then retry
  assembly with all N items in order. Block N's audio always lands on clip N.
- Video job status `failed` or `nsfw` with no error text → moderation, not
  bad luck. Named public figures and very close-up recognizable faces are
  the most common trigger — route those blocks to a mid-shot/abstract
  description instead.
- User wants isolated deliverables (SFX-only track, single clips, stills):
  raw clips have no voice — narration exists only in the assembly, so
  extracting per-clip audio/frames locally (ffmpeg) yields clean voiceless
  assets.

---

# Reference: Vox Prompt Templates (Mixed Media)

Everything here feeds Phases 1 and 3 of the pipeline. The goal of every
prompt is the same: a **motion-designed editorial collage** — the visual
grammar of a Vox video — never a filmed scene. Motion is **brisk, decisive,
and stable** throughout — see the Motion vocabulary section before writing
any MOTION line.

## The visual vocabulary

Draw scenes from this palette of devices. Every block should combine two or
three of them, chosen to literally illustrate that block's narration line.

- **Archival cutouts** — photographic subjects (people, buildings, objects)
  cut out with rough white paper borders, snapping crisply into place over
  flat backgrounds. Photos live *inside* the collage as elements; the frame
  as a whole is never live-action.
- **Flat color fields** — bold editorial backdrops. When no brand palette is
  active: warm yellow, off-white paper, deep navy, coral red — one dominant
  color per block, consistent accent palette across the whole video. When a
  brand palette is active (see Phase 0 in SKILL.md): use the brand's exact
  colors only, stated as light/background vs. accent, and honor any stated
  accent-coverage ratio.
- **Paper & print textures** — grain, halftone dots, newsprint, torn edges,
  tape strips, subtle drop shadows that sell the "cut and pasted" feel.
- **Hand-drawn annotations** — marker circles snapping into place around a
  cutout in one confident stroke, underlines whipping in fast, arrows
  connecting elements, scribbled emphasis strokes. (Abstract strokes only —
  never letters or words.) Draw-on strokes should complete quickly, not
  linger mid-draw.
- **Abstract data graphics** — bar charts snapping to height, line graphs
  drawing themselves upward at a brisk clip, pie slices separating cleanly,
  unlabeled — pure shape and motion, no numerals, no axis text.
- **Maps** — flat stylized maps with animated routes, pulsing location dots,
  regions filling with color.
- **Redaction & highlight blocks** — solid color bars sliding over areas
  with a quick snap, spotlight vignettes isolating one cutout while the rest
  dims fast.
- **Scale comparisons** — one object multiplying into rows, a small cutout
  next to a towering one, stacks growing in fast rhythmic pops.

## Motion vocabulary

Vox motion is **snappy, intentional, and locked-down** — never a slow drift,
never a soft meander, never handheld wobble. Every motion beat should read
as a confident, fast decision, not a gentle float.

- **Entrances:** quick ease-out pops with a slight overshoot-and-settle,
  landing within a beat — never a slow fade-in or gradual slide.
- **Camera:** either genuinely locked/static, or moving with clear fast
  intent — a decisive push-in, a quick whip-pan, a sharp page-flip cut
  between ideas. No slow drifting pans, no lingering static holds once the
  beat has landed, no handheld shake or wobble at any point.
- **Parallax:** collage layers can drift against each other for depth, but
  keep the drift subtle and background-only — the foreground subject that
  carries the beat should always feel locked and stable.
- **Rhythm:** something should always be moving, but only one thing should
  be *loud* at a time, and every loud beat should land fast — aim for a new
  impact roughly every 2-3 seconds rather than one slow build per 10s clip.
- **What to avoid explicitly:** slow zooms with no payoff, elements that
  drift into place rather than snap, cameras that wander, any hint of
  handheld shake, long static holds after a beat has already landed.

## STYLE KEY prompt (only for 16:9 runs with no brand palette — default 9:16 uses the preset)

Use with `generate_image`, model `nano_banana_pro`, `aspect_ratio: "16:9"`:

```
Editorial mixed-media collage style swatch, Vox-documentary motion graphics
aesthetic: flat warm yellow and off-white paper background with halftone dot
texture, archival photo cutouts with rough white paper borders, torn paper
edges and tape strips, hand-drawn black marker circles and arrows, bold flat
color blocks in navy and coral, subtle paper grain and drop shadows.
Abstract composition only — no characters, no objects with faces, no
letters, no words, no numbers. Non-photorealistic, no live-action, no
realism, no 3D render.
```

For a brand-palette run, replace the color language with the brand's exact
light/background tone and accent color (state hex values and, if given, the
accent's approximate frame coverage), and explicitly exclude any Vox default
colors that aren't part of the brand.

## STYLE tokens (used in every block prompt's STYLE REFERENCE line)

```
editorial mixed-media collage, archival photo cutouts with white paper
borders, flat bold color fields, halftone and paper grain textures,
hand-drawn marker annotations, brisk decisive motion-graphics animation,
locked or fast-intent camera work, non-photorealistic, no live-action
```

## Block prompt template

One per block, labeled, no timecodes:

```
Block {N}
STYLE REFERENCE: Match the attached style key EXACTLY — {STYLE tokens}.
SCENE: {the collage composition that illustrates this block's narration line:
which cutouts, which color field, which annotations/charts/maps}.
MOTION: {brisk entrance choreography + a camera that is either locked or
moves with fast clear intent (push-in, whip-pan) + what snaps/pops during
the shot — no drifting, no wobble, no lingering holds}.
AUDIO: {ambient bed + one or two paper/whoosh/tick SFX — no voice, no narration}.
NEGATIVE: readable text, letters, words, numbers, captions, subtitles,
watermark, logo, photorealism, live-action footage, 3D render, lip-sync,
talking characters, color drift, slow drifting camera, handheld shake,
camera wobble, lingering static holds, sluggish motion.
```

The NEGATIVE line is fixed — copy it verbatim into every block (append
brand-exclusion colors when a brand palette is active). The scene must
visualize the narration's *idea*, not depict someone saying it.

## Worked examples

Narration (Block 1): *"Every day, humans throw away enough food to feed two
billion people. And most of it never even reaches a plate."*

```
Block 1
STYLE REFERENCE: Match the attached style key EXACTLY — editorial mixed-media
collage, archival photo cutouts with white paper borders, flat bold color
fields, halftone and paper grain textures, hand-drawn marker annotations,
brisk decisive motion-graphics animation, locked or fast-intent camera work,
non-photorealistic, no live-action.
SCENE: A warm yellow paper background with halftone texture. Photo cutouts of
apples, bread loaves and a full dinner plate snap into a neat grid, then one
by one flip over and tumble downward off-frame into a torn-paper "bin" shape
at the bottom. A thick black marker circle snaps around the last remaining
plate in one confident stroke.
MOTION: Cutouts pop into the grid fast with a sharp overshoot-and-settle in
quick succession; camera holds locked as they begin tumbling, then a fast
decisive push-in on the last plate; the marker circle snaps in in a single
quick stroke, no drift, no wobble.
AUDIO: Soft paper rustles and quick whoosh ticks as cutouts flip and fall,
low minimal ambient pulse underneath — no voice, no narration.
NEGATIVE: readable text, letters, words, numbers, captions, subtitles,
watermark, logo, photorealism, live-action footage, 3D render, lip-sync,
talking characters, color drift, slow drifting camera, handheld shake,
camera wobble, lingering static holds, sluggish motion.
```

Narration (mid-video evidence block): *"In nineteen seventy, shipping one
container across the ocean cost ten times what it does today. Then the boxes
took over."*

```
Block 4
STYLE REFERENCE: Match the attached style key EXACTLY — editorial mixed-media
collage, archival photo cutouts with white paper borders, flat bold color
fields, halftone and paper grain textures, hand-drawn marker annotations,
brisk decisive motion-graphics animation, locked or fast-intent camera work,
non-photorealistic, no live-action.
SCENE: Deep navy background. A stylized flat world map snaps up from the
bottom in one fast beat; a coral dotted route draws itself quickly across the
ocean between two pulsing dots. An archival photo cutout of a cargo ship rides
along the route while an abstract bar chart on the right shrinks in sharp
rhythmic steps, its tallest bar collapsing to a stub on the last beat. Torn-
paper container shapes multiply into a growing stack with quick pops.
MOTION: Map snaps in fast with a hard overshoot-settle; route line draws left
to right at a brisk clip; camera does one decisive lateral whip to follow the
ship, then locks; bars shrink in sharp rhythmic steps, no easing drift;
container stack builds with fast rhythmic pops, no lingering holds.
AUDIO: Low ambient hum, soft tick per bar step, gentle ocean-paper whoosh —
no voice, no narration.
NEGATIVE: readable text, letters, words, numbers, captions, subtitles,
watermark, logo, photorealism, live-action footage, 3D render, lip-sync,
talking characters, color drift, slow drifting camera, handheld shake,
camera wobble, lingering static holds, sluggish motion.
```

## Script example (structure reference, 6 blocks = 1 minute)

Topic: "Why food waste is a supply-chain story"

```
Block 1  Every day, humans throw away enough food to feed two billion
         people. And most of it never even reaches a plate.
Block 2  We blame picky eaters and overfull fridges. But the biggest losses
         happen long before you ever see the food.
Block 3  Nearly forty percent of waste in poorer countries happens at the
         farm — crops rot waiting for trucks that never come.
Block 4  Rich countries flipped the problem. Their food survives the journey,
         then dies in supermarkets chasing perfect-looking produce.
Block 5  Here's the twist: fixing trucks and fridges would cut more waste
         than every household campaign combined.
Block 6  So the fight against food waste isn't in your kitchen. It's in the
         boring machinery that moves dinner around the world.
```

Notice the shape: cold-open stat → stakes → two evidence beats → the turn →
kicker that reframes Block 1. Each line is one idea, ~20–24 words, numbers
spelled out, no filler.

---

# Reference: Paper-Diorama Documentary Style ("WHO BLINKS?" playbook)

The second house style: a cinematic vintage paper-diorama documentary —
aged sepia newsprint worlds, censor-bar cutout figures, one burnt-orange
accent, letterpress prop typography, tungsten light, macro tilt-shift.
Born from reverse-engineering a reference video and battle-tested on the
"WHO BLINKS?" nuclear-treaty explainer. Use it when the brief says
cinematic / dramatic / investigative / "like the AI bubble video", or when
the topic is geopolitics, money, or power. Already fast-paced and
stable-camera by design (fake-oner, aggressive speed ramps) — no changes
needed for the brisk/stable motion rule. This style is exempt from the
brand-palette rule in Phase 0 of SKILL.md unless the user explicitly asks
to recolor it — its sepia/burnt-orange palette is the whole point of the
look. No captions are burned by this skill for this style either (props
carry their own letterpress labels, which is different from subtitles).

## Style key

Reusable style key already generated — attach its job id as an image
reference instead of regenerating:

```
STYLE KEY (diorama): 0561c26f-ad53-44da-815d-a8796d32d864
```

If a fresh key is ever needed, the prompt that produced it
(`generate_image`, `nano_banana_pro`, 16:9):

```
Cinematic vintage paper diorama style swatch, documentary collage
aesthetic: a miniature three-dimensional landscape built entirely from
aged sepia newspaper sheets and cardboard, torn edges, layered paper
canyon walls of old newsprint, monochrome archival photo cutouts of
anonymous suited figures standing among the paper structures with black
censor bars over their eyes, one dominant burnt-orange paper prop as the
single color accent against the sepia world, distressed letterpress print
texture, warm tungsten documentary lighting with deep shadows, macro
tilt-shift lens look with shallow depth of field, film grain and dust.
Handcrafted physical paper materials only — no letters, no words, no
numbers, no logos. Non-photorealistic scene content, no live-action
people, stylized paper craft world.
```

## STYLE tokens (open every clip prompt with these)

```
cinematic vintage paper diorama, aged sepia newsprint world, monochrome
halftone print, monochrome archival cutout figures with black censor bars
over their eyes, single burnt-orange accent, distressed letterpress,
warm tungsten light, macro tilt-shift shallow depth of field, film grain,
handcrafted stop-motion paper feel, non-photorealistic, no live-action
```

## Prop typography

Unlike the Mixed Media style (which bans all in-clip text), this style
CARRIES short letterpress text on props — that's its signature. One label
per scene, 1–2 words or a number ("EXPIRED", "1,000", "AUGUST",
"WHO BLINKS?"), always described as "distressed letterpress" on a torn
burnt-orange paper element, and always fenced in the negative:
`No text anywhere except "<LABEL>". No gibberish letters…`.

## Reusable prop assets (attach to keep objects consistent)

Generated 1:1 on plain backgrounds with the style key referenced — pass
alongside the style key as extra `image_references` and say "the X from
the reference image" in the prompt so the object doesn't morph between
clips:

| Prop | Job id |
|---|---|
| Paper nuclear missile (orange nose) | 0cb0ada4-5376-44fe-8950-822425825336 |
| Aged newspaper front page (censor-bar portrait) | 4cf403d1-6791-4661-af13-7d61330accdd |
| Powder keg "WHO BLINKS?" + coiled fuse | 68d803d1-3876-4410-9be4-9d800f6913be |
| Three leader cutouts (US red tie / RU / CN) | bd35a771-ddd9-456f-827a-18027293d1b0 |

New props: `generate_image` + `nano_banana_pro`, 1:1, style key attached,
"Single reusable prop asset, centered on a plain warm off-white paper
background… Nothing else in frame."

## Engine: seedance_2_0 (ref-grade)

```
generate_video
  model: "seedance_2_0"
  duration: 10
  resolution: "720p"        # 45 cr; 1080p = 90 cr
  mode: "std"
  aspect_ratio: "16:9"
  genre: "noir"             # consistent dark grade across clips
  generate_audio: true      # native SFX/drone sound design — keep it
  medias: [ { value: "<style key>", role: "image_references" }, …props ]
```

Seedance executes in-prompt cuts ("Shot 1 … Cut to shot 2 …"), reads
"speed ramp", "FPV", "whip pan" literally, and renders real fire/embers
beautifully. Its native audio (fuse crackle, drones, impacts) survives
assembly under the voiceover — design it in the prompt ("Sound design: …
No speech.").

gemini_omni (30 cr) is the fallback — notably it renders RECOGNIZABLE
politician likenesses from descriptions where seedance refuses (see
moderation notes).

## Fake-oner block prompt shape

Every clip = one continuous camera move; every boundary hidden in motion
blur so hard cuts read as a single unbroken shot:

```
<STYLE tokens> — shot as ONE continuous high-energy FPV camera move with
aggressive speed ramps.
The shot: [emerges from motion-blurred <previous element>] … [one impact
moment every ~3s: slam / stamp / shockwave / snap] … [ends fully
motion-blurred mid-<dive/whip/fall/flare>].
Sound design: [3–5 concrete diegetic events]. No speech.
No text anywhere except "<LABEL>". No gibberish letters, no captions,
no watermark, no photorealism, no live-action.
```

Worked example (opening block of "WHO BLINKS?"):

```
…shot as ONE continuous high-energy FPV camera move with aggressive speed
ramps.
The shot: from black, EXTREME slow-motion macro of a halftone-printed
human eye on newsprint as a thick black censor bar SLAMS down over it
like a guillotine, paper dust exploding on impact. Violent speed-ramp
pull-back reveals it is a giant newspaper front-page portrait of a
heavyset elderly American statesman with a long red tie; a gust RIPS the
page away revealing a second portrait — a compact stern Russian
statesman — ripped away again to a third — an East Asian statesman —
each rip faster than the last. The camera then DIVES at full speed into a
tearing gap in a giant aged treaty document as a burnt-orange stamp
punches the letterpress word "EXPIRED" across it; the lens plunges
through the torn fibers into swirling paper dust, ending mid-dive fully
motion-blurred.
Sound design: guillotine slam with dust whump, three accelerating page
rips, one massive stamp punch, rushing paper wind. No speech.
No text except "EXPIRED". …
```

## Moderation map (hard-won)

- **Named politicians in video prompts → job FAILS** on seedance (submits
  fine, dies at render). Names are fine in the TTS voiceover.
- **Close-up recognizable statesman faces** (even described, unnamed) →
  seedance fails; **gemini_omni renders them** — route face-forward
  blocks to gemini, keep the same style key.
- Mid-shot / full-body "leader with red tie / compact Russian / East
  Asian statesman" descriptions pass on BOTH engines. Censor bars over
  the eyes both sell the editorial look and defuse likeness issues.
- **"mushroom cloud" → nsfw flag.** Replace with another silhouette
  (hourglass worked and fit the deadline theme better).
- The server intercepts stylized prompts with `preset_recommendation`
  notices (3D RENDER / IN THE DARK / DROWN IN MUSIC / FREE FALL…). Never
  accept — resubmit with `declined_preset_id` from `retry_literal_with`.
  The id only suppresses that exact preset; a new prompt may trip a
  different one.

## Music

No standalone music model is usable through this MCP (sonilo_music is
game-pipeline-only — decline, don't substitute). Options: rely on
seedance's native drone/SFX bed (usually enough), or brief an external
generator (Suno/Udio) and mix locally. A measured brief that matched the
reference: ~46 BPM heartbeat pulse, sub-bass drone + low cello, almost no
highs, 8-second breathing swells, loud open, single climax at 80% of
runtime, rapid decay to silence.
