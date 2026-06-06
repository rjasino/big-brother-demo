# 1. Tech Stack

| Layer               | Technology     | Version                  | Role                                                         | Setup Note                                                                                                                                                                                                                                                                                                                                              |
| ------------------- | -------------- | ------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Backend Framework   | Laravel        | 13.x                     | Routing, controllers, validation, middleware, Eloquent       | Targets PHP 8.4; pin first-party packages in `composer.json` since some community packages lag a major Laravel bump — run `composer why-not laravel/framework 13.x` before adding deps.                                                                                                                                                                 |
| Language            | PHP            | 8.4                      | Server runtime                                               | Enable the `pdo_pgsql` and `pgsql` extensions (not bundled by default on many images). 8.4 property hooks and `new` in initializers are available but unnecessary for this scope.                                                                                                                                                                       |
| Frontend Library    | React          | 19.x                     | Inertia page components (the "View" in MVC)                  | JSX compiled by Vite via `@vitejs/plugin-react`; pages live in `resources/js/Pages/*` and are resolved by name, not by route.                                                                                                                                                                                                                           |
| SPA Bridge          | Inertia.js     | 2.x                      | Server-driven SPA adapter — no separate REST/GraphQL API     | **Manually configured — no Laravel starter kit.** Install `@inertiajs/react` (client) and `inertiajs/inertia-laravel` (server); publish and register the `HandleInertiaRequests` middleware by hand; add `@inertia` + `@viteReactRefresh` + `@vite` directives to a single `app.blade.php` root; create `resources/js/app.tsx` with `createInertiaApp`. |
| Database            | PostgreSQL     | 16                       | Relational store of record                                   | **Runs in Docker.** Map a non-default host port (e.g. `5433:5432`) so it never collides with a locally installed Postgres; set `DB_HOST=127.0.0.1`, `DB_PORT=5433` in `.env`. Persist with a named volume.                                                                                                                                              |
| ORM                 | Eloquent       | bundled with Laravel 13  | Active-Record mapping over Postgres                          | Set `DB_CONNECTION=pgsql`. Models use Laravel's default `bigint` auto-increment PK — no `$keyType` or `$incrementing` overrides needed.                                                                                                                                                                                                                 |
| Dependency Managers | Composer + npm | Composer 2.x / npm 10.x  | PHP packages / JS packages                                   | Two lockfiles travel together (`composer.lock`, `package-lock.json`). Local dev runs two processes: `php artisan serve` and `npm run dev` (Vite HMR). Production builds assets with `npm run build`.                                                                                                                                                    |
| Containerization    | Docker         | Engine 27.x / Compose v2 | Environment parity for the database (and optionally the app) | A single `docker-compose.yml` Postgres service is the minimum. Sail is optional and intentionally avoided here to keep the wiring legible for the demo audience.                                                                                                                                                                                        |

---

# 2. System Architecture

## 2.1 Architectural Pattern

**Monolithic MVC with a server-driven SPA frontend via Inertia.**

The three-module scope (Enrollment, Load Assignment, Attendance Monitoring) does not justify service decomposition, a message bus, or a standalone API tier — those would add operational surface area with zero demo payoff. Inertia is the load-bearing choice: it lets React render the entire UI as a single-page application while the server keeps owning routing, validation, and authorization, and it does so _without_ a hand-written API contract. There is no `/api/v1/enrollments` to version, no client-side data-fetching layer, and no DTO duplication between PHP and TypeScript. Controllers return page components plus props; React renders them. For a teaching artifact this matters more than usual: a learner can trace one HTTP request from a React `Link` all the way to a Postgres row and back without crossing a serialization boundary they have to reason about separately.

## 2.2 Request Lifecycle

The path for a typical Inertia visit (e.g., submitting an enrollment) is:

1. A React page component triggers a visit — `router.post('/enrollments', data)` or an Inertia `<Link>`. Inertia issues an XHR carrying the `X-Inertia: true` header instead of forcing a full document load.
2. Laravel matches the URI in `routes/web.php` (not `api.php` — Inertia uses the web middleware group and its session/CSRF stack).
3. The `HandleInertiaRequests` middleware runs, attaching shared props (authenticated user, flash messages) to whatever the controller returns.
4. The controller validates input through a `FormRequest`, then delegates to an Eloquent model or a thin service class.
5. Eloquent compiles the operation to SQL and sends it over `pdo_pgsql` to the PostgreSQL container.
6. Postgres executes and returns rows; Eloquent hydrates them into model instances.
7. The controller returns `Inertia::render('Enrollment/Create', $props)`. Inertia inspects the request: because `X-Inertia` is present, it responds with a JSON payload `{ component, props, url, version }` — **not** a full HTML page.
8. The client-side Inertia runtime receives that JSON, swaps in the named React component, and merges the new props into the page — no full reload, no flash of white. (Only the _first_, non-Inertia request to a URL returns the HTML shell with the initial `data-page` payload embedded.)

The asymmetry in step 8 is the one piece worth highlighting to the audience: the same controller action serves both a full HTML boot and a JSON partial, decided purely by the presence of one header.

## 2.3 Module Boundaries

