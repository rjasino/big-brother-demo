---
description: Clarify the task before any spec or code work begins
agent: agent-x44-mentor
---

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
