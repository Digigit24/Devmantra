# Master Prompt Chain — Laravel Client Sites

The single file you open at the start of every client engagement. It tells you (and Claude Code) which prompt to run next.

> **Source of truth:** `../CLIENT_BUILD_PLAYBOOK.md` for architecture decisions.
> **This file:** the runbook — which prompt to paste, when, and what comes out.

---

## 0. Decide once, up front

Answer these three questions before pasting anything. They route you down the right branch.

| # | Question | Answer A | Answer B |
|---|---|---|---|
| Q1 | Does the client have an existing website to preserve? | No → greenfield | Yes → migration |
| Q2 | Does the admin UI need to be brand-customised (logo, colors, custom widgets)? | Yes → custom Blade admin | No → Filament fast-path |
| Q3 | Does this client want a *fresh* starter, or do you already have a reusable template repo? | Fresh → run `01-build-starter-template.md` once, then reuse forever | Reuse → skip 01, clone existing template |

---

## 1. The chain (paste the prompts in this order)

```
┌─────────────────────────────────────────────────────────────────┐
│ ONE-TIME (per agency, not per client):                          │
│  └─ 01-build-starter-template.md                                │
│     Produces: digigit-laravel-template repo, cloneable forever  │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│ PER CLIENT:                                                     │
│                                                                 │
│  Q1=No (Greenfield)            Q1=Yes (Migration)               │
│  ───────────────────           ────────────────────             │
│  Clone template                Clone template                   │
│       │                              │                          │
│       │                        02-convert-html-to-laravel.md    │
│       │                              │                          │
│       ▼                              ▼                          │
│  ─────── REQUIREMENTS INTERVIEW (human gate) ───────            │
│       │                                                         │
│       ▼                                                         │
│  Q2=Yes? → 03-admin-custom-blade.md                             │
│  Q2=No?  → 03-admin-filament-fastpath.md                        │
│       │                                                         │
│       ▼                                                         │
│  Phase 5/6/7 from CLIENT_BUILD_PLAYBOOK.md                      │
│  (frontend wiring → SEO → forms → deploy)                       │
└─────────────────────────────────────────────────────────────────┘
```

---

## 2. The one-shot orchestrator prompt

Paste this **once per client** into Claude Code at the repo root. It runs the whole chain with human gates at the right moments.

```
You are the build orchestrator for a Laravel client site. Read these files
in order and follow them as a chain, stopping at every human-input gate:

  1. /prompts/MASTER_PROMPT_CHAIN.md   (this file — for routing)
  2. /CLIENT_BUILD_PLAYBOOK.md          (architecture rules)

Then ask me three routing questions using AskUserQuestion:

  Q1. Greenfield or migrating an existing HTML site?
  Q2. Custom-branded admin or Filament fast-path?
  Q3. Start from a fresh template or clone an existing template repo?

Based on my answers, load the matching prompt file from /prompts/ and
execute it phase by phase. At every "STOP" or "human-input gate" in those
prompts, stop and use AskUserQuestion to confirm before continuing.

Never:
- Skip the requirements interview.
- Invent the content model without my answers.
- Run database migrations without showing me the schema first.
- Commit a half-finished phase — every commit must leave the app bootable.

Always:
- Branch as `claude/<client>-phase-<n>-<short-slug>` per phase.
- Reference Devmantra files (app/Models/*, app/Http/Controllers/Admin/*,
  resources/views/admin/partials/_seo-panel.blade.php) as the canonical
  implementation when in doubt.
- After each phase, run `php artisan test` and `php artisan route:list`
  and report any failures before moving on.

Start by asking Q1, Q2, Q3 now.
```

---

## 3. Prompt index (this folder)

| File | When to use | Output |
|---|---|---|
| `MASTER_PROMPT_CHAIN.md` | Read first, every time. | Routing decisions. |
| `01-build-starter-template.md` | **Once.** Builds your agency's reusable Laravel template repo. | A `digigit-laravel-template` repo you clone per client. |
| `02-convert-html-to-laravel.md` | Client has an existing HTML/static site. | All `.html` migrated to Blade in `resources/views/frontend/`. |
| `03-admin-custom-blade.md` | Client paid for a fully-branded admin UI. | Custom Blade admin with section builder (Devmantra pattern). |
| `03-admin-filament-fastpath.md` | Client only cares about the public site; admin can be generic. | Filament v3 admin in 1/3 the time. |

---

## 4. Human-input gates — never skip these

In order, the moments where Claude Code stops and you decide:

1. **Routing (Q1/Q2/Q3)** — at the very start.
2. **Requirements interview** — fields per content type, section types per page, forms list, brand kit.
3. **Schema review** — after `php artisan migrate:fresh --pretend` Claude shows you the proposed schema. You approve.
4. **Section type registry** — the list of allowed section types per builder model. Hard to change later.
5. **JSON-LD payload** — paste the client's Organization schema and any custom types.
6. **`custom_head` policy** — confirm only admins can write to it; never accept it from public forms.
7. **Pre-deploy checklist** — APP_DEBUG, secrets rotated, robots.txt, GA/Pixel IDs.

If Claude tries to glide past any of these, paste:
> "Stop. We're at human-input gate <N>. Show me the proposed answer and wait for me to confirm."

---

## 5. Branch naming

```
claude/<client>-phase-0-bootstrap
claude/<client>-phase-1-requirements
claude/<client>-phase-2-migrate-html       (only if Q1=Yes)
claude/<client>-phase-3-models
claude/<client>-phase-4-admin
claude/<client>-phase-5-frontend
claude/<client>-phase-6-seo
claude/<client>-phase-7-forms-deploy
```

One PR per phase keeps reviews sane.

---

## 6. When the chain breaks

If a prompt produces garbage, do **not** paste a follow-up like "fix it". Instead:

1. Revert the phase commit.
2. Re-read the prompt — usually the requirements doc was incomplete.
3. Patch `docs/requirements.md` or `docs/data-model.md`, **then** re-run the phase prompt verbatim.

Prompts are versioned artifacts. Improve the prompt, not the patch.
