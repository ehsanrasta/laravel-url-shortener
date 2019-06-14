<template>
    <div>
        <div class="d-flex justify-content-between">
            <p class="form-text text-muted py-0 my-0">{{ allLinks.length }} links</p>
            <p class="form-text text-muted py-0 my-0">Clicks all time</p>
        </div>

        <ul class="list-group overflow-auto" style="max-height: 300px">
            <li :class="{ 'active' : isSelected(index) }"
                @click="setSelected(link, index)"
                class="d-flex align-items-start flex-column list-group-item list-group-item-action" href="#some-link"
                style="cursor: pointer;" v-for="(link, index) in allLinks">
                <small class="d-flex w-100 text-uppercase">{{ link.created_at | momentDay }}</small>
                <div class="d-flex w-100 justify-content-between">
                    <h5>{{ link.original | truncate(30) }}</h5>
                    <span>{{ link.clicks }} <i class="far fa-chart-bar"></i></span>
                </div>
                <p>
                    <small>short.test/<b>{{ link.short }}</b></small>
                </p>
            </li>
        </ul>
    </div>
</template>

<script>
  import linksClient from './../api/links'

  export default {
    name: 'LinkListComponent',

    data () {
      return {
        allLinks: [],
        selectedIndex: -1,
        selectedLink: {},
      }
    },

    methods: {
      setSelected (link, index) {
        this.selectedLink = link
        this.selectedIndex = index
      },

      isSelected (index) {
        return index === this.selectedIndex
      }
    },

    async mounted () {
      let vm = this

      await linksClient.getAllLinksForUser().then((response) => {
        response.data.forEach(function (element) {
          vm.allLinks.push(element)
        })
      }).catch((error) => {
        this.$swal({
          type: 'error',
          title: 'Oops...',
          text: 'There was an error loading your past links.',
        })
      })
    }
  }
</script>

<style scoped>

</style>