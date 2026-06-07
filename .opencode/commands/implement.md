---
description: Begin implementation after spec is approved
agent: agent-x44-mentor
---

Before doing anything else, apply this agent guard:

- If the current agent is `agent-x44-mentor`, continue normally.
- If the current agent is not `agent-x44-mentor`, first decide whether the request would change the codebase, workflow files, or repository behavior.
- If the request is codebase-changing, do not branch, edit files, or run implementation steps. Reply: `This repository requires implementation-oriented work to be requested through Agent-X44-Mentor. Please rerun this command using Agent-X44-Mentor.` You may add brief guidance, but do not progress the workflow.
- If the request is a pure question, read-only exploration, or a one-line doc/comment typo fix, you may help without redirecting, but do not run `/implement` unless the current agent is `agent-x44-mentor`.

Implement the approved spec only after the user has approved it.

Before making changes, confirm the worktree is safe to use. If unrelated local changes make branching, testing, or later staging ambiguous, stop and ask the user which files belong to this task.

Implement in this order:

1. **Update `main`, then create the working branch.** Pull the latest remote `main` branch first, then cut a fresh branch from that updated `main` for the current task before making implementation changes. Name it `<author_name>/<task_word>`.
   - Refresh local `main` from the remote before branching so the task starts from the current upstream tip
   - If there are modified or untracked files, stash it first before cutting a branch. Pop the stash later after branching out.
   - Read `author_name` from `git config user.name`
   - Normalize it for branch names (lowercase; replace spaces and other unsafe characters with `-`)
   - Derive `task_word` from the approved task/spec as one concise lowercase word
   - This branch is the agent's working branch for the current task; the human will handle the PR separately
2. **Backend** — services, models, routes, controllers
3. **Frontend** — components, pages, state
4. **Tests** — Pest PHP feature tests in `tests/Feature/` and unit tests in `tests/Unit/` per the testing rules in `.opencode/rules/testing.md`

Rules that always apply:

- Follow `.opencode/rules/coding.md` for PHP and JavaScript ES6 standards
- Follow `.opencode/rules/security.md` for secrets, auth, and input validation
- Follow `.opencode/rules/testing.md` for test structure and mocking rules
- Stay within the scope defined in the approved spec — if something requires a scope change, STOP and flag it before continuing
- Base the branch on `main`, not the current branch tip
- If the target branch name already exists and is not clearly reusable for the same task, STOP and ask the user before proceeding
- If targeted tests fail, do not advance to `/commit` until the failures are resolved or explicitly discussed with the user
- Optimize every implementation for teachability so a college student can follow the code without advanced shorthand
- Avoid ternary operators, short-circuit logic, and hard-to-read chaining in generated code
- Use named function components for React code and explain spread/destructuring when using JSON-shaped data

When implementation is complete:

Output a summary with:

- Files created or modified
- Tests written (file paths and what they cover)
- Test commands run and their outcome
- Any deviations from the spec (if none, say so explicitly)
- Any teaching-oriented style choices made to improve student readability
- Signal: `Ready for manual acceptance testing.`

Do NOT commit any code yet.
