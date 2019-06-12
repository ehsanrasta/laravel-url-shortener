<script>
  import { Line } from 'vue-chartjs'

  export default {
    name: 'LinkChartComponent',

    extends: Line,

    mounted () {
      let data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets:
          [{
            data: [10, 20, 15, 5, 30, 60, 70, 20, 30, 10, 50, 70],
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
  }
</script>