<template>
    <div>
        <div class="d-flex justify-content-between">
            <p class="form-text text-muted py-0 my-0">{{ links.length }} links</p>
            <p class="form-text text-muted py-0 my-0">Clicks all time</p>
        </div>

        <ul class="list-group overflow-auto" style="max-height: 300px">
            <li class="d-flex align-items-start flex-column list-group-item" href="#some-link" v-for="link in links">
                <small class="d-flex w-100 text-uppercase">May 29</small>
                <div class="d-flex w-100 justify-content-between">
                    <h5>twitter.com</h5>
                    <span>5 <i class="far fa-chart-bar"></i></span>
                </div>
                <a href="">
                    <small>short.test/<b>jW8Kl2</b></small>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
  export default {
    name: 'LinksListComponent',

    data () {
      return {
        links: [{}, {}, {}]
      }
    }
  }
</script>

<style scoped>

</style>