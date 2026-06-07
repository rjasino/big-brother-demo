# Big Brother API

Laravel 13 backend scaffold for the Big Brother School Management System.

## Purpose

This app is the JSON API service for the monorepo. In this bootstrap stage it provides:

- Laravel 13 project structure
- Sanctum-ready API setup
- PostgreSQL-oriented environment defaults
- A simple root response and API health check

## Local commands

Run these from `apps/big-brother-api/`:

```bash
composer install
php artisan serve
php artisan test
```

## Environment notes

- `DB_CONNECTION=pgsql`
- `DB_PORT=5433` to match the repo Docker Compose file
- `FRONTEND_URL=http://localhost:5173` for local SPA requests

## Current scope

This scaffold does not yet include Enrollment, Load Assignment, or Attendance business logic. It only prepares the backend foundation for later feature work.
