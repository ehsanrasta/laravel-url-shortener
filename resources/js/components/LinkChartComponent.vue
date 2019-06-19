<script>
  import { Line } from 'vue-chartjs'

  export default {
    name: 'LinkChartComponent',

    props: ['link'],

    extends: Line,

    computed: {
      chartData: function () {
        return this.link.clicksByMonth
      }
    },

    mounted () {
      this.renderAreaChart()
    },

    methods: {
      renderAreaChart () {
        let data = {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets:
            [{
              data: this.chartData,
              backgroundColor: 'rgba(52, 144, 220, 0.2)',
              borderColor: 'rgba(52, 144, 220, 1)',
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

          maintainAspectRatio: false,
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