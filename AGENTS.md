# AGENTS.md

This file provides guidance to OpenCode (opencode.ai) when working with code in this repository.

## What This is

Big Brother School Management System is a school management demo built for **George Orwell College of Arts and Technology** by **1984 Tech Solutions**. It is scoped to three modules only: Enrollment, Load Assignment, and Attendance Monitoring.

This project is primarily a **teaching vehicle** — a concrete, running system used to demonstrate the fundamentals of agentic workflow and prompt harness engineering to students and colleagues at FullScale. The goal is not production completeness; it is _"I could build this on Monday"_ clarity.

The implementation approach is a **monorepo with separated services**:

- `apps/big-brother-api` — Laravel backend service
- `apps/big-brother-ui` — React + Vite frontend service
- `packages/db` — shared database models and common application types

**Programs served:** BSCS, BSEMC, BSIS
**Out of scope:** grading, scheduling, billing, library, and all other modules not listed above.

---

## 🚦 Workflow — Read This First

Every task follows a single four-stage pipeline: **`/task → /spec → /implement → /commit`**. This is the atomic step shape for all work in this project and the same pipeline demonstrated to the audience.

The default orchestrator for this workflow is **`agent-x44-mentor`**. Slash commands in `.opencode/commands/` should route through that agent so intake, gates, and handoffs stay consistent.

```
  ┌──────────┐   clarify   ┌──────────┐   approved   ┌─────────────┐   tests pass   ┌─────────┐
  │  /task   │ ──────────► │  /spec   │ ───────────► │  /implement │ ─────────────► │ /commit │
  └──────────┘             └──────────┘              └─────────────┘                └─────────┘
```

### `/task`

Clarify the request — behavior, edge cases, dependencies, constraints, existing patterns. Summarize what will be done and ask: _"Is this correct? Should I proceed to write the spec?"_

### `/spec`

Write the spec to `docs/specs/<YYYY-MM-DD>-SPEC-<slug>.md`. Output: `Spec saved to docs/specs/<YYYY-MM-DD>-SPEC-<slug>.md. Please review and reply 'approved' to proceed.`

**Gate:** user replies `approved` → move to `/implement`.

### `/implement`

Cut branch from updated `main`, implement the approved scope, and run targeted tests. Output: `Ready for manual acceptance testing.`

Stop and return for approval if:

- the scope needs to expand beyond the approved spec
- unrelated working tree changes make the task boundary unclear
- targeted tests fail or cannot be run safely
- a shared contract change in `packages/db` has not been verified against the affected app or apps

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

### Failure branches

- Unclear requirements → stay in `/task`
- Missing decisions in the spec → stay in `/spec`
- Scope change during implementation → stop and return for approval
- Failing targeted tests → stay in `/implement`
- Unrelated dirty worktree before commit → ask which files belong

---

## Repository Structure

Refer to `.opencode/rules/structure.md`

## App Structure

Refer to `.opencode/rules/structure.md`

## Dev Commands

Refer to `.opencode/rules/dev-command.md`

---

## Source-of-Truth Documents

| Question is about…                                   | Read                   |
| :--------------------------------------------------- | :--------------------- |
| Product scope, modules, programs, out-of-scope items | `docs/prd.md`          |
| System architecture, API surface, folder layout      | `docs/sdd.md`          |
| Entities, fields, relationships                      | `docs/data_model.json` |
| Per-feature specs                                    | `docs/specs/`          |

## Data Model — Core Entities

## Agentic Workflow Context

This codebase is also a **teaching artifact**. The four-stage command pipeline (`/task → /spec → /implement → /commit`) is the demo's atomic step shape — it is deliberately visible and narrated, not hidden.

`agent-x44-mentor` is not only an orchestrator. It is also a teaching mentor for students reading the code and workflow output.

When working on demo-oriented tasks (workflow documents, slide content, handouts, worked examples):

