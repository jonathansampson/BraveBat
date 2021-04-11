<template>
  <div>
    <h2 class="py-4 text-xl font-semibold text-center">
      {{ title }}
    </h2>
    <toggle-panel @screenshot="screenshot" :title="title"> </toggle-panel>
  </div>
  <canvas ref="canvas" :aria-label="title" role="img"> </canvas>
</template>

<script>
import { defineComponent, ref, onMounted } from '@vue/runtime-core'
import {
  useDonutChartData,
  useDonutChartOption
} from '../Composables/useChartData'
import { Chart } from 'chart.js'
import TogglePanel from './TogglePanel'
import useChartScreenshot from '../Composables/useChartScreenshot'

export default defineComponent({
  props: {
    title: {
      type: String,
      required: true
    },
    url: {
      type: String,
      required: true
    }
  },
  components: {
    TogglePanel
  },
  setup(props) {
    const { chartScreenshot } = useChartScreenshot()
    const canvas = ref(null)
    let data = null
    let chart = null

    onMounted(() => {
      axios.post('/api/v2' + props.url).then((res) => {
        data = res.data
        chart = new Chart(canvas.value, {
          type: 'doughnut',
          data: useDonutChartData(data, 'channel', 'total_today'),
          options: useDonutChartOption()
        })
      })
    })

    const screenshot = () => {
      let filename = props.url.split(/\//).pop()
      let imageSrc = chart.toBase64Image()
      chartScreenshot(filename, imageSrc)
    }

    return {
      canvas,
      screenshot
    }
  }
})
</script>

<style></style>
