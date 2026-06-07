# Big Brother UI

React 19 + Vite frontend scaffold for the Big Brother School Management System.

## Purpose

This app is the student-friendly frontend shell for later feature work. In this bootstrap stage it provides:

- React 19 project setup in JavaScript
- Browser routing with one default home screen
- A small layout and API service layer structure
- Vitest testing setup for future component work

## Local commands

Run these from `apps/big-brother-ui/`:

```bash
npm install
npm run dev
npm run build
npm run test -- --run
```

## Environment note

Set `VITE_API_URL` in a local `.env` file when you want the frontend to call the backend.

## Current scope

This scaffold does not yet include Enrollment, Load Assignment, or Attendance Monitoring screens. It only sets up the frontend foundation.