- Prefer producing **real files** (markdown, pptx, html) over pasting content inline.
- Every workflow you formalize must pass the **agent-visibility test**: a competent engineer who was not in the original conversation could read it, execute it manually, and get the same outcome.
- Always show the **orchestration spectrum** for any demo workflow: manual → assisted → supervised → autonomous. Be honest about which mode is appropriate today.
- Every demo workflow must include at least one **failure branch**. No hand-waving on failure modes.

When writing or changing code for this repository:

- Prefer code that a college student can read line by line.
- Do not use ternary operators.
- Do not use short-circuit patterns for rendering or control flow.
- Use JavaScript with ES6 syntax instead of TypeScript for MERN and React work.
- Use named function components in React code.
- Break long chains into intermediate variables before using the final value.
- When spread or destructuring is used with JSON-shaped data, explain what is being copied or extracted and why.
- Prefer clear, repeatable coding patterns over clever or highly compact syntax.
- Keep backend code in `apps/big-brother-api`, frontend code in `apps/big-brother-ui`, and shared contracts in `packages/db`.
- If a change touches `packages/db`, verify the affected consumer apps instead of assuming the shared change is safe everywhere.

## Hard Project Constraints

These are decided — not negotiable without explicit user signoff:

- **Scope is fixed at three modules.** Grading, scheduling, billing, library are OUT OF SCOPE.
- **Programs served are fixed:** BSCS, BSEMC, BSIS only.
- **ERD entities are canonical.** The eight entities above are the schema. Any structural change must go through the full pipeline.
- **Demo clarity > production completeness.** If a choice trades off between "easy to teach" and "production-grade," favor teachability and document the trade-off.
- **Framework-agnostic stance.** Workflow principles demonstrated here must hold whether an audience later uses LangGraph, Claude Code, n8n, plain Python, or sticky notes. Do not pitch a specific framework as the answer.
- **Monorepo separation is intentional.** Do not collapse backend, frontend, and shared package concerns into one app structure.
- **Shared contracts belong in `packages/db`.** Do not duplicate common model and type definitions across the apps without a strong reason.

## Domain Vocabulary

- **Agentic workflow** — a workflow where every step has explicit inputs, outputs, a named tool, and a decidable success condition.
- **Agent-visible** — a step or workflow that could be executed by an LLM-based agent without tacit human knowledge.
- **Prompt harness** — the scaffolding (system prompt, context injection, output format rules) that constrains an LLM to produce predictable, auditable output.
- **Orchestration mode** — Manual, Assisted, Supervised, or Autonomous execution of the same workflow definition.
- **Load assignment** — the act of assigning a specific course to a specific faculty member for a given term.
- **Junction entity** — `StudentCourse` and `ProgramCourse` are junction/bridge entities; treat them as first-class domain objects, not implementation details.
- **Four-stage pipeline** — `/task → /spec → /implement → /commit` — the atomic command shape used throughout this project and its demos.
- **Monorepo service boundary** — the intended separation between `apps/big-brother-api`, `apps/big-brother-ui`, and `packages/db`.
- **Shared contract** — a model, schema helper, or type in `packages/db` that multiple apps depend on.

## Rules

Read the relevant file before writing code in that area:

- `.opencode/rules/coding.md` — PHP and JavaScript ES6 language standards
- `.opencode/rules/dev-command.md` — service-specific development commands in the monorepo
- `.opencode/rules/security.md` — data handling, auth, backend hardening
- `.opencode/rules/structure.md` — monorepo layout and ownership guidance
- `.opencode/rules/testing.md` — test stack, file conventions, mocking rules, coverage targets

Workflow-specific files:

- `.opencode/agents/agent-x44-mentor.md` — orchestrator role and gating behavior
- `.opencode/commands/task.md` — clarification stage
- `.opencode/commands/spec.md` — spec creation stage
- `.opencode/commands/implement.md` — implementation stage
- `.opencode/commands/commit.md` — commit stage
