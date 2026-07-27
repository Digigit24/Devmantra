# Vox-Style Prompt Templates

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
