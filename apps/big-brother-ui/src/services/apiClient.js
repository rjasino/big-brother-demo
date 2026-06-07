const defaultApiUrl = 'http://localhost:8000'

export function getApiBaseUrl() {
  const configuredApiUrl = import.meta.env.VITE_API_URL

  if (configuredApiUrl) {
    return configuredApiUrl
  }

  return defaultApiUrl
}

export async function fetchJson(path, options = {}) {
  const apiBaseUrl = getApiBaseUrl()
  const requestUrl = `${apiBaseUrl}${path}`
  const response = await fetch(requestUrl, options)

  if (response.ok) {
    const responseData = await response.json()

    return responseData
  }

  throw new Error(`Request failed with status ${response.status}`)
}
