<template>
    <div class="mt-10">
        <!-- TODO: List transisitions -->
        <div v-for="link in previousLinks" :key="link.id" class="grow flex items-center justify-between w-2/3 mx-auto h-24 rounded bg-white mt-5">
            <a :href="link.original" class="ml-20 text-purple-500 font-bold">{{ link.original }}</a>

            <div class="ml-auto flex flex-row items-center">
                <a :href="'/' + link.short" class="text-purple-500">{{ APP_URL }}/{{ link.short }}</a>
                <button
                    class="border border-4 bg-white border-purple-500 text-purple-500 hover:text-white hover:bg-purple-500 py-3 px-4 ml-12 rounded-full w-full mr-20 focus:outline-none">
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
