# Coding Standards

These rules apply to all agents across frontend and backend.

## General

- Follow clean, self-documenting code principles.
- Prefer small, focused functions and methods — single responsibility.
- Use meaningful names for variables, functions, and classes.
- Remove dead code — do not leave commented-out blocks.
- Write code that a college student can understand without advanced shorthand.
- Prefer explicit statements over compressed expressions.
- Use `if` and `else` blocks instead of ternary operators.
- Do not use short-circuit patterns such as `condition && action()` or `condition && <Component />`.
- If an expression is hard to read in one line, split it into named intermediate variables.
- When a non-obvious language feature is used, explain it in simple terms in the surrounding response.

## Teaching Style

- Optimize for readability before cleverness.
- Keep one main idea per line when possible.
- Use descriptive variable names instead of abbreviations unless the abbreviation is already standard in the codebase.
- Prefer shallow nesting and early validation blocks.
- When transforming data, do it step by step so a student can trace the result.
- Recommend simple, consistent patterns that students can copy safely into similar tasks.
- For MERN and React student work, use JavaScript with ES6 module syntax instead of TypeScript.

## PHP (Backend)

- Use PHP 8.4+ features: typed properties, enums, match expressions, readonly classes.
- Always use strict types: `declare(strict_types=1);` at the top of every PHP file.
- Use `final` classes for models, controllers, and services unless extension is intended.
- Prefer named arguments for clarity when calling functions with multiple parameters.
- Prefer `if` / `else` and named variables over nested expressions.
- If method chaining becomes long or hides intent, break it into intermediate variables.
- Keep controller methods easy to trace: validate, delegate, return.

## JavaScript ES6 (Frontend)

- Use JavaScript for MERN and React project work instead of TypeScript.
- Use ES6 module syntax such as `import` and `export`.
- Prefer `.js` and `.jsx` files for frontend code.
- If data shape expectations need to be explained, use clear variable names, small helper functions, or JSDoc comments only when they improve student understanding.
- Use named function components instead of arrow-function components.
- Prefer explicit event handlers and explicit return branches over inline conditional rendering tricks.
- When reading nested API or JSON data, decompose it into variables before rendering or updating state.
- When using object spread or destructuring, explain in the response what fields were extracted or copied and why.
- Avoid chaining like `response.data.user.profile.name` inside JSX or business logic; assign each step to a readable variable first.

## Recommended Beginner-Friendly Style

- Use named function declarations such as `function StudentCard()` for React components.
- Use descriptive names such as `studentRecord`, `attendanceStatus`, and `isEnrollmentOpen`.
- Use one transformation step at a time when building arrays or objects.
- Keep conditionals explicit even if the shorter version would also work.
- Prefer returning early with a clear `if` block instead of combining many checks in one expression.
