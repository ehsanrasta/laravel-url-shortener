<template>
    <div>
        <div class="container mx-auto flex flex-col px-10 sm:p-0 sm:flex-row sm:justify-between cursor-default">
            <stat-counter
                :icon="'fa-users'"
                :fg-color="'text-blue-500'"
                :bg-color="'bg-blue-100'"
                :value="this.selectedLink.totalClicks"
                :description="'Total Followers'"></stat-counter>
            <stat-counter
                :icon="'fa-eye'"
                :fg-color="'text-purple-500'"
                :bg-color="'bg-purple-100'"
                :value="this.selectedLink.totalClicks"
                :description="'Total Clicks'"></stat-counter>
            <stat-counter
                :icon="'fa-heart'"
                :fg-color="'text-green-500'"
                :bg-color="'bg-green-100'"
                :value="this.selectedLink.totalClicks"
                :description="'Total Reach'"></stat-counter>
        </div>

        <div class="container mx-auto shadow bg-white rounded px-10 sm:p-0">
            <link-chart :height="100" :chart-data="this.selectedLink.clicksByMonth" :chart-labels="chartLabels"></link-chart>
        </div>

        <div class="mt-10 px-10 sm:p-0">
            <link-list v-if="links.length > 0" :links="links" v-model="selectedLink"></link-list>
        </div>
    </div>
</template>

<script>
  import StatCounter from './StatCounter.vue'

  import LinksClient from '../../api/links'
  import LinkChart from './LinkChart'
  import LinkList from './LinkList'

  export default {
    name: 'Dashboard',

    components: {LinkList, LinkChart, StatCounter},

    data () {
      return {
        APP_URL: process.env.MIX_APP_URL,

        selectedLink: {},

        chartLabels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],

        links: [],
      }
    },

    async mounted () {
      let vm = this

      try {
        const response = await LinksClient.getAllLinksForUser()
        response.data.forEach(function (link) {
          vm.links.push(link)
        })
      } catch (error) {
        this.$swal({
          type: 'error',
          title: 'Oops...',
          text: 'There was an error loading your past links.',
        })
      }
    },
  }
</script>

<style scoped>

</style>
