<template>
    <div>
        <div class="row mb-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <link-chart-component :link="selectedLink"></link-chart-component>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-sm-12 col-md-5">
                <link-list-component :links="links" v-model="selectedLink"></link-list-component>
            </div>
        </div>
    </div>
</template>

<script>
  import LinkChartComponent from './LinkChartComponent.vue'
  import LinkListComponent from './LinkListComponent.vue'

  import LinksClient from '../../api/links'

  export default {
    name: 'DashboardComponent',

    components: {LinkChartComponent, LinkListComponent},

    data () {
      return {
        selectedLink: undefined,

        links: [],
      }
    },

    async mounted () {
      let vm = this

      await LinksClient.getAllLinksForUser().then((response) => {
        response.data.forEach(function (element) {
          vm.links.push(element)
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
