<template>
    <div class="mt-10">
        <div v-for="link in previousLinks" :key="link.id" class="flex flex-col md:flex-row md:items-center md:justify-between w-2/3 mx-auto rounded bg-white mt-5 p-4">
            <a :href="link.original" class="text-purple-500 hover:underline">{{ link.original | truncate(30) }}</a>

            <div class="flex flex-col md:w-1/2 md:flex-row md:items-center md:justify-end">
                <a :href="'/' + link.short" class="mt-5 md:mt-0 font-bold text-purple-500 hover:underline">{{ APP_URL }}/{{ link.short }}</a>
                <button
                    class="mt-5 md:mt-0 md:w-1/3 md:ml-3 w-full py-2 px-4 border bg-white border-purple-500 text-purple-500 hover:text-white hover:bg-purple-500 rounded-full focus:outline-none">
                    Copy
                </button>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'PreviousLinksList',

    data () {
      return {
        APP_URL: process.env.MIX_APP_URL,
        copiedIndex: undefined,
      }
    },

    props: ['previousLinks'],

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
    .grow { transition: all .2s ease-in-out; }
    .grow:hover { transform: scale(1.05); }
</style>
