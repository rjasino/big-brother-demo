import { Outlet } from 'react-router-dom'

export function AppLayout() {
  return (
    <div className="app-shell">
      <header className="app-shell__header">
        <h1 className="app-shell__title">Big Brother School Management System</h1>
        <p className="app-shell__subtitle">
          React frontend bootstrap for Enrollment, Load Assignment, and Attendance.
        </p>
      </header>

      <main className="app-shell__content">
        <Outlet />
      </main>
    </div>
  )
}
