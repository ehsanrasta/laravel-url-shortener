<template>
    <div class="mt-10 bg-white p-8 shadow w-full md:w-2/3 mx-auto">
        <p class="uppercase font-semibold text-gray-600">Links</p>
        <ul class="mt-8">
            <li v-for="link in previousLinks" :key="link.id" class="flex flex-row mt-8">
                <i class="fas fa-link text-xl bg-purple-100 text-purple-500 p-3 rounded self-center"></i>
                <div class="flex flex-col ml-8">
                    <a :href="'/' + link.short" class="text-purple-600 font-semibold">{{ APP_URL }}/{{ link.short }}</a>
                    <a :href="link.original" class="text-purple-500 mt-1">{{ link.original | truncate(30) }}</a>
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
    .grow {
        transition: all .2s ease-in-out;
    }

    .grow:hover {
        transform: scale(1.05);
    }
</style>
