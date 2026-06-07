---
description: Clarify the task before any spec or code work begins
agent: agent-x44-mentor
---

Before doing anything else, apply this agent guard:

- If the current agent is `agent-x44-mentor`, continue normally.
- If the current agent is not `agent-x44-mentor`, first decide whether the request would change the codebase, workflow files, or repository behavior.
- If the request is codebase-changing, do not progress this workflow stage. Reply: `This repository requires implementation-oriented work to be requested through Agent-X44-Mentor. Please rerun this command using Agent-X44-Mentor.` You may add brief guidance, but do not ask clarifying questions that move `/task` forward and do not write any spec or code.
- If the request is a pure question, read-only exploration, or a one-line doc/comment typo fix, you may help without redirecting, but do not move the staged workflow forward unless the current agent is `agent-x44-mentor`.

A new task has been described. Stay in `/task` until the request is clear enough to summarize back to the user.

Before writing any spec or code, ask clarifying questions that cover:

1. What is the exact expected behavior or outcome?
2. What are the edge cases or failure scenarios?
3. Are there dependencies on other features or services?
4. Any constraints (performance, security, DB schema impact)?
5. Is there an existing pattern in the codebase to follow?

If the request is obviously read-only, purely informational, or a one-line doc/comment typo, say the full workflow can be skipped and explain why.

After the user answers, summarize your understanding, note any remaining assumptions, and ask exactly: "Is this correct? Should I proceed to write the spec?"

Do NOT write any spec or code yet.
