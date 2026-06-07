---
description: Stage changes and write a clean conventional-commit message
agent: agent-x44-mentor
---

Before doing anything else, apply this agent guard:

- If the current agent is `agent-x44-mentor`, continue normally.
- If the current agent is not `agent-x44-mentor`, first decide whether the request would change the codebase, workflow files, or repository behavior.
- If the request is codebase-changing, do not stage files or create a commit. Reply: `This repository requires implementation-oriented work to be requested through Agent-X44-Mentor. Please rerun this command using Agent-X44-Mentor.` You may add brief guidance, but do not progress the workflow.
- If the request is a pure question, read-only exploration, or a one-line doc/comment typo fix, you may help without redirecting, but do not run `/commit` unless the current agent is `agent-x44-mentor`.

Prepare and execute a git commit. Work through these steps in order.

**Trigger:** Execute this command only after manual acceptance testing or explicit user confirmation that implementation is approved.

## Step 1 — Inspect working tree

Run `git status` and `git diff` (both staged and unstaged) to understand what has changed. Do not assume — read the actual diff.

## Step 2 — Determine what to stage

If there are unstaged or unrelated changes, ask the user which files to include. Default to staging only files directly related to the current task. Never stage:

- `.env` or any file containing secrets
- Generated build artefacts (`dist/`, `.next/`, `node_modules/`)

## Step 3 — Draft the commit message

Use **Conventional Commits** format:

```
<type>: <subject>

[optional body — only if the subject line alone is insufficient]
```

**Type** — pick one:

| Type       | Use when                                     |
| ---------- | -------------------------------------------- |
| `feat`     | A new feature or capability visible to users |
| `fix`      | A bug fix                                    |
| `refactor` | Code restructured without behaviour change   |
| `chore`    | Tooling, config, dependency updates          |
| `test`     | Adding or fixing tests only                  |
| `docs`     | Documentation only                           |
| `perf`     | Performance improvement                      |

**Subject rules:**

- Imperative mood, present tense: "add", "fix", "remove" — not "added" or "fixes"
- No capital letter at the start
- No period at the end
- Max 72 characters on the subject line

**Body** (include only when needed):

- Explain _why_, not _what_ — the diff already shows what changed
- Wrap at 72 characters
- Separate from subject with a blank line

## Step 4 — Show and confirm

Present the full proposed commit message to the user before running any git command. Ask: "Does this look right? Reply 'yes' to commit."

## Step 5 — Commit

Once the user confirms, run:

```
git add <files>
git commit -m "<message>"
```

Use a heredoc to pass multi-line messages to avoid shell escaping issues.

After the commit succeeds, output the commit hash and subject line.

If the proposed commit is blocked by unrelated changes, unresolved test failures, or uncertainty about which files belong to the task, stop and ask the user instead of guessing.
