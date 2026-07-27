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
artifact (see the "Reference: Gates, Checkpoints, and the Artifact Layout" section below for the exact layout of
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

See the "Reference: Gates, Checkpoints, and the Artifact Layout" section below for the full artifact layout and
the exact checkpoint-writing calls for all four gates.

## Delivery

Final message: the rendered file via `present_files`, mode used
(fast/full), providers actually used per capability (with cost), the
project id / folder path so the user can find the checkpoints, and a note
that a real local OpenMontage/Backlot session can open the same project by
id. Offer the `youtube-seo` skill afterward if relevant — don't run it
unasked.

---

# Reference: Gates, Checkpoints, and the Artifact Layout

Concrete mechanics for the four gates in SKILL.md. Read
`skills/meta/checkpoint-protocol.md` inside `video/OpenMontage` first — this
file only adds the Cowork-specific pieces (artifact rendering, provider
status caching); it does not restate the full protocol.

## Project init (once, before Gate 1)

```python
import sys; sys.path.insert(0, ".")
from dotenv import load_dotenv
load_dotenv(".env")
from lib.checkpoint import init_project

init_project("<project-slug>", title="<human title>", pipeline_type="animated-explainer")
```

Use a short slug derived from the brief (e.g. `esop-calculator-reel`). This
creates `projects/<project-slug>/` and `project.json` — required before any
checkpoint write, and what a real Backlot board needs to list the project.

## Writing a checkpoint

```python
from lib.checkpoint import write_checkpoint

write_checkpoint(
    pipeline_dir,        # PROJECTS_DIR from lib.checkpoint, or the repo's projects/ path
    project_name,        # the slug used in init_project
    stage,                # "script" | "scene_plan" | "asset" | "edit" | "compose" | ...
    status,               # "in_progress" | "awaiting_human" | "completed"
    artifacts,            # {"script": {...}} — schema-validated against schemas/artifacts/<name>.schema.json
    metadata=None,        # cost snapshot, provider_status, partial_progress, etc.
)
```

`write_checkpoint` enforces the gate itself — it raises if you try to write
`status="completed"` for a gated stage without a prior human-approved
`awaiting_human` checkpoint. Do not work around this; if a stage must skip
its gate, that has to be an explicit `decision_log` entry from the user,
recorded before the write, not a code path that bypasses the check.

## Gate 1 — Script + block breakdown

**Checkpoint:** `stage="script"` (and `"scene_plan"` once written),
`status="awaiting_human"`, artifacts validated against
`schemas/artifacts/script.schema.json` and `scene_plan.schema.json`.

**Artifact contents (Cowork `create_artifact`):**
- Title, one-line logline, target duration, mode (fast/full).
- Full narration script, block by block.
- Per-block scene description (what Gate 3 will actually generate).
- No cost line yet — this gate is free.

**Chat message after rendering:** short summary + "Reply approved to move
to style and voice, or tell me what to change."

## Gate 2 — Style + voice pick

Before this gate, populate `projects/<id>/metadata/provider_status.json`
per the status-probe rules in SKILL.md. Structure:

```json
{
  "checked_at": "<iso timestamp>",
  "providers": {
    "elevenlabs_tts": {"status": "broken", "reason": "402 Payment Required — account has no credit"},
    "openai_tts": {"status": "unverified", "reason": "key present, not test-called"},
    "pexels_video": {"status": "broken", "reason": "401 Unauthorized — key invalid or expired"},
    "heygen_avatar": {"status": "unverified", "reason": "key present, not test-called"},
    "higgsfield": {"status": "confirmed", "reason": "MCP connected, 552 credits available", "opt_in_only": true}
  }
}
```

**Artifact contents:** for each capability the project needs (narration
voice, visual style/footage source, avatar if applicable), a small table:
provider name, status badge, estimated cost (`tool.estimate_cost(inputs)`
where available), one line of reasoning for the recommended pick — with
Higgsfield always listed but never pre-selected. Style-key image (or
reference footage sample) shown once generated.

**Chat message:** state exactly which providers will be used if approved
as-is, and the total estimated cost. "Reply approved to generate clips and
audio, or tell me which provider to swap."

## Gate 3 — Clip + audio contact sheet

**Checkpoint:** `stage="asset"`, artifacts validated against
`schemas/artifacts/asset_manifest.schema.json`. Write `in_progress`
checkpoints as each block's assets complete (resume support), per the
Intra-Stage Checkpointing section of the protocol.

**Artifact contents:** grid, one row per block — thumbnail/clip preview
link, provider used, prompt (collapsed/expandable), **measured** clip
duration, **measured** voice-take duration, a naive drift indicator (will
be recomputed properly at Gate 4). Running cost total.

**Chat message:** "All N blocks generated, total spent so far: $X. Reply
approved to review timeline sync, or tell me which block to redo."

## Gate 4 — Timeline sync review

This is the direct answer to the sync complaint — do not skip the
measurement step even under time pressure.

**Compute per block:**

```python
drift = abs(video_duration - audio_duration)
```

using real measured durations (ffprobe on the actual rendered file, or the
provider job's own duration field — never the value that was requested).

**Artifact contents:** a horizontal per-block timeline — two bars per
block (video duration, audio duration) drawn to scale, drift value called
out in a warning color above the 1.5s threshold, and editable fields for:
offset (seconds), trim in/out, speed multiplier (clamped ~0.85–1.15 before
flagging "will sound rushed/slow"). A live-recomputed total runtime as
values change. This can be static (recompute happens on your next message
after the user states new values in chat) since the artifact has no
callback into tool calls — say so plainly in the artifact itself: "edit and
tell me the new numbers, or tell me which fix to apply and I'll recompute."

**Checkpoint on approval:** write `edit_decisions` per
`schemas/artifacts/edit_decisions.schema.json` — `cuts[]` for each video
block (`id`, `source`, `in_seconds`, `out_seconds`, `speed`),
`audio.narration.segments[]` for each voice take (`asset_id`,
`start_seconds`, matching the approved offset). `status="completed"` only
after the human-approval write-back per protocol.

**Chat message:** confirm the final per-block numbers, then proceed
directly to compose (no separate gate for compose/render itself — the
timeline approval is the last creative gate; rendering is mechanical).

## Compose (after Gate 4, no further gate)

```python
# tools/video/video_compose.py routes by edit_decisions.render_runtime
# (Remotion / HyperFrames / FFmpeg) — do not hardcode a runtime choice;
# read what the edit stage set, or default per skills/core/hyperframes.md
# guidance if the project didn't specify one.
```

Poll to completion, run whatever self-review checks the compose-director
skill specifies (ffprobe validation, frame sampling, audio level check),
write `render_report`, then deliver.
