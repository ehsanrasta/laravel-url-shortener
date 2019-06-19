<script>
  import { Line } from 'vue-chartjs'

  export default {
    name: 'LinkChartComponent',

    props: ['link'],

    extends: Line,

    mounted () {
      let vm = this

      let data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets:
          [{
            data: vm.link.clicksByMonth,
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