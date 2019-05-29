<template>
    <div id="linkChartContainer">
        <apexchart :options="chartOptions" :series="series" height="100%" type="bar" width="100%"></apexchart>
    </div>
</template>

<script>
  export default {
    name: 'LinkChartComponent',

    data: function () {
      return {
        chartOptions: {
          chart: {
            id: 'vuechart'
          },
          xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          }
        },
        series: [{
          name: 'Clicks',
          data: [2, 10, 13, 5, 18, 53, 25, 30, 37, 42, 61, 72]
        }]
      }
    },
  }
</script>

<style scoped>
    #linkChartContainer {
        position: relative;
        width: 100%;
        height: 300px;
    }
</style>