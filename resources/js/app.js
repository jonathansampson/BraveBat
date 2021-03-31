window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import Chart from 'chart.js'
import InstantSearch from './components/InstantSearch.vue'
import ToggleableLineChart from './components/Charts/ToggleableLineChart.vue'
import { createApp } from 'vue'

const app = createApp({
  components: {
    ToggleableLineChart,
    InstantSearch
  }
})

// import upperFirst from 'lodash/upperFirst'
// import camelCase from 'lodash/camelCase'
// const requireComponent = require.context(
//   './components',
//   true,
//   /Base[A-Z]\w+\.(vue|js)$/
// )

// requireComponent.keys().forEach((fileName) => {
//   const componentConfig = requireComponent(fileName)

//   const componentName = upperFirst(
//     camelCase(
//       fileName
//         .split('/')
//         .pop()
//         .replace(/\.\w+$/, '')
//     )
//   )

//   app.component(componentName, componentConfig.default || componentConfig)
// })

app.mount('#app')
