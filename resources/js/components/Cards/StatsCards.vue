<template>
  <div class="flex items-center py-8 bg-gray-50">
    <div class="container px-4 mx-auto sm:px-6 md:px-8">
      <div>
        <h1 class="p-6 text-3xl font-semibold text-center">
          <a href="/search"> {{ overallCreatorsCount }}M Brave Creators </a>
        </h1>
      </div>

      <div class="flex justify-end mb-2 text-xxs">
        <div
          class="flex items-center px-1 py-0.5 space-x-0.5 bg-gray-100 rounded-md"
        >
          <button
            v-for="(option, index) in options"
            :key="index"
            @click="toggle(option)"
            class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
            :class="{ 'bg-white': option === selectedOption }"
          >
            {{ option }}
          </button>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-2 sm:gap-6 xl:grid-cols-4">
        <stats-card
          :stat="stat"
          v-for="stat in stats"
          :period="selectedOption"
        ></stats-card>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, defineComponent, ref } from 'vue'
import StatsCard from './StatsCard'

export default defineComponent({
  name: 'StatsCards',
  components: {
    StatsCard
  },
  props: {
    stats: {
      type: Array,
      required: true
    }
  },
  setup(props) {
    const selectedOption = ref('1M')
    const options = ['1M', '3M', '1Y']
    const toggle = (option) => {
      selectedOption.value = option
    }
    const overallCreatorsCount = computed(() => {
      let stat = props.stats.find((stat) => stat.channel === 'overall')
      return (stat.total_today / 1_000_000).toFixed(1)
    })

    return { options, selectedOption, toggle, overallCreatorsCount }
  }
})
</script>
