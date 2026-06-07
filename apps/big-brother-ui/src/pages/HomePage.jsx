export function HomePage() {
  return (
    <section className="home-page">
      <div className="home-page__panel">
        <h2 className="home-page__heading">Framework bootstrap complete</h2>
        <p>
          This default screen confirms that the React app is running and ready for later
          module work.
        </p>
      </div>

      <div className="home-page__panel">
        <h2 className="home-page__heading">What is ready now</h2>
        <ul className="home-page__list">
          <li className="home-page__list-item">React 19 and Vite are configured.</li>
          <li className="home-page__list-item">Browser routing is ready for future pages.</li>
          <li className="home-page__list-item">A small API service layer has a home in `src/services`.</li>
        </ul>
      </div>
    </section>
  )
}
