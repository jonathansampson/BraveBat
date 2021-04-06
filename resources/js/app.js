window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import InstantSearch from './components/Search/InstantSearch.vue'
import AdvancedSearch from './components/Search/AdvancedSearch.vue'
import ChannelSearch from './components/Search/ChannelSearch.vue'
import ToggleableLineChart from './components/Charts/ToggleableLineChart.vue'
import CreatorDonutChart from './components/Charts/CreatorDonutChart.vue'
import { createApp } from 'vue'

import {
  Chart,
  ArcElement,
  LineElement,
  PointElement,
  DoughnutController,
  LineController,
  CategoryScale,
  LinearScale,
  TimeScale,
  Tooltip,
  Legend
} from 'chart.js'

Chart.register(
  ArcElement,
  CategoryScale,
  DoughnutController,
  LineElement,
  LineController,
  PointElement,
  LinearScale,
  TimeScale,
  Tooltip,
  Legend
)

import 'chartjs-adapter-date-fns'

import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

Chart.register({
  id: 'p1',
  beforeDraw: function (chart, args, options) {
    var ctx = chart.ctx
    ctx.fillStyle = 'white'
    ctx.fillRect(0, 0, chart.width, chart.height)
  }
})

const app = createApp({
  components: {
    ToggleableLineChart,
    InstantSearch,
    CreatorDonutChart,
    AdvancedSearch,
    ChannelSearch
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
