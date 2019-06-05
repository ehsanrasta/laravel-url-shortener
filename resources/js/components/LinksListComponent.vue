<template>
    <div>
        <div class="d-flex justify-content-between">
            <p class="form-text text-muted py-0 my-0">{{ allLinks.length }} links</p>
            <p class="form-text text-muted py-0 my-0">Clicks all time</p>
        </div>

        <ul class="list-group overflow-auto" style="max-height: 300px">
            <li class="d-flex align-items-start flex-column list-group-item" href="#some-link" v-for="link in allLinks">
                <small class="d-flex w-100 text-uppercase">{{ link.created_at | momentDay }}</small>
                <div class="d-flex w-100 justify-content-between">
                    <h5>{{ link.original | truncate(30) }}</h5>
                    <span>{{ link.total_clicks }} <i class="far fa-chart-bar"></i></span>
                </div>
                <a :href="'http://short.test/' + link.short">
                    <small>short.test/<b>{{ link.short }}</b></small>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
  export default {
    name: 'LinksListComponent',

    data () {
      return {}
    },

    computed: {
      allLinks () {
        return this.$store.state.allLinks
      }
    },

    mounted () {
      this.$store.dispatch('getAllLinksForUser')
    }
  }
</script>

<style scoped>

</style>