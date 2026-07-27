# OpenMontage Multi-Provider Pipeline (Cowork Edition)

Runs your real, locally-installed OpenMontage video pipeline from inside a
Cowork session — actual ElevenLabs / HeyGen / stock-footage (Pexels /
Pixabay / Unsplash) / OpenAI / Google providers, using OpenMontage's own
tool registry, stage-director skills, artifact schemas, and checkpoint
protocol — instead of a single-provider shortcut. Higgsfield is available
as one provider among many but is **never selected by default** — it is
opt-in only, because Higgsfield credits are being conserved right now. For
a fast, Higgsfield-only single-style reel with no provider choice, use the
`vox-motion-graphics` skill instead; this skill is for when the user wants
real multi-provider production, brand-flexible visuals, real footage, or
OpenMontage's fuller SOP.

**Where OpenMontage lives:** the user's local install is mounted at
`video/OpenMontage` (bash path `/sessions/<session>/mnt/video/OpenMontage`).
Everything in this skill reads and writes inside that folder — its
`tools/`, `schemas/`, `pipeline_defs/`, `skills/`, and `projects/`
directories are the actual source of truth, not something this skill
reinvents. Read the relevant OpenMontage file before acting on it; this
SKILL.md is a map, not a replacement for the underlying docs.

## Why this works from Cowork (and what it can't do)

Cowork's sandboxed shell has network egress to the real provider APIs and
can `pip install` OpenMontage's lightweight core dependencies
(no GPU/heavy-ML packages in its main `requirements.txt`). That means
actual tool execution — not just producing OpenMontage-shaped files — is
possible. What it can't do: keep OpenMontage's real local Backlot web board
(`python -m backlot open`) running and visible to the user across turns, or
drive the separate `designers-backlot` Electron app. This skill's Cowork
artifact stands in for that board on this surface. Checkpoints are still
written in OpenMontage's canonical format and location, so if the user ever
runs real OpenMontage locally via Claude Code/Cursor and points it at the
same `projects/<id>/` folder, it picks the project up natively — this
skill never diverges from the real schema to make its own life easier.

## One-time-per-session setup

Before the first tool call, from `video/OpenMontage`:

```bash
pip install pyyaml pydantic jsonschema python-dotenv Pillow numpy requests \
  google-auth google-genai openai --break-system-packages
```

Then, in every Python invocation this session, load env vars before
importing any tool:

```python
import sys; sys.path.insert(0, ".")   # run with cwd = video/OpenMontage
from dotenv import load_dotenv
load_dotenv(".env")
```

Do this once per session (pip installs persist for the session; `.env`
must be reloaded per Python process since each bash call is independent).

## Provider status — check before offering, never assume

OpenMontage's tools declare `get_status()` (env key present/absent) but
that only proves a key exists, not that the account is funded or the key
is valid. At the start of any project, and before showing the provider
picker in Gate 2, run a **cheap or free status probe** per candidate
provider and cache the result in
`projects/<id>/metadata/provider_status.json`:

- Key present via `get_status()` → tentatively "available".
- Where a free/near-zero-cost verification call exists, make it once per
  session and record the real result (this skill was validated this way:
  ElevenLabs returned `402 Payment Required` — key valid, account out of
  credits; Pexels returned `401 Unauthorized` — key itself invalid/expired).
  A provider that fails this check is marked **broken** and excluded from
  the picker with a one-line reason, not silently retried.
- Where no safe free check exists (e.g. paid image/video generation),
  trust `get_status()` but label the picker entry "unverified — will only
  be confirmed on first real use."
- Never spend a paid generation credit just to test availability.

Respect each tool's own `fallback_tools` chain (e.g. `elevenlabs_tts` →
`openai_tts` → `piper_tts`, defined in the tool file itself) when a
preferred provider is broken — offer the fallback in the picker rather than
silently failing the gate.

