# 1. Project Name and Owner

- **App name:** Big Brother School Management System
- **Developer:** 1984 Tech Solutions
- **Owning institution:** George Orwell College of Arts and Technology

# 2. Problem Statement

George Orwell College runs three degree programs (BSCS, BSEMC, BSIS) but manages enrollment, faculty course loads, and attendance through disconnected spreadsheets and paper records. Registrars cannot quickly confirm which courses a student is enrolled in for the term, and there is no single record tying a faculty member to the courses they are assigned to teach. Attendance is logged by hand per session, so students who slip below the required attendance threshold surface late — after intervention is already hard. The Big Brother SMS centralizes Enrollment, Load Assignment, and Attendance Monitoring into one source of truth, so each fact is recorded once and is readable by everyone who needs it.

# 3. Target Users

- **Student** — needs to see which program and courses they are enrolled in for the term and their own attendance standing per course.
- **Faculty** — needs to see their assigned course load for the term and record/review attendance for each class session they teach.
- **Registrar/Admin** — needs to enroll students into programs and courses, assign course loads to faculty per term, and monitor attendance across the college.

# 4. Core Features

### Enrollment

- Registrar can enroll a student into a program for a given term.
- Registrar can assign courses to an enrolled student for the term (creating StudentCourse records).
- Registrar can drop or transfer a student out of a course within the term.
- Student can view their current program and the courses they are enrolled in.
- **Agentic:** System auto-validates a student's course selections against the program curriculum (ProgramCourse) and flags any course that is not part of their program before enrollment is confirmed.

### Load Assignment

- Registrar can assign a course to a faculty member for a specific term (creating a Load Assignment).
- Registrar can reassign or unassign a faculty member's course load.
- Faculty can view their assigned course load for the current term.
- Registrar can view all assignments for a given course to spot coverage gaps.
- **Agentic:** System auto-flags courses with no faculty assigned for the upcoming term, and faculty whose total load exceeds a configured maximum.

### Attendance Monitoring

- Faculty can record attendance for each student per class session (present / absent / late).
- Faculty can review the full attendance history for any course they teach.
- Student can view their own attendance record and current standing per course.
- Registrar can generate an attendance summary rolled up by course or program.
- **Agentic:** System auto-flags students whose attendance in a course falls below the required threshold and notifies the assigned faculty and registrar.

# 5. Domain Entities

| Entity              | Key Attributes (3–5)                                                 | Relationships                                                                         |
| ------------------- | -------------------------------------------------------------------- | ------------------------------------------------------------------------------------- |
| **Faculty**         | faculty_id, name, employee_no, department, status                    | Has many Load Assignments.                                                            |
| **Load Assignment** | load_assignment_id, faculty_id (FK), course_id (FK), term            | Belongs to one Faculty; references one Course. (Junction: Faculty ↔ Course per term.) |
| **Course**          | course_id, course_code, title, units                                 | Has many Load Assignments, StudentCourse, ProgramCourse, and Attendance records.      |
| **StudentCourse**   | student_course_id, student_id (FK), course_id (FK), term, status     | Junction linking one Student and one Course (term enrollment).                        |
| **ProgramCourse**   | program_course_id, program_id (FK), course_id (FK)                   | Junction linking one Program and one Course (curriculum).                             |
| **Student**         | student_id, name, year_level, program_id (FK), status                | Belongs to one Program; has many StudentCourse and Attendance records.                |
| **Program**         | program_id, code (BSCS/BSEMC/BSIS), name                             | Has many Students and ProgramCourse records.                                          |
| **Attendance**      | attendance_id, student_id (FK), course_id (FK), session_date, status | Belongs to one Student and one Course (one record per session).                       |

# 6. Scope / Boundaries

**In Scope**

- Enrollment: register students into programs and assign their term courses.
- Load Assignment: assign courses to faculty per term and view loads.
- Attendance Monitoring: record per-session attendance and surface at-risk students.
- The three agentic flags above (curriculum validation, unassigned-course/overload detection, low-attendance alerts).

**Out of Scope**

- Grading and grade computation.
- Class scheduling and room/timetable management.
- Billing, tuition, and payments.
- Library, dormitory, and any other administrative module.
- Cross-institution or multi-campus support.

**Demo Constraints**

- Data is seeded, not live-synced from any existing SIS.
- Built to illustrate the stages of an agentic workflow, not to replace a live Student Information System.
- Optimized for clarity and a "build it on Monday" walkthrough, not for production completeness.
