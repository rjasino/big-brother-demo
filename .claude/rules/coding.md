# Coding Standards

These rules apply to all agents across frontend and backend.

## General

- Follow clean, self-documenting code principles.
- Prefer small, focused functions and methods — single responsibility.
- Use meaningful names for variables, functions, and classes.
- Remove dead code — do not leave commented-out blocks.

## PHP (Backend)

- Use PHP 8.4+ features: typed properties, enums, match expressions, readonly classes.
- Always use strict types: `declare(strict_types=1);` at the top of every PHP file.
- Use `final` classes for models, controllers, and services unless extension is intended.
- Prefer named arguments for clarity when calling functions with multiple parameters.

## TypeScript (Frontend)

- Strict mode is always on (`"strict": true` in `tsconfig.json`).
- No `any` types — use `unknown` and narrow explicitly if needed.
- Define all prop interfaces with explicit types — no implicit `{}` objects.
- Use TypeScript `enum` only for fixed UI states; prefer `as const` objects for string unions.
- Export types and interfaces from a co-located `.types.ts` file.
- Use React functional components with hooks; avoid class components.
