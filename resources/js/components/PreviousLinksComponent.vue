<template>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center mb-1"
            v-for="(link, index) in previousLinks">
            {{ link.original | truncate(40) }}

            <div>
                <a :href="'http://short.test/' + link.short" target="_blank">http://short.test/{{ link.short }}</a>
                <button @click="copy(link.short, index)" class="btn ml-3" type="button"
                        v-bind:class="{ 'btn-secondary': copiedIndex !== index, 'btn-success': copiedIndex === index }">
                    <span v-if="copiedIndex !== index">Copy</span>
                    <span v-if="copiedIndex === index">Copied!</span>
                </button>
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    name: 'PreviousLinksComponent',

    data () {
      return {
        copiedIndex: undefined,
      }
    },

    computed: {
      previousLinks () {
        return this.$store.state.previousLinks
      }
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