<template>
  <div class="relative mr-6 text-xxs">
    <div class="flex justify-end">
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
          class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
        >
          <screenshot-icon class="w-3 h-3"></screenshot-icon>
        </button>
        <button
          @click="webShare"
          v-if="isWebShareSupported"
          class="px-1 py-0.5 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-200"
        >
          <share-icon class="w-3 h-3"></share-icon>
        </button>
        <social-share-panel v-else></social-share-panel>
      </div>
    </div>
  </div>
</template>

<script>
import ScreenshotIcon from '../Icons/ScreenshotIcon.vue'
import ShareIcon from '../Icons/ShareIcon.vue'
import { defineComponent, ref } from '@vue/runtime-core'
import useWebShare from '../Composables/useWebShare'
import SocialSharePanel from './SocialSharePanel.vue'

export default defineComponent({
  components: {
    ScreenshotIcon,
    ShareIcon,
    SocialSharePanel
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
    const { webShare, isSupported: isWebShareSupported } = useWebShare()

    const screenshot = () => {
      emit('screenshot')
    }

    const toggle = (days) => {
      filteringDays.value = days
      emit('toggle', days)
    }

    return {
      screenshot,
      buttons,
      toggle,
      filteringDays,
      isWebShareSupported,
      webShare
    }
  }
})
</script>
