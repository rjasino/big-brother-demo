# @big-brother/db

Shared package scaffold for database-facing contracts used by the Big Brother School Management System.

## Purpose

This package is the home for shared model metadata and shared data-shape exports that both apps may use later.

## Current scope

At bootstrap time, this package stays intentionally small:

- one public export entry in `src/index.js`
- separate `models/` and `types/` folders
- a small Node test so the package can be verified early

## Commands

Run these from `packages/db/`:

```bash
npm test
npm run build
```
