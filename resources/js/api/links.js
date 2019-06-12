import { ApiClient } from '../client'

let client = new ApiClient('http://short.test/api/')

export default {

  shorten (link) {
    if (!link.original.startsWith('http://') && !link.original.startsWith('https://')) {
      link.original = 'http://' + link.original
    }

    return client.post('shorten', link)
  },

  getAllLinksForUser () {
    return client.get('links')
  }

}