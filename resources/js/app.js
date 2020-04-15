window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

Vue.component('line-chart', require('./components/LineChart.vue').default);

const app = new Vue({
    el: '#app',
});
