/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

window.moment = require('moment')

import VueSweetalert2 from 'vue-sweetalert2'
import VueApexCharts from 'vue-apexcharts'
import BootstrapVue from 'bootstrap-vue'

window.Vue.use(VueSweetalert2)
window.Vue.use(VueApexCharts)
window.Vue.use(BootstrapVue)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('shorten-link-form-component', require('./components/ShortenLinkFormComponent.vue').default)

Vue.component('previous-links-component', require('./components/PreviousLinksListComponent.vue').default)

Vue.component('apexchart', VueApexCharts)

Vue.component('link-chart-component', require('./components/LinkChartComponent.vue').default)

Vue.component('all-links-component', require('./components/LinksListComponent.vue').default)

Vue.component('selected-link-information-component', require('./components/SelectedLinkInformationComponent.vue').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.filter('truncate', function (text, stop, clamp) {
  return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
})

Vue.filter('momentDay', function (text) {
  return moment(text).format('MMM D')
})

const app = new Vue({
  el: '#app',
})
