window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import InstantSearch from './components/InstantSearch.vue'
import AdvancedSearch from './components/AdvancedSearch.vue'
import ToggleableLineChart from './components/Charts/ToggleableLineChart.vue'
import CreatorDonutChart from './components/Charts/CreatorDonutChart.vue'
import { createApp } from 'vue'
import Chart from 'chart.js'

Chart.plugins.register({
  beforeDraw: function (chartInstance) {
    var ctx = chartInstance.chart.ctx
    ctx.fillStyle = 'white'
    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height)
  }
})

const app = createApp({
  components: {
    ToggleableLineChart,
    InstantSearch,
    CreatorDonutChart,
    AdvancedSearch
  }
})
app.mount('#app')
