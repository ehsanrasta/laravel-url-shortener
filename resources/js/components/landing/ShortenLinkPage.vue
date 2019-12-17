<template>
    <div class="p-3">
        <shorten-link-form
            v-on:addToPreviousLinks="addToPreviousLinks"
            class="flex mx-auto justify-between sm:w-full md:w-2/3 focus:outline-none border border-transparent focus-within:border-purple-500 rounded-full">
        </shorten-link-form>

        <links-list :links="previousLinks" v-if="previousLinks.length > 0" class="rounded mt-10 bg-white p-6 shadow w-full md:w-2/3 mx-auto">
            <template v-slot:list-title>Links</template>
            <template v-slot:list-item="{ link, selected }">
                <previous-links-list-item :link="link" :selected="selected"></previous-links-list-item>
            </template>
        </links-list>

        <div v-if="previousLinks.length === 0" class="md:w-2/3 mt-10 mx-auto">
            <notification>
                <template v-slot:title>Hey!</template>
                <template v-slot:body>
                    <p>This feels empty...</p>
                    <p>Start by adding some links 👆</p>
                    <p>Then view your dashboard for some <span>📈</span></p>
                </template>
            </notification>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'ShortenLinkPage',

    data () {
      return {
        previousLinks: [],
      }
    },

    methods: {
      addToPreviousLinks (link) {
        if (this.previousLinks.length >= 3) {
          this.previousLinks.splice(-1)
        }

        this.previousLinks.unshift(link)
      },
    }
  }
</script>

<style scoped>

</style>
