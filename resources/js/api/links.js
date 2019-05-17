import { ApiClient } from '../client'

let client = new ApiClient('http://short.test/api/')

export default {

  shorten (link) {
    return client.post('shorten', link)
  }

}