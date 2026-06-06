# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What This Is

Big Brother School Management System is a school management demo built for **George Orwell College of Arts and Technology** by **1984 Tech Solutions**. It is scoped to three modules only: Enrollment, Load Assignment, and Attendance Monitoring.

This project is primarily a **teaching vehicle** — a concrete, running system used to demonstrate the fundamentals of agentic workflow and prompt harness engineering to students and colleagues at FullScale. The goal is not production completeness; it is _"I could build this on Monday"_ clarity.

**Programs served:** BSCS, BSEMC, BSIS
**Out of scope:** grading, scheduling, billing, library, and all other modules not listed above.

---

## 🚦 Workflow — Read This First

Every task follows a single four-stage pipeline: **`/task → /spec → /implement → /commit`**. This is the atomic step shape for all work in this project and the same pipeline demonstrated to the audience.

```
  ┌──────────┐   clarify   ┌──────────┐   approved   ┌─────────────┐   tests pass   ┌─────────┐
  │  /task   │ ──────────► │  /spec   │ ───────────► │  /implement │ ─────────────► │ /commit │
  └──────────┘             └──────────┘              └─────────────┘                └─────────┘
```

### `/task`

Clarify the request — behavior, edge cases, dependencies, constraints, existing patterns. Summarize what will be done and ask: _"Is this correct? Should I proceed to write the spec?"_

### `/spec`

Write the spec to `docs/specs/<YYYY-MM-DD>-SPEC-<slug>.md`. Output: `Spec saved to docs/specs/SPEC-<slug>.md. Please review and reply 'approved' to proceed.`

**Gate:** user replies `approved` → move to `/implement`.

### `/implement`

Cut branch, implement, run targeted tests. Output: `Ready for acceptance testing.`

Require manual acceptance only when:

- The change affects a student-facing or faculty-facing UI flow
- The change crosses module boundaries (Enrollment ↔ Load Assignment ↔ Attendance)

### `/commit`

Write a conventional-commit message and commit. Output: summary of what shipped.

### Signal vocabulary

| Gate               | User says one of…                                     |
| :----------------- | :---------------------------------------------------- |
| After `/task`      | "yes", "correct", "proceed to spec", "write the spec" |
| After `/spec`      | "approved", "approve", "lgtm"                         |
| After `/implement` | any confirmation that implementation is done          |
| After `/commit`    | any confirmation that the commit is good              |

### When to skip the workflow entirely

Go straight to the change only for:

- Pure questions ("what does X do?", "where is Y defined?")
- One-line typo fixes in docs or comments
- Read-only exploration

---

## Repository Structure

```
software-engineering/
├── apps/                  # Executable projects (one app: the SMS)
│   └── big-brother/       # Laravel 13 application (to be scaffolded)
├── packages/              # Shared libraries (currently empty)
├── docs/
│   ├── prd.md             # Product requirements
│   ├── sdd.md             # System design (tech stack, architecture, DB rationale)
│   ├── data_model.json    # Authoritative table schema
│   ├── erd.png            # Entity relationship diagram
│   └── specs/             # Per-feature spec files (YYYY-MM-DD-SPEC-<slug>.md)
├── docker-compose.yml     # Postgres 16 service (host port 5433)
└── .claude/
    ├── commands/          # Custom slash commands (task, spec, implement, commit)
    └── rules/             # Coding, security, and testing standards
```

---

## App Structure (`apps/big-brother/`)

Each app under `apps/` is self-contained — its own `composer.json`, `package.json`, and dependencies. The single executable project here is a standard Laravel 13 application. Key directories once scaffolded:

```
apps/big-brother/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # One controller per module (Enrollment, LoadAssignment, Attendance)
│   │   └── Requests/       # FormRequest validation classes
│   └── Models/             # Eloquent models (one per entity in data_model.json)
├── resources/js/
│   └── Pages/              # Inertia React page components, grouped by module
│       ├── Enrollment/
│       ├── LoadAssignment/
│       └── Attendance/
├── routes/
│   └── web.php             # All routes (Inertia uses web middleware, not api.php)
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
└── tests/
    ├── Feature/             # Controller/feature tests (mirrors app/ structure)
    └── Unit/                # Service class unit tests
```

Other repo locations:

- `docs/` — source of truth for product and architecture decisions. Read before guessing.
- `docs/specs/` — approved and draft spec documents (one per feature/task).
- `.claude/commands/` — `/task`, `/spec`, `/implement`, `/commit` slash commands driving the four-stage pipeline.
- `.claude/rules/` — coding, security, and testing standards.

