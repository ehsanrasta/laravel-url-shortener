<template>
    <div class="card">
        <div class="card-body">
            <small class="text-muted text-uppercase">
                Created {{ link.created_at | momentDayYear }} |
            </small>

            <small>
                <a href="">etienneac</a>
            </small>

            <h4 class="mt-3 mb-3">{{ link.original }}</h4>

            <p class="mr-2" style="display: inline"><a :href="link.short">short.test/<b>{{ link.short
                }}</b></a>
            </p>
            <div class="btn btn-outline-primary btn-sm">Copy</div>
            <div class="btn btn-outline-primary btn-sm">Edit</div>

            <hr>

            <div class="d-flex flex-column align-items-start">
                <h4 style="display: inline">{{ link.clicks }} <i class="far fa-chart-bar"></i></h4>
                <small class="d-flex text-muted text-uppercase mb-1">Total clicks</small>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'SelectedLinkInformationComponent',

    props: ['link'],
  }
</script>

<style scoped>

</style>