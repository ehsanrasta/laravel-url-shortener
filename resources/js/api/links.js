import { ApiClient } from '../client'

let client = new ApiClient(process.env.MIX_APP_URL + '/api')

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
