<template>
    <div>
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
</template>

<script>
  import linksClient from '../../api/links'

  export default {
    name: 'ShortenLinkForm',

    data () {
      return {
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
          this.$emit('addToPreviousLinks', response.data)
        } catch (error) {
          this.$swal({
            type: 'error',
            title: 'Oops...',
            text: 'Please check your link and try again.',
          })
        }
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
