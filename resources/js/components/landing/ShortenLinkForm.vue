<template>
    <div>
        <div class="flex mx-auto justify-between sm:w-full md:w-2/3 focus:outline-none border border-transparent focus-within:border-purple-500 rounded-full
                        shadow-md focus-within:shadow-lg">
            <input v-model="original" type="text" class="p-3 pl-5 w-10/12 z-10 text-purple-600 outline-none rounded-l-full"
                   autocorrect="off" autocapitalize="none"
                   v-on:keyup.enter="shorten()"
                   placeholder="Paste URL">
            <button
                @click="shorten()"
                type="button"
                class="w-6/12 bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-4 z-0 -ml-5 rounded-full focus:outline-none">
                <span class="ml-5 text-lg">Shorten</span>
            </button>
        </div>

        <previous-links-list :previous-links="previousLinks" v-if="previousLinks.length > 0"></previous-links-list>

        <div v-if="previousLinks.length === 0" class="rounded text-gray-600 mt-10 bg-white p-8 shadow w-full md:w-2/3 mx-auto">
            <p class="font-semibold">Hey!</p>
            <p class="mt-2">This feels empty...</p>
            <p>Start by adding some links 👆</p>
            <p>Then view your dashboard for some <span>📈</span></p>
        </div>
    </div>
</template>

<script>
  import linksClient from '../../api/links'

  import PreviousLinksList from './PreviousLinksList.vue'

  export default {
    name: 'ShortenLinkForm',

    components: {
      PreviousLinksList,
    },

    data () {
      return {
        previousLinks: [],
        original: '',
      }
    },

    methods: {
      async shorten () {
        const link = {
          original: this.addProtocolToLink(this.original)
        }

        try {
          const response = await linksClient.shorten(link)
          this.original = ''
          this.addToPreviousLinks(response.data)
        } catch (error) {
          this.$swal({
            type: 'error',
            title: 'Oops...',
            text: 'Please check your link and try again.',
          })
        }
      },

      addToPreviousLinks (link) {
        if (this.previousLinks.length >= 3) {
          this.previousLinks.splice(-1)
        }

        this.previousLinks.unshift(link)
      },

      addProtocolToLink (link) {
        if (link.substring(0, 8) !== 'https://' && link.substring(0, 7) !== 'http://') {
          link = 'https://' + link
        }

        return link
      }
    },
  }
</script>

<style scoped>
</style>
