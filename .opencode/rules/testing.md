# Testing Standards

These rules apply to all implementation work before the workflow can move from `/implement` to `/commit`.

## Testing Philosophy

- Use tests to explain behavior, not only to catch bugs.
- Write tests that a college student can read from top to bottom.
- Prefer simple test setup with clear variable names.
- Test one main idea at a time when possible.
- Do not claim a task is ready if no relevant verification was run.

## Testing Frameworks

- Use **Pest** for backend tests.
- Use **Vitest** for frontend tests.
- Choose the smallest useful test first, then add more coverage only when the change needs it.

## Backend Testing With Pest

- Put HTTP, API, and end-to-end backend behavior in `tests/Feature/`.
- Put isolated business logic in `tests/Unit/`.
- Use clear Pest test descriptions so students can understand what the test is checking.
- Use model factories for test data instead of large hardcoded fixtures.
- Use `RefreshDatabase` or `LazilyRefreshDatabase` when database reset behavior is needed.
- Keep each test focused on one behavior: success case, validation failure, authorization failure, or regression case.

## Frontend Testing With Vitest

- Use Vitest for frontend unit and component tests.
- Place frontend tests near the code they validate when the project structure supports that pattern.
- Prefer simple rendering and interaction tests over deeply mocked implementation tests.
- Use test names that describe what the student should expect from the UI.
- When a frontend change has no automated test yet, run the most relevant verification available such as `vitest`, lint, typecheck, or build.

## Beginner-Friendly Test Style

- Arrange the test in a clear order: setup, action, assertion.
- Use descriptive names such as `studentRecord`, `response`, `payload`, and `result`.
- Keep setup short and readable.
- Break long setup chains into intermediate variables.
- Prefer explicit assertions over compact or clever test helpers.
- Add a short explanation in the implementation summary when a test uses a tool or pattern students may not know yet.

## Minimum Coverage Expectations

- Cover the happy path.
- Cover the main failure, validation, or error path.
- Cover authorization or permission behavior when access rules are involved.
- Add a regression test when fixing a bug that could happen again.

## Workflow And Configuration Changes

- For workflow or config changes, verify the referenced file paths, command names, and rule text stay internally consistent.
- If there is no runnable automated test for the change, state the manual verification clearly.

## Failure Handling

- Never skip, delete, or weaken a test only to make the suite pass.
- If a relevant test fails, stay in `/implement` and fix it or report the blocker clearly.
- If a failure already existed before the current task, separate that failure from the new work in your report.

## Reporting

- Report the test commands you ran.
- Report whether each command passed, failed, or was not available.
- If you could not run a needed test, say why.
- State any remaining manual verification that the user should perform.
