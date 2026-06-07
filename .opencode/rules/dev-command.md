## Dev Command

This repository uses a monorepo layout.

- Run shared infrastructure commands from the repo root.
- Run backend commands from `apps/big-brother-api/`.
- Run frontend commands from `apps/big-brother-ui/`.
- Run shared package commands from `packages/db/` when that package has its own scripts.

```bash
# Shared infrastructure - run from repo root
docker compose up -d

# Backend - run from apps/big-brother-api/
php artisan serve
php artisan migrate
php artisan db:seed
php artisan test
php artisan test --filter=EnrollmentTest
php artisan test tests/Feature/EnrollmentTest.php

# Frontend - run from apps/big-brother-ui/
npm install
npm run dev
npm run build
npm run test
npm run test -- --run

# Shared package - run from packages/db/
npm install
npm run build
npm run test
```

## Beginner-Friendly Command Guidance

- Start the database first if the backend depends on Postgres.
- Start backend and frontend in separate terminals.
- Run the smallest useful test command before running the full suite.
- If you only changed the frontend, do not run backend-only commands first.
- If you changed shared types in `packages/db`, verify both the package itself and the app that consumes the change.

## Typical Local Workflow

1. From repo root, start Docker services.
2. In `apps/big-brother-api/`, run Laravel backend commands.
3. In `apps/big-brother-ui/`, run Vite frontend commands.
4. In `packages/db/`, rebuild or retest the shared package when its files change.

## Testing Shortcuts By Area

- Backend change -> run `php artisan test` or a focused Pest command in `apps/big-brother-api/`.
- Frontend change -> run `npm run test` or a focused Vitest command in `apps/big-brother-ui/`.
- Shared package change -> run the package test/build command first, then verify the affected backend or frontend app.