**Enrollment.** Controllers: `EnrollmentController`, with `StudentController` for student CRUD. _Owns_ `students` and `student_courses` (the enrollment record itself). Each student carries a `program_id` FK directly on the `students` row (Program 1 — M Students), making program membership a first-class attribute rather than something inferred through course history. This module _reads_ `courses`, `programs`, and `program_courses` to decide which courses a student may take. It is the only writer of enrollment state — every other module treats `student_courses` as read-only fact.

**Load Assignment.** Controller: `LoadAssignmentController`. _Owns_ `load_assignments`. _Reads_ `faculty` and `courses` to build the assignment. It has no write dependency on the other modules; its only coupling is reading the shared `courses` catalog.

**Attendance Monitoring.** Controller: `AttendanceController`. _Owns_ `attendance`. **Cross-module read dependency (explicit):** attendance can only legitimately be recorded for a student who is _enrolled_ in a course, so this module reads `student_courses` — a record owned by Enrollment — to validate that a `(student_id, course_id)` pair is a real enrollment before writing an attendance row. The foreign keys point at `students` and `courses` directly (per the ERD), but the business-rule guard reads Enrollment-owned state.

---

# 3. Database Design

## 3.1 Core Entities

- **Reference:** [data_model.json](data_model.json)
- **Primary Source for Current Design:** `erd.png`

## 3.2 Logical Table Notes

**load_assignments** — Composite uniqueness: `UNIQUE (faculty_id, course_id, academic_year, term, section)` prevents assigning the same faculty the same course-section twice in one term. A `bigint` auto-increment primary key is used for stable single-column addressing in Eloquent relationships and route-model binding. Beyond the two foreign keys it carries `academic_year`, `term`, optional `section`, `status` (assigned / completed / cancelled), and `assigned_at`.

**student_courses** — Composite uniqueness: `UNIQUE (student_id, course_id, academic_year, term)` allows a re-take in a later term while blocking duplicate enrollment in the same term. `bigint` PK. Extra columns: `academic_year`, `term`, `enrollment_status` (enrolled / dropped / completed), and `enrolled_at` to timestamp the enrollment event independently of `created_at`.

**program_courses** — Composite uniqueness: `UNIQUE (program_id, course_id)` — a course appears at most once in a program's curriculum (no term dimension here; curriculum is term-agnostic). `bigint` PK. Extra columns: `year_level`, optional `term`, and `is_required` to express where the course sits in the program plan.

## 3.3 Design Considerations

**Auto-increment vs. UUID.** Every table uses a `bigint` auto-increment primary key (`bigserial` / Laravel `id()`). The driving reasons are simplicity and teachability: sequential integer keys are immediately readable in seed data, factory output, and query results — a learner tracing a request from a React page to a Postgres row can follow the IDs without decoding UUIDs. Eloquent's default conventions (`$primaryKey = 'id'`, `$incrementing = true`) work without override. The tradeoff — sequential IDs let a caller guess neighboring record counts — is acceptable at demo data volumes and is worth calling out to the audience as a deliberate teachability choice rather than a security recommendation.

**Soft Deletes.** Apply Laravel's `SoftDeletes` trait (a nullable `deleted_at timestamptz`) to the reference tables — `faculty`, `students`, `courses`, `programs` — where accidental loss is costly and history matters. Do **not** soft-delete the junction tables or `attendance`: in a teaching artifact, every query against those would otherwise need an implicit `WHERE deleted_at IS NULL`, which obscures the lesson. The tradeoff is honest — soft-deleting a course while hard-deleting its enrollment links can leave a "dangling" enrolled course visible as trashed; for the demo's scope that edge is acceptable and worth pointing out to the audience rather than engineering around.

**Term/Semester Scoping.** There is no dedicated `Term` entity. Term is a `varchar(20)` (e.g. `2025-1S`) stored on `load_assignments` and `student_courses` — the only two tables where multi-term data actually accumulates. For three modules this avoids an extra join on every enrollment and assignment query, keeping the data model readable. The honest recommendation: the moment a scheduling or grading module is added (both explicitly out of scope), promote Term to a first-class table with a foreign key, because string terms will not survive validation, ordering, and date-range logic. For this demo, the string is the right call.

**Attendance Granularity.** One `attendance` row represents exactly one student, in one course, on one calendar session — enforced by `UNIQUE (student_id, course_id, attendance_date)`. This makes attendance a per-session fact (the common case for a class that meets on distinct days). If a course meets more than once per day, this model collapses those into one row; the migration path is to either add a `session_no smallint` to the unique key or replace `attendance_date date` with a `session_at timestamptz`. The single-session-per-day choice is deliberate for clarity and stated so the limitation is visible.

**PostgreSQL-specific choices.** Several decisions lean on Postgres features that MySQL either lacks or handles differently: `timestamptz` is used everywhere instead of a naive `datetime`, so all timestamps are stored UTC and rendered per the session time zone — important once attendance crosses any DST boundary; and `CHECK` constraints enforce the small status enums (`attendance.attendance_status`, `student_courses.enrollment_status`) at the database layer rather than trusting the application alone. `citext` is a candidate for the `email` columns to make uniqueness case-insensitive without lowercasing in PHP, and is noted as an optional hardening step rather than a requirement for the demo.
