let mutations = {
  CREATE_LINK (state, link) {
    Object.assign(state.link, link)

    addToPreviousLinks(state, link)
  },

  ADD_LINKS (state, links) {
    links.forEach(function (element) {
      state.allLinks.push(element)
    })
  }
}

function addToPreviousLinks (state, link) {
  if (state.previousLinks.length >= 3) {
    let removed = state.previousLinks.splice(-1)
  }

  state.previousLinks.unshift(link)
}

export default mutations