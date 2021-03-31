<template>
  <div>
    <h2 class="py-4 text-xl font-semibold text-center" v-if="title">
      {{ title }}
    </h2>
    <toggle-panel>
      <button
        @click="screenshot"
        class="inline-flex items-center justify-center px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
      >
        <screenshot-icon class="w-3 h-3"></screenshot-icon>
      </button>
    </toggle-panel>
  </div>
  <canvas ref="canvas"> </canvas>
</template>

<script>
import { defineComponent, ref, onMounted } from '@vue/runtime-core'
import {
  useDonutChartData,
  useDonutChartOption
} from '../Composables/useChartData'
import Chart from 'chart.js'
import ScreenshotIcon from '../Icons/ScreenshotIcon.vue'
import TogglePanel from './TogglePanel'

Chart.plugins.register({
  beforeDraw: function (chartInstance) {
    var ctx = chartInstance.chart.ctx
    ctx.fillStyle = 'white'
    ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height)
  }
})

export default defineComponent({
  props: {
    title: {
      type: String,
      required: false
    },
    url: {
      type: String,
      required: true
    }
  },
  components: {
    ScreenshotIcon,
    TogglePanel
  },
  setup(props) {
    const canvas = ref(null)
    const chart = ref(null)
    const data = ref(null)
    const imageSrc = ref(null)

    onMounted(() => {
      axios.get(props.url).then((res) => {
        data.value = res.data
        console.log(useDonutChartData(data.value))
        chart.value = new Chart(canvas.value, {
          type: 'doughnut',
          data: useDonutChartData(data.value),
          options: useDonutChartOption()
        })
      })
    })

    const screenshot = () => {
      let filename = props.url.split(/\//).pop()
      imageSrc.value = chart.value.toBase64Image()
      let a = document.createElement('a')
      a.href = chart.value.toBase64Image()
      a.download = `${filename}.png`
      a.click()
    }

    return {
      canvas,
      chart,
      screenshot
    }
  }
})
</script>

<style></style>
