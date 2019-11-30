<template>
    <div>
        <div class="container mx-auto pt-10 flex md:flex-row sm:justify-between flex-wrap cursor-default">
            <stat-counter :icon="'fa-users'" :fg-color="'text-blue-500'" :bg-color="'bg-blue-100'"></stat-counter>
            <stat-counter :icon="'fa-bullseye'" :fg-color="'text-purple-500'" :bg-color="'bg-purple-100'"></stat-counter>
            <stat-counter :icon="'fa-heart'" :fg-color="'text-green-500'" :bg-color="'bg-green-100'"></stat-counter>
            <!-- todo selectedLink -->
        </div>

        <div class="container mx-auto shadow bg-white rounded p-5">
            <link-chart-component :height="100" :chart-data="[45, 34, 56, 34, 78, 23, 56, 17, 15, 90, 12, 67]"></link-chart-component>
            <!-- todo selectedLink -->
        </div>

        <div class="container mt-10 mx-auto shadow bg-white rounded p-5">
            <link-list-component :links="links"></link-list-component>
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
