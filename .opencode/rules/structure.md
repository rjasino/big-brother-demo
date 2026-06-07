## Repository Structure

```
software-engineering/
├── apps/                  # Executable applications in the monorepo
│   ├── big-brother-api/   # Laravel backend service
│   └── big-brother-ui/    # React + Vite frontend service
├── packages/              # Shared libraries used by multiple apps
│   └── db/                # Shared database models, schema helpers, and common types
├── docs/
│   ├── prd.md             # Product requirements
│   ├── sdd.md             # System design (tech stack, architecture, DB rationale)
│   ├── data_model.json    # Authoritative table schema
│   ├── erd.png            # Entity relationship diagram
│   └── specs/             # Per-feature spec files (YYYY-MM-DD-SPEC-<slug>.md)
├── docker-compose.yml     # Shared local infrastructure (for example Postgres)
└── .opencode/
    ├── agents/            # Custom agents such as agent-x44-mentor
    ├── commands/          # Custom slash commands (task, spec, implement, commit)
    └── rules/             # Coding, security, testing, structure, and command standards
```

---

## Monorepo Layout Guidance

Each app under `apps/` is self-contained and owns its own runtime, dependencies, and test commands. Shared logic that must stay consistent across apps belongs in `packages/`, not copied into each service.

- `apps/big-brother-api` owns backend HTTP endpoints, business rules, auth, and persistence.
- `apps/big-brother-ui` owns frontend pages, components, client state, and API consumption.
- `packages/db` owns shared database-facing contracts, reusable schema knowledge, and common types that need one source of truth across the monorepo.

When choosing where a change belongs:

- Put backend-only code in `apps/big-brother-api`.
- Put frontend-only code in `apps/big-brother-ui`.
- Put cross-app database models or shared types in `packages/db`.
- Do not duplicate shared model or type definitions across apps when `packages/db` should own them.

## Backend App Structure (`apps/big-brother-api/`)

The backend is a Laravel 13 service. Typical structure:

```
apps/big-brother-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # API controllers grouped by module
│   │   └── Requests/       # FormRequest validation classes
│   ├── Models/             # Eloquent models when they are backend-specific
│   └── Services/           # Focused business logic classes
├── routes/
│   ├── api.php             # JSON API routes
│   └── web.php             # Optional health, auth, or non-API routes if needed
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
└── tests/
    ├── Feature/            # Endpoint and integration behavior
    └── Unit/               # Service and domain logic
```

## Frontend App Structure (`apps/big-brother-ui/`)

The frontend is a React + Vite application that consumes the Laravel API.

```
apps/big-brother-ui/
├── src/
│   ├── components/         # Reusable UI building blocks
│   ├── pages/              # Route-level screens grouped by module
│   ├── services/           # API clients and request helpers
│   ├── types/              # Frontend-only data shape helpers or constants when not shared from packages/db
│   └── test/               # Test setup utilities if needed
├── public/
└── tests/                  # Optional frontend integration or component test area
```

## Shared Package Structure (`packages/db/`)

`packages/db` is the shared contract layer for data models and common data shape definitions used by both applications.

```
packages/db/
├── src/
│   ├── models/             # Shared model definitions or schema representations
│   ├── types/              # Shared domain and transport shape definitions
│   └── index.js            # Public exports for the package
├── package.json
└── README.md
```

Keep `packages/db` focused:

- shared data shape definitions that frontend and backend must agree on
- shared model metadata or schema helpers
- reusable database-facing contracts

Do not turn `packages/db` into a dump for unrelated utilities.
