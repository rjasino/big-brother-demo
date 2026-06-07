# Security Standards

These rules apply to all agents across frontend and backend.

## Secrets & Credentials

- Never log passwords, tokens, or PII.
- Store all secrets in `.env` — never hardcode them.
- Never commit `.env` files — use `.env.example` for reference.
- Never read `.env` values directly; use `.env.example` as a reference and inject values via config files or environment variables.

## Backend Security

- Rate-limit public endpoints using `throttle` middleware.
- Use `bcrypt` or `argon2` for password hashing (Laravel's default `Hash` facade).
- Never expose stack traces or internal error details in production responses.
- Return proper HTTP status codes: `200`, `201`, `204`, `400`, `401`, `403`, `404`, `422`, `500`.

## Frontend Security

- Do not store auth tokens or other sensitive data in `localStorage`; prefer secure httpOnly cookie-based auth for first-party SPAs.
- Use Laravel Sanctum as the default auth layer for decoupled React-to-Laravel applications; use API tokens only for non-browser clients or tightly controlled integrations.
- Handle 401 responses globally — redirect to login.
- Sanitize any user-generated content before rendering.
