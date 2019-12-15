<template>
    <div class="rounded mt-10 bg-white p-6 shadow w-full md:w-2/3 mx-auto">
        <p class="uppercase font-semibold text-gray-600">Links</p>
        <ul>
            <li v-for="link in previousLinks" :key="link.id" class="flex flex-row mt-6 border-b border-gray-300 items-center pb-3">
                <i class="fas fa-link text-xl bg-purple-100 text-purple-500 p-2 rounded self-center"></i>
                <div class="flex flex-col ml-6 w-full">
                    <a :href="'/' + link.short" class="text-purple-600 font-semibold">{{ APP_URL }}/{{ link.short }}</a>
                    <a :href="link.original" class="text-purple-500">{{ link.original | truncate(25) }}</a>
                </div>
            </li>
        </ul>
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
</style>
