<template>
    <div>
        <div class="row mb-5">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <link-chart-component></link-chart-component>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-sm-12 col-md-4">
                <link-list-component></link-list-component>
            </div>

            <div class="col-sm-12 col-md-7">
                <selected-link-information-component></selected-link-information-component>
            </div>
        </div>
    </div>
</template>

<script>
  import LinkChartComponent from './LinkChartComponent.vue'
  import LinkListComponent from './LinkListComponent.vue'
  import SelectedLinkInformationComponent from './SelectedLinkInformationComponent.vue'

  export default {
    name: 'DashboardComponent',

    components: {LinkListComponent, LinkChartComponent}
  }
</script>

<style scoped>

</style>