**Higgsfield exception:** even when available and funded, do not include
Higgsfield in the default-recommended slot of any picker. Only offer it
when the user explicitly names it (in chat or by picking it from the
picker's full list) — mirrors the user's standing instruction not to spend
Higgsfield credits without being asked. When the user does pick Higgsfield
for a capability, route the call through the connected Higgsfield MCP
(`mcp__666673db-6a08-402b-b5a1-077f278a7b1e__*`) rather than hitting its
raw API from Python — the MCP is already connected and billed.

## Modes: fast vs full

Ask which mode if it isn't obvious from the request (a quick reel vs. "do
the full production process"); default to **fast** for anything under ~90
seconds with no explicit request for deep research.

| Mode | Stages run | When |
|---|---|---|
| **fast** (default) | script → scene → asset → edit → compose | quick social clips, the user has a clear brief already, iterative/experimental work |
| **full** | research → proposal → script → scene → asset → edit → compose → publish, exactly as `pipeline_defs/animated-explainer.yaml` defines it | the user asks for the full pipeline, a bigger/higher-stakes production, or wants OpenMontage's research-grounded proposal step |

In full mode, follow `pipeline_defs/animated-explainer.yaml` and its
referenced stage-director skills (`skills/pipelines/explainer/*-director.md`)
literally — do not improvise stage order, `checkpoint_required`, or
`human_approval_default` values; they are binding per
`skills/meta/checkpoint-protocol.md`. In fast mode, still honor the same
checkpoint/approval semantics for the stages that do run, and still write a
`project.json` via `init_project()` at the start so the folder is a valid
OpenMontage project either way.

## The four gates (Cowork artifact = the Backlot board on this surface)

Every gate: write the checkpoint (`status="awaiting_human"`) exactly per
`skills/meta/checkpoint-protocol.md`, render the gate's content in a Cowork
artifact (see `references/gates-and-checkpoints.md` for the exact layout of
each), then **end your turn** with a short chat summary asking for
approval — same as real Backlot: "the board shows what's waiting and why,
you reply in chat." The artifact is read-only display, not a click-through
approver — approval is always a chat reply, because that's genuinely how
the underlying system works and this skill doesn't invent a capability the
artifact tool doesn't have.

1. **Script + block breakdown** — `script` + `scene_plan` artifacts, no
   generation yet, fully free to iterate.
2. **Style + voice pick** — one style/reference asset generated per visual
   provider chosen (flagged cost before it fires) + a text shortlist of
   voice/provider options per capability, each with provider name, real
   cost estimate (`tool.estimate_cost(inputs)`), status
   (confirmed/unverified/broken), and one line of reasoning. Nothing else
   generates until this gate is approved.
3. **Clip + audio contact sheet** — all clips/images and voice takes
   generated per the approved picks; contact sheet shows thumbnails,
   prompts, provider used, and **real measured durations** (ffprobe or the
   provider's own duration field — never the requested/target duration).
4. **Timeline sync review** — the direct fix for "audio and video don't
   sync": a per-block visual timeline comparing real clip duration vs. real
   audio duration, computed drift, and editable offset/trim/speed values.
   Only after this gate is approved does `edit_decisions` get written and
   compose run.

After Gate 4 approval: run the compose stage (`tools/video/video_compose.py`
routes to Remotion/HyperFrames/FFmpeg per `edit_decisions.render_runtime`),
poll to completion, present the final file, and write the `render_report`
checkpoint.

## Hard rule: no paid generation without gate approval

This applies to every provider, not just Higgsfield — ElevenLabs, HeyGen,
stock APIs that charge, OpenAI/Google image or video generation, all of it.
Nothing that spends real money fires until the relevant gate above has an
explicit "approved" reply from the user in chat. A prior broad approval
("go ahead and make the whole thing") does not cover later gates unless the
user says so explicitly — record that as a `decision_log` entry per the
checkpoint protocol if they do.

## Sync-drift fix (Gate 4 mechanics)

This is the concrete answer to "the audio and video don't fit perfectly":

1. After Gate 3, read the **actual** rendered duration of every clip and
   every voice take — never the value you requested.
2. Compute `drift = abs(video_duration - audio_duration)` per block.
3. If `drift <= 1.5s`: default to centering the shorter element, note it in
   the timeline as "auto-fine, no action needed."
4. If `drift > 1.5s`: flag it prominently, and offer concrete fixes in the
   artifact rather than silently averaging it away — re-voice at a
   different `speech_rate`, trim the clip's in/out points, apply a mild
   speed adjustment (never more than ~15% before it reads as rushed), or
   manually set an offset. Let the user edit the numbers directly; recompute
   total duration live as they do.
5. Only write `edit_decisions.json` (exact schema:
   `schemas/artifacts/edit_decisions.schema.json` — `cuts[].in_seconds` /
   `out_seconds` / `speed`, `audio.narration.segments[].start_seconds`) once
   the user has confirmed the timeline, not before.

See `references/gates-and-checkpoints.md` for the full artifact layout and
the exact checkpoint-writing calls for all four gates.

## Delivery

Final message: the rendered file via `present_files`, mode used
(fast/full), providers actually used per capability (with cost), the
project id / folder path so the user can find the checkpoints, and a note
that a real local OpenMontage/Backlot session can open the same project by
id. Offer the `youtube-seo` skill afterward if relevant — don't run it
unasked.
