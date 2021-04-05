<template>
  <div>
    <h2 class="py-4 text-xl font-semibold text-center" v-html="title"></h2>
    <toggle-panel
      :toggleable="toggleable"
      @screenshot="screenshot"
      @toggle="toggle"
      :title="title"
    >
    </toggle-panel>
    <canvas ref="canvas"> </canvas>
  </div>
</template>

<script>
import { computed, defineComponent, onMounted, ref } from '@vue/runtime-core'
import {
  useLineChartData,
  useLineChartOption
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
    },
    toggleable: {
      type: Boolean,
      default: true
    },
    brand: {
      type: String,
      required: false,
      default: null
    }
  },
  components: {
    TogglePanel
  },
  setup(props) {
    const { chartScreenshot } = useChartScreenshot()
    const canvas = ref(null)
    const filteringDays = ref(null)
    const unit = computed(() =>
      filteringDays.value >= 90 || !filteringDays.value ? 'month' : 'day'
    )
    let chart = null
    let data = null

    onMounted(() => {
      axios.post(props.url).then((res) => {
        data = res.data
        chart = new Chart(canvas.value, {
          type: 'line',
          data: useLineChartData(data, null, props.brand),
          options: useLineChartOption()
        })
      })
    })

    const toggle = (days) => {
      filteringDays.value = days
      let { labels, datasets } = useLineChartData(data, days)
      chart.data.labels = labels
      chart.data.datasets = datasets
      chart.options.scales.x.time.unit = unit.value
      chart.update()
    }

    const screenshot = () => {
      let filename = props.url.split(/\//).pop()
      let imageSrc = chart.toBase64Image()
      chartScreenshot(filename, imageSrc)
    }

    return {
      canvas,
      toggle,
      screenshot,
      filteringDays,
      unit
    }
  }
})
</script>

<style></style>
