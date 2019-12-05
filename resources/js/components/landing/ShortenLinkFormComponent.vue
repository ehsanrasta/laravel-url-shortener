<template>
    <div>
        <div class="flex mx-auto justify-between w-2/3 focus:outline-none border border-transparent focus-within:border-purple-500 rounded-full
                        shadow-md focus-within:shadow-lg">
            <input v-model="original" type="text" class="p-3 pl-5 w-10/12 z-10 text-purple-600 outline-none rounded-l-full"
                   v-on:keyup.enter="shorten()"
                   placeholder="Paste URL">
            <button
                @click="shorten()"
                type="button"
                class="w-6/12 bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-4 z-0 -ml-5 rounded-full focus:outline-none">
                <span class="ml-5 text-lg">Shorten</span>
            </button>
        </div>

        <previous-link-list-component :previous-links="previousLinks" v-if="previousLinks.length > 0"></previous-link-list-component>
    </div>
</template>

<script>
  import linksClient from '../../api/links'

  import PreviousLinkListComponent from './PreviousLinksListComponent.vue'

  export default {
    components: {
      PreviousLinkListComponent,
    },

    data () {
      return {
        previousLinks: [],
        original: '',
      }
    },

    methods: {
      async shorten () {
        let originalCopy = this.addProtocolToLink(this.original)

        let link = {
          id: Math.floor(Math.random() * 50), // todo: this is wrong
          original: originalCopy
        }

        await linksClient.shorten(link).then((response) => {
          this.original = ''

          let {
            id,
            original,
            short
          } = response.data

          this.addToPreviousLinks({id, original, short})
        }).catch((error) => {
          this.$swal({
            type: 'error',
            title: 'Oops...',
            text: 'Please check your link and try again.',
          })
        })
      },

      addToPreviousLinks (link) {
        if (this.previousLinks.length >= 3) {
          let removed = this.previousLinks.splice(-1)
        }

        this.previousLinks.unshift(link)
      },

      addProtocolToLink (link) {
        if (link.substring(0, 8) !== 'https://' && link.substring(0, 7) !== 'http://') {
          link = 'https://' + this.original
        }

        return link
      }
    },
  }
</script>

<style scoped>
</style>
