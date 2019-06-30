<template>
    <div>
        <div class="d-flex justify-content-between">
            <p class="form-text text-muted py-0 my-0">{{ links.length }} links</p>
            <p class="form-text text-muted py-0 my-0">Clicks all time</p>
        </div>

        <ul class="list-group overflow-auto" style="max-height: 300px">
            <li :class="{ 'active' : isSelected(index) }"
                @click="setSelected(link, index)"
                class="d-flex align-items-start flex-column list-group-item list-group-item-action" href="#some-link"
                style="cursor: pointer;"
                v-for="(link, index) in links">
                <small class="d-flex w-100 text-uppercase">{{ link.created_at | momentDay }}</small>
                <div class="d-flex w-100 justify-content-between">
                    <h5>{{ link.original | truncate(30) }}</h5>
                    <span>{{ 5 }} <i class="far fa-chart-bar"></i></span>
                </div>
                <p>
                    <small>short.test/<b>{{ link.short }}</b></small>
                </p>
            </li>
        </ul>
    </div>
</template>

<script>
  export default {
    name: 'LinkListComponent',

    props: {
      links: [],
    },

    data () {
      return {
        selectedIndex: undefined,
        selectedLink: undefined,
      }
    },

    methods: {
      setSelected (link, index) {
        this.selectedLink = link
        this.selectedIndex = index

        this.$emit('input', link)
      },

      isSelected (index) {
        return index === this.selectedIndex
      }
    },
  }
</script>

<style scoped>

</style>