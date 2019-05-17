import linksClient from './../api/links'

let actions = {
  async shorten ({commit}, link) {
    await linksClient.shorten(link)
      .then((response) => {
        let {
          id,
          original,
          short,
        } = response.data

        commit('CREATE_LINK', {id, original, short})
      })
  }
}

export default actions