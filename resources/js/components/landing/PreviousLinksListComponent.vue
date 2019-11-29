<template>
    <ul class="list-group">
        <li class="list-group-item d-flex flex-wrap align-items-center mb-1"
            v-for="(link, index) in previousLinks">

            <span class="mr-auto">{{ link.original | truncate(40) }}</span>

            <a :href="'http://short.test/' + link.short" class="mr-1" target="_blank">http://short.test/{{
                link.short }}</a>

            <button @click="copy(link.short, index)" class="btn col-sm-12 col-md-1" type="button"
                    v-bind:class="{ 'btn-secondary': copiedIndex !== index, 'btn-success': copiedIndex === index }">
                <span v-if="copiedIndex !== index">Copy</span>
                <span v-if="copiedIndex === index">Copied!</span>
            </button>
        </li>
    </ul>
</template>

<script>
  export default {
    name: 'PreviousLinkListComponent',

    data () {
      return {
        copiedIndex: undefined,
      }
    },

    props: {
      previousLinks: [],
    },

    methods: {
      copy (shortLink, index) {
        const el = document.createElement('textarea')
        el.value = 'http://short.test/' + shortLink
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