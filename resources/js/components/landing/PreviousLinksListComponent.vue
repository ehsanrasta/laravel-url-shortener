<template>
    <div class="mt-10">
        <!-- TODO: List transisitions -->
        <div v-for="link in previousLinks" :key="link.id" class="flex items-center justify-between w-full h-24 bg-white rounded-tr-lg rounded-bl-lg mt-5">
            <p class="text-lg ml-20 text-purple-500 font-bold">{{ link.original }}</p>

            <div class="ml-auto flex flex-row items-center">
                <p class="text-purple-500">{{ APP_URL }}/{{ link.short }}</p>
                <button
                    class="border border-2 border-purple-500 text-white text-purple-500 hover:bg-purple-500 hover:text-white py-3 px-4 ml-12 rounded-full w-full mr-20 focus:outline-none">
                    Copy
                </button>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'PreviousLinkListComponent',

    // todo: implement copy

    data () {
      return {
        APP_URL: process.env.MIX_APP_URL,
        copiedIndex: undefined,
      }
    },

    props: {
      previousLinks: [],
    },

    methods: {
      copy (shortLink, index) {
        const el = document.createElement('textarea')
        el.value = process.env.MIX_APP_URL + shortLink
        document.body.appendChild(el)
        el.select()
        document.execCommand('copy')
        document.body.removeChild(el)

        this.setCopiedIndex(index)

        setTimeout(() => {
          this.setCopiedIndex(undefined)
        }, 1500)
      },

      setCopiedIndex (index) {
        this.copiedIndex = index
      }
    }
  }
</script>

<style scoped>

</style>
