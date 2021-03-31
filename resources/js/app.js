window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import InstantSearch from './components/InstantSearch.vue'
import ToggleableLineChart from './components/Charts/ToggleableLineChart.vue'
import CreatorDonutChart from './components/Charts/CreatorDonutChart.vue'
import { createApp } from 'vue'

const app = createApp({
  components: {
    ToggleableLineChart,
    InstantSearch,
    CreatorDonutChart
  }
})
app.mount('#app')
