<template>
    <div class="flex mx-auto justify-between focus:outline-none border border-transparent focus-within:border-purple-500 rounded-full">
        <input v-model="original" type="text" class="p-3 pl-5 w-10/12 z-10 text-purple-600 outline-none rounded-l-full"
               required
               autocorrect="off" autocapitalize="none"
               @keyup.enter="shorten()"
               placeholder="Enter URL">
        <button
            @submit.prevent=""
            @click.prevent="shorten()"
            type="submit"
            class="w-6/12 bg-purple-500 hover:bg-purple-600 text-white font-bold py-3 px-4 z-0 -ml-5 rounded-full focus:outline-none">
            <span v-if="! isLoading" class="ml-5 text-lg">Shorten</span>
            <span>
                <clip-loader :loading="isLoading" :color="'#5dc596'" :size="'21px'" class="ml-6"></clip-loader>
            </span>
        </button>
    </div>
</template>

<script>
  import linksClient from '../../api/links'

  export default {
    name: 'ShortenLinkForm',

    data () {
      return {
        isLoading: false,
        original: '',
      }
    },

    methods: {
      async shorten () {
        this.isLoading = true

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
            text: 'Something went wrong!',
            confirmButtonColor: '#805ad5',
          })
        } finally {
          this.isLoading = false
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
