<script>
  import { Line } from 'vue-chartjs'

  export default {
    name: 'LinkChartComponent',

    props: ['chartData', 'chartLabels'],

    extends: Line,

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
              backgroundColor: 'rgba(0, 0, 0, 0)',
              borderColor: 'rgba(107, 70, 193, 1)',
            }]
        }

        let options = {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
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
