import axios from 'axios'

const getClient = (baseUrl = null) => {

  const options = {
    baseURL: baseUrl,
    headers: {'X-Requested-With': 'XMLHttpRequest'}
  }

  const client = axios.create(options)

  let token = document.head.querySelector('meta[name="csrf-token"]')

  if (token) {
    client.defaults.headers.common['X-CSRF-TOKEN'] = token.content
  } else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
  }

  return client
}

class ApiClient {
  constructor (baseUrl = null) {
    this.client = getClient(baseUrl)
  }

  post (url, data = {}, conf = {}) {
    return this.client.post(url, data, conf)
      .then(response => Promise.resolve(response))
      .catch(error => Promise.reject(error))
  }
}

export { ApiClient }

export default {
  post (url, data = {}, conf = {}) {
    return getClient().post(url, data, conf)
      .then(response => Promise.resolve(response))
      .catch(error => Promise.reject(error))
  }
}
