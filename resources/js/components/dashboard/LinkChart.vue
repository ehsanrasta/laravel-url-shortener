<script>
  import { Bar } from 'vue-chartjs'

  export default {
    name: 'LinkChart',

    props: ['chartData', 'chartLabels'],

    extends: Bar,

    mounted () {
      this.renderAreaChart()
    },

    methods: {
      renderAreaChart () {
        let data = {
          labels: this.chartLabels,
          datasets:
            [{
              data: this.chartData,
              backgroundColor: 'rgba(107, 70, 193, 1)',
              borderColor: 'rgba(107, 70, 193, 1)',
            }]
        }

        let options = {
          scales: {
            yAxes: [{
              display: false,
              ticks: {
                beginAtZero: true,
              },
              gridLines: {
                display: false,
              }
            }],

            xAxes: [{
              display: false,
              gridLines: {
                display: false,
              }
            }]
          },

          legend: {
            display: false
          },

          responsive: true,

          maintainAspectRatio: true,
        }

        this.renderChart(data, options)
      }
    },

    watch: {
      chartData () {
        this.$data._chart.destroy()
        this.renderAreaChart()
      }
    }
  }
</script>
