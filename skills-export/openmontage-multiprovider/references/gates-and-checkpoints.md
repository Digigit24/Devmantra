# Gates, Checkpoints, and the Artifact Layout

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
