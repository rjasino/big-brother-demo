import { expect, test } from 'vitest'
import { render, screen } from '@testing-library/react'
import { BrowserRouter } from 'react-router-dom'
import App from './App'

function renderApp() {
  return render(
    <BrowserRouter>
      <App />
    </BrowserRouter>,
  )
}

test('shows the default bootstrap screen', () => {
  renderApp()

  const heading = screen.getByRole('heading', {
    name: 'Big Brother School Management System',
  })

  expect(heading).toBeInTheDocument()
  expect(screen.getByText('Framework bootstrap complete')).toBeInTheDocument()
})
