# Testing Standards

These rules apply to all agents.

## Backend (Pest PHP)

- Write feature tests for all controller actions (happy path + error cases).
- Write unit tests for all service class methods.
- Use `RefreshDatabase` or `LazilyRefreshDatabase` trait in feature tests.
- Use model factories for test data — never hardcode fixture data.
- Test files mirror the `app/` structure under `tests/Feature/` and `tests/Unit/`.
- Use in-memory SQLite for unit tests.
