window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import InstantSearch from './components/Search/InstantSearch.vue'
import AdvancedSearch from './components/Search/AdvancedSearch.vue'
import ToggleableLineChart from './components/Charts/ToggleableLineChart.vue'
import CreatorDonutChart from './components/Charts/CreatorDonutChart.vue'
import { createApp } from 'vue'

import {
  Chart,
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip
} from 'chart.js'

Chart.register(
  ArcElement,
  LineElement,
  BarElement,
  PointElement,
  BarController,
  BubbleController,
  DoughnutController,
  LineController,
  PieController,
  PolarAreaController,
  RadarController,
  ScatterController,
  CategoryScale,
  LinearScale,
  LogarithmicScale,
  RadialLinearScale,
  TimeScale,
  TimeSeriesScale,
  Decimation,
  Filler,
  Legend,
  Title,
  Tooltip
)

import 'chartjs-adapter-date-fns'

import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

Chart.register({
  id: 'background-white',
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
