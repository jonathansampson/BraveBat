<template>
  <div class="flex justify-end mb-2 mr-6 text-xxs">
    <div
      class="flex items-center px-1 py-0.5 space-x-0.5 bg-gray-100 rounded-md"
    >
      <div v-if="toggleable">
        <button
          v-for="(days, label) in buttons"
          :key="label"
          @click="toggle(days)"
          class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
          :class="{ 'bg-white': days === filteringDays }"
        >
          {{ label }}
        </button>
      </div>
      <button
        @click="screenshot"
        class="inline-flex items-center justify-center px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
        :class="{}"
      >
        <screenshot-icon class="w-3 h-3"></screenshot-icon>
      </button>
      <button
        v-if="isWebShareSupported"
        @click="chartShare"
        class="inline-flex items-center justify-center px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
      >
        <share-icon class="w-3 h-3"></share-icon>
      </button>
    </div>
  </div>
</template>

<script>
import ScreenshotIcon from '../Icons/ScreenshotIcon.vue'
import ShareIcon from '../Icons/ShareIcon.vue'
import { defineComponent, ref } from '@vue/runtime-core'
import useWebShare from '../Composables/useWebShare'

export default defineComponent({
  components: {
    ScreenshotIcon,
    ShareIcon
  },
  props: {
    toggleable: {
      type: Boolean,
      default: false
    }
  },
  emits: ['screenshot', 'toggle'],
  setup(_, { emit }) {
    const filteringDays = ref(null)
    const buttons = {
      '7D': 7,
      '1M': 30,
      '3M': 90,
      '1Y': 365,
      All: null
    }
    const { chartShare, isSupported: isWebShareSupported } = useWebShare()

    const screenshot = () => {
      emit('screenshot')
    }

    const toggle = (days) => {
      filteringDays.value = days
      emit('toggle', days)
    }

    return {
      screenshot,
      chartShare,
      isWebShareSupported,
      buttons,
      toggle,
      filteringDays
    }
  }
})
</script>
