window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import InstantSearch from './components/InstantSearch.vue'
import AdvancedSearch from './components/AdvancedSearch.vue'
import ToggleableLineChart from './components/Charts/ToggleableLineChart.vue'
import CreatorDonutChart from './components/Charts/CreatorDonutChart.vue'
import { createApp } from 'vue'
import Chart from 'chart.js'

import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

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

const requireComponent = require.context(
  './components/Base',
  true,
  /Base[A-Z]\w+\.(vue|js)$/
)
requireComponent.keys().forEach((fileName) => {
  const componentConfig = requireComponent(fileName)
  const componentName = upperFirst(
    camelCase(
      fileName
        .split('/')
        .pop()
        .replace(/\.\w+$/, '')
    )
  )
  app.component(componentName, componentConfig.default || componentConfig)
})
app.mount('#app')
