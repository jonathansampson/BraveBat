<template>
  <div>
    <h2 class="py-4 text-xl font-semibold text-center">
      {{ title }}
    </h2>
    <toggle-panel @screenshot="screenshot" :title="title"> </toggle-panel>
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
    const chart = ref(null)
    const data = ref(null)

    onMounted(() => {
      axios.post(props.url).then((res) => {
        data.value = res.data
        chart.value = new Chart(canvas.value, {
          type: 'doughnut',
          data: useDonutChartData(data.value),
          options: useDonutChartOption()
        })
      })
    })

    const screenshot = () => {
      let filename = props.url.split(/\//).pop()
      let imageSrc = chart.value.toBase64Image()
      chartScreenshot(filename, imageSrc)
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
