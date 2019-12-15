<template>
    <div>
        <div v-if="links.length > 0"
             class="container mx-auto shadow bg-white rounded sm:p-0">
            <link-chart :height="100" :chart-data="this.selectedLink.clicksByMonth" :chart-labels="chartLabels"></link-chart>
        </div>

        <div v-if="links.length > 0"
             class="mt-10">
            <link-list :links="links" v-model="selectedLink"></link-list>
        </div>

        <div v-if="links.length === 0"
             class="rounded text-gray-600 bg-white p-8 shadow w-full md:w-2/3 mx-auto">
            <p class="font-semibold">Hey!</p>
            <p class="mt-2">There's nothing here...</p>
            <a href="/" class="text-blue-500 hover:underline">Start by adding some links ✨</a>
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