## Dev Commands

All commands run from inside `apps/big-brother/`. The database runs in Docker (started from the repo root); run it before `artisan serve`.

```bash
# Database — run from repo root
docker compose up -d          # start Postgres on host port 5433

# All commands below run from apps/big-brother/
php artisan serve
php artisan migrate
php artisan db:seed

npm run dev                   # Vite HMR — run alongside artisan serve
npm run build                 # production asset compile

php artisan test
php artisan test --filter=EnrollmentTest
php artisan test tests/Feature/EnrollmentTest.php
```

## Source-of-Truth Documents

| Question is about…                                   | Read                   |
| :--------------------------------------------------- | :--------------------- |
| Product scope, modules, programs, out-of-scope items | `docs/prd.md`          |
| System architecture, API surface, folder layout      | `docs/sdd.md`          |
| Entities, fields, relationships                      | `docs/data_model.json` |
| Per-feature specs                                    | `docs/specs/`          |

## Data Model — Core Entities

Eight entities from the ERD. Do not rename, merge, or restructure without going through the full `/task → /spec → /implement → /commit` pipeline:

| Entity           | Role                                                        |
| :--------------- | :---------------------------------------------------------- |
| `Faculty`        | Instructors who are assigned course loads                   |
| `LoadAssignment` | Junction: Faculty ↔ Course per term                         |
| `Course`         | A course offering (can belong to multiple programs)         |
| `StudentCourse`  | Junction: Student ↔ Course enrollment                       |
| `ProgramCourse`  | Junction: Program ↔ Course curriculum mapping               |
| `Student`        | A student enrolled in one or more programs                  |
| `Program`        | Degree program (BSCS, BSEMC, BSIS)                          |
| `Attendance`     | Per-session presence record linking Student ↔ Course ↔ date |

## Agentic Workflow Context

This codebase is also a **teaching artifact**. The four-stage command pipeline (`/task → /spec → /implement → /commit`) is the demo's atomic step shape — it is deliberately visible and narrated, not hidden.

When working on demo-oriented tasks (workflow documents, slide content, handouts, worked examples):

- Prefer producing **real files** (markdown, pptx, html) over pasting content inline.
- Every workflow you formalize must pass the **agent-visibility test**: a competent engineer who was not in the original conversation could read it, execute it manually, and get the same outcome.
- Always show the **orchestration spectrum** for any demo workflow: manual → assisted → supervised → autonomous. Be honest about which mode is appropriate today.
- Every demo workflow must include at least one **failure branch**. No hand-waving on failure modes.

## Hard Project Constraints

These are decided — not negotiable without explicit user signoff:

- **Scope is fixed at three modules.** Grading, scheduling, billing, library are OUT OF SCOPE.
- **Programs served are fixed:** BSCS, BSEMC, BSIS only.
- **ERD entities are canonical.** The eight entities above are the schema. Any structural change must go through the full pipeline.
- **Demo clarity > production completeness.** If a choice trades off between "easy to teach" and "production-grade," favor teachability and document the trade-off.
- **Framework-agnostic stance.** Workflow principles demonstrated here must hold whether an audience later uses LangGraph, Claude Code, n8n, plain Python, or sticky notes. Do not pitch a specific framework as the answer.

## Domain Vocabulary

- **Agentic workflow** — a workflow where every step has explicit inputs, outputs, a named tool, and a decidable success condition.
- **Agent-visible** — a step or workflow that could be executed by an LLM-based agent without tacit human knowledge.
- **Prompt harness** — the scaffolding (system prompt, context injection, output format rules) that constrains an LLM to produce predictable, auditable output.
- **Orchestration mode** — Manual, Assisted, Supervised, or Autonomous execution of the same workflow definition.
- **Load assignment** — the act of assigning a specific course to a specific faculty member for a given term.
- **Junction entity** — `StudentCourse` and `ProgramCourse` are junction/bridge entities; treat them as first-class domain objects, not implementation details.
- **Four-stage pipeline** — `/task → /spec → /implement → /commit` — the atomic command shape used throughout this project and its demos.

## Rules

Read the relevant file before writing code in that area:

- `.claude/rules/coding.md` — PHP and TypeScript language standards
- `.claude/rules/security.md` — data handling, auth, backend hardening
- `.claude/rules/testing.md` — test stack, file conventions, mocking rules, coverage targets
