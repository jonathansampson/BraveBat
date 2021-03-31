<template>
  <div>
    <h2 class="py-4 text-xl font-semibold text-center">
      {{ title }}
    </h2>
    <div class="flex justify-end mb-2 mr-6 text-xxs">
      <div
        class="flex items-center px-1 py-0.5 space-x-0.5 bg-gray-200 rounded-md"
      >
        <div v-if="toggleable">
          <button
            v-for="(days, label) in buttons"
            :key="label"
            @click="toggle(days)"
            class="px-1 py-0.5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-200"
            :class="{ 'bg-white': days === filteringDays }"
          >
            {{ label }}
          </button>
        </div>
        <button
          @click="screenshot"
          class="inline-flex items-center justify-center px-1 py-0.5 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-gray-200"
        >
          <svg
            class="w-3 h-3"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
            ></path>
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
            ></path>
          </svg>
        </button>
      </div>
    </div>
    <canvas ref="canvas"> </canvas>
  </div>
</template>

<script>
import { computed, defineComponent, onMounted, ref } from '@vue/runtime-core'
import { useChartData, useLineChatOption } from '../Composables/useChartData'
import Chart from 'chart.js'

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
      required: true
    },
    url: {
      type: String,
      required: true
    },
    toggleable: {
      type: Boolean,
      default: true
    }
  },
  setup(props) {
    const canvas = ref(null)
    const chart = ref(null)
    const data = ref(null)
    const filteringDays = ref(null)
    const imageSrc = ref(null)
    const unit = computed(() =>
      filteringDays.value >= 90 || !filteringDays.value ? 'month' : 'day'
    )

    const buttons = {
      '7D': 7,
      '1M': 30,
      '3M': 90,
      '1Y': 365,
      All: null
    }

    onMounted(() => {
      axios.get(props.url).then((res) => {
        data.value = res.data
        chart.value = new Chart(canvas.value, {
          type: 'line',
          data: useChartData(data.value, null),
          options: useLineChatOption()
        })
      })
    })

    const toggle = (days) => {
      filteringDays.value = days
      let { labels, datasets } = useChartData(data.value, days)
      chart.value.data.labels = labels
      chart.value.data.datasets = datasets
      chart.value.options.scales.xAxes[0].time.unit = unit
      chart.value.update()
    }

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
      toggle,
      buttons,
      filteringDays,
      screenshot,
      imageSrc,
      unit
    }
  }
})
</script>

<style></style>
