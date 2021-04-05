<template>
  <div class="relative z-10">
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
    const chart = ref(null)
    const data = ref(null)
    const filteringDays = ref(null)
    const unit = computed(() =>
      filteringDays.value >= 90 || !filteringDays.value ? 'month' : 'day'
    )

    onMounted(() => {
      axios.post(props.url).then((res) => {
        data.value = res.data
        chart.value = new Chart(canvas.value, {
          type: 'line',
          data: useLineChartData(data.value, null, props.brand),
          options: useLineChartOption()
        })
      })
    })

    const toggle = (days) => {
      filteringDays.value = days
      let { labels, datasets } = useLineChartData(data.value, days)
      chart.value.data.labels = labels
      chart.value.data.datasets = datasets
      chart.value.options.scales.xAxes[0].time.unit = unit
      chart.value.update()
    }

    const screenshot = () => {
      let filename = props.url.split(/\//).pop()
      let imageSrc = chart.value.toBase64Image()
      chartScreenshot(filename, imageSrc)
    }

    return {
      canvas,
      chart,
      toggle,
      filteringDays,
      screenshot,
      unit
    }
  }
})
</script>

<style></style>
