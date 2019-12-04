<template>
    <div>
        <div class="container mx-auto flex md:flex-row sm:justify-between flex-wrap cursor-default">
            <stat-counter :icon="'fa-users'" :fg-color="'text-blue-500'" :bg-color="'bg-blue-100'"></stat-counter>
            <stat-counter :icon="'fa-bullseye'" :fg-color="'text-purple-500'" :bg-color="'bg-purple-100'"></stat-counter>
            <stat-counter :icon="'fa-heart'" :fg-color="'text-green-500'" :bg-color="'bg-green-100'"></stat-counter>
            <!-- todo selectedLink -->
        </div>

        <div class="container mx-auto shadow bg-white rounded p-5">
            <link-chart-component :height="100" :chart-data="clicksByMonth" :chart-labels="chartLabels"></link-chart-component>
            <!-- todo selectedLink -->
        </div>

        <div class="container overflow-x-auto mt-10 shadow rounded bg-white">
            <link-list-component v-if="links.length > 0" :links="links" v-model="selectedLink"></link-list-component>
            <!-- todo selectedLink -->
        </div>
    </div>
</template>

<script>
  import StatCounter from './StatCounter.vue'

  import LinksClient from '../../api/links'
  import LinkChartComponent from './LinkChartComponent'
  import LinkListComponent from './LinkListComponent'

  export default {
    name: 'DashboardComponent',

    components: {LinkListComponent, LinkChartComponent, StatCounter},

    data () {
      return {
        selectedLink: null,

        chartLabels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

        links: [],
      }
    },

    computed: {
      clicksByMonth () {
        if (this.selectedLink !== null) {
          return this.selectedLink.clicksByMonth
        }

        return [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
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
