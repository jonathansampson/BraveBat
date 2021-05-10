<template>
  <a
    class="p-2 bg-white rounded shadow-sm  sm:p-5 hover:bg-orange-50 focus:ring-2 focus:ring-brand-orange focus:outline-none"
    :href="channelUrl"
  >
    <div class="relative flex items-center space-x-2 sm:space-x-4">
      <div class="absolute top-0 right-0">
        <base-pill-green-rounded
          class="text-xxs sm:text-xs px-2 py-0.5"
          v-if="channelGrowth >= 0"
        >
          <base-icon-up class="w-3 h-3"></base-icon-up>
          <span>{{ channelGrowth }}%</span>
        </base-pill-green-rounded>
        <base-pill-red-rounded class="text-xs px-1 py-0.5" v-else>
          <base-icon-down class="w-3 h-3"></base-icon-down>
          <span>{{ -channelGrowth }}%</span>
        </base-pill-red-rounded>
      </div>
      <div>
        <div
          class="flex items-center justify-center w-8 h-8 rounded-full  sm:w-12 sm:h-12 bg-gray-50"
        >
          <component
            :is="channelLogo"
            class="w-4 h-4 sm:w-6 sm:h-6"
          ></component>
        </div>
      </div>
      <div>
        <div class="text-xs text-gray-400 sm:text-base">
          {{ channelName }}
        </div>
        <div class="text-lg font-bold text-gray-900 sm:text-2xl">
          {{ channelCount }}
        </div>
      </div>
    </div>
  </a>
</template>

<script>
import { computed, defineComponent } from '@vue/runtime-core'
import useCapitalize from '../Composables/useCapitalize'

export default defineComponent({
  name: 'StatsCard',
  props: {
    stat: {
      type: Object,
      required: true
    },
    period: {
      type: String,
      required: true
    }
  },
  setup(props) {
    const { capitalize } = useCapitalize()
    const channelLogo = computed(() => {
      return props.stat.channel === 'overall'
        ? 'base-logo-brave'
        : `base-logo-${props.stat.channel}`
    })
    const channelUrl = computed(() => {
      if (props.stat.channel === 'overall' || props.stat.channel === 'reddit') {
        return '/search'
      }
      return `/creators/${props.stat.channel}`
    })
    const channelName = computed(() => capitalize(props.stat.channel))
    const channelCount = computed(() => props.stat.total_today.toLocaleString())
    const channelGrowth = computed(() => {
      if (props.period === '1M') {
        return Math.round(
          (props.stat.total_today / props.stat.total_1m_ago - 1) * 100
        )
      }
      if (props.period === '3M') {
        return Math.round(
          (props.stat.total_today / props.stat.total_3m_ago - 1) * 100
        )
      }
      if (props.period === '1Y') {
        return Math.round(
          (props.stat.total_today / props.stat.total_1y_ago - 1) * 100
        )
      }
    })
    return { channelLogo, channelName, channelCount, channelGrowth, channelUrl }
  }
})
</script>
